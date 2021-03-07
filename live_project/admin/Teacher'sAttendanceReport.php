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

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	 <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addATeent" >
	 <div class="col-lg-12">
	 
	 		 <table width="1075" class="table table-bordered table-responsive" style="margin-top:10px;">
					  <tr>
						<td colspan="10" align="center">&nbsp;<span class="text-success" style="font-size:18px;"><strong>
<?php if(!isset($_POST["submit"])){?>Today, the attendance of teachers<?php } else { echo $_POST["olddate"];?>  Date Attendance List <?php } ?></strong></span></td>
					  </tr>
					
					  <tr>
					  		<td width="4%"><strong>Date</strong></td>
							<td colspan="5">
								<select name="olddate" id="olddate"  style="width:180px; height:28px;">
					
						<option>Select One...</option>
						<?php
								$selecDAte="SELECT `date` FROM `teacherpresent` GROUP BY `date` order by `date` DESC ";
								$resultdate=$db->select_query($selecDAte);
									if($resultdate){
											while($fetchREsult=$resultdate->fetch_array()){
						
						?>
									<option><?php echo $fetchREsult["date"];?></option>
						<?php } }?>
					</select>
&nbsp;&nbsp;
<input type="submit" name="submit"  value="Search" class="btn btn-success btn-sm" style="width:80px"/>
&nbsp;&nbsp;<input type="submit" name="Reload"  value="Reload" class="btn btn-success btn-sm" style="width:80px"/>							</td>
					  </tr>
					    <tr>
					      <td rowspan="2" align="center">SL.NO.</td>
					      <td width="22%" rowspan="2" align="center">Name</td>
					      <td width="21%" rowspan="2" align="center">Designation</td>
					      <td width="21%" rowspan="2" align="center">Attendance</td>
					      <td colspan="2" align="center">Absent</td>
		       </tr>
					    <tr>
					      <td width="17%" height="24" align="center">Approved</td>
					    <td width="15%" align="center">Unapproved</td>
			     </tr>
				 
				 <?php
				 	if(!isset($_POST["submit"])){
				 		 $sql="SELECT `teacherpresent`.*,`teachers_information`.`teachers_name`,`designation` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`date`='".date('d-m-Y')."' ORDER BY `teacherpresent`.`slNo` ASC";
						$resultSql=$db->select_query($sql);
						@$coutrows=$resultSql->num_rows;
							if($coutrows > 0){
								$sl=0;
									while($fetch_sql=$resultSql->fetch_array()){
						
						$sl++;
				 ?>
				 	<tr>
							<td align="center"><?php echo $sl;?></td>
							<td><?php echo $fetch_sql["teachers_name"];?></td>
							<td><?php echo $fetch_sql["designation"];?></td>
							<td align="center"><?php if($fetch_sql["present"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?>
							</td>
							<td align="center"><?php if($fetch_sql["onvacation"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?></td>
							<td align="center"><?php if($fetch_sql["absent"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?></td>
							
					</tr>
				 
				 <?php } } else {?>
				 	<tr>
							<td colspan="7">
										<span><strong class="text-danger" style="font-size:18px">Today, the attendace is not complete !!!</strong></span>
							</td>
					</tr>
				 <?php } } ?>
				 <?php
				 	if(isset($_POST["submit"])){
					 $sql="SELECT `teacherpresent`.*,`teachers_information`.`teachers_name`,`designation` FROM `teacherpresent`
INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacherpresent`.`teacherID`
WHERE `teacherpresent`.`date`='".$_POST["olddate"]."' ORDER BY `teacherpresent`.`slNo` ASC";
						$resultSql=$db->select_query($sql);
						@$coutrows=$resultSql->num_rows;
							if($coutrows > 0){
								$sl=0;
									while($fetch_sql=$resultSql->fetch_array()){
						
						$sl++;
				 ?>
				 	<tr>
							<td align="center"><?php echo $sl;?></td>
							<td><?php echo $fetch_sql["teachers_name"];?></td>
							<td><?php echo $fetch_sql["designation"];?></td>
							<td align="center"><?php if($fetch_sql["present"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?>
							</td>
							<td align="center"><?php if($fetch_sql["onvacation"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?></td>
							<td align="center"><?php if($fetch_sql["absent"]=='1'){?>
									<span class='text-center text-success glyphicon glyphicon-ok'></span>
									<?php } else {?>
									<span class='text-center text-danger glyphicon glyphicon-remove'></span>
									<?php } ?></td>
							
					</tr>
				 
				 <?php } } else {?>
				 	<tr>
							<td colspan="7">
										<span><strong class="text-danger" style="font-size:18px">Today, the attendace is not complete !!!</strong></span>
							</td>
					</tr>
				 <?php }
					}
				 ?>
			</table>
	 </div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
