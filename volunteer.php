<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $panel=false;
    include 'templates/header.php';
    date_default_timezone_set ("Asia/Kuala_Lumpur");
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
        $spreadsheetId ='1giuSKFQ2kDL5bX1gu05H1_zyPpvyYNmKocnTz3w6uGo';

        if(isset($_POST["roles"])){
            $range = "Non-medical Roles!A1:M";
            $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
            $count=count($rows['values']);
            $data=[];
            $data[]=$count;
            $data[]=$_POST["nationality"];
            $data[]=$_POST["name"];
            $data[]=$_POST["age"];
            $data[]=$_POST["gender"];
            $data[]=$_POST["city"];
            $data[]=$_POST["vaccination"];
            $data[]=$_POST["email"];
            $data[]="+6".$_POST["phone"];
            $data[]=implode(", ",$_POST["roles"]);
            // if(isset($_POST["days"])) $data[]=implode(", ",$_POST["days"]);
            // else $data[]="";
            // if(isset($_POST["shifts"])) $data[]=implode(", ",$_POST["shifts"]);
            // else $data[]="";
            $data[]=$_POST["study"];
            $data[]=date("jS F Y, g:i a");

            $values=array($data);
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
        }

        if(isset($_POST["roles_medical"])){
            $range = "Medical Roles!A1:M";
            $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
            $count=count($rows['values']);
            $data=[];
            $data[]=$count;
            $data[]=$_POST["nationality"];
            $data[]=$_POST["name"];
            $data[]=$_POST["age"];
            $data[]=$_POST["gender"];
            $data[]=$_POST["city"];
            $data[]=$_POST["vaccination"];
            $data[]=$_POST["email"];
            $data[]="+6".$_POST["phone"];
            $data[]=$_POST["medical"];
            // if(isset($_POST["days"])) $data[]=implode(", ",$_POST["days"]);
            // else $data[]="";
            // if(isset($_POST["shifts"])) $data[]=implode(", ",$_POST["shifts"]);
            // else $data[]="";
            $data[]=$_POST["study"];
            
            $data[]=date("jS F Y, g:i a");
            $values=array($data);
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
        }
        
        $subject="Thank You for Registering!"; 
        $message=file_get_contents("templates/email/volunteer.html");
        $message=str_replace("==name==",$_POST["name"],$message);
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
            $mail->addAddress($_POST["email"]);

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();
        } 
        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        
        $subject="PKRCS Begins... (Update Email on 2nd August)"; 
        $message=file_get_contents("templates/email/volunteer-update.html");
        $message=str_replace("==name==",$_POST["name"],$message);
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
            $mail->addAddress($_POST["email"]);

            $mail->addAttachment("documents/JoinFight-FAQ.pdf");

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
    <h3 class="text-center">Join the Fight against COVID-19!</h3>
    <p class="text-center">Volunteer Registration</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <div class="row justify-content-center mb-5">
            <div class="col-3">
                <a href="Images/VolFight1.png" target="_blank">
                    <img src="Images/VolFight1.png" class="w-100">
                </a>
            </div>
            <div class="col-3">
                <a href="Images/VolFight2.png" target="_blank">
                    <img src="Images/VolFight2.png" class="w-100">
                </a>
                
            </div>
            <div class="col-3">
                <a href="Images/VolFight3.png" target="_blank">
                    <img src="Images/VolFight3.png" class="w-100">
                </a>
            </div>
            <div class="col-3">
                <a href="Images/VolFight4.png" target="_blank">
                    <img src="Images/VolFight4.png" class="w-100">
                </a>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-lg-6 mb-3">
                <a href="documents/Crest Initiative.pdf" target="_blank">
                    <div class="d-flex w-100 justify-content-center align-items-center py-3 shadow rounded">
                        <div class="col-4">
                            <img src="Images/Google Photos.png" class="w-100"/>
                        </div>
                        <div class="col-7">
                            <span style="text-decoration: none !important; color:white;">Letter from ArchKL</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <a href="documents/E-posters.pdf" target="_blank">
                    <div class="d-flex w-100 justify-content-center align-items-center py-3 shadow rounded">
                        <div class="col-4">
                            <img src="Images/Google Photos.png" class="w-100"/>
                        </div>
                        <div class="col-7">
                            <span style="text-decoration: none !important; color:white;">E-Posters</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <a href="documents/JoinFight-FAQ.pdf" target="_blank">
                    <div class="d-flex w-100 justify-content-center align-items-center py-3 shadow rounded">
                        <div class="col-4">
                            <img src="Images/Google Photos.png" class="w-100"/>
                        </div>
                        <div class="col-7">
                            <span style="text-decoration: none !important; color:white;">Frequently Asked Questions (FAQ)</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>





