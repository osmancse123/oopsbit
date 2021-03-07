
<?php
error_reporting(0);
require_once("../db_connect/config.php");
require_once("../db_connect/conect.php");
	
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
AND `result`.`session`='$session' GROUP BY `result`.`session` order by `result`.`std_roll` ASC";


//echo $sqlSelectName;
		$resulName=$db->select_query($sqlSelectName);
		if($resulName){
				$fetchinfo=$resulName->fetch_array();
		}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Tabulation Sheet</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.x-git.min.js"></script>
	<script src="textEdit/redactor/redactor.min.js"></script>


<script type="text/javascript">
	
	function delmarks(stdid)
	{
		
		
		var con=confirm("Do you want to delete the load?");
		if(con==true)
		{
			var groupId= $("#hiddenId").val();
			var deleterAll="Delete All Subject";
			

					 $.ajax({
          
                    type: "POST",
                    url: "deleteMarks.php",
                    data: {stdid:stdid,groupId:groupId,deleterAll:deleterAll},
                    cache: false,
                    success: function(data) {
                    		//alert(data);

                    		
              				location.reload();
            			}
             		});

     			

		}
		else
		{
				return false;
		}
	}
</script>

<script type="text/javascript">
	
	function singleSubDelete(sub,std)
	{
		
		
		var con=confirm("Do you want to delete the load?");
		if(con==true)
		{
			var groupId= $("#hiddenId").val();


			var deleteSingleSub="Delete All Subject";
			

					 $.ajax({
          
                    type: "POST",
                    url: "deleteMarks.php",
                    data: {stdid:std,groupId:groupId,sub:sub},
                    cache: false,
                    success: function(data) {
                    		//alert(data);

                    		
              				location.reload();
            			}
             		});

     			

		}
		else
		{
				return false;
		}
	}
