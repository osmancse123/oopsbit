<?php 
	$Z=0;
	$X="";
	$Y="";
if(isset($_POST["ADD"]))
{

	$X=isset(($_POST["X"]))?$_POST["X"]:"";
	$Y=isset(($_POST["Y"]))?$_POST["Y"]:"";
	$Z=$X+$Y;


}
	if(isset($_POST["sub"]))
{

	$X=isset(($_POST["X"]))?$_POST["X"]:"";
	$Y=isset(($_POST["Y"]))?$_POST["Y"]:"";
	$Z=$X-$Y;
}

	if(isset($_POST["multi"]))
{

	$X=isset(($_POST["X"]))?$_POST["X"]:"";
	$Y=isset(($_POST["Y"]))?$_POST["Y"]:"";
	$Z=$X*$Y;

}
	if(isset($_POST["divi"]))
{

	$X=isset(($_POST["X"]))?$_POST["X"]:"";
	$Y=isset(($_POST["Y"]))?$_POST["Y"]:"";
	$Z=$X/$Y;
	
}

 ?>
<!DOCTYPE html>	
 <head>
	<title>input</title>
</head>
<body>
	<form  method="POST">


		<center>



		<table style="height:300px; width:500px; border:1px solid #ccc;">


			<tr>
				<td align="center"><input type="text" name="X" value="<?php echo $X;?>"></td>
			</tr>
			<tr>
				<td align="center"><input type="text" name="Y" value="<?php echo $Y;?>"></td>
			</tr>
			<tr>
			 <td align="center"><input type="text" name="Z" value="<?php echo $Z;?>"></td>
			</tr>


			<tr>
					<td align="center">
						<input type="submit" name="ADD" value="add">
						<input type="submit" name="sub" value="sub">
						<input type="submit" name="multi" value="multi">
						<input type="submit" name="divi" value="divi">
					</td>

			</tr>
			
		
		
		
		</table>
			



		</center>
	</form>
</body>
</html>