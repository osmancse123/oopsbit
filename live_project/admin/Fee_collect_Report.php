<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
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
  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>




   
	<script>
	
	  $(document).ready(function () {
                
                $('#date').datepicker({
                    format: "dd/mm/yyyy"
					
                }).on('changeDate', function(e){
					$(this).datepicker('hide');
					ShowReportDaily();
				});  
            
            });
			 $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd/mm/yyyy"
                    }).on('changeDate', function(e){
					$(this).datepicker('hide');
					
				});   
                
                });
				
				   $(document).ready(function () {
                 
                    $('#example12').datepicker({
                        format: "dd/mm/yyyy"
                    }).on('changeDate', function(e){
					$(this).datepicker('hide');
					
				}); 
				
				
                });
				
				/*<!-- $(document).ready(function () {
                 
                    $('#years').datepicker({
                         minViewMode: 2,
         format: 'yyyy'
                    }).on('changeDate', function(e){
					$(this).datepicker('hide');
					
				}); 
				
				
                });-->*/
				
				
				
				
				/*$("#example12").datepicker( {
					format: "yyyy",
					viewMode: "years", 
					minViewMode: "years"
				}).on('changeDate', function(e){
					$(this).datepicker('hide');
				});*/


			function ShowReportDaily(){
					var date = $('#date').val();
					var forDaily  = "ASDFADSFASDF";
			
							$.ajax({
										url : "showfeeCollectPaymentReport.php",
										data : {date:date,forDaily:forDaily},
										type : "POST",
										success:function(data){
													//alert();
												$('#showDailyreport').html(data);
										}
									});
					
					
			}
			
			function shwoMonthlyReport(){
					var year  = $('#year').val();
					var month  = $('#month').val();
					var monthlyreport = "dd";
					
					if(year !=''  &&  month !='' ){
					 	
						
							$.ajax({
										url : "showfeeCollectPaymentReport.php",
										data : {year:year,month:month,monthlyreport:monthlyreport},
										type : "POST",
										success:function(data){
												
													
												$('#showMonthlyreport').html(data);
										}
									});
										
					}else{
							alert('Please Select The Date !!');
					}
			}
			
			function showYearlyCost(){
					var showEarlypost = "ddd";
					var year1 =$('#year1').val();
					
					if(year1 !=""){
						$.ajax({
										url : "showfeeCollectPaymentReport.php",
										data : {year1:year1,showEarlypost:showEarlypost},
										type : "POST",
										success:function(data){
												
													
												$('#showEarlyCost').html(data);
										}
									});
					
					}else{
							alert('Please Enter The Year !!');
					}
			}
			 
   
   
   $(document).ready(function(){




  $('#stdId').keyup(function(){
  
    var forFestdid = $(this).val();
    
   	var clas = $('#clas').val();
    var forstudenPaidDI = "dd";
    if(forFestdid != ""){
      $.ajax({
        url : "autoComSTd.php",
        data : {forstudenPaidDI:forstudenPaidDI,forFestdid:forFestdid,clas:clas},
        type : "POST",
        success:function(data){
            
          $('#idlist').fadeIn();
          $('#idlist').html(data);
        }
      });
    }
    
  });
  
    $(document).on('click','li',function(){

      $('#stdId').val($(this).text());
      $('#idlist').fadeOut();
      showIdby();
	  

    });
});


    function printData(){
            var id =$('#stdId').val();
			var yearstd=$('#yearstd').val();
			var clas = $('#clas').val();
			var std =  "ddd";
      

   window.open('showfeeCollectPaymentReport.php?id='+id+'&&clas='+clas+'&&yearstd='+yearstd+'&&std='+std+'',
  '_blank');
           
    }
	
	
	</script>
	
	</head>
	
   <style>
   
  .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 180px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
  margin-left:105px;
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
  <li class="active"><a data-toggle="tab" href="#home">Daily</a></li>
  <li><a data-toggle="tab" href="#menu1">Mothly</a></li>
  <li><a data-toggle="tab" href="#menu2">Yearly</a></li>
	<li><a data-toggle="tab" href="#studentWis">Student</a></li>
</ul>

