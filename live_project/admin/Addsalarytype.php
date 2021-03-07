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
	

	$fetch[0]=$db->autogenerat('salary_type','id','SAL-','8');

//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$paymenttitle=$db->escape($_POST['paymenttitle']);
		$Amount=$db->escape($_POST['Amount']);
		$duration_to=$db->escape($_POST['duration1']);
		$duration_from=$db->escape($_POST['duration2']);
		$admin_id=$db->escape($_POST['Adminname']);

		if(!empty($id) && !empty($paymenttitle) && !empty($Amount))
		{
			$query="INSERT INTO `salary_type` (`id`,`title`,`duration_to`,`duration_from`,`amount`,`admin_id`) VALUES('".$fetch[0]."','$paymenttitle','$duration_to','$duration_from','$Amount','$admin_id')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
			$fetch[0]=$db->autogenerat('salary_type','id','SAL-','8');

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
		$query="DELETE FROM `salary_type` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->autogenerat('salary_type','id','SAL-','8');
		print "<script>location='Addsalarytype.php'</script";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{
		$id=$db->escape($_POST['id']);
		$paymenttitle=$db->escape($_POST['paymenttitle']);
		$Amount=$db->escape($_POST['Amount']);
		$duration_to=$db->escape($_POST['duration1']);
		$duration_from=$db->escape($_POST['duration2']);
		$admin_id=$db->escape($_POST['Adminname']);
		if(!empty($id) && !empty($paymenttitle) && !empty($Amount))
		{
			$query="REPLACE INTO `salary_type` (`id`,`title`,`duration_to`,`duration_from`,`amount`,`admin_id`) VALUES('$id','$paymenttitle','$duration_to','$duration_from','$Amount','$admin_id')";
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
		$query="select * from salary_type";
		$result=$db->select_query($query);
		
		$table="<table class='table table-responsive table-hover table-bordered' align='center'>"."<tr class='success'>"."<td >ID </td>"."<td >Title </td>"."<td>Duration To</td>"."<td>Duration From</td>"."<td >Amount</td>"."<td>Admin ID</td>"."<td>Edit Or Delete</td>"."</tr>";
		if($result)
		{
		$num_fields=mysqli_num_fields($result);
		while($a=$result->fetch_array())
		{
			$table.="<tr class='info'>";
			for($i=0;$i<$num_fields;$i++)
			{
				$table.="<td>".$a[$i]."</td>";

			}
			$table.="<td>";
			$table.="<a href='?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px; margin-left:5px;' href='?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()	'>Delete</a>";
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
		$query="SELECT * FROM `salary_type` WHERE `id`='$src_text'";
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
		$query="DELETE FROM `salary_type` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->autogenerat('salary_type','id','SAL-','8');
		print "<script>location='Addsalarytype.php'</script";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}
	if(isset($_POST['Clear']))
	{
		print "<script>location='Addsalarytype.php'</script";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Salary Type</span> </td>
  			</tr>
			
					
			<tr>
				<td class="info"> Salary Title  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="hidden" name="id" value="<?php echo $fetch[0];?>" />
							<input type="text" placeholder="Title" class="form-control" name="paymenttitle" <?php if($chek){?> value="<?php echo $fetch[1];?>" <?php } ?> />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info">Duration</td>
				<td class="info">:</td>
				<td class="info" colspan="2">
					<div class="col-lg-5 col-md-5 has-info">
						<input type="text" <?php if($chek){?> value="<?php echo $fetch[2];?>" <?php } ?> id="example1"  class="form-control" placeholder="Duration" name="duration1"  />
						
					</div>
						<div class="col-md-1 col-lg-1"><strong class="text-danger">To</strong></div>
					<div class="col-lg-5 col-md-5 has-info">
						<input type="text" id="example2"  class="form-control" placeholder="Duration" name="duration2" <?php if($chek){?> value="<?php echo $fetch[3];?>" <?php } ?> />
						
					</div>
				
			</tr>
			<tr>
				<td class="info">Amount</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Amount" class="form-control" name="Amount" <?php if($chek){ ?> value="<?php echo $fetch[4];?>" <?php } ?> />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Admin Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
							<input type="text" placeholder="Admin Name" class="form-control" name="Adminname" <?php if($chek){?> value="<?php echo $fetch[5];?>" <?php } ?> />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
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
  
 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
