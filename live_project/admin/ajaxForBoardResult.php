 <?php

	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
		$id=$db->autogenerat('boardexamresult','boardResultID','BRD-','10');

	if(isset($_GET["id"])){
			$sql="SELECT * FROM `boardexamresult` GROUP BY `Title` ASC";
			$resultSql=$db->select_query($sql);
			
			if($resultSql){
				
				
			?>
				<table width="67%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="9">
								
									<input type="button" onclick="return creatAdmin()" class="btn btn-success btn-sm" style="width:120px;" value="Create" />
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Represh" />								</td>
							</tr>
							<?php 
									while($fetchSql=$resultSql->fetch_array()){
							?>
							<tr>
								<td colspan="9" align="center"><strong><span><?php echo $fetchSql["Title"];?></span></strong></td>
							</tr>
								<?php 
										$sqlsession="SELECT * FROM `boardexamresult` WHERE `Title`='".$fetchSql["Title"]."' GROUP BY `Session` ORDER BY `Session` DESC";
										$resultSession=$db->select_query($sqlsession);
											if($resultSession){
													while($fetchResult=$resultSession->fetch_array()){
								?>
									<tr>
											<td colspan="9" align="center"><strong><span><?php echo $fetchResult["Session"];?></span></strong></td>
									</tr>	
									
										<tr align="center">
											<td width="10%">Select One</td>
											<td width="15%">Student ID</td>
											<td width="15%">Name</td>
											<td width="15%">Type</td>
											<td width="12%">Year</td>
											<td width="16%">Group Name</td>
											<td width="13%">Roll No</td>
											<td width="18%">Reg No</td>
											<td width="16%">GPA</td>
										</tr>
										
										<?php 
											$sqlForAll="SELECT * FROM `boardexamresult` WHERE `Title`='".$fetchResult["Title"]."' AND `Session`='".$fetchResult["Session"]."'";
											$resulForAll=$db->select_query($sqlForAll);
											if($resulForAll){
												while($fetchforAll=$resulForAll->fetch_array()){
										?>
										<tr align="center">
											<td width="10%">
											
													<input type="checkbox" class="chek" name="chek[]" value="<?php echo $fetchforAll["boardResultID"];?>" />
											</td>
											<?php
												 $name = "SELECT `student_name` FROM `student_personal_info` WHERE `id`='".$fetchforAll["StudentId"]."'";
												$restulNam = $db->select_query($name);
													if($restulNam->num_rows > 0){
														$fetchNam = $restulNam->fetch_array();
													}else{
															 $nameold = "SELECT `StudentName` FROM `exstudentreport` WHERE `Id`='".$fetchforAll["StudentId"]."'";
															$resultold = $db->select_query($nameold);
																if($resultold->num_rows > 0 ){
																$fetchNam = $resultold->fetch_array();
																}
													
													}
											?>
											
											<td width="15%"><?php echo $fetchforAll["StudentId"]; ?></td>
											<td width="15%"><?php echo $fetchNam[0]; ?></td>
											<td width="15%"><?php echo $fetchforAll["type"]; ?></td>
											<td width="12%"><?php echo $fetchforAll["year"]; ?></td>
											<td width="16%"><?php if($fetchforAll["GroupName"]!="Select One"){echo $fetchforAll["GroupName"];} else {echo "---------";} ?></td>
											<td width="13%"><?php echo $fetchforAll["RollNo"]; ?></td>
											<td width="18%"><?php echo $fetchforAll["RegNo"]; ?></td>
											<td width="16%"><?php echo $fetchforAll["GPA"]; ?></td>
										</tr>
							<?php } } } } }  ?>
						
							
					
			
</table>
					<?php
					
			}
			 else {?>
				<table width="50%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="6">
								
									<input type="button" onclick="return creatAdmin()" class="btn btn-success btn-sm" style="width:120px;" value="Add" />
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Represh" />								</td>
							</tr>
				</table>
			
<?php }  }
		
		?>
		
		<?php if(isset($_POST["Notid"])){
		
			?>
					<div class="col-md-10 col-md-offset-1">
							<table class="table table-responsive table-hover table-bordered "> 
									<tr>
											<td colspan="4" align="center"><strong class="text-success" style="font-size:15px; ">Board Exam Result</strong></td>
									</tr>
									
									<tr>
									    
											<td>Type</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="xx" name="xx" class="form-control">																<option>General</option>
															
															<option>Vocational</option>
													</select>
											  </div>
											</td>
									</tr>
									
									
									<tr>
									    
											<td>Title</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Title" name="Title" class="form-control">														<optgroup label="Select Title">			<option>SSC</option>
														<option>HSC</option>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Group /Subject</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
											    
											    <input type="text" id="Group" name="Group" class="form-control" />
												
											  </div>
											</td>
									</tr>
									<tr>
										<td>Session</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" id="Session" name="Session" class="form-control">																		
													
													
													
												
											  </div>
											</td>
									</tr>
									<tr>
										<td>Year</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
												<input type="text" name="Year" class="form-control">																		
														
											  </div>
											</td>
									</tr>
									<tr>
										<td>Type</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Type" name="Type" class="form-control">																		
														<optgroup label="Select One">
															<option>Regular</option>
															<option>Irregular</option>
																<option>Private</option>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Student ID</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="StudentID" id="StudentID" placeholder="Student ID.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Roll No</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="RollNO" id="RollNO" placeholder="Roll NO.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Reg No</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="RegNo" id="RegNo" placeholder="Reg No.." />
											  </div>
											</td>
									</tr>
										<tr>
										<td>GPA</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="GPA" id="GPA" placeholder="GPA.." />
											  </div>
											</td>
									</tr>
										<tr>
										<td>Village</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="v" id="v"  />
											  </div>
											</td>
									</tr>
									<tr>
										<td>PO</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="p" id="p"  />
											  </div>
											</td>
									</tr>
									
									<tr>
										<td>Upazilla</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="u" id="u"  />
											  </div>
											</td>
									</tr>
										<tr>
										<td>District </td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="d" id="d"  />
											  </div>
											</td>
									</tr>
									
										<tr>
										
											<td colspan="3" align="right">
													<span id="msgShow"></span>
											</td>
									</tr>
										<tr>
										
											<td colspan="3" align="center">
													<input type="button" value="Save" class="btn btn-sm btn-success" onclick="return ResultAdd()" style="width:120px;"/>
													<input type="button" value="Show All" class="btn btn-sm btn-success" onclick="return selectAll()" style="width:120px;"/>
											</td>
									</tr>
		</table>
			<?php
		}
			if(isset($_POST["chekId"])){
			
					if(!empty($_POST["title"]) && isset($_POST["title"]) && !empty($_POST["type"]) && isset($_POST["type"]) && !empty($_POST["studentID"]) && isset($_POST["studentID"]) && !empty($_POST["RollNO"]) && isset($_POST["RollNO"])
						&& !empty($_POST["session"]) && isset($_POST["session"]) && !empty($_POST["Year"]) && isset($_POST["Year"])  
					&& !empty($_POST["gpa"]) && isset($_POST["gpa"])){
							
							
							$sqlChek="SELECT * FROM `running_student_info` WHERE `student_id`='".$_POST["studentID"]."'";
							$resulChek=$db->select_query($sqlChek);
							if($resulChek){
							
							$insertBoardResult="INSERT INTO `boardexamresult` (`boardResultID`,`type`,`Title`,`GroupName`,`Session`,`year`,`StudentId`,`RollNo`,`RegNo`,`GPA`) VALUES ('$id','".$_POST["type"]."','".$_POST["title"]."','".$_POST["group"]."','".$_POST["session"]."','".$_POST["Year"]."','".$_POST["studentID"]."','".$_POST["RollNO"]."','".$_POST["regNo"]."','".$_POST["gpa"]."')";
								$result=$db->insert_query($insertBoardResult);
									if(isset($db->sms)){
										print $db->sms;
									}
							$id=$db->autogenerat('boardexamresult','boardResultID','BRD-','10');
						}else{
							$sqlChek="SELECT * FROM `exstudentreport` WHERE `Id`='".$_POST["studentID"]."'";
							$resulChek=$db->select_query($sqlChek);
							if($resulChek){
							
							$insertBoardResult="INSERT INTO `boardexamresult` (`boardResultID`,`type`,`Title`,`GroupName`,`Session`,`year`,`StudentId`,`RollNo`,`RegNo`,`GPA`) VALUES ('$id','".$_POST["type"]."','".$_POST["title"]."','".$_POST["group"]."','".$_POST["session"]."','".$_POST["Year"]."','".$_POST["studentID"]."','".$_POST["RollNO"]."','".$_POST["regNo"]."','".$_POST["gpa"]."')";
								$result=$db->insert_query($insertBoardResult);
									if(isset($db->sms)){
										print $db->sms;
									}
							$id=$db->autogenerat('boardexamresult','boardResultID','BRD-','10');
						}
					} } else {
							
							print "<span class='text-center  text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up Important Fields..</strong></span>";
					}
					
			}
			
			
		if(isset($_POST["dchekid"]))
		{
			 $countSelect=count($_POST["chekvalue"]);
			
			for($x = 0; $x < $countSelect; $x++){
				  $delet_query="DELETE FROM `boardexamresult` WHERE `boardResultID`='".$_POST["chekvalue"][$x]."'";
				 $db->delete_query($delet_query);
				 		
					
			}
		}
		
		
		
		
		
		
		
			
		
			
 ?>
 
 
 
 
 <?php
 
 
 if(isset($_GET["staticid"])){
			$sql="SELECT * FROM `statictestomonialinfo` GROUP BY `Title` ASC";
			$resultSql=$db->select_query($sql);
			
			if($resultSql){
				
				
			?>
				<table width="62%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="10">
								
									<input type="button" onclick="return creatAdmin()" class="btn btn-success btn-sm" style="width:120px;" value="Creat" />
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Represh" />								</td>
							</tr>
							<?php 
									while($fetchSql=$resultSql->fetch_array()){
							?>
							<tr>
								<td colspan="10" align="center"><strong><span><?php echo $fetchSql["Title"];?></span></strong></td>
							</tr>
								<?php 
										$sqlsession="SELECT * FROM `statictestomonialinfo` WHERE `Title`='".$fetchSql["Title"]."' GROUP BY `Session` ORDER BY `Session` DESC";
										$resultSession=$db->select_query($sqlsession);
											if($resultSession){
													while($fetchResult=$resultSession->fetch_array()){
								?>
									<tr>
											<td colspan="10" align="center"><strong><span><?php echo $fetchResult["Session"];?></span></strong></td>
									</tr>	
									
										<tr align="center">
											<td width="6%">Select One</td>
											<td width="10%">Student ID</td>
											<td width="13%">Name</td>
											<td width="7%">Type</td>
											<td width="11%">Year</td>
											<td width="11%">Group Name</td>
											<td width="6%">Roll No</td>
											<td width="12%">Reg No</td>
											<td width="7%">GPA</td>
											<td width="17%">Action</td>
										</tr>
										
										<?php 
											$sqlForAll="SELECT * FROM `statictestomonialinfo` WHERE `Title`='".$fetchResult["Title"]."' AND `Session`='".$fetchResult["Session"]."'";
											$resulForAll=$db->select_query($sqlForAll);
											if($resulForAll){
												while($fetchforAll=$resulForAll->fetch_array()){
										?>
										<tr align="center">
											<td width="6%">
											
													<input type="checkbox" class="chek" name="chek[]" value="<?php echo $fetchforAll["boardResultID"];?>" />
										  </td>
									
									
											<td width="10%"><?php echo $fetchforAll["boardResultID"]; ?></td>
											<td width="13%"><?php echo $fetchforAll["studentName"]; ?></td>
											<td width="7%"><?php echo $fetchforAll["type"]; ?></td>
											<td width="11%"><?php echo $fetchforAll["year"]; ?></td>
											<td width="11%"><?php if($fetchforAll["GroupName"]!="Select One"){echo $fetchforAll["GroupName"];} else {echo "---------";} ?></td>
											<td width="6%"><?php echo $fetchforAll["RollNo"]; ?></td>
											<td width="12%"><?php echo $fetchforAll["RegNo"]; ?></td>
											<td width="7%"><?php echo $fetchforAll["GPA"]; ?></td>
											<td width="17%">

												<a href="StaticviewTestimonial.php?date=<?php echo date('d/m/Y')?>&stdid=<?php echo $fetchforAll["boardResultID"];?>" class="btn btn-success btn-sm" target="_blank">Show Testimonial</a><br><br>

													<!--<a href="characterCertificate.php?date=<?php echo date('d/m/Y')?>&stdid=<?php echo $fetchforAll["boardResultID"];?>" class="btn btn-success btn-sm" target="_blank">Character Certificate</a><br><br>-->

													<!--<a href="TransferCertificate.php?date=<?php echo date('d/m/Y')?>&stdid=<?php echo $fetchforAll["boardResultID"];?>" class="btn btn-success btn-sm" target="_blank">Transfer Certificate</a><br><br>-->



											<a href="editTestomonial.php?id=<?php echo $fetchforAll["boardResultID"];?>" class="btn btn-success btn-sm"  target="adminbody">Edit</a> </td>
										</tr>
							<?php } } } } }  ?>
						
							
					
			
</table>
					<?php
					
			}
			 else {?>
				<table width="50%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="6">
								
									<input type="button" onclick="return creatAdmin()" class="btn btn-success btn-sm" style="width:120px;" value="Add" />
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Represh" />								</td>
							</tr>
				</table>
			
<?php }  } ?>

