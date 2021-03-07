<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
		$db = new database();
		 $selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);

	if(isset($_POST['viewFee']))
	{

		if($_POST["ClassFee"]=="All")
		{
		$query="select * from add_fee";
		$result=$db->select_query($query);
		if($result)
		{
				$select_class="SELECT `add_fee`.*,`add_class`.`class_name` FROM `add_fee` INNER JOIN `add_class` ON `add_class`.`id`= `add_fee`.`class_id` 
				where `add_fee`.`year`='".$_POST['FeeYear']."' GROUP BY `add_fee`.`class_id` ORDER BY `add_class`.`index` ASC";
			$result_class=$db->select_query($select_class);
			if($result_class)
			{

				$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center'>";


       
      

           $table.="<tr class='warning'> <td align='center' colspan='7'> <span class='text-success' style='font-size:18px; font-weight:blod;'> <h1>".$fetchApp["institute_name"]." </h1></span></td></tr>";
             $table.="<tr class='warning'> <td align='center' colspan='7'> <span class='text-success' style='font-size:18px; font-weight:blod;'> Fee Title - ".$_POST['FeeYear']."</span></td></tr>";



  
		while($fetch_class=$result_class->fetch_array()){

					$table.="<tr>"."<td colspan='7' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetch_class['class_name']."</span>"."</td>"."</tr>";


				$table.="<tr> <td> &nbsp; SL. No.</td> <td> &nbsp; Fee Title</td>"."<td>Fee Type </td>"."<td>Year</td>"."<td>Month </td>"."<td>Amount</td>"."</tr>";	
					
					 $select_all="SELECT `add_fee`.*,`month_setup`.`name`  FROM `add_fee` INNER JOIN `month_setup` 
ON `month_setup`.`id`=`add_fee`.`fk_month_id` WHERE `class_id`='".$fetch_class[4]."' and `year`='".$_POST['FeeYear']."'  ORDER BY  `add_fee`.`fk_month_id` ASC ";
					$result_all=$db->select_query($select_all);
					
					$i=0;
					if($result_all)
					{
						$totalFee=0;
						
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$result_all->fetch_array()){
						$table.="<tr>";
						$i++;
						$table.="<td height='25'>".$i."</td>";
							$table.="<td>".$fetch_all[1]."</td>";
						$table.="<td>".$fetch_all['Common_Exceptional']."</td>";

							
							$table.="<td>".$fetch_all[5]."</td>";
					
					

	
						$table.="<td>".$fetch_all['name']."</td>";
							$table.="<td  align='right'>".$fetch_all[3]."</td>";

					$totalFee=$totalFee+$fetch_all[3];
									
						$table.="</tr>";
						
						
						
						}

						$table.="<tr> <td colspan='5' align='right'> Total :</td>
						<td align='right'>$totalFee</td></tr>";

					
					}
					
				}
				
				$table.="</table>"."<div>";
			
			
			}
		
		}
		
		
		}
		else
		{
				$explode_Class=explode("and",$_POST["ClassFee"]);


					$query="select * from add_fee";
					$result=$db->select_query($query);
					if($result)
					{


	$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center'>";


       
           $table.="<tr class='warning'> <td align='center' colspan='7'> <span class='text-success' style='font-size:18px; font-weight:blod;'> <h1>".$fetchApp["institute_name"]." </h1></span></td></tr>";
             $table.="<tr class='warning'> <td align='center' colspan='7'> <span class='text-success' style='font-size:18px; font-weight:blod;'> Fee Title - ".$_POST['FeeYear']."</span></td></tr>";

				

		
					$table.="<tr>"."<td colspan='7' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$explode_Class[1]."</span>"."</td>"."</tr>";
				$table.="<tr>"."<td>SL. No.</td>"."<td>Title</td>"."<td>Fee Type</td>"."<td>Month </td>"."<td>Year</td>"."<td>Amount</td>"."</tr>";	
					
					 $select_all="SELECT `add_fee`.*,`month_setup`.`name`  FROM `add_fee` INNER JOIN `month_setup` 
ON `month_setup`.`id`=`add_fee`.`fk_month_id` WHERE `class_id`='".$explode_Class[0]."' and `year`='".$_POST['FeeYear']."' ORDER BY  `add_fee`.`fk_month_id` ASC ";
					$result_all=$db->select_query($select_all);
					
						
					$i=0;
					if($result_all)
					{
						$totalFee=0;
						
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$result_all->fetch_array()){
						$table.="<tr>";
						$i++;
						$table.="<td height='25'>".$i."</td>";
							$table.="<td>".$fetch_all[1]."</td>";
						$table.="<td>".$fetch_all['Common_Exceptional']."</td>";

							
							$table.="<td>".$fetch_all[5]."</td>";
					
					

	
						$table.="<td>".$fetch_all['name']."</td>";
							$table.="<td  align='right'>".$fetch_all[3]."</td>";

					$totalFee=$totalFee+$fetch_all[3];
									
						$table.="</tr>";
						
						
						
						}

						$table.="<tr> <td colspan='5' align='right'> Total :</td>
						<td align='right'>$totalFee</td></tr>";

					
					}
					
				}
				
				$table.="</table>"."<div>";
			
			
		
		}
	}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="datespicker/bootstrap.min.css">
	<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
   
     <script src="datespicker/bootstrap-datepicker.js"></script>
</head>
<body>

<style>
	@media print{
			.notPrintHtml{
				display:none;
			}
			.printButton{
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

     <form method="POST"> 

<div class="col-md-10 col-md-offset-1  notPrintHtml" style=";padding: 0px;" > 



		


					<div class="col-md-12" style="padding: 0px; margin: 0px; border-bottom: 2px solid #ccc; "> <h3 style="padding-left: 20px;"><br>View Class & Year Wise Fee</h3><br></div>

					<div class="col-md-6" ><br>
						Year : &nbsp;
						 <select name="FeeYear" class="form-control" style="max-width: 300px;">
						 	<option value="<?php print $_POST["FeeYear"] ?>"> <?php print $_POST["FeeYear"]; ?>
						 		
						 	</option>
						 		
						 		<?php

								$select_section = "SELECT `year` FROM `add_fee` GROUP BY `year` DESC  ";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
									{?>
							
							<option value="<?php echo "$fetchsection[0]"?>"><?php echo $fetchsection[0];?></option>


							<?php  } 
							 } ?>

						</select>
				 </div>

				<div class="col-md-6">
				 <br>
					Select Class: 	 <select name="ClassFee" class="form-control" style="max-width: 300px;">
								

									<?php 
									if(isset($_POST["viewFee"]))
									{
											echo "<option value='".$_POST["ClassFee"]."'> $explode_Class[1]</option>";

									}?>


								<option value="All">All</option>
							<?php 
								$select_section = "SELECT * FROM `add_class` order by `index` asc ";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
									{?>
							
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>


							<?php  }  } ?>
				</select>
			</div>

				<div class="col-md-12" style="text-align: center;">&nbsp;<br><br><input type="submit" name="viewFee" value="Show" class="btn btn-primary" style="  width: 200px; "> 
				<br>
<br>
 </div>

</div>


</body>
</html>
<?php

if(isset($_POST["viewFee"]))
{
	echo $table;
	print '<div class="col-md-10 col-md-offset-1  " style=";padding: 0px; text-align: center;" > 
	<input type="button" name="print" value="Print" onclick="window.print()" class="btn btn-primary printButton" style="width: 200px;">
	<br>
</div>';

}


 } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
