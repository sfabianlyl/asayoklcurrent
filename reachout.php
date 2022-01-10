<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    // $image="rog.png";
    $panel=false;
    $image="rog_square.png";
    // $imagefull=true;

    $text="Hey ASAYO! I'm interested to apply for ROG.";
    $textenc=urlencode($text);
    $subject="ROG Registration";

    include "include/rog_functions.php";
    $past=$conn->query("SELECT * from $table where group_category='Past';");
    $present=$conn->query("SELECT * from $table where group_category='Present';");

    if(isset($_COOKIE["status"])){
        $status=$_COOKIE["status"];
        setcookie("status","",time()-86400,"/");
    }

    if(isset($_POST["formName"])){
        if($_POST["formName"]=="reachoutReg"){
            $nationality=$_POST["nationality"];
            $name=$_POST["name"];
            $ic=$_POST["ic"];
            $email=$_POST["email"];
            $comment=$_POST["comment"];
            $phone=$_POST["phone"];
            $socmed=$_POST["socmed"];
            
            $subject="Reach Out Grant"; 
            $message="<p>Thank you for registering with us!</p><br>";
            $message.="<p><b>Nationality: </b>$nationality</p>";
            $message.="<p><b>Nama (Name): </b>$name</p>";
            $message.="<p><b>MyKad/Passport: </b>$ic</p>";
            $message.="<p><b>Mobile No.: </b>$phone</p>";
            $message.="<p><b>Email: </b>$email</p>";
            $message.="<p><b>Social media: </b>$socmed</p>";
            $message.="<p><b>Comments: </b>$comment</p>";
            $message.="<br><p style='color:red;'>This is a no-reply email</p><br>";
        
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
                $mail->Password = 'Wo5fjiCx6gQG';                           // SMTP password
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
                $mail->addAddress("gregpravin@asayokl.org");
                $mail->addAddress("chermaine@asayokl.org");
                $mail->addCC($email);

            //Content
                $mail->isHTML(true);                                 
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->send();
            } 
            catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }else if($_POST["formName"]=="login"){
            $response=login($_POST);
            if($response["success"]){
                setToken($response["token"]);
                if($response["type"]=="admin")
                    header("Location: /rog-admin");
                else
                    header("Location: /rog-user");
                exit;
            }else{
                $status="login credential";
            }
                
        }

    }

?>

<?php  include 'templates/header.php'; ?>

