
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
          <td width="307" align="center">&nbsp;<span style="font-size:20px; font-weight:bold; letter-spacing:1; color:#940320; font-family:sans-serif">SOUTH BALLAVPUR HIGH SCHOOL & COLLEGE </span><br/>
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
	 

 <img src="all_image/testimonialSDMS2015.jpg"  style="margin-top: 7px;margin-right: 45px; height: 905px; width: 1000px;" />
	  			

	  		
	

	  	 


	     <table  width="810" height="870" border="0"  style="margin-top:-832px; background:none; position:relative; "    cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="3">
          	
 <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
        <tr>
          <td width="12%" rowspan="6" align="left"><img src="all_image/logoSDMS2015.png" style="height:140px; width:140px;"/></td>
          <td width="75%" align="center" height="10"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;"></span> </td>
          <td width="12%" rowspan="5" align="center">
          	<!-- <img src="all_image/gov.png" style="height: 120px; width: 120px;" /> --></td>
        </tr>
    
        <tr>
          <td align="center" height="22"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:23px; font-weight:bold; letter-spacing:1px;">SOUTH BALLAVPUR HIGH SCHOOL & COLLEGE </span></td>
        </tr>
        <tr>
          <td height="27"  align="center" valign="top"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;">P.O. Darogarhat & Upazilla : Chhagalnaiya, District : Feni.<br>
          	Estd. : 1948 </span></td>
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

			<?php
if( $fetchForall["gender"] == "Male")
				{
					echo "Son";
				}
				else {
					echo "Daughter";
				}?> 


		 of      : &nbsp;&nbsp;&nbsp;<b><?php
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
		</b> 


Bearing Registration No. :  <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
?></b>
					Roll- Chhagalnaiya No. :   <b><?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?> </b> 

			of this institute came out successfully
			in the <?php print $fetchForall["Title"]; ?> Examination of the year <b><?php
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
			?></b> group and and secured GPA <b>  :&nbsp<?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
				?> </b> .
			
			
	<br/> 


	
				<br/>
		 
		To the Best of my Knowledge <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "he";
				}
				else {
					echo "she";
				}
		?> bears a good moral character and did not take part in any activities subversive of the institution. <br>

<?php
if( $fetchForall["gender"] == "Male")
				{
					echo "His";
				}
				else {
					echo "Her";
				}?> 
date of birth is  <b>  <?php
					if(isset($fetchForall)){
						echo $fetchForall["bd"];
					}
					else {
						echo "";
					}
				?></b>.

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
          		<table width="100%" style="margin-top:20px;">
          			<tr>
			          <td height="50" width="30%" align="lift">....................................<br>&nbsp;&nbsp;&nbsp;<span style="font-weight: bold; font-size: 20px; font-family: Arial block;"> Compared by </span></td>
			          <td width="30%" align="center"><br><span style="font-weight: bold; font-size: 20px; font-family: Arial block;"></span></td>
			          
			          <td width="30%" align="right">........................................................................<br>

			          	<span style="font-weight: bold; font-size: 20px; font-family: Arial block;">Principal </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>South Ballavpur High School & College</p>

			          </td>

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
	  

	  </div>
</div>
<p>&nbsp;</p>
	</center>
</html>
</body>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


