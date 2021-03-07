
<?php

error_reporting(1);
@session_start();
@date_default_timezone_set('Asia/Dhaka');
require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}


    
	
if(isset($_POST['add']))
    {
	//print $_POST['addmissiondate'];
        $classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
        @$explode_Class=explode("and",$classname);
        //print_r($explode_Class);
        $class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
        @$exploide_gropu=explode("and",$class_section);
        //print_r($exploide_gropu);
        if(!empty($_POST["studentname"]) && !empty($_POST["gender"]) && !empty($_POST['fathername']) && !empty($_POST['mothersname']) && $classname!="Select One" && !empty($class_section) && !empty($_POST['Session1']))
        {

		 	$prefix=date("y");
    	 	$fetch_Student[0]=$db->withoutPrefix('reg_student_personal_info','id',"0".$prefix,'6');
		  $passward  = base64_encode($fetch_Student[0]);
    
               
                $file_name = $_FILES['file']['name'];
                $file_size =$_FILES['file']['size'];
                $file_tmp =$_FILES['file']['tmp_name'];
                $file_type=$_FILES['file']['type']; 
                  
                $file_ext=@strtolower(end(explode('.',$file_name)));
                
                $expensions= array("jpeg","jpg","png",''); 
                if(in_array($file_ext,$expensions) == false && $file_size > 360000){
                    //$msg="<span class='text-center text-danger'>extension not allowed, and check your image less then 360kb.</span>";
					  print "<script>alert('extension not allowed, and check your image less then 360kb')</script>";
                }   else {  
         @$personal_insert_query="INSERT INTO `reg_student_personal_info` (`id`,`addmission_date`,`student_name`,`father_name`,`mother_name`,`gender`,`date_of_brith`,`religious`,`meritial_status`,`blood_group`,`nationality`,`contact_no`,`email`) VALUES('".$fetch_Student[0]."','".$_POST['addmissiondate']."','".$_POST['studentname']."','".$_POST['fathername']."','".$_POST['mothersname']."','".$_POST['gender']."','".$_POST['dateofbrith']."','".$_POST['religious']."','".$_POST['meritelstutas']."','".$_POST['blood']."','".$_POST['Nationality']."','".$_POST['Contactno']."','".$_POST['Email']."')";
       
	   $previousresult_insert_query="INSERT INTO reg_student_previous_result 
        (id,psc_board, psc_institute, psc_registration,  psc_Year, psc_roll, psc_group, psc_GPA, psc_passing_year,jsc_board,jsc_institute,jsc_registration,jsc_Year,jsc_roll, jsc_group, jsc_GPA, jsc_passing_year,  ssc_board, ssc_institute, ssc_registration, ssc_Year, ssc_roll, ssc_group, ssc_GPA, ssc_passing_year) values ('".$fetch_Student[0]."','".$_POST['pscboard']."','".$_POST['pscinstitute']."','".$_POST['pscregno']."','".$_POST['pscyear']."','".$_POST['pscroll']."','".$_POST['pscgroup']."','".$_POST['pscgradepoint']."','".$_POST['pscpassingyear']."','".$_POST['jscboard']."','".$_POST['jscinstitute']."','".$_POST['jscregno']."','".$_POST['jscyear']."','".$_POST['jscroll']."','".$_POST['jscgroup']."','".$_POST['jscgradepoint']."','".$_POST['jscpassingyear']."','".$_POST['sscboard']."','".$_POST['sscinstitue']."','".$_POST['sscregno']."','".$_POST['sscyear']."','".$_POST['sscroll']."','".$_POST['sscgroup']."','".$_POST['ssgradepoint']."','".$_POST['sscpassingyear']."')";

        $studentaddress_insert_query="INSERT INTO reg_student_address_info (id, present_house_name, present_village, present_PO, present_post_code, present_upazila, present_distric,permanent_house_name, permanent_village, permanent_PO, permanent_post_code, permanent_upazila, permanent_distric)VALUES('".$fetch_Student[0]."','".$_POST['prehouseno']."','".$_POST['previlll']."','".$_POST['prepo']."','".$_POST['prepostcode']."','".$_POST['preupazilla']."','".$_POST['predistric']."','".$_POST['parhose']."','".$_POST['parvill']."','".$_POST['parpo']."','".$_POST['parpostcode']."','".$_POST['parupazilla']."','".$_POST['pardistric']."')";
        
        @$student_gurdient_informaiton="INSERT INTO `reg_student_guardian_information` (`id`,`guardian_name`,`guardian_house_name`,`guardian_village`,`guardian_po`,`guardian_postCode`,`guardian_upazila`,`guardian_distric`,`relation_with_student`,`guardian_contact`,`guardian_email`) VALUES ('".$fetch_Student[0]."','".$_POST['GuardianName']."','".$_POST['grahouseno']."','".$_POST['gravilll']."','".$_POST['grapo']."','".$_POST['grapostcode']."','".$_POST['graupazilla']."','".$_POST['gradistrict']."','".$_POST['RelationWithStudent']."','".$_POST['GuardianContactNo']."','".$_POST['GuardianEmail']."')";

        

        @$student_academic_information="INSERT INTO reg_student_acadamic_information (id, admission_disir_class, admission_disir_group, regular_iregular, caues, session2, tc_orderNo, date) VALUES ('".$fetch_Student[0]."','$explode_Class[0]','$exploide_gropu[0]','".$_POST['regularirregular']."','".$_POST['Cause']."','".$_POST['Session1']."','".$_POST['tcorderno']."','".$_POST['academicdate']."')";
        
		$studnetPasswardInfor="INSERT INTO `reg_student_passward`(`studentId`,`passward`,`status`) VALUES('".$fetch_Student[0]."','$passward','Deactive')";
    /*}*/
	$strfimg="../../other_img/".$fetch_Student[0].".jpg";
	@move_uploaded_file($_FILES["file"]["tmp_name"],$strfimg);
        @chmod($strfimg,0644);
		$db->insert_query($student_academic_information);
        $db->insert_query($student_gurdient_informaiton);
        $db->insert_query($studentaddress_insert_query);
        $db->insert_query($personal_insert_query);
        $db->insert_query($previousresult_insert_query);
		 $db->insert_query($studnetPasswardInfor);
		   
		 print "<script>location='successFullMessage.php?id=$fetch_Student[0]'</script>";
         $fetch_Student[0]=$db->withoutPrefix('reg_student_personal_info','id',"0".$prefix,'6');
      //  $strfimg=
		//print "../../other_img/".$fetch_Student[0].".jpg";
      
		
}

    
	
	}
    else
    {
        print "<script>alert('Please Fill Up TextField')</script>";
    }
    }
    
    
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     	 <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />

	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 	
	
	 <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
		<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	 
	<script src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.multipurpose_tabcontent.js"></script>
	<script>
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
	// alert('ddd');
        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=1 )
                {
                    //show that the username is available
					//alert(result);
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

 $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
					
                }).on('changeDate', function(e){
					$(this).datepicker('hide');
					
				});  
            
            });
	</script>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  overflow-x: hidden;
}

