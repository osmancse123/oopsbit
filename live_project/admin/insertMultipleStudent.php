<?php 	
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();

			$classID=explode('and',$_POST["className"]);
			$groupID=explode('and',$_POST["groupname"]);
			$SectionID=explode('and',$_POST["section"]);	
			
			
		if(isset($_POST["chek"])){
			 $countAll=count($_POST["chek"]);

			for($x = 0;$x < $countAll; $x++){
					$selectQuery="SELECT `running_student_info`.*,`student_acadamic_information`.`session2` FROM `running_student_info` INNER JOIN 
`student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`student_id`='".$_POST["chek"][$x]."'";
					$resultQuery=$db->select_query($selectQuery);
					if($resultQuery){
							$fetchQuery=$resultQuery->fetch_array();
							$iNSERAcademicRecord= "INSERT INTO `student_academic_record` (`student_id`,`class_id`,`session`,`year`,`class_roll`,`groupID`) VALUES ('".$fetchQuery["student_id"]."','".$fetchQuery["class_id"]."','".$fetchQuery["session2"]."','".$fetchQuery["year"]."','".$fetchQuery["class_roll"]."','".$fetchQuery["group_id"]."')";
							$db->insert_query($iNSERAcademicRecord);
							$delStudenRunn="DELETE FROM `running_student_info` WHERE `student_id`='".$fetchQuery[0]."'";
							$db->delete_query($delStudenRunn);
							$delSubRE="DELETE FROM `subject_registration_table` WHERE `std_id`='".$fetchQuery[0]."'";
							$db->delete_query($delSubRE);
							
							$updatesql="UPDATE `student_acadamic_information` SET `admission_disir_class`='".$classID[0]."',`admission_disir_group`='".$groupID[0]."',`session2`='".$_POST["sss"]."' WHERE `id`='".$_POST["chek"][$x]."'";
$db->update_query($updatesql);


					 $replaceQuery="INSERT  INTO `running_student_info` (`student_id`,`class_id`,`class_roll`,`group_id`,`section_id`,`datev`,`year`) VALUES ('".$_POST["chek"][$x]."','$classID[0]','".$_POST["rollNo"][$x]."','$groupID[0]','$SectionID[0]','".date('d/m/Y')."','".$_POST["year"][$x]."')";
					$resultquery=$db->insert_query($replaceQuery);
							
						 //$councomPsubjec=count($_POST["subject"]);
						 for($a = 0; $a < count($_POST["subject"]);$a++){
			$explodecompulsarysubject=explode('codnumber', $_POST['subject'][$a]);
             $inser_compusaray_Subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$explodecompulsarysubject[0]."')";
                        //print_R($inser_compusaray_Subject);
              $r_compul=$db->insert_query($inser_compusaray_Subject);
		}//cmsubject
						
						for($n=0; $n <count($_POST["selective"]); $n++ )
          {
                        $explopide_selective=explode("codenumber",$_POST['selective'][$n]);
                       
                        $insert_select_subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$explopide_selective[0]."')";
                         $check_Selctive=$db->insert_query($insert_select_subject);
            }//end sl
			
			if(!empty($_POST["optional_subject"]))
                    {
                        $insert_optional_Subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$_POST["optional_subject"]."')";
                         $check_optionale_Subejct=$db->insert_query($insert_optional_Subject);
                    }
								
					
					}
					else {
					$updatesql="UPDATE `student_acadamic_information` SET `admission_disir_class`='".$classID[0]."',`admission_disir_group`='".$groupID[0]."',`session2`='".$_POST["sss"]."' WHERE `id`='".$_POST["chek"][$x]."'";
$db->update_query($updatesql);

						$replaceQuery="INSERT  INTO `running_student_info` (`student_id`,`class_id`,`class_roll`,`group_id`,`section_id`,`datev`,`year`) VALUES ('".$_POST["chek"][$x]."','$classID[0]','".$_POST["rollNo"][$x]."','$groupID[0]','$SectionID[0]','".date('d/m/Y')."','".$_POST["year"][$x]."')";
					$resultquery=$db->insert_query($replaceQuery);
					
					
		 

								
									 for($a = 0; $a < count($_POST["subject"]);$a++){
			$explodecompulsarysubject=explode('codnumber', $_POST['subject'][$a]);
             $inser_compusaray_Subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$explodecompulsarysubject[0]."')";
                        //print_R($inser_compusaray_Subject);
              $r_compul=$db->insert_query($inser_compusaray_Subject);
		}//cmsubjecgt
			for($n=0; $n <count($_POST["selective"]); $n++ )
          {
                        $explopide_selective=explode("codenumber",$_POST['selective'][$n]);
                       
                        $insert_select_subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$explopide_selective[0]."')";
                         $check_Selctive=$db->insert_query($insert_select_subject);
            }//end ssl
				if(!empty($_POST["optional_subject"]))
                    {
                        $insert_optional_Subject="INSERT INTO `subject_registration_table` (`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('".$_POST["chek"][$x]."','".$classID[0]."','".$groupID[0]."','".$_POST["optional_subject"]."')";
                         $check_optionale_Subejct=$db->insert_query($insert_optional_Subject);
                    }
								
					
						
					}
			}
			}
			
			if(isset($db->sms)){
				echo $db->sms;
			}

?>