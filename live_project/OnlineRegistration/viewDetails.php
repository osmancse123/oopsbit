
<?php 	

error_reporting(0);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	$id=$_GET['id'];
	
	 $sql ="SELECT `reg_student_acadamic_information`.*,`reg_student_address_info`.*,`reg_student_guardian_information`.*,`reg_student_personal_info`.*,
`reg_student_previous_result`.*,`reg_student_passward`.*,`add_class`.`class_name`,`add_group`.`group_name` FROM `reg_student_acadamic_information` INNER JOIN `reg_student_address_info`
ON `reg_student_address_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_guardian_information`
ON `reg_student_acadamic_information`.`id`=`reg_student_guardian_information`.`id` INNER JOIN `reg_student_personal_info`
ON `reg_student_personal_info`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN `reg_student_previous_result`
ON `reg_student_previous_result`.`id`=`reg_student_acadamic_information`.`id` INNER JOIN`reg_student_passward` ON `reg_student_passward`.`studentId`=`reg_student_acadamic_information`.`id` INNER JOIN `add_class` ON `add_class`.`id`=`reg_student_acadamic_information`.`admission_disir_class`
INNER JOIN `add_group`  ON  `add_group`.`id`=`reg_student_acadamic_information`.`admission_disir_group` WHERE `reg_student_acadamic_information`.`id`='$id'";
	$result =  $db->select_query($sql);
		if($result->num_rows > 0){
			$fetch_result = $result->fetch_array();
		}

	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
		<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