</script>


   

 <style>
 ul li{ list-style: none; display: inline; margin:auto; }
 ul li a{ background: GREEN; padding: 10px 15px 10px 15px; color: #fff; border-radius:10px; }
	@media print{
			.noneBtnForprin{
				display:none;
			}
			.not{
				display:none;
			}
			.notPrint{
				display:none;
			}
		
			
		}


</style>

<input type="hidden" name="hiddenId" id="hiddenId" value="<?php print $gpId;?>">

<table   cellpadding="0" cellspacing="0"  style="border:1px #000 solid;  margin: 5px;">
	


<?php
	$subName=0;
	
	$totalStudent="SELECT `marksheet`.`STudentID`,`marksheet`.`StudentRoll`,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN  `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID` WHERE `ClassId`='$clId' AND `GroupID`='$gpId' AND `ExamId`='$examId' AND `Session`='$session' GROUP BY `STudentID` ORDER BY `marksheet`.`StudentRoll` ASC";
	//echo $selectStudent;
	$querystudentTotal=$db->select_query($totalStudent);
	$rows=$querystudentTotal->num_rows;
	//echo $rows;

// ........................................ Pagination ......................................................
// 							
							$page_rows = 75;
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



// ........................................ end Pagination ......................................................
// 	

$printsl=0;


	$selectStudent="SELECT `marksheet`.`STudentID`,`marksheet`.`StudentRoll`,`student_personal_info`.`student_name` FROM `marksheet` INNER JOIN  `student_personal_info` ON `student_personal_info`.`id`=`marksheet`.`STudentID` WHERE `ClassId`='$clId' AND `GroupID`='$gpId' AND `ExamId`='$examId' AND `Session`='$session' GROUP BY `STudentID` ORDER BY `marksheet`.`StudentRoll` ASC $limit";
	//echo $selectStudent;
	$queryStudent=$db->select_query($selectStudent);

		if($queryStudent){
				while($fetchSelectName=$queryStudent->fetch_array())
				{
$subName++;
$toalSubjectMarks=0;
$toalObtainMark=0;

	$printsl++;


if($printsl%7==0 || $printsl==1)
{


?>



<tr>
	
<td  style=" border-bottom:1px #000 solid;" valign="top" align="center">
	<table style="padding: 0px; margin: 0px; margin-top: 80px;">
			<tr>
				<td> 
				<span>
					<img src="all_image/logoSDMS2015.png" style=" width: 50px; height: 50px">
				</span>
			</td>
<td>
				<span style="font-size: 36px; font-weight: bold; vertical-align: middle;"> 
					<?php  echo $fetch_query["institute_name"]; ?></span>
				 </td>
			</tr>


			<tr>
				<td colspan="2"> 
				 <strong><span class="text-justify text-success" style="">Tabulation Sheet : <?php echo $fetchinfo['exam_type'];?> </span></strong>,&nbsp;&nbsp; <strong><span class="text-justify text-success" style="">Class :&nbsp;<?php  echo $fetchinfo["class_name"];?>, &nbsp;&nbsp;Session :&nbsp;<?php   echo $fetchinfo["session"];?> , &nbsp;&nbsp;Group : &nbsp;<?php   echo $fetchinfo["group_name"];?></span></strong>
			</td>

			</tr>

			<tr>
				<td colspan="2" height="5"></td>
			</tr>


	</table>


</td>
</tr>
<?php
}
?>

<tr>
	

	<td  >
		<div style="width: 100%; ">
		
		<table  cellpadding="0" cellspacing="0">
				
				<tr>
					
					<td  style=" border-right:1px #000 solid; border-bottom:1px #000 solid; width:60px;" valign="top">

						<table width="100%"  cellpadding="0" cellspacing="0"  style="height: 100%">
							
								<tr>
										<td style="border-bottom:1px #000 solid; height: 36px; text-align: center; font-weight: bold; ">ID</td>
								</tr>

								<tr>
									<td  align="center" valign="middle">
										<br><br>

										<span style="vertical-align: middle; font-weight: bold; padding-top: 30px;"><?php echo $fetchSelectName['STudentID'];?></span>
									</td>

								</tr>
						</table>

					</td>



<td   style="border-right:1px #000 solid; border-bottom:1px #000 solid; " valign="top">

						<table width="100%"  cellpadding="0" cellspacing="0"  style="height: 100%">
							
								<tr>
										<td style="border-bottom:1px #000 solid; height: 36px; text-align: center; font-weight: bold; padding-left: 5px; padding-right: 5px;"> Roll </td>
								</tr>

								<tr>
									<td  align="center" valign="middle">
										<br><br>

										<span style="vertical-align: middle; font-weight: bold; padding-top: 30px;"><?php echo $fetchSelectName['StudentRoll'];?></span>
									</td>

								</tr>
						</table>

					</td>


<td   style="border-right:1px #000 solid; border-bottom:1px #000 solid; width:120px;" valign="top">

						<table width="100%" height="100%"  cellpadding="0" cellspacing="0"  style=" padding: 0px; margin: 0px; width: 120px;">
							
								<tr>
										<td style="border-bottom:1px #000 solid; height: 36px; text-align: center; font-weight: bold;  ">Name</td>
								</tr>

								<tr>
									<td  align="center" valign="middle">
										<br>

										<span style="vertical-align: middle;  "><?php echo $fetchSelectName['student_name'];?></span><br>
										<input type="button"  class="notPrint"  name="btndel" class="btndel" value="Delete" onclick="return delmarks(<?php echo $fetchSelectName['STudentID']; ?>);">
									</td>

								</tr>
						</table>

					</td>


				

				



<?php
	$selectSubjectType="SELECT `add_subject_info`.`select_subject_type`  FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`STudentID`='$fetchSelectName[STudentID]' GROUP BY `add_subject_info`.`select_subject_type` ORDER BY `add_subject_info`.`select_subject_type` ASC ";

	$querySubjectType=$db->select_query($selectSubjectType);
		if($querySubjectType){
				while($fetchSubjecttype=$querySubjectType->fetch_array())
				{

					$selectSubject="
SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name` FROM `marksheet` INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
  
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' AND `marksheet`.`STudentID`='$fetchSelectName[STudentID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' GROUP BY `add_subject_info`.`subject_code`  ORDER BY `add_subject_info`.`serial` ASC ";

	$querysubject=$db->select_query($selectSubject);
		if($querysubject){
				while($fetchsubject=$querysubject->fetch_array())
				{



						$selectSubPart="SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`add_subject_part_info`.`subject_part_name`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`part_id` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info`ON `add_subject_part_info`.`subject_name`=`marksheet`.`SubjectId`
WHERE `add_subject_part_info`.`class_id`='$clId' AND `add_subject_part_info`.`group_id`='$gpId' AND `add_subject_part_info`.`exam_type`='$examId'
AND `marksheet`.`Session`='$session' AND `marksheet`.`STudentID`='$fetchSelectName[STudentID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' 
AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' GROUP BY `add_subject_part_info`.`part_id` ORDER BY `add_subject_part_info`.`sl` ASC ";

$querySubjectPart=$db->select_query($selectSubPart);
if($querySubjectPart)
{

		while($fetchSubjectPart=$querySubjectPart->fetch_array())
		{


		

// ...............................................Select Part Marks....................................
	
			$selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,
`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`subject_part_name`,`subject_information`.`ContAss`,
`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`
INNER JOIN  `subject_information` ON `subject_information`.`subPartId`=`marksheet`.`SubjectPartID`
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' 
AND `marksheet`.`STudentID`='$fetchSelectName[STudentID]' AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' AND  `marksheet`.`SubjectPartID`='$fetchSubjectPart[part_id]' AND `subject_information`.`examID`='$examId'";






$querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
if($querysubjectPartmarks)
{

		if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
		{


?>


	<td style="border-right:1px #000 solid; border-bottom:1px #000 solid; width: 130px; " valign="top">
					

				


								<table  cellpadding="0" cellspacing="0"  style="height: 100%; border-top: 0px; width: 150px;"  height="100%" >
							
								<tr>
										<td style="border-bottom:1px #000 solid; height: 36px; text-align: center;  "><?php
										// print $fetchSubjecttype['select_subject_type']."<br>"; 
 											//print $fetchsubject['subject_name']."<br>"; 
										if($subName==1)
											{
												print "<span style='font-size:13px;'>".$fetchSubjectPart['subject_part_name']."&nbsp;(". $fetchSubjectPart['subject_part_code'].")"."</span>";
											}
											else
											{
												print $fetchSubjectPart['subject_part_code'];
											}

											

										?>
										
<input type="button"  class="notPrint" name="delsub" value="del" id="delsub" onclick="return singleSubDelete(<?php print $fetchsubject['SubjectId'];?>,<?php print $fetchSelectName['STudentID'];?>)" >

										</td>
								</tr>




								<tr>
									<td  <?php if($fetchSubjectPartmarks[5]=='F') {?>


									bgcolor="#ccc"

									<?php
								}
								?>>
										
										<table width="100%"  cellpadding="0" cellspacing="0"  style="height: 100%">
											<tr>
														
													<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> CA </td>
													<?php
												}
												?>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> CT </td>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> MT </td>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;"> PT </td>
															<td style="border-bottom:1px #000 solid; text-align: center; "> Total </td>
										  </tr>

										  	<tr>
														<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[9]; ?> </td>
													<?php
												}
												?>
													


															
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[10]; ?> </td>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[11]; ?> </td>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[12]; ?> </td>
															<td  style=" border-bottom:1px #000 solid;text-align: center; "> 
																<?php echo $fetchSubjectPartmarks[13]; 

												$toalSubjectMarks+=$fetchSubjectPartmarks[13];
												
													
?>

															 </td>
										  </tr>
										  	<tr>

										  		<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															 <td rowspan="3"  style="vertical-align: middle;"><?php echo $fetchSubjectPartmarks[0]; ?></td>
													<?php
												}
												?>


										  	 
										  	  <td rowspan="3"  style="vertical-align: middle; border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[1]; ?></td>
										  	  <td rowspan="3"  style="vertical-align: middle;border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[2]; ?></td>
										  	  <td rowspan="3" style="vertical-align: middle;border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[3]; ?></td>
										  	 
										  	  <td align="center" style="border-bottom: 1px #000 solid;"><?php echo $fetchSubjectPartmarks[4]; 
// obtainMarks
$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];
										  	  ?></td>
  </tr>
										  	<tr>
										  	  <td align="center" style="border-bottom: 1px #000 solid;"


				<?php if($fetchSubjectPartmarks[5]=='F') {?>


									bgcolor="#ff0000"

									<?php
								}
								?>

								><?php echo $fetchSubjectPartmarks[5]; ?></td>
  </tr>
										  	<tr>
										  	  <td align="center"style="font-weight: bold;" ><?php echo $fetchSubjectPartmarks[6]; ?></td>
  </tr>


													</table>


									</td>

								</tr>
						</table>


				</td>

		<?php
		//..............................SubjectPartmarks
		}
	} 
//................................Subject Part
	}

}
else
{
	// ...............................................Subject Mark Marks // without Part ....................................
	$selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`subject_information`.`ContAss`,`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId` 
INNER JOIN `subject_information` ON `subject_information`.`examID`=`marksheet`.`ExamId` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` 
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$session' 
AND `marksheet`.`STudentID`='$fetchSelectName[STudentID]' AND `marksheet`.`SubjectId`= '$fetchsubject[SubjectId]' AND `subject_information`.`subjectId`='$fetchsubject[SubjectId]' AND `subject_information`.`examID`='$examId'
 ";
			


$querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
if($querysubjectPartmarks)
{

		if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
		{


?>


				<td style="border-right:1px #000 solid; border-bottom:1px #000 solid; width: 150px;  " valign="top">
					

				


								<table width="100%"  cellpadding="0" cellspacing="0"   style="height: 100%; border-top: 0px; width: 150px;">
							
								<tr>
										<td style="border-bottom:1px #000 solid; height: 36px; text-align: center;  "><?php

										if($subName==1)
											{
												 print "<span style='font-size:13px;'>".$fetchSubjectPartmarks['subject_name']."&nbsp;(". $fetchSubjectPartmarks['subject_code'].")"."</span>";
											}
											else
											{
												print $fetchSubjectPartmarks['subject_code'];
											}


										// print $fetchSubjecttype['select_subject_type']."<br>"; 
 											//print $fetchsubject['subject_name']."<br>"; 
										//print $fetchSubjectPart['subject_part_name']."&nbsp;(". $fetchSubjectPart['subject_part_code'].")";

										?>
											
												<input type="button"  class="notPrint" name="delsub" value="del" id="delsub" onclick="return singleSubDelete(<?php print $fetchsubject['SubjectId'];?>,<?php print $fetchSelectName['STudentID'];?>)" >

										</td>
								</tr>




								<tr>
									<td <?php if($fetchSubjectPartmarks[5]=='F') {?>


									bgcolor="#ccc"

									<?php
								}
								?>>
										
										<table width="100%"  cellpadding="0" cellspacing="0"  style="height: 100%">
											<tr>
														
													<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> CA </td>
													<?php
												}
												?>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> CT </td>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> MT </td>
															<td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;"> PT </td>
															<td style="border-bottom:1px #000 solid; text-align: center; "> Total </td>
										  </tr>

										  	<tr>
														<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[9]; ?> </td>
													<?php
												}
												?>
													


															
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[10]; ?> </td>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[11]; ?> </td>
															<td  style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[12]; ?> </td>
															<td  style=" border-bottom:1px #000 solid;text-align: center; "> <?php echo $fetchSubjectPartmarks[13]; 

															$toalSubjectMarks=$toalSubjectMarks+$fetchSubjectPartmarks[13];?> </td>
										  </tr>
										  	<tr>

										  		<?php
														if($fetchSubjectPartmarks[9]!=0)
														{
													?>
															 <td rowspan="3"  style="vertical-align: middle;"><?php echo $fetchSubjectPartmarks[0]; ?></td>
													<?php
												}
												?>


										  	 
										  	  <td rowspan="3"  style="vertical-align: middle; border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[1]; ?></td>
										  	  <td rowspan="3"  style="vertical-align: middle;border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[2]; ?></td>
										  	  <td rowspan="3" style="vertical-align: middle;border-right:1px #000 solid;  text-align: center;"><?php echo $fetchSubjectPartmarks[3]; ?></td>
										  	 
										  	  <td align="center" style="border-bottom: 1px #000 solid;"><?php echo $fetchSubjectPartmarks[4]; 

										  	  		$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];
										  	  ?></td>
  </tr>
										  	<tr>
										  	  <td align="center" style="border-bottom: 1px #000 solid; "

<?php if($fetchSubjectPartmarks[5]=='F') {?>


									bgcolor="#ff0000"

									<?php
								}
								?>
				

								><?php echo $fetchSubjectPartmarks[5]; ?></td>
  </tr>
										  	<tr>
										  	  <td align="center"  style="font-weight: bold;"><?php echo $fetchSubjectPartmarks[6]; ?></td>
  </tr>


													</table>


									</td>

								</tr>
						</table>


				</td>

		<?php
		//..............................SubjectPartmarks
		}
	} 
//................................Subject Part



//..................................
}

// Select SUbject

		}
	}



// End Subject Type
		}
}




		?>

				<td style=" border-right:1px #000 solid;border-bottom:1px #000 solid;width: 130px; " valign="top" 
