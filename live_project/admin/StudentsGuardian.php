<?php
session_start();


	  require_once("../db_connect/conect.php");
	$db = new database();



function sender($url,$key,$mobile,$senderId,$sms)
{
	$data = json_encode(array('api_key' => $key,'type'=>'unicode', 'contacts' => $mobile,'senderid'=>$senderId, 'msg' => $sms));
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDpORXdRNXJRTw=="));
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
    $dd=curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //http_build_query($data). "\n";
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
}
		
		
if (isset($_POST["add"])) 
{
	$type=$_POST["type"];
	$massage=$_POST["details"];

	$query1 = "SELECT * FROM project_info";
	$sql1=$db->select_query($query1);	
	$fetc=mysqli_fetch_assoc($sql1);
	$query = "SELECT running_student_info.student_id,running_student_info.class_id,student_personal_info.contact_no FROM running_student_info INNER JOIN student_personal_info ON running_student_info.student_id=student_personal_info.id WHERE running_student_info.class_id='$type' order by id asc";
	$sql=$db->select_query($query);
	if($sql)
	
	 $rows=$sql->num_rows;
		   
for($i =0; $i <$rows;$i++ ){
           $fetch = $sql->fetch_array();
		if(isset($fetch["contact_no"])&&$fetch["contact_no"]!=""){
		    
		    
		    //	print $fetch["mobile_no"];
		$key='R60002955a9fd0aaeafad0.87230244';
 $mobile  = "88".$fetch["contact_no"]; //Receiver's country code+number
$senderId='8804445629106';// sender id number
$sms=$massage; //Double quotes are good for new line characters e.g. \n
//$sms = urlencode($sms); //Very Important Otherwise spaces shall not be parsed correctly
ini_set('allow_url_fopen',1);
$url = "http://users.sendsmsbd.com/smsapi?";
$mss=sender($url,$key,$mobile,$senderId,$sms);
if ($msg) {
	echo "Send Success";
	}	
	
	
	
}
}


	
	}
	
	
	
	
$query="select * from add_class";
$sql=$db->select_query($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar counchil membar information</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered" style="margin-top:15px;">
			<tr>
				<td>
					<span style="font-size: 20px;">Send Massage</span>
				</td>
			</tr>
			<tr>
				<td>
					<table class=" table table-bordered" style="margin-bottom: 0px;">
						<tr>
							<td width="15%;">Type</td>
							<td>
								<select name="type" class="form-control" required="">
								<option disabled="" selected="">select one</option>
									<?php
while ($fetch=mysqli_fetch_assoc($sql))
 {
	


									?>
									<option value="<?php  echo $fetch["id"]?>"><?php echo  $fetch["class_name"]?></option>
									<?php
}
									?>
								</select>
							</td>
						</tr>
		

							<tr>
							<td width="15%;">Massage</td>
							<td>
								<textarea class="form-control" name="details" style="height:300px">
									
								</textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php
									if (isset($msg)) {
										echo $msg;
									}else{
										echo $db->sms;
									}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
<input type="submit" name="add" class="btn btn-success" style="width: 120px;" value="Send">
<input type="submit" name="view" class="btn btn-danger" style="width: 120px;" value="Reset">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>




</form>
</body>
</html>