<?php
ob_start();
session_start();
include ('dbcon.php');
include ('functions.php');



$listpermsion9="SELECT * FROM permission_role Where per_role='Orderlist' AND status='yes' AND acc_id='".$_SESSION['posseetango_id']."'";
								$resultpersssion9= mysqli_query($conn,$listpermsion9);
								if(mysqli_num_rows($resultpersssion9) > 0)
								{ 



?>

	






<br>
<br>
<table id="examplek" class="table table-bordered key-buttons text-nowrap" >

												<thead>
													<tr>
														<th class="bg-primary">#</th>
														<th class="bg-primary">PIN Code</th>
														<th class="bg-primary">Serial Code</th>
														<th class="bg-primary">Amount</th>
														<th class="bg-primary">Status</th>
														<th class="bg-primary">Created Date</th>
														<th class="bg-primary">Updated Date</th>
														<th class="bg-primary">Updated By</th>
														<th  width="15" class ="bg-primary"></th>


														<?php

														$listpermsion9="SELECT * FROM permission_role Where per_role='casherorder' AND status='yes' AND acc_id='".$_SESSION['posseetango_id']."'";
															$resultpersssion9= mysqli_query($conn,$listpermsion9);
															if(mysqli_num_rows($resultpersssion9) > 0)
															{ 

														 ?>

														<th  width="15" class ="bg-primary"></th>
														<?php

													}

													$listpermsion9="SELECT * FROM permission_role Where per_role='cheeforder' AND status='yes' AND acc_id='".$_SESSION['posseetango_id']."'";
															$resultpersssion9= mysqli_query($conn,$listpermsion9);
															if(mysqli_num_rows($resultpersssion9) > 0)
															{ 

													?>
														<th  width="15" class ="bg-primary"></th>
														<?php

													}

														?>




													</tr>
												</thead>


												<tbody >





													<?php
						
						
						
                       $counter=1;                   
                       $projectlist= "SELECT * FROM tbl_pin_codes ";
							 $resultclist= mysqli_query($conn,$projectlist);
							if(mysqli_num_rows($resultclist) > 0)
							{
							while($rows= mysqli_fetch_array($resultclist))
							{												
							?>

													<tr>
														<td style="vertical-align:middle;"><?php echo $counter++; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["PinCode"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["SerialCode"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["Amount"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["Status"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["CreatedDate"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["UpdatedDate"]; ?></td>
														<td style="vertical-align:middle;"><?php echo $rows["UpdatedBy"]; ?></td>

														<?php

														$listpermsion9="SELECT * FROM permission_role Where per_role='casherorder' AND status='yes' AND acc_id='".$_SESSION['posseetango_id']."'";
															$resultpersssion9= mysqli_query($conn,$listpermsion9);
															if(mysqli_num_rows($resultpersssion9) > 0)
															{ 

														 ?>
															<td style="vertical-align:middle;">
														<a href="orderupdate.php?order=<?php echo $rows["pin_id"];?>">
														<button type="button" class="btn btn-danger btn-sm">View</button>
														</a>
														</td>



																<?php

													}

													$listpermsion9="SELECT * FROM permission_role Where per_role='cheeforder' AND status='yes' AND acc_id='".$_SESSION['posseetango_id']."'";
															$resultpersssion9= mysqli_query($conn,$listpermsion9);
															if(mysqli_num_rows($resultpersssion9) > 0)
															{ 

													?>





															<td style="vertical-align:middle;">
														<a href="cheeforder.php?order=<?php echo $rows["pin_id"];?>">
														<button type="button" class="btn btn-info btn-sm">Order List</button>
														</a>
														</td>

													</tr>




													<?php

													}

														?>

							<?php  
							   
							}
						    }							
							?>				


									
												
												</tbody>
												
											</table>

<script type="text/javascript">

$(document).ready(function(){  
      $('.view_data').click(function(){  
           var order_id = $(this).attr("id");  
           $.ajax({  
                url:"dashbord.php",  
                method:"POST",  
                data:{pin_id:pin_id},  
                success:function(data){  
                  
 
                }  
           });  
      });  
 }); 

<?php 
ob_end_flush();

}

?>

	</script>