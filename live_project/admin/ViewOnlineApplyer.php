
<?php
require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	/*error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	
	$id=$db->autogenerat('admin_users','id','ADMIN-','10');
	if(isset($_POST["save"])){
		if(!empty($_POST["linkID"])){
		if(isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["Email"]) && !empty($_POST["Email"]) && isset($_POST["admintype"]) && !empty($_POST["admintype"]) && isset($_POST["Passward"]) && !empty($_POST["Passward"]) && isset($_POST["RePassward"]) && !empty($_POST["RePassward"])&& isset($_POST["status"]) && !empty($_POST["status"]) ){
		
			if($_POST["Passward"] === $_POST["RePassward"]){
				$pass=$db->passward_encrypt($_POST["Passward"]);
				$Repass=$db->passward_encrypt($_POST["RePassward"]);
				$countmainLink=count($_POST["linkID"]);
				print $countmainLink."<br/>";
				$coutsublink=count($_POST["SublinkID"]);
				print $coutsublink."<br/>";
				$counsublink=count($_POST[""]);
					$insertsql="INSERT INTO `admin_users` (`id`,`Name`,`email`,`status`,`type`,`pass`,`repass`) VALUES('$id','$_POST[name]','$_POST[Email]','$_POST[status]','$_POST[admintype]','$pass','$Repass')";
					$chek=$db->insert_query($insertsql);
					$Paht="../other_img/".$id.".jpg";
					move_uploaded_file($_FILES["file"]["tmp_name"],$Paht);
					
					for($x=0; $x<$countmainLink;$x++){
						$minInsert="INSERT INTO `main_link_piority` (`adminId`,`Main_Link_id`) VALUES ('$id','".$_POST["linkID"][$x]."')";
						$resultmain=$db->insert_query($minInsert);
					}
					
					for($z=0; $z<$coutsublink; $z++){
							$explodevale=explode('and',$_POST["SublinkID"][$z]);
							$insertsublink="INSERT INTO `sublinkpeority` (`AdminId`,`MainLinkID`,`sublinkId`) VALUES ('$id','$explodevale[0]','$explodevale[1]')";
							$resultInsertlink=$db->insert_query($insertsublink);
					}
			
			}
			
		}
		}else{
		
				$sms="<script>alert('Please Select Link...')</script>";
		}
	}*/
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
	 </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
				<div class="col-md-12 col-lg-12" id="load-data-here" style="margin-top:10px;">
					
				</div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
 <script>
 			/*	$(document).ready(function(){
						var response = '';
						var id ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForAdmin.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});

            
           	 });*/
			 function selectAll(){
			 	var response = '';
						var id ="dd";
						$.ajax({ type: "GET",   
								 url: "ajaxForOnlineApplier.php",   
								 data:{id:id},
								 async: false,
								 success : function(text)
								 {
									$("#load-data-here").html(text);
								 }
						});
			 }
			 selectAll();
			
			function creatAdmin(){
						var Notid ="ddd"; 
					$.ajax({
							url:"ajaxForAdmin.php",
							type:"POST",
							data : {Notid:Notid},
							 success : function(text)
							{
									$("#load-data-here").html(text);
								}
							
					});	
			}
			
			function viewShowImage(e){
		var file = e.files[0];
			var imagefile = file.type;		
			var type = ["image/jpeg","image/png","image/jpg"];
			if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2]){
				var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
			}else{
				alert("Please select a vild image");
			}
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
				//$("#textt").text("Selected Image : ");
                $("#preview").attr('src',e.target.result);
				$("#preview").css('height','60px');
            }
			}
			
			$(":file").filestyle();
			
			
			function check_all()
			{
			
			if($('#chkbx_all').is(':checked')){
				$('input.check_elmnt2').prop('disabled', false);
				$('input.check_elmnt').prop('checked', true);
				$('input.check_elmnt2').prop('checked', true);
			}else{
				$('input.check_elmnt2').prop('disabled', true);
				$('input.check_elmnt').prop('checked', false);
				$('input.check_elmnt2').prop('checked', false);
				}
		}	
		
		
		function deleteFunction(){
				
				var chekvalue = [];
				$('.chek').each(function(){
					if($(this).is(":checked"))
					{
						chekvalue.push($(this).val());
					}
				
				});
				var chekid="10";
				$.ajax({
							url:"ajaxForAdmin.php",
							type:"POST",
							data : {chekid:chekid,chekvalue:chekvalue},
							success : function(text)
							{
									//alert(text);
									selectAll();
							}
							
					});	
				
		}
		
		function ADfun(id)
		{
			
			var status=$("#deactive-"+id).val();
			var Adminid = id;
			var chek="10";
				$.ajax({
							url:"ajaxForAdmin.php",
							type:"POST",
							data : {status:status,Adminid:Adminid,chek:chek},
							success : function(text)
							{
									//alert(text);
									selectAll();
							}
							
					});	
			
		}
		function passMatch(){
				var pass = $("#Passward").val();
				var repass = $("#RePassward").val();
				//alert(repass);
				if(pass == ""){
					$('#showMsg').html("<strong class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Please Enter the passward..</strong>");
				}else if(repass == ""){
					$('#showMsg').html("");
				}
				else if(pass ===  repass) {
					$('#showMsg').html("<strong class='glyphicon glyphicon-ok text-success' style='font-size:15px;font-weight:bold'>&nbsp;Passward  match..</strong>");
				}
				else if(pass != repass){
					$('#showMsg').html("<strong class='glyphicon glyphicon-remove text-danger' style='font-size:15px;font-weight:bold'>&nbsp;Passward  don't match..</strong>");
				}
		}
		
	function chekMain(getID){
					
					if($('#linkID-'+getID).is(':checked')){
						$("input#sublinkID-"+getID).prop('disabled', false);
						$("input#sublinkID-"+getID).prop('checked', true);
					
					}else{
						$("input#sublinkID-"+getID).prop('disabled', true);
						$("input#sublinkID-"+getID).prop('checked', false);
					
					}
			
				}
 </script>
  </body>
</html>
