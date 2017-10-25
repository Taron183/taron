<?php
	
	require("menu.php");
	require("connect.php");
	$error="";
	$format_erroe="";
	
	
	
	$id_pro=$_GET['id_pro'];
	$_SESSION['id_pro'] = $_GET['id_pro'];
	
	
	$id_cat=$_SESSION['id_cat'];
	
	if(isset($_POST['images'])){
		$image = $_FILES['file']['name'];
		$id_pro=$_GET['id_pro'];
		
		
		if($image == ""){
			
			$error = '
					<div class="alert alert-warning">
						<strong>Warning!</strong>The image file is not selected.
.
					</div>
			';
		}else{
			$format = ['jpeg','jpg'];
			$exp = explode('.', $image);
			$end = end($exp);
			$md5_img=md5($image .date("h/m/s/m/d/y")).'.'.$end;
			
			if(in_array($end,$format)== true){
				
				
				$tep_name = $_FILES['file']['tmp_name'];
				$src="../images/".$id_cat."/".$id_pro."/".$md5_img;
				$up_img = move_uploaded_file($tep_name , $src);
				
				if($up_img == true){
					mysqli_query($con, "INSERT INTO images(image, id_pro, id_cat) VALUES('$md5_img','$id_pro', '$id_cat') ");
				
					
				}
				
				
				
				
				
				
				
				
				$success ='
							<div class="alert alert-success">
								<strong>Success!</strong>Successfully sent data.

							</div>
						';
				
				
				
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
	
	$resalt = mysqli_query($con, "SELECT * FROM  images WHERE  id_pro = '$id_pro'");
	//$a = mysqli_fetch_assoc($resalt);
	//$_SESSION['id_pro'] = $a['id_pro'];
	//$_SESSION['image'] = $a['image'];
	
	
	
	


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
			
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file"  name="file"  class="custom-file-input" >
				  <button type="submit" name="images" class="btn btn-default">Add Images</button>
				</form>
			
				
				
				
			</form>
		</div>
		<div class="container">
			<h2>Images</h2>
			           
				<table class="table table-hover  table-bordered">
					<thead>
						<tr>
							<th>Image</th>
							<th>
								<button type="button" class="btn btn-danger btn-sm"   data-toggle="modal" data-target="#myModal" data="image" id="delete">
									<span class="glyphicon glyphicon-remove"></span>Delete
								</button>
							</th>
							
							
								
							
						</tr>
					</thead>
					<tbody>
						<?php  while($assoc = mysqli_fetch_assoc($resalt)){?>
								
							
								
							
								<tr>
									
									<th>
									
										
										<img  class="select_img" src="../images/<?php echo $id_cat; ?>/<?php  echo $assoc['id_pro'];?>/<?php echo "$assoc[image]"; ?>">
										
										
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