  <?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{		require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
  $clId=$_GET["clID"];
	$gpId=$_GET["gpna"];
	$examId=$_GET["exId"];
	$Session=$_GET["session"];
	$studentRoll=$_GET["stdRoll"];
	

	  $sql="SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`add_class`.`class_name`,`add_group`.`group_name` FROM `result`  JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId' AND `result`.`session`='$Session' AND `result`.`std_roll`='$studentRoll'";
	//print $sql;
	$result=$db->select_query($sql);
	if($result){
			$fetch_r=$result->fetch_array();
	}
	
	
	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}	


$col=0;
	$selectSubjectPartNo="SELECT * FROM `add_subject_part_info` WHERE `class_id`='$clId' AND `exam_type`='$examId' AND `group_id`='$gpId'";
	//print $selectSubjectPartNo;
	$querySelectSubjectPartNo=$db->select_query($selectSubjectPartNo);
	if($querySelectSubjectPartNo)
	{
		
		$col=1;
	}


?>
<meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
<style type="text/css">
<!--
.style3 {font-size: 18px}
.style6 {font-size: 24px; font-weight: bold; }
.style17 {font-size: 24px; font-weight: bold; }
.style21 {font-size: 22px}

-->
</style>


<style media="print">
.dont-print{display:none;}
</style>
    
<body bgcolor="#f4f4f4">
<table  width="1100"  height="1500" border="0"     align="center" cellpadding="0"  cellspacing="0" bgcolor="#fff">

  <tr>
    <td valign="top">
	
	<table height="1330" width="1100"cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="all_image/school_mark_sheetSDMS2015.jpg" height="1530" width="1100"/>
            <table width="900" height="1290" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" 
            style="margin-top:-1300px; background:none; position:relative;">
              <tr>
                <td width="888" height="92" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                  
					 <tr>
                      <td width="100%" colspan="3" align="center"><span><strong style="font-size:22px;"><?php
					  	$examName = "SELECT `exam_type` FROM `exam_type_info` WHERE `exam_id`='".$fetch_r["examId"]."'";
						$resultName = $db->select_query($examName);
							if($resultName->num_rows > 0){
								$fetchName = $resultName->fetch_array();
								
							}
							$selectSession="SELECT `session2` FROM `student_acadamic_information` WHERE `id`='".$fetch_r["STD_ID"]."'";
							$ressss = $db->select_query($selectSession);
							if($ressss->num_rows > 0){
								$fetchsss = $ressss->fetch_array();
								
							}
							echo $fetchName[0].'-'.$fetchsss[0]
					  ?></strong> </span></td>
                   
                    </tr>
					  <tr>
                      <td width="10%">Student ID- </td>
                      <td width="18%" align="left"><span style="font-size:18px; letter-spacing:2px;font-weight: bold;"><?php if(isset($fetch_r)){ echo $fetch_r["STD_ID"];} else { echo "";}?></span></td>
                      <td width="73%" valign="top"></td>
                    </tr>
                </table></td>
              </tr>
             
            
             
                <td height="127" align="center"><table width="100%" height="323" border="0" cellpadding="0" cellspacing="0">
				<tr>
                      <td><span class="style21">Class Name</span></td>
                      <td><span class="style21">:</span></td>
                      <td height="39"><span class="style21"><?php if(isset($fetch_r)){ echo $fetch_r["class_name"];} else{echo "";}?></span></td>
                    </tr>
                    <tr>
                      <td width="20%"><span class="style21">Group  </span></td>
                      <td width="2%"><span class="style21">:</span></td>
                      <td width="50%" height="40"><span class="style21">
                       <?php if(isset($fetch_r)){ echo $fetch_r["group_name"];}else{echo "";}?>
                        
                      </span></td>
                      <td width="28%" rowspan="8" align="right" valign="middle">
					  
					  
					  <table width="90%" height="276" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
                          <tr>
                            <td width="48%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;">Class Interval </td>
                            <td width="27%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;">Grade</td>
                            <td width="25%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;  border-right:1px solid #000000;">Point</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">80 - 100 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A+</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">5.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">70 - 79</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">4.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">60 - 69 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A-</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">3.50</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"> 50 - 59 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">B</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">3.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">40 - 49</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">C</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">2.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">33 - 39</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">D</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">1.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">00-32</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">F</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">0.00</td>
                          </tr>
                         
                      </table></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Student's Name</span></td>
                      <td><span class="style21">:</span></td>
                      <td height="39"><span class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["student_name"];}else {echo "";}?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Father's Name </span></td>
                      <td><span class="style21">:</span></td>
                      <td height="37"><span class="style21">  <?php if(isset($fetch_r)){ echo $fetch_r["father_name"];} else {echo "";}?> </span></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Mother's Name </span></td>
                      <td><span class="style21">:</span></td>
                      <td height="42"><span class="style21">  <?php if(isset($fetch_r)){ echo $fetch_r["mother_name"];}else {echo "";}?> </span></td>
                    </tr>
                  
					
					
                    <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Session</td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["session"];} else {echo "";}?></td>
                            <td width="13%" class="style21"> </td>
                            <td width="2%" class="style21"></td>
                            <td width="32%" class="style21"></td>
                          </tr>
                      </table></td>
                    </tr>
					
					
					  <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Roll No. </td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["std_roll"];}else {echo "";}?></td>
                            <td width="20%" class="style21">&nbsp;</td>
                            <td width="2%" class="style21">&nbsp;</td>
                            <td width="25%" class="style21">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
					
					     <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Result </td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> 
							
							<?php if(isset($fetch_r)){ 
														if($fetch_r["CGPA"] == "0.00" ){?>
														<span><strong >FAILED</strong></span>
														<?php } else {?>
														<span><strong >PASSED</strong></span>
														<?php }
													}?>
													
							
							</td>
                            <td width="20%" class="style21">&nbsp;</td>
                            <td width="2%" class="style21">&nbsp;</td>
                            <td width="25%" class="style21">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
					
                    
                </table></td>
              </tr>

