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
	global  $chek;
	
	$fetch[5]='';
	$fetch[6]="";
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_subject_part_info','part_id',"37".$prefix,'12');
	
	
//add dat......................................
if(isset($_POST['add']))
	{
		$id=$db->escape($_POST['id']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		@$explodeclass_name=explode("and",$classname);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide=explode("and",$class_section);
		$examtype=$db->escape(isset($_POST['examtype'])?$_POST['examtype']:"");
		@$exploide_examtype=explode('and', $examtype);

		@$explode_subjectype=explode('and', $subject_type);
		$subject_name = $db->escape(isset($_POST['subjectname'])?$_POST['subjectname']:"");
		@$explodesubject_name=explode('and', $subject_name);
		$subject_part_name=$db->escape($_POST['subjectaprtname']);
		$subjectpart_code = $db->escape($_POST['subjectpartcode']); 
		$subjectpartSlNo=$db->escape($_POST['subjectpartSlNo']); 
		
		if(!empty($id) && !empty($classname) && !empty($class_section) && !empty($subject_name) && !empty($subjectpart_code) && !empty($subject_name) && $exploide_examtype[0]!="Null")
		{
			$query="INSERT INTO `add_subject_part_info` (`part_id`,`class_id`,`exam_type`,`group_id`,`subject_name`,`subject_part_name`,`subject_part_code`,`sl`)
					VALUES('".$fetch[0]."','$explodeclass_name[0]','$exploide_examtype[0]','$exploide[0]','$explodesubject_name[0]','$subject_part_name','$subjectpart_code','$subjectpartSlNo')";
			$resultisnsert=$db->insert_query($query);
			//print_r($query);
		$fetch[0]=$db->withoutPrefix('add_subject_part_info','part_id',"37".$prefix,'12');

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
		$query="DELETE FROM `add_subject_part_info` WHERE `part_id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_subject_part_info','part_id',"37".$prefix,'12');
				print "<script>location='add_Subject_part.php'</script>";
	}
//post end delete data.........................................
	//post update data..........................................
if(isset($_POST['Update']))
	{

		$id=$db->escape($_POST['id']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		@$explodeclass_name=explode("and",$classname);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		@$exploide=explode("and",$class_section);
		$examtype=$db->escape(isset($_POST['examtype'])?$_POST['examtype']:"");
		@$exploide_examtype=explode('and', $examtype);
		
		@$explode_subjectype=explode('and', $subject_type);
		$subject_name = $db->escape(isset($_POST['subjectname'])?$_POST['subjectname']:"");
		@$explodesubject_name=explode('and', $subject_name);
		$subject_part_name=$db->escape($_POST['subjectaprtname']);
		$subjectpart_code = $db->escape($_POST['subjectpartcode']); 
		$subjectpartSlNo=$db->escape($_POST['subjectpartSlNo']); 
		
		if(!empty($id) && !empty($classname) && !empty($class_section) && !empty($subject_name) && !empty($subjectpart_code)  && !empty($subject_name))
		{
			$query="REPLACE INTO `add_subject_part_info` (`part_id`,`class_id`,`exam_type`,`group_id`,`subject_name`,`subject_part_name`,`subject_part_code`,`sl`)
					VALUES('$id','$explodeclass_name[0]','$exploide_examtype[0]','$exploide[0]','$explodesubject_name[0]','$subject_part_name','$subjectpart_code','$subjectpartSlNo')";
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
		$query="select * from add_subject_part_info";
		$result=$db->select_query($query);
		if($result)
		{
			$select_class="SELECT `add_subject_part_info`.`class_id`,`add_class`.`class_name` FROM `add_subject_part_info` INNER JOIN `add_class` ON `add_subject_part_info`.`class_id`=`add_class`.`id` GROUP BY `add_subject_part_info`.`class_id` order by `add_subject_part_info`.`class_id` asc ";
			$checked_class=$db->select_query($select_class);
			if($checked_class)
			{
				$table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr class='warning' >"."<td align='left' colspan='8'>"."<a href='add_Subject_part.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:380px; font-weight:blod;'>View All Subject Part </span>"."</td>"."</tr>";
				while($fetch_class=$checked_class->fetch_array())
				{
					$table.="<tr class='success'>"."<td align='center' colspan='8'>"."<strong>"."<span class='text-justify text-danger' style='font-size:18px;'>".$fetch_class[1]."</span>"."</strong>"."</td>"."</tr>";
					$select_group="SELECT `add_subject_part_info`.`class_id`,`group_id`,`add_group`.`group_name` FROM `add_subject_part_info` INNER JOIN `add_group` ON `add_subject_part_info`.`group_id`=`add_group`.`id` WHERE `add_subject_part_info`.`class_id`='".$fetch_class[0]."' GROUP BY `add_subject_part_info`.`group_id` order by `add_subject_part_info`.`group_id` asc";
					$cheked_group=$db->select_query($select_group);
					//print "asdf";
					if($cheked_group)
					{
						//print "adsf";
						while($fetch_group=$cheked_group->fetch_array())
						{
							$table.="<tr class='warning'>"."<td align='center' colspan='8'>"."<strong>"."<span class='text-justify text-success' style='font-size:15px'>".$fetch_group[2]."</span>"."</strong>"."</td>"."</tr>";

							$select_all="SELECT `add_subject_part_info`.`part_id`,`add_subject_part_info`.`class_id`,`add_subject_part_info`.`exam_type`,`add_subject_part_info`.`group_id`,`add_subject_part_info`.`subject_name`,`add_subject_part_info`.`subject_part_name`,`add_subject_part_info`.`subject_part_code`
,`add_subject_info`.`subject_name`,`subject_code`,`select_subject_type`,`exam_type_info`.`exam_type`,`add_subject_part_info`.`sl` FROM `add_subject_part_info`
JOIN `add_subject_info` ON `add_subject_info`.`id`=`add_subject_part_info`.`subject_name` JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`add_subject_part_info`.`exam_type`
WHERE `add_subject_part_info`.`class_id`='".$fetch_class[0]."' AND `add_subject_part_info`.`group_id`='".$fetch_group[1]."' ORDER BY `add_subject_info`.`serial` ASC ";
							$chekced_all=$db->select_query($select_all);
							if($chekced_all)
							{
								$table.="<tr class=''>"."<td>Main Subject Name</td>"."<td> Main Subject code</td>"."<td>Subject Part Name</td>"."<td>Subject Part Code</td>"."<td>SL. No.</td>"."<td>Subject Type</td>"."<td>Exam Type</td>"."<td>Edit </td>"."</tr>";
								while($fetch_all=$chekced_all->fetch_array())
								{
									$count=mysqli_num_fields($chekced_all);
									
									$table.="<tr>"."<td>".$fetch_all[7]."</td>"."<td>".$fetch_all[8]."</td>"."<td>".$fetch_all[5]."</td>"."<td>".$fetch_all[6]."</td>"."<td>".$fetch_all[11]."</td>"."<td>".$fetch_all[9]."</td>"."<td>".$fetch_all[10]."</td>";
								
									$table.="<td  align='center'>";
									$table.="<a href='?edit=$fetch_all[0]&cs=$fetch_all[1]&gp=$fetch_all[3]' class='btn btn-primary' style='width:80px' confirm_click='return confirm_click()'>Edit</a>"."&nbsp;<a href='?delete=$fetch_all[0]&cs=$fetch_all[1]&gp=$fetch_all[3]' class='btn btn-danger' style='width:80px' confirm_click='return confirm_delete()'>Delete</a>";

									

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
		 $query="SELECT `add_subject_part_info`.*,`exam_type_info`.`exam_type`,`add_class`.`class_name`,`add_group`.`group_name`,
`add_subject_info`.`subject_name`,`select_subject_type` FROM `add_subject_part_info` 
JOIN `exam_type_info` ON `exam_type_info`.`exam_id`=`add_subject_part_info`.`exam_type` 
JOIN `add_class` ON `add_class`.`id`=`exam_type_info`.`select_class` JOIN `add_group` 
ON `add_group`.`id`=`add_subject_part_info`.`group_id` JOIN `add_subject_info`
 ON `add_subject_info`.`id`=`add_subject_part_info`.`subject_name`

WHERE `add_subject_part_info`.`part_id`='".$_GET["edit"]."' AND `add_class`.`id`='".$_GET["cs"]."' AND `add_group`.`id`='".$_GET["gp"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}
	}

	if(isset($_GET['delete']))
	{
		$src_text=$db->escape($_GET['delete']);
		 $query="DELETE from  `add_subject_part_info` WHERE `add_subject_part_info`.`part_id`='$src_text'";
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
		$query="DELETE FROM `add_subject_part_info` WHERE `part_id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_subject_part_info','part_id',"37".$prefix,'12');
				print "<script>location='add_Subject_part.php'</script>";


	}
//end link delete data........................

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
 $(document).ready(function(e) {
            var checking_html = '<img src="search_group/loading.gif" /> Checking...';
			
			<!--   /*     On Change Running Class          */      -->
			$('#className').change(function(e) {
				$('#checkingGroup').html(checking_html);
                checkGroup();
				Check_exam_type();
				check_subjectype();
            });	

            $('#groupname').change(function(e) {
				$('#checkingsection').html(checking_html);
                check_subjectype();
				
            });	
        });

//function to check group name
function checkGroup()
{
		var class_name = $('#className').val();
		$.post("check_grou_name.php", { className: class_name },
			function(result){
				//if the result is 1
				if(result !=0 )
				{
					//show that the username is available
					$('#groupname').html(result);
					$('#checkingGroup').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#checkingGroup').html('No Group Name Found');
					
					$('#groupname').html('');
				}
		});

}  


//function to check exam type availability	
function Check_exam_type()
{
		var class_name = $('#className').val();
		$.post("Check_exam_type.php", { className: class_name },
			function(result){
				//if the result is 1
				if(result !=0 )
				{
					//show that the username is available
					$('#examtype').html(result);
					$('#checkingGroup').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#checkingGroup').html('No Exam  Name Found');
					$('#item_result').html("");
					$('#examtype').html('');
				}
		});

}  

//function to check subjecttype type availability	
function check_subjectype()
{
		var class_name = $('#className').val();
		//alert(class_name);
		var group_name = $('#groupname').val();
		//alert(group_name);
		$.post("check_subject_type.php", { className: class_name, groupName: group_name },
			function(result){
				//if the result is 1
				if(result !=0 )
				{
					//show that the username is available
					$('#subjectype').html(result);
					$('#checkingsection').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#checkingsection').html('No Subject Type Found');
					$('#item_result').html("");
					$('#subjectype').html('');
				}
		});

}  

 $(document).ready(function()
  {
		var checking_html = '<img src="search_group/loading.gif" /> Checking...';
		$('#subjectype').change(function()
		{
			$('#checksubjectype').html(checking_html);
				check_subject_name();
		});	
  });
//function to check subjecttype type availability	
function check_subject_name()
{
		var class_name = $('#className').val();
		//alert(class_name);
		var group_name = $('#groupname').val();
		//alert(group_name);
		var subject_type=$('#subjectype').val();
		//alert(subject_type);
		$.post("checksubjectname.php", { className: class_name, groupName: group_name,stubjectype:subject_type },
			function(result){
				//if the result is 1
				if(result !=0 )
				{
					//show that the username is available
					$('#subjectname').html(result);
					$('#checksubjectype').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#checksubjectype').html('No Subject Type Found');
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
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='add_Subject_part.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"  bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Subject Part</span> </td>
  			</tr>
					
			<tr>
				<td class="info"> Class Name </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
					<input type="hidden" readonly=""  name="id" value="<?php echo $fetch[0];?>" />
						<select name="className" id="className" class="form-control">
							<?php
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[1]and$fetch[8]"?>"><?php echo $fetch[8];?></option>
							<?php } else {?>
							<option>Select One</option>
							<?php } ?>
							<?php 
								$select_section = "SELECT * FROM `add_class` order by id asc";
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
				<td class='info'><span id="checkingGroup"></span><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Exam Type</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="examtype" id="examtype" class="form-control">
								<?php
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[2]and$fetch[7]"?>"><?php echo $fetch[7];?></option>
							<?php } ?>
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
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[3]and$fetch[9]"?>"><?php echo $fetch[9];?></option>
							<?php } ?>
						</select>
						<span id="grupnameresult"></span>
					</div>
				</td>
				<td class='info'><span id="checkingsection"></span><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Type</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="subjectype" id="subjectype" class="form-control">
								<?php
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[4]and$fetch[11]"?>"><?php echo $fetch[11];?></option>
							<?php } ?>
						</select>
					</div>
				</td>
				<td class='info'><span id="checksubjectype"></span><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Name</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="subjectname" id="subjectname" class="form-control">
								<?php
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[4]and$fetch[10]"?>"><?php echo $fetch[10];?></option>
							<?php } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Subject Part Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Subject Part Name" value="<?php echo $fetch[5];?>" class="form-control" name="subjectaprtname"  />
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
						<input type="text" placeholder="Subject Code" value="<?php echo $fetch[6];?>" class="form-control" name="subjectpartcode"  />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong>*&nbsp;Try It English</strong></span></td>
			</tr>

				<tr>
				<td class="info"> Subject Subject Part SL. No.</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Subject Code Sl. No." value="<?php echo $fetch[7];?>" class="form-control" name="subjectpartSlNo"  />
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
					
					<?php }  ?>
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Delete" name="Delete" class="btn btn-primary btn-sm" style="width:80px;"  onclick='return confirm_delete()'/>					
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
