<?php
session_start();
include ('config.php');
include('dbcon.php');

date_default_timezone_set("Asia/Baghdad");
if(isset($_SESSION['posseetango_id']))
{	
  echo "<script>window.location.assign('dashbord.php')</script>";
}
else
{
?>

<html lang="en" dir="ltr">
  <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="assets/images/brand/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico" />

		<!-- Title -->
		<title>Restorant</title>

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

        <!--Font Awesome-->
		<link href="assets/plugins/fontawesome-free/css/all.css" rel="stylesheet">

		<!-- Custom scroll bar css-->
		<link href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!-- Dashboard Css -->
		<link href="assets/css/dashboard.css" rel="stylesheet" />

		<!---Font icons-->
		<link href="assets/plugins/iconfonts/plugin.css" rel="stylesheet" />

	</head>
	<body class="login-img custom-bg">
		
		
		<div id="global-loader" ><div class="showbox"></div></div>

		<div class="page">
			<div class="custompage">
				<div class="custom-content  mt-0">
					<div class="row">
						<div class="col-lg-8 d-block mx-auto">
							<div class="row">
								<div class="col-md-12">
			
			
						<?php
		

	if(isset($_POST['loginsin']))
	{
		$errMsg = '';
		// Get data from FORM
		$username = $_POST['emadcscil'];
		$password = md5($_POST['pasfefd']);
		if($username == '')
		{
			$errMsg = 'Enter username';
		}
		if($password == '')
		{
			$errMsg = 'Enter password';
		}
		
		if($errMsg == '') {
			try {
				$stmt = $connect->prepare("SELECT * FROM account_table WHERE account_username= :username  AND account_static='Active' ");
				$stmt->execute(array(
					':username' => $username
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($data == false)
				{
					$errMsg = "User $username Not found.";
				}
				else 
				{
					if($password == $data['account_password']) 
					{
						$_SESSION['posseetango_id'] = $data['account_id'];
						$_SESSION['accountfullname'] = $data['account_full_name'];
						$_SESSION['accounttype'] = $data['account_type'];
						$_SESSION['accfullname']  = $data['account_full_name'];
						echo "<script>window.location.assign('dashbord.php')</script>";
						
					}
					else
						$errMsg = 'Password Not Match.';
				}
			}
			catch(PDOException $e) 
			{
				$errMsg = $e->getMessage();
			}
		}
        
	    }
	if(!isset($_SESSION['posseetango_id']))
       {	


       	$accounts1= "SELECT * FROM system_content_table";
										$resultlists1 = mysqli_query($conn,$accounts1);
										if(mysqli_num_rows($resultlists1) > 0)
										{
										while($row1= mysqli_fetch_array($resultlists1))
										{	
									    
										$photo=$row1['company_logo'];


									  }
								    }


		   ?>
			



			
							
							<form  action=""  method="POST">
							
							<div class="col-md-12">
									<h3 class="text-center">Login to your Account</h3>
									<div class="form-group">
										<label class="form-label text-left" for="exampleInputEmail1">Username</label>
										<input type="text" class="form-control" name="emadcscil" id="exampleInputEmail1"  placeholder="Username" >
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="text-left form-label">Password</label>
										<input type="password" class="form-control" name="pasfefd" id="inputPassword3" placeholder="Password"  >
									</div>
										<button class="btn btn-primary" type="submit" name="loginsin">Sign in</button>										
										<button class="btn btn-primary" type="submit" name="home">Home</button>
								</div>
							
						</form>

				
				 <?php  } ?>
				 
				 </div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
				
			</div>
		</div>
	</div>
<!-- Dashboard js -->
		<script src="assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="assets/js/vendors/selectize.min.js"></script>
		<script src="assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="assets/js/vendors/circle-progress.min.js"></script>
		<script src="assets/plugins/rating/jquery.rating-stars.js"></script>

		<!--Bootstrap.min js-->
		<script src="assets/plugins/bootstrap/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Counters -->
		<script src="assets/plugins/counters/counterup.min.js"></script>
		<script src="assets/plugins/counters/waypoints.min.js"></script>

		<!-- Custom js -->
		<script src="assets/js/custom.js"></script>

	</body>
</html>

<?php 
 }  
?>