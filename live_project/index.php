<?php
error_reporting(1);
@session_start();
@date_default_timezone_set('Asia/Dhaka');

require_once("db_connect/config.php");
require_once("db_connect/conect.php");
$db = new database();
	unset($_SESSION['path']);
	  $path="other_img/";
	  $_SESSION['path']=$path;
?>
<?php

$projectinfo="SELECT * FROM project_info";
	$relproject=$db->select_query($projectinfo);
	if($relproject){
	$fetcproject=$relproject->fetch_array();
}
	



$select_about="SELECT * FROM about_school";
	$result_about=$db->select_query($select_about);
	if($result_about){
	$fetch_about=$result_about->fetch_array();}
	
?>
<?php

$select_mission_vission="SELECT * FROM mission_and_vision";
		$result_ms=$db->select_query($select_mission_vission);
		if($result_ms){
		$fetch_mission_vission=$result_ms->fetch_array();
		}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $fetcproject["institute_name"];?></title>
<link rel="shortcut icon" href="admin/all_image/shortcurt_iconSDMS2015.png" />
  <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
<link rel="stylesheet" href="frontend/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="frontend/newstricker/css/marquee.css" />
<link rel="stylesheet" href="frontend/newstricker/css/example.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a351fecd37344ed"></script>

<link rel="stylesheet" href="frontend/css/style.css">




 <body>

<style>
body {
    background-image: url("img/images.jpg");
	
font-family: 'Roboto', sans-serif;}

 #boxshadow {
    position: relative;
    box-shadow: 2px 3px 5px rgba(0, 0, 0, .5);
   
    background: #fff;
    padding:8px;
}


</style>

                             <style type="text/css">
                            
