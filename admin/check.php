<?php
	session_start();
	$con=mysqli_connect("localhost", "root", "", "das4");
	if(isset($_POST['logo'])){
		$logo = $_POST['logo'];
		$pass = $_POST['pass'];
		$resalt = mysqli_query($con, "SELECT * FROM admin WHERE  logo = '$logo' AND  pass = '$pass'");
		$rows = mysqli_num_rows($resalt);
		if($rows == 1){
			$_SESSION['admin']="admin";
			echo "yes";
		}
		else{
			echo "no";
		}
		
		
		
	}else{
		header("location:index.php");
	}
	
		
	
	
	
	
	








?>