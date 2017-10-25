<?php 
	
	
	

	require("connect.php");
	require("menu.php");
	$error = "";
	$format_erroe = "";
	$success = "";
	if(isset($_POST['uploded'])){
		$eng_title1 = $_POST['eng_title1'];
		$rus_title1 = $_POST['rus_title1'];
		$eng_title2 = $_POST['eng_title2'];
		$rus_title2 = $_POST['rus_title2'];
		$eng_des = $_POST['eng_des'];
		$rus_des = $_POST['rus_des'];
		$image = $_FILES['file']['name'];
		
		
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
				$src="../images/uploade/".$md5_img;
				$up_img = move_uploaded_file($tep_name , $src);
				
				if($up_img == true){
					mysqli_query($con, "INSERT INTO slider
							(
								image, 
								eng_title1, 
								rus_title1, 
								eng_title2, 
								rus_title2, 
								eng_des, 
								rus_des
											) VALUES
							
							(
								'$md5_img',
								'$eng_title1',
								'$rus_title1',
								'$eng_title2',
								'$rus_title2',
								'$eng_des',
								'$rus_des'
							
												)		
											
				
				     ");
				
					
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
	
	$sel_result = mysqli_query($con,"SELECT * FROM  slider");
	
	
	
	




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
						<button type="button"  name="btn_delete" id="btn_delete" class="btn btn-default" data-dismiss="modal">Yes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>

			</div>
		</div>

		
		  
		<div class="container">
			<form  action=""  method="post"  enctype="multipart/form-data">
			
				<?php echo $error, $format_erroe, $success; ?>
				
				<div class="form-group">
					<input type="file" name="file" class="custom-file-input">
				</div>
			
				
				<div class="form-group">
					<label for="usr">Title 1:</label>
					<input type="text" name="eng_title1" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Загаловка 1:</label>
					<input type="text" name="rus_title1" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Title 2:</label>
					<input type="text"  name="eng_title2" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Загаловка 2:</label>
					<input type="text" name="rus_title2" class="form-control" id="usr">
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
					<button type="submit" name="uploded" class="btn btn-default">Uploaded</button>	
				</div>
				
				
			</form>
		</div>
		
		<div class="container">
			<h2>Inserted image and text</h2>
			           
				<table class="table table-hover  table-bordered">
					<thead>
					  <tr>
						<th>Image</th>
						<th>Title 1</th>
						<th>Загаловка 1</th>
						<th>Title 2</th>
						<th>Загаловка 2</th>
						<th>Description</th>
						<th>Описание</th>
						<th>Edit</th>
						<th>
								<?php  echo '
									<button type="button" class="btn btn-danger btn-sm del"   data-toggle="modal" data-target="#myModal" >
									  <span class="glyphicon glyphicon-remove"></span>Delete
									</button>
								  ' ?>
						</th>
						
					  </tr>
					</thead>
					<tbody>
						<?php while($assoc = mysqli_fetch_assoc($sel_result)){ ?>
						
							<tr >
								<th>
									<img class="select_img" src="../images/uploade/<?php echo "$assoc[image]"; ?>">
									
								</th>
								
								<th>
									
										<input type="text"  class="inp" value="<?php  echo $assoc['eng_title1'];?>" style="display:none"]>
									<p class="th_text">
										<?php  echo $assoc['eng_title1'];?>
									</p>	
										
								</th>
								
								<th>
									<?php  echo $assoc['rus_title1']; ?>
											
								</th>
								
								<th>
									<?php  echo $assoc['eng_title2']; ?>	
								</th>
								
								<th>
									<?php  echo $assoc['rus_title2']; ?>	
								</th>
								
								<th>
									<?php  echo $assoc['eng_des']; ?>	
								</th>
								
								<th>
									
									<?php  echo $assoc['rus_des']; ?>
									
										
								</th>
								
								<th>
									
									
									<button type="button" class="btn btn-success btn-sm edit"> 
									
									  <span class="glyphicon glyphicon-pencil "></span><a href="edit.php?id=<?php echo $assoc['id']; ?>"> Edit</a>
									</button>
								  
									
								</th>
								
								<th>
									<input class="delete_customer" type="checkbox" name="customer_id[]" value="<?php echo $assoc['id'];?>">
								</th>
							</tr>
							
							
								
							
						
						<?php }?>
					</tbody>
				</table>
				
				
		</div>
		
		<script>
$(document).ready(function(){
 

 
});
</script>

	</body>
</html>
