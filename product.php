<?php
	
   
    if(isset($_GET['id_all'])){
		require("admin/connect.php");
		require("header.php");
		
		$id_all = $_GET['id_all'];
	
	
	}else{
		header("location:index.php");
	}
	

   


	$kol = 6;
	

	
		

	
	$result_pro  = mysqli_query($con,"SELECT * FROM product  WHERE  id_cat = '$id_all' LIMIT 0,$kol");

	
		if (isset($_GET['page'])){
				
			$page = $_GET['page'];
			$result_pro  = mysqli_query($con,"SELECT * FROM product  WHERE  id_cat = '$id_all' LIMIT $page,$kol");
		}else{
			$page = 0;
			
		} 
	


	$res = mysqli_query($con,"SELECT COUNT(*) FROM product WHERE  id_cat = '$id_all'");
	$row = mysqli_fetch_row($res);
	$total = $row[0];
	$str_pag = ceil($total / $kol);


	


?>





	<div class="container  pr">
	
			
				<?php $i=0; while($assoc_pro = mysqli_fetch_assoc($result_pro)){?>	
						
					<?php if($i%3==0){ ?>
						<div class="row">
					
					<?php   }?>	
					
						
							<div class= "col-lg-4 col-md-4 col-xs-12"  >
								
									<div class= "prod">
										
										<div  class= "prod_a">
											<a href="product_full.php?id_pro=<?php echo $assoc_pro['id'] ?>"> <?php echo $assoc_pro["name_".$lang] ?> </a>
										</div>
										
										<div class="description-small">
											<?php echo $assoc_pro[$lang.'_des'] ?>						
										</div>
										
										<div class="image">
											<div class="sale">
												<span>Sale</span>
											</div>
											<a href="product_full.php?id_pro=<?php echo $assoc_pro['id'] ?>" >
											
												<img width="387" height="387" alt="6w Philips Led Tube Light" title="6w Philips Led Tube Light" class="img-primary" src="images/<?php echo $assoc_pro['id_cat'] ?>/<?php echo $assoc_pro['id'] ?>/<?php echo $assoc_pro['image']?>">
											</a>
										</div>
										
										<div class="caption">
														
											<div class="price">
																							 
												<span class="price-new">$<?php echo $assoc_pro['price_sale'] ?></span> <span class="price-old">$<?php echo $assoc_pro['price'] ?></span>
											</div>
																					
											<button class="btn-icon-add pull-right" type="button" ><i class="fa fa-shopping-bag"></i></button>
														
										</div>
									</div>	
								
							</div>
							
					<?php if(($i+1)%3==0){ ?>
						</div>
					
					<?php   }?>	
					
					
					
				<?php $i++;  }?>	
			
					
				
       
	</div>
	<div  class="container">
		<ul class='pagination'>	
			<?php
				echo"
					<li >
						<a href='product.php?id_all=$id_all'> 1 </a>
					</li>";
			?>
			<?php
				for ($i = 2; $i <= $str_pag; $i++){
					echo	"
						
							
							<li >
								<a href='product.php?id_all=$id_all&page=".$i."'>  ".$i." </a>
							</li>";
						
				}
			?>	
		</ul>
	
	</div>















<?php include("footer.php") ?>