<div class="tab-content table-bordered" style="margin-bottom:20px;">
  <div id="home" class="tab-pane fade in active" style="margin-bottom:10px;">
    			
					<span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Select Date : </strong></span><br/>
						<input type="text" name="date" id="date" style="width: 500px; height:30px; margin-left:10px;" onSelect="return ShowReportDaily()" onClick="return ShowReportDaily()" />&nbsp;&nbsp;
			
			
			<div id="showDailyreport" style="margin-top:20px;"></div>
  	
  </div>
  <div id="menu1" class="tab-pane fade" style="margin-bottom:20px; margin-top:20px; text-align:center">
  
  		
			<span><strong style="font-size:15px;">Select Month </strong></span>&nbsp; &nbsp;<select name="month" id="month" class="" style="width: 200px; height:30px; margin-left:10px;">
				<?php
					$selectMonth  = "SELECT * FROM `month_setup` ORDER BY `id` ASC";
					$resultMonth = $db->select_query($selectMonth);
						if($resultMonth->num_rows > 0)
						{	
						while($fetchMonth = $resultMonth->fetch_array()){
				?>
					<option value="<?php echo $fetchMonth["id"];?>"><?php echo $fetchMonth["name"];?></option>
					<?php } } ?>
			</select>&nbsp; &nbsp;
								<span><strong style="font-size:15px;">&nbsp;&nbsp;  Select Year </strong></span>&nbsp; &nbsp;<select name="year" id="year" class="" style="width: 200px; height:30px; margin-left:10px;">
									<?php
					$selectYear  = "SELECT `year` FROM  `student_paid_table` GROUP BY `year` ORDER BY `year` DESC";
					$relYear = $db->select_query($selectYear);
						if($relYear->num_rows > 0)
						{	
						while($fetchyear = $relYear->fetch_array()){
				?>
					<option value="<?php echo $fetchyear["year"];?>"><?php echo $fetchyear["year"];?></option>
					<?php } } ?>
								</select>&nbsp;&nbsp;						
								<input  type="button" onClick="return shwoMonthlyReport()" name="submit" id="submit" value="Submit" />
								
								<div id="showMonthlyreport" style="margin-top:20px;"></div>
  
  
  </div>
  <div id="menu2" class="tab-pane fade">
			   <span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Select Year : </strong></span><br/>
								  <select  name="year1" id="year1" class="" style="width: 500px; height:30px; margin-left:10px;" onChange="return showYearlyCost() ">
								  <option>Select One </option> 	<?php
					$selectYear1  = "SELECT `year` FROM  `student_paid_table` GROUP BY `year` ORDER BY `year` DESC";
					$relYear1 = $db->select_query($selectYear1);
						if($relYear1->num_rows > 0)
						{	
						while($fetchyear1 = $relYear1->fetch_array()){
				?>
					<option value="<?php echo $fetchyear1["year"];?>"><?php echo $fetchyear1["year"];?></option>
					<?php } } ?>
								</select>&nbsp;&nbsp;					
										<br/>
										<div id="showEarlyCost" style="margin-top:20px;"></div>
  </div>
  
   <div id="studentWis" class="tab-pane fade">
   <br/>
			<div style="height:80px;">&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;
			
								<div class="col-lg-6 col-md-6" style="float:left; clear:right"><span><strong style="font-size:15px;">&nbsp;&nbsp;  Select Class </strong></span>&nbsp; &nbsp;<select  class="" id="clas" style="width: 200px; height:30px;">
									<?php
					$selClass  = "SELECT * FROM `add_class` ORDER BY `id` ASC";
					$resultClass = $db->select_query($selClass);
						if($resultClass->num_rows > 0)
						{	
						while($fetchResultcls = $resultClass->fetch_array()){
				?>
								<option value="<?php echo $fetchResultcls["id"];?>"><?php echo $fetchResultcls["class_name"];?></option>
								<?php }  } ?>
								</select></div>
								<div class="col-lg-6 col-md-6" style="float:left; clear:right"> <span><strong style="font-size:15px;">Student ID </strong></span>&nbsp; &nbsp;<input type="text" autocomplete="off" name="stdId"  onKeyUp="return showIdby()"   id="stdId" placeholder='Student ID' style="width:178px; border-radius:0px;"/>
                <div id="idlist" class="ui-autocomplete"  style="text-align:left"></div>&nbsp; &nbsp;</div><br/>
								
									</div>	
									<div class="col-lg-offset-3 col-md-offset-3"><span><strong style="font-size:15px;">&nbsp;&nbsp;  Select Year </strong></span><select name="yearstd" id="yearstd" class="" style="width: 200px; height:30px;">
									<?php
					$selectYearstd  = "SELECT `year` FROM  `student_paid_table` GROUP BY `year` ORDER BY `year` DESC";
					$relYearstd = $db->select_query($selectYearstd);
						if($relYearstd->num_rows > 0)
						{	
						while($fetchyearstd = $relYearstd->fetch_array()){
				?>
					<option value="<?php echo $fetchyearstd["year"];?>"><?php echo $fetchyearstd["year"];?></option>
					<?php } } ?>
								</select>&nbsp;&nbsp;		
								<input  type="button" onClick="return printData()" name="submit" id="submit" value="Submit" /></div>		
										<div id="showEarlyCost" style="margin-top:20px;"></div>
  </div>
  		
</div>
    <script src="../js/bootstrap.min.js"></script>
	
	</form>
  </body>
</html>