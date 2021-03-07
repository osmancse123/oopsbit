<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	if(isset($_POST["StringData"])){
	
			$ClassId=explode('and',$_POST["ClassId"]);
			$groupname=explode('and',$_POST["groupname"]);
			$Session=$db->escape($_POST["Session"]);
			$Session=$db->escape($_POST["Session"]);
			$Session=$db->escape($_POST["Session"]);
			
			?>
			
			<table width="792" height="108" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="40" colspan="5" align="center"><strong class="text-success" style="font-size:16px">Student's Details</strong> </td>
    </tr>
  <tr align="center">
    <td width="66" height="29">Select All <br/><input type="checkbox" name="checkbox" id="chkbx_all" onclick="return check_all();"/> </td>
    <td width="132">Student ID </td>
	 <td width="188">Class Roll </td>
    <td width="150">Student Name </td>
   
    <td width="244">Father's Name </td>
  </tr>
  <?php
  		 $selectAllData ="SELECT `running_student_info`.*,`student_personal_info`.*,`student_acadamic_information`.`session2` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
INNER JOIN  `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='".$ClassId[0]."' AND `running_student_info`.`group_id`='".$groupname[0]."' AND  `student_acadamic_information`.`session2`='$Session'
AND `class_roll` BETWEEN '".$_POST["from"]."' AND '".$_POST["to"]."' 
 GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC";
 $check_query=$db->select_query($selectAllData);
                            if($check_query->num_rows > 0){
                                while($fetch_class=$check_query->fetch_array())
                                {
  ?>
  <tr align="center">
    <td height="34"><input type="checkbox"  id="checkboxsingId[]" class="check_elmnt" name="checkboxsingId[]" value="<?php echo $fetch_class['student_id']?>"/> </td>
    <td><?php echo $fetch_class['student_id']?>  </td>
	 <td><?php echo $fetch_class['class_roll']?>  </td>
    <td><?php echo $fetch_class['student_name']?>  </td>
  
    <td><?php echo $fetch_class['father_name']?>  </td>
  </tr>
  
  <?php  } 
  
  ?>
  	<tr align="center">
		<td height="34" colspan="5" align="right" > <input type="button" name="save" id="save" value="Save" class="btn btn-primary btn-defualt btn-sm" style="width:150px;" onclick="return Save2()"/></td>
    </tr>
  <?php }?>
</table>

		
<?php		}
	
	
	if(isset($_POST["saveExStudent"])){
	
		//	 $count = count($_POST["fromData"]);
			  for($a = 0; $a < count($_POST["fromData"]);$a++){
			  			   $select_query = "SELECT `running_student_info`.`student_id`,`class_id`,`group_id`,`class_roll`,`student_acadamic_information`.`session2`,`student_personal_info`.`student_name`,date_of_brith,`father_name`,`mother_name`,`gender`
FROM `running_student_info` INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
INNER JOIN  `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` WHERE `running_student_info`.`student_id`='".$_POST['fromData'][$a]."'";
						$resultQuery = $db->select_query($select_query);
							if($resultQuery->num_rows > 0 ){
								$fetchQuery = $resultQuery->fetch_array();
									 $inserQuery = "INSERT INTO `exstudentreport`(`Id`,`StudentName`,`FatherName`,`MotherName`,`ClassId`,`GroupId`,`classRoll`,`session`,`gender`,'date_of_brith') VALUES('$fetchQuery[student_id]','$fetchQuery[student_name]','$fetchQuery[father_name]','$fetchQuery[mother_name]','$fetchQuery[class_id]','$fetchQuery[group_id]','$fetchQuery[class_roll]','$fetchQuery[session2]','$fetchQuery[gender]','$fetchQuery[date_of_brith]')";
									$resultInsert = $db->insert_query($inserQuery);
									
									$delete_query1="DELETE FROM `running_student_info` WHERE `student_id`='$fetchQuery[student_id]'";            
									$delete_query2="DELETE FROM `subject_registration_table` WHERE `std_id`='$fetchQuery[student_id]'";        
									
									$db->delete_query($delete_query1);
									$db->delete_query($delete_query2);            
									
									
							}
							
								
			  }
	 } ?>
	
	
	