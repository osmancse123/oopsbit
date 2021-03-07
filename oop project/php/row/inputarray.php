<?php  
 if (isset($_POST["add"]))
 {
 	$sum=0;
 	$c=count($_POST["x"]);
 	for ($i=0; $i <$c ; $i++) 
 	{ 
 		$v=$_POST["x"] [$i];
 		$sum=$sum+$v;
 	}
 	print "result :$sum";
 }

?>



<!DOCTYPE html>
<html>
<head>
	<title>input</title>
</head>
<body>
<form method="POST" >
	<input type="text" name="x">
	<input type="submit" name="show" value="show">
	<br>
	<?php
	if (isset($_POST["show"]))
	 {
	 	
	 
	$x=isset($_POST["x"])?$_POST["x"]:"";

	for ($i=0; $i <$x ; $i++) 
	{
	 ?>
		<br><br><input type="text" name="x[]"/>
	<?php 
	}
	?>
	<br><input type="submit" name="add" value="add">
	<?php
	} 
	 ?>
	 
</form>
</body>
</html>