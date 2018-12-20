<?php
 	include('database.php');
	$user_id = $_SESSION['user_id'];
   	if(isset($_POST['submit'])){
		$contact_fields = $_POST['contact_fields']; 
		$search_value	= $_POST['search_value'];
		header("location: ?fields_name=$contact_fields&value=$search_value");
	}
	$search_value = '';
	$fields_name  = '';
	if(isset($_GET['fields_name'])==1){
		if($_GET['fields_name'] === "Name"){
			$fields_name = 'CONCAT(First_Name," ", Last_Name)';
		}else{
			$fields_name = $_GET['fields_name'];
		}
	}
	if(isset($_GET['value'])==1){
		$search_value = $_GET['value'];
	}
	if( !(empty($search_value)) || !(empty($fields_name))  ){
		$q= "Select Contact_ID, CONCAT(First_Name,' ', Last_Name) as Name, Phone_Number, Home_Phone_Number, City, State, ZIpcode from contacts where $fields_name LIKE '%$search_value%' AND User_ID ='$user_id'";
	
	}else{
		$q= "Select Contact_ID, CONCAT(First_Name,' ', Last_Name) as Name, Phone_Number, Home_Phone_Number, City, State, ZIpcode from contacts where User_ID ='$user_id'";
	}
	$result = mysqli_query($conn, $q);
	$total_contacts = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
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
<br>
<br>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">	
				<div class="container-fluid">
					
					<table class="table  table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Complete Name</th>
								<th>Phone Number</th>
								<th>Home Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zipcode</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php $count=1;while ($row = mysqli_fetch_array($result)) { ?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['Name'] ?></td>
								<td><?php echo $row['Phone_Number'] ?></td>
								<td><?php echo $row['Home_Phone_Number'] ?></td>
								<td><?php echo $row['City'] ?></td>
								<td><?php echo $row['State'] ?></td>
								<td><?php echo $row['ZIpcode'] ?></td>
								<td>
									<a href="index.php?view_contact_id=<?php echo $row["Contact_ID"]; ?>"><span class="glyphicon glyphicon-eye-open" title="View Profile"></span></a> 
									<a href="update_contact.php?id=<?php echo $row["Contact_ID"]; ?>"><span class="glyphicon glyphicon-pencil" title="Update"></span> </a> 
									<a href="index.php?delete_contact_id=<?php echo $row["Contact_ID"] ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></i></a>
								</td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
					
					<?php 
						if($total_contacts<1 && !(empty($search_value))){
							if( $fields_name=='CONCAT(First_Name," ", Last_Name)' ){
								$fields_name = "Name";
							}
					?>
						<h3 style="text-align:center;margin-top:30px;"><?php echo $fields_name .' "'.$search_value.'"';  ?> Not Found</h3>
					<?php } ?>
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET['view_contact_id']) == 1 ){ ?>
				<?php include('view_contact.php'); ?>
				<script type='text/javascript'>
					$('#view_contact').fadeIn();
					window.onclick = function(event) {
						if (event.target == modal) {
							$('#view_contact').fadeOut();
						}
					}
				</script>	
			<?php } ?>
			<?php
			if(isset($_GET['delete_contact_id']) == 1 ){ ?>
				<?php include('delete_contact.php'); ?>
				<script type='text/javascript'>
					$('#delete_contact_id').fadeIn();
					
					window.onclick = function(event) {
						if (event.target == modal) {
							$('#delete_contact_id').fadeOut();
						}
					}
				</script>	
			<?php } ?>
	</div>	
</div>
</body>
</html>		