<tr>
    <td></td>

</tr>
             
              <tr>
                <td  align="center" valign="top" >

                    <table style=" width: 100%;   font-size: 18px; margin-top: 50px; float: left;  "  cellpadding="0" cellspacing="0">
                      
                      <tr>
                        <td style="border-top:1px #000 solid; border-left:1px #000 solid;">

               

                  <table cellpadding="0" cellspacing="0" width="100%">
                    
                        <tr>
                        
                            <td style="border-right: 1px #000  solid; border-bottom: 1px #000  solid; text-align: center; width: 50px; height: 40px;">Sub.  Code</td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;">Subject Name</td>
                              <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; width: 85px;">Full Marks</td>
                               <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; width: 47px;">Cre.</td>
                                <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;width: 47px;">MCQ</td>
                                 <td style=" width: 47px; border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;">Prac.</td>
                             
                             <td style=" width: 47px;border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;">Total</td>
                              <td style=" width: 47px;border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;">Grade</td>
                              
                              <?php
                              	if($col==1)
                              	{?>
                              			  <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; width: 47px;">Joint GP</td>
                              	<?php }
                              ?>
                            
                              
                               <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; width: 47px;">GP</td>
                               

                                 
                        </tr>

<!--  ............................Subject wise Marks........................ -->

    

