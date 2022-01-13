function showEng(){
    $(".bm").removeClass("show");
    $("#bm, #eng").addClass("disabled");
    setTimeout(function(){
        $(".bm").hide();
        $(".eng").show();
        $(".eng").addClass("show");
        $("#bm").removeClass("disabled");
    },610);
    Cookies.set('lang','eng', { expires: 30 });
}

function showBm(){
    $(".eng").removeClass("show");
    $("#bm, #eng").addClass("disabled");
    setTimeout(function(){
        $(".eng").hide();
        $(".bm").show();
        $(".bm").addClass("show");
        $("#eng").removeClass("disabled");
    },610);
    Cookies.set('lang','bm', { expires: 30 });
}

function scrollTo(sel){
    var offset=$(sel).offset();
    offset.left-=20;
    offset.top-=170;
    $("html,body").animate({
        scrollTop:offset.top,
        scrollLeft:offset.left
    });
}

$(document).ready(function(){
    mobileUpdate();

    $(window).on('resize', function() {
        mobileUpdate();
    });


    var lang=Cookies.get('lang');
    if(lang==undefined || lang=="eng"){
        showEng();
    }else{
        showBm();
    }

    
    $("#bm").on("click",showBm);

    $("#eng").on("click",showEng);

    $("#control-nationality").change(function() { //if nationality is not malaysian, ask for origin country
        if ($(this).val() == "Malaysian Citizen") {
            $('#controlled-origin-state').show();
            $('#controlled-origin-state select').attr('required','');
            $('#controlled-origin-state select').attr('data-error','This field is required');

            $('#controlled-origin-diocese').show();
            $('#controlled-origin-diocese').attr('required', '');
            $('#controlled-origin-diocese').attr('data-error', 'This field is required.');

            $('#controlled-origin-country').hide();
            $('#controlled-origin-country input').removeAttr('required');
            $('#controlled-origin-country input').removeAttr('data-error');
            $('#controlled-origin-country input').val("");
            $('#controlled-origin-country input').attr("value","");

            $('#controlled-origin-diocese2').hide();
            $('#controlled-origin-diocese2').removeAttr('required');
            $('#controlled-origin-diocese2').removeAttr('data-error');
            $('#controlled-origin-diocese2').val("");

            $('#controlled-origin-diocese-sbh').hide();
            $('#controlled-origin-diocese-sbh').removeAttr('required');
            $('#controlled-origin-diocese-sbh').removeAttr('data-error');
            $('#controlled-origin-diocese-sbh').val("");

            $('#controlled-origin-diocese-swk').hide();
            $('#controlled-origin-diocese-swk').removeAttr('required');
            $('#controlled-origin-diocese-swk').removeAttr('data-error');
            $('#controlled-origin-diocese-swk').val("");

        } else {
            
            $('#controlled-origin-country').show();
            $('#controlled-origin-country input').attr('required', '');
            $('#controlled-origin-country input').attr('data-error', 'This field is required.');

            $('#controlled-origin-diocese2').show();
            $('#controlled-origin-diocese2').attr('required', '');
            $('#controlled-origin-diocese2').attr('data-error', 'This field is required.');

            $('#controlled-origin-state').hide();
            $('#controlled-origin-state select').removeAttr('required');
            $('#controlled-origin-state select').removeAttr('data-error');
            $('#controlled-origin-state select').val("");
            

            $('#controlled-origin-diocese').hide();
            $('#controlled-origin-diocese').removeAttr('required');
            $('#controlled-origin-diocese').removeAttr('data-error');
            $('#controlled-origin-diocese').val("");

            $('#controlled-origin-diocese-sbh').hide();
            $('#controlled-origin-diocese-sbh').removeAttr('required');
            $('#controlled-origin-diocese-sbh').removeAttr('data-error');
            $('#controlled-origin-diocese-sbh').val("");

            $('#controlled-origin-diocese-swk').hide();
            $('#controlled-origin-diocese-swk').removeAttr('required');
            $('#controlled-origin-diocese-swk').removeAttr('data-error');
            $('#controlled-origin-diocese-swk').val("");

            

        }
    });
    $("#control-nationality").trigger("change");
      $("#controlled-origin-state select").change(function(){
            
            switch($(this).val()){
                case "Selangor":
                case "Kuala Lumpur":
                case "Putrajaya":
                case "Negeri Sembilan":
                case "Terengganu":
                case "Pahang": 
                    $('#controlled-origin-diocese').show();
                    $('#controlled-origin-diocese').attr('required', '');
                    $('#controlled-origin-diocese').attr('data-error', 'This field is required.');
                    $('#controlled-origin-diocese').val("Keuskupan Agung Kuala Lumpur"); 
                    $('#controlled-origin-diocese').attr("value","Keuskupan Agung Kuala Lumpur"); 
                    $("#controlled-origin-diocese").trigger("change");

                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");
                    
                    $('#controlled-origin-diocese-swk').hide();
                    $('#controlled-origin-diocese-swk').removeAttr('required');
                    $('#controlled-origin-diocese-swk').removeAttr('data-error');
                    $('#controlled-origin-diocese-swk').val("");

                    $('#controlled-origin-diocese-sbh').hide();
                    $('#controlled-origin-diocese-sbh').removeAttr('required');
                    $('#controlled-origin-diocese-sbh').removeAttr('data-error');
                    $('#controlled-origin-diocese-sbh').val("");

                    $("#controlled-origin-diocese").trigger("change");
                    break;

                case "Kelantan":
                case "Pulau Pinang":
                case "Kedah":
                case "Perak":
                case "Perlis": 
                $('#controlled-origin-diocese').show();
                    $('#controlled-origin-diocese').attr('required', '');
                    $('#controlled-origin-diocese').attr('data-error', 'This field is required.');
                    $('#controlled-origin-diocese').val("Keuskupan Pinang"); 
                    $('#controlled-origin-diocese').attr("value","Keuskupan Pulau Pinang"); 
                    $("#controlled-origin-diocese").trigger("change");

                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");
                    
                    $('#controlled-origin-diocese-swk').hide();
                    $('#controlled-origin-diocese-swk').removeAttr('required');
                    $('#controlled-origin-diocese-swk').removeAttr('data-error');
                    $('#controlled-origin-diocese-swk').val("");

                    $('#controlled-origin-diocese-sbh').hide();
                    $('#controlled-origin-diocese-sbh').removeAttr('required');
                    $('#controlled-origin-diocese-sbh').removeAttr('data-error');
                    $('#controlled-origin-diocese-sbh').val("");

                    $("#controlled-origin-diocese").trigger("change");
                    break;

                case "Melaka":
                case "Johor": 
                    $('#controlled-origin-diocese').show();
                    $('#controlled-origin-diocese').attr('required', '');
                    $('#controlled-origin-diocese').attr('data-error', 'This field is required.');
                    $('#controlled-origin-diocese').val("Keuskupan Melaka Johor"); 
                    $('#controlled-origin-diocese').attr("value","Keuskupan Melaka Johor"); 

                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");

                    $('#controlled-origin-diocese-swk').hide();
                    $('#controlled-origin-diocese-swk').removeAttr('required');
                    $('#controlled-origin-diocese-swk').removeAttr('data-error');
                    $('#controlled-origin-diocese-swk').val("");

                    $('#controlled-origin-diocese-sbh').hide();
                    $('#controlled-origin-diocese-sbh').removeAttr('required');
                    $('#controlled-origin-diocese-sbh').removeAttr('data-error');
                    $('#controlled-origin-diocese-sbh').val("");

                    $("#controlled-origin-diocese").trigger("change");
                    break;
                case "Labuan":
                    $('#controlled-origin-diocese').show();
                    $('#controlled-origin-diocese').attr('required', '');
                    $('#controlled-origin-diocese').attr('data-error', 'This field is required.');
                    $('#controlled-origin-diocese').val("Keuskupan Agung Kota Kinabalu"); 
                    $('#controlled-origin-diocese').attr("value","Keuskupan Agung Kota Kinabalu");
    
                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");

                    $('#controlled-origin-diocese-swk').hide();
                    $('#controlled-origin-diocese-swk').removeAttr('required');
                    $('#controlled-origin-diocese-swk').removeAttr('data-error');
                    $('#controlled-origin-diocese-swk').val("");

                    $('#controlled-origin-diocese-sbh').hide();
                    $('#controlled-origin-diocese-sbh').removeAttr('required');
                    $('#controlled-origin-diocese-sbh').removeAttr('data-error');
                    $('#controlled-origin-diocese-sbh').val("");

                    $("#controlled-origin-diocese").trigger("change");
                    break;
                case "Sabah":
                    $('#controlled-origin-diocese').hide();
                    $('#controlled-origin-diocese').removeAttr('required');
                    $('#controlled-origin-diocese').removeAttr('data-error');
                    $('#controlled-origin-diocese').val("");

                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");

                    $('#controlled-origin-diocese-swk').hide();
                    $('#controlled-origin-diocese-swk').removeAttr('required');
                    $('#controlled-origin-diocese-swk').removeAttr('data-error');
                    $('#controlled-origin-diocese-swk').val("");

                    $('#controlled-origin-diocese-sbh').show();
                    $('#controlled-origin-diocese-sbh').attr('required','');
                    $('#controlled-origin-diocese-sbh').attr('data-error','This field is required');
                    $("#controlled-origin-diocese").trigger("change");
                    break;

                case "Sarawak":
                    $('#controlled-origin-diocese').hide();
                    $('#controlled-origin-diocese').removeAttr('required');
                    $('#controlled-origin-diocese').removeAttr('data-error');
                    $('#controlled-origin-diocese').val("");

                    $('#controlled-origin-diocese2').hide();
                    $('#controlled-origin-diocese2').removeAttr('required');
                    $('#controlled-origin-diocese2').removeAttr('data-error');
                    $('#controlled-origin-diocese2').val("");

                    $('#controlled-origin-diocese-sbh').hide();
                    $('#controlled-origin-diocese-sbh').removeAttr('required');
                    $('#controlled-origin-diocese-sbh').removeAttr('data-error');
                    $('#controlled-origin-diocese-sbh').val("");

                    $('#controlled-origin-diocese-swk').show();
                    $('#controlled-origin-diocese-swk').attr('required','');
                    $('#controlled-origin-diocese-swk').attr('data-error','This field is required');
                    $("#controlled-origin-diocese").trigger("change");
                    break;
          }
      });
      $("#controlled-origin-state select").trigger("change");
    $("#controlled-origin-diocese").change(function() { //if controlled-origin-diocese is KL, ask for select parish
        if ($(this).val() == "Keuskupan Agung Kuala Lumpur") {
            $('#controlled-origin-parish2').hide();
            $('#controlled-origin-parish2').removeAttr('required');
            $('#controlled-origin-parish2').removeAttr('data-error');
            $('#controlled-origin-parish2').val("");
            
            $('#controlled-origin-parish').show();
            $('#controlled-origin-parish').attr('required', '');
            $('#controlled-origin-parish').attr('data-error', 'This field is required.');

        } else {
            
            $('#controlled-origin-parish2').show();
            $('#controlled-origin-parish2').attr('required', '');
            $('#controlled-origin-parish2').attr('data-error', 'This field is required.');

            $('#controlled-origin-parish').hide();
            $('#controlled-origin-parish').removeAttr('required');
            $('#controlled-origin-parish').removeAttr('data-error');
            $('#controlled-origin-parish').val("");

        }
    });
    $("#controlled-origin-diocese").trigger("change");

    $("#control-migrate-country").change(function() { //if migrate country is Malaysia is KL, ask for select state, and diocese
        if ($(this).val() == "Malaysia") {
            
            
            $('#controlled-migrate-diocese').show();
            $('#controlled-migrate-diocese select').attr('required', '');
            $('#controlled-migrate-diocese select').attr('data-error', 'This field is required.');

            $('#controlled-migrate-state').show();
            $('#controlled-migrate-state select').attr('required', '');
            $('#controlled-migrate-state select').attr('data-error', 'This field is required.');

        } else {

            $('#controlled-migrate-diocese').hide();
            $('#controlled-migrate-diocese select').removeAttr('required');
            $('#controlled-migrate-diocese select').removeAttr('data-error');
            $('#controlled-migrate-diocese select').val("");

            $('#controlled-migrate-state').hide();
            $('#controlled-migrate-state input').removeAttr('required');
            $('#controlled-migrate-state input').removeAttr('data-error');
            $('#controlled-migrate-state input').val("");

        }
    });
    $("#control-migrate-country").trigger("change");

    $("#controlled-migrate-state select").change(function(){
            
        switch($(this).val()){
            case "Selangor":
            case "Kuala Lumpur":
            case "Putrajaya":
            case "Negeri Sembilan":
            case "Terengganu":
            case "Pahang": 
                $('#controlled-migrate-diocese input').show();
                $('#controlled-migrate-diocese input').attr('required', '');
                $('#controlled-migrate-diocese input').attr('data-error', 'This field is required.');
                $('#controlled-migrate-diocese input').val("Keuskupan Agung Kuala Lumpur"); 
                $('#controlled-migrate-diocese input').attr("value","Keuskupan Agung Kuala Lumpur"); 
                $("#controlled-migrate-diocese input").trigger("change");
                
                $('#controlled-migrate-diocese-swk').hide();
                $('#controlled-migrate-diocese-swk').removeAttr('required');
                $('#controlled-migrate-diocese-swk').removeAttr('data-error');
                $('#controlled-migrate-diocese-swk').val("");

                $('#controlled-migrate-diocese-sbh').hide();
                $('#controlled-migrate-diocese-sbh').removeAttr('required');
                $('#controlled-migrate-diocese-sbh').removeAttr('data-error');
                $('#controlled-migrate-diocese-sbh').val("");

                $("#controlled-migrate-diocese input").trigger("change");
                break;

            case "Kelantan":
            case "Pulau Pinang":
            case "Kedah":
            case "Perak":
            case "Perlis": 
                $('#controlled-migrate-diocese input').show();
                $('#controlled-migrate-diocese input').attr('required', '');
                $('#controlled-migrate-diocese input').attr('data-error', 'This field is required.');
                $('#controlled-migrate-diocese input').val("Keuskupan Pulau Pinang"); 
                $('#controlled-migrate-diocese input').attr("value","Keuskupan Pulau Pinang"); 
                $("#controlled-migrate-diocese input").trigger("change");

                $('#controlled-migrate-diocese-swk').hide();
                $('#controlled-migrate-diocese-swk').removeAttr('required');
                $('#controlled-migrate-diocese-swk').removeAttr('data-error');
                $('#controlled-migrate-diocese-swk').val("");

                $('#controlled-migrate-diocese-sbh').hide();
                $('#controlled-migrate-diocese-sbh').removeAttr('required');
                $('#controlled-migrate-diocese-sbh').removeAttr('data-error');
                $('#controlled-migrate-diocese-sbh').val("");

                $("#controlled-migrate-diocese input").trigger("change");
                break;

            case "Melaka":
            case "Johor": 
                $('#controlled-migrate-diocese input').show();
                $('#controlled-migrate-diocese input').attr('required', '');
                $('#controlled-migrate-diocese input').attr('data-error', 'This field is required.');
                $('#controlled-migrate-diocese input').val("Keuskupan Melaka Johor"); 
                $('#controlled-migrate-diocese input').attr("value","Keuskupan Melaka Johor"); 

                $('#controlled-migrate-diocese-swk').hide();
                $('#controlled-migrate-diocese-swk').removeAttr('required');
                $('#controlled-migrate-diocese-swk').removeAttr('data-error');
                $('#controlled-migrate-diocese-swk').val("");

                $('#controlled-migrate-diocese-sbh').hide();
                $('#controlled-migrate-diocese-sbh').removeAttr('required');
                $('#controlled-migrate-diocese-sbh').removeAttr('data-error');
                $('#controlled-migrate-diocese-sbh').val("");

                $("#controlled-migrate-diocese input").trigger("change");
                break;
            
            case "Labuan":
                $('#controlled-migrate-diocese input').show();
                $('#controlled-migrate-diocese input').attr('required', '');
                $('#controlled-migrate-diocese input').attr('data-error', 'This field is required.');
                $('#controlled-migrate-diocese input').val("Keuskupan Agung Kota Kinabalu"); 
                $('#controlled-migrate-diocese input').attr("value","Keuskupan Agung Kota Kinabalu"); 

                $('#controlled-migrate-diocese-swk').hide();
                $('#controlled-migrate-diocese-swk').removeAttr('required');
                $('#controlled-migrate-diocese-swk').removeAttr('data-error');
                $('#controlled-migrate-diocese-swk').val("");

                $('#controlled-migrate-diocese-sbh').hide();
                $('#controlled-migrate-diocese-sbh').removeAttr('required');
                $('#controlled-migrate-diocese-sbh').removeAttr('data-error');
                $('#controlled-migrate-diocese-sbh').val("");

                $("#controlled-migrate-diocese input").trigger("change");
                break;

            case "Sabah":
                $('#controlled-migrate-diocese input').hide();
                $('#controlled-migrate-diocese input').removeAttr('required');
                $('#controlled-migrate-diocese input').removeAttr('data-error');
                $('#controlled-migrate-diocese input').val("");

                $('#controlled-migrate-diocese-swk').hide();
                $('#controlled-migrate-diocese-swk').removeAttr('required');
                $('#controlled-migrate-diocese-swk').removeAttr('data-error');
                $('#controlled-migrate-diocese-swk').val("");

                $('#controlled-migrate-diocese-sbh').show();
                $('#controlled-migrate-diocese-sbh').attr('required','');
                $('#controlled-migrate-diocese-sbh').attr('data-error','This field is required');
                $("#controlled-migrate-diocese").trigger("change");
                break;

            case "Sarawak":
                $('#controlled-migrate-diocese input').hide();
                $('#controlled-migrate-diocese input').removeAttr('required');
                $('#controlled-migrate-diocese input').removeAttr('data-error');
                $('#controlled-migrate-diocese input').val("");

                $('#controlled-migrate-diocese-sbh').hide();
                $('#controlled-migrate-diocese-sbh').removeAttr('required');
                $('#controlled-migrate-diocese-sbh').removeAttr('data-error');
                $('#controlled-migrate-diocese-sbh').val("");

                $('#controlled-migrate-diocese-swk').show();
                $('#controlled-migrate-diocese-swk').attr('required','');
                $('#controlled-migrate-diocese-swk').attr('data-error','This field is required');
                $("#controlled-migrate-diocese input").trigger("change");
                break;
      }
  });
  $("#controlled-migrate-state select").trigger("change");

    $("#control-purpose").change(function() { //if migrate country is Malaysia is KL, ask for select diocese
        if ($(this).val() == "Pembelajaran") {
            
            
            $('#controlled-campus-field').show();
            $('#controlled-campus-field input').each(function(){
                $(this).attr('required', '');
                $(this).attr('data-error', 'This field is required.');
            });

            $('#controlled-organisation-occupation').hide();

            $('#controlled-organisation-occupation input').each(function(){
                $(this).removeAttr('required');
                $(this).removeAttr('data-error');
                $(this).val("");
            });


        } else {

            $('#controlled-organisation-occupation').show();
            $('#controlled-organisation-occupation input').each(function(){
                $(this).attr('required', '');
                $(this).attr('data-error', 'This field is required.');
            });

            $('#controlled-campus-field').hide();
            $('#controlled-campus-field input').each(function(){
                $(this).removeAttr('required');
                $(this).removeAttr('data-error');
                $(this).val("");
            });

        }
    });
    $("#control-purpose").trigger("change");

    $(".ftn").click(function($e){
        $e.preventDefault();
        var id=$(this).attr("id");
        var test=id.split("-")[0];
        var num=id.split("-")[1];
        if(test=="tn"){
            var target="#ftn-";
        }else{
            var target="#tn-";
        }
        target+=num;
        $(target)[0].scrollIntoView();
        window.scrollBy(0, -120);
    });

    $('.collapse').on('shown.bs.collapse', function(e) {
        var $panel = $(this).closest('.card');
        $('html,body').animate({
          scrollTop: $panel.offset().top - 120
        }, 100);
      });
      
    $(".rog .nav-link[data-toggle='tab']").click(function(){
        $(".nav-link").parent().css({opacity:0.5});
        $(this).parent().css({opacity:1});
    });
    $(window).on('load', function() {
        $(".rog .active").parent().css({opacity:1});
    });
    
    

    $("input[type='radio'][name='program'][value='scripture']").attr("checked","");
    $("input[type='radio'][name='location'][value='KL']").attr("checked","");
    
    $("input[type='radio'][name='location']").on("change",function(){
        $(".program-dates").hide("slow");
        var idDates="#"+$(this).val()+"Dates";
        $(idDates).show("slow");
    });
    $(".program-dates").hide();
    $("#KLDates").show("slow");
   
    $("#nationalityOthers").on("keyup",function(){
        $("input[type='radio'][name='nationality']").removeAttr("checked");
        $("input[type='radio'][name='nationality']").prop("checked",false);
        if(this.value){
            $("#radioOthers").prop("checked",true);
            $("#radioOthers").val(this.value);
        }else{
            $("#radioMalaysia").prop("checked",true);
        }
        $("#radioMalaysia, #radioOthers").trigger("change");
    });
    $("select[name='diocese']").on("change",function(){
        $("#parishOthers, #parishKL").prop("disabled",true);
        $("#parishOthers, #parishKL").prop("required",false);
        $("#parishOthers, #parishKL").css("display","none");
        if(this.value =="Keuskupan Agung Kuala Lumpur"){
            $("#parishKL").prop("disabled",false);
            $("#parishKL").prop("required",true);
            $("#parishKL").css("display","block");
        }else{
            $("#parishOthers").prop("disabled",false);
            $("#parishOthers").prop("required",true);
            $("#parishOthers").css("display","block");
        }
    });
    
     $(".navbar-toggler").on("click", function(){ 
         $("#navbarCollapse").toggleClass("show");
         $(this).toggleClass("collapsed");
     });

     $("#contact, #contactCloseBtn").on("click", function(){
         $(".contact-modal").toggleClass("contact-modal-show");
     })
     
     $("#myform").on("submit", function(e){
         if(/\d/.test($("input[name='name']").val())){
             alert("Please do not put digits in the name field.");
            scrollTo("input[name='name']");
             return false;

         }
         if($("input[name='language[]']").length > 0){
             if ($('input[name="language[]"]:checked, input[name="slot"]:checked').length > 0){
                 $("#myform").submit();
             }else{
                 alert("Please check at least one session.");
                 return false;
             }
         }else{
             $("#myform").submit();
         }
     });
}); 

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

function scroll(){
    alert($(this).attr("id"));
    var id= this.id;
}

function mobileUpdate(){
    var viewportWidth = $(window).width();
    if (viewportWidth <= 768) $("#tab-navigate").removeClass("flex-column").addClass("nav-tabs");
    else $("#tab-navigate").removeClass("nav-tabs").addClass("flex-column");
}

