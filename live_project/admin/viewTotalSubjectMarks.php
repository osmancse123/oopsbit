<?php

error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
		$clId=$_GET["clID"];
		$gpId=$_GET["gpna"];
		$examId=$_GET["exId"];
		$session=$_GET["session"];
			$sqlProjectInfo="SELECT * FROM `project_info`";
			$result_query=$db->select_query($sqlProjectInfo);
			if($result_query){
					$fetch_query=$result_query->fetch_array();
				
			}
	$sqlSelectName="SELECT `result`.*,`exam_type_info`.`exam_type`,`add_class`.`class_name`,`add_group`.`group_name` FROM `result`
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`result`.`examId` JOIN `add_class` ON `add_class`.`id`=`result`.`classId`
JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID` WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId'
AND `result`.`session`='$session' GROUP BY `result`.`session`";
		$resulName=$db->select_query($sqlSelectName);
		if($resulName){
				$fetchSelectName=$resulName->fetch_array();
		}
		
		$selecbordersql = "SELECT COUNT(`subject_registration_table`.`subject_id`) FROM `subject_registration_table` INNER JOIN `student_acadamic_information`
ON `student_acadamic_information`.`id` = `subject_registration_table`.`std_id` WHERE `subject_registration_table`.`class_id`='$clId' AND `subject_registration_table`.`group_id`='$gpId' AND `student_acadamic_information`.`session2`='$session' GROUP BY `subject_registration_table`.`std_id` ORDER BY   `subject_registration_table`.`std_id` DESC LIMIT 1";
		$resultborder = $db->select_query($selecbordersql);
		if($resultborder){
				$fetchBorder = $resultborder->fetch_array();
				
		}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tebulation Sheet </title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
</head>

	<body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class=""  style="border:2px #CCCCCC solid;
		
			
			 width:<?php echo 200*$fetchBorder[0];?>px"
			 
			 >
                <span class="text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px"></strong></span><br/>
			
               <table width="109%" height="384" border="1" class="table table-responsive  table-bordered">
  <tr >
    <td width="<?php echo 600*$fetchBorder[0];?>px" height="52" align="center" style="border:1px #000000 solid;"><p><strong><span class="text-justify text-success" style="font-size:18px; padding-left:420px; padding-top:50px;"><?php  if(isset($fetch_query)){echo $fetch_query["institute_name"];} else {echo "";}?> </span></strong></p>
      </td>
    <td width="1562" style="border:1px #000000 solid;"> &nbsp;&nbsp;<strong><span class="text-justify text-warning">CA=Cont. Asses.&nbsp;&nbsp;&nbsp; CT= Creative
    <p>&nbsp;&nbsp;MC=MCQ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PT=Parctical</p></span></strong></td>
  </tr>
  <tr style="border:1px #000000 solid;">
    <td height="24" colspan="2" align="center" style="border:1px #000000 solid;"><strong><span class="text-justify text-success" style="">Total Subject Marks(<?php if(isset($fetchSelectName)){echo $fetchSelectName["exam_type"];} else {echo "";}?>)</span></strong></td>
  </tr>
  <tr >
    <td height="24" colspan="2" align="center" style="border:1px #000000 solid;"><strong><span class="text-justify text-success" style="">Class :&nbsp;<?php  if(isset($fetchSelectName)){ echo $fetchSelectName["class_name"];} else {echo "";}?> &nbsp;&nbsp;Session :&nbsp;<?php  if(isset($fetchSelectName)){ echo $fetchSelectName["session"];} else {echo "";}?> &nbsp;&nbsp;Group : &nbsp;<?php  if(isset($fetchSelectName)){ echo $fetchSelectName["group_name"];} else {echo "";}?></span></strong></td>
  </tr>
  <tr>
    <td height="268" colspan="2"  style="border:1px #000000 solid;">&nbsp;
<!--	fdsg-->

	
      <table width="100%" height="91" border="1" class="" cellpadding="0" cellspacing="0" align="center">
        
		<?php 
		
		

							 $sql="SELECT COUNT(`STD_ID`) FROM `result`  WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId' AND `result`.`session`='$session'";
							//print $sql;
							$result=$db->select_query($sql);
							if($result)
							{
								$row=$result->fetch_array();
							}
							$rows = $row[0];
							
							$page_rows = 5;
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
							 $sql1= "SELECT `result`.*,`student_personal_info`.`student_name` FROM `result`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`result`.`STD_ID` WHERE `result`.`classId`='$clId' AND `result`.`examId`='$examId'
AND `result`.`GroupID`='$gpId' AND `result`.`session`='$session' ORDER BY `result`.`std_roll`   ASC $limit";
							$result1=$db->select_query($sql1);
							$textline1= "Commetee Members(<b>$rows</b>)";
							$textline2="Page<b>$pagenum</b>of<b>$last</b>";
							$pagenationCtrl = '';
							if($last != 1){
								//$pagenationCtrl.= '';
								if($pagenum > 1 )
								{
									$previous = $pagenum-1;
									$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$previous.'" class="previous">Previous</a></li> &nbsp;';
										for($i = $pagenum-4;$i < $pagenum; $i++){
											
											if($i > 0){
												
												$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											}
											
										}
										
								}
								$pagenationCtrl.=''.$pagenum.'&nbsp;';
									for($i = $pagenum+1;$i <= $last; $i++){
											$pagenationCtrl.= '<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$i.'" class="pagination">'.$i.'</a> </li>&nbsp;';
											if($i >= $pagenum+4){
												
												break;
											}
											
										}
										if($pagenum != $last)
										{
											$next=$pagenum+1;
											$pagenationCtrl.='&nbsp; &nbsp;<li><a href="'.$_SERVER['PHP_SELF'].'?clID='.$clId.'&gpna='.$gpId.'&exId='.$examId.'&session='.$session.'&pn='.$next.'" class="next">Next</a></li>';
										}
										//$pagenationCtrl.="</ul>";
							}				
							
						
							
							if($result1){
							$x = 0;
								while($fetchFroStudent=$result1->fetch_array()){
								$x++;
								
				/* $sqlForStudent="SELECT `result`.*,`student_personal_info`.`student_name` FROM `result`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`result`.`STD_ID` WHERE `result`.`classId`='$clId' AND `result`.`examId`='$examId'
AND `result`.`GroupID`='$gpId' AND `result`.`session`='$session' ORDER BY `result`.`std_roll` ASC";
				$resultForStudnt=$db->select_query($sqlForStudent);
				if($resultForStudnt){
					while($fetchFroStudent=$resultForStudnt->fetch_array()){*/
		?>
		<tr bgcolor="#f1f1f1"  >
		
          <td width="33" height="29" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">ID</strong></td>
          <td width="58" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px">Roll</strong></td>
          <td width="247" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px">Name</strong></td>
		  <?php  
		  
		 
		

		  	   $selectSubjectType="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='CompulsorySubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcType=$db->select_query($selectSubjectType);
			if($resultSubjcType){
				$count=$resultSubjcType->num_rows;
				while($fetchsubtype=$resultSubjcType->fetch_array()){
				//print_r($fetchsubtype);
		  	
		  ?>
		 
          <td height="29" colspan="3" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px"><?php //echo $fetchsubtype["select_subject_type"];?><?php if($fetchsubtype["SubjectPartID"]!="NULL") {
		   	 $sqlForPart=" SELECT `add_subject_part_info`.`subject_part_code`,`subject_part_name` FROM `add_subject_part_info` WHERE `part_id`='$fetchsubtype[SubjectPartID]' AND `subject_name`='$fetchsubtype[SubjectId]'";
				$resultForPart=$db->select_query($sqlForPart);
				if($resultForPart){
					$fetchForPart=$resultForPart->fetch_array();
				}
		  ?>  <?php echo '&nbsp;'.$fetchForPart["subject_part_name"].'-'.$fetchForPart["subject_part_code"].'&nbsp;' ?><?php } else {?> <?php echo '&nbsp;'.$fetchsubtype["subject_name"].'-'.$fetchsubtype["subject_code"].'&nbsp;'?> <?php } ?></strong> </td>
		  
		  <?php } }  ?>
		  
		  
		  	<?php   $selectSubjectTypeGp="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='GroupSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcTypegp=$db->select_query($selectSubjectTypeGp);
			if($resultSubjcTypegp){
				$count=$resultSubjcTypegp->num_rows;
				while($fetchsubtype=$resultSubjcTypegp->fetch_array()){
				//print_r($fetchsubtype);
		  	
		  ?>
		
          <td height="29" colspan="3" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px"><?php //echo $fetchsubtype["select_subject_type"];?><?php if($fetchsubtype["SubjectPartID"]!="NULL") {
		   	 $sqlForPart=" SELECT `add_subject_part_info`.`subject_part_code`,`subject_part_name` FROM `add_subject_part_info` WHERE `part_id`='$fetchsubtype[SubjectPartID]' AND `subject_name`='$fetchsubtype[SubjectId]'";
				$resultForPart=$db->select_query($sqlForPart);
				if($resultForPart){
					$fetchForPart=$resultForPart->fetch_array();
				}
		  ?>  <?php echo '&nbsp;'.$fetchForPart["subject_part_name"].'-'.$fetchForPart["subject_part_code"].'&nbsp;' ?><?php } else {?> <?php echo '&nbsp;'.$fetchsubtype["subject_name"].'-'.$fetchsubtype["subject_code"].'&nbsp;'?> <?php } ?></strong> </td>
		  
		  <?php } }  ?>
		  
		  <?php   $selectSubjectTypeop="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='OptionalSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcTypeop=$db->select_query($selectSubjectTypeop);
			if($resultSubjcTypeop){
				$count=$resultSubjcTypeop->num_rows;
				while($fetchsubtype=$resultSubjcTypeop->fetch_array()){
				//print_r($fetchsubtype);
		  	
		  ?>
		 
          <td height="29" colspan="3" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px"><?php //echo $fetchsubtype["select_subject_type"];?><?php if($fetchsubtype["SubjectPartID"]!="NULL") {
		   	 $sqlForPart=" SELECT `add_subject_part_info`.`subject_part_code`,`subject_part_name` FROM `add_subject_part_info` WHERE `part_id`='$fetchsubtype[SubjectPartID]' AND `subject_name`='$fetchsubtype[SubjectId]'";
				$resultForPart=$db->select_query($sqlForPart);
				if($resultForPart){
					$fetchForPart=$resultForPart->fetch_array();
				}
		  ?>  <?php echo '&nbsp;'.$fetchForPart["subject_part_name"].'-'.$fetchForPart["subject_part_code"].'&nbsp;' ?><?php } else {?> <?php echo '&nbsp;'.$fetchsubtype["subject_name"].'-'.$fetchsubtype["subject_code"].'&nbsp;'?> <?php } ?></strong> </td>
		  
		  <?php } }  ?>
		  
		  
		 
		   <td width="46" align="center" style="border:1px #000000 solid;"><strong style="color:#000000 ; font-size:16px">CGPA</strong></td>
		  
        </tr>
        <tr >
          <td width="33" rowspan="2" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetchFroStudent["STD_ID"];?></strong></td>
          <td width="58" rowspan="2" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetchFroStudent["std_roll"];?></strong></td>
          <td width="247" rowspan="2" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetchFroStudent["student_name"];?></strong> </td>
		<?php 
		
		
			 $selectSubjectType="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='CompulsorySubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcType=$db->select_query($selectSubjectType);
			if($resultSubjcType){
				$count=$resultSubjcType->num_rows;
				while($fetchsubtype=$resultSubjcType->fetch_array()){
		?>
		
			  <td width="55" height="29" align="center" style="border:1px #000000 solid;"> <strong style="color:#000000; font-size:16px">Total</strong></td>
			  <td width="109" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Obtain Marks</strong></td>
			  <td width="99" height="29" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Grade Point</strong></td>
			
			 
			<?php } }  ?>
			
			<?php 
		
		
			 $selectSubjectTypegp="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='GroupSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcTypegp=$db->select_query($selectSubjectTypegp);
			if($resultSubjcTypegp){
				$count=$resultSubjcTypegp->num_rows;
				while($fetchsubtype=$resultSubjcTypegp->fetch_array()){
		?>
		
				  <td width="42" height="29" align="center" style="border:1px #000000 solid;"> <strong style="color:#000000; font-size:16px">Total</strong></td>
			  <td width="120" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Obtain Marks</strong></td>
			  <td width="102" height="29" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Grade Point</strong></td>
			
			<?php } } ?>
			
			
			<?php 
		
		
			 $selectSubjectTypeop="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type`,`subject_name`,`subject_code` FROM `marksheet` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`STudentID`='".$fetchFroStudent["STD_ID"]."'
