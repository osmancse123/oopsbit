<?php
	
		error_reporting(1);
		@session_start();
		if($_SESSION["logstatus"] === "Active")
		{
		require_once("../db_connect/config.php");
		require_once("../db_connect/conect.php");
		date_default_timezone_set("Asia/Dhaka");
		$db = new database();
		$adminid = $_SESSION["id"];
?>
	
		

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
	    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Change Password </strong></span><br/>
				  <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Old Password</span></strong></td>
                        <td ><div class="col-md-8">
								<input type="hidden" name="adminid" id="adminid" value="<?php echo $adminid;?>"/>
                        		<input type="text"  name="oldPassward" id="oldPassward" onKeyUp="return matchOldpass()" onChange="return matchOldpass()" />
						</div><br/><br/>
						<span id="showMassage"></span>
                    </tr>

                    <tr>
                        <td><strong><span class="text-success" style="font-size: 15px;">New Password</span></strong></td>
                        <td><div class="col-md-8"><input type="password"  name="newPass" id="newPass" />
                        </div>
                        </td>
                    </tr>

                    
                <tr>
                    <td ><strong><span class="text-success" style="font-size: 15px;">Retype Password</span></strong></td>
                        <td><div class="col-md-8"><input type="password"  name="REnewPass" id="REnewPass" onKeyUp="return passMatch()" />
                        </div><br/><br/>
						<span id="showMsg"></span>
                        </td>
                </tr>
				
				<tr>
					<Td colspan="2" align="right">
								<strong style="font-weight:bold; font-size:15px"><span id="updateSms" class="text-danger"></span></strong>
								
								
					</Td>
				</tr>
				
                <tr><td colspan="2" align="center">
				<input type="button" name="changePass" value="Change Password" class="btn btn-primary active"  style="width: 180px" onClick="return changePasss()"></input></td></tr>
                </table>
							
                </div>
				
			  </form>
 <script src="../js/bootstrap.min.js"></script>
 	<script>
		function matchOldpass(){
				$('#showMassage').show();
				var adminId=$("#adminid").val();
				var OldPassward=$("#oldPassward").val();
				//alert(OldPassward);
				if(OldPassward == ""){
					location.reload();
				}
				var chekOldPass="11";
				$.ajax({
							url:"ajaxForAdmin.php",
							type:"POST",
							data : {adminId:adminId,OldPassward:OldPassward,chekOldPass:chekOldPass},
							success : function(text)
							{
								$("#showMassage").html(text);
									
							}
					});
					
					
		}
		
		function passMatch(){
				$('#showMsg').show();
				var pass = $("#newPass").val();
				var repass = $("#REnewPass").val();
				//alert(repass);
				if(pass == ''){
						$('#showMsg').html("<strong class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Please Enter the passward..</strong>");
				}else {
						if(pass === repass){
								$('#showMsg').html("<strong class='glyphicon glyphicon-ok text-success' style='font-size:15px;font-weight:bold'>&nbsp;Passward  match..</strong>");
						}else {
							$('#showMsg').html("<strong class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Passward  don't match..</strong>");
						}
				}
				
				
		}
		
		function changePasss(){
			$('#showMassage').hide();
			$('#showMsg').hide()
			
			var pass = $("#newPass").val();
			var repass = $("#REnewPass").val();
			var adminId=$("#adminid").val();
			var OldPassward=$("#oldPassward").val();
			
			var updatePass="18";
				$.ajax({
							url:"ajaxForAdmin.php",
							type:"POST",
							data : {pass:pass,repass:repass,adminId:adminId,OldPassward:OldPassward,updatePass:updatePass},
							success : function(text)
							{
								$("#updateSms").html(text);
									
							}
					});
		}
	</script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

