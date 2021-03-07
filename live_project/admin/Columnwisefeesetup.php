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
	
	
	
	$fetch[1]='';
	$fetch[2]='';
	$fetch[8]='';
	$fetch[4]='';
	$fetch[3]='';
	$fetch[5]="";
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('columnwisefeesetupforstd','id',"0".$prefix,'10');
	
	global $chek;

//add dat......................................
if(isset($_POST['add']))
	{
	
			
		
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['columnId']);
	
		$year=$db->escape($_POST['checkbox']);
		//print_r($exploide_gropu);
		$className=explode('and',$_POST['className']);
		
		if(!empty($_POST['checkbox']) && !empty($title) )
		{
			 $countFees = count($_POST['checkbox']);
			 for($x = 0 ;$x < $countFees ; $x++){
			 
			  $query="INSERT INTO `columnwisefeesetupforstd` VALUES ('".$fetch[0]."','$title','".$_POST['checkbox'][$x]."','$className[0]')";
			$resultisnsert=$db->insert_query($query);
			$fetch[0]=$db->withoutPrefix('columnwisefeesetupforstd','id',"0".$prefix,'10');

			 
			 }
			

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
		$query="DELETE FROM `add_fee` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('columnwisefeesetupforstd','id',"0".$prefix,'10');
		print "<script>location='Columnwisefeesetup.php'</script>";
		
	}
//post end delete data.........................................

//post update data..........................................
if(isset($_POST['Update']))
	{
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['title']);
	
		$year=$db->escape($_POST['year']);
		//print_r($exploide_gropu);
		
		if(!empty($id) && !empty($year) && !empty($title) )
		{
			$query="REPLACE  INTO `coloumn_setup` VALUES ('".$_POST["id"]."','$title','$year')";
			$resultisnsert=$db->update_query($query);
			//print_r($query);
				$src_text=$db->escape($_POST['id']);
		$query="SELECT * FROM `coloumn_setup` WHERE `id`='".$_POST["id"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}


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
		$query="SELECT `columnwisefeesetupforstd`.*,`add_class`.`class_name` FROM `columnwisefeesetupforstd`
INNER JOIN `add_class` ON `add_class`.`id`=`columnwisefeesetupforstd`.`fk_cls_id` 
GROUP BY `columnwisefeesetupforstd`.`fk_cls_id`";
		$result=$db->select_query($query);
		if($result)
		{
		
		
		$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr class='warning' >"."<td align='left' colspan='7'>"."<a href='Columnwisefeesetup.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:380px; font-weight:blod;'>Show All </span>"."</td>"."</tr>";
			
					
					
					$sgrouocoloum="SELECT `columnwisefeesetupforstd`.*,`add_class`.`class_name` FROM `columnwisefeesetupforstd`
INNER JOIN `add_class` ON `add_class`.`id`=`columnwisefeesetupforstd`.`fk_cls_id` 
GROUP BY `columnwisefeesetupforstd`.`fk_cls_id`";


$resultsgrouocoloum=$db->select_query($sgrouocoloum);
		if($resultsgrouocoloum)
		{
				while($fetcresultsgrouocoloum=$resultsgrouocoloum->fetch_array()){
				
				
			$table.="<tr>"."<td colspan='7' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetcresultsgrouocoloum['class_name']."</span>"."</td>"."</tr>";

				$table.="<tr>"."<td>column Name </td>"."<td>Fee Title </td>"."<td>Action</td>"."</tr>";	
					 $selectFeeName = "SELECT `columnwisefeesetupforstd`.*, `add_fee`.`title`,`coloumn_setup`.`Name` FROM `columnwisefeesetupforstd` 
INNER JOIN `add_fee` ON `add_fee`.`id`=`columnwisefeesetupforstd`.`fk_fee_id` 
INNER JOIN `coloumn_setup` ON `coloumn_setup`.`id`=`columnwisefeesetupforstd`.`fk_column_id`
WHERE `columnwisefeesetupforstd`.`fk_cls_id`='".$fetcresultsgrouocoloum['fk_cls_id']."'";
$resuFe=$db->select_query($selectFeeName);
		if($resuFe)
		{
		
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$resuFe->fetch_array()){
						$table.="<tr>";
						
							$table.="<td>".$fetch_all['Name']."</td>";
							$table.="<td>".$fetch_all['title']."</td>";
							
							
						
						$table.="<td>";
						$table.="<a href='?dlt=$fetch_all[0]'class='btn btn-primary' onclick='return confirm_click()' style='width:80px'>Delete</a>"."</td>";
									
						$table.="</tr>";
						
						
						
				}
				}
				
			}
			}
				
				$table.="</table>"."<div>";
			
			
			}
		
		
		
	}

//end view data.....................................

//link edit data...................................	

//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `columnwisefeesetupforstd` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('columnwisefeesetupforstd','id',"0".$prefix,'10');
		print "<script>location='Columnwisefeesetup.php'</script>";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Clear']))
	{
		print "<script>location='Columnwisefeesetup.php'</script>";
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
 



function showFee(){
		var id =$('#stdId').val();
		var showDataforcolum="feesss";
		var ClassId=$('#className').val();
		var groupID=$('#groupname').val();
		var year=$('#year').val();
		
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForaddFee.php",
                    data: {id:id,showDataforcolum:showDataforcolum,ClassId:ClassId,groupID:groupID,year:year},
                    cache: false,
                    success: function(data) {
                  //  alert(data);
						$('#showFees').html(data);
						}
						
					
					
                    });
	
    }
	
	
	
</script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">		<?php 
		if(isset($_POST["View"]))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Columnwisefeesetup.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" cellpadding="0" cellspacing="0" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td colspan="3" align="center">
				<span style="font-size:22px; color:#333; display:block;">Column Wise Fee Setup </span>  	
				</td>			
			</tr>
			
			
						
					
			<tr>
				<td width="19%" height="51" class="info">Select Column</td>
				<td width="0%" class="info">:</td>
				<td width="81%" class="info">
					<div class="col-lg-6 has-warning">
								<select name="columnId"  class="form-control" style="border-radius:0px;">
								<option disabled="disabled">Select One</option>
								<?php 
								$selMonth = "SELECT * FROM `coloumn_setup` ORDER BY `id` ASC";
								$checkMont=$db->select_query($selMonth);
								if($checkMont)
								{
									while($fetmonth=$checkMont->fetch_array())
								{
										if($fetch[6] != $fetmonth[0] ){
							?>
							<option value="<?php echo "$fetmonth[0]"?>"><?php echo $fetmonth[1];?></option>
							<?php }  }  } ?>
								</select>
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
			  </td>
				
			</tr>	
				
				
			
		<tr>
				<td width="19%" height="51" class="info">Year</td>
				<td width="0%" class="info">:</td>
				<td width="81%" class="info">
					<div class="col-lg-6 has-warning">
								<input type="text" value="<?php echo date('Y')?>" style="width:100%; height:30px; padding-left:5px;" name="year" id="year"></input>
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
			  </td>
				
			</tr>	
						
					
			<tr>
				<td class="info">Select Class</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-6 has-warning">
								<select name="className"  id="className"  class="form-control" onChange="showFee()" style="border-radius:0px;">
								<option>Select One</option>
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
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				
		</tr>	
				
				
				

			<tr>
				<td class="info" colspan="5" id="showFees"></td>
				
				
				
			</tr>
			
			<tr>	
  				<td class="danger" colspan="3" bgcolor="#dddddd" align="center"><span>
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
  				<td bgcolor="#f4f4f4" class="warning" colspan="3"align="center" >
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
