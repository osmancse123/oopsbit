<?php
  require_once("../../db_connect/conect.php");
    $db = new database();
	$id =json_decode($_GET["id"]);
$vou =json_decode($_GET["Lid"]);

$selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);
$selTea="select * from teachers_information where teachers_id='$id'";
$queTeac=$db->select_query($selTea);
if($queTeac)
{
$fetchTeac=mysqli_fetch_assoc($queTeac);

$selTeaa="select * from teacher_payment_history where id='$vou'";
$queTeaca=$db->select_query($selTeaa);
if($queTeac)
{
$fetchTeaca=mysqli_fetch_assoc($queTeaca);
?>
<?php
$a=0;
for ($j=0; $j <2 ; $j++)
 { 

$a++;
?>
<style type="text/css">
<!--
li{list-style:none;}
.style1 {color: #003366; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;margin-left:10px;}
-->
</style>

<table width="486" height="337" border="1" align="center" cellpadding="0" cellspacing="0" style="float:left; clear:right; margin-left:20px;">
  <tr>
    <td height="78" colspan="4">
	<li style="width:76; float:left; clear:right; margin-left:10px;"><img src="../all_image/Logo.png" width="76" height="74"/></li>
	 <ul style="float:left; clear:right; margin-left:-10px;">
	  
	  <li style="color:#000000;font-family:Algerian; text-shadow:0px 0px 2px #ccc; font-size:20px;"><?php echo $fetchApp["institute_name_en"]?></li>
	 <li><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["address_en"]?></p></li>
	  <li style="margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"]?></li>
      </ul>	</td>
  </tr>
    <tr>
    <td width="65" height="28"><span class="style1">Month</span></td>
    <td colspan="3">&nbsp;
	
	<?php 

if ($fetchTeaca["month"]=="Jan") {
	echo "January";
}
else if ($fetchTeaca["month"]=="Feb") {
	echo "February";
}
else if ($fetchTeaca["month"]=="Mar") {
	echo "March";
}
else if ($fetchTeaca["month"]=="Apr") {
	echo "April";
}
else if ($fetchTeaca["month"]=="May") {
	echo "May";
}
else if ($fetchTeaca["month"]=="Jun") {
	echo "June";
}
else if ($fetchTeaca["month"]=="Jul") {
	echo "July";
}
else if ($fetchTeaca["month"]=="Aug") {
	echo "August";
}
else if ($fetchTeaca["month"]=="Sep") {
	echo "September";
}
else if ($fetchTeaca["month"]=="Oct") {
	echo "October";
}
else if ($fetchTeaca["month"]=="Nov") {
	echo "November";
}
else if ($fetchTeaca["month"]=="Dec") {
	echo "December";
}
else {
	echo $fetchTeaca["month"];
}
?>-<?php echo $fetchTeaca["year"]; ?>
	</td>
  </tr>
  <tr>
    <td width="65" height="35"><span class="style1">Receipt</span></td>
    <td width="165">&nbsp;<?php echo $fetchTeaca["id"] ?></td>
    <td width="91"><span class="style1">Date</span></td>
    <td width="144">&nbsp;<?php echo $fetchTeaca["date"] ?></td>
  </tr>
  <tr>
    <td height="31"><span class="style1">Name</span></td>
    <td>&nbsp; <?php echo $fetchTeac["teachers_name"] ?></td>
    <td><span class="style1">Phone</span></td>
    <td>&nbsp; <?php echo $fetchTeac["mobile_no"] ?></td>
  </tr>
  <tr>
    <td height="31"><span class="style1">ID</span></td>
    <td>&nbsp;<?php echo $fetchTeac["teachers_id"] ?></td>
    <td><span class="style1">Designation</span></td>
    <td>&nbsp;<?php echo $fetchTeac["designation"] ?></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2">&nbsp;</td>
    <td height="31"><span class="style1">Total Salary </span></td>
    <td>&nbsp;<?php echo $fetchTeaca["current_amount"] ?></td>
  </tr>
  
  <tr>
    <td height="36"><span class="style1">Withdrawa</span></td>
    <td>&nbsp;<?php echo $fetchTeaca["payment_amout"] ?></td>
  </tr>
  <tr>
    <td height="63" colspan="4"><b style="margin-left:20px;">Accounter</b> <b style="margin-left:320px;">Teacher</b> </td>
  </tr>
</table>
<?php
}}}

?>