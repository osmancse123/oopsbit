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
    $fetch_all[0]=$db->withoutPrefix('teachers_information','teachers_id',$prefix,'10');
	
	
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
          if(!empty($_POST['teaherid'])&&!empty($_POST['custom_indexno'])&&!empty($_POST['teachername']) && !empty($_POST["type"]))
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
				
				if($_POST["type"] == 'Stuff')
				{
					if($_POST["email"] != ''){
						$email = $_POST['email'];
					}else {
						$email = $_POST['custom_indexno'].mt_rand(100000,999999).'@gmail.com';
					}
				}else {
					$email = $_POST['email'];
				}
				if($_POST["type"] == 'Stuff')
				{
						 $insert_query="INSERT INTO `teachers_information` (
               `teachers_id`,`index_no`,`teachers_name`,`designation`,`date_of_birth`,`gender`,
                `blood_group`,`relegion`,`marital_status`,`fathers_name`,`mothers_name`,`mobile_no`,
                `email`,`present_address`,`parmanent_address`,`service_firs_joinig_date`,`the_date_of_joining`,`mpo_date`,`educational_qualification`,`additional_qualifications`,`hobby`,`custom_index`,`votar_id_no`,Department,`Type`)
                VALUES('".$_POST['teaherid']."','".$_POST['custom_indexno']."','".$_POST['teachername']."','".$_POST['positon']."','".$_POST['brithdate']."','".$_POST['gender']."','".$_POST['bloodgroup']."','".$_POST['religious']."','".$_POST['meritialstatus']."','".$_POST['fathername']."','".$_POST['MOTHERNAME']."','".$_POST['mobileno']."','$email','".$_POST['presentaddress']."','".$_POST['parmanentaddress']."','".$_POST['service_firs_joinig_date']."','".$_POST['currentjobdate']."','".$_POST['mpdate']."','".$_POST['educationquality']."','".$_POST['extraquality']."','".$_POST['hobby']."','".$_POST['indexno']."','".$_POST['voterid']."','".$_POST["Department"]."','".$_POST["type"]."')";
				
				}else {
					if(!empty($_POST['email'])){
						 $insert_query="INSERT INTO `teachers_information` (
               `teachers_id`,`index_no`,`teachers_name`,`designation`,`date_of_birth`,`gender`,
                `blood_group`,`relegion`,`marital_status`,`fathers_name`,`mothers_name`,`mobile_no`,
                `email`,`present_address`,`parmanent_address`,`service_firs_joinig_date`,`the_date_of_joining`,`mpo_date`,`educational_qualification`,`additional_qualifications`,`hobby`,`custom_index`,`votar_id_no`,Department,`Type`)
                VALUES('".$_POST['teaherid']."','".$_POST['custom_indexno']."','".$_POST['teachername']."','".$_POST['positon']."','".$_POST['brithdate']."','".$_POST['gender']."','".$_POST['bloodgroup']."','".$_POST['religious']."','".$_POST['meritialstatus']."','".$_POST['fathername']."','".$_POST['MOTHERNAME']."','".$_POST['mobileno']."','$email','".$_POST['presentaddress']."','".$_POST['parmanentaddress']."','".$_POST['service_firs_joinig_date']."','".$_POST['currentjobdate']."','".$_POST['mpdate']."','".$_POST['educationquality']."','".$_POST['extraquality']."','".$_POST['hobby']."','".$_POST['indexno']."','".$_POST['voterid']."','".$_POST["Department"]."','".$_POST["type"]."')";
					
					}else {
					
						 $msg="<span class='text-center text-danger'>Please Fill Up Email </span>";
					}
				}
               
                $db->insert_query($insert_query);
               if($_POST["type"] == 'Stuff'){
            $strfimg="../other_img/".$_POST['teaherid'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
			}else {
			$strfimg="../other_img/".$_POST['email'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
			}
                 $fetch_all[0]=$db->withoutPrefix('teachers_information','teachers_id',$prefix,'10');
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
                $src_query="SELECT * FROM `teachers_information`  WHERE `teachers_id`='$srctext'";
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
           if(!empty($_POST['teaherid'])&&!empty($_POST['custom_indexno'])&&!empty($_POST['teachername']))
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

           $insert_query="REPLACE INTO `teachers_information` (
           `teachers_id`,`index_no`,`teachers_name`,`designation`,`date_of_birth`,`gender`,
            `blood_group`,`relegion`,`marital_status`,`fathers_name`,`mothers_name`,`mobile_no`,
            `email`,`present_address`,`parmanent_address`,`service_firs_joinig_date`,`the_date_of_joining`,`mpo_date`,`educational_qualification`,`additional_qualifications`,`hobby`,`custom_index`,`votar_id_no` ,Department,`Type`)
            VALUES('".$_POST['teaherid']."','".$_POST['custom_indexno']."','".$_POST['teachername']."','".$_POST['positon']."','".$_POST['brithdate']."','".$_POST['gender']."','".$_POST['bloodgroup']."','".$_POST['religious']."','".$_POST['meritialstatus']."','".$_POST['fathername']."','".$_POST['MOTHERNAME']."','".$_POST['mobileno']."','".$_POST['email']."','".$_POST['presentaddress']."','".$_POST['parmanentaddress']."','".$_POST['service_firs_joinig_date']."','".$_POST['currentjobdate']."','".$_POST['mpdate']."','".$_POST['educationquality']."','".$_POST['extraquality']."','".$_POST['hobby']."','".$_POST['indexno']."','".$_POST['voterid']."','".$_POST["Department"]."','".$_POST["type"]."')";
            $db->update_query($insert_query);
			if($_POST["type"] == 'Stuff'){
            $strfimg="../other_img/".$_POST['teaherid'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
			}else {
			$strfimg="../other_img/".$_POST['email'].".jpg";
            @move_uploaded_file($_FILES["file"]["tmp_name"], $strfimg);
            @chmod($strfimg,0644);
			}
        
        }
    }
}
        else{
            $msg=$msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
        }
    }
    //ending update 

    if(isset($_POST['View']))
    {
       print"<script>location='teacher_all_view.php'</script>";
    }
  
     //link edit
    if(isset($_GET['edit']))
    {
                 $src_query="SELECT * FROM `teachers_information`  WHERE `teachers_id`='".$_GET['edit']."'";
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
  /*  if(isset($_GET['dlt']))
    {
            $dlt_query="DELETE from `teachers_information` WHERE `email`='".$_GET['dlt']."'";
            $db->delete_query($dlt_query);
            $fetch_all[0]=$db->autogenerat('teachers_information','teachers_id','THR-','13');
             @unlink("../other_img/".$_GET['dlt'].".jpg");
              print"<script>location='teacher_all_view.php'</script>";
    }
    */
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
   
    <title>Teachers Information</title>
   <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/loading/loading.css" />
    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
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
        $(document).ready(
        function()
        {
            $('#extraqulity').redactor();
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
			
			function ShowTeacherAndStruff(){
			
						var show = "asdfsadf";
								$.ajax({
				
								url:"ShowTeacherAndStruff.php",
								type:"POST",
								data:{show:show},
								cache:false,
								success:function(data){
									//alert(data);
									$('#hideDate').hide();
									$('#viewData').hide();
									$('#showData').show();
									$("#showData").delay("slow").fadeIn().html(data);
								
									
								}
							});
			}
			
			function Back(){
									$('#hideDate').show();
									$('#viewData').hide();
									$('#showData').hide();
			
			
			
			}
			
			function Go(){
			
				var goes = "asdfsadf";
				var type = $('#className').val();
				if(type != 'Select One'){
								$.ajax({
				
								url:"ShowTeacherAndStruff.php",
								type:"POST",
								data:{goes:goes,type:type},
								cache:false,
								success:function(data){
									//alert(data);
									$('#hideDate').hide();
									
									$('#showData').hide();
									$('#viewData').show().html(data);
									
								
									
								}
							});
							}else {
								alert('Fill Up this Text');
							}
			
			
			
			}
			
			function Back2(){
									$('#hideDate').hide();
									$('#showData').show();
									$('#viewData').hide();
			
			}
			
			function delete2(getID){
		
					$.ajax({
					
									url:"ShowTeacherAndStruff.php",
									type:"POST",
									data:{getID:getID},
									cache:false,
									success:function(data){
										//alert(data);
										
										 Go();
									
										
									}
								});
										
				}
				
				function AddEx(getShowAdd){
								//alert(getShowAdd);
							$.ajax({
					
									url:"ShowTeacherAndStruff.php",
									type:"POST",
									data:{getShowAdd:getShowAdd},
									cache:false,
									success:function(data){
										//alert(data);
										
										 Go();
									
										
									}
								});
				}
	</script>
	  </head>
<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			.not{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPrint{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
  <body>

  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >

            <div class="form-group col-lg-10 col-sm-11  has-feedback" id="hideDate">
                    <table class="table table-responsive col-sm-offset-1" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                            <tr>
                <td bgcolor="#f4f4f4"  class="warning"  colspan="4" bgcolor="#dddddd" align="center"> <span style="font-size:22px; color:#333; display:block;">Teacher And Stuff Information</span> </td>
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
                
                           
                           
                <tr class="success">
                    <td align="right">Serial NO</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-warning ">
                         <input type="hidden" name="teaherid" readonly=""value="<?php echo $fetch_all[0]; ?>" />
                            <input name="custom_indexno" type="text" class="form-control" id="custom_indexno" value="<?php echo $fetch_all[1]; ?>" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>    
                  <tr class="info">
                    <td align="right"> Index No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-info ">
                            <input type="text" value="<?php echo $fetch_all[21]; ?>" name="indexno" class="form-control" />
                            
                        </div>
                    </td>
                    <td></td>
                </tr>  
                <tr class="success">
                    <td align="right">Name </td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" value="<?php echo $fetch_all[2]; ?>" name="teachername" class="form-control" placeholder="Name " />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="info">
                    <td align="right"> Designation</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <input type="text" value="<?php echo $fetch_all[3]; ?>" name="positon" class="form-control" placeholder="Designation" />
                            <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            
                        </div>
                    </td>
                     
                </tr> 
				
				  <tr class="info">
                    <td align="right"> Type</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                          
                         		    <?php if($checked_query){ ?>
                           <input type="radio" name="type"  class="radio-inline" value="Teacher" <?php 
                             if($fetch_all[24]=="Teacher") { ?>
                             checked="checked";
                            <?php }  ?> />Teacher 
                            <input type="radio" name="type" class="radio-inline" value="Stuff" style="margin-left:35px;" <?php 
                            if($fetch_all[24]=="Stuff") { ?>
                            checked="checked";
                            <?php }
                           ?> />Stuff 
                           <?php } else {?>
                                <input type="radio" name="type"  class="radio-inline" value="Teacher"/> Teacher
                         <input type="radio" name="type" placeholder="Your Name" class="radio-inline" value="Stuff" style="margin-left:35px;"/>Stuff 
                           <?php } ?>
						   
						   
						      
                        </div>
                    </td>
                     
                </tr> 
				
				<tr class="info">
                    <td align="right"> Department</td>
                    <td>:</td>
                    <td colspan="2">
                         <div class="col-lg-12 col-md-8 col-sm-8 has-success">
                           <select class="form-control" name="Department">
                           <?php 
                            if($checked_query)
                                
                                { ?>
                            <option><?php echo $fetch_all[23];?></option>
                            <?php }
                           ?>
                             <option value="" disabled  <?php if(!isset($_GET['edit'])){?> selected<?php } ?>>Select One</option>
                             <option>Accounting</option>
							 <option>Bangla</option>
							 <option>Botany</option>
							 <option>Chemistry</option>
							 <option>Economics</option>
							 <option>English</option>
							 <option>History</option>
							 <option>Islamic History and Culture</option>
							 <option>Management</option>
							 <option>Mathematics</option>
							 <option>Philosophy</option>
							 <option>Physics </option>
							 <option>Political Science</option>
							 <option>Social Welfare</option>
							 <option>Zoology</option>
                           </select>
              
                          
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right">Voter Id No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" value="<?php echo $fetch_all[22]; ?>" name="voterid" class="form-control" />
                            
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>

                <tr class="info">
                    <td align="right"> Date Of Birth</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input id="example1"  type="text" value="<?php echo $fetch_all[4]; ?>"  name="brithdate" class="form-control" placeholder="dd-mm-yy" />
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
                             if($fetch_all[5]=="female") { ?>
                             checked="checked";
                            <?php }  ?> />Female 
                            <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;" <?php 
                            if($fetch_all[5]=="male") { ?>
                            checked="checked";
                            <?php }
                           ?> />male 
                           <?php } else {?>
                                <input type="radio" name="gender"  class="radio-inline" value="female"/>Female 
                         <input type="radio" name="gender" placeholder="Your Name" class="radio-inline" value="male" style="margin-left:35px;"/>Male 
                           <?php } ?>
                        
                        </div>
                    </td>
                 <td class="text-warning"><span class="glyphicon glyphicon-warning-sign"></span></td>
                     
                </tr>  
                <tr class="info">
                    <td align="right">  Blood Group</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input name="bloodgroup" value="<?php echo $fetch_all[6]; ?>" type="text" class="form-control" id="bloodgroup" placeholder="Blood Group" />
                            
                            
                        </div>
                    </td>
                     
                </tr>
                <tr class="success">
                    <td align="right"> Religious</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success">
                           <select class="form-control" name="religious">
                           <?php 
                            if($checked_query)
                                
                                { ?>
                            <option><?php echo $fetch_all[7];?></option>
                            <?php }
                           ?>
                             <option value="" disabled  <?php if(!isset($_GET['edit'])){?> selected<?php } ?>>Select One</option>
                              <option>Islam</option>
                              <option>Hindu</option>
                              <option>Crystan </option>
                              <option>Other</option>
                           </select>
                        </div>
                    </td>
                     
                </tr> 
                <tr class="info">
                    <td align="right">Relationship</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                           <select class="form-control" name="meritialstatus">
                           <?php 
                            if($checked_query)
                                {?>
                            <option><?php echo $fetch_all[8]?></option>
                            <?php  }  ?>
                             <option value="" disabled <?php if(!isset($_GET['edit'])){?> selected<?php } ?>>Select One</option>
                              <option>Married</option>
                            <option>Unmarried</option>
                           </select>
                        </div>
                    </td>
                     
                </tr>  
                  <tr class="success">
                    <td align="right">Father Name</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <input type="text" value="<?php echo $fetch_all[9]; ?>" name="fathername" class="form-control" placeholder="Father Name" />
                            
                            
                        </div>
                    </td>
                     
                </tr>  
                <tr class="info">
                    <td align="right"> Mother Name</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <input type="text" value="<?php echo $fetch_all[10]; ?>" name="MOTHERNAME" class="form-control" placeholder="Mother Name " />
                            
                            
                        </div>
                    </td>
                     
                </tr> 
                 <tr class="success">
                    <td align="right">  Mobile No</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" value="<?php echo $fetch_all[11]; ?>" name="mobileno" class="form-control" placeholder="Mobile No" />
                            
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="info">
                    <td align="right"> Email</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-info ">
                            <input type="email" value="<?php echo $fetch_all[12]; ?>" name="email" class="form-control" placeholder="example@mail.com" />
                            
                            
                        </div>
                    </td>
                     <td><span class="text-danger"><strong>For Teacher Email Must be Required</strong></span></td>
                </tr>  
                <tr class="success">
                    <td align="right"> Present Address</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <textarea class="form-control" name="presentaddress" placeholder=" Present Address"><?php echo $fetch_all[13];?> </textarea>
                        </div>
                    </td>
                     
                </tr>
                <tr class="info">
                    <td align="right">Permanent Address</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-warning ">
                            <textarea class="form-control" name="parmanentaddress"  placeholder="Permanent Address" ><?php echo $fetch_all[14];?> </textarea>
                             <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                           
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right">     1st date of service</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" id="example2" value="<?php echo $fetch_all[15] ;?>" name="service_firs_joinig_date" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr> 
                <tr class="info">
                    <td align="right">      The current date of joining</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-info ">
                            <input type="text" id="example3"  value="<?php echo $fetch_all[16] ;?>" name="currentjobdate" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>     
             <tr class="success">
                    <td align="right">  MPO Date</td>
                    <td>:</td>
                    <td>
                        <div class="col-lg-12 col-md-12 has-success ">
                            <input type="text" id="example4"  value="<?php echo $fetch_all[17] ;?>" name="mpdate" class="form-control" placeholder="dd-mm-yy" />
                            </div>
                    </td>
                     <td><span class="text-danger"><strong>Type in English</strong></span></td>
                </tr>
                <tr class="info">
                    <td align="right">Education Qualification</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <textarea class="form-control" name="educationquality" placeholder="Education Qualification" id="redactor"><?php echo $fetch_all[18];?> </textarea>
                        </div>
                    </td>
                     
                </tr>  
                <tr class="success">
                    <td align="right">  Extra Qualification</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-success ">
                            <textarea class="form-control" name="extraquality" id="extraqulity" placeholder="Extra Qualification"><?php echo $fetch_all[19];?> </textarea>
                        </div>
                    </td>
                     
                </tr> 
                <tr class="info">
                    <td align="right">   Hobby</td>
                    <td>:</td>
                    <td colspan="2">
                        <div class="col-lg-12 col-md-8 col-sm-8 has-info ">
                            <textarea class="form-control" name="hobby" placeholder="Hobby"><?php echo $fetch_all[20];?></textarea>
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
                    <td><?php if($checked_query){
						if($fetch_all[24] == "Stuff"){
					?> <img class="img-responsive img-thumbnail" height="200" width="130" style="margin-top: 10px" src="../other_img/<?php echo $fetch_all[0]?>.jpg" /> <?php 
					} else {
					?>
					 <img class="img-responsive img-thumbnail" height="200" width="130" style="margin-top: 10px" src="../other_img/<?php echo $fetch_all[12]?>.jpg" /> <?php 
			
					 }
					}?></td>
                     
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
                    <input type="button" onClick="return ShowTeacherAndStruff()" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
                   
                    <input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
                </td>
            </tr>      
             </table>

            </div>
			
			
			<div id="showData"></div>
			<div id="viewData"></div>

  </form>
    
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>    	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
