
 <br>
<?php
    error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
		$sqlforTitle="SELECT * FROM `project_info`";
	$chke=$db->select_query($sqlforTitle);
	if($chke){
			$fetch_tiitle=$chke->fetch_array();
	}
	
	  $sqlForTest="SELECT `statictestomonialinfo`.*,`distributedtestomoniallist`.* FROM `statictestomonialinfo`
INNER JOIN `distributedtestomoniallist` ON `distributedtestomoniallist`.`studentId`=`statictestomonialinfo`.`boardResultID`
WHERE `statictestomonialinfo`.`boardResultID`='".$_GET["stdid"]."'";
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
	<div style="width:1500px; margin-left:20px; margin-top:0px;">
	<div style="float:left; clear:right; width:480px;">
	  <table style="width:100%; margin-top:10px;"  height="145" border="0" cellpadding="0" cellspacing="0" >
        <tr>
         
        </tr>
        <tr>
          <td width="71" height="75" align="center">&nbsp;<img src="http://chhagalnaiyapilot.edu.bd/admin/all_image/shortcurt_iconSDMS2015.png" style="height:60px; width:60px"/></td>
          <td width="307" align="center">&nbsp;<span style="font-size:20px; font-weight:bold; letter-spacing:1; color:#940320; font-family:sans-serif">Chhagalnaiya Govt. Pilot High School</span><br/>
		    <span style=" font-size:16px">P.O. & Upazilla :Chhagalnaiya, District :Feni.</span><br/>		  </td>
          <td width="80" align="center"></td>
        </tr>
        <tr>
          <td colspan="3" align="center">&nbsp; <a href="#" style="background:#011263; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; border-radius:20px; font-size:20px; letter-spacing:2; color:#FFFFFF; font-weight:bold; font-family:sans-serif; text-decoration:none "><strong>Testimonial </strong></a></td>
        </tr>
      </table>
	  <table style="width:100%"  height="44" border="0" cellpadding="0" cellspacing="0">
	  	<tr>
			<td width="49%" height="42"><span style="font-size:16px; padding-left:5px;font-family:sans-serif, fantasy, monospace; ">No -&nbsp;<?php
					if(isset($fetchForall)){
						echo $fetchForall["boardResultID"];
					}
					else {
						echo "";
					}
			?></span></td>
			<td width="8%"></td>
			<td width="13%"><span style="font-size:16px; padding-left:5px;font-family:sans-serif, fantasy, monospace; ">Date : </span></td>
			<td width="45%"><span style="padding-left:-10px;">
			<?php
					if(isset($fetchForall)){
						echo $fetchForall["date"];
					}
					else {
						echo "";
					}
			?>
			</span></td>
		</tr>
  </table>
  
	  <table style="width:100%"  height="462" border="0" cellpadding="0" cellspacing="0">

				<tr>
					<td width="41%" height="50"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Name Of the student</i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["studentName"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="39"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Father's Name</i></span></td>
					<td width="59%">
					<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>
					<?php
					if(isset($fetchForall)){
						echo $fetchForall["fatherName"];
					}
					else {
						echo "";
					}
			?>
			</i></span>
			
			
					</td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Mother's Name </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["motherName"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Village </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["v"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  	<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;PO </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["p"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
					<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Upazilla  </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["u"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
					<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;District  </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["d"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="46"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Name of the Examinition </i></span></td>
					<td width="59%">		<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"].'&nbsp;Examinition';
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="46"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Year </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;  <?php
	  		if($fetchForall["Title"]=='SSC')
			{
	  ?>
	  Group Name 
	  <?php } else {?>Honours Subject <?php  } ?> </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
			
	  
				<tr>
					<td width="41%" height="44"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Examinition Roll No. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
	
				<tr>
					<td width="41%" height="42"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Reg No. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="48"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Session. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="63"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Result : GPA </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
	  </table>
	  
	  </div>
	  <div style="float:left; margin-left:20px; width:970px; ">
	  <?php
	  		if($fetchForall["Title"]=='HSC')
			{
	  ?>

		
		
	  <img src="all_image/testimonialSDMS2015.jpg" height="870" width="1000"  />
	  
	   <table  width="810" height="920" border="0"  style="margin-top:-832px; background:none; position:relative; "    cellpadding="0" cellspacing="0" >
       
		<tr>
          <td height="308" colspan="3" style="padding-top:130px; padding-left:10px; margin-top:100px;"><table width="99%" height="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="18%" rowspan="5" align="center"><img src="all_image/gov.jpg" /></td>
              <td width="65%" align="center" height="10"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; letter-spacing:1px;">Government of the People's Republic of Bangladesh</span> </td>
              <td width="17%" rowspan="5" align="center"><img src="all_image/logoSDMS2015.png"  style="height:150px; width:140px;"/></td>
            </tr>
            <tr>
              <td align="center" height="12"><span style="color:#006600; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; letter-spacing:1px;">Office of the Principal</span> </td>
            </tr>
            <tr>
              <td align="center" height="22"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:40px; font-weight:bold; letter-spacing:1px;">Feni Govt. College, Feni </span></td>
            </tr>
            <tr>
              <td height="27"  align="center" valign="top"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;">Estd.- 1922 </span></td>
            </tr>
            <tr>
              <td rowspan="2" align="center"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold; letter-spacing:1px; background:#482257; color:#FFFFFF; padding:10px; border-radius:15px;">Testimonial </span></td>
            </tr>
            <tr>
              <td height="35" align="left" valign="bottom">&nbsp;&nbsp;Sl. No. : 1700000891 </td>
              <td align="right" valign="bottom">Date : 23/02/2019 </td>
            </tr>
          </table></td>
	     </tr>

        <tr>
          <td height="330" width="905" colspan="3" style="padding-left:0px; line-height:40px;  " ><p style="padding-left:10px;font-family:sans-serif, fantasy, monospace; text-align:justify; padding-left:5px; font-size:20px; width:100%; display:block; overflow:hidden;">Certified   &nbsp;&nbsp;that &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["studentName"];
					}
					else {
						echo "";
					}
			?>   </b><br/>
		 Son/Daughter of &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php
					if(isset($fetchForall)){
						echo $fetchForall["fatherName"];
					}
					else {
						echo "";
					}
			?></b>&nbsp;&nbsp;&nbsp;&nbsp;and &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["motherName"];
					}
					else {
						echo "";
					}
			?>
		</b> <br/>
		was a student of <b> <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?> </b>  Classes this College 
		during the academic session :<b><?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?></b>.
		 
	
		<?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>
			
			
		has  passed the  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?> </b> Examination of the Board of intermediate and secondery education, Comilla in  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?> </b> bearing Roll Feni-1,No <b> <?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?></b> and Registrantion No  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?></b> 
	of session  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?></b>	in  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?>	</b> group and Secured CGPA   <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?>	</b>  in the scale  of GPA 5.00.
		 
		<br/><br/> To the best of my knowladge,<?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?> bears a good moral character.So, far as I know  <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>
		
		
	did not taken part in any activities ,
		 subversive of the sate of the college discipline.
	<br/>	I wish
		  <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "him";
				}
				else {
					echo "her";
				}
		?>
		
		
		  every success in life.</	p></td>
        </tr>
        <tr>
          <td width="905" height="217">&nbsp;</td>
          <td width="905">&nbsp;</td>
          <td width="905">&nbsp;</td>
        </tr>
      </table>
	  
	 
	  <?php } 

	  else { 

	  		?>

 <img src="all_image/testimonialSDMS2015.jpg"  style="margin-top: 7px;margin-right: 45px; height: 905px; width: 1000px;" />
	  			

	  		
	

	  	 


	     <table  width="810" height="870" border="0"  style="margin-top:-832px; background:none; position:relative; "    cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="3">
          	
 <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
        <tr>
          <td width="12%" rowspan="6" align="left"><img src="all_image/logoSDMS2015.png" style="height:140px; width:140px;"/></td>
          <td width="75%" align="center" height="10"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;">Government of the People's Republic of Bangladesh</span> </td>
          <td width="12%" rowspan="5" align="center">
          	<img src="all_image/gov.png" style="height: 120px; width: 120px;" /></td>
        </tr>
     <tr>
          <td align="center" height="12" ><span style="color:#006600; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; letter-spacing:1px;"></span> </td>
          </tr> 
        <tr>
          <td align="center" height="22"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold; letter-spacing:1px;">Chhagalnaiya Govt. Pilot High School </span></td>
        </tr>
        <tr>
          <td height="27"  align="center" valign="top"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;">P.O. & Upazilla : Chhagalnaiya, District : Feni.<br>
          	<?php
          	if($fetchForall["xx"]=='Vocational'){
	  			?>

School Code(voc) :69001, EIIN 106461
	  		<?php } else { ?>

School Code : 6900, EIIN : 106461 <?php }?> </span></td>
          </tr>
        
        <tr>
          <td rowspan="2" align="center"> <span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold; letter-spacing:1px; background:#482257; color:#FFFFFF; padding:10px; border-radius:15px;">Testimonial </span></td>
          </tr>
       
      </table>

          </td>
        </tr>
		
		 <tr>
          <td  colspan="4"> <span style="float: left; clear: right; font-size: 18px; font-weight: bold;"> Sl. No. : <?php print $_GET["stdid"] ?> </span><span style="float: right;font-size: 18px; font-weight: bold; "> Date : <?php print $_GET["date"] ?></span> </td>
          
        </tr>
        <tr>
          <td height="330" width="905px;" colspan="3" style="padding-left:0px; line-height:36px;  " >
          
          <br>
          
          <span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i><p style="padding-left:10px;font-family:sans-serif, fantasy, monospace; text-align:justify; padding-left:5px; font-size:20px; width:100%; display:block; overflow:hidden">&nbsp;&nbsp; This is to certify   &nbsp;that &nbsp;&nbsp;&nbsp;<b><?php
					if(isset($fetchForall)){
						echo $fetchForall["studentName"];
					}
					else {
						echo "";
					}
			?>   </b>
			&nbsp;&nbsp;
		S/O. : &nbsp;&nbsp;&nbsp;<b><?php
					if(isset($fetchForall)){
						echo $fetchForall["fatherName"];
					}
					else {
						echo "";
					}
			?></b>&nbsp;&nbsp;and &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["motherName"];
					}
					else {
						echo "";
					}
			?>
		</b> &nbsp;&nbsp; of Village &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["v"];
					}
					else {
						echo "";
					}
			?>
		</b> &nbsp;&nbsp;  P.O. : &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["p"];
					}
					else {
						echo "";
					}
			?>
		</b>  &nbsp;&nbsp;&nbsp; Upazilla : &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["u"];
					}
					else {
						echo "";
					}
			?>
		</b>  &nbsp;&nbsp; District : &nbsp;&nbsp;<b>
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["d"];
					}
					else {
						echo "";
					}
			?>
		</b> duly passed the Secondary School Certificate <?php
		    if($fetchForall["xx"]=='Vocational'){
		?>(Vocational)
		<?php  } ?>
		Examination in  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?> </b> in  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?></b>   Group from this school under  <?php
		    if($fetchForall["xx"]=='Vocational'){
		?> 
		BTEB, Dhaka 
		<?php }else{ ?>the B.I.S.E. Comilla<?php }  ?>
		
		bearing Roll No. :   <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?> </b> Registration No. :  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?> </b> Session : <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?> </b>and Secured GPA <b>  :&nbsp<?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
				?> </b> .
			
			
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; According to admission Register  <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "his";
				}
				else {
					echo "her";
				}
		?> date of birth is  <b>  <?php
					if(isset($fetchForall)){
						echo $fetchForall["bd"];
					}
					else {
						echo "";
					}
				?></b>.
	
	
				<br/>
		 
		So, far  my knowledge, <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "he";
				}
				else {
					echo "she";
				}
		?> bears a good moral character and is not known to have taken part in any activity against the school or of discipline. <?php
