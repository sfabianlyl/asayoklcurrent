<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $panel=false;
    include 'templates/header.php';
    date_default_timezone_set ("Asia/Kuala_Lumpur");
?>

<?php 
    $sessionDates=[
        "KL"=>[
            "Study Day (Online) - Tuesdays, 8.30pm"=>[
                "12th January 2021",
                "9th March 2021",
                "11th May 2021",
                "13th July 2021",
                "14th September 2021",
                "9th November 2021"
            ],
            "Prayer Day (Online) - Tuesdays, 8.30pm"=>[
                "9th February 2021",
                "15th June 2021",
                "12th October 2021"
            ],
            "Family Day - Saturdays, 12.00pm"=>[
                "17th April 2021",
                "14th August 2021",
                "4th December 2021"
            ]
        ],
        
    ];

    $nextSessions=[
        "KL"=>"Jan 2022"
    ]

?>

<?php
    if(isset($_POST["submit"])){
        
        

        //google sheets connection:
        $client = new \Google_Client();
        $client->setApplicationName('My PHP App');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig('../cdac4de75d4e/asayokldb-cdac4de75d4e.json');
        $sheets = new \Google_Service_Sheets($client);
        
        
        $location=$_POST["location"];
        $nationality=$_POST["nationality"];
        $name=$_POST["name"];
        $age=$_POST["age"];
        $gender=$_POST["gender"];
        $email=$_POST["email"];
        $parishes=$_POST["parishes"];
        $talents=$_POST["talents"];
        $phone=$_POST["phone"];

        // $sessions=$_POST["session"];
        switch($location){
            case "KL": $spreadsheetId ='1g0bAIEOQjh-3WYV0Dud_lDgEkJyQKL1-ADJ2yKHagGE'; break;
            case "Tamil": $spreadsheetId='1nb-kxh2NR5q73aRG3w6ZNZowHpsHreYB9N7f3qemQnI'; break;
        }
        
        $range = "Registration!A1:K";

        $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
        $count=count($rows['values']);
        $data=[];
        $data[]=$count;
        $data[]=$location;
        $data[]=$name;
        $data[]=$age;
        $data[]=$gender;
        $data[]=$nationality;
        $data[]=$email;
        $data[]=$phone;
        $data[]=$parishes;
        $data[]=$talents;
        $data[]=date("jS F Y, g:i a");
        
        $values=array($data);
    
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);


        

        $subject="Catholic Young Adult Network ASAYOKL"; 
        $message="<h1>Thank You for Registering!</h1>";
        $message.="<p>Terima kasih atas pendaftaran anda. Kami akan menghubungi anda melalui e-mel atau telefon (Whatsapp).";
        $message.="<br>[Thank you for your registration. We will contact you via email or phone (Whatsapp).]</p>";
       
        $message.="<br><p><b>Network: $location</b></p>";
        
        $message.="<p><b>Nama (Name): </b>$name</p>";
        $message.="<p><b>Tahun Lahir (Year of Birth): </b>$age</p>";
        $message.="<p><b>Jantina (Gender): </b>$gender</p>";
        $message.="<p><b>Kewarganegaraan (Nationality): </b>$nationality</p>";
        $message.="<p><b>No. Telefon (Mobile No.): </b>$phone</p>";
        $message.="<p><b>E-mel (Email): </b>$email</p>";
        
        $message.="<p>In the meantime, do join our <a href='https://t.me/asayoklcyan' target='_blank'>Telegram Channel</a> to receive updates on our monthly gatherings.</p>";
        
        $message.="<p>Thank you</p>";
        $message.="<p><b><i><font color='red'>This is a no reply email. Please do not reply to this email.</font></i></b></p>";

        $header="MIME-Version: 1.0" . "\r\n";
        $header.="Content-type: multipart/related; boundary='emailsectionseparator'; type='text/html'" . "\r\n";
        $header.="From: {noreply@catholicyouth.my}";

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            $mail->SMTPDebug = 1;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.catholicyouth.my';                  // Specify main and backup SMTP servers
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
    
?>


<div class="mb-5">
    <h3 class="text-center">Catholic Young Adult Network</h3>
    <p class="text-center"><i>Join us according to your location convenience.</i></p>
</div>


<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <form action="" method="POST" id="myform">
            <div class="row mb-5 align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-5 text-center">
                            <label for="KL">
                                <input class="hangout-radio" type="radio" id="KL" name="location" value="KL" required checked>
                                <div><img src="Images/ArchKL OYP_YANKL.png" class="w-100"></div>
                            </label>
                        </div>
                        <!--<div class="col-5 text-center">-->
                        <!--    <label for="Tamil">-->
                        <!--        <input class="hangout-radio" type="radio" id="Tamil" name="location" value="Tamil">-->
                        <!--        <div><img src="Images/ArchKL OYP_YANTS.png" class="w-100"></div>-->
                        <!--    </label>-->
                        <!--</div>-->
                        <div class="col-5 text-center">
                            <h4>Coming Soon...</h4>
                        </div> 
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-5 text-center">
                            <h4>Coming Soon...</h4>
                        </div>
                        <div class="col-5 text-center">
                            <h4>Coming Soon...</h4>
                        </div> 
                    </div>
                    
                </div>
            </div>
            
            <div class="row mb-5 align-items-center">
                <div class="col-12">
                    <p>Tentatively planned sessions:</p>
                    <?php foreach($nextSessions as $network=>$month): ?>
                        <div id="<?=$network."Dates"?>" class="program-dates">
                            <h5>Next Session: <?=$month?></h5>
                        </div>
                    <?php endforeach;?>    
                    <!-- <?php foreach($sessionDates as $network=>$details): ?>
                        <div id="<?=$network."Dates"?>" class="program-dates">
                            <?php foreach($details as $type=>$dates):?>
                                <h6><?=$type?></h6>
                                    <ol>
                                        <?php foreach($dates as $date):?> <li><?=$date?></li> <?php endforeach; ?>
                                    </ol>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach;?>     -->
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
                <div class="col-4">Tahun Lahir (Year of Birth)</div>
                <div class="col-8">
                    <label><input type="text" class="form-control" name="age" ></label>
                    
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
                <div class="col-4">Top 3 Frequent Parishes For Mass</div>
                <div class="col-8">
                    <input type="text" name="parishes" class="form-control" placeholder="Put in at least 1 parish, seperate by comma." required>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-4">Tell us something interesting about yourself</div>
                <div class="col-8">
                    <input type="text" name="talents" class="form-control" placeholder="" required>
                </div>
            </div>

            
            
            <div class="row mb-5">
                <small><i>This is a One Time Registration. Subsequent activities will be notified via email. <br>One time registration is valid for the year of registration only.</i></small>
            </div>
            <div class="row justify-content-center">
                <div class="col-6"><button class="btn btn-success w-100" type="submit" name="submit">Hantar (Submit)</button></div>
            </div>
        </form>
    </div>
</div>

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
                <p class="text-center">Thank you for registering!<br>We will contact you as soon as possible. </p>
                <br>
                <p class="text-center">Please check your email for a summary of your registration.</p>
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