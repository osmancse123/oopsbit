
<?php
include("../db_connect/conect.php");
$db = new database();


echo $fetch[0]="";
echo $fetch[1]="";
echo $fetch[2]="";
echo $fetch[3]="";
echo $fetch[4]="";
echo $fetch[5]="";
echo $fetch[6]="";
echo $fetch[7]="";
echo $fetch[8]="";
echo $fetch[9]="";

$varRoll=mysqli_real_escape_string($db->link,isset($_POST["roll"])?$_POST["roll"]:"");
if(isset($_POST["serch"]))
{
	$sql="SELECT * FROM `certificate` where roll='$varRoll'";
    $query=$db->select_query($sql);
    $fetch=$query->fetch_array();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<form method="post">
<input type="text" name="roll" value="" class="form-control" style="max-width: 100%">
<button type="submit" name="serch">Search</button>

	<table height="300" width="700" align="center" style="border: 1px solid #000;">
		<tr>
			<td align="center"><h3>প্রত্যয়ন পত্র</h3></td>
		</tr>
		<tr>
			<td>
			<span style="margin-left: 30px;">প্রত্যয়ন করা যাইতেছে যে  &nbsp;&nbsp;<?php echo $fetch[0]; ?></span>
			</td>
		</tr>
		<tr>
			<td>পিতাঃ &nbsp;&nbsp;<?php echo $fetch[1]; ?><span style="margin-left: 250px;">মাতাঃ &nbsp;&nbsp;<?php echo $fetch[2]; ?></td>
		</tr>
		<tr>
			<td>গ্রামঃ <?php echo $fetch[3]; ?><span style="margin-left: 150px;"> ডাকঘরঃ</span> <?php echo $fetch[4]; ?> <span style="margin-left: 120px;">উপজেলাঃ </span><?php echo $fetch[5]; ?></td>
			
		</tr>
		<tr>
			<td>জেলাঃ <?php echo $fetch[6]; ?> <span style="margin-left: 150px;">। অত্র বিদ্যলয়ের</span> <?php echo $fetch[7]; ?> শ্রেণির নিয়মিত ছাত্র । তাহার</td>
		</tr>
		<tr>
			<td>রোল নংঃ <?php echo $fetch[8]; ?><span style="margin-left: 130px;">। ভর্তি বহি অনুযায়ী তাহার জন্ম তারিখঃ</span> <?php echo $fetch[9]; ?></td>
		</tr>

		<tr>
			<td><span style="margin-left: 30px;">আমি তাহার সার্বিক মঙ্ঘল কামনা করি।</span></td>
		</tr>


	</table>
	</form>
</body>
</html>