<!DOCTYPE html>
<html>
<head>
	<title>calcutator</title>
</head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="row/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="row/css/froala_editor.css">

    <style type="text/css">
    	#bottom{margin-left: 10px;height: 50px;width: 40px;}
    </style>

<script type="text/javascript">

	function clickone()
	{

		var o=document.frm.operan.value;
		var h=parseInt(document.frm.hiddenval.value);
		var a=document.frm.result.value;
		if(o=="")
		{



		
		if(a=="")
		{


		 document.frm.hiddenval.value=1;
		 document.frm.result.value=1;
		}
		else
		{
			var d=a+'1';

			 document.frm.hiddenval.value=d;
			document.frm.result.value=d;

		}


    }
    else
    {
    	var z=h+1;
    	 document.frm.hiddenval.value=z;
    	 var d=a+'1';
			document.frm.result.value=d;

			

    }


	}

function operandd()
{
	var a=document.frm.result.value;
	document.frm.result.value=a+'+';
	document.frm.operan.value="+";
}

function equalResult()
{
		
		var h=document.frm.hiddenval.value;

		var a=document.frm.result.value;
		document.frm.result.value=a+'='+h;
}

</script>
<body style="background-color: #ccc;" >
	<form method="POST" name="frm">
<table class="table" align="center" style="width: 260px;background-color: #fff;margin-top: 50px;">
	<thead>
		<tr>
			<th>Calculator</th>
		</tr>
	</thead>

	<tbody>

		<tr>
			<td>


		<input type="text" name="result" value=""class="form-control" style="max-width: 200px; margin-left: 10px;"><br>


		<input type="text" name="hiddenval">
		<input type="text" name="operan">


		<input type="button" name="one" value="1" id="bottom" class="btn btn-success" onclick="return clickone()">

		<input type="button" name="two" value="2"id="bottom"class="btn btn-success "> 

		<input type="button" name="3" value="3" id="bottom"class="btn btn-success ">


		<input type="button" name="plus" value="+" class="btn btn-primary " id="bottom" style="margin-left:10px;" onclick="return operandd()"> <br><br>



		<input type="button" name="add" value="4"id="bottom"  class="btn btn-success ">

		<input type="button" name="sum" value="5"id="bottom"class="btn btn-success "> 

		<input type="button" name="sum" value="6" id="bottom"class="btn btn-success "> 


		<input type="button" name="div" value="-"class="btn btn-primary " id="bottom" style="margin-left:10px"><br><br>


		<input type="button" name="add" value="7"id="bottom" class="btn btn-success ">

		<input type="button" name="sum" value="8"id="bottom" class="btn btn-success "> 

		<input type="button" name="mul" value="9"id="bottom" class="btn btn-success">


		<input type="button" name="div" value="*"class="btn btn-primary " id="bottom" style="margin-left:10px"><br><br>


		<input type="button" name="add" value="0" id="bottom" class="btn btn-success">

		<input type="button" name="sum" value="." id="bottom"class="btn btn-success"> 
		
		<input type="button" name="sum" value="=" id="bottom"class="btn btn-success" onclick="return equalResult()"> 

		<input type="button" name="sum" value="/"class="btn btn-primary" id="bottom" style="margin-left:10px">
		

	</td>
</tr>

</tbody>
		
</table>
</form>
</body>
</html>
