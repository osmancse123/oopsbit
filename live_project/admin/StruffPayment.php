<?php
 
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{ /*require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
  	global $msg;
    global $result_std_details;
    global $result_Teacher;
    global $checked_searc;
    $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
  
  if(isset($_POST["searchbutton"]))
    {
	$searTeracher="SELECT * FROM `teacher_payable_master_table` WHERE `teacher_id`='".$_POST['id']."'";
      $checked_searc=$db->select_query($searTeracher);
    
      if($checked_searc)
      {
        $fetch_techer=$checked_searc->fetch_array();
        $teacherInfo="SELECT `teachers_information`.`teachers_name`,`teachers_information`.`mobile_no`,`teachers_information`.`email` FROM  `teacher_payable_master_table` 
		INNER JOIN `teachers_information` ON `teacher_payable_master_table`.`teacher_id`=`teachers_information`.`teachers_id` 
   		WHERE `teacher_payable_master_table`.`teacher_id`='".$fetch_techer['teacher_id']."'"; 
      $result_Teacher=$db->select_query($teacherInfo);
        if($result_Teacher)
        {
            $fetch_teacher=$result_Teacher->fetch_array();
        }
      }
    }   
  $makeid=$db->autogenerat('teacher_payment_history','id','PID-','9');
   $makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
    if(isset($_POST["save"]))
    {
      @$tchid=$_POST['id'];
     if(!empty($_POST['id']) && !empty($_POST['paidAmount']))
		{
        $insert_fee="INSERT INTO `teacher_payment_history` (`id`,`teacher_id`,`date`,`year`,`current_amount`,`payment_amout`,`user_id`) VALUES('$makeid','".$_POST['id']."','".date('d/m/Y')."','".date('Y')."','".$_POST['totalpayable']."','".$_POST['paidAmount']."','1')";
        $check_insert=$db->insert_query($insert_fee);
          
          $aa=$_POST['totalpayable'];
          $bb=$_POST['paidAmount'];
          $currentAmount=$aa-$bb;
          $updateQuery="UPDATE `teacher_payable_master_table` SET `pay_amount`='$currentAmount', `last_payment`='".$_POST['paidAmount']."', `last_payment_date`='".date('d/m/Y')."' WHERE `teacher_id`='".$_POST['id']."'";
       	$update=$db->update_query($updateQuery);
        $insert_cost="INSERT INTO `other_cost` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES('$makeidCost','".date('d/m/Y')."','Teacher Payment','$makeid-".$_POST['teacherName']."','".$_POST['paidAmount']."','1')";
        $check_insertAA=$db->insert_query($insert_cost);
       echo "<script>location='teacher_recipt.php?techid=$tchid&id=$makeid'</script>";
       $makeid=$db->autogenerat('teacher_payment_history','id','PID-','9');
        $makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
       }
       else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
    }
    // //link dlt data.....................................
    // if(isset($_GET['dlt']))
    // {
    //   $linid=$db->escape($_GET['dlt']);
    //   $query="DELETE FROM `add_discount` WHERE `discount_id`='$linid'";
    //   $delete=$db->delete_query($query);
    //  $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
    //   print "<script>location='Adddiscount.php'</script";
  
    // }*/
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
	$('#struffID').keyup(function(){
	$('#totalpayable').val('');
	$('#paidAmount').val('');
	$('#duammmount').val('');
		var struffID = $(this).val();
		var forSturffPayableSetting = "dd";
		if(struffID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {struffID:struffID,forSturffPayableSetting:forSturffPayableSetting},
				type : "POST",
				success:function(data){
					$('#idlist').fadeIn();
					$('#idlist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#struffID').val($(this).text());
			$('#idlist').fadeOut();
			showIdby();
			
		});
});

function showIdby(){
				
var id =$('#struffID').val();
var name="nu";

//alert(lent);
var lent =$('#struffID').val().length;
$('#showPaymentTitle').html('');
$('#TeacherPaymentdataTable').html('');
$('#sms').html('');
if(lent > 9){
		//alert("anik");
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForStruffPayment.php",
                    data: {id:id,name:name},
                    cache: false,
                    success: function(data) {
                    
                    	
							var a = data.split('/');
							
							var name = a[0];
							//alert(name);
							var designation = a[1];
							var  Mobile = a[2];
							
							$('#name').val(name);
							$('#Designation').val(designation);
							$('#Mobile').val(Mobile);
							
							 showpaybalAmmount();
							 
							 
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Designation').val('');
							$('#Mobile').val('');

	}
}


function showpaybalAmmount(){
var id =$('#struffID').val();
var paybalAMmount="nu";

 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForStruffPayment.php",
                    data: {id:id,paybalAMmount:paybalAMmount},
                    cache: false,
                    success: function(data) {
									
										
                    			$('#totalpayable').val(data);
								Calculate();
							
						}
						
					
					
                    });


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
	var struffName = $('#name').val();
	var struffID =$('#struffID').val();
	if(paidAmount != '' && struffID !='' && duammmount !='' ){
	 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForStruffPayment.php",
                    data:{AddandDelete:AddandDelete,totalpayable:totalpayable,paidAmount:paidAmount,duammmount:duammmount,struffName:struffName,struffID:struffID},
                    cache: false,
                    success: function(data) {
										
										
                    			$('#showmsg').html(data);
								 showpaybalAmmount();
								 Calculate();
								 
								 $('#frstPage').hide();
								 $('#datatable').show();
								 ShowHistoryTeacher();
							
						}
						
					
					
                    });
					}else {
						alert('Please Fill Up All  Fields..!!');
							return false;
					}
}


