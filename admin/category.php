<?php 
	
	require("connect.php");
	require("menu.php");
	$empty_error = "";
	$num_error = "";
	
	
		
					
					
	
	
	
	if(isset($_POST['cat'])){
		$eng_cat=$_POST['eng_cat'];
		$rus_cat=$_POST['rus_cat'];
		
		
		if(empty($eng_cat) && empty($rus_cat) ){
			
			$empty_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> Fill in the field.
								</div>
					
								';
			
		}else{
			
			$resalt = mysqli_query($con, "SELECT * FROM  category WHERE eng_cat='$eng_cat' OR rus_cat='$rus_cat'");
			$num=mysqli_num_rows($resalt);
			
			if($num == 1){
				$num_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> Тhis category already exists.
								</div>
					
								';
				
			
			}else{
			
				mysqli_query($con, "INSERT INTO category  (eng_cat, rus_cat) VALUES ('$eng_cat','$rus_cat')");
				$resalt = mysqli_query($con, "SELECT id FROM  category  ORDER BY id DESC LIMIT 1 ");
				$assoc = mysqli_fetch_assoc($resalt);
				$id=$assoc['id'];
				mkdir("../images/".$id);
				
			}
			
			
			
		}
		
		
	}
	
	
	
	
	
	if(isset($_POST['edit'])){
		$eng_cat=$_POST['eng_cat'];
		$rus_cat=$_POST['rus_cat'];
		$id=$_POST['id'];
		
		
		if(empty($eng_cat) && empty($rus_cat) ){
			
			$empty_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> Fill in the field.
								</div>
					
								';
			
		}else{
			
			$res = mysqli_query($con, "SELECT * FROM  category WHERE (eng_cat='$eng_cat') OR  (rus_cat='$rus_cat') AND id <> '$id'");
			$num=mysqli_num_rows($res);
			
			if($num == 1){
				$num_error = '
								
								<div class="alert alert-warning">
								  <strong>Warning!</strong> Тhis category already exists.
								</div>
					
								';
				
			
			}else{
				
				
					
					mysqli_query($con, "UPDATE  category  SET eng_cat='$eng_cat', rus_cat='$rus_cat'  WHERE id='$id'");
				
				
				
			}
			
			
			
		}
		
		
	}

	
	$resalt = mysqli_query($con, "SELECT * FROM  category order by id desc ");


?>




		<div class="modal fade" id="Modal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					</div>
					
						<form action="" method="post"  enctype="multipart/form-data">
							
							<div class="modal-body">
								<div class="form-group">
									<label for="usr">Category</label>
									<input type="text"  name="eng_cat" class="form-control eng" id="usr">
								</div>
								<div class="form-group">
									
									<input type="hidden"  name="id" class="form-control ids" id="usr">
								</div>
						
								<div class="form-group">
									<label for="usr">Категория</label>
									<input type="text" name="rus_cat" class="form-control rus" id="usr">
								</div>
								
							</div>
							
							<div class="modal-footer">
								<button type="submit" name="edit" class="btn btn-default">Edit</button>
								
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</form>	
				</div>
			</div>
		</div>
		
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
			
			<?php echo $num_error;?>
		    <?php echo $empty_error; ?>
			<form  action=""  method="post"  enctype="multipart/form-data">
			
				<div class="form-group">
					<label for="usr">Category</label>
					<input type="text" name="eng_cat" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<label for="usr">Категория</label>
					<input type="text" name="rus_cat" class="form-control" id="usr">
				</div>
				
				<div class="form-group">
					<button type="submit" name="cat" class="btn btn-default">Add category</button>	
				</div>
				
				
			</form>
		</div>
		<div class="container">
			<h2>Category</h2>
			           
				<table class="table table-hover  table-bordered">
					<thead>
						<tr>
							<th>Category</th>
							<th>Категория</th>
							<th>Edit</th>
							<th>Add</th>
							<th>
								<button type="button" class="btn btn-danger btn-sm"   data-toggle="modal" data-target="#myModal" data="category" id="delete">
									<span class="glyphicon glyphicon-remove"></span>Delete
								</button>
							</th>
							
								
							
						</tr>
					</thead>
					<tbody>
						<?php while($assoc = mysqli_fetch_assoc($resalt)){?>
							<tr>
								<th >
									<?php echo $assoc['eng_cat'] ?>
								</th>
								
								<th >
									<?php echo $assoc['rus_cat'] ?>
								</th>
								
								<th>
									<button type="button" class="btn btn-success btn-sm edits" data-toggle="modal" data-target="#Modal" rus="<?php echo $assoc['rus_cat'] ?>" eng="<?php echo $assoc['eng_cat'] ?>"  id="<?php echo $assoc['id'] ?>"> 
									
									  <span class="glyphicon glyphicon-pencil "></span>Edit
									</button>
								</th>
								
								
								
								<th>
									<button type="button" class="btn "  >
									  <span class="glyphicon glyphicon-import"></span>
									  <a href="product.php?id=<?php echo $assoc['id'] ?>">Add Product</a>
									</button>
								</th>
								<th>
									<input  type="checkbox" name="customer_id[]" value="<?php echo $assoc['id'];?>">
								</th>
							
							</tr>
						
						<?php } ?>
						
					</tbody>
				</table>
				
				
		</div>

	</body>
</html>