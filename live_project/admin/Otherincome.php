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

	$fetch[0]=$db->autogenerat('other_income','id',date('y'),'9');

//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$title=$db->escape($_POST['title']);
		$description=$db->escape($_POST['description']);
		$amount=$db->escape($_POST['Amount']);
		$adminame=$db->escape($_POST['Adminname']);
		$date=$db->escape($_POST['date']);

		$ex=explode("-",$date);
		$d=$ex[2]."-".$ex[1]."-".$ex[0];


		if(!empty($id) && !empty($date) && !empty($title) && !empty($amount) && !empty($adminame))
		{
			$query_ass="INSERT INTO `other_income` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES ('$id','$d','$title','$description','$amount','$adminame')";
			//echo $query_ass;
			$result_query=$db->insert_query($query_ass);
			//print_r($query);
			$fetch[0]=$db->autogenerat('other_income','id',date('y'),'9');

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
		$query="DELETE FROM `other_income` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
			$fetch[0]=$db->autogenerat('other_cost','id',date('y'),'9');
		
		print "<script>location='Otherincome.php'</script";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{
		$id=$db->escape($_POST['id']);
		$title=$db->escape($_POST['title']);
		$description=$db->escape($_POST['description']);
		$amount=$db->escape($_POST['Amount']);
		$adminame=$db->escape($_POST['Adminname']);
		$date=$db->escape($_POST["date"]);
		$ex=explode("-",$date);
		$d=$ex[2]."-".$ex[1]."-".$ex[0];


		if(!empty($id) && !empty($date) && !empty($title) && !empty($amount) && !empty($adminame))
		{
			$query_ass="REPLACE INTO `other_cost` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES ('$id','$d','$title','$description','$amount','$adminame')";
			$result_query=$db->update_query($query_ass);

			

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
		$query="select * from other_income";
		$result=$db->select_query($query);
		
		$table="<table class='table table-responsive table-hover table-bordered' align='center'>"."<tr class='success'>"."<td >ID </td>"."<td>Date</td>"."<td >Title </td>"."<td >Description</td>"."<td >Amount</td>"."<td >Admin Name</td>"."<td>Edit Or Delete</td>"."</tr>";
		if($result)
		{
		$num_fields=mysqli_num_fields($result);
		while($a=$result->fetch_array())
		{
			$table.="<tr>";
			for($i=0;$i<$num_fields;$i++)
			{
				$table.="<td>".$a[$i]."</td>";

			}
			$table.="<td align='center'>";
			$table.="<a href='?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px; ' href='?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()	'>Delete</a>";
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
		$query="SELECT * FROM `other_cost` WHERE `id`='$src_text'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();

				$ex=explode("-",$fetch[1]);
		        $d=$ex[2]."-".$ex[1]."-".$ex[0];

			}
	}
//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `other_income` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->autogenerat('other_income','id','OTC-','9');
		print "<script>location='Otherincome.php'</script";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}
	if(isset($_POST['Clear']))
	{
		print "<script>location='Otherincome.php'</script";
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
                
                $('#example2').datepicker({
                    format: "dd-mm-yyyy"
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
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Others Income Entry </span> </td>
  			</tr>
			
			<tr>
				<td class="info">Date</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" name="id" value="<?php echo $fetch[0];?>" />

							<input type="text" autocomplete="off" id="example2"  class="form-control" name="date"<?php if($chek){?> value="<?php echo $d;?>" <?php }else { 
								print 'value="'.date('d-m-Y').'"'; } ?> />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>		
			<tr>
				<td class="info"> Title  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
							

						<select class="form-control" name="title">
							<?php
								$sql="SELECT * FROM `income_expense_title` WHERE `type`='Income' ORDER BY `index` ASC";
								$query=$db->select_query($sql);
								if($query)
								{
									while($fetchTilte=$query->fetch_array())
									{?>

											<option value="<?php print $fetchTilte[0];?>"> <?php print $fetchTilte[1];?> </option>

									<?php
								   }
								}
							?>
								
						</select>


						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Description  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
							
							<textarea class="form-control" name="description" id="radactor"><?php if ($chek) {?>
									<?php echo $fetch[3];?>
							<?php 
							} ?></textarea>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info">Amount</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Amount" autocomplete="off" class="form-control" name="Amount" <?php if($chek){?> value="<?php echo $fetch[4];?>" <?php } ?> />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"></strong></span></td>
			</tr>


			
	<input type="hidden" placeholder="Admin Name" class="form-control" name="Adminname" value="<?php print $_SESSION[id]; ?>" />
						

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
