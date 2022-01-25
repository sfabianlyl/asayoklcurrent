<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    if(!isset($_POST["name"])){
        header('Location: /checkin');
        die();
    }

    //set up DB connection, and google sheets API connection

    //DB connection:
//for testing

   // $servername="localhost";
   // $username="root";
    //$password="";
    //$database="asayokl";
//for production

     $servername="localhost";
     $username="catholic_asayokl";
     $password=")weIV$+y6,[H";
     $database="catholic_asayokl";
    $conn=new mysqli($servername,$username,$password,$database);


//google sheets connection:

$client = new \Google_Client();
$client->setApplicationName('My PHP App');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');

$client->setAuthConfig('../cdac4de75d4e/asayokldb-cdac4de75d4e.json');
$sheets = new \Google_Service_Sheets($client);

$spreadsheetId ='13QAI_yr0k7R_ZJv-Ak9bgf4VANvkMMhHkCXXcsTUYQ0';


    date_default_timezone_set("Asia/Kuala_Lumpur");
    $nationality=$_POST["nationality"];
    $age=$_POST["age"];
    $name=$_POST["name"];
    $IC=$_POST["IC"];
    $phone=$_POST["mobile"];
    $email=$_POST["email"];
    $baptism=$_POST["baptism"];
    $confirmation=$_POST["confirmation"];
    $eucharist=$_POST["eucharist"];
    $country= (isset($_POST["country"])? $_POST["country"]:'Malaysia');
    $state=(isset($_POST["state"])? $_POST["state"]:"");
    $diocese=$_POST["diocese"];
    $parish=$_POST["parish"];
    $migrateCountry=$_POST["migrateCountry"];
    $migrateState=(isset($_POST["migrateState"])? $_POST["migrateState"]:'');
    $migrateDiocese= (isset($_POST["migrateDiocese"])? $_POST["migrateDiocese"]:'');
    $migrateParish=(isset($_POST["migrateParish"])? $_POST["migrateParish"]:'');
    $campus=(isset($_POST["campus"])? $_POST["campus"]:'');
    $field=(isset($_POST["field"])? $_POST["field"]:'');
    $organisation=(isset($_POST["organisation"])? $_POST["organisation"]:'');
    $occupation=(isset($_POST["occupation"])? $_POST["occupation"]:'');
    
    $status=$_POST["status1"];
    $assist=$_POST["assist"];
    $timestamp=date("d/m/Y h:i:s A");

    switch($state){
        case "Selangor":
        case "Kuala Lumpur": $district="Undefined"; break;
        case "Pahang":
        case "Terengganu": $district="PT"; break;
        case "Negeri Sembilan": $district="NS"; break;
        case "Putrajaya": $district="KLS"; break;
        default: $district="Non ArchKL";
    }

    switch($migrateState){
        case "Selangor":
        case "Kuala Lumpur": $migrateDistrict="Undefined"; break;
        case "Pahang":
        case "Terengganu": $migrateDistrict="PT"; break;
        case "Negeri Sembilan": $migrateDistrict="NS"; break;
        case "Putrajaya": $migrateDistrict="KLS"; break;
        default: $migrateDistrict="Non ArchKL";
    }


    //get images path
    if(isset($_POST["baptismImg"]))
        $baptismImg=$_POST["baptismImg"];
    if(isset($_POST["confirmationImg"]))
        $confirmationImg=$_POST["confirmationImg"];
    if(isset($_POST["eucharistImg"]))
        $eucharistImg=$_POST["eucharistImg"];

    //insert into database
    $sql="INSERT into census (nationality, age, `name`, ic, phone, email, baptism, confirmation, eucharist, country, diocese, parish, 
    migrateCountry, migrateDiocese, migrateParish, campus, field, organisation, occupation, `status`, `timestamp`, `assist`) 
    values ('$nationality','$age','$name','$IC','$phone','$email','$baptism','$confirmation','$eucharist','$country','$diocese','$parish',
    '$migrateCountry','$migrateDiocese','$migrateParish','$campus','$field','$organisation','$occupation','$status','$timestamp','$assist');";
  
    $conn->query($sql);
    
    //insert into google sheet

    $range = 'A1:Z';
    $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
    $count=count($rows['values']);
    $data[]=$count;
    $data[]=$migrateDistrict;
    $data[]=$nationality;
    $data[]=$age;
    $data[]=$name;
    $data[]=$IC;
    $data[]=$phone;
    $data[]=$email;
    $data[]=$baptism;
    $data[]=$confirmation;
    $data[]=$eucharist;
    $data[]=$country;
    $data[]=$state;
    $data[]=$diocese;
    $data[]=$district;
    $data[]=$parish;
    $data[]=$migrateCountry;
    $data[]=$migrateDiocese;
    $data[]=$migrateParish;
    $data[]=$campus;
    $data[]=$field;
    $data[]=$organisation;
    $data[]=$occupation;
    $data[]=$status;
    $data[]=$timestamp;
    $data[]=$assist;
    $values=array($data);
 
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
    
    //make email through mail()
    //$to="sfabianlyl@gmail.com"; //for mail()
    $subject="New Census Form"; 
    $message="<h1>New Census Form</h1>";
    $message.="<p><b>Nationality: </b>$nationality</p>";
    $message.="<p><b>Age: </b>$age</p>";
    $message.="<p><b>Name: </b>$name</p>";
    $message.="<p><b>Identification No: </b>$IC</p>";
    $message.="<p><b>Mobile No: </b>$phone</p>";
    $message.="<p><b>Email: </b>$email</p>";
    $message.="<p><b>Baptism: </b>$baptism</p>";
    $message.="<p><b>Confirmation: </b>$confirmation</p>";
    $message.="<p><b>Eucharist: </b>$eucharist</p>";
   
    if($country!="Malaysia"){
        $message.="<p><b>From Country: </b>$country</p>";
        $message.="<p><b>From State: </b>$state</p>";
    }
       
    $message.="<p><b>From Diocese: </b>$diocese</p>";
    $message.="<p><b>From Parish: </b>$parish</p>";
    $message.="<p><b>Migrate Country: </b>$migrateCountry</p>";
    if($migrateCountry=="Malaysia"){
        $message.="<p><b>Migrate State: </b>$migrateState</p>";
        $message.="<p><b>Migrate Diocese: </b>$migrateDiocese</p>";
    }
        
    if($migrateDiocese=="Keuskupan Agung Kuala Lumpur"){
        $message.="<p><b>Migrate District: </b>$migrateDistrict</p>";
        $message.="<p><b>Migrate Parish: </b>$migrateParish</p>";
    }
        
    if($campus==''){
        $message.="<p><b>Organization: </b>$organisation</p>";
        $message.="<p><b>Occupation: </b>$occupation</p>";
    }else{
        $message.="<p><b>Campus: </b>$campus</p>";
        $message.="<p><b>Field: </b>$field</p>";
    }
    
    $message.="<p><b>Marital Status: </b>$status</p>";
    $message.="<p><b>Assistance Required: </b>$assist</p>";
    $message.="<p>Thank you</p>";
    $message.="<p><b><i><font color='red'>This is a no reply email. Please do not reply to this email.</font></i></b></p>";

 
    $header="MIME-Version: 1.0" . "\r\n";
    $header.="Content-type: multipart/related; boundary='emailsectionseparator'; type='text/html'" . "\r\n";
    $header.="From: {noreply@catholicyouth.my}";
    // mail($to,$subject,$message,$header);  //sends using mail()

    //make email through PHPMailer

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
    //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.catholicyouth.my';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@catholicyouth.my';       // SMTP username
        $mail->Password = 'q4U2nSh2cDZJ';                           // SMTP password
       // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 26;                                    // TCP port to connect to
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    //Recipients
        $mail->setFrom('noreply@catholicyouth.my', 'ASAYO KL');

    switch($diocese){
        case 'Keuskupan Agung Kuala Lumpur': 
            $mail->addAddress('josephine@asayokl.my'); 
            break;

        case 'Keuskupan Pulau Pinang': 
            $mail->addAddress('pdyn@pgdiocese.org'); 
            $mail->addAddress('cmo.penang.diocese@gmail.com'); 
            break;

        case 'Keuskupan Agung Kuching': 
            $mail->addAddress('kchadyouth.office@gmail.com'); 
            break;

        case 'Keuskupan Agung Kota Kinabalu': 
            $mail->addAddress('dypt2007@gmail.com'); 
            break;

        case 'Keuskupan Melaka-Johor': 
            $mail->addAddress('daryltan@majodi.org'); 
            $mail->addAddress('mattwee@majodi.org'); 
            $mail->addAddress('malaccajohorecc@gmail.com'); 
            break;

        case 'Keuskupan Miri': 
            $mail->addAddress('genie.maylynn@gmail.com'); 
            break;

        case 'Keuskupan Sibu': 
            $mail->addAddress('sibudioceseyouth@gmail.com'); 
            break;

        case 'Keuskupan Keningau': 
            $mail->addAddress('kbkkgau@gmail.com'); 
            break;

        case 'Keuskupan Sandakan': 
            $mail->addAddress('dyasdkn@gmail.com'); 
            break;

        default: break;
    }
    
    switch($migrateDiocese){
        case 'Keuskupan Agung Kuala Lumpur': 
            $mail->addAddress('josephine@asayokl.my'); 
            break;

        case 'Keuskupan Pulau Pinang': 
            $mail->addAddress('pdyn@pgdiocese.org'); 
            $mail->addAddress('cmo.penang.diocese@gmail.com'); 
            break;

        case 'Keuskupan Agung Kuching': 
            $mail->addAddress('kchadyouth.office@gmail.com'); 
            break;

        case 'Keuskupan Agung Kota Kinabalu': 
            $mail->addAddress('dypt2007@gmail.com'); 
            break;

        case 'Keuskupan Melaka-Johor': 
            $mail->addAddress('daryltan@majodi.org'); 
            $mail->addAddress('mattwee@majodi.org'); 
            $mail->addAddress('malaccajohorecc@gmail.com'); 
            break;

        case 'Keuskupan Miri': 
            $mail->addAddress('genie.maylynn@gmail.com'); 
            break;

        case 'Keuskupan Sibu': 
            $mail->addAddress('sibudioceseyouth@gmail.com'); 
            break;

        case 'Keuskupan Keningau': 
            $mail->addAddress('kbkkgau@gmail.com'); 
            break;

        case 'Keuskupan Sandakan': 
            $mail->addAddress('dyasdkn@gmail.com'); 
            break;

        default: break;
    }
    $mail->addAddress($email);
        //$mail->addAddress($to);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('annedanam@asayokl.org');
        $mail->addCC('checkin@asayokl.my');
        $mail->addBCC('josephine@asayokl.my');
        $mail->addBCC('fabian@asayokl.my');
    //Attachments
    if(isset($_POST["baptismImg"]))
        $mail->addAttachment($baptismImg);         // Add attachments
    if(isset($_POST["confirmationImg"]))
        $mail->addAttachment($confirmationImg);         // Add attachments
    if(isset($_POST["eucharistImg"]))
        $mail->addAttachment($eucharistImg);         // Add attachments


    //Content
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = $message;


        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }





    if(isset($_POST["baptismImg"]))
        unlink($baptismImg);
    if(isset($_POST["confirmationImg"]))
        unlink($confirmationImg);
    if(isset($_POST["eucharistImg"]))
        unlink($eucharistImg);
        
    // header('Location: /');
    // die();

        
    
?>

<script>
    alert('Submitted Successfully!');
    window.location.replace('https://www.asayokl.my');
</script>