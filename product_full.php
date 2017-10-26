<?php 

	

	
	if(isset($_GET['id_pro'])){
		require("admin/connect.php");
		require("header.php");
		$id_pro = $_GET['id_pro']; 
		$result = mysqli_query($con, "SELECT * FROM  product WHERE id = '$id_pro' ");
		$assoc = mysqli_fetch_assoc($result); 
		$_SESSION['product_name'] = $assoc['name_eng'];
		
		
		
		
		
		
	}
	
	else{
		header('Location: index.php');
	}
	

	
	
	$resalt_com = mysqli_query($con, "SELECT * FROM comment WHERE  id_pro = '$id_pro' and chek = '1'  ");
		
	
	

	

	
	

?>


		
		<div class="container">
			
			<div class="row">
				<div class="col-sm-6  product_page-left">
					<div class="product-gallery">
												
						<div class="row">
							<div class="col-lg-12">
								<img  class="image_new" width="400" height="400" alt="" id="productZoom" src="images/<?php echo $assoc['id_cat'] ?>/<?php echo $assoc['id'] ?>/<?php echo $assoc['image']?> ">								
							</div>
							<div class="col-lg-12  image-thumb">
								<div class="bx-wrapper" style="max-width: 800px; margin: 0px auto;">
									<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 125px;">
										<ul id="productGallery" class="image-additional" data-slide-width="125" style="width: 515%; position: relative; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
											<li style="float: left; list-style: none; position: relative; width: 125px; margin-right: 15px;">
												
													
													<img  class="images_pro images_pro1" width="125" height="125" src="images/<?php echo $assoc['id_cat'] ?>/<?php echo $assoc['id'] ?>/<?php echo $assoc['image']?>">
													
											</li>
											
											<?php $re = mysqli_query($con,"SELECT * FROM  images WHERE id_pro = '$id_pro' ") ?>
											<?php  while($ass = mysqli_fetch_assoc($re)){?>
												<li style="float: left; list-style: none; position: relative; width: 125px; margin-right: 15px;">
												
													
													<img class="images_pro" width="125" height="125" src="images/<?php echo $assoc['id_cat'] ?>/<?php echo $assoc['id'] ?>/<?php echo $ass['image']?>">
													
												</li>
											<?php  }?>
											
											
											
										</ul>
									</div>
									<div class="bx-controls bx-has-controls-direction">
										<div class="bx-controls-direction">
											<a class="bx-prev disabled" href="">
												<i class="material-icons-chevron_left"></i>
											</a>
											<a class="bx-next disabled" href="">
												<i class="material-icons-chevron_right">
												</i>
											</a>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
					</div>
				</div>
				
				
				
				
				<div class="col-sm-6  product_page-right">
					<div class="general_info product-info">
						<h2 class="product-title"><?php echo $assoc["name_".$lang] ?></h2>
						<div class="price-section">							
							<span class="price-new">$<?php echo $assoc['price'] ?></span> <span class="price-old">$<?php echo $assoc['price_sale'] ?></span> 
														
							<div class="reward-block">
								<span class="reward"><strong>Count:</strong><?php echo $assoc['count'] ?></span>
							</div>
							
						</div>
						
						<ul class="list-unstyled product-section">
							<li><strong>Brand:</strong>
								<a href="#">Philips</a>
							</li>
														<li>
								<strong>Product Code:</strong>
								<span>Classic</span>
							</li>
														<li>
								<strong>Reward Points:</strong>
								<span>400</span>
							</li>
														<li>
								<strong>Availability:</strong>
								<span class="stock">In Stock</span>
							</li>
						</ul>
						
						
						<div class="reward-block">
							<span class="reward"><strong>Description:</strong><?php echo $assoc[$lang.'_des'] ?></span>
						</div>
						
						
						<div class="quantity">
							<strong>Quantity:</strong>
						
							<input type="number" min="1" max="30" step="1" class="inp_cart"  >
							
							<button type="button" id="button-cart" data-loading-text="Loading..." class="btnca btn cart"  data-id_pro="<?php echo $assoc['id']; ?>"  data-id_user="<?php echo $_SESSION['id_user'];; ?>" >Add to Cart</button>
						</div>
						
						
																	
					</div>
				</div>	
						
			</div>
					
		</div>					
																																																																																																		
		<div class="container  coment_con">
			
			<form>
				<div class="form-group">
				  <label for="comment">Comment  product:</label>
				  <textarea class="form-control comment_text" rows="5" id="comment"></textarea>
				</div>
				
				<div class="form-group">
				  <p class="com_text"></p>
				</div>
				
				<div class="form-group" style="text-align:right;">
					<button type="button" class="btn btn-success send"  data-id_pro="<?php echo $assoc['id'] ?>">Send</button>
				</div>
				
				
			</form>
			
	
		
	
			<?php  while($ass = mysqli_fetch_assoc($resalt_com)){?>
			
				
				
															
				

				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h3><?php  echo $ass['firstname']; ?>  <?php  echo $ass['lastname']; ?></h3>
						</div><!-- /col-sm-12 -->
					</div><!-- /row -->
					<div class="row">
						<div class="col-sm-1">
							<div class="thumbnail">
								<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
							</div><!-- /thumbnail -->
						</div><!-- /col-sm-1 -->

						<div class="col-sm-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<span class="text-muted"><?php  echo $ass['comment']; ?></span>
								</div>
								
							</div><!-- /panel panel-default -->
						</div><!-- /col-sm-5 -->




					</div><!-- /row -->

				</div>
				
				
		   <?php  }?>
													
			
		</div>	
		
						
						
