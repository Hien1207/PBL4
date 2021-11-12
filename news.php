<?php 
session_start();

if(!isset($_SESSION['user_data']))
{
	header('location:index.php');
}

require('database/ChatUser.php');

require('database/News.php');

$chat_object = new News;

$chat_data = $chat_object->get_all_news_data();

$user_object = new ChatUser;

$user_data = $user_object->get_user_all_data();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="vendor-front/bootstrap/bootstrap.min.css" rel="stylesheet">	
    <link href="vendor-front/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vendor-front/parsley/parsley.css"/>   
	<link href="./vendor-front/bootstrap/nicepage.css" rel="stylesheet">
    <link href="./vendor-front/bootstrap/style.css" rel="stylesheet">
    <script class="u-script" type="text/javascript" src="./vendor-front/bootstrap/js/nicepage.js"></script>
    <script class="u-script" type="text/javascript" src="./vendor-front/bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="vendor-front/jquery/jquery.min.js"></script>
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>
    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
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
	<style type="text/css">
		html,
		body {
		  height: 100%;
		  width: 100%;
		  margin: 0;
		}
		#wrapper
		{
			display: flex;
		  	flex-flow: column;
		  	height: 100%;
		}
		#remaining
		{
			flex-grow : 1;
		}
	
		#chat-room-frm {
			margin-top: 10px;
		}
		#news-box {
			margin: 10px 100px;
			background-color: red;
			padding: 20px;
		}
	
		

	</style>
</head>
<body class="u-body" >
     <section class="u-align-center u-clearfix u-gradient h-section-1" id="carousel_0fb8"  >

	<div style="padding: 2%;" >

					<?php
					foreach($chat_data as $chat)
					{
						


						echo '
					
						
								<div style="padding: 2% 10%; ">
								  <div style="background-color: #e6e6e6; border-radius: 5px">
									<img src="'.$chat["user_profile"].'" class="img-fluid rounded-circle img-thumbnail"  />
									<b style="color: blue">'.$chat["user_name"].'  </b>  <br/>
                                    <small> <i>'.$chat["created_on"].'</i> </small>
									<b style="color: red">'.$chat["title"].' </b>
									<br />
                                    <p>'.$chat["content"].'</p>
                                    <br />
									</div>
                                    
                                    
								</div>
						
					
						';
					}
					?>
				
			
	
	</div>
 </section>
</body>
<script type="text/javascript">
	
	$(document).ready(function(){

		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

		conn.onmessage = function(e) {
		    console.log(e.data);

		    var data = JSON.parse(e.data);

		    var row_class = '';

		    var background_class = '';

		    if(data.from == 'Me')
		    {
		    	row_class = 'row justify-content-start';
		    	background_class = 'text-dark alert-light';
		    }
		    else
		    {
		    	row_class = 'row justify-content-end';
		    	background_class = 'alert-success';
		    }

		    var html_data = "<div ><div class='col-sm-10'><div class='shadow-sm alert "+background_class+"'><b>"+data.from+" - </b>"+data.msg+"<br /><div class='text-right'><small><i>"+data.dt+"</i></small></div></div></div></div>";

		    $('#messages_area').append(html_data);

		    $("#chat_message").val("");
		};

		$('#chat_form').parsley();

		$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

		$('#chat_form').on('submit', function(event){

			event.preventDefault();

			if($('#chat_form').parsley().isValid())
			{

				var user_id = $('#login_user_id').val();

				var message = $('#chat_message').val();

				var data = {
					userId : user_id,
					msg : message
				};

				conn.send(JSON.stringify(data));

				$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

			}

		});
		

	});
	
</script>
</html>