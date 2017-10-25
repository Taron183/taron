<?php 
	
	require("menu.php");
	require("connect.php");
	$error="";
	$format_erroe="";

	$id_cat=$_GET['id'];
	$_SESSION['id_cat'] = $_GET['id'];
	
	
	
	if(isset($_POST['product'])){
		$image = $_FILES['file']['name'];
		$name_eng=$_POST['name_eng'];
		$name_rus=$_POST['name_rus'];
		$price=$_POST['price'];
		$price_sale=$_POST['price_sale'];
		$count=$_POST['count'];
		$eng_des = $_POST['eng_des'];
		$rus_des = $_POST['rus_des'];
		
		
		if(!empty($price) && !empty($count)){
			if(is_numeric($price)&& is_numeric($count)){
				if($image == ""){
			
				$error = '
					<div class="alert alert-warning">
						<strong>Warning!</strong>The image file is not selected.
.
					</div>';
				}else{
					$format = ['jpeg','jpg'];
					$exp = explode('.', $image);
					$end = end($exp);
					$md5_img=md5($image .date("h/m/s/m/d/y")).'.'.$end;
					
					mysqli_query($con, "INSERT INTO product  (image, name_eng, name_rus, price, price_sale, count,eng_des, rus_des, id_cat) VALUES ('$md5_img','$name_eng', '$name_rus', '$price', '$price_sale', '$count','$eng_des','$rus_des', '$id_cat')");
					
					$resalt = mysqli_query($con, "SELECT id FROM  product  ORDER BY id DESC LIMIT 1 ");
					$assoc = mysqli_fetch_assoc($resalt);
					$id=$assoc['id'];
					mkdir("../images/".$id_cat."/".$id);
					
					if(in_array($end,$format)== true){
						
						
						$tep_name = $_FILES['file']['tmp_name'];
						$src="../images/".$id_cat."/".$id."/".$md5_img;
						$up_img = move_uploaded_file($tep_name , $src);
						
						if($up_img == true){
							
						
							
						}
						
						
						
						
						
					}
					else{
						$format_erroe = '
								<div class="alert alert-warning">
									<strong>Warning!</strong>The format of the image should be "jpg", ".jpeg".
								</div>
						
							';
					}
					
					
				
				}
			
				
			
			
			
			
			
			
			
			}else{
				$format_erroe = '
								<div class="alert alert-warning">
									<strong>Warning!</strong>Еnter numbers
.
								</div>
						
							';
			}
		
		
		}else{
			$format_erroe = '
								<div class="alert alert-warning">
									<strong>Warning!</strong> Fill in the field.
								</div>
						
							';
		}
		
		
		
		
		
		 
		 
		 
		 
		 
	}
	
	if(isset($_POST['images'])){
		$images = $_FILES['file']['name'];
		
		
		if($images == ""){
			
			$error = '
					<div class="alert alert-warning">
						<strong>Warning!</strong>The image file is not selected.
.
					</div>
			';
		}else{
			$format = ['jpeg','jpg'];
			$exp = explode('.', $images);
			$end = end($exp);
			$md5_img=md5($images .date("h/m/s/m/d/y")).'.'.$end;
			
			if(in_array($end,$format)== true){
				
				
				$tep_name = $_FILES['file']['tmp_name'];
				$src="../images/".$id."/".$md5_img;
				$up_img = move_uploaded_file($tep_name , $src);
				
				if($up_img == true){
					mysqli_query($con, "INSERT INTO images  (image, id_pro) VALUES ('$md5_img', '$id')");
				
					
				}
				
				
				
				
				
			}
			else{
				$format_erroe = '
						<div class="alert alert-warning">
							<strong>Warning!</strong>The format of the image should be "jpg", ".jpeg".
						</div>
				
					';
			}
			
			
		
		}
		
	}
	
	
	

	$resalt = mysqli_query($con, "SELECT * FROM  product WHERE  id_cat = '$id_cat'");
	
	
	
	//$p=$_SESSION['id_pro'];
	//$i=$_SESSION['image'];
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	
	






?>



	
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete</h4>
					</div>
					<div class="modal-body">
						<p>Do you really want to delete this line?</p>
					</div>
					
					
					<div class="modal-footer">
						<button type="button"  name="btn_delete" class="btn btn-default" data-dismiss="modal" id="btn">Yes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>

			</div>
		</div>
		

		<div class="container">
			<?php echo $error; ?>
			<?php echo $format_erroe; ?>
			
			<form  action=""  method="post"  enctype="multipart/form-data">
			
				<div class="form-group">
					
					<input type="file" name="file" class="custom-file-input">
				</div>
			
				<div class="form-group">
					<label for="usr">Name_eng</label>
					<input type="text" name="name_eng" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Name_rus</label>
					<input type="text" name="name_rus" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Price</label>
					<input type="text" name="price" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Price %</label>
					<input type="text" name="price_sale" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Count</label>
					<input type="text" name="count" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="comment">Description:</label>
					<textarea class="form-control" name="eng_des" rows="5" id="comment"></textarea>
				</div>
				
				<div class="form-group">
					<label for="comment">Описание:</label>
					<textarea class="form-control" name="rus_des"  rows="5" id="comment"></textarea>
				</div>
				
				<div class="form-group">
					<button type="submit" name="product" class="btn btn-default">Add product</button>	
				</div>
				
				
			</form>
		</div>
		<div class="container">
			<h2>Product</h2>
			           
				<table class="table table-hover  table-bordered">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name_eng</th>
							<th>Name_rus</th>
							<th>Price</th>
							<th>Price %</th>
							<th>Count</th>
							<th>Description</th>
							<th>Описание</th>
							<th>Edit</th>
							<th>
								<button type="button" class="btn btn-danger btn-sm"   data-toggle="modal" data-target="#myModal" data="product" id="delete">
									<span class="glyphicon glyphicon-remove"></span>Delete
								</button>
							</th>
							
								
							
						</tr>
					</thead>
					<tbody>
						
							<?php  while($assoc = mysqli_fetch_assoc($resalt)){?>
								
							
								
							
								<tr>
									
										<th>
										
											
											<img  class="select_img" src="../images/<?php echo $id_cat; ?>/<?php  echo $assoc['id'];?>/<?php echo "$assoc[image]"; ?>">
											
											
											
											
												
											<button type="button" class="btn "  >
											  <span class="glyphicon glyphicon-import"></span>
											  <a href="images.php?id_pro=<?php echo $assoc['id'] ?>">Add Images</a>
											</button>
											
											
										</th>
									
									
									<th >
										<?php echo $assoc['name_eng'] ?>
									</th>
									
									<th >
										<?php echo $assoc['name_rus'] ?>
									</th>
									<th >
										<?php echo $assoc['price'] ?>
									</th>
									
									<th >
										<?php echo $assoc['price_sale'] ?>
									</th>
									
									<th >
										<?php echo $assoc['count'] ?>
									</th>
									
									<th >
										<?php echo $assoc['eng_des'] ?>
									</th>
									
									<th >
										<?php echo $assoc['rus_des'] ?>
									</th>
									<th>
										<button type="button" class="btn btn-success btn-sm edit"> 
									
									  <span class="glyphicon glyphicon-pencil "></span><a href="edits.php?id_edits=<?php echo $assoc['id']; ?>"> Edit</a>
									</button>
									</th>
									<th>
										<input  type="checkbox" name="customer_id[]" value="<?php echo $assoc['id'];?>">
									</th>
								</tr>
								
								
								
							<?php   } ?>
						
							
									
									
						
						
						
					</tbody>
				</table>
				
				
		</div>

	</body>
</html>