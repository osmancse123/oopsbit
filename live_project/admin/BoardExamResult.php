<?php
	error_reporting(1);
	@session_start();

	if($_SESSION["logstatus"] === "Active")
	{

require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

$db = new database();

if(isset($_GET["del"]))
{ 

$del="DELETE from `boardexamresult`  where `StudentId`='".$_GET["del"]."'";
$delete=$db->select_query($del);

}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	 </head>
	 <script type="text/javascript">

	 	function delconfirm()
	 	{
	 		var result = confirm("Want to delete?");
				if (result) {
				    return true;
				}
				else
				{
					return false;
				}
	 	}


	</script>

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
								 url: "ajaxForBoardResult.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});
			 }
			 selectAll();
			
		function creatAdmin(){
					var Notid ="ddd"; 
					$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {Notid:Notid},
							 success : function(text)
							{
									$("#load-data-here").html(text);
								}
							
					});
		}

		function editInfo(x){
					var tstid=x;
					var textid="dddd";
					$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {textid:textid,tstid:tstid},
							 success : function(text)
							{
									$("#load-data-here").html(text);
								}
							
					});
		}
		

		function Resultupdate()
		{
			

				var update="selectOne";
				var title =$('#Title').val();
				var group =$('#Group').val();
				var type=$('#Type').val();
				var studentID=$('#StudentID').val();
				var RollNO=$('#RollNO').val();
				var regNo=$('#RegNo').val();
				var gpa=$('#GPA').val();
				var session=$('#Session').val();
				var Year =$('#Year').val();
			
				
				$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {update:update,title:title,group:group,type:type,studentID:studentID,RollNO:RollNO,regNo:regNo,gpa:gpa,session:session,Year:Year},
							 success : function(text)
								{
									$("#msgShow").html(text);
									
								}
							
					});

		}


		function ResultAdd(){
				//alert('dd');
				var chekId="selectOne";
				var title =$('#Title').val();
				var group =$('#Group').val();
				var type=$('#Type').val();
				var studentID=$('#StudentID').val();
				var RollNO=$('#RollNO').val();
				var regNo=$('#RegNo').val();
				var gpa=$('#GPA').val();
				var session=$('#Session').val();
				var Year =$('#Year').val();
			
				
				$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {chekId:chekId,title:title,group:group,type:type,studentID:studentID,RollNO:RollNO,regNo:regNo,gpa:gpa,session:session,Year:Year},
							 success : function(text)
								{
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
				var dchekid="10";
				$.ajax({
							url:"ajaxForBoardResult.php",
							type:"POST",
							data : {dchekid:dchekid,chekvalue:chekvalue},
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