.wrapper {
  max-width: 1200px;
  margin: 150px auto;
  margin-top:20px;
}

.wrapper > h1 { text-align: center; }

.wrapper > h1 span {
  border-bottom: 2px solid #49a4d9;
  display: inline-block;
  padding: 0 10px 10px;
  color: #49a4d9;
  transition: all 0.5s linear;
}

ul, li {
  margin: 0;
  padding: 0;
  list-style: none;
}

@media only screen and (max-device-width: 480px) {
.formediaFrast {
				height:1800px;
}
	}
</style>
<script type="text/javascript">
		$(document).ready(function(){
				
				$(".first_tab").champ({
                plugin_type :  "tab",
                side : "",
                active_tab : "1",
                controllers : "true",
                ajax : "true",
                show_ajax_content_in_tab : "5",
					content_path : "html.php"
			});
				
			

			$(".accordion_example").champ({
                plugin_type :  "accordion",
                side : "left",
                active_tab : "3",
                controllers : "true"
			});

			$(".second_tab").champ({
                plugin_type :  "tab",
                side : "right",
                active_tab : "1",
                controllers : "false"
			});

			$(".third_tab").champ({
                plugin_type :  "tab",
                side : "",
                active_tab : "5",
                controllers : "true",
                ajax : "true",
                show_ajax_content_in_tab : "5",
                content_path : "html.txt"
			});
				
		});
		
		function viewShowImage(e){
		var file = e.files[0];
			var imagefile = file.type;		
			var type = ["image/jpeg","image/png","image/jpg"];
			if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2]){
				var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
			}else{
				alert("Please select a vild image");
			}
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
				//$("#textt").text("Selected Image : ");
                $("#preview").attr('src',e.target.result);
				$("#preview").css('height','60px');
            }
			}
			$(":file").filestyle();
	</script>
