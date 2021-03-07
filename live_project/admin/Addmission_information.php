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
    global $chek_all;
 
$select_all="select * from admission_info"; 
$chek_all=$db->select_query($select_all);
if($chek_all)
{
   $fetch_all=$chek_all->fetch_array();
}
    if(isset($_POST["add"]))
    {   
        $name=$db->escape($_POST["name"]);
        
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($_POST["name"])   && !empty($detaile))

         {
                @$inserquery="INSERT INTO `admission_info` (`id`,`name`,`title`) VALUES('1','$name','$detaile')";
                   
                  
                  @$chek_insert=$db->insert_query($inserquery);
                    //print_r($inserquery);
        }
        else
        {
            $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
        }
      } 
      

if(isset($_POST["Delete"]))
{
    $Delete="DELETE FROM `admission_info` WHERE `id`='1'";
    $db->delete_query($Delete);
    print "<script>location='Addmission_information.php'</script>";
    


}

     if(isset($_POST["Update"]))
    {   
         $name=$db->escape($_POST["name"]);
        
        $detaile=$db->escape(isset($_POST["descreption"])?$_POST["descreption"]:"");
        if(!empty($_POST["name"])   && !empty($detaile))

         {
               @$inserquery="replace INTO `admission_info` (`id`,`name`,`title`) VALUES('1','$name','$detaile')";
              @$chek_insert=$db->update_query($inserquery);

 $select_all="select * from admission_info";
 $chek_all=$db->select_query($select_all);
 if($chek_all)
 {
    $fetch_all=$chek_all->fetch_array();
 }
                    //print_r($inserquery);
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
   
        <div class="has-feedback col-xs-12 col-sm-10 col-lg-10 col-md-10 col-sm-offset-1 col-md-offset-1">
            <table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
                            <tr>
                <td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
Admission Information</span> 

</td>
            </tr>
      
      <tr class="info">
        <td align="right">Name &nbsp;</td>
        <td>:</td>
        <td>
          <div class="col-sm-12 col-md-12 has-warning">
          <input type="text" name="name" <?php if($chek_all){?> value="<?php echo $fetch_all[1];?>" <?php } else {?> value="" <?php }?> class="form-control" placeholder="Name" />
            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
          </div>
          </td>
      </tr>  
      
     
    <tr class="info">
        <td align="right">  

Admission Information &nbsp;</td>
        <td>:</td>
         <td>
            <div class="col-sm-12 col-md-12">
            <textarea  name="descreption" class="form-control" id="redactor"><?php if($chek_all){echo $fetch_all[2]; } else { echo ""; }?> </textarea>
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
                <?php 
                    if(!$chek_all){?>
   
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
    </body>
    </html>
					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

    

