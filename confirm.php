<?php
if(!isset($_POST["name"])){
    header('Location: /checkin');
    die();
}
?>
<?php 
    $image="checkin.png";
    $panel=false;
    include 'templates/header.php';
?>


<?php     
    // include '../dcont.php';
    // $conn->query(recordVisit());
?>

<style>
            td{
                padding: 2%;
            }
            td:first-child{
                font-weight:bold;
            }
            .confirmButton{
                font-size:2vh;
                width:10vh;
                height:7vh;
                padding:1vh;
                border-radius:10px;
                border:0px solid black;
                background-color:green;
                color:white;
            }
</style>

            <!-- content begins -->
            <div style="margin:3%;">
                <p style="font-size:1.6vw;">Pengesahan: Sila pastikan butiran yang dimasuki adalah tepat.</p>
                <p style="font-size:1.2vw;"><i>Confirmation Page: Please confirm the entered details are correct.</i></p>

                <?php 
                    $target_dir="temp_upload/";

                    if($_FILES["baptismImg"]["error"]==0)
                        if($_FILES["baptismImg"]["size"]<5000000){
                            $baptism=$target_dir.basename($_FILES["baptismImg"]["name"]);
                            move_uploaded_file($_FILES["baptismImg"]["tmp_name"],$baptism);
                        }
                    
                    if($_FILES["confirmationImg"]["error"]==0)
                        if($_FILES["confirmationImg"]["size"]<5000000){
                            $confirmation=$target_dir.basename($_FILES["confirmationImg"]["name"]);
                            move_uploaded_file($_FILES["confirmationImg"]["tmp_name"],$confirmation);
                        }
                    if($_FILES["eucharistImg"]["error"]==0)
                        if($_FILES["eucharistImg"]["size"]<5000000){
                            $eucharist=$target_dir.basename($_FILES["eucharistImg"]["name"]);
                            move_uploaded_file($_FILES["eucharistImg"]["tmp_name"],$eucharist);
                        }
                 ?>
                <form action="submit" method="POST" enctype="multipart/formdata">
                    
                    <table id="confirm-table">
                        <tr>
                            <td>Nationality <i>(Warganegara)</i>:</td>
                            <td><?=$_POST["nationality"]?></td>
                            <input type="hidden" name="nationality" value="<?=$_POST["nationality"]?>">
                        </tr>
                        <tr>
                            <td>Age <i>(Umur)</i>:</td>
                            <td><?=$_POST["age"]?></td>
                            <input type="hidden" name="age" value="<?=$_POST["age"]?>">
                        </tr>
                        <tr>
                            <td>Name <i>(Nama)</i>:</td>
                            <td><?=$_POST["name"]?></td>
                            <input type="hidden" name="name" value="<?=$_POST["name"]?>">
                        </tr>
                        <tr>
                            <td>Identification Card No. / Passport <i>(No. Kad Pengenalan / Passport)</i>:</td>
                            <td><?=$_POST["IC"]?></td>
                            <input type="hidden" name="IC" value="<?=$_POST["IC"]?>">
                        </tr>
                        <tr>
                            <td>Telephone Number<i>(No. Telefon)</i>:</td>
                            <td><?=$_POST["mobile"]?></td>
                            <input type="hidden" name="mobile" value="<?=$_POST["mobile"]?>">
                        </tr>
                        <tr>
                            <td>Email<i>(Emel)</i>:</td>
                            <td><?=$_POST["email"]?></td>
                            <input type="hidden" name="email" value="<?=$_POST["email"]?>">
                        </tr>
                        <tr>
                            <td>Baptism<i>(Pembaptisan)</i>:</td>
                            <td><?php if(!isset($_POST["baptism"])) echo "No"; else echo "Yes"; ?></td>
                            <input type="hidden" name="baptism" value="<?php if(!isset($_POST["baptism"])) echo "No"; else echo "Yes"; ?>">
                        </tr>
                        <?php
                            if(isset($baptism)){
                                echo "<tr>";
                                echo "<td>Image <i>(Imej)</i></td>";
                                echo "<td><img src='$baptism' style='max-height:200px; max-width:500px;'></img></td>";
                                echo "<input type='hidden' name='baptismImg' value='$baptism'>";
                                echo "</tr>";
                            }
                        ?>
                        <tr>
                            <td>Confirmation<i>(Penguatan)</i>:</td>
                            <td><?php if(!isset($_POST["confirmation"])) echo "No"; else echo "Yes"; ?></td>
                            <input type="hidden" name="confirmation" value="<?php if(!isset($_POST["confirmation"])) echo "No"; else echo "Yes"; ?>">
                        </tr>
                        <?php
                            if(isset($confirmation)){
                                echo "<tr>";
                                echo "<td>Image <i>(Imej)</i></td>";
                                echo "<td><img src='$confirmation' style='max-height:300px; max-width:600px;'></img></td>";
                                echo "<input type='hidden' name='baptismImg' value='$confirmation'>";
                                echo "</tr>";
                            }
                        ?>
                        <tr>
                            <td>Eucharist<i>(Ekaristi)</i>:</td>
                            <td><?php if(!isset($_POST["eucharist"])) echo "No"; else echo "Yes"; ?></td>
                            <input type="hidden" name="eucharist" value="<?php if(!isset($_POST["eucharist"])) echo "No"; else echo "Yes"; ?>">
                        </tr>
                        <?php
                            if(isset($eucharist)){
                                echo "<tr>";
                                echo "<td>Image <i>(Imej)</i></td>";
                                echo "<td><img src='$eucharist' style='max-height:300px; max-width:600px;'></img></td>";
                                echo "<input type='hidden' name='baptismImg' value='$eucharist'>";
                                echo "</tr>";
                            }
                        ?>
                        <?php if($_POST["nationality"]=="Non Malaysian Citizen"){
                            echo "<tr>";
                            echo "<td>Origin Country <i>(Negara Asal)</i>:</td>";
                            echo "<td>".$_POST["originCountry"]."</td>";
                            echo '<input type="hidden" name="country" value="'.$_POST["originCountry"].'">';
                            echo "</tr>";
                        } ?>

                        <tr>
                            <td>State<i>(Negeri)</i>:</td>
                            <td><?=$_POST["originState"][0]?></td>
                            <input type="hidden" name="state" value="<?=$_POST["originState"][0]?>">
                        </tr>
                        <tr>
                            <td>Diocese<i>(Keuskupan)</i>:</td>
                            <td><?=$_POST["originDiocese"][0]?></td>
                            <input type="hidden" name="diocese" value="<?=$_POST["originDiocese"][0]?>">
                        </tr>
                        <tr>
                            <td>Parish<i>(Paroki)</i>:</td>
                            <td><?=$_POST["originParish"][0]?></td>
                            <input type="hidden" name="parish" value="<?=$_POST["originParish"][0]?>">
                        </tr>
                        <tr>
                            <td>Migrating to <i>(Berpindah kepada)</i>:</td>
                            <td><?=$_POST["migrateCountry"]?></td>
                            <input type="hidden" name="migrateCountry" value="<?=$_POST["migrateCountry"]?>">
                        </tr>
                        <?php if($_POST["migrateCountry"]=="Malaysia"):?>
                        <tr>
                            <td>State <i>(Negeri)</i>:</td>
                            <td><?=$_POST["migrateState"][0]?></td>
                            <input type="hidden" name="migrateState" value="<?=$_POST["migrateState"][0]?>">
                        </tr>
                        <?php endif;?>
                        
                        <?php if($_POST["migrateCountry"]=="Malaysia"){
                            echo "<tr>";
                            echo "<td>New Diocese <i>(Keuskupan Baru)</i>:</td>";
                            echo "<td>".$_POST["migrateDiocese"][0]."</td>";
                            echo '<input type="hidden" name="migrateDiocese" value="'.$_POST["migrateDiocese"][0].'">';
                            echo "</tr>";
                        } ?>
                        <tr>
                        <?php 
                            if(isset($_POST["migrateDiocese"]))
                                if($_POST["migrateDiocese"][0]=="Keuskupan Agung Kuala Lumpur"  && isset($_POST["migrateParish"])){
                                    echo "<tr>";
                                    echo "<td>New Parish <i>(Paroki Baru)</i>:</td>";
                                    echo "<td>".$_POST["migrateParish"][0]."</td>";
                                    echo '<input type="hidden" name="migrateParish" value="'.$_POST["migrateParish"][0].'">';
                                    echo "</tr>";
                                } 
                        ?>
                        <?php if($_POST["purpose"]=="Pembelajaran") :?>
                            <tr>
                                <td>Campus <i>(Kampus)</i>:</td>
                                <td><?=$_POST["campus"]?></td>
                                <input type="hidden" name="campus" value="<?=$_POST["campus"]?>">
                            </tr>
                            <tr>
                                <td>Study Field <i>Bidang Pembelajaran</i>:</td>
                                <td><?=$_POST["field"]?></td>
                                <input type="hidden" name="field" value="<?=$_POST["field"]?>">
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td>Organisation <i>(Organisasi)</i>:</td>
                                <td><?=$_POST["organisation"]?></td>
                                <input type="hidden" name="organisation" value="<?=$_POST["organisation"]?>">
                            </tr>
                            <tr>
                                <td>Occupation<i>Pekerjaan</i>:</td>
                                <td><?=$_POST["occupation"]?></td>
                                <input type="hidden" name="occupation" value="<?=$_POST["occupation"]?>">
                            </tr>
                        <?php endif; ?>
                        
                        <tr>
                            <td>Status <i>(Status)</i>:</td>
                            <td><?=$_POST["status"]?></td>
                            <input type="hidden" name="status1" value="<?=$_POST["status"]?>">
                        </tr>
                        <tr>
                            <td>Assistance <i>(Bantuan)</i>:</td>
                            <td><?=implode(', ',$_POST["assist"])?></td>
                            <input type="hidden" name="assist" value="<?=implode(', ',$_POST["assist"])?>">
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="confirmButton" style="float:right;"name="status">Confirm</button></td>
                           
                        </tr>
                    </table>
                </form>
            </div>
<script>
    window.onload= function(){
        var element=document.getElementById("confirm-table");
        element.scrollIntoView();
    };
</script>
<?php readfile('templates/footer.html'); ?>