</head>

<body>
<form name="signfrom" action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="container">
				
		<div class="col-lg-12 col-md-12 col-xs-12 table-bordered" style="text-align:center;height:100px;">
						<span style="padding-top:25px; font-size:20px; font-weight:bold" class="text-success"><br/><?php print $fetch_school_information['institute_name'] ?></span>
						<br/>
						<span class="text-info" style="font-size:16px; font-weight:500">(Admission Infromation)</span>
		</div>
		
		<div class="tab_wrapper first_tab">
			<ul class="tab_list">
				<li class="active">Personal Information</li>
				<li>Previous Result</li>
				<li>Address/Academic Information</li>
				<li>Gurdian Information</li>
			
				
			</ul>

			<div class="content_wrapper" >
				<div class="tab_content active formediaFrast" style="height:750px;">
					<progress style="Width:100%;background:#F1123F; height:10px;" class="progress progress-striped progress-success"  role="progressbar" value="25" max="100"></progress>
							
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
									<table style="width:100%;">
											<tr>
													<td><span class="text-success" style="font-weight:500">Admission Date :</span>
															<input type="text" style="height:30px; width:100%; margin-top:5px;" placeholder="dd-mm-yy" id="example1" name="addmissiondate" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[1];?>'
            <?php  } ?> /></div>
                <input type="hidden" name="id" 
                value='<?php echo $fetch_Student[0];?>'
            ></input>
													</td>
											</tr>
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Student Name :</span><strong class="text-danger" >**</strong><input type="text" placeholder="Student Name" name="studentname" style="height:30px; width:100%; margin-top:5px;"   <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[2];?>'
            <?php  } ?>  />
													</td>
											</tr>
											
											
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Gendar :</span> <strong class="text-danger" >**</strong><br/>
															<input type="radio" name="gender"  class="radio-inline" value="Male"  <?php if (isset($check_Student)) {
                    if($fetch_Student[5]=="Male"){?>
                checked="checked"
            <?php  } } ?> />&nbsp;&nbsp;Male
                         <input type="radio" name="gender" class="radio-inline" value="Female" style="margin-left:35px; padding-left: 5px;"<?php if (isset($check_Student)) {
                    if($fetch_Student[5]=="Female"){?>
                checked="checked"
            <?php  } } ?> 
                         />&nbsp;&nbsp;Female 
													</td>
											</tr>
											<tr>
													<td><span class="text-success" style="font-weight:500">Religious   :</span> 
															<select style="height:30px; width:100%; margin-top:5px;"  name="religious">
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
													</td>
											</tr>
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Blood Group   :</span> 
															<select  style="height:30px; width:100%; margin-top:5px;"  name="blood">
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
                    </select>				</td>
											</tr>
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Maritel Status    :</span> <br/>
															<input type="radio" name="meritelstutas"  class="radio-inline" value="married" <?php if (isset($check_Student)) {
                    if($fetch_Student[8]=="married"){?>
                checked="checked"
            <?php  } } ?>/>&nbsp;&nbsp;Married     
                         <input type="radio" name="meritelstutas" class="radio-inline" value="unmarried" style="margin-left:35px; padding-left: 5px;"
                         <?php if (isset($check_Student)) {
                    if($fetch_Student[8]=="unmarried"){?>
                checked="checked"
            <?php  } } ?>/>&nbsp;&nbsp;Unmarried			</td>
											</tr>
											<tr>
											<td height="40"></td>
											</tr>
											
									</table>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered" >
							
							<table style="width:100%;" >
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Father Name :</span> <strong class="text-danger" >**</strong>
															<input type="text" placeholder="Fathers Name" name="fathername" style="height:30px; width:100%; margin-top:5px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[3];?>'
            <?php  } ?>  />
													</td>
											</tr>	
											<tr>
													<td><span class="text-success" style="font-weight:500">Mother's Name :</span> <strong class="text-danger" >**</strong><input type="text" placeholder="Mothers Name" name="mothersname"  style="height:30px; width:100%; margin-top:5px;"  <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[4];?>'
            <?php  } ?>  />
													</td>
											</tr>
											<tr>
													<td><span class="text-success" style="font-weight:500">Date Of Birth :</span> 
															<input type="text" placeholder="dd-mm-yy" name="dateofbrith" style="height:30px; width:100%; margin-top:5px;" id="example2" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[6];?>'
            <?php  } ?>  />
													</td>
											</tr>
											<tr>
													<td><span class="text-success" style="font-weight:500">Nationality   :</span> 
															<input type="text" placeholder="Nationality" name="Nationality" style="height:30px; width:100%; margin-top:5px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[10];?>'
            <?php  } ?>  />
													</td>
											</tr>
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Contact No  :</span> 
															<input type="text" placeholder="Contact No" name="Contactno" style="height:30px; width:100%; margin-top:5px;"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[11];?>'
            <?php  } ?>   />		</td>
											</tr>
											
											
											<tr>
													<td><span class="text-success" style="font-weight:500">Email    :</span> <br/>
															<input type="email" placeholder="Example@mail.com" name="Email" style="height:30px; width:100%; margin-top:5px;"  <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[12];?>'
            <?php  } ?>   />		</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
									</table>
							
							</div>
					
					
					</div>

				
				
				
				<div class="tab_content" style="height:800px;">
				<progress style="Width:100%;background:#F0A924; height:10px;" class="progress progress-striped progress-success" value="50" max="100"></progress>
					
					<div class="table-bordered col-lg-6  col-md-6 col-xs-12" style="height:250px;">
						<span style="display:block; font-size:16px; font-weight:600" class="text-success">PSC/Ebtedaye Result Information </span>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Board  :</span> 
											<input type="text" name="pscboard"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Institute  :</span> 
											<input type="text" name="pscinstitute"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table></div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Reg.No.  :</span> 
											<input type="text" name="pscregno"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table></div>	
								
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Year  :</span> 
											<input type="text" name="pscyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Roll  :</span> 
											<input type="text" name="pscroll"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Group  :</span> 
											<input type="text" name="pscgroup"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Grade Point  :</span> 
											<input type="text" name="pscgradepoint"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
					
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Passing Year :</span> 
											<input type="text" name="pscpassingyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
					
					</div>
					<div class="table-bordered col-lg-6  col-md-6 col-xs-12" style="height:250px;">
						<span style="display:block; font-size:16px; font-weight:600" class="text-success">JSC/JDC Result Information </span>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Board  :</span> 
											<input type="text" name="jscboard"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Institute  :</span> 
											<input type="text" name="jscinstitute"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table></div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Reg.No.  :</span> 
											<input type="text" name="jscregno"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table></div>	
								
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Year  :</span> 
											<input type="text" name="jscyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Roll  :</span> 
											<input type="text" name="jscroll"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>	
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Group  :</span> 
											<input type="text" name="jscgroup"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Grade Point  :</span> 
											<input type="text" name="jscgradepoint"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
					
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Passing Year :</span> 
											<input type="text" name="jscpassingyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
						</div>
					
					</div>
					
					<div class="table-bordered col-lg-12  col-md-6 col-xs-12">
							<span style="display:block; font-size:16px; font-weight:600" class="text-success">SSC/DAKHIL Result Information </span>
						
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Board :</span> 
											<input type="text" name="sscboard"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Institute :</span> 
											<input type="text" name="sscinstitue"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Reg.No :</span> 
											<input type="text" name="sscregno"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Year :</span> 
											<input type="text" name="sscyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Roll :</span> 
											<input type="text" name="sscroll"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Group :</span> 
											<input type="text" name="sscgroup"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Grade Point :</span> 
											<input type="text" name="ssgradepoint"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<table style="width:100%">
										<tr>
											<td>
											<span class="text-success" style="font-weight:500">Passing Year :</span> 
											<input type="text" name="sscpassingyear"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input></td>
										</tr>
								</table>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="margin-top:10px;"></div>
						
					</div>
					
					
				</div>

				<div class="tab_content" style="height:970px;">
				<progress style="Width:100%;background:#3FDE16; height:10px;" class="progress progress-striped progress-success" value="75" max="100"></progress>
				
			
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
							<span style="display:block; font-size:16px; font-weight:600" class="text-success">Present Address</span>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">House No./Name :</span>
																<input type="text" name="prehouseno"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">VILL. :</span>
																<input type="text" name="previlll"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">PO. :</span>
																<input type="text" name="prepo"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Post Code. :</span>
																<input type="text" name="prepostcode"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Upazilla :</span>
																<input type="text" name="preupazilla"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Distric :</span>
																<input type="text" name="predistric"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
									<table style="height:20px;">
											<tr>
													<td height="20"></td>
											</tr>
									</table>
								</div>
								
								
								
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
							<span style="display:block; font-size:16px; font-weight:600" class="text-success">Parmanenet Address:</span>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">House No./Name :</span>
																<input type="text" name="parhose"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">VILL. :</span>
																<input type="text" name="parvill"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">PO. :</span>
																<input type="text" name="parpo"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Post Code. :</span>
																<input type="text" name="parpostcode"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Upazilla :</span>
																<input type="text" name="parupazilla"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Distric :</span>
																<input type="text" name="pardistric"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
									<table style="height:20px;">
											<tr>
													<td height="20"></td>
											</tr>
									</table>
								</div>
								
								
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
								<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Admission Desire( Class):</span>
																 <select name="className" id="className" style="width:100%; height:30px;" >
                       <option >Select One</option>
                       <?php 
                                $select_section = "SELECT * FROM `add_class`";
                                $cheked_query=$db->select_query($select_section);
                                if($cheked_query)
                                {
                                    while($fetchsection=$cheked_query->fetch_array())
                                {
                            ?>
                            <option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
                            <?php }  } ?>
                    </select>
													 </td>
												</tr>
										</table>
										
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Admission Desire(Group):</span>
																  <select name="groupname" id="groupname"  style="width:100%; height:30px;">
                            
                        </select>
													 </td>
												</tr>
										</table>
										
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Session:</span>
																<select name="Session1" style="width:100%; height:30px;">
					<?php if (isset($check_Student)) {?>
					<option><?php echo $fetch_Student[63]?></option>
					<?php } else {?>
						<option>Select One</option>
						        <?php } ?>
								  <?php 
								$y=date('Y')+1;
								$previous=$y-10;
								for($year = $y; $year >= $previous;  $year--)
								{?>
								
								<option><?php print $year-1;?>-<?php print $year;?></option>
								
								<?php }
							?>
							
					</select>
													 </td>
												</tr>
										</table>
										
										
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Images:</span>
																<input  type="file" class="filestyle" name="file" accept="image/*" id="file" onChange="viewShowImage(this)"></input>
																
					 
													 </td>
													 <td height="125">  <img src="../../admin/all_image/Noimage.png" class='img-responsive img-thumbnail' height='180' width='120' id="preview" style='margin-top: 5px; margin-left:15px;' /></td>
												</tr>
										</table>
										
										<table style="width:100%; height:21px;">
												<tr>
													<td>
													 </td>
												</tr>
										</table>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Regular/Iregular:</span><br/>
																<input type="radio" style="margin-left:15px; padding-left:5px;" name="regularirregular"  class="radio-inline" value="regular"<?php if (isset($check_Student)) {
                    if($fetch_Student[61]=="regular"){?>
                checked="checked"
            <?php  } } ?>/>&nbsp;&nbsp;Regular<br/>
                         <input type="radio" name="regularirregular" class="radio-inline" value="Irregular" style="margin-left:15px; padding-left: 5px;"
                         <?php if (isset($check_Student)) {
                    if($fetch_Student[61]=="Irregular"){?>
                checked="checked"
            <?php  } } ?>/>&nbsp;&nbsp;Irregular</input>
													 </td>
												</tr>
										</table>
								
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Cause.:</span>
															<input type="text" name="Cause" style="width:100%; height:30px;"<?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[62];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								
								</div>
								
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;"><strong><span class="text-success" style="font-weight:500">If Migrates:</span></strong></div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">TC Order No.:</span>
															<input type="text" name="tcorderno" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[64];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										
										<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Date:</span>
														<input type="text" id="academicdate" name="academicdate"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[65];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
								
								</div>
								
								
								
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
										
										<table style="width:100%; height:152px;">
												<tr>
													<td>
													 </td>
												</tr>
										</table>
								
								</div>
						</div>
						
						<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered"></div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 table-bordered"></div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 table-bordered"></div>-->
				
				
				
					
				</div>

				<div class="tab_content" style="height:500px;">
				<progress style="Width:100%; background:green; height:10px" class="progress progress-striped progress-success" value="100" max="100"></progress>
				
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
					<span style="display:block; font-size:16px; font-weight:600" class="text-success">Guardian's Address:</span>
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Guardian's Name :</span>
																<input type="text" name="GuardianName"   placeholder="Guardian's Name"  style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Relation With Student :</span>
																<input type="text" placeholder="Relation With Student" name="RelationWithStudent" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Guardian's Contact No :</span>
																<input type="text" placeholder="Guardian's Contact No:" name="GuardianContactNo" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Guardian's Email :</span>
																<input type="text" placeholder="example@mail.com" name="GuardianEmail" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
						<div  class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<table style="width:100%; height:41px;">
												<tr>
													<td>
													 </td>
												</tr>
										</table>
							</div>
							
							
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 table-bordered">
					
						
						
						<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">House No./Name.</span>
																<input type="text"  name="grahouseno" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">VILL.</span>
																<input type="text"  name="gravilll" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">PO.</span>
																<input type="text"  name="grapo" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Post Code.</span>
																<input type="text"  name="grapostcode" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Upazilla.</span>
																<input type="text"  name="graupazilla" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%;">
												<tr>
													<td><span class="text-success" style="font-weight:500">Distric.</span>
																<input type="text"  name="gradistrict" style="width:100%; height:30px;" <?php if (isset($check_Student)) {?>
                value='<?php echo $fetch_Student[13];?>'
            <?php  } ?>  ></input>
													 </td>
												</tr>
										</table>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="text-align:right; margin-top:10px;">
									<input type="submit" name="add" value="Submit" class="btn btn-success" />
							</div>
							
							<div class="col-lg-4 col-sm-4 col-md-6 col-xs-6">
									<table style="width:100%; height:20px;">
											<tr>
												<td></td>
											</tr>
									</table>
							</div>
							
					</div>
					
					
				
				</div>
				
			</div>

		</div>
	</div>
	 <script src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</form>
</body>
</html>