<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <form action="" method="POST">
            <h3 class="mb-3" style="text-decoration:underline;">Personal Details</h3>
            <div class="pl-3">
                
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Nationality</h4></div>
                    <div class="col-12">
                        <label>
                            <input type="radio" id="radioMalaysia" name="nationality" value="Malaysia" required checked> Malaysia
                        </label><br>
                        <label>
                            <input type="radio" id="radioOthers" name="nationality" value="" required> <input type="text" id="nationalityOthers" placeholder="Other...">
                        </label>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Full Name</h4></div>
                    <div class="col-12">
                        <input type="text" name="name" class="form-control" placeholder="Please insert full name as in IC" required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Age</h4></div>
                    <div class="col-12">
                        <input type="number" class="form-control" name="age" min="18" max="50" placeholder="Partipants must be between 18 to 50 years of age." required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Gender</h4></div>
                    <div class="col-12">
                        <label><input type="radio" name="gender" value="Male" required>Lelaki (Male)</label><br>
                        <label><input type="radio" name="gender" value="Female" required>Perempuan (Female)</label>
                    </div>
                </div>

                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4 class="mb-0">Current city/town I am living in</h4><i>We are looking for volunteers living in Klang Valley area.</i></div>
                    <div class="col-12">
                        <input type="text" class="form-control" name="city" required>
                    </div>
                </div>
                
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Email</h4></div>
                    <div class="col-12">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>Phone Number</h4></div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <span class="px-3">+6</span>
                            <div style="flex:1;">
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12"><h4>I have:</h4></div>
                    <div class="col-12">
                        <select name="vaccination" class="form-control" required>
                            <option>Not been vaccinated yet</option>
                            <option>Received first dose of vaccination</option>
                            <option>Received both doses of vaccination (Fully vaccinated)</option>
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="mb-3" style="text-decoration:underline;">Volunteering Details</h3>
            <div class="pl-3">
                <div class="row mb-5">
                    <div class="col-12 mb-5">
                        <h4 class="mb-0">I am interested in the following roles</h4>
                        <span>
                            <i>You may select more than 1 roles, up to 3. (Only first 3 roles will be recorded)</i>
                        </span>
                    </div>
                    <div class="col-12 pl-4">
                        <h5><strong>Medical Roles</strong></h5>
                        <div class="pl-3 mb-5">
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles_medical" value="Medical"> 
                                    <div>
                                        Trained and Licensed Medical Personnel
                                        <ul>
                                            <li>Medical Doctors.</li>
                                            <li>Clinical Administrator.</li>
                                            <li>Nursing & Paramedic.</li>
                                            <li>Patient Management.</li>
                                            <li>Other Clinical Services.</li>
                                            <li><input type="text" class="form-control" name="medical" placeholder="Please state your profession."></li>
                                        </ul>
                                        
                                    </div>
                                    
                                </label>
                            </div>
                        </div>

                        <h5><strong>Non-medical Roles</strong></h5>
                        <p>
                            The following roles will be required to work onsite and will be in direct contact with the quarantined guests. You will be required to be in full Personal Protective Equipment (PPE), which will be provided together with training on how to put them on. Throughout your shift, you are not allowed to leave the building before being decontaminated. Other trainings will be given where applicable/needed.
                        </p>
                        <div class="pl-3 mb-5">
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Reception"> 
                                    <div>
                                        Reception 
                                        <ul>
                                            <li>Will be responsible on the total number of check-ins and check-outs.</li>
                                            <li>Will be communicating with guests to decide admission or not based on certain criterias.</li>
                                            <li>Will be communicating with COVID Assesment Centre (CAC) KL.</li>
                                            <li>Added advantage for multi-lingual volunteers.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Food & Beverage"> 
                                    <div>
                                        Food & Beverage 
                                        <ul>
                                            <li>Will be responsible on liaising with reception on the amount of food to be ordered from catarer.</li>
                                            <li>Will be collecting food from caterer from a safe-zone near the building.</li>
                                            <li>Will be distributing and delivering food to each room.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Cleaning & Sanitization"> 
                                    <div>
                                        Cleaning & Sanitization
                                        <ul>
                                            <li>Will be cleaning and sanitizing rooms after guests have checked out.</li>
                                            <li>Will only handle non-clinical wastes.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Building Maintenance"> 
                                    <div>
                                        Building Maintenance
                                        <ul>
                                            <li>Will be maintaining basic plumbing and electrical defects of the entire building.</li>
                                            <li>Will be working with employed maintenance team.</li>
                                            <li>Will be monitoring guests on security cameras to ensure guests are not wandering.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Ambulance Driver"> 
                                    <div>
                                        Ambulance Driver
                                        <ul>
                                            <li>Will be on standby at the hotel to transfer patients to and fro hospital if needed.</li>
                                        </ul>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <p>
                            The following roles will be required to work onsite when necessary, and will not be in direct contact with guests. You will be required to be in full PPE when on site, and will not be allowed to leave the building before decontaminated.
                        </p>
                        <div class="pl-3">
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Inventory"> 
                                    <div>
                                        Inventory 
                                        <ul>
                                            <li>Will be responsible to record and keep track of non-clinical resources in the building.</li>
                                            <li>Will be responsible for re-stocking resources when needed.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="Transport"> 
                                    <div>
                                        Transport
                                        <ul>
                                            <li>Will be handling transport of non-guest related logistics.</li>
                                            <li>Volunteers are required to use personal vehicles.</li>
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="roles[]" value="IT & Comms"> 
                                    <div>
                                        IT & Communication
                                        <ul>
                                            <li>Will be maintaining general IT infrastructure of the building (WiFi, laptops and PCs, RF card system, database and software).</li>
                                            
                                        </ul>
                                    </div>
                                    
                                </label>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- <div class="row mb-5">
                    <div class="col-12"><h4>Availability: Days</h4></div>
                    <div class="col-12">
                        <div class="pl-3">
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Monday"> 
                                    <div>
                                        Monday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Tuesday"> 
                                    <div>
                                        Tuesday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Wednesday"> 
                                    <div>
                                        Wednesday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Thursday"> 
                                    <div>
                                        Thursday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Friday"> 
                                    <div>
                                        Friday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Saturday"> 
                                    <div>
                                        Saturday
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="days[]" value="Sunday"> 
                                    <div>
                                        Sunday
                                    </div>
                                    
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12"><h4>Availability: Shifts</h4></div>
                    <div class="col-12">
                        <div class="pl-3">
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="shifts[]" value="A.M."> 
                                    <div>
                                        A.M. shift
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="shifts[]" value="P.M> "> 
                                    <div>
                                        P.M. shift
                                    </div>
                                    
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex w-100">
                                    <input type="checkbox" class="form-check-input" name="shifts[]" value="overnight"> 
                                    <div>
                                        Overnight
                                    </div>
                                    
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                <div class="row mb-5 align-items-center">
                    <div class="col-12">
                        To qualify for volunteering in a COVID related cause, you are required to enroll in a free-of-charge COVID-19 Response Training course.<br>
                        Are you interested to participate in a group study with ASAYOKL, which will be conducted on Friday nights while going through this course?              
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="study" value="Yes" id="study-yes" required>
                            <label class="form-check-label" for="study-yes">Yes, I'm interested!</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="study" value="No" id="study-no" required>
                            <label class="form-check-label" for="study-no">No, I'm not interested.</label>
                        </div>
                    </div>
                </div>
                
            </div>
            <div>
                <div class="row mb-5 align-items-center">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="understand" id="checkbox-understand" required>
                            <label class="form-check-label" for="checkbox-understand">
                                By submitting this form, I understand that I am expressing my interest to undergo Online COVID-19 Training Course in order to volunteer in the fight against COVID-19.<br>
                                I also understand that I may not be selected due to reasons up to the discretion of the organisers of COVID-19 related cause.
                            </label>
                        </div>
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
                <p class="text-center">Thank you for registering with us!</p>
                <br>
                <p class="text-center">We will be in touch with you soon.</p>
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