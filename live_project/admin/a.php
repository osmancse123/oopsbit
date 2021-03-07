
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

    $final="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' order by sl desc limit 0,1 ";
$queryfinal=$db->select_query($final);
$fetchFinalExamType=$queryfinal->fetch_array();


  
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

<style>
  *{padding: 0px; margin: 0px;}
  td{border-right:1px #000 solid; border-bottom:1px #000 solid;}

</style>


</head>

<body>
<div style="height:900px; width:1340px; background-image:url(all_image/3school_mark_sheetSDMS2015.jpg); background-repeat: no-repeat; margin:15px;">

  <div style="height:850px; width:1220px;  margin-left:55px; padding-top: 1px; ">
    

    <div style=" margin-top:50px; margin-left: 180px; ">
      <div style="float: left;clear: right;"> 
        <img src="all_image/hompageCodeSDMS2015.jpg" style="height: 70px; width: 80px;">
      </div>
       <div style="float: left; clear: right; "> 
            <h1 style="font-size: 26px; font-family: sans-serif; padding-left:30px; "> CHHAGALNAIYA ACADEMY</h1>
            <p style="font-size: 20px; font-weight: bold; padding-left: 100px; margin-top: -5px; "> Academic Transcript</p>
       </div>
    </div>



              <table style="width: 1000px; font-size: 16px; margin-left:5px;" cellpadding="0" cellspacing="0">
                  <tr>
                        <td style="border-top:1px #000 solid; border-left:1px #000 solid ;  height: 20px;">&nbsp;Student ID &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetch_r)){ echo $fetch_r["STD_ID"];} else { echo "";}?> &nbsp;</td>

                        <td style="border-top:1px #000 solid;">&nbsp;Class &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;"><?php if(isset($fetch_r)){ echo $fetch_r["class_name"];} else{echo "";}?> &nbsp;</td>


                        <td style="border-top:1px #000 solid;">&nbsp;Group &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;"> <?php if(isset($fetch_r)){ echo $fetch_r["group_name"];}else{echo "";}?> &nbsp;</td>


                       
                        <td style="border-top:1px #000 solid;">&nbsp;Section &nbsp;</td>
                        <td style="border-top:1px #000 solid;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;"><?php if(isset($fetchSec)){ echo $fetchSec["section_name"];}else{echo "";}?> &nbsp;</td>

                       <td style=" border-top:1px #000 solid;">&nbsp;Session &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-bottom:1px #000 solid ;">: &nbsp;</td>
                        <td style="border-top:1px #000 solid;border-right:1px #000 solid;border-bottom:1px #000 solid ;"><?php if(isset($fetch_r)){ echo $fetch_r["session"];} else {echo "";}?> &nbsp;</td>
                     


                  </tr>

                  <tr>
                      <td style="border-left:1px #000 solid">&nbsp;Roll No.  &nbsp;</td>
                        <td >: &nbsp;</td>
                        <td  ><?php if(isset($fetch_r)){ echo $fetch_r["std_roll"];}else {echo "";}?> &nbsp;</td>
                        <td >&nbsp;Student's Name &nbsp;</td>
                        <td >: &nbsp;</td>
                        <td><?php if(isset($fetch_r)){ echo $fetch_r["student_name"];}else {echo "";}?> &nbsp;</td>

                        <td >&nbsp;Father's Name &nbsp;</td>
                        <td >: &nbsp;</td>
                        <td > <?php if(isset($fetch_r)){ echo $fetch_r["father_name"];} else {echo "";}?> &nbsp;</td>


                        <td >&nbsp;Mother's Name &nbsp;</td>
                        <td >: &nbsp;</td>
                        <td  colspan="4"><?php if(isset($fetch_r)){ echo $fetch_r["mother_name"];}else {echo "";}?>  &nbsp;</td>

                  </tr>


                 
              </table>


  <table width="180" height="150" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" align="right" style="font-size: 12px; font-weight: bold; margin-top: -110px;margin-right: 7px;">
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

<br>





