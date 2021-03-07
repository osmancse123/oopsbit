<?php
  
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
/*    global $checked_std_info;
  global $insert_fee_studnt;
  if(isset($_POST["searchbutton"]))
  {
    
    $searstudent="SELECT * FROM `teachers_information` WHERE `teachers_id`='".$_POST['id']."'";
    $checked_std_info=$db->select_query($searstudent);
    
    if($checked_std_info)
    {
      
          $fetch_std_info=$checked_std_info->fetch_array();
    
    }
  }
$dateTime=date('d/m/Y');
$fetch[0]=$db->autogenerat('teacher_payable_master_table','pay_id','PaY-','9');
if (isset($_POST['save']))
 {
  $selectQ="SELECT * FROM `teacher_payable_master_table` where `teacher_id`='".$_POST['teacherIdno']."'";
  $selectdTable=$db->select_query($selectQ);
  if ($selectdTable) 
  {
    @$totalsa=$_POST['payableAmountf'];
    $fetch_data=$selectdTable->fetch_array();
    $payable=$fetch_data['pay_amount']+$totalsa;
    $updatess="UPDATE teacher_payable_master_table SET `payable_date`='$dateTime',`pay_amount`='$payable' where teacher_id='".$_POST['teacherIdno']."'";
    $update=$db->update_query($updatess);
  }
  else
  {
  $query="INSERT INTO `teacher_payable_master_table` (`pay_id`,`teacher_id`,`payable_date`,`pay_amount`,`user_id`) VALUES ('".$fetch[0]."','".$_POST['teacherIdno']."','$dateTime','".$_POST['payableAmountf']."','1')";
      $resultisnsert=$db->insert_query($query);
      $fetch[0]=$db->autogenerat('teacher_payable_master_table','pay_id','PaY-','9');
    }
}*/
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
  <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>

   
     <script src="datespicker/bootstrap-datepicker.js"></script>


    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
     $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
			
			
			
			$(document).ready(function(){
	$('#teacherId').keyup(function(){
			
		var teacherID = $(this).val();
		var forAdd = "dd";
		if(teacherID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {teacherID:teacherID,forAdd:forAdd},
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
if(lent > 9){
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
							
							 showPaymentTitle();
							 
							 
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Designation').val('');
							$('#Email').val('');

	}
}


function showPaymentTitle(){

				var showPaymentTitle = "ddd";
				 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherPaybal.php",
                    data: {showPaymentTitle:showPaymentTitle},
                    cache: false,
                    success: function(data) {
                    	
							 $('#showPaymentTitle').html(data);
							 
						}
						
					
					
                    });
	
}


function TeacherpaymentADd(){
		var add = "ddd";
				 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherPaybal.php",
                    data:$(".dataFrom").serialize() + "&add=" + add,
                    cache: false,
                    success: function(data) {
                    	
							 $('#showMsg').html(data);
							 showTeacherPayment();
							 
						}
						
					
					
                    });
	
}
function showTeacherPayment(){

		var showTeacherPayemntt="showPyament";

			 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherPaybal.php",
                    data:$(".dataFrom").serialize() + "&showTeacherPayemntt=" + showTeacherPayemntt,
                    cache: false,
                    success: function(data) {
                    	
							 $('#TeacherPaymentdataTable').html(data);
							
							 
							 
						}
						
					
					
                    });
}

function saveData(){
			var saveData  = "dd";
			 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxForTeacherPaybal.php",
                    data:$(".dataFrom").serialize() + "&saveData=" + saveData,
                    cache: false,
                    success: function(data) {
                    		
							 $('#showMsg').html(data);
							 location.reload();
							 
							 
						}
						
					
					
                    });
					
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
  <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal dataFrom">
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			
        <tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="8"  bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Teacher Payable Setting</span> </td>
  			</tr>
         
                
      
  			<tr>

  				<td  align="right" colspan="3"><strong><span class="text-justify text-success text-right">Teacher Id &nbsp;</span></strong></td>
  				<td  align="right" colspan="2">
<div class="col-md-3"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:178px;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
        
							</td>
