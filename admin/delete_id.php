<?php 

	
  if(isset($_POST['id'])){
    require("connect.php");
    $id = $_POST['id'];
    $result = mysqli_query($con, "SELECT * FROM slider WHERE id = '$id' ");
    $assoc = mysqli_fetch_assoc($result);
   
    $del_img = unlink("../images/uploade/".$assoc['image']);
    if($del_img == true){
       $deleted = mysqli_query($con, "DELETE FROM slider WHERE id = '$id' ");
      
      if( $deleted == true){
       
       echo "a";
      }
      
      
      
    }
	
  }else{
    header("location:http://localhost/das5/admin/");
  }
  
	
	



	
	
	
	

	
	



?>