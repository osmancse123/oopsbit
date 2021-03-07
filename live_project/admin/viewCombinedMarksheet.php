
   <?php
  error_reporting(1);
 
  require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
  date_default_timezone_set("Asia/Dhaka");
  $db = new database();
  
  $clId=$_GET["clID"];
  $gpId=$_GET["gpna"];
  $examId=$_GET["exId"];
  $Session=$_GET["session"];
  $studentRoll=$_GET["stdRoll"];
  

    $sql="SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`add_class`.`class_name`,`add_group`.`group_name`  FROM `result`  JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`session`='$Session' AND `result`.`std_roll`='$studentRoll'";
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


$sec="SELECT `running_student_info`.*,`add_section`.`section_name` FROM `running_student_info` 
INNER JOIN `add_section` ON `add_section`.`id`=`running_student_info`.`section_id` 
WHERE `student_id`='$fetch_r[STD_ID]'";

$checkSection=$db->select_query($sec);
$fetchSec=$checkSection->fetch_array();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
     <title><?php print $fetch_school_information['title'] ?></title>
    <link rel="shortcut icon" href="../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />

</head>
<body>
<div style="height:765px; width:1095px; background-image:url(all_image/2school_mark_sheetSDMS2015.jpg); background-repeat: no-repeat; margin:15px;">

  <div style="height:720px; width:1000px;  margin-left:45px; padding-top: 1px;">
    

    <div style=" margin-top:50px; margin-left: 180px;">
      <div style="float: left;clear: right;"> <img src="all_image/hompageCodeSDMS2015.jpg" style="height: 90px; width: 110px;">
      </div>
       <div style="float: left; clear: right; "> 
            <h1 style="font-size: 26px; font-family: sans-serif; padding-left:30px; "> <?php print $fetch_school_information['institute_name']?></h1>
            <p style="font-size: 20px; font-weight: bold; padding-left: 100px; margin-top: -10px; "> Academic Transcript</p>
       </div>
    </div>



  <table  >
    <tr>
        <td>
              <table style="width: 800px; font-size: 14px;">
                  <tr>
                        <td style="border-top:1px #000 solid; border-left:1px #000 solid ;  height: 20px;">&nbsp;Student ID &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetch_r)){ echo $fetch_r["STD_ID"];} else { echo "";}?> &nbsp;</td>

                        <td style="border-top:1px #000 solid;">&nbsp;Class &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetch_r)){ echo $fetch_r["class_name"];} else{echo "";}?> &nbsp;</td>


                        <td style="border-top:1px #000 solid;">&nbsp;Group &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"> <?php if(isset($fetch_r)){ echo $fetch_r["group_name"];}else{echo "";}?> &nbsp;</td>


                       
                        <td style="border-top:1px #000 solid;">&nbsp;Section &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetchSec)){ echo $fetchSec["section_name"];}else{echo "";}?> &nbsp;</td>

                       
                     


                  </tr>

                  <tr>
                        <td style="border-top:1px #000 solid; border-left:1px #000 solid ; height: 20px;">&nbsp;Student's Name &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetch_r)){ echo $fetch_r["student_name"];}else {echo "";}?> &nbsp;</td>

                        <td style="border-top:1px #000 solid;">&nbsp;Father's Name &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"> <?php if(isset($fetch_r)){ echo $fetch_r["father_name"];} else {echo "";}?> &nbsp;</td>


                        <td style="border-top:1px #000 solid;">&nbsp;Mother's Name &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;" colspan="4"><?php if(isset($fetch_r)){ echo $fetch_r["mother_name"];}else {echo "";}?>  &nbsp;</td>


                     

                       
                      


                  </tr>
                  <tr>
                        <td style="border-top:1px #000 solid; border-left:1px #000 solid ;height: 20px; border-bottom:1px #000 solid ;">&nbsp;Session &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid ;"><?php if(isset($fetch_r)){ echo $fetch_r["session"];} else {echo "";}?> &nbsp;</td>

                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">&nbsp;Roll No.  &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid ;"><?php if(isset($fetch_r)){ echo $fetch_r["std_roll"];}else {echo "";}?> &nbsp;</td>


                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">&nbsp;Result &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid ;" colspan="4"><?php if(isset($fetch_r)){ 
                            if($fetch_r["CGPA"] == "0.00" ){?>
                            <span><strong >FAILED</strong></span>
                            <?php } else {?>
                            <span><strong >PASSED</strong></span>
                            <?php }
                          }?> &nbsp;</td>


                      

                      


                  </tr>
              </table>

        </td>
    </tr>
    <tr>
        <td></td>
    </tr>


  </table>

  <table width="180" height="150" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" align="right" style="font-size: 12px; font-weight: bold; margin-top: -180px;margin-right: 7px;">
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
                         
                      </table>




