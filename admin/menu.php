

<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("location:index.php");
	
	}
	
	
	
	
	
	
	
	
	
	
	$res = mysqli_query($con,"SELECT * FROM  comment  WHERE  news = '00'");
	$assoc = mysqli_fetch_assoc($res);
	$num = mysqli_num_rows($res)
	
	
	




?>
<html>
	<head>
		
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/admin.css">
		<script src="../js/jquery-3.2.1.js"></script>
		<script src="../js/admin.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		
		
	
	
		
	</head>
	<body>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		
		
		<ul class="nav navbar-nav">
			<li ><a  href="admin.php">Home</a></li>
			<li ><a href="category.php">Category</a></li>
			<li ><a href="comment_admin.php">Comment  <strong class="str">(<?php if($assoc['news'] == 00){echo $num;}  ?>)</strong></a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			
			<li><a href="logout.php" ><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
		</ul>
	</div>
</nav>