<?php 

	session_start();
	
	if(isset($_POST['comment'])){
		require("admin/connect.php");
		
		$comment = $_POST['comment'];
		$id_pro = $_POST['id_pro'];
		
		if(!isset($_SESSION['user'])){
			echo "no_reg";	
			
		}else{
			
			if($_POST['comment'] == ""){
				echo "no_com";
			}else{
				
			
				
				$id_user = $_SESSION['id_user'];
				$username = $_SESSION['user'];
				$firstname = $_SESSION['firstname'];
				$lastname = $_SESSION['lastname'];
				$product_name =	$_SESSION['product_name'];
					
				
				
				
				$insert = mysqli_query($con,"INSERT INTO  comment(comment, username, firstname, lastname, product_name, id_pro, chek, news) VALUES ('$comment', '$username', '$firstname', '$lastname', '$product_name',  '$id_pro', '0', '00')"); 
				
				if($insert == true){
					echo "yes_com";
				}	
			
			
			}
			
		}
		
		
		
	
	
	}else{
		
		header('Location:index.php');
	}






?>