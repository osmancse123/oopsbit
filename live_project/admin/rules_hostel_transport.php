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
    global $chek_query;
	$prefix=date("y"."m"."d");
$fetch_query[0]=$db->withoutPrefix('rules_hostel_transport','id',"12".$prefix,'12');

    if(isset($_POST["add"]))
    {  
         $title=$db->escape($_POST["title"]);
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if($title!="নির্বাচন করুন"  && !empty($detaile)) {
              $insert_qury="INSERT INTO `rules_hostel_transport` (`id`,`type`,`description`) VALUES('".$fetch_query[0]."','$title','$detaile')";
              $cheek_query=$db->insert_query($insert_qury);
              $fetch_query[0]=$db->withoutPrefix('rules_hostel_transport','id',"12".$prefix,'12');

        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 
      
if(isset($_POST["view"]))
{
    $query="select * from rules_hostel_transport ORDER BY `ID` DESC";
        $result=$db->select_query($query);
        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='rules_hostel_transport.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='4' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>Regulations, accommodation and transportation information services</span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Title</td>"."<td> Details<ts>"."<td>Edit Or Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
            //print_r($count);
                while($fetch_All=$result->fetch_array())
                {
                    
                   $table.="<tr>";
                    for ($i=1; $i < $count; $i++) { 
                        $table.="<td>".$fetch_All[$i]."</td>";
                    }
                    
                  
                       
                  
                        $table.="<td>";
                         $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }

        $table.="</table>"."</div>";
}

if(isset($_GET["dlt"]))
{
    $Delete="DELETE FROM `rules_hostel_transport` WHERE `id`='".$_GET["dlt"]."'";
    $db->delete_query($Delete);
    print "<script>location='rules_hostel_transport.php'</script>";
$fetch_query[0]=$db->withoutPrefix('rules_hostel_transport','id',"12".$prefix,'12');

  


}

if(isset($_GET["edit"]))
{
        $select_query="SELECT * FROM rules_hostel_transport WHERE `id`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
}
     if(isset($_POST["Update"]))
    {   
        
        $title=$db->escape($_POST["title"]);
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($title)  && !empty($detaile)) {
                 $insert_qury="Replace INTO `rules_hostel_transport` (`id`,`type`,`description`) VALUES('".$_POST["id"]."','$title','$detaile')";
              $cheek_query=$db->update_query($insert_qury);
              if($chek_query)
              {
                $select_query="SELECT * FROM rules_hostel_transport WHERE `id`='".$_POST["id"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
              }
        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
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
              $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );

      </script>
    </head>
    <body>
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
    <?php if(isset($_POST["view"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='rules_hostel_transport.php'>"."Go Back"."</a>"."<strong>"."</span>";
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
Regulations, hostel and transport information</span> </td>
            </tr>
        
      <tr class="info">
        <td align="right">Type  &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-8">
          <input type="hidden" name="id" value="<?php echo @$fetch_query[0];?>"></input>
            <select class="form-control" name="title">
            <?php
                if($chek_query)
                { ?>
                    <option><?php echo $fetch_query[1]; ?></option>
                <?php }
            ?>
                
                <option>Regulations</option>
                <option>Hostel Information </option>
                <option>Transport Information</option>
            </select>
          </div>
          </td>
      </tr>
      
    <tr class="info">
        <td align="right">  
Details &nbsp;</td>
        <td>:</td>
         <td>
            <div class="col-sm-12 col-md-12">
            <textarea  name="descreption" class="form-control"  id="redactor"><?php if($chek_query){echo $fetch_query[2]; } else { echo ""; }?> </textarea>
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
                <td bgcolor="#f4f4f4" class="warning" colspan="3"align="center" >
                <?php if(!$chek_query){ ?>
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
        <?php 
        } ?>
    </form>
    </body>
    </html>
					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

    

