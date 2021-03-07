
<script type="text/javascript">
	function confirm_click()
	{
		var con=confirm("Do you want to delete the Subject ?");
		if(con==true)
		{
			return true;

		}
		else
		{
			return false;
		}
	}
</script>
<style type="text/css">
	
	@media print{
		.print{
			display: none;
		}
		a[href]:after {
    content: none !important;
  }
	}
</style>

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
	
		 $selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);

	$fetch[6]='';
	$fetch[5]="";
	$fetch[4]='';
	$fetch[3]="";
	$fetch[2]='';
	$fetch[1]="";
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_subject_info','id',"36".$prefix,'12');
	

//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['className']);
		@$explodeclass_name=explode("and",$classname);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide=explode("and",$class_section);
		$subject_name = $db->escape($_POST['subjectname']);
		$subject_code = $db->escape($_POST['subjectcode']); 
		$subjecttype=$db->escape($_POST['subjecttype']);
		if(!empty($id) && !empty($classname) && !empty($class_section) && !empty($subject_name) && !empty($subject_code) && !empty($subjecttype))
		{
			$query="INSERT INTO `add_subject_info` (`id`,`class_id`,`group_id`,`subject_name`,`subject_code`,`select_subject_type`,`serial`) VALUES ('".$fetch[0]."','$explodeclass_name[0]','$exploide[0]','$subject_name','$subject_code','$subjecttype','".$_POST["Serial"]."')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
			$fetch[0]=$db->withoutPrefix('add_subject_info','id',"36".$prefix,'12');
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
		$query="DELETE FROM `add_subject_info` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_subject_info','id',"36".$prefix,'12');
		 print "<script>location='addsubject.php'</script";

	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{

		$id=$db->escape($_POST['id']);
		$classname=$db->escape($_POST['className']);
		@$explodeclass_name=explode("and",$classname);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide=explode("and",$class_section);
		$subject_name = $db->escape($_POST['subjectname']);
		$subject_code = $db->escape($_POST['subjectcode']); 
		$subjecttype=$db->escape($_POST['subjecttype']);
		if(!empty($id) && !empty($classname) && !empty($class_section) && !empty($subjecttype) && !empty($subject_name) && !empty($subject_code))
		{
			$query="REPLACE INTO `add_subject_info` (`id`,`class_id`,`group_id`,`subject_name`,`subject_code`,`select_subject_type`,`serial`) VALUES ('$id','$explodeclass_name[0]','$exploide[0]','$subject_name','$subject_code','$subjecttype','".$_POST["Serial"]."')";
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
	{?>

		<table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:0px;">
    <tr>
      <td  height="50"  colspan="4" align="center" >
 
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px; list-style: none;"><?php echo $fetchApp["institute_name"]?></li>
   <li style="list-style: none;"><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style=" list-style: none; margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
    <li style="list-style: none;"><h4>View All Subject </h4></li>
     </ul>     


      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>

		<?php



		$query="select * from add_subject_info";
		$result=$db->select_query($query);

		$table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";

$table.="<tr class='warning'><td align='left' colspan='6'><a href='addsubject.php' class='btn btn-primary'> Back</a></td> <tr>";







		if($result){
			
			$seect_class=" SELECT `add_class`.`class_name`,`add_subject_info`.`class_id` FROM `add_subject_info` INNER JOIN `add_class` ON `add_subject_info`.`class_id`=`add_class`.`id` GROUP BY `class_name` ORDER BY `add_class`.`id` ASC";
			$result_Class=$db->select_query($seect_class);
			if($result_Class)
			{
				
				while($a=$result_Class->fetch_array()){
				$table.="<tr class='info'>"."<td colspan='5' align='center' class='bg-warning'>"."<span class='text-success'>"."<strong>".$a[0]."</strong>"."</span>"."</td>"."</tr>";
					
					$select_group="SELECT `add_subject_info`.`class_id`,`group_id`,`add_group`.`group_name` FROM `add_subject_info` INNER JOIN `add_group` ON `add_subject_info`.`group_id`=`add_group`.`id` WHERE `add_subject_info`.`class_id`='".$a[1]."' GROUP BY group_id  ORDER BY `add_group`.`id` ASC ";
					$result_group=$db->select_query($select_group);
					if($result_group){
					while ($v=$result_group->fetch_array())
					{
						$table.="<tr class='warning'>"."<td colspan='5' align='center' class='bg-warning'>"."<span class='text-success'>"."<strong>".$v[2]."</strong>"."</span>"."</td>"."</tr>";
						$table.="<tr class='success'>"."<td >Subject Name</td>"."<td>Subject Code</td>"."<td>Subject Type"."<td>Edit Or Delete</td>"."</tr>";
						$select_all="SELECT `id`,`subject_name`,`subject_code`,`select_subject_type` FROM `add_subject_info` WHERE `group_id`='".$v[1]."' ORDER BY `add_subject_info`.`serial` ASC ";
						$result_all=$db->select_query($select_all);
						
						if($result_all)
						{
							$count=mysqli_num_fields($result_all);
							while($fetch_all=$result_all->fetch_array())
							{

								$table.="<tr>";
								for($i =1 ;$i < $count;$i++)
								{
									$table.="<td>".$fetch_all[$i]."</td>";
								}
								$table.="<td>";
							$table.="<a href='?edit=$fetch_all[0]&cs=$v[0]&gp=$v[1]' class='btn btn-primary' style='width:80px'>Edit</a> &nbsp;&nbsp; <a href='?del=$fetch_all[0]' class='btn btn-danger' style='width:80px' onclick='return confirm_click()'>Delete</a>";
							$table.="</td>";
								$table.="</tr>";
							}
						}

					}
				}
					
				

				}

			}	
		}
		
		$table.="</table>";
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		 	$query="SELECT `add_subject_info`.*,`add_class`.`id`,`class_name`,`add_group`.`id`,`group_name` FROM `add_subject_info` JOIN `add_class` ON
`add_class`.`id`=`add_subject_info`.`class_id` JOIN `add_group` ON `add_group`.`class_id`=`add_class`.`id` WHERE `add_subject_info`.`id`='".$_GET["edit"]."' AND `add_class`.`id`='".$_GET["cs"]."' AND `add_group`.`id`='".$_GET["gp"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}
	}
//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['del']))
	{
		$id=$db->escape($_GET['del']);
		$query="DELETE FROM `add_subject_info` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		
	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}
	if(isset($_POST['Clear']))
	{
		print "<script>location='addsubject.php'</script>";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
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
				if(result != 1 )
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
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='addsubject.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4"  class="warning"  colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Subject</span> </td>
  			</tr>
					
			<tr>
				<td class="info"> Class Name </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<input type="hidden" readonly=""  name="id" value="<?php echo $fetch[0];?>" />
						<select name="className" id="className" class="form-control">
						
						<?php
								if($chek){
							?>
								<option value="<?php echo "$fetch[7]and$fetch[8]"?>"><?php echo $fetch[8];?></option>
							
							<?php } else { ?>
							<option>Select One</option>
							<?php } ?>
							<?php 
								$select_section = "SELECT * FROM `add_class` order by id asc";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
									if($fetch[8]!=$fetchsection[2]){
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php } }  } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Select Group </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="groupname" id="groupname" class="form-control">
							<?php
								if($chek){
							?>
								<option value="<?php echo "$fetch[9]and$fetch[10]"?>"><?php echo $fetch[10];?></option>
							
							<?php } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Subject Name" value="<?php echo $fetch[3];?>" class="form-control" name="subjectname"  />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Code</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Subject Code" value="<?php echo $fetch[4];?>" class="form-control" name="subjectcode"  />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Serial No</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Serial No" value="<?php echo $fetch[6];?>" class="form-control" name="Serial"  />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>
			<tr>
				<td class="info"> Select Subject Type</td>
				<td class="info">:</td>
				<td class="info" colspan="2">
					<div class="col-lg-12 has-warning">
						<input type="radio" name="subjecttype" class="radio-inline" value="CompulsorySubject"<?php 
							if($fetch[5]=="CompulsorySubject") {?>
								checked="checked";
							<?php }
						?>>Compulsory Subject</input>
						<input type="radio"  name="subjecttype" class="radio-inline" value="GroupSubject"<?php 
							if($fetch[5]=="GroupSubject") {?>
								checked="checked";
							<?php }
						?>>Group Subject</input>
						<input type="radio"  name="subjecttype" class="radio-inline" value="OptionalSubject" <?php 
							if($fetch[5]=="OptionalSubject") {?>
								checked="checked";
							<?php }
						?>>Optional Subject</input>
					</div>
				</td>
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
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
