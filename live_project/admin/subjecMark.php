

<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	$prefix=date("y"."m"."d");
	$idd=$db->withoutPrefix('subject_information','SubInfoID',"38".$prefix,'12');

	if(isset($_POST["markadd"]))
	{
		$ClassId=explode('and',$_POST["ClassId"]);
		$examID=explode('and',$_POST["examID"]);
		$GroupId=explode('and',$_POST["GroupId"]);
		$parid=$db->escape($_POST["PartID"]);
		$subID=$db->escape($_POST["subID"]);
		
		if(!empty($_POST["cnAss"]))
		{
			$cnAss=$db->escape($_POST["cnAss"]);
		}
		else
		{
			$cnAss=0;
		}
		if(!empty($_POST["Cretive"]))
		{
			$Cretive=$db->escape($_POST["Cretive"]);
		}
		else
		{
			$Cretive=0;
		}
		if(!empty($_POST["mcqmak"]))
		{
			$mcqmak=$db->escape($_POST["mcqmak"]);
		}
		else
		{
			$mcqmak=0;
		}
		if(!empty($_POST["practical"]))
		{
			$practical=$db->escape($_POST["practical"]);
		}
		else
		{
			$practical=0;
		}
		
		$total=$db->escape($_POST["total"]);
		$sql ="INSERT INTO `subject_information` (`SubInfoID`,`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`) VALUES ('$idd','$ClassId[0]','$examID[0]','$GroupId[0]','$subID','$parid','$cnAss','$Cretive','$mcqmak','$practical','$total')";
		$result=$db->insert_query($sql);
			$idd=$db->withoutPrefix('subject_information','SubInfoID',"38".$prefix,'12');


		if($db->sms)
		{
			echo $db->sms;
		}
	}
	
	if(isset($_POST["subinfoid"]))
	{
		$subinfoid=$db->escape($_POST["subinfoid"]);
		$exType=explode('and',$_POST["exType"]);
		$clID=explode('and',$_POST["clID"]);
		//print $clID;
		$GpID=explode('and',$_POST["GpID"]);
		$subId=$db->escape($_POST["subId"]);
		$subParId=$db->escape($_POST["subParId"]);
		$subCode=$db->escape($_POST["subCode"]);
		if(!empty($_POST["countAss"])){
		$countAss=$db->escape($_POST["countAss"]);
		} else { $countAss=0; }
		if(!empty($_POST["creative"])){
		$creative=$db->escape($_POST["creative"]);
		}  else {
			$creative=0;
		}
		if(!empty($_POST["Mcq"])){
		$Mcq=$db->escape($_POST["Mcq"]);
		}else { $Mcq=0; }
		if(!empty($_POST["Partical"])){
		$Partical=$db->escape($_POST["Partical"]);
		} else { $Partical=0;}
		$total=$db->escape($_POST["total"]);
		//print "aaa";
		
		/*$sql3="UPDATE `subject_information` SET `examID`='".$_POST["exType"]."' AND `classID`='$clID' AND `groupID`='$GpID' AND `subjectId`='$subId' AND `subPartId`='$subParId' AND `ContAss`='$countAss'
AND `Creative`='$creative' AND  `MCQ`='$Mcq' AND `practical`='$Partical' AND `total`='$total' WHERE `SubInfoID`='$subinfoid'";
print_r($sql3);*/
		$ddd5="REPLACE INTO `subject_information` (`SubInfoID`,`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`)
VALUES ('$subinfoid','$clID[0]','$exType[0]','$GpID[0]','$subId','$subParId','$countAss','$creative','$Mcq','$Partical','$total');";
//print_r($slq5);*/
		$reeee=$db->update_query($ddd5);
		if($db->sms)
		{
			echo $db->sms;
		}
	}
	
	
	
	if(isset($_POST["ViewAll"])){
	
			
				$out='';
				$a=0;
				$className  = explode('and',$_POST["className"]);
				$groupname  = explode('and',$_POST["groupname"]);
				$examtype   = explode('and',$_POST["examtype"]);
				
				?>
				
				
					<table class="table table-responsive table-hover table-bordered" style="margin-top:20px"><tr><td  colspan="11"><input type="button" onClick="return backPage()" name="Back" id="BackMark" class="btn btn-danger btn-sm" value="BACK"/></td></tr>
					<?php 
			 $sql="SELECT `subject_information`.`classID`,`add_class`.`class_name` FROM `subject_information`
INNER JOIN `add_class` ON `add_class`.`id`=`subject_information`.`classID` where subject_information.classID=$className[0] group by subject_information.classID";
			$chek=$db->select_query($sql);
			if($chek){
				while($fetch_class=$chek->fetch_object()){
				?>
					<tr><td align="center" colspan="11"><span class="text-success text-center"><strong><?php echo $fetch_class->class_name ?></strong></span></td></tr>
					<?php 
					
					 $sql2="SELECT `subject_information`.`groupID`,`subPartId`,`add_group`.`group_name` FROM `subject_information`
INNER JOIN `add_group` ON `add_group`.`id`=`subject_information`.`groupID` WHERE `subject_information`.`groupID`=$groupname[0] group by `subject_information`.`groupID`";
					$chke6=$db->select_query($sql2);
					if($chke6){
						while($fetch_all=$chke6->fetch_object()){
							?>
							<tr><td align="center" colspan="11" class="text-success"><strong><?php echo $fetch_all->group_name?></strong></td></tr>
							<?php 
							/*$sql77="SELECT * FROM `subject_information` WHERE `classID`='".$fetch_class->classID."' AND `groupID`='".$fetch_all->groupID."'";
							$result77=$db->select_query($sql77);
							if($result77){
								$fet777=$result77->fetch_object();
							}*/
							/*if($fet777->subPartId != 'NULL')
							{
							$sq45="SELECT `subject_information`.`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,`SubInfoID`,`add_subject_info`.`subject_name`,subject_code,select_subject_type,`add_subject_part_info`.`subject_part_name`,subject_part_code,`exam_type_info`.`exam_type`
FROM `subject_information` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId`
JOIN `add_subject_part_info` ON `add_subject_part_info`.`part_id`=`subject_information`.`subPartId` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID`
 WHERE `subject_information`.`classID`='".$fetch_class->classID."'
AND `subject_information`.`groupID`='".$fetch_all->groupID."'";
							print($sq45);
							} else {
								*/
							 $sq45="SELECT `subject_information`.`SubInfoID`,`classID`,`examID`,`groupID`,`subjectId`,`subPartId`,`ContAss`,`Creative`,`MCQ`,`practical`,`total`,`add_subject_info`.`subject_name`,subject_code,select_subject_type,`exam_type_info`.`exam_type`
FROM `subject_information` JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_information`.`subjectId`
 JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`subject_information`.`examID`
 WHERE `subject_information`.`classID`='".$fetch_class->classID."'
AND `subject_information`.`groupID`='".$fetch_all->groupID."' and `subject_information`.`examID`=$examtype[0] ORDER BY `add_subject_info`.`serial`";
//print($sq45);
									
							//}

							$rel64=$db->select_query($sq45);
							?>
							<tr align="center">
								  <td width="69" rowspan="2" style="padding-top:40px" >Exam Type</td>
								  <td width="87" rowspan="2"  style="padding-top:40px">Subject Name</td>
								  <td width="84" rowspan="2"  style="padding-top:40px">Subject Code</td>
								  <td width="116" rowspan="2"  style="padding-top:40px">Subject Part Name</td>
								  <td width="63" rowspan="2"  style="padding-top:40px">Part Code</td>
								  <td height="53" colspan="5"  style="padding-top:15px">Marks</td>
								  <td width="178" rowspan="2"  style="padding-top:40px">Edit & Delete </td>
					  </tr>
								<tr align="center">
								  <td width="64" height="51">Count Ass</td>
								  <td width="51">Creative</td>
								  <td width="37">MCQ</td>
								  <td width="45">Partical</td>
								  <td width="31">Total</td>
								  
							  </tr>
							
							<!--<tr><td>Exam Type</td><td>Subject Name</td><td>Subject Code</td><td>Subject Part Name</td><td>Part Code</td><td>Count Ass</td><td>Creative</td><td>MCQ</td><td>Partical</td><td>Total</td><td>Edit</td></tr>-->
						<?php 
							
							if($rel64){
							while($f45=$rel64->fetch_array()){
							//print_r($f45);
							if($f45["subPartId"]=="NULL")
							{
								$code=$f45["subject_code"];
							}
							else
							{
								$code=$f45["subject_part_code"];
							}
							$a++;
									//$a=$f45[0];
									?>
									<!--modell -->
<div class="modal fade " id="<?php echo $f45["SubInfoID"] ?>" tabindex="-1" role="dialog" aria-labelledby="akashlebel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="width:1060px; margin-left:-80px">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-lebel="close">
						<span aria-hidden="true" >&times;</span>
						<span class="sr-only"></span>
					</button>
					<h4 class="modal-title text-danger" id="akashlebel"> <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Edit <?php echo $f45["subject_name"] ; ?>&nbsp;Subject Mark Distribution</strong></span></h4>
				</div>
				<div class="modal-body" style="height:400px">
						
						<div class="table-bordered" style="height:50px;">
							<strong><span class="text-success" style="font-size: 15px; "><div class="col-md-3  col-lg-3" style="padding:10px">Select Class &nbsp;</div> <div class="col-md-1" style="padding:10px">:</div></span></strong>
							<div class="col-md-8 col-lg-8"  style="padding:7px"> <select style="width:280px;" class="form-control" name="clID"  id="clID-<?php echo $f45["SubInfoID"];?>" onchange="return chekgpEx('<?php echo $f45["SubInfoID"];?>')">
					 <option value="<?php echo "$fetch_class->classID".'and'."$fetch_class->class_name" ?>"><?php echo $fetch_class->class_name;?></option>
                        
                        <?php 
                            $ee="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `index` ASC";
                            $check=$db->select_query($ee);
                            if($check){
                                while($fetchhh=$check->fetch_array())
                                {
                        ?>
                        <option value="<?php echo "$fetchhh[0]and$fetchhh[2]"?>"><?php echo $fetchhh[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select>
							</div>
						</div>
						
						<div class="table-bordered" style="height:50px;">
							<strong><span class="text-success" style="font-size: 15px; "><div class="col-md-3  col-lg-3" style="padding:10px">Exam Type &nbsp;</div> <div class="col-md-1" style="padding:10px">:</div></span></strong>
							<div class="col-md-8 col-lg-8"  style="padding:7px"> 
								<input type="hidden" name="subinfoid" id="subinfoid-<?php echo $f45["SubInfoID"]?>" value="<?php echo $f45["SubInfoID"];?>"/>								
								<select style="width:280px" class="form-control" name="extype" id="extype-<?php echo $f45["SubInfoID"];?>">
								<option value="<?php echo "$f45[examID]and$f45[exam_type]" ?>"><?php echo $f45["exam_type"] ?></option>
								
								</select>
							</div>
						</div>
						
						
						
					<div class="table-bordered" style="height:50px;">
							<strong><span class="text-success" style="font-size: 15px; "><div class="col-md-3  col-lg-3" style="padding:10px">Select Group &nbsp; </div><div class="col-md-1" style="padding:10px">:</div></span></strong>
							<div class="col-md-8 col-lg-8"  style="padding:7px"> 
								<select style="width:280px" onchange="return chekSubType('<?php echo $f45["SubInfoID"];?>')" class="form-control" name="grName" id="grName-<?php echo $f45["SubInfoID"];?>">
								<option value="<?php echo "$fetch_all->groupID".'and'."$fetch_all->group_name" ?>"><?php echo $fetch_all->group_name ?></option>
								</select>
							</div>
						</div>
						
						<div class="table-bordered" style="height:50px;">
							<strong><span class="text-success" style="font-size: 15px; "><div class="col-md-3  col-lg-3" style="padding:10px">Select Subject Type &nbsp;</div> <div class="col-md-1" style="padding:10px">:</div></span></strong>
							<div class="col-md-8 col-lg-8"  style="padding:7px"> 
								<select style="width:280px" class="form-control" name="sbType" id="sbType-<?php echo $f45["SubInfoID"];?>" onchange="return SubName('<?php echo $f45["SubInfoID"];?>')">
								<option value="<?php echo $f45["subjectId"] ?>"><?php echo $f45["select_subject_type"] ?></option>
								</select>
							</div>
						</div>
						
						
						<div class="table-bordered" style="height:150px; padding-top:10px;">
									<div class="col-md-6 col-lg-6 table-bordered" style="height:30px;padding-top:5px">
											<div class="col-md-4 col-lg-4"><span class="text-success"><strong>Subject Name</strong></span></div>
											<div class="col-md-4 col-lg-4"><span class="text-success"><strong>Subject Part</strong></span></div>
											<div class="col-md-4 col-lg-4"><span class="text-success"><strong>Subject Code</strong></span></div>
									</div>
								
									<div class="col-md-6 col-lg-6 table-bordered" style="text-align:center;height:30px; padding-top:5px"><span class="text-success"><strong>Marks</strong></span></div>
									<div class="col-md-6 col-lg-6 table-bordered" style="height:90px">
											<div class="col-md-4 col-lg-4" style="padding-top:20px;">
											<select name="subN" id="subN-<?php echo $f45["SubInfoID"];?>" onchange="return subNC('<?php echo $f45["SubInfoID"]; ?>')" class="form-control">
											<option value="<?php echo $f45["subjectId"] ?>"><?php echo $f45["subject_name"] ?></option>
											</select>
											</div>
											<div class="col-md-4 col-lg-4"  style="padding-top:20px;"><select name="subNpN" onchange="return SubParC('<?php echo $f45["SubInfoID"];?>')" id="subNpN-<?php echo $f45["SubInfoID"];?>"   class="form-control">
											<option value="<?php echo $f45["subPartId"] ?>"><?php echo $f45["subject_part_name"] ?></option>
											</select></div>
											<div class="col-md-4 col-lg-4"  style="padding-top:20px;"><input type="text" value="<?php echo $code;?>" name="subC" id="subC-<?php echo $f45["SubInfoID"];?>" class="form-control" /></div>
									</div>
									<div class="col-md-6 col-lg-6 table-bordered" style="height:40px; padding-top:5px">
										<div class="col-md-3 col-lg-3"><span class="text-success"><strong>Count.Ass.</strong></span></div>
										<div class="col-md-2 col-lg-2"><span class="text-success"><strong>Creative</strong></span></div>
										<div class="col-md-2 col-lg-2"><span class="text-success"><strong>MCQ.</strong></span></div>
										<div class="col-md-2 col-lg-2"><span class="text-success"><strong>Practical</strong></span></div>
										<div class="col-md-3 col-lg-3"><span class="text-success"><strong>Total</strong></span></div>
									</div>
									<div class="col-md-6 col-lg-6 table-bordered" style="height:50px; padding-top:5px">
										<div class="col-md-3 col-lg-3"><input type="text" class="form-control" id="countass-<?php echo $f45["SubInfoID"];?>" name="countass" placeholder="00" maxlength="3" onkeyup="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" onchange="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" value="<?php echo $f45["ContAss"];?>" ></input></div>
										<div class="col-md-2 col-lg-2"><input type="text" class="form-control" id="theory_written-<?php echo $f45["SubInfoID"];?>" name="theory_written" placeholder="00"  maxlength="3" onkeyup="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" onchange="TotalGenerat('<?php echo $f45["SubInfoID"];?>');"  value="<?php echo $f45["Creative"];?>" ></input></div>
										<div class="col-md-2 col-lg-2"><input class="form-control" type="text" id="mcq_mark-<?php echo $f45["SubInfoID"];?>" name="mcq_mark" placeholder="00"  maxlength="3" onkeyup="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" onchange="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" value="<?php echo $f45["MCQ"] ?>" ></input></div>
										<div class="col-md-2 col-lg-2"><input type="text" class="form-control" id="practical-<?php echo $f45["SubInfoID"];?>" name="practical" placeholder="00"  maxlength="3" onkeyup="TotalGenerat('<?php echo $f45["SubInfoID"];?>');"  onchange="TotalGenerat('<?php echo $f45["SubInfoID"];?>');" value="<?php echo  $f45["practical"] ?>"></input></div>
										<div class="col-md-3 col-lg-3"><input type="text" class="form-control" id="total-<?php echo $f45["SubInfoID"];?>" value="<?php echo $f45["total"]; ?>" name="total" placeholder="00"   readonly  ></input></div>
									</div>

						</div>
						
						
				</div>
				<div class="modal-footer" align="right">
				<span id="showMsg"></span>
				<!--	<input type="button" class="btn btn-success" value="Save" onclick="return UpdatSubjectMark('<?php echo $f45["SubInfoID"] ?>')" style="width:120px" />-->
					<input type="button" class="btn btn-danger" value="Close" data-dismiss="modal" aria-lebel="close" style="width:120px"  />
				</div>
			</div>
		</div>
	</div>
									<!--end model-->
									
									
									
									
									
									
									
									
									
	
									<tr id="hidetr<?php echo $f45["SubInfoID"]; ?>"><td><?php echo $f45["exam_type"] ?></td><td><span style="text-transform: uppercase;"> <?php echo $f45["subject_name"]?> </span></td><td><?php echo $f45["subject_code"] ?></td><td><?php 
										$sqlsubpar="SELECT `subject_part_name`,`subject_part_code` FROM  `add_subject_part_info` WHERE `part_id`='".$f45["subPartId"]."'";
										$result=$db->select_query($sqlsubpar);
										if($result){
										$fetch_subPart=$result->fetch_array();
									echo $fetch_subPart["subject_part_name"];}else {echo $fetch_subPart["subject_part_name"]=""; } ?></td><td><?php 
										$sqlsubpar="SELECT `subject_part_name`,`subject_part_code` FROM  `add_subject_part_info` WHERE `part_id`='".$f45["subPartId"]."'";
										$result=$db->select_query($sqlsubpar);
										if($result){
										$fetch_subPart=$result->fetch_array();
									echo $fetch_subPart["subject_part_code"];}else {echo $fetch_subPart["subject_part_code"]=""; } ?></td><td><?php echo $f45["ContAss"] ?></td><td><?php echo $f45["Creative"] ?></td><td><?php echo $f45["MCQ"] ?></td><td><?php echo $f45["practical"] ?></td><td><?php echo $f45["total"] ?></td><td>
								
									
									
									<input type="button" onClick="return deleteBYid('<?php echo $f45["SubInfoID"]; ?>')" value="Delete" class="btn btn-success btn-sm"  style="width:80px;"   />
									
									
								</td></tr>
								
							
									
							<?php	}	
							}
						}
					}
					
					
				}
				
			}?>
		</table>
	
	<?php }


if(isset($_POST["deletid"])  && !empty($_POST["deletid"])){
		$delete = "DELETE FROM subject_information WHERE SubInfoID='".$_POST["deletid"]."'";
		$resutlDelete= $db->delete_query($delete);
			
}

?>
