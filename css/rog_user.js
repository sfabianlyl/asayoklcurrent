$(document).ready(function(){

    $("#addMember").on("click",function(){
        var num=$(".flex-table>div.row").length;
        var cloneRow=$(".member-detail").first().clone();
        cloneRow.find("input").val("");
        cloneRow.find("select").val("Member");
        cloneRow.find("select").on("change",clearLeader);
        cloneRow.find("div.row-num").text(num);
        $(".flex-table").append(cloneRow);
    });

    $("#changePassword").on("submit",function(e){
        e.preventDefault();
        if($("input[name='new']").val()!=$("input[name='new2']").val()){
            showMessage("Error","Passwords do not match.");
            return false;
        }

        if(!(/^[0-9a-zA-Z@$!%*#?&]{8,15}$/g.test($("input[name='new']").val()))){
            showMessage("Error","Password should be between 8 to 15 characters");
            return false;
        }

        this.submit();
    })

    $("select[name='membership[]']").on("change",clearLeader);
});

function showMessage(title,message){
    $("#error-title").text(title);
    $("#error-body").text(message);
    $("#statusModal").modal("show");
}

function clearLeader(){
    var value=$(this).val();
    if(value!="Member"){
        $("select[name='membership[]'] option:contains('"+value+"'):selected").parent().val("Member");
        $(this).val(value);
    }
}