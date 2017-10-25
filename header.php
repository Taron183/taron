<?php 

	session_start();
	
	$log_error = "";

	
	
	
  
  if(!isset($_SESSION['lang'])){
		$lang = "eng";
	}else{
		$lang = $_SESSION['lang'];
	}
	
	if(isset($_POST['log_in'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$result = mysqli_query($con,"SELECT * FROM users  WHERE username = '$username' or password = '$password'");
		$assoc = mysqli_fetch_assoc($result);
		$num = mysqli_num_rows($result);
		if($num == 1){
			$_SESSION['user'] = $assoc['username'];
			$_SESSION['id_user'] = $assoc['id']; 
			$id_user = $_SESSION['id_user'];
			$_SESSION['firstname'] = $assoc['firstname'];
			$_SESSION['lastname'] = $assoc['lastname'];
			
			
			
			
			
			
			
			
			
		
		
		}else{
			$log_error='
			
						<div class="alert alert-warning">
							<strong>Warning!</strong> Username оr password  combination incorrect.
						</div>
			
						';	
		
		}
	}
  
		
  
	
?>		
		
<html>
	
	<head>
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script  src="js/jquery-3.2.1.js"> </script>
		<script  src="js/main.js"> </script>
		<script  src="js/bootstrap.min.js"> </script>
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		
	</head>
	
	<body>
		
		<header>
			<div class="header1">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="container">
						<div class="menu_top">
							<ul>
					
								
								
								<?php if(!isset($_SESSION['user'])){
									  echo '
										<li class="menu_li"><a href="#"><span>Wish List <i>(0)</i></span></a></li>
										<li class="menu_li"><a href="register.php"><span>Register </span></a></li>
										<li class="menu_li">
										  
										  <div class="dropdown">
											<button class="btn btn-primary bt-primary dropdown-toggle" type="button" data-toggle="dropdown">Login
											<span class="caret"></span></button>
											<ul class="dropdown-menu drop_log">
											<form  action="" method="post">
											  <li>
												<div class="form-group">
												  <label for="usr">Username:</label>
												  <input type="text" name="username"  class="form-control" id="usr">
												</div>
											  </li>
												
											  <li>
												<div class="form-group">
												  <label for="usr">Password:</label>
												  <input type="password" name="password" class="form-control" id="usr">
												</div>
											  </li>
											  
											  <li>
												
												<div class="form-group" style="text-align:right" >
												  <button  type="submit" name="log_in" class="btn btn-success">Log in</button>
												</div>	
												
											  </li>
											  
											</form>	
											
											</ul>
										  </div>
										</li>';
									}
									else{
										echo '
											<li class="menu_li"><a href="#"><span> My Account <i>('.$_SESSION['user'].')</i></span></a></li>
											<li class="menu_li"><a href="#"><span>Wish List <i>(0)</i></span></a></li>
											<li class="menu_li"><a href="log_out.php"><span>Log Out</span></a></li>
										  
										';
									}
								?>
								
								
								
								
								
							</ul>
						</div>
						
					
						
						<div class="dropdown pull-right">
							<button class="btn dropdown-toggle btl " type="button" data-toggle="dropdown"><span class="spantext"><?php echo $lang; ?></span>
							<span class="caret"></span></button>
							
								<ul class="dropdown-menu">
									<li><a class="eng_a" href="lang.php?lang=<?php echo 'eng'; ?>">eng</a></li>	
									<li><a class="rus_a" href="lang.php?lang=<?php echo 'rus'; ?>">rus</a></li>	
								</ul>
							
						</div>
						
						
						<div class="dropdown pull-right cart">
							<button class="btn btl  dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-shopping-bag" aria-hidden="true"></i><strong>Cart:</strong>0 item(s)
							<span class="caret"></span></button>
							<ul class="dropdown-menu cartmenu">
								<li class="cart-name">Cart</li>
								<li class="cart-text">
									<p class="text-empty">Your shopping cart is empty!</p>
								</li>
							</ul>
						</div>
						
						<div class="pull-right wel">	
							<em>Welcome to our online store!</em>
						</div>
						
						<div  class="log">
							<?php echo $log_error; ?>
						</div>
					
					</div>
					
					
				
		
				</div>	
				
			</div>
			
			
		
		
		
			<div class="container">    
								
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
						<div class="text">
							<div  class="phone">
								<span><a href="#">+3(800) 2345-6789</a></span>
							</div>
							<div class="day">
								<p> 7 Days a  from 9:00 am to 7:00 pm</p>
							</div>
						</div>	
					</div>
					<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12  pad" >
						<div class="logo text-center">	
							<a href="index.php">
								<img src="images/logo-295x44.png"  alt="Image">
							</a>
						</div>	
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12  pad">
						<div  class="social">
							<ul>
								<li><a href="#"><i class="fa fa-facebook" ></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
								
							</ul>
						</div>
					</div>
				</div>	
				
			</div>
			<div class="container">
			
				<nav class="navbar   navbar-default navmenu">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header full-left">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav menu">
								<li class="nav-item">
									<a class="nav-link" href="#">Bathroom Vanities</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Exterior Lighting</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " href="#">Chandeliers</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " href="#">Ceiling Lights</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " href="#">Wall Sconces</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " href="#">Lamps</a>
								</li>
								
								<div class="search">
									<a class="top-search">
										<i class="fa fa-search" aria-hidden="true"></i>
									
									</a>
									
									
									<div id="search" style="width: 0px; opacity: 0; display: none;">
										<div class="inner">
										<input type="text" name="search" value="" placeholder="">
											<button type="button" class="button-search"><i class="material-icons-search"></i></button>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</ul>
						  
						
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>	
		</header>
		

