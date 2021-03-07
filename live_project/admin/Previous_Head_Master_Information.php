	<?php
		error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
		require_once("../db_connect/conect.php");

		$db = new database();
	
		global $table;
		$fetch[4]="";
		$fetch[1]="";
		$fetch[2]="";
		$fetch[3]="";
		$fetch[5]="";
		$prefix=date("y"."m"."d");
	    $fetch[0]=$db->withoutPrefix('previous_principal','id',$prefix,'10');
		
		if(isset($_POST['add']))
		{
			$title = $db->escape($_POST['title']);
			$name = $db->escape($_POST['name']);
			$to = $db->escape($_POST['to']);
			$form=$db->escape($_POST['from']);
			$ptid=$db->escape($_POST['id']);
			@$desingation = $db->escape($_POST['desingation']);
			if(!empty($title) && !empty($name) && !empty($to) && !empty($form) && !empty($desingation))
			{
				$query="INSERT INTO `previous_principal` (`id`,`title`,`name`,`to`,`from`,`designation`) VALUES ('".$fetch[0]."','$title','$name','$to','$form','$desingation')";
				//print_r($query);
				
				$resultisnsert=$db->insert_query($query);
				 $strfimg="../other_img/".$fetch[0].".jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
                @chmod($strfimg,0644);
				$fetch[0]=$db->withoutPrefix('previous_principal','id',$prefix,'10');

			}
			else
			{
				$msg="<span class='text-center text-danger glyphicon glyphicon-remove'>&nbsp;Please Fill Up TextField</span>";
			}
		}
		

		if(isset($_POST['srcbutton']))
		{
			//print "dsafa";
			$src_text=$db->escape($_POST['srctext']);
			if(!empty($src_text))
			{
				$query="SELECT * FROM `previous_principal` WHERE `id`='$src_text'";
				$cheked_query=$db->select_query($query);
				if($cheked_query)
					{
						$fetch=$cheked_query->fetch_array();
					}

			}
			else
			{
				$msg="<span class='text-center text-danger glyphicon glyphicon-remove'>&nbsp;Not Found !!</span>";
			}
		}

		if(isset($_POST['Update']))
		{
		$title = $db->escape($_POST['title']);
			$name = $db->escape($_POST['name']);
			$to = $db->escape($_POST['to']);
			$form=$db->escape($_POST['from']);
			$ptid=$db->escape($_POST['id']);
			$desingation = $db->escape($_POST['desingation']);
			if(!empty($title) && !empty($name) && !empty($to) && !empty($form) && !empty($desingation))
			{
				$query="REPLACE INTO `previous_principal` (`id`,`title`,`name`,`to`,`from`,`designation`) VALUES ('$ptid','$title','$name','$to','$form','$desingation')";
				 $strfimg="../other_img/$ptid.jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
                @chmod($strfimg,0644);
				$update=$db->update_query($query);			
			}
			else
			{
				$msg="<span class='text-center text-danger glyphicon glyphicon-remove'>&nbsp;Please Fill Up TextField</span>";	
			}
		}

		if(isset($_POST['Delete']))
		{
			$ptid=$db->escape($_POST['id']);
			$query="DELETE FROM `previous_principal` WHERE `id`='$ptid'";
			$delete=$db->delete_query($query);
			$fetch[0]=$db->withoutPrefix('previous_principal','id',$prefix,'10');
			print "<script>location='Previous_Head_Master_Information.php'</script>";

			
		}
		if(isset($_POST['View']))
		{
			$query="select * from previous_principal";
			$result=$db->select_query($query);
			
			$table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
       		 $table.="<tr class='warning' >"."<td align='left' colspan='8'>"."<a href='Previous_Head_Master_Information.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:380px; font-weight:blod;'>
Current and former headmasters Information</span>"."</td>"."</tr>";
			$table.="<tr class='' style='margin-top:10px;'>"."<td>Title</td>"."<td>Name</td>"."<td>To</td>"."<td>From</td>"."<td>Designation</td>"."<td>Image</td>"."<td>Edit Or Delete</td>"."</tr>";
			if($result){
				$num_fields=mysqli_num_fields($result);
			while($a=$result->fetch_array())
			{
				$table.="<tr class=''>";
				for($i=1;$i<$num_fields;$i++)
				{
					$table.="<td>".$a[$i]."</td>";

				}
				$table.="<td>".'<a href="../other_img/'.$a[0].'.jpg" class="btn btn-primary" target="_blank">Download</a>'."</td>";
				$table.="<td align='center'>";
				$table.="<a href='Previous_Head_Master_Information.php?edit=$a[0]' class='btn btn-primary' style='width:80px' onclick='return confirm_click()'>Edit</a><br/><a style='width:80px; margin-top:2px;' href='Previous_Head_Master_Information.php?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()	'>Delete</a>";
				$table.="</td>";
				$table.="</tr>";
			} }
			$table.="</table>";
		}

		if(isset($_GET['edit']))
		{
			$src_text=$db->escape($_GET['edit']	);
			if(!empty($src_text))
			{
				$query="SELECT * FROM `previous_principal` WHERE `id`='$src_text'";
				$cheked_query=$db->select_query($query);
				if($cheked_query)
					{
						$fetch=$cheked_query->fetch_array();
					}

			}
			else
			{
				$msg="<span class='text-center text-danger glyphicon glyphicon-remove'>&nbsp;Not Found !!</span>";
			}
		}

		if(isset($_GET['dlt']))
		{
			$linid=$db->escape($_GET['dlt']);
			$query="DELETE FROM `previous_principal` WHERE `id`='$linid'";
			$delete=$db->delete_query($query);
			 $fetch[0]=$db->withoutPrefix('previous_principal','id',$prefix,'10');
			print "<script>location='Previous_Head_Master_Information.php'</script>";
			@unlink("../other_img/".$linid.".jpg");
			
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
		
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>


		    <link href="../css/bootstrap.min.css" rel="stylesheet">

	    <link rel="stylesheet" href="datespicker/datepicker.css">
	    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

	   <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
	     <script src="datespicker/bootstrap-datepicker.js"></script>
	    
	    <script type="text/javascript">
	    	function confirm_click()
	    	{
	    		$confirm_click=confirm('Are You Confirm Update ');
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
	    		$confirm_click=confirm('Are You Confirm Delete ');
	    		if($confirm_click===true)
	    		{
	    			return true;
	    		}
	    		else
	    		{
	    			return false;
	    		}
	    	}

	    	// When the document is ready
	            $(document).ready(function () {
	                
	                $('#example1').datepicker({
	                    format: "dd/mm/yyyy"
	                });  
	            
	            });
	             // When the document is ready
	            $(document).ready(function () {
	                
	                $('#example2').datepicker({
	                    format: "dd/mm/yyyy"
	                });  
	            
	            });
				function viewShowImage(e){
		var file = e.files[0];
			var imagefile = file.type;		
			var type = ["image/jpeg","image/png","image/jpg"];
			if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2]){
				var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
			}else{
				alert("Please select a vild image");
			}
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
				//$("#textt").text("Selected Image : ");
                $("#preview").attr('src',e.target.result);
				$("#preview").css('height','60px');
            }
			}
			$(":file").filestyle();
	    </script>
	  </head>
		
	  <body>
	  	<form name="" action=""  method="post"  enctype="multipart/form-data" class="form-horizontal" >
		
		<?php 
			if(isset($_POST['View']))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Previous_Head_Master_Information.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}else{
		?>
	  	<div class="has-feedback col-xs-12 col-md-8 col-sm-8 col-sm-offset-2 col-md-offset-2">
	  	<table align="center" class="table table-responsive" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
	  			<tr>
	  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Current and former headmasters Information</span> </td>
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
					<td class="info">Title </td>
					<td class="info">:</td>
					<td colspan="2" class="info">
						<div class="col-lg-10 col-sm-10 col-md-10 has-warning">
							<input type="text" name="title" class="form-control" value="<?php echo $fetch[1]; ?>" />
	                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						</div>
						<input type="hidden" name="id" value="<?php echo @$fetch[0];?>" />
					</td>
				</tr>
				<tr>
					<td class="info">Name </td>
					<td class="info">:</td>
					<td colspan="2" class="info">
						<div class="col-lg-10 col-sm-10 col-md-10 has-warning">
							<input type="text" name="name" class="form-control" value="<?php echo $fetch[2]; ?>" />
	                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						</div>
					</td>
				</tr>
				<tr class="info">
					<td>To</td>
					<td>:</td>
					<td colspan="2">
						<div class="col-lg-10 col-sm-10 col-md-10 has-warning">
							<input type="text" id="example1" class="form-control" name="to" value="<?php echo $fetch[3];?>"/><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						</div>
						
					</td>
					
				</tr>
				<tr class="info">
					<td>From</td>
					<td>:</td>
					<td colspan="2">
						<div class="col-lg-10 col-sm-10 col-md-10 has-warning">
							<input type="text" id="example2" class="form-control" name="from" value="<?php echo $fetch[4];?>" /><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						</div>
					</td>
					 
				</tr>
				<tr>
					<td colspan="1" class="info">Designation</td>
					<td class="info">:</td>
					<td colspan="2" class="info">
						<div class="col-lg-10 col-sm-10 col-md-10 has-warning">
							<select class="form-control" name="desingation">
								
								<?php 
									if($cheked_query)
									{?>
									<option><?php echo $fetch[5];?></option>
								<?php	} else {
								?>
								<option>Select One..</option>
								<?php } ?>
								<option>Headmaster </option>
								<option>Headmaster In-charge</option>
							</select>
							
						</div>
					</td>
				</tr>
				 <tr class="success">
                    <td align="left">
    Picture(250*200)px</td>
                    <td>:</td>
                    <td colspan="2">
                       <div class="col-lg-8 col-md-8"><input type="file" class="filestyle" name="file" accept="image/*" id="file" onChange="viewShowImage(this)" /></div><br/><br/<br/>
					   <img src="all_image/Noimage.png" class='img-responsive img-thumbnail' height='90' width='90' id="preview" style='margin-top: 5px; margin-left:15px;' />
                    </td>
                   
                     
                </tr>
				<tr>
	  				<td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
	  					<?php 
	  						if(isset($msg))
	  						{
	  							echo "<strong>".$msg."</strong>";
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
					
					<?php if(!$cheked_query){ ?>
						<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
						<?php } else { ?>
						<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
						<?php } ?>
						<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
						<input type="submit" value="Delete" name="Delete" onClick="return confirm_delete()" class="btn btn-primary btn-sm" style="width:80px;"/>
						
						<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
					</td>
	  			</tr>
	  	</table>
		
				</div>

	  	<?php } ?>
		</form>
	 
	    <script src="../js/bootstrap.min.js"></script>
	  </body>
	</html>
	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
