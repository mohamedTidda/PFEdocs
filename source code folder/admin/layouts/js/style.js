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
//======================start add asterisk(*) on required field=============================
  $('input').each(function(){
      if ($(this).attr('required') === 'required') {
        $(this).after('<span class="asterisk">*</span>');
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
//====== end function to show and hide the modal form =================================
//===== start function reload doctor page when close the modal===========
$('.btn-close').click(function (){
   location.reload(); // then reload the page
});
//===== end function reload doctor page when close the modal===========
//========start delete doctor==============================================
$('.confirm').on("click", function(e){
  var answer = confirm("Are you sure want to delete doctor?");
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
  var answer = confirm("Are you sure want to delete pharmacy?");
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
//========end delete pharmacy==============================================
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
//=====================start add new pharmacy in DB ======================================
$('.addForm-ph').on("submit", function(e){
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
          { name: $(".name").val(), col: "ph_name", table: "pharmacy"}).done(function(data){
           var result1 = $.trim(data);
           console.log(result1);
           if(result1 == "exist"){
              $(".nameError").text("This name is already registered with us. choose different name.");
              $(".nameError").removeClass('hidden');
            }else{
             $(".nameError").addClass('hidden');
                    $.post("manage.php?do=addPharmacy", $(".addForm-ph").serialize()).done(function(data) {
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
//=====================end add new doctor in DB ======================================
//=====================start validate edite  Pharmacy form ===================================
 $('.ph-editForm').on("submit", function(e){
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
          { name: $(".name").val(), col: "ph_name", table: "pharmacy"}).done(function(data) {
           var result1 = $.trim(data);
           console.log(result1);
           if(result1 == "exist"){
              $(".nameError").text("This name is already registered with us. choose different name.");
              $(".nameError").removeClass('hidden');
            }else{
             $(".nameError").addClass('hidden');
             $.post("manage.php?do=updatepharmacy", $(".ph-editForm").serialize()).done(function(data) {
                    var result=$.trim(data);
                    console.log(data);
                      if(result == "updated-ph") {
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
//=====================end validate edite  Pharmacy form =======================================



});



