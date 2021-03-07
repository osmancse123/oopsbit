
<?php
error_reporting();
@session_start();
	if($_SESSION["logstatus"] === "Active")
	{      

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();
	
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
        
     <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <form name="notice" action="viewDetails.php" method="POST"  enctype="multipart/form-data" class="form-horizontal" >
	
		<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
              <table align="center" class="table table-responsive box noneBtnForprin" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
             <tr>
                <td class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
Student's  Records </span> </td>
            </tr>
			
              <tr>
                <td  class="warning" colspan="3" align="center">

                	<div class="col-md-8">
                		<label>
                			<input type="text" autocomplete="off" name="stID" class="form-control" id="stdId" placeholder='Student ID'/>
                		</label>

						<label>
							<input type="submit" name="show" value="Search" class="btn btn-success" formtarget="_blank">
						</label>


								

                </div> </td>
            </tr>			
			</table>
			</div>	
		
			<span id="showdata"></span>
	</form>
	  </body>
    </html>


<?php 
		    } 
		    else 
		    {

		    	 print "<script>location='../adminloginpanel/index.php'</script>";

		    }

?>
