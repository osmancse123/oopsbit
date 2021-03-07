
<?php
class basic
{
	
	
	
	function namta($x)
	{	$t="";
		$a=$x;
	for ($i=1; $i <=10 ; $i++) 
	{ 
		$c=$a*$i;
		$t.="<br>$x*$i=$c";
	}
		return $t;
	}
}
	$ob=new basic();
	$e=isset($_POST["f"])?$_POST["f"]:"0";
	$add=$ob->namta($e)
?>



<!DOCTYPE html>
<html>
<head>
	<title>object</title>
</head>
<body>
	<form method="POST">
<input type="text" name="f" value="<?php print $e ;?>"><br>

<input type="submit" name="add" value="add">

<br>
<br><?php print $add ;?>
</form>

</body>
</html>