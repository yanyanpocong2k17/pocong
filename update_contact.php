<?php 
	session_start();
	include("config.php");
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$get_contact = "select * from contacts where contact_id = '$id'";
		$get_contact = mysqli_query($conn, "select * from contacts where contact_id = '$id'");
		$row = mysqli_fetch_array($get_contact);
	}
 ?>
 <?php 
	$cell_phone_number_err='';
	$profile_tmp='';
	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone_number = $_POST['cell_phone_number'];
		$home_phone_number = $_POST['home_phone_number'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zipcode = $_POST['zipcode'];
		
		$update_contact = "update contacts set FIrst_Name='$firstname', Last_Name='$lastname', Phone_Number='$phone_number', Home_Phone_Number='$home_phone_number', City='$city', State='$state', ZIpcode='$zipcode' where Contact_ID = '$id'";
	
		if (mysqli_query($conn, $update_contact)) {
			header("location: update_contact.php?id=$_GET[id]&contact_updated=1");
			
		} else {
			header("location: update_contact.php?id=$_GET[id]&duplicate_entry=1");
		}
		
		
		mysqli_close($conn);
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	 <link href="bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap-3.3.7/js/jquery.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default bg-primary">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <span id="brand-title">My Phonebook</span>             
             </a>
        </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class=""><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
           
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome </span> <?php echo $_SESSION['login_user']; ?> <span class="glyphicon glyphicon-user"><!--span class="caret"--></span></a>
                <ul class="dropdown-menu">
                <li id="logout"><a  href="?logout=1" ><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>    
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>

 <div class="modal" id="Logout_msg" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" onclick="$('#Logout_msg').fadeOut();">&times;</button>
                <center><h4 class="modal-title">Logout</h4></center>
            </div>
            <div class="modal-body">
                <center><p>Do you really want to logout</p></center>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="location.href='logout.php'" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Yes</button>
                <button type="button"  class="btn btn-danger" data-dismiss="modal" onclick="$('#Logout_msg').fadeOut();" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_GET['logout']) == 1){
    
?>
    <script type='text/javascript'>
        
        $('#Logout_msg').fadeIn();
        window.onclick = function(event) {
            if (event.target == modal) {
                $('#Logout_msg').fadeOut();
            }
        
        }
    </script>
<?php }?>
			<div class="row">
				<div class="col-sm-col-sm-offset-4">
				<div style="text-align:center" class="col-sm-3 col-sm-offset-1">
					<h4 style="text-align:center; margin:20px;"></h4>
				</div>	
			</div>

			<div style="padding:10px;" class="row">
				<form action="update_contact.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
								
				<div class="col-sm-5">
					<!-- Use as User id when updating contact -->
					<input type="hidden" name="id" value="<?php echo $row["Contact_ID"]; ?>">

					<div class="form-group">
						<label for="first-name">First Name</label>
						<input type="text" id="firstname" class="form-control text-field"  name="firstname" value="<?php echo $row['First_Name']?>" placeholder="First Name" autofocus />
					</div>
					<div class="form-group">
						<label for="last-name">Last Name</label>
						<input type="text" class="form-control text-field"  name="lastname" value="<?php echo $row['Last_Name']?>" placeholder="Last Name" />
					</div>
					<div class="form-group">
						<label for="cell-phone">Cell Phone</label>
						<input type="text" class="form-control text-field"  name="cell_phone_number" value="<?php echo $row['Phone_Number']?>" placeholder="Cell Phone" />
					</div>
					<div class="form-group">
						<label for="home-phone">Home Phone</label>
						<input type="text" class="form-control text-field"  name="home_phone_number" value="<?php echo $row['Home_Phone_Number']?>" placeholder="Home Phone Number" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" class="form-control text-field"  name="city" value="<?php echo $row['City']?>" placeholder="City" />
					</div>
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" class="form-control text-field"  name="state" value="<?php echo $row['State']?>" placeholder="State" />
					</div>
					<div class="form-group">
						<label for="zipcode">Zipcode</label>
						<input type="text" class="form-control text-field"  name="zipcode" value="<?php echo $row['ZIpcode']?>" placeholder="Zipcode" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div style="margin-top:10px" class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block" > Update Contact  </button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<div class="modal" id="update_success" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#update_success').fadeOut();$('#firstname').focus()">&times;</button>
					<center><h4 class="modal-title">Congrats</h4></center>
				</div>
				<div class="modal-body">
					<center><p>New Contact Successfully Updated</p><center>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="duplicate_entry" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#duplicate_entry').fadeOut();$('#firstname').focus()">&times;</button>
					<center><h4 class="modal-title">Warning</h4><center>
				</div>
				<div class="modal-body">
					<center><p>Duplicate Entry for Cell Phone Number</p></center>
				</div>
			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['contact_updated']) == 1 ){ ?>
		<script type='text/javascript'>
			$('#update_success').fadeIn();
			
			window.onclick = function(event) {
				if (event.target == modal) {
					$('#add_err').fadeOut();
				}
			}
		</script>	
	<?php }
	if(isset($_GET['duplicate_entry']) == 1 ){ ?>
		<script type='text/javascript'>
			$('#duplicate_entry').fadeIn();
			
			window.onclick = function(event) {
				if (event.target == modal) {
					$('#duplicate_entry').fadeOut();
				}
			}
		</script>	
	<?php } ?>
</body>
</html>	
