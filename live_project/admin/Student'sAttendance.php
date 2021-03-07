<?php

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
	
    <link href="../css/bootstrap.min.css" rel="stylesheet"></head>
	 <script>
	 			
				 $(document).ready(function()
  {
		var checking_html = '<img src="search_group/loading.gif" /> Checking...';
		$('#selectClass').change(function()
		{
			$('#item_result').html(checking_html);
				check_availability();
				$('#showdata').html('');
				$('#Editdata').html('');
				$('#from').val('');
				$('#to').val('');
				$('#selectsubject').html('');
				$('#selectSubPart').html('');
		});	
		
		$('#selectGroup').change(function()
        {
          
				chekSubjectName();
				$('#showdata').html('');
				$('#Editdata').html('');
				  $('#selectSubPart').html('');
				  $('#from').val('');
				$('#to').val('');
				 
        });
		 
		$('#selectsubject').change(function()
        {
            $('#check_sub_name').html(checking_html);
              chek_subject_part();
			  $('#showdata').html('');
			  $('#Editdata').html('');
			  $('#from').val('');
				$('#to').val('');
               

        });
     
  });

//function to check username availability	
function check_availability()
{
		var class_name = $('#selectClass').val();
		$.post("check_grou_name.php", { className: class_name },
			function(result){
				//if the result is 1
				if(result != 1 )
				{
					//show that the username is available
					$('#selectGroup').html(result);
					$('#item_result').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#category_result').html('No Group Name Found');
					$('#item_result').html("");
					$('#select').html('');
				}
		});

}  
function chekSubjectName()
{
        var class_name = $('#selectClass').val();
        var group_name = $('#selectGroup').val();
      
        $.post("cheking_subject_name_forStudentAttendance.php", { className: class_name, groupName: group_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
					//alert(result);
                    $('#selectsubject').html(result);
                    $('#chek_type').html("");
                   

                }
                else
                {
                    
                    $('#chek_type').html("");
                    $('#selectsubject').html('');
                }
        });

}              

