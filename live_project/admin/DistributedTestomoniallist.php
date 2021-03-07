
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
			 	var response = '';
						var id ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForDistributionTest.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});
			 }
			 selectAll();
			
		
		function deleteFunction(){
				
				var chekvalue = [];
				$('.chek').each(function(){
					if($(this).is(":checked"))
					{
						chekvalue.push($(this).val());
					}
				
				});
				var dchekid="10";
				$.ajax({
							url:"ajaxForDistributionTest.php",
							type:"POST",
							data : {dchekid:dchekid,chekvalue:chekvalue},
							success : function(text)
							{
									alert(text);
									selectAll();
							}
							
					});	
				
		}
	
 </script>
  </body>
</html>