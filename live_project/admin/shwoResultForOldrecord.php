<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
		
		
			if(isset($_POST["CsslassId"])){
					  $sqlOld ="SELECT `student_academic_record`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`student_name`
FROM `student_academic_record` INNER JOIN `add_class` ON `add_class`.`id`=`student_academic_record`.`class_id` 
INNER JOIN `add_group` ON `add_group`.`id`=`student_academic_record`.`groupID` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`student_academic_record`.`student_id` WHERE `student_academic_record`.`student_id`='".$_POST["stdId"]."'
 GROUP BY `student_academic_record`.`class_id` ORDER BY `student_academic_record`.`class_id` ASC";
					$resultOld = $db->select_query($sqlOld);
						if($resultOld->num_rows > 0){
							?>
								<table width="864" border="1" cellpadding="0" cellpadding="0" align="center">
										<tr>
									    <td colspan="6" height="50" align="center"><strong><span style="font-size:18px;" class="text-success">Student Old Record </span></strong></td>
									  </tr>
									  <tr align="center" style=" font-size:14px;">
									    <td width="168">Student ID </td>
										<td width="168">Student Name  </td>
										<td width="168">Class Roll </td>
										<td width="161">Class Name </td>
										<td width="219">Group Name</td>
										<td width="114">Session</td>
									  </tr>
									  <?php
									  		while($fetchOldRecord = $resultOld->fetch_array()){
									  ?>	
									  <tr align="center" style=" font-size:14px;">
									    <td>&nbsp;<?php echo $fetchOldRecord[0];?></td>
										<td>&nbsp;<?php echo $fetchOldRecord["student_name"];?></td>
										<td>&nbsp;<?php echo $fetchOldRecord["class_roll"];?></td>
										<td>&nbsp;<?php echo $fetchOldRecord["class_name"];?></td>
										<td>&nbsp;<?php echo $fetchOldRecord["group_name"];?></td>
										<td>&nbsp;<?php echo $fetchOldRecord["session"];?></td>
										
									  </tr>
									  <?php } ?>
</table> 

							<?php
						}
			}
	
	?>