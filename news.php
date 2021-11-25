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
      border-radius: 20px ;
    }
    .btn_new:hover{
      background: black;
      color:white;
      cursor: pointer;
    }
    .post-container {
    width: 670px;
    margin: 2% 25%;
    box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
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
  }
  .blog-title{
    margin-left:40px;
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
  .image {
        width: 20%;
        font-family:futura-light;
      }
      .text {
        width: 80%;
        display: block;
        padding:5px 20px ;
        font-family:futura-light;
        border: 2px solid #478ac9;
      }
      .ava {
        display: flex;
        padding-bottom: 5px;
      }
      .avatar {
        width: 40px;
        height: 40px;
        margin: 2px 0px;
        border: 2px solid #478ac9;
        border-radius: 50%;
      }
      .ad {
        display: block;
        margin: 2px;
        margin-left: 10px;
        width: 300px;
      }
      .ad-t {
        height: 20px;
        font-size: 15px;
        display: flex;
        color: #478ac9;
      }
      .title {
        text-shadow: 1px 0 0 #478ac9, -1px 0 0 #478ac9, 0 1px 0 #478ac9, 0 -1px 0 #478ac9, 1px 1px #478ac9, -1px -1px 0 #478ac9, 1px -1px 0 #478ac9, -1px 1px 0 #478ac9;
        font-size:20px; 
        text-transform:uppercase;
        color: red;
      }
      .name {
        border-bottom: 1px solid var(--gray-boder);
        margin: 2px;
      }
      .delete{
        width:100%;
        background: white;

      }
      .delete:hover{
        cursor: pointer;
        background: #478ac9;
        color: white;
      }
      pre{
        font-family:futura-light;

      }
  </style>

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <link rel="canonical" href="/">
  </head>
  <body class="u-body" style="display: flex;">
      <div class="infor" id="infor">
      <input type="hidden" name="login_id" id="login_id"  value="<?php echo $login_user_id; ?>" />

      <?php
      
					foreach($chat_data as $chat)
					{
            $btn_del="";
            if ($chat["user_id"] == $login_user_id) 

              $btn_del =    '   <div class="dropdown" style="display:flex">
                               <button name="myFunction" class="dropbtn" style="padding: 0px;height:0px"><img src="https://cdn3.iconfinder.com/data/icons/web-interface-glyph/512/interface_-_site_-_web_-_development-22-512.png" style="width:30px"></button>
                                  <div id="myDropdown" class="dropdown-content" >
                                  <button class="delete"  name="btn_delete" value="'.$chat["id_news"].'"  >Delete </button>
                                  </div>
                                </div>';

            if($chat["file_name"] !="")
            {
              echo '
					
						
              <div style="padding: 1% 10%;">
                <div style=" border-radius:5px;display:flex;">
                  <div class="image">
                      <img src="'.$chat["file_name"].'" style="width:100%; height:100%">
                  </div>
                  <div class="text">
                    <div class="ava">
                      <div style="width:40px">
                           <img class="avatar"  src="'.$chat["user_profile"].'"/>
                      </div>  
                      <div class="ad">
                        <div class="ad-t">
                          <b >'.$chat["user_name"].'  </b>
                        </div>
                        <div class="ad-t"> <small> <i>'.$chat["created_on"].'</i> </small> </div>
                      </div>
                      <div style="margin-left:400px">'.$btn_del.'</div>
                    </div>
                    <div class="name">
                        <b  class="title">'.$chat["title"].' </b><br/>
                        <pre style="font-size:15px">'.$chat["content"].'</pre>
                    </div>
                 </div>
                </div>                                          
              </div>      
          ';
            }
            else{
              echo '
							
              <div style="padding: 1% 10%; ">
                    <div class="text" style="width:100%">
                    <div class="ava">
                      <div style="width:40px">
                          <img class="avatar" src="'.$chat["user_profile"].'"/>
                      </div>  
                      <div class="ad">
                        <div class="ad-t">
                          <b >'.$chat["user_name"].'  </b>
                        </div>
                        <div class="ad-t"> <small> <i>'.$chat["created_on"].'</i> </small> </div>
                      </div>
                      <div style="margin-left:550px">'.$btn_del.'</div>
                    </div>
                    <div class="name">
                        <b class="title">'.$chat["title"].' </b><br/>
                        <pre style="font-size:15px; ">'.$chat["content"].'</pre>
                    </div>
                </div>         
              </div>
          
        
          ';
            }
						
					}
					?>
      </div>
      <div class="post">
          <button class="btn_new" onclick="openMenu()">+ NEW</button>
      </div>
        <div class="post-container" id="post">
        <div class="post-container__header">
          <input type="hidden" name="login_user_profile" id="login_user_profile"  value="<?php echo $login_user_profile; ?>" />

          <input type="hidden" name="login_user_id" id="login_user_id"  value="<?php echo $login_user_id; ?>" />
          <h4  class="post-title">POST INFORMATION</h4>
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
          <div style="text-align:center">
                <input type='file' name="file" id="file" style="font-size: 10px;" placeholder="Image" />
                <div>
                  <img id="img" style="width: 130px; height:50px" src="" />
                </div>   
          </div>
          <div class="post-box__send">
              <button type="submit" class="btn-send" onclick="closeMenu()"></button>
          </div>
        </form>

       
        </div>
  </body>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
$("#file").change(function(){
    readURL(this);
});
</script>
<script>
        
        $("button[name=myFunction]").click( function()
            { 
              document.getElementById("myDropdown").classList.toggle("show");

            });
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
    </script>   

<script type="text/javascript">
	function openMenu() {
    document.getElementById("post").style.left = "6%";
    }

  function closeMenu() {
    document.getElementById("post").style.left = "80%";
    }
	$(document).ready(function(){

    var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

		conn.onmessage = function(e) {
		    console.log(e.data);

		    var data = JSON.parse(e.data);
        
        if (data.msg != 'reset')
        {  var btn_del='';
          if (data.userId ==  $('#login_id').val() )
          {
            btn_del='   <div class="dropdown" style="display:flex">'+
                               '<button name="myFunction" class="dropbtn" style="padding: 0px;height:0px"><img src="https://cdn3.iconfinder.com/data/icons/web-interface-glyph/512/interface_-_site_-_web_-_development-22-512.png" style="width:30px"></button>'+
                                  '<div id="myDropdown" class="dropdown-content" >'+
                                 ' <button class="delete"  name="btn_delete" value="'+data.newsId+'"  >Delete </button>'+
                                 ' </div>'+
                               ' </div>';
          }
          
              if (data.FileName !="")
            {
              var html_data =  '<div style="padding: 1% 10%;">'+
                '<div style=" border-radius:5px;display:flex;">'+
                  '<div class="image">'+
                    '  <img src="'+data.FileName+'" style="width:100%; height:100%">'+
                  '</div>'+
                  '<div class="text">'+
                    '<div class="ava">'+
                     ' <div style="width:40px">'+
                         ' <img class="avatar"  src="'+data.profile+'"/>'+
                     ' </div>  '+
                     ' <div class="ad">'+
                        '<div class="ad-t">'+
                          '<b >'+data.from+'  </b>'+
                       ' </div>'+
                        '<div class="ad-t"> <small> <i>'+data.dt+'</i> </small> </div>'+
                     ' </div>'+
                     ' <div style="margin-left:400px;">'+btn_del+'</div>'+
                    '</div>'+
                   ' <div class="name">'+
                        '<b class="title">'+data.Title+' </b><br/>'+
                       ' <pre style="font-size:15px">'+data.msg+'</pre>'+
                   ' </div>'+
                ' </div>'+
               ' </div>     '    +                
             ' </div>      '
          ;  

            }
            else
            {
              var html_data = ' <div style="padding: 1% 10%; ">'+
                 '   <div class="text" style="width:100%">'+
                    '<div class="ava">'+
                      '<div style="width:40px">'+
                          '<img class="avatar" src="'+data.profile+'"/>'+
                     ' </div>  '+
                      '<div class="ad">'+
                        '<div class="ad-t">'+
                          '<b >'+data.from+'  </b>'+
                        '</div>'+
                        '<div class="ad-t"> <small> <i>'+data.dt+'</i> </small> </div>'+
                      '</div>'+
                      '<div style="margin-left:500px;">'+btn_del+'</div>'+
                    '</div>'+
                    '<div class="name">'+
                        '<b class="title">'+data.Title+' </b><br/>'+
                        '<pre style="font-size:15px">'+data.msg+'</pre>'+
                    '</div>'+
                '</div> '+        
              '</div>'

          ;
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

          var user_profile= $('#login_user_profile').val();

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
                profile:user_profile,
          			command:'news'
				};
        conn.send(JSON.stringify(data));

			}

		});


    
    $("button[name=btn_delete]").click( function()
    { 
	    alert("Do you want DELETE item ? ");

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

</html>