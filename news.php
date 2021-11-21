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
   
    
  <link href="./vendor-front/bootstrap/nicepage.css" rel="stylesheet">
    <link href="./vendor-front/bootstrap/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="vendor-front/parsley/parsley.css"/>

	<link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One:400|Inconsolata:200,300,400,500,600,700,800,900">
    
	<script src="vendor-front/jquery/jquery.min.js"></script>	
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="application/ld+json">
    {
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"url": "/"
    }</script>
    <style>
    .infor{
      width: 90%;
      padding-top: 2%;
    }
    .post{
      width: 10%;
    }
    .btn_new{
      width: 100px;
      background: white;
      color:black;
      margin-top: 30px;
      font-weight: 700;
      font-family: futura-light;
      border-radius: 20px;
    }
    .btn_new:hover{
      background: black;
      color:white;
      cursor: pointer;
    }
    .post-container {
    width: 670px;
    margin: 0% 25%;
    left: 80%;
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 8px;
    position: fixed;
    transition: all 1s ease;
    }
.post-container__header {
  margin: 5px 0px 5px 34%;
  display: flex;
  flex-direction: row;
 
}
.post-title {
    font-size: 20px;
    font-weight: 500;
    margin: 5px;
    padding-left: 10px;
   font-family: "Pacifico", cursive;
  }
  .page-logo {
    height: 40px;
    width: 40px;
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
    .logo-text {
      font-size: 12px;
      font-weight: 600;
    font-family:"Pacifico", cursive;
  }
.post-container__form {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
}
.preview{
  width: 50px;
  height: 50px;
}
  label {
      font-family:"Pacifico", cursive;
      margin-right: 10px;
    }
    .input-title {
      background-color: rgb(224, 224, 224);
      border: none;
      outline: none;
      padding: 5px;
      width: 80%;
      color: rgb(107, 107, 107);
      border-bottom: solid 1px #fff;
      border-radius: 8px;
    }
    ::placeholder {
      color: rgb(155, 153, 153);
      opacity: 0.7;
    }
    .input-title:focus {
      border-bottom: solid 1px rgb(3, 211, 3);
      border-radius: 0;
      background-color: #fff;
    }
  
  .post-option {
    display: flex;
    flex-direction: row;
    margin-top: 20px;
    margin-left: 16px;
  }

.post-option__content {
  cursor: pointer;
  padding: 5px ;
  margin-left: 20px;
  height: 35px;
  width: 35px;
  background-size: 100%;
  background-image: url(https://raw.githubusercontent.com/ductai26998/Mini-Blog/1002037f251ee951bc2882358ef46fc2b2d05d39/mini-blog/src/assets/icon/pencil.svg);
}

.post-box {
 width: 94%;
  display: flex;
  flex-direction: column;
  position: relative;
  margin: 20px 3%;
}
.post-box__text {
  border-radius: 8px;
  padding-top: 10px;
  height: 150px;
  background-color: rgb(224, 224, 224);
}
.post-box__text--input {
  border: none;
  outline: none;
  padding: 10px;
  padding-top: 0;
  color: rgb(71, 71, 71);
  border-radius: 8px;
  width: 100%;
  height:100%;
  background-color: transparent;
}

  label{
    cursor: pointer;
    font-family: "Pacifico", cursive;
    padding: 5px;
    width: 100px;
    text-align: center;
    border-radius: 8px;
    background-color: #fff2cc;
  }
  label:hover {
    background-color: #f3de9f;
  }

.post-box__send {
  display: flex;
  justify-content: flex-end;
}

  .btn-send {
    border: none;
    padding: 5px;
    height: 30px;
    width: 30px;
    margin: 5px 20px;
    background-size: 100%;
    background-image: url(https://raw.githubusercontent.com/ductai26998/Mini-Blog/1002037f251ee951bc2882358ef46fc2b2d05d39/mini-blog/src/assets/icon/send.svg);
  }
    </style>

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <link rel="canonical" href="/">
  </head>
  <body class="u-body">
    <section class="u-align-center u-clearfix u-gradient h-section-1" id="carousel_0fb8" style="display: flex;height:200vh">
      <div class="infor" id="infor">
      <input type="hidden" name="login_user_id" id="login_user_id"  value="<?php echo $login_user_id; ?>" />

      <?php
					
          foreach($chat_data as $chat)
          { $btn_del="";
            $data_load='';
            if ($chat["user_name"] == $login_user_name) 
              $btn_del ='
                               <button  name="btn_delete" value="'.$chat["id_news"].'"  >Delete
                               </button>';
                           
            $data_load.='<div style="padding: 2% 10%; ">
            <div style="background-color: #e6e6e6; border-radius: 5px">'.$btn_del.'
            <b style="color: blue">'.$chat["user_name"].'  </b>  <br/>
            <small> <i>'.$chat["created_on"].'</i> </small>
            <b style="color: red">'.$chat["title"].' </b>
            <br />
            <p>'.$chat["content"].'</p>
            <br />';
            if($chat["file_name"] !="")
              $data_load.='<img src="'.$chat["file_name"].'" style="width: 200px; height: 200px">';

            $data_load.='</div></div>';
            echo $data_load;
          }

					?>
      </div>
      <div class="post">
          <button class="btn_new" id="btn-new" onclick="openMenu()">+ NEW</button>
      </div>
        <div class="post-container" id="post">
        <div class="post-container__header">
          <input type="hidden" name="login_user_id" id="login_user_id"  value="<?php echo $login_user_id; ?>" />
          <h4  class="post-title">Post information</h4>
          <div style="margin-left: 200px;">
                 <i class="fas fa-times" onclick="closeMenu()" id="fas-close"></i>
          </div>
        </div>
        <form method="post" @submit.prevent="postBlog" name ="news_form" id="news_form" class="post-container__form" data-parsley-errors-container="#validation_error">
          <div class="blog-title">
            <label for="">Title: </label>
            <input
              class="input-title"
              type="text"
              name="title"
              id="title"
              placeholder="Your blog title"
             
            />
          </div>
          <div class="post-option">
            <div class="post-option__content"></div>
          </div>
          <div class="post-box">
            <div class="post-box__text" >
              <textarea
                name="content"
                id="content"
                class="post-box__text--input"
                cols="30"
                rows="10"
              ></textarea>
            </div>
          </div>
          <div>
                <input type='file' name="file" id="file" style="font-size: 10px;" placeholder="Image" />
                <div class="preview">
                  <img id="img" style="width: 50px; height:50px" src="" />
                </div>
                
          </div>
          <div class="post-box__send">
              <button type="submit" class="btn-send" ></button>
          </div>
        </form>

       
        </div>

  
    </section>
   
    

  </body>
  
    

<script type="text/javascript">
	

	$(document).ready(function()
  {

		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

		conn.onmessage = function(e) {
		    console.log(e.data);

		    var data = JSON.parse(e.data);
        
        if (data.msg != 'reset')
        {
              if (data.FileName !="")
            {
              var html_data = '<div style="padding: 2% 10%; "> <div style="background-color: #e6e6e6; border-radius: 5px"><button name="btn_delete" value="'+data.newsId+'" >Delete</button>	<b style="color: blue">'+data.from+'  </b>  <br/> <small> <i>'+data.dt+'</i> </small>	<b style="color: red">'+data.Title+' </b><br /><p>'+data.msg+'</p><br /> <img src="'+data.FileName+'" style="width: 200px; height: 200px"> </div>	</div>'; 

            }
            else
            {
              var html_data = '<div style="padding: 2% 10%; "> <div style="background-color: #e6e6e6; border-radius: 5px"><button name="btn_delete" value="'+data.newsId+'" >Delete</button>	<b style="color: blue">'+data.from+'  </b>  <br/> <small> <i>'+data.dt+'</i> </small>	<b style="color: red">'+data.Title+' </b><br /><p>'+data.msg+'</p><br /> </div>	</div>'; 

            }
            $('#infor').prepend(html_data);

            $("#title").val("");
            $("#content").val("");
        }
        if (data.msg=='reset')
        {
          location.reload();
        }
		    

		};

		$('#news_form').parsley();


		$('#news_form').on('submit', function(event){

			event.preventDefault();

			if($('#news_form').parsley().isValid())
			{  
          var user_id= $('#login_user_id').val();

				  var title = $('#title').val();

        	var content=$('#content').val();

          var files =$('#file')[0].files;
          var fd = new FormData();

          if (files.length > 0)
          {
             fd.append('file',files[0]);
             var name='upload/'+files[0]['name'];
             $.ajax({
                url:'upload.php',
                type:'post',
                data: fd, 
                contentType:false,
                processData:false,
                success: function(response)
                {
                  if (response !=0 )
                  {
                     $("#img").attr("src", response);
                     $(".preview img").show();
                  }
                }
              });
              
              
             
      }
      else name="";
      var data = {
					      userId : user_id,
					      Title : title,
          			msg : content,
                FileName: name,
          			command:'news'
				};
        conn.send(JSON.stringify(data));

			}

		});


    
    $("button[name=btn_delete]").click( function()
    { 
	    alert("Do you want DELETE item ? ")
      var id_news =$(this).attr('value');
      var data = {
					      userId :'user_id',
                newsId:id_news,
          			command:'delete'
				};

        conn.send(JSON.stringify(data));

    });
   
	});
	
</script>

<script>

function openMenu() 
  {
    document.getElementById("post").style.left = "6%";
  }

  function closeMenu() 
  {
    document.getElementById("post").style.left = "80%";
  }

</script>
</html>