function chek_subject_part()
{
        var class_name = $('#selectClass').val();
	    var group_name = $('#selectGroup').val();
        var sub_name=$('#selectsubject').val();
        
        $.post("checking_subject_part_nameForstd.php", { className: class_name, groupName: group_name,  sub_name: sub_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
					 $("input#selectSubPart").prop('checked', false);
                    $('#selectSubPart').html(result);
                    $('#check_sub_name').html("");
                   

                }
                else
                {
                    
                    $('#check_sub_name').html("");
                    $('#selectSubPart').html('');
                }
        });
}

		
			function showStudent(){
				
			$('#showdata').show();
				$("#Editdata").hide();
				
				
			var morevalue="ddf";
			var classID=$('#selectClass').val();
			
			var gruID=$('#selectGroup').val();
			var selectsubject =$('#selectsubject').val();
			var selectSubPart =$('#selectSubPart').val();
			var from=parseInt($('#from').val());
			var to=parseInt($('#to').val());
			var total = to-from;
		
			if(total <=10 ){
			$('#smsshow').html('');
					$.ajax({
						url:"ajaxForStudentAttendace.php",
						type:"POST",
						data:{classID:classID,gruID:gruID,from:from,to:to,morevalue:morevalue,selectsubject:selectsubject,selectSubPart:selectSubPart},
						cache:false,
						success:function(data){
							//alert(data);
						
							$('#showdata').html(data);
							
							
						}
					});
					}
					else{
							$('#smsshow').html("<span class='text-center text-danger '><strong>&nbsp;limit are too long (at least 10)...</strong></span>");
							return false;
					
					}
			}
			
		function check_all( parent_chk_bx_id, all_chk_bx_clss)
			{
			//alert('asdf');
			var x,r; 
			r = document.getElementsByClassName(all_chk_bx_clss);
			w=r.length;
			//alert(w);
			if(parent_chk_bx_id.checked== true)
			{
				for(x=0;x < r.length; x++)
				{
					r[x].checked = true;
					//alert (r[x].value);
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
		
		$(function() {
		  enable_cb();
		  $("#chkbx_all").click(enable_cb);
		});
		
		function check_all() {
				 if($('#chkbx_all').is(':checked')){
				 		$("input.check_elmnt").prop('checked', true);
						$("input#group1").prop('disabled', true)
						$("input#group2").prop('disabled', true)
						
				 }else {
						 $("input.check_elmnt").prop('checked', false);
						 $("input#group1").prop('disabled', false)
						$("input#group2").prop('disabled', false)
				 }
		}
		
		
		
	
				function singleChek(getid){
					if($('#snchek-'+getid).is(':checked')){
						$("input.approved-"+getid).prop('disabled', true);
						$("input.Unapproved-"+getid).prop('disabled', true);
					}else{
					$("input.approved-"+getid).prop('disabled', false);
					$("input.Unapproved-"+getid).prop('disabled', false);
					}
				}
				
				function approvedFun(idget)
				{
					if($('.approved-'+idget).is(':checked')){
							$("input.Unapproved-"+idget).prop('disabled', true);
							$("input#snchek-"+idget).prop('disabled', true);
							$("input#attnTime-"+idget).prop('disabled', true);
							$("input#leavTime-"+idget).prop('disabled', true);
							
					}else{
						$("input.Unapproved-"+idget).prop('disabled', false);
						$("input#snchek-"+idget).prop('disabled', false);
						$("input#attnTime-"+idget).prop('disabled', false);
						$("input#leavTime-"+idget).prop('disabled', false);
					}
				}	
				
				function UNapprovedFun(iget)
				{
					if($('.Unapproved-'+iget).is(':checked')){
							$("input.approved-"+iget).prop('disabled', true);
							$("input#snchek-"+iget).prop('disabled', true);
							$("input#attnTime-"+iget).prop('disabled', true);
							$("input#leavTime-"+iget).prop('disabled', true);
					}else{
						$("input.approved-"+iget).prop('disabled', false);
						$("input#snchek-"+iget).prop('disabled', false);
						$("input#attnTime-"+iget).prop('disabled', false);
						$("input#leavTime-"+iget).prop('disabled', false);
					}
				}
				
				function AddPresent(){
				var morevalue="dd";
				
				$.ajax({
							url:"ajaxForStudentAttendace.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&addStudentDAta=" + morevalue,
							success:function(text)
							{		
								//alert(text);
								$("#sms").html(text);
							}
							
					});	
			}	
				
		function showEditAttendance(){
				$('#showdata').hide();
				$("#Editdata").show();
				var showdAtaForEdit="ddd";
				$.ajax({
							url:"ajaxForStudentAttendace.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&showdAtaForEdit=" + showdAtaForEdit,
							success:function(text)
							{		
								//alert(text);
								$("#Editdata").html(text);
							}
							
					});	
							
		}	
		
		function UpdatePreset(){
				var updateValue="dd";
					//alert(updateValue);
				$.ajax({
							url:"ajaxForStudentAttendace.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&updateValue=" + updateValue,
							success:function(text)
							{		
								//alert(text);
								$("#UpdateMas").html(text);
							}
							
					});	
			}	
			

				
	 </script>
	 
	 <body>
  	<form name="teacherinfo" action=""  method="post"  enctype="multipart/form-data" id="newFrom" class="form-horizontal addATeent" >
	 <div class="col-lg-12">
	 			
				 <table width="1075" c class="table table-bordered table-responsive" style="margin-top:10px; margin-bottom:0px">
						  <tr>
							<td colspan="5" align="center">&nbsp;<span class="text-success" style="font-size:18px;"><strong>Student's attendance</strong></span></td>
						  </tr>
						  
						  <tr>
						  	<td colspan="5">
									<div class="col-md-6">
											<label>Select Class</label>
											<select class="selectClass" id="selectClass" name="selectClass"  style="width:250px; height:30px; padding-left:5px;">
											<option value="Select Class">Select Class</option>
										<?php
												$selectClass="SELECT * FROM `add_class`";
												$resulClass=$db->select_query($selectClass);
													if($resulClass){
														while($fetch_class=$resulClass->fetch_array()){
										
										?>
										<option value="<?php echo $fetch_class["id"]?>"><?php echo $fetch_class["class_name"]?></option>
										<?php } }?>
									</select>
									</div>
									
									<div class="col-md-6">
									<label>Select Group</label>
									<select class="selectGroup" id="selectGroup" name="selectGroup" style="width:250px; padding-left:5px; height:30px;">
											
									</select>
										<input type="hidden" id="selectsubject" name="selectsubject" value="selectsubject" />
											<input type="hidden" id="selectsubject" name="selectsubject" value="selectSubPart" />
									</div>
							</td>
						  </tr>
						 
						
					<!--	
						  <tr>
						  
						  
						  		<td>Select Subject</td>
								<td colspan="2">
									<select class="selectsubject" id="selectsubject" name="selectsubject"  style="width:250px; height:30px; padding-left:5px;">
									</select>
								</td>
								<td>Select Subject Part</td>
								<td colspan="2"><select class="selectSubPart"  id="selectSubPart" name="selectSubPart" style="width:250px; padding-left:5px; height:30px;" required>
											
									</select></td>
						  		</tr>
						<tr>-->
						
						
						
						
						<tr>
						
								<td colspan="5" align="center">
										 <input type="text"   name="from" id="from"   style="width:50px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Roll No - </label>
<input type="text" name="to" id="to"  style="width:50px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;"/>&nbsp;&nbsp;&nbsp;&nbsp;<span id="smsshow"></span><br/>

<input type="button" name="" value="Submit"  onClick="return showStudent()"/>
								</td>
						</tr>
						
					
						
				</table>
				
					<span id="showdata"></span>
					<span id="Editdata"></span>
				</div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>