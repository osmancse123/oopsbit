<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

    $db = new database();
	$prefix=date("y"."m"."d");
	$fetch_p[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
		$selesl="SELECT MAX(`sl`) FROM `video_gallery`";
	$chke=$db->select_query($selesl);
	{
		$fetch_sl=$chke->fetch_array();
		$inc=$fetch_sl[0]+1;
	}
	
	if(isset($_POST["add"]))
	{
		$sl = $db->escape($_POST['sl_num']);
		$title = $db->escape($_POST['title']);
		$details = $db->escape($_POST['details']);
		$url = $db->escape($_POST['url']);
		$date = $db->escape($_POST['date']);
		if(isset($_FILES["file"])){

        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];   
        $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                $inserquery="INSERT INTO video_gallery VALUES('".$fetch_p[0]."','$sl','$title','$details','$file_ext','$url','$date')";
				$db->insert_query($inserquery);
                $fetch_p[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
				move_uploaded_file($file_tmp,"../other_img/".$fetch_p[0].'.'.$file_ext);
				print "<script>location='video_gallery.php'</script>";
            }
			}
			
	}	
	
	/*if(isset($_POST['add'])) {
		//$fetch_p[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
		$sl = $db->escape($_POST['sl_num']);
		$title = $db->escape($_POST['title']);
		$details = $db->escape($_POST['details']);
		if(isset($_FILES['file'])){
			$fName = $_FILES['file']['name'];
			@$extension = strtolower(end(explode('.',$fName)));
		}	
		$url = $db->escape($_POST['url']);
		$date = $db->escape($_POST['date']);
		$alowed = array('jpg','jpeg','png','');
		if(!empty($extension)){
			$query = "INSERT INTO video_gallery VALUES('".$fetch_p[0]."','$sl','$title','$details','$extension','$url','$date')";
			if(in_array($extension, $alowed)) {
				$db->insert_query($query);
				$fetch_p[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
				$destination = "../other_img/".$fetch_p[0].".$extension";
				if(move_uploaded_file($_FILES['file']['tmp_name'],$destination)) {
					//nothing gonna happend------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				}
			}
			else{
				$msg="<span class='text-center text-danger'>Please select an image file</span>";
			}
		} else{
			$msg="<span class='text-center text-danger'>Must have select an image</span>";
		}
		
	}*/
	if(isset($_POST['view'])) {
		$fetch_p[0]='';
		$fetch_p[1]='';
		$fetch_p[2]='';
		$fetch_p[3]='';
		$fetch_p[4]='';
		$fetch_p[5]='';
		$fetch_p[6]='';
		$fetch_p[7]='';
		$display='none';
		$table = "<table class='table table-responsive table-bordered' style='margin-top:20px;'>"."<tr><td colspan='7'><input type='submit' name='view' class='btn-link' value='Refersh'/><input type='submit' name='clear' class='btn-link' value='Go Back'/></td></tr>"."<tr class='bg-primary'>"."<td>Sl</td>"."<td>Title</td>"."<td>Details</td>"."<td>Image</td>"."<td>Date</td>"."<td>Action</td>"."</tr>";
		$query = "SELECT * FROM video_gallery";
		if($checked_query=$db->select_query($query)){
			while($fetch_v = $checked_query->fetch_array()) {
				$table.="<tr>"."<td>".$fetch_v[1]."</td>"."<td>".$fetch_v[2]."</td>"."<td>".$fetch_v[3]."</td>"."<td align='center'>"."<a href='../other_img/$fetch_v[0].$fetch_v[4]' target='_blank'>"."<img src='../other_img/$fetch_v[0].$fetch_v[4]' height='60' width='100' title='Click image to inlarge' class='image-responsive' />"."</a>"."</td>"."<td>".$fetch_v[6]."</td>"."<td>"."<a href='video_gallery.php?edit=$fetch_v[0]' class='btn btn-primary'>Edit</a>"."<a href='video_gallery.php?delete=$fetch_v[0]&ext=$fetch_v[4]' class='btn btn-danger'>Delete</a>"."</td>"."</tr>";
			}
		}
		$table.="</table>";
	}
	if(isset($_GET['edit'])) {
		
		$query = "SELECT * FROM video_gallery WHERE id='".$_GET['edit']."'";
		if($result = $db->select_query($query)) {
			$fetch_p = $result->fetch_array();
		}
 	}
	if(isset($_POST["update"]))
	{
		$sl = $db->escape($_POST['sl_num']);
		$title = $db->escape($_POST['title']);
		$details = $db->escape($_POST['details']);
		$url = $db->escape($_POST['url']);
		$date = $db->escape($_POST['date']);
		if(isset($_FILES["file"])){

        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];   
        $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                $inserquery="REPLACE INTO video_gallery VALUES('".$_POST["id"]."','$sl','$title','$details','$file_ext','$url','$date')";
				$db->update_query($inserquery);
               // $fetch_p[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
				move_uploaded_file($file_tmp,"../other_img/".$_POST["id"].'.'.$file_ext);
				
            }
			}
			
	}
	if(isset($_GET['delete'])){
		$id = $db->escape($_GET['delete']);
		$query = "DELETE FROM video_gallery WHERE id='$id' ";
		if(!empty($id)){
			$db->delete_query($query);
		
			 @unlink("../other_img/".$_GET["dlt"].$_GET["ext"]);
			$fetch[0] = $db->withoutPrefix('video_gallery','id',"29".$prefix,'12');
			print "<script>location='video_gallery.php'</script>";

		}
		else
		{
			$msg="<span class='text-center text-danger'>No data</span>";
		}
		
	}

	if(isset($_POST['exit'])) {
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap.com</title>
    <!--Bootstarp-->
    <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
	<link rel="stylesheet" href="textEdit/redactor/redactor.css" />
	<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
	<script src="textEdit/redactor/redactor.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="datespicker/datepicker.css">
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 
	<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#redactor').redactor();
		}
	);
	
	  $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm to Update');
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
    		$confirm_click=confirm('Are You Confirm to Delete');
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
<form method="post" action="" name="video_gallery" enctype="multipart/form-data" >
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-md-offset-1">
		<table class="table table-responsive table-bordered" style="display:<?php echo $display; ?>; border:1px solid #000; margin-top:20px;">
			<tr class="bg-primary">
				<td class="text-center" colspan="2"><span style="font-size:22px;">Video gallery</span></td>
			</tr>
			<tr>
				<td>Serial No.</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
						<input type="text" name="sl_num" <?php if(!isset($_GET["edit"])){?> value="<?php echo $inc;?>" <?php } else {?> value="<?php echo $fetch_p[1];?>" <?php } ?>class="form-control"  placeholder="Serial No."  />
						<input type="hidden" name="id"  value="<?php echo $fetch_p[0]; ?>" /><input type="hidden" name="ext" <?php if(isset($_GET['edit'])) { ?> value="<?php echo $fetch_p[4]; ?>" <?php }?>  />
					</div>
				</td>
			</tr>
			<tr>
				<td>Title</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 " >
						<input type="text"  name="title" class="form-control"  placeholder="Title"  <?php if(!isset($_GET["edit"])){?> value="" <?php } else {?> value="<?php echo $fetch_p[2];?>" <?php } ?>  />
					</div>
				</td>
			</tr>
			<tr>
				<td>Video details </td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
						<textarea class="form-control" id="redactor" name="details" rows="3" placeholder="Video details"><?php if(isset($_GET["edit"])){ echo $fetch_p[3]; } else { echo "";}?> </textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td>Video Front Photo</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
						<input type="file" name="file" />
						<?php if(isset($_GET['edit']) or isset($_GET['delete'])) { ?>
							<a href="../other_img/<?php echo $fetch_p[0]; ?>.<?php echo $fetch_p[4]; ?>" target="_blank"><img src="../other_img/<?php echo $fetch_p[0]; ?>.<?php echo $fetch_p[4]; ?>" height="60" width="100"  class="img-responsive" /></a>
						<?php } ?>
					</div>
				</td>
			</tr>
			<tr>
				<td>Video URL</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
						<input type="text"  name="url" class="form-control" placeholder="Video URL" 
						<?php if(isset($_GET["edit"])){?> value="<?php echo $fetch_p[5]?>" <?php } else {?>
						value="" <?php } ?>
						 />
					</div>
				</td>
			</tr>
			<tr>
				<td>Upload Date</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" >
						<input  type="text" id="example1" name="date" class="form-control" placeholder="dd-mm-yy" <?php if(isset($_GET["edit"])){?> value="<?php echo $fetch_p[6]?>" <?php } else {?>
						value="" <?php } ?>/>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
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
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				
				<?php if(!isset($_GET["edit"])){?>
					<input type="submit" name="add" value="Add" class="btn btn-primary" />
					<?php } else {?>
					<input type="submit" name="update" value="Edit" class="btn btn-primary" />
				
					<?php } ?>
						<input type="submit" name="view" value="View" class="btn btn-primary" />
					<input type="submit" name="exit" value="Exit" class="btn btn-primary" />
					
				</td>
			</tr>
		</table>
		<?php if(isset($table)) {echo $table;} ?>
	</div>
</form>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
