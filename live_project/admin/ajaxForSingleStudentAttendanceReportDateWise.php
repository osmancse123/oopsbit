<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			

?>

<table class="table table-bordered table-responsive" style="margin-top:0px; margin-bottom:0px">
		<?php
				if(isset($_POST["selectClass"]) and $_POST["selectClass"] !="Select Class" and isset($_POST["selectGroup"]) and $_POST["selectGroup"] !="" and isset($_POST["selectsubject"]) and $_POST["selectsubject"] !="" and  isset($_POST["stdId"]) and $_POST["stdId"] !="" and $_POST["fromdate"] !="" and  isset($_POST["fromdate"]) and $_POST["todate"] !="" and isset($_POST["todate"])){
				$groupId=explode('and',$_POST["selectGroup"]);
			if($_POST["selectSubPart"] != "NULL"){
				 $sql="SELECT `studentpresent`.*,`student_personal_info`.`student_name` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
WHERE `studentpresent`.`StudentID`='".$_POST["stdId"]."' AND `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$groupId[0]' AND `studentpresent`.`date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'
AND `studentpresent`.`subjectID`='".$_POST["selectsubject"]."' AND `studentpresent`.`SubjectPartId`='".$_POST["selectSubPart"]."' GROUP BY `studentpresent`.`StudentID` ";
		}else{
		
			  $sql="SELECT `studentpresent`.*,`student_personal_info`.`student_name` FROM `studentpresent`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
WHERE `studentpresent`.`StudentID`='".$_POST["stdId"]."' AND `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$groupId[0]' AND `studentpresent`.`date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'
 AND `studentpresent`.`subjectID`='".$_POST["selectsubject"]."' GROUP BY `studentpresent`.`StudentID` ";
			
			}
			$resultSql=$db->select_query($sql);
			@$counSql=$resultSql->num_rows;
				if($counSql > 0){
						$resultFetch=$resultSql->fetch_array();
						
		?>
		<tr>
		<?php
		if($_POST["selectSubPart"] == "NULL"){
							   $colspan="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `subjectID`='".$_POST["selectsubject"]."' AND `date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'";
							 }
							 else{
							   $colspan="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `subjectID`='".$_POST["selectsubject"]."' and  `SubjectPartId`='".$_POST["selectSubPart"]."' AND `date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'";
							 
							 }
							 $ResultColspan=$db->select_query($colspan);
							 
							 @$counRowSS=$ResultColspan->num_rows;
							
		
					$forfrstd=6;
					$forSubject=4;
					 $forName=2;
					
					 $forPartName=4;
					if($counRowSS>0){
										  $forfrstd=$forfrstd+$counRowSS;
										  $forSubject=$forSubject+$counRowSS;
										   $forName= $forName;
										   
											
									}
								
		?>
				<td colspan="<?php echo $forfrstd;?>" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" >From &nbsp;<?php echo $_POST["fromdate"]?>&nbsp;  To &nbsp<?php echo $_POST["todate"]?>&nbsp; Date List of Student's Attendance</strong></span></td>
		</tr>
		<tr>
		<?php
		
				$ForClsAndGrop="SELECT `studentpresent`.`classID`,`add_class`.`class_name`,`add_group`.`group_name` FROM `studentpresent`
INNER JOIN `add_class` ON `add_class`.`id`=`studentpresent`.`classID` INNER JOIN `add_group`
ON `add_group`.`id`=`studentpresent`.`GroupID` WHERE `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$groupId[0]'
GROUP BY `studentpresent`.`GroupID`";
				$ResultForcls=$db->select_query($ForClsAndGrop);
					if($ResultForcls->num_rows>0){
							$FetchForClss=$ResultForcls->fetch_array();
					}
		?>
		<td colspan="<?php echo $forfrstd;?>" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" >Class Name &nbsp;:
		
		&nbsp;<?php 
				if(isset($ResultForcls)){ echo $FetchForClss["class_name"];} else {echo "";}
		?>&nbsp;  Group Name &nbsp: &nbsp;<?php 
				if(isset($ResultForcls)){ echo $FetchForClss["group_name"];} else {echo "";}
		?> &nbsp; </strong></span></td>
		
			</tr>
		<tr>
				<td colspan="<?php echo  $forName;?>">&nbsp; &nbsp; &nbsp;<span class="text-justify text-success" style="font-size:15px; font-weight:bold">Name &nbsp;: &nbsp;
					<?php 
						if(isset($resultSql)){ echo $resultFetch["student_name"];} else {echo "";}
					?>
				</span></td>
				<td colspan="<?php echo $forSubject;?>">&nbsp; &nbsp; &nbsp;<span class="text-justify text-success" style="font-size:15px; font-weight:bold">Subject Name &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
					<?php 
						if($_POST["selectSubPart"] == "NULL" or $_POST["selectSubPart"] != "NULL"){
									$subjectName="SELECT * FROM `add_subject_info` WHERE `id`='".$_POST["selectsubject"]."'";
									$resultName=$db->select_query($subjectName);
									if(@$resultName->num_rows > 0){
											$fetchName=$resultName->fetch_array();
											echo $fetchName["subject_name"]; 
									}else {
									
										echo $fetchName["subject_name"]="";
									}
							}
					?>
				</span></td>
		</tr>
		<tr>
		
				<td colspan="<?php echo  $forName;?>">&nbsp; &nbsp; &nbsp;<span class="text-justify text-success" style="font-size:15px; font-weight:bold">Roll &nbsp; &nbsp;  : &nbsp; &nbsp;<?php
				
						if(isset($resultSql)){ echo $resultFetch["RollNo"];} else {echo "";}
				?></span></td>
				<td colspan="<?php echo $forSubject;?>"><?php if($_POST["selectSubPart"] != "NULL"){
				
						$selectSubjectPartName="SELECT * FROM `add_subject_part_info` WHERE `subject_name`='".$_POST["selectsubject"]."' AND `part_id`='".$_POST["selectSubPart"]."'";
							$resultSubjectpartName=$db->select_query($selectSubjectPartName);
								if(@$resultSubjectpartName->num_rows > 0){
								?>
									&nbsp; &nbsp; &nbsp;<span class="text-justify text-success" style="font-size:15px; font-weight:bold">Subject Part Name &nbsp; &nbsp; : &nbsp; &nbsp;
								<?php
										$fetSubjectPartName=$resultSubjectpartName->fetch_array();
										echo $fetSubjectPartName["subject_part_name"];
								}
								else {
									echo $fetSubjectPartName["subject_part_name"]="";
								}
				
				}
				
				?>
				
				
				</span></td>
		</tr>
		
		
		
		<tr>
				<td height="21" colspan="<?php echo $forName ?>" align="center">&nbsp;Serial No</td>
			<?php 
					if($_POST["selectSubPart"] == "NULL"){
					   $sqlFroserial="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `subjectID`='".$_POST["selectsubject"]."' AND `date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'";
					 }
					 else{
					    $sqlFroserial="SELECT * FROM `studentpresent` WHERE `StudentID`='".$_POST["stdId"]."' AND `classID`='".$_POST["selectClass"]."' AND `GroupID`='$groupId[0]' AND `subjectID`='".$_POST["selectsubject"]."' and  `SubjectPartId`='".$_POST["selectSubPart"]."' AND `date` BETWEEN '".$_POST["fromdate"]."' AND '".$_POST["todate"]."'";
					 
					 }
					 $resultForSerial=$db->select_query( $sqlFroserial);
					  $countRows= $resultForSerial->num_rows;
					if(@$countRows>0){
					$sl=0;
					 while($fetchForserail= $resultForSerial->fetch_array()){
					 $sl++;
					 			?>
			
				<td width="109" align="center"><?php echo $sl;?></td>
				
				<?php  } } ?>
				<td width="80" rowspan="2" align="center">Total</td>
		</tr>
	<tr>
				<td height="21" colspan="<?php echo $forName;?>" align="center">&nbsp;date</td>
				<?php
						$forDate=$db->select_query($sqlFroserial);
						@$CountDate=$forDate->num_rows;
							if($CountDate>0){
									while($fetDate=$forDate->fetch_array()){
				?>
				
				<td width="109" align="center"><?php echo $fetDate["date"];?></td>
				
				<?php } }?>
  </tr>
		
		<tr>
			<td width="518" rowspan="2" align="center"><br/>
		    Absance</td>
				<td width="246" align="center">Approved</td>
					
					
				<?php
				
				
						$resulforonvacation=$db->select_query($sqlFroserial);
								if($resulforonvacation->num_rows>0){	
								$total=0;
									while($fetchForonvacation=$resulforonvacation->fetch_array()){
										
				?>
					<td align="center">&nbsp;
							<?php 
									if($fetchForonvacation["onvacation"]==='1'){
									$total=$total+1;
							?>
							
							<span class='text-center text-success glyphicon glyphicon-ok'></span>
							<?php } else {?>
							<span class='text-center text-danger glyphicon glyphicon-remove'></span>
							<?php } ?>
					</td>
					<?php } } ?>
					<td align="center">&nbsp;<?php echo $total;?></td>
		</tr>
		
		<tr>
			<td align="center">Unapproved</td>
					<?php
						$resultForUnapproved=$db->select_query($sqlFroserial);
								if($resultForUnapproved->num_rows>0){	
								$totalun=0;
									while($fetchForUnapp=$resultForUnapproved->fetch_array()){
										
									//	print_r($fetchForUnapp);
										
				?>
					
					<td align="center">&nbsp;
					<?php 
									if($fetchForUnapp["absent"]==='1'){
									$totalun=$totalun+1;
							?>
							
							<span class='text-center text-success glyphicon glyphicon-ok'></span>
							<?php } else {?>
							<span class='text-center text-danger glyphicon glyphicon-remove'></span>
							<?php } ?>
					</td>
					
					<?php } }?>
					
					<td align="center">&nbsp;<?php echo $totalun;?></td>
		</tr>
			<tr>
			<td colspan="2" align="center">Attendance</td>
				<?php
						$resultForPresnt=$db->select_query($sqlFroserial);
								if($resultForPresnt->num_rows>0){	
								$totalPre=0;
									while($fethForpresnt=$resultForPresnt->fetch_array()){
										
									//	print_r($fetchForUnapp);
										
				?>
			
				<td align="center">&nbsp;
				<?php 
									if($fethForpresnt["present"]==='1'){
									$totalPre=$totalPre+1;
							?>
							
							<span class='text-center text-success glyphicon glyphicon-ok'></span>
							<?php } else {?>
							<span class='text-center text-danger glyphicon glyphicon-remove'></span>
							<?php } ?>
				</td>
				
				<?php } }?>
					<td align="center">&nbsp;
							<?php echo $totalPre;?>
					</td>
		</tr>
		<tr id="dont">
				<td colspan="<?php echo $forSubject;?>" align="center">
					<input type="button" name="print" value="Print" onclick="window.print()"/>
				</td>
		</tr>
		<?php } else {?>
		<tr>
				<td colspan="6" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >This is Student Not Found..</strong></span></td>
		</tr>
		
		
		<?php  } } else {?>
		<tr>
				<td colspan="6" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >Please Fill Up Important Fields..</strong></span></td>
		</tr>
		<?php } ?>
</table>
