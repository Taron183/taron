$(document).ready(function(){
	
	
	$(".search").click(function(){
		$("#search").css({
			"width": "913px", "opacity": "1", "display":"block"
		})
	})
	
	
	$(".images_pro").click(function(){
		var img = $(this).attr("src");
		$(".image_new").attr("src", img);
		
		
		$(".images_pro").css({"opacity": "0.2",})
		$(this).css({"opacity": "1",})
		
	})
	
	
	$(".send").click(function(){
		var comment = $(".comment_text").val()
		var id_pro = $(this).attr("data-id_pro")
		
		
		
		$.ajax({
			url:'comment.php',
			method:'POST',
			data:{comment,id_pro},
			success:function(x){
				
				if(x == "no_com"){
					$(".com_text").text("The field is empty")
				}
				else if(x == "no_reg"){
					$(".com_text").text("Can not post comments please register!!!")
				}
				else if(x == "yes_com"){
					$(".com_text").text("Comment after the admin review will be installed")
				}
				
			
			
			}
		
		
		})
		
		
		
		$(".comment_text").val("")
	
	})
	
	
	$(".cart").click(function(){
		id_pro = $(this).attr("data-id_pro");
		id_user = $(this).attr("data-id_user");
		inp_val = $(".inp_cat").val();
			
		console.log(id_pro)
		console.log(id_user)
		console.log(inp_val)
	})
	
	
})