.table{border:1px #4639E8 solid;}
.title{color:#000000; font-size:25px; font-weight:bold; text-align:center;}
.intitle{padding-left:15px; color:#0033CC; font-size:18px; letter-spacing:0.5px;}
.text{padding-left:15px; color:#000000; font-size:18px; }
</style>

<style media="print">
.print{display:none;}
#print{display:none;}
</style>


</head>

<body style="background:#fff;background: -moz-radial-gradient(center, ellipse cover,  #e5e5e5 0%, #ffffff 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#e5e5e5), color-stop(100%,#ffffff));
  background: -webkit-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%); 
  background: -o-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%); 
  background: -ms-radial-gradient(center, ellipse cover,  #e5e5e5 0%,#ffffff 100%);
  background: radial-gradient(ellipse at center,  #e5e5e5 0%,#ffffff 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5e5e5', endColorstr='#ffffff',GradientType=1 ); 
 font: 600 15px "Open Sans",Arial,sans-serif;">
 
 <center>
 


<table  class="table "  style="background: #fff;;max-width: 960px; border-top:1px #4639E8 solid; "  border="0" align="center" cellpadding="0" cellspacing="0">
 
 <tr>
 	<td align="left" style=" padding-left: 20px;"> 

<span style=" float: left;clear: right;"> 
<p style="text-align:left;">
 	<h3  style="text-transform:uppercase; font-size: 22px;"><?php print $fetch_school_information['institute_name'] ?></h3>
 </p>
 <p style="text-align: center;">
 	<h5 style="text-transform:uppercase;">
<?php print $fetch_school_information['location'] ?>
</h5>
</p>
<p style="text-align: center;">
	<h4>
Admission Form - <?php echo $fetch_result["session2"]; ?>
</h4>



</p>
</span>

<span style="float: left; clear: right; margin-left: 60px; margin-top: 50px; ">
	<p>
<h4>
	
	Applicant's ID : <b><?php echo $fetch_result["id"]; ?></b>





</h4>
	</p>
</span>


<span style=" float: right;">


<!-- 	<img src="../other_img/<?php print $_POST['getId']?>.jpg" height="156" width="180" /> -->

	<img src="../other_img/<?php print $_GET['id']?>.jpg"  style="width: 80px; height: 100px " />
</span>



    </td>

 </tr>


     <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">ADMISSION DESIRE </span></td>
  </tr>

<tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

     <tr>
       
        <td width="321"  bgcolor="#FFFFFF" ><span style="padding-left: 10px; font-size: 14px;">Class</span></td>

        
          <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        </td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["class_name"]; ?></span></td>
        </tr>

	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	


         <tr>
        <td  width="145"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Group</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["group_name"]; ?></span></td>
        </tr>
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>






 <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">PERSONAL INFORMATION </span></td>
  </tr>

  
  <tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>

    <td width="50%">

	 
	 <table>
	 			
	 	
	 		
	 	
      <tr>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Application Date</span></td>

        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        <td width="550" bgcolor="#FFFFFF">

          <span style=" font-size: 14px;"><?php echo $fetch_result['addmission_date']; ?>
        </td>

    

      </tr>


      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["student_name"]; ?></span></td>
        </tr>
       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Father's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["father_name"]; ?></span></td>
        </tr>
     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Mother's Name</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["mother_name"]; ?></span></td>
        </tr>
      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Gender</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["gender"]; ?></span></td>
        </tr>
      <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Date Of Birth</span></td>
        <td  bgcolor="#FFFFFF"><span style=" padding-left: 10px;font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["date_of_brith"]; ?></span></td>
        </tr>
      <tr>
        <td width="321" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Religion</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style=" font-size: 14px;"><?php echo $fetch_result["religious"]; ?></span></td>
        </tr>
    
   


   
	</table>	


    </td>

    <td width="50%">

    		<table>
    			
    			 <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Nationality</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["nationality"]; ?></span></td>
        </tr>
     <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Relationship</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["meritial_status"]; ?></span></td>
        </tr>
      <tr>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Blood Group</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["blood_group"]; ?></span></td>
        </tr>
    			  <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Contact No.</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["contact_no"]; ?></span></td>
        </tr>
      <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Student's Email</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["email"]; ?></span></td>
        </tr>
     <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        </tr>
      <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"></span></td>
        </tr>
    		</table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

 

     <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">PREVIOUS RESULT</span></td>
  </tr>


<tr>
    <td>





<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Institute</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_institute"]; ?></span></td>
        </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Class</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_board"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Class Roll</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_roll"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Board Roll</span></td>
        <td  bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_registration"]; ?></span></td>
        </tr>



	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Group</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_group"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Passing Year</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_passing_year"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">GPA/Total Marks</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["psc_GPA"]; ?></span></td>
        </tr>

        <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Documents</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 30px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">

          <a href="../other_img/<?php print $_GET['id']?>tc.jpg" target="_blank" class="print">View</a>

          <?php
                $pathdocument=$_GET['id']."tc.jpg";
                if (file_exists('../other_img/'.$pathdocument)) 
                {
                    echo "Document attached";
                } 
                else {
                    echo "Document not attached";
                }
          ?>

        </span></td>
        </tr>
      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

<!-- .....................................Address................................-->
   <tr>
        <td height="30"   bgcolor="#BADCDC"><span style="padding-left: 10px; font-size: 15px;">ADDRESS</span></td>
  </tr>


<tr>
    <td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
     <tr>
    <td width="50%">
	 <table>

	 	<tr>
	 			<td colspan="3" align="left" > <b style="padding-left: 10px;">Present Address </b></td>

	 	</tr>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">House Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_house_name"]; ?></span></td>
    </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Village </span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_village"]; ?></span></td>
        </tr>



         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Post Office</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_PO"]; ?></span></td>
        </tr>



       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Upazila</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_upazila"]; ?></span></td>
        </tr>

       <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">District</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["present_distric"]; ?></span></td>
        </tr>


	</table>	


    </td>

    <td width="50%">

    <table>
    			
        <tr>
	 				<td colspan="3" align="left" > <b style="padding-left: 10px;"> <b> Permanent Address </b> </td>

	 	</tr>
	 	

    	<tr>
        <td width="140"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">House Name</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_house_name"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Village </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_village"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Post Office</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF">
        	<span style="padding-left: 10px; font-size: 14px;">
        		<?php echo $fetch_result["permanent_PO"]; ?></span></td>
        </tr>


        <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Upazila</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>

        <td colspan="2" bgcolor="#FFFFFF">
        	<span style="padding-left: 10px; font-size: 14px;">
        		<?php echo $fetch_result["permanent_upazila"]; ?></span></td>
        </tr>


       <tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">District</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["permanent_distric"]; ?></span></td>
        </tr>



      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

    <!-- ................................End Address................................-->
 


<!-- ............................Guardian's	Info................................-->
   <tr>
        <td height="30"   bgcolor="#BADCDC">
        	<span style="padding-left: 10px; font-size: 15px;">GUARDIAN'S INFORMATION </span> </td>
  </tr>



<tr>
    <td>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" >
     
   <tr>
    <td width="50%">
	 <table>

     <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Guardian  Name</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_name"]; ?></span></td>
        </tr>

         <tr>
        <td width="321"  bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Relation</span></td>
        <td width="48" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td width="601" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["relation_with_student"]; ?></span></td>
        </tr>






	</table>	


    </td>

    <td width="50%">

    <table>
    			
    	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">Guardian's Contact No</span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_contact"]; ?></span></td>
        </tr>
        	<tr>
        <td   bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"> Guardian's Email </span></td>
        <td bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;">:</span></td>
        <td colspan="2" bgcolor="#FFFFFF"><span style="padding-left: 10px; font-size: 14px;"><?php echo $fetch_result["guardian_email"]; ?></span></td>
        </tr>
        	
      
      
    </table> 
    </td>

  

</tr>
    </table>
	
	</td>
    </tr>

    <!-- ..........................End Guardian's................................-->
 


<tr>


	<td>

		<table width="100%">
		
		<tr>
				<td  align="center">
				
					<br>
.............................<br>
      Guardian  </td>
				<td align="center">
            <td align="center" valign="bottom">  Developed By: <b>SBIT</b> </td>
					<br>
					.............................<br>
      Student 


				</td>

		</tr>
	</table>


	</td>

</tr>






	





<tr id="print">
              
 <td id="print">
 
              

                <input type="button" onClick="window.print()" value="Print" class="btn btn-large btn-danger"  />&nbsp;&nbsp;&nbsp;

           

          
   </td>

            
        </tr>
</table>