<?php

	require("admin/connect.php");
	require("header.php");

	$result = mysqli_query($con,"SELECT * FROM  slider");
	
		
	
	




?>



		<div id="myCarousel" class="carousel slide " data-ride="carousel">
			  <!-- Indicators -->
			<ol class="carousel-indicators borders">
				<?php $i=0;  while($assoc = mysqli_fetch_assoc($result)){?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){echo 'active';}?>"></li>
				<?php $i++; }?>
				
			</ol>

			  <!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php $result = mysqli_query($con,"SELECT * FROM  slider"); ?>
				<?php $i=0;  while($assoc = mysqli_fetch_assoc($result)){?>
					
					<div class="item <?php if($i==0){echo 'active';}?> " id="item">
						<img src="images/uploade/<?php echo "$assoc[image]"; ?>" alt="Los Angeles">
						<div class="the">
							<h3><?php echo $assoc[$lang."_title2"] ?></h3>
						    
							<h2><?php echo $assoc[$lang."_title1"] ?></h2>
							
							<p><?php echo $assoc[$lang."_des"] ?></p><br>
							<a class="btn-primary" href="index.php?route=product/category&amp;path=41">SHOP NOW</a>
						</div>
					</div>
				<?php $i++; }?>
			
			
				

				
			</div>

			 
		</div>
		
		
		
			
		
			
			
		<div class="container cat">
			
			<?php $result_cat = mysqli_query($con, "SELECT * FROM  category order by id desc")?>
			<?php  while($assoc_cat = mysqli_fetch_assoc($result_cat)){?>
			
				<div class="row">
					
					
						<a href="product.php?id_all=<?php echo  $assoc_cat['id'] ?>"   class="cat_a"> 
							<h3 class="cat_h3"><?php echo $assoc_cat[$lang."_cat"] ?></h3> 
						</a>
					
						<?php $result_pro = mysqli_query($con, "SELECT * FROM product  WHERE  id_cat = '$assoc_cat[id]' ORDER BY id DESC LIMIT 3")?>
						
						
						
							<?php  while($assoc_pro = mysqli_fetch_assoc($result_pro)){?>
								
								
									
										<div class=" col-lg-4 col-md-4 col-xs-12 product ">
											
													 
										 <a href="product_full.php?id_pro=<?php echo $assoc_pro['id'] ?>"  class="pro_a">  
											<img src="images/<?php echo $assoc_pro['id_cat'] ?>/<?php echo $assoc_pro['id'] ?>/<?php echo $assoc_pro['image'] ?>" class="img-thumbnail img_pro" alt="Cinque Terre" >
										</a> 
										   <h4 class="pro_h4"><?php echo $assoc_pro['name_eng'] ?></h4>
										</div>
									
									
								
							
							<?php  }?>
						
				</div>		
				
			<?php  }?>
		
		</div>	
		
		
		
		

	
	<?php include("footer.php") ?>