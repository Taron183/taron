<?php 
	$format_error="";
	if(isset($_GET['id_edits'])){
		require("connect.php");
		require("menu.php");
		$id_cat=$_SESSION['id_cat'];
		
		
		$id_edits = $_GET['id_edits'];
		$result = mysqli_query($con, "SELECT * FROM product WHERE id = '$id_edits' ");
		$assoc = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)== 0){
			header("location:product.php");
			
			
		}else{
			if(isset($_POST['edits'])){
				$image = $_FILES['file']['name'];
				$name_eng=$_POST['name_eng'];
				$name_rus=$_POST['name_rus'];
				$price=$_POST['price'];
				$price_sale=$_POST['price_sale'];
				$count=$_POST['count'];
				$eng_des = $_POST['eng_des'];
				$rus_des = $_POST['rus_des'];
				
				if($image == ""){
					$update = mysqli_query($con, "UPDATE product SET  name_eng = '$name_eng',  name_rus=  '$name_rus', price = '$price', price_sale = '$price_sale',count= '$count', eng_des =  '$eng_des', rus_des = '$rus_des'
						WHERE id= '$id_edits'
				     ");
					
					 
				}else{
					$format = ['jpeg','jpg'];
					$exp = explode('.', $image);
					$end = end($exp);
					$md5_img=md5($image .date("h/m/s/m/d/y")).'.'.$end;
					if(in_array($end,$format)== true){
					
						$tep_name = $_FILES['file']['tmp_name'];
						$src="../images/".$id_cat."/".$id_edits."/".$md5_img;
						$up_img = move_uploaded_file($tep_name , $src);
						
						if($up_img == true){
						
							 
							 $update = mysqli_query($con, "UPDATE product SET image = '$md5_img', name_eng = '$name_eng',  name_rus=  '$name_rus', price = '$price', price_sale = '$price_sale',count= '$count', eng_des =  '$eng_des', rus_des = '$rus_des'
							WHERE id= '$id_edits'
								");
							 
							 unlink("../images/".$id_cat."/".$id_edits."/".$assoc['image']);
							
							
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
		header("location:product.php");
	}
	$result = mysqli_query($con, "SELECT * FROM product WHERE id = '$id_edits' ");
	$assoc = mysqli_fetch_assoc($result);
	
?>





	
		
			<?php echo $format_error; ?>
		<div class="container conter_edit">
			<form  action=""  method="post"  enctype="multipart/form-data">
			
				
				<div class="form-group">
					
					<img  class="select_img" src="../images/<?php echo $id_cat; ?>/<?php  echo $assoc['id'];?>/<?php echo "$assoc[image]"; ?>">
				</div>
				
				<div class="form-group">
					
					<input type="file" name="file" class="custom-file-input">
				</div>
			
				
				<div class="form-group">
					<label for="usr">Name_eng</label>
					<input type="text" name="name_eng" class="form-control" id="usr" value="<?php echo $assoc['name_eng'] ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Name_rus</label>
					<input type="text" name="name_rus" class="form-control" id="usr" value="<?php echo $assoc['name_rus'] ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Price</label>
					<input type="text"  name="price" class="form-control" id="usr" value="<?php echo $assoc['price'] ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Price %</label>
					<input type="text" name="price_sale" class="form-control" id="usr" value="<?php echo $assoc['price_sale'] ?>">
				</div>
				
				<div class="form-group">
					<label for="usr">Count</label>
					<input type="text" name="count" class="form-control" id="usr" value="<?php echo $assoc['count'] ?>">
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
					<button type="submit" name="edits" class="btn btn-default">Edit</button>	
				</div>
				
				
			</form>
		</div>
	
	
	</body>
	
	
</html>