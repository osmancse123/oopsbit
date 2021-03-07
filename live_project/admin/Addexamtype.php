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
	
	$fetch[2]='';
	$fetch[1]="";
	$prefix=date("y"."m"."d");
	 $fetch[0]=$db->withoutPrefix('exam_type_info','exam_id',"35".$prefix,'12');
	 
global $chek;
//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['examname']);
		$class_section=$db->escape($_POST['class_section']);
		@$exploide=explode("and",$class_section);
		if(!empty($id) && !empty($classname) && $class_section!="Select One" )
		{
			$query="INSERT INTO `exam_type_info`(`exam_id`,`select_class`,`exam_type`) VALUES ('".$fetch[0]."','$exploide[0]','$classname')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
	 		$fetch[0]=$db->withoutPrefix('exam_type_info','exam_id',"35".$prefix,'12');

		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
	}
	//end add data.........................
//post delete data......................................
if(isset($_POST['Delete']))
	{
		$id=$db->escape($_POST['id']);
		$query="DELETE FROM `exam_type_info` WHERE `exam_id`='$id'";
		$delete=$db->delete_query($query);
		 $fetch[0]=$db->withoutPrefix('exam_type_info','exam_id',"35".$prefix,'12');
		 print "<script>location='Addexamtype.php'</script>";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{

		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['examname']);
		$class_section=$db->escape($_POST['class_section']);
		@$exploide=explode("and",$class_section);
		if(!empty($id) && !empty($classname))
		{
			$query="REPLACE INTO `exam_type_info` (`exam_id`,`select_class`,`exam_type`) VALUES ('$id','$exploide[0]','$classname')";
			$update=$db->update_query($query);
			$query="SELECT `exam_type_info`.*,`add_class`.`id`,`class_name` FROM `exam_type_info` INNER JOIN `add_class` ON `add_class`.`id`=`exam_type_info`.`select_class` 
WHERE `exam_type_info`.`exam_id`='".$_GET["edit"]."' AND `add_class`.`id`='".$_GET["cs"]."'";
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
//end post update data...........................
//view data...............................	
	if(isset($_POST['View']))
	{
		$query="select * from exam_type_info";
		$result=$db->select_query($query);
		if($result)
		{
			$select_class="SELECT `exam_type_info`.*,`add_class`.`class_name` FROM `exam_type_info` INNER JOIN `add_class` ON `add_class`.`id`=`exam_type_info`.`select_class` GROUP BY `exam_type_info`.`select_class` ORDER BY `add_class`.`index` ASC";
			$result_class=$db->select_query($select_class);
			if($result_class)
			{
				$table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr class='warning' >"."<td align='left' colspan='2'>"."<a href='Addexamtype.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:480px; font-weight:blod;'>পরীক্ষা  সমূহ</span>"."</td>"."</tr>";
		while($fetch_class=$result_class->fetch_array()){
					$table.="<tr>"."<td colspan='3' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetch_class[3]."</span>"."</td>"."</tr>";	
						$select_all="SELECT * FROM `exam_type_info` WHERE `select_class`='".$fetch_class[1]."' ORDER BY `exam_type` ASC";
						$result_all=$db->select_query($select_all);
						if($result_all)
						{
						while($fetch_all=$result_all->fetch_array()){
								$table.="<tr>"."<td  class='text-center text-danger'>".$fetch_all[2]."</td>"."<td class='text-center'>";
								$table.="<a href='?edit=$fetch_all[0]&cs=$fetch_all[1]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>";
									$table.="</td>"."</tr>";
								}
						
						}
					
					}
				
				$table.="</table>"."</div>";
			}
			
		
		}
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT `exam_type_info`.*,`add_class`.`id`,`class_name` FROM `exam_type_info` INNER JOIN `add_class` ON `add_class`.`id`=`exam_type_info`.`select_class` 
WHERE `exam_type_info`.`exam_id`='".$_GET["edit"]."' AND `add_class`.`id`='".$_GET["cs"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}
	}
//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['dlt']))
	{
		$id=$db->escape($_GET['dlt']);
		$query="DELETE FROM `exam_type_info` WHERE `exam_id`='$id'";
		$delete=$db->delete_query($query);
		 $fetch[0]=$db->withoutPrefix('exam_type_info','exam_id',"35".$prefix,'12');
		 print "<script>location='Addexamtype.php'</script>";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Exit']))
	{
		print "<script>location='Addexamtype.php'</script>";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
		<?php 
		if(isset($_POST["View"]))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Addexamtype.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Exam Type</span> </td>
  			</tr>
					
			<tr>
				<td class="info"> Select Class </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<input type="hidden" readonly=""  name="id" value="<?php echo $fetch[0];?>" />
						<select name="class_section" class="form-control">
						
						<?php 
							if($chek)
							{
						
						?>
						<option value="<?php echo "$fetch[3]and$fetch[4]"?>"><?php echo $fetch[4]?></option>
						<?php }  else {?>
						
							<option>Select One...</option>
						<?php } ?>
							<?php 
								$select_section = "SELECT * FROM `add_class`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php } } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Exam Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Exam Name" value="<?php echo $fetch[2];?>" class="form-control" name="examname"  />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			
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
				<?PHP 
					if(!$chek)
					{
				?>
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php } else {?>
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>
					
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
									
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	
	</div>
	<?php } ?>
  	</form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
