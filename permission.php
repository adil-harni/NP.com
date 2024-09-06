<?php
ob_start();
session_start();
include ('dbcon.php');
include ('functions.php');
date_default_timezone_set("Asia/Baghdad");
if(isset($_SESSION['posseetango_id']))
{

 
	
	include('header.php');
?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				
				<!--side-menu-->

				<div class=" app-content my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h3 class="page-title"> Permission</h3>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Permission</li>
							</ol>
						</div>
						
						

					    <div class="row">
				      
					  <?php
 
			 if(isset($_POST['submitpermission']))
			 {
					$accc=$_POST['useracc'];
					foreach($_POST['role'] as $index => $val){
					  $sql= "INSERT INTO `permission_role`(`per_role`,`status`, `acc_id`)
					 VALUES('$val','yes','$accc')";
					 $result= mysqli_query($conn,$sql);
				 if($result)
				 {
					 
			     }
			   }
				echo "<h5 style='color:#008ae6;;'>Permission Roles Set</h5>";
			}
			?>	
				     		<div class="col-md-12">
									<div class="card shadow">
										<div class="card-header">
										<form action=""   method="POST">
		<select class="form-control"  name="useracc" Required style="display:inline; width:200px;">
		 <option  value="">System User</option>
		 <?php			
			$account= "SELECT * FROM   account_table";
			$resultlist = mysqli_query($conn,$account);
			if(mysqli_num_rows($resultlist) > 0)
			{
			while($rowl= mysqli_fetch_array($resultlist))
			{
			?>							
			<option style="color:black;" value="<?php echo $rowl['account_id']; ?>"><?php echo $rowl['account_full_name']; ?></option>					
			<?php
			}
			}
			?>
		 </select>	
						</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
													<div class="custom-control custom-checkbox mb-3">
														<input class="custom-control-input" name="role[]" id="customCheck026" value="Dashboard" type="checkbox">
														<label class="custom-control-label" for="customCheck026">Dashboard</label>
													</div>
													<div class="custom-control custom-checkbox mb-3">
														<input class="custom-control-input" name="role[]" id="customCheck027" value="Dashboardinfo" type="checkbox">
														<label class="custom-control-label" for="customCheck027">Dashboard Info</label>
													</div>


												</div>
											</div>
										</div>
										<div class="card-header">
										<button class="btn btn-info btn-sm" type="submit" name="submitpermission">Submit</button>
										</div>
										</form>
									</div>
								</div>
					
					   </div>
					   </div>
					   </div>

						

					
				


					<!--footer-->
		

	<?php  include('footer.php');  ?>

<?php
ob_end_flush();


}
else{
	echo "<script>window.location.assign('index.php')</script>";
	

}

?>