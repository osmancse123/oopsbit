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
$fetch_query[0]=$db->withoutPrefix('holiday_list','ID',"10".$prefix,'12');

    if(isset($_POST["add"]))
    {   
       
        $title=$db->escape($_POST["title"]);
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($title)  or !empty($detaile)) {
                if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","","txt");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                @$inserquery="INSERT INTO `holiday_list`(`ID`,`Title`,`Description`,`Extension`) VALUES('".$fetch_query[0]."','$title','$detaile','$file_ext')";
                  
                     @move_uploaded_file($file_tmp,"../other_img/".$fetch_query[0].'.'.$file_ext);
            }  
                }   
                else{
                                    @$inserquery="INSERT INTO `holiday_list`(`ID`,`Title`,`Description`,`Extension`) VALUES('".$fetch_query[0]."','$title','$detaile','$file_ext')";
                   
                }  
                  @$chek_insert=$db->insert_query($inserquery);
                    //print_r($inserquery);
$fetch_query[0]=$db->withoutPrefix('holiday_list','ID',"10".$prefix,'12');

        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 
      
if(isset($_POST["view"]))
{
    $query="select * from holiday_list ORDER BY `ID` DESC";
        $result=$db->select_query($query);
        $table="<div class='col-md-12' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr>"."<td align='left'>"."<a href='Listof_holiday.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."</td>".
        "<td colspan='4' align='center'>"."<span class='text-success' style='font-size:18px; font-weight:blod;'>List Of Holiday</span>"."</td>"."</tr>";
        if($result){
            $table.="<tr>"."<td>Title</td>"."<td> Details<ts>"."<td> File</td>"."<td>Edit Or Delete</td>"."</tr>";
            $count=mysqli_num_fields($result);
            //print_r($count);
                while($fetch_All=$result->fetch_array())
                {
                    
                   $table.="<tr>";
                    for ($i=1; $i < $count-2; $i++) { 
                        $table.="<td>".$fetch_All[$i]."</td>";
                    }
                    
                  
                         $table.="<td>".$fetch_All[2]."</td>";
						 if($fetch_All[3] != ""){
                        $table.="<td>".'<a href="../other_img/'.$fetch_All[0].'.'.$fetch_All[3].'" class="btn btn-primary" target="_blank">Download</a>'."</td>";}
						else {
						 $table.="<td>No Lavel</td>";
						}
                   
                       
                        //print "asdf";
                  
                        $table.="<td>";
                         $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?edit=$fetch_All[0]' class='btn btn-danger' onclick='return //confirm_delete()'>Edit</a>";
                        $table.="<a style='width:80px; margin-left:5px; margin-top:2px;' href='?dlt=$fetch_All[0]&ext=$fetch_All[3]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                        $table.="</td>";
                 $table.="</tr>";
                   

                }
        }

        $table.="</table>"."</div>";
}

if(isset($_GET["dlt"]))
{
    $Delete="DELETE FROM `holiday_list` WHERE `ID`='".$_GET["dlt"]."'";
    $db->delete_query($Delete);
    print "<script>location='Listof_holiday.php'</script>";
    $fetch_query[0]=$db->withoutPrefix('holiday_list','ID',"10".$prefix,'12');
    @unlink("../other_img/".$_GET['dlt'].".".$_GET['ext']."");


}

if(isset($_GET["edit"]))
{
        $select_query="SELECT * FROM holiday_list WHERE `ID`='".$_GET["edit"]."'";
        $chek_query=$db->select_query($select_query);
        if($chek_query){
            $fetch_query=$chek_query->fetch_array();
        }
}
     if(isset($_POST["Update"]))
    {   
        
        $title=$db->escape($_POST["title"]);
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($title)  or !empty($detaile)) {
                if(isset($_FILES["file"])){

        @$file_name = $_FILES['file']['name'];
        @$file_size =$_FILES['file']['size'];
        @$file_tmp =$_FILES['file']['tmp_name'];
        @$file_type=$_FILES['file']['type'];   
        @$file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
        $expensions= array("jpeg","jpg","png","pdf","","txt");         
                
                if(in_array($file_ext,$expensions) === false){
                    $msg="extension not allowed, please choose another file.";
                } 
                else  if($file_size > 2097152){
                 $msg='File size must be excately 2 MB';
                }  
                else{
                @$inserquery="REPLACE INTO `holiday_list`(`ID`,`Title`,`Description`,`Extension`) VALUES('".$_POST["id"]."','$title','$detaile','$file_ext')";
                  
                     @move_uploaded_file($file_tmp,"../other_img/".$_POST["id"].'.'.$file_ext);
            }  
                }   
                else{
                                    @$inserquery="REPLACE INTO `holiday_list`(`ID`,`Title`,`Description`,`Extension`) VALUES('".$_POST["id"]."','$title','$detaile','$file_ext')";
                  
                   
                }  
                  @$chek_insert=$db->update_query($inserquery);
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
	
	 $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );
	
	 function checkforText()
    {
        if (document.getElementById("forText").checked == true)
        {
            //alert("aa");
            document.notice.descreption.disabled=false;
            document.notice.file.disabled=true;
    

        }
        else
        {
            //alert("bb");
            document.notice.descreption.disabled=true;
            document.notice.file.disabled=true;
    

        }
    }   
    
    function checkforboth()
    {
        if (document.getElementById("both").checked == true )
        {
        //alert("aa");
            document.notice.descreption.disabled=false;
            document.notice.file.disabled=false;
        }
    }

    function checkforFile()
    {
        if (document.getElementById("forFile").checked)
        {
        //alert("aa");
            document.notice.file.disabled=false;
            document.notice.descreption.disabled=true;  

        }
        else
        {
            //alert("bb");
            document.notice.file.disabled=true;
            document.notice.descreption.disabled=true;
            //document.routine.notice_details.disabled=true;

        }
    }


      </script>
    </head>
    <body>
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
    <?php if(isset($_POST["view"]))
    {
        if(!$result)
        {
            echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Records   Found"."<a href='Listof_holiday.php'>"."Go Back"."</a>"."<strong>"."</span>";
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
Holiday List</span> </td>
            </tr>
        
      <tr class="info">
        <td align="right">Title &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
          <input type="hidden" name="id" value="<?php echo @$fetch_query[0];?>"></input>
          <input type="text" name="title" <?php if($chek_query){?> value="<?php echo $fetch_query[1];?>" <?php } else {?> value="" <?php }?> class="form-control" placeholder="Title" />
          </div>
          </td>
      </tr>
      
	  <tr class="info">
        <td align="right">Select One &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12">
            <input type="radio" name="details" id="forText" onClick="checkforText();" >
 Text 
           &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
           <input type="radio" name="details" id="forFile" onClick="checkforFile();">
File 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
           <input type="radio" name="details" id="both" onClick="checkforboth();">
Both 
          </div>
          </td>
      </tr>
    <tr class="info">
        <td align="right">  
Details &nbsp;</td>
        <td>:</td>
         <td>
            <div class="col-sm-12 col-md-12">
            <textarea  name="descreption" class="form-control" disabled="disabled"  id="redactor"><?php if($chek_query){echo $fetch_query[2]; }?> </textarea>
            </div>
            </td>

    </tr>
    <tr class="info">
            <td align="right" width="180">  Upload File &nbsp; </td>
            <td>:</td>
            <td><input type="file" name="file" disabled="disabled" accept="image/*" />
            
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

    

