<?php
// MySQLi connection
   require_once("../../database/connect.php"); 
//Deleting a user from the table
	if(isset($_GET['del'])){
		$del_id = $_GET['del'];
		$del_images = "select image from product where product_id='$del_id'";
	    $run_users = mysqli_query($con, $del_images);
	    $row = mysqli_fetch_assoc($run_users);
	    unlink('./images/'.$row['image']);
		$delete = "delete from product where product_id='$del_id'";
	    $run_delete = mysqli_query($con, $delete); 
		if($run_delete){
			 echo "<script>alert('A user has been deleted!')</script>";
			 header('Location: view.php');
		}  
	}
