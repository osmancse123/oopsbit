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
   
   if($_GET["edit"]){
   	$select="SELECT * FROM `scout` where id='".$_GET["edit"]."'";
   	$checked_query=$db->select_query($select);
   	if($checked_query)
   	{
   		$fetch_zero=$checked_query->fetch_array();
   }
   }

    if(isset($_POST['add']))
    {
      $title=$db->escape($_POST['title']);
      $about_school=$db->escape($_POST['Contact_Textarea']);
    	if(!empty($about_school) && !empty($title))
    	{
    	$insert="INSERT INTO `scout` VALUES('','$title','$about_school')";
    	$db->insert_query($insert);$select="SELECT * FROM `scout`";
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
        $insert="REPLACE INTO `scout` VALUES('".$_POST['id']."','$title','$about_school')";
      	$db->update_query($insert);$select="SELECT * FROM `scout`";
  
    }else
    {
      $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
    }
  }

if(isset($_POST['Delete'])){
	$Delete="DELETE FROM `scout` WHERE `id`='1'";
	$db->delete_query($Delete);
  print "<script>location='scout.php'</script>";
 
}

   if(isset($_GET['dlt'])){
	$Delete="DELETE FROM `scout` WHERE `id`='".$_GET["dlt"]."'";
	$db->delete_query($Delete);
  print "<script>location='scout.php'</script>";
 
}



if(isset($_POST["View"]))
{
    $query="select * from scout";
        $result=$db->select_query($query);
        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='scout.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='6' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>View Details </span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Title</td>"."<td>Notice Details </td>"."<td>Edit Or Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
                while($fetch_All=$result->fetch_array())
                {
                   $table.="<tr>";
                  
                   $table.="<td>".$fetch_All[1]."</td>";
				      $table.="<td>".$fetch_All[2]."</td>";
                        $table.="<td>";
                         $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }

        $table.="</table>"."</div>";
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
	
	</script><link href="../css/bootstrap.min.css" rel="stylesheet">
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
<?php if(isset($_POST["View"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Notice  Found"."<a href='scout.php'>"."Go Back"."</a>"."<strong>"."</span>";
        }
        else
        {
        echo $table;
        }
    }
    else
    {?>
  <div class="col-sm-8 col-md-10 col-lg-8 col-sm-offset-1 col-lg-offset-2">
  	<table align="center" class="table table-responsive " style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning" style="background:#1a2226"  align="center"><span style="font-size:22px; color:#FFFFFF; display:block;">
Scout </span> </td>
  			</tr>
      <tr class="info">
      <td align="center">
          <div class="col-sm-12 col-md-12">
		  
		  <input type="hidden" <?php if($checked_query){  ?> value="<?php echo $fetch_zero[0];?>"  <?php  }  ?> name="id"/>
		  <select name="title" class="form-control">
		   <?php if($checked_query){  ?>
		   <option><?php echo $fetch_zero[1];?></option>
		   <?php  }  ?>
		  			<option>Scout</option>
					<option>Cub</option>
		  </select>
       
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
  				<td bgcolor="#f4f4f4" class="warning" style="background:#3c8dbc" colspan="3"align="center" >
       
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
   
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
		<input type="submit" value="View" name="View"  class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Delete" name="Delete" class="btn btn-primary btn-sm" style="width:80px;"  onclick='return confirm_delete()'/>				
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
    
  </table>
  </div>
   <?php 
        } ?>
</form>
	 
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

	