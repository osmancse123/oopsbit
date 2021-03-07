<?php
@session_start();
	require_once("../db_connect/config.php");
	
	require_once("../db_connect/conect.php");
  global $result_std_details;
  global $insert_fee_studnt;
	$db = new database();
	 if(isset($_POST['searchbutton']))
   {
      $id=$db->escape($_POST['id']);
      $year=$db->escape($_POST['year']);
      $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
      @$exploide=explode('and', $class);
      if(!empty($id) && !empty($class)){

      $select="SELECT * FROM `running_student_info` WHERE `student_id`='$id' AND `class_id`='".$exploide[0]."'";
      $result_s=$db->select_query($select);
      if($result_s)
      {
        $select_Std_details="SELECT `running_student_info`.`student_id`,`class_roll`,`class_id`,`student_personal_info`.`student_name`,`add_class`.`class_name` FROM `running_student_info` 
INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
 WHERE `running_student_info`.`student_id`='$id' AND `running_student_info`.`class_id`='".$exploide[0]."'";

 //echo $select_Std_details;

    $result_std_details=$db->select_query($select_Std_details);
    if ($result_std_details) {
      $fetch_Student_details=$result_std_details->fetch_array();
    }
      }
    }
   }
   if(isset($_POST["Add"]))
   {
       $id=$db->escape($_POST['id']);
      $year=$db->escape($_POST['year2']);
      $classId=$db->escape($_POST['clsid']);
      
      if(!empty($_POST['name']) && !empty($_POST["roll"]))
      { 
  //     $selectStudentAccount="select id,fee_id,class_id,year from student_account_info WHERE id='$id'";
  //      $resultStudentAccount=$db->select_query($selectStudentAccount);
  //      if ($resultStudentAccount==true)
  //       {
  //     $fetch=$resultStudentAccount->fetch_array();
  // if ($fetch['id']==$id&&$fetch['class_id']== $classId&&$fetch['year']==$year)
  //   {
  //      echo "You Have Already Add Fee";
  //   }
  //   }
  //   else
  //   {
      $feedetails=count($_POST["fee"]);
      //print $feedetails;
      for($t = 0; $t < $feedetails ; $t++)
      {
        $insert_fee="INSERT INTO `student_account_info`(`id`,`class_id`,`fee_id`,`year`,`month`,`date`,`admin_id`) VALUES ('$id','".$_POST['clsid']."','".$_POST["fee"][$t]."','$year','".date('M')."','".date('d/m/y')."','1')";
        $insert_fee_studnt=$db->insert_query($insert_fee);
      }
    // }
    }
   }
   if (isset($_POST['Add3']))
    {
     echo "<script>location='student_class_group_wise_report.php?stdId=".$_POST['id']."'</script>";
   }
    if(isset($_GET['deleId']))
  {
    $stdid=$db->escape($_GET['stdid']);
    $classId=$db->escape($_GET['classId']);
    $yearId=$db->escape($_GET['yearId']);
    $linid=$db->escape($_GET['deleId']);
    $query="DELETE FROM `student_account_info` WHERE `id`='$stdid' and `class_id`='$classId' and `fee_id`='$linid' and `year`='$yearId'";
    $delete=$db->delete_query($query);
   $insert_fee="INSERT INTO `recent_delete_info`(`student_id`,`title`,`fee_id`,`date_time`,`admin_id`) VALUES ('$stdid','Delete From Student Account','$linid','".date('d/m/y')."','1')";
        $insert_fee_studnt=$db->insert_query($insert_fee);
    print "<script>location='add_fee_in_student_account.php'</script>";

  }
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
				 }
				 
		}
		
	


		function chekGroup()
{

        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                   
                }
                else
                {
                 
                    $('#groupname').html('');
                }
                
           
                 
        });
		$('#name').val('');
		$('#roll').val('');
		$('#stdId').val('');
		$('#sms').html('');
		$('#showresult').html('');
		$('#showFees').html('');

}
				
