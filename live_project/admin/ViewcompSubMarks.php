  <?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	$className=explode('and',$_POST["className"]);
	$examtype=explode('and',$_POST["examtype"]);
	$session=$_POST["session"];
	
	
 

?>
<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPrint{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
<table class="table table-responsive table-hover table-bordered" style="margin-top:10px">
		<?php 
				$sql1="SELECT `marksheet`.*,`add_class`.`class_name` FROM `marksheet` INNER JOIN `add_class` ON `add_class`.`id`=`marksheet`.`ClassId`  WHERE `marksheet`.`ClassId`='$className[0]' AND  `marksheet`.`ExamId`='$examtype[0]' AND `marksheet`.`Session`='$session' GROUP BY `marksheet`.`ClassId` AND `marksheet`.`Session`";
				//print $sql1;
				$chek1=$db->select_query($sql1);
				if($chek1){
				while($fetch1=$chek1->fetch_array()){
		?>
		<tr>
		  <td width="94" colspan="0" class="dontPrint"><input type="button" name="back" id="back" value="BACK" onclick="return ShowBack()" class="btn btn-sm btn-danger noneBtnForprin" /></td><td colspan="4" align=""><strong><span class="text-success text-center" style="font-size:15px; padding-left:200px;"><?php echo $fetch1["class_name"]."&nbsp;(".$fetch1["Session"].")";?></span></strong></td>
		  
		 
		</tr>
		<?php
				$sql2="SELECT `marksheet`.*,`exam_type_info`.`exam_type` FROM `marksheet` INNER JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`marksheet`.`ExamId`  WHERE `marksheet`.`ClassId`='".$fetch1["ClassId"]."' AND  `marksheet`.`ExamId`='$examtype[0]' AND  `marksheet`.`Session`='".$fetch1["Session"]."' GROUP BY `marksheet`.`ExamId`";
				$chek_2=$db->select_query($sql2);
				if($chek_2){
				while($fetch_2=$chek_2->fetch_array()){
		 ?>
				<tr>
			<td colspan="4" align="center"><strong><span class="text-success text-center" style="font-size:15px; padding-left:0px;"><?php echo $fetch_2["exam_type"];?></span></strong></td>
		</tr>
		<?php
				$sql3="SELECT `marksheet`.*,`add_group`.`group_name` FROM `marksheet` INNER JOIN `add_group` ON `add_group`.`id`=`marksheet`.`GroupID` WHERE `marksheet`.`ClassId`='".$fetch_2["ClassId"]."' AND `marksheet`.`ExamId`='".$fetch_2["ExamId"]."' AND `marksheet`.`Session`='".$fetch_2["Session"]."' GROUP BY `marksheet`.`GroupID` ORDER BY `add_group`.`group_name` ASC";
			$chek34=$db->select_query($sql3);
			if($chek34){
				while($fetch34=$chek34->fetch_array()){
			
?>		<tr>
			<td colspan="4" align="center"><strong><span class="text-success text-center" style="font-size:15px; padding-left:0px;"><?php echo $fetch34["group_name"];?></span></strong></td>
		</tr>
		<?php
				$sql4="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet` INNER JOIN `add_subject_info`
ON `add_subject_info`.`id`=`marksheet`.`SubjectId` WHERE `marksheet`.`ClassId`='".$fetch34["ClassId"]."' AND `marksheet`.`ExamId`='".$fetch34["ExamId"]."' AND `marksheet`.`GroupID`='".$fetch34["GroupID"]."' AND `marksheet`.`Session`='".$fetch34["Session"]."' GROUP BY  `add_subject_info`.`select_subject_type` ORDER BY `add_subject_info`.`select_subject_type` ASC";
				$chek4=$db->select_query($sql4);
				if($chek4){
				while($fetch_4=$chek4->fetch_array()){
		?>
		<tr>
			<td colspan="4" align="center"><strong><span class="text-success text-center" style="font-size:15px; padding-left:0px;"><?php echo $fetch_4["select_subject_type"];?></span></strong></td>
		</tr>
		<tr align="center">
			<td><span style="font-size:15px; font-weight:800" class="text-danger">Subject Code</span></td>
			<td width="122"><span style="font-size:15px; font-weight:800" class="text-danger">Subject Name</span></td>
				<td width="153"><span style="font-size:15px; font-weight:800" class="text-danger">Subject Part Code</span></td>
			<td width="153"><span style="font-size:15px; font-weight:800" class="text-danger">Subject Part Name</span></td>
		</tr>
		<?php 
				$sp="SELECT `marksheet`.*,`add_subject_info`.`select_subject_type` FROM `marksheet`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`marksheet`.`SubjectId`
WHERE `marksheet`.`ClassId`='".$fetch34["ClassId"]."' AND `marksheet`.`ExamId`='".$fetch34["ExamId"]."' AND `marksheet`.`Session`='".$fetch34["Session"]."' 
AND `marksheet`.`GroupID`='".$fetch34["GroupID"]."' AND `add_subject_info`.`select_subject_type`='".$fetch_4["select_subject_type"]."'  GROUP BY `marksheet`.`SubjectId`";
				$cp=$db->select_query($sp);
				if($cp){
				while($fp=$cp->fetch_array()){
				$gp="SELECT * FROM `marksheet` WHERE `ClassId`='".$fetch34["ClassId"]."' AND `ExamId`='".$fetch34["ExamId"]."' AND `Session`='".$fetch34["Session"]."' AND SubjectId='".$fp["SubjectId"]."'  AND `GroupID`='".$fetch34["GroupID"]."' GROUP BY `SubjectPartID`";
				$gps=$db->select_query($gp);
				if($gps){
				while($cps=$gps->fetch_array()){
				
		?>
				
		<tr align="center">
			<td><span style="font-size:15px; font-weight:800" class="text-danger"><?php
			$t="SELECT `add_subject_info`.`subject_code`,`subject_name` FROM `add_subject_info` WHERE `id`='".$fp["SubjectId"]."'";
			//print $t;
			$t2=$db->select_query($t);
			if($t2)
			{
				$f2=$t2->fetch_array();
			}
			 echo $f2["subject_code"];?></span></td>
			<td><span style="font-size:15px; font-weight:800" class="text-danger"><?php echo $f2["subject_name"]?></span></td>
				<td><span style="font-size:15px; font-weight:800" class="text-danger">
					<?php
						$PartSql="SELECT `add_subject_part_info`.`subject_part_code`,`subject_part_name` FROM `add_subject_part_info` WHERE  `subject_name`='".$fp["SubjectId"]."' AND `part_id`='".$cps["SubjectPartID"]."'";
						//print $PartSql;
						$chekPar=$db->select_query($PartSql);
						if($chekPar){
							$fetchPart=$chekPar->fetch_array();
						}
						else
						{
							$fetchPart["subject_part_name"]="";
							$fetchPart["subject_part_code"]="";
						}
						echo $fetchPart["subject_part_code"];
						
						
					?>
				</span></td>
			<td><span style="font-size:15px; font-weight:800" class="text-danger">
			<?php echo $fetchPart["subject_part_name"];?></span></td>
		</tr>
		<?php } } ?>
		
		<?php } } ?>
		
		<?php } } ?>		
		
		<?php } } ?>
		
		<?php } } ?>	
		
		<?php } }?>
		<tr>
				<td colspan="4" align="center" class="dontPrint"><input type="button" name="print" value="Print" onclick="window.print()" class="btn btn-danger btn-sm noneBtnForprin" id="print" /></td>
			</tr>
</table>