// 			if( $fetchForall["gender"] == "Male")
// 				{
// 					echo "He";
// 				}
// 				else {
// 					echo "She";
// 				}
		?> 
		<!--took part in the following other activities arranged by the school. <br/>-->
		<!--a)..............................	b)..............................	c)..............................<br>-->
	<br>	&nbsp;&nbsp;&nbsp;&nbsp; I wish 
		<?php
			if( $fetchForall["gender"] == "Male")
				{
 					echo "him";
 				}
 				else {
 					echo "her";
 				}
		?> 
		every success in life. 
		
		
		</p></span></i></td>
        </tr>

        <tr>
          <td colspan="4">
          		<table width="100%" style="margin-top:10px;">
          			<tr>
			          <td height="50" width="30%" align="lift">....................................<br>&nbsp;&nbsp;&nbsp;<span style="font-weight: bold; font-size: 20px; font-family: Arial block;"> Compared by </span></td>
			          <td width="60%" align="center"><br><span style="font-weight: bold; font-size: 20px; font-family: Arial block;"></span></td>
			          
			          <td width="30%" align="right">....................................<br><span style="font-weight: bold; font-size: 20px; font-family: Arial block;">Headmaster </span>&nbsp;&nbsp;&nbsp;</td>

			        </tr>
          	</table>
          
          </td>
          

        </tr>
        
            <tr>
          <td colspan="4">
          		
          
          </td>
          

        </tr>
        
        
        <tr>
          <td width="123" height="107">&nbsp;</td>
          <td width="335">&nbsp;</td>
          <td width="510">&nbsp;</td>
           <td></td>

        </tr>
      </table>
	  
	  
	  <?php } ?>
	  </div>
</div>
<p>&nbsp;</p>
	</center>
</html>
</body>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


