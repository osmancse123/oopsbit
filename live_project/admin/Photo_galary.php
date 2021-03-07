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
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('photo_gellary','photo_id',"28".$prefix,'12');
	
	
	$selesl="SELECT MAX(`serial_no`) FROM `photo_gellary`";
	$chke=$db->select_query($selesl);
	{
		$fetch_sl=$chke->fetch_array();
		$inc=$fetch_sl[0]+1;
	}
	
	if(isset($_POST["add"]))
	{
		$sl=$db->escape($_POST["sl_number"]);
		$id=$db->escape($_POST["id"]);
		$title=$db->escape($_POST["title"]);
		$details=$db->escape($_POST["details"]);
		$slide=$db->escape(isset($_POST["slide"])?$_POST["slide"]: "");
		$bottom_slide=$db->escape(isset($_POST["bottom_slide"])?$_POST["bottom_slide"]:"");
		$gallery=$db->escape(isset($_POST["gallery"])?$_POST["gallery"]:"");
		$folder=$db->escape(isset($_POST["folder"])?$_POST["folder"]:"");
		$adfolder=$db->escape(isset($_POST["adfolder"])?$_POST["adfolder"]:"");
		if(isset($_FILES["file"])){

        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];   
        $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","nef","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                
                else{
                $inserquery="INSERT INTO `photo_gellary` (`photo_id`,`serial_no`,`title`,`details`,`slide`,`bottom_slide`,`gellary`,`folder`,`adfolder`,`extension`) VALUES('".$fetch[0]."','$sl','$title','$details','$slide','$bottom_slide','$gallery','$folder','$adfolder','$file_ext')";
					$fetch[0]=$db->withoutPrefix('photo_gellary','photo_id',"28".$prefix,'12');
					$db->insert_query($inserquery);
                  move_uploaded_file($file_tmp,"../other_img/".$fetch[0].'.'.$file_ext);
            }
			}
			
	}	
	if(isset($_POST["view"]))
	{
		 $query="select * from `photo_gellary` ORDER BY `serial_no` DESC";
        $result=$db->select_query($query);
		if($result)
		{
			   $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='Photo_galary.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='6' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>Photo Galary</span>"."</td>"."</tr>";
		$table.="<tr>"."<td>Serial No</td>"."<td>Title</td>"."<td>Details</td>"."<td>Type</td>"."<td>File</td>"."<td>Edit Or Delete</td>"."</tr>";
			$count=mysqli_num_fields($result);
			while($fetch_All=$result->fetch_array())
			{
				$table.= "<tr>";
				for($i = 1;$i <= $count -7; $i++)
				{
					$table.="<td>".$fetch_All[$i]."</td>";
				}
				if($fetch_All[4] == "slide")
				{
					$table.="<td>".$fetch_All[4]."</td>";
				}
				else if($fetch_All[5] == "bottom_slide")
				{
					$table.="<td>".$fetch_All[5]."</td>";
				}
				
				else if($fetch_All[6] == "gallery")
				{
					$table.="<td>".$fetch_All[6]."</td>";
				}
				else if($fetch_All[7] == "folder")
				{
					$table.="<td>".$fetch_All[7]."</td>";
				}
				else if($fetch_All[8] == "Adminfolder")
				{
					$table.="<td>".$fetch_All[8]."</td>";
				}
				else 
				{
					$table.="<td></td>";
				}
				$table.="<td class='text-center'>";
				$table.='<a href="../other_img/'.$fetch_All[0].'.'.$fetch_All[9].'" class="btn btn-primary" target="_blank">Download</a>';
				$table.="<td>";
				$table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]&ext=$fetch_All[9]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
				$table.= "</tr>";
			}
		}
	}
		if(isset($_GET["edit"]))
		{
			$select_all="select * from `photo_gellary` WHERE `photo_id`='".$_GET["edit"]."'";
			$chek=$db->select_query($select_all);
			if($chek)
			{
				$fetch=$chek->fetch_array();
			}
		}
		
		if(isset($_GET["dlt"]))
		{
			$delete="DELETE FROM `photo_gellary` WHERE `photo_id`='".$_GET["dlt"]."'";
			$db->delete_query($delete);
			@unlink("../other_img/".$_GET["dlt"].'.'.$_GET["ext"]."");
			print "<script>location='Photo_galary.php'</script>";
		}
			if(isset($_POST["Update"]))
	{
		$sl=$db->escape($_POST["sl_number"]);
		$id=$db->escape($_POST["id"]);
		$title=$db->escape($_POST["title"]);
		$details=$db->escape($_POST["details"]);
		$slide=$db->escape(isset($_POST["slide"])?$_POST["slide"]: "");
		$bottom_slide=$db->escape(isset($_POST["bottom_slide"])?$_POST["bottom_slide"]:"");
		$gallery=$db->escape(isset($_POST["gallery"])?$_POST["gallery"]:"");
		$folder=$db->escape(isset($_POST["folder"])?$_POST["folder"]:"");
		$adfolder=$db->escape(isset($_POST["adfolder"])?$_POST["adfolder"]:"");
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
                $inserquery="REPLACE INTO `photo_gellary` (`photo_id`,`serial_no`,`title`,`details`,`slide`,`bottom_slide`,`gellary`,`folder`,`adfolder`,`extension`) VALUES('".$_POST["id"]."','$sl','$title','$details','$slide','$bottom_slide','$gallery','$folder','$adfolder','$file_ext')";
					//$fetch_query[0]=$db->withoutPrefix('photo_gellary','photo_id',"28".$prefix,'12');
					$db->update_query($inserquery);
					$select_all="select * from `photo_gellary` WHERE `photo_id`='".$_GET["edit"]."'";
			$chek=$db->select_query($select_all);
			if($chek)
			{
				$fetch=$chek->fetch_array();
			}

                  move_uploaded_file($file_tmp,"../other_img/".$_POST["id"].'.'.$file_ext);
            }
			}
			
	}	
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstarp-->
    <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
	<link rel="stylesheet" href="textEdit/redactor/redactor.css" />
	<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
	<script src="textEdit/redactor/redactor.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#redactor').redactor();
		}
	);
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
	<form method="post" action="" name="photo_gallery" enctype="multipart/form-data" >
	    <?php if(isset($_POST["view"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Recorde  Found"."<a href='Photo_galary.php'>"."Go Back"."</a>"."<strong>"."</span>";
        }
        else
        {
        echo $table;
        }
    }
    else
    {?>
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-lg-offset-1">
    	<table class="table table-responsive table-bordered" style=" display:<?php echo $display; ?> ;margin-top:20px; border:1px solid #000;">
			<tr class="bg-primary">
				<td colspan="2" class="text-center"><span style="font-size:22px">Photo gallery</span></td>
			</tr>
			<tr>
				<td>Serial No.</td>
				<td>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<input type="text"  name="sl_number" class="form-control" <?php if($chek){?> value="<?php echo $fetch[1];?>" <?php } else {?> value="<?php echo $inc;?>"  <?php } ?> />
						<input type="hidden" name="id" value="<?php echo $fetch[0];?>" />
						
					</div>
				</td>
			</tr>
			<tr>
				<td>Title</td>
				<td>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<input type="text" name="title" class="form-control" <?php if($chek){?> value="<?php echo $fetch[2];?>" <?php } else {?> value="" <?php } ?>/>
					
					</div>
				</td>
			</tr>
			<tr>
				<td>Details</td>
				<td>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<textarea  class="form-control" id="redactor" name="details" rows="3"><?php if($chek){ echo $fetch[3];} else { echo "";}?></textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td>Chose Photo(906*390)</td>
				<td>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<input type="file" name="file" />
						
					</div>
				</td>
			</tr>
			<tr>
				<td>Display</td>
				<td>
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
					<input type="checkbox" name="slide" id="slide"  value="slide" 
					<?php 
						if($chek){
							if($fetch[4]=="slide")
							{?>
							checked="checked"
							<?php }
						}
					?>/> Top slide
			 		<input type="checkbox" name="bottom_slide" id="bottom_slide" value="bottom_slide" <?php 
						if($chek){
							if($fetch[5]=="bottom_slide")
							{?>
							checked="checked"
							<?php }
						}
					?> /> Bottom slide
					<input type="checkbox" name="gallery" id="gallery" value="gallery"  <?php 
						if($chek){
							if($fetch[6]=="gallery")
							{?>
							checked="checked"
							<?php }
						}
					?>/> Gallery
			 		<input type="checkbox" name="folder" id="folder" value="folder"   <?php 
						if($chek){
							if($fetch[7]=="folder")
							{?>
							checked="checked"
							<?php }
						}
					?>/>Classes
					<input type="checkbox" name="adfolder" id="adfolder" value="Adminfolder" <?php 
						if($chek){
							if($fetch[8]=="Adminfolder")
							{?>
							checked="checked"
							<?php }
						}
					?>/>Project
				</div>
				</td>
			</tr>
			<tr>
                <td colspan="3" align="center"><span>
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
				<td colspan="2" align="center">
					<?php 
						if(!$chek)
						{
					?>
                    <input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php } else {?>
                 
                    <input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
               <?php } ?>
                    <input type="submit" value="View" name="view" class="btn btn-primary btn-sm" style="width:80px;"/>
                                 
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
