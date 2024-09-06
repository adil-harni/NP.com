
<?php 

function adminlogout(){
	if(isset($_POST['logout'])){
		
		
		session_destroy();
		header("location: index.php");
				  exit();
		
	}
}

	
?>


