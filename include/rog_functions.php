<?php 
    $servername="localhost";
    $username="catholic_asayokl";
    $password=")weIV$+y6,[H";
    $database="catholic_asayokl";
    $table="rog_users";

    $conn=new mysqli($servername,$username,$password,$database);


    function authenticate(){
        global $conn;
        $token=getToken();
        $sql="SELECT `token_timestamp` from `rog_token` where `rog_token`=?;";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$token);
        $stmt->execute();
        $date=$stmt->get_result()->fetch_assoc()["token_timestamp"];
        if(strtotime($date)<strtotime("-30 days")){
            logout();
            return false;
        }else{
            return true;
        }
    }

    function login($input){
        global $conn;
        $username=$input["username"];
        $password=$input["password"];

        $sql="select * from `rog_users` where `group_login`=? and `group_password`=md5(?);";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $result=$stmt->get_result();
        $exist=$result->num_rows;

        if($exist){
            $row=$result->fetch_assoc();
            $id=$row["group_id"];
            $type=$row["group_category"];
            $token="";
            $sql="select * from `rog_token` where `rog_token`=?;";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("s",$token);
            do{
                $token=randomString().uniqid("",true);
                $stmt->execute();
                $result2=$stmt->get_result()->fetch_assoc();
            }while($result2);
            
            $sql="INSERT into `rog_token` (`rog_token`,`user_id`) values (?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("ss",$token,$id);
            $stmt->execute();

            return ["success"=>true, "token"=>$token, "type"=>$type];
        }else{
            return ["success"=>false];
        }
    }

    function logout(){
        global $conn;
        $token=getToken();
        $sql="DELETE FROM `rog_token` where rog_token=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$token);
        $stmt->execute();
    }

    function changePassword($input){
        global $conn;
        if(!authenticate()){
            header("Location: /reachout");
            die();
        }
        $pass_encrypt=md5($input["new"]);
        $sql="update `rog_users` set `group_password`=? where `group_id`=?;";
        $id=getID();
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$pass_encrypt,$id);
        $stmt->execute();

    }

    function createApplication($input){
        global $conn;
        if(!authenticate()){
            header("Location: /reachout");
            die();
        }

        $id=(isset($input["group_id"]))?$id=$input["id"]:$id=getID();


        for($i=0; $i<count($input["name"]);$i++){
            $input["members"][]=[
                "name"=>$input["name"][$i],
                "mobile"=>$input["mobile"][$i],
                "email"=>$input["email"][$i],
                "membership"=>$input["membership"][$i]
            ];
        }
        $sql="INSERT into `rog_application` (`user_id`,`application_json`) values (?,?)";
        
        $inputs=json_encode($input);
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss", $id,$inputs);
        $stmt->execute();

        $groupName=$input["teamName"];
        $sql="UPDATE `rog_users` set `group_name`=? where `group_id`=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$groupName,$id);
        $stmt->execute();

        if(isset($input["submit"]))
        if($input["submit"]=="submit"){
            $sql="update `rog_users` set `group_category`='pending' where `group_id`='$id';";
            $conn->query($sql);
        }

    }

    function getLatestApplications(){
        global $conn;

        
        $sql="SELECT `user_id`,`application_json` from `rog_application` where `application_no` in (SELECT max(`application_no`) from `rog_application` group by `user_id` )";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc()){
            $output=json_decode($row["application_json"],true);
            $output["id"]=$row["user_id"];
            $outputs[]=$output;
        }
        
        return $outputs;
    }

    function getLatestApplication($id=null){
        global $conn;
        if(!$id) $id=getID();

        $sql="SELECT `application_json` from `rog_application` where `user_id`='$id' order by `application_timestamp` desc limit 1";
        return json_decode($conn->query($sql)->fetch_assoc()["application_json"],true);
    }

    function uploadVideo($input){

    }

    function getAllContent(){

    }

    function getMemberType($id=null){
        global $conn;
        if(!$id) $id=getID();

        $sql="SELECT `group_category` from `rog_users` where `group_id`=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["group_category"];
    }

    function loggedIn(){
        return (getToken())? true:false;
    }

    function setToken($token){
        setcookie("token",$token,time()+60*60*24*30,"/");
    }

    function getToken(){
        return $_COOKIE["token"];
    }

    function getID(){
        global $conn;
        $token=getToken();
        $sql="SELECT `user_id` from `rog_token` where `rog_token`=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["user_id"];
    }

    function getName($id=null){
        global $conn;
        if(!$id) $id=getID();

        $sql="SELECT `group_name` from `rog_users` where `group_id`=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["group_name"];
    }

    function randomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }


?>