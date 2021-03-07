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
				margin: 2mm;/* margin you want for the content */
			}
		}
</style>
  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
	<?php
	
	
							$sql="SELECT COUNT(`running_student_info`.`student_id`),`running_student_info`.*,`student_acadamic_information`.`session2` FROM `running_student_info` 
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` 
 WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `student_acadamic_information`.`session2`='".$_GET["session"]."'  AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."'";
							//print $sql;
							$result=$db->select_query($sql);
							if($result)
							{
								$row=$result->fetch_array();
							}
							$rows = $row[0];
							
							$page_rows =12;
							$last = ceil($rows/$page_rows);
							if($last < 1)
							{
								$last = 1;
							}
							$pagenum = 1;
							if(isset($_GET["pn"]))
							{
								
								$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
							}
							if($pagenum < 1)
							{
									$pagenum = 1;
							}
							else if($pagenum > $last){
								$pagenum = $last;
								
							}
								$sl =0;
							$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
							$sql1= "SELECT `running_student_info`.*,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2`,`add_class`.`class_name`,`add_group`.`group_name` 
FROM `running_student_info` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` 
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` INNER JOIN  `add_group` ON `add_group`.`id`=`running_student_info`.`group_id`
INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id`  WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `student_acadamic_information`.`session2`='".$_GET["session"]."' AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."' ORDER BY `running_student_info`.`class_roll` ASC $limit";
							$result1=$db->select_query($sql1);
							$textline1= "Commetee Members(<b>$rows</b>)";
							$textline2="Page<b>$pagenum</b>of<b>$last</b>";
							$pagenationCtrl = '';
							if($last != 1){
								//$pagenationCtrl.= '';
								if($pagenum > 1 )
								{
									$previous = $pagenum-1;
									$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$_GET["clID"].'&gpna='.$_GET["gpna"].'&exam='.$_GET["exam"].'&session='.$_GET["session"].'&stdRollfrom='.$_GET['stdRollfrom'].'&stdRollto='.$_GET['stdRollto'].'&pn='.$previous.'" class="previous">Previous</a></li> &nbsp;';
										for($i = $pagenum-4;$i < $pagenum; $i++){
											
											if($i > 0){
												
												$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$_GET["clID"].'&gpna='.$_GET["gpna"].'&exam='.$_GET["exam"].'&session='.$_GET["session"].'&stdRollfrom='.$_GET['stdRollfrom'].'&stdRollto='.$_GET['stdRollto'].'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											}
											
										}
										
								}
								$pagenationCtrl.=''.$pagenum.'&nbsp;';
									for($i = $pagenum+1;$i <= $last; $i++){
											$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$_GET["clID"].'&gpna='.$_GET["gpna"].'&exam='.$_GET["exam"].'&session='.$_GET["session"].'&stdRollfrom='.$_GET['stdRollfrom'].'&stdRollto='.$_GET['stdRollto'].'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											if($i >= $pagenum+4){
												
												break;
											}
											
										}
										if($pagenum != $last)
										{
											$next=$pagenum+1;
											$pagenationCtrl.='&nbsp; &nbsp;<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$_GET["clID"].'&gpna='.$_GET["gpna"].'&exam='.$_GET["exam"].'&session='.$_GET["session"].'&stdRollfrom='.$_GET['stdRollfrom'].'&stdRollto='.$_GET['stdRollto'].'&pn='.$next.'" class="next">Next</a></li>';
										}
										//$pagenationCtrl.="</ul>";
							}		
							
							
		 	/*$selecr_data = "SELECT `running_student_info`.*,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2`,`add_class`.`class_name`,`add_group`.`group_name` 
FROM `running_student_info` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` 
INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` INNER JOIN  `add_group` ON `add_group`.`id`=`running_student_info`.`group_id`
INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id`  WHERE `running_student_info`.`class_id`='".$_GET["clID"]."' AND `running_student_info`.`group_id`='".$_GET["gpna"]."' AND `student_acadamic_information`.`session2`='".$_GET["session"]."' AND `running_student_info`.`class_roll`  BETWEEN '".$_GET["stdRollfrom"]."' AND '".$_GET["stdRollto"]."' ORDER BY `running_student_info`.`class_roll` ASC";*/
$result_data = $db->select_query($sql1);		
						if($result_data->num_rows > 0)	{
								while($fetch_Data = $result_data->fetch_array()){
	?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height:170px; margin-top:20px; "  >
		  
			
											
											
		  	<table height="159" border="1" cellpadding="0" cellspacing="0" style=" width:100%; height:155px; " >
  <tr style="border:1px #000000 solid" >
											 <td width="64" style="border-right:1px #FFFFFF solid;"> 	 <img src="all_image/logoSDMS2015.png"  style="height:50px; width:50px; margin-top:2px; margin-bottom:2px; margin-left:5px"/><span  style="font-size:18px;"> </td>
											  <td width="390" colspan="3" align="center">
											<span style="font-size:18px;"> <?php print $fetch_school_information['institute_name'] ?></span>
												 <br/>
												 <span style="font-size:15px; "> <?php print $fetch_school_information['location'] ?></span><br/>
												 <strong>
		<?php
				$examName = "SELECT * FROM `exam_type_info` WHERE `exam_id`='".$_GET["exam"]."'";
				$resultName = $db->select_query($examName);
					if($resultName->num_rows > 0 ){
						$fetcjMane= $resultName->fetch_array();
					}
					echo $fetcjMane['exam_type'];
		?>
							  &nbsp;</td>
			  </tr>
  <tr align="center">
    <td height="25" style="border-right:#FFFFFF 1px solid">Name : </td>
    <td colspan="3">&nbsp;<strong style="font-size:14px"><?php echo $fetch_Data['student_name']?></strong></td>
    </tr>
  <tr align="center">
    <td width="72" height="24" style="border-right:#FFFFFF 1px solid">Class :</td>
    <td width="64">&nbsp;<?php echo $fetch_Data['class_name']?></td>
    <td width="69" style="border-right:#FFFFFF 1px solid"> &nbsp;Group : </td>
    <td width="119">&nbsp;<?php echo $fetch_Data['group_name']?></td>
  </tr>
  <tr align="center">
    <td height="30" style="border-right:#FFFFFF 1px solid">Roll : </td>
    <td>&nbsp;<b><?php echo $fetch_Data['class_roll']?></b></td>
    <td style="border-right:#FFFFFF 1px solid">ID : </td>
    <td>&nbsp; <?php echo $fetch_Data['student_id']?></td>
  </tr>
</table> 

		  </div>
		  <?php  }  } ?>
		  	<ul class="pager noneBtnForprin" >
						<?php echo $pagenationCtrl;?>
						</ul>
					
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
