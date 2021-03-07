<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    date_default_timezone_set("Asia/Dhaka");
    $time=date("h:i:s");
	$date=date("Y-m-d");
    $prefix=date("y"."m"."d");
    global $msg;
    global $table;
    global $chek_all;
	$db = new database();
    $id=$db->withoutPrefix('admission_result','admission_result_id',"18".$prefix,'12');
	

 
 /*$select_all="select * from presedent_info";
 $chek_all=$db->select_query($select_all);
 if($chek_all)
 {
    $fetch_all=$chek_all->fetch_array();
 }*/
    if(isset($_POST["add"]))
    {   
       
        $title=$db->escape($_POST["title"]);
        $name=$db->escape($_POST["name"]);
      

         if(!empty($_POST["title"]))
        {
           if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;extension not allowed, please choose another file.</strong></span>";
                } 
                else  if($file_size > 2097152){
                 $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;File size must be excately 2 MB<strong></span>";
                }  
                else{
                    //print "asdfsadfasdf";
             @$inserquery="INSERT INTO `admission_result` (`admission_result_id`,`date`,`time`,`name`,`title`,`extension`) VALUES('$id','$date','$time','$name','$title','$file_ext')";
              @$chek_insert=$db->insert_query($inserquery);
                   // print_r($inserquery);
                @$path="../other_img/".$id.'.'.$file_ext;
                @move_uploaded_file($file_tmp,$path);
                @chmod($path, 0644);
                
    $id=$db->withoutPrefix('admission_result','admission_result_id',"18".$prefix,'12');

              }
        }
      }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 
      

if(isset($_GET["dlt"]))
{
    $Delete="DELETE FROM `admission_result` WHERE `admission_result_id`='".$_GET["dlt"]."'";
    $db->delete_query($Delete);
    print "<script>location='Addmission_result.php'</script>";
    $id=$db->withoutPrefix('admission_result','admission_result_id',"18".$prefix,'12');
    @unlink("../other_img/".$_GET['dlt'].".".$_GET['ext']."");


}

if(isset($_POST["View"]))
{
    $query="select * from admission_result ORDER BY date DESC";
        $result=$db->select_query($query);
        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='Addmission_result.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='6' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>The results of admission</span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Date</td>"."<td>Time</td>"."<td>Name</td>"."<td>Title</td>"."<td> File</td>"."<td> Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
                while($fetch_All=$result->fetch_array())
                {
                   $table.="<tr>";
                    for ($i=1; $i <$count-1; $i++) { 
                        $table.="<td>".$fetch_All[$i]."</td>";
                    }
                    

                    $table.="<td>".'<a href="../other_img/'.$fetch_All[0].'.'.$fetch_All[5].'" class="btn btn-primary" target="_blank">Download</a>'."</td>";
                   
                        $table.="<td>";
                         
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]&ext=$fetch_All[5]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }

        $table.="</table>"."</div>";
}
      
    
      if (isset($_POST["Exit"])) {
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
    $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );
    
    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update');
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
    		$confirm_click=confirm('Are You Confirm Delete');
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
    <body>
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
    <?php if(isset($_POST["View"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Addmission Result  Found"."<a href='Addmission_result.php'>"."Go Back"."</a>"."<strong>"."</span>";
        }
        else
        {
        echo $table;
        }
    }
    else
    {?>
        <div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
            <table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
                            <tr>
                <td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
 Admission Result</span> </td>
            </tr>
      
      <tr class="info">
        <td align="right">Name  &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12 has-warning">
          <input type="text" name="name" <?php if($chek_all){?> value="<?php echo $fetch_all[2];?>" <?php }  else {?> value="" <?php }?> class="form-control" placeholder="Name" />
          <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
          </div>
          </td>
      </tr>

      <tr class="info">
        <td align="right">Title &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12 has-warning">
          <input type="text" name="title" <?php if($chek_all){?>  value="<?php echo $fetch_all[2];?>" <?php } else {?> value="" <?php }?> class="form-control" placeholder="Title" />
          <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
          </div>
          </td>
      </tr>
    
     
  
       <tr class="info">
        <td align="right">File  &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="file" name="file"  />

          </div>
          </td>
      </tr>
    
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
                
                    <input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
                   
                    <input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"  />               
                    <input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
                </td>
            </tr>
            </table>
        </div>
        <?php } ?>
    
    </form>
    </body>
    </html>
    					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


