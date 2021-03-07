
<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{      require_once("../db_connect/config.php");
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

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
   
function showIdby(){
  var showdata = "ddddddd";
  var stdId = 	$('#stdId').val();
    var year = 	$('#year').val();

  //alert(stdId);
		$.ajax({
				url:"showstudentAccountrecord.php",
				type:"POST",
				data:{showdata:showdata,stdId:stdId,year:year},
				cache:false,
				success:function(data){
					//alert(data);
					$('#showdata').html(data);
					
					
				
					
				}
			});
}


      </script>
	  
	
    </head>
    <body>
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
	
		<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
              <table align="center" class="table table-responsive box noneBtnForprin" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
                            <tr>
                <td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
Single Student's  Account Records </span> </td>
            </tr>
			
              <tr>
                <td  class="warning" colspan="3" align="center">
				<div class="col-md-4" style="text-align:right">
				
								<input type="text" autocomplete="off" name="year" class="form-control" id="year" placeholder='<?php echo date('Y') ?>' style="border-radius:0px;"/>
								&nbsp; &nbsp; &nbsp; &nbsp; 
								
							
								
							
                </div>
				
				<div class="col-md-6" style="text-align:right">
				
								<input type="text" autocomplete="off" name="stdId" class="form-control" id="stdId" placeholder='Student ID' style="border-radius:0px;"/>
								&nbsp; &nbsp; &nbsp; &nbsp; 
								
							
								
							
                </div>
				
				
					<div class="col-md-2" style="text-align:left">
						<input type="button" name="submit" value="Submit" onclick="return showIdby()" style="display:inline; border-radius:0px;" class="btn btn-danger btn-sm" />
					</div>
				 </td>
            </tr>			
			</table>
			</div>	
		
			<span id="showdata"></span>
	</form>
	  </body>
    </html>
		    					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
