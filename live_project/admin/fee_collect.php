
<?php

  error_reporting(1);
    @session_start();
    date_default_timezone_set("Asia/Dhaka");


    if($_SESSION["logstatus"] === "Active")
    {

  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  global $result_std_details;
  global $insert_fee_studnt;
  $db = new database();
   
// if(isset($_POST["id"]))
// {
//   $sql="SELECT voucher FROM `student_paid_table` WHERE `class_id`='311609230005' GROUP BY `voucher`";
//   $query=$db->link->query($sql);
// $id=1900000;
//   while($fetch_voucherid=$query->fetch_array())
//   {
//        //print $fetch_voucherid[0]."<br>";
//     $id++;

//     $u="UPDATE student_paid_table SET `voucher`='$id' WHERE `voucher`='$fetch_voucherid[0]'";
//     $q=$db->link->query($u);



//   }


// }




    
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>

  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
function check_all( parent_chk_bx_id, all_chk_bx_clss)
    {
      var x,r; 
      r = document.getElementsByClassName(all_chk_bx_clss);
      
      if(parent_chk_bx_id.checked== true)
      {
        for(x=0;x < r.length; x++)
        {
          r[x].checked = true;
       
        }
      }
      else
      {
        for(x=0;x < r.length; x++)
        {
          r[x].checked = false;
        
        }
      }
    }
  
  

    function enable_cb() {
    
         if($('#chkbx_all').is(':checked')){
            $("input.check_elmnt").prop('checked', true);
            totalShow();
            
         }else {
             $("input.check_elmnt").prop('checked', false);
              $('#showresult').html('');
              $('#totalShowAmount').val('');

         }
         
    }
    
  


    function checkinstallment()
{


        var class_name = $('#className').val();
        $.post("checkinstalment.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#instrument').html(result);
                   
                }
                else
                {
                 
                    $('#instrument').html('');
                }
                
           
                 
        });


    $('#name').val('');
    $('#roll').val('');
    $('#stdId').val('');
    $('#sms').html('');
    $('#showresult').html('');
    $('#totalShowAmount').val('');
    $('#showFees').html('');

}
   
function ShowInsWiseFee()
{

	

    var id =$('#stdId').val();
    var showData="feesss";
    var ClassId=$('#className').val();
 	var InstrumentId=$('#instrument').val();

 	if(InstrumentId!="Select One")
 	{

 		$("#insLoadin").html("Fee Title Loading...");
 	}
	var NewInsWiseFees = "ddfdfdfdfd";
	var year=$('#year').val();
        $.post("ajaxForFeeCollectionNew.php", { className: ClassId,checkFeeId:showData,id:id,year:year,InstrumentId:InstrumentId,NewInsWiseFees:NewInsWiseFees},
            function(result){
                
                if(result !=0 )
                {
                    //show that the username is available
                    $('#showFees').html(result);
                    $("#insLoadin").html("");
                   
                }
                else
                {
                 
                    $('#showFees').html('');
					
                }
                
           
                 
        });
}

function selectallfee(){


  if($('#selectall').is(':checked')){
            $('.titlewc').prop('checked', true);

              $('.rcv').prop('disabled', false);
               
           
         }else {
             $('.titlewc').prop('checked', false);
               $('.rcv').prop('disabled', true);
            
         }
         totalDueShow();
}

function viewFees(){

		var showins=$('#instrument').val();
		if(showins == "Select One"){
		
		$("#feetitleLoading").html("Loading Fee Title");
	var feesId = $('#chosen').val();
	 var id =$('#stdId').val();
   
    var ClassId=$('#className').val();
 	

	var year=$('#year').val();
	
						var SingleWiseFee = "ddd";
					  $.ajax({
          
                    type: "POST",
                    url: "ajaxForFeeCollectionNew.php",
                    data: {feesId:feesId,SingleWiseFee:SingleWiseFee,ClassId:ClassId,year:year,id:id},
                    cache: false,
                    success: function(data) {
						//alert(data);
                   $('#showFees').html(data);
                   $("#feetitleLoading").html("");
           
            }
            
          
          
                    });
					 $('#showFees').html("");
					
					
			
		
		}else {
				
				alert('Please Null this Instrument');
				return false;
				
		}
}

