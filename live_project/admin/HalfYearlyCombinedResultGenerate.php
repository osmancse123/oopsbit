<!-- HalfYearlyCombinedResultGenerate.php -->


   <?php
  error_reporting(1);
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  date_default_timezone_set("Asia/Dhaka");
  $db = new database();

  	       $classID=explode('and',$_POST["className"]);
			$Session=$_POST["Session"];
			$groupname = explode('and',$_POST["groupname"]);
			$clId=$classID[0];
  			$gpId=$groupname[0];

  			$limit1=$_POST["limit1"];
  			$limit2=$_POST["limit2"];

 
  
   $sql="SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`add_class`.`class_name`,`add_group`.`group_name`  FROM `result`  JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`session`='$Session'  GROUP BY  `result`.`STD_ID` ORDER BY `result`.`std_roll` ASC LIMIT $limit1,$limit2";


  $result=$db->select_query($sql);
  if($result){

      while($fetch_r=$result->fetch_array())
      {

          $DELETE="DELETE FROM `combinedmarks` WHERE `studentID`='$fetch_r[STD_ID]' AND  `session`='".$_GET["session"]."'";
         $db->select_query($DELETE);


      	 $studentRoll=$fetch_r[1];
  
  
  
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

$selectExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ";
$queryExamType=$db->select_query($selectExamType);
$fetchExamType=$queryExamType->fetch_array();
       
      
$helfYearly=0;
$selectSub="SELECT `add_subject_info`.`id`,`add_subject_info`.`subject_name`,`add_subject_info`.`select_subject_type`,`add_subject_info`.`subject_code` FROM `marksheet`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
 WHERE  `StudentRoll`='$studentRoll' AND `ClassId`='$clId' AND `GroupID`='$gpId' AND `Session`='$Session' GROUP BY `SubjectId` ORDER BY `add_subject_info`.`serial` ASC";





 $selectSubject=$db->select_query($selectSub);
 $rowcount=@mysqli_num_rows($selectSubject);
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
   		// print $selectSubJectPart.'<br><br>';
	 	$totalSubjectpartObtainMarks=0; 
	 	$totalsubpartmarks=0;

        $querySelectPart=$db->select_query($selectSubJectPart);
        if($querySelectPart)
        {

         while($fetch_subPartName=$querySelectPart->fetch_array())
         {
            $sl++;
            $totalMarksTotrial=0;

          $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 0,1";

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
   


        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 1,1";

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


        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 2,1";

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


   $totrialAvg=$totalMarksTotrial/2;
    
  if($fetchMarks['total']==100)
    {

       $helfYearly=$fetchMarks['obtainMark']* 70/100; 
       //print $helfYearly;

    }
    else if($fetchMarks['total']==50)
    {
        $helfYearly=$fetchMarks['obtainMark']* 60/100; 
      // print $helfYearly;
    }

    
      $totalComMarks= $helfYearly+$totrialAvg;
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

		//print $totalMarks;
 

 
  
  


          $totalsubpartmarks=$totalsubpartmarks+$fetchMarks['total'];
          $totalSubjectpartObtainMarks=$totalSubjectpartObtainMarks+$totalMarks;
          $low++;

          } // fetch subject part

    //print $totalsubpartmarks."<br>". $totalSubjectpartObtainMarks;
if($totalSubjectpartObtainMarks>=$totalsubpartmarks*80/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*100/100)
  {
        $grade="A+";
        $CGPA="5.00";
  }
  else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*70/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*79.99/100)
  {
        $grade="A";
        $CGPA="4.00";
  }

 else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*60/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*69.99/100)
  {
        $grade="A-";
        $CGPA="3.50";
  }

   else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*50/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*59.99/100)
  {
        $grade="B";
        $CGPA="3.00";
  }
    else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*40/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*49.99/100)
  {
        $grade="C";
        $CGPA="2.00";
  }
    else if($totalSubjectpartObtainMarks>=$totalsubpartmarks*33/100 &&  $totalSubjectpartObtainMarks<=$totalsubpartmarks*39.99/100)
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

  			$insertQuery="INSERT INTO `combinedmarks`(`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`,`subjectType`)VALUES('$fetch_r[STD_ID]','$clId','$gpId','HelfYearlyCombinedResult',
  			'".$_GET["session"]."','$studentRoll','$fetchsubject[0]','$totalsubpartmarks','$totalSubjectpartObtainMarks','$grade','$CGPA','$fetchsubject[2]')";
  			 $executequery=$db->select_query($insertQuery);

