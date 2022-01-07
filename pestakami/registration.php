<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
    $panel=false;
    include '../templates/header.php';
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
        $client->setAuthConfig('../../cdac4de75d4e/asayokldb-cdac4de75d4e.json');
        $sheets = new \Google_Service_Sheets($client);
        $spreadsheetId ='1_3eQTaT0dk4oDxn_gmT0V5Es2MHdrHi1pkm0s11fK3U';
        
        
        $nationality=$_POST["nationality"];
        $name=$_POST["name"];
        $age=$_POST["age"];
        $gender=$_POST["gender"];
        $email=$_POST["email"];
        $parish=$_POST["parish"];
        $diocese=$_POST["diocese"];
        $phone=($_POST["phone"][0]=="+")?$_POST["phone"]:"+6".$_POST["phone"];
        $programs=$_POST["program"];
        $address=$_POST["address"];
        $timestamp=date("jS F Y, g:i a");
        
        $summary="";
        foreach($programs as $date=>$program){
            if($program=="none") continue;
            switch($date){
                case "Thursday, 18th November": 
                    $spreadsheetId="1Ht4TwERiGiYwQyiLQhz_-WfwabYA1Ag5An20nS1tzUk";
                    $session="Hangout: Date Nite";
                break;
                case "Friday, 19th November": 
                    $spreadsheetId="1Z_tC77mQo9GpwZ5btAx2MBIy7SdtPR-yyZuhzMY4150";
                    $session="Hangout: TGI Fun Nite";
                break;
                case "Saturday, 20th November": 
                    $spreadsheetId="1fCQJEkwABsq8bOc8BrtV6KuXmZfh4M86ASvPHkATWnw";
                    $session="Hangout: Manna Nite";
                break;
            }
            $range="$program!A1:M"; 
            $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
            $count=count($rows['values']);
            $data=[];
            $data[]=$count;
            $data[]=$nationality;
            $data[]=$name;
            $data[]=$age;
            $data[]=$gender;
            $data[]=$email;
            $data[]=$phone;
            $data[]=$diocese;
            $data[]=$parish;
            $data[]=$address;
            $data[]=$timestamp;
            $values=array($data);
            $body = new Google_Service_Sheets_ValueRange([
                'values' => $values
            ]);
            $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
            $summary.="$session ($date) => $program,\n";
        }

        $spreadsheetId="1q_ZruhP6BV5viCHSH_n8hoJvRd6Eifa6m0vD6grbghc";
        $range="Registration!A1:M";
        $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
        $count=count($rows['values']);
        $data=[];
        $data[]=$count;
        $data[]=$nationality;
        $data[]=$name;
        $data[]=$age;
        $data[]=$gender;
        $data[]=$email;
        $data[]=$phone;
        $data[]=$diocese;
        $data[]=$parish;
        $data[]=$address;
        $data[]=$summary;
        $data[]=$timestamp;
        $values=array($data);
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
            
        
        $subject="Pesta K.A.M.I. ArchKL"; 
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
        foreach($programs as $date=>$program){
            if($program=="none") continue;
            switch($date){
                case "Thursday, 18th November": 
                    $session="Hangout: Date Nite";
                break;
                case "Friday, 19th November": 
                    $session="Hangout: TGI Fun Nite";
                break;
                case "Saturday, 20th November": 
                    $session="Hangout: Manna Nite";
                break;
            }
            $message.="<li>$session ($date) => $program</li>";
        }
        $message.="</ol><br>";
        $message.="<p><b>Nama (Name): </b>$name</p>";
        $message.="<p><b>No. Telefon (Mobile No.): </b>$phone</p>";
        $message.="<p><b>E-mel (Email): </b>$email</p>";

        if($age=="15 - 17"){
            $message.="<br><br><p style='color:red;'><i>As you're below 18, we would need you to ask your parent / guardian to fill up the Parental/Guardian Consent Form - Pesta K.A.M.I. ArchKL <a href='https://forms.gle/zRML2bojwUty72ew9' target='_blank;'>https://forms.gle/zRML2bojwUty72ew9</a></i></p>";
            $message.="<p style='color:red;'><i>Ensure that your parent / guardian is aware of you participating in this celebration.</i></p>";
        }
        
        $message.="<br><br><p class='text-center'>In the meantime, do subscribe to our Telegram: ASAYOKL <a href='https://t.me/asayokl' target='_blank'>https://t.me/asayokl</a> & join Pesta K.A.M.I Group Chat <a href='https://t.me/joinchat/of-V0ZPhMF84ZTM1' target='_blank'>https://t.me/joinchat/of-V0ZPhMF84ZTM1</a></p><br><br>";
        
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