<td colspan="3"></td>
  			</tr>

        <tr>
         		<td colspan="8">
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Name &nbsp; :</span></strong> <input  type="text" name="name" style="width:100%; height:30px; padding-left:5px;" id="name" readonly="" /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Designation &nbsp;:</span></strong> <input type="text" name="Designation" id="Designation"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
						<div class="col-md-4"><strong><span class="text-justify text-success text-right">Email &nbsp;:</span></strong> <input type="text" name="Email" id="Email"  style="width:100%;  height:30px; padding-left:5px;" readonly="" /></div>
				</td>   
        </tr>

			<tr>
					<td colspan="8">
							<div class="col-md-6"><strong><span class="text-justify text-success text-right">Section &nbsp;:</span></strong> 
							 <select  name="SHsection" id="SHsection" style="width:100%;  height:30px;"  required>
							 <option>Select One..</option>
							 <?php 
							 		$forclassSection="SELECT * FROM `add_class_section`";
									$resultClassection=$db->select_query($forclassSection);
										if($resultClassection->num_rows > 0){
												while($fetchClassSection=$resultClassection->fetch_array()){
							 ?>
          								<option value="<?php echo $fetchClassSection["id"]?>"><?php echo $fetchClassSection["Class_Section"];?></option>
         	<?php }  }?>
         </select>
							</div>
							<div class="col-md-6"><strong><span class="text-justify text-success text-right">Date &nbsp;:</span></strong>
							 <input type="text" id="example1" class="datess" name="date" value="<?php echo date('d/m/Y')?>" style="width:100%;  height:30px;"  placeholder="dd/mm/yy"></input>
							</div>
					</td>
			</tr>


			<tr>
					<td id="showPaymentTitle" colspan="8"></td>
			</tr>
        <!--	<tr>
          <td align="right"><strong><span class="text-justify text-success text-right">Section &nbsp;</span></strong>  </td>
          <td colspan="2">
          <div class="col-md-12" >
        
          </div>
          </td>
          
          <td align="right"><strong><span class="text-justify text-success text-right">Date &nbsp;</span></strong>  </td>
          <td colspan="3" >
          <div class="col-md-12" >
          
            <input type="text" id="example1" class="form-control datess" name="date"  placeholder="dd/mm/yy"></input>
        </div>
            </td>
            <?php 
              if($checked_std_info)
                { ?>
              <tr>
                <td colspan="2" align="center"><strong><span class="text-justify text-info"> Payment Title</span></strong></td>

                <td colspan="2" align="left"><strong><span class="text-justify text-info"> Amount</span></strong></td>
                <td align="center" colspan="3"><strong><span class="text-justify text-info">ADD</span></strong></td>
              </tr>
              <tr>
           <td colspan="2">
                <div class="col-md-10">
                  <select name="paymenttitle" class="form-control" id="payTitle">
                    <option selected disabled>select one</option>
                    <?php 
$queryAA="select * from add_payment_title";
    $resultAA=$db->select_query($queryAA);
    if ($resultAA>0) {
    while($a=$resultAA->fetch_array())
    {
                    ?>
                    <option value="<?php echo $a['id'] ?>"><?php echo $a['payment_title'] ?></option>
                    <?php
                  }}?>
                  </select>
                    
                  </div> 
                </td>
                <td colspan="2">
                  <input type="text" class="form-control" name="payedamount" id="payAmount"></input>
                </td>
                 </form>
                <td align="center"  colspan="3">
                  <button class="btn btn-info btn-sm add">ADD</button>
                </td>
              </tr>


              <?php }
            ?>

             
        </tr>-->
           <tr>
              
          <td colspan="8" align="center" id="TeacherPaymentdataTable">
            

            </td>
        </tr>
        <tr>
           <td colspan="7"  bgcolor="#f4f4f4" class="warning" colspan="7" bgcolor="#dddddd" align="center"  align="center" id="massg">
            </td>
           
         
        </tr>
         
        </table>
        </div>
 
  <script type="text/javascript">
//<!--$(document).ready(function(){
//$('.add').on('click', function() {
//var tchId=$('.tcherId').val();
//var dates=$('.datess').val();
//
//var post = $('.dataFrom').serialize(); 
////alert(tchId);
//jQuery.ajax({
//        type: "POST",
//        url: "insert_teacher_payment.php",
//        data: post,
//        cache: false,
//        success: function(datas)
//            {
//      
//        $("#massg").html(datas);
//        
//         $('#TeacherPaymentdataTable').load('loadTeacherPaymentDataTable.php?tchrId='+tchId+'&date='+dates);
// $('#payTitle').val('');
// $('#payAmount').val('');
//                }
//        });
// });
//
// });-->


  </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	</form>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
