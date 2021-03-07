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
	$fetch[0]='';
	$fetch[4]="";
	$fetch[5]="";
	$fetch[3]=$db->autogenerat('sub_link_info','Sub_Link_Id','Sub_Link-','12');

	if(isset($_POST['add']))
	{
		$slno=$db->escape($_POST['serialno']);
		$linid=$db->escape($_POST['linkid']);
		$maillink=$db->escape($_POST['maillink']);
		$explode=@explode('and',$maillink);
		//print_r($explode);
		$linkname=$db->escape($_POST['linkname']);
		$pagename=$db->escape($_POST['pagename']);
		if(!empty($maillink) && !empty($linkname))
		{
			$query="INSERT INTO `sub_link_info` (`Sl_No`,`Main_Link`,`MainLinkName`,`Sub_Link_Id`,`Sub_Link_Name`,`Sub_Page_Name`) VALUES ('$slno','$explode[0]','$explode[1]','$linid','$linkname','$pagename') ";
			
			$resultisnsert=$db->insert_query($query);
			$fetch[3]=$db->autogenerat('sub_link_info','Sub_Link_Id','Sub_Link-','12');
		}
		else
		{
			$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
		}
	}
	
if(isset($_POST['Delete']))
	{
		$linid=$db->escape($_POST['linkid']);
		$query="DELETE FROM `sub_link_info` WHERE `Sub_Link_Id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[3]=$db->autogenerat('sub_link_info','Sub_Link_Id','Sub_Link-','12');
		
	}

	if(isset($_POST['Update']))
	{
		$slno=$db->escape($_POST['serialno']);
		$linid=$db->escape($_POST['linkid']);
		$maillink=$db->escape($_POST['maillink']);
		$explode=@explode('and',$maillink);
		//print_r($explode);
		$linkname=$db->escape($_POST['linkname']);
		$pagename=$db->escape($_POST['pagename']);
		if(!empty($linid))
		{
			$query="UPDATE `sub_link_info` SET `Sl_No`='$slno',`Main_Link`='$explode[0]',MainLinkName='$explode[1]',Sub_Link_Name='$linkname',`Sub_Page_Name`='$pagename' WHERE `Sub_Link_Id`='$linid'";
			$update=$db->update_query($query);			
		}
		else
		{
			$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";	
		}
	}

	
	if(isset($_POST['View']))
	{
		$query="select * from sub_link_info";
		$result=$db->select_query($query);
		$num_fields=mysqli_num_fields($result);
		$table="<table class='table table-responsive table-hover table-bordered' align='center'>"."<tr class='success'>"."<td >Serial No</td>"."<td>Main Link ID</td>"."<td>Main Link Name</td>"."<td>Sub Link ID</td>"."<td>Sub Link Name</td>"."<td>Sub Link Page Name</td>"."<td>Edit Or Delete</td>"."</tr>";
		if($result){
		while($a=$result->fetch_array())
		{
			$table.="<tr class='info'>";
			for($i=0;$i<$num_fields;$i++)
			{
				$table.="<td>".$a[$i]."</td>";

			}
			$table.="<td>";
			$table.="<a href='Sub_Link_Add.php?edit=$a[3]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px;' href='Sub_Link_Add.php?dlt=$a[3]' class='btn btn-danger' onclick='return confirm_delete()	'>Delete</a>";
			$table.="</td>";
			$table.="</tr>";
		} }
		$table.="</table>";
	}

	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT * FROM `sub_link_info` WHERE `Sub_Link_Id`='$src_text'";
		$cheked_query=$db->select_query($query);
		if($cheked_query)
			{
				$fetch=$cheked_query->fetch_array ();
			}
	}

	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `sub_link_info` WHERE `Sub_Link_Id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[3]=$db->autogenerat('sub_link_info','Sub_Link_Id','Sub_Link-','12');
		
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
	<style type="text/css">
		.box {width :70%;}
	</style> 
  <body>
  	<form name="sublink" action="" method="post"  enctype="multipart/form-data" >

  	<div class="col-xs-12 col-lg-10">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning" colspan="4" align="center"><span style="font-size:22px; color:#333; display:block;">সাব লিংক যুক্তকরন </span> </td>
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
				<td class="info">প্রধান লিংক নির্বাচন </td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<select class="form-control" name="maillink">
						<option>প্রধান লিংক নির্বাচন</option>
						<?php
							$query="SELECT * FROM  `main_link_info` where `Page_Name`='#'";
							$a=$db->select_query($query);
							if($a){
							while($fetch_admin_link=$a->fetch_array())
							{
						?>
							<option value="<?php echo "$fetch_admin_link[1]and$fetch_admin_link[2]"?>"><?php echo $fetch_admin_link[2];?></option>
							<?php }  }?>
							
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info"> 	সাব লিংক আইডি</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="linkid" value="<?php echo $fetch[3];?>"/>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info"> 	সাব লিংকের নাম </td>
				<td class="info">:</td>
				<td colspan="2" class="info" >
					<div class="col-lg-8">
						<input type="text" class="form-control" name="linkname" value="<?php echo $fetch[4];?>" />
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="1" class="info"> 	পেইজের নাম</td>
				<td class="info">:</td>
				<td colspan="2" class="info">
					<div class="col-lg-8">
						<input type="text" class="form-control" name="pagename" value="<?php echo $fetch[5];?>"/>
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
  							 echo $db->sms;
  						}

  					?>

  				</span> </td>
  			</tr>
			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Delete" name="Delete" class="btn btn-primary btn-sm" style="width:80px;"  onclick='return confirm_delete()'/>					
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	<?php echo $table;?>
	</div>
  	</form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
