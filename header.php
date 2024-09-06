<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- Title -->
		<title>NP</title>
		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <!--Font Awesome-->
		<link href="assets/plugins/fontawesome-free/css/all.css" rel="stylesheet">
		<!-- Dashboard Css -->
		<link href="assets/css/dashboard.css" rel="stylesheet" />
		<!-- vector-map -->
		<link href="assets/plugins/vector-map/jqvmap.min.css" rel="stylesheet">
		<!-- Custom scroll bar css-->
		<link href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
		<!-- Sidemenu Css -->
		<link href="assets/plugins/toggle-sidebar/css/sidemenu.css" rel="stylesheet">
		<!-- morris Charts Plugin -->
		<link href="./assets/plugins/morris/morris.css" rel="stylesheet" />
		<!---Font icons-->
		<link href="assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
		<!-- Slect2 css -->
		<link href="assets/plugins/select2/select2.min.css" rel="stylesheet" />
		<!-- Time picker Plugin -->
		<link href="assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />
		  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

		<!-- Date Picker Plugin -->
		<link href="assets/plugins/date-picker/spectrum.css" rel="stylesheet" />
		<!--mutipleselect css-->
		<link rel="stylesheet" href="assets/plugins/multipleselect/multiple-select.css">
<!-- Data table css -->
		<link href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




	</head>
	<body class="app sidebar-mini rtl">
<?php

										if(isset($_SESSION['posseetango_id']))
                                        {
											$posseetangoid=$_SESSION['posseetango_id'];
										$accounts= "SELECT * FROM account_table   WHERE account_id='".$_SESSION['posseetango_id']."' ";
										$resultlists = mysqli_query($conn,$accounts);
										if(mysqli_num_rows($resultlists) > 0)
										{
										while($rowi= mysqli_fetch_array($resultlists))
										{	
									    
										$accountid=$_SESSION['posseetango_id'];
										$accountname=$rowi['account_full_name'];
										?>
<header class="app-header header">


	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
				
				
				
					<div class="app-sidebar__user">
						<div class="user-body">
							<span class="avatar avatar-lg brround text-center" style="background-image: url(assets/images/users/male/user.png)"></span>
						</div>
						<div class="user-info">
							<div href="#" class="ml-2"><span class="text-dark app-sidebar__user-name font-weight-semibold"><?php  echo $rowi['account_full_name']; ?></span><br>
								<span class="text-muted app-sidebar__user-name text-sm"><?php  echo $rowi['user_position']; ?></span>
							</div>
						</div>
					</div>
					
					<ul class="side-menu">
					
						<li>
							<a class="side-menu__item" href="dashbord.php"><i class="side-menu__icon si si-layers"></i><span class="side-menu__label">Dashbord</span></a>
						</li>


						<?php


		$listpermsion2="SELECT account_type FROM account_table Where account_id='".$_SESSION['posseetango_id']."'";
								$resultpersssion2= mysqli_query($conn,$listpermsion2);
								$row = mysqli_fetch_assoc($resultpersssion2);
								$account_type = $row['account_type'];
								if ($account_type == 'Admin') {
								
							?>
						<li>
							<a class="side-menu__item" href="UploadItem.php"><i class="side-menu__icon si si-layers"></i><span class="side-menu__label">Upload Items</span></a>
						</li>
						<?php

								}

								
		$listpermsion2="SELECT account_type FROM account_table Where account_id='".$_SESSION['posseetango_id']."'";
								$resultpersssion2= mysqli_query($conn,$listpermsion2);
								$row = mysqli_fetch_assoc($resultpersssion2);
								$account_type = $row['account_type'];
								if ($account_type == 'Admin' or $account_type == 'User') { 
							?>
						<li>
							<a class="side-menu__item" href="search.php"><i class="side-menu__icon si si-layers"></i><span class="side-menu__label">Search</span></a>
						</li>
						<?php

								
}

		$listpermsion2="SELECT account_type FROM account_table Where account_id='".$_SESSION['posseetango_id']."'";
								$resultpersssion2= mysqli_query($conn,$listpermsion2);
								$row = mysqli_fetch_assoc($resultpersssion2);
								$account_type = $row['account_type'];
								if ($account_type == 'Admin') { 
							?>
						<li>
							<a class="side-menu__item" href="Data.php"><i class="side-menu__icon si si-layers"></i><span class="side-menu__label">All Voucher Cards</span></a>
						</li>
						<?php

								}				



			  
							?>
						
						
				</aside>



				<!-- Dashboard Core -->

					<!-- Navbar Right Menu-->

<?php


					 	$accounts1= "SELECT * FROM system_content_table";
										$resultlists1 = mysqli_query($conn,$accounts1);
										if(mysqli_num_rows($resultlists1) > 0)
										{
										while($row1= mysqli_fetch_array($resultlists1))
										{	
									    
										$photo=$row1['company_logo'];
										$address=$row1['company_address'];
										$phone=$row1['company_phone'];
										$namecompany=$row1['company_name'];
									

								}}?>

					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="dashbord.php">
								<h1>CMS</h1>




							</a>
							<!-- Sidebar toggle button-->
							
							<div class="d-flex order-lg-2 ml-auto">
								<div class="d-none d-md-flex">
									<a href="#" class="nav-link icon full-screen-link" id="fullscreen-button">
										<i class="fe fe-minimize " ></i>
									</a>
								</div>
								
								<div class="dropdown">
								
										
										<br>



<div class="text-center">
    <form method="POST" action="">
        <button class="btn btn-primary btn-sm" type="submit" name="logout">
            <i class="si si-share-alt"></i> Log Out
        </button>
    </form>
    <br>
</div>

<?php
if (isset($_POST['logout'])) {
    adminlogout(); // This function is called when the form is submitted
}
?>

								
								
								
								</div>
							</div>
						</div>
					</div>
				</header>

<?php  }  }  } ?>
	

	<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>