function ShowHistoryTeacher(){
		 var showDAta = 'showData';
	var struffID =$('#struffID').val();
	if(struffID !=''){
		$.ajax({
		 			
                    type: "POST",
                    url: "ajaxForStruffPayment.php",
                    data:{showDAta:showDAta,struffID:struffID},
                    cache: false,
                    success: function(data) {
							
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
    <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal addData">
      <div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="frstPage">
        	<table align="center" class="table table-responsive box"  style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			
        <tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="8" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Struff Payment</span> </td>
  			</tr>
         
                
      
  			<tr>

  				<td  align="right" colspan="3"><strong><span class="text-justify text-success text-right">Struff Id &nbsp; :</span></strong></td>
  				<td  align="right" colspan="2">
<div class="col-md-3"> <input type="text" autocomplete="off" name="struffID"  onKeyUp="return showIdby()"  id="struffID" placeholder='Struff ID' style="width:178px;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
        
							</td>
<td colspan="3"></td>
  			</tr>

        <tr>
         		<td colspan="8">
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Name &nbsp; :</span></strong> <input  type="text" name="name" style="width:100%; height:30px; padding-left:5px;" id="name"readonly=""  /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Designation &nbsp;:</span></strong> <input type="text" name="Designation" id="Designation"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Mobile No &nbsp;:</span></strong> <input type="text" name="Mobile" id="Mobile"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
				</td>   
        </tr>
		
		<tr>

				<td colspan="7" align="right"><strong><span class="text-justify text-success text-right">Payable Amount: &nbsp;</span></strong>  </td>
				<tD>
					
				 <input type="text"  name="totalpayable" id="totalpayable" placeholder="00.00" style="width:180px; height:30px; padding-left:5px;" readonly=""/></tD>
		</tr>
		<tr>
				<td colspan="7" align="right"><strong><span class="text-justify text-success text-right">	Payment Amount: &nbsp;</span></strong>  </td>
				<tD>   <input type="text" name="paidAmount" id="paidAmount" placeholder="00.00" onKeyUp="return Calculate()"  style="width:180px;  height:30px; padding-left:5px;"></input></tD>
		</tr>
		
		<tr>
				<td colspan="7" align="right"><strong><span class="text-justify text-success text-right">Due Ammount &nbsp;</span></strong>  </td>
				<tD> <input type="text"  name="duammmount" id="duammmount" placeholder="00.00" style="width:180px;  height:30px; padding-left:5px;"  readonly=""/></tD>
		</tr>
			<tr>
				<td align="right" colspan="8"><span id="showmsg"></span></td>
			</tr>
			<tr>
				<td align="right" colspan="8">
						<input type="button" id="payment" name="payment" value="Payment" class="btn btn-danger btn-sm" onClick="return ADDandDelete()" />
				</td>
			</tr>
		</table>
		
		
       
       
      </div>
 		<div class="col-md-10 col-md-offset-1" id="datatable">
        	
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
  </form>
  </body>
  
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
