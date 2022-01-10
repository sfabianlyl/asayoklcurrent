<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $panel=false;
    include 'templates/header.php';
    date_default_timezone_set ("Asia/Kuala_Lumpur");

    
    // $mandTime=strtotime("September 7th 8.45pm");
    // $mandVal=date("j/n",$mandTime);
    // $mand="Mandarin $mandVal";
    // $mandStr=date("d/m/Y - g:ia",$mandTime);
    $mandTime2=strtotime("October 18th 8.45pm"); 
    $mandVal2=date("j/n",$mandTime2);
    $mand2="Mandarin $mandVal2"; 
    $mandStr2=date("d/m/Y - g:ia",$mandTime2);

    // $bmTime=strtotime("September 8th 8.45pm");
    // $bmVal=date("j/n",$bmTime);
    // $bm="BM $bmVal";
    // $bmStr=date("d/m/Y - g:ia",$bmTime);
    $bmTime2=strtotime("October 26th 8.45pm"); 
    $bmVal2=date("j/n",$bmTime2);
    $bm2="BM $bmVal2"; 
    $bmStr2=date("d/m/Y - g:ia",$bmTime2);

    // $tamilTime=strtotime("September 9th 8.45pm"); 
    // $tamilVal=date("j/n",$tamilTime);
    // $tamil="Tamil $tamilVal"; 
    // $tamilStr=date("d/m/Y - g:ia",$tamilTime);
    $tamilTime2=strtotime("October 20th 8.45pm"); 
    $tamilVal2=date("j/n",$tamilTime2);
    $tamil2="Tamil $tamilVal2"; 
    $tamilStr2=date("d/m/Y - g:ia",$tamilTime2);

    // $engTime=strtotime("September 10th 8.45pm"); 
    // $engVal=date("j/n",$engTime);
    // $eng="English $engVal"; 
    // $engStr=date("d/m/Y - g:ia",$engTime);
    $engTime2=strtotime("October 21st 8.45pm"); 
    $engVal2=date("j/n",$engTime2);
    $eng2="English $engVal2"; 
    $engStr2=date("d/m/Y - g:ia",$engTime2);

    $yaTamTime=strtotime("October 25th 8.45pm"); 
    $yaTamVal=date("j/n",$yaTamTime);
    $yaTam="Young Adult (Tamil) $yaTamVal"; 
    $yaTamStr=date("d/m/Y - g:ia",$yaTamTime);
    // $yaTamTime2=strtotime("September 10th 8.45pm"); 
    // $yaTamVal2=date("j/n",$yaTamTime2);
    // $yaTam2="Young Adult (Tamil) $yaTamVal2"; 
    // $yaTamStr2=date("d/m/Y - g:ia",$yaTamTime2);
    // $yaTamTime3=strtotime("September 17th 8.45pm"); 
    // $yaTamVal3=date("j/n",$yaTamTime3);
    // $yaTam3="Young Adult (Tamil) $yaTamVal3"; 
    // $yaTamStr3=date("d/m/Y - g:ia",$yaTamTime3);

    $yaBmEngTime=strtotime("October 25th 8.45pm"); 
    $yaBmEngVal=date("j/n",$yaBmEngTime);
    $yaBmEng="Young Adult (BM/Eng) $yaBmEngVal"; 
    $yaBmEngStr=date("d/m/Y - g:ia",$yaBmEngTime);
    // $yaBmEngTime2=strtotime("September 28th 8.45pm"); 
    // $yaBmEngVal2=date("j/n",$yaBmEngTime2);
    // $yaBmEng2="Young Adult (BM/Eng) $yaBmEngVal2"; 
    // $yaBmEngStr2=date("d/m/Y - g:ia",$yaBmEngTime2);
    
    $yaMandTime=strtotime("October 25th 8.45pm"); 
    $yaMandVal=date("j/n",$yaMandTime);
    $yaMand="Young Adult (Mandarin) $yaMandVal"; 
    $yaMandStr=date("d/m/Y - g:ia",$yaMandTime);

    // $ycsTime=strtotime("September 17th 8.45pm"); 
    // $ycsVal=date("j/n",$ycsTime);
    // $ycs="Youth and Campus Students (BM/Eng) $ycsVal"; 
    // $ycsStr=date("d/m/Y - g:ia",$ycsTime);
    $ycsTime2=strtotime("October 27th 8.45pm"); 
    $ycsVal2=date("j/n",$ycsTime2);
    $ycs2="Youth and Campus Students (BM/Eng) $ycsVal2"; 
    $ycsStr2=date("d/m/Y - g:ia",$ycsTime2);
    
    $klnTime=strtotime("January 25th 8.30pm"); 
    $klnVal=date("j/n",$klnTime);
    $kln="KL North $klnVal"; 
    $klnStr=date("d/m/Y - g:ia",$klnTime);
    
    $petalingTime=strtotime("January 28th 8.30pm"); 
    $petalingVal=date("j/n",$petalingTime);
    $petaling="Petaling $petalingVal"; 
    $petalingStr=date("d/m/Y - g:ia",$petalingTime);
    

    // $taizeTime=strtotime("August 30th 8.00pm");
    // $taizeVal=date("j/n",$taizeTime);
    // $taize="Game Night $taizeVal"; $taizeStr=date("d/m/Y - g:ia",$taizeTime);
    
    // $gntTime=strtotime("August 22nd 8.30pm");
    // $gntVal=date("j/n",$gntTime);
    // $gnt="Game Night (Tamil) $gntVal"; $gntStr=date("d/m/Y - g:ia",$gntTime);
    
    // mand 20/4 8.00
    $irlMand=[
        "Mandarin 24/4 8.00"=>"8.00am - 9.30am",
        "Mandarin 24/4 10.00"=>"10.00am - 11.30am",
        "Mandarin 24/4 12.00"=>"12.00pm - 1.30pm",
        "Mandarin 24/4 3.00"=>"3.00pm - 4.30pm",
        "Mandarin 24/4 5.00"=>"5.00pm - 6.30pm"
    ];
    $irlBm=[    
        "BM 24/4 8.00"=>"8.00am - 9.30am",
        "BM 24/4 10.00"=>"10.00am - 11.30am",
        "BM 24/4 12.00"=>"12.00pm - 1.30pm",
        "BM 24/4 3.00"=>"3.00pm - 4.30pm",
        "BM 24/4 5.00"=>"5.00pm - 6.30pm"
    ];
    $irlEng=[
        "English 24/4 8.00"=>"8.00am - 9.30am",
        "English 24/4 10.00"=>"10.00am - 11.30am",
        "English 24/4 12.00"=>"12.00pm - 1.30pm",
        "English 24/4 3.00"=>"3.00pm - 4.30pm",
        "English 24/4 5.00"=>"5.00pm - 6.30pm"
    ];
