
<?php 	
	include("../../db_mysql_connect_folder/dateBaseConnectionPage.php");
	$id=$_GET['stid'];

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Student Details</title>
<style type="text/css">
.table{border:1px #4639E8 solid;}
.title{color:#000000; font-size:25px; font-weight:bold; text-align:center;}
.intitle{padding-left:15px; color:#0033CC; font-size:18px; letter-spacing:0.5px;}
.text{padding-left:15px; color:#000000; font-size:18px; }
</style>

<style media="print">
.print{display:none;}
</style>
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


</head>

<body style="background:#e5e5e5;background: -moz-radial-gradient(center, ellipse cover,  #e5e5e5 0%, #ffffff 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#e5e5e5), color-stop(100%,#ffffff));
  background: -webkit-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%); 
  background: -o-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%); 
  background: -ms-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%);
  background: radial-gradient(ellipse at center,  #e5e5e5 0%,#ffffff 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5e5e5', endColorstr='#ffffff',GradientType=1 ); 
 font: 600 15px "Open Sans",Arial,sans-serif;">
 
 <center>
	<table  class="table" width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="41" align="center" bgcolor="#99CCFF"><span class="title">View Studen's Information</span> </td>
    </tr>
  <tr>
    <td>
					<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#99CCCC">
      <tr>
        <td height="33" colspan="4" bgcolor="#BADCDC"><span class="intitle">PERSONAL INFORMATION </span></td>
      </tr>
	  <?php
	  	$select_personal=mysql_query("SELECT * FROM `student_parsonal_info` WHERE `student_id`='$id'");
		$fetch_personal=mysql_fetch_array($select_personal);
	  ?>
      <tr>
        <td height="40" bgcolor="#FFFFFF"><span class="text">Application Date</span></td>
        <td bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal['AdmissionDate']; ?></td>
        <td width="229" rowspan="6" align="center" bgcolor="#FFFFFF"><img src="image/<?php print $_GET['stid']?>.jpg" height="156" width="180" /></td>
      </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Studen's Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[1]; ?></span></td>
        </tr>
       <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Father's Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[2]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Mother's Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[3]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Gender</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[4]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Date Of Birth</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[5]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Religion</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[6]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Nationality</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[7]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Relationship</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[8]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Blood Group</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[9]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student's Contact No.</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[10]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student's Email</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[11]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student's ID</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[0]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student's Passward</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_personal[12]; ?></span></td>
        </tr>
    </table>
	
	</td>
    </tr>
	<tr>
		<td>
			<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
						  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">PREVIOUS RESULT </span></td>
						  </tr>
						  <?php 
						  	$select_pre=mysql_query("SELECT * FROM `previous_result` WHERE `student_id`='$id'");
							$fetch_pre=mysql_fetch_array($select_pre);
						  ?>
						  
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> Institute</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[2]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> Registration No.</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[3]; ?></span></td>
     					 </tr>
						  
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> Roll No.</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[5]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> Group</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[6]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> GPA</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[7]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text"> Passing Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_pre[8]; ?></span></td>
     					 </tr>
						 
		  </table>

		</td>
	</tr>
	<tr>
		<td>
			<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
				  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">STUDENT'S ADDRESS INFORMATION</span></td>
				  </tr>
				  <?php 
				  	$select_add=mysql_query("SELECT * FROM `student_address_info` WHERE `student_id`='$id'");
					$fetc_add=mysql_fetch_array($select_add);
				  
				  ?>
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present House Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[1]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Village</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[2]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[3]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[4]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Upazila</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[5]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> District</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[6]; ?></span></td>
			  </tr>
				
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Permanent House Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[7]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Village</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[8]; ?></span></td>
			  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[9]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[10]; ?></span></td>
			  </tr>
					<tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Upazila</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[11]; ?></span></td>
     				</tr>
					<tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> District</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_add[12]; ?></span></td>
     				</tr>
		  </table>

		</td>
	</tr>
	<tr>
		<td>
				<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
				  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">GUARDIAN'S INFORMATION
 </span></td>
				  </tr>
				  <?php 
				  	$select_gra=mysql_query("SELECT * FROM `guardian_information` WHERE `student_id`='$id'");
					$fetc_gra=mysql_fetch_array($select_gra);
				  
				  ?>
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian's  Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[1]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> House Name </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[2]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">	 Village </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[3]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[4]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[5]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Upazila </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[6]; ?></span></td>
   				  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> District </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[7]; ?></span></td>
   				  </tr>
				
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Relation With Student</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[8]; ?></span></td>
   				  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Contact No.</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[9]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text"> Email</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_gra[10]; ?></span></td>
   				  </tr>
		  </table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
				  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">Acamedic Information
 </span></td>
				  </tr>
				  <?php 
				  	$select_ACA=mysql_query("SELECT * FROM `acadamic_information` WHERE `student_id`='$id'");
					$fetc_aca=mysql_fetch_array($select_ACA);
				  
				  ?>
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Applicant Desire Class</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_aca[1]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Applicant Desire Group </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_aca[2]; ?></span></td>
			  </tr>
				  
				 
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Session </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetc_aca[5]; ?></span></td>
			  </tr>
				
			
				
		  </table>
		</td>
	</tr>
	
</table>

<br>
	<form name="frm" method="post" action="" >
	<input type="submit"  class="print" value="Print" class="noneBtnForprin" name="print" onClick="window.print()" style="height:30px; width:120px; background:#0099CC; color:#FFFFFF;" >	
	&nbsp;&nbsp;
</form>	</center>
</body>
</html>
<br />
