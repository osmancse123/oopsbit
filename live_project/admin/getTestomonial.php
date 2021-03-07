 <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
		require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
		if(isset($_POST["view"])){
				if(!empty($_POST["date"]) && !empty($_POST["stdid"])){
					
					$chekId="SELECT * FROM `boardexamresult` WHERE `StudentId`='".$_POST["stdid"]."'";
					$resultID=$db->select_query($chekId);
						if($resultID){
					$inserSql="REPLACE INTO `distributedtestomoniallist` (`date`,`studentId`) VALUES ('".$_POST["date"]."','".$_POST["stdid"]."')";
					$resultsql=$db->update_query($inserSql);
					print "<script>location='viewTestimonial.php?date=$_POST[date]&stdid=$_POST[stdid]'</script>";
						}
						else {
							print "<script>alert('Student Not Found..');</script>";
							print "<script>window.close();</script>";
						}
					
					
				}else {
					print "<script>window.close();</script>";
				}
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
        
     <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
          $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd/mm/yyyy"
                    });  
                
                });


      </script>
    </head>
    <body>
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
   				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
						<table align="center" class="table table-responsive" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
								   <tr>
									<td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">Testomonial</span> </td>
								</tr>
								 <tr>
									<td>Date</td>
									<td>:</td>
									<td><input type="text" name="date" id="example1" /></td>
								</tr>
								<tr>
									<td>Student ID</td>
									<td>:</td>
									<td><input type="text" name="stdid" id="stdid" placeholder="Student ID..." /></td>
								</tr>
								 <tr>
									<td  class="warning" colspan="3" align="center">
									
										<input type="submit" name="view" id="view" value="View" formtarget="_blank" class=""/>
									</td>
								</tr>
						</table>
				</div>
    </form>
    </body>
    </html>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

    

