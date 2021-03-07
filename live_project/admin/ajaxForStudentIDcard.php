  <?php
	@error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
 		$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	 

    </head>
<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontprint{
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
  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="container" style="margin-top:50px;">
					<div class="row-fluid">
					<!--for looop-->
					
					<?php
				 	$selecr_data="SELECT `running_student_info`.*,`student_personal_info`.`id`,`student_name`,`student_acadamic_information`.`session2`,
`add_class`.`class_name`,`add_group`.`group_name` FROM `running_student_info` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`= `running_student_info`.`student_id` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` INNER JOIN `add_class`
ON `add_class`.`id`=`running_student_info`.`class_id` INNER JOIN `add_group`
ON `add_group`.`id`=`running_student_info`.`group_id` WHERE `running_student_info`.`class_id`='".$_GET["clID"]."'
AND `running_student_info`.`group_id`='".$_GET["gpna"]."'  AND `student_acadamic_information`.`session2`='".$_GET["session"]."' AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."' ORDER BY `running_student_info`.`class_roll` ASC";
				$result_data = $db->select_query($selecr_data);		
						if($result_data->num_rows > 0)	{
								while($fetch_Data = $result_data->fetch_array()){
					?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<table width="433" border="1" cellpadding="0" cellspacing="0" style="margin-bottom:0px; width:460px;">
							<tr style="border:1px #000000 solid" >
											 <td width="64" style="border-right:1px #FFFFFF solid;"> 	 <img src="all_image/logoSDMS2015.png"  style="height:50px; width:50px; margin-top:2px; margin-bottom:2px; margin-left:5px"/><span  style="font-size:18px;"> </td>
											  <td width="390" colspan="3" align="center">
											<span style="font-size:22px;"> <?php print $fetch_school_information['institute_name'] ?></span>
												 <br/>
												 <span style="font-size:18px; "> <?php print $fetch_school_information['location'] ?></span><br/>
												 <span style="  font-size: 14px; "> Mobile: <?php print $fetch_school_information['phone_number'] ?>,Email:<?php print $fetch_school_information['email'] ?></span>
							  &nbsp;</td>
							  </tr>
							  </table>
							  
									<table width="475" border="1" cellpadding="0" cellspacing="0" style="margin-bottom:25px; width:460px; height:260px;">
											
											<tr>
												<td colspan="4" align="center"> <strong><span style="font-size:16px;font-weight:500; border-bottom:2px #000000 solid; letter-spacing:1" class="text-capitalize text-success">Student ID  -<?php echo $fetch_Data["student_id"];?></span></strong></td>
											</tr>
											
											<tr>
											  <td width="28%" rowspan="7" align="center" style="vertical-align:top">
                                                <img src="../other_img/<?php echo $fetch_Data["student_id"];?>.jpg" height="120" width="120" style="margin-top:5px; margin-left:2px; margin-right:2px;"/><b/>
												
													<span style="font-size:10px; font-family:Geneva, Arial, Helvetica, sans-serif"><?php echo $fetch_Data["student_name"];?></span>											  
												<br/>
												<br/><br/><span>	</span>
											  </td>
											  
											  
											  
												<td width="15%" height="83" style="padding-left:5px; font-size:18px; border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">Name</td>
												<td width="3%" style="padding-left:5px;  font-size:18px;  border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">:</td>
												<td width="54%" style="padding-left:5px;  font-size:18px;border-bottom:1px #FFFFFF solid; "><?php echo $fetch_Data["student_name"];?></td>
											</tr>
											<tr>
											  <td height="32" style="padding-left:5px;  font-size:18px;  border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;"> Class</td>
												<td style="padding-left:5px;  font-size:18px;  border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">:</td>
												<td style="padding-left:5px;  font-size:18px; border-bottom:1px #FFFFFF solid;"><?php echo $fetch_Data["class_name"];?></td>
											</tr>
											<?php 
													if( $fetch_Data["group_name"]!="Null"){
											?>
											<tr>
											  <td height="32" style="padding-left:5px;  font-size:18px;  border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid; ">Group</td>
												<td style="padding-left:5px;  font-size:18px;  border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">:</td>
												<td style="padding-left:5px;  font-size:18px;  border-bottom:1px #FFFFFF solid;"><?php echo $fetch_Data["group_name"];?></td>
											</tr>
											<?php }?>
											<tr>
											  <td height="32" style="padding-left:5px;  font-size:18px; border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">Roll No</td>
											  <td style="padding-left:5px;  font-size:18px; border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">:</td>
											  <td style="padding-left:5px;  font-size:18px; border-bottom:1px #FFFFFF solid;"><?php echo $fetch_Data["class_roll"];?></td>
									  </tr>
											<tr>
											  <td height="32" style="padding-left:5px;  font-size:18px; border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">Year</td>
												<td style="padding-left:5px;  font-size:18px; border-right:1px #FFFFFF solid; border-bottom:1px #FFFFFF solid;">:</td>
												<td style="padding-left:5px;  font-size:18px;"><?php echo date('Y');?></td>
											</tr>
											
											
											
											<td height="30" colspan="2"  align="left" style=" border-top:1px  #FFFFFF solid; border-right:1px #FFFFFF solid; font-size:16px; font-weight:600; letter-spacing:1;">&nbsp;</td>
											  <td height="30" colspan="3" align="right" style="border-top:1px  #FFFFFF solid; font-size:16px; font-weight:600; letter-spacing:1"><span>Principal</span></td>
											</tr>
							  </table>
							  
							  
							</div>
							<?php  } 	} ?>
							<!--End for looop-->
							<input type="submit" value="Print"  class="btn btn-block btn-success noneBtnForprin" style="margin-bottom:10px; border-radius:0px;" onClick="window.print()"/>
					</div>
			</div>	
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