.social-icon {
    color: #fff;
}
ul.social-icons {
    margin-top: 10px;
}
.social-icons li {
    vertical-align: top;
    display: inline;
    height: 100px;
}
.social-icons a {
    color: #fff;
    text-decoration: none;
}
.face {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.face:hover {
    background-color: #3d5b99;
}
.twitter {
    padding:10px 12px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.twitter:hover {
    background-color: #00aced;
}
.rss {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.rss:hover {
    background-color: #eb8231;
}
.youtube {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.youtube:hover {
    background-color: #e64a41;
}
.instagram {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.instagram:hover {
    background-color: #0073a4;
}
.plus {
    padding:10px 9px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.plus:hover {
    background-color: #e25714;
}


                             </style>
 
   </head>
 

			<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;" >
				
					<section>
					
							<div class="col-md-10 col-lg-10 col-sm-12 col-xs-12  col-md-offset-1" id='boxshadow'>
										
										
										
											
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px ; margin:0px;" id="middiv">
												
													<?php include('header.php');?>
												
													<?php 
															if(isset($_GET["page"])){
																	switch($_GET["page"]){
																			case "allnotice":
																			{
																				include_once('allnotice.php');
																			}
																			break;
																			case "officeorder":
																			{
																				include_once('allnotice.php');
																			}
																			break;

																			

																			case "founder_message":
																			{
																				include_once('founder_message.php');
																			}
																			break;

																			
																			case "video":
																			{
																				include_once('video.php');
																			}
																			break;
																			
																			
																			case "noticeview":
																			{
																				include_once('noticeview.php');
																			}
																			break;
																			case "head":
																			{
																				include_once('head.php');
																			}
																			break;
																			case "vp":
																			{
																				include_once('vp.php');
																			}
																			break;
																			
																			
																			case "FS":
																			{
																				include_once('FS.php');
																			}
																			break;
																			
																			
																			case "PS":
																			{
																				include_once('PS.php');
																			}
																			break;
																			
																			
																			case "about":
																			{
																				include_once('about.php');
																			}
																			break;
																			
																			
																			case "mission":
																			{
																				include_once('mission.php');
																			}
																			break;
																			
																			case "history":
																			{
																				include_once('history.php');
																			}
																			break;
																			
																			case "contact":
																			{
																				include_once('contact.php');
																			}
																			break;
																			
																			
																			case "scout":
																			{
																				include_once('scout.php');
																			}
																			break;
																			
																			case "Cub":
																			{
																				include_once('scout.php');
																			}
																			break;
																			
																			case "BNCC":
																			{
																				include_once('BNCC.php');
																			}
																			break;
																			case "red":
																			{
																				include_once('red.php');
																			}
																			break;
																			case "Girls":
																			{
																				include_once('red.php');
																			}
																			break;
																			
																			
																			
																			
																			case "sport":
																			{
																				include_once('red.php');
																			}
																			break;
																			
																			case "library":
																			{
																				include_once('red.php');
																			}
																			break;
																			
																			
																			
																			case "calendar":
																			{
																				include_once('calendar.php');
																			}
																			break;
																			
																			
																			
																			case "uniform":
																			{
																				include_once('uniform.php');
																			}
																			break;
																			case "fees":
																			{
																				include_once('fees.php');
																			}
																			break;
																			
																			
																			case "holiday":
																			{
																				include_once('holiday.php');
																			}
																			break;
																			
																			case "public":
																			{
																				include_once('publicresult.php');
																			}
																			break;
																			
																			case "scholership":
																			{
																				include_once('scholership.php');
																			}
																			break;
																			
																			case "various":
																			{
																				include_once('variousexam.php');
																			}
																			break;
																			
																			case "admisionrule":
																			{
																				include_once('admisionrule.php');
																			}
																			break;
																			
																			case "join":
																			{
																				include_once('routine.php');
																			}
																			break;
																			case "class":
																			{
																				include_once('routine.php');
																			}
																			break;
																			case "teacher":
																			{
																				include_once('routine.php');
																			}
																			break;
																			case "studenexam_record":
																			{
																				include_once('exam.php');
																			}
																			break;
																			case "examniyomaboli":
																			{
																				include_once('exam.php');
																			}
																			break;
																			case "examroutine":
																			{
																				include_once('exam.php');
																			}
																			break;
																			case "examsuggesion":
																			{
																				include_once('exam.php');
																			}
																			break;
																			
																			case "Regulations":
																			{
																				include_once('rulse.php');
																			}
																			break;
																			
																			case "Hostel Information":
																			{
																				include_once('rulse.php');
																			}
																			break;
																			
																			case "Transport Information":
																			{
																				include_once('rulse.php');
																			}
																			break;
																			case "acchivement":
																			{
																				include_once('exam.php');
																			}
																			break;
																			
																			case "clsstudent":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			case "gpstudent":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			case "teacherinfo":
																			{
																				include_once('student.php');
																			}
																			break;
																			case "staff":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			case "gurdian":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			
																			
																			
																			case "Former_cheif":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			
																			
																			
																			case "member":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																		case "doner":
																			{
																				include_once('student.php');
																			}
																			break;
																			
																			
																			
																			case "zero":
																			{
																				include_once('zero.php');
																			}
																			break;
																			
																			
																			
																			case "curiculam":
																			{
																				include_once('curiculam.php');
																			}
																			break;
																			case "viewcur":
																			{
																				include_once('viewcur.php');
																			}
																			break;
																			case "event":
																			{
																				include_once('curiculam.php');
																			}
																			break;
																			case "nevent":
																			{
																				include_once('curiculam.php');
																			}
																			break;
																			
																			case "Literary practices":
																			{
																				include_once('litaray.php');
																			}
																			break;
																			case "Cultural practices":
																			{
																				include_once('litaray.php');
																			}
																			break;
																			case "Study tour":
																			{
																				include_once('litaray.php');
																			}
																			break;
																			case "litaryview":
																			{
																				include_once('about.php');
																			}
																			break;
																			
																			case "prokoshona":
																			{
																				include_once('exam.php');
																			}
																			break;
																			
																			case "photo":
																			{
																				include_once('gallery.php');
																			}
																			break;
																			
																		
																			case "stdview":
																			{
																				include_once('singelview.php');
																			}
																			break;
																			
																			
																			
																			
																	default:
																			include_once('leftsidebody.php');
																			
																}	
														}else{

															 include('topSlide.php');


																include_once('leftsidebody.php');
													}
															
													?>
													
													<?php include('rightsidebody.php');?>
		
		
											</div>
											
											
										
										
								
								
										
										
								</div>
								
								
						
								
								
								
					</section>
					<?php  
						
								include('footer.php');
						?>
				<?php

	 $sql="SELECT COUNT(photo_id)  FROM `photo_gellary`  WHERE  `gellary`='gallery'";
	$result=$db->select_query($sql);
	if($result)
	{
		$row=$result->fetch_array();
	}
	$rows = $row[0];
	$page_rows = 40;
	$last = ceil($rows/$page_rows);
	if($last < 1)
	{
		$last = 1;
	}
	$pagenum = 1;
	if(isset($_GET["pn"]))
	{
		
		$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
	}
	if($pagenum < 1)
	{
			$pagenum = 1;
	}
	else if($pagenum > $last){
		$pagenum = $last;
		
	}
	$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
	$sql1= "SELECT * FROM `photo_gellary`  WHERE  `gellary`='gallery' ORDER BY serial_no ASC $limit";
	$result1=$db->select_query($sql1);
	$textline1= "Commetee Members(<b>$rows</b>)";
	$textline2="Page<b>$pagenum</b>of<b>$last</b>";
	$pagenationCtrl = '';
	if($last != 1){
		
		if($pagenum > 1 )
		{
			$previous = $pagenum-1;
			$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$previous.'" >Previous</a> &nbsp;';
				for($i = $pagenum-4;$i < $pagenum; $i++){
					
					if($i > 0){
						
						$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					}
					
				}
		}
		
			for($i = $pagenum+1;$i <= $last; $i++){
					$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					if($i >= $pagenum+4){
						
						break;
					}
					
				}
				if($pagenum != $last)
				{
					$next=$pagenum+1;
					$pagenationCtrl.='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$next.'" >Next</a>';
				}
	}				
				
				
				
				
				
					
					$sl = 0;
					if($result1){
					while($fetch=$result1->fetch_object()){				
					
?>
<div id="<?php echo $fetch->photo_id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4><?php echo $fetch->title;?></h4>
      </div>
      <div class="modal-body">
        <img  src="other_img/<?php echo $fetch->photo_id;?>.jpg" alt="<?php echo $fetch->title;?>"  style="padding:10px;width: 100%"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php }  ?>

<?php } ?>
			</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="frontend/js/bootstrap.min.js"></script>
	

		<script type="text/javascript" src="frontend/newstricker/js/marquee.js"></script>

<script>
			$(function (){

				$('.simple-marquee-container').SimpleMarquee();
				
			});
			
			function fontsize16(){
					 $(".fontsize").css("fontSize", 12);
					  $(".changetitle").css("fontSize",13);
					 
					  $("#noticetitle").css("fontSize",13);
			}
			
			function fontsize18(){
					 $(".fontsize").css("fontSize", 16);
					  $("#noticetitle").css("fontSize",16);
					  $(".changetitle").css("fontSize",16);
			}
	function fontsize20(){
					 $(".fontsize").css("fontSize", 20);
					  $("#noticetitle").css("fontSize",20);
					   $(".changetitle").css("fontSize",20);
			}
			
			
			function backgroupcolone(){
					 $(".backgroundcol").css("background", "#fff");
					  $(".backgroundcol").css("color", "black");
					  $("#noticetitle").css("color","black");
					   $("#titlecolor").css("color","black");
					    $(".changetitle").css("color","black");
					  
			}
			
			
			function backgroupcoltwo(){
					 $(".backgroundcol").css("background", "#cfe5fc");
					 $(".backgroundcol").css("color", "black");
					  $("#noticetitle").css("color","black");
					   $("#titlecolor").css("color","black");
					     $(".changetitle").css("color","black");
					  
					  
				}
			
			
			function backgroupcolthree(){
					 $(".backgroundcol").css("background", "#2f2f2f");
					 $(".backgroundcol").css("color", "yellow");
					  $("#noticetitle").css("color","yellow");
					   $("#titlecolor").css("color","yellow");
					    $(".changetitle").css("color","yellow");
			}
			
				function backgroupcolfour(){
					 $(".backgroundcol").css("background", "#f7f3d6");
					 $(".backgroundcol").css("color", "black");
					  $("#noticetitle").css("color","black");
					   $("#titlecolor").css("color","black");
					     $(".changetitle").css("color","black");
			}
		</script>

  </body>
</html>  <style type="text/css">
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
  
</style>
