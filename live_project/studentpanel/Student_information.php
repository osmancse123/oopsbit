<?php
	error_reporting(1);
	@session_start();
		if($_SESSION["userlogin"] === "1")
	{

     require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

    $db = new database();
    global $check_Student;
    global $msg;
	/*$prefix=date("y"."m");
    $fetch_Student[0]=$db->withoutPrefix('student_personal_info','id',$prefix,'10');*/
	
    
    if(isset($_POST['Update']))
    {
        $classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
        @$explode_Class=explode("and",$classname);
        //print_r($explode_Class);
        $class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
        @$exploide_gropu=explode("and",$class_section);
        //print_r($exploide_gropu);
        if( !empty($_POST["studentname"]) && !empty($_POST["gender"]) && !empty($_POST['id']) && !empty($_POST['fathername']) && !empty($_POST['mothersname']) && $classname!="Select One" && !empty($class_section))
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
         @$personal_insert_query="REPLACE INTO `student_personal_info` (`id`,`addmission_date`,`student_name`,`father_name`,`mother_name`,`gender`,`date_of_brith`,`religious`,`meritial_status`,`blood_group`,`nationality`,`contact_no`,`email`) VALUES('".$_POST['id']."','".$_POST['addmissiondate']."','".$_POST['studentname']."','".$_POST['fathername']."','".$_POST['mothersname']."','".$_POST['gender']."','".$_POST['dateofbrith']."','".$_POST['religious']."','".$_POST['meritelstutas']."','".$_POST['blood']."','".$_POST['Nationality']."','".$_POST['Contactno']."','".$_POST['Email']."')";
        
        $previousresult_insert_query="REPLACE INTO student_previous_result 
        (id,psc_board, psc_institute, psc_registration,  psc_Year, psc_roll, psc_group, psc_GPA, psc_passing_year,jsc_board,jsc_institute,jsc_registration,jsc_Year,jsc_roll, jsc_group, jsc_GPA, jsc_passing_year,  ssc_board, ssc_institute, ssc_registration, ssc_Year, ssc_roll, ssc_group, ssc_GPA, ssc_passing_year) values ('".$_POST['id']."','".$_POST['pscboard']."','".$_POST['pscinstitute']."','".$_POST['pscregno']."','".$_POST['pscyear']."','".$_POST['pscroll']."','".$_POST['pscgroup']."','".$_POST['pscgradepoint']."','".$_POST['pscpassingyear']."','".$_POST['jscboard']."','".$_POST['jscinstitute']."','".$_POST['jscregno']."','".$_POST['jscyear']."','".$_POST['jscroll']."','".$_POST['jscgroup']."','".$_POST['jscgradepoint']."','".$_POST['jscpassingyear']."','".$_POST['sscboard']."','".$_POST['sscinstitue']."','".$_POST['sscregno']."','".$_POST['sscyear']."','".$_POST['sscroll']."','".$_POST['sscgroup']."','".$_POST['ssgradepoint']."','".$_POST['sscpassingyear']."')";

        $studentaddress_insert_query="REPLACE INTO student_address_info (id, present_house_name, present_village, present_PO, present_post_code, present_upazila, present_distric,permanent_house_name, permanent_village, permanent_PO, permanent_post_code, permanent_upazila, permanent_distric)VALUES('".$_POST['id']."','".$_POST['prehouseno']."','".$_POST['previlll']."','".$_POST['prepo']."','".$_POST['prepostcode']."','".$_POST['preupazilla']."','".$_POST['predistric']."','".$_POST['parhose']."','".$_POST['parvill']."','".$_POST['parpo']."','".$_POST['parpostcode']."','".$_POST['parupazilla']."','".$_POST['pardistric']."')";
        
        $student_gurdient_informaiton="REPLACE INTO `student_guardian_information` (`id`,`guardian_name`,`guardian_house_name`,`guardian_village`,`guardian_po`,`guardian_postCode`,`guardian_upazila`,`guardian_distric`,`relation_with_student`,`guardian_contact`,`guardian_email`) VALUES ('".$_POST['id']."','".$_POST['GuardianName']."','".$_POST['grahouseno']."','".$_POST['gravilll']."','".$_POST['grapo']."','".$_POST['grapostcode']."','".$_POST['graupazilla']."','".$_POST['gradistrict']."','".$_POST['RelationWithStudent']."','".$_POST['GuardianContactNo']."','".$_POST['GuardianEmail']."')";

        

        @$student_academic_information="REPLACE INTO student_acadamic_information (id, admission_disir_class, admission_disir_group, regular_iregular, caues, session2, tc_orderNo, date) VALUES ('".$_POST['id']."','$explode_Class[0]','$exploide_gropu[0]','".$_POST['regularirregular']."','".$_POST['Cause']."','".$_POST['Session1']."','".$_POST['tcorderno']."','".$_POST['academicdate']."')";
       
    }
		$db->update_query($student_academic_information);
        $db->update_query($student_gurdient_informaiton);
        $db->update_query($studentaddress_insert_query);
        $db->update_query($personal_insert_query);
        $db->update_query($previousresult_insert_query);
        $strfimg="../other_img/".$_POST['id'].".jpg";
        @move_uploaded_file($_FILES["file"]["tmp_name"],$strfimg);
        @chmod($strfimg,0644);
}

    }
    else
    {
        $msg="<span class='text-center text-danger'>Please Fill Up TextField</span>";
    }
    }
	
	

	
	
   $select_student=" SELECT `student_personal_info`.`id`,`addmission_date`,`student_name`,`father_name`,`mother_name`,`gender`,`date_of_brith`,`religious`,`meritial_status`,`blood_group`,`nationality`,`contact_no`,`email`, `student_previous_result`.`psc_board`,`psc_institute`,`psc_registration`,`psc_Year`,`psc_roll`,`psc_group`,`psc_GPA`,`psc_passing_year`,`jsc_board`,`jsc_institute`,`jsc_registration`,`jsc_Year`,`jsc_roll`, `jsc_group`,`jsc_GPA`,`jsc_passing_year`,`ssc_board`,`ssc_institute`,`ssc_registration`,`ssc_Year`,`ssc_roll`,`ssc_group`,`ssc_GPA`,`ssc_passing_year`,`student_address_info`.`present_house_name`,`present_village`,`present_PO`,`present_post_code`,`present_upazila`, `present_distric`,`permanent_house_name`,`permanent_village`,
 `permanent_PO`,`permanent_post_code`,`permanent_upazila`,`permanent_distric`,`student_guardian_information`.`guardian_name`,`guardian_house_name`,`guardian_village`,`guardian_po`, `guardian_postCode`,`guardian_upazila`,`guardian_distric`,
 `relation_with_student`,`guardian_contact`,`guardian_email`,`student_acadamic_information`.`admission_disir_class`,
 `admission_disir_group`,`regular_iregular`, `caues`,`session2`,`tc_orderNo`,`date`,`add_class`.`class_name`,`add_group`.`group_name` FROM `student_personal_info` 
 JOIN `student_previous_result` ON `student_personal_info`.`id`=`student_previous_result`.`id` JOIN 
 `student_address_info` ON `student_previous_result`.`id`=`student_address_info`.`id` JOIN 
 `student_guardian_information` ON `student_address_info`.`id`=`student_guardian_information`.`id` JOIN 
 `student_acadamic_information` ON `student_guardian_information`.`id`=`student_acadamic_information`.`id` 
  INNER JOIN `add_class` ON `add_class`.`id`=`student_acadamic_information`.`admission_disir_class` INNER JOIN 
 `add_group` ON `add_group`.`id`=`student_acadamic_information`.`admission_disir_group`
 WHERE `student_personal_info`.`id`='".$_SESSION["useridid"]."'";
    $check_Student=$db->select_query($select_student);
        if($check_Student){
        $fetch_Student=$check_Student->fetch_array();
    }
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
            
    <script type="text/javascript" src="../admin/textEdit/lib/jquery-1.9.0.min.js"></script>
            
    <link rel="stylesheet" href="../admin/datespicker/datepicker.css">
     <script src="../admin/datespicker/bootstrap-datepicker.js"></script>
    
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
                
                $('#academicdate').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

         //check group name 
  $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
        }); 
  });

