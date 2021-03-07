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
	global $chek;
	
	$fetch[0]='';
	$fetch[1]="";
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_class_section','id',"30".$prefix,'12');
	

//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['class']);
		
		if(!empty($id) && !empty($classname))
		{
				$query="INSERT INTO `add_class_section` (`id`,`Class_Section`) VALUES ('".$fetch[0]."','$classname')";
				$resultisnsert=$db->insert_query($query);
				$fetch[0]=$db->withoutPrefix('add_class_section','id',"30".$prefix,'12');

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
		$query="DELETE FROM `add_class_section` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_class_section','id',"30".$prefix,'12');
		print "<script>location='Add_classSection.php'</script>";
	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['class']);
		if(!empty($id) && !empty($classname))
		{
			$query="UPDATE `add_class_section` SET `Class_Section`='$classname' WHERE `id`='$id'";
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
		$query="select * from add_class_section";
		$result=$db->select_query($query);
		
		$table="<div class='col-md-10 col-lg-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left' colspan='2'>"."<a href='Add_classSection.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; font-weight:blod; padding-left:250px'>View All Class Seciton</span>"."</td>"."</tr>";
		if($result)
		{
		 $table.="<tr>"."<td>Class Section Name</td>"."<td>Edit Or Delete</td>"."</tr>";
		$num_fields=mysqli_num_fields($result);
		while($a=$result->fetch_array())
		{
			$table.="<tr class='info'>";
			for($i=1;$i<$num_fields;$i++)
			{
				$table.="<td>".$a[$i]."</td>";

			}
			$table.="<td>";
			$table.="<a href='?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>";
			$table.="</td>";
			$table.="</tr>";
		}
	}
		$table.="</table>";
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT * FROM `add_class_section` WHERE `id`='$src_text'";
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
		$query="DELETE FROM `add_class_section` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_class_section','id',"30".$prefix,'12');
		print "<script>location='Add_classSection.php'</script>";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}
	if(isset($_POST['Clear']))
	{
		print "<script>location='Add_classSection.php'</script>";
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">
<?php 
		if(isset($_POST["View"]))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Add_classSection.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Class Section</span> </td>
  			</tr>
			
			<tr>
				<td class="info">ID</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 col-md-12">
						<input type="text" readonly="" class="form-control" name="id" value="<?php echo $fetch[0];?>" />
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Class Section  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" class="form-control" name="class" value="<?php echo $fetch[1];?>" />
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
					<?php  } else {?>
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
									
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	
	</div>
	<?php  }?>
  	</form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
