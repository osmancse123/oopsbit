<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	@session_start();
	$db = new database();
	unset($_SESSION["logstatus"]);
	unset($_SESSION["id"]);
	unset($_SESSION["name"]);
	unset($_SESSION["type"]);
	
//$user_name="anik";
//$passward="anik";
if(isset($_POST['login']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
			$sql="SELECT * FROM `admin_users` WHERE `email`='".$_POST["email"]."'";		
			
			$result=$db->select_query($sql);
				

        
		if($result){
			$fetchARra=$result->fetch_array();
			$hash=crypt($_POST['password'],$fetchARra["pass"]);
			//print $hash; 
			if($hash === $fetchARra["pass"]){
					$_SESSION["logstatus"]=$fetchARra["status"];
					$_SESSION["name"]=$fetchARra["Name"];
					$_SESSION["id"]=$fetchARra["id"];
					$_SESSION["type"]=$fetchARra["type"];
					header('location:../admin/index.php');
			}
				 else
			{
				$message="<span style='color: RED; font-size: 18px;'>Sorry Check Your Email && Password.</span>";   
			}
        }
       
   }
    else
    {
        $message="<span style='color: RED; font-size: 18px;'>Please Fill Out All Field.</span>";    
    }
}
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
    
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      
<title>Login Panel</title>
<link rel="shortcut icon" href="../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />

<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		
        <link rel="stylesheet" href="../css/normalize.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="NetFile/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="NetFile/bootstrap-theme.min.css">
		
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/owl.carousel.css">
		<link rel="stylesheet" href="../css/owl.theme.css">
		<link rel="stylesheet" href="../css/lightbox.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/anmatecss.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
	<a href="../">Back</a>
	
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
           <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                      <form id="loginform" class="form-horizontal" role="form" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="email" type="text" required class="form-control" id="login-username" placeholder="username or email" autocomplete="off">                                        
                                  </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="password" type="password" required class="form-control" id="login-password" placeholder="password" autocomplete="off" >
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                    
									  <input type="submit" name="login" value="Login" id="btn-fblogin" class="btn btn-primary" style="width:200px;">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        <?php
                                        if(isset($_POST['login']))
										{
											echo $message;
										}
										else
										{
										?>
                                            Don't Have an Account Contact Administrator! 
                                        <?php
										}
										?>
                                       <!-- <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>-->
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
         <script src="NetFile/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <!-- Latest compiled and minified JavaScript -->
		<script src="NetFile/bootstrap.min.js"></script>
		<script src="../js/jquery.ticker.min.js"></script>
		<script type="text/javascript" src="../js/jquery.bootstrap.newsbox.min.js"></script>
		<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="../js/lightbox.min.js"></script>
		<script type="text/javascript" src="../js/mainn.js"></script>
		<script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
		


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
<?php
//mysql_close();
@ob_end_flush();
?>