//function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=1 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                    $('#item_result').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    $('#category_result').html('No Group Name Found');
                    $('#item_result').html("");
                    $('#groupname').html('');
                }
        });

}  

    </script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
        <div class="has-feedback col-lg-10 col-lg-offset-1">
    <table align="center" class="table table-responsive bg-info" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
            <tr>
                <td bgcolor="#f4f4f4" class="warning"  colspan="2"  bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;"><STRONG class='text-success'>Student Information</STRONG></span> </td>
            </tr>
              <tr>
                <td bgcolor="#f4f4f4" class="success" colspan="2"  align="left"><span style="font-size:15px; color:#333; display:block;"><STRONG class='text-info'><span class="glyphicon glyphicon-share-alt"></span>PERSONAL INFORMATION</STRONG></span>

                 </td>
            </tr>
             <tr>
                <td align="right"><span class="text-info"><strong>Addmission Date&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="dd-mm-yy" id="example1" name="addmissiondate" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[1];?>'
            <?php  } ?> /></div>
                <input type="hidden" name="id" 
                value='<?php echo $fetch_Student[0];?>'
            ></input>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong>Student Name&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="Student Name" name="studentname" class="form-control"  <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[2];?>'
            <?php  } ?>  /><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong>Fathers Name&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="Fathers Name" name="fathername" class="form-control"  <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[3];?>'
            <?php  } ?>  /><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></div>
                </td>
            </tr>

            <tr>
                <td align="right"><span class="text-info"><strong>Mothers Name&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="Mothers Name" name="mothersname" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[4];?>'
            <?php  } ?>  /><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong> Gender&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="radio" name="gender"  class="radio-inline" value="Male"  <?php if (isset($check_Student)) {
                    if($fetch_Student[5]=="Male"){?>
                checked="checked"
            <?php  } } ?> />Male
                         <input type="radio" name="gender" class="radio-inline" value="Female" style="margin-left:35px; padding-left: 5px;"<?php if (isset($check_Student)) {
                    if($fetch_Student[5]=="Female"){?>
                checked="checked"
            <?php  } } ?> 
                         />Female <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span> </div>
                </td>
            </tr>
             <tr>
                <td align="right"><span class="text-info"><strong>Date Of Brith &nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="dd-mm-yy" name="dateofbrith" class="form-control" id="example2" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[6];?>'
            <?php  } ?>  /></div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong>Religious &nbsp;:</strong></span></td>
                <td><div class="col-md-6">
                <select class="form-control" name="religious">
                    <?php if (isset($check_Student)) {?>
                <option><?php echo $fetch_Student[7];?></option>
            <?php  } ?> 
                    
                        <option disabled <?php if(!isset($_GET["edit"])){?> selected <?php }?>>Select One</option>
                        <option>Islam</option>
                        <option>Hindu</option>
                        <option>Chiristian</option>
                        <option>Buddha  </option>
                        <option>Other</option>
                    </select>
                </div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong> Meritel Stutas&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="radio" name="meritelstutas"  class="radio-inline" value="married" <?php if (isset($check_Student)) {
                    if($fetch_Student[8]=="married"){?>
                checked="checked"
            <?php  } } ?>/>Married     
                         <input type="radio" name="meritelstutas" class="radio-inline" value="unmarried" style="margin-left:35px; padding-left: 5px;"
                         <?php if (isset($check_Student)) {
                    if($fetch_Student[8]=="unmarried"){?>
                checked="checked"
            <?php  } } ?>/>Unmarried </div>
                </td>
            </tr>
              <tr>
                <td align="right"><span class="text-info"><strong>Blood Group &nbsp;:</strong></span></td>
                <td><div class="col-md-6">
                    <select class="form-control" name="blood">
                       <?php if (isset($check_Student)) {?>
                <option><?php echo $fetch_Student[9];?></option>
            <?php  } ?> 
                    
                        <option disabled <?php if(!isset($_GET["edit"])){?> selected <?php }?>>Select One</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>O+</option>
                        <option>O- </option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                    </select>
                </div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong>Nationality&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="Nationality" name="Nationality" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[10];?>'
            <?php  } ?>  /></div>
                </td>
            </tr>
             <tr>
                <td align="right"><span class="text-info"><strong>Contact No&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="text" placeholder="Contact No" name="Contactno" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[11];?>'
            <?php  } ?>   /></div>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="text-info"><strong>Email&nbsp;:</strong></span></td>
                <td><div class="col-md-6"><input type="email" placeholder="Example@mail.com" name="Email" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[12];?>'
            <?php  } ?>   /></div>
                </td>
            </tr>
              
           
        
            </table>
            <table align="center" class="table table-responsive bg-info" style="border:1px #CCCCCC solid; margin-top: -20px;"> 
             <tr>
                <td bgcolor="#f4f4f4" class="success" colspan="9"  align="left"><span style="font-size:15px; color:#333; display:block;"><STRONG class='text-info'><span class="glyphicon glyphicon-share-alt"></span>PREVIOUS RESULT</STRONG></span> </td>
            </tr>
            <tr>
                <td><STRONG class='text-info'>Exam Name</STRONG></span></td>
                <td><STRONG class='text-info'>Board</STRONG></span></td>
                <td><STRONG class='text-info'>Institute</STRONG></span></td>
                <td><STRONG class='text-info'>Reg.No.</STRONG></span></td>
                <td><STRONG class='text-info'>Year</STRONG></span></td>
                <td><STRONG class='text-info'>Roll</STRONG></span></td>
                <td><STRONG class='text-info'>Group</STRONG></span></td>
                <td><STRONG class='text-info'>Grade Point</STRONG></span></td>
                <td><STRONG class='text-info'>Passing Year</STRONG></span></td>

            </tr>
            <tr>
                <td><STRONG class='text-info'>PSC/Ebtedaye</STRONG></span></td>
              
                    <td>                        
                    <input type="text" name="pscboard" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
                </td>
                <td>
                        <input type="text" name="pscinstitute" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[14];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscregno" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[15];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscyear" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[16];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscroll" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[17];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscgroup" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[18];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscgradepoint" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[19];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="pscpassingyear" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[20];?>'
            <?php  } ?>  ></input>
                    </td>
                       
             </tr>
             <tr>
                <td><STRONG class='text-info'>JSC/JDC</STRONG></span></td>
              
                    <td>                        
                    <input type="text" name="jscboard" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[21];?>'
            <?php  } ?>  ></input>
                </td>
                <td>
                        <input type="text" name="jscinstitute" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[22];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="jscregno" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[23];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="jscyear" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[24];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="jscroll" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[25];?>'
            <?php  } ?>   ></input>
                    </td>
                    <td>
                        <input type="text" name="jscgroup" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[26];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="jscgradepoint" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[27];?>'
            <?php  } ?>   ></input>
                    </td>
                    <td>
                        <input type="text" name="jscpassingyear" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[28];?>'
            <?php  } ?>  ></input>
                    </td>    
                       
             </tr>
             <tr>
                <td><STRONG class='text-info'>SSC/DAKHIL</STRONG></span></td>
              
                    <td>                        
                    <input type="text" name="sscboard" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[29];?>'
            <?php  } ?>  ></input>
                </td>
                    <td>
                        <input type="text" name="sscinstitue" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[30];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="sscregno" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[31];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="sscyear" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[32];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="sscroll" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[33];?>'
            <?php  } ?>   ></input>
                    </td>
                    <td>
                        <input type="text" name="sscgroup" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[34];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="ssgradepoint" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[35];?>'
            <?php  } ?>  ></input>
                    </td>
                    <td>
                        <input type="text" name="sscpassingyear" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[36];?>'
            <?php  } ?>  ></input>
                    </td>             
             </tr>
            </table>
            <table align="center" class="table table-responsive bg-info" style="border:1px #CCCCCC solid; margin-top: -20px;"> 
             <tr>
                <td bgcolor="#f4f4f4" class="success" colspan="7"  align="left"><span style="font-size:15px; color:#333; display:block;"><STRONG class='text-info'><span class="glyphicon glyphicon-share-alt"></span>STUDENT'S ADDRESS</STRONG></span> </td>
            </tr>
            <tr>
                <td rowspan="2"><STRONG class='text-info'>Present Address:</STRONG></span></td>
                <td>House No./Name.</td>
                <td><input type="text" name="prehouseno" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[37];?>'
            <?php  } ?>  ></input></td>
                 <td>VILL.</td>
                <td><input type="text" name="previlll" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[38];?>'
            <?php  } ?>  ></input></td>
                 <td>PO.</td>
                <td><input type="text" name="prepo" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[39];?>'
            <?php  } ?>  ></input></td>
            </tr>
            <tr>
                 <td>Post Code.</td>
                <td><input type="text" name="prepostcode" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[40];?>'
            <?php  } ?>  ></input></td>
                 <td>Upazilla.</td>
                <td><input type="text" name="preupazilla" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[41];?>'
            <?php  } ?>  ></input></td>
                 <td>Distric.</td>
                <td><input type="text" name="predistric" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[42];?>'
            <?php  } ?>  ></input></td>
            </tr>
            <tr>
                <td rowspan="2"><STRONG class='text-info'>Parmanenet Address:</STRONG></span></td>
                <td>House No./Name.</td>
                <td><input type="text" name="parhose" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[43];?>'
            <?php  } ?>  ></input></td>
                 <td>VILL.</td>
                <td><input type="text" name="parvill" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[44];?>'
            <?php  } ?>  ></input></td>
                 <td>PO.</td>
                <td><input type="text" name="parpo" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[45];?>'
            <?php  } ?>  ></input></td>
            </tr>
            <tr>
                 <td>Post Code.</td>
                <td><input type="text" name="parpostcode" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[46];?>'
            <?php  } ?>  ></input></td>
                 <td>Upazilla.</td>
                <td><input type="text" name="parupazilla" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[47];?>'
            <?php  } ?>  ></input></td>
                 <td>Distric.</td>
                <td><input type="text" name="pardistric" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[48];?>'
            <?php  } ?>  ></input></td>
            </tr>
            </table>
            <table align="center" class="table table-responsive bg-info" style="border:1px #CCCCCC solid; margin-top: -20px;"> 
             <tr>
                <td bgcolor="#f4f4f4" class="success"  colspan="9"  align="left"><span style="font-size:15px; color:#333; display:block;"><STRONG class='text-info'><span class="glyphicon glyphicon-share-alt"></span>GUARDIAN'S INFORMATION</STRONG></span> </td>
            </tr>
            <tr>
                <td><STRONG class='text-info'>Guardian's Name:</STRONG></span></td>
                <td colspan="7">
                <div class="col-md-8 col-lg-8">
                <input type="text" class="form-control" placeholder="Guardian's Name" name="GuardianName"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[49];?>'
            <?php  } ?>  ></input></div></td>
            </tr>
             <tr>
                <td rowspan="2"><STRONG class='text-info'>Guardian's  Address:</STRONG></span></td>
                <td>House No./Name.</td>
                <td><input type="text" name="grahouseno" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[50];?>'
            <?php  } ?>  ></input></td>
                 <td>VILL.</td>
                <td><input type="text" name="gravilll" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[51];?>'
            <?php  } ?>  ></input></td>
                 <td>PO.</td>
                <td><input type="text" name="grapo" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[52];?>'
            <?php  } ?>  ></input></td>
            </tr>
             <tr>
                
                <td>Post Code.</td>
                <td><input type="text" name="grapostcode" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[53];?>'
            <?php  } ?>  ></input></td>
                 <td>Upazilla.</td>
                <td><input type="text" name="graupazilla" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[54];?>'
            <?php  } ?>  ></input></td>
                 <td>Distric.</td>
                <td><input type="text" name="gradistrict" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[55];?>'
            <?php  } ?>  ></input></td>
            </tr>
            
             <tr>
                <td><STRONG class='text-info'>Relation With Student:</STRONG></span></td>
                <td colspan="7">
                <div class="col-md-8 col-lg-8">
                <input type="text" class="form-control" placeholder="Relation With Student" name="RelationWithStudent"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[56];?>'
            <?php  } ?>  ></input></div></td>
            </tr>
             <tr>
                <td><STRONG class='text-info'>Guardian's Contact No:</STRONG></span></td>
                <td colspan="7">
                <div class="col-md-8 col-lg-8">
                <input type="text" class="form-control" placeholder="Guardian's Contact No:" name="GuardianContactNo" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[57];?>'
            <?php  } ?>  ></input></div></td>
            </tr>
             <tr>
                <td><STRONG class='text-info'>Guardian's Email:</STRONG></span></td>
                <td colspan="7">
                <div class="col-md-8 col-lg-8">
                <input type="email" class="form-control" placeholder="example@mail.com" name="GuardianEmail" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[58];?>'
            <?php  } ?>  ></input></div></td>
            </tr>
            </table>
            <table align="center" class="table table-responsive bg-info" style="border:1px #CCCCCC solid; margin-top: -20px;"> 
             <tr>
                <td bgcolor="#f4f4f4" class="success"  colspan="7"  align="left"><span style="font-size:15px; color:#333; display:block;"><STRONG class='text-info'><span class="glyphicon glyphicon-share-alt"></span>ACADEMIC INFORMATION</STRONG></span> </td>
            </tr>
            <tr>
                <td colspan="2"><STRONG class='text-info'>Admission Desire( Class):</STRONG></span></td>
                <td colspan="6">
                <div class="col-md-6 col-lg-6">
                    <select name="className" id="className" class="form-control">
                       
                       <?php
					   		if($check_Student){
							?>
							 <option value="<?php echo "$fetch_Student[admission_disir_class]and$fetch_Student[class_name]"?>"><?php echo $fetch_Student["class_name"];?></option>
							<?php
							}else {
					   
					   ?>
					   
					   <option >Select One</option>
					   <?php } ?>
					   <?php 
                                $select_section = "SELECT * FROM `add_class`";
                                $cheked_query=$db->select_query($select_section);
                                if($cheked_query)
                                {
                                    while($fetchsection=$cheked_query->fetch_array())
                                {
									if($fetch_Student["admission_disir_class"] != $fetchsection[0] ){
                            ?>
                            <option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
                            <?php } }  } ?>
                    </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><STRONG class='text-info'>Admission Desire(Group):</STRONG></span></td>
                <td colspan="6">
                <div class="col-lg-6 col-md-6"> 
                    <select name="groupname" id="groupname" class="form-control">
                             <?php
					   		if($check_Student){
							?>
							 <option value="<?php echo "$fetch_Student[admission_disir_group]and$fetch_Student[group_name]"?>"><?php echo $fetch_Student["group_name"];?></option>
							<?php
							}
					   
					   ?>
                        </select>
                </div>
                </td>
            </tr>
            <tr>
                <td><STRONG class='text-info'>Regular/Iregular:</STRONG></span></td>
                <td></td>
                <td><input type="radio" name="regularirregular"  class="radio-inline" value="regular"<?php if (isset($check_Student)) {
                    if($fetch_Student[61]=="regular"){?>
                checked="checked"
            <?php  } } ?>/>Regular
                         <input type="radio" name="regularirregular" class="radio-inline" value="Irregular" style="margin-left:35px; padding-left: 5px;"
                         <?php if (isset($check_Student)) {
                    if($fetch_Student[61]=="Irregular"){?>
                checked="checked"
            <?php  } } ?>/>Irregular</input></td>
                 <td>Cause.</td>
                <td><input type="text" name="Cause" class="form-control"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[62];?>'
            <?php  } ?>  ></input></td>
                 <td>Session.</td>
                <td>
					<select name="Session1" class="form-control">
					<?php if (isset($check_Student)) {?>
					<option><?php echo $fetch_Student[63]?></option>
					<?php } else {?>
						<!--<option>Select One</option>
						        <?php // } ?>
								  <?php 
								//$y=date('Y')+1;
								//$previous=$y-10;
								//for($year = $y; $year >= $previous;  $year--)
								//{?>
								
								<option><?php// print $year-1;?>-<?php //print $year;?></option>
								
								<?php //}
							?>-->
							<option>Select One</option>
						        <?php } ?>
								  <?php 
								$y=date('Y')+1;
								$previous=$y-5;
								for($year = $y; $year >= $previous;  $year--)
								{?>
								
								<option><?php print $year-1;?>-<?php print $year;?></option>
								
								<?php }
								$y=date('Y');
								$previous=$y-5;
								for($year = $y; $year >= $previous;  $year--)
								{
							?>
							<option><?php print $year;?></option>
							<?php  } ?>
					</select>
				
				<!--<input type="text" placeholder="2013-2014" name="Session1" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[63];?>'
            <?php  } ?>  ></input> ---></td>
            </tr>
            <tr>
                <td><STRONG class='text-info'>If Migrates:</STRONG></span></td>
                <td>TC Order No.</td>
                <td><input type="text" name="tcorderno" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[64];?>'
            <?php  } ?>  ></input></td>
                 <td>Date.</td>
                <td><input type="text" id="academicdate" name="academicdate" class="form-control" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[65];?>'
            <?php  } ?>  ></input></td>
                 <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="right"><STRONG class='text-info'>Image:</STRONG></span></td>
                <td colspan="2" align="left"><input type="file" name="file"></input></td>
                <td colspan="3" align="left"><strong class="text-danger">Picture Size Must be Less then or Equal (300*200)Pixels</strong></td>
                <td><?php if($check_Student){?> <img src="../other_img/<?php echo $fetch_Student[0]?>.jpg" height='120' width='130'/> <?php } ?></td>
            </tr>
            <tr>
                <td class="danger" colspan="7" bgcolor="#dddddd" align="center"><span>
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
                <td bgcolor="#f4f4f4" class="warning" colspan="7" align="center" >
               
                    <input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
                   
                </td>
            </tr>
            </table>
        </div>


 </form>

    <script src="../admin/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../Admission/Registration/signIN/signIn.php'</script>";}?>
