  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	

 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>
	
	
	
  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 
	     <script src="../js/bootstrap.min.js"></script>
	 <script type="text/javascript">
	 
		

</script>
    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Attendence Report</strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Type</span></strong></td>
                        <td ><div class="col-md-6">
                        <select class="form-control" name="className" id="className" onChange="forclass()" style="width:280px; border-radius:0px;">
									<option>Select One</option>
									<option value="teacher">Teacher  </option>
										<option value="Staff">Staff  </option>
									<option value="student">Student</option>
                        </select></div>
						
						<div class="col-md-6" id="showclsname">
									 
						</div>
                    </tr>
					
					
					 <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">ID</span></strong></td>
                        <td ><div class="col-md-8">
                        		<input type="text" name="id" id="id" class="form-control"   style="width:280px; border-radius:0px;"/>
 						</div>
                    </tr>

   					 <tr>
                    	
						<td ><strong><span class="text-success" style="font-size: 15px;">Select Pattern</span></strong></td>
                        <td ><div class="col-md-8">
						 <select  name ="Type"  id="Type" class="form-control" onChange="showReport()" style="width:280px; border-radius:0px;">
						  <option value="10">Select One</option>
                      <option value="5">Daily</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
						</select>
						 </div></td>
                    
					
					</tr>
					
					
					 <tr id="date">
                    	
						
					</tr>
					
					
				
					
                <tr><td colspan="2" align="center"><input type="button" name="showdata" value="Show Data" class="btn btn-danger btn-md" style="width: 180px" onClick="return ShowReportDaily()"></input>
				</td></tr>
                </table>
							
                </div>
				
				 <div class="col-md-10 col-md-offset-1" id="showdata">
				 
				 
				 </div>
		
     </form>

 
        <script type="text/javascript">
	
			function forclass(){
			
					var className = $('#className').val();
					
					if(className == 'student'){
							    $('#showclsname').append('<select name="clsname" id="clsname"  style="border-radius:0px;" class="form-control"><?php 
$selMonth = "SELECT * FROM `add_class`";$checkMont=$db->select_query($selMonth);if($checkMont){while($fetmonth=$checkMont->fetch_array()){if($fetch[6] != $fetmonth[0] ){?><option value="<?php echo "$fetmonth[id]"?>"><?php echo $fetmonth['class_name'];?></option><?php }  }  } ?></select>');
					}else{
					 $('#showclsname').html('');
					
					}
			}
			
            function showReport(){
						$('#date').html('');
   					
					
					
					var type = $('#Type').val();
                    if(type=='10'){
                          alert('Please Select Type');
                           $('#group').html('');
                    }
                    else{


                        if(type==='5'){

                         
                              $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;">Select Date</span></strong></td><td ><div class="col-md-8"><input type="text" name="date" id="example1"  style="width:280px; border-radius:0px;" class="form-control" placeholder="dd-mm-yy" /></div></td>');
                        }
                        else if(type==='2'){
  
                               $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;">Select Month & Year</span></strong></td><td ><div class="col-md-8"><select name="monthID" id="monthID"  style="border-radius:0px;" class="form-control"><?php 
$selMonth = "SELECT * FROM `month_setup` ORDER BY `id` ASC";$checkMont=$db->select_query($selMonth);if($checkMont){while($fetmonth=$checkMont->fetch_array()){if($fetch[6] != $fetmonth[0] ){?><option value="<?php echo "$fetmonth[0]"?>"><?php echo $fetmonth[1];?></option><?php }  }  } ?></select>  <br/> <input type="text" id="year"  class="form-control" placeholder="2018" style="width:280px; border-radius:0px;"/></div></td>');

                            
                        }else if(type==='3')
                        {
                         $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;">Write Year</span></strong></td><td ><div class="col-md-8"><input type="text" id="wyear" placeholder="2018" class="form-control" style="width:280px; border-radius:0px;"/></div></td>');

                        }


                        else{

                      	$('#date').html('');
   					
                        }



                    }

                    

            }


				function ShowReportDaily(){
		
				
					var className = $('#className').val();
					
					var id = $('#id').val();
					
					var type = $('#Type').val();
					
					var example1 = $('#example1').val();
					
						var monthID = $('#monthID').val();
						
						var year = $('#year').val();
							var wyear = $('#wyear').val();
							var clsname = $('#clsname').val();
					
						
					if(type == "5"){
					var forDaily  = "ASDFADSFASDF";
					
					
		
							$.ajax({
										url : "ajaxforallatrep.php",
										data : {forDaily:forDaily,className:className,example1:example1,id:id,clsname:clsname},
										type : "POST",
										success:function(data){
													
													
													
												$('#showdata').html(data);
										}
									});
									
					}			
					
					
					if(type == "2"){
					var formonthly  = "ASDFADSFASDF";
					
				
		
							$.ajax({
										url : "ajaxforallatrep.php",
										data : {monthID:monthID,formonthly:formonthly,year:year,className:className,id:id,clsname:clsname},
										type : "POST",
										success:function(data){
												
												$('#showdata').html(data);
										}
									});
									
					}	
					
					
						if(type == "3"){
					var foryear  = "ASDFADSFASDF";
					
				
		
							$.ajax({
										url : "ajaxforallatrep.php",
										data : {year:wyear,foryear:foryear,className:className,id:id,clsname:clsname},
										type : "POST",
										success:function(data){
												//alert(data);
												$('#showdata').html(data);
										}
									});
									
					}									
					
			}	
				
        </script>

  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