function addTemCart()
{
   var id =$('#stdId').val();
    var addCart="feesss";
    var ClassId=$('#className').val();
    var groupID=$('#groupname').val();
    var year=$('#year').val();
    var feeId=$('#list_fee').val();
    var date=$('#example2').val();
    if (feeId=="") 
    {
      alert("Please Select Fee Title");
        return false;
    }
        if (date=="") 
    {
      alert("Please Select Date");
        return false;
    }    
      if (id=="") 
    {
      alert("Please Select Student Id");
        return false;
    }
     $.ajax({
          
                    type: "POST",
                    url: "load_fee_cart.php",
                    data: {id:id,addCart:addCart,ClassId:ClassId,groupID:groupID,year:year,feeId:feeId,date:date},
                    cache: false,
                    success: function(data) {
                  $("#sms").html(data);
           
            }
            
          
          
                    });
}
     $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
function grandTotalWithDiscount(parameter)
{
var total=$('#total_'+parameter).val();
var dis=$('#dis_'+parameter).val();
    if(dis != ""){
 var due=total-dis;
$('#G_total_'+parameter).val(due);

}

}
function dueAmount(parameter)
{
var total=$('#G_total_'+parameter).val();
var paid=$('#paid_'+parameter).val();
    if(paid != ""){
 var due=total-paid;
$('#due_'+parameter).val(due);
sums();
}

}

function sums()
{


  var add = 0;
                $(".amt").each(function() {
                    add += Number($(this).val());
                });
                $("#totalShowAmount").val(add);

}

//  $(function() {

//             $(".totalSum").change(function() {
//                 var add = 0;
//                 alert(add);
//                 $(".amt").each(function() {
//                     add += Number($(this).val());
//                 });
//                 $("#totalShowAmount").val(add);
//             });
//         });
// }
//    $('input:checkbox').keyup(function(){ 
// var tot=0;
// $('input:checkbox:checked').each(function(){
// var total =$(this).val();
// alert(total);
// tot+=parseInt($(this).val());
// });
//      tot+=parseInt($('#more').val());
// $('#totalShowAmount').val(total)
// });

function month(parameter)
{
  var slots=$("#month_"+parameter).val();
  $("#resutlSlot_"+parameter).val(slots);
}


function checkdelete(parameter,sl)
{

var answer = confirm('Are you sure you want to delete this?');
if (answer)
{
  var id =parameter;
  var deleteted ="delete";
      $.ajax({
          
                    type: "POST",
                    url: "load_fee_cart.php",
                    data: {id:id,deleteted:deleteted},
                    cache: false,
                    success: function(data) {
                  $("#sms").html(data);
                  $("#tr_"+sl).remove();

            // showFee();
            }
            
          
          
                    });
}
else
{
 
}
 
}

