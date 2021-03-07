
<div class="col-md-9 col-xs-12" style="padding:0px ; margin:0px; margin-top:10px; ">
						
							<div class="col-md-4 col-xs-12" id="noticetopdiv" style="margin-top:2px">
									
										<span>Text Size</span>
									
										&nbsp;&nbsp;&nbsp;&nbsp; <a  style="text-decoration:none; cursor:pointer" onclick="fontsize16()"><span style="font-size:14px">A</span></a>
										
									    &nbsp;&nbsp;<a style="text-decoration:none; cursor:pointer" onclick="fontsize18()">	<span style="font-size:18px">A</span></a>
										
										&nbsp;&nbsp;<a  style="text-decoration:none; cursor:pointer" onclick="fontsize20()"> <span style="font-size:20px">A</span></a>
							</div>
							
							
							<div class="col-md-4 col-xs-12" id="noticetopdiv" style="margin-top:2px;">
									
									<div class="col-md-2 col-xs-2" style="padding:0px; margin:0px;  font-size:14px;
		 color:#FFFFFF;" >Color</div>
										
										<div class="col-md-10 col-xs-10" style="padding:0px; margin:0px;">
										&nbsp;&nbsp;&nbsp;&nbsp; <a  style="cursor:pointer" onclick="backgroupcolone()"> <div id="colordiv">C</div></a>
										
									    &nbsp;&nbsp;	 <a  style="cursor:pointer"  onclick="backgroupcoltwo()"> <div  id="colordivone">C</div></a>
										
										&nbsp;&nbsp; <a  style="cursor:pointer"  onclick="backgroupcolthree()"> <div  id="colordivtwo">C</div></a>
										
										&nbsp;&nbsp;<a   style="cursor:pointer" onclick="backgroupcolfour()">  <div  id="colordivthree">C</div> </a>
										</div>
							</div>
							
														
</div>	


<style>
       #boxshadow {
        position: relative;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
      
        background: white;
}


</style>

<?php
		if(isset($_GET["stid"])){
			 $select_sn_cmt="SELECT `running_student_info`.*,`student_personal_info`.*,`student_guardian_information`.*,`student_acadamic_information`.*,`student_address_info`.*,
				`add_class`.`class_name`,`add_group`.`group_name` FROM `running_student_info` INNER JOIN `student_personal_info` ON
				 `running_student_info`.`student_id`=`student_personal_info`.`id`
				INNER JOIN `student_guardian_information` ON `student_guardian_information`.`id`=`running_student_info`.`student_id`
				INNER JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
				INNER JOIN `student_address_info` ON `student_address_info`.`id`=`running_student_info`.`student_id`
				INNER JOIN `add_class` ON `add_class`.`id`=`running_student_info`.`class_id` INNER JOIN `add_group` 
				ON `add_group`.`id`=`running_student_info`.`group_id`  WHERE `running_student_info`.`student_id`='".$_GET["stid"]."'";
		}
		
		if(isset($_GET["teacherid"])){
					 $select_sn_cmt ="SELECT 
  `teachers_information`.`email` AS student_id,
  `teachers_information`.`teachers_name` AS student_name,
  `teachers_information`.`fathers_name` AS father_name,
  `teachers_information`.`mothers_name` AS mother_name,
  `teachers_information`.`designation` AS session2,
  `teachers_information`.`email` AS class_name,
  `teachers_information`.`date_of_birth` AS date_of_brith,
  `teachers_information`.`gender` AS gender,
  `teachers_information`.`educational_qualification` AS qualification
FROM
  `teachers_information` 
WHERE `email` = '".$_GET["teacherid"]."' ";
		}
		
			if(isset($_GET["staffid"])){
			
			 $select_sn_cmt ="SELECT 
  `stuff_information`.`stuff_id` AS student_id,
  `stuff_information`.`stuff_name` AS student_name,
  `stuff_information`.`designation` AS session2,
  `stuff_information`.`date_of_birth` AS date_of_brith,
  `stuff_information`.`gender` AS gender,
  `stuff_information`.`fathers_name` AS father_name,
  `stuff_information`.`mothers_name` AS mother_name,
   `stuff_information`.`mobile_no` AS class_name
FROM
  `stuff_information` 
WHERE `stuff_id` = '".$_GET["staffid"]."'";
			}
			
				if(isset($_GET["memid"])){
				
							 $select_sn_cmt ="SELECT 
  `comitte_members_information`.`id` AS student_id,
  `comitte_members_information`.`name` AS student_name,
  `comitte_members_information`.`designation` AS session2,
  `comitte_members_information`.`date_of_birth` AS date_of_brith,
  `comitte_members_information`.`gender` AS gender,
  `comitte_members_information`.`father_name` AS father_name,
  `comitte_members_information`.`mother_name` AS mother_name,
  `comitte_members_information`.`mobile_no` AS class_name 
FROM
  `comitte_members_information` 
WHERE `id` ='".$_GET["memid"]."'";


				}
				
				if(isset($_GET["donerid"])){
				  $select_sn_cmt ="SELECT 
  `donermembersinfo`.`id` AS student_id,
  `donermembersinfo`.`name` AS student_name,
  `donermembersinfo`.`designation` AS session2,
  `donermembersinfo`.`date_of_birth` AS date_of_brith,
  `donermembersinfo`.`gender` AS gender,
  `donermembersinfo`.`father_name` AS father_name,
  `donermembersinfo`.`mother_name` AS mother_name,
  `donermembersinfo`.`mobile_no` AS class_name   FROM `donermembersinfo` 
WHERE `id`='".$_GET["donerid"]."'";
						
				
				}
				if(isset($_GET["gurdian"])){
				  $select_sn_cmt ="SELECT `pta_information`.`id` AS student_id,`pta_information`.`name` AS student_name,
`pta_information`.`designation` AS session2,`pta_information`.`mobile_no` AS class_name 
FROM `pta_information`
WHERE `id`='".$_GET["gurdian"]."'";
						
				
				}
				
				
				if(isset($_GET["fcid"])){
				   $select_sn_cmt ="SELECT `previous_principal`.`id` AS student_id,`previous_principal`.`designation` AS session2, 
`previous_principal`.`name` AS student_name,`previous_principal`.* FROM
 `previous_principal` WHERE `id`='".$_GET["fcid"]."'";
						
				
				}
				
		$result=$db->select_query($select_sn_cmt);
					//$count=mysqli_num_fields($result);
					if($result){
						$fetch_sm=$result->fetch_object();
					}
