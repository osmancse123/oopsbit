  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	if(isset($_GET["id"])){
			$sql="SELECT * FROM `admin_users`";
			$resultSql=$db->select_query($sql);
			
			if($resultSql){?>
				<table width="50%" class="table table-responsive table-hover table-bordered">
							<tr>
								<td align="right" colspan="7">
								
									<input type="button" onclick="return creatAdmin()" class="btn btn-success btn-sm" style="width:120px;" value="Create" />
										<input type="button" class="btn btn-danger btn-sm" style="width:120px;" onclick="return deleteFunction()" value="Delete" />
											<input type="submit" class="btn btn-info btn-sm" style="width:120px;" value="Refresh" />								</td>
							</tr>
							<tr align="center">
								<td width="15%">Select One</td>
								<td width="13%">Name</td>
								<td width="21%">Email</td>
								<td width="12%">Type</td>
								<td width="16%">Status</td>
								<td width="23%">Picture</td>
								<td width="23%">Action</td>
								
							</tr>
							
					
			<?php
					while($fetchSql=$resultSql->fetch_array()){
					$sl=0;
							if($fetchSql["id"] != "306"){
							$sl++;
							?>
								<tr align="center">
								<td width="15%"><input type="checkbox" class="chek" name="chek[]" value="<?php echo $fetchSql["id"];?>" /></td>
								<td width="13%"><?php echo $fetchSql["Name"];?></td>
								<td width="21%"><?php echo $fetchSql["email"];?></td>
								<td width="12%"><?php echo $fetchSql["type"];?></td>
								<td width="16%">&nbsp;<?php if($fetchSql["status"]==="Active"){?>
									<input type="hidden" name="deactive[]" id="deactive-<?php echo $fetchSql["id"]?>" value="dActive"/>
									<a href="#" class="btn btn-success btn-flat" style="width:120px;" onclick="return ADfun('<?php echo $fetchSql["id"]?>')">Activated</a><?php } else {?>
												<input type="hidden" name="deactive[]" id="deactive-<?php echo $fetchSql["id"]?>" value="Active"/>
												<a href="#" class="btn btn-danger btn-flat" style="width:120px; " onclick="return ADfun('<?php echo $fetchSql["id"]?>')">Deactivated</a>
									<?php } ?>
								</td>
								<td width="23%"><a href="../other_img/<?php echo $fetchSql["id"];?>.jpg" class="btn btn-primary" target="_blank">See Photos</a></td>
								<td width="23%"><input class="btn btn-primary"  type="button" value="Update" onclick="return editAdmin('<?php echo $fetchSql["id"];?>')" ></input></td>
							</tr>
							
							<?php
					} }
					?>
						</table>
					<?php
					
			}
			}
			
			if(isset($_POST["Notid"]))
			{
					?>
					<div class="col-md-10 col-md-offset-1">
							<table class="table table-responsive table-hover table-bordered "> 
									<tr>
											<td colspan="4" align="center"><strong class="text-success" style="font-size:15px; ">Creat New Admin</strong></td>
									</tr>
									<tr>
											<td>Name</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control"  name="name" id="name" placeholder="Your Name.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Email</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" name="Email" id="Email" placeholder="Your Email.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Admin Type</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select name="admintype" id="admintype" class="form-control">
														<optgroup label="Select One">
															
															<option>Main Admin</option>
															<option>Sub Admin</option>
															
														</optgroup>
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Password</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="password" class="form-control" name="Passward" id="Passward" placeholder="Password.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Re Password</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="password" class="form-control" name="RePassward" id="RePassward" placeholder="Re Password.." onkeyup="return passMatch()" />
											  </div><br/><br/>
											  <span id="showMsg" style="font-weight:bold"></span>
											</td>
									</tr>
									<tr>
										<td>Status</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="radio" name="status" value="Active"/>&nbsp; Active										<input type="radio" name="status" value="dActive"/>&nbsp; Deactive
											  </div>
											</td>
									</tr>
									<tr>
										<td>Picture </td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="file" class="filestyle" name="file" accept="image/*" id="file" onChange="viewShowImage(this)" />
											  </div>
												<img id="preview" src="all_image/Noimage.png" class='img-responsive img-thumbnail' height='90' width='90' style='margin-top: 5px; margin-left:15px;'/>
											</td>
									</tr>
									
							</table>
							<table class="table" style="margin-top:-20px; border:1px #333333 solid;">
								<tr>
											<td align="center"><input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; <span><strong class="text-danger ">Select All</strong></span></td>
								</tr>
								
								<tr>
										<td>
											<?php 
											 
						if($_SESSION["id"]=="306"){
										$selecMain="SELECT `Main_Link_Id`,`Main_Link_Name` FROM `main_link_info`  ORDER BY `SLNO` ASC";
										$resultMain=$db->select_query($selecMain);
										if($resultMain){
											while($fetch_Main=$resultMain->fetch_array()){
									
									?><p style="background:#DEFADA"><input class="check_elmnt" id="linkID-<?php echo  $fetch_Main["Main_Link_Id"];?>" type="checkbox" name="linkID[]" value="<?php echo  $fetch_Main["Main_Link_Id"]?>" onclick="return chekMain('<?php echo  $fetch_Main["Main_Link_Id"];?>')"/> &nbsp;<strong class="text-success"><?php echo  $fetch_Main["Main_Link_Name"]?></strong><p>
								<?php 
									$subLink="SELECT * FROM `sub_link_info` WHERE `Main_Link`='$fetch_Main[Main_Link_Id]'";
									$result=$db->select_query($subLink);
									if($result){
										while($fetchSql=$result->fetch_array()){
								?>
											<span><input class="check_elmnt2" type="checkbox" id="sublinkID-<?php echo $fetch_Main["Main_Link_Id"];?>" name="SublinkID[]" value="<?php echo  "$fetchSql[Main_Link]and$fetchSql[Sub_Link_Id]"?>" disabled="disabled" /> &nbsp;<strong class="text-warning"><?php echo  $fetchSql["Sub_Link_Name"]?></strong></span>
											<?php } }?>
									
									<?php } }  } else {?>
									<?php
									
									$selecMain="SELECT `main_link_piority`.*,`main_link_info`.`Main_Link_Name`,`Page_Name` FROM `main_link_info` 
INNER JOIN `main_link_piority` ON `main_link_piority`.`Main_Link_id`=`main_link_info`.`Main_Link_Id`
WHERE `main_link_piority`.`adminId`='".$_SESSION["id"]."'  ORDER BY `main_link_info`.`SLNO` ASC";
										$resultMain=$db->select_query($selecMain);
										if($resultMain){
											while($fetch_Main=$resultMain->fetch_array()){
									
									?><p style="background:#DEFADA"><input class="check_elmnt" id="linkID-<?php echo  $fetch_Main["Main_Link_id"];?>" type="checkbox" name="linkID[]" value="<?php echo  $fetch_Main["Main_Link_id"]?>" onclick="return chekMain('<?php echo  $fetch_Main["Main_Link_id"];?>')"/> &nbsp;<strong class="text-success"><?php echo  $fetch_Main["Main_Link_Name"]?>
									
									<p>
								<?php 
									$subLink="SELECT `sublinkpeority`.*,`sub_link_info`.`Sub_Link_Name`,`Sub_Page_Name` FROM `sublinkpeority`
INNER JOIN `sub_link_info` ON `sub_link_info`.`Sub_Link_Id`=`sublinkpeority`.`sublinkId` WHERE 
`sublinkpeority`.`AdminId`='".$_SESSION["id"]."' AND `sub_link_info`.`Main_Link`='$fetch_Main[1]' GROUP BY `sub_link_info`.`Sub_Link_Id` ORDER BY `sub_link_info`.`Sl_No` ASC";
									$result=$db->select_query($subLink);
									if($result){
										while($fetchSql=$result->fetch_array()){
								?>
											<span>
											
											<input class="check_elmnt2" type="checkbox" id="sublinkID-<?php echo $fetch_Main["Main_Link_id"];?>" name="SublinkID[]" value="<?php echo  "$fetchSql[MainLinkID]and$fetchSql[sublinkId]"?>" disabled="disabled" />&nbsp;<strong class="text-warning"><?php echo  $fetchSql["Sub_Link_Name"];?></strong></span>
											<?php } }?>
									
									<?php } } ?></td>
								
									<?php }  ?>
								</tr>
								<tr>
									<td align="center"> <input type="submit" name="save" value="Save" id="save" class="btn btn-sm btn-danger" /></td>
								</tr>
							</table>
</div>
					<?php
			}
			
			
		
	?>
	
	<?php
	
		if(isset($_POST["chekid"]))
		{
			$countSelect=count($_POST["chekvalue"]);
			for($x = 0;$x<$countSelect;$x++){
				$delet_query="DELETE FROM `admin_users` WHERE `id`='".$_POST["chekvalue"][$x]."'";
				$delet_mainlink="DELETE FROM `main_link_piority` WHERE `adminId`='".$_POST["chekvalue"][$x]."'";
				$delet_sublink="DELETE FROM `sublinkpeority` WHERE `AdminId`='".$_POST["chekvalue"][$x]."'";
				@unlink("../other_img/".$_POST["chekvalue"][$x].".jpg");
				$db->delete_query($delet_query);
				$db->delete_query($delet_mainlink);
				$db->delete_query($delet_sublink);
			}
		}
		
		if(isset($_POST["chek"])){
			$updatestatus="UPDATE `admin_users` SET `status`='".$_POST["status"]."' WHERE `id`='".$_POST["Adminid"]."'";
			$result=$db->update_query($updatestatus);
		}
		
		if(isset($_POST["chekOldPass"])){
		
					$selectByadminId="SELECT * FROM `admin_users` WHERE `id`='".$_POST["adminId"]."'";
					$result=$db->select_query($selectByadminId);
					if($result){
							$fetchAll=$result->fetch_array();
					}
					
					$hash = crypt($_POST["OldPassward"],$fetchAll["pass"]);
					if($hash === $fetchAll["pass"]){
						print "<strong><span class='glyphicon glyphicon-ok text-success' style='font-size:15px;font-weight:bold'>&nbsp;Old Passward Match Successfully..</span></strong>";
					}else {
						print "<strong><span class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Old Passward Don't Match ..</span></strong>";
					}
		}
		
		if(isset($_POST["updatePass"])){
				$selectByadminId="SELECT * FROM `admin_users` WHERE `id`='".$_POST["adminId"]."'";
					$result=$db->select_query($selectByadminId);
					if($result){
							$fetchAll=$result->fetch_array();
					}
					
					$hash = crypt($_POST["OldPassward"],$fetchAll["pass"]);
					if($hash === $fetchAll["pass"]){
							if($_POST["pass"] === $_POST["repass"]){
								$newPass=$db->passward_encrypt($_POST["pass"]);
								//print $newPass."<br/>";
								$rePass=$db->passward_encrypt($_POST["repass"]);
								//print $rePass."<br/>";
								$update_query="UPDATE `admin_users` SET `pass`='$newPass',`repass`='$rePass' WHERE `id`='".$_POST["adminId"]."'";
								$result_query=$db->update_query($update_query);
										if(isset($db->sms)){
											echo $db->sms;
										}
							}else {
								print "<strong><span class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Retype Passward Don't Match ..</span></strong>";
							}
					}else {
						print "<strong><span class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Old Passward Don't Match ..</span></strong>";
					}
		}
	?>
	
	<?php
	
			if(isset($_POST["editadmin"])){
			$sql = "SELECT * FROM `admin_users` WHERE `id`='".$_POST["getid"]."'";
			$resultsql = $db->select_query($sql);
			if($resultsql > 0){
					$fetchSql = $resultsql->fetch_array();
			}
			?>
			<div class="col-md-10 col-md-offset-1">
							<table class="table table-responsive table-hover table-bordered "> 
									<tr>
											<td colspan="4" align="center"><strong class="text-success" style="font-size:15px; ">Update Data</strong></td>
									</tr>
									<tr>
											<td>Name</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" value="<?php echo $fetchSql["Name"];?>"  name="name" id="name" placeholder="Your Name.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Email</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="text" class="form-control" value="<?php echo $fetchSql["email"];?>" name="Email" id="Email" placeholder="Your Email.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Admin Type</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<select name="admintype" id="admintype" class="form-control">
														
														<option><?php echo $fetchSql["type"];?></option>
														
															<?php 
																if($fetchSql["type"] != "Main Admin"){
																?>
															<option>Main Admin</option><?php } ?>
																<?php 
																if($fetchSql["type"] != "Sub Admin"){
																?>
															<option>Sub Admin</option><?php } ?>
															
													
													</select>
											  </div>
											</td>
									</tr>
									<tr>
										<td>Password</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="password" class="form-control" name="Passward" id="Passward" placeholder="Password.." />
											  </div>
											</td>
									</tr>
									<tr>
										<td>Re Password</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="password" class="form-control" name="RePassward" id="RePassward" placeholder="Re Password.." onkeyup="return passMatch()" />
													<input type="text" class="form-control" name="id" id="id" placeholder="Re Password.." value="<?php echo $fetchSql["id"]; ?>"  />
											  </div><br/><br/>
											  <span id="showMsg" style="font-weight:bold"></span>
											</td>
									</tr>
									<tr>
										<td>Status</td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="radio" name="status" value="Active" <?php 
																if($fetchSql["status"] == "Active"){
																?>
																 checked="checked"
																 <?php } ?> 
															/>&nbsp; Active										<input type="radio" name="status" value="dActive" 	<?php 	if($fetchSql["status"] == "dActive"){
																?>
																 checked ="checked"
																 <?php } ?>   />&nbsp; Deactive
											  </div>
											</td>
									</tr>
									<tr>
										<td>Picture </td>
											<td>:</td>
											<td>
											<div class="col-md-8">
													<input type="file" class="filestyle" name="file" accept="image/*" id="file" onChange="viewShowImage(this)" />
											  </div>
												<img id="preview" src="all_image/Noimage.png" class='img-responsive img-thumbnail' height='90' width='90' style='margin-top: 5px; margin-left:15px;'/>
											</td>
									</tr>
									
							</table>
							<table class="table" style="margin-top:-20px; border:1px #333333 solid;">
								<tr>
											<td align="center"><input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; <span><strong class="text-danger ">Select All</strong></span></td>
								</tr>
								
								<tr>
										<td>
											<?php 
											 
						if($_SESSION["id"]=="306"){
										$selecMain="SELECT `Main_Link_Id`,`Main_Link_Name` FROM `main_link_info`  ORDER BY `SLNO` ASC";
										$resultMain=$db->select_query($selecMain);
										if($resultMain){
											while($fetch_Main=$resultMain->fetch_array()){
									
									?><p style="background:#DEFADA"><input class="check_elmnt" id="linkID-<?php echo  $fetch_Main["Main_Link_Id"];?>" type="checkbox" name="linkID[]" value="<?php echo  $fetch_Main["Main_Link_Id"]?>" onclick="return chekMain('<?php echo  $fetch_Main["Main_Link_Id"];?>')"/> &nbsp;<strong class="text-success"><?php echo  $fetch_Main["Main_Link_Name"]?></strong><p>
								<?php 
									$subLink="SELECT * FROM `sub_link_info` WHERE `Main_Link`='$fetch_Main[Main_Link_Id]'";
									$result=$db->select_query($subLink);
									if($result){
										while($fetchSql=$result->fetch_array()){
								?>
											<span><input class="check_elmnt2" type="checkbox" id="sublinkID-<?php echo $fetch_Main["Main_Link_Id"];?>" name="SublinkID[]" value="<?php echo  "$fetchSql[Main_Link]and$fetchSql[Sub_Link_Id]"?>" disabled="disabled" /> &nbsp;<strong class="text-warning"><?php echo  $fetchSql["Sub_Link_Name"]?></strong></span>
											<?php } }?>
									
									<?php } }  } else {?>
									<?php
									
									$selecMain="SELECT `main_link_piority`.*,`main_link_info`.`Main_Link_Name`,`Page_Name` FROM `main_link_info` 
INNER JOIN `main_link_piority` ON `main_link_piority`.`Main_Link_id`=`main_link_info`.`Main_Link_Id`
WHERE `main_link_piority`.`adminId`='".$_SESSION["id"]."'  ORDER BY `main_link_info`.`SLNO` ASC";
										$resultMain=$db->select_query($selecMain);
										if($resultMain){
											while($fetch_Main=$resultMain->fetch_array()){
									
									?><p style="background:#DEFADA"><input class="check_elmnt" id="linkID-<?php echo  $fetch_Main["Main_Link_id"];?>" type="checkbox" name="linkID[]" value="<?php echo  $fetch_Main["Main_Link_id"]?>" onclick="return chekMain('<?php echo  $fetch_Main["Main_Link_id"];?>')"/> &nbsp;<strong class="text-success"><?php echo  $fetch_Main["Main_Link_Name"]?>
									
									<p>
								<?php 
									$subLink="SELECT `sublinkpeority`.*,`sub_link_info`.`Sub_Link_Name`,`Sub_Page_Name` FROM `sublinkpeority`
INNER JOIN `sub_link_info` ON `sub_link_info`.`Sub_Link_Id`=`sublinkpeority`.`sublinkId` WHERE 
`sublinkpeority`.`AdminId`='".$_SESSION["id"]."' AND `sub_link_info`.`Main_Link`='$fetch_Main[1]' GROUP BY `sub_link_info`.`Sub_Link_Id` ORDER BY `sub_link_info`.`Sl_No` ASC";
									$result=$db->select_query($subLink);
									if($result){
										while($fetchSql=$result->fetch_array()){
								?>
											<span>
											
											<input class="check_elmnt2" type="checkbox" id="sublinkID-<?php echo $fetch_Main["Main_Link_id"];?>" name="SublinkID[]" value="<?php echo  "$fetchSql[MainLinkID]and$fetchSql[sublinkId]"?>" disabled="disabled" />&nbsp;<strong class="text-warning"><?php echo  $fetchSql["Sub_Link_Name"];?></strong></span>
											<?php } }?>
									
									<?php } } ?></td>
								
									<?php }  ?>
								</tr>
								<tr>
									<td align="center"> <input type="submit" name="update" value="Save" id="save" class="btn btn-sm btn-danger" /></td>
								</tr>
							</table>
</div><?php
			
			}
	?>
	
	
	
	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
