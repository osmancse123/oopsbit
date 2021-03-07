<?php

  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	 $sqlForTest="SELECT `boardexamresult`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`date_of_brith`,`student_address_info`.`permanent_house_name`,`permanent_village`,`permanent_PO`,`permanent_post_code`,`permanent_upazila`,`permanent_distric`,`gender`
FROM `boardexamresult` JOIN `student_personal_info` ON `student_personal_info`.`id`=`boardexamresult`.`StudentId`
JOIN `student_address_info` ON `student_address_info`.`id`=`boardexamresult`.`StudentId` WHERE `boardexamresult`.`StudentId`='".$_GET["stdid"]."'";
	$resultForAll=$db->select_query($sqlForTest);
		if($resultForAll){
				$fetchForall=$resultForAll->fetch_array();
		}
?>

<html>
	<head>
		<title>
			Testimonial
		</title>
		<style media="print">
.dont-print{display:none;}
        </style>
		<style type="text/css"> 
		
		*{padding:0px; margin:0px;}.style5 {font-size: 24px}
.style12 {font-family: "Times New Roman", Times, serif}
.style14 {font-size: 24px; font-family: "Times New Roman", Times, serif; }
        .style16 {font-size: 16px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
.style17 {font-size: 16px}
        .style19 {font-size: 18px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
        </style>
	</head>
	<body>
	<center>
<table width="1325" height="919" background="chhagalnaiya.png" style=" background:url(all_image/testimonialSDMS2015.png) no-repeat;position:relative; border:0px;" align="center" >
  <tr>
    <td width="1006" height="285" align="right" valign="bottom"></td>
    <td width="307" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="35%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="61%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="style16">EIIN</span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">106462</span></td>
      </tr>
      <tr>
        <td><span class="style16">School Code </span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">6918</span></td>
      </tr>
      <tr>
        <td><span class="style16">Center Code </span></td>
        <td><span class="style16">:</span></td>
        <td><span class="style16">616</span></td>
      </tr>
      <tr>
        <td><span class="style17"></span></td>
        <td><span class="style17"></span></td>
        <td><span class="style17"></span></td>
      </tr>
      <tr>
        <td><span style="font-size:18px; font-weight:bold;">Date</span></td>
        <td><span class="style19">:</span></td>
        <td><span style="font-size:18px; font-weight:bold;"><?php print $_GET["date"]?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="615" colspan="2" valign="top"><table width="100%" height="71%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8%"><span class="style12"></span></td>
        <td colspan="3" rowspan="2" valign="top"><table width="100%" height="52%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="41" colspan="3" class="style14">This is to certify that - </td>
            <td width="13%" class="style12">&nbsp;</td>
            <td width="3%" class="style12">&nbsp;</td>
            <td width="25%" class="style12">&nbsp;</td>
          </tr>
          <tr>
            <td width="16%" class="style12"><p class="style5">Name                
            </p>              </td>
            <td width="4%" align="center" class="style12"><span class="style5">:</span></td>
            <td width="39%" class="style12"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["student_name"];} else {echo "";}?></span></td>
            <td class="style12 style5">Roll No. </td>
            <td class="style12 style5">:</td>
            <td class="style12 style5"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["RollNo"];} else {echo "";}?></span></td>
          </tr>
          <tr>
            <td class="style12"><span class="style5">Father's Name</span></td>
            <td align="center" class="style12"><span class="style5">:</span></td>
            <td class="style12"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["father_name"];} else {echo "";}?></span></td>
            <td class="style12 style5">Reg. No. </td>
            <td class="style12 style5">:</td>
            <td class="style12 style5"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["RegNo"];} else {echo "";}?></span></td>
          </tr>
          <tr>
            <td class="style12"><span class="style5">Mother's Name</span></td>
            <td align="center" class="style12"><span class="style5">:</span></td>
            <td class="style12"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["mother_name"];} else {echo "";}?></span></td>
            <td class="style12 style5">Session</td>
            <td class="style12 style5">:</td>
            <td class="style12 style5"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["Session"];} else {echo "";}?></span></td>
          </tr>
          <tr>
            <td valign="top" class="style12"><span class="style5">Address</span></td>
            <td align="center" valign="top" class="style12"><span class="style5">:</span></td>
            <td class="style12"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["permanent_village"].','.$fetchForall["permanent_PO"].','.$fetchForall["permanent_upazila"].','.$fetchForall["permanent_distric"];} else {echo "";}?></span></td>
            <td class="style12 style5">Type</td>
            <td class="style12 style5">:</td>
            <td class="style12 style5"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["type"];} else {echo "";}?></span></td>
          </tr>
          <tr>
            <td class="style12"><span class="style5">Date of birth</span></td>
            <td align="center" class="style12"><span class="style5">:</span></td>
            <td class="style12"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["date_of_brith"];} else {echo "";}?></span></td>
            <td class="style12 style5">Group</td>
            <td class="style12 style5">:</td>
            <td class="style12 style5"><span class="style5"><?php if(isset($fetchForall)){ echo $fetchForall["GroupName"];} else {echo "";}?></span></td>
          </tr>
          <tr>
            <td class="style12">&nbsp;</td>
            <td class="style12">&nbsp;</td>
            <td class="style12">&nbsp;</td>
            <td class="style12">&nbsp;</td>
            <td class="style12">&nbsp;</td>
            <td class="style12">&nbsp;</td>
          </tr>
        </table></td>
        <td width="8%"><span class="style12"></span></td>
      </tr>
      <tr>
        <td height="139"><span class="style12"></span></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td height="104"><span class="style12"></span></td>
        <td colspan="3" align="justify" valign="top"><p class="style14">passed the <?php if(isset($fetchForall)){ echo $fetchForall["Title"];} else {echo "";}?> examination from this school in <?php print $fetchForall["year"]?> under the BISE, Comilla  <?php //print $fetch['year']?> and secured GPA <strong><?php if(isset($fetchForall)){ echo $fetchForall["GPA"];} else {echo "";}?> </strong> out of 5.00
          
          So far we know, 
		  <?php
		   if($fetchForall["gender"]=="Male")
		   {
		    	print "he";
		   }
		   else
		   {
		   	print "she";
		   }
		   
		   ?> bears a good moral character and didn't take part in any subversive activities of the school
            or the state during  <?php
		   if($fetchForall["gender"]=="Male")
		   {
		    	print "his";
		   }
		   else
		   {
		   	print "her";
		   }
		   
		   ?>  stay in the school.</p></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td><span class="style12"></span></td>
        <td colspan="3"><span class="style14">We wish  <?php
		   if($fetchForall["gender"]=="Male")
		   {
		    	print "him";
		   }
		   else
		   {
		   	print "her";
		   }
		   
		   ?>  every success in life.</span></td>
        <td><span class="style12"></span></td>
      </tr>
      <tr>
        <td><span class="style12"></span></td>
        <td width="28%"><span class="style12"></span></td>
        <td width="29%"><span class="style12"></span></td>
        <td width="27%"><span class="style12"></span></td>
        <td><span class="style12"></span></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
  </tr>
</table>
<form name="frm" method="post" >
<input type="submit" value="Print" onClick="window.print()" class="dont-print" />
</form>
<p>&nbsp;</p>
	</center>
</html>
</body>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


