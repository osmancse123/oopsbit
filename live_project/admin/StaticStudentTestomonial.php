<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

            
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
            
    <link rel="stylesheet" href="datespicker/datepicker.css">
     <script src="datespicker/bootstrap-datepicker.js"></script>
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
				<div class="col-md-12 col-lg-12" id="load-data-here" style="margin-top:10px;">
					
				</div>
  </form>
    <script src="bootstrap/js/bootstrap.min.js"></script>
 <script>
 
          $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
			
			
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
						var staticid ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForBoardResult.php",   
								 data:{staticid:staticid},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});
			 }
			 selectAll();
			
		function creatAdmin(){
					var statNotid ="ddd"; 
					$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {statNotid:statNotid},
							 success : function(text)
							{
									$("#load-data-here").html(text);
								}
							
					});
		}
		
		function ResultAdd(){
				//alert('dd');
				var sataticchekId="selectOne";
				var title =$('#Title').val();
				var group =$('#Group').val();
				var type=$('#Type').val();
				var studentID=$('#StudentID').val();
				var RollNO=$('#RollNO').val();
				var regNo=$('#RegNo').val();
				var gpa=$('#GPA').val();
				var session=$('#Session').val();
				var Year =$('#Year').val();
				
				var studentName=$('#studentName').val();
				var fatherName=$('#fatherName').val();
				var MotherName =$('#MotherName').val();
				var gender =$('#gender').val();
				var example2 = $('#example2').val();
			    var xx =$('#xx').val();
				
				var v =$('#v').val();
				var p =$('#p').val();
				var u = $('#u').val();
			    var d =$('#d').val();
			       var bd =$('#bd').val();
				$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {sataticchekId:sataticchekId,title:title,group:group,type:type,studentID:studentID,RollNO:RollNO,regNo:regNo,gpa:gpa,session:session,Year:Year,studentName:studentName,MotherName:MotherName,fatherName:fatherName,gender:gender,example2:example2,xx:xx,v:v,p:p,u:u,d:d,bd:bd},
							 success : function(text)
								{
									//alert(text);
									$("#msgShow").html(text);
									
								}
							
					});
		}
		
		function deleteFunction(){
				
				var chekvalue = [];
				$('.chek').each(function(){
					if($(this).is(":checked"))
					{
						chekvalue.push($(this).val());
					}
				
				});
				var sdchekid="10";
				$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {sdchekid:sdchekid,chekvalue:chekvalue},
							success : function(text)
							{
									//alert(text);
									selectAll();
							}
							
					});	
				
		}
	
 </script>
  </body>
</html>
					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

