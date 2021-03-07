<?php

$add="";
class basic
{
	public $a;
	public $b;
	public $c;
	function add($x,$y)
	{
		$a=$x;
		$b=$y;
		$c=$a+$b;
		return $c;
	}
	function sum($x,$y)
	{
		$a=$x;
		$b=$y;
		$c=$a-$b;
		return $c;
	}
	function mul($x,$y)
	{
		$a=$x;
		$b=$y;
		$c=$a*$b;
		return $c;
	}
	function div($x,$y)
	{
		$a=$x;
		$b=$y;
		$c=$a/$b;
		return $c;
	}
}
	$ob=new basic();
	$e=isset($_POST["f"])?$_POST["f"]:"";
	$d=isset($_POST["d"])?$_POST["d"]:"";
	if (isset($_POST["add"])) 
	{
		$add=$ob->add($e,$d);
	}

	if (isset($_POST["sum"])) 
	{
		$add=$ob->sum($e,$d);
	}

	if (isset($_POST["mul"])) 
	{
		$add=$ob->mul($e,$d);
	}

	if (isset($_POST["div"])) 
	{
		$add=$ob->div($e,$d);
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>object</title>
</head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="row/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="row/css/froala_editor.css">



<body style="background-color: #ccc;" >
	<form method="POST">
<table class="table table-bordered" align="center" style="width: 300px;background-color: #fff;margin-top: 50px;">
	<thead>
		<tr>
			<th>Calculation</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>


		<input type="text" name="f" value="<?php echo $e?>"class="form-control"><br>

		<input type="text" name="d" value="<?php echo $d?>"class="form-control"><br>

		<input type="text" name="" value="<?php echo $add?>"class="form-control"><br>



		<input type="submit" name="add" value="+" class="btn btn-success ">

		<input type="submit" name="sum" value="-"class="btn btn-success "> 

		<input type="submit" name="mul" value="*"class="btn btn-success ">

		<input type="submit" name="div" value="/"class="btn btn-success ">



	</td>
</tr>
</tbody>
		
</table>
</form>
</body>
</html>