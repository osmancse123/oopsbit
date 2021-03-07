<?php  
 if (isset($_POST["add"]))
 {
 	$sum=0;
 	$c=count($_POST["x"]);
 	for ($i=0; $i <$c ; $i++) 
 	{ 
 		$v=$_POST["x"] [$i];
 		?>
 		<br><?php
 		print "result :$v";
 	}
 
 }

?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.0-beta.0/css/froala_editor.css">
<body>
<form method="POST" >
	<table class="table table-bordered" align="center" style="width: 50%">
		<thead>
			<tr>
				<th>Martsheet</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="text" name="x" class="form-control"  style="max-width:100%;" align="center">
					<input type="submit" name="show" value="show">
				</td>
			</tr>
			<tr>
				<td>
					
					<?php
					if (isset($_POST["show"]))
					 {
					 	
					 
					$x=isset($_POST["x"])?$_POST["x"]:"";

					for ($i=0; $i <$x ; $i++) 
					{
					 ?>
					<br><br><input type="text" name="x[] "class="form-control" style="width: 20%;" />
					<?php 
					}
					?>
					<br><input type="submit" name="add" value="add">
					<?php
					} 
					 ?>
				</td>
			</tr>
		</tbody>
	
	
	 </table>
</form>
</body>
</html>