$(function(){
	   'use strict'; 
   //=====================hide placeholder on focus in it ===========================================================
    $('[placeholder]').focus(function(){
      $(this).attr('data-text', $(this).attr('placeholder'));
      $(this).attr('placeholder','');
    }).blur(function(){
      $(this).attr('placeholder', $(this).attr('data-text'));
    });

       //=========function to hide and show the sidebar on click on [btn-click]  button ===================================
   $('.btn-click ').click(function(){
      $('.main-menu,.logo').toggleClass('active');
      $('.logo .td ,.logo .hide').toggleClass('visible ');
      $('.main-menu .nav-text , .info').toggleClass('visible');
      $('.main-nav,.dash').toggleClass('active1');
      $('.dash1').toggleClass('active3');
      $('.dash2').toggleClass('margin-r');
   });

   //=========function to  hide and show the sidbare depending on the size of the page ==========================================

  $(window).bind("resize", function () {
       // console.log($(this).width());
        if($(this).width() < 767) {
            $('.main-menu, .logo').addClass('active');
            $('.logo .td').removeClass('visible ');
            $('.logo .hide, .main-menu .nav-text, .info').addClass('visible ');
            $('.main-nav, .dash').addClass('active1');
            $('.dash1').addClass('active3');
            $('.dash2').addClass('margin-r');

        } else {
            $('.main-menu, .logo').removeClass('active');
            $('.logo .td').addClass('visible ');
           $('.logo .hide , .main-menu .nav-text , .info').removeClass('visible');
            $('.main-nav, .dash').removeClass('active1');
            $(' .dash1').removeClass('active3');
            $('.dash2').removeClass('margin-r');
        }
    });

//============= start function to add and remove border from menu(Activity/Settings) in profile page ===============
  $('.min-menu').click( function() {
    $(this).addClass('min-menu-border').siblings().removeClass('min-menu-border');

  });
      $('[data-toggle]').click(function(){
      $('.menu-1').addClass('hide-me');
      var pageId = $(this).data('toggle');
      $('#'+pageId).removeClass('hide-me');
});
 //================ end function to add and remove border from menu in profile page ==========================


//===== start checking of register fields==========================================================
 $('.editForm').on("submit", function(e){
      e.preventDefault();
    var errors = false, checkemail=false;
    console.log('good');

 //===== start check name field and add new user if not exist the enterd email===============================

 //===== end check email field and add new user if not exist the enterd email===============================
 });
 //===== end checking of register fields==========================================================

  //===========================validation msg========================================

  $(".registered-confirm:visible").fadeOut(5000);

  //===========================validation msg========================================

//===================start login error checking ===========================================================
$(".loginForm").on("submit", function(e) {
    e.preventDefault();
    $.post("manage.php?do=checkuser", $(".loginForm").serialize() ).done(function(data) {
        var result = $.trim(data);
        console.log(result);
        if(result == "exist") {
          window.location.href = "index.php";
        } else {
          console.log(result);
          $(".loginError").removeClass('visible');
        }
      });
  });
//===================end  login error checking =========================================

//====================START TO CHECK ADDING LIKE ==========================================================================
   $(".addlike").on("click", function(){
    var id_post = $(this).attr("data-id");
    console.log(id_post);
    $.post("manage.php?do=addlike", { idpost : id_post }).done(function(data) {
      var result = $.trim(data);
      console.log(result);
      if(result == "ok") {
        location.reload();
      }
    });
  });
//====================END TO CHECK ADDING LIKE ============================================

// ========== START SREARCH FORM (live data search) ==============================================
 
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

});