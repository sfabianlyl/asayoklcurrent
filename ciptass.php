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
        "Terengganu"=>[
            "17th June 2021 @ 8.00pm",
        ],
        "Cheras"=>[
            "9th October 2021 @ 8.30pm",
        ],
    ];

    $tentative=[
        "Terengganu"=>"September"
    ];

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
        $phone=$_POST["phone"];
        $homeState=$_POST["homeState"];
        $uniState=$_POST["uniState"];
        $uniName=$_POST["uniName"];
        $course=$_POST["course"];

        // $sessions=$_POST["session"];
        switch($location){
            case "Terengganu": $spreadsheetId ='12M31szNdtaF5HlWbq55ShMPvboc311p8lNwARtzpTHE'; break;
            case "Cheras": $spreadsheetId ='1wilFbTxNNuPPxvMxRGyDT1Xl0QY5bBR8td2Lkjp7xh0'; break;
        }
        
        $range = "Registration!A1:K";

        $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
        $count=count($rows['values']);
        $data=[];
        $data[]=$count;
        $data[]=$nationality;
        $data[]=$name;
        $data[]=$age;
        $data[]=$gender;
        $data[]=$phone;
        $data[]=$email;
        $data[]=$homeState;
        $data[]=$uniState;
        $data[]=$uniName;
        $data[]=$course;
        $data[]=date("jS F Y, g:i a");
        
        $values=array($data);
    
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);


        

        $subject="CIPTASS ASAYOKL"; 
        $message="<h1>Thank You for Registering!</h1>";
        $message.="<p>Terima Kasih atas pendaftaran anda.  anda akan diberitahu melalui e-mel atau WhatsApp mengenai Aktiviti dan perjumpaan Pelajar IPTA / IPTS Katolik yang dihoskan ASAYOKL (ArchKL).</p>";
        $message.="<p>Jika anda memerlukan bantuan iringan pastoral yang lain, jangan ragu-ragu untuk menghubungi nama-nama di bawah.</p>";
        $message.="<p><i>Thank you for registering. you will be notified  via email or WhatsApp about Catholic IPTA/IPTS Students Activities and gatherings hosted ASAYOKL (ArchKL).</i></p>";
        $message.="<p><i>If you are in need of any other pastoral accompaniment assistance please do not hesitate to contact the names below.</i></p>";
        
        $message.="<h4>ASAYOKL (Archdiocese of Kuala Lumpur)</h4>";
        $message.="<p>Selangor<br>Fabian Lee<br><a href='mailto:fabian@asayokl.org'>fabian@asayokl.org</a></p>";
        $message.="<p>Pahang<br>Gregory Pravin Rajah<br><a href='mailto:gregpravin@asayokl.org'>gregpravin@asayokl.org</a></p>";
        $message.="<p>Negeri Sembilan<br>Fabian Lee<br><a href='mailto:fabian@asayokl.org'>fabian@asayokl.org</a></p>";
        $message.="<p>Wilayah Persekutuan Kuala Lumpur<br>Gregory Pravin Rajah<br><a href='mailto:gregpravin@asayokl.org'>gregpravin@asayokl.org</a></p>";
        $message.="<p>Terengganu<br>Fabian Lee<br><a href='mailto:fabian@asayokl.org'>fabian@asayokl.org</a></p>";

        $message.="<h4>PDYN (Diocese of Penang)</h4>";
        $message.="<p>Perlis<br>Kedah<br>Kelantan<br>Pulau Pinang<br>Perak</p>";
        $message.="<p>Jason Tioh<br><a href='mailto:jasontioh@gmail.com'>jasontioh@gmail.com</a><br>+6010-5364138</p>";

        $message.="<h4>MJDYPN (Diocese of Melaka-Johor)</h4>";
        $message.="<p>Melaka<br>Karen Chan<br><a href='mailto:karenchan@mjdiocese.my'>karenchan@mjdiocese.my</a></p>";
        $message.="<p>Johor<br>Aloysius Irenaeus<br><a href='mailto:aloysius@mjdiocese.my'>aloysius@mjdiocese.my</a></p>";
        
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


<div class="d-flex justify-content-center">
    <div class="col-8 col-lg-6">
        <img src="Images/CIPTASS.png" alt="" class="w-100">
    </div>
    
</div>


