<?php

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
			

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet"></head>
	<script>
			function check_all( parent_chk_bx_id, all_chk_bx_clss)
			{
			//alert('asdf');
			var x,r; 
			r = document.getElementsByClassName(all_chk_bx_clss);
			w=r.length;
			//alert(w);
			if(parent_chk_bx_id.checked== true)
			{
				for(x=0;x < r.length; x++)
				{
					r[x].checked = true;
					//alert (r[x].value);
				}
			}
			else
			{
				for(x=0;x < r.length; x++)
				{
					r[x].checked = false;
				
				}
			}
		}	
		
		$(function() {
		  enable_cb();
		  $("#chkbx_all").click(enable_cb);
		});
		
		function enable_cb() {
		  if (this.checked) {
			$("input#group").prop('disabled', true);
		  } else {
			$("input#group").prop('disabled', false);
		  }
		}
		
		
		
	
				function singleChek(getid){
					if($('#snchek-'+getid).is(':checked')){
						$("input.approved-"+getid).prop('disabled', true);
						$("input.Unapproved-"+getid).prop('disabled', true);
					}else{
					$("input.approved-"+getid).prop('disabled', false);
					$("input.Unapproved-"+getid).prop('disabled', false);
					}
				}
				
				function approvedFun(idget)
				{
					if($('.approved-'+idget).is(':checked')){
							$("input.Unapproved-"+idget).prop('disabled', true);
							$("input#snchek-"+idget).prop('disabled', true);
							$("input#attnTime-"+idget).prop('disabled', true);
							$("input#leavTime-"+idget).prop('disabled', true);
							
					}else{
						$("input.Unapproved-"+idget).prop('disabled', false);
						$("input#snchek-"+idget).prop('disabled', false);
						$("input#attnTime-"+idget).prop('disabled', false);
						$("input#leavTime-"+idget).prop('disabled', false);
					}
				}	
				
				function UNapprovedFun(iget)
				{
					if($('.Unapproved-'+iget).is(':checked')){
							$("input.approved-"+iget).prop('disabled', true);
							$("input#snchek-"+iget).prop('disabled', true);
							$("input#attnTime-"+iget).prop('disabled', true);
							$("input#leavTime-"+iget).prop('disabled', true);
					}else{
						$("input.approved-"+iget).prop('disabled', false);
						$("input#snchek-"+iget).prop('disabled', false);
						$("input#attnTime-"+iget).prop('disabled', false);
						$("input#leavTime-"+iget).prop('disabled', false);
					}
				}
				
			function AddPresent(){
				var morevalue="dd";
				
				$.ajax({
							url:"ajaxForattendance.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&moredata=" + morevalue,
							success:function(text)
							{		
								//alert(text);
								$("#sms").html(text);
							}
							
					});	
			}	
			
			function UpdatePreset(){
				var updateValue="dd";
				
				$.ajax({
							url:"ajaxForattendance.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&updateValue=" + updateValue,
							success:function(text)
							{		
								//alert(text);
								$("#sms").html(text);
							}
							
					});	
			}
	</script>
  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addATeent" >
	 <div class="col-lg-12">
	 		 <table width="1075" class="table table-bordered table-responsive" style="margin-top:10px;">
              <tr>
                <td colspan="8" align="center">&nbsp;<span class="text-success" style="font-size:18px;"><strong>Teacher's attendance</strong></span></td>
              </tr>
              <tr>
                <td colspan="8" align="right">&nbsp;
			<select name="olddate" id="olddate"  style="width:180px; height:28px;">
					
						<option>Select One...</option>
						<?php
								$selecDAte="SELECT `date` FROM `teacherpresent` GROUP BY `date` order by `date` DESC";
								$resultdate=$db->select_query($selecDAte);
									if($resultdate){
											while($fetchREsult=$resultdate->fetch_array()){
						
						?>
									<option><?php echo $fetchREsult["date"];?></option>
						<?php } }?>
					</select>
					&nbsp; 
					<input type="submit" value="submit" name="submit" id="submit"/>
					&nbsp; 
					<input type="submit" value="Clear" name="Clear" id="Clear"/>				</td>
              </tr>
              <tr>
                <td>&nbsp;<span class="text-danger"><strong>Date</strong></span></td>
                <td colspan="7">&nbsp;<input type="text" style="width:180px; height:28px;" name="daterunning" id="daterunning" value="<?php if(isset($_POST["submit"])){ echo $_POST["olddate"]; } else{ echo date('d-m-Y') ;}?>"/></td>
              </tr>
              <tr>
                <td width="55" rowspan="2" align="center"><strong>SL.NO</strong></td>
                <td width="222" rowspan="2" align="center"><strong>Name</strong></td>
                <td width="145" rowspan="2" align="center"><strong>Designation</strong></td>
                <td colspan="3" align="center"><strong>Attendance</strong></td>
                <td colspan="2" align="center"><strong>Absence</strong></td>
              </tr>
              <tr>
                <td width="104" height="46" align="center"><strong><?php if(!isset($_POST["submit"])){?>select All<?php } else {?> Select <?php }?> </strong><br/>
				<?php 
					if(!isset($_POST["submit"])){
				?>
					<input id="chkbx_all"  onclick="check_all(this,'check_elmnt')" type="checkbox"  />
				<?php } ?>
				</td>
                <td width="103" align="center"><strong>Attendance Time </strong></td>
                <td width="107" align="center"><strong>Leaving Time</strong></td>
                <td width="141" align="center"><strong>Approved</strong></td>
                <td width="146" align="center"><strong>Unapproved</strong></td>
              </tr>
			  
			  <?php
			  if(!isset($_POST["submit"])){
			  		$sql="SELECT * FROM `teachers_information` WHERE `Type`='Teacher' ORDER BY `index_no` ASC";
					$resultsql=$db->select_query($sql);
						if($resultsql){
						$sl=0;
								while($fetchSql=$resultsql->fetch_array()){
			  
			  			$sl++;
			  ?>
			  	<tr>
						<td align="center"><?php echo $sl;?></td>
						<td align="center"><?php echo $fetchSql["teachers_name"];?></td>
						<td  align="center"><?php echo $fetchSql["designation"];?></td>
						<td align="center"><input class="check_elmnt" type="checkbox" onClick="return singleChek('<?php echo  $fetchSql["teachers_id"];?>')" name="linkID[]" value="<?php echo  $fetchSql["teachers_id"]?>" id="snchek-<?php echo $fetchSql["teachers_id"]?>"/></td>
						<td align="center">
						
						<input type="text" name="attnTime[]" value="<?php echo date('h'.':'.'m');?>" id="attnTime-<?php echo $fetchSql["teachers_id"]?>"  style="width:90px; text-align:center" /></td>
						<td align="center"><input type="text" name="leavTime[]" id="leavTime-<?php echo $fetchSql["teachers_id"]?>"  style="width:90px;text-align:center"  /></td>
						<td align="center"><input type="checkbox" class="approved-<?php echo $fetchSql["teachers_id"]?>" id="group" name="approved[]" value="<?php echo $fetchSql["teachers_id"];?>" onClick="return approvedFun('<?php echo $fetchSql["teachers_id"];?>')" /></td>
						<td align="center"><input type="checkbox" class="Unapproved-<?php echo $fetchSql["teachers_id"]?>" id="group" name="unapproved[]" value="<?php echo $fetchSql["teachers_id"];?>" onClick="return UNapprovedFun('<?php echo $fetchSql["teachers_id"];?>')" /></td>
				</tr>
			  
			  <?php } } }
			  	if(isset($_POST["submit"])){ 
					if($_POST["olddate"] != "Select One..."){
				 	$sql5="SELECT `teacherpresent`.*,`teachers_information`.`teachers_name`,`designation` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`date`='".$_POST["olddate"]."' ORDER BY `teacherpresent`.`slNo` ASC";
					$resultsql=$db->select_query($sql5);
						if($resultsql){
						$sl=0;
								while($fetchSql=$resultsql->fetch_array()){
			  
			  			$sl++;
			  ?>
			 
			 <tr>
						<td align="center"><?php echo $sl;?></td>
						<td align="center"><?php echo $fetchSql["teachers_name"];?></td>
						<td  align="center"><?php echo $fetchSql["designation"];?></td>
						<td align="center"><input class="check_elmnt" type="checkbox" onClick="return singleChek('<?php echo  $fetchSql["teacherID"];?>')" name="linkID[]" value="<?php echo  $fetchSql["teacherID"]?>" id="snchek-<?php echo $fetchSql["teacherID"]?>" <?php if($fetchSql["present"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?>/></td>
						<td align="center">
						
						<input type="text" name="attnTime[]" value="<?php echo $fetchSql["comming_time"]?>" id="attnTime-<?php echo $fetchSql["teacherID"]?>"  style="width:90px; text-align:center" readonly=""/></td>
						<td align="center"><input type="text" value="<?php  echo date('h'.':'.'m');?>"  name="leavTime[]" id="leavTime-<?php echo $fetchSql["teacherID"]?>"  style="width:90px; text-align:center"  /></td>
						<td align="center"><input <?php if($fetchSql["onvacation"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?>   type="checkbox" class="approved-<?php echo $fetchSql["teacherID"]?>" id="group" name="approved[]" value="<?php echo $fetchSql["teacherID"];?>" onClick="return approvedFun('<?php echo $fetchSql["teacherID"];?>')" /></td>
						<td align="center"><input   <?php if($fetchSql["absent"]=='1'){?> checked="checked" <?php } else { ?> disabled="disabled" <?php } ?> type="checkbox" class="Unapproved-<?php echo $fetchSql["teacherID"]?>" id="group" name="unapproved[]" value="<?php echo $fetchSql["teacherID"];?>" onClick="return UNapprovedFun('<?php echo $fetchSql["teacherID"];?>')" /></td>
				</tr>
			 
			 <?php } } } } ?>
			 	<tr>
						<td align="right" colspan="8"><span id="sms"></span></td>
				</tr> 
			  <tr>
			  	<td colspan="8" align="center">
				<?php
					if(isset($_POST["submit"])){
					?>
						<input type="button" name="updateAll" id="updateAll" value="Update" onClick="return UpdatePreset()" />
					<?php
					}else {
				?>
					<input type="button" name="adddata" id="adddata" value="Submit" onClick="return AddPresent()" />
					<?php } ?>
				</td>
			  </tr>
      </table>
	 </div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
