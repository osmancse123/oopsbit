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
	$fetch[0]="";
	$fetch[1]="";
	$fetch[2]="";
	$fetch[3]="";
	$fetch[1]=$db->autogenerat('main_link_info','Main_Link_Id','Main_Link-','13');
	

	if(isset($_POST['add']))
	{
		$slno=$db->escape($_POST['serialno']);
		$linid=$db->escape($_POST['linkid']);
		$linkname=$db->escape($_POST['linkname']);
		$pagename=$db->escape($_POST['pagename']);
		if(!empty($linid) && !empty($linkname))
		{
			$query="INSERT INTO `main_link_info` (`SLNO`,`Main_Link_Id`,`Main_Link_Name`,`Page_Name`,type) VALUES ('$slno','$linid','$linkname','$pagename','".$_POST["section"]."')";
			$resultisnsert=$db->insert_query($query);
			$fetch[1]=$db->autogenerat('main_link_info','Main_Link_Id','Main_Link-','13');
		}
		else
		{
			$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
		}
	}
	

	if(isset($_POST['srcbutton']))
	{
		//print "dsafa";
		$src_text=$db->escape($_POST['srctext']);
		if(!empty($src_text))
		{
			$query="SELECT * FROM `main_link_info` WHERE `Main_Link_Id`='$src_text'";
			if($query)
			{
				$fetch=$db->select_query($query)->fetch_array();
			}
		}
		else
		{
			$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
		}
	}

	if(isset($_POST['Update']))
	{
		$slno=$db->escape($_POST['serialno']);
		$linid=$db->escape($_POST['linkid']);
		$linkname=$db->escape($_POST['linkname']);
		$pagename=$db->escape($_POST['pagename']);

		if(!empty($linid))
		{
			$query="UPDATE `main_link_info` SET `SLNO`='$slno',`Main_Link_Name`='$linkname', `Page_Name`='$pagename',type='".$_POST["section"]."' WHERE `Main_Link_Id`='$linid'";
			$update=$db->update_query($query);			
		}
		else
		{
			$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";	
		}
	}

	if(isset($_POST['Delete']))
	{
		$linid=$db->escape($_POST['linkid']);
		$query="DELETE FROM `main_link_info` WHERE `Main_Link_Id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[1]=$db->autogenerat('main_link_info','Main_Link_Id','Main_Link-','13');
		
	}
	if(isset($_POST['View']))
	{
		$query="select * from main_link_info";
		$result=$db->select_query($query);
		$num_fields=mysqli_num_fields($result);
		$table="<table class='table table-responsive table-hover table-bordered' align='center'>"."<tr class='success'>"."<td >Serial No</td>"."<td>Main Link ID</td>"."<td>Main Link Name</td>"."<td>Page Name</td>"."<td>Type</td>"."<td>Edit Or Delete</td>"."</tr>";
		if($result){
		while($a=$result->fetch_array())
		{
			$table.="<tr class='info'>";
			for($i=0;$i<$num_fields;$i++)
			{
				$table.="<td>".$a[$i]."</td>";

			}
			$table.="<td>";
			$table.="<a href='Main_Link_Add.php?edit=$a[1]' class='btn btn-primary' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px;' href='Main_Link_Add.php?dlt=$a[1]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
			$table.="</td>";
			$table.="</tr>";
		} }
		$table.="</table>";
	}

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT * FROM `main_link_info` WHERE `Main_Link_Id`='$src_text'";
		$fetch=$db->select_query($query)->fetch_array ();
	}

	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `main_link_info` WHERE `Main_Link_Id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[1]=$db->autogenerat('main_link_info','Main_Link_Id','Main_Link-','13');
		header('location:Main_Link_Add.php');
	}

	if(isset($_POST['Exit']))
	{
		print exit();
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
    		$confirm_click=confirm('Are You Confirm Update The Menu');
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
    		$confirm_click=confirm('Are You Confirm Delete The Menu');
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" >

  	<div class="col-xs-12 col-md-8 col-sm-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning"  colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add page</span> </td>
  			</tr>
			<tr>
				<td class="info"></td>
				<td class="info"></td>
				
				<td class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="srctext" style="float:right;" placeholder="Search" />
					</div>
					
				</td>
				<td class="info"><button type="submit" name="srcbutton" class="btn btn-primary" style="float:left"><span class="glyphicon glyphicon-search"></span></button></td>
			</tr>
			<tr>
				<td class="info">সিরিয়াল নং</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="serialno" value="<?php echo $fetch[0];?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info">লিংক আইডি</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="linkid" value="<?php echo $fetch[1];?>"/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info">Select Section</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<select name="section" class="form-control">
							
							<option >Website Relatited Link</option>
							<option >Marksheet & Tabulationsheet Relatited Link</option>
							<option >Attendance Information</option>
							<option >Accounts Relatited Link</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info">লিংকের নাম </td>
				<td class="info">:</td>
				<td colspan="2" class="info" >
					<div class="col-lg-8">
						<input type="text" class="form-control" name="linkname" value="<?php echo $fetch[2];?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info"> 	পেইজের নাম</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="pagename" value="<?php echo $fetch[3];?>"/>
					</div>
				</td>
			</tr>
			<tr>
  				<td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
  					<?php 
  						if(isset($msg))
  						{
  							echo $msg;
  						}
  						else
  						{
  							 echo "<strong>".$db->sms."</strong>";
  						}

  					?>

  				</span> </td>
  			</tr>
			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Delete" name="Delete" onClick="return confirm_delete()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	
	</div>
	<?php echo $table;?>
  	</form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
