<?php

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	$selProject="SELECT * FROM `project_info`";
	$resproject=$db->select_query($selProject);
	@$counrows=$resproject->num_rows;
	if($counrows>0){
			$fetchResult=$resproject->fetch_array();
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
	    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 <script>
	   $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });
				
				   $(document).ready(function () {
                    
                    $('#example12').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });
				
				function showATtendance(){
						var FristDAte=$('.FristDAte').val();
						var sndDAte=$('.sndDAte').val();
						var submit1="ss";
						$('#frstDiv').hide();
						$('#secondDive').show();
					$.ajax({
							url : "ajaxForDateWiseStrffAttendance.php",
							data : {FristDAte:FristDAte,sndDAte:sndDAte,submit1:submit1},
							
							type : "POST",
							success:function(data){
									$('#secondDive').html(data);	
							}
						});
				}
					function Back(){
							$('#frstDiv').show();
						$('#secondDive').hide();
					}
				 
	 </script>
	 <style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPritntd{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
    <link href="../css/bootstrap.min.css" rel="stylesheet"></head>
	 <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addATeent" >
	 <div class="col-lg-12" id="frstDiv">
		
	 	<table width="" border="0" class="table-responsive table-bordered" style="margin-top:10px; width:100%;">
						
					  <tr>
						<td height="43" colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <tr>
						<td height="32" colspan="9" align="center">&nbsp;
								<span><strong style="font-size:15px;">From Date</strong></span>&nbsp; &nbsp;<input type="text" class="FristDAte" name="FristDAte" id="example1"/>&nbsp; &nbsp;
								<span><strong style="font-size:15px;">&nbsp;&nbsp;  To Date </strong></span>&nbsp; &nbsp;<input type="text" name="sndDAte" id="example12" class="sndDAte"/>&nbsp;&nbsp;						
								<input  type="button" onClick="return showATtendance()" name="submit" id="submit" value="Submit" />
								</td>
					  </tr>
					  <tr>
					
					
					    <td height="30" colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" > List of Struff Attendance</strong></span></td>
						
	      			</tr>
					 <tr>
					    <td height="30" colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >Please Select Date And Submit................</strong></span></td>
						</tr>
					
					
				
		 
					<tr>
					    <td height="30" colspan="9" align="center">&nbsp; <input type="submit" name="print" id="print" class="noneBtnForprin" onClick="return window.print()" value="print"/></td>
	      		</tr>
	   </table>

	 </div>
	 <div  class="col-lg-12" id="secondDive"></div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
