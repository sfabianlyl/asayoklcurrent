<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Archdiocesan Single Adults & Youth Office</title>
    <link rel="shortcut icon" type="image/x-icon" href="/Images/sitelogo.ico" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/css/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="/css/bootstrap.min.js"></script>
    <script src="/css/js.cookie-2.2.1.min.js"></script>
    <script src="/css/myScript3.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/myStyle.css" type="text/css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/cooper-hewitt" type="text/css"/> 
<?php if(isset($tinymce)) if($tinymce): ?>
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            width:'100%',
            height:'500px',
        });
    </script>   
<?php endif;?>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top" style="background-color:#006837">
    <?php if(isset($main_page)):    ?>
        <a href="#" class="navbar-brand"><img src="/Images/archkl.png" height=70 width=auto/></a>
    <?php else: ?>
        <a href="/" class="navbar-brand"><img src="/Images/asayokl-banner.png" height=70 width=auto/></a>
    <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center" style="min-width:10rem; flex: 0 0 10rem;">
            <div>
                <a id="eng">ENG</a><span style="cursor:default;">&nbsp;|&nbsp;</span><a id="bm">BM</a>
            </div>
            <button type="button" class="navbar-toggler collapsed">
                <span class="menu-icon-bar top-bar"></span>
                <span class="menu-icon-bar middle-bar"></span>
                <span class="menu-icon-bar bottom-bar"></span>
            </button>
        </div>
        
    </nav>
    
    <div id="navbarCollapse">
        <div class="row justify-content-center pt-5">
            <!-- <div class="col-12 col-lg-8 mb-4">
                <h4>Teens <i>(Remaja)</i></h4>
                <br>
                <a href="teens">Butiran <i>(Details)</i></a>
                <a href="checkin">Check In</a>
            </div> -->
            <div class="col-12 col-lg-6 mb-4">
                <h4>Youth & Campus Students <i>(Belia dan Pelajar Kampus)</i></h4>
                <br>
                <a href="youth-campus">Butiran <i>(Details)</i></a>
                <a href="checkin">Check In</a>
                <a href="lnl">Love & Life</a>
                <a href="ciptass">CIPTASS</a>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h4>Young Adults <i>(Belia Dewasa)</i></h4>
                <br>
                <a href="young-adult">Butiran <i>(Details)</i></a>
                <a href="checkin">Check In</a>
                <a href="cyan">Catholic Young Adults Network</a>
                <a href="s2s">Sinners 2 Saints</a>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h4>Lay Singles <i>(Kekal Bujang)</i></h4>
                <br>
                <a href="lay-singles">Butiran <i>(Details)</i></a>
                <a href="checkin">Check In</a>
            </div>
            <div class="col-12 col-lg-6 mb-4">
                <h4>Programmes & Events For All<i>(Program & Acara Untuk Semua)</i></h4>
                <br>
                <a href="hangout">Hangout</a>
                <a href="pestakami">Pesta K.A.M.I.</a>
                <a href="kamikudus">K.A.M.I. KUDUS</a>
                <a href="reachout">Reach Out Grant</a>
                <a href="aypa">AYPA 2019</a>
            </div>
        </div>
    </div>

    <div class="social-nav-panel" style="display:none;">
        <div class="social-nav">
            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_Facebook.png">
                    <a href="https://www.facebook.com/pg/AsayoKualaLumpur/about/?entry_point=page_edit_dialog&tab=page_info" target="_blank">
                        ASAYO Kuala Lumpur
                    </a>
                </div>
            </div>
            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_Instagram.png">
                    <a href="https://www.instagram.com/asayo_kl/" target="_blank">
                        @asayo_kl
                    </a>
                </div>
            </div>
            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_Twitter.png">
                    <a href="https://twitter.com/asayo_kl" target="_blank">
                        @asayo_kl
                    </a>
                </div>
            </div>
            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_Youtube.png">
                    <a href="https://www.youtube.com/channel/UCYYMs6KKetfDXo2HNOaiyMg" target="_blank">
                        ASAYO Kuala Lumpur
                    </a>
                </div>
            </div>
            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_Whatsapp.png">
                    <a href="https://wa.me/60185903889" target="_blank">
                        +60185903889
                    </a>
                </div>
            </div>

            <div class="social-nav-block">
                <div class="social-nav-details">
                    <img src="/Images/icon_WWW.png">
                    <a href="https://asayokl.my" target="_blank">
                        asayokl.my
                    </a>
                </div>
            </div>
            
            
        </div>
        
    </div>

    
   
    <div class="hero-banner">
<?php if (isset($image)):?>
        <div class="hero-logo <?php if(isset($imagefull)) echo 'hero-logo-full'?>">
            <img src="Images/<?=$image?>"/>
        </div>
<?php endif; ?>


    </div>
    <div class="container">
        <div style="height:40px;" class="w-100"></div>
