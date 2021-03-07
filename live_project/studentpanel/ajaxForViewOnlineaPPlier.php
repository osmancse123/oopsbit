<?php
	error_reporting(1);
	@session_start();
	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	
	if(isset($_SESSION["useridid"])){
	
				
	
	  $sql ="SELECT `student_personal_info`.*,`student_previous_result`.*,`student_guardian_information`.*,`student_acadamic_information`.*,
`student_address_info`.*,`add_class`.`class_name`,`add_group`.`group_name` FROM `student_personal_info` INNER JOIN `student_previous_result`
ON `student_previous_result`.`id`=`student_personal_info`.`id` INNER JOIN `student_guardian_information`
ON `student_guardian_information`.`id`=`student_personal_info`.`id` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`student_personal_info`.`id` INNER JOIN `student_address_info`
ON `student_address_info`.`id`=`student_personal_info`.`id`  INNER JOIN `add_class` ON `add_class`.`id`=`student_acadamic_information`.`admission_disir_class`
INNER JOIN `add_group`  ON  `add_group`.`id`=`student_acadamic_information`.`admission_disir_group` WHERE `student_personal_info`.`id`='".$_SESSION["useridid"]."'";
	$result =  $db->select_query($sql);
		if($result->num_rows > 0){
			$fetch_result = $result->fetch_array();
		}

	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
<style type="text/css">
.table{border:1px #4639E8 solid;}
.title{color:#000000; font-size:25px; font-weight:bold; text-align:center;}
.intitle{padding-left:15px; color:#0033CC; font-size:18px; letter-spacing:0.5px;}
.text{padding-left:15px; color:#000000; font-size:18px; }
</style>

<style media="print">
.print{display:none;}
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
    <td height="41" align="center" bgcolor="#99CCFF"><span class="title"><?php echo $fetch_result["student_name"]; ?>'s Information</span> </td>
    </tr>
  <tr>
    <td>
					<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#99CCCC">
      <tr>
        <td height="33" colspan="4" bgcolor="#BADCDC"><span class="intitle">PERSONAL INFORMATION </span></td>
      </tr>
	 
      <tr>
        <td height="40" bgcolor="#FFFFFF"><span class="text">Admission Date</span></td>
        <td bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result['addmission_date']; ?></td>
        <td width="229" rowspan="6" align="center" bgcolor="#FFFFFF"><img src="../other_img/<?php print $_POST['getId']?>.jpg" height="156" width="180" /></td>
      </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["student_name"]; ?></span></td>
        </tr>
       <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Father Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["father_name"]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Mother Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["mother_name"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Gender</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["gender"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Date Of Birth</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["date_of_brith"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Religious</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["religious"]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Nationality</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["nationality"]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Relitionship</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["meritial_status"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Blood Group</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["blood_group"]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student Contact</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["contact_no"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student Email</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["email"]; ?></span></td>
        </tr>
     <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student ID</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["id"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" height="40" bgcolor="#FFFFFF"><span class="text">Student Passward</span></td>
        <td width="48" bgcolor="#FFFFFF"><span class="text">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["passward"]; ?></span></td>
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
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Board</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_board"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Institute</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_institute"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Registration</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_registration"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_Year"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Roll</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_roll"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Group</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_group"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC GPA</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_GPA"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">PSC Passing Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["psc_passing_year"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Board</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_board"]; ?></span></td>
     					 </tr>
						    <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Institute</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_institute"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Registration</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_registration"]; ?></span></td>
     					 </tr>
						  <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_Year"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Roll</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_roll"]; ?></span></td>
     					 </tr>
						  <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Group</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_group"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC GPA</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_GPA"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">JSC Passing Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["jsc_passing_year"]; ?></span></td>
     					 </tr>
						   <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Board</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_board"]; ?></span></td>
     					 </tr>
						  <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Institute</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_institute"]; ?></span></td>
     					 </tr>
						  <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Registration</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_registration"]; ?></span></td>
     					 </tr>
						 <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_Year"]; ?></span></td>
     					 </tr>
						 <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Roll</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_roll"]; ?></span></td>
     					 </tr>
						 <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Group</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_group"]; ?></span></td>
     					 </tr>
						  <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC GPA</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_GPA"]; ?></span></td>
     					 </tr>
						 <tr>
							<td width="287" height="40" bgcolor="#FBFBFB"><span class="text">SSC Passing year</span></td>
							<td width="43" bgcolor="#FBFBFB"><span class="text">:</span></td>
							<td width="744" bgcolor="#FBFBFB"><span class="text"><?php echo $fetch_result["ssc_passing_year"]; ?></span></td>
     					 </tr>
		  </table>

		</td>
	</tr>
	<tr>
		<td>
			<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
				  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">STUDENT ADDRESS INFORMATION</span></td>
				  </tr>
				 
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present House Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_house_name"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present Village</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_village"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present Post</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_PO"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_post_code"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present Upazilla</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_upazila"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Present Distric</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["present_distric"]; ?></span></td>
			  </tr>
				
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent House Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_house_name"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent Village</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_village"]; ?></span></td>
			  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent Post</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_PO"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_post_code"]; ?></span></td>
			  </tr>
					<tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent Upazilla</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_upazila"]; ?></span></td>
     				</tr>
					<tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Parmanent Distric</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["permanent_distric"]; ?></span></td>
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
				 
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian  Name</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_name"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian House Name </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_house_name"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian	 Village </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_village"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Post </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_po"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Post Code</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_postCode"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Upazilla </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_upazila"]; ?></span></td>
   				  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Distric </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_distric"]; ?></span></td>
   				  </tr>
				
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Relation With Student</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["relation_with_student"]; ?></span></td>
   				  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Contact</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_contact"]; ?></span></td>
   				  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Guardian Email</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["guardian_email"]; ?></span></td>
   				  </tr>
		  </table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%"  border="0"  cellpadding="1" cellspacing="1" bgcolor="#99CCCC" style="margin-top:5px;">
				  <tr>
						  <td height="43" colspan="3" bgcolor="#BADCDC"><span class="intitle">Accamedic Information
 </span></td>
				  </tr>
				 
				   <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Addmission Disir Class</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["class_name"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Addmission Disir Group </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["group_name"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Regular or Iregular </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["regular_iregular"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Cause  </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["caues"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Session </span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["session2"]; ?></span></td>
			  </tr>
				  <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">TC Order No</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["tc_orderNo"]; ?></span></td>
			  </tr>
				 <tr>
							<td width="287" height="40" bgcolor="#FFFFFF"><span class="text">Date</span></td>
							<td width="43" bgcolor="#FFFFFF"><span class="text">:</span></td>
							<td width="744" bgcolor="#FFFFFF"><span class="text"><?php echo $fetch_result["date"]; ?></span></td>
			  </tr>
				  
				  <tr>
				  	<td width="287" colspan="4" bgcolor="#FFFFFF"><span class="text"><div id="success_message" class="ajax_response" style="float:right"></div></span></td>
				  </tr>
				
				  
		  </table>
		</td>
	</tr>
	
</table>
<?php } ?>