<?php if(isset($_POST["statNotid"])){
		
			?>
			  <script>
			  
          $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
			</script>
					<div class="col-md-10 col-md-offset-1">
							<table class="table table-responsive table-hover table-bordered "> 
									<tr>
											<td colspan="4" align="center"><strong class="text-success" style="font-size:15px; ">Board Exam Result</strong></td>
									</tr>
										<tr>
											<td>Date</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
										<select id="xx" name="xx" class="form-control">																<option>General</option>
															
															<option>Vocational</option>
													</select>
											  </div>
											</td>
									</tr>
										
													
													<tr>
											<td>Date</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
												<input type="text" placeholder="dd-mm-yy" id="example2" name="dataTesto" class="form-control" />
											  </div>
											</td>
									</tr>
									<tr>
											<td>Title</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Title" name="Title" class="form-control">														<optgroup label="Select Title">							
															<option>SSC</option>
															<option>HSC</option>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Group /Subject</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
											    
											    <input type="text" id="Group" name="Group"  class="form-control" />
												
											  </div>
											</td>
									</tr>
									<tr>
										<td>Session</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" id="Session" name="Session" class="form-control">																		
													
											  </div>
											</td>
									</tr>
									<tr>
										<td>Year</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Year" name="Year" class="form-control">																		
														<optgroup label="Select One">
															<?php 
																	$date=date("Y")+1;
																	$previous=$date-10;
																	for($year=$date;$year>=$previous;$year--)
																	{
																?>
																		<option><?php echo $year;?></option>
																<?php } ?>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Type</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Type" name="Type" class="form-control">																		
														<optgroup label="Select One">
															<option>Regular</option>
															<option>Irregular</option>
															<option>Private</option>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Student Name</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="studentName" id="studentName" placeholder="student  Name" />
											  </div>
											</td>
									</tr>
									
									<tr>
										<td>Father Name</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="fatherName" id="fatherName" placeholder="Father Name" />
											  </div>
											</td>
									</tr>
									
										<tr>
										<td>Mother Name</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="MotherName" id="MotherName" placeholder="Mother Name" />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Gender</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="gender" name="gender" class="form-control">																		
														<optgroup label="Select One">
															<option>Male</option>
															<option>Female</option>
															
														</optgroup>
													</select>											  </div>
											</td>
									</tr>
									
									<tr>
										<td>Roll No</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="RollNO" id="RollNO" placeholder="Roll NO.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Reg No</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="RegNo" id="RegNo" placeholder="Reg No.." />
											  </div>
											</td>
									</tr>
								<tr>
										<td>GPA</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="GPA" id="GPA" placeholder="GPA.." />
											  </div>
											</td>
									</tr>
									
									
										<tr>
										<td>Village</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="v" id="v"  />
											  </div>
											</td>
									</tr>
									<tr>
										<td>PO</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="p" id="p"  />
											  </div>
											</td>
									</tr>
									
									<tr>
										<td>Upazilla</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="u" id="u"  />
											  </div>
											</td>
									</tr>
										<tr>
										<td>Distric</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="d" id="d"  />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Birth Date </td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="bd" id="bd"  />
											  </div>
											</td>
									</tr>
										<tr>
										
											<td colspan="3" align="right">
													<span id="msgShow"></span>
											</td>
									</tr>
										<tr>
										
											<td colspan="3" align="center">
													<input type="submit" value="Save" class="btn btn-sm btn-success" onclick="return ResultAdd()" style="width:120px;" />
													<input type="button" value="Show All" class="btn btn-sm btn-success" onclick="return selectAll()" style="width:120px;"/>
											</td>
									</tr>
		</table>
			<?php
		}
		
		if(isset($_POST["sataticchekId"])){
		//rint "dd";
			$bdid=$db->withoutPrefix('statictestomonialinfo','boardResultID','17','10');
					if(!empty($_POST["title"]) && isset($_POST["title"]) && !empty($_POST["type"]) && isset($_POST["type"])  && !empty($_POST["RollNO"]) && isset($_POST["RollNO"]) && !empty($_POST["session"]) && isset($_POST["session"]) && !empty($_POST["Year"]) && isset($_POST["Year"])  && !empty($_POST["gpa"]) && isset($_POST["gpa"])
					&& !empty($_POST["studentName"]) && isset($_POST["studentName"])
					&& !empty($_POST["fatherName"]) && isset($_POST["fatherName"])
					&& !empty($_POST["MotherName"]) && isset($_POST["MotherName"])){
							
							
							 $inssql="INSERT INTO `statictestomonialinfo` (`boardResultID`,`type`,`Title`,`GroupName`,`Session`,`year`,`RollNo`,`RegNo`,`GPA`,`studentName`,`fatherName`,`motherName`,gender,`xx`,`v`,`p`,`u`,`d`,`bd`) VALUES ('$bdid','".$_POST["type"]."','".$_POST["title"]."','".$_POST["group"]."','".$_POST["session"]."','".$_POST["Year"]."','".$_POST["RollNO"]."','".$_POST["regNo"]."','".$_POST["gpa"]."','".$_POST['studentName']."','".$_POST['fatherName']."','".$_POST['MotherName']."','".$_POST["gender"]."','".$_POST["xx"]."','".$_POST['v']."','".$_POST['p']."','".$_POST["u"]."','".$_POST["d"]."','".$_POST["bd"]."')";
								$result=$db->insert_query($inssql);
										
														 $inserSql="REPLACE INTO `distributedtestomoniallist` (`date`,`studentId`) VALUES ('".$_POST["example2"]."','$bdid')";
														$resultsql=$db->update_query($inserSql);
															
																//print "<script>location='StaticviewTestimonial.php?date=$_POST[example2]&stdid=$bdid'<///script>";
															
										
									if(isset($db->sms)){
										print $db->sms;
									}
							
						
					}else {
							
							print "<span class='text-center  text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up Important Fields..</strong></span>";
					}
			}
			
			
			if(isset($_POST["sdchekid"]))
		{
			 $countSelect=count($_POST["chekvalue"]);
			
			for($x = 0; $x < $countSelect; $x++){
				  $delet_query="DELETE FROM `statictestomonialinfo` WHERE `boardResultID`='".$_POST["chekvalue"][$x]."'";
				 $db->delete_query($delet_query);
				 		
					
			}
		}
		
			 ?>