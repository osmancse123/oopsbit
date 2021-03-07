
<?php

	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
       	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     	 <meta name="Description" content="" />
		 <title>Attendance System</title>
		<link rel="shortcut icon" href="img/incon.jpg" />
		
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
	
	</head>
	<body>
	   
	   
	    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="">
                  <img src="../all_image/logoSDMS2015.png" alt="FCI logo" height="30">
              </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="../">Home</a></li>
                <li><a href="../Student'sAttendance.php" target="ifrmae">Student Attendance </a></li> 
				<?php
					if($_SESSION["type"] == "Main Admin"){
				?>
				
				 <li><a href="../Teacher'sAttendance.php" target="ifrmae">Teacher's Attendance </a></li> 
				  <li><a href="../StruffAttendance.php" target="ifrmae">Staff Attendance </a></li> 
				   <li><a href="../DateWiseStudentAttendanceReport.php" target="ifrmae">Student  Report </a></li> 
				    <li><a href="../Teacher'sAttendanceReport.php" target="ifrmae">Teacher's    Report </a></li> 
					 <li><a href="../DateWiseTeacher'sAttendanceReport.php" target="ifrmae">Monthly  Teacher's </a></li> 
					  <li><a href="../DateWiseStrffAttendanceReport.php" target="ifrmae">Monthly Staff </a></li> 
					   <li><a href="../attendancerportall.php" target="ifrmae">ALL Attendence Report  </a></li> 
					   
					   
					   <?php } ?>
					   	
					     <li><a href="../../login/">LogOut  </a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
               <!-- <li><a href="index.php?page=logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>-->
              </ul>
            </div>
          </div>
        </nav>
		
		
		<div class="col-md-12">
					<iframe src="../Student'sAttendance.php" name="ifrmae" style="height:800px; width:100%"></iframe>
					
		</div>
		
		
		<div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 navbar-default" style="color:#000;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left:0px; padding-top:25px; padding-bottom:25px;">
                    <b>Copyright &copy; PSC</a></b>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" align="right"  style="padding-left:0px;  padding-top:10px;  padding-bottom:10px;">
                    Developed by <a href="http://www.sbit.com.bd/" target="_blank">
                            <img src="http://asktechmate.com/public/AllImgae/developer.jpg" style="height: 50px;" alt="logo">
                        </a>
                </div>
            </div>
        </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
	
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	
		
	</body>
</html>

<?php } else { print "<script>location='../../login/index.php'</script>";}?>
