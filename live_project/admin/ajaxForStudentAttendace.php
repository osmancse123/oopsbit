<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
		
?>
<?php
		if(isset($_POST["morevalue"])){
	
			$gropuid=explode('and',$_POST["gruID"]);
				
?>
			 <table width="429" class="table table-bordered table-responsive" style="margin-top:0px;">
						<?php
								if(isset($_POST["classID"]) and $_POST["classID"] != "Select Class" and isset($_POST["gruID"]) and $_POST["gruID"]!="" ){
						?>
			
			
			<tr>
                <td colspan="6" align="left">
				
				<div class="col-md-6">
												<label>Attendance Message </label><br/>
					<textarea cols="30" name="attendancemsg"></textarea>	
				  </div>
									
									<div class="col-md-6">
								<label>Absence Message</label>	<br/><textarea cols="30" name="absencemsg"></textarea>	
									</div>
									
									
									
					
				
					
					
					
				</td>
              </tr>
			  
			  
			  		
              <tr>
                <td colspan="6" align="left">
				
				
				
				
				&nbsp;
			<select name="olddate" id="olddate" onchange="return showEditAttendance()"  style="width:180px; height:28px;">
					
						<option>Select One...</option>
						<?php
								$selecDAte="SELECT `date` FROM `studentpresent` GROUP BY `date` order by `date` DESC";
								$resultdate=$db->select_query($selecDAte);
									if($resultdate){
											while($fetchREsult=$resultdate->fetch_array()){
						
						?>
									<option><?php echo $fetchREsult["date"];?></option>
						<?php } }?>
				  </select>
					&nbsp; 
					<input type="button" value="submit" name="submit" id="submit" onclick="return showEditAttendance()"/>
					&nbsp; 
					<input type="submit" value="Clear" name="Clear" id="Clear"/>				</td>
              </tr>
              <tr>
                <td>&nbsp;<span class="text-danger"><strong>Date</strong></span></td>
                <td colspan="5">&nbsp;<input type="text" style="width:180px; height:28px;" name="daterunning" id="daterunning" value="<?php if(isset($_POST["submit"])){ echo $_POST["olddate"]; } else{ echo date('d-m-Y') ;}?>"/></td>
              </tr>
              <tr>
                <td width="86" rowspan="2" align="center"><strong>SL</strong></td>
                <td width="60" rowspan="2" align="center"><strong>Name</strong></td>
                <td width="33" rowspan="2" align="center"><strong>Roll No.</strong></td>
                <td width="76" align="center"><strong>Attendance</strong></td>
                <td colspan="2" align="center"><strong>Absence</strong></td>
              </tr>
              <tr>
                <td height="46" align="center"><strong>select All </strong><br/>
				
					<input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />				</td>
                <td width="65" align="center"><strong>Approved</strong></td>
                <td width="81" align="center"><strong>Unapproved</strong></td>
              </tr>
			  
			  <?php
			
			  		  $sql="SELECT `running_student_info`.`student_id`,`class_roll`,`student_personal_info`.`student_name`,`student_guardian_information`.`guardian_contact` 
FROM `running_student_info` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` 

INNER JOIN `student_guardian_information` ON `student_guardian_information`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='".$_POST["classID"]."' AND `running_student_info`.`group_id`='$gropuid[0]' 
 AND `running_student_info`.`class_roll` BETWEEN ".$_POST["from"]." AND ".$_POST["to"]."";
					
					

					$resultsql=$db->select_query($sql);
						if($resultsql){
						$sl=0;
								while($fetchSql=$resultsql->fetch_array()){
			  
			  			$sl++;
			  ?>
			  	<tr>
						<td align="center"><?php echo $sl;?></td>
						<td align="center"><?php echo $fetchSql["student_name"];?></td>
						<td  align="center"><?php echo $fetchSql["class_roll"];?></td>
						<td align="center"><input class="check_elmnt" type="checkbox" onClick="return singleChek('<?php echo  $fetchSql["student_id"];?>')" name="linkID[]" value="<?php echo  "$fetchSql[student_id]and$fetchSql[class_roll]and$fetchSql[guardian_contact]"?>" id="snchek-<?php echo $fetchSql["student_id"]?>"/>
						
						  <input type="hidden" name="contactno[]" value="<?php echo $fetchSql["guardian_contact"];?>" id="gcontac-<?php echo $fetchSql["student_id"]?>"  style="width:90px; text-align:center" />	
						
						
						
						  <input type="hidden" name="attnTime[]" value="<?php echo date('h'.':'.'m');?>" id="attnTime-<?php echo $fetchSql["student_id"]?>"  style="width:90px; text-align:center" />						  <input type="hidden" name="leavTime[]" id="leavTime-<?php echo $fetchSql["student_id"]?>"  style="width:90px;text-align:center"  /></td>
						<td align="center"><input type="checkbox" class="approved-<?php echo $fetchSql["student_id"]?>" id="group1" name="approved[]" value="<?php echo "$fetchSql[student_id]and$fetchSql[class_roll]";?>" onClick="return approvedFun('<?php echo $fetchSql["student_id"];?>')" /></td>
						<td align="center"><input type="checkbox" class="Unapproved-<?php echo $fetchSql["student_id"]?>" id="group2" name="unapproved[]" value="<?php echo "$fetchSql[student_id]and$fetchSql[class_roll]";?>" onClick="return UNapprovedFun('<?php echo $fetchSql["student_id"];?>')" /></td>
				</tr>
			  
			  <?php  } }
			 ?>
			 	<tr>
						<td align="right" colspan="6"><span id="sms"></span></td>
				</tr> 
			  <tr>
			  	<td colspan="6" align="center">
				
					<input type="button" name="adddata" id="adddata" value="Submit" onClick="return AddPresent()" />				</td>
			  </tr>
						<?php } else {?>
							<tr>
								<td align="right"><span class='text-center text-danger '><strong>&nbsp;Please Select Important Fields...</strong></span></td>
							</tr>
						<?php } ?>
</table>
<?php } 




	
function sender($url,$key,$mobile,$senderId,$sms)
{

	$data = json_encode(array('api_key' => $key,'type'=>'unicode', 'contacts' => $mobile,'senderid'=>$senderId, 'msg' => $sms));
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDpORXdRNXJRTw=="));
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
    $dd=curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //http_build_query($data). "\n";
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
}




		if(isset($_POST["addStudentDAta"]))		
	{
			$selectGroup=explode('and',$_POST["selectGroup"]);
		 	//print_r($selectGroup);
		  $seeTHisdayPresent="SELECT * FROM `studentpresent` WHERE  `classID`='".$_POST["selectClass"]."' and `GroupID`='$selectGroup[0]' and  `date`='".$_POST["daterunning"]."' AND `subjectID`='".$_POST["selectsubject"]."' AND `SubjectPartId`='".$_POST["selectSubPart"]."' AND `RollNo` BETWEEN ".$_POST["from"]." AND ".$_POST["to"]."";
			$resultpresetnt=$db->select_query($seeTHisdayPresent);
					@$countrows=$resultpresetnt->num_rows;
				if($countrows>0){
						print "<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Today's attendance was completed !!</strong></span>";
				}	
				else{
			if(!empty($_POST["linkID"])){
					for($x = 0;$x<count($_POST["linkID"]) ; $x++){
							 $ecploda=explode('and',$_POST["linkID"][$x]);
							 $insertQUery="INSERT INTO `studentpresent` (`slNo`,`date`,`RollNo`,`StudentID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`,`classID`,`GroupID`,`subjectID`,`SubjectPartId`) VALUES ('0','".$_POST["daterunning"]."','$ecploda[1]','$ecploda[0]','1','0','0','".$_POST["attnTime"][$x]."','".$_POST["leavTime"][$x]."','".$_POST["selectClass"]."','$selectGroup[0]','".$_POST["selectsubject"]."','".$_POST["selectSubPart"]."')";
							$db->insert_query($insertQUery);
							
							if($_POST["attendancemsg"] != ""){
									


$stdMobileNo="SELECT `guardian_contact` FROM `student_guardian_information` WHERE `id`='$ecploda[0]'";
$query=	$db->link->query($stdMobileNo);
$fetch_num=$query->fetch_array();


									$key='R60002955aeb2527c26bd5.91135862';
									 $mobile  ='88'.$fetch_num[0]; //Receiver's country code+number
									echo $mobile;
									$senderId='8804445629106';// sender id number
									$sms=$_POST["attendancemsg"]; //Double quotes are good for new line characters e.g. \n
									//$sms = urlencode($sms); //Very Important Otherwise spaces shall not be parsed correctly
									ini_set('allow_url_fopen',1);
									$url = "http://users.sendsmsbd.com/smsapi?";
									$succ=sender($url,$key,$mobile,$senderId,$sms);



							
     

									
							}
					}
			}
			if(!empty($_POST["approved"])){
					for($z = 0;$z<count($_POST["approved"]) ; $z++){
					$ecplodaapp=explode('and',$_POST["approved"][$z]);
							$insertQUery="INSERT INTO `studentpresent` (`slNo`,`date`,`RollNo`,`StudentID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`,`classID`,`GroupID`,`subjectID`,`SubjectPartId`) VALUES ('0','".$_POST["daterunning"]."','$ecplodaapp[1]','$ecplodaapp[0]','0','0','1','0:00','0:00','".$_POST["selectClass"]."','$selectGroup[0]','".$_POST["selectsubject"]."','".$_POST["selectSubPart"]."')";
							$db->insert_query($insertQUery);
							
							if($_POST["absencemsg"] != ""){
									
										
$stdMobileNo="SELECT `guardian_contact` FROM `student_guardian_information` WHERE `id`='$ecplodaapp[0]'";
$query=	$db->link->query($stdMobileNo);
$fetch_num=$query->fetch_array();
								
									$key='R60002955aeb2527c26bd5.91135862';
									 $mobile  ='88'.$fetch_num[0]; //Receiver's country code+number
									$senderId='8804445629106';// sender id number
									$sms=$_POST["attendancemsg"]; //Double quotes are good for new line characters e.g. \n
									//$sms = urlencode($sms); //Very Important Otherwise spaces shall not be parsed correctly
									ini_set('allow_url_fopen',1);
									$url = "http://users.sendsmsbd.com/smsapi?";
									$succ=sender($url,$key,$mobile,$senderId,$sms);

     

									
							}
					}
			}
			if(!empty($_POST["unapproved"])){
				for($c = 0;$c<count($_POST["unapproved"]) ; $c++){
				$ecplodaUpp=explode('and',$_POST["unapproved"][$c]);
							 $insertQUery="INSERT INTO `studentpresent` (`slNo`,`date`,`RollNo`,`StudentID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`,`classID`,`GroupID`,`subjectID`,`SubjectPartId`) VALUES ('0','".$_POST["daterunning"]."','$ecplodaUpp[1]','$ecplodaUpp[0]','0','1','0','0:00','0:00','".$_POST["selectClass"]."','$selectGroup[0]','".$_POST["selectsubject"]."','".$_POST["selectSubPart"]."')";
							$db->insert_query($insertQUery);
							
								if($_POST["absencemsg"] != ""){
									
										$stdMobileNo="SELECT `guardian_contact` FROM `student_guardian_information` WHERE `id`='$ecplodaUpp[0]'";
$query=	$db->link->query($stdMobileNo);
$fetch_num=$query->fetch_array();
								
								
									$key='R60002955aeb2527c26bd5.91135862';
									 $mobile  ='88'.$fetch_num[0]; //Receiver's country code+number
									$senderId='8804445629106';// sender id number
									$sms=$_POST["attendancemsg"]; //Double quotes are good for new line characters e.g. \n
									//$sms = urlencode($sms); //Very Important Otherwise spaces shall not be parsed correctly
									ini_set('allow_url_fopen',1);
									$url = "http://users.sendsmsbd.com/smsapi?";
									$succ=sender($url,$key,$mobile,$senderId,$sms);
     

									
							}
					}
			}
			if(isset($db->sms)){
				echo $db->sms;
			}
			}
	}
	
	if(isset($_POST["updateValue"])){
			$selectGroup = explode('and',$_POST["selectGroup"]);
		if(!empty($_POST["linkID"])){
					for($x = 0;$x<count($_POST["linkID"]) ; $x++){
				 	$explodea=explode('and',$_POST["linkID"][$x]);
					
							   $insertQUery="UPDATE `studentpresent` SET `present`='1',`onvacation`='0',`absent`='0',`comming_time`='".$_POST["attnTime"][$x]."',`goingTime`='".$_POST["leavTime"][$x]."' WHERE  `classID`='".$_POST["selectClass"]."' and `GroupID`='$selectGroup[0]' and  `date`='".$_POST["daterunning"]."' AND `subjectID`='".$_POST["selectsubject"]."' AND `SubjectPartId`='".$_POST["selectSubPart"]."' AND `StudentID`='".$explodea[0]."'";
							
							$db->update_query($insertQUery);
					}
			}
			if(!empty($_POST["approved"])){
					for($z = 0;$z<count($_POST["approved"]) ; $z++){
					$explodeApp=explode('and',$_POST["approved"][$z]);
							 $insertQUery="UPDATE `studentpresent` SET `present`='0',`onvacation`='1',`absent`='0',`comming_time`='0:00',`goingTime`='0:00' WHERE `classID`='".$_POST["selectClass"]."' and `GroupID`='$selectGroup[0]' and  `date`='".$_POST["daterunning"]."' AND `subjectID`='".$_POST["selectsubject"]."' AND `SubjectPartId`='".$_POST["selectSubPart"]."'  AND `StudentID`='".$explodeApp[0]."'";
							$db->update_query($insertQUery);
					}
			}
			if(!empty($_POST["unapproved"])){
				for($c = 0;$c<count($_POST["unapproved"]) ; $c++){
				$explodeUN=explode('and',$_POST["unapproved"][$c]);
							  $insertQUery="UPDATE `studentpresent` SET `present`='0',`onvacation`='0',`absent`='1',`comming_time`='0:00',`goingTime`='0:00' WHERE  `classID`='".$_POST["selectClass"]."' and `GroupID`='$selectGroup[0]' and  `date`='".$_POST["daterunning"]."' AND `subjectID`='".$_POST["selectsubject"]."' AND `SubjectPartId`='".$_POST["selectSubPart"]."' AND `StudentID`='".$explodeUN[0]."'";
							$db->update_query($insertQUery);
					}
			}
			if(isset($db->sms)){
				echo $db->sms;
			}
	}
	
	if(isset($_POST["showdAtaForEdit"])){
$gropuid=explode('and',$_POST["selectGroup"]);
				
?>
			 <table width="425" class="table table-bordered table-responsive" style="margin-top:0px;">
											
              <tr>
                <td colspan="6" align="left">&nbsp;
			<select name="olddate" id="olddate" onchange="return showEditAttendance()"  style="width:180px; height:28px;">
					
						<option>Select One...</option>
						<?php
								$selecDAte="SELECT `date` FROM `studentpresent` GROUP BY `date` order by `date` DESC";
								$resultdate=$db->select_query($selecDAte);
									if($resultdate){
											while($fetchREsult=$resultdate->fetch_array()){
						
						?>
									<option ><?php echo $fetchREsult["date"];?></option>
						<?php } }?>
				  </select>
					&nbsp; 
					<input type="button" value="submit" name="submit" id="submit"  onclick="return showEditAttendance()"/>
					&nbsp; 
					<input type="submit" value="Clear" name="Clear" id="Clear"/>				</td>
              </tr>
              <tr>
                <td>&nbsp;<span class="text-danger"><strong>Date</strong></span></td>
                <td colspan="5">&nbsp;<input type="text" style="width:180px; height:28px;" name="daterunning" id="daterunning" value="<?php echo $_POST["olddate"];?>"/></td>
              </tr>
              <tr>
                <td width="37" rowspan="2" align="center"><strong>SL</strong></td>
                <td width="40" rowspan="2" align="center"><strong>Name</strong></td>
                <td width="32" rowspan="2" align="center"><strong>Roll No.</strong></td>
                <td width="76" align="center"><strong>Attendance</strong></td>
                <td colspan="2" align="center"><strong>Absence</strong></td>
              </tr>
              <tr>
                <td height="46" align="center"><strong>select  </strong><br/>				</td>
                <td width="65" align="center"><strong>Approved</strong></td>
                <td width="147" align="center"><strong>Unapproved</strong></td>
              </tr>
			  
			  <?php
			
			  		   $sql="SELECT `studentpresent`.*,`student_personal_info`.`student_name` FROM `studentpresent` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`studentpresent`.`StudentID`
WHERE `studentpresent`.`date`='".$_POST["olddate"]."' AND `studentpresent`.`classID`='".$_POST["selectClass"]."' AND `studentpresent`.`GroupID`='$gropuid[0]' AND `studentpresent`.`subjectID`='".$_POST["selectsubject"]."' AND `studentpresent`.`SubjectPartId`='".$_POST["selectSubPart"]."' and   `studentpresent`.`RollNo` BETWEEN ".$_POST["from"]." AND ".$_POST["to"]." ORDER BY `studentpresent`.`RollNo` ASC";
					$resultsql=$db->select_query($sql);
						if($resultsql){
						$sl=0;
								while($fetchSql=$resultsql->fetch_array()){
			  
			  			$sl++;
			  ?>
			  	<tr>
						<td align="center"><?php echo $sl;?></td>
						<td align="center"><?php echo $fetchSql["student_name"];?></td>
						<td  align="center"><?php echo $fetchSql["RollNo"];?></td>
						<td align="center"><input class="check_elmnt" type="checkbox" onClick="return singleChek('<?php echo  $fetchSql["StudentID"];?>')" name="linkID[]" value="<?php echo  "$fetchSql[StudentID]and$fetchSql[RollNo]"?>" id="snchek-<?php echo $fetchSql["StudentID"]?>" 
						<?php if($fetchSql["present"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?>
						
						/>
						
						  <input type="hidden" name="attnTime[]" value="<?php echo date('h'.':'.'m');?>" id="attnTime-<?php echo $fetchSql["StudentID"]?>"  style="width:90px; text-align:center" />						  <input type="hidden" name="leavTime[]" id="leavTime-<?php echo $fetchSql["StudentID"]?>"  style="width:90px;text-align:center"  /></td>
						<td align="center"><input type="checkbox" class="approved-<?php echo $fetchSql["StudentID"]?>" id="group1" name="approved[]" value="<?php echo "$fetchSql[StudentID]and$fetchSql[RollNo]";?>" onClick="return approvedFun('<?php echo $fetchSql["StudentID"];?>')"
						
						<?php if($fetchSql["onvacation"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?>
						
						 /></td>
						<td align="center"><input type="checkbox" class="Unapproved-<?php echo $fetchSql["StudentID"]?>" id="group2" name="unapproved[]" value="<?php echo "$fetchSql[StudentID]and$fetchSql[RollNo]";?>" onClick="return UNapprovedFun('<?php echo $fetchSql["StudentID"];?>')"
						<?php if($fetchSql["absent"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?>
						
						 /></td>
				</tr>
			  
			  <?php  } }  ?>
			 	<tr>
						<td align="right" colspan="6"><span id="UpdateMas"></span></td>
				</tr> 
			  <tr>
			  	<td colspan="6" align="center">
				
					<input type="button" name="adddata" id="adddata" value="Update" onClick="return UpdatePreset()" />				</td>
			  </tr>
</table>


<?php } ?>