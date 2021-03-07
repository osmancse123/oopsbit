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
					shwoMonthlyReport();
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
					var forDaily  = "";
			
							$.ajax({
										url : "showCostReport.php",
										data : {date:date,forDaily:forDaily},
										type : "POST",
										success:function(data){
													
												$('#showDailyreport').html(data);
										}
									});
					
					
			}
			
			function shwoMonthlyReport(){
					var frsdate  = $('#example1').val();
					var snddate  = $('#example12').val();
					var monthlyreport = "dd";
					
					if(frsdate !=''  &&  snddate !='' ){
					 	
						
							$.ajax({
										url : "showCostReport.php",
										data : {frsdate:frsdate,snddate:snddate,monthlyreport:monthlyreport},
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
					var years =$('#years').val();
					if(years !=""){
						$.ajax({
										url : "showCostReport.php",
										data : {years:years,showEarlypost:showEarlypost},
										type : "POST",
										success:function(data){
												
													
												$('#showEarlyCost').html(data);
										}
									});
					
					}else{
							alert('Please Enter The Year !!');
					}
			}
			 
   
	</script>
	
	</head>
	
  <body>
  <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal dataFrom">
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1 table-bordered" style="margin-top:10px;">

<ul class="nav nav-tabs" style="margin-top:20px; ">
  <li class="active"><a data-toggle="tab" href="#home">Daily</a></li>
  <li><a data-toggle="tab" href="#menu1">Mothly</a></li>
  <li><a data-toggle="tab" href="#menu2">Yearly</a></li>
</ul>

<div class="tab-content table-bordered" style="margin-bottom:20px;">
  <div id="home" class="tab-pane fade in active" style="margin-bottom:10px;">
    			
					<span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Select Date : </strong></span><br/>
						<input type="text" name="date" id="date" style="width: 500px; height:30px; margin-left:10px;" onSelect="return ShowReportDaily()" onClick="return ShowReportDaily()" />&nbsp;&nbsp;
			
			
			<div id="showDailyreport" style="margin-top:20px;"></div>
  	
  </div>
  <div id="menu1" class="tab-pane fade" style="margin-bottom:20px; margin-top:20px; text-align:center">
  
  		
			<span><strong style="font-size:15px;">From Date</strong></span>&nbsp; &nbsp;<input type="text" class="FristDAte" name="FristDAte" id="example1"/>&nbsp; &nbsp;
								<span><strong style="font-size:15px;">&nbsp;&nbsp;  To Date </strong></span>&nbsp; &nbsp;<input type="text" name="sndDAte" id="example12" class="sndDAte"/>&nbsp;&nbsp;						
								<input  type="button" onClick="return shwoMonthlyReport()" name="submit" id="submit" value="Submit" />
								
								<div id="showMonthlyreport" style="margin-top:20px;"></div>
  
  
  </div>
  <div id="menu2" class="tab-pane fade">
			   <span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Select Year : </strong></span><br/>
								     <input type="text" name="years" id="years" style="width: 500px; height:30px; margin-left:10px;" onKeyUp="return showYearlyCost()"/>

										<div id="showEarlyCost" style="margin-top:20px;"></div>
  </div>
  		
</div>
    <script src="../js/bootstrap.min.js"></script>
	
	</form>
  </body>
</html>