<?php

							$selectResult="SELECT * FROM `result` WHERE `STD_ID`='$fetchSelectName[STudentID]' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$session' AND `examId`='$examId'";
							$querySelectResult=$db->select_query($selectResult);
							if($querySelectResult)
							{

									if($fetchResult=$querySelectResult->fetch_array())
									{
											
											$gpaWithOptional=$fetchResult[6];
											$gpa=$fetchResult[7];
									}
									else
									{
											$gpaWithOptional="Null";
											$gpa="Null";
									}

							}

	

?>
				>

					<table cellpadding="0" cellspacing="0" width="100%" border="0">
						
						<tr>
							<td style="height: 36px; border-bottom: 1px #000 solid; text-align: center;">GPA</td>
						</tr>

						<?php


							if($gpaWithOptional!=0.00)
							{
						?>


						<tr>

								<td style=" border-bottom: 1px #000 solid; text-align: center;font-weight: bold;">
									
										<?php print $gpaWithOptional; ?>
								</td>
						</tr>

						<tr>

								<td style=" border-bottom: 1px #000 solid; text-align: center;">
									
										Without Optional
								</td>
						</tr>
						<tr>

								<td style=" text-align: center;font-weight: bold;">
									
									 	<?php print $gpa; ?>
								</td>
						</tr>
						<?php
						}
						else
						{?>

						<tr>

								<td style=" text-align: center;  font-weight: bold; ">
									
									 	0.00
								</td>
						</tr>    
							<?php

						}
						?>

					</table>

				</td>

				<td style=" border-bottom:1px #000 solid;  width: 100% ">


