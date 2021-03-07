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
	  <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
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
				$('#fromdate').val('');
				$('#todate').val('');
				$('#stdId').val('');
				$('#selectsubject').html('');
				$('#selectSubPart').html('');
		});	
		
		$('#selectGroup').change(function()
        {
          
				chekSubjectName();
				$('#showdata').html('');
				$('#Editdata').html('');
				  $('#selectSubPart').html('');
				$('#fromdate').val('');
				$('#todate').val('');
				$('#stdId').val('');
				 
        });
		 
		$('#selectsubject').change(function()
        {
            $('#check_sub_name').html(checking_html);
              chek_subject_part();
			  $('#showdata').html('');
			  $('#Editdata').html('');
			$('#fromdate').val('');
				$('#todate').val('');
				$('#stdId').val('');

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
			
			
			
			
			
			 $(document).ready(function () {
                    
                    $('#fromdate').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });
				
				   $(document).ready(function () {
                    
                    $('#todate').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });
				
				$(document).ready(function(){
	$('#stdId').keyup(function(){
		var attendacID = $(this).val();
		var forattendance = "dd";
		if(attendacID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {attendacID:attendacID,forattendance:forattendance},
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



function ShowData(){
				var updateValue="dd";
				
					
				$.ajax({
							url:"ajaxForSingleStudentAttendanceReportDateWise.php",
							type:"POST",
							data:$(".addATeent").serialize() + "&updateValue=" + updateValue,
							success:function(text)
							{		
								//alert(text);
								$("#showdata").html(text);
							}
							
					});	
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
  margin-left:500px;
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
  <style>
	@media print{
			#noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontPritntd{
			display:none;
			}
			@page 
			{
				size:  auto;   /* auto is the initial value */
				margin: 0mm;  /* this affects the margin in the printer settings */
			}
		
			html
			{
				background-color: #FFFFFF; 
				margin: 0px;  /* this affects the margin on the html before sending to printer */
			}
		
			body
			{
				border: solid 0px blue ;
				margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
			}
		}
</style>
	 <body>
  	<form name="teacherinfo" action=""  method="post"  enctype="multipart/form-data" id="newFrom" class="form-horizontal addATeent" >
	 <div class="col-lg-12">
	 			
				 <table width="1075" id="noneBtnForprin"  class="table table-bordered table-responsive" style="margin-top:10px; margin-bottom:0px">
						  <tr>
							<td colspan="5" align="center">&nbsp;<span class="text-success" style="font-size:18px;"><strong>Subject Wise Student's Attendance</strong></span></td>
						  </tr>
						  <tr>
						  		<td>Select Class</td>
								<td colspan="2">
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
								</td>
								<td>Select Group</td>
								<td colspan="2"><select class="selectGroup" id="selectGroup" name="selectGroup" style="width:250px; padding-left:5px; height:30px;">
											
									</select></td>
						  		</tr>
						
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
						<tr>
						<tr align="right">
						 <td colspan="5"><div class="col-md-8">
							<span>Student ID</span>	&nbsp;&nbsp;<input type="text" autocomplete="off" name="stdId"  id="stdId" placeholder='Student ID'/>
								<div id="idlist" class="ui-autocomplete" style="text-align:left"></div>
                		</div>
                      
                        </td>
						</tr>
						<tr>
						
								<td colspan="5" align="center">

									<span>From Date </span>&nbsp; &nbsp; <input type="text" name="fromdate"  id="fromdate" style="width:185px;" />&nbsp;
									<span>To Date </span>&nbsp; &nbsp; <input type="text" name="todate"  id="todate" style="width:185px;"/>
								</td>
						</tr>
						
						<tr>
						
								<td colspan="5" align="center">

								 <input type="button"  value="Submit"  onClick="return ShowData()" /><span>
								</td>
						</tr>
						
					
						
				</table>
				
					<span id="showdata"></span>
			</div>
  </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>