	<?php
	
	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();

					if(isset($_POST["submit1"])){	
					  $selectGourpbyId="SELECT `struff_present`.*,`teachers_information`.`teachers_name`,`designation` FROM `struff_present`
					INNER JOIN  `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
					WHERE `struff_present`.`date` BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'   GROUP BY `struff_present`.`StruffID`   ORDER BY `struff_present`.`slNo` ASC";
					$result_rows_by_teacherID=$db->select_query($selectGourpbyId);
				 	 	//@$coubtrows=$result_rows->num_rows;
						
				 	 $select_groupByDAte="SELECT `struff_present`.*,`teachers_information`.`teachers_name`,`designation` FROM `struff_present`
					INNER JOIN  `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
					WHERE `struff_present`.`date` BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'   GROUP BY `struff_present`.`date`   ORDER BY `struff_present`.`slNo` ASC";
					$result_rows=$db->select_query($select_groupByDAte);
				 	 	@$coubtrows=$result_rows->num_rows;
						$colspan=5;
				
					 ?>
					 <table width="" border="0" class="table-responsive table-bordered" style="margin-top:10px; width:100%;">
					  <tr>
						<td height="43" colspan="<?php echo $colspan+$coubtrows;?>" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:16px" ><?php if(isset($fetchResult)){ echo @$fetchResult["institute_name"];} else {echo @$fetchResult["institute_name"]; }?></strong></span></td>
					  </tr>
					  <tr>
						<td height="32" id="dont" colspan="<?php echo $colspan+$coubtrows;?>" align="left">&nbsp;
								
								<input  type="button" name="submit" id="submit" value="Back" onclick="return Back()"  />
								</td>
					  </tr>
					  <tr>
					
					
					    <td height="30" colspan="<?php echo $colspan+$coubtrows;?>" align="center">&nbsp;<span><strong class="text-capitalize text-success" style="font-size:14px" >From &nbsp;<?php echo $_POST["FristDAte"]?> &nbsp;  To &nbsp;<?php echo $_POST["sndDAte"]?>&nbsp; Date List of Teachers Attendance</strong></span></td>
						
	      			</tr>
				<?php 	
					  $selectQuery="SELECT `struff_present`.*,`teachers_information`.`teachers_name`,`designation`  FROM `struff_present`
			INNER JOIN  `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
			WHERE `struff_present`.`date` BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'   GROUP BY `struff_present`.`StruffID`   ORDER BY `struff_present`.`slNo` ASC";
					$resultQuery=$db->select_query($selectQuery);
						@$countQueyr=$resultQuery->num_rows;
						$x=0;
						if($countQueyr > 0){
							
		  				$x++;
		  ?>
		  	<tr>
			
					   
					 
					 
					   <?php  $select_groupByDAte="SELECT `struff_present`.*,`teachers_information`.`teachers_name`,`designation` FROM `struff_present`
			INNER JOIN  `teachers_information` ON `teachers_information`.`teachers_id`=`struff_present`.`StruffID`
			WHERE `struff_present`.`date` BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'   GROUP BY `struff_present`.`date`   ORDER BY `struff_present`.`slNo` ASC";
				$resultQuery=$db->select_query($select_groupByDAte);
				@$countquery=$resultQuery->num_rows;
					if($countquery > 0){
					
					?>
						 <td colspan="4" align="center">&nbsp;Serial No</td>
					<?php
						$z=0;
							while($fetchQuery=$resultQuery->fetch_array()){
						$z++;
				
			?> <td width="81" align="center">&nbsp;<?php echo $z;?></td>
					<?php } } ?>
					    <td width="70" rowspan="2" align="center">Total</td>
	      	</tr>
		  	<tr>
				<?php	$resultQuery=$db->select_query($select_groupByDAte);
						@$countquery=$resultQuery->num_rows;
						if($countquery > 0){
					
					?>
					    <td colspan="4" align="center">Date</td>
						<?php
						$z=0;
							while($fetchQuery=$resultQuery->fetch_array()){
						$z++;
						
			?>
					   
					    <td align="center">&nbsp<?php echo $fetchQuery["date"];?></td>
						<?php } } ?>
					   
	   			 </tr>
		  <?php
							while($fetchGroupbyTeacherID=$result_rows_by_teacherID->fetch_array()){
					?>
					  <tr>
					    <td width="195" rowspan="2" align="center">Name</td>
					    <td width="252" rowspan="2" align="center">&nbsp; Designation </td>
					    <td width="157" rowspan="2" align="center">&nbsp; Absence</td>
					  	 <td width="168" align="center">Approved</td>
					 	 <?php
						  	$selctByApp="SELECT * FROM `struff_present` WHERE `StruffID`='".$fetchGroupbyTeacherID["StruffID"]."' AND `date`  BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'";
							$resublByapp=$db->select_query($selctByApp);
								@$countByapp=$resublByapp->num_rows;
								if($countByapp>0){
								$apporved=0;
									while($fetchBYapp=$resublByapp->fetch_array()){
									
									
						 	
						 		if($fetchBYapp["onvacation"]=='1'){
									$apporved++;
						 ?>
						 <td align="center"><span class='text-center text-success glyphicon glyphicon-ok'></span></td>
						 <?php } else {?>
						 <td align="center"><span class='text-center text-danger glyphicon glyphicon-remove'></span></td>
						 <?php } }  }?>
						 <td width="125" align="center"><?php echo $apporved;?></td>
						
					 </tr>
						 
					  <tr>
					    <td align="center">&nbsp;Unpproved</td>
					   
					     <?php
						  	$selctByApp="SELECT * FROM `struff_present` WHERE `StruffID`='".$fetchGroupbyTeacherID["StruffID"]."' AND `date`  BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'";
							$resublByapp=$db->select_query($selctByApp);
								@$countByapp=$resublByapp->num_rows;
								if($countByapp>0){
								$absent=0;
									while($fetchBYapp=$resublByapp->fetch_array()){
									
									
						 	
						 		if($fetchBYapp["absent"]=='1'){
									$absent++;
						 ?>
						 <td align="center"><span class='text-center text-success glyphicon glyphicon-ok'></span></td>
						 <?php } else {?>
						 <td align="center"><span class='text-center text-danger glyphicon glyphicon-remove'></span></td>
						 <?php } }  }?>
						 <td align="center"><?php echo $absent;?></td>
		  </tr>
					
					  <tr>
					    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $fetchGroupbyTeacherID["teachers_name"];?></strong></td>
					    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $fetchGroupbyTeacherID["designation"];?></strong></td>
					    <td colspan="2" align="center">&nbsp; Attendance</td>
					    <?php
						  	$selctByApp="SELECT * FROM `struff_present` WHERE `StruffID`='".$fetchGroupbyTeacherID["StruffID"]."' AND `date`  BETWEEN '".$_POST["FristDAte"]."' AND '".$_POST["sndDAte"]."'";
							$resublByapp=$db->select_query($selctByApp);
								@$countByapp=$resublByapp->num_rows;
								if($countByapp>0){
								$present=0;
									while($fetchBYapp=$resublByapp->fetch_array()){
									
									
						 	
						 		if($fetchBYapp["present"]=='1'){
									$present++;
						 ?>
						 <td align="center"><span class='text-center text-success glyphicon glyphicon-ok'></span></td>
						 <?php } else {?>
						 <td align="center"><span class='text-center text-danger glyphicon glyphicon-remove'></span></td>
						 <?php } }  }?>
						 <td align="center"><?php echo $present;?></td>
	    		  	
					<?php } ?>
					</tr>
					<td height="30" colspan="<?php echo $colspan+$coubtrows;?>" align="center">&nbsp; <input type="submit" name="print" id="print" class="noneBtnForprin" onClick="return window.print()" value="print"/></td>
	      		</tr>
		  <?php
		  	} else {?>
			   <tr>
					    <td height="30" colspan="9" align="center">&nbsp;<span><strong class="text-capitalize text-danger" style="font-size:14px" >Attendance Not Entry...............</strong></span></td>
	      </tr>
		  	    
	   </table>
			<?php
			} } ?>
				