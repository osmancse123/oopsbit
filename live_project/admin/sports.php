<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();
    global $msg;

   global $checked_query;
   	$select="SELECT * FROM `sports`";
   	$checked_query=$db->select_query($select);
   	if($checked_query)
   	{
   		$fetch_zero=$checked_query->fetch_array();
   }

    if(isset($_POST['add']))
    {
      $title=$db->escape($_POST['title']);
      $about_school=$db->escape($_POST['Contact_Textarea']);
    	if(!empty($about_school) && !empty($title))
    	{
    	$insert="INSERT INTO `sports` VALUES('1','$title','$about_school')";
    	$db->insert_query($insert);$select="SELECT * FROM `sports`";
    $checked_query=$db->select_query($select);
    if($checked_query)
    {
      $fetch_zero=$checked_query->fetch_array();
   }
      
    }
    else{
    	$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
    }
    }
   
  if(isset($_POST['Update']))
    {
    	
      $title=$db->escape($_POST['title']);
      $about_school=$db->escape($_POST['Contact_Textarea']);
    	if(!empty($about_school) and !empty($title))
      {
        $insert="REPLACE INTO `sports` VALUES('1','$title','$about_school')";
      	$db->update_query($insert);$select="SELECT * FROM `sports`";
    $checked_query=$db->select_query($select);
    if($checked_query)
    {
      $fetch_zero=$checked_query->fetch_array();
   }
       
    }else
    {
      $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
    }
  }

if(isset($_POST['Delete'])){
	$Delete="DELETE FROM `sports` WHERE `id`='1'";
	$db->delete_query($Delete);
  print "<script>location='sports.php'</script>";
 
}
 if(isset($_POST['Exit']))
    {
        print exit;
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div class="col-sm-8 col-md-10 col-lg-8 col-sm-offset-1 col-lg-offset-2">
  	<table align="center" class="table table-responsive " style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning"  align="center"><span style="font-size:22px; color:#333; display:block;">
Sports</span> </td>
  			</tr>
      <tr class="info">
      <td align="center">
          <div class="col-sm-12 col-md-12">
          <input type="text" name="title" <?php if($checked_query){?>value="<?php echo $fetch_zero[1];?>"<?php } else {?> value=""<?php } ?> class="form-control" placeholder="Title" />
          </div>
          </td>
      </tr>
    <tr class="info">
      <td align="center">
      		<div class="col-sm-12 col-md-12">
      		<textarea name="Contact_Textarea" class="form-control"  id="redactor"><?php if($checked_query) {echo $fetch_zero[2];} else { echo "";}?></textarea>
      		</div>
      		</td>

    </tr>

    <tr>
                <td class="danger"  align="center"><span>
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
  				<td bgcolor="#f4f4f4" class="warning" colspan="3"align="center" >
          <?php
            if(!$checked_query)
            {
          ?>
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
          <?php } else {?>
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
				<?php } ?>
					<input type="submit" value="Delete" name="Delete" class="btn btn-primary btn-sm" style="width:80px;"  onclick='return confirm_delete()'/>				
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
    
  </table>
  </div>
</form>
	 
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

	