<table width="1200" height="221" border="0" cellpadding="0" cellspacing="0" style="margin-left:5px;margin-top:5px;">


  <tr>
    <td width="23" rowspan="3" align="center" style="border-top:1px #000 solid;border-left:1px #000 solid; ">SL. </td>

    <td width="208" rowspan="3" align="center" style="border-top:1px #000 solid; ">Subject Name</td>

    <td width="41" rowspan="3" align="center" style="border-top:1px #000 solid; ">Sub. Code </td>

    <td height="21" colspan="10" align="center" style="border-top:1px #000 solid; "><strong>Exam Type </strong></td>

   <td colspan="6" rowspan="2"   align="center" style="border-top:1px #000 solid; "><strong>Combined Result</strong></td>

  </tr>
  


  <tr>
    <td height="20" colspan="5" align="center"><strong>3rd Tutorial Exam</strong></td>

    <td colspan="5" align="center"><strong>Annual Exam.</strong></td>
  </tr>


  <tr>
    <td width="46" height="39" align="center">Full Marks </td>
    <td width="52" align="center">Obtain Marks </td>
    <td width="39" align="center">Grade</td>
    <td width="29" align="center"> GP</td>
    <td width="34" align="center">GPA</td>


<!--     <td width="45" align="center">Full Marks </td>
    <td width="46" align="center">Obtain Marks</td>
    <td width="43" align="center"> Grade </td>
    <td width="37" align="center">GP</td>
    <td width="33" align="center">GPA</td>
 -->

    <td width="45" align="center">Full Marks </td>
    <td width="52" align="center">

          <table style="padding: 0px; width: 100px; height: 100%" cellspacing="0" cellspacing="0"> 
           <tr>
              <td colspan="4" style="border-right: 0px; text-align: center;">Obtain Marks</td>
          </tr>

          <tr>
              <td style="border-bottom: 0px; width: 30px; ">Cre.</td>
              <td style="border-bottom: 0px;width: 30px;  ">MCQ</td>
              <td style="border-bottom: 0px; width: 30px; ">Prac.</td>
              <td style="border-bottom: 0px; border-right: 0px;width: 30px; ">Total</td>
          </tr>
         
          </table>

    </td>
    <td width="51" align="center">Grade</td>
    <td width="30" align="center">GP</td>
    <td width="36" align="center">GPA</td>


  <td width="69" align="center"> 3rd Tutorial Exam (100%)  </td>
  <td width="81" align="center"><p>Half Yearly Exam  70% </p>    </td>
  <td width="46" align="center">Total Marks </td>
  <td width="46" align="center">Grade</td>
  <td width="31" align="center">GP</td>
  <td width="37" align="center">GPA</td>
  </tr>
  
  <?php
    $selectExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ";
    $queryExamType=$db->select_query($selectExamType);
    $fetchExamType=$queryExamType->fetch_array();
   
    $helfYearly=0;


  $selectSub="SELECT `add_subject_info`.`id`,`add_subject_info`.`subject_name`,`add_subject_info`.`select_subject_type`,`add_subject_info`.`subject_code` FROM `marksheet`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
 WHERE  `StudentRoll`='$studentRoll' AND `ClassId`='$clId' AND `GroupID`='$gpId' AND `Session`='$Session' GROUP BY `SubjectId` ORDER BY `add_subject_info`.`serial` ASC";




 $selectSubject=$db->select_query($selectSub);

 $rowcount=mysqli_num_rows($selectSubject);

 if($selectSubject)
 {

  $sl=0;
  $total_point=0;
  $total_subject=0;
  
  while($fetchsubject=$selectSubject->fetch_array())
  {
      $totalMarksTotrial=0;
      $selectSubJectPart="SELECT * FROM `add_subject_part_info` WHERE `subject_name`='$fetchsubject[0]' AND `exam_type`='$fetchExamType[0]'  AND `class_id`='$clId'";

      $low=0;
      $totalSubjectpartObtainMarks=0; 
      $totalsubpartmarks=0;

        $querySelectPart=$db->select_query($selectSubJectPart);
        if($querySelectPart)
        {

         while($fetch_subPartName=$querySelectPart->fetch_array())
         {
            $sl++;
            $totalMarksTotrial=0;

  ?>
  
    <tr>

    <td align="center" style="border-left:1px #000 solid; height: 30px;" ><?php print $sl; ?> </td>
    <td align="left" > &nbsp;<?php print $fetch_subPartName['subject_part_name']?></td>
    <td align="center"><?php print $fetch_subPartName['subject_part_code']?></td>



    <?php 
        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 3,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

    $selectMarks="SELECT `marksheet`.*,`add_subject_part_info`.`sl`,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`INNER JOIN `subject_information` ON `subject_information`.`subPartId`=`marksheet`.`SubjectPartID`
WHERE `StudentRoll`='$studentRoll' 
AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' 
AND `marksheet`.`ExamId`='$fetchExamTypeInfo[0]' AND `marksheet`.`SubjectId`='$fetchsubject[0]' AND `marksheet`.`Session`='$Session' ORDER BY `add_subject_part_info`.`sl` ASC LIMIT $low,1";


          

          $queryMarks=$db->select_query($selectMarks);
          if($queryMarks)
          {
            $fetchMarks=$queryMarks->fetch_array();
              $totalMarksTotrial=$totalMarksTotrial+$fetchMarks['obtainMark'];
          }
          else
          {
            $fetchMarks['total']='';
            $fetchMarks['obtainMark']='';
            $fetchMarks['LetterGrade']='';
            $fetchMarks['GradePoint']='';
          }


     $selectGPA="SELECT * FROM `result` WHERE `std_roll`='$studentRoll' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$fetchExamTypeInfo[0]'";


      $queryCGPA=$db->select_query($selectGPA);
      if($queryCGPA)
      {
          $fetchCGPA=$queryCGPA->fetch_array();
      }
      else
      {
        $fetchCGPA['CGPA']='0.0';
      }

?>

    <td width="46" align="center"><?php print $fetchMarks['total']?></td>
    <td width="52" align="center"><?php print $fetchMarks['obtainMark']?></td>
    <td width="39" align="center"><?php print $fetchMarks['LetterGrade']?></td>
    <td width="29" align="center"> <?php print $fetchMarks['GradePoint']?></td>

    <?php
      if($sl==1)
      {?>
         <td width="34" align="center" rowspan="<?php print $rowcount+2; ?>"><?php print  $fetchCGPA['CGPA']?></td>
      <?php 
        }
      ?>
   



  <?php 

        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 4,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

      //  print "...........".$fetchExamTypeInfo['exam_type']."<br>>br>";

       
    $selectMarks="SELECT `marksheet`.*,`add_subject_part_info`.`sl`,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`marksheet`.`SubjectPartID`INNER JOIN `subject_information` ON `subject_information`.`subPartId`=`marksheet`.`SubjectPartID`
WHERE `StudentRoll`='$studentRoll' 
AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' 
AND `marksheet`.`ExamId`='$fetchExamTypeInfo[0]' AND `marksheet`.`SubjectId`='$fetchsubject[0]' AND `marksheet`.`Session`='$Session' ORDER BY `add_subject_part_info`.`sl` ASC LIMIT $low,1";

          //print $selectMarks."<br><br><br>";

          $queryMarks=$db->select_query($selectMarks);
          if($queryMarks)
          {
            $fetchMarks=$queryMarks->fetch_array();
          }
          else
          {
            $fetchMarks['total']='';
            $fetchMarks['obtainMark']='';
            $fetchMarks['LetterGrade']='';
            $fetchMarks['GradePoint']='';
          }

          $selectGPA="SELECT * FROM `result` WHERE `std_roll`='$studentRoll' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$fetchExamTypeInfo[0]'";

          $queryCGPA=$db->select_query($selectGPA);
          if($queryCGPA)
          {
              $fetchCGPA=$queryCGPA->fetch_array();
          }
          else
          {
             $fetchCGPA['CGPA']='0.0';
          }


    ?>

    <td width="46" align="center"><?php print $fetchMarks['total']?></td>
    <td width="52" align="center">
      
     <table style="padding: 0px;  height: 100%" cellspacing="0" cellspacing="0"> 
   

    <tr>
        <td style="border-bottom: 0px; text-align: center; width: 25px; ">&nbsp;<?php print $fetchMarks[9]?></td>
        <td style="border-bottom: 0px;text-align: center;width: 38px;  ">&nbsp;<?php print $fetchMarks[10]?></td>
        <td style="border-bottom: 0px;text-align: center; width: 30px; ">&nbsp;<?php print $fetchMarks[11]?></td>
        <td style="border-bottom: 0px; border-right: 0px;width: 30px; " align="center">&nbsp;<?php print $fetchMarks['obtainMark']?></td>
    </tr>
   
    </table>



    </td>
    <td width="39" align="center"><?php print $fetchMarks['LetterGrade']?></td>
    <td width="29" align="center"> <?php print $fetchMarks['GradePoint']?></td>
        <?php
      if($sl==1)
      {?>
         <td width="34" align="center" rowspan="<?php print $rowcount+2; ?>"><?php print  $fetchCGPA['CGPA']?></td>
      <?php }
    ?>

  <td width="69" align="center"><?php  $totrialAvg=$totalMarksTotrial;
    print $totrialAvg; ?></td>
  <td width="81" align="center">  
  <?php  


  if($fetchMarks['total']==100)
    {

       $helfYearly=$fetchMarks['obtainMark']* 70/100; 
       print $helfYearly;

    }
    else if($fetchMarks['total']==50)
    {
        $helfYearly=$fetchMarks['obtainMark']* 60/100; 
       print $helfYearly;
    }

    ?> </td>
  <td width="46" align="center">
    
    <?php   $totalComMarks= $helfYearly+$totrialAvg;
   $tm[0]="";
   $tm[1]="";
   $totalMarks=0;
  $tm=explode('.',$totalComMarks);
  if($tm!='')
  {


  if($tm[1]>4)
  {
       $totalMarks=$tm[0]+1;
  }
  else
  {
    $totalMarks=$tm[0];
  }

}

print $totalMarks;
 

?>
  </td>
  <td width="46" align="center">
    <?php

    //print $fetchCGPA['CGPA'];


 if($totalMarks>=$fetchMarks['total']*80/100 &&  $totalMarks<=$fetchMarks['total']*100/100)
  {
        $grade="A+";
        $CGPA="5.00";
  }
  else if($totalMarks>=$fetchMarks['total']*70/100 &&  $totalMarks<=$fetchMarks['total']*79.99/100)
  {
        $grade="A";
        $CGPA="4.00";
  }

 else if($totalMarks>=$fetchMarks['total']*60/100 &&  $totalMarks<=$fetchMarks['total']*69.99/100)
  {
        $grade="A-";
        $CGPA="3.50";
  }

   else if($totalMarks>=$fetchMarks['total']*50/100 &&  $totalMarks<=$fetchMarks['total']*59.99/100)
  {
        $grade="B";
        $CGPA="3.00";
  }
    else if($totalMarks>=$fetchMarks['total']*40/100 &&  $totalMarks<=$fetchMarks['total']*49.99/100)
  {
        $grade="C";
        $CGPA="2.00";
  }
    else if($totalMarks>=$fetchMarks['total']*33/100 &&  $totalMarks<=$fetchMarks['total']*39.99/100)
  {
        $grade="D";
        $CGPA="1.00";
  }
  else
  {
     $grade="F";
     $CGPA="0.00";
  }

    if($fetchMarks['GradePoint']=="0.00")
    {
        $grade="F";
        $CGPA="0.00"; 
    }

      print $grade;

  ?></td>
  <td width="31" align="center"><?php print $CGPA; ?></td>
     <?php
      if($sl==1)
      {?>
         <td width="34" align="center" rowspan="<?php print $rowcount+2; ?>">

            <?php 
          $selectcgpa="SELECT * FROM  `result` WHERE `STD_ID`='$fetch_r[STD_ID]' and examId='$fetchFinalExamType[0]'";
         $querycgpa=$db->select_query($selectcgpa);
        $fetchcgpa=$querycgpa->fetch_array();

        print  $fetchcgpa['CGPA'];

            ?>

            

          </td>
      <?php }
    ?>

  </tr>
  
  
  <?php

          $totalsubpartmarks=$totalsubpartmarks+$fetchMarks['total'];
          $totalSubjectpartObtainMarks=$totalSubjectpartObtainMarks+$totalMarks;
          $low++;

          } // fetch subject part

    //print $totalsubpartmarks."<br>". $totalSubjectpartObtainMarks;
if($totalSubjectpartObtainMarks>=$totalsubpartmarks*80/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*100/100)
  {
       // print "A+";
        $CGPA="5.00";
  }
  else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*70/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*79.99/100)
  {
        //print "A";
        $CGPA="4.00";
  }

 else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*60/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*69.99/100)
  {
        //print "A-";
        $CGPA="3.50";
  }

   else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*50/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*59.99/100)
  {
        //print "B";
        $CGPA="3.00";
  }
    else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*40/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*49.99/100)
  {
        //print "C";
        $CGPA="2.00";
  }
    else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*33/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*39.99/100)
  {

      if($_GET["clID"]=="311609100003" || $_GET["clID"]=="311609110004")
      {
          //print "F";
          $CGPA="0.00";
      }
      else
      {
        //print "D";
        $CGPA="1.00";
      }
        
  }
  else
  {
     //print "F";
     $CGPA="0.00";
  }