<div class="row justify-content-center mb-5">
    <div class="col-10 col-lg-5 bg-white" style="border-radius:2rem;">
        <img src="/Images/pestakami.png" alt="" class="w-100">
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-lg-8 col-11">
        <form action="" id="myform" method="POST">
            <h2 class="mb-5">Sesi-sesi (Sessions)</h2>

            <h4 class="text-center mb-3">Hangout: Date Nite @ 18th November</h4>
            <div class="row mb-5 justify-content-center">
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Thursday, 18th November]" value="BM"> BM
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Thursday, 18th November]" value="Mandarin"> Mandarin
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Thursday, 18th November]" value="Tamil"> Tamil
                    </label>
                </div>
                
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Thursday, 18th November]" value="English"> English
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Thursday, 18th November]" value="none"> None
                    </label>
                </div>
            </div>

            <h4 class="text-center mb-3">Hangout: TGI Fun Nite @ 19th November</h4>
            <div class="row mb-5 justify-content-center">
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Friday, 19th November]" value="Game Night"> Game Night
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Friday, 19th November]" value="Craft Night"> Craft Night
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Friday, 19th November]" value="none"> None
                    </label>
                </div>
            </div>

            <h4 class="text-center mb-3">Hangout: Manna Nite @ 20th November</h4>
            <div class="row mb-5 justify-content-center">
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Saturday, 20th November]" value="BM"> BM
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Saturday, 20th November]" value="Mandarin"> Mandarin
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Saturday, 20th November]" value="Tamil"> Tamil
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Saturday, 20th November]" value="English"> English
                    </label>
                </div>
                <div class="col-6 col-lg-3">
                    <label>
                        <input type="radio" name="program[Saturday, 20th November]" value="none"> None
                    </label>
                </div>
            </div>

            

            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Kewarganegaraan (Nationality)</div>
                <div class="col-12 col-lg-8">
                    <label>
                        <input type="radio" id="radioMalaysia" name="nationality" value="Malaysia" required checked> Malaysia
                    </label><br>
                    <label>
                        <input type="radio" id="radioOthers" name="nationality" value="" required> <input type="text" id="nationalityOthers" placeholder="Other...">
                    </label>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Nama seperti dalam MyKad/Passport (Name as in MyKad/Passport)</div>
                <div class="col-12 col-lg-8">
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Umur (Age)</div>
                <div class="col-12 col-lg-8">
                    <label><input type="radio" name="age" value="15 - 17">15 - 17 tahun (15 - 17 years old)</label><br>
                    <label><input type="radio" name="age" value="18 - 21" checked>18 - 21 tahun (18 - 21 years old)</label><br>
                    <label><input type="radio" name="age" value="22 - 24">22 - 24 tahun (22 - 24 years old)</label><br>
                    <label><input type="radio" name="age" value="25 - 29">25 - 29 tahun (25 - 29 years old)</label><br>
                    <label><input type="radio" name="age" value="30 - 34">30 - 34 tahun (30 - 34 years old)</label>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Jantina (Gender)</div>
                <div class="col-12 col-lg-8">
                    <label><input type="radio" name="gender" value="Male" required>Lelaki (Male)</label><br>
                    <label><input type="radio" name="gender" value="Female" required>Perempuan (Female)</label>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Emel (Email)</div>
                <div class="col-12 col-lg-8">
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">No. Telefon (Phone Number)</div>
                <div class="col-12 col-lg-8">
                    <input type="text" name="phone" class="form-control" placeholder="e.g. 0132263959 for Malaysian number, add in the country code for non-Malaysian number." required>
                </div>
            </div>
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Keuskupan (Diocese)</div>
                <div class="col-12 col-lg-8">
                    <select class="form-control" name="diocese" required>
                        <option value="Keuskupan Agung Kuala Lumpur">Keuskupan Agung Kuala Lumpur</option>
                        <option value="Keuskupan Pinang">Keuskupan Pinang</option>
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
                <div class="col-12 col-lg-4">Paroki (Parish)</div>
                <div class="col-12 col-lg-8">
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
            <div class="row mb-5 align-items-center">
                <div class="col-12 col-lg-4">Postal Address</div>
                <div class="col-12 col-lg-8">
                    <textarea name="address" id="" class="w-100" rows="5" required></textarea>
                </div>
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
                <p class="text-center">Thank you for registering for Pesta K.A.M.I! </p>
                <br>
                <p class="text-center">Please check your email for further instructions.</p>
                <br>
                <br>
                <p class="text-center">In the meantime, do subscribe to our Telegram: ASAYOKL <a href="https://t.me/asayokl" target="_blank">https://t.me/asayokl</a> & join Pesta K.A.M.I Group Chat <a href="https://t.me/joinchat/of-V0ZPhMF84ZTM1" target="_blank">https://t.me/joinchat/of-V0ZPhMF84ZTM1</a></p>
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
    include '../templates/footer.html';
?>