$(document).ready(function(){




  $('#stdId').keyup(function(){
  
    var forFestdid = $(this).val();
    
    var ClassId=$('#className').val();
    var groupID=$('#groupname').val();
    var forAddFee = "dd";
    if(forFestdid != ""){
      $.ajax({
        url : "autoComSTd.php",
        data : {forFestdid:forFestdid,forAddFee:forAddFee,ClassId:ClassId,groupID:groupID},
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



function showIdby(){
     $('#showFees').html('');
	  $('#showmsg').html('');
	 
	 
var id =$('#stdId').val();
     
var name="nu";
var ClassId=$('#className').val();
var groupID=$('#groupname').val();
var lent =$('#stdId').val().length;
var year=$('#year').val();
$('#sms').html('');
if(lent > 2){
    //alert("anik");
     $.ajax({
          
                    type: "POST",
                    url: "ajaxForFeeCollectionNew.php",
                    data: {id:id,name:name,ClassId:ClassId,groupID:groupID,year:year},
                    cache: false,

                    success: function(data) {
                    
       // alert(data);
                        var a = data.split('/');
              
              var name = a[0];
              //alert(name);
              var roll = a[1];
              var previousPaid=a[2];
              $('#name').val(name);
              $('#roll').val(roll);
                $('#previousPaid').val(previousPaid);
               // showFee();
               sshowAccFees();
			   
            }
            
          
          
                    });
  
    }
  else{
              $('#name').val('');
              $('#roll').val('');
               $('#previousPaid').val('');

  }
}



    function sshowAccFees()
{


       var id =$('#stdId').val();
            var showInfee="feesss";
            var ClassId=$('#className').val();
            var groupID=$('#groupname').val();
            var year=$('#year').val();
         
          $.ajax({
          
                    type: "POST",
                    url: "ajaxForFeeCollectionNew.php",
                    data: {showInfee:showInfee,id:id,year:year,ClassId:ClassId},
                    cache: false,
                    success: function(data) {
				
					$("#dd").html(data);
                       
            
            }
            
          
          
                    });




}
   
   
   
   
  
        
        function ADDvalue(){
            var id =$('#stdId').val();
            var moredataV="feesss";
            var ClassId=$('#className').val();
            var groupID=$('#groupname').val();
            var year=$('#year').val();
           
            var paid=$('#totalShowAmount').val();
            
            if(id==''){
              alert('Please Enter The ID');
              return false;
            }
            if(ClassId=='Select Class'){
              alert('Please Select Class');
              return false;
            }
            
           
            if(year==''){
              alert('Please Enter The Year');
              return false;
            }
            
     
             $.ajax({
              type: "POST",
              url: "ajaxForFeeCollectionNew.php",
              data:$(".addfee").serialize() + "&moredataV=" + moredataV,
              cache: false,
              success: function(data) {
                   // parseInt($('#last_id').val(data));
					//$('#showmsg').html('Data Insert Successfully');
				//	location.reload();
                //showData();
                }
                
              
              
              });
        }
  
        function ADDvalues(){
        	 $("#ADD").attr('disabled', true);
        	 $("#loading").html("Loading...");

            var id =$('#stdId').val();
            var moredataV="feesss";
            var ClassId=$('#className').val();
            var groupID=$('#groupname').val();
            var year=$('#year').val();
           
            var paid=$('#totalShowAmount').val();
            
            if(id==''){
              alert('Please Enter The ID');
              return false;
            }
            if(ClassId=='Select Class'){
              alert('Please Select Class');
              return false;
            }
            
           
            if(year==''){
              alert('Please Enter The Year');
              return false;
            }
            
     
             $.ajax({
              type: "POST",
              url: "ajaxForFeeCollectionNew.php",
              data:$(".addfee").serialize() + "&moredataV=" + moredataV,
              cache: false,
              success: function(data) {
                    parseInt($('#last_id').val(data));
					//$('#showmsg').html('Data Insert Successfully');
					      
                showData();
                 location.reload();

                }
                
              
              
              });
        }

    function printData(){
            var id =$('#stdId').val();
            var lastId='dddd';
			var last_id = parseInt($('#last_id').val());
			
			var year=$('#year').val();
			var date=$('#example2').val();
			//alert(date);
			
			var clas = $('#className').val();
      

   window.open('student_print_vaocher.php?id="'+id+'"&Lid="'+lastId+'"&year="'+year+'"&date="'+date+'"&clas="'+clas+'"&last_id="'+last_id+'"',
  '_blank');
           
    }
	
	function showData(){
	  var id =$('#stdId').val();
            var lastId='dddd';
			var last_id = parseInt($('#last_id').val());
			
			var year=$('#year').val();
			var date=$('#example2').val();
			//alert(date);
			
			var clas = $('#className').val();
      

   window.open('student_print_vaocher.php?id="'+id+'"&Lid="'+lastId+'"&year="'+year+'"&date="'+date+'"&clas="'+clas+'"&last_id="'+last_id+'"',
  '_blank');
	}


    
    function backpage(){
        $('#frspage').show();
        $('#showfeeslist').hide();
    }
    
    function deletefordata(getId){
        var value=$('#delete-'+getId).val();
        var deletedata="ddd";
         $.ajax({
              type: "POST",
              url: "ajaxForFeeCollectionNew.php",
              data:{value:value,deletedata:deletedata},
              cache: false,
              success: function(data) {
                  
                  allview();
                
                }
                
              
              
              });
    }
	
	
	function showDue(getID){
				var netAmmount = parseFloat($('#netAmmount-'+getID).val());
				var paidAmm = parseFloat($('#paidAmm-'+getID).val());
				var ReciveAmm = parseFloat($('#ReciveAmm-'+getID).val());
				var OldDue = parseFloat($('#Due-'+getID).val());
				var grandTotal  = 0;
				
				if($('#paidAmm-'+getID).val() == ""){
				paidAmm= 0;
				}

				if(ReciveAmm != ""){
						var total = ReciveAmm+paidAmm;
						//alert(total);
							if(total <= netAmmount && ReciveAmm <= netAmmount){
							
									var due = netAmmount-total;
									$('#due-'+getID).val(due);
									grandTotal = grandTotal +  ReciveAmm;
									sums();
									
							}else {
							
							$('#due-'+getID).val(OldDue);
							$('#ReciveAmm-'+getID).val("");
							
							}
				}
	}
	
	
	function disss(getId) {
		
    // var a = getIdd.split('/');
    // var getId=a[0];
    //alert(a[1]);
        
				 if($('#FeesID-'+getId).is(':checked')){

         

				 		$("#ammount-"+getId).prop('disabled', false);
						$("#discount-"+getId).prop('disabled', false);
						$("#netAmmount-"+getId).prop('disabled', false);
						$("#paidAmm-"+getId).prop('disabled', false);
						$("#due-"+getId).prop('disabled', false);
						$("#ReciveAmm-"+getId).prop('disabled', false);
						
						
				 }else {

						$("#ammount-"+getId).prop('disabled', true);
						$("#discount-"+getId).prop('disabled', true);
						$("#netAmmount-"+getId).prop('disabled', true);
						$("#paidAmm-"+getId).prop('disabled', true);
						$("#due-"+getId).prop('disabled', true);
						$("#ReciveAmm-"+getId).prop('disabled', true);

            
				 }
         totalDueShow();
         sums();

				 
		}
		



    function totalDueShow(){
      
     // alert("hello");
      var fess = [];
 $("#totalDueAmountview").val("");
      $('.titlewc').each(function(){

        if($(this).is(":checked"))
        {
          fess.push($(this).val());

        }
      
      });

      var sumOfDue="sum";
       $.ajax({
          
                    type: "POST",
                    url: "ajaxForFeeCollectionNew.php",
                    data: {fess:fess,sumOfDue:sumOfDue},
                    cache: false,
                    success: function(dataa) {
                    
                        $("#totalDueAmountview").val(dataa);

                        var totalDeuamount=Number($('#totalShowAmount').val());
                        var due =dataa-totalDeuamount;

                        $("#totalDeeAmount").val(due);
            
            }
            
          
          
                    });
    
        }
        

		
		
		
function sums()
{
    var totalDeuamount=Number($('#totalDueAmountview').val());
 
  var add = 0;
                $(".rcv").each(function() {
                    add += Number($(this).val());
                });
                
                $("#totalShowAmount").val(add);
              
                 var due =totalDeuamount-add;

                 $("#totalDeeAmount").val(due);
}

		
    </script>
  
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
  margin-left:13px;
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
  <select id="more" name="more" style="display: none;">
    <option value="0 QR">0</option>

</select>
    <form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addfee">

    <div class="has-feedback col-xs-12    col-sm-8 col-lg-12 col-md-12"   id="frspage">
    <table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
        <tr>
          <td bgcolor="#f4f4f4"  class="warning" colspan="6"   bgcolor="#dddddd"    align="center"><span style="font-size:22px; color:#333; display:block;">Fee Collection</span>  </td>
        </tr>
      <tr>
      
        <td colspan="6">
          <div class="col-md-3"><select name="className" onChange="return checkinstallment()" class="form-control" required id="className"  style="width:100%; border-radius:0px;">
            <option>Select Class</option>
            <?php 
                $select_section = "SELECT * FROM `add_class`";
                $cheked_query=$db->select_query($select_section);
                if($cheked_query)
                {
                  while($fetchsection=$cheked_query->fetch_array())
                  {
              ?>
              <option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
              <?php }  } ?>
          
            
          </select>


      <span id="feetitleLoading" style=" font-weight: bold; color: GREEN; font-size: 16px;"> </span>
  </div>
         
          <div class="col-md-4">
        
             <input type="text" autocomplete="off" name="stdId"  onKeyUp="return showIdby()" class="form-control"  id="stdId" placeholder='Student ID' style="width:178px; border-radius:0px;" /> 
         
         


            <div id="idlist" class="ui-autocomplete"  style="text-align:left"></div>
         </div>


          <div class="col-md-2"><input type="text" required value="<?php echo date('Y')?>" class="form-control" style="width:100%;  padding-left:5px;border-radius:0px;" name="year" id="year"></input></div>
         <div class="col-md-3">
               <input type="text" id="example2" style="width: 100%;border-radius:0px;"class="form-control" placeholder="date"  name="date"  value="<?php echo date('d/m/Y') ?>" />
         </div>
        </td>
      </tr>
    
    
    <tr>
      <td colspan="6">
        <div class="col-md-4 table-bordered" >
              Name &nbsp;:<input type="text" class="form-control" style="width:100%;  padding-left:5px; margin-bottom:10px;  border-radius:0px;" name="name" id="name" readonly></input>
        </div>
        <div class="col-md-4 table-bordered">
        Roll &nbsp;:<input type="text" class="form-control" style="width:100%;   padding-left:5px; margin-bottom:10px; border-radius:0px;" name="roll" id="roll" readonly></input>
    
        </div>
         <div class="col-md-4 table-bordered">
        Previous Paid &nbsp;:<input type="text" class="form-control" style="width:100%;   padding-left:5px; margin-bottom:10px; border-radius:0px;" name="previousPaid" id="previousPaid" readonly></input>
    
        </div>
 
      </td>
      
    </tr>
        <tr>
      <td colspan="6" >
		<div class="col-md-6 table-bordered" style="height:90px;" >
Select Installment  &nbsp;:
            <select style="width:100%; padding-left:5px; margin-bottom:10px; border-radius:0px;"
             class="form-control" name="instrument" id="instrument" onChange="return ShowInsWiseFee()">
					
				<option>ALL</option>
         			
            </select>

            <span id="insLoadin" style=" font-weight: bold; color: GREEN; font-size: 16px;"> </span>
      </div>
    <div class="col-md-6 table-bordered" id="dd" style="height:90px;">
	<!--Select Fee's &nbsp; :
   <select style="width:100%; padding-left:5px; margin-bottom:10px; border-radius:0px;" class="form-control" name="showff"  onChange="return howInsWiseFee()">
					<option>Select One..</option>
         			
            </select>-->


  
	</div>
        
      </td>
      
    </tr>
    
    <tr>
        <td colspan="6" id="showFees">
				
		</td>
    </tr>
    <tr>
        <td colspan="6" id="sms" align="right"><span id="showmsg"></span></td>
    </tr>

   
          
         
   <tr>
  
     <td></td>
     <td></td>
   

      <td  class="text-right">
        Net Total : <input type="text" name="totalDueAmountview"  id="totalDueAmountview"  style="border-radius:0px;  height:30px; text-align: right;" readonly="readonly"> 
       
     </td>
   

     <td  class="text-right">
    Total Paid: <input type="text" name="totalAmo" id="totalShowAmount" style="border-radius:0px;  height:30px;" readonly="readonly"> 
     </td>

     <td  class="text-right">
    Due  : <input type="text" name="totalDues" id="totalDeeAmount"    style="border-radius:0px;  height:30px;" readonly="readonly"> 
     </td>
   

   
   </tr> 
        
        
        <tr>
          <td colspan="6" align="center">
		  <span id="loading" style=" font-weight: bold; color: GREEN; font-size: 18px;"> </span>&nbsp; &nbsp;

		   <input type="button" name="Save" id="ADD" value="Payment with report" style="width: 180px;"  class="btn btn-success" onClick="return ADDvalues()"/>
		  
		  <!--   <input type="submit" name="id" id="id" value="id" style="width: 180px;" /> -->
      
      
      
		  
		  
		  <input type="hidden" name="last_id" id="last_id" />
		  
		  
		  <b> <input type="checkbox" name="smsOk" id="sendSms" value="smsOk"> With Send SMS</b> </td>
        </tr>
</table>

  </form>
<script>
  jQuery(document).ready(function(){
      jQuery(".chosen").data("placeholder","Select Slot").chosen();
    });
</script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>


<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

