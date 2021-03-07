<?php
 
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{ 
			require_once("../../db_connect/conect.php");
	$db = new database();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script type="text/javascript" src="../textEdit/lib/jquery-1.9.0.min.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
      	$(document).ready(function(){
	$('#teacherId').keyup(function(){
			$('#totalpayable').val('');
						$('#paidAmount').val('');
						$('#duammmount').val('');
						var month=$('#month').val();
						var year=$('#year').val();

		var teacherID = $(this).val();
		var forTeacherPaybalSeettion = "dd";
		if(teacherID != "" && month!=null){
			$.ajax({
				url : "../autoComSTd.php",
				data : {teacherID:teacherID,forTeacherManage:forTeacherPaybalSeettion},
				type : "POST",
				success:function(data){
					
					$('#idlist').fadeIn();
					$('#idlist').html(data);
				
				}
			});
		}
		else
		{
			alert("Please Select Year And Month");
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#teacherId').val($(this).text());
			$('#idlist').fadeOut();
			showIdby();
			
		});
});

function showIdby(){
				
var id =$('#teacherId').val();
var name="nu";

//alert(lent);
var lent =$('#teacherId').val().length;
$('#showPaymentTitle').html('');
$('#TeacherPaymentdataTable').html('');
$('#sms').html('');
if(lent > 2){
		//alert("anik");
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherFinalize.php",
                    data: {id:id,name:name},
                    cache: false,
                    success: function(data) {
                    
                    	
							var a = data.split('/');
							
							var name = a[0];
							//alert(name);
							var designation = a[1];
							var  Email = a[2];
							
							$('#name').val(name);
							$('#Designation').val(designation);
							$('#Email').val(Email);
								var  amount = a[3];
							$('#paidAmount').val(amount);
							totalSalaryAm();
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Designation').val('');
							$('#Email').val('');
							$('#paidAmount').val('00.00');

	}
}

function totalSalaryAm()
{
	var id =$('#teacherId').val();
	var month =$('#month').val();
	var year =$('#year').val();
	var totalBounus ="df";
	 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherFinalize.php",
                    data: {id:id,month:month,totalBounus:totalBounus,year:year},
                    cache: false,
                    success: function(data) {
                    
							$('#totalSalary').val(data);
						}
						
					
					
                    });
}

function ADDandDelete(){
	var AddandDelete  = "adddelete";

	var paidAmount = parseFloat($('#paidAmount').val());
	var  duammmount = $('#obtainSalary').val();
	
	var teacherId =$('#teacherId').val();
	if(paidAmount != '' && teacherId !='' && duammmount !='' ){
	 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherFinalize.php",
                    data:$(".dataFrom").serialize() + "&AddandDelete=" + AddandDelete,
                    cache: false,
                
                    success: function(data) {
										
										
                    			$('#showmsg').html(data);
                    

							
							
						}
						
					
					
                    });
					}else {
						alert('Please Fill Up All  Fields..!!');
							return false;
					}
}



function paymentHistoryF(){
		 var ShowHistory = 'showData';
	var teacherId =$('#teacherId').val();
	
	if(teacherId !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherFinalize.php",
                    data:{ShowHistory:ShowHistory,teacherId:teacherId},
                    cache: false,
                    success: function(data) {
							
                    			$('.dataFrom').hide();
                    			$('#datatable').html(data);
							
							
						}
						
					
					
                    });
					
					}else{
					 $('#frstPage').show();
								 $('#datatable').hide();
							alert('Please Fill Up All  Fields..!!');
							return false;
							 
								
					}
}	

function calculet()
{
		var totalSalary =parseFloat($('#totalSalary').val());
		var fromTeacher =parseFloat($('#fromTeacher').val());
		var fromSchool  =parseFloat($('#fromSchool').val());

		var sum=fromTeacher+fromSchool;
		$('#totalFuture').val(sum);
	
var minus=totalSalary-fromTeacher;
$('#obtainSalary').val(minus);



}
    </script>
 
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
  min-width: 180px;
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
  </head>
  <body>
    <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal addData dataFrom">
      <div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="frstPage">
        	<table align="center" class="table table-responsive box table-bordered"  style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			
        <tr>
  				<td bgcolor="#f4f4f4"  class="warning" colspan="3" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Teacher Final Salary Setting</span> </td>
  			</tr>
         
                
      
  			<tr>

  				<td  align="left" colspan="3">
<div class="col-md-12"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:178px;  height:30px;"/> Month : 
<select class="" style="width:178px;  height:30px;" id="month" name="month">
	<option disabled="" selected="">Select Month</option>
	<option value="Jan">January</option>
  <option value="Feb">February</option>
  <option value="Mar">March</option>
  <option value="Apr">April</option>
  <option value="May">May</option>
  <option value="Jun">June</option>
  <option value="Jul">July</option>
  <option value="Aug">August</option>
  <option value="Sep">September</option>
  <option value="Oct">October</option>
  <option value="Nov">November</option>
  <option value="Dec">December</option>
</select> Year : <input type="text" name="year" value="<?php echo date("Y") ?>" id="year">
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div>

								</div>
        
							</td>

  			</tr>
<tr>
	<td>Name</td>
	<td width="1%">:</td>
	<td><input  type="text" name="name" style="width:100%; height:30px; padding-left:5px;" id="name" readonly=""  /></td>
</tr>
<tr>
	<td>Designation</td>
	<td>:</td>
	<td><input type="text" name="Designation" id="Designation"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></td>
</tr>

<tr>
	<td>Phone</td>
	<td>:</td>
	<td><input type="text" name="Email" id="Email"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></td>
</tr>

<tr>
	<td>Grand Salary</td>
	<td>:</td>
	<td><input type="text" name="paidAmount" id="paidAmount" placeholder="00.00" style="width:180px;  height:30px; padding-left:5px;"></td>
</tr>
<tr>
	<td colspan="3"></td>
</tr>
<tr>
	<td>Total Salary</td>
	<td>:</td>
	<td>
	 <input type="text" name="totalSalary" id="totalSalary" style="height: 30px">
	</td>
</tr>
<tr class="info">
	<td colspan="3" style="text-align: center;font-size: 18px; font-weight: bold;color: navy;">Futures Funds</td>
</tr>
<tr>
	<td>From Teacher</td>
	<td>:</td>
	<td>
	 <input type="text" name="fromTeacher" id="fromTeacher" style="height: 30px" onkeyup ="calculet()">
	</td>
</tr>
<tr>
	<td>From Institute</td>
	<td>:</td>
	<td>
	 <input type="text" name="fromSchool" id="fromSchool" style="height: 30px" onkeyup ="calculet()">
	</td>
</tr>
<tr>
	<td>Total Futures Funds</td>
	<td>:</td>
	<td>
	 <input type="text" name="totalFuture" id="totalFuture" style="height: 30px">
	</td>
</tr>
<tr>
	<td>Total Obtain Salary</td>
	<td>:</td>
	<td>
	 <input type="text" name="obtainSalary" id="obtainSalary" style="height: 30px">
	</td>
</tr>
<tr>
				<td align="right" colspan="3">
				<span id="showmsg"></span>
						<input type="button" id="payment" name="payment" value="Save" class="btn btn-danger btn-sm" onClick="return ADDandDelete()" />
						<button type="button" class="btn btn-sm btn-info">View</button>
							
				</td>
			</tr>
		</table>

      </div>
        </form>
 		<div class="col-md-10 col-md-offset-1" id="datatable" style="margin-top: 20px;">
        	
        </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>


  </body>
  
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