//print $CGPA;

        }// end query subject part

        else
        {
          $sl++;



        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 0,1";

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


    

        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 1,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

        
  $selectMarks="SELECT `marksheet`.*,`subject_information`.`total`,`add_subject_info`.`subject_code` FROM `marksheet` 
INNER JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `StudentRoll`='$studentRoll' 
AND `marksheet`.`ClassId`='$clId' AND `marksheet`.`GroupID`='$gpId' 
AND `marksheet`.`ExamId`='$fetchExamTypeInfo[0]' AND `marksheet`.`SubjectId`='$fetchsubject[0]' AND `marksheet`.`Session`='$Session' AND `subject_information`.`groupID`='$gpId'
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


        $ExamType="SELECT * FROM `exam_type_info` WHERE `select_class`='$clId' ORDER BY `exam_type_info`.`sl` ASC LIMIT 2,1";

        $queryExamTypeInfo=$db->select_query($ExamType);
        $fetchExamTypeInfo=$queryExamTypeInfo->fetch_array();

      //  print "...........".$fetchExamTypeInfo['exam_type']."<br>>br>";

  $selectMarks="SELECT `marksheet`.*,`subject_information`.`total` FROM `marksheet` 
INNER JOIN `subject_information` ON `subject_information`.`subjectId`=`marksheet`.`SubjectId`
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


    $totrialAvg=$totalMarksTotrial/2;
   // print $totrialAvg;  
   
  if($fetchMarks['total']==100)
    {
       $helfYearly=$fetchMarks['obtainMark']* 70/100; 
       //print $helfYearly;

    }
    else if($fetchMarks['total']==50)
    {
       if($fetchMarks['subject_code']=='154' && $fetchMarks['ClassId']!='311609230005' )
      {

        $helfYearly=$fetchMarks['obtainMark'];
        print $helfYearly;
      }
      else
      {
        $helfYearly=$fetchMarks['obtainMark']* 60/100; 
       // print $helfYearly;
      }
       
       
    }


 $totalComMarks= $helfYearly+$totrialAvg;
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

  
	$insertQuery="INSERT INTO `combinedmarks`(`studentID`,`ClassID`,`GroupID`,`ExamID`,`session`,`studentRoll`,`subjectID`,`fullMarks`,`obtainMarks`,`letterGrade`,`gradePoint`,`subjectType`)VALUES('$fetch_r[STD_ID]','$clId','$gpId','HelfYearlyCombinedResult',
  			'".$_GET["session"]."','$studentRoll','$fetchsubject[0]','$fetchMarks[total]','$totalMarks','$grade','$CGPA','$fetchsubject[2]')";
  			 $executequery=$db->select_query($insertQuery);



        }
      }// end fetch subject 
  }// end select sub

$sub=0;
$gp=0;
  	$selectresult="SELECT * FROM `combinedmarks` WHERE `studentID`='$fetch_r[STD_ID]'";
  	$queryResult=$db->select_query($selectresult);
    $failed=0;
    $withoutOptional=0;
  	while($fetchresult=$queryResult->fetch_array())
  	{
  			if($fetchresult['subjectType']=="OptionalSubject")
  			{
  					$g=$fetchresult['gradePoint']-2;
  					if($g>0)
  					{
  						$gp=$gp+$g;
  					}
  			}
  			else
  			{
  					$sub++;
  					$gp=$gp+$fetchresult['gradePoint'];
            $withoutOptional=$withoutOptional+$fetchresult['gradePoint'];
            if($fetchresult['gradePoint']=="0.00")
            {
                $failed=1;
            }

  			}


  	}
    if($failed>0)
    {
         $cgpa='0.00';
        $cgpaWithoutOptional='0.00';
    }
    else{
      $cgpa=$gp/$sub;
      $cgpaWithoutOptional=$withoutOptional/$sub;
      if($cgpaWithoutOptional>5)
      {
        $cgpaWithoutOptional="5.00";
      }

       if($cgpa>5)
      {
        $cgpa="5.00";
      }

    }

  	   $DEL="DELETE FROM `combinedresult` WHERE `Student_ID`='$fetch_r[STD_ID]' AND `Year`='".date('Y')."'";
      $db->select_query($DEL);


  	$insertResult="INSERT INTO `combinedresult`(`Student_ID`,`Roll`,`GPA`,`withOutOptional`,`Year`) VALUES('$fetch_r[STD_ID]',' $studentRoll','$cgpa','$cgpaWithoutOptional','".date('Y')."')";
  	 	$db->select_query($insertResult);




	} // Fetch Student 

}// Select Student 
else
{
	print "&nbsp;&nbsp; <h3 style='color:#ff0000'>Limit Exist </h3>";
}
?>
  
 