<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <form action="" method="POST" id="myform">
            <div class="row mb-5 align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-5 text-center">
                            <label for="Terengganu">
                                <input class="ciptass-radio" type="radio" id="Terengganu" name="location" value="Terengganu" checked>
                                <div><img src="Images/CIPTASS_Terengganu.png" class="w-100"></div>
                            </label>
                        </div>
                        <div class="col-5 text-center">
                            <label for="Cheras">
                                <input class="ciptass-radio" type="radio" id="Cheras" name="location" value="Cheras">
                                <div><img src="Images/CIPTASS_Cheras.png" class="w-100"></div>
                            </label>
                        </div>
                    </div>
                    <!--<div class="row justify-content-center">-->
                    <!--    <div class="col-5 text-center">-->
                    <!--        <h4>Coming Soon...</h4>-->
                    <!--    </div>-->
                    <!--    <div class="col-5 text-center">-->
                    <!--        <h4>Coming Soon...</h4>-->
                    <!--    </div> -->
                    <!--</div>-->
                    
                </div>
            </div>

            <div id="ciptass-disclaimer" style="display:none;">
                <h5>
                    Next Session: 
                    <?php foreach($tentative as $state=>$month):?>
                        <span id="<?=$state."Tentative"?>" class="ciptass-tentatives" style="display:none;"><?=$month?></span>
                    <?php endforeach; ?>
                </h5>
                <p>Registration will open 2 weeks before confirmed date.</p>
            </div>

            <div id="ciptass-registration" style="display:none;">
                <div class="row mb-5 align-items-center">
                    
                    <div class="col-12">
                        <p>Tentatively planned sessions:</p>
                        <?php foreach($sessionDates as $state=>$dates): ?>
                            <div id="<?=$state."Dates"?>" class="ciptass-dates" style="display:none;">
                                <ol>
                                    <?php foreach($dates as $date):?> <li><?=$date?></li> <?php endforeach; ?>
                                </ol>
                            </div>
                        <?php endforeach;?>    
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
                    <div class="col-4">Home state (Negeri asal)</div>
                    <div class="col-8">
                        <select class="form-control" name="homeState">
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Labuan">Wilayah Persekutuan Labuan</option>
                            <option value="Putrajaya">Wilayah Persekutuan Putrajaya</option>
                        </select>
                        
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">State of your University (Negeri universiti anda)</div>
                    <div class="col-8">
                        <select class="form-control" name="uniState" id="uniState">
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Labuan">Wilayah Persekutuan Labuan</option>
                            <option value="Putrajaya">Wilayah Persekutuan Putrajaya</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Name of University (Nama universiti)</div>
                    <div class="col-8">
                        <div id="TerengganuUni" class="universities">
                            <label for="umtRadio">
                                <input type="radio" name="uniName" id="umtRadio" value="University Malaysia Terengganu"> University Malaysia Terengganu
                            </label><br>
                            <label for="uniszaRadio">
                                <input type="radio" name="uniName" id="uniszaRadio" value="University Sultan Zainal Abidin"> University Sultan Zainal Abidin
                            </label><br>
                            <label for="ipgdriRadio">
                                <input type="radio" name="uniName" id="ipgdriRadio" value="Institut Pendidikan Guru Kampus Dato' Razali Ismail"> Institut Pendidikan Guru Kampus Dato' Razali Ismail
                            </label><br>
                            <label for="ucsiRadio">
                                <input type="radio" name="uniName" id="ucsiRadio" value="University College Sedaya International"> University College Sedaya International
                            </label><br>
                            <label for="uitmRadio">
                                <input type="radio" name="uniName" id="uitmRadio" value="Universiti Teknologi MARA Kampus Dungun"> Universiti Teknologi MARA Kampus Dungun
                            </label>
                        </div>
                        <div id="KelantanUni" class="universities">
                            <label for="usmhcRadio">
                                <input type="radio" name="uniName" id="usmhcRadio" value="University Sains Malaysia (USM) Health Campus"> University Sains Malaysia (USM) Health Campus
                            </label><br>
                            <label for="umkRadio">
                                <input type="radio" name="uniName" id="umkRadio" value="University Malaysia Kelantan"> University Malaysia Kelantan
                            </label><br>
                            <label for="ipgkbRadio">
                                <input type="radio" name="uniName" id="ipgkbRadio" value="Institut Pendidikan Guru Kampus Kota Bharu"> Institut Pendidikan Guru Kampus Kota Bharu
                            </label><br>
                            <label for="ipgsmRadio">
                                <input type="radio" name="uniName" id="ipgsmRadio" value="Institut Pendidikan Guru Kampus Sultan Mizan"> Institut Pendidikan Guru Kampus Sultan Mizan
                            </label><br>
                            <label for="lucRadio">
                                <input type="radio" name="uniName" id="lucRadio" value="Lincoln University College"> Lincoln University College
                            </label>
                            <label for="uitmkRadio">
                                <input type="radio" name="uniName" id="uitmkRadio" value="MARA University of Technology Kelantan"> MARA University of Technology Kelantan
                            </label>
                        </div>
                        
                        <label for="othersRadio">
                            <input type="radio" name="uniName" id="othersRadio" value=""> Others: <input type="text" id="uniOthers">
                        </label>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">I will be...</div>
                    <div class="col-8">
                        <label><input type="radio" name="course" value="Going back to uni" required>Going back to uni</label><br>
                        <label><input type="radio" name="course" value="Continuing with online class" required>Continuing with online class</label><br>
                        <label><input type="radio" name="course" value="Going back to uni, continuing with online class" required>Both</label>
                    </div>
                </div>
                <script>
                    $("#uniOthers").on("change keydown", function(){
                        $("#othersRadio").val($(this).val());
                    });
                    $("#uniOthers").on("focus", function(){
                        $("#othersRadio").trigger("click");
                    });
                    $("#uniState").on("change",function(){
                        $(".universities").hide("slow");
                        var uni=$(this).val()+"Uni";
                        $("#"+uni).show("slow");
                    });
                    $("#uniState").trigger("change");
                    
                    $(".ciptass-radio").on("change",function(){
                        $(".ciptass-dates").hide("slow");
                        var loc=$(this).val();
                        console.log(loc);
                        $("#"+loc+"Dates").show("slow");
                    }).trigger("change");
                    
                </script>
                
                <div class="row mb-5">
                    <small><i>This is a One Time Registration. Subsequent activities will be notified via email. <br>One time registration is valid for the year of registration only.</i></small>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6"><button class="btn btn-success w-100" type="submit" name="submit">Hantar (Submit)</button></div>
                </div>
            </div>
            <script>
                var disclaim=[
                    "Terengganu"
                ];
                $(".ciptass-radio").on("click",function(){
                    if(disclaim.includes($(this).val())){
                        $("#ciptass-disclaimer").show("slow");
                        $("#ciptass-registration").hide("slow");
                        $(".ciptass-tentatives").hide();
                        $("#"+$(this).val()+"Tentative").show();
                        return;
                    }

                    $("#ciptass-disclaimer").hide("slow");
                    $("#ciptass-registration").show("slow");
                        
                });
            </script>
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