<?php

	//error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
		$id=$db->autogenerat('boardexamresult','boardResultID','BRD-','10');

	if(isset($_GET["id"])){
			$sql="SELECT `distributedtestomoniallist`.`date`,`distributedtestomoniallist`.`studentId`,`boardexamresult`.* FROM `distributedtestomoniallist`
INNER JOIN `boardexamresult` ON `boardexamresult`.`StudentId`=`distributedtestomoniallist`.`studentId` GROUP BY `boardexamresult`.`Title` ORDER BY `boardexamresult`.`Title` ASC";
			$resultSql=$db->select_query($sql);
			
			if($resultSql){
				
				
			?>
				<table width="50%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="7">
								
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Represh" />								</td>
							</tr>
							<?php 
									while($fetchSql=$resultSql->fetch_array()){
							?>
							<tr>
								<td colspan="7" align="center"><strong><span><?php echo $fetchSql["Title"];?></span></strong></td>
							</tr>
								<?php 
										$sqlsession="SELECT `distributedtestomoniallist`.`date`,`distributedtestomoniallist`.`studentId`,`boardexamresult`.* FROM `distributedtestomoniallist`
INNER JOIN `boardexamresult` ON `boardexamresult`.`StudentId`=`distributedtestomoniallist`.`studentId` 
WHERE `boardexamresult`.`Title`='".$fetchSql["Title"]."' GROUP BY `boardexamresult`.`Session` ORDER BY `boardexamresult`.`Session` DESC";
										$resultSession=$db->select_query($sqlsession);
											if($resultSession){
													while($fetchResult=$resultSession->fetch_array()){
								?>
									<tr>
											<td colspan="7" align="center"><strong><span><?php echo $fetchResult["Session"];?></span></strong></td>
									</tr>	
									
										<tr align="center">
											<td width="10%">Select One</td>
											<td width="15%">Type</td>
											<td width="12%">Date</td>
											<td width="16%">Group Name</td>
											<td width="13%">Roll No</td>
											<td width="18%">Reg No</td>
											<td width="16%">GPA</td>
										</tr>
										
										<?php 
											$sqlForAll="SELECT `boardexamresult`.*,`distributedtestomoniallist`.`studentId`,`date` FROM `distributedtestomoniallist`
INNER JOIN `boardexamresult` ON `boardexamresult`.`StudentId`=`distributedtestomoniallist`.`studentId`
WHERE `boardexamresult`.`Title`='".$fetchSql["Title"]."' AND `boardexamresult`.`Session`='".$fetchResult["Session"]."'";
											$resulForAll=$db->select_query($sqlForAll);
											if($resulForAll){
												while($fetchforAll=$resulForAll->fetch_array()){
										?>
										<tr align="center">
											<td width="10%">
											
													<input type="checkbox" class="chek" name="chek[]" value="<?php echo $fetchforAll["studentId"];?>" />
											</td>
											<td width="15%"><?php echo $fetchforAll["type"]; ?></td>
											<td width="12%"><?php echo $fetchforAll["date"]; ?></td>
											<td width="16%"><?php if($fetchforAll["GroupName"]!="Select One"){echo $fetchforAll["GroupName"];} else {echo "---------";} ?></td>
											<td width="13%"><?php echo $fetchforAll["RollNo"]; ?></td>
											<td width="18%"><?php echo $fetchforAll["RegNo"]; ?></td>
											<td width="16%"><?php echo $fetchforAll["GPA"]; ?></td>
										</tr>
							<?php } } } } }  ?>
						
							
					
			
						</table>
					<?php
					
			}
			  }
		
		?><?php if(isset($_POST["Notid"])){
		
			?>
					<div class="col-md-10 col-md-offset-1">
							<table class="table table-responsive table-hover table-bordered "> 
									<tr>
											<td colspan="4" align="center"><strong class="text-success" style="font-size:15px; ">Board Exam Result</strong></td>
									</tr>
									<tr>
											<td>Title</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Title" name="Title" class="form-control">														<optgroup label="Select Title">
															<option>HSC</option>
															<option>SSC</option>
															<option>JSC</option>
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Group</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Group" name="Group" class="form-control">														<optgroup label="Select Group">
															<option>Science</option>
															<option>Business Studies</option>
															<option>Humanities</option>
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Session</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select id="Session" name="Session" class="form-control">																		
														<optgroup label="Select One">
															<?php 
																	$date=date("Y")+1;
																	$previous=$date-10;
																	for($year=$date;$year>=$previous;$year--)
																	{
																?>
																		<option><?php echo $year-1?>-<?php echo $year?></option>
																<?php } ?>
															
														</optgroup>
													</select>
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
																		<option><?php echo $year?></option>
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
			
			
		if(isset($_POST["dchekid"]))
		{
			  $countSelect=count($_POST["chekvalue"]);
			
			for($x = 0; $x < $countSelect; $x++){
				  $delet_query="DELETE FROM `distributedtestomoniallist` WHERE `studentId`='".$_POST["chekvalue"][$x]."'";
				 $db->delete_query($delet_query);
				 		
					
			}
		}
			
 ?>