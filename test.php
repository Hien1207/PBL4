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
   

  </head>
  <body class="u-body" style="display: flex;">
      <div class="infor" id="infor">
      <?php
      
      foreach($chat_data as $chat)
      {
        echo $chat['content'];
      }
      ?>       
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
                     ' <div style="margin-left:50 %">'+btn_del+'</div>'+
                    '</div>'+
                   ' <div class="name">'+
                        '<b class="title">'+data.Title+' </b><br/>'+
                       ' <h9 style="font-size:15px">'+data.msg+'</h9>'+
                   ' </div>'+
                ' </div>'+
               ' </div>     '                     +                
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
                      '<div style="margin-left:50%">'+btn_del+'</div>'+
                    '</div>'+
                    '<div class="name">'+
                        '<b class="title">'+data.Title+' </b><br/>'+
                        '<h9 style="font-size:15px">'+data.msg+'</h9>'+
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