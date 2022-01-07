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
    // $username="catholic_asayokl";
    // $password=")weIV$+y6,[H";
    // $database="catholic_asayokl";
    // $conn=new mysqli($servername,$username,$password,$database);
    // if(isset($_POST["submit"])){
        
        

    //     //google sheets connection:
    //     $client = new \Google_Client();
    //     $client->setApplicationName('My PHP App');
    //     $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    //     $client->setAccessType('offline');
    //     $client->setAuthConfig('../cdac4de75d4e/asayokldb-cdac4de75d4e.json');
    //     $sheets = new \Google_Service_Sheets($client);
    //     $spreadsheetId ='1fZJit2m8ShfFnl1EYAs69E-wO21bXvFanj0R6Iqt3qc';

    //     $data=[];
    //     $data[]=$_POST["age"];
    //     $data[]=$_POST["state"];
    //     $data[]=$_POST["gender"];
    //     $data[]=$_POST["state_of_life"];
    //     if(isset($_POST['rank'])){
    //         $data=array_merge($data,$_POST['rank']);
    //         if(isset($_POST["rank_others"])){
    //             $temp=array_pop($data);
    //             $data[]="$temp - ".$_POST["rank_others"];
    //         }
            

    //     } 
    //     if(isset($_POST['question2']))
    //     foreach($_POST['question2'] as $index=>$answer){
    //         $data[]="$answer - ".$_POST['question2text'][$index];
    //     }

    //     if(isset($_POST['question3'])) $data[]=$_POST['question3'];
    //     else $data[]="No comments";

    //     switch($_POST['form']){
    //         case "family": 
    //             $data[]=$_POST["commitment"]; 
    //             $sheet="Family";
    //             break;
    //         case "social": 
    //             $data[]=$_POST["affirmed"]; 
    //             $data[]=$_POST["parish_social_response"]; 
    //             $data[]=$_POST["empowered"]; 
    //             $sheet="Social";
    //             break;
    //         case "ecology":
    //             $data[]=$_POST["cultivate"]; 
    //             $data[]=$_POST["empowered"]; 
    //             $sheet="Ecology";
    //             break;
    //         case "differently":
    //             if(isset($_POST["ability"])) $data[]=implode(", ",$_POST["ability"]);
    //             else $data[]="-";
    //             $data[]=$_POST["differently_able"]; 
    //             if($_POST["equal"]=="Others"){
    //                 $temp="Others";
    //                 if(isset($_POST["equalOthers"])) $temp.=" - ".$_POST["equalOthers"];
    //             }else{
    //                 $temp=$_POST["equal"];
    //             }
    //             $data[]=$temp; 
    //             $sheet="Differently Abled";
    //             break;
    //         case "elderly":
    //             $data[]=$_POST["elderly_accompaniment"];
    //             $data[]=$_POST["elderly_prepared"];
    //             $data[]=$_POST["elderly_advantage"];
    //             $sheet="Elderly";
    //             break;
    //     }

    //     if($_POST["archbishop"]=="Others" || $_POST["archbishop"]=="Yes"){
    //         $temp=$_POST["archbishop"];
    //         if(isset($_POST["archbishopOthers"])) $temp.=" - ".$_POST["archbishopOthers"];
    //     }else{
    //         $temp=$_POST["archbishop"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["priest"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["priestOthers"])) $temp.=" - ".$_POST["priestOthers"];
    //     }else{
    //         $temp=$_POST["priest"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["religious"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["religiousOthers"])) $temp.=" - ".$_POST["religiousOthers"];
    //     }else{
    //         $temp=$_POST["religious"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["lay"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["layOthers"])) $temp.=" - ".$_POST["layOthers"];
    //     }else{
    //         $temp=$_POST["lay"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["sacraments"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["sacramentsOthers"])) $temp.=" - ".$_POST["sacramentsOthers"];
    //     }else{
    //         $temp=$_POST["sacraments"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["community"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["communityOthers"])) $temp.=" - ".$_POST["communityOthers"];
    //     }else{
    //         $temp=$_POST["community"];
    //     }
    //     $data[]=$temp; 

    //     if($_POST["responding"]=="Others"){
    //         $temp="Others";
    //         if(isset($_POST["respondingOthers"])) $temp.=" - ".$_POST["respondingOthers"];
    //     }else{
    //         $temp=$_POST["responding"];
    //     }
    //     $data[]=$temp; 

    //     $data[]=$_POST["employment"];
    //     // $data[]=$_POST["inclusive"];
    //     $data[]=$_POST["understand"];
    //     if(isset($_POST["feedback"])) $data[]=$_POST["feedback"];
    //     else $data[]="No feedback.";
        
    //     $data[]=date("jS F Y, g:i a");

    //     $range = "$sheet!A1:Z";
    //     $rows = $sheets->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);
    //     $count=count($rows['values']);
    //     array_unshift($data,$count-1);

    //     $values=array($data);
    //     $body = new Google_Service_Sheets_ValueRange([
    //         'values' => $values
    //     ]);
    //     $result = $sheets->spreadsheets_values->append($spreadsheetId, $range, $body,['valueInputOption' => 'RAW']);
        
        
        
        
    // }