?>

<?php
    // $servername="localhost";
    // $username="root";
    // $password="";
    // $database="asayokl";
    $servername="localhost";
    $username="catholic_asayokl";
    $password=")weIV$+y6,[H";
    $database="catholic_asayokl";
    $conn=new mysqli($servername,$username,$password,$database);
    if(isset($_POST["submit"])){
        
        

        //google sheets connection:
        $client = new \Google_Client();
        $client->setApplicationName('My PHP App');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig('../cdac4de75d4e/asayokldb-cdac4de75d4e.json');
        $sheets = new \Google_Service_Sheets($client);
        $spreadsheetId ='1_3eQTaT0dk4oDxn_gmT0V5Es2MHdrHi1pkm0s11fK3U';
        
        
        $nationality=$_POST["nationality"];
        $name=$_POST["name"];
        $age=$_POST["age"];
        $gender=$_POST["gender"];
        $email=$_POST["email"];
        $parish=$_POST["parish"];
        $diocese=$_POST["diocese"];
        $phone=$_POST["phone"];
        $program=$_POST["program"];
        
        if($program=="IRL"){
            $spreadsheetId='1NOWQumdvB0Su2GopR_vkV96EXiprKt8L1_Z07pmvZuQ';
            $slot=$_POST["slot"];
            $parts=explode(" ",$slot);
            $lang=$parts[0];
            $date=$parts[1];
            $datesql="%$date%";
            $time=$parts[2];
            $sql="SELECT count(*) as `number` from `hangout-irl` where `email`=? and `slot` like ?;";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param('ss',$email,$datesql);
            $stmt->execute();
            $result=$stmt->get_result()->fetch_assoc()["number"];
            $sql="SELECT count(*) as `number` from `hangout-irl` where `email`=? and `slot`=?;";
            $stmt2=$conn->prepare($sql);
            $stmt2->bind_param('ss',$email,$slot);
            $stmt2->execute();
            $count=$stmt2->get_result()->fetch_assoc()["number"];
            if($count>7){
                $type="waitlist";
            }else{
                $type="normal";
            }
            if($result==0){
                $sql="INSERT INTO `hangout-irl` (`slot`,`name`,`age`,`gender`,`email`,`phone`,`parish`,`diocese`,`nationality`,`type`) values (?,?,?,?,?,?,?,?,?,?);";
                $stmt3=$conn->prepare($sql);
                $stmt3->bind_param("ssssssssss",$slot,$name,$age,$gender,$email,$phone,$parish,$diocese,$nationality,$type);
                $stmt3->execute();
                
                $range = "$lang!A1:M";
                $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
                $count=count($rows['values']);
                $data=[];
                $data[]=$count;
                $data[]=$date;
                $data[]=$time;
                $data[]=$nationality;
                $data[]=$name;
                $data[]=$age;
                $data[]=$gender;
                $data[]=$email;
                $data[]=$phone;
                $data[]=$diocese;
                $data[]=$parish;
                $data[]=$type;
                $data[]=date("jS F Y, g:i a");
                
                $values=array($data);
                $body = new Google_Service_Sheets_ValueRange([
                    'values' => $values
                ]);
                $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
                
                $subject="Hangout: In Real Life (IRL) with ASAYOKL"; 
                $message="<h1>Thank You for Registering!</h1>";
                $message.="<p>Terima kasih atas pendaftaran anda. Kami akan menghubungi anda melalui e-mel atau telefon (Whatsapp) untuk maklumat lanjut.";
                $message.="<br>[Thank you for your registration. We will contact you via email or phone (Whatsapp) for further information.]</p>";
                $message.="<p>Thank you</p>";
                $message.="<p><b><i><font color='red'>This is a no reply email. Please do not reply to this email.</font></i></b></p>";
                
                $header="MIME-Version: 1.0" . "\r\n";
                $header.="Content-type: multipart/related; boundary='emailsectionseparator'; type='text/html'" . "\r\n";
                $header.="From: {noreply@catholicyouth.my}";
                
                
                
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.catholicyouth.my';                  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'noreply@catholicyouth.my';       // SMTP username
                    $mail->Password = 'FOWo9nqkijlk';                           // SMTP password
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
    
                //Content
                    $mail->isHTML(true);                                 
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    $mail->send();
                } 
                catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
            
        }else{
            $languages=$_POST["language"];
            foreach($languages as $language){
                $sql="SELECT * from `hangouts` where `email`='$email' and `language`='$language';";
                $result=$conn->query($sql);
                if($row=$result->fetch_assoc()){
                    
                }else{
                    $sql="INSERT INTO `hangouts` (`language`,`name`,`age`,`gender`,`email`,`phone`,`parish`,`diocese`,`nationality`) values ('$language','$name','$age','$gender','$email','$phone','$parish','$diocese','$nationality');";
                    $conn->query($sql);
                    $parts=explode(" ",$language);
                    $date=array_pop($parts);
                    $lang=implode(" ",$parts);
                    $range = "$lang!A1:G";
                    $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
                    $count=count($rows['values']);
                    $data=[];
                    $data[]=$count;
                    $data[]=$date;
                    $data[]=$nationality;
                    $data[]=$name;
                    $data[]=$age;
                    $data[]=$gender;
                    $data[]=$email;
                    $data[]=$phone;
                    $data[]=$diocese;
                    $data[]=$parish;
                    
                    $values=array($data);
                
                    $body = new Google_Service_Sheets_ValueRange([
                        'values' => $values
                    ]);
                    $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
                    $temp=explode("@",$date);
                    $datePart=explode("/",$temp[0]);
                    $day=$datePart[0];
                    $month=$datePart[1];
                    $str=date("d/m/Y - g:ia",strtotime("$month/$day 8.45pm"));
                    $sessions[]="$lang @ $str";
                }
            }
            if(isset($sessions)){
            $subject="Online Hangout with ASAYOKL"; 
            $message="<h1>Thank You for Registering!</h1>";
            $message.="<p>Terima kasih atas pendaftaran anda. Kami akan menghubungi anda melalui e-mel atau telefon (Whatsapp) untuk kod mesyuarat **2 jam sebelum kita mulakan. Dalam masa yang sama, anda boleh:";
            $message.="<br>[Thank you for your registration. We will contact you via email or phone (Whatsapp) for meeting code **2 hours before we start. In the meantime, you can]:</p>";
            $message.="<p>**Muat Turun Aplikasi Hangouts Meet (Download Hangouts Meet App)</p>";
            $message.="<p>Untuk pengguna Android (For Android users): https://play.google.com/store/apps/details?id=com.google.android.apps.meetings</p>";
            $message.="<p>Untuk pengguna iPhone/iPad (For iPhone/iPad users): https://apps.apple.com/my/app/hangouts-meet-by-google/id1013231476</p>";
            $message.="<p>Jika anda menggunakan laptop/PC (If you are connecting from a laptop/PC):</p>";
            $message.="<p>Anda memerlukan emel/akaun Google. Buka Aplikasi Google Meet melalui papan pemuka akaun Google<br>
                        (You will need a Google email/account. Open the Google Meet app via the Google account dashboard):<br>
                        https://meet.google.com/</p>";
            $message.="<br><p><b>Sesi (Session): </b></p>";
            $message.="<ol>";
            foreach($sessions as $session){
                $message.="<li>$session</li>";
            }
            $message.="</ol><br>";
            $message.="<p><b>Nama (Name): </b>$name</p>";
            $message.="<p><b>No. Telefon (Mobile No.): </b>$phone</p>";
            $message.="<p><b>E-mel (Email): </b>$email</p>";
            
        
            $message.="<p>Thank you</p>";
            $message.="<p><b><i><font color='red'>This is a no reply email. Please do not reply to this email.</font></i></b></p>";

            $header="MIME-Version: 1.0" . "\r\n";
            $header.="Content-type: multipart/related; boundary='emailsectionseparator'; type='text/html'" . "\r\n";
            $header.="From: {noreply@catholicyouth.my}";

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'mail.catholicyouth.my';                  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'noreply@catholicyouth.my';       // SMTP username
                $mail->Password = 'FOWo9nqkijlk';                           // SMTP password
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

            //Content
                $mail->isHTML(true);                                 
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->send();
            } 
            catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
        }
        
    }
