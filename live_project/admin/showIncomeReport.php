<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	 $db = new database();
	 
			
			
			if(isset($_POST["forDaily"])){
				

				$ex=explode('-', $_POST["date"]);
				$d=$ex[2].'-'.$ex[1].'-'.$ex[0];
			
			$dailyAmmount = "SELECT * FROM `other_income` WHERE `date`='".$d."'";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="37">Sl</td>
					<td width="418">Title</td>
					<td width="283">Description</td>
					<td width="349">Ammount</td>
				</tr>
				<?php   
						$sl;
						$total = 0;
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
						$total = $total+$fetchDailyAmmount["amount"];
				?>
				<tr>
					<td width="37"><?php echo $sl;?></td>
					<td width="418"><?php echo $fetchDailyAmmount["title"];?></td>
					<td width="283"><?php echo $fetchDailyAmmount["description"];?></td>
					<td width="349"><?php echo $db->my_money_format($fetchDailyAmmount["amount"]);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="3"  align="right"><strong>Total Income</strong></td>
					<td><strong><?php echo $db->my_money_format($total);?></strong></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="4" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>
	  <?php
	 
	 		if(isset($_POST["monthlyreport"])){
					$sqlmonthlyreport = "SELECT * FROM `other_income` WHERE `date` BETWEEN '".$_POST["frsdate"]."' AND '".$_POST["snddate"]."'";
					$resultMonthlyreport =$db->select_query($sqlmonthlyreport);
					if($resultMonthlyreport->num_rows > 0){
					?>
				<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="37">Sl</td>
					<td width="418">Title</td>
					<td width="283">Description</td>
					<td width="349">Ammount</td>
				</tr>
				<?php   
						$sl;
						$total = 0;
						while($fetchDailyAmmount = $resultMonthlyreport->fetch_array()){
						$sl++;
						$total = $total+$fetchDailyAmmount["amount"];
				?>
				<tr>
					<td width="37"><?php echo $sl;?></td>
					<td width="418"><?php echo $fetchDailyAmmount["title"];?></td>
					<td width="283"><?php echo $fetchDailyAmmount["description"];?></td>
					<td width="349"><?php echo $db->my_money_format($fetchDailyAmmount["amount"]);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="3"  align="right"><strong>Total Income</strong></td>
					<td><strong><?php echo $db->my_money_format($total);?></strong></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="4" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 ?>
	  
	 <?php
	 		if(isset($_POST["showEarlypost"])){
			
					$yearlyshowcost = "SELECT * FROM `other_income` WHERE  RIGHT(`date`,4) ='".$_POST["years"]."'";
						$resulshowcost = $db->select_query($yearlyshowcost);
							if($resulshowcost->num_rows > 0){
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="37">Sl</td>
					<td width="418">Title</td>
					<td width="283">Description</td>
					<td width="349">Ammount</td>
				</tr>
				<?php   
						$sl;
						$total = 0;
						while($fetchDailyAmmount = $resulshowcost->fetch_array()){
						$sl++;
						$total = $total+$fetchDailyAmmount["amount"];
				?>
				<tr>
					<td width="37"><?php echo $sl;?></td>
					<td width="418"><?php echo $fetchDailyAmmount["title"];?></td>
					<td width="283"><?php echo $fetchDailyAmmount["description"];?></td>
					<td width="349"><?php echo $db->my_money_format($fetchDailyAmmount["amount"]);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="3"  align="right"><strong>Total Income</strong></td>
					<td><strong><?php echo $db->my_money_format($total);?></strong></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="4" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>	
			
		<?php 	}
	 
	 ?>