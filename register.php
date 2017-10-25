<?php 
	$form_error = "";
	$success = "";
	$confirms = "";
	$user_error ="";
	$email_error ="";
	
	require("admin/connect.php");
	require("header.php");

	if(isset($_POST['reg'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		$gender = $_POST['gender'];
		
		
		if(empty($_POST['name']) && empty($_POST['surname']) && empty($_POST['username']) && empty($_POST['password'])){
			$form_error = '
						
						<div class="alert alert-warning">
						  <strong>Warning!</strong> Fill the whole form.
						</div>
					';
						
						
			
		}else{
			if($password == $confirm){
				
				$result = mysqli_query($con,"SELECT * FROM users  WHERE  username = '$username' or email = '$email' ");
				$assoc = mysqli_fetch_assoc($result);
				$num = mysqli_num_rows($result);
				
				if($num == 1){
					
					if($assoc['email'] == $email){
						$email_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> User with such an  e-mail already exists!
								</div>
					
								';
						
					}
					if($assoc['username'] == $username){
						$user_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> User with such an  username already exists!
								</div>
					
								';
					}	
					
					
					
					
				}else{
					$insert = mysqli_query($con,"INSERT INTO  users(firstname, lastname, email, username, password, gender ) VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$gender ' )");
				
					if($insert==true){
						$success = '

							<div class="alert alert-success">
								<strong>Success!</strong> You Are Registrated!!!.
							</div>
										';
			
			
			
					}
					
					
				}
				
				
				
			}
			else{
			
					$confirms = '
					
					<div class="alert alert-warning">
					  <strong>Warning!</strong> Confirmation does not match the password.
					</div>
		
					';
				}
		
			
		
		
		
		
		
		
		
		}
	
	}	 

	








?>



	<div class="container">
  
		<div class="row">                
			<div id="content" class="col-sm-12">      
				<h1  class="reg_h1">Register Account</h1>
				<?php echo  $form_error; ?>
				<?php echo  $success; ?>
				<form action="" method="post"  class="form-horizontal">
					
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-firstname">First Name</label>
						<div class="col-sm-10">
							<input type="text" name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
						<div class="col-sm-10">
							<input type="text" name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control">
						</div>
					</div>
					
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-password">Username</label>
						<div class="col-sm-10">
							<input type="text" name="username" value="" placeholder="Username" id="input-password" class="form-control">
							<?php echo $user_error; ?>
						</div>
					</div>
					
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-email">E-Mail</label>
						<div class="col-sm-10">
							<input type="email" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
							<?php echo $email_error; ?>
						</div>
					</div>
					
					<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-password">Password</label>
							<div class="col-sm-10">
							  <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
							</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
						<div class="col-sm-10">
							<input type="password" name="confirm" value="" placeholder="Password Confirm" id="input-confirm" class="form-control">
							<?php echo $confirms; ?>
						</div>
							
					</div>
					
					<div class="form-group"  id="reg_rad">
					
					
						<label class="col-sm-2 control-label" for="input-confirm">Floor</label>
						<div class="radio rad">
							<label><input type="radio" name="gender"  value="male" checked>Male</label>
						</div>
						<div class="radio rad">
							<label><input type="radio" name="gender"  value="female">Female</label>
						</div>
						
					</div>
					
					
					<div class="buttons">
						<div class="pull-right">                        
							
										
							<input type="submit" name="reg" class="btn btn-primary">
							
						</div>
					</div>
					
					
					
				</form>
				
			</div>
			
		</div>
		
		
</div>





























<?php include("footer.php") ?>