$(document).ready(function(){
	$('#stdId').keyup(function(){
	
		var fordiscountID = $(this).val();
		
		var ClassId=$('#className').val();
		var groupID=$('#groupname').val();
		var forDiscount = "dd";
		if(fordiscountID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {forDiscount:forDiscount,fordiscountID:fordiscountID,ClassId:ClassId,groupID:groupID},
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
				
var id =$('#stdId').val();
var name="nu";
var ClassId=$('#className').val();
var groupID=$('#groupname').val();
var lent =$('#stdId').val().length;
//alert(lent);
$('#sms').html('');
if(lent >4){
		//alert("anik");
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxfordiscount.php",
                    data: {id:id,name:name,ClassId:ClassId,groupID:groupID},
                    cache: false,
                    success: function(data) {
                    
						
                    		var a = data.split('/');
							
							var name = a[0];
							//alert(name);
							var roll = a[1];
							$('#name').val(name);
							$('#roll').val(roll);
							 showFee();
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#roll').val('');

	}
}

function showFee(){
		var id =$('#stdId').val();
		var showData="feesss";
		var ClassId=$('#className').val();
		var groupID=$('#groupname').val();
		var year=$('#year').val();
		
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxfordiscount.php",
                    data: {id:id,showData:showData,ClassId:ClassId,groupID:groupID,year:year},
                    cache: false,
                    success: function(data) {
                    
						$('#showFees').html(data);
						
						
						
						}
						
					
					
                    });
	
    }
	
	function showDATA(){
			var feeID=$('#feetitle').val();
				
			var ClassId=$('#className').val();
			var groupID=$('#groupname').val();
			var year=$('#year').val();
			var forShammount="ddd";
			if(feeID != "Select One.."){
					$.ajax({
		 			
                    type: "POST",
                    url: "ajaxfordiscount.php",
                    data: {forShammount:forShammount,feeID:feeID,ClassId:ClassId,groupID:groupID,year:year},
                    cache: false,
                    success: function(data) {
                    	
						$('#ammount').val(data);
						$('#discount').val('');
						}
						
					
					
                    });
			
			}
	}
	
	function MinusResult(getID){
		
			var feeAmmount = parseFloat($('#ammount-'+getID).val());
			var discount = parseFloat($('#discount-'+getID).val());
			if(feeAmmount >=    discount){
			
					var total = feeAmmount-discount;
					$('#paidAmmount-'+getID).val(total);
			}else {
			
				
				$('#discount-'+getID).val(0);
				$('#paidAmmount-'+getID).val(0);
				
			}
			
		
	}
	
	
	
				
				function ADDvalue(){
						var id =$('#stdId').val();
						var moredata="feesss";
						var ClassId=$('#className').val();
						var groupID=$('#groupname').val();
						var year=$('#year').val();
						var discount=$("#discount").val();
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
						
						if(discount==''){
							alert('Please Enter The Discount');
							return false;
						}
						
						
						 $.ajax({
							type: "POST",
							url: "ajaxfordiscount.php",
							data:$(".addfee").serialize() + "&moredata=" + moredata,
							cache: false,
							success: function(data) {
										
									$('#sms').html(data);
								
								}
								
							
							
							});
				}


		function allview(){
						var id =$('#stdId').val();
						var forView="feesss";
						var ClassId=$('#className').val();
					
						var year=$('#year').val();
						
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
						
							$('#frspage').hide();
							$('#showfeeslist').show();
						 $.ajax({
							type: "POST",
							url: "ajaxfordiscount.php",
							data:$(".addfee").serialize() + "&forView=" + forView,
							cache: false,
							success: function(data) {
										
									$('#showfeeslist').html(data);
								
								}
								
							
							
							});
		}
		
		function backpage(){
				$('#frspage').show();
				$('#showfeeslist').hide();
		}
		
		function deletefordata(getid){
				var value=$('#delete-'+getid).val();
				
				var deletedata="ddd";
				 $.ajax({
							type: "POST",
							url: "ajaxfordiscount.php",
							data:{value:value,deletedata:deletedata},
							cache: false,
							success: function(data) {
									
									allview();
								
								}
								
							
							
							});
		}
		
		
		function DesableUndis(getID){
		if($('#chekOne-'+getID).is(':checked')){
				 		$('#ammount-'+getID).prop('disabled', false);
						$('#discount-'+getID).prop('disabled', false);
						$('#paidAmmount-'+getID).prop('disabled', false);
						$('#refBy-'+getID).prop('disabled', false);
				 }else {
						$('#ammount-'+getID).prop('disabled', true);
						$('#discount-'+getID).prop('disabled', true);
						$('#paidAmmount-'+getID).prop('disabled', true);
						$('#refBy-'+getID).prop('disabled', true);
				 }
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addfee">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="frspage">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning"  colspan="6" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Discount</span>  </td>
  			</tr>
			<tr>
			
				<td colspan="6">
					<div class="col-md-4"><select name="className" class="form-control" onChange="return chekGroup()" required id="className"  style="width:100%; height:30px; border-radius:0px;">
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
					
						
					</select></div>
					
					<div class="col-md-3">


						<input type="text" autocomplete="off" name="stdId"   style="width:218px; height:30px; border-radius:0px;" class="form-control"  onKeyUp="return showIdby()"  id="stdId" placeholder='Student ID' />
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
					<div class="col-md-2"><input type="text" value="<?php echo date('Y')?>" class="form-control" style="width:100%; height:30px; padding-left:5px; margin-left:20px; border-radius:0px;" name="year" id="year"></input></div>
				</td>
			</tr>
  	
		
		<tr>
			<td colspan="6">
				<div class="col-md-6 table-bordered" >
							Name &nbsp;:<input type="text" style="width:100%; height:30px; padding-left:5px; margin-bottom:10px;" name="name" id="name"></input>
				</div>
				<div class="col-md-6 table-bordered">
				Roll &nbsp;:<input type="text" style="width:100%; height:30px; padding-left:5px; margin-bottom:10px;" name="roll" id="roll"></input>
		
				</div>
				
			</td>
		</tr>
		
		
		<tr>
				<td colspan="6" id="showFees"></td>
		</tr>
		<tr>
				<td colspan="6" id="sms" align="right"></td>
		</tr>
       
   
          
         
    
        
        
        <tr>
          <td colspan="6" align="center"><input type="button" name="ADD" id="ADD" value="ADD" style="width: 150px;"  class="btn btn-primary" onClick="return ADDvalue()"/>&nbsp;&nbsp;<button type="button" class="btn btn-primary" style="width: 150px;" name="Add3" onClick="return allview()">View Discount List</button> </td>
        </tr>
</table>
</div>
<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="showfeeslist">
</div>


	</form>
  
   
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>