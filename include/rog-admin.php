<?php 
    include "include/rog_functions.php";
    
    if(!loggedIn()){
        header("Location: /reachout");
        die();
    }

    if(getMemberType()!="admin"){
        header("Location: /rog-user");
        die();
    }
?>

<?php 
    if(isset($_POST["form"])){
        switch($_POST["form"]){
            case "application": createApplication($_POST); break;
            case "changepassword": changePassword($_POST); break;
        }
    } 
?>

<?php include "templates/header.php" ?>
<?php $input=getLatestApplications(); $me=getName();?>

<h2 class="text-center mb-5">Welcome, <?=$me?></h2>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="application-tab" data-toggle="tab" href="#application" role="tab" aria-controls="application" aria-selected="true">Application Form</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="min-height:1000px">
  <div class="tab-pane fade show active" id="application" role="tabpanel" aria-labelledby="application-tab">

    <div class="row">
        <div class="col-3">
            <ul class="nav nav-tabs flex-column" id="usersTab" role="tablist">
            <?php $i=1;foreach($inputs as $input): ?>
                <li class="nav-item">
                    <a class="nav-link <?=($i==1)?"active":""?>" id="member-<?=$input["id"]?>-tab" data-toggle="tab" href="#member-<?=$input["id"]?>" role="tab" aria-controls="application" aria-selected="true"><?=($input["teamName"])?$input["teamName"]:"Unnamed Group"?></a>
                </li>
                
            <?php $i++; endforeach;?>
            </ul>
        </div>
        <div class="col-9">
            <div class="tab-content" id="usersTabContent" style="min-height:1000px">
                <?php $j=1; foreach($inputs as $input): ?>
                    <div class="tab-pane fade <?=($j==1)?"active":""?>" role="tabpanel" id="member-<?=$input["id"]?>" aria-labelledby="member-<?=$input["id"]?>-tab">
                        <form action="" method="POST">
                            <input type="hidden" name="form" value="application">
                            <input type="hidden" name="group_id" value="<?=$input["id"]?>">

                            <h4 class="my-5">Team Details</h4>
                            <div class="row mb-5">
                                <label>1. Team Name</label>
                                <input type="text" name="teamName" value="<?=$input["teamName"]?>" class="form-control">
                            </div>
                            <div class="row justify-content-between mb-5">
                                <label>2. Team List</label>
                                <button type="button" id="addMember" class="btn btn-success">Add Member</button>
                            </div>
                            <div class="flex-table mb-5">
                                <div class="row align-items-center">
                                    <div class="col-1 text-center">No</div>
                                    <div class="col-7 text-center">Details</div>
                                    <div class="col-4 text-center">Member</div>
                                </div>
                            <?php $i=1; foreach($input["members"] as $member):?>
                                <div class="row align-items-center member-detail">
                                    <div class="col-1 text-center row-num"><?=$i?></div>
                                    <div class="col-7 text-center">
                                        <div class="row">
                                            <label>Name (as in MyKad/Passport)</label>
                                            <input type="text" name="name[]" class="form-control" value="<?=$member["name"]?>">
                                        </div>
                                        <div class="row">
                                            <label>Mobile No.</label>
                                            <input type="text" name="mobile[]" class="form-control" placeholder="e.g. +60123456789" value="<?=$member["mobile"]?>">
                                        </div>
                                        <div class="row">
                                            <label>Email</label>
                                            <input type="email" name="email[]" class="form-control" value="<?=$member["email"]?>">
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <select class="form-control" name="membership[]">
                                            <option <?=($member["membership"]=="Member")?'selected="selected"':""?>>Member</option>
                                            <option <?=($member["membership"]=="Team Leader 1")?'selected="selected"':""?>>Team Leader 1</option>
                                            <option <?=($member["membership"]=="Team Leader 2")?'selected="selected"':""?>>Team Leader 2</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <?php $i++; endforeach;?>
                                <?php if ($i==1):?>
                                    <div class="row align-items-center member-detail">
                                        <div class="col-1 text-center row-num"><?=$i?></div>
                                        <div class="col-7 text-center">
                                            <div class="row">
                                                <label>Name (as in MyKad/Passport)</label>
                                                <input type="text" name="name[]" class="form-control" value="">
                                            </div>
                                            <div class="row">
                                                <label>Mobile No.</label>
                                                <input type="text" name="mobile[]" class="form-control" placeholder="e.g. +60123456789" value="">
                                            </div>
                                            <div class="row">
                                                <label>Email</label>
                                                <input type="email" name="email[]" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <select class="form-control" name="membership[]">
                                                <option>Member</option>
                                                <option>Team Leader 1</option>
                                                <option>Team Leader 2</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>

                            <h4 class="mb-5">Reach Out Details</h4>
                            <div class="row mb-5">
                                <label>1. We want to reach out to the following person / family/ community (describe how your team came into contact with the person/ family/ community and what is the situation/ dilemma/ concern/ issue which warrants assistance)</label>
                                <textarea class="form-control" name="reachoutPerson"><?=$input["reachoutPerson"]?></textarea>
                            </div>

                            <div class="row mb-5">
                                <label>2. We hope that through our reach out we could (describe how your team’s effort may be beneficial to the recipient(s))</label>
                                <textarea class="form-control" name="reachoutPurpose"><?=$input["reachoutPurpose"]?></textarea>
                            </div>

                            <div class="row mb-5">
                                <label>3. Target for Fundraising in RM *without the grant</label>
                                <input type="number" class="form-control" placeholder="xxxx.xx" name="fundraiseAmount" value="<?=$input["fundraiseAmount"]?>">
                            </div>

                            <div class="row mb-5">
                                <label>4. Fundraising timeline</label>
                                
                            </div>
                            <div class="row mb-5">
                                    <div class="col-6">
                                        <label>Start Date</label>
                                        <input type="date" name="fundraiseStart" value="<?=$input["fundraiseStart"]?>" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label>End Date</label>
                                        <input type="date" name="fundraiseEnd" value="<?=$input["fundraiseEnd"]?>" class="form-control">
                                    </div>
                            </div>
                            <div class="row mb-5">
                                <label>5. Reach out plan</label>
                                <div class="col-12">
                                    <ul>
                                        <li>Once Off (to purchase the necessaries with funds collected or to give cash to recipient(s)</li>
                                        <li>Short Term (to provide aid periodically to recipient for 3 to 6 months)</li>
                                        <li>Temporary Term (to provide aid periodically to recipient for more than a year and/or until recipient is better able to provide for themselves)</li>
                                    <ul>
                                </div>
                                <select class="form-control" name="reachoutTerm">
                                    <option value="Once Off" <?=($input["reachoutTerm"]=="Once Off")?'selected="selected"':""?>>Once Off</option>
                                    <option value="Short Term" <?=($input["reachoutTerm"]=="Short Term")?'selected="selected"':""?>>Short Term</option>
                                    <option value="Temporary Term" <?=($input["reachoutTerm"]=="Temporary Term")?'selected="selected"':""?>>Temporary Term</option>
                                </select>
                            </div>

                            <div class="row mb-5">
                                <label>6. We plan to execute our reach out (describe in detail how you will utilise the fund collected and execute your reach out)</label>
                                <textarea class="form-control" name="reachoutPlan"><?=$input["reachoutPlan"]?></textarea>
                            </div>


                            <h4 class="mb-5">Team's Reflection</h4>
                            <div class="row mb-5">
                                <label>1. What does it mean to you as a person to see your ‘neighbour(s)’ living subpar?</label>
                                <textarea class="form-control" name="reflectionNeighbour"><?=$input["reflectionNeighbour"]?></textarea>
                            </div>

                            <div class="row mb-5">
                                <label>2. What personal life’s experiences/ sharing or teaching from friends have helped you to be more sensitive and compassionate to the needs of other people?</label>
                                <textarea class="form-control" name="reflectionPersonal"><?=$input["reflectionPersonal"]?></textarea>
                            </div>

                            <div class="row mb-5">
                                <label>3. How do you see yourself walking with Jesus through this reach out?</label>
                                <textarea class="form-control" name="reflectionJesus"><?=$input["reflectionJesus"]?></textarea>
                            </div>

                            <h4 class="mb-5">Proposal Video</h4>
                            
                            <div class="row mb-5">
                                <label>Submit a creative proposal in form of a video:- song/dance/sketch/animation/anything which can creatively...</label>
                                <div class="col-12 mb-5">
                                    <ol>
                                        <li>serve as a tool to encourage other young people to reach out.</li>
                                        <li>describe the reach-out in a non-formal way & easily understood way.</li>
                                        <li>fun and attractive.</li>
                                        <li>more than 1 minute and less than 3 minutes.</li>
                                    </ol>
                                </div>        
                            
                                <label>Please provide a YouTube link for the video:</label>
                                <input type="text" name="videoLink" class="form-control" value="<?=$input["videoLink"]?>">
                            </div>

                            <div class="row justify-content-around mb-5">
                                <div class="col-4 col-lg-3"><button type="submit" name="save" value="submit" class="btn btn-warning w-100">Save</button></div>
                                <div class="col-4 col-lg-3"><button type="submit" name="submit" value="submit" class="btn btn-success w-100">Submit</button></div>
                            </div>

                        </form>
                    </div>
                <?php $j++; endforeach;?>
            </div>
        </div>
    </div>
        
    
  </div>
  <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
    <form action="" method="POST" id="changePassword">
        <input type="hidden" name="form" value="changepassword">

        <h4 class="my-5">Change Password</h4>
        
        <div class="row mb-5">
            <label>New Password</label>
            <input type="password" name="new" class="form-control" placeholder="8-15 characters">
        </div>
        <div class="row mb-5">
            <label>Repeat New Password</label>
            <input type="password" name="new2" class="form-control">
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-4"><button type="submit" class="w-100 btn btn-primary">Change</button></div>
        </div>

    </form>
  </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="error-title">Login Failed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <p id="error-body">Wrong . Please try again.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<script src="css/rog_user.js"></script>
<?php include "templates/footer.html" ?>