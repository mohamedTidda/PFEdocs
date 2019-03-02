$(function(){
     'use strict'; 
  //===================== start function to hide placeholder on focus in it ==================
  $('[placeholder]').focus(function () {
    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this).attr('placeholder', '');
  }).blur(function () {
    $(this).attr('placeholder', $(this).attr('data-text'));
  });
//===================== end function to hide placeholder on focus in it ================
$(window).bind("resize", function (){
  //console.log($(this).width());
  if($(this).width() < 751 ){
     $('.make-it-float').removeClass('float-r');
   }else{
     $('.make-it-float').addClass('float-r');
   }
});
//======================start add asterisk(*) on required field=============================
  $('input').each(function(){
      if ($(this).attr('required') === 'required') {
        $(this).after('<span class="asterisk">*</span>');
      }
  });
    $('input').each(function(){
      if ($(this).attr('data-id') === 'req') {
         $('span').addClass('star');
      }
  });
//======================and add asterisk(*) on required field===============================
// ========start convert password field to text field on hover ==============================
  var passField = $('.password');
  $('.show-pass').hover(function () {
    passField.attr('type', 'text');
  },function () {
    passField.attr('type', 'password');
  });
// ========end convert password field to text field on hover ================
//====== start function to show and hide the modal form ==================
 $('.add-doctor').click(function(){
   $('.modal-d').modal();
 });
 $('.add-ph').click(function(){
   $('.modal-ph').modal();
 });
 $('.add-patient').click(function(){
   $('.modal-p').modal();
 });
//====== end function to show and hide the modal form =================================
//===== start function reload doctor page when close the modal===========
$('.btn-close').click(function (){
   location.reload(); // then reload the page
});
//===== end function reload doctor page when close the modal===========
//========start delete doctor==============================================
$('.confirm').on("click", function(e){
  var answer = confirm("Are you sure want to delete?");
  if(answer){
      var D_id = $(this).attr("data-id");
     console.log(D_id);
     $.post("manage.php?do=delete", { Did:D_id, col:"D_id", table:"doctors"}).done(function(data){
     var result = $.trim(data);
     console.log(result);
     if(result == "deleted"){
           $(".deleted-success").text("deleted successfuly");
           $(".deleted-success").removeClass('hidden');
           $(".deleted-success:visible").fadeOut(5000);
           $('.'+D_id).addClass('hidden');
            setTimeout(function(){
             location.reload();
            },4000);
        //console.log('good');
      }else{
       //console.log('bad');
      }
    });
  }else{
    console.log('stop');
  }
});
//========end delete doctor==============================================

//========start delete pharmacy==============================================
$('.confirm1').on("click", function(e){
  var answer = confirm("Are you sure want to delete?");
  if(answer){
      var ph_id = $(this).attr("data-id");
     console.log(ph_id);
     $.post("manage.php?do=delete", { Did:ph_id, col:"ph_id", table:"pharmacy"}).done(function(data){
     var result = $.trim(data);
     console.log(result);
     if(result == "deleted"){
           $(".deleted-success").text("deleted successfuly");
           $(".deleted-success").removeClass('hidden');
           $(".deleted-success:visible").fadeOut(5000);
           $('.'+ph_id).addClass('hidden');
            setTimeout(function(){
             location.reload();
            },4000);
        //console.log('good');
      }else{
       //console.log('bad');
      }
    });
  }else{
    console.log('stop');
  }
});
//============================end delete pharmacy==============================================
//========================== Start delete patient from doctor's List====================
$('.confirm2').on("click", function(e){
  var answer = confirm("Are you sure want to delete this patient ?");
  if(answer){
      var r_id = $(this).attr("data-id");
     console.log(r_id);
     $.post("manage.php?do=delete", { id:r_id, col:"pOd_id", table:"patientofdoctor"}).done(function(data){
     var result = $.trim(data);
     console.log(result);
     if(result == "deleted"){
           $(".deleted-success").text("deleted successfuly");
           $(".deleted-success").removeClass('hidden');
           $(".deleted-success:visible").fadeOut(5000);
           $('.'+r_id).addClass('hidden');
            setTimeout(function(){
             location.reload();
            },4000);
        //console.log('good');
      }else{
       //console.log('bad');
      }
    });
  }else{
    console.log('stop');
  }
});
//========================== End delete patient from doctor's List====================
//=====================start add new doctor in DB ======================================
$('.addForm').on("submit", function(e){
  e.preventDefault();
    var errors = false
  var name=$('.name').val();
  if (!/\S/.test(name)){ //check if the name field is not empty or just contains whitespaces
      $('.nameError').text("Name should not be empty or contains whitespaces only ");
      $(".nameError").removeClass('hidden');
      errors=true;
  }else if(!/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(name)){//check if name contains only letters and spaces
    $('.nameError').text("Name should contains only letters");
    $(".nameError").removeClass('hidden');
    errors=true;
  }else{
    $(".nameError").addClass('hidden');
  }
     //check if the password field is not empty or just contains whitespaces
   if (!/\S/.test($('.password').val())){
        $('.passwordError').text("password should not be empty");
      $(".passwordError").removeClass('hidden');
      errors=true;
  }else{
     $(".passwordError").addClass('hidden');
  }
   //check if the adress field is not empty or just contains whitespaces
   if (!/\S/.test($('.adress').val())){
        $('.adressError').text("adress should not be empty");
      $(".adressError").removeClass('hidden');
      errors=true;
  }else{
     $(".adressError").addClass('hidden');
  }
   //check if the office field is not empty or just contains whitespaces
   if (!/\S/.test($('.office').val())){
        $('.officeError').text("office should not be empty");
      $(".officeError").removeClass('hidden');
      errors=true;
  }else{
     $(".officeError").addClass('hidden');
  }
    //check if the phone field is not empty or just contains whitespaces
   if (!/\S/.test($('.phone').val())){
        $('.phoneError').text("phone should not be empty");
      $(".phoneError").removeClass('hidden');
      errors=true;
  }else{
     $(".phoneError").addClass('hidden');
  }
  if(errors==false){
         $.post("manage.php?do=checkName", 
          { name: $(".name").val(), col: "D_name", table: "doctors" }).done(function(data) {
           var result1 = $.trim(data);
           console.log(result1);
           if(result1 == "exist"){
              $(".nameError").text("This name is already registered with us. choose different name.");
              $(".nameError").removeClass('hidden');
            }else{
             $(".nameError").addClass('hidden');
                    $.post("manage.php?do=addDoctor", $(".addForm").serialize()).done(function(data) {
                    var result=$.trim(data);
                    console.log(data);
                      if(result == "inserted") {
                           //console.log('good');
                           $('input').val("");
                          $(".updated-success").removeClass('hidden');
                          $(".updated-success:visible").fadeOut(5000);
                      }else{
                        console.log('bad');
                      }
              });
            }

      });

  }
});
//=====================end add new doctor in DB =======================================
//=====================start validate doctors edite form =======================================
$('.editForm').on("submit", function(e){
  e.preventDefault();
  var errors = false
  var name=$('.name').val();
  if (!/\S/.test(name)){ //check if the name field is not empty or just contains whitespaces
      $('.nameError').text("Name should not be empty or contains whitespaces only ");
      $(".nameError").removeClass('hidden');
      errors=true;
  }else if(!/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(name)){//check if name contains only letters and spaces
    $('.nameError').text("Name should contains only letters");
    $(".nameError").removeClass('hidden');
    errors=true;
  }else{
    $(".nameError").addClass('hidden');
  }
   //check if the name field is not empty or just contains whitespaces
   if (!/\S/.test($('.adress').val())){
        $('.adressError').text("adress should not be empty");
      $(".adressError").removeClass('hidden');
      errors=true;
  }else{
     $(".adressError").addClass('hidden');
  }
   //check if the name field is not empty or just contains whitespaces
   if (!/\S/.test($('.office').val())){
        $('.officeError').text("office should not be empty");
      $(".officeError").removeClass('hidden');
      errors=true;
  }else{
     $(".officeError").addClass('hidden');
  }
    //check if the name field is not empty or just contains whitespaces
   if (!/\S/.test($('.phone').val())){
        $('.phoneError').text("phone should not be empty");
      $(".phoneError").removeClass('hidden');
      errors=true;
  }else{
     $(".phoneError").addClass('hidden');
  }
  //check there'are no errors adn send the information
  if(errors==false){
          $.post("manage.php?do=checkName",
           { name: $(".name").val(),col: "D_name", table: "doctors"}).done(function(data) {
           var result1 = $.trim(data);
           console.log(result1);
           if(result1 == "exist"){
              $(".nameError").text("This name is already registered with us. choose different name.");
              $(".nameError").removeClass('hidden');
            }else{
             $(".nameError").addClass('hidden');
             $.post("manage.php?do=updateDoctor", $(".editForm").serialize()).done(function(data) {
                    var result=$.trim(data);
                    console.log(data);
                      if(result == "updated") {
                           //console.log('good');
                               setTimeout(function(){
                               location.reload();
                               },4000);
                          $(".updated-success").removeClass('hidden');
                          $(".updated-success:visible").fadeOut(5000);
                      }else{
                        console.log('bad');
                      }
              });  
            }

      });
  }
});
//=====================end validate doctors edite form =======================================
/*========================Start frontend validation ============================================
  ==============================================================================================*/
//===================start login error checking ===========================================================

$(".login-form").on("submit", function(e) {
    e.preventDefault();
    var errors = false;
    var type= $('.selector').val(),
        name= $('.user').val(),
        pass=$('.pass').val() ;
       if (!/\S/.test(name)){ //check if the name field is not empty or just contains whitespaces
         $('.nameError').text("Name should not be empty");
         $(".nameError").removeClass('hidden');
          errors=true;
        }else{
          $(".nameError").addClass('hidden');
        }
       if (!/\S/.test(pass)){ //check if the password field is not empty or just contains whitespaces
         $('.passError').text("Password should not be empty");
         $(".passError").removeClass('hidden');
          errors=true;
       }else{
          $(".passError").addClass('hidden');
       }
     if(type==="0"){//check if the type field is empty
      $('.typeError').text("you have to choose your type acount");
      $(".typeError").removeClass('hidden');
      errors=true;
     }else{
        $(".typeError").addClass('hidden');
     }
     if(errors==false){
        $.post("manage.php?do=ckeckUser", $(".login-form").serialize() ).done(function(data) {
            var result = $.trim(data);
            console.log(result);
            if(result == "user_exist") {
              window.location.href = type+".php";
              console.log(result);
            } else {
                $('.loginError').text("Invalid name\\password. try again.");
                $(".loginError").removeClass('hidden');
              console.log(result);
            }
          });
     }
  });
//===================end  login error checking =========================================
//===================start validate the form to edit patient============================

$(".p-editForm").on("submit", function(e){
e.preventDefault();
  var errors = false
  var name=$('.name').val();
  if (!/\S/.test(name)){ //check if the name field is not empty or just contains whitespaces
      $('.nameError').text("Name should not be empty or contains whitespaces only ");
      $(".nameError").removeClass('hidden');
      console.log('bad');
      errors=true;
  }else if(!/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(name)){//check if name contains only letters and spaces
    $('.nameError').text("Name should contains only letters");
    $(".nameError").removeClass('hidden');
    errors=true;
  }else{
    $(".nameError").addClass('hidden');
  }
   //check if the name field is not empty or just contains whitespaces
   if (!/\S/.test($('.adress').val())){
        $('.adressError').text("adress should not be empty");
      $(".adressError").removeClass('hidden');
      errors=true;
  }else{
     $(".adressError").addClass('hidden');
  }
    //check if the name field is not empty or just contains whitespaces
   if (!/\S/.test($('.phone').val())){
        $('.phoneError').text("phone should not be empty");
      $(".phoneError").removeClass('hidden');
      errors=true;
  }else{
     $(".phoneError").addClass('hidden');
  }
  if(errors==false){
  $.post("manage.php?do=checkName", 
          { name: $(".name").val(), col: "p_name", table: "patients"}).done(function(data){
            var result1 = $.trim(data);
           //console.log(result1);
              if(result1 == "exist"){
              $(".nameError").text("This name is already registered with us. choose different name.");
              $(".nameError").removeClass('hidden');
            }else{
              $(".nameError").addClass('hidden');
              $.post("manage.php?do=updatepatient", $(".p-editForm").serialize()).done(function(data) {
                     var result=$.trim(data);
                     console.log(data);
                      if(result == "updated-p"){
                               setTimeout(function(){
                               location.reload();
                               },4000);
                          $(".updated-success").removeClass('hidden');
                          $(".updated-success:visible").fadeOut(5000);  
                      }else{
                            console.log('bad');
                      }
               });
            }

          });
  } 
});
//===================end validate the form to edit patient============================
//=============================Start add new patient =============================
$('.addForm-p').on("submit", function(e){
    e.preventDefault();
    var errors = false
  var name=$('.name').val();
  if (!/\S/.test(name)){ //check if the name field is not empty or just contains whitespaces
      $('.nameError').text("Name should not be empty or contains whitespaces only ");
      $(".nameError").removeClass('hidden');
      errors=true;
  }else if(!/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(name)){//check if name contains only letters and spaces
    $('.nameError').text("Name should contains only letters");
    $(".nameError").removeClass('hidden');
    errors=true;
  }else{
    $(".nameError").addClass('hidden');
  }
     //check if the password field is not empty or just contains whitespaces
   if (!/\S/.test($('.password').val())){
        $('.passwordError').text("password should not be empty");
      $(".passwordError").removeClass('hidden');
      errors=true;
  }else{
     $(".passwordError").addClass('hidden');
  }
   //check if the adress field is not empty or just contains whitespaces
   if (!/\S/.test($('.adress').val())){
        $('.adressError').text("adress should not be empty");
      $(".adressError").removeClass('hidden');
      errors=true;
  }else{
     $(".adressError").addClass('hidden');
  }
   //check if the office field is not empty or just contains whitespaces
   if (!/\S/.test($('.birth_date').val())){
        $('.birth_dateError').text("birth date should not be empty");
      $(".birth_dateError").removeClass('hidden');
      errors=true;
  }else{
     $(".birth_dateError").addClass('hidden');
  }
    //check if the phone field is not empty or just contains whitespaces
   if (!/\S/.test($('.phone').val())){
        $('.phoneError').text("phone should not be empty");
      $(".phoneError").removeClass('hidden');
      errors=true;
  }else{
     $(".phoneError").addClass('hidden');
  }
if(errors==false){
   $.post("manage.php?do=checkName", 
          { name: $(".name").val(), col: "p_name", table: "patients"}).done(function(data){
           var result1 = $.trim(data);
           console.log(result1);
           if(result1 == "exist"){
              $(".existError_p").text("This name is already registered with us. add it to patients !.");
              $(".existError").removeClass('hidden');
                 $('.btn_add').on("click", function(e){
                       $.post("manage.php?do=add-patientofdoctor", $(".addForm-p").serialize()).done(function(data){
                                var result=$.trim(data);
                                console.log(result);
                                if(result=='inserted'){
                                     $('input').val("");
                                    $(".existError").addClass('hidden');
                                    $(".updated-success").removeClass('hidden');
                                    $(".updated-success:visible").fadeOut(5000);
                                }else{
                                  if(result=='allredy_exist'){
                                      $(".existError").text("this patient is allredy exist into yout patient");
                                      $(".existError").removeClass('hidden');
                                  }else{
                                    $(".existError").addClass('hidden');
                                  }
                                }
                       });
                 });
            }else{
             $(".existError").addClass('hidden');
                    $.post("manage.php?do=add-patient", $(".addForm-p").serialize()).done(function(data) {
                    var result=$.trim(data);
                    console.log(data);
                      if(result == "inserted") {
                           //console.log('good');
                           $('input').val("");
                          $(".updated-success").removeClass('hidden');
                          $(".updated-success:visible").fadeOut(5000);
                      }else{
                        console.log('bad');
                      }
              });
            }
          });
}
});
//================================End add new patient ==========================================
// ==========START SREARCH FORM (live data search) ==============================================
$(document).ready(function(e){

  $(".search-Box").keyup(function(){
    $(".resultRearch").show();
        //to show and hide resultRearch on focus on input filed
      $('.search-Box').focus(function(){
         $(".resultRearch").show();
         }).blur(function(){
             $(".resultRearch").hide();
        });
    $(".resultRearch").hover(function(){
        $(this).show();});
    //senf informartion from input fiels to manage.php?do=search
    var text = $(this).val();
   // console.log(text);
    $.ajax({
      method:'POST',//method to send
      url: 'manage.php?do=search', //directory to send 
      data:'txt=' + text, //value to send
      success: function(data){//send information and display it in (resultRearch) div if the function succes
        //console.log(data);
        $(".resultRearch").html(data);//display info in div with class resultRearch
      }
    });
  })
});
// ========== END SREARCH FORM ================================================================
/*=============Start search medicine name in DB==============================================*/
$(document).ready(function(e){
  $(".medicine-name").keyup(function(){
    $(".m-resultRearch").show();
        //to show and hide resultRearch on focus on input filed
      $('.medicine-name').focus(function(){
         $(".m-resultRearch").show();
         }).blur(function(){
             $(".m-resultRearch").hide();
        });
    $(".m-resultRearch").hover(function(){$(this).show();});
    //send informartion from input fiels to manage.php?do=earch-medicine
    var text = $(this).val();
   // console.log(text);
    $.ajax({
      method:'POST',//method to send
      url: 'manage.php?do=search-medicine', //directory to send 
      data:'txt=' + text, //value to send
      success: function(data){//send information and display it in (resultRearch) div if the function succes
        //console.log(data);
        $(".m-resultRearch").html(data);//display info in div with class resultRearch
      }
    });
  });
 $('.m-resultRearch').on('click','li',function (){
     var text=$(this).text();
     //console.log(text);
     $('.medicine-name').val(text);
 });
});
/*=============End search medicine name in DB==============================================*/
/*===========start add medicine in the prescription========================================*/
$(".add-medicine").click(function(e){
    e.preventDefault();
    var errors = false,
        name=$('.medicine-name').val(),
        dose=$('.dose').val(),
        repeated=$('.repeated').val(),
        box=$('.box').val(),
        form=$('.form').val(),
        time=$('.time').val();
             //check if the name field is not empty or just contains whitespaces
             if (!/\S/.test(name)){
                  $('.medicine-nameError').text("medicine namenot be empty");
                  $(".medicine-nameError").removeClass('hidden');
                errors=true;
              }else{
                  $(".medicine-nameError").addClass('hidden');
              }
             //check if the dose field is not empty
             if (!/\S/.test(dose)){
                  $('.doseError').text("dose must not be empty");
                  $(".doseError").removeClass('hidden');
                errors=true;
              }else{
                  $(".doseError").addClass('hidden');
              }
             //check if the repeated field is not empty
             if (!/\S/.test(repeated)){
                  $('.repeatedError').text("repeated mustnot be empty");
                  $(".repeatedError").removeClass('hidden');
                errors=true;
              }else{
                  $(".repeatedError").addClass('hidden');
              }
             //check if the repeated field is not empty
             if (!/\S/.test(box)){
                  $('.boxError').text("box must not be empty");
                  $(".boxError").removeClass('hidden');
                errors=true;
              }else{
                  $(".boxError").addClass('hidden');
              }
             //check if the form field is not empty
             if (form ==='0'){
                  $('.formError').text("you have to choose the medication form");
                  $(".formError").removeClass('hidden');
                errors=true;
              }else{
                  $(".formError").addClass('hidden');
              }
             //check if the form field is not empty
             if (time ==='0'){
                  $('.timeError').text("you have to choose the medication time");
                  $(".timeError").removeClass('hidden');
                errors=true;
              }else{
                  $(".timeError").addClass('hidden');
              }
      if(errors==false){
          $.post("manage.php?do=add-medicine", $(".prescribe-form").serialize()).done(function(data){
              var result1 = $.trim(data);
              console.log(result1); 
              if(result1=='mdicines_described') {
                   $('.medicine-list').append('<li class="med-item">'+name +' '+ dose +'<span class="pull-right">'
                   +box +' Box</span>'+'<span class="r-f-t">'+ repeated+' '+form  +' '+ time +'</span></li>');
              }else{
                  console.log('bad');
              }
         });
      }
});
/*===========End add medicine in the prescription========================================*/
/*================Start save prescribtion================================================*/
$(".save-prescribtion").click(function(e){
  var p_id = $(this).attr("data-id");
      $.post("manage.php?do=save-prescribtion", {Pid:p_id}).done(function(data){
        var result1 = $.trim(data);
        console.log(result1); 
   });
});
/*================Start save prescribtion================================================*/

});











