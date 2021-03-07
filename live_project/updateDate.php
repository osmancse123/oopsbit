
<?php
@error_reporting(1);
  require_once("db_connect/config.php");
  require_once("db_connect/conect.php");
    $db = new database();

$sql="SELECT * FROM `student_paid_table` WHERE `date` LIKE '%2019-04%'";

$select=$db->link->query($sql);
while($fetch=$select->fetch_array())
{
	//print $fetch[4]."<br>";

	$s=explode("-",$fetch[4]);

	 $d=$s[0].'-'.'01'.'-'.$s[2];

	$ss="UPDATE `student_paid_table` SET `date`='$d' WHERE `voucher`='".$fetch[1]."'";

	$db->link->query($ss);

}




    ?>



