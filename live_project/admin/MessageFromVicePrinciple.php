<?php	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();
    global $msg;
   $fetch_zero[1]='';
   $fetch_zero[2]='';
   $fetch_zero[3]='';
   	$select="SELECT * FROM `message_from_viceprinciple`";
   	$checked_query=$db->select_query($select);
   	if($checked_query)
   	{
   		$fetch_zero=$checked_query->fetch_array();
   }

    if(isset($_POST['add']))
    {
      $name=$db->escape($_POST['name']);
      $title=$db->escape($_POST['title']);
      $about_school=$db->escape($_POST['Contact_Textarea']);
    	if(!empty($name) && !empty($title) && !empty($about_school))
    	{

    	$insert="INSERT INTO `message_from_viceprinciple` VALUES('1','$name','$title','$about_school')";
     
    	$chek=$db->insert_query($insert);
      
      $path="../other_img/vicePrinciple.jpg";
      move_uploaded_file($_FILES['file']['tmp_name'],$path);
    
		$select="SELECT * FROM `message_from_viceprinciple`";
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
    	
      $name=$db->escape($_POST['name']);
      $title=$db->escape($_POST['title']);
      $about_school=$db->escape($_POST['Contact_Textarea']);
    	if(!empty($name) && !empty($title) && !empty($about_school))
      {
        $insert="REPLACE INTO `message_from_viceprinciple` VALUES('1','$name','$title','$about_school')";
      	$db->update_query($insert);
       $path="../other_img/vicePrinciple.jpg";
      move_uploaded_file($_FILES['file']['tmp_name'],$path);
	  $select="SELECT * FROM `message_from_viceprinciple`";
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
	$Delete="DELETE FROM `message_from_viceprinciple` WHERE `id`='1'";
	$db->delete_query($Delete);
  @unlink("../other_img/vicePrinciple.jpg");
  print "<script>location='MessageFromVicePrinciple.php'</script>";

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
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div class="col-sm-10 col-md-10 col-sm-offset-1">
  	<table align="center" class="table table-responsive " style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">Vice Principle Message  </span> </td>
  			</tr>
         <tr class="info">
        <td align="right">Title &nbsp; </td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="text" name="title" value="<?php echo $fetch_zero[2];?>" class="form-control" placeholder="Title" />
          </div>
          </td>
      </tr>
        <tr class="info">
        <td align="right"> Name &nbsp; </td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="text" name="name" value="<?php echo $fetch_zero[1];?>" class="form-control" placeholder="Name" />
          </div>
          </td>
      </tr>
     
    <tr class="info">
        <td align="right">  Message &nbsp; </td>
         <td>:</td>
         <td>
      		<div class="col-sm-12 col-md-12">
      		<textarea name="Contact_Textarea" class="form-control"  id="redactor"><?php echo $fetch_zero[3];?></textarea>
      		</div>
      		</td>

    </tr>
    <tr class="info">
            <td align="right">Picture  &nbsp; </td>
            <td>:</td>
            <td><div class="col-lg-6 col-md-6"><input type="file" class="filestyle" class="" name="file" accept="image/*"  onChange="return viewShowImage(this)"/></div><br/><br/>
            <?php if($checked_query){?> <img src="../other_img/Principle.jpg" class='img-responsive img-thumbnail' height='90' width='90' id="preview" style='margin-top: 5px; margin-left:15px;' /><?php } ?></td>
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
  				<td bgcolor="#f4f4f4" class="warning" colspan="3"align="center" >
				<?php if(!$checked_query){?>
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" /><?php } else {?>
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

	