?>

<style>
    .ranking{
        position:relative;
        border:1px solid white;
        border-radius:1rem;
        margin-bottom:1rem;
    }
    .ranking input[type="checkbox"]{
        display:none;
    }
    .ranking label{
        display:flex;
        width:100%;
        border-radius:15px;
        cursor:pointer;
        padding:1rem 3rem;
    }

    .ranking.first, .ranking.second, .ranking.third, .ranking.fourth, .ranking.fifth, .ranking.sixth, .ranking.seventh, .ranking.eighth, .ranking.ninth{
        background-color:#fed501;
        color:#006837;
        border:1px solid transparent;
    }
    .ranking.first:after, .ranking.second:after, .ranking.third:after, .ranking.fourth:after, .ranking.fifth:after, .ranking.sixth:after, .ranking.seventh:after, .ranking.eighth:after, .ranking.ninth:after{
        position:absolute;
        transform:translate(-50%,-50%);
        top:50%;
        right:1rem;
    }
    .ranking.first:after{
        content:'1';
    }
    .ranking.second:after{
        content:'2';
    }
    .ranking.third:after{
        content:'3';
    }
    .ranking.fourth:after{
        content:'4';
    }
    .ranking.fifth:after{
        content:'5';
    }
    .ranking.sixth:after{
        content:'6';
    }
    .ranking.seventh:after{
        content:'7';
    }
    .ranking.eighth:after{
        content:'8';
    }
    .ranking.ninth:after{
        content:'9';
    }

    .boxed{
        border:1px solid white;
        border-radius:1rem;
    }

    .form-check{
        margin-bottom:1.5rem;
    }

    hr{
        border-top: 5px solid white;
    }
    body{
        font-size:1.25rem;
    }

    
</style>

<div class="mb-5">
    <h3 class="text-center">ArchKL Survey</h3>
    <p class="text-center">Finding a <i>renewed</i>&nbsp;&nbsp;way of being Church</p>
</div>

