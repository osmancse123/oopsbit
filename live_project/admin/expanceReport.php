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
    
    <title>Daily Expanse Report(Class wise)</title>
	
	
	
  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
	 
	     <script src="../js/bootstrap.min.js"></script>
	 <script type="text/javascript">
	 
	 
	 $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });
				
				
      $(document).ready(function()
       {

        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               Check_exam_type();
        });
    
 });

         //function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                    $('#item_result').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('category_result').style.color='RED';
                    $('#category_result').html('No Group Name Found');
                    $('#item_result').html("");
                    $('#groupname').html('');
                }
                
                $('#subject_type').html("");
                $('#sub_name').html("");
                $('#part_name').html('');
                $('#subjectcode').val('');
                 
        });
}

	
		

</script>
    </head>

  <body>
  	<form name="teacherinfo" action="DailyExpense.php" method="get"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px; text-transform: capitalize;">Expanse Report </strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                 

   					 <tr>
                    	
						<td ><strong><span class="text-success" style="font-size: 15px;">Select Type</span></strong></td>
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
					
					
				
					
                <tr>
                	<td colspan="2" align="left">
                		<input type="submit" name="showdata" value="Show Data" class="btn btn-success btn-md" style="width: 180px" formtarget="_blank"></input>
					</td>
			</tr>

                </table>

                </div>
				
				 <div class="col-md-10 col-md-offset-1" id="showdata">
				 
				 
				 </div>
		
     </form>

 
        <script type="text/javascript">
	
			
			
            function showReport(){
						$('#date').html('');
   					
					
					
					var type = $('#Type').val();
                    if(type=='10'){
                          alert('Please Select Type');
                           $('#group').html('');
                    }
                    else{


                        if(type==='5'){

                         
                              $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;">Select Date</span></strong></td><td ><div class="col-md-8"><input type="text" name="date" id="example1"  style="width:280px; border-radius:0px;" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" /></div></td>');
                        }
                        else if(type==='2'){
  
                               $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;">Select Month & Year</span></strong></td><td ><div class="col-md-8"><select name="monthID" id="monthID"  style="border-radius:0px; width:280px;" class="form-control"><?php 
$selMonth = "SELECT * FROM `month_setup` ORDER BY `id` ASC";$checkMont=$db->select_query($selMonth);if($checkMont){while($fetmonth=$checkMont->fetch_array()){if($fetch[6] != $fetmonth[0] ){?><option value="<?php echo "$fetmonth[0]"?>"><?php echo $fetmonth[1];?></option><?php }  }  } ?></select>  <br/> <input type="text" name="year" id="year"  class="form-control"  value="<?php echo date('Y')?>" style="width:280px; border-radius:0px;"/></div></td>');

                            
                        }else if(type==='3')
                        {
                         $('#date').append('<td><strong><span class="text-success" style="font-size: 15px;"> Year</span></strong></td><td ><div class="col-md-8"><input type="text"  id="wyear" name="SelectYear" value="<?php echo date('Y')?>" class="form-control" style="width:280px; border-radius:0px;"/></div></td>');

                        }


                        else{

                      	$('#date').html('');
   					
                        }



                    }

                    

            }


				
				
        </script>

  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
