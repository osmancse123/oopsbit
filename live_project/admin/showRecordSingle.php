
<?php
error_reporting(1);
	@session_start();
		if($_SESSION["userlogin"] === "1")
	{
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

    $db = new database();
	if(isset($_SESSION["useridid"])) {


	$studentDetails="SELECT `running_student_info`.*, `student_personal_info`.*,`student_guardian_information`.`guardian_contact`,
`student_address_info`.`permanent_house_name`,`permanent_village`,`permanent_PO`,`permanent_upazila`,`permanent_distric`,`add_class`.`class_name`,
`add_group`.`group_name` FROM `running_student_info` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
INNER JOIN `student_guardian_information` ON `student_guardian_information`.`id`=`running_student_info`.`student_id`
INNER JOIN `student_address_info` ON `student_address_info`.`id`=`running_student_info`.`student_id` INNER JOIN`add_class`
ON `add_class`.`id`=`running_student_info`.`class_id` INNER JOIN `add_group` ON `add_group`.`id`=`running_student_info`.`group_id` WHERE `running_student_info`.`student_id`='".$_SESSION["useridid"]."'";

print $studentDetails;

		$resultDetails = $db->select_query($studentDetails);
			if($resultDetails->num_rows > 0){
						$fetchDeatials = $resultDetails->fetch_array();
				}
	?>
		 <style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			.not{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPrint{
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
	<table width="927" height="504" border="1" cellpadding="0" cellspacing="0" align="center" style="margin-top:10px;">
  <tr >
  	
    <td height="32" colspan="9" align="center">&nbsp;
	
	
	
		
	<strong><span style="font-size:16px;" class="text-success">Student's Details </span></strong></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="29" align="left" style="padding-left:20px; font-size:16px;">ID No. </td>
	  <td height="29" colspan="2" align="left" style="padding-left:20px; font-size:16px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["student_id"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="210" rowspan="5" align="center" style="padding-left:20px; font-size:16px; vertical-align:middle;"> <?php
								if($fetchDeatials["gender"] =="Male"){
					 	$src = "../other_img/$fetchDeatials[id].jpg";
									if (file_exists($src)) {
									
									?>
								
						
						<img src="../other_img/<?php echo $fetchDeatials["id"] ?>.jpg"  class="img-responsive img-thumbnail"    border="2" style="margin-top:8px;border:0px;  height:150px; width:120px" alt='<?php echo $fetchDeatials["student_name"] ?>'/>
	
									
									<?php
								} else {
								
								?>
						
						<img src="all_image/male.png"  class="img-responsive img-thumbnail"    border="2" style="margin-top:8px;border:0px;  height:150px; width:120px" alt='<?php echo $fetchDeatials["student_name"] ?>'/>
	
								
								<?php 
								
								}
						?><?php } else {
			?>
	<img src="all_image/femaleImage.jpg"  class="img-responsive img-thumbnail"    border="2" style="margin-top:8px;border:0px;  height:150px; width:120px" alt='<?php echo $fetchDeatials["student_name"] ?>'/>
<?php 	}?>	</td>
  </tr>
  
   <tr style="padding-left:20px; font-size:16px;">
  	
    <td width="190" height="28" align="left" style="padding-left:20px; font-size:14px;">Student's Name </td>
	  <td height="28" colspan="2" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["student_name"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="30" align="left" style="padding-left:20px; font-size:14px;">Father's Name </td>
     <td height="30" colspan="2" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["father_name"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="33" align="left" style="padding-left:20px; font-size:14px;">Mother's Name </td>
	  <td height="33" colspan="2" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["mother_name"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="91" align="left" style="padding-left:20px; font-size:14px;">Permanent Address </td>
	  <td height="91" colspan="2" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["permanent_house_name"].','.$fetchDeatials["permanent_village"].','.$fetchDeatials["permanent_PO"].','.$fetchDeatials["permanent_upazila"].','.$fetchDeatials["permanent_distric"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="29" align="left" style="padding-left:20px; font-size:14px;">Date of birth </td>
	  <td width="234" height="29" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["date_of_brith"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="283" height="29"  align="left" style="padding-left:20px; font-size:14px;" >Admission date </td>
		  <td width="210" height="29" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["date_of_brith"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="30" align="left" style="padding-left:20px; font-size:14px;">Religion </td>
	  <td width="234" height="30" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["religious"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="283" height="30"  align="left" style="padding-left:20px; font-size:14px;">Gender</td>
		  <td width="210" height="30" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["gender"];
			}else {
				echo "";
			}
	  ?></td>
  </tr>
   <tr >
  	
    <td width="190" height="29" align="left" style="padding-left:20px; font-size:14px;">Present Year </td>
	  <td width="234" height="29" align="left" style="padding-left:20px; font-size:14px;"><?php echo date('Y');
	  ?></td>
	    <td height="34"  align="left" style="padding-left:20px; font-size:14px;">Blood group </td>
	    <td height="34" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["blood_group"];
			}else {
				echo "";
			}
	  ?></td>
   </tr>
  
   <tr >
  	
    <td width="190" height="27" align="left" style="padding-left:20px; font-size:14px;">Present Class </td>
	  <td width="234" height="27" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["class_name"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="283" align="left" style="padding-left:20px; font-size:14px;"><!--Previous Class--> </td>
	    <td width="210" height="27" align="left" style="padding-left:20px; font-size:14px;"> <?php 
			/*if(isset($fetchRecord)){
				echo $fetchRecord["class_name"];
			}else {
				echo "";
			} */?></td>
  </tr>
   <tr >
  	
    <td width="190" height="30" align="left" style="padding-left:20px; font-size:14px;">Present Group </td>
	  <td width="234" height="30" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["group_name"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="283" align="left" style="padding-left:20px; font-size:14px;"><!--Previous Group--> </td>
	    <td width="210" height="30" align="left" style="padding-left:20px; font-size:14px;"> <?php 
			/*if(isset($fetchRecord)){
				echo $fetchRecord["group_name"];
			}else {
				echo "";
			}*/ ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="28" align="left" style="padding-left:20px; font-size:14px;">Present Roll </td>
	  <td width="234" height="28" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["class_roll"];
			}else {
				echo "";
			}
	  ?></td>
	    <td width="283" align="left" style="padding-left:20px; font-size:14px;"><!--Previous Roll --></td>
	    <td width="210" height="28" align="left" style="padding-left:20px; font-size:14px;"><?php 
			/*if(isset($fetchRecord)){
				echo $fetchRecord["class_roll"];
			}else {
				echo "";
			}*/ ?></td>
  </tr>
  
   <tr >
  	
    <td width="190" height="34" align="left" style="padding-left:20px; font-size:14px;">Gurdian Contact No. </td>
     <td width="234" height="34" align="left" style="padding-left:20px; font-size:14px;"><?php 
	  		if(isset($fetchDeatials)){
				echo $fetchDeatials["guardian_contact"];
			}else {
				echo "";
			}
	  ?></td>
     <td width="283" height="34"  align="left" style="padding-left:20px; font-size:14px;">&nbsp;</td>
     <td width="210" height="34" align="left" style="padding-left:20px; font-size:14px;">&nbsp;</td>
  </tr>
  
   <tr class="noneBtnForprin" >
  	
    <td colspan="4" width="190" height="34" align="center" style="padding-left:20px; font-size:14px;">
			<a href='Student_information.php?edit=<?php echo $fetchDeatials[0] ?>'class='btn btn-primary btn-sm'  style='width:80px'>Edit</a>
			<input type="submit" value="Print" class="btn btn-danger btn-sm"  onclick="window.print()"/>	</td>
  </tr>
</table>

	
		<?php 
	} else 
	{
	 print "<script>location='../Admission/Registration/signIN/signIn.php'</script>";
	}?>