<?php include "templates/pmpc-respondent.html";?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <h3>Which category do you feel most called to speak about?</h3>
        <div class="nav nav-tabs mb-5" id="nav-tab" role="tablist">
            <a class="nav-item nav-link" id="family-nav" data-toggle="tab" href="#family" role="tab" aria-controls="family" aria-selected="false">Family</a>
            <a class="nav-item nav-link" id="social-nav" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">Social</a>
            <a class="nav-item nav-link" id="ecology-nav" data-toggle="tab" href="#ecology" role="tab" aria-controls="ecology" aria-selected="false">Ecology</a>
            <a class="nav-item nav-link" id="differently-nav" data-toggle="tab" href="#differently" role="tab" aria-controls="differently" aria-selected="false">Differently Able</a>
            <a class="nav-item nav-link" id="elderly-nav" data-toggle="tab" href="#elderly" role="tab" aria-controls="elderly" aria-selected="false">Elderly</a>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-nav">
                <form action="" method="POST">
                    <input type="hidden" name="form" value="family">
                    <?php include "templates/pmpc-respondent-common.html";?>
                    <div class="mb-5">
                        <h5>Tap on the following issues to rank them by level of importance to you (1st for most important, and leave unselected if not applicable).</h5>
                        <div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-parenting1" value="N/A">
                                <label for="family-rank-parenting1">Parenting - Mother/father relationship with Children (vice versa)</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-parenting2" value="N/A">
                                <label for="family-rank-parenting2">Parenting - providing safe space for Children's education, peer to peer interaction, secondary caregivers, etc</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-single-parenting1" value="N/A">
                                <label for="family-rank-single-parenting1">Single Parenting - Mother/father relationship with Children (vice versa)</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-single-parenting2" value="N/A">
                                <label for="family-rank-single-parenting2">Single Parenting - providing safe space for Children's education, peer to peer interaction, secondary caregivers, etc</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-dependent" value="N/A">
                                <label for="family-rank-dependent">Caring for a dependant; siblings, elderly, etc</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-marital" value="N/A">
                                <label for="family-rank-marital">Husband and Wife relationship</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-separated" value="N/A">
                                <label for="family-rank-separated">Relationship among divorce / separated / remarried couples</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-relationship" value="N/A">
                                <label for="family-rank-relationship">Family relationship with GOD, prayer life, parish community, etc</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="family-rank-others" value="N/A">
                                <label for="family-rank-others">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="pr-3">Others:</span>
                                        <div style="flex:1;"><input type="text" id="family-ranking-others-text" name="rank_others" class="form-control"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php include "templates/pmpc-question2.html";?>
                    <?php include "templates/pmpc-question3.html";?>
                    <div class="mb-5">
                        <h5>Has your commitment (time, money and efforts) in Parish/Church life, positively impacted your relationship between you and your family?</h5>
                        <?php $name="commitment"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <?php include "templates/pmpc-common.html";?>
                </form>
            </div>
            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-nav">
                <form action="" method="POST">
                    <input type="hidden" name="form" value="social">
                    <?php include "templates/pmpc-respondent-common.html";?>
                    <div class="mb-5">
                    <h5>Tap on the following issues to rank them by level of importance to you (1st for most important, and leave unselected if not applicable).</h5>
                        <div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-stability" value="N/A">
                                <label for="social-rank-stability">Work Stability & Security / Financial Stability & Security </label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-educational" value="N/A">
                                <label for="social-rank-educational">Educational opportunities and guidance / Financial assistance</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-friendship" value="N/A">
                                <label for="social-rank-friendship">Friendship (relationship and conduct) among people of other beliefs and in non-church communities (school, clubs, etc) </label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-online" value="N/A">
                                <label for="social-rank-online">Online relationship and conduct among peers / virtual ministry and witnessing of faith on social media </label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-personal" value="N/A">
                                <label for="social-rank-personal">Personal Wellness: Mental Health / Recreational & Sport / Leisure </label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-service" value="N/A">
                                <label for="social-rank-service">Service to the community: Volunteerism / Socio-political issues</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-dating" value="N/A">
                                <label for="social-rank-dating">Navigating dating and intimate relationships </label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-discovery" value="N/A">
                                <label for="social-rank-discovery">Self Discovery: Identity, Personality, Sexuality </label>
                            </div>
                            
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="social-rank-others" value="N/A">
                                <label for="social-rank-others">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="pr-3">Others:</span>
                                        <div style="flex:1;"><input type="text" id="social-ranking-others-text" name="rank_others" class="form-control"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php include "templates/pmpc-question2.html";?>
                    <?php include "templates/pmpc-question3.html";?>
                    <div class="mb-5">
                        <h5>Through your upbringing (formal/informal education) in the Catholic Church, has it affirmed you in your beliefs of the CST (Catholic Social Teaching)?</h5>
                        <div class="pl-5">
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="radio" class="form-check-input" name="affirmed" value="My upbringing in the Church has educated me well however I am still struglling to integrate my faith values with  the reality of my life" required> 
                                    <span>My upbringing in the Church has educated me well however I am still struglling to integrate my faith values with  the reality of my life</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="radio" class="form-check-input" name="affirmed" value="My upbringing in the Church has educated me well and helped me concretely to integrate my faith values with the reality of my life" required> 
                                    <span>My upbringing in the Church has educated me well and helped me concretely to integrate my faith values with the reality of my life</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="radio" class="form-check-input" name="affirmed" value="My upbringing in the Church has not educated nor equipped me enough to reconcile my faith values with the reality of my life" required> 
                                    <span>My upbringing in the Church has not educated nor equipped me enough to reconcile my faith values with the reality of my life</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5>Is your Parish social response efforts truly reaching outside our comfort boundaries and into the real need and reality of the person in need?</h5>
                        <?php $name="parish_social_response"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <div class="mb-5">
                        <h5>Do you feel empowered by your upbring and experiences as a faithful Catholic to be actively involved in service to the community in platforms and areas outside the perimeters of the Catholic Church (NGO, NPO, Politics, etc)</h5>
                        <?php $name="empowered"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <?php include "templates/pmpc-common.html";?>
                </form>
            </div>
            <div class="tab-pane fade" id="ecology" role="tabpanel" aria-labelledby="ecology-nav">
                <form action="" method="POST">
                    <input type="hidden" name="form" value="ecology">
                    <?php include "templates/pmpc-respondent-common.html";?>
                    
                    <?php include "templates/pmpc-question3.html";?>
                    
                    <div class="mb-5">
                        <h5>The efforts of the Parish/ArchKL to cultivate a culture of responsibility towards stewardship of environment has changed my personal response and behaviour towards the care of the environment</h5>
                        <?php $name="cultivate"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <div class="mb-5">
                        <h5>Do you feel empowered by the efforts of the Parish/ArchKL to be actively involved in responding to the welfare and issues related to the ecology outside the perimeters of the Catholic Church?</h5>
                        <?php $name="empowered"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <?php include "templates/pmpc-common.html";?>
                </form>
            </div>
            <div class="tab-pane fade" id="differently" role="tabpanel" aria-labelledby="differently-nav">
                <form action="" method="POST">
                    <input type="hidden" name="form" value="differently">
                    <?php include "templates/pmpc-respondent-common.html";?>
                    <div class="mb-5">
                    <h5>Tap on the following issues to rank them by level of importance to you (1st for most important, and leave unselected if not applicable).</h5>
                        <div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-parenting" value="N/A">
                                <label for="differently-rank-parenting">Parenting a differently-able child</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-caring" value="N/A">
                                <label for="differently-rank-caring">Caring for/living with someone who is differently-able</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-employment" value="N/A">
                                <label for="differently-rank-employment">Employment/education/respect and dignity for differently-able</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-resources" value="N/A">
                                <label for="differently-rank-resources">Resources/formation designed for differently-able</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-sacraments" value="N/A">
                                <label for="differently-rank-sacraments">Sacraments/prayer/parish celebration (Mass) sensitive and inclusive for people who are differently able</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-support" value="N/A">
                                <label for="differently-rank-support">Support group for people who are differently-able and those who care for those who are differently-able</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-space" value="N/A">
                                <label for="differently-rank-space">Space in every area of parish life/community life/church for a differently-able person to partake in</label>
                            </div>
                            
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="differently-rank-others" value="N/A">
                                <label for="differently-rank-others">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="pr-3">Others:</span>
                                        <div style="flex:1;"><input type="text" id="differently-ranking-others-text" name="rank_others" class="form-control"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php include "templates/pmpc-question2.html";?>
                    <?php include "templates/pmpc-question3.html";?>
                    <div class="mb-5">
                        <h5>I am...</h5>
                        <div class="pl-5">
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" name="ability[]" value="a differently-abled person">
                                    <span>a differently-abled person</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" name="ability[]" value="caring for a differently-able person">
                                    <span>caring for a differently-able person</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" name="ability[]" value="working with the differently-able communities">
                                    <span>working with the differently-abled communities</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" name="ability[]" value="mindful towards the differently-abled community">
                                    <span>mindful towards the differently-abled community</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input" id="ability_others_input" name="ability[]" value="">
                                    <div class="d-flex align-items-center" style="flex:1">
                                        <span class="pr-3">Others:</span>
                                        <div style="flex:1;">
                                            <input type="text" class="form-control" id="ability_others">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <script>
                                $("#ability_others").on("change",function(){
                                    $("#ability_others_input").val($(this).val());
                                }).trigger("change");
                            </script>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5>Are the differently-able faithful given equal space in all areas of Church life activities/decision-making/service/planning/repsonsibility etc?</h5>
                        <?php $name="differently_able"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <div class="common-questions mb-5">
                        <h5 class="mb-3">Are the differently-able faithful given and made aware of equal opporturnities to fulltime mission in the Catholic Church (Priesthood, Religious Life, Lay workers)?</h5>
                        <div class="pl-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="equal" value="Yes" required> Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="equal" value="No" required> No
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input others" name="equal" value="Others" required> Others (feel free to express yourself!)
                                </label>
                            </div>
                            <div>
                                <textarea name="equalOthers" class="form-control" rows="5" style="display:none"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <?php include "templates/pmpc-common.html";?>
                </form>
            </div>
            <div class="tab-pane fade" id="elderly" role="tabpanel" aria-labelledby="elderly-nav">
                <form action="" method="POST">
                    <input type="hidden" name="form" value="elderly">
                    <?php include "templates/pmpc-respondent-common.html";?>
                    <div class="mb-5">
                        <h5>Tap on the following issues to rank them by level of importance to you (1st for most important, and leave unselected if not applicable).</h5>
                        <div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-relationship" value="N/A">
                                <label for="elderly-rank-relationship">Relationship between children and grandchildren</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-mental" value="N/A">
                                <label for="elderly-rank-mental">Mental Health Wellness</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-support" value="N/A">
                                <label for="elderly-rank-support">Support (all areas) in the event of the death or illness of a spouse</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-financial" value="N/A">
                                <label for="elderly-rank-financial">Financial Stability and Security (inclusive of medical and living)</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-active" value="N/A">
                                <label for="elderly-rank-active">Active participation and inclusiveness in the Parish/ArchKL community</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-opportunity" value="N/A">
                                <label for="elderly-rank-opportunity">Opportunity for social and recreational gathering (inclusive of non believers)</label>
                            </div>
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-retirement" value="N/A">
                                <label for="elderly-rank-retirement">Navigating Retirement and Separation </label>
                            </div>
                            
                            <div class="ranking">
                                <input type="checkbox" name="rank[]" id="elderly-rank-others" value="N/A">
                                <label for="elderly-rank-others">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="pr-3">Others:</span>
                                        <div style="flex:1;"><input type="text" id="elderly-ranking-others-text" name="rank_others" class="form-control"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php include "templates/pmpc-question2.html";?>
                    <?php include "templates/pmpc-question3.html";?>
                    <div class="mb-5">
                        <h5>Are the Elderly with the Parish/ArchKL community (especially in active ministry) given proper accompaniment, and facilitation in transitioning out of parish responsibilities?</h5>
                        <?php $name="elderly_accompaniment"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <div class="mb-5">
                        <h5>Are the Elderly within the Parish/ArchKL community prepared to embrace and accept the next part of life (death) in a holistic and healthy way?</h5>
                        <?php $name="elderly_prepared"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    <div class="mb-5">
                        <h5>Are the Elderly with the Parish/ArchKL community taken advantage of in how they are expected to contribute of themselves?</h5>
                        <?php $name="elderly_advantage"; include "templates/pmpc-scale.php"; ?>
                    </div>
                    
                    
                    <?php include "templates/pmpc-common.html";?>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script>
    
    function refreshRanking(){
        var rankedConts=$(".ranking:visible");
        var rankedCbxs=rankedConts.find("input[type='checkbox']:checked");
        if($(this).is(":checked")){
            
            if(!rankedConts.is(".first")){
                $(this).val("First");
                $(this).closest(".ranking").addClass("first");
                return;
            }
            if(!rankedConts.is(".second")){
                $(this).val("Second");
                $(this).closest(".ranking").addClass("second");
                return;
            }
            if(!rankedConts.is(".third")){
                $(this).val("Third");
                $(this).closest(".ranking").addClass("third");
                return;
            }
            if(!rankedConts.is(".fourth")){
                $(this).val("Fourth");
                $(this).closest(".ranking").addClass("fourth");
                return;
            }
            if(!rankedConts.is(".fifth")){
                $(this).val("Fifth");
                $(this).closest(".ranking").addClass("fifth");
                return;
            }
            if(!rankedConts.is(".sixth")){
                $(this).val("Sixth");
                $(this).closest(".ranking").addClass("sixth");
                return;
            }
            if(!rankedConts.is(".seventh")){
                $(this).val("Seventh");
                $(this).closest(".ranking").addClass("seventh");
                return;
            }
            if(!rankedConts.is(".eighth")){
                $(this).val("Eighth");
                $(this).closest(".ranking").addClass("eighth");
                return;
            }
            if(!rankedConts.is(".ninth")){
                $(this).val("Ninth");
                $(this).closest(".ranking").addClass("ninth");
                return;
            }
            
        }else{
            $(this).val("N/A");
            var cont=$(this).closest(".ranking");
            var order=cont.attr("class").replace("ranking","").trim();
            switch(order){
                case "first": 
                    $(".second:visible").removeClass("second").addClass("first").find("input[type='checkbox']").val("First");
                case "second":
                    $(".third:visible").removeClass("third").addClass("second").find("input[type='checkbox']").val("Second");
                case "third":
                    $(".fourth:visible").removeClass("fourth").addClass("third").find("input[type='checkbox']").val("Third");  
                case "fourth":
                    $(".fifth:visible").removeClass("fifth").addClass("fourth").find("input[type='checkbox']").val("Fourth");
                case "fifth":
                    $(".sixth:visible").removeClass("sixth").addClass("fifth").find("input[type='checkbox']").val("Fifth");
                case "sixth":
                    $(".seventh:visible").removeClass("seventh").addClass("sixth").find("input[type='checkbox']").val("Sixth");
                case "seventh":
                    $(".eighth:visible").removeClass("eighth").addClass("seventh").find("input[type='checkbox']").val("Seventh");
                case "eighth":
                    $(".ninth:visible").removeClass("ninth").addClass("eighth").find("input[type='checkbox']").val("Eighth");
                case "ninth": break;
            }
            cont.removeClass(order);
        }
    }
    $(".ranking input[type='checkbox']").prop("checked",false);

    $(".ranking input[type='checkbox']").on("change",refreshRanking);

    $("form").on("submit",function(e){
       
        $(".ranking:visible input[name='rank[]']:not(:checked)").prop("checked",true).val("N/A");
        $("input[name='question2[]']:visible:checked").val("Yes");
        $("input[name='question2[]']:visible:not(:checked)").prop("checked",true).val("No");
        var question2text=$("input[name='question2text[]']");
        $.each(question2text,function(index,text){
            if($(text).val()) return;
            $(text).val("No comments");
        });
        var template=$("#demographic");
        
        $(this).find("input[name='age']").val(template.find("input[name='age']:checked").val());
        $(this).find("input[name='state']").val(template.find("select[name='state']").val());
        $(this).find("input[name='gender']").val(template.find("input[name='gender']:checked").val());
        $(this).find("input[name='state_of_life']").val(template.find("select[name='state_of_life']").val());
    });
    
</script>

<script>
    $(".question2").hide();
    $("input[name='question2[]']").prop("checked",false);
    $("input[name='question2[]']").on("change",function(){
        var text=$(this).closest(".boxed").find(".question2");
        text.val("");
        if($(this).is(":checked")) text.show();
        else text.hide();
    });
</script>

<script>

    $(".common-questions input[type='radio']").prop("checked",false).on("change",function(){
        var cont=$(this).closest(".pl-5");
        var textarea=cont.find("textarea");
        if($(this).is(":checked") && $(this).val()=="Others"){
            textarea.show();
        }else if($(this).is(":checked") && $(this).val()=="Yes" && $(this).is("[name='archbishop']")){
            textarea.show();
        }
        else{
            textarea.hide();
        }
        textarea.val("");
    }).trigger("change");
</script>

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
                <p class="text-center">Thank you for participating in the survey!</p>
                <br>
                <p class="text-center">You may submit another response for a different category if you like.</p>
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