<div class="row justify-content-center mb-5 rog">
    <div class="col-12 text-right px-0 pt-3 mb-3 px-lg-5">
        <ul class="nav justify-content-around">
            <li class="nav-item rog-hero-button">
                <a class="nav-link active" id="aboutrog-tab" data-toggle="tab" href="#aboutRog" role="tab" aria-controls="aboutRog" aria-selected="true">
                    <img class="w-100" src="Images/rog_info.png"/>
                </a>
            </li>
           
            <li class="nav-item rog-hero-button">
                <a class="nav-link" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="false">
                    <img class="w-100" src="Images/rog_past.png"/>
                </a>
            </li>
            <li class="nav-item rog-hero-button">
                <a class="nav-link" id="present-tab" data-toggle="tab" href="#present" role="tab" aria-controls="present" aria-selected="false">
                    <img class="w-100" src="Images/rog_current.png"/>
                </a>
            </li>
            <li class="nav-item rog-hero-button">
                <a class="nav-link" id="login-form" style="cursor:pointer;" data-toggle="modal" data-target="#loginModal">
                    <img class="w-100" src="Images/rog_login.png"/>
                </a>
            </li>
            
        </ul>
    </div>
    

    


    <div class="col-sm-8 col-12 post-title text-center">
        <div class="tab-content text-center" id="myTabContent">
            <!-- About ROG Tab -->
            <div class="tab-pane text-center fade show active" id="aboutRog" role="tabpanel" aria-labelledby="home-tab">
                <div id="accordion" class="mb-5">
               

                    <!-- Terms and Conditions -->
                    <div class="card shadow">
                        <button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <div class="card-header py-3 text-left" id="headingOne">
                                <h5 class="eng mb-0" style="display:none;">ROG Terms & Conditions</h5>
                                <h5 class="bm mb-0" style="display:none;">ROG Terma & Syarat</h5>
                            </div>
                        </button>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body text-left">
                                <!-- Content here -->
                                <ol class="eng" style="display:none;">
                                    <li>Although your mission activity may have a higher value, each successful application will be awarded a grant up to a maximum of RM1000.</li>
                                    <li>Grant application is open between November and April.</li>
                                    <li>Application must precede mission activity.</li>
                                    <li>Mission activity should be carried out between December and September.</li>
                                    <li>In the event that the funds are not able to be utilised due to unforeseen circumstances that inhibit the recipient to carry out their outreach, recipients are advised to prioritize the health, wellbeing and safety of persons involved and
                                        <ol type="a">
                                            <li>Consider other outreach activities</li>
                                            <li>Seek assistance from ASAYO</li>
                                        </ol>
                                    </li>
                                    <li>Upon expression of interest through ASAYOKL, applicants will be accompanied through submitting a creative proposal, raising funds, and preparation for outreach if required.</li>
                                    <li>Successful applicants are required to document the mission activity through videos and photos for the purpose of sharing their testimony.</li>
                                    <li>Only mission activities that are in accordance with the teachings of the Catholic Church will be considered.</li>
                                    <li>PMS-ArchKL and ASAYOKL values every young person’s desire to serve and would strongly encourage applicants to consider other avenues to pursue their outreach should the Reach Out Grant not be awarded to them.</li>
                                </ol>
                                <ol class="bm" style="display:none;">
                                    <li>Walaupun aktiviti misi anda mungkin mempunyai nilai yang lebih tinggi, setiap permohonan yang berjaya hanya akan diberikan geran sehingga maksimum RM1000.</li>
                                    <li>Permohonan geran dibuka antara bulan November dan April.</li>
                                    <li>Permohonan mesti mendahului aktiviti misi.</li>
                                    <li>Aktiviti misi harus dijalankan antara bulan Disember dan September.</li>
                                    <li>Sekiranya dana tidak dapat digunakan kerana keadaan yang tidak terduga yang menghalang penerima untuk melakukan “outreach” mereka, penerima disarankan untuk mengutamakan kesihatan, kesejahteraan dan keselamatan orang yang terlibat dan
                                        <ol type="a">
                                            <li>Pertimbangkan aktiviti “outreach” lain</li>
                                            <li>Dapatkan bantuan dari ASAYO</li>
                                        </ol>
                                    </li>
                                    <li>Setelah menyatakan minat melalui ASAYOKL, pemohon akan disertai dengan mengemukakan cadangan kreatif, mengumpulkan dana, dan persiapan untuk “outreach” jika diperlukan.</li>
                                    <li>Pemohon yang berjaya dikehendaki mendokumentasikan aktiviti misi melalui video dan foto untuk tujuan berkongsi keterangan mereka.</li>
                                    <li>Hanya aktiviti m”outreach” yang sesuai dengan ajaran Gereja Katolik yang akan dipertimbangkan.</li>
                                    <li>PMS-ArchKL dan ASAYOKL menghargai keinginan setiap orang muda untuk melayani dan oleh itu mendorong pemohon untuk mempertimbangkan jalan lain untuk meneruskan “outreach” mereka sekiranya gagal menerima Geran Reach Out.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Discernment Checklist -->
                    <div class="card shadow">
                        <button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <div class="card-header py-3 text-left" id="headingFive">
                                <h5 class="mb-0">ROG Discernment Checklist</h5>
                            </div>
                        </button>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body text-left">
                                <!-- Content here -->
                                <ol class="eng" sty;e="display:none;">
                                    <li>Serving the common good -</li> 
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Have I thought beyond my needs when serving this person, family, or community?</li>
                                        <li>Have I considered the material and spiritual good of this person, family or community?</li>
                                    </ol>
                                    
                                    <li>Helping every individual live a dignified, truly human life -</li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Am I offering deliberate, practical support for the well-being of this person, family or community?</li>
                                        <li>Am I concerned with the good of all, even of people nobody thinks about because they have no voice and no power?</li>
                                    </ol>
                                    
                                    <li>Protecting the intrinsic rights of groups and associations -  </li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>In helping this person, family or community, am I encouraging private initiative on their part as I recognize it to be an important component of the dignity of the human person?</li>
                                    </ol>
                                    
                                    <li>Preserving unity (culture, race, and religion) in Malaysia - </li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Am I allowing space in my outreach for this person, family or community to not just receive practical assistance, but also to have a conversation partner, to grow by coming to understand the ideas, arguments, needs, and wishes of others, and to be able to develop their personality more completely?</li>
                                        <li>Am I taking future generations into consideration in my actions and decisions when helping this person, family or community?</li>
                                    </ol>
                                        
                                </ol>

                                <ol class="bm" sty;e="display:none;">
                                    <li>Melayani kebaikan bersama -</li> 
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Adakah saya berfikir di luar keperluan saya ketika melayani orang, keluarga, atau komuniti ini?</li>
                                        <li>Sudahkah saya mengambil kira kebaikan fizikal dan rohani orang, keluarga atau komuniti ini?</li>
                                    </ol>
                                    
                                    <li>Membantu setiap individu menjalani kehidupan yang bermaruah -</li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Adakah saya menawarkan sokongan praktikal untuk kesejahteraan orang, keluarga atau komuniti ini?</li>
                                        <li>Adakah saya prihatin dengan kebaikan semua, termasuk orang yang telah dipinggirkan kerana mereka tidak mempunyai suara dan kuasa?</li>
                                    </ol>
                                    
                                    <li>Melindungi hak hak asasi kumpulan dan persatuan  -  </li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Dalam menolong orang, keluarga atau komuniti ini, adakah saya mendorong inisiatif dari pihak mereka kerana saya mengenali  pentingnya komponen martabat seseorang?</li>
                                    </ol>
                                    
                                    <li>Memelihara perpaduan (budaya, bangsa, dan agama) di Malaysia - </li>
                                    <ol style="list-style-type:lower-alpha;">
                                        <li>Adakah saya memberi ruang dalam “outreach” saya untuk orang, keluarga atau komuniti ini untuk tidak hanya menerima bantuan praktikal, tetapi juga mempunyai rakan perbualan, untuk berkembang dengan memahami idea, hujah, keperluan, dan kehendak orang lain, dan dapat memperkembangkan personaliti mereka dengan lebih lengkap?</li>
                                        <li>Adakah saya mempertimbangkan generasi akan datang dalam tindakan dan keputusan saya ketika menolong orang, keluarga atau komuniti ini?</li>
                                    </ol>
                                        
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- How to ROG -->
                    <div class="card shadow">
                        <button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <div class="card-header py-3 text-left" id="headingThree">
                                <h5 class="eng mb-0" style="display:none;">ROG Steps to Apply</h5>
                                <h5 class="bm mb-0" style="display:none;">ROG Langkah-langkah Aplikasi</h5>
                            </div>
                        </button>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body text-left">
                                <!-- Content here -->
                                <ol class="eng" style="display:none;">
                                    <li>Express interest and begin your mission journey with ASAYOKL (below)</li>
                                    <li>Interview/Accompaniment with ASAYO</li>
                                    <li>Submit creative proposal (video, song, report etc)</li>
                                    <li>Once approved, receive RM150 seed money from ASAYO to begin fundraising (to be received within 7 days)</li>
                                    <li>
                                        Participants to raise between RM450 to RM1000 within 60 days
                                        <ol style="list-style-type:lower-alpha;">
                                            <li>RM450 to RM1000 raised - receive matched amount to a maximum of RM1000 from PMS (ie raise RM500, receive RM500)</li>
                                            <li>Less than RM450 raised - will not receive matched amount. Get to keep RM150 seed money</li>
                                        </ol>
                                    </li>
                                    <li>
                                        Participants to submit testimony of mission upon completion
                                        <ol style="list-style-type:lower-alpha;">
                                            <li>3 minute video OR</li>
                                            <li>>100 word report with photos</li>

                                        </ol>
                                    </li>

                                </ol>

                                <ol class="bm" style="display:none;">
                                    <li>Nyatakan minat dan mulakan perjalanan misi anda dengan ASAYOKL (di bawah)</li>
                                    <li>Temu ramah / Temuduga dengan ASAYOKL</li>
                                    <li>Kirim proposal kreatif (video, lagu, laporan dll)</li>
                                    <li>Setelah diluluskan, terima wang sebanyak RM150 dari ASAYOKL untuk memulakan penggalangan dana (akan diterima dalam masa 7 hari)</li>
                                    <li>
                                        Peserta akan mengumpulkan antara RM450 hingga RM1000 dalam masa 60 hari
                                        <ol style="list-style-type:lower-alpha;">
                                            <li>RM450 to RM1000 dikumpul -  jumlah dikumpul dipadan sehingga maksimum RM1000 dari PMS (ie dikumpul RM500, terima RM500)</li>
                                            <li>Dikumpul kurang daripada RM450 - tidak akan menerima jumlah yang sepadan. Wang permulaan RM150 dianggap sebagai geran</li>
                                        </ol>
                                    </li>
                                    <li>
                                        Participants to submit testimony of mission upon completion.
                                        <ol style="list-style-type:lower-alpha;">
                                            <li>Video 3 minit atau</li>
                                            <li>Laporan >100 perkataan dengan lampiran gambar</li>

                                        </ol>
                                    </li>

                                </ol>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <form method="POST" class="text-left">
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="eng" style="display:none;">Nationality</span>
                            <span class="bm" style="display:none;">Kewarganegaraan</span>
                        </div>
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
                        <div class="col-4">
                            <span class="bm" style="display:none;">Nama seperti dalam MyKad/Passport</span> 
                            <span class="eng" style="display:none;">Name as in MyKad/Passport</span>
                        </div>
                        <div class="col-8">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="bm" style="display:none;">Nombor MyKad/Passport</span>
                            <span class="eng" style="display:none;">MyKad/Passport Number</span>
                        </div>
                        <div class="col-8">
                            <input type="text" name="ic" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="bm" style="display:none;">Emel</span>
                            <span class="eng" style="display:none;">Email</span> 
                        </div>
                        <div class="col-8">
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="bm" style="display:none;">No. Telefon</span>
                            <span class="eng" style="display:none;">Phone Number</span> 
                        </div>
                        <div class="col-8">
                            <input type="text" name="phone" class="form-control" value="+6" required>
                        </div>
                    </div>
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="bm" style="display:none;">Kontak lain, contohnya media sosial</span>
                            <span class="eng" style="display:none;">Other contact, such as social media</span> 
                        </div>
                        <div class="col-8">
                            <input type="text" name="socmed" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-5 align-items-center">
                        <div class="col-4">
                            <span class="bm" style="display:none;">Ruang Komen (sila kongsikan tim anda (jika ada) dan pelan outreach yang anda ingin laksana)</span>
                            <span class="eng" style="display:none;">Comment areas (please share with us your team (if any) and the outreach you are hoping to achieve )</span> 
                        </div>
                        <div class="col-8">
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-5 align-items-center">
                        <div class="col-12">
                            <span class="bm" style="display:none;">Dengan menekan butang "hantar", anda telah memahami terma dan syarat aplikasi geran ini dan akan menjangkakan hubungan dari tim pastoral ASAYOKL untuk meneruskan aplikasi untuk Reach Out Grant.</span>
                            <span class="eng" style="display:none;">By clicking on un submit you have understood the terms and conditions of the grant application and will be expecting a contact from ASAYOKL’s pastoral Team to proceed further to apply for the Reach Out Grant.</span> 
                        </div>
                    </div>
                    <input type="hidden" name="formName" value="reachoutReg"> 
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button class="btn btn-success w-100" type="submit" name="submit">
                                <span class="bm" style="display:none;">Hantar</span>
                                <span class="eng" style="display:none;">Submit</span> 
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Past ROG -->
            <div class="tab-pane text-center fade" id="mission" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row text-center justify-content-center">
                    <div class="pt-2 col-12 col-lg-10">
                        <p>If you have the urge or desire to reach out, but would need some guidance to discern the nature of your outreach activity, don't hesitate to <a href="mailto:chermaine@asayokl.org">contact us!</a></p>
                    </div>                    
                </div>                
            </div>


            <!-- Past ROG -->
            <div class="tab-pane text-center fade" id="past" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row text-left justify-content-center">
                    <div class="pt-2 col-12 col-lg-10">
                        <div id="accordion2">
