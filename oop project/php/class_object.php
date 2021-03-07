<?php

class basicclass
{
	
	public $c;
	function add($x,$y)
	{
	
	$c=$x+$y;
	return $c;
	}
}
$ob=new basicclass();


$m=isset($_POST["first"])?$_POST["first"]:"0";
$n=isset($_POST["second"])?$_POST["second"]:"0";
$r=$ob->add($m,$n);





?>
<!DOCTYPE html>
<html>
<head>
	<title>class_object</title>
</head>
<body>
	<form method="POST" name="" enctype="">
	<table>
		<tr>
			<td><input type="text" name="first"placeholder="<?php echo($m);?>" value=""></td>
		</tr>
		<tr>
			<td><input type="text" name="second" value="<?php echo($n);?>"></td>
		</tr>
		<tr>
			<td><input type="text" name="" value="<?php echo($r);?>"></td>
		</tr>
		<tr>
			<td><input type="submit" name="add" value="add"></td>
		</tr>
	</table>
</form>
</body>
</html>

