<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	global $msg;
    global $srcmsg;
    global $checked_query;
    $prefix=date("y"."m"."d");
    $fetch_all[0]=$db->withoutPrefix('comitte_members_information','id',"4".$prefix,'10');
    $fetch_all[1]='';
    $fetch_all[2]='';
    $fetch_all[3]='';
    $fetch_all[4]='';
    $fetch_all[5]='';
    $fetch_all[6]='';
    $fetch_all[7]='';
    $fetch_all[8]='';
    $fetch_all[9]='';
    $fetch_all[10]='';
    $fetch_all[11]='';
    $fetch_all[12]='';
    $fetch_all[13]='';
    $fetch_all[14]='';
    $fetch_all[15]='';
    $fetch_all[16]='';
    $fetch_all[17]='';
    $fetch_all[18]='';
    $fetch_all[19]='';
    $fetch_all[20]='';
    $fetch_all[21]='';
    $fetch_all[22]='';
   

    if(isset($_POST['add']))
    {
        if(!empty($_POST['teaherid'])&&!empty($_POST['teachername']))
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

               @$insert_query="INSERT INTO `comitte_members_information` (`id`,`index_no`,`name`,`designation`,`voter_id_no`,`date_of_birth`,`gender`,`blood_group`,`religion`,`matial_status`,`father_name`,`mother_name`,`present_address`,`parmanent_address`,`starting_date`,`ending_date`,`educational_qualification`,`mobile_no`) VALUES ('$fetch_all[0]','".$_POST["indexno"]."','".$_POST["teachername"]."','".$_POST["positon"]."','".$_POST["voterid"]."','".$_POST["brithdate"]."','".$_POST["gender"]."','".$_POST["bloodgroup"]."','".$_POST["religious"]."','".$_POST["meritialstatus"]."','".$_POST["fathername"]."','".$_POST["MOTHERNAME"]."','".$_POST["presentaddress"]."','".$_POST["parmanentaddress"]."','".$_POST["service_firs_joinig_date"]."','".$_POST["currentjobdate"]."','".$_POST["educationquality"]."','".$_POST["mobileno"]."')";
                $strfimg="../other_img/".$fetch_all[0].".jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
                @chmod($strfimg,0644);

             $db->insert_query($insert_query);
            
                $fetch_all[0]=$db->withoutPrefix('comitte_members_information','id',"4".$prefix,'10');
            
               
            }
            }
        
        }
        else{
            $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
        }
    }
	///data ending add

    if(isset($_POST['srcbutton']))
    {
        $srctext=$_POST['srctext'];
        if(!empty($srctext))
        {
                $src_query="SELECT * FROM `comitte_members_information`  WHERE `id`='$srctext'";
                $checked_query=$db->select_query($src_query);
                if($checked_query)
                {
                     $fetch_all=$checked_query->fetch_array();
                }
                else{
                    $srcmsg="<span class='text-danger'>No Data Found!!Try Again.</span>";
                }

        }
        else{
            $srcmsg="<span class='text-danger'>You Must Fill The Search Box.</span>";
        }
    }
    //data search eding 
    if(isset($_POST['Update']))
    {
if(!empty($_POST['teaherid'])&&!empty($_POST['teachername']))
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

               @$insert_query="Replace INTO `comitte_members_information` (`id`,`index_no`,`name`,`designation`,`voter_id_no`,`date_of_birth`,`gender`,`blood_group`,`religion`,`matial_status`,`father_name`,`mother_name`,`present_address`,`parmanent_address`,`starting_date`,`ending_date`,`educational_qualification`,`mobile_no`) VALUES ('".$_POST["teaherid"]."','".$_POST["indexno"]."','".$_POST["teachername"]."','".$_POST["positon"]."','".$_POST["voterid"]."','".$_POST["brithdate"]."','".$_POST["gender"]."','".$_POST["bloodgroup"]."','".$_POST["religious"]."','".$_POST["meritialstatus"]."','".$_POST["fathername"]."','".$_POST["MOTHERNAME"]."','".$_POST["presentaddress"]."','".$_POST["parmanentaddress"]."','".$_POST["service_firs_joinig_date"]."','".$_POST["currentjobdate"]."','".$_POST["educationquality"]."','".$_POST["mobileno"]."')";
                   $strfimg="../other_img/".$_POST["teaherid"].".jpg";
                @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
                @chmod($strfimg,0644);

             $db->update_query($insert_query);
            
            
               
            }
            }
        
        }
        else{
            $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
        }
    }
    //ending update 

    if(isset($_POST['View']))
    {
       print"<script>location='all_commitee_members_view.php'</script>";
    }
  
     //link edit
    if(isset($_GET['edit']))
    {
                 $src_query="SELECT * FROM `comitte_members_information`  WHERE `id`='".$_GET['edit']."'";
                $checked_query=$db->select_query($src_query);
                if($checked_query)
                {
                     $fetch_all=$checked_query->fetch_array();
                }
                else{
                    $srcmsg="<span class='text-danger'>No Data Found!!Try Again.</span>";
                }
    }
     //link delete 
    if(isset($_GET['dlt']))
    {
            $dlt_query="DELETE from `comitte_members_information` WHERE `id`='".$_GET['dlt']."'";
            $db->delete_query($dlt_query);
            $fetch_all[0]=$db->withoutPrefix('comitte_members_information','id',"4".$prefix,'10');
             @unlink("../other_img/".$_GET['dlt'].".jpg");
             header("location:all_commitee_members_view.php");
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
   
    <title>Members of the Executive Council Information</title>
   <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
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
             $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
              $(document).ready(function () {
                
                $('#example3').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
               $(document).ready(function () {
                
                $('#example4').datepicker({
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
                <td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Members of the Executive Council Information</span> </td>
            </tr>
                <tr class="success">
                            <td><?PHP echo "<strong>".$srcmsg."</strong>" ?></td>
                            <td></td>
                            <td style="width: 280px;">
                                <div class="col-lg-12 col-md-12 has-success">
                                    <input type="text" class="form-control" placeholder="search" name="srctext" />

                                </div>
                            </td>
                            <td>  <button type="submit" name="srcbutton" class="btn btn-primary" style="float:left"><span class="glyphicon glyphicon-search"></span></button></td></td>
                </tr>
              
                 
                  <tr class="info">
                    <td align="right">  Index No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-info ">
                            <input type="text" value="<?php echo $fetch_all[1]; ?>" name="indexno" class="form-control" />
							 <input type="hidden" name="teaherid" readonly="" class="form-control" value="<?php echo $fetch_all[0]; ?>" />
                            
                        </div>
                    </td>
                    <td></td>
                </tr>  
                <tr class="success">
                    <td align="right"> Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" value="<?php echo $fetch_all[2]; ?>" name="teachername" class="form-control" placeholder="Your Name .." />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="info">
                    <td align="right">  Designation </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" value="<?php echo $fetch_all[3]; ?>" name="positon" class="form-control" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right">Voter ID No.</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" value="<?php echo $fetch_all[4]; ?>" name="voterid" class="form-control" />
                            
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>

                <tr class="info">
                    <td align="right"> Date OF Birth </td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input id="example1"  type="text" value="<?php echo $fetch_all[5]; ?>"  name="brithdate" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="success">
                    <td align="right"> Gendar </td>
                    <td>:</td>
                    <td >
                        <div class="col-lg-12 col-md-12 has-success ">
                        
                             <?php if($checked_query){ ?>
                           <input type="radio" name="gender"  class="radio-inline" value="female" <?php 
                             if($fetch_all[6]=="female") { ?>
                             checked="checked";
                            <?php }  ?> />Female 
                            <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;" <?php 
                            if($fetch_all[6]=="male") { ?>
                            checked="checked";
                            <?php }
                           ?> />Male 
                           <?php } else {?>
                                <input type="radio" name="gender"  class="radio-inline" value="female"/>Female 
                         <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;"/>Male 
                           <?php } ?>
                        
                        </div>
                    </td>
                 <td class="text-warning"><span class="glyphicon glyphicon-warning-sign"></span></td>
                     
                </tr>  
                <tr class="info">
                    <td align="right">  Blood Group </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input name="bloodgroup" value="<?php echo $fetch_all[7]; ?>" type="text" class="form-control" id="bloodgroup" placeholder="Blood Group " />
                            
                            
                        </div>
                    </td>
                     
                </tr>
                <tr class="success">
                    <td align="right"> Religious </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success">
                           <select class="form-control" name="religious">
                           <?php 
                            if($checked_query)
                                
                                { ?>
                            <option><?php echo $fetch_all[8];?></option>
                            <?php }
                           ?>
                             <option value="" disabled  <?php if(!isset($_GET['edit'])){?> selected<?php } ?>>Select One </option>
                              <option>Islam </option>
                              <option>Hindu </option>
                              <option>Crystan  </option>
                              <option>Other </option>
                           </select>
                        </div>
                    </td>
                     
                </tr> 
                <tr class="info">
                    <td align="right"> Relationship </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                           <select class="form-control" name="meritialstatus">
                           <?php 
                            if($checked_query)
                                {?>
                            <option><?php echo $fetch_all[9]?></option>
                            <?php  }  ?>
                             <option value="" disabled <?php if(!isset($_GET['edit'])){?> selected<?php } ?>> Select One </option>
                              <option>Married </option>
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
                            <input type="text" value="<?php echo $fetch_all[10]; ?>" name="fathername" class="form-control" placeholder="Father Name "
                            
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="info">
                    <td align="right"> Mother Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input type="text" value="<?php echo $fetch_all[11]; ?>" name="MOTHERNAME" class="form-control" placeholder="Mother Name " />
                            
                            
                        </div>
                    </td>
                     
                </tr> 
                 <tr class="success">
                    <td align="right"> Mobile No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" value="<?php echo $fetch_all[17]; ?>" name="mobileno" class="form-control" placeholder="Mobile No" />
                            
                             <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
              
                <tr class="success">
                    <td align="right">Present Address </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <textarea class="form-control" name="presentaddress" placeholder="Present Address"><?php echo $fetch_all[12];?> </textarea>
                        </div>
                    </td>
                     
                </tr>
                <tr class="info">
                    <td align="right">Permanent Address</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <textarea class="form-control" name="parmanentaddress"  placeholder="Permanent Address" ><?php echo $fetch_all[13];?> </textarea>
                             <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                           
                        </div>
                    </td>
                     
                </tr>

                <tr class="success">
                    <td align="right">  Validity period</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" id="example2" value="<?php echo $fetch_all[14] ;?>" name="service_firs_joinig_date" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="info">
                    <td align="right">Deadline </td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-info ">
                            <input type="text" id="example3"  value="<?php echo $fetch_all[15] ;?>" name="currentjobdate" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>     
            
                <tr class="info">
                    <td align="right">Education Qualification</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <textarea class="form-control" name="educationquality" placeholder="Education Qualification " id="redactor"><?php echo $fetch_all[16];?> </textarea>
                        </div>
                    </td>
                     
                </tr>  
               
               
                <tr class="success">
                    <td align="right">
   Picture (250*200)px</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <input type='file' name="file" accept="image/*" />
                        </div>
                    </td>
                    <td><?php if($checked_query){?> <img class="img-responsive img-thumbnail" height="200" width="130" style="margin-top: 10px" src="../other_img/<?php echo $fetch_all[0]?>.jpg" /> <?php }?></td>
                     
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
				<?php  
						if(!$checked_query){
				?>
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
    
  
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>	        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
