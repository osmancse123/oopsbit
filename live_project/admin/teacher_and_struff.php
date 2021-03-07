<?php
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
  <script type="text/javascript" src="../../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="../textEdit/redactor/redactor.min.js"></script>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../datespicker/datepicker.css">
    <link rel="stylesheet" href="../datespicker/bootstrap.min.css">

   
     <script src="../datespicker/bootstrap-datepicker.js"></script>




   
	<script>
	
	 $(document).ready(function(){
	$('#teacherId').keyup(function(){
	
		var teacherID = $(this).val();
		var forTeacherPaybalSeettion = "dd";
		if(teacherID != ""){
			$.ajax({
				url : "../autoComSTd.php",
				data : {teacherID:teacherID,forTeacherPaybalSeettion:forTeacherPaybalSeettion},
				type : "POST",
				success:function(data){
					
					$('#idlist').fadeIn();
					$('#idlist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#teacherId').val($(this).text());
			$('#idlist').fadeOut();
		
			
		});
});

 $(document).ready(function(){
	$('#struffID').keyup(function(){
	//	alert('dddd');
		var struffID = $(this).val();
		
		var forSturffPayableSetting = "dd";
		if(struffID != ""){
			$.ajax({
				url : "../autoComSTd.php",
				data : {struffID:struffID,forSturffPayableSetting:forSturffPayableSetting},
				type : "POST",
				success:function(data){
					//alert(data);
					$('#stflist').fadeIn();
					$('#stflist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#struffID').val($(this).text());
			$('#stflist').fadeOut();
			
			
		});
});



			function showAccountINfor(){
					var typeT = $('#type').val();
					var month = $('#month').val();
					var Years = $('#year').val();
					var teacherId = $('#teacherId').val();
				
			if(teacherId !=""){
							$.ajax({
										url : "teacher_report_payable.php",
										data : {Years:Years,teacherId:teacherId,typeT:typeT,month:month},
										type : "POST",
										success:function(data){
												
												$('#loadVal').html(data);
										}
									});
									}else {
										alert("Please Fill Up Important Fields..!!");
									}
					
					
			}
			
			function print(){
   					var typeT = $('#type').val();
					var month = $('#month').val();
					var Years = $('#year').val();
      				var teacherId = $('#teacherId').val();
if (typeT=="tech") {
	if (teacherId!="") {
   window.open('teacher_report_payable.php?id='+teacherId+'&typeT='+typeT+'&month='+month+'&Years='+Years+'',
  '_blank');
}
else
{
	alert("Please Give The Teacher ID");
   }
}
else
{
	  window.open('teacher_report_payable.php?typeT='+typeT+'&month='+month+'&Years='+Years+'',
  '_blank');
}

           
    }
   
	</script>
	
	</head>
	 <style type="text/css">
<!--
.style1 {color: #CCCCCC}
-->
    </style>
	<style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 310px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
  margin-left:15px;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;

  .ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;

    &.ui-state-hover, &.ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
    }
  }
}
 </style>
  <body>
  <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal dataFrom">
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1 table-bordered" style="margin-top:10px;">

<ul class="nav nav-tabs" style="margin-top:20px; ">
  <li class="active"><a data-toggle="tab" href="#home">Teacher's</a></li>


</ul>

<div class="tab-content table-bordered" style="margin-bottom:20px;">
  <div id="home" class="tab-pane fade in active" style="margin-bottom:10px;">
    			<table style="width:100%;margin-top: 20px;">
    			<tr>
    				<td colspan="2"><b style="margin-left: 20px;">Type :</b> 
    				<select style="height: 30px; width: 160px;" id="type">
    				
    					<option value="month">Monthly</option>
    					<option value="tech">Teacher According Report</option>
    				
    				</select>
<b style="margin-left: 20px;">Month :</b> <select style="height: 30px; width: 120px;" id="month">
    				<?php
$sql="select * from teacher_payment_history group by month";
$quer=$db->select_query($sql);
if ($quer) {
while ( $row=mysqli_fetch_assoc($quer))
 {
?>
<option value="<?php echo $row["month"]; ?>"><?php 

if ($row["month"]=="Jan") {
	echo "January";
}
else if ($row["month"]=="Feb") {
	echo "February";
}
else if ($row["month"]=="Mar") {
	echo "March";
}
else if ($row["month"]=="Apr") {
	echo "April";
}
else if ($row["month"]=="May") {
	echo "May";
}
else if ($row["month"]=="Jun") {
	echo "June";
}
else if ($row["month"]=="Jul") {
	echo "July";
}
else if ($row["month"]=="Aug") {
	echo "August";
}
else if ($row["month"]=="Sep") {
	echo "September";
}
else if ($row["month"]=="Oct") {
	echo "October";
}
else if ($row["month"]=="Nov") {
	echo "November";
}
else if ($row["month"]=="Dec") {
	echo "December";
}
else {
	echo $row["month"];
}
 ?></option>

<?php
}}
	?>
    				</select>
    				<b style="margin-left: 20px;">Year :</b> <select style="height: 30px; width: 120px;" id="year">
    					<?php
$sql="select * from teacher_payment_history group by year";
$quer=$db->select_query($sql);
if ($quer) {
while ( $row=mysqli_fetch_assoc($quer))
 {
?>
<option value="<?php echo $row["year"]; ?>"><?php echo $row["year"]; ?></option>

<?php
}}
	?>
    				</select>
    				</td>
    			</tr>
						<tr>
								<td colspan="2"><br><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Teacher ID: </strong></span><br/>	
								<div class="col-md-12"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:50%;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div><button class="btn btn-info" type="button" onclick="print()">Report</button></div> 
								</td>
								
								
						</tr>
				</table>		
	

  	
  </div>
 
  		
</div>
</div>

    <script src="../../js/bootstrap.min.js"></script>
	
	</form>


  </body>
</html>
<style type="text/css">
	@media print{
.dataFrom{display: none;}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		

		}
</style>
<div class="col-md-12" style="margin-top: 20px;">
	<div id="loadVal" >
	
</div>
</div>

