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
	$fetch[0]=$db->withoutPrefix('add_class','id',"31".$prefix,'12');
	
	global $chek;
//add dat......................................
if(isset($_POST['add']))
	{
		$exploide[1]='';
		$exploide[0]='';
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['classname']);
		$class_section=$db->escape(isset($_POST['class_section'])?$_POST['class_section']:"");
		@$exploide=explode("and",$class_section);
		if(!empty($id) && !empty($classname) && $class_section!="Select One")
		{
			$query="INSERT INTO `add_class` (`id`,`class_section_id`,`class_name`,`index`) VALUES ('".$fetch[0]."','$exploide[1]','$classname','".$_POST['indexNo']."')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
			$fetch[0]=$db->withoutPrefix('add_class','id',"31".$prefix,'12');

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
		$query="DELETE FROM `add_class` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_class','id',"31".$prefix,'12');
		print "<script>location='Add_class.php'</script>";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{

		$exploide[1]='';
		$exploide[0]='';
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['classname']);
		$class_section=$db->escape(isset($_POST['class_section'])?$_POST['class_section']:"");
		@$exploide=explode("and",$class_section);
		if(!empty($id) && !empty($classname) && $class_section!="Select One")
		{
			$query="REPLACE INTO `add_class`(`id`,`class_section_id`,`class_name`,`index`) VALUES ('$id','$exploide[1]','$classname','".$_POST['indexNo']."')";
			$update=$db->update_query($query);			
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
		$query="select * from add_class";
		$result=$db->select_query($query);
		
	
		if($result)
		{
		$table="<div class='col-md-10 col-lg-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='Add_class.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='3' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>View All Class</span>"."</td>"."</tr>";
		$select_alll="SELECT `add_class_section`.`Class_Section`,`add_class`.* FROM `add_class` INNER JOIN `add_class_section` ON `add_class`.`class_section_id`=`add_class_section`.`id` ORDER BY `add_class`.`index` ASC";
		$chek_all=$db->select_query($select_alll);
		if($chek_all){
		$table.="<tr>"."<td>Index</td><td>Class Section Name</td>"."<td>Class  Name</td>"."<td>Edit</td>"."</tr>";
		while($a=$chek_all->fetch_array())
		{
			$table.="<tr class='info'>";
			$table.="<td>".$a[4]."</td>"."<td>".$a[0]."</td>"."<td>".$a[3]."</td>";
			$table.="<td>";
			$table.="<a href='?edit=$a[1]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>";
			$table.="</td>";
			$table.="</tr>";
		}
	}
	}
		$table.="</table>"."</div>";
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT `add_class`.*,`add_class_section`.`id`,`Class_Section` FROM `add_class` INNER JOIN `add_class_section` ON `add_class`.`class_section_id`=`add_class_section`.`id`
 WHERE `add_class`.`id`='$src_text'";
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
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `add_class` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_class','id',"31".$prefix,'12');
		print "<script>location='Add_class.php'</script>";


	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Clear']))
	{
		print "<script>location='Add_class.php'</script>";
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
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Add_class.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Class </span> </td>
  			</tr>
			
						
			<tr>
				<td class="info"> Class Section  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" readonly=""  name="id" value="<?php echo $fetch[0];?>" />
						<select name="class_section" class="form-control">
						
				
								<?php if($chek){?>
									<option value="<?php echo "$fetch[5]and$fetch[2]"?>"><?php echo $fetch[5];?></option>
								<?php } ?>
							<?php 
								$select_section = "SELECT * FROM `add_class_section`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[1]and$fetchsection[0]"?>"><?php echo $fetchsection[1];?></option>
							<?php } } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Class Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Class Name" class="form-control" name="classname" value="<?php echo $fetch[2];?>" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>

				<tr>
				<td class="info">Index No.  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Class index" class="form-control" name="indexNo" value="<?php echo $fetch[3];?>" />
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
				<?php 
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