<?php while($row=$past->fetch_assoc()): 
    $id=$row["group_id"];
    $user=$row["group_login"];
    $sql="SELECT * from `rog_videos` where group_id='$id';";
    $result=$conn->query($sql);

?>
                            <div class="card shadow">
                                <button class="btn btn-link p-0" data-toggle="collapse" data-target="#past<?=$id?>" aria-expanded="false" aria-controls="#past<?=$id?>">
                                    <div class="card-header py-3 text-left" id="headingPast<?=$id?>">
                                        <h5 class="mb-0"><?=$row["group_name"]?></h5>
                                    </div>
                                </button>
                                <div id="past<?=$id?>" class="collapse" aria-labelledby="headingPast<?=$id?>" data-parent="#accordion2">
                                    <div class="card-body">
                                        <!-- Content here -->
<?php if(file_exists("profiles/$user/about_us.html")):?>
                                        <h6>About Us</h6>
                                        <div class="row mb-5">
                                            <div class="col-12">
                                                <?php readfile("profiles/$user/about_us.html"); ?>
                                            </div>
                                        </div>
<?php endif;?>
<?php if(file_exists("profiles/$user/testimonies.html")):?>
                                        <h6>Testimonies</h6>
                                        <div class="row mb-5">
                                            <div class="col-12">
                                                <?php readfile("profiles/$user/testimonies.html"); ?>
                                            </div>
                                        </div>
