<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	global $msg;
	global $chekcquery;
	global $chek_query;
	$prefix=date("y"."m"."d");
	$fetch_singel[0]=$db->withoutPrefix('pta_information','id',"6".$prefix,'10');
	

	if(isset($_POST["add"]))
	{
		if(!empty($_POST["iddd"]) && !empty($_POST["indexno"]) && !empty($_POST["namemm"]) && !empty($_POST["positon"]) && !empty($_POST["mobileno"]))
		{
				$insert="INSERT INTO `pta_information` (`id`,`index_no`,`name`,`designation`,`address`,`mobile_no`) VALUES ('".$fetch_singel[0]."','".$_POST["indexno"]."','".$_POST["namemm"]."','".$_POST["positon"]."','".$_POST["addresss"]."','".$_POST["mobileno"]."')";
				$chek_query=$db->insert_query($insert);
				$strfimg="../other_img/".$fetch_singel[0].".jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
               	$fetch_singel[0]=$db->withoutPrefix('pta_information','id',"6".$prefix,'10');
			    @chmod($strfimg,0644);

		}
	}
	
	if(isset($_POST["View"]))
	{	
		$query="SELECT * FROM `pta_information`";
		$chekcquery=$db->select_query($query);
		if($chekcquery){

		$numrows=mysqli_num_fields($chekcquery);
		$table="<div class='col-md-12 col-lg-12'>"."<table style='margin-top:5px;' class='table table-responsive table-hover table-bordered'>";
		$table.="<tr>"."<td clospan='2'><a class='btn btn-danger btn-sm' href='PTA_Association.php'>Back</a></td>"."<td colspan='7' align='center'><span class='text-success text-center' style='font-size:18px;'><strong>view Members of the Parent Teacher Information</strong></span></td>"."</tr>";
		$table.="<tr>"."<td>	Index No </td>"."<td>Name </td>"."<td>Designation  </td>"."<td>Address </td>"."<td>Mobile No </td>"."<td>Picture </td>"."<td>Edit or Delete</td>"."</tr>";
		while ($fetch_a=$chekcquery->fetch_array()) {
			$table.="<tr>";
			for ($i=1; $i < $numrows; $i++) { 
				$table.="<td>".$fetch_a[$i]."</td>";
			}
			$table.="<td>"."<img class='img-responsive' height='120' width='100' src='../other_img/".$fetch_a[0].".jpg'/>"."</td>";
			$table.="<td>"."<a href='?edit=$fetch_a[0]' class='btn btn-primary btn-sm' style='width:120px' >Edit</a>"."<br/>"."<a href='?dlt=$fetch_a[0]' class='btn btn-danger btn-sm' style='width:120px;margin-top:2px;'>Delete</a>"."</td>";
			$table.="</tr>";
		}
		$table.="</div>"."</table>";
	}
	}
	if(isset($_GET["edit"]))
	{	
		$selct_Quer="SELECT * FROM `pta_information` WHERE `id`='".$_GET["edit"]."'";
		$chek_query=$db->select_query($selct_Quer);
		if($chek_query)
		{
			$fetch_singel=$chek_query->fetch_array();

		}

	}
	if(isset($_POST["Update"]))
	{
		if(!empty($_POST["iddd"]) && !empty($_POST["indexno"]) && !empty($_POST["namemm"]) && !empty($_POST["positon"]) && !empty($_POST["mobileno"]))
		{
				$insert="REPLACE INTO `pta_information` (`id`,`index_no`,`name`,`designation`,`address`,`mobile_no`) VALUES ('".$_POST["iddd"]."','".$_POST["indexno"]."','".$_POST["namemm"]."','".$_POST["positon"]."','".$_POST["addresss"]."','".$_POST["mobileno"]."')";
				$chek_query=$db->update_query($insert);
				$strfimg="../other_img/".$_POST["iddd"].".jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
			    @chmod($strfimg,0644);
				$selct_Quer="SELECT * FROM `pta_information` WHERE `id`='".$_POST["iddd"]."'";
		$chek_query=$db->select_query($selct_Quer);
		if($chek_query)
		{
			$fetch_singel=$chek_query->fetch_array();

		}

		}	
	}
	if(isset($_GET["dlt"]))
	{
		if(!empty($_GET["dlt"]))
		{
			$delete_qurey="DELETE FROM `pta_information` WHERE `id`='".$_GET["dlt"]."'";
			$con_delt=$db->delete_query($delete_qurey);
			@unlink("../other_img/".$_GET["dlt"].".jpg");
			$fetch_singel[0]=$db->withoutPrefix('pta_information','id',"6".$prefix,'10');

		}

	}
	if(isset($_POST["Exit"]))
	{

		print exit;
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
	<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
	
	<script src="datespicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
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
        
        $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );
   
</script>
  </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
  	<?php 
  		if(isset($_POST["View"]))
  		{
  			if ($chekcquery) {
  				echo $table;
  			}
  			else
  			{
  				print "<span class='text-danger'><strong>NO Data Have Found</strong></span>"."<strong><a href='PTA_Association.php'>Go Back</a></strong>";
  			}
  			
  		}
  		else
  		{
  	?>

            <div class="form-group col-lg-10 col-sm-11  has-feedback">
                    <table class="table table-responsive col-sm-offset-1" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                            <tr>
                <td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Members of the Parent Teacher Information</span> </td>
            </tr>
           
                 
                 
                  <tr class="info">
                    <td align="right">Index No </td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-8 col-md-8 has-info ">
                            <input type="text" <?php if ($chek_query) {?>
                            value="<?php echo $fetch_singel[1]; ?>" <?php }?> name="indexno" class="form-control" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback">
							<input type="hidden" name="iddd" readonly="" class="form-control" value="<?php echo $fetch_singel[0]; ?>" /> 
                        </div>
                    </td>
                    <td></td>
                </tr>  
                <tr class="success">
                    <td align="right"> Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-8 col-md-8 col-sm-8 has-warning ">
                            <input type="text" <?php if($chek_query) {?> value="<?php echo $fetch_singel[2]; ?>" <?php } ?> name="namemm" class="form-control" placeholder="Name.." />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="info">
                    <td align="right"> Designation </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-8 col-md-8 col-sm-8 has-warning ">
                            <input type="text" <?php if($chek_query) {?> value="<?php echo $fetch_singel[3]; ?>" <?php } ?> name="positon" class="form-control" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right">  Mobile No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-8 col-md-8 has-success ">
                            <input type="text" <?php if($chek_query) {?> value="<?php echo $fetch_singel[5]; ?>" <?php } ?> name="mobileno" class="form-control" placeholder="Mobile No" />
                             <span class="glyphicon glyphicon-warning-sign form-control-feedback">
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
              
                <tr class="success">
                    <td align="right">Address </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-8 col-md-8 col-sm-8 has-success ">
                            <textarea id="redactor" class="form-control" name="addresss" placeholder="Address "><?php if($chek_query){ echo $fetch_singel[4];} else { echo "" ;}?> </textarea>
                        </div>
                    </td>
                     
                </tr>
                <tr class="success">
                    <td align="right">
   Picture  (250*200)px</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <input type='file' name="file" accept="image/*" />
                        </div>
                    </td>
                    <td><?php if($chek_query){?> <img class="img-responsive img-thumbnail" height="200" width="130" style="margin-top: 10px" src="../other_img/<?php echo $fetch_singel[0]?>.jpg" /> <?php } ?></td>
                     
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
				<?php 
					if(!$chek_query){
				?>
                    <input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php } else {?>
                    <input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>
                    <input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
                   
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
