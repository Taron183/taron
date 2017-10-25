<?php

	require("connect.php");
	require("menu.php");
	


	$result = mysqli_query($con,"SELECT * FROM comment  ORDER BY id DESC ");
	mysqli_query($con,"UPDATE  comment SET news = '11'");


	
?>


<div class="container">
	<h2>Product comment</h2>
			   
		<table class="table table-hover  table-bordered">
			<thead>
			  <tr>
				<th>Comment</th>
				<th>Username</th>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Product_name</th>
				<th>NO  Yes</th>
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
				<?php while($assoc = mysqli_fetch_assoc($result)){ ?>
				
					
					<tr <?php if ($assoc['news'] == 00){echo 'style= background:#8a6d3b';} ?> >
						
						
						
						
						<th>
							<?php  echo $assoc['comment']; ?>
									
						</th>
						
						<th>
							<?php  echo $assoc['username']; ?>
									
						</th>
						
						<th>
							<?php  echo $assoc['firstname']; ?>
									
						</th>
						
						<th>
							<?php  echo $assoc['lastname']; ?>
									
						</th>
						
						<th>
							<?php  echo $assoc['product_name']; ?>	
						</th>
						
						
						
						
						
						
						
						<th>
							
							
								<label class="switch">
								  <input type="checkbox"  class="on_off"  <?php if($assoc['chek'] == 1){echo ' checked ';} ?> data-com_id="<?php echo $assoc['id']; ?>">
								  <span class="slider round"></span>
								</label>
							  
						
						</th>
						
						<th>
							<input class="delete_customer" type="checkbox" name="customer_id[]" value="<?php echo $assoc['id'];?>">
						</th>
					</tr>
					
					
						
					
				
				<?php }?>
			</tbody>
		</table>
		
		
</div>
















<?php include("footer.php") ?>