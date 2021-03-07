
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
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
					
					<span class="changetitle"  style="font-size:18px; color:black; font-family:'Times New Roman', Times, serif">
					<?php
					
					if($_GET["page"] == "teacherinfo"){
					?>
					Teacher Information
					<?php } else if($_GET["page"]=="staff") {?>
					
					Staff Information
					<?php } else if($_GET["page"]=="Former_cheif") {?>
						Former Cheif  Information
					<?php } else if($_GET["page"]=="gpstudent" or $_GET["page"]=="clsstudent" ) {?>
					Student Information
					<?php } else if($_GET["page"]=="member") {?>
					Member Information
					<?php } else if($_GET["page"]=="doner") {?>
						Doner Member Information
							<?php } else if($_GET["page"]=="gurdian") {?>
							  Guardian and Teacher Association
							
					<?php } ?>
					</span>
		</div>
		
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
					
				<?php
		
		if($_GET["page"] == "gpstudent"){
		$sql="SELECT COUNT(`student_id`) FROM `running_student_info` WHERE `class_id`='".$_GET["cls"]."' and group_id='".$_GET["gpid"]."'";
		
		}else if($_GET["page"] == "clsstudent"){
		$sql="SELECT COUNT(`student_id`) FROM `running_student_info` WHERE `class_id`='".$_GET["cls"]."'";
		
		}else if($_GET["page"] == "teacherinfo"){
		 $sql="SELECT COUNT(`teachers_id`) FROM `teachers_information`";
		
		}else if($_GET["page"] == "staff"){
		 $sql="SELECT COUNT(`stuff_id`) FROM `stuff_information`";
		
		}	else if($_GET["page"] == "Former_cheif"){
		 $sql="SELECT COUNT(`id`) FROM `previous_principal`";
		
		}	
	else if($_GET["page"] == "member"){
		 $sql="SELECT COUNT(`id`) FROM `comitte_members_information`";
		
		}		else if($_GET["page"] == "doner"){
		 $sql="SELECT COUNT(`id`) FROM `donermembersinfo`  WHERE `type`='".$_GET["cls"]."'";
		
		}		else if($_GET["page"] == "gurdian"){
		 $sql="SELECT COUNT(`id`) FROM `pta_information`";
		
		}	
	
	
	
	
	$result=$db->select_query($sql);
	if($result)
	{
		$row=$result->fetch_array();
	}
	$rows = $row[0];
	$page_rows = 20;
	$last = ceil($rows/$page_rows);
	if($last < 1)
	{
		$last = 1;
	}
	$pagenum = 1;
	if(isset($_GET["pn"]))
	{
		
		$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
	}
	if($pagenum < 1)
	{
			$pagenum = 1;
	}
	else if($pagenum > $last){
		$pagenum = $last;
		
	}
	$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
	
	
		if($_GET["page"] == "gpstudent"){
		
 	$sql1= "
SELECT `running_student_info`.`student_id`,class_roll,`student_acadamic_information`.
`admission_disir_class`,`student_acadamic_information`.`admission_disir_group`, `add_class`.`class_name`,`student_personal_info`.student_name,gender
 FROM `running_student_info` JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
 JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `add_class`
  ON `add_class`.`id`=`running_student_info`.`class_id`  WHERE `running_student_info`.`class_id`='".$_GET["cls"]."' and `running_student_info`.`group_id`='".$_GET["gpid"]."' ORDER BY `running_student_info`.`class_roll` ASC $limit";
		
		}else if($_GET["page"] == "clsstudent"){
		
	 $sql1= "
SELECT `running_student_info`.`student_id`,class_roll,`student_acadamic_information`.
`admission_disir_class`,`student_acadamic_information`.`admission_disir_group`, `add_class`.`class_name`,`student_personal_info`.student_name,gender
 FROM `running_student_info` JOIN `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id` 
 JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id` JOIN `add_class`
  ON `add_class`.`id`=`running_student_info`.`class_id`  WHERE `running_student_info`.`class_id`='".$_GET["cls"]."' ORDER BY `running_student_info`.`class_roll` ASC $limit";
		
		}else if($_GET["page"] == "teacherinfo"){
		 
		  $sql1= "SELECT `teachers_information`.`email` AS student_id,`teachers_information`.`teachers_name` AS student_name,
`teachers_information`.`designation` AS class_roll,`teachers_information`.`mobile_no` AS class_name,gender FROM `teachers_information` ORDER BY index_no ASC $limit";
		
	}else if($_GET["page"] == "staff"){
	
	 $sql1= "SELECT `stuff_information`.`stuff_id` AS student_id,`stuff_information`.`stuff_name` AS student_name,
`stuff_information`.`designation` AS class_roll,`stuff_information`.`mobile_no` AS class_name,`gender` FROM `stuff_information`  ORDER BY index_no ASC $limit";

	}else if($_GET["page"] == "Former_cheif"){
	 $sql1= "SELECT `previous_principal`.`id` AS student_id,`previous_principal`.`name` AS student_name,
`previous_principal`.`designation` AS class_roll,`previous_principal`.`to` AS class_name FROM `previous_principal` ORDER BY id ASC $limit";
	
	}else if($_GET["page"] == "member"){
	 $sql1= "SELECT `comitte_members_information`.`id` AS student_id,`comitte_members_information`.`name`
 AS student_name, `comitte_members_information`.`designation`
  AS class_roll,`comitte_members_information`.`mobile_no` 
AS class_name,`gender` FROM  comitte_members_information ORDER BY `id` ASC  $limit";
	
	}else if($_GET["page"] == "doner"){
	 $sql1= "SELECT `donermembersinfo`.`id` AS student_id,`donermembersinfo`.`name` AS student_name,
`donermembersinfo`.`designation` AS class_roll,`donermembersinfo`.`mobile_no` AS class_name,`gender`
FROM `donermembersinfo` where type='".$_GET["cls"]."' ORDER BY `id` ASC  $limit";
	
	}else if($_GET["page"] == "gurdian"){
	 $sql1= "SELECT `pta_information`.`id` AS student_id,`pta_information`.`name` AS student_name,
`pta_information`.`designation` AS class_roll,`pta_information`.`mobile_no` AS class_name FROM `pta_information`
ORDER BY `id` ASC  $limit";
	
	}
				
	
	
	$result1=$db->select_query($sql1);
	$textline1= "Commetee Members(<b>$rows</b>)";
	$textline2="Page<b>$pagenum</b>of<b>$last</b>";
	$pagenationCtrl = '';
	if($last != 1){
		
			if($_GET["page"] == "gpstudent"){
		
		if($pagenum > 1 )
		{
			$previous = $pagenum-1;
			$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page=gpstudent&cls='.$_GET['cls'].'&gpid='.$_GET['gpid'].'&pn='.$previous.'" >Previous</a> &nbsp;';
				for($i = $pagenum-4;$i < $pagenum; $i++){
					
					if($i > 0){
						
						$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page=gpstudent&cls='.$_GET['cls'].'&gpid='.$_GET['gpid'].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					}
					
				}
		}



			for($i = $pagenum+1;$i <= $last; $i++){
					$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page=gpstudent&cls='.$_GET['cls'].'&gpid='.$_GET['gpid'].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					if($i >= $pagenum+4){
						
						break;
					}
					
				}
				
				if($pagenum != $last)
				{
					$next=$pagenum+1;
					$pagenationCtrl.='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page=gpstudent&cls='.$_GET['cls'].'&gpid='.$_GET['gpid'].'&pn='.$next.'" >Next</a>';
				}
				
			}else if($_GET["page"] == "clsstudent" or $_GET["page"] == "teacherinfo" or $_GET["page"] == "staff" or $_GET["page"] == "Former_cheif"  or $_GET["page"] == "member" or $_GET["page"] == "doner" or $_GET["page"] == "gurdian"){
			
			
		if($pagenum > 1 )
		{
			$previous = $pagenum-1;
			$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&cls='.$_GET['cls'].'&pn='.$previous.'" >Previous</a> &nbsp;';
				for($i = $pagenum-4;$i < $pagenum; $i++){
					
					if($i > 0){
						
						$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&cls='.$_GET['cls'].'&pn='.$i.'">'.$i.'</a> &nbsp;';
					}
					
				}
		}



			for($i = $pagenum+1;$i <= $last; $i++){
					$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&cls='.$_GET['cls'].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					if($i >= $pagenum+4){
						
						break;
					}
					
				}
				
				if($pagenum != $last)
				{
					$next=$pagenum+1;
					$pagenationCtrl.='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&cls='.$_GET['cls'].'&pn='.$next.'" >Next</a>';
				}
			
			}	
				
	}
if($result1){
	
	while($fetch=$result1->fetch_object()){
	
					if($_GET["page"] == "clsstudent" or $_GET["page"] == "gpstudent"){
								$href="?page=stdview&stid=".$fetch->student_id;
					}else if($_GET["page"] == "teacherinfo"){
								$href="?page=stdview&teacherid=".$fetch->student_id;
					}else if($_GET["page"] == "staff"){
								$href="?page=stdview&staffid=".$fetch->student_id;
					}else if($_GET["page"] == "Former_cheif"){
								$href="?page=stdview&fcid=".$fetch->student_id;
					}else if($_GET["page"] == "member"){
						$href="?page=stdview&memid=".$fetch->student_id;
					}else if($_GET["page"] == "doner"){
						$href="?page=stdview&donerid=".$fetch->student_id;
					}else if($_GET["page"] == "gurdian"){
						$href="?page=stdview&gurdian=".$fetch->student_id;
					}
				?>
						<a href="<?php echo $href;?>"  style="color:#000000">
						
						
						<div class="col-md-12 col-xs-12 table-bordered visible-xs visible-sm hidden-lg hidden-md">
									<table  class="table table-bordered" style="width:100%;	">
										<tbody>
												<tr>
														<td colspan="2">
																	<?php
									 $src = "other_img/$fetch->student_id.jpg";
								
								
								if($_GET["page"] == "Former_cheif" or $_GET["page"] == "gurdian"){
								if (file_exists($src)) {
								?>
									<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle; padding-top:2px;" />
								<?php }else{
								?>
								<img src="other_img/male.png" style="width:100%; height:180px; vertical-align:middle;padding-top:2px;" />
								<?php
				       			}	}else {
								
									if($fetch->gender =="Male" or $fetch->gender =="male" ){
									
									if (file_exists($src)) {
									
									?>
									<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle;padding-top:2px;" />
									<?php
									} else {
									?>
									<img src="other_img/male.png" style="width:100%; height:180px; vertical-align:middle;padding-top:2px;" />
									<?php 
									
									} } else{ if(file_exists($src)) {
									
										?>
										<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle;padding-top:2px;" />
									<?php
									} else { ?>
									
										<img src="other_img/femaleImage.jpg" style="width:100%; height:180px; vertical-align:middle;padding-top:2px;" />
										
										<?php  } } } ?>
											
														
														</td>
												</tr>
												
											<tr>
																		<td width="21%" height="39"><span class="changetitle">Name</span> </td>
																		<td width="77%"><span class="changetitle"><?php echo $fetch->student_name?></span> </td>
																		
										  </tr>
																<tr>
																	
																		<td height="31" >
																		
																	<span class="changetitle">	
																		<?php
																	
																			if($_GET["page"] == "teacherinfo" or $_GET["page"] == "staff" or $_GET["page"] == "member" or $_GET["page"] == "doner" or $_GET["page"] == "gurdian" or $_GET["page"] == "Former_cheif")
																				{
																	?>
																	Designation
																	<?php  } else {?>
																		Roll
																		
																		<?php }  ?>																		</td>
																		
																		
																		</span>
																		
																		<td width="2%"><span class="changetitle"><?php echo $fetch->class_roll?></span></td>
																		
																</tr>
																<tr>
																		
																		
																		<td height="32" >
																		
																		<span   class="changetitle">	<?php
																	
																			if($_GET["page"] == "teacherinfo" or $_GET["page"] == "staff" or $_GET["page"] =="member" or $_GET["page"] == "doner" or $_GET["page"] == "gurdian" or $_GET["page"] == "Former_cheif")
																				{
																	?>
																Mobile No
																	<?php  } else {?>
																		Class Name
																		
																		<?php }  ?>																		</td>
																		
																		</span>
																		
																		
																		<td><span class="changetitle"><?php echo $fetch->class_name?></span></td>
																		
																</tr>
																
																<tr>
																		
																		
																		
																	
																		
																		
																		<td height="21" colspan="2" align="center"><a  href="<?php echo $href;?>"  class="btn btn-danger btn-sm">
																		Details</a></td>
																		
																</tr>
										</tbody>
									</table>
						</div>
						
						<div class="col-md-6 col-xs-12 table-bordered hidden-xs hidden-sm visible-lg visible-md" style="margin:0px; padding:0px; height:180px; margin-top:10px;">
									<div class="col-md-4 col-xs-4" style="margin:0px; padding:0px">
									
										<?php
									 $src = "other_img/$fetch->student_id.jpg";
								
								
								if($_GET["page"] == "Former_cheif" or $_GET["page"] == "gurdian"){
								if (file_exists($src)) {
								?>
									<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle" />
								<?php }else{
								?>
								<img src="other_img/male.png" style="width:100%; height:180px; vertical-align:middle" />
								<?php
				       			}	}else {
								
									if($fetch->gender =="Male" or $fetch->gender =="male" ){
									
									if (file_exists($src)) {
									
									?>
									<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle" />
									<?php
									} else {
									?>
									<img src="other_img/male.png" style="width:100%; height:180px; vertical-align:middle" />
									<?php 
									
									} } else{ if(file_exists($src)) {
									
										?>
										<img src="<?php echo $src;?>" style="width:100%; height:180px; vertical-align:middle" />
									<?php
									} else { ?>
									
										<img src="other_img/femaleImage.jpg" style="width:100%; height:180px; vertical-align:middle" />
										
										<?php  } } } ?>
											
									
									
									
									
									</div>
									<div class="col-md-8 col-xs-8 hidden-xs hidden-sm visible-lg visible-md" style="margin:0px; padding:0px" id="studentview">
											
												<table  class="table table-bordered" style="width:100%;	">
														<tbody>
																<tr>
																		<td width="35%" height="52"><span class="changetitle">Name</span> </td>
																		<td width="63%"><span class="changetitle"><?php echo $fetch->student_name?></span> </td>
																		
																</tr>
																<tr>
																	
																		<td height="33" >
																		
																	<span class="changetitle">	
																		<?php
																	
																			if($_GET["page"] == "teacherinfo" or $_GET["page"] == "staff"  or $_GET["page"] =="member" or $_GET["page"] == "doner" or $_GET["page"] == "gurdian" or $_GET["page"] == "Former_cheif")
																				{
																	?>
																	Designation
																	<?php  } else {?>
																		Roll
																		
																		<?php }  ?>																		</td>
																		
																		
																		</span>
																		
																		<td width="2%"><span class="changetitle"><?php echo $fetch->class_roll?></span></td>
																		
																</tr>
																<tr>
																		
																		
																		<td height="21" >
																		
																		<span  class="changetitle">	<?php
																	
																			if($_GET["page"] == "teacherinfo" or $_GET["page"] == "staff"  or $_GET["page"] =="member" or $_GET["page"] == "doner" or $_GET["page"] == "gurdian" or $_GET["page"] == "Former_cheif")
																				{
																	?>
																Mobile No
																	<?php  } else {?>
																		Class Name
																		
																		<?php }  ?>																		</td>
																		
																		</span>
																		
																		
																		<td><span class="changetitle"><?php echo $fetch->class_name?></span></td>
																		
																</tr>
																
																<tr>
																		
																		
																		
																	
																		
																		
																		<td height="21" colspan="2" align="center"><a href="<?php echo $href;?>"  class="btn btn-danger btn-sm">
																		Details</a></td>
																		
																</tr>
														</tbody>
									  </table>
										
									</div>
						</div></a>
						
						<?php  }  } ?>
						
							<div style="margin:0px; padding:0px; text-align:center"><span>Total : <?php echo $rows;?></span></div>
						
							
							<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
							
								
								<br/>
								<br/>
								<!-- Go to www.addthis.com/dashboard to customize your tools --> Share with :<div class="addthis_inline_share_toolbox"></div>
				</div>
				
				<div class="center" style='text-align:center;'>
				<div class="pagination">
							<?php echo $pagenationCtrl;?>
				</div>
			</div>
						
						
				
		</div>
		
		
		
		
</div>