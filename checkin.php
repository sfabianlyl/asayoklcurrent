<?php 
    $image="checkin.png";
    $panel=false;
    include 'templates/header.php';
?>



<!-- content goes here -->
<div class="row justify-content-center pad-btm-50">
    <div class="col-lg-8 col-12 text-center pad-btm-15">
        <h3>Check In</h3>
    </div>
    <div class="col-lg-8 col-12 pad-btm-30">
        <p>
            Di Keuskupan Agung Kuala Lumpur, Malaysia, ASAYO KL (Archdiocesan Single Adults & Youth Office, Kuala Lumpur) 
            adalah Pejabat yang ditugaskan khas untuk meneliti and melayani keperluan pastoral umat Katolik muda 
            yang berusia dari 18 sehingga 39 usia tahun dan sedang tinggal di Keuskupan Agung tersebut.
        </p>

        <p>
            Keuskupan Agung Kuala Lumpur melayani umat yang sedang tinggal di Negeri Selangor, Negeri Pahang, 
            Negeri Terengganu, Negeri Sembilan, Wilayah Perseketuan Putrajaya dan Wilayah Perseketuan Kuala Lumpur.
        </p>
    </div>
    
    <div class="col-lg-8 col-12 text-center">
        <h4>Untuk maklumat anda</h4>
    </div>
    <div class="col-lg-8 col-12 text-center pad-btm-15">
        <h6><i>For your information</i></h6>
    </div>
    <div class="col-lg-8 col-12 pad-btm-30">
        <ol class="checkin">
            <li>Semua bahagian perlu diisi. <br><span>All sections are required to be filled in.</span></li>

            <li>
                Anda akan dihubungi 2 minggu sebelum atau 2 minggu selepas tarikh ketibaan anda melalui media sosial, 
                e-mel atau telefon bimbit.<br>
                <span>
                    You will be contacted 2 weeks before or 2 weeks after your date of arrival via social media, 
                    email or mobile number.
                </span>
            </li>

            <li>
                Kami akan bantu menghubungkan anda ke paroki atau pelayanan belia yang terdekat kepada anda.<br>
                <span>
                    We will help connect you to the nearest parish or youth group to you.
                </span>
            </li>

            <li>
                Perkhidmatan ulang-alik dari terminal lapangan terbang/bus/kereta api tidak tersedia.<br>
                <span>
                    Shuttle services from the airport / bus / train terminals are not available.
                </span>
            </li>

            <li>Perkhimatan asrama/tempat kediaman tidak tersedia.<br><span>Dormitory/accommodation services are not available.</span></li>
            <li>Perkhidmatan biasiswa tidak tersedia.<br><span>Scholarship services are not available.</span></li>
            <li>Perkhidmatan ulang-alik ke Misa tidak tersedia.<br><span>Transport service to the Mass is not available.</span></li>

            <li>
                Perkhidmatan dan pelayanan yang akan dipikul oleh paroki-paroki di Keuskupan Agung 
                adalah berlainan dan mengikut keupayaan masing-masing. Beberapa perkhidmatan ini 
                mungkin atau mungkin tidak disediakan untuk anda.<br>
                <span>
                    The services and pastoral care that the parishes of the Archdiocese will have are different 
                    and according to their respective capabilities. Some of these services may or may not 
                    be available to you.
                </span>
            </li>
            <li>
                Harap maklum, kami mungkin menerima banyak e-mel setiap hari, dan kemungkinan email anda 
                terlepas pandangan kami. Sekiranya anda tidak dihubungi dalam tempoh masa yang dinyatakan, 
                anda boleh menghubungi ASAYO KL di +60185903889.<br>
                <span>
                    Please note, as we may receive many emails daily, it is possible that your email may 
                    be overlooked. In the event, you are not contacted within the stated time frame, 
                    you may contact ASAYO KL at +60185903889.
                </span>
            </li>
            
        </ol>
    </div>
</div>

<div class="row justify-content-center pad-btm-50">
    <div class="col-lg-4 col-12 pad-btm-30">
        <button type="button" class="checkin-button" data-toggle="modal" data-target="#form-self">
            <div class="card shadow rounded">
                <img class="card-img-top" src="Images/checkin-button1.png" alt="Card image cap">
                <!-- <div class="card-body text-center">
                    <h5 class="card-title" style="color:white;">Check In <br>Sendiri. <br>(Untuk pelajar/pekerja)</h5>
                    <h6 class="card-subtitle mb-2 text-darker"><i>Check In Yourself. <br>(For students/worker)</i></h6>            
                </div> -->
            </div>
        </button>
    </div>
    <div class="col-lg-4 col-12 pad-btm-30">
        <button type="button" class="checkin-button" data-toggle="modal" data-target="#form-behalf">
            <div class="card shadow rounded">
                <img class="card-img-top" src="Images/checkin-button2.png" alt="Card image cap">
                <!-- <div class="card-body text-center">
                    <h5 class="card-title" style="color:white;">Check In <br>bagi pihak seseorang.<br>(Untuk ibubapa) </h5>
                    <h6 class="card-subtitle mb-2 text-darker"><i>Check In on behalf of someone.<br>(For parents)</i></h6>
                    
                </div> -->
            </div>
        </button>
    </div>
</div>


<!-- Form Modal Self -->

<div class="modal fade" id="form-self">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <form action="confirm" method="POST" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pengisian diri</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php include 'templates/checkin-self.html' ?>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">HANTAR</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Form Modal Behalf -->

<div class="modal fade" id="form-behalf">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form action="submitBehalf" method="POST">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pengisian bagi pihak</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php include 'templates/checkin-behalf.html' ?>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">HANTAR</button>
                </div>

            </div>
        </form>
    </div>
</div>

<?php include 'templates/footer.html';?>