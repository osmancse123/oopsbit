<?php

//class phpobj
//{
//	public $a;
//	public $b;
//	public $c;
//	function add($X,$Y)
//	{
//		$a=$X;
//		$b=$Y;
//		$c=$a+$b;
//		return $c;
//	}
//}
//$ob=new phpobj();
//$Result=$ob->add(50,50);

//echo "$Result";

	$Result="";
class phpobj
{
	public $a;
	public $b;
	public $c;
	function add($X,$Y)
	{
		$a=$X;
		$b=$Y;
		$c=$a+$b;
		return $c;
	}	function sub($X,$Y)
	{
		$a=$X;
		$b=$Y;
		$c=$a-$b;
		return $c;
	}	function div($X,$Y)
	{
		$a=$X;
		$b=$Y;
		$c=$a/$b;
		return $c;
	}
}

$ob=new phpobj();

$AA=isset($_POST["A"])? $_POST["A"]:"";
$BB=isset($_POST["B"])? $_POST["B"]:"";

if(isset($_POST["Show"]))
{
	$Result=$ob->add($AA,$BB);	
}

if(isset($_POST["sub"]))
{
	$Result=$ob->sub($AA,$BB);	
}


if(isset($_POST["div"]))
{
	$Result=$ob->div($AA,$BB);	
}




?>




<!DOCTYPE html>
<html>
<head>
	<title>Class</title>
</head>
<body>


	<form method="POST">

		<input type="text" name="A" value="<?php echo $AA  ?>"><br>
		<input type="text" name="B" value="<?php echo $BB  ?>"><br>
		<input type="text" name="C" value="<?php echo $Result  ?>"><br>
		<input type="submit" name="Show" value="add">
		<input type="submit" name="sub" value="Sub">
		<input type="submit" name="div" value="Div">
		
	</form>

</body>
</html>
