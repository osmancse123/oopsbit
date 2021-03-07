<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{ 
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();
    global $msg;
   $fetch_zero[2]='';
   $fetch_zero[1]='';
   global $checked_query;
  $select="SELECT * FROM `red_crecent_info`";
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
    	$insert="INSERT INTO `red_crecent_info` VALUES('1','$title','$about_school')";
    	$db->insert_query($insert);
        $select="SELECT * FROM `red_crecent_info`";
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
      if(!empty($title) && !empty($about_school))
      {
      	$insert="REPLACE INTO `red_crecent_info` VALUES('1','$title','$about_school')";
      	$db->update_query($insert);
          $select="SELECT * FROM `red_crecent_info`";
   $checked_query=$db->select_query($select);
   if($checked_query)
    {
      $fetch_zero=$checked_query->fetch_array();
   }
       
      }
      else
      {
        $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
      }
  } 

if(isset($_POST['Delete'])){
	$Delete="DELETE FROM `red_crecent_info` WHERE `id`='1'";
	$db->delete_query($Delete);
  print "<script>location='Red_cricent.php'</script>";
  
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
<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="lib/jquery-1.9.0.min.js"></script>


	<!-- Redactor is here -->
	<link rel="stylesheet" href="redactor/redactor.css" />
	<script src="redactor/redactor.min.js"></script>
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js">
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
  <div class="col-sm-10 col-md-10 col-sm-offset-1">
  	<table align="center" class="table table-responsive " style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning" style="background:#2CA303" colspan="3" align="center"><span style="font-size:22px; color:#FFFFFF; display:block;">
Red Cricent

</span> </td>
  			</tr>
      <tr class="info">
        <td align="right">Title &nbsp; </td>
        
        <td colspan="2">
          <div class="col-sm-11 col-md-11">
          <input type="text"  name="title" <?php if($checked_query){?> value="<?php echo $fetch_zero[1];?>"<?php } else {?> value="" <?php } ?> class="form-control" placeholder="Title" />
          </div>
          </td>
      </tr>
    <tr class="info">
        <td align="right"> Details &nbsp; </td>
         <td colspan="2">
      		<div class="col-sm-11 col-md-11">
      		<textarea name="Contact_Textarea" class="form-control"  id="redactor"><?php if($checked_query){ echo $fetch_zero[2];} else { echo "";}?></textarea>
      		</div>
      		</td>

    </tr>
    
    <tr>
                <td class="danger" colspan="3" align="center"><span>
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
  				<td bgcolor="#f4f4f4" class="warning" style="background:#9494E2" colspan="3"align="center" >
          <?php 
            if(!$checked_query){
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

	