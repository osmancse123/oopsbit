<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	global $msg;
	global $table;
	
	
	
	$fetch[1]='';
	$fetch[2]='';
	$fetch[8]='';
	$fetch[4]='';
	$fetch[3]='';
	$fetch[5]=date('Y');
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');
	
	global $chek;

//add dat......................................
if(isset($_POST['add']))
	{
	
			
		$explode_Class[0]='';
		$explode_Class[1]='';
		$exploide_gropu[0]='';
		$exploide_gropu[1]='';
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationto = $db->escape($_POST['duration1']);
		$durationfrom = $db->escape($_POST['duration2']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		$explode_Class=explode("and",$classname);
	
		$year=$db->escape($_POST['year']);
		//print_r($exploide_gropu);
		
			if($_POST["exceptional"]=="Common")
			{
						if(!empty($id) && !empty($year) && !empty($title) && !empty($amount) && $amount>0)
						{
							$query="INSERT INTO `add_fee` (`id`,`title`,`details`,`amount`,`class_id`,`year`,`fk_month_id`,`Common_Exceptional`,`index`) VALUES ('".$fetch[0]."','$title','$detisls','$amount','$explode_Class[0]','$year','".$_POST["monthID"]."','".$_POST["exceptional"]."','".$_POST['index']."')";
							$resultisnsert=$db->insert_query($query);
							$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');


						}
						else
						{
							$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
						}

			}
			else
			{

				if(!empty($id) && !empty($year) && !empty($title))
						{
							$query="INSERT INTO `add_fee` (`id`,`title`,`details`,`amount`,`class_id`,`year`,`fk_month_id`,`Common_Exceptional`,`index`) VALUES ('".$fetch[0]."','$title','$detisls','0','$explode_Class[0]','$year','".$_POST["monthID"]."','".$_POST["exceptional"]."','".$_POST['index']."')";
							$resultisnsert=$db->insert_query($query);
							$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');


						}
						else
						{
							$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
						}
			}

	



	}
	//end add data.........................
//post delete data......................................
if(isset($_POST['Delete']))
	{
		$id=$db->escape($_POST['id']);
		$query="DELETE FROM `add_fee` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');
		print "<script>location='Add_fee.php'</script>";
		
	}
//post end delete data.........................................

//post update data..........................................
if(isset($_POST['Update']))
	{
		$explode_Class[0]='';
		$explode_Class[1]='';
		$exploide_gropu[0]='';
		$exploide_gropu[1]='';
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationto = $db->escape($_POST['duration1']);
		$durationfrom = $db->escape($_POST['duration2']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		$explode_Class=explode("and",$classname);
		//print_r($explode_Class);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		$exploide_gropu=explode("and",$class_section);
		//print_r($exploide_gropu);
		$year=$db->escape($_POST['year']);

		if($_POST["exceptional"]=="Common")
			{

		if(!empty($id)&& !empty($year) && !empty($title) && !empty($amount))
		{
			$query="REPLACE  INTO `add_fee` (`id`,`title`,`details`,`amount`,`class_id`,`year`,`fk_month_id`,`Common_Exceptional`,`index`) VALUES ('".$_POST['id']."','$title','$detisls','$amount','$explode_Class[0]','$year','".$_POST["monthID"]."','".$_POST["exceptional"]."','".$_POST['index']."')";
			$resultisnsert=$db->update_query($query);
			//print_r($query);
				$src_text=$db->escape($_POST['id']);
		$query="SELECT `add_fee`.*,`add_class`.`id`,`class_name`,`Month_setup`.`name`
 FROM `add_fee` JOIN `add_class` ON `add_fee`.`class_id`=`add_class`.`id` JOIN `Month_setup`
  ON `add_fee`.`fk_month_id`=`Month_setup`.`id`

WHERE `add_fee`.`id`='".$_POST["id"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}


		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
	}
	else
	{

		if(!empty($id)&& !empty($year) && !empty($title))
		{
			$query="REPLACE  INTO `add_fee` (`id`,`title`,`details`,`amount`,`class_id`,`year`,`fk_month_id`,`Common_Exceptional`,`index`) VALUES ('".$_POST['id']."','$title','$detisls','$amount','$explode_Class[0]','$year','".$_POST["monthID"]."','".$_POST["exceptional"]."','".$_POST['index']."')";
			$resultisnsert=$db->update_query($query);
			//print_r($query);
				$src_text=$db->escape($_POST['id']);
		$query="SELECT `add_fee`.*,`add_class`.`id`,`class_name`,`Month_setup`.`name`
 FROM `add_fee` JOIN `add_class` ON `add_fee`.`class_id`=`add_class`.`id` JOIN `Month_setup`
  ON `add_fee`.`fk_month_id`=`Month_setup`.`id`

WHERE `add_fee`.`id`='".$_POST["id"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}


		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}


	}


	}
//end post update data...........................
//view data...............................	
	if(isset($_POST['viewFee']))
	{

		if($_POST["ClassFee"]=="All")
		{
		$query="select * from add_fee";
		$result=$db->select_query($query);
		if($result)
		{
				$select_class="SELECT `add_fee`.*,`add_class`.`class_name` FROM `add_fee` INNER JOIN `add_class` ON `add_class`.`id`= `add_fee`.`class_id` where `add_fee`.`year`='".$_POST['FeeYear']."' GROUP BY `add_fee`.`class_id` ORDER BY `add_class`.`index` ASC";
			$result_class=$db->select_query($select_class);
			if($result_class)
			{
				$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";


        $table.="<tr class='warning' >"."<td align='center' colspan='8'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>View All Fee</span>"."</td>"."</tr>";

		while($fetch_class=$result_class->fetch_array()){
					$table.="<tr>"."<td colspan='9' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetch_class['class_name']."</span>"."</td>"."</tr>";
				$table.="<tr> <td>Sl. No.</td><td>Index</td>"."<td>Title</td>"."<td>Ammount</td>"."<td>Year</td>"."<td>Month </td>"."<td>Fee Type</td>"."<td>Action</td>"."</tr>";	
					
					 $select_all="SELECT `add_fee`.*,`month_setup`.`name`  FROM `add_fee` INNER JOIN `month_setup` 
ON `month_setup`.`id`=`add_fee`.`fk_month_id` WHERE `class_id`='".$fetch_class[4]."' and `year`='".$_POST['FeeYear']."' order by `add_fee`.`index` ASC ";
					$result_all=$db->select_query($select_all);
					
					if($result_all)
					{$i=0;
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$result_all->fetch_array()){
							$i++;
						$table.="<tr>";
						$table.="<td>".$i."</td>";
							$table.="<td>".$fetch_all['index']."</td>";
							$table.="<td>".$fetch_all[1]."</td>";
							$table.="<td>".$fetch_all[3]."</td>";
							$table.="<td>".$fetch_all[5]."</td>";
						
						$table.="<td>".$fetch_all['name']."</td>";
						$table.="<td>".$fetch_all['Common_Exceptional']."</td>"."<td>";



						$table.="<a href='?edit=$fetch_all[0]'class='btn btn-primary'style='width:80px' target='_blank'>Edit</a>"."<a href='?dlt=$fetch_all[0]' class='btn btn-danger' onclick='return confirm_delete()' style='width:80px'>Delete</a>"."</td>";
									
						$table.="</tr>";
						
						
						
						}
					
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

				
				$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";


        $table.="<tr class='warning' >"."<td align='center' colspan='8'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>View All Fee</span>"."</td>"."</tr>";

		
					$table.="<tr>"."<td colspan='9' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$explode_Class[1]."</span>"."</td>"."</tr>";
				$table.="<tr> <td>Sl. No.</td><td>Index</td>"."<td>Title</td>"."<td>Ammount</td>"."<td>Year</td>"."<td>Month </td>"."<td>Fee Type</td>"."<td>Action</td>"."</tr>";	
					
					 $select_all="SELECT `add_fee`.*,`month_setup`.`name`  FROM `add_fee` INNER JOIN `month_setup` 
ON `month_setup`.`id`=`add_fee`.`fk_month_id` WHERE `class_id`='".$explode_Class[0]."' and `year`='".$_POST['FeeYear']."' order by `add_fee`.`index` ASC ";
					$result_all=$db->select_query($select_all);
					
					if($result_all)
					{
						$i=0;
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$result_all->fetch_array()){
							$i++;
						$table.="<tr>";
						
						$table.="<td>".$i."</td>";
							$table.="<td>".$fetch_all['index']."</td>";

							$table.="<td>".$fetch_all[1]."</td>";
							$table.="<td>".$fetch_all[3]."</td>";
							$table.="<td>".$fetch_all[5]."</td>";
						
						$table.="<td>".$fetch_all['name']."</td>";
						$table.="<td>".$fetch_all['Common_Exceptional']."</td>"."<td>";



						$table.="<a href='?edit=$fetch_all[0]'class='btn btn-primary' style='width:80px' target='_blank'>Edit</a>"."<a href='?dlt=$fetch_all[0]' class='btn btn-danger' onclick='return confirm_delete()' style='width:80px'>Delete</a>"."</td>";
									
						$table.="</tr>";
						
						
						
						}
					
					}
					
				}
				
				$table.="</table>"."<div>";
			
			
		
		}
	}


//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		
		 $queryg="SELECT `add_fee`.*,`add_class`.`id`,`class_name`,`month_setup`.`name` FROM `add_fee` JOIN `add_class` ON `add_fee`.`class_id`=`add_class`.`id` JOIN `month_setup` ON `month_setup`.`id`=`add_fee`.`fk_month_id`  WHERE `add_fee`.`id`='".$_GET["edit"]."'";
  //print  $queryg;
		
		$chek=$db->select_query($queryg);
		if($chek)
			{
				//print  $queryg;
				$fetch=$chek->fetch_array();
				
			}
	}
//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `add_fee` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		print "<script>location='Add_fee.php'</script>";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Clear']))
	{
		print "<script>location='Add_fee.php'</script>";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Add Fee</title>
    
	<link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
	<link rel="stylesheet" href="textEdit/redactor/redactor.css" />
	<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
	<script src="textEdit/redactor/redactor.min.js"></script>

	  <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
    	  $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

    	    $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

    	$(document).ready(
		function()
		{
			$('#radactor').redactor();
		}
	);

    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}

    	function confirm_delete()
    	{
    		$confirm_click=confirm('Are You Confirm Delete');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
 



</script>
  </head>
	
  <body>
  	<form  method="post"  enctype="multipart/form-data" class="form-horizontal">	

  		<?php 
		if(isset($_POST["View"]))
		{?>
			


				<div class="col-md-10 col-md-offset-1  " style=";padding: 0px; " > 



							<div class="col-md-12">

								<br><a href='Add_fee.php' class='btn btn-primary'><span class='link text-center'>Back<span></a>  <br>
							</div>


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


							<?php  }  } ?>

						</select>
				 </div>

				<div class="col-md-6"> <br>
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

				<div class="col-md-12" style="text-align: center;">&nbsp;<br><br><input type="submit" name="viewFee"   value="Show" class="btn btn-primary" style="  width: 200px; "> 
				<br>
<br>
 </div>

</div>
					

				<?php
			
		}
		else
		{

			if(isset($_POST["viewFee"]))
			{?>
				<div class="col-md-10 col-md-offset-1  " style="padding: 0px; " > 

<div class="col-md-12">

								<br><a href='Add_fee.php' class='btn btn-primary'>
									<span class='link text-center'>Back<span></a>  <br>
							</div>

					<div class="col-md-12 " style="padding: 0px; margin: 0px;"> <h3 style="padding-left: 20px;  border-bottom: 2px solid #ccc; "><br>View Class & Year Wise Fee <br></h3></div>
					<div class="col-md-6" >
						<br>
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


							<?php  }  } ?>

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

				<?php
					echo $table;
			}
			else
			{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4"   class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Fee Title </span> </td>
  			</tr>
			
			
						
						
				

			<tr>
				<td class="info">Title</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" readonly="" class="form-control" name="id" value="<?php echo $fetch[0];?>" />
						<input type="text"  placeholder="Title" class="form-control" name="title" value="<?php echo $fetch[1];?>"  style="border-radius:0px;" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Year</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
						<input type="text"  placeholder="2016" class="form-control" name="year" value="<?php echo $fetch[5];?>"  style="border-radius:0px;"/>
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Details</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12">
						<textarea class="form-control" id="radactor" name="details" placeholder="Details"><?php echo $fetch[2];?></textarea>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Amount</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Amount" class="form-control" id="amount" name="amount" value="<?php echo $fetch[3];?>" style="border-radius:0px;" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			
			<tr>
				<td class="info"> Class Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="className" id="className"  style="border-radius:0px;" class="form-control">
						
						<?php 
									if($chek)
									{
								?>
								
									<option  value="<?php echo "$fetch[4]and$fetch[class_name]"?>"><?php echo $fetch['class_name']?></option>
								<?php  }  else {?>
									<option>Select One...</option>
								<?php
								  }  ?>
							<?php 
								$select_section = "SELECT * FROM `add_class` order by `index` ASC";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
									if($fetch[4] != $fetchsection[0]){
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php } }  } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Select Month </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="monthID" id="monthID"  style="border-radius:0px;" class="form-control">
							<?php 
									if($chek)
									{
								?>
								
									<option  value="<?php echo "$fetch[6]"?>"><?php echo $fetch['name']?></option>
								<?php  }  else {?>
									<option>Select One...</option>
								<?php
								  }  ?>
							<?php 
								$selMonth = "SELECT * FROM `month_setup` ORDER BY `id` ASC";
								$checkMont=$db->select_query($selMonth);
								if($checkMont)
								{
									while($fetmonth=$checkMont->fetch_array())
								{
										if($fetch[6] != $fetmonth[0] ){
							?>
							<option value="<?php echo "$fetmonth[0]"?>"><?php echo $fetmonth[1];?></option>
							<?php }  }  } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			
				<tr>
				<td class="info">Fee Index</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Index" class="form-control" id="index" name="index" value="<?php echo $fetch[8];?>" style="border-radius:0px;" />
						</span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>

			<tr>
				<td class="info"> Fee Type </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
								<input type="radio" name="exceptional" value="Common" checked="checked" <?php
										if($fetch[7] == "Common")
										{
								?> 
									checked="checked"
								<?php } ?>/>&nbsp;Common Fee
								
								<input type="radio" name="exceptional" value="exceptional"  <?php
										if($fetch[7] ==  "exceptional")
										{
								?> 
									checked="checked"
								<?php } ?>  />&nbsp;Exceptional Fee
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			
			
			<tr>	
  				<td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
  					<?php 
  						if(isset($msg))
  						{
  							echo "<strong>".$msg."</strong>";
  						}
  						else 
  						{
  							 echo "<strong>".$db->sms."<strong>";
  						}



  					?>

  				</span> </td>
  			</tr>
			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
				<?php 
					if(!$chek)
					{
				?>
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php
					 } 

					else {?>
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>


					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;" formtarget="_blank"/>
								
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	
	</div>
  	
	<?php }} ?>
	</form>
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