?>


<div class="col-md-9 col-xs-12 fontsize backgroundcol"  style="padding:0px ; margin:0px; margin-top:10px; padding-top:10px;" >

		
				<div class="col-md-6 col-xs-6" style="margin:0px;
					padding:0px;  text-align:left; ">
							<img src="img/Printer-icon.png" id="boxshadow" style="height:20px; width:20px;" />
				</div>
				
				
				
				<div class="col-md-6 col-xs-6" style="margin:0px;
				padding:0px; text-align:right; padding-top:20px;">
						<span id="noticetitle"  style="color:#000000; font-size:12px; font-family:'Times New Roman', Times, serif; font-weight:300;"> End-time: 15 Dec 2017</span>
				</div>
				
				<div class="col-md-12 col-xs-12"  style="width:100%; border-bottom:1px #E4E4E4 solid; margin-top:10px;">
				
				</div>
				
				
		<!--<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
	
					
					<span class="changetitle"  style="font-size:18px; color:black; font-family:'Times New Roman', Times, serif">PRESIDENCY SCHOOL & COLLEGE</span>
		
		
		</div>-->
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
		
		
			
					<table class="table table-bordered table-responsive">
								<tbody>
								<tr>
												<td colspan="3">
												<?php
												
												 $src = "other_img/$fetch_sm->student_id.jpg";
												 	if($fetch_sm->gender =="Male" or $fetch_sm->gender =="male" ){
									
															if (file_exists($src)) { ?> 
															<img src="<?php echo $src;?>" style="height:250px; width:307px;" />
															<?php
									
															}else {
																?>
																<img src="other_img/male.png" style="height:250px; width:307px;" />
																<?php
															
															}
													}else{
																if (file_exists($src)) { ?> 
														<img src="<?php echo $src;?>" style="height:250px; width:307px;" />
													
													<?php } else { ?> 
													<img src="other_img/femaleImage.png" style="height:250px; width:307px;" />
													
													<?php } }
																
												?>
													
												</td>
												
										</tr>	
										
										<tr>
												<td width="100">Name</td>
												<td width="3" align="center">:</td>
												<td width="230"><?php echo $fetch_sm->student_name;?></td>
										</tr>	
											<?php
								
									if(isset($_GET["fcid"])){
										?>
											<tr>
												<td>Duration	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->from.'--'.$fetch_sm->to;?></td>
										</tr>	
										<?php
									}
								?>
										<tr>
												<td>Father's Name</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->father_name;?></td>
										</tr>	
										
										
										<tr>
												<td>Mother's Name	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->mother_name;?></td>
										</tr>	
										
										
										<tr>
												<td>
													<?php 
											
														if(isset($_GET["stid"])){
													?>
														Session
													<?php 
														} else if(isset($_GET["teacherid"]) || isset($_GET["staffid"]) || isset($_GET["memid"]) || isset($_GET["donerid"]) || isset($_GET["gurdian"]) || isset($_GET["fcid"])){ ?> 
														Designation
														<?php } ?>
												</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->session2;?></td>
										</tr>	
										
										
										
										
										
										
										
									
										<tr>
												<td>
													<?php 
										
														if(isset($_GET["stid"])){
														?>
										
												Class Name	
												<?php
													}else if(isset($_GET["teacherid"])){
													?>
													Email
													<?php
													
													} else if(isset($_GET["staffid"]) or isset($_GET["memid"]) || isset($_GET["donerid"]) || isset($_GET["gurdian"]) || isset($_GET["fcid"])){ ?>
													Mobile No
													<?php
													
													}
												
												?>
												</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->class_name;?></td>
										</tr>	
									
										<?php 
											if(isset($_GET["stid"])){
												if($fetch_sm->group_name ==="Null" || $fetch_sm->group_name ==="null" ) {
												
												}else{
										?>
										<tr>
												<td>Group Name	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->group_name;?></td>
										</tr>	
										<?php } } ?>
										
										<?php 
										if(isset($_GET["stid"])){
 ?>
										<tr>
												<td>Admission Date	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->addmission_date;?></td>
										</tr>	
										
										<?php  } ?>
										<?php 
											if(isset($_GET["teacherid"])){
											
											?>
										<tr>
												<td>Qualification	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->qualification;?></td>
										</tr>	
										<?php
										
										}
										?>
										
										<tr>
												<td>Brith Date	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->date_of_brith;?></td>
										</tr>	
										<tr>
												<td>Gendar	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->gender;?></td>
										</tr>	
										
									
								<?php
								
									if(isset($_GET["fcid"])){
										?>
											<tr>
												<td>Duration	</td>
												<td align="center">:</td>
												<td><?php echo $fetch_sm->from.'--'.$fetch_sm->to;?></td>
										</tr>	
										<?php
									}
								?>
								</tbody>
					</table>
					
					
				
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
		</div>
		
		
</div>