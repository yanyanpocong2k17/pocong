<?php
   include("config.php");
   session_start();
   if(isset($_SESSION['login_user'])){
      header("location:index.php");
      location.reload();
   }
   $error='';
   $myusername='';
   $mypassword='';
   
   if($_SERVER["REQUEST_METHOD"] == "POST" ) {
   
      if(isset($_POST['username'])){
         $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      }
      if(isset($_POST['username'])){
         $mypassword = mysqli_real_escape_string($conn ,$_POST['password']); 
      }
      
      $sql = "SELECT User.User_ID FROM User WHERE User.User_Name = '$myusername' and User.Password = PASSWORD('$mypassword')";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     
      $count = mysqli_num_rows($result);
      		
      if($count == 1) {
         $_SESSION['user_id'] = $row['User_ID'];   
         $_SESSION['login_user'] = $myusername;
         header("location: index.php");
         location.reload();
      }else {
         header("location:login.php?login_err=1");
      }
   }   
?>
<!DOCTYPE html>
<br>
<br>
<br>
<html>
   <head>
      <title>Login</title>
       <link href="bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap-3.3.7/js/jquery.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <div class="carousel slide carousel-fade" data-ride="carousel">
         <div class="carousel-inner" role="listbox">
            <div class="item"></div>
            <div class="item active"></div>
            <div class="item"></div>
            <div class="item"></div>
         </div>
      </div>
   <div id="loginbox" style="margin-top:60px;" class="mainbox col-sm-4 col-sm-offset-4">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<center><div class="panel-title">Log In</div></center>
			</div>     
			<div style="padding-top:30px" class="panel-body " >
				<form id="loginform" class="form-horizontal" role="form" action="" method = "post">
					<!--Username-->		
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i " class="glyphicon glyphicon-user"></i></span>
						<input type="email" id="username" type="text" class="form-control" name="username" value="" title="Username" placeholder="Username" autofocus autocomplete>                                        
					 </div>
					<!--Password-->	
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i " class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" title="Password" class="form-control" name="password" placeholder="Password">
               </div>
               <div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
                     <center><button type="submit" class="btn btn-info " name="submit">Login  </button></center>
                  </div>
               </div>
               <div class="form-group">
			   <center>
						<div class="col-md-12 control">
								Don't have an account
							<a href="register.php" title="Sign Up Here">Sign Up Here</a>
							</div>
						</div>
						</center>
					</div>    
				</form>  
			</div>                     
		</div>  
   </div>
   <div class="modal" id="LoginError" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#LoginError').fadeOut();$('#username').focus()">&times;</button>
					<center><h4 class="modal-title">Warning</h4></center>
				</div>
				<div class="modal-body">
					<center><p>Invalid Username/Password</p></center>
				</div>
         </div>
      </div>
   </div>
      <?php
         if(isset($_GET['login_err']) == 1){
            
      ?>
         <script type='text/javascript'>

            var modal = document.getElementById('LoginError');
            $('#LoginError').fadeIn();

            
            window.onclick = function(event) {
               if (event.target == modal) {
                  $('#LoginError').fadeOut();
               }
            }
         </script>
      <?php }?>
   </body>
</html>