<table>
  




        <?php
                $selectExamType="SELECT `marksheet`.*,`exam_type_info`.`exam_type` FROM  `marksheet` 
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `ClassId`='$clId' AND `STudentID`='$fetch_r[STD_ID]' AND `Session`='$Session'  GROUP BY `ExamId` ORDER BY `exam_type_info`.`exam_id` ASC";
$selectExam=$db->select_query($selectExamType);
while($fetchExamType=$selectExam->fetch_array())
{


              ?>
                <tr>
                    <td align="center" style="border-bottom: 1px #000 solid;"><b><?php print $fetchExamType['exam_type']?></b></td>
                </tr>


<tr>
  <td>



                      <table style="width: 100%" style="font-size: 12px;">
                        <tr>
<?php

$toalSubjectMarks=0;
$toalObtainMark=0;
$selectSubjectType="SELECT `add_subject_info`.`select_subject_type`  FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$fetchExamType[4]' AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' GROUP BY `add_subject_info`.`select_subject_type` ORDER BY `add_subject_info`.`select_subject_type` ASC ";

  $querySubjectType=$db->select_query($selectSubjectType);
    if($querySubjectType){
        while($fetchSubjecttype=$querySubjectType->fetch_array())
        {


            $selectSubject="SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name` FROM `marksheet` INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$fetchExamType[4]' AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' GROUP BY `add_subject_info`.`subject_code`  ORDER BY `add_subject_info`.`serial` ASC ";


          $querysubject=$db->select_query($selectSubject);
            if($querysubject){
                while($fetchsubject=$querysubject->fetch_array())
                {

                   $selectSubPart="SELECT `marksheet`.`SubjectId`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`add_subject_part_info`.`subject_part_name`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`part_id` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info`ON `add_subject_part_info`.`subject_name`=`marksheet`.`SubjectId`
WHERE `add_subject_part_info`.`class_id`='$clId' AND `add_subject_part_info`.`group_id`='$gpId' AND `add_subject_part_info`.`exam_type`='$fetchExamType[4]'
AND `marksheet`.`Session`='$Session' AND `marksheet`.`STudentID`='$fetch_r[STD_ID]'  AND `add_subject_info`.`select_subject_type`='$fetchSubjecttype[select_subject_type]' 
AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' GROUP BY `add_subject_part_info`.`part_id` ORDER BY `add_subject_part_info`.`sl` ASC ";

$querySubjectPart=$db->select_query($selectSubPart);
if($querySubjectPart)
{

    while($fetchSubjectPart=$querySubjectPart->fetch_array())
    {

  
      $selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,
`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_part_info`.`subject_part_code`,`add_subject_part_info`.`subject_part_name`,`subject_information`.`ContAss`,
`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet`
INNER JOIN  `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
INNER JOIN  `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`
INNER JOIN  `subject_information` ON `subject_information`.`subPartId`=`marksheet`.`SubjectPartID`
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$fetchExamType[4]' AND `marksheet`.`Session`='$Session' 
AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' AND `add_subject_part_info`.`subject_name`='$fetchsubject[SubjectId]' AND  `marksheet`.`SubjectPartID`='$fetchSubjectPart[part_id]' AND `subject_information`.`examID`='$fetchExamType[4]'";


$querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
if($querysubjectPartmarks)
{

    if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
    {
        $toalSubjectMarks=$toalSubjectMarks+$fetchSubjectPartmarks[13];
$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];
    }

  }

      ?>

       <td style='font-size: 12px;border-top: 1px #000 solid;border-bottom: 1px #000 solid;border-right: 1px #000 solid;'>
<table width="100%" cellpadding="0" cellspacing="0" height="100%" >
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;"><?php print $fetchSubjectPart[3]."(".$fetchSubjectPart[4].")"; ?> </td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;" align="center">  Marks: <?php print $fetchSubjectPartmarks['total'];?></td>
  </tr>
  <tr>
    <td style="border-right: 1px #000 solid;" align="center"><?php print $fetchSubjectPartmarks['obtainMark'];?></td>
    <td>&nbsp;<?php print $fetchSubjectPartmarks['GradePoint'];?></td>
  </tr>

</table>
        </td>

   <?php
    }
  }
  else
  {

    $selectSubjectPartMarks="SELECT `marksheet`.`Count_Ass`,`marksheet`.`Creative`,`marksheet`.`Mcq`,`marksheet`.`Practical`,`marksheet`.`obtainMark`,`marksheet`.`LetterGrade`,`marksheet`.`GradePoint`,`add_subject_info`.`subject_code`,`add_subject_info`.`subject_name`,`subject_information`.`ContAss`,`subject_information`.`Creative`,`subject_information`.`MCQ`,`subject_information`.`practical`,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId` 
INNER JOIN `subject_information` ON `subject_information`.`examID`=`marksheet`.`ExamId` 
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId` 
WHERE `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' AND `marksheet`.`ExamId`='$fetchExamType[4]' AND `marksheet`.`Session`='$Session' 
AND `marksheet`.`STudentID`='$fetch_r[STD_ID]' AND `marksheet`.`SubjectId`= '$fetchsubject[SubjectId]' AND `subject_information`.`subjectId`='$fetchsubject[SubjectId]' AND `subject_information`.`examID`='$fetchExamType[4]'
 ";
      
 //print $selectSubjectPartMarks."<br>jjjjjjjj";


      $querysubjectPartmarks=$db->select_query($selectSubjectPartMarks);
      if($querysubjectPartmarks)
      {

          if($fetchSubjectPartmarks=$querysubjectPartmarks->fetch_array())
          {

$toalSubjectMarks=$toalSubjectMarks+$fetchSubjectPartmarks[13];
$toalObtainMark=$toalObtainMark+$fetchSubjectPartmarks[4];
            }
      }
?>
            <td style='font-size: 12px;border-bottom: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid;'>
              <table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td>

<table width="100%" cellpadding="0" cellspacing="0" height="100%" >
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;"><?php print $fetchsubject[2]." (".$fetchsubject[1].")"; ?> </td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;" align="center">  Marks: <?php print $fetchSubjectPartmarks['total'];?></td>
  </tr>
  <tr>
    <td style="border-right: 1px #000 solid;" align="center"><?php print $fetchSubjectPartmarks['obtainMark'];?></td>
    <td>&nbsp;<?php print $fetchSubjectPartmarks['GradePoint'];?></td>
  </tr>

</table>


       </td>
  </tr>
 

</table>
</td>

            

    



<?php  }




        }

        }


      
  }
}
?>
                       
                      <td style='font-size: 12px;border-bottom: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid;'>
              <table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td>

<table width="100%" cellpadding="0" cellspacing="0" height="100%" >
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;">GPA<br>Obtained Marks </td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom: 1px #000 solid;" align="center"> <?php

              $selectResult="SELECT * FROM `result` WHERE `STD_ID`='$fetch_r[STD_ID]' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$fetchExamType[4]'";
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

?></td>
  </tr>
  <tr>
    <td style="border-right: 1px #000 solid;" align="center"><?php print $toalObtainMark." / ".
$toalSubjectMarks?></td>
   
  </tr>

</table>


       </td>
  </tr>
 

</table>
</td>
                       
                        </tr>

             </table>

<!-- ///////////Exam Type///////// -->
</td>
</tr>


  <?php
}
?>
</table>


</div>
  </div>


</body>
</html>

  