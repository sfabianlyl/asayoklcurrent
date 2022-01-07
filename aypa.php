<?php 
    //$image="calendar.png";
    $panel=false;
    include 'templates/header.php';
?>
<div class="row justify-content-center pad-btm-50">
    <div class="col-lg-8 col-12">

        <!-- Finalised Statement -->
        <div class="row">
            <div class="row mb-5 justify-content-center align-items-center">
                
                <div class="col-6 text-right ">
                    <h3>Pernyataan AYPA 2019</h3>
                    <h5><i>AYPA 2019 Statement</i></h5>
                </div>
                <div class="col-lg-3 col-5">
                    <img src="Images/aypa-logo.png" class="w-100"/>
                </div>
            </div>
            <?php include 'templates/final_statement.html'?>
        </div>

        <!-- Download Finalised Statement -->
        <div class="row justify-content-center pad-btm-50">
            <div class="col-6 col-lg-3 mb-3">
                <a href="documents/AYPA_2019_STATEMENT.pdf">
                    <button type="button" class="checkin-button text-center">
                        <div class="card card-download shadow">
                            <div class="card-body trans text-center px-0 py-0">
                                <img src="Images/pdf-logo.png" class="w-100">
                            </div>
                            <div class="card-footer text-center">
                                <span>English</span>
                            </div>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <a>
                    <button type="button" class="checkin-button text-center" disabled>
                        <div class="card card-download shadow">
                            <div class="card-body trans text-center px-0 py-0">
                                <img src="Images/pdf-logo.png" class="w-100">
                            </div>
                            <div class="card-footer text-center">
                                <span>Translating...</span>
                            </div>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <a>
                    <button type="button" class="checkin-button text-center" disabled>
                        <div class="card card-download shadow">
                            <div class="card-body trans text-center px-0 py-0">
                                <img src="Images/pdf-logo.png" class="w-100">
                            </div>
                            <div class="card-footer text-center">
                                <span>Translating...</span>
                            </div>
                        </div>
                    </button>
                </a>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <a>
                    <button type="button" class="checkin-button text-center" disabled>
                        <div class="card card-download shadow">
                            <div class="card-body trans text-center px-0 py-0">
                                <img src="Images/pdf-logo.png" class="w-100">
                            </div>
                            <div class="card-footer text-center">
                                <span>Translating...</span>
                            </div>
                        </div>
                    </button>
                </a>
            </div>
        </div>

        <!-- Youtube Videos -->
        <div class="row mb-5 justify-content-center">

            <div class="col-lg-6 mb-5 col-12 text-center">
                <h5>AYPA Day 1</h5>
                <div class="video-container">
                    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FAsayoKualaLumpur%2Fvideos%2F1037711893226586%2F&show_text=0&width=560&mute=0" width="100%" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                </div>
            </div>

            <div class="col-lg-6 mb-5 col-12 text-center">
                <h5>AYPA Day 2</h5>
                <div class="video-container">
                    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FAsayoKualaLumpur%2Fvideos%2F2377420469013966%2F&show_text=0&width=560&mute=0" width="100%" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                </div>
            </div>

            <div class="col-lg-6 mb-5 col-12 text-center">
                <h5>AYPA Day 3</h5>
                <div class="video-container">
                    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FAsayoKualaLumpur%2Fvideos%2F2394526870793183%2F&show_text=0&width=560&mute=0" width="100%" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                </div>
            </div>


            <div class="col-lg-6 mb-5 col-12 text-center">
                <h5>AYPA Recap</h5>
                <div class="video-container">
                    <iframe width="100%" height="auto" src="https://www.youtube.com/embed/lA5XBbzGCZI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <!-- Link to WATERMARKED PICTURES -->
        <div class="row mb-5 download justify-content-center">
            <div class="col-lg-6 col-10">
                <a href="https://photos.app.goo.gl/G9cgGE4rmvq7sHPm6" target="_blank">
                    <div class="row justify-content-center align-items-center py-3 shadow rounded">
                        <div class="col-4">
                            <img src="Images/Google Photos.png" class="w-100"/>
                        </div>
                        <div class="col-7">
                            <span style="text-decoration: none !important; color:white;">Click to see pictures of AYPA 2019</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>
<?php include 'templates/footer.html';?>