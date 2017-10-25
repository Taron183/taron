<?php 
	$format_error="";
	if(isset($_GET['id'])){
		require("connect.php");
		require("menu.php");
		$id = $_GET['id'];
		
		$result = mysqli_query($con, "SELECT * FROM slider WHERE id = '$id' ");
		$assoc = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)== 0){
			header("location:admin.php");
			
			
		}else{
			if(isset($_POST['Update'])){
				$eng_title1 = $_POST['eng_title1'];
				$rus_title1 = $_POST['rus_title1'];
				$eng_title2 = $_POST['eng_title2'];
				$rus_title2 = $_POST['rus_title2'];
				$eng_des = $_POST['eng_des'];
				$rus_des = $_POST['rus_des'];
				$image = $_FILES['file']['name'];
				
				if($image == ""){
					$update = mysqli_query($con, "UPDATE slider SET eng_title1 = '$eng_title1', rus_title1 = '$rus_title1', eng_title2 =  '$eng_title2', rus_title2 = '$rus_title2', eng_des =  '$eng_des', rus_des = '$rus_des'
						WHERE id= '$id'
				     ");
					header("location:admin.php"); 
				}else{
					$format = ['jpeg','jpg'];
					$exp = explode('.', $image);
					$end = end($exp);
					$md5_img=md5($image .date("h/m/s/m/d/y")).'.'.$end;
					if(in_array($end,$format)== true){
					
						$tep_name = $_FILES['file']['tmp_name'];
						$src="../images/uploade/".$md5_img;
						$up_img = move_uploaded_file($tep_name , $src);
						
						if($up_img == true){
							$update = mysqli_query($con, "UPDATE slider SET image = '$md5_img',eng_title1 = '$eng_title1', rus_title1 = '$rus_title1', eng_title2 =  '$eng_title2', rus_title2 = '$rus_title2', eng_des =  '$eng_des', rus_des = '$rus_des'
								WHERE id= '$id'
							 ");
							 
							 unlink("../images/uploade/".$assoc['image']);
							 header("location:admin.php");
							
						}
					
					
					
					
					}else{
						$format_error='
							<div class="alert alert-warning">
								<strong>Warning!</strong>The format of the image should be "jpg", ".jpeg".
							</div>
						
						';
					}
				
				}
			}	
		}
	}else{
		header("location:admin.php");
	}
	
	
?>





	
		
			<?php echo $format_error; ?>
		<div class="container conter_edit">
			<form  action=""  method="post"  enctype="multipart/form-data">
			
				
				<div class="form-group">
					
					<img class="img_a" src="../images/uploade/<?php echo $assoc['image'];?>">
				</div>
				
				<div class="form-group">
					
					<input type="file" name="file" class="custom-file-input">
				</div>
			
				
				<div class="form-group">
					<label for="usr">Title 1:</label>
					<input type="text" name="eng_title1" class="form-control" id="usr" value="<?php echo $assoc["eng_title1"]; ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Загаловка 1:</label>
					<input type="text" name="rus_title1" class="form-control" id="usr" value="<?php echo $assoc["rus_title1"]; ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Title 2:</label>
					<input type="text"  name="eng_title2" class="form-control" id="usr" value="<?php echo $assoc["eng_title2"]; ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Загаловка 2:</label>
					<input type="text" name="rus_title2" class="form-control" id="usr" value="<?php echo $assoc["rus_title2"]; ?>">
				</div>
				
				<div class="form-group">
					<label for="comment">Description:</label>
					<textarea class="form-control" name="eng_des" rows="5" id="comment"      ><?php echo $assoc["eng_des"]; ?></textarea>
				</div>
				
				<div class="form-group">
					<label for="comment">Описание:</label>
					<textarea class="form-control" name="rus_des"  rows="5" id="comment"><?php echo $assoc["rus_des"]; ?></textarea>
				</div>
				
				<div class="form-group">
					<button type="submit" name="Update" class="btn btn-default">UPDATE</button>	
				</div>
				
				
			</form>
		</div>
	
	
	</body>
	
	
</html>