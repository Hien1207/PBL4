<?php 

//privatechat.php

session_start();

if(!isset($_SESSION['user_data']))
{
	header('location:index.php');
}

require('database/ChatUser.php');
$login_user_id = '';
        $login_user_name = '';
				foreach($_SESSION['user_data'] as $key => $value)
				{
					$login_user_id = $value['id'];
          $login_user_name=$value['name'];
          $login_user_profile=$value['profile'];
          
        }

?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="​Architectural, interior and brand design">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    
    <link href="./vendor-front/bootstrap/nicepage.css" rel="stylesheet">
    <link href="./vendor-front/bootstrap/style.css" rel="stylesheet">
    <script class="u-script" type="text/javascript" src="./vendor-front/bootstrap/js/nicepage.js"></script>
    <script class="u-script" type="text/javascript" src="./vendor-front/bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One:400|Inconsolata:200,300,400,500,600,700,800,900">
    <script type="application/ld+json">
    {
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"url": "/"
    }</script>
    <style>
      .avatar {
        width: 40px;
        height: 40px;
        margin-top: 10px;
        margin-left: 500px;
        border: 2px solid #478ac9;
        border-radius: 50%;
      }
    </style>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <link rel="canonical" href="/">
  </head>
  <body class="u-body" >
    <header class="u-clearfix u-header u-palette-1-base u-header" id="sec-61e1">
        <div class="u-clearfix u-sheet u-sheet-1"  style="display: flex;">
        <h1 class="u-custom-font u-text u-text-default u-text-2" style="margin: 12px 0px;">ABC SCHOOL<span style="font-weight: 700;">
            <span style="font-weight: 400;">
              <span style="font-style: italic;"></span>
            </span>
          </span>
        </h1>
        <input  type="hidden" name="login_user_id" id="login_user_id"  value="<?php echo $login_user_id; ?>" />
        <img class="avatar" src="<?php echo $login_user_profile ?>" >
     
      <div class="u-nav u-spacing-30 u-unstyled u-nav-1" style="margin-left:10px;margin-top :15px;display:flex" >

        <a style="color:white;margin-right:20px"  href="home.php" target="main">Home</a>
        <a style="color:white;margin-right:20px"  href="news.php" target="main">News</a>
        <a style="color:white;margin-right:20px"  href="chat.php" target="main">Chat</a>
        <div class="dropdown" style="display:flex">
        <button onclick="myFunction()" class="dropbtn" style="padding: 0px;height:10px"><img src="https://cdn1.iconfinder.com/data/icons/menu-flat-shaded-1/512/DropDown_Menu-2-512.png" style="width:30px"></button>
        <div id="myDropdown" class="dropdown-content" >
        <a style="padding: 0px;" href='profile.php' target="main" >PROFILE</a>
        <button style="padding: 0px;" id="logout" name="logout" > 
          <a style="padding: 0px;" id="log" name="log" href='index.php' target="_top" >LogOut
          </a>

        </button>
        </div>
      </div>
      
    </div>
      
    </div></header>
     <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
                }
            }
            }
        }
        
        $('#logout').click(function(){

        user_id = $('#login_user_id').val();

        $.ajax({
          url:"action.php",
          method:"POST",
          data:{user_id:user_id, action:'leave'},
          success:function(data)
          {
            var response = JSON.parse(data);
            if(response.status == 1)
            {
              conn.close();
              // $("#logout_link")[0].click();

            }
          }
        })

        });


    </script>
   