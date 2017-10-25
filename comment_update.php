<?php
	
	
	
	if(isset($_POST['id_comment'])){
		require("admin/connect.php");
		$id_comment = $_POST['id_comment'];
		$chek = $_POST['chek'];
		
		mysqli_query($con,"UPDATE  comment SET chek = '$chek' WHERE id = '$id_comment'");
		echo $id_comment;
		echo $chek;
		
	}
	else{
		header("location:index.php");
	}
	
	

	


 ?>
 
 
 	