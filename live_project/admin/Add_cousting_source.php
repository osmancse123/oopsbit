<?php
 //error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
		require_once("../db_connect/config.php");
		require_once("../db_connect/conect.php");
		$db = new database();
		global $msg;
		global $table;
		$duration="Select One";
		$type="Select Type";
		$fetch[1]="";
		$fetch[2]="";
		$fetch[4]="";
		$fetch[3]="";
		$fetch[5]="";
	

    //add dat......................................
    if(isset($_POST["add"]))
	{

		echo "xxxxxxmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm";

		$typee = $db->escape($_POST['type']);
		$index = $db->escape($_POST['index']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationto = $db->escape($_POST['duration']);
		
		
		if($type!="Select Type" && !empty($title))
		{
			$query="INSERT INTO `income_expense_title` (`title`,`details`,`Duration`,`amount`,`type`,`index`) VALUES ('$title','$detisls','$durationto','$amount','$typee','$index')";
			$resultisnsert=$db->insert_query($query);
			echo $query;
			
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
		$query="DELETE FROM `income_expense_title` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		
		print "<script>location='IncomeExpenseTitle.php'</script";
		
	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{
		$type = $db->escape($_POST['type']);
		$index = $db->escape($_POST['index']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationTitle = $db->escape($_POST['duration']);
		
		
		


		if(!empty($id) && !empty($title) && !empty($amount))
		{
			$query="REPLACE INTO `income_expense_title` (`title`,`details`,`Duration`,`amount`,`type`,`index`) VALUES ('$title','$detisls','$durationTitle','$amount','$type','$index')";
			$resultisnsert=$db->update_query($query);
			//print_r($query);

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
		$query="select * from add_cousting_source";
		$result=$db->select_query($query);
		
		$table.="<table class='table table-responsive table-hover table-bordered'>"."<tr class='success'>"."<td >ID </td>"."<td >Title</td>"."<td >Details </td>"."<td >Durotion To</td>"."<td >Duration Form</td>"."<td >Amount </td>"."<td>Edit Or Delete</td>"."</tr>";
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
			$table.="<td align='center'>";
			$table.="<a href='?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px; margin-left:0px;' href='?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()	'>Delete</a>";
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
		$query="SELECT * FROM `add_cousting_source` WHERE `id`='$src_text'";
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
		$query="DELETE FROM `add_cousting_source` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->autogenerat('add_cousting_source','id','COUS-','9');
		print "<script>location='add_cousting_source.php'</script";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Clear']))
	{
		print "<script>location='add_cousting_source.php'</script";
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
 
 //check group name 
  $(document).ready(function()
  {
		var checking_html = '<img src="search_group/loading.gif" /> Checking...';
		$('#className').change(function()
		{
			$('#item_result').html(checking_html);
				check_availability();
		});	
  });

//function to check username availability	
function check_availability()
{
		var class_name = $('#className').val();
		$.post("check_grou_name.php", { className: class_name },
			function(result){
				//if the result is 1
				if(result !=1 )
				{
					//show that the username is available
					$('#groupname').html(result);
					$('#item_result').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#category_result').html('No Group Name Found');
					$('#item_result').html("");
					$('#select').html('');
				}
		});

}  




</script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Income Expense Title </span> </td>
  			</tr>
			
			
						
			<tr>
				<td class="info">Type</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<select class="form-control" name="type">
						<option><?php print $type;?></option>
						<option>Income</option>
						<option>Expense</option>
					</select>


						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>

	<tr>
				<td class="info">SL No</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<input type="text" name="index" placeholder="index" class="form-control">

						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
				

			<tr>
				<td class="info">Title</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" readonly="" class="form-control" name="id" value="<?php echo $fetch[0];?>" />
						<input type="text"  placeholder="Title" autocomplete="off" class="form-control" name="title" value="<?php echo $fetch[1];?>"  />
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
						<input type="text" placeholder="Amount" autocomplete="off" class="form-control" name="amount" value="<?php echo $fetch[5];?>" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>


				<tr>
				<td class="info">Duration</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<select class="form-control" name="duration" > 
						<option><?php print $duration ;?></option>
						<option>Daily</option>
						<option>Weekly</option>
						<option>Monthly</option>
						<option>Quarterly</option>
						<option>Semi yearly</option>
						<option>Yearly</option>
						<option>None</option>
					</select>

						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
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
