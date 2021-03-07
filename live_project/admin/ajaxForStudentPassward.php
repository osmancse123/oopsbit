 <?php 	
 error_reporting(0);
 require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	
		if(isset($_POST["checkboxsingId"])){
					
					if(!empty($_POST["passward"])){
					for($x = 0;$x < count($_POST["checkboxsingId"]); $x++ ){
						
					
							$query = "INSERT INTO `studentpassward`(`id`,`passward`) VALUES('".$_POST["checkboxsingId"][$x]."','".$_POST["passward"][$x]."')";
							$db->insert_query($query);
					}
					}
		}
		
		
		
	?>
	
	
	
	<?php  if(isset($_POST["StringDataddddd"])){
	
			$ClassId=explode('and',$_POST["ClassId"]);
			$groupname=explode('and',$_POST["groupname"]);
			$Session=$db->escape($_POST["Session"]);
			$Session=$db->escape($_POST["Session"]);
			$Session=$db->escape($_POST["Session"]);
			
			?>
			
			<table width="792" height="108" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="40" colspan="5" align="center"><strong class="text-success" style="font-size:16px">Student's Details</strong> </td>
    </tr>
  <tr align="center">
    <td width="66" height="29">Select All <br/><input type="checkbox" name="checkbox" id="chkbx_all" onclick="return check_all();"/> </td>
    <td width="132">Student ID </td>
	 <td width="188">Class Roll </td>
    <td width="150">Passward</td>
   
    
  </tr>
  <?php
  		 $selectAllData ="SELECT `running_student_info`.*,`student_personal_info`.*,`student_acadamic_information`.`session2` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
INNER JOIN  `student_acadamic_information` ON `student_acadamic_information`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='".$ClassId[0]."' AND `running_student_info`.`group_id`='".$groupname[0]."' AND  `student_acadamic_information`.`session2`='$Session'
AND `class_roll` BETWEEN '".$_POST["from"]."' AND '".$_POST["to"]."' 
 GROUP BY `running_student_info`.`student_id` ORDER BY `running_student_info`.`class_roll` ASC";
 $check_query=$db->select_query($selectAllData);
                            if($check_query->num_rows > 0){
                                while($fetch_class=$check_query->fetch_array())
                                {
  ?>
  <tr align="center">
    <td height="34"><input type="checkbox"  id="checkboxsingId-<?php echo $fetch_class['student_id']?>" class="check_elmnt" name="checkboxsingId[]" onclick="return byroollcheked('<?php echo $fetch_class['student_id']?>')" value="<?php echo $fetch_class['student_id']?>"/> </td>
    <td><?php echo $fetch_class['student_id']?>  </td>
	 <td><?php echo $fetch_class['class_roll']?>  </td>
    <td> <input type="text" name="passward[]" id="passward-<?php echo $fetch_class['student_id']?>" class="dd"  disabled="disabled"/> </td>
  
   
  </tr>
  
  <?php  } 
  
  ?>
  	<tr align="center">
		<td height="34" colspan="5" align="right" > 
			
		<input type="button" name="save" id="save" value="Save" class="btn btn-primary btn-defualt btn-sm" style="width:150px;" onclick="return Saveff()"/></td>
    </tr>
  <?php }?>
</table>
<?php  }



	
 ?>