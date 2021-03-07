
<?php
	error_reporting(1);
@session_start();


	
@date_default_timezone_set('Asia/Dhaka');
require_once("../../db_connect/config.php");
	require_once("../../db_connect/conect.php");

	$db = new database();
	
    /*unset($_SESSION["userlogin"]);
	unset($_SESSION["useridid"]);*/

	
	
	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}

if(isset($_POST["login"])){
	if(!empty($_POST["ID"]) && !empty($_POST["password"])){
	    
	
	     
		$sql = "SELECT * FROM `reg_student_passward` WHERE `studentId`='".$_POST["ID"]."' AND `passward`='".$_POST["password"]."'";
		$resultSql = $db->select_query($sql);
			if($resultSql->num_rows > 0){
			
					$_SESSION["userlogin"]='1';
					$_SESSION["useridid"]=$_POST["ID"];

					print header('location:../admit/admit.php');
					
					}else{
						
						print "<script>alert('Wrong User and Password..');</script>";
					}
      		
					
		}else{
			print "<script>alert('Please Enter The ID And Password');</script>";
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     	 <meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../../../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
<link href="signin.css" rel="stylesheet">
</head>

<body>
<script>
	$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
<div class="login-page">
  <div class="form">
    <form class="register-form" action="" method="post">
      <input type="text" placeholder="name"/>
      <input type="password" name="passward" placeholder="password"/>
      <input type="text" placeholder="email address" name=""/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="" method="post">
      <input type="text" placeholder="ID" name="ID"/>
      <input type="password" placeholder="password" name="password"/>
      <button type="submit" name="login" >login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>

</body>
</html>
