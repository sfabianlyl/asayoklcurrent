<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    if(!isset($_POST["name"])){
        header('Location: /checkin');
        die();
    }

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

$spreadsheetId ='1eylKPAyc6WR43Fqgq1xWK0oi0sl1ptxVmgMk8XuzLwU';
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $name=$_POST["nameChild"];
    $phone=$_POST["phoneChild"];
    $email=$_POST["emailChild"];
    $relation=$_POST["relation"];
    $nameChild=$_POST["name"];
    $phoneChild=$_POST["phone"];
    $emailChild=$_POST["email"];
    $month=$_POST["month"];
    $year=$_POST["year"];
    $state=$_POST["state"];
    $campus=$_POST["campus"];
   
    $timestamp=date("d/m/Y h:i:s A");

   
    //insert into database
    // $sql="INSERT into `census-behalf` (`name`,`phone`,`email`,`relation`,`nameChild`,`phoneChild`,`emailChild`,`month`,`year`,`state`,`timestamp`) 
    // values ('$name','$phone','$email','$relation','$nameChild','$phoneChild','$emailChild','$month','$year','$state','$timestamp');";
  
    $conn->query($sql);
    
    //insert into google sheet

    $range = 'A1:T';
    $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
    $count=count($rows['values']);
    $data[]=$count;
    $data[]=$name;
    $data[]=$phone;
    $data[]=$email;
    $data[]=$relation;
    $data[]=$nameChild;
    $data[]=$phoneChild;
    $data[]=$emailChild;
    $data[]=$month;
    $data[]=$year;
    $data[]=$state;
    $data[]=$timestamp;
    $data[]=$campus;
    $values=array($data);
 
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
    
    //make email through mail()
    //$to="sfabianlyl@gmail.com"; //for mail()
    $subject="Checkin On Behalf"; 
    $message="<h1>Checkin on behalf</h1>";
    $message.="<p><b>Name: </b>$name</p>";
    $message.="<p><b>Mobile No: </b>$phone</p>";
    $message.="<p><b>Email: </b>$email</p>";
    $message.="<p><b>Relation: </b>$relation</p>";
    $message.="<p><b>Child Name: </b>$nameChild</p>";
    $message.="<p><b>Email: </b>$emailChild</p>";
    $message.="<p><b>Mobile No: </b>$phoneChild</p>";
    $message.="<p><b>Year of Migrating: </b>$year</p>";
    $message.="<p><b>Month of Migrating: </b>$month</p>";
    $message.="<p><b>Migrating to: </b>$state</p>";
    $message.="<p><b>Campus/Company: </b>$campus</p>";
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
        $mail->Password = '4ZykA3GcM7mS';                           // SMTP password
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
        $mail->addAddress($email);
        $mail->addAddress($emailChild);
       
        $mail->addCC('checkin@asayokl.org');
        $mail->addBCC('josephine@asayokl.org');


    //Content
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = $message;


        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
        
    
?>

<script>
    alert('Submitted Successfully!');
    window.location='/checkin';
</script>