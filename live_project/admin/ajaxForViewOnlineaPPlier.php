
	

</style>

<?php
	error_reporting(1);
	@session_start();
	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	
	if(isset($_GET["id"])){
	
				
				 $sql_session="SELECT `reg_student_passward`.*,`reg_student_acadamic_information`.*,`reg_student_address_info`.*,`reg_student_guardian_information`.*,
`reg_student_personal_info`.*,`reg_student_previous_result`.* FROM `reg_student_passward` INNER JOIN `reg_student_acadamic_information`
ON `reg_student_passward`.`studentId`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_address_info` ON 
`reg_student_address_info`.`id`=`reg_student_passward`.`studentId` INNER JOIN `reg_student_guardian_information` ON
`reg_student_guardian_information`.`id`=`reg_student_passward`.`studentId` INNER JOIN `reg_student_personal_info` 
ON `reg_student_personal_info`.`id`=`reg_student_passward`.`studentId` INNER JOIN  `reg_student_previous_result`
ON `reg_student_previous_result`.`id`=`reg_student_passward`.`studentId` GROUP BY `reg_student_acadamic_information`.`session2`";
				$resultSession  = $db->select_query($sql_session);
					if($resultSession->num_rows > 0){
					?>	<table class="table table-bordered table-hover">
				<?php		while($fetchSEssion = $resultSession->fetch_array()){
				?>
				
							<tr>
								<td align="center" colspan="10"><span class="text-success" style="font-size:18px;"><?php echo $fetchSEssion["session2"];?></span>
								</td>
							</tr>
							<?php 
									$sqlForClass = "SELECT `reg_student_acadamic_information`.*,`add_class`.`class_name`
 FROM `reg_student_acadamic_information` INNER JOIN `add_class` ON `add_class`.`id`=`reg_student_acadamic_information`.`admission_disir_class`
 WHERE `reg_student_acadamic_information`.`session2`='$fetchSEssion[session2]' GROUP BY `reg_student_acadamic_information`.`admission_disir_class` ORDER BY `reg_student_acadamic_information`.`admission_disir_class` ASC";
 									$resultForClass = $db->select_query($sqlForClass);	
									if($resultForClass->num_rows > 0) {
										while($fetchForClass = $resultForClass->fetch_array()){
							?>
							<tr>
								<td align="center" colspan="10"><span class="text-info" style="font-size:16px;"><?php echo $fetchForClass["class_name"];?></span>
								</td>
							</tr>
							<tr>
									<td align="center">SL NO.</td>
								<td align="center">Student's Name</td>
								<td align="center">Father's Name</td>
								<td align="center">Mother's Name</td>
								<td align="center">Group Name</td>
								<td align="center">Application Date</td>
								<td align="center">Student ID</td>
								<td align="center">Passward</td>
								<td align="center">Action</td>
							</tr>
							<?php 
									$sqlfordetails  = "SELECT `reg_student_personal_info`.*,`reg_student_acadamic_information`.*,`reg_student_passward`.*,`add_group`.`group_name` FROM `reg_student_personal_info`
 INNER JOIN `reg_student_acadamic_information` ON `reg_student_acadamic_information`.`id`=`reg_student_personal_info`.`id`
 INNER JOIN `reg_student_passward` ON `reg_student_passward`.`studentId`=`reg_student_personal_info`.`id` INNER JOIN `add_group` ON
 `add_group`.`id`=`reg_student_acadamic_information`.`admission_disir_group`
 WHERE  `reg_student_acadamic_information`.`session2`='".$fetchForClass["session2"]."' AND
 `reg_student_acadamic_information`.`admission_disir_class`='".$fetchForClass["admission_disir_class"]."' ORDER BY `reg_student_personal_info`.`id` ASC";
 								$resultFordetails = $db->select_query($sqlfordetails);
										if($resultFordetails->num_rows > 0){
										    $sl=0;
											while($fetchfordetails =$resultFordetails->fetch_array()){
											    $sl++;
								
							?>
							<tr>
							    <td align="center"><?php echo $sl;?></td>
								<td align="center"><?php echo $fetchfordetails["student_name"];?></td>
							   <td align="center"><?php echo $fetchfordetails["father_name"];?></td>
								<td align="center"><?php echo $fetchfordetails["mother_name"];?></td>
								<td align="center"><?php echo $fetchfordetails["group_name"];?></td>
								<td align="center"><?php echo $fetchfordetails["addmission_date"];?></td>
								<td align="center"><?php echo $fetchfordetails["studentId"];?></td>
								<td align="center"><?php echo $fetchfordetails["passward"];?></td>
								<td align="center"><input type="button" value="View" class="btn btn-large btn-success" onClick="return viewStudent('<?php echo $fetchfordetails["studentId"];?>')"/> &nbsp;&nbsp; <input type="button"  class="btn btn-large btn-danger" value="Delete" onClick="return deleteStudent('<?php echo $fetchfordetails["studentId"];?>')"/> </td>
							</tr>
							<?php } } } } } ?>
					</table>
				<?php
	
	}
	}
	?>
	
	

	<?php if(isset($_POST["viewAllbyid"])){
	
	 $sql ="SELECT `reg_student_acadamic_information`.*,`reg_student_address_info`.*,`reg_student_guardian_information`.*,`reg_student_personal_info`.*,
`reg_student_previous_result`.*,`reg_student_passward`.*,`add_class`.`class_name`,`add_group`.`group_name` FROM `reg_student_acadamic_information` INNER JOIN `reg_student_address_info`
ON `reg_student_address_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_guardian_information`
ON `reg_student_acadamic_information`.`id`=`reg_student_guardian_information`.`id` INNER JOIN `reg_student_personal_info`
ON `reg_student_personal_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_previous_result`
ON `reg_student_previous_result`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN`reg_student_passward` ON `reg_student_passward`.`studentId`=`reg_student_acadamic_information`.`id` INNER JOIN `add_class` ON `add_class`.`id`=`reg_student_acadamic_information`.`admission_disir_class`
INNER JOIN `add_group`  ON  `add_group`.`id`=`reg_student_acadamic_information`.`admission_disir_group` WHERE `reg_student_acadamic_information`.`id`='".$_POST["getId"]."'";
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
#print{display:none;}
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
 


<table  class="table"  style="max-width: 960px; border-top:1px #4639E8 solid; "  border="0" align="center" cellpadding="0" cellspacing="0">
 
 <tr>
 	<td align="left" style=" padding-left: 20px;"> 

<span style=" float: left;clear: right;"> 
<p style="text-align:left;">
 	<h3  style="text-transform:uppercase; font-size: 22px;"><?php print $fetch_school_information['institute_name'] ?></h3>
 </p>
 <p style="text-align: center;">
 	<h5 style="text-transform:uppercase;">
<?php print $fetch_school_information['location'] ?>
</h5>
</p>
<p style="text-align: center;">
	<h4>
Admission Form - <?php echo $fetch_result["session2"]; ?>
</h4>



</p>
</span>

<span style="float: left; clear: right; margin-left: 60px; margin-top: 50px; ">
	<p>
<h4>
	
	Applicant's ID : <b><?php echo $fetch_result["id"]; ?></b>





</h4>
	</p>
</span>


<span style=" float: right;">


<!-- 	<img src="../other_img/<?php print $_POST['getId']?>.jpg" height="156" width="180" /> -->

	<img src="../other_img/<?php print $_POST['getId']?>.jpg"  style="width: 80px; height: 100px " />
</span>



    </td>

 </tr>


     <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">ADMISSION DESIRE </span></td>
  </tr>

<tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

     <tr>
       
        <td width="321"  bgcolor="#FFFFFF" ><span style="padding-left: 10px; font-size: 14px;">Class</span></td>

        
          <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        </td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["class_name"]; ?></span></td>
        </tr>

	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	


         <tr>
        <td  width="145"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Group</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["group_name"]; ?></span></td>
        </tr>
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>






 <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">PERSONAL INFORMATION </span></td>
  </tr>

  
  <tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>

    <td width="50%">

	 
	 <table>
	 			
	 	
	 		
	 	
      <tr>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Application Date</span></td>

        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        <td width="550" bgcolor="#FFFFFF">

          <span style=" font-size: 14px;"><?php echo $fetch_result['addmission_date']; ?>
        </td>

    

      </tr>


      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["student_name"]; ?></span></td>
        </tr>
       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Father's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["father_name"]; ?></span></td>
        </tr>
     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Mother's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["mother_name"]; ?></span></td>
        </tr>
      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Gender</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["gender"]; ?></span></td>
        </tr>
      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Date Of Birth</span></td>
        <td  bgcolor="#FFFFFF"><span style=" padding-left: 10px;font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["date_of_brith"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Religion</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["religious"]; ?></span></td>
        </tr>
    
   


   
	</table>	


    </td>

    <td width="50%">

    		<table>
    			
    			 <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Nationality</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["nationality"]; ?></span></td>
        </tr>
     <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Relationship</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["meritial_status"]; ?></span></td>
        </tr>
      <tr>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Blood Group</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["blood_group"]; ?></span></td>
        </tr>
    			  <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Contact No.</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["contact_no"]; ?></span></td>
        </tr>
      <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Email</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["email"]; ?></span></td>
        </tr>
     <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        </tr>
      <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        </tr>
    		</table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

 

     <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">PREVIOUS RESULT</span></td>
  </tr>


<tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Institute</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_institute"]; ?></span></td>
        </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Class</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_board"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Class Roll</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_roll"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Board Roll</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_registration"]; ?></span></td>
        </tr>



	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Group</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_group"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Passing Year</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_passing_year"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">GPA/Total Marks</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_GPA"]; ?></span></td>
        </tr>

        <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Documents</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">

          <a href="../other_img/<?php print $_POST['getId']?>tc.jpg" target="_blank" class="print">View</a>

          <?php
                $pathdocument=$_POST['getId']."tc.jpg";
                if (file_exists('../other_img/'.$pathdocument)) 
                {
                    echo "Document attached";
                } 
                else {
                    echo "Document not attached";
                }
          ?>

        </span></td>
        </tr>
      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

<!-- .....................................Address................................-->
   <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">ADDRESS</span></td>
  </tr>


<tr>
    <td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

	 	<tr>
	 			<td colspan="3" align="left" > <b style="padding-left: 10px;">Present Address </b></td>

	 	</tr>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">House Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_house_name"]; ?></span></td>
    </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Village </span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_village"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Post Office</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_PO"]; ?></span></td>
        </tr>



       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Upazila</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_upazila"]; ?></span></td>
        </tr>

       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">District</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_distric"]; ?></span></td>
        </tr>


	</table>	


    </td>

    <td width="50%">

    <table>
    			
        <tr>
	 				<td colspan="3" align="left" > <b style="padding-left: 10px;"> <b> Permanent Address </b> </td>

	 	</tr>
	 	

    	<tr>
        <td width="140"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">House Name</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_house_name"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Village </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_village"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Post Office</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF">
        	<span style="padding-left: 10px; font-size: 14px;">
        		<?php echo $fetch_result["permanent_PO"]; ?></span></td>
        </tr>


        <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Upazila</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        <td colspan="2" bgcolor="#FFFFFF">
        	<span style="padding-left: 10px; font-size: 14px;">
        		<?php echo $fetch_result["permanent_upazila"]; ?></span></td>
        </tr>


       <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">District</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_distric"]; ?></span></td>
        </tr>



      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

    <!-- ................................End Address................................-->
 


<!-- ............................Guardian's	Info................................-->
   <tr>
        <td height="30"   bgcolor="#BADCDC">
        	<span style="padding-left: 10px; font-size: 15px;">GUARDIAN'S INFORMATION </span> </td>
  </tr>



<tr>
    <td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
   <tr>
    <td width="50%">
	 <table>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Guardian  Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_name"]; ?></span></td>
        </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Relation</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["relation_with_student"]; ?></span></td>
        </tr>






	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Guardian's Contact No</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_contact"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Guardian's Email </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_email"]; ?></span></td>
        </tr>
        	
      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

    <!-- ..........................End Guardian's................................-->
 


<tr>


	<td>

		<table width="100%">
		
		<tr>
				<td  align="center">
				
					<br>
.............................<br>
      Guardian  </td>
				<td align="center">
					<br>
					.............................<br>
      Student 


				</td>

		</tr>
	</table>


	</td>

</tr>





<!-- ............................Guardian's	Info................................-->
   <tr>
        <td height="30"   bgcolor="#BADCDC">
        	<span style="padding-left: 10px; font-size: 15px; font-weight: bold;"> ADMINISTRATIVE AREA (Office will fillup this section) </span> </td>
  </tr>



<tr>
    <td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
   <tr>
    <td width="50%">
	 <table>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Admission Date </span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Receipt No.</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>

   <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Roll No.</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>




	</table>	


    </td>



    <td width="50%">

    <table>
    			
    	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Admission Reg. No.</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Admitted Class </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>
        	
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Student ID </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">............................</span></td>
        </tr>
      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

    <!-- ..........................End Guardian's................................-->
 


<tr>


	<td>

		<table width="100%">
		
		<tr>
				<td  align="center">
				
					<br>
.............................<br>
      Register </td>
       <td align="center" valign="bottom">  Developed By: <b>SBIT</b> </td>
				<td align="center">

					<br>
					.............................<br>
      Headmaster 


				</td>

		</tr>
	</table>


	</td>

</tr>


<tr id="print">
              
 <td id="print">
 
                <input type="button" value="Back"  class="btn btn-large btn-danger" onClick="return BAck()"/>&nbsp;&nbsp;&nbsp;

                <input type="button" onClick="window.print()" value="Print" class="btn btn-large btn-info"  />&nbsp;&nbsp;&nbsp;

                <input type="button"  value="Approved For Admit Card"  onclick="return ApproveByIDforADmit('<?php echo $_POST['getId']?>')"  class="btn btn-large btn-success" />&nbsp;&nbsp;&nbsp;

                <input type="button" value="Admission Processing"  onclick="return ApproveByIDstdt('<?php echo $_POST['getId']?>')" 
                 class="btn btn-large btn-primary"/>&nbsp;&nbsp;&nbsp;

          
   </td>

            
        </tr>
</table>



<?php } ?>

<?php
		if(isset($_POST["deletebyId"])){
			

			$sql1 = "DELETE FROM `reg_student_passward` WHERE `studentId`='".$_POST["getId"]."'";
			$sql2 = "DELETE FROM `reg_student_personal_info` WHERE `id`='".$_POST["getId"]."'";
			$sql3 = "DELETE FROM `reg_student_previous_result` WHERE `id`='".$_POST["getId"]."'";
			$sql4 = "DELETE FROM  `reg_student_acadamic_information` WHERE `id`='".$_POST["getId"]."'";			
			$sql5 = "DELETE FROM `reg_student_address_info` WHERE `id`='".$_POST["getId"]."'";
			$sql6 = "DELETE FROM `reg_student_guardian_information` WHERE `id`='".$_POST["getId"]."'";
			$db->delete_query($sql1);
			$db->delete_query($sql2);
			$db->delete_query($sql3);
			$db->delete_query($sql4);
			$db->delete_query($sql5);
			@unlink("../other_img/".$_POST['getId'].".jpg");
		}
?>
<?php
		if(isset($_POST["updatestatus"])){
				$updateStatus = "UPDATE `reg_student_passward`  SET `status`='active' WHERE `studentId`='".$_POST["getdid"]."'";
				$db->update_query($updateStatus);
					if(isset($db->sms))
					
					{
						print $db->sms;
					}
		}
?>	

<?php
		if(isset($_POST["studentadd"])){
		
		
		
				$selectquery  = "SELECT `reg_student_acadamic_information`.*,`reg_student_address_info`.*,`reg_student_guardian_information`.*,
`reg_student_personal_info`.*,`reg_student_previous_result`.* FROM `reg_student_personal_info`
INNER JOIN `reg_student_acadamic_information` ON `reg_student_acadamic_information`.`id`=`reg_student_personal_info`.`id`
INNER JOIN `reg_student_address_info` ON `reg_student_address_info`.`id`  = `reg_student_personal_info`.`id`
INNER JOIN `reg_student_guardian_information` ON  `reg_student_guardian_information`.`id`=`reg_student_personal_info`.`id`
INNER JOIN `reg_student_previous_result` ON `reg_student_previous_result`.`id` = `reg_student_personal_info`.`id`
WHERE `reg_student_personal_info`.`id`='".$_POST["getdid"]."'";


				if($resultsql = $db->select_query($selectquery)){
				
						$fetchSql = $resultsql->fetch_array();
				
						@$personal_insert_query="INSERT INTO `student_personal_info` (`id`,`addmission_date`,`student_name`,`father_name`,`mother_name`,`gender`,`date_of_brith`,`religious`,`meritial_status`,`blood_group`,`nationality`,`contact_no`,`email`) VALUES('".$fetchSql['id']."','".$fetchSql['addmission_date']."','".$fetchSql['student_name']."','".$fetchSql['father_name']."','".$fetchSql['mother_name']."','".$fetchSql['gender']."','".$fetchSql['date_of_brith']."','".$fetchSql['religious']."','".$fetchSql['meritial_status']."','".$fetchSql['blood_group']."','".$fetchSql['nationality']."','".$fetchSql['contact_no']."','".$fetchSql['email']."')";
        
        $previousresult_insert_query="INSERT INTO student_previous_result 
        (id,psc_board, psc_institute, psc_registration,  psc_Year, psc_roll, psc_group, psc_GPA, psc_passing_year,jsc_board,jsc_institute,jsc_registration,jsc_Year,jsc_roll, jsc_group, jsc_GPA, jsc_passing_year,  ssc_board, ssc_institute, ssc_registration, ssc_Year, ssc_roll, ssc_group, ssc_GPA, ssc_passing_year) values
		 ('".$fetchSql['id']."','".$fetchSql['psc_board']."','".$fetchSql['psc_institute']."','".$fetchSql['psc_registration']."','".$fetchSql['psc_Year']."','".$fetchSql['psc_roll']."','".$fetchSql['psc_group']."','".$fetchSql['psc_GPA']."','".$fetchSql['psc_passing_year']."','".$fetchSql['jsc_board']."','".$fetchSql['jsc_institute']."','".$fetchSql['jsc_registration']."','".$fetchSql['jsc_Year']."','".$fetchSql['jsc_roll']."','".$fetchSql['jsc_group']."','".$fetchSql['jsc_GPA']."','".$fetchSql['jsc_passing_year']."','".$fetchSql['ssc_board']."','".$fetchSql['ssc_institute']."','".$fetchSql['ssc_registration']."','".$fetchSql['ssc_Year']."','".$fetchSql['ssc_roll']."','".$fetchSql['ssc_group']."','".$fetchSql['ssc_GPA']."','".$fetchSql['ssc_passing_year']."')";

        $studentaddress_insert_query="INSERT INTO student_address_info (id, present_house_name, present_village, present_PO, present_post_code, present_upazila, present_distric,permanent_house_name, permanent_village, permanent_PO, permanent_post_code, permanent_upazila, permanent_distric) VALUES 
		('".$fetchSql['id']."','".$fetchSql['present_house_name']."','".$fetchSql['present_village']."','".$fetchSql['present_PO']."','".$fetchSql['present_post_code']."','".$fetchSql['present_upazila']."','".$fetchSql['present_distric']."','".$fetchSql['permanent_house_name']."','".$fetchSql['permanent_village']."','".$fetchSql['permanent_PO']."','".$fetchSql['permanent_post_code']."','".$fetchSql['permanent_upazila']."','".$fetchSql['permanent_distric']."')";
        
        @$student_gurdient_informaiton="INSERT INTO `student_guardian_information` (`id`,`guardian_name`,`guardian_house_name`,`guardian_village`,`guardian_po`,`guardian_postCode`,`guardian_upazila`,`guardian_distric`,`relation_with_student`,`guardian_contact`,`guardian_email`) VALUES ('".$fetchSql['id']."','".$fetchSql['guardian_name']."','".$fetchSql['guardian_house_name']."','".$fetchSql['guardian_village']."','".$fetchSql['guardian_po']."','".$fetchSql['guardian_postCode']."','".$fetchSql['guardian_upazila']."','".$fetchSql['guardian_distric']."','".$fetchSql['relation_with_student']."','".$fetchSql['guardian_contact']."','".$fetchSql['guardian_email']."')";

        

        @$student_academic_information="INSERT INTO student_acadamic_information (id, admission_disir_class, admission_disir_group, regular_iregular, caues, session2, tc_orderNo, date) VALUES ('".$fetchSql['id']."','$fetchSql[admission_disir_class]','$fetchSql[admission_disir_group]','".$fetchSql['regular_iregular']."','".$fetchSql['caues']."','".$fetchSql['session2']."','".$fetchSql['tc_orderNo']."','".$fetchSql['date']."')";
		
		$db->insert_query($student_academic_information);
        $db->insert_query($student_gurdient_informaiton);
        $db->insert_query($studentaddress_insert_query);
        $db->insert_query($personal_insert_query);
        $db->insert_query($previousresult_insert_query);
		
			
			
			
				
				}
				
					if(isset($db->sms))
					
					{
						print $db->sms;
					}
		}
?>	