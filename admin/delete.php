<?php
//delete.php

if(isset($_POST["id"])){
	require("connect.php");
	$id = $_POST['id'];
	$str = implode(",",$id);
	$result = mysqli_query($con, "SELECT * FROM slider WHERE  id  in   ($str)");
	
	
	while($assoc = mysqli_fetch_assoc($result)){
		$del_img = unlink("../images/uploade/".$assoc['image']);
	}
	$deleted = mysqli_query($con, "DELETE FROM slider WHERE id in  ($str) ");
	if( $deleted == true){
       
       echo "a";
    }
	
	
	
	
}







