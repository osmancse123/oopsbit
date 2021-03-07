<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			
			
			if(isset($_POST["forDaily"])){
			
			
			
			
					$selProject="SELECT * FROM `project_info`";
					$resproject=$db->select_query($selProject);
					@$counrows=$resproject->num_rows;
					if($counrows>0){
							$fetchResult=$resproject->fetch_array();
					}
					
					
					?>
						<table width="1105"  class="table table-bordered table-responsive" style=" margin-bottom:0px">
						
						   <tr>
						<td height="43" colspan="14" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <?php
					  
					  		if(!empty($_POST["className"]) and $_POST["className"]!="Select One" and !empty($_POST["example1"]))
							{ 
							
									
									if($_POST["className"] == 'teacher'){
										  $frsttile = "SELECT `teacherpresent`.`teacherID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`teacherID`='".$_POST["id"]."'";
									}else if($_POST["className"] == 'Staff') {
										
										
											   $frsttile = "SELECT `struff_present`.`StruffID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `struff_present`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
WHERE `struff_present`.`StruffID`='".$_POST["id"]."'";


										}else if($_POST["className"] == 'student') {
										
										
										
										 $frsttile = "SELECT `studentpresent`.`StudentID`,`student_personal_info`.`student_name`,`add_class`.`class_name`,`add_group`.`group_name`,
`running_student_info`.`class_roll` FROM `studentpresent` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group` ON `add_group`.`id`=`studentpresent`.`GroupID`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`studentpresent`.`StudentID` WHERE
`studentpresent`.`StudentID`='".$_POST["id"]."' AND `studentpresent`.`classID`='".$_POST["clsname"]."'";



										
										}
									
									$resultfrstt=$db->select_query($frsttile);
									
									if(count($resultfrstt) > 0){
											$fetchfrst=$resultfrstt->fetch_array();
									}
												  
					  ?>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>
										<?php
										
										if($_POST["className"] == 'teacher'){
										?>
										Teacher   attendance 
										
										<?php
										} else if($_POST["className"] == 'Staff'){
										?>
											Staff   attendance 

										<?php }  else {
										
										?>
										Student attendance
										<?php
										}
										?>
										Report.</strong></span></td>
									</tr>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:14px;"><strong>
										<?php
											if($_POST["className"] == 'teacher' or $_POST["className"] == 'Staff' ){
											?>
											
												 Name&nbsp;:&nbsp; <?php echo $fetchfrst['teachers_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Designation &nbsp;:&nbsp; <?php  echo  $fetchfrst['designation'] ?>  Mobile  No :  <?php  echo  $fetchfrst['mobile_no'] ?> 
											<?php 
											}else { ?> 
												Class Name&nbsp;:&nbsp;<?php echo $fetchfrst['class_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												 Group Name&nbsp;:&nbsp;<?php echo $fetchfrst['group_name']?> &nbsp;:&nbsp; Name : <?php echo $fetchfrst['student_name']?>  &nbsp;:&nbsp; Roll No : <?php echo $fetchfrst['class_roll']?>  
											
											<?php }
										?>
									
										
										
										
										
										</strong></span></td>
									</tr>
									
									<tr>
										<td colspan="6" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total   Attendance  &nbsp;</strong></span></td>
										<td  colspan="4" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Total   Absent   &nbsp;</strong></span></td>
  </tr>
									<tr>
											<td width="191"  height="21" align="center"><span class="text-success" style="font-weight:600">Total Attendance</span></td>
											<td colspan="5"  align="left"><span class="text-success" style="font-weight:600">
											
											
											
											<?php
												if($_POST["className"] == 'teacher'){
													
													 $totaatten = "SELECT SUM(`present`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `present`='1'";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												 $totaatten = "SELECT SUM(`present`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `present`='1'";
													
												
												}else {
												
												 $totaatten = "SELECT SUM(`present`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `present`='1'";
												
												}
												
												
												$resulttota = $db->select_query($totaatten)->fetch_array();
												echo $resulttota[0];
											
											?>
											
											
											
											
											</span></td>
											<td width="59" align="center"><strong><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Absent</span></strong></td>
											<td width="407" colspan="2"  align="left"><span class="text-danger" style="font-weight:600">
											
												
											<?php
													if($_POST["className"] == 'teacher'){
													
													$totalabsent = "SELECT SUM(`absent`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `absent`='1'";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												$totalabsent = "SELECT SUM(`absent`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `absent`='1'";
													
													
												
												}else {
												
												 $totalabsent = "SELECT SUM(`absent`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `absent`='1'";
												
												}
												
												$resultabsent = $db->select_query($totalabsent)->fetch_array();
												echo $resultabsent[0];
											
											?>
											
											
											</span></td>
									</tr>
									<tr>
											<td height="21"  align="center">&nbsp;</td>
											<td colspan="5"  align="left">&nbsp;</td>
											<td  align="center"><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Vacation</span></span></td>
											<td><span class="text-danger" style="font-weight:600">
											
										
											
											<?php
													if($_POST["className"] == 'teacher'){
													
												 	$vacation = "SELECT SUM(`onvacation`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `onvacation`='1'";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												$vacation = "SELECT SUM(`onvacation`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `onvacation`='1'";
													
												
												}else {
												
												 $vacation = "SELECT SUM(`onvacation`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `date`='".$_POST["example1"]."' AND `onvacation`='1'";
												
												}
												
												
												$resvacation = $db->select_query($vacation)->fetch_array();
												echo $resvacation[0];
											
											?>
											
											
										
										
										</span></td>
									</tr>

									</tr>
									
								
						  
						  <?php } else {?>
						   <tr>
							<td colspan="10" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Please Fill Up All fields...</strong></span></td>
						  </tr>
						  
						  <?php } ?>
						  <tr id="trNotprint">
							<td colspan="10" align="center">&nbsp;<input type="submit" value="Print" onclick="window.print()"/></td>
						  </tr>
						  </table>
					<?php
			}

	
			if(isset($_POST["formonthly"])){
			
			
					$selProject="SELECT * FROM `project_info`";
					$resproject=$db->select_query($selProject);
					@$counrows=$resproject->num_rows;
					if($counrows>0){
							$fetchResult=$resproject->fetch_array();
					}
					
					
					?>
						<table width="1105"  class="table table-bordered table-responsive" style=" margin-bottom:0px">
						
						   <tr>
						<td height="43" colspan="14" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <?php
					  
					  		if(!empty($_POST["className"]) and $_POST["className"]!="Select One" and !empty($_POST["year"]))
							{ 
							
									
									if($_POST["className"] == 'teacher'){
										  $frsttile = "SELECT `teacherpresent`.`teacherID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`teacherID`='".$_POST["id"]."'";
									}else if($_POST["className"] == 'Staff') {
										
										
											   $frsttile = "SELECT `struff_present`.`StruffID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `struff_present`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
WHERE `struff_present`.`StruffID`='".$_POST["id"]."'";
									}else if($_POST["className"] == 'student') {
										
										
										
										    $frsttile = "SELECT `studentpresent`.`StudentID`,`student_personal_info`.`student_name`,`add_class`.`class_name`,`add_group`.`group_name`,
`running_student_info`.`class_roll` FROM `studentpresent` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group` ON `add_group`.`id`=`studentpresent`.`GroupID`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`studentpresent`.`StudentID` WHERE
`studentpresent`.`StudentID`='".$_POST["id"]."' AND `studentpresent`.`classID`='".$_POST["clsname"]."'";



										
										}
									
									$resultfrstt=$db->select_query($frsttile);
									
									if(count($resultfrstt) > 0){
											$fetchfrst=$resultfrstt->fetch_array();
									}
												  
					  ?>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>
										
										
										<?php
										
										if($_POST["className"] == 'teacher'){
										?>
										Teacher   attendance 
										
										<?php
										} else if($_POST["className"] == 'Staff'){
										?>
											Staff   attendance 

										<?php }
										?>
										
										Report
										
										
										
										</strong></span></td>
									</tr>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:14px;"><strong>
										<?php
											if($_POST["className"] == 'teacher' or $_POST["className"] == 'Staff' ){
											?>
											
												 Name&nbsp;:&nbsp;<?php echo $fetchfrst['teachers_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Designation &nbsp;:&nbsp; <?php  echo  $fetchfrst['designation'] ?>  Mobile  No :  <?php  echo  $fetchfrst['mobile_no'] ?> 
											<?php 
											}else { ?> 
												Class Name&nbsp;:&nbsp;<?php echo $fetchfrst['class_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												 Group Name&nbsp;:&nbsp;<?php echo $fetchfrst['group_name']?> &nbsp;:&nbsp; Name : <?php echo $fetchfrst['student_name']?>  &nbsp;:&nbsp; Roll No : <?php echo $fetchfrst['class_roll']?>  
											
											<?php }
										?>
									
										
										
										
										
										</strong></span></td>
									</tr>
									
									<tr>
										<td colspan="6" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total   Attendance  &nbsp;</strong></span></td>
										<td  colspan="4" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Total   Absent   &nbsp;</strong></span></td>
  </tr>
									<tr>
											<td width="191"  height="21" align="center">&nbsp;
											<span class="text-success" style="font-weight:600">Total Days</span>
											</td>
											<td colspan="5"  align="left">&nbsp;
										<span class="text-success" style="font-weight:600">	<?php
													if($_POST["className"] == 'teacher'){
													
													$totaldays = "SELECT * FROM `teacherpresent` WHERE SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
													$totaldays = "SELECT * FROM `struff_present` WHERE SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";
													
													
												
												}else {
												
													$totaldays = "SELECT * FROM `studentpresent` WHERE SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";
													
												
												
												}
												
												$resultttlday = $db->select_query($totaldays);
												echo $resultttlday->num_rows;	
											
											?>
											</span>
											</td>
											<td width="59" align="center"><strong><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Absent</span></strong></td>
											<td width="407" colspan="2"  align="left"><span class="text-danger" style="font-weight:600">
											
												
											
											
											<?php
													if($_POST["className"] == 'teacher'){
													
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `absent`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `absent`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
											}else{
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `absent`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
												}
												
												$resultabsent = $db->select_query($totalabsent)->fetch_array();
												echo $resultabsent[0];
											
											?>
											
											
											
											
											</span></td>
									</tr>
									<tr>
											<td height="21"  align="center"><span class="text-success" style="font-weight:600">Total Attendance</span></td>
											<td colspan="5"  align="left"><span class="text-success" style="font-weight:600">
											  <?php
												if($_POST["className"] == 'teacher'){
													
													
													
													
													  $totaatten = "SELECT SUM(`present`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `present`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
													 $totaatten = "SELECT SUM(`present`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."'  AND `present`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
													
												
												}else {
												
												
													 $totaatten = "SELECT SUM(`present`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."'  AND `present`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
												}
												
												
												$resulttota = $db->select_query($totaatten)->fetch_array();
												echo $resulttota[0];
											
											?>
											
											
											
											
											
											
											</span></td>
											<td  align="center"><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Vacation</span></span></td>
											<td><span class="text-danger" style="font-weight:600">
											
										
											
											<?php
													if($_POST["className"] == 'teacher'){
													
													
													  $vacation = "SELECT SUM(`onvacation`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `onvacation`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
											
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
													  $vacation = "SELECT SUM(`onvacation`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `onvacation`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
											
													
												
												}else{
												
												
													  $vacation = "SELECT SUM(`onvacation`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `onvacation`='1' AND SUBSTR(`date`,4,2)='".$_POST["monthID"]."' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
												}
												
												
												$resvacation = $db->select_query($vacation)->fetch_array();
												echo $resvacation[0];
											
											?>
											
											
										
										
										</span></td>
									</tr>

									</tr>
									
								
						  
						  <?php } else {?>
						   <tr>
							<td colspan="10" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Please Fill Up All fields...</strong></span></td>
						  </tr>
						  
						  <?php } ?>
						  <tr id="trNotprint">
							<td colspan="10" align="center">&nbsp;<input type="submit" value="Print" onclick="window.print()"/></td>
						  </tr>
						  </table>
					<?php
			}
			
			
			if(isset($_POST["foryear"])){
			
			
					$selProject="SELECT * FROM `project_info`";
					$resproject=$db->select_query($selProject);
					@$counrows=$resproject->num_rows;
					if($counrows>0){
							$fetchResult=$resproject->fetch_array();
					}
					
					
					?>
						<table width="1105"  class="table table-bordered table-responsive" style=" margin-bottom:0px">
						
						   <tr>
						<td height="43" colspan="14" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <?php
					  
					  		if(!empty($_POST["className"]) and $_POST["className"]!="Select One" and !empty($_POST["year"]))
							{ 
							
									
									if($_POST["className"] == 'teacher'){
										  $frsttile = "SELECT `teacherpresent`.`teacherID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`teacherID`='".$_POST["id"]."'";
									}else if($_POST["className"] == 'Staff') {
										
										
											   $frsttile = "SELECT `struff_present`.`StruffID`,`teachers_information`.`teachers_name`,`designation`,`mobile_no` FROM `struff_present`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
WHERE `struff_present`.`StruffID`='".$_POST["id"]."'";
									}else if($_POST["className"] == 'student') {
										
										
										  $frsttile = "SELECT `studentpresent`.`StudentID`,`student_personal_info`.`student_name`,`add_class`.`class_name`,`add_group`.`group_name`,
`running_student_info`.`class_roll` FROM `studentpresent` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group` ON `add_group`.`id`=`studentpresent`.`GroupID`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`studentpresent`.`StudentID` WHERE
`studentpresent`.`StudentID`='".$_POST["id"]."' AND `studentpresent`.`classID`='".$_POST["clsname"]."'";



										
										}
									
									$resultfrstt=$db->select_query($frsttile);
									
									if(count($resultfrstt) > 0){
											$fetchfrst=$resultfrstt->fetch_array();
									}
												  
					  ?>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>
										
										
										<?php
										
										if($_POST["className"] == 'teacher'){
										?>
										Teacher   attendance 
										
										<?php
										} else if($_POST["className"] == 'Staff'){
										?>
											Staff   attendance 

										<?php }
										?>
										
										Report
										
										
										
										</strong></span></td>
									</tr>
									<tr>
										<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:14px;"><strong>
										<?php
											if($_POST["className"] == 'teacher' or $_POST["className"] == 'Staff' ){
											?>
											
												 Name&nbsp;:&nbsp;<?php echo $fetchfrst['teachers_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Designation &nbsp;:&nbsp; <?php  echo  $fetchfrst['designation'] ?>  Mobile  No :  <?php  echo  $fetchfrst['mobile_no'] ?> 
												<?php 
											}else { ?> 
												Class Name&nbsp;:&nbsp;<?php echo $fetchfrst['class_name']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												 Group Name&nbsp;:&nbsp;<?php echo $fetchfrst['group_name']?> &nbsp;:&nbsp; Name : <?php echo $fetchfrst['student_name']?>  &nbsp;:&nbsp; Roll No : <?php echo $fetchfrst['class_roll']?>  
											
											<?php }
										?>
									
									
										
										
										
										
										</strong></span></td>
									</tr>
									
									<tr>
										<td colspan="6" align="center">&nbsp;<span class="text-success" style="font-size:15px;"><strong>Total   Attendance  &nbsp;</strong></span></td>
										<td  colspan="4" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Total   Absent   &nbsp;</strong></span></td>
  </tr>
									<tr>
											<td width="191"  height="21" align="center">&nbsp;
											<span class="text-success" style="font-weight:600">Total Days</span>
											</td>
											<td colspan="5"  align="left">&nbsp;
										<span class="text-success" style="font-weight:600">	<?php
													if($_POST["className"] == 'teacher'){
													
												  	 $totaldays = "SELECT * FROM `teacherpresent` WHERE   SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
													$totaldays = "SELECT * FROM `struff_present` WHERE SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";
													
													
												
												}else{
												$totaldays = "SELECT * FROM `studentpresent` WHERE SUBSTR(`date`,7,4)='".$_POST["year"]."'  GROUP BY  SUBSTR(`date`,1,2)";   }
												
												$resultttlday = $db->select_query($totaldays);
												echo $resultttlday->num_rows;	
											
											?>
											</span>
											</td>
											<td width="59" align="center"><strong><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Absent</span></strong></td>
											<td width="407" colspan="2"  align="left"><span class="text-danger" style="font-weight:600">
											
												
											
											
											<?php
													if($_POST["className"] == 'teacher'){
													
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `absent`='1'   AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `absent`='1' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
											
											
													
													
												
												}else{
												
												
													  $totalabsent = "SELECT SUM(`absent`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `absent`='1' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
												}
												
												$resultabsent = $db->select_query($totalabsent)->fetch_array();
												echo $resultabsent[0];
											
											?>
											
											
											
											
											</span></td>
									</tr>
									<tr>
											<td height="21"  align="center"><span class="text-success" style="font-weight:600">Total Attendance</span></td>
											<td colspan="5"  align="left"><span class="text-success" style="font-weight:600">
											  <?php
												if($_POST["className"] == 'teacher'){
													
													
													
												 	$totaatten = "SELECT SUM(`present`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `present`='1'  AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
													 $totaatten = "SELECT SUM(`present`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."'  AND `present`='1'  AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
													
												
												}else{
												 $totaatten = "SELECT SUM(`present`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."'  AND `present`='1'  AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
												}
												
												
												$resulttota = $db->select_query($totaatten)->fetch_array();
												echo $resulttota[0];
											
											?>
											
											
											
											
											
											
											</span></td>
											<td  align="center"><span class="text-danger" style="font-weight:600"><span class="text-danger" style="font-weight:600">Vacation</span></span></td>
											<td><span class="text-danger" style="font-weight:600">
											
										
											
											<?php
													if($_POST["className"] == 'teacher'){
													
													
													  $vacation = "SELECT SUM(`onvacation`) FROM `teacherpresent` WHERE `teacherID`='".$_POST["id"]."' AND `onvacation`='1' AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
											
											
													
													
												}else 	if($_POST["className"] == 'Staff'){
												
												
													  $vacation = "SELECT SUM(`onvacation`) FROM `struff_present` WHERE `StruffID`='".$_POST["id"]."' AND `onvacation`='1'  AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
											
													
												
												}else{
												
												
													  $vacation = "SELECT SUM(`onvacation`) FROM `studentpresent` WHERE `StudentID`='".$_POST["id"]."' AND `onvacation`='1'  AND SUBSTR(`date`,7,4)='".$_POST["year"]."'";
												
												}
												
												
												$resvacation = $db->select_query($vacation)->fetch_array();
												echo $resvacation[0];
											
											?>
											
											
										
										
										</span></td>
									</tr>

									</tr>
									
								
						  
						  <?php } else {?>
						   <tr>
							<td colspan="10" align="center">&nbsp;<span class="text-danger" style="font-size:15px;"><strong>Please Fill Up All fields...</strong></span></td>
						  </tr>
						  
						  <?php } ?>
						  <tr id="trNotprint">
							<td colspan="10" align="center">&nbsp;<input type="submit" value="Print" onclick="window.print()"/></td>
						  </tr>
						  </table>
					<?php
			}
?>