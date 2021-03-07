<?php
	error_reporting(1);
	@session_start();
	
	if(isset($_POST["logOUt"]))
	{
		unset($_SESSION["logstatus"]);
	}
	
	if($_SESSION["logstatus"] === "Active")
	{
		require_once("../db_connect/config.php");
		require_once("../db_connect/conect.php");
		$db = new database();
		
		$projectinfo="SELECT  * FROM `project_info`";
		$result=$db->select_query($projectinfo);
		if($result>0){
			$fetch_result=$result->fetch_array();
		}
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>এডমিন পেনেল || <?php if(isset($fetch_result)){ echo $fetch_result["title"];} else {echo "";}?></title>
	<link rel="shortcut icon" href="all_image/<?php echo "shortcurt_iconSDMS2015"?>.png" />
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <form name="" action="" method="post">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>&nbsp;Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  



                                 <?php
                $pathdocument=$_SESSION["id"].".jpg";
                

                if (file_exists('../other_img/'.$pathdocument)) 
                {?>

                  <img src="../other_img/<?php echo $_SESSION["id"];?>.jpg"  class="user-image" alt="User Image">

              <?php  } 
                else {?>

                 <img src="../other_img/male.png"  class="user-image" alt="User Image" >

                <?php }
          ?>



                  <span class="hidden-xs"><?php echo $_SESSION["name"];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">


                    

                        <?php
                $pathdocument=$_SESSION["id"].".jpg";
                

                if (file_exists('../other_img/'.$pathdocument)) 
                {?>

                  <img src="../other_img/<?php echo $_SESSION["id"];?>.jpg" class="img-circle" alt="User Image">

              <?php  } 
                else {?>

                 <img src="../other_img/male.png" class="img-circle" alt="User Image">

                <?php }
          ?>



                    <p>
                      <?php echo $_SESSION["name"];?> - <?php if($_SESSION["id"]=="306"){ echo "Software Company";}else {echo "Member of &nbsp;	".$fetch_result["title"];} ?>
                      <small> <?php if($_SESSION["id"]=="306"){ ?>since Jan. 2011<?php } ?></small>
                    </p>
                  </li>
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                     <input type="submit" name="logOUt" class="btn btn-danger "  value="Sign Out" />
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
		  <?php 
		  	if($_SESSION["id"]=="306"){
		  ?>
           <li class="header">Developer LINK</li>
          <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Developer LINK</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Main_Link_Add.php" target="adminbody"><i class="fa fa-circle-o"></i> Add Main Link</a></li>
                <li><a href="Sub_Link_Add.php" target="adminbody" ><i class="fa fa-circle-o"></i> Add Sub Link</a></li>
				      <li><a href="Add_classSection.php" target="adminbody"><i class="fa fa-circle-o"></i>Add Class Section </a></li>
                <li><a href="Add_class.php" target="adminbody"><i class="fa fa-circle-o"></i>Add class</a></li>
                <li><a href="project.php" target="adminbody"><i class="fa fa-circle-o"></i>Project Info</a></li>

              </ul>
            </li>
		<?php } ?>
			<?php
			if($_SESSION["id"]=="306"){
					$select_dev_link="SELECT * FROM `main_link_info` GROUP BY `type` ORDER BY `SLNO` ASC";
					}else {
								$select_dev_link="SELECT `main_link_piority`.`Main_Link_id`,`main_link_info`.`type` FROM `main_link_piority`
INNER JOIN `main_link_info` ON `main_link_info`.`Main_Link_Id`=`main_link_piority`.`Main_Link_id`
WHERE `main_link_piority`.`adminId`='".$_SESSION["id"]."' GROUP BY `main_link_info`.`type`  ORDER BY `main_link_info`.`SLNO` ASC";
					}
					$chek_dev_link=$db->select_query($select_dev_link);
					if($chek_dev_link){
					while($fetch_link=$chek_dev_link->fetch_array()){
			
			?>
           
			<li class="header"><?php echo $fetch_link["type"]; ?></li>
           	
			<?php
					if($_SESSION["id"]=="306"){
						
						$select_main_link="SELECT * FROM `main_link_info`WHERE `type`='".$fetch_link["type"]."' ORDER BY `SLNO` ASC";
					}
					else {
						
						$select_main_link="SELECT `main_link_piority`.*,`main_link_info`.`Main_Link_Name`,`Page_Name`,`type` FROM `main_link_info` 
INNER JOIN `main_link_piority` ON `main_link_piority`.`Main_Link_id`=`main_link_info`.`Main_Link_Id`
WHERE `main_link_piority`.`adminId`='".$_SESSION["id"]."' AND  `main_link_info`.`type`='$fetch_link[type]' ORDER BY `main_link_info`.`SLNO` ASC ";
					}
			
					$chek_main_link=$db->select_query($select_main_link);
					if($chek_main_link){
					while($fetch_main_link=$chek_main_link->fetch_array()){
					if($fetch_main_link["Page_Name"] == '#')
					{
					
					
		
					
			?>
		
			<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span> <?php  echo $fetch_main_link["Main_Link_Name"];?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <?php  
						if($_SESSION["id"]=="306"){
							
							$select_sub_link="SELECT * FROM  `sub_link_info` WHERE `Main_Link`='".$fetch_main_link[1]."' ORDER BY `Sl_No` ASC";
						}else{
							
							$select_sub_link="SELECT `sublinkpeority`.*,`sub_link_info`.`Sub_Link_Name`,`Sub_Page_Name` FROM `sublinkpeority`
INNER JOIN `sub_link_info` ON `sub_link_info`.`Sub_Link_Id`=`sublinkpeority`.`sublinkId` WHERE 
`sublinkpeority`.`AdminId`='".$_SESSION["id"]."' AND `sub_link_info`.`Main_Link`='$fetch_main_link[1]' GROUP BY `sub_link_info`.`Sub_Link_Id` ORDER BY `sub_link_info`.`Sl_No` ASC";
						}
				 		
						$chek_Sub_link=$db->select_query($select_sub_link);
						if($chek_Sub_link)
						{
						while($fetch_sub_link=$chek_Sub_link->fetch_array()){
				 ?>
				 
				 <li>


          <a href="<?php echo $fetch_sub_link["Sub_Page_Name"];?>" 
              <?php
                if($fetch_sub_link["Sub_Page_Name"]=="ViewOnlineApplier.php")
                {
                        ?>
                              target="_blank"
                        <?php
                }
                else
                {
              ?>
            target="adminbody"

            <?php
                }
            ?>
            ><i class="fa fa-circle-o text-red"></i> <span><?php echo $fetch_sub_link["Sub_Link_Name"];?></span></a>

        </li>
                 <?php  } }?>
                
              </ul>
            </li>
			   
			
					<?php } else {?>
					<li><a href="<?php echo $fetch_main_link[3];?>" target="adminbody"><i class="fa fa-book"></i> <span><?php echo $fetch_main_link[2];?></span></a></li>
				<?php } } } } }?>
					
						 <li><a href="ClassWiseMeritList.php" target="adminbody"><i class="fa fa-book"></i> <span>Class Wise Merit List</span></a></li> 
						 	 <li><a href="sectionWiseMeriteList.php" target="adminbody"><i class="fa fa-book"></i> <span>Section Wise Merit List</span></a></li> 
					 <li><a href="CombinedMarksheet.php" target="adminbody"><i class="fa fa-book"></i> <span>Combined Marksheet</span></a></li> 
			


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="../" target="_blank" class="btn btn-default "><i class="fa fa-dashboard"></i> Home </a>
            </li>
            <li>

              <input type="submit" name="logOUt" value="Log Out" class="btn btn-danger "/></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12" style="height: 2300px;">
                    <!-- IFRAME -->
                    <iframe 
				src="About_School.php" name="adminbody" height="100%" width="100%"  allowtransparency="1" frameborder="1" scrolling="yes" id="iframe" onload='javascript:resizeIframe(this);' style="border:0px; margin-top:5px;">

                      
                     </iframe>

                     <!-- IFRAME -->
            </div>
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b> 
         </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://sbit.com.bd/"><?php echo $_SESSION["name"];?></a>.</strong> All rights reserved.
      </footer>

     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	</form>
	
	  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