//print $CGPA;

        }// end query subject part
        else
        {
          $sl++;
/////////////////////////////////////////////Single Subject///////////////////
?>
   <tr>

    <td align="center" style="border-left:1px #000 solid; height: 30px;" ><?php print $sl; ?> </td>
    <td align="left" > &nbsp;<?php print $fetchsubject['subject_name']?></td>
    <td align="center"><?php print $fetchsubject['subject_code']?></td>

    <?php 


        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 3,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

    $selectMarks="SELECT `marksheet`.*,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId`
WHERE `StudentRoll`='$studentRoll' 
AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' 
AND `marksheet`.`ExamId`='$fetchExamTypeInfo[0]' AND `marksheet`.`SubjectId`='$fetchsubject[0]' AND `marksheet`.`Session`='$Session'  AND `subject_information`.`groupID`='$gpId'
  AND `subject_information`.`examID`='$fetchExamTypeInfo[0]'";




          

          $queryMarks=$db->select_query($selectMarks);
          if($queryMarks)
          {
            $fetchMarks=$queryMarks->fetch_array();
              $totalMarksTotrial=$totalMarksTotrial+$fetchMarks['obtainMark'];
          }
          else
          {
            $fetchMarks['total']='';
            $fetchMarks['obtainMark']='';
            $fetchMarks['LetterGrade']='';
            $fetchMarks['GradePoint']='';
          }

$selectGPA="SELECT * FROM `result` WHERE `std_roll`='$studentRoll' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$fetchExamTypeInfo[0]'";


$queryCGPA=$db->select_query($selectGPA);
if($queryCGPA)
{
    $fetchCGPA=$queryCGPA->fetch_array();
}
else
{
   $fetchCGPA['CGPA']='0.0';
}


    ?>

    <td width="46" align="center"><?php print $fetchMarks['total']?></td>
    <td width="52" align="center"><?php print $fetchMarks['obtainMark']?></td>
    <td width="39" align="center"><?php print $fetchMarks['LetterGrade']?></td>
    <td width="29" align="center"> <?php print $fetchMarks['GradePoint']?></td>
    
      <?php 
      if($sl==1)
      {?>
        <td width="34" align="center" rowspan="<?php print $rowcount;?>"> <?php print $fetchCGPA['CGPA']; ?> </td>

        <?php 
      }
   ?>



  <?php 

        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 4,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

      //  print "...........".$fetchExamTypeInfo['exam_type']."<br>>br>";

  $selectMarks="SELECT `marksheet`.*,`subject_information`.`total`,`add_subject_info`.`subject_code` FROM `marksheet` 
INNER JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `StudentRoll`='$studentRoll' 
AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' 
AND `marksheet`.`ExamId`='$fetchExamTypeInfo[0]' AND `marksheet`.`SubjectId`='$fetchsubject[0]' AND `marksheet`.`Session`='$Session' AND `subject_information`.`groupID`='$gpId'
  AND `subject_information`.`examID`='$fetchExamTypeInfo[0]'";

          //print $selectMarks."<br><br><br>";

          $queryMarks=$db->select_query($selectMarks);
          if($queryMarks)
          {
            $fetchMarks=$queryMarks->fetch_array();
          }
          else
          {
            $fetchMarks['total']='';
            $fetchMarks['obtainMark']='';
            $fetchMarks['LetterGrade']='';
            $fetchMarks['GradePoint']='';
          }

$selectGPA="SELECT * FROM `result` WHERE `std_roll`='$studentRoll' AND `classId`='$clId' AND `GroupID`='$gpId' AND `session`='$Session' AND `examId`='$fetchExamTypeInfo[0]'";


$queryCGPA=$db->select_query($selectGPA);
if($queryCGPA)
{
    $fetchCGPA=$queryCGPA->fetch_array();
}
else
{
   $fetchCGPA['CGPA']='0.0';
}



    ?>

    <td width="46" align="center"><?php print $fetchMarks['total']?></td>
    <td width="52" align="center">
      

       <table style="padding: 0px;  height: 100%" cellspacing="0" cellspacing="0"> 
   

    <tr>
        <td style="border-bottom: 0px; text-align: center; width: 25px; ">&nbsp;<?php print $fetchMarks[9]?></td>
        <td style="border-bottom: 0px;text-align: center;width: 38px;  ">&nbsp;<?php print $fetchMarks[10]?></td>
        <td style="border-bottom: 0px;text-align: center; width: 30px; ">&nbsp;<?php print $fetchMarks[11]?></td>
        <td style="border-bottom: 0px; border-right: 0px;width: 30px; " align="center">&nbsp;<?php print $fetchMarks['obtainMark']?></td>
    </tr>
   
    </table>


    </td>
    <td width="39" align="center"><?php print $fetchMarks['LetterGrade']?></td>
    <td width="29" align="center"> <?php print $fetchMarks['GradePoint']?></td>
    <?php 
      if($sl==1)
      {?>
        <td width="34" align="center" rowspan="<?php print $rowcount;?>"> <?php print $fetchCGPA['CGPA']; ?> </td>

        <?php 
      }
   ?>



  <td width="69" align="center"><?php  $totrialAvg=$totalMarksTotrial;
    print $totrialAvg; ?></td>
  <td width="81" align="center">  <?php  
   
  if($fetchMarks['total']==100)
    {
       $helfYearly=$fetchMarks['obtainMark']* 70/100; 
       print $helfYearly;

    }
    else if($fetchMarks['total']==50)
    {
       if($fetchsubject['subject_code']=='154' )
       {

        $helfYearly=$fetchMarks['obtainMark'];
        print $helfYearly;
       }
      else
      {
        $helfYearly=$fetchMarks['obtainMark']* 60/100; 
        print $helfYearly;
      }
      
    }

  

    ?> </td>
  <td width="46" align="center">
    
    <?php   $totalComMarks= $helfYearly+$totrialAvg;
  $tm[0]="";
  $tm[1]="";
  $totalMarks=0;
  $tm=explode('.',$totalComMarks);
  if($tm!='')
  {


  if($tm[1]>4)
  {
       $totalMarks=$tm[0]+1;
  }
  else
  {
    $totalMarks=$tm[0];
  }

}

print $totalMarks;
 

?>

  </td>
  <td width="46" align="center"><?php
  //print $totalMarks;

 if($totalMarks>=$fetchMarks['total']*80/100 &&  $totalMarks<=$fetchMarks['total']*100/100)
  {
        $grade="A+";
        $CGPA="5.00";
  }
  else if($totalMarks>=$fetchMarks['total']*70/100 &&  $totalMarks<=$fetchMarks['total']*79.99/100)
  {
        $grade="A";
        $CGPA="4.00";
  }

 else if($totalMarks>=$fetchMarks['total']*60/100 &&  $totalMarks<=$fetchMarks['total']*69.99/100)
  {
        $grade="A-";
        $CGPA="3.50";
  }

   else if($totalMarks>=$fetchMarks['total']*50/100 &&  $totalMarks<=$fetchMarks['total']*59.99/100)
  {
        $grade="B";
        $CGPA="3.00";
  }
    else if($totalMarks>=$fetchMarks['total']*40/100 &&  $totalMarks<=$fetchMarks['total']*49.99/100)
  {
        $grade="C";
        $CGPA="2.00";
  }
    else if($totalMarks>=$fetchMarks['total']*33/100 &&  $totalMarks<=$fetchMarks['total']*39.99/100)
  {
      if($_GET["clID"]=="311609100003" || $_GET["clID"]=="311609110004")
      {
          $grade="F";
          $CGPA="0.00";
      }
      else
      {
        $grade="D";
        $CGPA="1.00";
      }
  }
  else
  {
     $grade="F";
     $CGPA="0.00";
  }

   if($fetchMarks['GradePoint']=="0.00")
    {
        $grade="F";
        $CGPA="0.00"; 
    }

    print $grade;


  ?></td>
  <td width="31" align="center"><?php print $CGPA; ?></td>
    
    <?php 
      if($sl==1)
      {?>
        <td width="34" align="center" rowspan="<?php print $rowcount;?>">

            <?php 
       $selectcgpa="SELECT * FROM  `result` WHERE `STD_ID`='$fetch_r[STD_ID]' and examId='$fetchFinalExamType[0]'";
         $querycgpa=$db->select_query($selectcgpa);
        $fetchcgpa=$querycgpa->fetch_array();

        print  $fetchcgpa['CGPA'];

            ?>



         </td>

        <?php 
      }
   ?>

  </tr>
  
<?php

////////////////////////End Single Subject////////////////////////////////////

        }
      }// end fetch subject 
  }// end select sub
?>
  
 
</table>



</div>
  </div>


</body>
</html>

  