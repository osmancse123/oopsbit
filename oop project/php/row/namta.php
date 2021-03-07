<?php 
$z=0;
if (isset($_POST ["show"])) 
{
	$x=isset($_POST["x"])?$_POST["x"]:"";
	
	for ($i = 1; $i <= 10; $i++) 
	{
		$z=$x*$i;

	
	echo "<br>$x*$i=$z";
	}

}

?>

<html>
	<head>
		<title>input</title>
	</head>
	<body>
		<form method="post">
			<input type="text" name="x" value="" ><br>
			<input type="submit" name="show" value="show">
		</form>
	</body>
</html>