<?php endif;?>
<?php
    while($videos=$result->fetch_assoc()):
        $type=$videos["video_type"];
        $link=$videos["video_link"];
?>                                                                                                    
                                        <h6><?=$type?> Video</h6>
                                        <div class="video-container">
                                            <iframe src="<?=$link?>" width="100%" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                                        </div>        
<?php endwhile; ?>
                                    </div>
                                </div> 
                            </div>
<?php endwhile; ?>
                        </div>
                    </div>                    
                </div>                  
            </div>
            <!-- Current Submissions -->
            <div class="tab-pane text-center fade" id="present" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row text-center justify-content-center">
                    <div class="pt-2 col-12 col-lg-10">
                        <p>We have no applications for this year yet. Click <a href="#" style="cursor:pointer;" data-toggle="modal" data-target="#contactModal">here</a> to be the first!</p>
                    </div>                    
                </div>                 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
            <div class="row mb-4 px-4">
                <label>Username</label>
                <input class="form-control" type="text" name="username"/>
            </div>

            <div class="row mb-4 px-4">
                <label>Password</label>
                <input class="form-control" type="password" name="password"/>
            </div>
            <input type="hidden" name="formName" value="login">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" value="asd" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row justify-content-between text-center mb-4 px-4">
                <div class="col-lg-5 col-12 mb-5">
                    <a target="_blank" href="https://wa.me/60185903889?text=<?=$textenc?>"><button class="btn btn-success btn-block">WhatsApp</button></a>
                </div>
                <div class="col-lg-5 col-12 mb-5">
                    <a target="_blank" href="mailto:chermaine@asayokl.org?subject=<?=$subject?>&body=<?=$text?>"><button class="btn btn-danger btn-block">Email</button></a>
                </div>
            </div>
            
        </div>
    </div>
  </div>
</div>

<?php if(isset($status)):?>
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Login Failed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <p>Wrong <?=$status?>. Please try again.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<script>
    $(window).on('load',function(){
        $('#statusModal').modal('show');
        $('#statusModal').on('hide.bs.modal', function (e) {
            $('#loginModal').modal('show');
        });
    });
</script>
<?php endif; ?>
<?php include 'templates/footer.html';?>