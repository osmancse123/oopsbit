<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
		 require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

	$db = new database();
	$fetch[1] = '';
	$fetch[2] = '';
	@$fetch[0] = $db->autogenerat("usefull_link","id","lnk-","8");
	if(isset($_POST['add'])) {
		$id =  $db->escape($_POST['link_id']);
		$title = $db->escape($_POST['link_title']);
		$url = $db->escape($_POST['link_url']);
		if(!empty($url)) {
			$query = "INSERT INTO usefull_link VALUES('$id','$title','$url')";
			$db->insert_query($query);
		} else{
			$msg="<span class='text-center text-danger'>Please select a vild name</span>";
		}
		
	}
	if(isset($_POST['view'])) {
		$display='none';
		$table="<table class='table table-responsive table-bordered' style='margin-top:20px;'>"."<tr><td colspan='7'><input type='submit' name='view' class='btn-link' value='Refresh' /><input type='submit' name='clear' class='btn-link' value='Go back' /></td></tr>"."<tr class='bg-primary'>"."<td>Title</td>"."<td>Url</td>"."<td>Action</td>"."</tr>";
		$query = "SELECT * FROM usefull_link";
		if($result = $db->select_query($query)) {
			$num = mysqli_num_fields($result);
			while($fetch = $result->fetch_array()){
				$table.="<tr>";
				for($i=1; $i<$num; $i++) {
					$table.="<td>".$fetch[$i]."</td>";
				}
				$table.="<td>"."<a href='UsefulLink.php?delete=$fetch[0]' class='btn btn-danger'>Delete</a>"."<a href='UsefulLink.php?edit=$fetch[0]' class='btn btn-primary'>Edit</a>"."</td>";
				$table.="</tr>";
			}
		}
		$table.="</table>";
	}
	if(isset($_GET['edit']) or isset($_GET['delete'])) {
		if(isset($_GET['edit'])) {
			$edit = htmlentities($_GET['edit']);
		}else{
			$edit = '';	
		}
		if(isset($_GET['delete'])) {
			$delete = htmlentities($_GET['delete']);
		}else{
			$delete='';
		}
		$query = "SELECT * FROM usefull_link WHERE id='$edit' or id='$delete'";
		if($result = $db->select_query($query)) {
			$fetch = $result->fetch_array();
		}
	}
	if(isset($_POST['edit'])){
		$id =  $db->escape($_POST['link_id']);
		$title = $db->escape($_POST['link_title']);
		$url = $db->escape($_POST['link_url']);
		if(!empty($url)){
			$query = "REPLACE INTO usefull_link VALUES('$id','$title','$url')";
			$db->update_query($query);
		}
	}
	if(isset($_POST['delete'])) {
		$id =  $db->escape($_POST['link_id']);
		$query = "DELETE FROM usefull_link WHERE id='$id'";
		$db->delete_query($query);
			$fetch[1] = '';
		$fetch[2] = '';
		@$fetch[0] = $db->autogenerat("usefull_link","id","lnk-","8");
	}
	if(isset($_POST['clear'])) {
		header("Location:UsefulLink.php");
		$fetch[1] = '';
		$fetch[2] = '';
	}
	if(isset($_POST["exit"]))
	{
		print exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstarp-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!--javascript-->
</head>
<body>
<form method="post" action="" >
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12  col-md-offset-1">
		<table class="table table-responsive table-bordered" style="display:<?php echo $display; ?> ;border:1px solid #000000; margin-top:20px;">
			<tr class="bg-primary">
				<td class="text-center" colspan="2"><span style="font-size:22px;">Usefull links</span></td>
			</tr>
			<tr>
				<td>ID</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="link_id" value="<?php echo $fetch[0]; ?>"  class="form-control" />
					</div>
				</td>
			</tr>
			<tr>
				<td>Title</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="text" <?php if(isset($fetch)) { ?> value="<?php echo $fetch[1];  ?>" <?php  } ?> name="link_title" class="form-control" placeholder="Link title" />
					</div> 
				</td>
			</tr>
			<tr>
				<td>Url</td>
				<td>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="link_url" <?php if(isset($fetch)) { ?> value="<?php echo $fetch[2];  ?>" <?php  } ?> class="form-control" placeholder="Url" />
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
					<?php 
						if(isset($_GET['edit']) or isset($_GET['delete'])) {
						if(isset($_GET['edit'])) {
							$name='edit';
							$value='Edit';
							$css='primary';
						}else if(isset($_GET['delete'])){
							$name='delete';
							$value='Delete';
							$css='danger';
						}
					 ?>
					 	<input type="submit" name="view" value="Go Back" class="btn btn-primary" />
					 	<input type="submit" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="btn btn-<?php echo $css; ?>" />
						<input type="submit" name="clear" value="New" class="btn btn-primary" />
					 <?php 
					 	}else{
						
					  ?>
					<input type="submit" name="add" value="Add" class="btn btn-primary" />
					<input type="submit" name="view" value="View" class="btn btn-primary" />
					<input type="submit" name="clear" value="Clear" class="btn btn-primary" />
					<input type="submit" name="exit" value="Exit" class="btn btn-primary" />
					<?php } ?>
				</td>
			</tr>
		</table>
		<?php if(isset($table)) {print $table;}?>
	</div>
	</form>
    <!--Ajax javscript-->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
    <!--including all jquery plugin-->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
