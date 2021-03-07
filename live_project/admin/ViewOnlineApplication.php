<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	 </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
				<div class="col-md-12 col-lg-12" id="load-data-here" style="margin-top:10px;">
					
				</div>
				
				<div class="col-md-12 col-lg-12" id="load-data-byID" style="margin-top:10px;">
					
				</div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
 <script>
 			/*	$(document).ready(function(){
						var response = '';
						var id ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForAdmin.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});

            
           	 });*/
			 function selectAll(){
			 	 $("#load-data-here").show();
						 $("#load-data-byID").hide();
			 	var response = '';
						var id ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForViewOnlineaPPlier.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
								 
									$("#load-data-here").html(text);
								 }
						});
			 }
			 selectAll();
			 
			 function viewStudent(getId){
						 $("#load-data-here").hide();
						 $("#load-data-byID").show();
						
			 		var response = '';
						var  viewAllbyid ="dd";
						var getId =getId;
						$.ajax({ type: "POST",   
								 url: "ajaxForViewOnlineaPPlier.php",   
								 data:{viewAllbyid:viewAllbyid,getId:getId},
								 async: false,
								 success : function(text)
								 {
								 		$("#load-data-byID").html(text);
								 }
						});
			  	
			 }
			 
			 
			 function deleteStudent(getId){
						
			 		var response = '';
						var  deletebyId ="dd";
						var getId =getId;
						$.ajax({ type: "POST",   
								 url: "ajaxForViewOnlineaPPlier.php",   
								 data:{deletebyId:deletebyId,getId:getId},
								 async: false,
								 success : function(text)
								 {
								 		 selectAll();
								 }
						});
			  	
			 }
			 
			 
			 
			 function BAck(){
			 			 $("#load-data-here").show();
						 $("#load-data-byID").hide();
			 
			 }
			 
			 function ApproveByIDforADmit(getdid){
			 		//var response = '';
						var  updatestatus ="dd";
						var getdid =getdid;
						$.ajax({ type: "POST",   
								 url: "ajaxForViewOnlineaPPlier.php",   
								 data:{updatestatus:updatestatus,getdid:getdid},
								 async: false,
								 success : function(text)
								 {
								 	$('#success_message').fadeIn().html(text);
										setTimeout(function() {
											$('#success_message').fadeOut("slow");
										}, 2000 );
								 }
						});
			 }
			 
			 function ApproveByIDstdt(getid){
			 
			 	var  studentadd ="dd";
						var getdid =getid;
						//alert(getdid);
						$.ajax({ type: "POST",   
								 url: "ajaxForViewOnlineaPPlier.php",   
								 data:{studentadd:studentadd,getdid:getdid},
								 async: false,
								 success : function(text)
								 {
								 	$('#success_message').fadeIn().html(text);
										setTimeout(function() {
											$('#success_message').fadeOut("slow");
										}, 2000 );
								 }
						});
						
						
			 
			 }
</script>