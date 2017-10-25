<?php 
	session_start();
	
	
	if(isset($_GET['lang']) && !empty($_GET['lang'])){
		require("admin/connect.php");
				
		$_SESSION['lang'] = $_GET['lang'];
	
	
		if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		else{
			header("Location: index.php");
		}
	
	}else{
		header("Location: index.php");
	}
	
	
	
	





?>