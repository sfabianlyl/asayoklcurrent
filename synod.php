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
        $spreadsheetId ='1cWAC8lGfHpvlXOQf3fwmj7TMWVP1n24x8FXqTW16ksw';
        
        
        
        $name=$_POST["name"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        $range = "Registration!A1:E";
        $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
        $count=count($rows['values']);
        $data=[];
        $data[]=$count;
        $data[]=$name;
        $data[]=$email;
        if($phone[0]!="+") $data[]="+6$phone";
        else $data[]=$phone;
        $data[]=date("jS F Y, g:i a");
        
        $values=array($data);
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
        
    }
?>
<div class="row justify-content-center mb-5">
    <div class="col-11 col-lg-5 mb-3">
        <img src="Images/Synod1 (2).png" class="w-100">
    </div>
    <div class="col-11 col-lg-5 mb-3">
        <img src="Images/Synod2 (1).png" class="w-100">
    </div>
</div>

<div class="mb-5">
    <h3 class="text-center">Synod 2021 - 20223</h3>
    <p class="text-center mb-5"><i>Listening Session hosted by ASAYOKL</i></p>
    <h5 class="text-center">Dear Young People in ArchKL, we want to hear from you!<br>RSVP below to receive the meeting code on the 3rd December!</h5>
</div>


<div class="row justify-content-center pt-5">
    <div class="col-lg-8 col-12">
        <form action="" id="myform" method="POST">
            
            <div>
                <div class="row mb-5">
                    <div class="col-4">Details:</div>
                    <div class="col-8">
                        <ul>
                            <li>Date: 3rd December 2021 (Friday)</li>
                            <li>Time: 8.30pm</li>
                            <li>Platform: Google Meet</li>
                        </ul>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-4">Nama seperti dalam MyKad/Passport (Name as in MyKad/Passport)</div>
                    <div class="col-8">
                        <input type="text" name="name" class="form-control" required>
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
                        <input type="text" name="phone" class="form-control" placeholder="e.g. 01XXXXXXX for Malaysian numbers, kindly include country code for non-Malaysian numbers" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6"><button class="btn btn-success w-100" type="submit" name="submit">Hantar (Submit)</button></div>
                </div>
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
                <p class="text-center">Thank you for registering! </p>
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