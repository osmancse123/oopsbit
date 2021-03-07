<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	
?>
<table align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;">
   	
	
		<tr>
				<td align="center" colspan="4"> <strong>Update Session  &nbsp; </strong>
					<input class="form-control"  type="text" value="<?php echo $_POST["session"]?>" name="sss" id="sss"  style="width:280px; border-radius:0px;" />
                </td>
		</tr>
          
            <tr>
				<td align="right"> <strong>Select Class  &nbsp; :</strong></td>
				<td>
					<div class="col-md-12 has-warning">
		
						<select name="className" id="className" class="form-control" onchange="return check_availability()" style="width:250px">
						
								<option>Select One</option>
							<?php 
								$select_section = "SELECT * FROM `add_class`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php }  } ?>
						</select>
                        <span id="item_result"></span>
					</div>
				</td>
                 <td align="right"> <strong>Select Group  &nbsp; :</strong></td>
                <td>
                    <div class="col-md-12 has-warning">
        
                        <select name="groupname" id="groupname" class="form-control" onchange="return check_section_name(),check_compolsary_subject(),check_selective_subject(),check_optional_subject()" style="width:250px"></select>
                        <span id="category_result"></span>
                        <span id="check_section"></span>
                    </div>
                </td>
			</tr>
            
            <tr>
                <td align="right"> <strong>Select Section  &nbsp; :</strong></td>
                <td>
                    <div class="col-md-12 has-warning">
        
                        <select name="section"  id="section" class="form-control" style="width:250px"></select>
                       
                    </div>
                </td>
                <td align="right"> <strong>Compulsory Subject:</strong></td>
                <td><div class="col-md-12">
                    <span id="compolsarysubject"></span> &nbsp;&nbsp;&nbsp;<span id="check_compol_name"></span>

                	</div>
                </td>
            </tr>
            
            

           
            <tr>
            	<td align="right"> <strong>Selective Subject:</strong></td>
            	<td><div class="col-md-12">
                 
                 <span id="selectivesubject"></span>   &nbsp;&nbsp;&nbsp;<span id="check_selectivenae"></span>
                </div>
            	</td>
                <td align="right"> <strong>Optional Subject &nbsp; :</strong></td>
                <td><div class="col-md-12">
                 <span id="select_optional_subject"></span>   &nbsp;&nbsp;&nbsp;<span id="check_optional_name"></span>   
                </div>
                </td>
            </tr>
</table>
	
	<table width="510" align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;">
		<tr align="center">
				<td width="77">Select All<BR/>
					<input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />
		  </td>
				<td width="147">Name</td>
				<td width="121">Roll No</td>
				<td width="64">Religion</td>
				<td width="77">Year</td>
		</tr>
		<?php
		@$explode=explode('and',$_REQUEST['classs']);
		@$explodegp=explode('and',$_REQUEST['gpfffff']);
				     $sqlForAll="SELECT `student_personal_info`.`student_name`,`religious`,`student_acadamic_information`.`session2`,`student_acadamic_information`.`id`  FROM `student_acadamic_information`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_acadamic_information`.`id`
WHERE `student_acadamic_information`.`session2`='".$_POST["session"]."' and `student_acadamic_information`.`admission_disir_class`='$explode[0]'
 and `student_acadamic_information`.`admission_disir_group`='$explodegp[0]'
 ORDER BY `student_personal_info`.`id` ASC   LIMIT ".$_POST["from"].",".$_POST["to"]."";
			$resultForAll=$db->select_query($sqlForAll);
			if($resultForAll){
				while($fetchForAl=$resultForAll->fetch_array()){
				
				$fetchRoll = "SELECT class_roll  FROM `running_student_info` WHERE `student_id`='".$fetchForAl['id']."'";
				$resultroll=$db->select_query($fetchRoll);
			if($resultroll){
					$fetchRoll = $resultroll->fetch_array();
			}
		
		?>
		<tr>
				<td><input type="checkbox" class="check_elmnt" name="chek[]" id="chek-<?php echo $fetchForAl["id"];?>" value="<?php echo $fetchForAl["id"];?>" onclick="return byroollcheked('<?php echo $fetchForAl["id"];?>')" /></td>
				<td><?php echo $fetchForAl["student_name"].'('.$fetchForAl["id"].')';?></td>
				<td align="center">
				
				
				<input type="text" style="width:50px;" class="roll" name="rollNo[]" id="rollNo-<?php echo $fetchForAl["id"];?>" <?php
				
				
				if($resultroll){
					 ?> value="<?php echo $fetchRoll[0];?>" <?php } ?> required  disabled="disabled"/>
				
				
				</td>
				<td><?php echo $fetchForAl["religious"];?></td>
				<td align="center"><input type="text" id="year[]" name="year[]" value="<?php echo date("Y")?>" style="padding-left:15px; width:120px;" /></td>
		</tr>
		<?php } } ?>
			<tr>
				<td colspan="5" align="right">
					<span id="smsforR"></span>
				</td>
			</tr>
		<tr>
			<td colspan="5" align="right">
				<input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary btn-defualt btn-sm" style="width:150px;" onclick="return Submit()"/>
			</td>
		</tr>
</table>

