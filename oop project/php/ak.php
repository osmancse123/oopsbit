<?php
$a="";
 	 class basic
 	 {	
 	 	function namta($x)
 	 	{
 	 		$t="";
 	 		for ($i=1; $i <=10 ; $i++) 
 	 		{ 
 	 			$c=$x*$i;
 	 			$t.="<br>$x*$i=$c";
 	 		}
 	 		return $t;
 	 	}

 	 } 

 	 $ob=new basic();
 	 $m=isset($_POST["m"])?$_POST["m"]:"0";

 	 if(isset($_POST["Show"]))
 	 {
 	 	$a=$ob->namta($m);

 	 }
 	
 	 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Namta</title>
</head>
<body>
	<form name="" method="POST" enctype="">
		<table>
			<tr>
				<td>
					<input type="text" name="m">
					


				</td>
			</tr>
			<tr>
				<td>

					<input type="submit" name="Show" value="Show">
<?php print $a;?>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>