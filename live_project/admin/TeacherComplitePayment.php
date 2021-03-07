<?php
 
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{ 
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
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
		if(teacherID != "" && month!=null && year!=null){
			$.ajax({
				url : "autoComSTd.php",
				data : {teacherID:teacherID,forTeacherPay:forTeacherPaybalSeettion},
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
                    url: "ajaxForTeacherPaybal.php",
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
				
							showTotalAmount();
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Designation').val('');
							$('#Email').val('');

	}
}




function Calculate(){

		var payableammout= parseFloat($('#totalpayable').val());
		var paidAmount= parseFloat($('#paidAmount').val());
		var totolminus = 0;
		$('#duammmount').val('');
			if(paidAmount => 0  && paidAmount!=''){
						if(payableammout == paidAmount || paidAmount < payableammout){
						totolminus = 	payableammout-paidAmount;
						
						
						$('#duammmount').val(totolminus);
					}else{
					
						$('#paidAmount').val('');
						$('#duammmount').val('');
					}
			}
}


function ADDandDelete(){
	var AddandDelete  = "adddelete";
	var totalpayable= parseFloat($('#totalpayable').val());
	var paidAmount = parseFloat($('#paidAmount').val());
	var  duammmount = $('#duammmount').val();
	var teacherName = $('#name').val();
	var teacherId =$('#teacherId').val();
	if(paidAmount != '' && teacherId !='' && duammmount !='' ){
	 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxforCompletepaymet.php",
                    data:$(".dataFrom").serialize() + "&AddandDelete=" + AddandDelete,
                    cache: false,
                   dataType: "json",
                    success: function(data) {
										
										
                    			$('#showmsg').html(data.sms);
                    			$('#payId').val(data.payId);
print();
							
						}
						
					
					
                    });
					}else {
						alert('Please Fill Up All  Fields..!!');
							return false;
					}
}


function ShowHistoryTeacher(){
		 var showDAta = 'showData';
	var teacherId =$('#teacherId').val();
	var payId =$('#payId').val();
	if(teacherId !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxforCompletepaymet.php",
                    data:{showDAta:showDAta,teacherId:teacherId,payId:payId},
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
function paymentHistoryF(){
		 var ShowHistory = 'showData';
	var teacherId =$('#teacherId').val();
	
	if(teacherId !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxforCompletepaymet.php",
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

function showTotalAmount()
{
	var showPaymentTitle = 'showData';
	var teacherId =$('#teacherId').val();
	var year =$('#year').val();
	var month =$('#month').val();
	if(teacherId !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxforCompletepaymet.php",
                    data:{showPaymentTitle:showPaymentTitle,teacherId:teacherId,year:year,month:month},
                    cache: false,
                     dataType: "json",
                    success: function(data) {
							
                    			$('#total_amount').val(data.tota);
			
						}
						
					
					
                    });
					
					}else{
			
							alert('Please Fill Up All  Fields..!!');
							return false;
							 
								
					}
}

    function print(){
            var id =$('#teacherId').val();
            var lastId=$('#payId').val();
      

   window.open('teacher/teacher_payment_report.php?id="'+id+'"&&Lid="'+lastId+'"',
  '_blank');
           
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
        	<table align="center" class="table table-responsive box"  style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			
        <tr>
  				<td bgcolor="#f4f4f4"  class="warning" colspan="8" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Teacher Payment</span> </td>
  			</tr>
         
                
      
  			<tr>
<td colspan="4" align="left">
<select style="height: 30px; width: 150px;" id="month" name="month">
	<option selected="" disabled="">Select Month</option>
	<?php
$sql="select * from teacher_future_funds group by month";
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
<select style="height: 30px; width: 150px;" id="year" name="year">
	<option selected="" disabled="">Select Year</option>
	<?php
$sql="select * from teacher_future_funds group by year";
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
  				<td  align="right" colspan="2"><strong><span class="text-justify text-success text-right">Teacher Id &nbsp; :</span></strong></td>
  				<td  align="right" colspan="2">
<div class="col-md-3"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:178px;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
        
							</td>

  			</tr>

        <tr>
         		<td colspan="8">
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Name &nbsp; :</span></strong> <input  type="text" name="name" style="width:100%; height:30px; padding-left:5px;" id="name" readonly=""  /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Designation &nbsp;:</span></strong> <input type="text" name="Designation" id="Designation"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Email &nbsp;:</span></strong> <input type="text" name="Email" id="Email"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
				</td>   
        </tr>
        <tr>
        	<td colspan="8">
        		
        		<div id="show_title">
        			
        		</div>
        	</td>
        </tr>
		
		<tr>
				<td colspan="7" align="right"><strong><span class="text-justify text-success text-right">Total Salary: &nbsp;</span></strong>  </td>
				<tD>   <input type="text" name="total_amount" id="total_amount" placeholder="00.00"   style="width:180px;  height:30px; padding-left:5px;"></input></tD>
		</tr>
		
		<tr>
				<td colspan="7" align="right"><strong><span class="text-justify text-success text-right">Pay Amount &nbsp;</span></strong>  </td>
				<tD> <input type="text"  name="payAmount" id="duammmount" placeholder="00.00" style="width:180px;  height:30px; padding-left:5px;"/></tD>
		</tr>
			<tr>
				<td align="right" colspan="8"><span id="showmsg"></span></td>
			</tr>
			<tr>
				<td align="right" colspan="8">
						<input type="button" id="payment" name="payment" value="Payment" class="btn btn-danger btn-sm" onClick="return ADDandDelete()" />
							<input type="button" id="paymentHistory" name="history" value="Payment History" class="btn btn-info btn-sm" onClick="paymentHistoryF()" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="payId" id="payId">
       
       
      </div>
        </form>
 		<div class="col-md-10 col-md-offset-1" id="datatable" style="margin-top: 20px;">
        	
        </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
/*$(document).ready(function(){
$('.view').on('click', function() {
	var tchId=$('.tcherId').val();

         $('.datatable').load('loadTeacherPaymentHistoryTable.php?tchrId='+tchId);
	 });

 });*/
    </script>

  </body>
  
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
