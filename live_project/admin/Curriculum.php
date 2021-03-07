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
	$fetch_query[0]=$db->withoutPrefix('cariculam','Id',"27".$prefix,'12');
		
    if(isset($_POST["add"]))
    {   
        $type=$db->escape($_POST["type"]);
        $selection=$db->escape($_POST["selection"]);
        $year=$db->escape($_POST["year"]);
        $title=$db->escape($_POST["title"]);
        
        if(!empty($title)  or !empty($type)) {
                if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","docx","doc","pdf","");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                @$inserquery="INSERT INTO `cariculam`(`Id`,`Type`,`Class`,`Year`,`Tite`,`Extension`) VALUES ('".$fetch_query[0]."','$type','$selection','$year','$title','$file_ext')";
               // print_r($inserquery);
                
                     @move_uploaded_file($file_tmp,"../other_img/".$fetch_query[0].'.'.$file_ext);
            }  
                }   
                else{
                    //print "asfd";
                                  @$inserquery="INSERT INTO `cariculam`(`Id`,`Type`,`Class`,`Year`,`Tite`,`Extension`) VALUES ('".$fetch_query[0]."','$type','$selection','$year','$title','$file_ext')";
                   
                }  
                  @$chek_insert=$db->insert_query($inserquery);
                    //print_r($inserquery);
                     $fetch_query[0]=$db->withoutPrefix('cariculam','Id',"27".$prefix,'12');  
        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 
      
if(isset($_POST["view"]))
{
    $query="select * from cariculam ORDER BY `Id` DESC";
        $result=$db->select_query($query);
        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='Curriculum.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='6' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>Curriculam's</span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Type</td>"."<td>Class</td>"."<td>Year</td>"."<td>Title</td>"."<td>File</td>"."<td>Edit Or Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
                while($fetch_All=$result->fetch_array())
                {
                   $table.="<tr>";
                    for ($i=1; $i <$count-1; $i++) { 
                        $table.="<td>".$fetch_All[$i]."</td>";
                    }
                    
                   $table.="<td>".'<a href="../other_img/'.$fetch_All[0].'.'.$fetch_All[5].'" class="btn btn-primary" target="_blank">Download</a>'."</td>";
                    
                        $table.="<td>";
                         $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]&ext=$fetch_All[5]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }

        $table.="</table>"."</div>";
}

if(isset($_GET["dlt"]))
{
    $Delete="DELETE FROM `cariculam` WHERE `Id`='".$_GET["dlt"]."'";
    $db->delete_query($Delete);
    print "<script>location='Curriculum.php'</script>";
    $fetch_query[0]=$db->withoutPrefix('cariculam','Id',"27".$prefix,'12');
    @unlink("../other_img/".$_GET['dlt'].".".$_GET['ext']."");


}

if(isset($_GET["edit"]))
{
        $select_query="SELECT * FROM `cariculam` WHERE `Id`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
}
     if(isset($_POST["Update"]))
    {   
       $type=$db->escape($_POST["type"]);
        $selection=$db->escape($_POST["selection"]);
        $year=$db->escape($_POST["year"]);
        $title=$db->escape($_POST["title"]);
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($title)  or !empty($detaile)) {
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
                @$inserquery="replace INTO `cariculam`(`Id`,`Type`,`Class`,`Year`,`Tite`,`Extension`) VALUES ('".$_POST["id"]."','$type','$selection','$year','$title','$file_ext')";
               // print_r($inserquery);
                
                     @move_uploaded_file($file_tmp,"../other_img/".$_POST["id"].'.'.$file_ext);
            }  
                }   
                else{
                    //print "asfd";
                                  @$inserquery="replace INTO `cariculam`(`Id`,`Type`,`Class`,`Year`,`Tite`,`Extension`) VALUES ('".$_POST["id"]."','$type','$selection','$year','$title','$file_ext')";
                   
                }  
                  @$chek_insert=$db->update_query($inserquery);
                   $select_query="SELECT * FROM `cariculam` WHERE `Id`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
                    //print_r($inserquery);
                     /// $fetch_query[0]=$db->autogenerat('routine','Routine_id','RTN-',10);    
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
    <?php if(isset($_POST["view"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Curriculum.php'>"."Go Back"."</a>"."<strong>"."</span>";
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
Curriculam</span> </td>
            </tr>
         <tr class="info">
        <td align="right">  Select Curriculam&nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
                    <select name="type" class="form-control">
                    <?php
                        if($chek_query){
                            ?>
                            <option><?php echo $fetch_query[1]; ?></option>
                            <?php
                        }
                    ?>
                          <option>Class Wise Curriculam</option>
                             <option>Chapter Wise Curriculam	</option>
                    </select>
          </div>
          </td>
      </tr>
      <tr class="info">
        <td align="right"> Select Class&nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
            <select name="selection" class="form-control">
                    <?php
                        if($chek_query){
                            ?>
                            <option><?php echo $fetch_query[2]; ?></option>
                            <?php
                        }
                        $select_class="SELECT * FROM `add_class`";
                        $chek_class=$db->select_query($select_class);
                        if($chek_class)
                        {
                            while($fetch_class=$chek_class->fetch_array())
                            {?>
                             <option><?php echo $fetch_class[2];?></option>                           <?php }
                        }

                 
                    ?>
                
            </select>
          </div>
          </td>
      </tr>
<tr class="info">
        <td align="right">  Select Year&nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
            <select name="year" class="form-control">
            <?php
                        if($chek_query){
                            ?>
                            <option><?php echo $fetch_query[3]; ?></option>
                            <?php
                        }
                    ?>
                    <?php

                       $y=date('Y');
                       $lesy=$y-10;
                       for($year=$y;$year>=$lesy;$year--)
                       {
                        ?>
                            <option><?php echo $year; ?></option>
                        <?php
                       }

                    ?>
            </select>
          </div>
          </td>
      </tr>

      <tr class="info">
        <td align="right">Title &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="hidden" name="id" value="<?php echo @$fetch_query[0];?>"></input>
          <input type="text" style="height: 50px;" name="title" <?php if($chek_query){?> value="<?php echo $fetch_query[4];?>" <?php } else {?> value="" <?php }?> class="form-control" placeholder="Title" />
          </div>
          </td>
      </tr>
      
  
    <tr class="info">
            <td align="right" width="180">  Upload File&nbsp; </td>
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

    

