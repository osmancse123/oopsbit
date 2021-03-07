<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();
    global $msg;
	$prefix=date("y"."m"."d");
    $fetch_query[0]=$db->withoutPrefix('literature_culture_education','id',"26".$prefix,'12');
	
	
   
   global $result;
   global $chek_query;



       if(isset($_POST["add"]))
    {   
        $date=$db->escape($_POST["date"]);
        $type=$db->escape($_POST["type"]);
        $detaile=$db->escape(isset($_POST["Contact_Textarea"])?$_POST["Contact_Textarea"]:"");
        if(!empty($type)  or !empty($detaile)) {
                if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                @$inserquery="INSERT INTO `literature_culture_education`(`id`,`date`,`type`,`details`) VALUES('".$fetch_query[0]."','$date','$type','$detaile')";
                  
                     @move_uploaded_file($file_tmp,"../other_img/".$fetch_query[0].'.jpg');
            }  
                }   
                else{
                    //print "asfd";
                                    @$inserquery="INSERT INTO `literature_culture_education`(`id`,`date`,`type`,`details`) VALUES('".$fetch_query[0]."','$date','$type','$detaile')";
                   
                }  
                  @$chek_insert=$db->insert_query($inserquery);
                    //print_r($inserquery);
                     $fetch_query[0]=$db->withoutPrefix('literature_culture_education','id',"26".$prefix,'12');     
        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 

  if(isset($_POST["View"]))
{
    
    $query="select * from literature_culture_education ORDER BY `date` DESC";
        $result=$db->select_query($query);

        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='literature_culture_education.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='6' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>Literature, culture and education services</span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Date</td>"."<td>Title</td>"."<td>Details Or File</td>"."<td>Edit Or Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
                while($fetch_All=$result->fetch_array())
                {
                   $table.="<tr>";
                    for ($i=1; $i <$count-1; $i++) { 
                        $table.="<td>".$fetch_All[$i]."</td>";
                    }
                    
                    if($fetch_All[3]=="")

                    {$table.="<td>".'<a href="../other_img/'.$fetch_All[0].'.jpg" class="btn btn-primary" target="_blank">Download</a>'."</td>";}
                    else
                    {
                        $table.="<td>".$fetch_All[3]."</td>";
                    }
                        $table.="<td>";
                         $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }
      }

      if(isset($_GET["dlt"]))
{
    $Delete="DELETE FROM `literature_culture_education` WHERE `id`='".$_GET["dlt"]."'";
    $db->delete_query($Delete);
    print "<script>location='literature_culture_education.php'</script>";
  $fetch_query[0]=$db->withoutPrefix('literature_culture_education','id',"26".$prefix,'12');
       @unlink("../other_img/".$_GET['dlt'].".jpg");


}

if(isset($_GET["edit"]))
{
        $select_query="SELECT * FROM `literature_culture_education` WHERE `id`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
}

   
    if(isset($_POST["Update"]))
    {   
        $date=$db->escape($_POST["date"]);
        $type=$db->escape($_POST["type"]);
        $detaile=$db->escape(isset($_POST["Contact_Textarea"])?$_POST["Contact_Textarea"]:"");
        if(!empty($type)  or !empty($detaile)) {
                if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                @$inserquery="Replace INTO  `literature_culture_education`(`id`,`date`,`type`,`details`) VALUES('".$_POST["id"]."','$date','$type','$detaile')";
                  
                     @move_uploaded_file($file_tmp,"../other_img/".$_POST["id"].'.jpg');
            }  
                }   
                else{
                    //print "asfd";
                                    @$inserquery="Replace INTO  `literature_culture_education`(`id`,`date`,`type`,`details`) VALUES('".$_POST["id"]."','$date','$type','$detaile')";
                   
                }  
                  @$chek_insert=$db->update_query($inserquery);
                   $select_query="SELECT * FROM `literature_culture_education` WHERE `id`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }

                    //print_r($inserquery);
                     //$fetch_query[0]=$db->autogenerat('national_event','Event_id','N_EVT-','10');     
        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
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

<link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
<link rel="stylesheet" href="textEdit/redactor/redactor.css" />
<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
<script src="textEdit/redactor/redactor.min.js"></script>
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

    <script src="datespicker/bootstrap-datepicker.js"></script>

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
      $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd/mm/yyyy"
                    });  
                
                });
	</script>
</head>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <?php 
  if(isset($_POST["View"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='literature_culture_education.php'>"."Go Back"."</a>"."<strong>"."</span>";
        }
        else
        {
        echo $table;
        }
    }
    else
    {?>
  <div class="col-sm-10 col-md-10 col-sm-offset-1">
  	<table align="center" class="table table-responsive " style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
Literature, culture and education</span> </td>
  			</tr>
      <tr class="info">
        <td align="right">Date &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="text" name="date" id="example1" <?php if($chek_query){ ?> value="<?php echo $fetch_query[1];?>" <?php } else {?> value="" <?php } ?> class="form-control" placeholder="date" />
          <input type="hidden" name="id" value="<?php echo $fetch_query[0] ;?>"></input>
          </div>
          </td>
      </tr>
      <tr class="info">
        <td align="right">Select Type&nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
                <select name="type" class="form-control">
                <?php 
                  if($chek_query){
                ?>
                <option><?php echo $fetch_query[2];?></option>
                <?php }?>
                    <option disabled="disabled">Select One</option>
                    <option>Literary practices</option>
                    <option>Cultural practices</option>
                    <option>Study tour</option>
                </select>
          </div>
          </td>
      </tr>
    <tr class="info">
        <td align="right">Details &nbsp;</td>
        <td>:</td>
         <td>
      		<div class="col-sm-12 col-md-12">
      		<textarea name="Contact_Textarea" class="form-control"  id="redactor"><?php if($chek_query) {echo $fetch_query[3];} else { echo "";}?></textarea>
      		</div>
      		</td>

    </tr>
    <tr class="info">
            <td align="right" width="180">Picture &nbsp; </td>
            <td>:</td>
            <td><input type="file" name="file" accept="image/*" />
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
  				<td bgcolor="#f4f4f4" class="warning" colspan="3"align="center" >
          <?php if(!$chek_query){?>
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

	