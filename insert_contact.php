<?php 
    session_start();
    include('config.php');
    $user_id = $_SESSION['user_id'];
	$cell_phone_number_err="";
	if (isset($_POST['submit'])) {
        $firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
        $cell_phone_number = $_POST["cphone"];
		$home_phone_number = $_POST['hphone'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip_code = $_POST['zipcode'];
        if(empty(trim($cell_phone_number)) ){
            $cell_phone_number_err = "Please enter a Cell Phone Number";
        } else{    
            $cell_phone_number = mysqli_real_escape_string($conn,$cell_phone_number);

			$sql = "SELECT * FROM contacts WHERE Phone_Number='".$cell_phone_number."'";
			
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);

            if($count == 1) {
                $cell_phone_number_err = "This cellphone number is already taken.";
            }else {
                
                $cell_phone_number = trim($_POST["cphone"]);
            }
            
		}
        if(empty($cell_phone_number_err)){
            $sql = "INSERT INTO contacts (First_Name,Last_Name,Phone_Number,Home_Phone_Number,City,State,ZIpcode,User_ID) VALUES 
            ('$firstname','$lastname','$cell_phone_number','$home_phone_number','$city','$state','$zip_code','$user_id')";

            if (mysqli_query($conn, $sql)) {
                header("location:insert_contact.php?contact_added=1");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }else{
			header("location: insert_contact.php?taken_cellnum=1");
		} 
        mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Contact</title>
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
				 <li id="logout"><a  href="?logout=1" > <a title="Add Contact" href="insert_contact.php">Add contact</a></li> 
                <li id="logout"><a  href="logout.php" >Log Out</a></li>    
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>
		<div class="row">
			
			<form action="insert_contact.php" method="post" enctype="multipart/form-data">
			<div style="text-align:center" class="col-sm-3 col-sm-offset-1">
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label for="first-name">First Name</label>
					<input type="text" class="form-control text-field" id="fname"  name="fname" placeholder="First Name" autofocus />
				</div>
				<div class="form-group">
					<label for="last-name">Last Name</label>
					<input type="text" class="form-control text-field"  name="lname" placeholder="Last Name" autofocus />
				</div>
				<div class="form-group">
					<label for="cell-phone">Cell Phone</label>
					<input type="text" class="form-control text-field"  name="cphone"   placeholder="Cell Phone" autofocus />
				</div>
				<div class="form-group">
					<label for="home-phone">Home Address</label>
					<input type="text" class="form-control text-field"  name="hphone" placeholder="Home Phone Address" autofocus />
				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" class="form-control text-field"  name="city" placeholder="City" autofocus />
				</div>
				<div class="form-group">
					<label for="state">State</label>
					<input type="text" class="form-control text-field"  name="state" placeholder="State" autofocus />
				</div>
				<div class="form-group">
					<label for="zipcode">Zipcode</label>
					<input type="text" class="form-control text-field"  name="zipcode" placeholder="Zipcode" autofocus />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div style="margin-top:10px" class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-block" > Insert Contact  </button>
					
				</div>
			</div>
		</div>
		</form>
		</div>
	</div>
</div>
<div class="modal" id="add_err" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id=close" onclick="$('#add_err').fadeOut();$('#fname').focus()">&times;</button>
				<center><h4 class="modal-title">Warning</h4></center>
			</div>
			<div class="modal-body">
				<center><p>Cell number is empty or it is already taken</p></center>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="add_success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id=close" onclick="$('#add_success').fadeOut();$('#fname').focus()">&times;</button>
				<center><h4 class="modal-title">Congrats</h4></center>
			</div>
			<div class="modal-body">
				<center><p>New Contact Successfully Added</p></center>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_GET['taken_cellnum']) == 1 ){ ?>
	<script type='text/javascript'>
		 

		var modal = document.getElementById('add_err');
		$('#add_err').fadeIn();

		
		window.onclick = function(event) {
			if (event.target == modal) {
				$('#add_err').fadeOut();
			}
		}
	</script>	
<?php	
	}
	if(isset($_GET['contact_added']) == 1 ){ ?>
	<script type='text/javascript'>
		var modal = document.getElementById('add_success');
		$('#add_success').fadeIn();

		
		window.onclick = function(event) {
			if (event.target == modal) {
				$('#add_success').fadeOut();
			}
		}
	</script>		 
<?php	
	}
?>
</body>
</html>		