<table  cellpadding="0" cellspacing="0" align="center" style="float: left;border-right:1px #000 solid; height:104px;">
	
		<tr>
				<td style=" border-bottom: 1px #000 solid; text-align: center; font-size: 15px;">Total Marks</td>
		</tr>

		<tr>
				<td style="  border-bottom: 1px #000 solid; text-align: center; font-weight: bold;    " valign="bottom"><?php print $toalObtainMark; ?></td>
		</tr>

			<tr>
				<td style="  text-align: center; font-weight: bold; " valign="top"><?php print $toalSubjectMarks; ?></td>
		</tr>
		

<!-- 		<tr>
				<td style="height: 36px; border-bottom: 1px #000 solid; text-align: center;">Place</td>
		</tr>

		<tr>
				<td align="center">1</td>
		</tr> -->

</table>

					


				</td>

				</tr>





			</table>

</div>
	</td>
</tr>

<?php
}
}

?>



<tr>
	<td align="center"  valign="bottom">
		
			<table align="center" >
					<tr>
							<td  align="center" valign="bottom" align="bottom"> .................................. </td>
							<td width="1500"></td>	
						    <td align="center" valign="bottom" align="bottom"> .................................. </td>	
					</tr>
					

						<tr>
							<td align="center"><b>Compared by</b></td>
							<td  align="center" height="20"><b> Developed By : SBIT (www.sbit.com.bd) </b></td>
							  <td align="center"><b>Headmaster</b></td>	
								
					</tr>


			</table>

	</td>
</tr>

</table>
 </body>
</html>
  
 
   
<span style="margin: auto; float: initial;">
	

<table align="center">
	
<tr>
	<td>
<ul class="pager noneBtnForprin" >
					<?php echo $pagenationCtrl;?>
						<button class="btn btn-danger"  onclick="window.print()" style="margin-left: 100px; height: 35px; width: 100px; background: #ff0000; color: #fff; border-radius:10px;"> Print</button>
 </ul>

 </span>
</td>
</tr>

 </table>
