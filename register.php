<?php
    include('config.php');
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            
            $username = mysqli_real_escape_string($conn,$_POST['username']);

            $sql = "SELECT * FROM User WHERE user_name='".$username."'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);
          
            if($count == 1) {
                $username_err = "This username is already taken.";
            }else {
                
                $username = trim($_POST["username"]);
            }
            
        }
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            $sql = "INSERT INTO User (user_name,password) VALUES ('$username', PASSWORD('$password'))";

            if (mysqli_query($conn, $sql)) {
                header("location: register.php?user_added=1");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<br>
<br>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
     <link href="bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap-3.3.7/js/jquery.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item"> </div>
            <div class="item active"></div>
            <div class="item"></div>
            <div class="item"></div>
        </div>
    </div>
   <div id="signupbox" style="margin-top:50px;" class="mainbox col-sm-4 col-sm-offset-4">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<center><div class="panel-title">Sign Up</div></center>
			</div>     
			<div style="padding-top:30px" class="panel-body" >
				<form id="signupform" class="form-horizontal" role="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div style="padding-left:15px;padding-right:15px;" class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group" >
                            <span class="input-group-addon"><i " class="glyphicon glyphicon-user"></i></span>
                            <input type="email" id="username" type="text" class="form-control" name="username" value="<?php echo $username; ?>" title="Username" placeholder="Username" autofocus autocomplete>                                        
                        </div>
                        <span style="text-align:center;" class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div style="padding-left:15px;padding-right:15px;" class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i " class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" title="Password" class="form-control" value="<?php echo $password; ?>" name="password" placeholder="Password">
                        </div>
                        <span style="text-align:center;" class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div style="padding-left:15px;padding-right:15px;" class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i " class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" name="confirm_password" title="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>"   placeholder="Confirm Password"/>
                        </div>
                        <span style="text-align:center;" class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
               <div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
                     <center><button type="submit" class="btn btn-info " title="Sign Up" name="submit"></span> Sign Up  </button></center>
                  </div>
               </div>
               <div class="form-group">
			   <center>
						<div class="col-md-12 control">
								Go to 
							<a href="login.php" title="Sign In Here">
								Sign in Here
							</a>
						</div>
					</div>  
			  </center>
				</form>  
			</div>                     
		</div>  
   </div>
   <div class="modal" id="Sinupmsg" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#Sinupmsg').fadeOut();$('#username').focus()">&times;</button>
					<center><h4 class="modal-title">Congrats</h4></center>
				</div>
				<div class="modal-body">
					<center><p>Successfully Registered</p></center>
				</div>
         </div>
      </div>
   </div>
    <?php
         if(isset($_GET['user_added']) == 1){
            
      ?>
         <script type='text/javascript'>
            var modal = document.getElementById('Sinupmsg');
            $('#Sinupmsg').fadeIn(); 
            window.onclick = function(event) {
               if (event.target == modal) {
                  $('#Sinupmsg').fadeOut();
               }
            }
         </script>
      <?php }?>
</body>
</html>