AND `add_subject_info`.`select_subject_type`='OptionalSubject' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' ORDER BY `add_subject_info`.`serial` ASC";

			$resultSubjcTypeop=$db->select_query($selectSubjectTypeop);
			if($resultSubjcTypeop){
				$count=$resultSubjcTypeop->num_rows;
				while($fetchsubtype=$resultSubjcTypeop->fetch_array()){
		?>
		
			  <td width="69" height="29" align="center" style="border:1px #000000 solid;"> <strong style="color:#000000; font-size:16px">Total</strong></td>
			  <td width="111" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Obtain Marks</strong></td>
			  <td width="92" height="29" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px">Grade Point</strong></td>
			
			  
			<?php } }  ?>
			<td width="46" rowspan="2" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetchFroStudent["CGPA"];?></strong> </td>
        </tr>
        <tr >
		<?php 
			$forSubjectInfo=" SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
 INNER JOIN `add_subject_info` ON `marksheet`.`SubjectId`=`add_subject_info`.`id` WHERE `STudentID`='$fetchFroStudent[STD_ID]' 
 AND `add_subject_info`.`select_subject_type`='CompulsorySubject' AND `marksheet`.`ExamId`='$examId' ORDER BY  `add_subject_info`.`serial` ASC";
		//print $forSubjectInfo;
			$resultInfo=$db->select_query($forSubjectInfo);
			if($resultInfo){
				while($fetsubInfo=$resultInfo->fetch_array()){
		
		?>
		
          <td width="55" height="20" align="center" style="border:1px #000000 solid;"><strong style="color:#000000">
		  <?php 
		  		if($fetsubInfo["SubjectPartID"] != "NULL")
				{
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]' AND `subPartId`='$fetsubInfo[SubjectPartID]'";
				}else {
				
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]'";
				}
				$resultSubInfo=$db->select_query($sqlSubjectMarks);
				if($resultSubInfo)
				{
					$fetchOldsubjecino=$resultSubInfo->fetch_array();
				}
				echo $fetchOldsubjecino["total"];
		  ?>
		 </strong> </td>
          <td width="109" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["obtainMark"];?></strong></td>
          <td width="99" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["GradePoint"];?></strong></td>
         
		  <?php } ?>
		  
		  
       	<?php } ?>
		
		<?php 
			$forSubjectInfogp=" SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
 INNER JOIN `add_subject_info` ON `marksheet`.`SubjectId`=`add_subject_info`.`id` WHERE `STudentID`='$fetchFroStudent[STD_ID]' 
 AND `add_subject_info`.`select_subject_type`='GroupSubject' AND `marksheet`.`ExamId`='$examId' ORDER BY  `add_subject_info`.`serial` ASC";
		//print $forSubjectInfo;
			$resultInfogp=$db->select_query($forSubjectInfogp);
			if($resultInfogp){
				while($fetsubInfo=$resultInfogp->fetch_array()){
		
		?>
		 
          <td width="42" height="20" align="center" style="border:1px #000000 solid;"><strong style="color:#000000">
		  <?php 
		  		if($fetsubInfo["SubjectPartID"] != "NULL")
				{
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]' AND `subPartId`='$fetsubInfo[SubjectPartID]'";
				}else {
				
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]'";
				}
				$resultSubInfo=$db->select_query($sqlSubjectMarks);
				if($resultSubInfo)
				{
					$fetchOldsubjecino=$resultSubInfo->fetch_array();
				}
				echo $fetchOldsubjecino["total"];
		  ?>
		 </strong> </td>
           <td width="120" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["obtainMark"];?></strong></td>
          <td width="102" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["GradePoint"];?></strong></td>
		  <?php } ?>
       	<?php } ?>
		
		<?php 
			$forSubjectInfoop=" SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` 
 INNER JOIN `add_subject_info` ON `marksheet`.`SubjectId`=`add_subject_info`.`id` WHERE `STudentID`='$fetchFroStudent[STD_ID]' 
 AND `add_subject_info`.`select_subject_type`='OptionalSubject' AND `marksheet`.`ExamId`='$examId' ORDER BY  `add_subject_info`.`serial` ASC";
		//print $forSubjectInfo;
			$resultInfoop=$db->select_query($forSubjectInfoop);
			if($resultInfoop){
				while($fetsubInfo=$resultInfoop->fetch_array()){
		
		?>
		
          <td width="69" height="20" align="center" style="border:1px #000000 solid;"><strong style="color:#000000">
		  <?php 
		  		if($fetsubInfo["SubjectPartID"] != "NULL")
				{
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]' AND `subPartId`='$fetsubInfo[SubjectPartID]'";
				}else {
				
					$sqlSubjectMarks="SELECT `subject_information`.`ContAss`,`Creative`,`MCQ`,`practical`,`total` FROM `subject_information` WHERE `subjectId`='$fetsubInfo[SubjectId]'";
				}
				$resultSubInfo=$db->select_query($sqlSubjectMarks);
				if($resultSubInfo)
				{
					$fetchOldsubjecino=$resultSubInfo->fetch_array();
				}
				echo $fetchOldsubjecino["total"];
		  ?>
		 </strong> </td>
           <td width="111" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["obtainMark"];?></strong></td>
          <td width="92" align="center" style="border:1px #000000 solid;"><strong style="color:#000000; font-size:16px"><?php echo $fetsubInfo["GradePoint"];?></strong></td>
		  <?php } ?>
       	<?php } ?>
		
		
	    </tr>
       
     
		
				<?php } }?>
      </table>

<!--gdhdgg
-->
	<ul class="pager noneBtnForprin" >
						<?php echo $pagenationCtrl;?>
		  </ul>

      </td>
  </tr>
</table></br><br/>
					
							
      </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
