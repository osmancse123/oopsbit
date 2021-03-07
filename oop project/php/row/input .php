<?php 
$z=0;
if (isset($_POST ["show"])) 
{
	$x=isset($_POST["x"])?$_POST["x"]:"";
	$y=isset($_POST["y"])?$_POST["y"]:"";
	$z=$x+$y;

}

?>

<html>
	<head>
		<title>input</title>
	</head>
	<body>
		<form method="post">
			<input type="text" name="x" value="<?php echo $x;?>" ><br>
			<input type="text" name="y" value="<?php echo $y;?>" ><br>
			<input type="submit" name="show" value="show">
			<input type="text" name="z" value="<?php echo $z;?>">
			
			
		</form>
	</body>
</html>