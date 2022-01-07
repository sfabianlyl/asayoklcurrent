<?php
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}
$user_os        =   getOS();
?>


<?php 
    // $image="archive.png";
    $panel=false;
    include 'templates/header.php';

    switch($user_os){
        case "iPhone":
        case "iPad":
        case "iPod": $type="iOS"; break;
        case "Android": $type="Android"; break;
        default: $type="Android"; break;
    }
    if($type=="Android"){
        $link[]="https://play.google.com/store/apps/details?id=com.ai.formed.formed"; //formed
        $link[]="https://play.google.com/store/apps/details?id=com.docatapp&hl=en"; //docat
        $link[]="https://play.google.com/store/apps/details?id=com.twg.app"; //tweeting
        $link[]="https://play.google.com/store/apps/details?id=com.aycka.apps.MassReadings"; //Laudate
        $link[]="https://play.google.com/store/apps/details?id=id.infinitech.ekatolik"; //eKatolik
        $link[]="https://play.google.com/store/apps/details?id=yuku.alkitab.debug&hl=en"; //AVB
        $link[]="https://play.google.com/store/apps/details?id=com.youcat.daily&hl=en"; //Youcat
        $link[]="https://play.google.com/store/apps/details?id=com.tweetingwithsaints&hl=en"; //Online with Saints
    }elseif($type=="iOS"){
        $link[]="https://apps.apple.com/us/app/formed/id1212963367"; //formed
        $link[]="https://apps.apple.com/us/app/docat-what-to-do/id1125955404"; //docat
        $link[]="https://apps.apple.com/us/app/tweeting-with-god/id939530303"; //tweeting
        $link[]="https://apps.apple.com/us/app/laudate-1-catholic-app/id499428207"; //Laudate
        $link[]="https://apps.apple.com/id/app/ekatolik/id1082252487"; //eKatolik
        $link[]="https://apps.apple.com/my/app/borneo-bible/id1147545735"; //AVB
        $link[]="https://apps.apple.com/us/app/youcat-daily-bible-catechism/id1447116947"; //Youcat
        $link[]="https://apps.apple.com/us/app/online-with-saints/id1449597052"; //Online with Saints
    }
    $apps = array(
        0 => array(
                "name" => "FORMED",
                "description" => "Collection of Basic Catechesis, Theology",
                "url" => $link[0],
                "img" => "Images/formed.png",
                "bgc" => "rgb(255,255,255)",
            ),
        1 => array(
                "name" => "DOCAT",
                "description" => "Catholic Social Teaching",
                "url" => $link[1],
                "img" => "Images/docat.png",
                "bgc" => "rgb(45,148,208)",
            ),
        2 => array(
                "name" => "TwG",
                "description" => "QnA Style Catechesis",
                "url" => $link[2],
                "img" => "Images/twg.png",
                "bgc" => "rgb(95,197,241)",
            ),
        3 => array(
                "name" => "Laudate",
                "description" => "Daily Mass Readings and Prayers",
                "url" => $link[3],
                "img" => "Images/laudate.png",
                "bgc" => "rgb(251,214,113)",
            ),
        4 => array(
                "name" => "eKatolik",
                "description" => "Daily Mass Readings and Prayers (BM)",
                "url" => $link[4],
                "img" => "Images/eKatolik.png",
                "bgc" => "rgb(130,84,21)",
            ),
        5 => array(
                "name" => "Borneo Bible",
                "description" => "Malay Bible",
                "url" => $link[5],
                "img" => "Images/avb.png",
                "bgc" => "rgb(28,166,94)",
            ), 
        6 => array(
                "name" => "YOUCAT Daily",
                "description" => "Daily excerpts from YOUCAT",
                "url" => $link[6],
                "img" => "Images/youcat.png",
                "bgc" => "rgb(246,246,246)",
            ),  
        7 => array(
                "name" => "Online with Saints",
                "description" => "Learn about our Saints!",
                "url" => $link[7],
                "img" => "Images/online-saints.png",
                "bgc" => "rgb(0,116,220)",
            ),                     
    );

    
?>

<!-- content goes here -->
<div class="row justify-content-center pad-btm-50">
    <div class="col-lg-8 col-12 text-center pad-btm-15">
        <h3>Sumber</h3>
    </div>
    
    <div class="col-lg-8 col-12 text-center">
        <div class="row mb-5 justify-content-center">
<?php foreach($apps as $app): ?>
            <div class="col-6 col-lg-3 mb-3">
                <a class="no-line" href="<?=$app["url"]?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?=$app["description"]?>">
                    <div class="card shadow rounded bg-trans">
                        <div style="background-color:<?=$app["bgc"]?>;">
                            <img class="card-img-top" src="<?=$app["img"]?>" alt="Card image cap">
                        </div>
                        <div class="card-body bg-green">
                            <h5 class="card-title"><b><?=$app["name"]?></b></h5>
                        </div>
                    </div>
                </a>
            </div>
<?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'templates/footer.html';?>