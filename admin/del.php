<?php

session_start();

if(isset($_POST['id']) && isset($_POST['data'])){
	require("connect.php");
	$id = $_POST['id'];
	$data = $_POST['data'];
	$str = implode(",",$id);
	$id_cat = $_SESSION['id_cat'];
	
	
	
	if($data == "image"){
		$id_pro = $_SESSION['id_pro'];
		$result = mysqli_query($con, "SELECT * FROM images WHERE  id  in   ($str)");
		
		while($assoc = mysqli_fetch_assoc($result)){
			$del_img = unlink("../images/".$id_cat."/".$id_pro."/".$assoc['image']);
		}
		$deleted = mysqli_query($con, "DELETE FROM images WHERE id in  ($str) ");
		if( $deleted == true){
       
			echo "a";
		} 
	
	}else if($data == "product"){
		
		$result = mysqli_query($con, "SELECT * FROM images WHERE  id_pro in ($str)");
		while($assoc = mysqli_fetch_assoc($result)){
			$del_img = unlink("../images/".$id_cat."/".$assoc['id_pro']."/".$assoc['image']);
		}
		$deleted = mysqli_query($con, "DELETE FROM images WHERE id_pro= ($str) ");
		
		
		$result = mysqli_query($con, "SELECT * FROM product WHERE  id  in   ($str)");
		while($assoc = mysqli_fetch_assoc($result)){
			$del_img = unlink("../images/".$id_cat."/".$assoc['id']."/".$assoc['image']);
			rmdir("../images/".$id_cat."/".$assoc['id']);
		}
		
		$deleted = mysqli_query($con, "DELETE FROM product WHERE id in ($str) ");
		
		
		if( $deleted == true){
			
			echo "a";
		} 
		
	}else if($data == "category"){
		$result = mysqli_query($con, "SELECT * FROM images WHERE  id_cat = ($str)");
		while($assoc = mysqli_fetch_assoc($result)){
			$del_img = unlink("../images/".$id_cat."/".$assoc['id_pro']."/".$assoc['image']);
		}
		$deleted = mysqli_query($con, "DELETE FROM images WHERE id_cat= ($str) ");
		
		$result = mysqli_query($con, "SELECT * FROM product WHERE  id_cat  in   ($str)");
		while($assoc = mysqli_fetch_assoc($result)){
			$del_img = unlink("../images/".$id_cat."/".$assoc['id']."/".$assoc['image']);
			rmdir("../images/".$id_cat."/".$assoc['id']);
		}
		 mysqli_query($con, "DELETE FROM product WHERE id_cat in ($str) ");
		 
		 
		$result = mysqli_query($con, "SELECT * FROM category WHERE  id  in   ($str)");
		while($assoc = mysqli_fetch_assoc($result)){
			rmdir("../images/".$assoc['id']);
		}
		$deleted = mysqli_query($con, "DELETE FROM category WHERE id in ($str) ");
		
		if( $deleted == true){
			
			echo "a";
		} 
		
	}

	
}


?>