<?php
$height=40;
$subName++;
$toalSubjectMarks=0;
$toalObtainMark=0;

  $selectSubjectType="SELECT `add_subject_info`.`select_subject_type`  FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' GROUP BY `add_subject_info`.`select_subject_type` ORDER BY `add_subject_info`.`select_subject_type` ASC ";

  $querySubjectType=$db->select_query($selectSubjectType);
    if($querySubjectType){
        while($fetchSubjecttype=$querySubjectType->fetch_array())
        {

      

$selectSubject="SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name` FROM `marksheet` INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' GROUP BY `add_subject_info`.`subject_code`  ORDER BY `add_subject_info`.`serial` ASC ";



  $querysubject=$db->select_query($selectSubject);
    if($querysubject){
        while($fetchsubject=$querysubject->fetch_array())
        {

$joint=0;
$height=$height+30;

            $selectSubPart="SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`add_subject_part_info`.`subject_part_name`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`part_id` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info`ON `add_subject_part_info`.`subject_name`=`marksheet`.`SubjectId`
WHERE `add_subject_part_info`.`class_id`='$clId' AND `add_subject_part_info`.`group_id`='$gpId' AND `add_subject_part_info`.`exam_type`='$examId'
AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' 
AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' GROUP BY `add_subject_part_info`.`part_id` ORDER BY `add_subject_part_info`.`sl` ASC ";

$querySubjectPart=$db->select_query($selectSubPart);
if($querySubjectPart)
{

    while($fetchSubjectPart=$querySubjectPart->fetch_array())
    {
$joint++;


    

// ...............................................Select Part Marks....................................
  
     
      $selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,
`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`subject_part_name`,`subject_information`.`ContAss`,
`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`
INNER JOIN  `subject_information` ON `subject_information`.`subPartId`=`marksheet`.`SubjectPartID`
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' 
AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' AND  `marksheet`.`SubjectPartID`='$fetchSubjectPart[part_id]' AND `subject_information`.`examID`='$examId'";

$querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
if($querysubjectPartmarks)
{

    if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
    {

$toalSubjectMarks=$toalSubjectMarks+$fetchSubjectPartmarks[13];
$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];

      ?>



             <tr>
                        
                            <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; height: 30px;"><?php echo $fetchSubjectPartmarks[7]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: left;">&nbsp; <?php echo $fetchSubjectPartmarks[8]?></td>
                              <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[13]?></td>
                            <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[1]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[2]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[3]?></td>
                             
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[4]?></td>
                              <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[5]?></td>

                              	<?php
                              	if($joint==1)
                              	{?>

                              		 <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;" rowspan="2">
                              		 <?php
                              		   

$SelectJointGP="SELECT * FROM `gnerate_marks` WHERE `studentID`='$fetch_r[STD_ID]' AND `ClassID`='$clId' AND `GroupID`='$gpId' AND `ExamID`='$examId' AND `session`='$Session' AND `subjectID`='$fetchsubject[SubjectId]'";
if($selectQueryJointMarks=$db->select_query($SelectJointGP))
{
	$fetchJointMarks=$selectQueryJointMarks->fetch_array();
	print $fetchJointMarks['letterGrade'];
}

                              		 ?>


                              		 </td>
                              		    <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"  rowspan="2"><?php  	print $fetchJointMarks['gradePoint']; ?></td>
                              	<?php }
                              	?>
                               


                            
                                
                                 
                        </tr>

  <?php

    }

}
////////////////////end Subject Part marks///////////////////////////////////////
}

////////////////////end Subject Part ///////////////////////////////////////
}
else
{

  $selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`subject_information`.`ContAss`,`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId` 
INNER JOIN `subject_information` ON `subject_information`.`examID`=`marksheet`.`ExamId` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` 
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$examId' AND `marksheet`.`Session`='$Session' 
AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' AND `marksheet`.`SubjectId`= '$fetchsubject[SubjectId]' AND `subject_information`.`subjectId`='$fetchsubject[SubjectId]' AND `subject_information`.`examID`='$examId'";
      


      $querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
      if($querysubjectPartmarks)
      {

          if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
          {

$toalSubjectMarks=$toalSubjectMarks+$fetchSubjectPartmarks[13];
$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];
            ?>

  <tr>
                        
                            <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center; height: 30px;"><?php echo $fetchSubjectPartmarks[7]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: left;">&nbsp; <?php echo $fetchSubjectPartmarks[8]?></td>
                              <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[13]?></td>
                            <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[1]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[2]?></td>
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[3]?></td>
                             
                             <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[4]?></td>
                              <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[5]?></td>

                                <?php
                              	if($col==1)
                              	{?>
                              			   <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"></td>
                              	<?php }
                              ?>

                            
                               <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><?php echo $fetchSubjectPartmarks[6]?></td>
                              
                                 
                        </tr>
       <?php   }

      }
///////////////////////////// End Subject Marks//////////////////////////

}

}
}
//////////////////// Subject  ///////////////////////////////////////
}
}
//////////////////// Subject Type  ///////////////////////////////////////
?>




                   


<!--  ............................End Subject wise Marks........................ -->
        

<tr>
    <td colspan="2" style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: right; height: 30px;">Total Marks &nbsp; </td>
    <td style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><b><?php
echo $toalSubjectMarks;

    ?></b></td>
    <td colspan="3" style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"> Obtained Marks</td>
    <td colspan="4" style="border-bottom: 1px #000  solid;border-right: 1px #000  solid; text-align: center;"><b>
      
<?php

echo $toalObtainMark;
?>

    </b></td>
  </tr>


                  </table>
</td>

<td style="border-right:1px #000 solid; border-top:1px #000 solid; width: 100px; text-align: center; border-bottom:1px #000 solid; " valign="top">
 
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style=" height: 100%;">
      <tr>
        <td style="border-bottom:1px #000 solid; height: 40px;" align="center" >GPA</td>
      </tr>
      <tr>
        <td align="center" valign="button" height="<?php print $height;?>"><b style="font-size: 24px;">


<?php

              $selectResult="SELECT * FROM `result` WHERE `STD_ID`='$fetch_r[STD_ID]' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$examId'";
              $querySelectResult=$db->select_query($selectResult);
              if($querySelectResult)
              {

                  if($fetchResult=$querySelectResult->fetch_array())
                  {
                      
                      $gpaWithOptional=$fetchResult[6];
                     
                  }
                  else
                  {
                      $gpaWithOptional="Null";
                     
                  }

              }

    echo $gpaWithOptional;

?>


       </b></td>
      </tr>

    </table>

</td>
</tr>


</table>







 

                </td>
              </tr>
              <tr>
                <td height="231" align="center" valign="bottom">
				<table width="100%" height="33%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:-180px;">
                    <tr>
                      <td width="55%" height="57" valign="top"><strong style="font-size: 20px;"><p> --------------------</p>Compared by</span></strong></td>
                      <td width="20%" align="center" valign="top">
                       </td>
                      
                      <td width="24%" align="center" valign="top"><strong style="font-size: 20px;"><p> -------------------------</p>
                        Principal </strong></td>
                    </tr>
                </table>
				</td>
              </tr>
            </table>
</td>
      </tr>
    </table>
	

</body>
</html>

<center class="dont-print">

<input type="button" value="Print" onClick="window.print()"  style="margin-top:100px; width:150px; height:40px; text-align:center;">
</center>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

