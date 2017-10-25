d=false
								/*ADMIN BLOG LOGIN*/
$(document).ready(function(){
	
	$(".logo_btn").click(function(){
		var logo = $(".logo").val()
		var pass = $(".pass").val()
		$.ajax({
			url: "../admin/check.php",
			type: "post",
			data: {logo ,pass},
			success: function(x){
				
				if(x == "yes"){
					window.location.replace("admin.php");
				}
				else if(x == "no"){
					$(".p_error").text("Login оr password   wrong");
				}
				
			}
		})
	})
	
								/*----------------DELETE  TABLE------------------*/
	
	/*$(".sel_delete").click(function(){
		 
		id = $(this).attr();
		console.log(id)
		
		
	
		
		delete_tr = $(this).parent().parent()
		
		
	
		
		
	})
	
	
	$(".delete").click(function(){
		
		
		$.ajax({
			url: "delete_id.php",
			type: "post",
			data: {id},
			success: function(date){
				if(date == "a"){
          delete_tr.fadeOut(1000,function(){
            $(this).remove()
          })
        }
				
				
				
				
			}
		})
		
		
		
	})*/
	
	
	
	$(".del").click(function(){
		id = [];
		   
		$(':checkbox:checked').each(function(i){
			id.push($(this).val());
		});
		
		if(id.length == 0){
			$(this).attr('data-target','')
			alert("Please Select atleast one checkbox");
		}
		
		
		else{
			$(this).attr('data-target','#myModal')
		}
		
		
	
	})
	
	
	$('#btn_delete').click(function(){
  
		$.ajax({
			url:'delete.php',
			method:'POST',
			data:{id},
			success:function(x){
				if(x=="a"){
				
					$(':checkbox:checked').parent().parent().fadeOut(1000,function(){
						$(this).remove()
					})
					
					
				} 

			}
			 
		});
	
		   
		
		   
		
	});
	
	
	$(".edits").click(function(){
		eng=$(this).attr("eng")
		rus=$(this).attr("rus")
		
		$(".eng").val(eng)
		$(".rus").val(rus)
		
		 id_edit= $(this).attr("id")
		 
		 $(".ids").val(id_edit)
		 
		 
		
		
		
		
	})
	
	
	$("#delete").click(function(){
		data = $("#delete").attr("data")
		
		id = []
		
		$(':checkbox:checked').each(function(i){
			id.push($(this).val());
		});
		
		if(id.length == 0){
			alert("Please Select atleast one checkbox");
			$(this).attr('data-target','')
			
		}
		else{
			$(this).attr('data-target','#myModal')
		}
		
		
		
	})
	
	
	$('#btn').click(function(){
  
		$.ajax({
			url:'del.php',
			method:'POST',
			data:{id,data},
			success:function(x){
				if(x=="a"){
				
					$(':checkbox:checked').parent().parent().fadeOut(500,function(){
						$(this).remove()
					})
					
					
				} 

			}
			 
		});
	
		   
		
		   
		
	});
	
	
	
	$(".on_off").click(function(){
		
	
		id_comment = $(this).attr('data-com_id')
		
		if($(this).parent().find('input').is(':checked')) {
			
			chek = 1;
			
			
		}
		else{
			chek = 0;
			
			 
		}
		
	
		$.ajax({
			url:'../comment_update.php',
			method:'POST',
			data:{id_comment,chek},
			success:function(){
			

			}
			 
		});
	})
	
	
	
	
	
			

})