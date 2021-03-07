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
	
	$fetch[3]='';
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_section','id',"33".$prefix,'12');
	

//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		@$explode_Class=explode("and",$classname);
		//print_r($explode_Class);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide_gropu=explode("and",$class_section);
		//print_r($exploide_gropu);
		$section_name = $db->escape($_POST['sectionname']);
		if(!empty($id) && $classname != "Select One" && !empty($class_section) && !empty($section_name))
		{
			$query="INSERT INTO add_section (`id`,`class_id`,`group_id`,`section_name`) VALUES ('".$fetch[0]."','$explode_Class[0]','$exploide_gropu[0]','$section_name')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
			$fetch[0]=$db->withoutPrefix('add_section','id',"33".$prefix,'12');


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
		$query="DELETE FROM `add_section` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_section','id',"33".$prefix,'12');
		print "<script>location='add_section.php'</script";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{

		$id=$db->escape($_POST['id']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		@$explode_Class=explode("and",$classname);
		//print_r($explode_Class);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide_gropu=explode("and",$class_section);
		//print_r($exploide_gropu);
		$section_name = $db->escape($_POST['sectionname']);
		if(!empty($id) && $classname != "Select One" && !empty($class_section) && !empty($section_name))
		{
			$query="REPLACE INTO `add_section` (`id`,`class_id`,`group_id`,`section_name`) VALUES ('$id','$explode_Class[0]','$exploide_gropu[0]','$section_name')";
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
		$query="select * from add_section";
		$result=$db->select_query($query);
		if($result)
		{
			$select_class="SELECT `add_section`.*,`add_class`.`class_name` FROM `add_section` INNER JOIN `add_class`
ON `add_class`.`id`=`add_section`.`class_id` GROUP BY `add_section`.`class_id` ORDER BY `add_class`.`index` ASC";
			$result_class=$db->select_query($select_class);
			if($result_class)
			{
				$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr class='warning' >"."<td align='left' colspan='3'>"."<a href='add_section.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:380px; font-weight:blod;'>View All Section</span>"."</td>"."</tr>";
				while($fetch_class=$result_class->fetch_array()){
					$table.="<tr>"."<td colspan='3' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetch_class[4]."</span>"."</td>"."</tr>";
					$selec_section="SELECT `add_section`.*,`add_group`.`group_name` FROM `add_section` INNER JOIN `add_group` ON `add_group`.`id`=`add_section`.`group_id`
WHERE `add_section`.`class_id`='".$fetch_class[1]."' ORDER BY `add_group`.`group_name` ASC";
					$result_section=$db->select_query($selec_section);
					if($result_section)
					{
						$table.="<tr class='text-center info'>"."<td class='text-center'>Section Name</td>"."<td class='text-center'>group Name</td>"."<td>Edit</td>"."</tr>";
						while($fetch_section=$result_section->fetch_array())
						{
						
							$table.="<tr>"."<td class='text-center text-danger'>".$fetch_section[3]."</td>"."<td class='text-center text-danger'>".$fetch_section[4]."</td>"."<td class='text-center'>";
									$table.="<a href='?edit=$fetch_section[0]&gp=$fetch_section[2]&cs=$fetch_section[1]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>";
									$table.="</td>"."</tr>";
						}
					}
				}
				
			$table.="</table>"."<div>";
			}
		}	
	
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$query="SELECT `add_section`.*,`add_class`.`id`,`class_name`,`add_group`.`id`,`group_name` FROM `add_section` JOIN `add_class`
ON `add_section`.`class_id`=`add_class`.`id` JOIN `add_group` ON `add_class`.`id`=`add_group`.`class_id` WHERE `add_section`.`id`='".$_GET['edit']."' AND `add_group`.`id`='".$_GET["gp"]."' AND `add_class`.`id`='".$_GET["cs"]."'";
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
		$query="DELETE FROM `add_section` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_section','id',"33".$prefix,'12');
		print "<script>location='add_section.php'</script";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}
	if(isset($_POST['Clear']))
	{
		print "<script>location='add_section.php'</script";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    <link rel="stylesheet" href="calander/css/jquery-ui-1.9.1.custom.min.css" type="text/css" />
	
	<script src="calander/js/jquery-1.8.2.js" type="text/javascript"></script>
	<script src="calander/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
    
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
		<?php 
		if(isset($_POST["View"]))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='add_section.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Section </span> </td>
  			</tr>
		<tr>
				<td class="info"> Class Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" readonly="" name="id" value="<?php echo $fetch[0];?>" />
						<select name="className" id="className" class="form-control">
							
							<?php 
									if($chek)
									{
							?>
								<option value="<?php echo "$fetch[4]and$fetch[5]"?>"><?php echo $fetch[5];?></option>
							<?php } else {?>
							
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
							<?php }  } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Group Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="groupname" id="groupname" class="form-control">
								<?php 
									if($chek)
									{
							?>
								<option value="<?php echo "$fetch[6]and$fetch[7]"?>"><?php echo $fetch[7];?></option>
							<?php } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Section Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" name="sectionname" value="<?php echo $fetch[3];?>" placeholder="Section Name"  class="form-control" />
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
