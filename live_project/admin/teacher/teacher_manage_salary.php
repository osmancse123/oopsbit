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
		if(teacherID != ""){
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
                    url: "../ajaxForTeacherPaybal.php",
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
							
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Designation').val('');
							$('#Email').val('');

	}
}



function ADDandDelete(){
	var AddandDelete  = "adddelete";

	var  paidAmount = $('#paidAmount').val();

	var teacherId =$('#teacherId').val();
	if(paidAmount != '' && teacherId !=''){
	 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxFormanageSalary.php",
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
	
	if(ShowHistory !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxFormanageSalary.php",
                    data:{view:ShowHistory,teacherId:teacherId},
                    cache: false,
                    success: function(data) {
							
                    			$('.dataFrom').hide();
                    			$('#datatable').show();
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

function back()
{
	$('.dataFrom').show();
	$('#datatable').hide();
}

function editSa(id)
{

$("#amount_"+id).show();
$("#title_"+id).hide();
$("#edit_"+id).hide();
$("#del_"+id).hide();
$("#up_"+id).show();
$("#rf_"+id).show();

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
  				<td bgcolor="#f4f4f4"  class="warning" colspan="3" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Teacher Manage Salary</span> </td>
  			</tr>
         
                
      
  			<tr>

  				<td  align="right" colspan="3">
<div class="col-md-3"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:178px;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
        
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
				<td align="right" colspan="3">
				<span id="showmsg"></span>
						<input type="button" id="payment" name="payment" value="Save" class="btn btn-danger btn-sm" onClick="return ADDandDelete()" />
						<button type="button" class="btn btn-sm btn-info" onclick="paymentHistoryF()">View</button>
							
				</td>
			</tr>
		</table>
		
	
       
      </div>
        </form>
 		<div class="col-md-10 col-md-offset-1" id="datatable" style="margin-top: 20px;">
        	
        </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
function refreash(id)
{
   $("#amount_"+id).hide();
$("#title_"+id).show();
$("#edit_"+id).show();

    $("#up_"+id).hide();
    $("#rf_"+id).hide();
    $("#del_"+id).show();
}
function ForUpdate(id)
{
  var Mid=id;
  var update="update";
   var amount=$("#amount_"+id).val();
  

 $.post("ajaxFormanageSalary.php", { Mid: Mid,update:update,amount:amount },
            function(result){
               
                if(result !=0 )
                {
                  
                  $("#sms").html(result);
       $("#amount_"+id).hide();
       var amount=$("#amount_"+id).val();
$("#title_"+id).show();
$("#title_"+id).html(amount);
$("#edit_"+id).show();

    $("#up_"+id).hide();
    $("#rf_"+id).hide();
    $("#del_"+id).show();
                }
                else
                {
  
                }

        });
            
}
function Fordelete(id)
{
  var Mid=id;
  var deleteS="delete";
   var title=$("#amount_"+id).val();

 $.post("ajaxFormanageSalary.php", { Mid: Mid,deleteS:deleteS },
            function(result){
               
                if(result !=0 )
                {
                   $("#sms").html(result);
          
                  $("#tr_"+id).hide("slow");
        
                }
                else
                {
  
                }

        });
            
}
    </script>

  </body>
  
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
