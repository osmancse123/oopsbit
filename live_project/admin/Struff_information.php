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
    $fetch[0]='';
    $fetch[1]='';
    $fetch[2]='';
    $fetch[3]='';
    $fetch[4]='';
    $fetch[5]='';
    $fetch[6]='';
    $fetch[7]='';
    $fetch[8]='';
    $fetch[9]='';
    $fetch[10]='';
    $fetch[11]='';
    $fetch[12]='';
    $fetch[13]='';
    $fetch[14]='';
    $fetch[15]='';
	 $prefix=date("y"."m"."d");
    $fetch[0]=$db->withoutPrefix('stuff_information','stuff_id',"2".$prefix,'10');
	
    

    if(isset($_POST['add']))
    {
        if(!empty($_POST['strufid']) && !empty($_POST['strufname']) && !empty($_POST['positon']) && !empty($_POST['gender']) && !empty($_POST['parmanentaddress']))
        {
            if(isset($_FILES['file'])){
               
                $file_name = $_FILES['file']['name'];
                $file_size =$_FILES['file']['size'];
                $file_tmp =$_FILES['file']['tmp_name'];
                $file_type=$_FILES['file']['type']; 
                  
                $file_ext=@strtolower(end(explode('.',$file_name)));
                
                $expensions= array("jpeg","jpg","png",''); 
                if(in_array($file_ext,$expensions) == false){
                    $msg="<span class='text-center text-danger'>extension not allowed, please choose a JPEG or PNG file.</span>";
                }   else {    

            $inset_query="INSERT INTO `stuff_information` (`stuff_id`,`index_no`,`stuff_name`,`designation`,`date_of_birth`,`gender`,`blood_group`,`relegion`,`marital_status`,`mobile_no`,`fathers_name`,`mothers_name`,`present_address`,`parmanent_address`,`the_date_of_joining`,`educational_qualification`) VALUES('".$_POST['strufid']."','".$_POST['indexno']."','".$_POST['strufname']."','".$_POST['positon']."','".$_POST['brithdate']."','".$_POST['gender']."','".$_POST['bloodgroup']."','".$_POST['religious']."','".$_POST['meritialstatus']."','".$_POST['mobileno']."','".$_POST['fathername']."','".$_POST['MOTHERNAME']."','".$_POST['presentaddress']."','".$_POST['parmanentaddress']."','".$_POST['joindate']."','".$_POST['educationquality']."')";
            $db->insert_query($inset_query);
    $fetch[0]=$db->withoutPrefix('stuff_information','stuff_id',"2".$prefix,'10');

            $strfimg="../other_img/".$_POST['strufid'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
        }
    }
        }
        else
        {
           $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
        }
    }

    

    if(isset($_POST['View']))
    {
       print"<script>location='struff_all_view.php'</script>";
    }

    //link edit
    if(isset($_GET['edit']))
    {
            $select="SELECT * FROM `stuff_information` WHERE `stuff_id`='".$_GET['edit']."'";
            $checked_query=$db->select_query($select);
            $fetch=$checked_query->fetch_array();
    }
    
    //post update
    if(isset($_POST['Update']))
    {
        if(!empty($_POST['strufid']) && !empty($_POST['strufname']) && !empty($_POST['positon']) && !empty($_POST['gender'])  && !empty($_POST['parmanentaddress']))
        {
            if(isset($_FILES['file'])){
               
                $file_name = $_FILES['file']['name'];
                $file_size =$_FILES['file']['size'];
                $file_tmp =$_FILES['file']['tmp_name'];
                $file_type=$_FILES['file']['type']; 
                  
                $file_ext=@strtolower(end(explode('.',$file_name)));
                
                $expensions= array("jpeg","jpg","png",""); 
                if(in_array($file_ext,$expensions) == false){
                    $msg="<span class='text-center text-danger'>extension not allowed, please choose a JPEG or PNG file.</span>";
                }   else {    

            $inset_query="REPLACE INTO `stuff_information` (`stuff_id`,`index_no`,`stuff_name`,`designation`,`date_of_birth`,`gender`,`blood_group`,`relegion`,`marital_status`,`mobile_no`,`fathers_name`,`mothers_name`,`present_address`,`parmanent_address`,`the_date_of_joining`,`educational_qualification`) VALUES('".$_POST['strufid']."','".$_POST['indexno']."','".$_POST['strufname']."','".$_POST['positon']."','".$_POST['brithdate']."','".$_POST['gender']."','".$_POST['bloodgroup']."','".$_POST['religious']."','".$_POST['meritialstatus']."','".$_POST['mobileno']."','".$_POST['fathername']."','".$_POST['MOTHERNAME']."','".$_POST['presentaddress']."','".$_POST['parmanentaddress']."','".$_POST['joindate']."','".$_POST['educationquality']."')";
            $db->update_query($inset_query);
             
            $strfimg="../other_img/".$_POST['strufid'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
        }
    }
}
        else
        {
           $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
        }   
    }
    
    //link delete 
    if(isset($_GET['dlt']))
    {
            $dlt_query="DELETE from `stuff_information` WHERE `stuff_id`='".$_GET['dlt']."'";
            $db->delete_query($dlt_query);
    $fetch[0]=$db->withoutPrefix('stuff_information','stuff_id',"2".$prefix,'10');
             @unlink("../other_img/".$_GET['dlt'].".jpg");
              print"<script>location='struff_all_view.php'</script>";
    }
    
    if(isset($_POST['Exit']))
    {
        print exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Stuff Information</title>
    <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
   <script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/loading/loading.css" />
   <link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
     <script src="datespicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
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
    		$confirm_click=confirm('Are You Confirm to Delete ');
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


            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
             // When the document is ready
            $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
    </script>
  </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >

            <div class="form-group col-lg-10 col-sm-11  has-feedback">
                    <table class="table table-responsive col-sm-offset-1" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                            <tr>
                <td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Staff Information</span> </td>
            </tr>
          
                            
                       
                <tr class="success">
                    <td align="right">Serial No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-warning ">
                        <input type="hidden" name="strufid" readonly="" value="<?php echo $fetch[0];?>" />
                            <input type="text" name="indexno" class="form-control"value="<?php echo $fetch[1];?>" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>    
                
                <tr class="success">
                    <td align="right">Name</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" name="strufname" class="form-control" placeholder="Name " value="<?php echo $fetch[2];?>"/>
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="info">
                    <td align="right">  Designation</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" name="positon" class="form-control" placeholder="Designation" value="<?php echo $fetch[3];?>" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
               

                <tr class="info">
                    <td align="right">  Date of Brith</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" id="example2" name="brithdate" class="form-control" placeholder="dd-mm-yy"value="<?php echo $fetch[4];?>" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="success">
                    <td align="right"> Gendar</td>
                    <td>:</td>
                    <td >
                        <div class="col-lg-12 col-md-12 has-success ">
                     <?php if($checked_query){ ?>
                           <input type="radio" name="gender"  class="radio-inline" value="female" <?php 
                             if($fetch[5]=="female") { ?>
                             checked="checked";
                            <?php }  ?> />Female 
                            <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;" <?php 
                            if($fetch[5]=="male") { ?>
                            checked="checked";
                            <?php }
                           ?> />Male 
                           <?php } else {?>
                                <input type="radio" name="gender"  class="radio-inline" value="female"/>Female
                         <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;"/>Name 
                           <?php } ?>
                        </div>
                    </td>
                 <td class="text-warning"><span class="glyphicon glyphicon-warning-sign"></span></td>
                     
                </tr>  
                <tr class="info">
                    <td align="right"> Blood Group</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input type="text" name="bloodgroup" class="form-control" placeholder="Blood Group" value="<?php echo $fetch[6];?>" />
                            
                            
                        </div>
                    </td>
                     
                </tr>
                <tr class="success">
                    <td align="right">Religious</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                           <select class="form-control" name="religious">
                           <?php 
                            if($checked_query)
                            {
                           ?>
                            <option><?php echo $fetch[7]; ?></option>
                           <?php } ?>
                             <option value="" disabled <?php if(!isset($_GET['edit'])) { ?> selected <?php }  ?>>Select One</option>
                              <option>Islam</option>
                              <option>Hindu</option>
                              <option>Crystan </option>
                              <option>Other</option>
                           </select>
                        </div>
                    </td>
                     
                </tr> 
                <tr class="info">
                    <td align="right"> Relitionship</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                           <select class="form-control" name="meritialstatus">
                             <?php 
                            if($checked_query)
                            {
                           ?>
                            <option><?php echo $fetch[8]; ?></option>
                           <?php } ?>
                             

                             <option value="" disabled <?php if(!isset($_GET['edit'])) { ?> selected <?php }  ?>>Select One</option>
                              <option>Married</option>
                            <option>Unmarried</option>
                           </select>
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="success">
                    <td align="right"> Father Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <input type="text" name="fathername" class="form-control" placeholder="Father Name " value="<?php echo $fetch[10];?>" />
                            
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="info">
                    <td align="right"> Mother Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input type="text" name="MOTHERNAME" class="form-control" placeholder="Mother Name " value="<?php echo $fetch[11];?>" />
                            
                            
                        </div>
                    </td>
                     
                </tr> 
                 <tr class="success">
                    <td align="right"> Mobile No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" name="mobileno" class="form-control" placeholder="01840241895" value="<?php echo $fetch[9];?>" />
                            
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                
                <tr class="success">
                    <td align="right">Present Address</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <textarea class="form-control" name="presentaddress" placeholder="Present Address"><?php echo $fetch[12];?> </textarea>
                        </div>
                    </td>
                     
                </tr>
                <tr class="info">
                    <td align="right">Permanent Address</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <textarea class="form-control" name="parmanentaddress"  placeholder="Permanent Address" ><?php echo $fetch[13]?> </textarea>
                             <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                           
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right"> Frist Joining Date</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" id="example1" name="joindate" class="form-control" placeholder="dd-mm-yy" value="<?php echo $fetch[14];?>" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="info">
                    <td align="right">Education Qualification</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <textarea class="form-control" name="educationquality" placeholder="" id="redactor"> <?php echo $fetch[15];?></textarea>
                        </div>
                    </td>
                     
                </tr>  
                
                <tr class="success">
                    <td align="right">
   Picture (250*200)px</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <input type='file' name="file" accept="image/*" /><?php if($checked_query) { ?><img class="img-responsive img-thumbnail" height="200" width="130" style="margin-top: 10px" src="../other_img/<?php echo $fetch[0]?>.jpg" /> <?php } ?>
                        </div>
                    </td>
                     
                </tr>
                <tr>
                <td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
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
                <td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
				<?php if(!$checked_query){?>
                    <input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php } else {?>
                    <input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>
                    <input type="submit" formtarget="_blank" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
                   
                    <input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
                </td>
            </tr>      
             </table>

            </div>

  </form>
 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