?>

<?php 
    if(isset($mand)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$mand';";
        $mandNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $mandNum=90;
    }
    
    if(isset($bm)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$bm';";
        $bmNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $bmNum=90;
    }
    
    if(isset($tamil)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$tamil';";
        $tamilNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $tamilNum=90;
    }
    
    if(isset($eng)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$eng';";
        $engNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $engNum=90;
    }
    
    
    if(isset($mand2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$mand2';";
        $mandNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $mandNum2=90;
    }
    
    if(isset($bm2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$bm2';";
        $bmNum2=$conn->query($sql)->fetch_assoc()["numb"];        
    }else{
        $bmNum2=90;
    }

    if(isset($tamil2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$tamil2';";
        $tamilNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $tamilNum2=90;
    }
    
    if(isset($eng2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$eng2';";
        $engNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $engNum2=90;
    }

    
    if(isset($yaBmEng)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaBmEng';";
        $yaBmEngNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaBmEngNum=90;
    }
    
    if(isset($yaBmEng2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaBmEng2';";
        $yaBmEngNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaBmEngNum2=90;
    }
    
    if(isset($yaTam)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaTam';";
        $yaTamNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaTamNum=90;
    }

    if(isset($yaTam2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaTam2';";
        $yaTamNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaTamNum2=90;
    }

    if(isset($yaTam3)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaTam3';";
        $yaTamNum3=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaTamNum3=90;
    }
    
    if(isset($yaMand)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$yaMand';";
        $yaMandNum3=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $yaMandNum3=90;
    }

    if(isset($ycs)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$ycs';";
        $ycsNum=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $ycsNum=90;
    }
    
    if(isset($ycs2)){
        $sql="SELECT count(*) as `numb` from `hangouts` where `language`='$ycs2';";
        $ycsNum2=$conn->query($sql)->fetch_assoc()["numb"];
    }else{
        $ycsNum2=90;
    }
    
?>

<div class="mb-5">
    <h3 class="text-center">Online Hangout with ASAYOKL</h3>
    <p class="text-center"><i>Join us according to your preferred language</i></p>
</div>


<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <form action="" id="myform" method="POST">
            <div class="row mb-5 align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="scripture" required>
                                <div><img src="Images/HANGOUT SCRIPTURE_1080by540.png" class="w-100"></div>
                            </label>
                        </div>
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="youngAdult" required>
                                <div><img src="Images/HANGOUT YOUNG ADULTS_1080by540.png" class="w-100"></div>
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="youthCampus" required>
                                <div><img src="Images/HANGOUT Y_C STUDENTS_1080by540.png" class="w-100"></div>
                            </label>
                        </div>
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="game" required>
                                <div><img src="Images/HANGOUT GN_1080by540.png" class="w-100"></div>
                            </label>
                        </div>
                         
                        
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="IRL" required>
                                <div><img src="Images/hangout_irl.png" class="w-100"></div>
                            </label>
                        </div>
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="KLN" required>
                                <div><img src="Images/hangout_kln.png" class="w-100"></div>
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        
                        <div class="col-10 col-lg-5">
                            <label>
                                <input class="hangout-radio" type="radio" name="program" value="Petaling" required>
                                <div><img src="Images/hangout_petaling.png" class="w-100"></div>
                            </label>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div id="hangout-disclaimer" style="display:none;">
                <h5>Tentative Date: 29th May 2021</h5>
                <p>Registrations will be open 1 week before the confirmed date, which will be updated based on the best interest of our young people in terms of public safety and health.</p>
            </div>
            <div id="hangout-registration-form" style="display:none;">
                <div class="row mb-5">
                    <div class="col-3 col-lg-4">Sesi (Session)</div>
                    <div class="col-9 col-lg-8">
                        <div id="scriptureDates">
                            <div class="row mb-3">
                                <div class="col-4">Mandarin</div>
                                <div class="col-8">
                                    <?php if($mandNum<=40): ?><input type="checkbox" name="language[]" value="<?=$mand?>"> <?=$mandStr?><br><?php endif; ?> 
                                    <?php if($mandNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$mand2?>"> <?=$mandStr2?><?php endif; ?> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Bahasa Malaysia</div>
                                <div class="col-8">
                                    <?php if($bmNum<=40): ?><input type="checkbox" name="language[]" value="<?=$bm?>"> <?=$bmStr?><br><?php endif; ?> 
                                    <?php if($bmNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$bm2?>"> <?=$bmStr2?><?php endif; ?> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Tamil</div>
                                <div class="col-8">
                                    <?php if($tamilNum<=40): ?><input type="checkbox" name="language[]" value="<?=$tamil?>"> <?=$tamilStr?><br> <?php endif; ?> 
                                    <?php if($tamilNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$tamil2?>"> <?=$tamilStr2?><?php endif; ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">English</div>
                                <div class="col-8">
                                    <?php if($engNum<=40): ?><input type="checkbox" name="language[]" value="<?=$eng?>"> <?=$engStr?><br><?php endif; ?> 
                                    <?php if($engNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$eng2?>"> <?=$engStr2?><?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        
    
                        <div id="youngAdultDates" style="display:none;">
                            <div class="row mb-3">
                                <div class="col-4">Mandarin</div>
                                <div class="col-8">
                                    <?php if($yaMandNum<=40): ?><input type="checkbox" name="language[]" value="<?=$yaMand?>"> <?=$yaMandStr?><br><?php endif; ?> 
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">BM + Eng</div>
                                <div class="col-8">
                                    <?php if($yaBmEngNum<=40): ?><input type="checkbox" name="language[]" value="<?=$yaBmEng?>"> <?=$yaBmEngStr?><br><?php endif; ?> 
                                    <?php if($yaBmEngNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$yaBmEng2?>"> <?=$yaBmEngStr2?><?php endif; ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">Tamil</div>
                                <div class="col-8">
                                    <?php if($yaTamNum<=40): ?><input type="checkbox" name="language[]" value="<?=$yaTam?>"> <?=$yaTamStr?><br><?php endif; ?> 
                                    <?php if($yaTamNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$yaTam2?>"> <?=$yaTamStr2?><br><?php endif; ?> 
                                    <?php if($yaTamNum3<=40): ?><input type="checkbox" name="language[]" value="<?=$yaTam3?>"> <?=$yaTamStr3?> <?php endif; ?> 
                                </div>
                            </div>  
                        </div>
    
                        <div id="youthCampusDates" style="display:none;">
                            <div class="row">
                                <div class="col-4">BM + Eng</div>
                                <div class="col-8">
                                    <?php if($ycsNum<=40): ?><input type="checkbox" name="language[]" value="<?=$ycs?>"> <?=$ycsStr?><br><?php endif; ?> 
                                    <?php if($ycsNum2<=40): ?><input type="checkbox" name="language[]" value="<?=$ycs2?>"> <?=$ycsStr2?> <?php endif; ?>  
                                </div>
                            </div>
                            
                        </div>
    
                        <div id="gameDates" style="display:none;">
                            <div class="row">
                                <div class="col-4">Game Night</div>
                                <div class="col-8">
                                    <!--<label><input type="checkbox" name="language[]" value="<?=$gnt?>"> <?="$gntStr (Tamil)"?></label><br>-->
                                    <!--<label><input type="checkbox" name="language[]" value="<?=$taize?>"> <?=$taizeStr?></label>-->
                                    <p>TBC</p>
                                </div>
                            </div>
                        </div>
                        
                        <div id="IRLDates" style="display:none;">
                            <h4>24th April 2020</h4>
                            <ul>
                                <li>Location: Perdana Botanical Garden, KL. </li>
                                <li>What to wear: Sports attire! There will be some games and walks by the lake.</li>
                                <li>What to bring: Water bottles to keep yourself hydrated, snacks, and an umbrella for when it rains.</li>
                            </ul>
                            
                            <?php 
                                $slot="";
                                $sql2="SELECT count(*) as `number` from `hangout-irl` where `slot`=?;";
                                $stmt2=$conn->prepare($sql2);
                                $stmt2->bind_param("s",$slot);
                            ?>
                            <div class="row mb-3">
                                <div class="col-4">Mandarin</div>
                                <div class="col-8">
                                    <?php 
                                        foreach($irlMand as $slot=>$title){
                                            $stmt2->execute();
                                            $num=$stmt2->get_result()->fetch_assoc()["number"];
                                            if($num<14): 
                                    ?>
                                        <input type="radio" name="slot" value="<?=$slot?>"> <?=$title?> <?=($num>=7)?"(Waitlist)":""?><br>
                                    <?php
                                            endif;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Bahasa Malaysia</div>
                                <div class="col-8">
                                    <?php 
                                        foreach($irlBm as $slot=>$title){
                                            $stmt2->execute();
                                            $num=$stmt2->get_result()->fetch_assoc()["number"];
                                            if($num<14): 
                                    ?>
                                        <input type="radio" name="slot" value="<?=$slot?>"> <?=$title?> <?=($num>=7)?"(Waitlist)":""?><br>
                                    <?php
                                            endif;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">English</div>
                                <div class="col-8">
                                    <?php 
                                        foreach($irlEng as $slot=>$title){
                                            $stmt2->execute();
                                            $num=$stmt2->get_result()->fetch_assoc()["number"];
                                            if($num<14): 
                                    ?>
                                        <input type="radio" name="slot" value="<?=$slot?>"> <?=$title?> <?=($num>=7)?"(Waitlist)":""?><br>
                                    <?php
                                            endif;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div id="KLNDates" style="display:none;">
                            <div class="row">
                                <div class="col-4">KL North</div>
                                <div class="col-8">
                                    <label><input type="radio" name="language[]" value="<?=$kln?>@Mandarin"> Mandarin, <?=$klnStr?> </label><br>
                                    <label><input type="radio" name="language[]" value="<?=$kln?>@BM"> BM, <?=$klnStr?> </label><br>
                                    <label><input type="radio" name="language[]" value="<?=$kln?>@Tamil"> Tamil, <?=$klnStr?> </label><br>
                                    <label><input type="radio" name="language[]" value="<?=$kln?>@English"> English, <?=$klnStr?> </label><br>

            
                                </div>
                            </div>
                        </div>
                        <div id="PetalingDates" style="display:none;">
                            <div class="row">
                                <div class="col-4">Petaling District</div>
                                <div class="col-8">
                                    <label><input type="radio" name="language[]" value="<?=$petaling?>@Mandarin"> Mandarin, <?=$petalingStr?></label><br>
                                    <label><input type="radio" name="language[]" value="<?=$petaling?>@BM"> BM, <?=$petalingStr?></label><br>
                                    <label><input type="radio" name="language[]" value="<?=$petaling?>@Tamil"> Tamil, <?=$petalingStr?></label><br>
                                    <label><input type="radio" name="language[]" value="<?=$petaling?>@English"> English, <?=$petalingStr?></label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Kewarganegaraan (Nationality)</div>
                    <div class="col-8">
                        <label>
                            <input type="radio" id="radioMalaysia" name="nationality" value="Malaysia" required checked> Malaysia
                        </label><br>
                        <label>
                            <input type="radio" id="radioOthers" name="nationality" value="" required> <input type="text" id="nationalityOthers" placeholder="Other...">
                        </label>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Nama seperti dalam MyKad/Passport (Name as in MyKad/Passport)</div>
                    <div class="col-8">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Umur (Age)</div>
                    <div class="col-8">
                        <label><input type="radio" name="age" value="18 - 21" checked>18 - 21 tahun (18 - 21 years old)</label><br>
                        <label><input type="radio" name="age" value="22 - 24">22 - 24 tahun (22 - 24 years old)</label><br>
                        <label><input type="radio" name="age" value="25 - 29">25 - 29 tahun (25 - 29 years old)</label><br>
                        <label><input type="radio" name="age" value="30 - 34">30 - 34 tahun (30 - 34 years old)</label>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Jantina (Gender)</div>
                    <div class="col-8">
                        <label><input type="radio" name="gender" value="Male" required>Lelaki (Male)</label><br>
                        <label><input type="radio" name="gender" value="Female" required>Perempuan (Female)</label>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Emel (Email)</div>
                    <div class="col-8">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">No. Telefon (Phone Number)</div>
                    <div class="col-8">
                        <input type="text" name="phone" class="form-control" value="+6" required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Keuskupan (Diocese)</div>
                    <div class="col-8">
                        <select class="form-control" name="diocese" required>
                            <option value="Keuskupan Agung Kuala Lumpur">Keuskupan Agung Kuala Lumpur</option>
                            <option value="Keuskupan Pulau Pinang">Keuskupan Pulau Pinang</option>
                            <option value="Keuskupan Melaka-Johor">Keuskupan Melaka-Johor</option>
                            <option value="Keuskupan Agung Kota Kinabalu">Keuskupan Agung Kota Kinabalu</option>
                            <option value="Keuskupan Keningau">Keuskupan Keningau</option>
                            <option value="Keuskupan Sandakan">Keuskupan Sandakan</option>
                            <option value="Keuskupan Agung Kuching">Keuskupan Agung Kuching</option>
                            <option value="Keuskupan Miri">Keuskupan Miri</option>
                            <option value="Keuskupan Sibu">Keuskupan Sibu</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Paroki (Parish)</div>
                    <div class="col-8">
                        <input type="text" name="parish" id="parishOthers" class="form-control" style="display:none;" disabled>
                        <select id="parishKL" class="form-control" name="parish" required>
                            <option value="Cathedral of St John">Cathedral of St John - 5 Jalan Bukit Nanas, 50250 Kuala Lumpur</option>
                            <option value="Church of Holy Rosary">Church of Holy Rosary - 10 Jalan Tun Sambanthan, 50470 Kuala Lumpur</option>
                            <option value="Church of St Anthony">Church of St Anthony - 5 Jalan Robertson, off Jalan Pudu, 50150 Kuala Lumpur</option>
                            <option value="Chapel of Ascension of The Lord - Lot 209, Lorong Permai A, Kg Tasik Permai, 68000 Ampang">Chapel of Ascension of The Lord - Lot 209, Lorong Permai A, Kg Tasik Permai, 68000 Ampang</option>
                            <option value="Church of Our Lady of Fatima">Church of Our Lady of Fatima - Jalan Sultan Abdul Samad, 50470</option>
    
                            <option value="Church of St Joseph">Church of St Joseph - Jalan Sentul, 51000 Kuala Lumpur</option>
                            <option value="Church of the Good Shepherd">Church of the Good Shepherd - 8 Jalan Air Puteh, 53200 Setapak, Kuala Lumpur</option>
                            <option value="Church of the Risen Christ">Church of the Risen Christ - 18 Jalan Sungkai, Batu 3 3/4 off Jalan Ipoh, 51100 Kuala Lumpur</option>
                            <option value="Church of Jesus Caritas">Church of Jesus Caritas - Jalan Kepong Baru, 52100 Kepong, Kuala Lumpur</option>
                            <option value="Chapel of Kristus Aman - 58 Lorong Rahim Kajai 14, Taman Tun Dr Ismail, 60000 Kuala Lumpur">Chapel of Kristus Aman - 58 Lorong Rahim Kajai 14, Taman Tun Dr Ismail, 60000 Kuala Lumpur</option>
                            <option value="Chapel of Kristus Cahaya - Jalan 53, Desa Jaya, 51200 Kuala Lumpur">Chapel of Kristus Cahaya - Jalan 53, Desa Jaya, 51200 Kuala Lumpur</option>
                            <option value="Chapel of Christ the King - 27B, Jalan Selayang Baru, 68100 Batu Caves, Selangor">Chapel of Christ the King - 27B, Jalan Selayang Baru, 68100 Batu Caves, Selangor</option>
                            <option value="Chapel of Our Lady of Lourdes - National Leprosy Centre, off Jalan Hospital, 47000 Sg Buloh, Selangor">Chapel of Our Lady of Lourdes - National Leprosy Centre, off Jalan Hospital, 47000 Sg Buloh, Selangor</option>
    
                            <option value="Church of the Holy Family">Church of the Holy Family - 11 Jalan Gereja, 43000 Kajang</option>
                            <option value="Chapel of St Anne(UPM)">Chapel of St Anne(UPM) - Jalan Alpha, UPM, 43300 Seri Kembangan, Selangor</option>
                            <option value="Chapel of St Anne(Semenyih)">Chapel of St Anne(Semenyih) - Semenyih Estate, Jalan Broga, 43500 Semenyih, Selangor</option>
                            <option value="Church of the Sacred Heart of Jesus">Church of the Sacred Heart of Jesus - 152 Jlan Peel, 55100 Kuala Lumpur</option>
                            <option value="Chapel of Our Lady of Good Health - Lorong Satu, Kg Pandan, 55100 Kuala Lumpur">Chapel of Our Lady of Good Health - Lorong Satu, Kg Pandan, 55100 Kuala Lumpur</option>
                            <option value="Church of St Francis of Assisi">Church of St Francis of Assisi - Batu 7, Jalan Cheras, 43200 Cheras, Selangor</option>
    
                            <option value="Church of the Assumption">Church of the Assumption - 70 Jalan Templer, 46050 Petaling Jaya</option>
                            <option value="Church of St Francis Xavier">Church of St Francis Xavier - 135 Jalan Gasing, 46000 Petaling Jaya</option>
                            <option value="Church of St Ignatius">Church of St Ignatius - 2 Jalan 22 25/23, Taman Plaza, 47301 Petaling Jaya</option>
                            <option value="Church of Our Lady of Guadalupe">Church of Our Lady of Guadalupe - 8437 Jalan Industry PBP 1/2, Taman Industri, Pusat Bandar Puchong 47100 Puchong, Selangor</option>
                            <option value="Church of the Divine Mercy">Church of the Divine Mercy - 26 Jalan Pemaju U1/15, Seksyen U1, 40150 Shah Alam</option>
                            <option value="Church of St Thomas Moore">Church of St Thomas Moore - 12 Jalan TPS, Taman Perindustrian UEP, 47600 Subang Jaya, Selangor</option>
    
                            <option value="Church of Our Lady of Lourdes">Church of Our Lady of Lourdes - 114 Jalan Tengku Kelana, 4100 Klang</option>
                            <option value="Church of the Holy Redeemer">Church of the Holy Redeemer - Persiaran Raja Wali, Taman Berkeley, 41150 Klang</option>
                            <option value="Mass Centre-Kapar">Mass Centre-Kapar - 69 Jalan Tahir Manan, Kapar, Kapar, 42200 Klang</option>
                            <option value="Church of St Anne">Church of St Anne - Jalan Tengku Bedar, 42000 Port Klang</option>
                            <option value="Chapel of St Theresa - Lot 8097, Lorong Amarasegera, Pandamaran, 42000 Port Klang">Chapel of St Theresa - Lot 8097, Lorong Amarasegera, Pandamaran, 42000 Port Klang</option>
                            <option value="Church of Ss Peter & Paul">Church of Ss Peter & Paul - 140 Jalan Kekwa, Taman Seri, Telok Datok, 42700 Banting</option>
                            <option value="Chapel of St Anthony - Carey Highland, 52960 Port Klang">Chapel of St Anthony - Carey Highland, 52960 Port Klang</option>
    
                            <option value="Church of St Jude - Jalan Lim Kak, 48000 Rawang">Church of St Jude - Jalan Lim Kak, 48000 Rawang</option>
                            <option value="Chapel of St Michael - Jalan Banglo, 48100 Batu Arang">Chapel of St Michael - Jalan Banglo, 48100 Batu Arang</option>
                            <option value="Chapel of St Joseph - Sg Choh, Serendah, 48000 Rawang">Chapel of St Joseph - Sg Choh, Serendah, 48000 Rawang</option>
                            <option value="Church of Our Lady of Mount Carmel - No 5 jalan Gereja, Tanah Rata, 39000 Cameron Highlands">Church of Our Lady of Mount Carmel - No 5 jalan Gereja, Tanah Rata, 39000 Cameron Highlands</option>
                            <option value="Church of St Paul the Apostle">Church of St Paul the Apostle - Jalan Rasathurai, Kuala Kubu Baru, 44000 Ulu Selangor</option>
                            <option value="Church of St Paul the Hermit">Church of St Paul the Hermit - Jalan Sekolah, 45600 Bestari Jaya</option>
                            <option value="Chapel of St Anthony - Coalfield Estate">Chapel of St Anthony - Coalfield Estate</option>
                            <option value="Chapel of Our Lady of Good Health - Asam Jawa">Chapel of Our Lady of Good Health - Asam Jawa</option>
                            <option value="Chapel of Infant Jesus - Jalan Tanjung Keramat, Kuala Selangor">Chapel of Infant Jesus - Jalan Tanjung Keramat, Kuala Selangor</option>
                            <option value="Chapel of St Anthony - Minyak Estate, 45600 Bestari Jaya">Chapel of St Anthony - Minyak Estate, 45600 Bestari Jaya</option>
                            <option value="Chapel of St Anthony - Tennamaram Estate, Bestari Jaya, Selangor">Chapel of St Anthony - Tennamaram Estate, Bestari Jaya, Selangor</option>
                            <option value="Chapel of St Anthony - St Andrew Estate, Selangor">Chapel of St Anthony - St Andrew Estate, Selangor</option>
                            <option value="Chapel of St Joseph - Nigel Garden Estate, Selangor">Chapel of St Joseph - Nigel Garden Estate, Selangor</option>
                            <option value="Chapel of St Paul the hermit - Sg Buloh Estate, Selangor">Chapel of St Paul the hermit - Sg Buloh Estate, Selangor</option>
                            <option value="Chapel of Our Lady of Good Health - Bukit Panjang Estate, Selangor">Chapel of Our Lady of Good Health - Bukit Panjang Estate, Selangor</option>
                            <option value="Chapel of Holy Spirit - Bukit Cheraka Estate, Selangor">Chapel of Holy Spirit - Bukit Cheraka Estate, Selangor</option>
    
                            <option>Church of Visitation - Jalan Yam Tuan, Seremban</option>
                            <option>Church of St Theresa - Jalan Besar, Nilai</option>
                            <option>Church of St Aloysius - Main Road, Mantin</option>
                            <option>Church of the Immaculate Conception BVM - Jalan Seremban, Port Dickson</option>
                            <option>Chapel of Infant Jesus - Sungai Pelek, Selangor</option>
                            <option>Chapel of Holy Family - Tampin Linggi</option>
                            <option>Chapel of St Anthony - Bukit Pelanduk</option>
                            <option>Church of St John Vianney - Jalan Seremban, Tampin</option>
                            <option>Chapel of St Christopher - Gemas</option>
                            <option>Chapel of St Joseph - Jalan Bukit, Kuala Pilah</option>
                            <option>Chapel of Mary, Mother of God - Bahau</option>
    
                            <option>Church of Sacred Heart - Bentong</option>
                            <option>Church of the Annunciation - Jalan Cheroh Lama, Raub</option>
                            <option>Chapel of St Francis Xavier - Jalan Tok Kaya Sentol, Kuala Lipis</option>
                            <option>Church of Our Lady of Perpetual Help - Jalan Tanjong Kerayong, Mentakab</option>
                            <option>Chapel of St John - Jalan Kampung Baru, Triang</option>
                            <option>Church of Our Lady of Mount Carmel - Jalan Gereja, Tanah Rata</option>
                            <option>Church of St Thomas - Jalan Gambut, Kuantan</option>
                            <option>Chapel of St Theresa - Jalan Gambang, Kuantan</option>
                            <option>Catholic Mission - Jalan Sultan Omar, Kuala Terengganu</option>
                            <option>Dungun Catholic Community - Jalan Besar, Dungun</option>
                            <option>St Philip Minh Catholic Community - Jalan Kubang Kurus, Kemaman</option>
                        
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6"><button class="btn btn-success w-100" type="submit" name="submit">Hantar (Submit)</button></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    jQuery(function($) {

        var _oldShow = $.fn.show;

        $.fn.show = function(speed, oldCallback) {
        return $(this).each(function() {
            var obj         = $(this),
                newCallback = function() {
                if ($.isFunction(oldCallback)) {
                    oldCallback.apply(obj);
                }
                obj.trigger('afterShow');
                };

            // you can trigger a before show if you want
            obj.trigger('beforeShow');

            // now use the old function to show the element passing the new callback
            _oldShow.apply(obj, [speed, newCallback]);
        });
        }
    });
    $(".hangout-radio").on("click",function(){
        if($(this).val()=="IRL"){
            var offset="#hangout-disclaimer";
        }else{
            var offset="#hangout-registration-form";
        }
        if($("#hangout-registration-form:visible").length > 0){
            scrollTo(offset);
        }else{
            $("#hangout-registration-form").one("afterShow",function(){
                if($(".hangout-radio:checked").val()=="IRL"){
                    var offset="#hangout-disclaimer";
                }else{
                    var offset="#hangout-registration-form";
                }
                scrollTo(offset);
            });
        }
        
        
        

        if($(this).val()=="IRL"){
            $("#hangout-registration-form").hide("slow");
            $("#hangout-disclaimer").show("slow");
            return;
        }
        $("#hangout-disclaimer").hide("slow");
        $("#hangout-registration-form").show("slow");
    });
    
</script>

<?php if(isset($_POST["submit"])):?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Thank you for registering!<br>Join us again next week! </p>
                <br>
                <p class="text-center">Please check your email for further instructions.</p>
            </div>
            
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#exampleModalCenter").modal("show");
        });
    </script>
<?php endif; ?>


<?php
    include 'templates/footer.html';
?>