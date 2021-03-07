<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
    date_default_timezone_set('Asia/Dhaka');

	$db = new database();
	global $msg;
  
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
        <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
   
     <script src="datespicker/bootstrap-datepicker.js"></script>
     <script type="text/javascript">
         // When the document is ready
      

            //check group name 
  $(document).ready(function()
  {
        /*var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               
        }); */

        /* $('#groupname').change(function()
        {
            $('#check_section').html(checking_html);
                check_section_name();
                check_compolsary_subject();
                check_selective_subject();
                check_optional_subject();

        });*/ 
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
                  $('#section').html("");
                  $('#compolsarysubject').html("");
                  $('#selectivesubject').html("");
                  $('#selectivesubject').html("");
                  $('#select_optional_subject').html("");
                $('#check_optional_name').html('');
                 $('#check_selectivenae').html('');
                      $('#check_compol_name').html('');
                     $('#chek_section_name').html('');
                    $('#category_result').html('');
        });

}

//function to check username availability   
function check_section_name()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        $.post("check_section_name.php", { className: class_name,groupName:group_name },
            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#section').html(result);
                    $('#check_section').html("");
                    $('#chek_section_name').html('');

                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('chek_section_name').style.color='RED';
                    $('#chek_section_name').html('No Section Name Found');
                    $('#check_section').html("");
                    $('#section').html('');
                }
        });

}  
//function to check compolsary subject availability   
function check_compolsary_subject()
{
        var class_name = $('#className').val();
       var group_name = $('#groupname').val();
        $.post("check_compolsary_subject.php", { className: class_name, groupname:group_name},
            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#compolsarysubject').html(result);
                    
                    $('#check_compol_name').html('');

                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('check_compol_name').style.color='RED';
                    $('#check_compol_name').html('No Compolsary Subject Name Found');
                   
                    $('#compolsarysubject').html('');
                }
        });

}  
//function to check selective subject availability   
function check_selective_subject()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
       
        $.post("check_selective_subject.php", { className: class_name,group_name:group_name},
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#selectivesubject').html(result);
                    
                    $('#check_selectivenae').html('');

                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('check_selectivenae').style.color='RED';
                    $('#check_selectivenae').html('No Group Subject Name Found');
                    
                    $('#selectivesubject').html('');
                }
        });

} 
//function to check selective subject availability   
function check_optional_subject()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
       
        $.post("check_optional_subject.php", { className: class_name,group_name:group_name},
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#select_optional_subject').html(result);

                    $('#check_optional_name').html('');

                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('check_optional_name').style.color='RED';
                    $('#check_optional_name').html('No optional Subject Name Found');
                    
                    $('#select_optional_subject').html('');
                }
        });

}  

		function ShowAllsTd(){
		
			
			
		var session = $('#session').val();
		var classs = $('#class').val();
		
		var gpfffff = $('#gpfffff').val();
		
		
		var from = parseInt($('#from').val());
		var to = parseInt($('#to').val());
	
		var total =from+to;
		var autoID = "ddd";
		
		if(to <= 10){
			
			if(session != "" && to != "" ){
				if(from >=0){
				$.ajax({
				url : "AjaxForMultipleStudentReg.php",
				data : {autoID:autoID,session:session,to:to,from:from,classs:classs,gpfffff:gpfffff},
				type : "POST",
				success:function(data){
					
					$('#ShowMiddleTable').html(data);
					$('#showMsg').html("");
					
				}
			});
			}
			else{
				$('#showMsg').html("<strong><span class='text-danger'>Please Fill Up All Fields...!!</span></strong>");
			return false;
			}
			}
			else 
			{
			$('#showMsg').html("<strong><span class='text-danger'>Please Fill Up All Fields...!!</span></strong>");
			return false;
			}
			
			
		}else {
		
			$('#showMsg').html("<strong><span class='text-danger'>Limit should be 10...!!</span></strong>");
			$('#ShowMiddleTable').html('');
			return false;
		}
		
	}
	function check_all(){

		if($('#chkbx_all').is(':checked')){
				 		$('.check_elmnt').prop('checked', true);
						$('.roll').prop('disabled', false);
				 }else {
						 $('.roll').prop('disabled', true);
						$('.check_elmnt').prop('checked', false);
				 }
                 
	}

		function Submit(){
								

				var fromData =$('.passdata').serialize();
				//alert(gg);
				var from = parseInt($('#from').val());
				var to = parseInt($('#to').val());
			
				var total =from+to;
				
				var insert = "ddd";
				$.ajax({
				url : "insertMultipleStudent.php",
				data : fromData,
				type : "POST",
				success:function(data){
					$('#smsforR').html(data);
					$('#from').val(total);
					 ShowAllsTd();
				}
			});
		}
		function byroollcheked(rollId){
					if($('#chek-'+rollId).is(':checked')){
				 		$('#rollNo-'+rollId).prop('disabled', false);
						
				 }else {
						$('#rollNo-'+rollId).prop('disabled', true);
				 }
		}
		
		
function check_group()
{
        var class_name = $('#class').val();
		
		
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                 
                    $('#gpfffff').html(result);
                    
                }
                else
                {
                    //show that the username is NOT available
                   
                    $('#gpfffff').html('');
                }
					  
                
        });

}
  </script>

     </head>
   <body>
	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal passdata">
  <div   class="has-feedback  col-md-10  col-md-offset-1">
    <table align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;"><tr>
                <td   bgcolor="#f4f4f4" class="warning"   colspan="2"  bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;"><STRONG class='text-success'>Multiple Student From Fill Up</STRONG></span> </td>
            </tr>
			<tr>
				
				<td align="">
					<label for="session">Select Class</label><br/>
					<div class="col-md-8"><select class="form-control" id="class" name="class"  onChange="return check_group()">
                       <optgroup label="Select Class..">
                       <option>Select One</option>
					   		 <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `id` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
								if($fetch_class[2] != ""){
                        ?>
                        <option value="<?php echo "$fetch_class[0]and$fetch_class[0]" ?>"><?php echo $fetch_class[2];?></option>
                        <?php } } } ?>
						
						
					   </optgroup>
                        </select>
                        </div>
				</td>
				
				<td align="">
					<label for="session">Select Group</label><br/>
					<div class="col-md-8">
					<select class="form-control" id="gpfffff" name="gpfffff"> </select>
                        </div>
				</td>
				
				
				
					
				
			</tr>
			
			<tr>
			
			<td align="" colspan="2">
					<label for="session">Select Session</label><br/>
					<div class="col-md-8"><select class="form-control" id="session" name="session"
					 onChange="return ShowAllsTd()">
                       <optgroup label="Select One..">
                       <?php 
								$sessionsql = "SELECT `session2` FROM `student_acadamic_information` GROUP BY `student_acadamic_information`.`session2` ORDER BY `student_acadamic_information`.`session2` DESC";
								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str >5){
						?>
								
								<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?>
								
								<?php
											$sessionsql = "SELECT `session2` FROM `student_acadamic_information` GROUP BY `student_acadamic_information`.`session2` ORDER BY `student_acadamic_information`.`session2` DESC";
								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str ==4){
								?>
																<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?></optgroup>
                        </select>
                        </div>
				</td>
				
				
				
			
				
				
			</tr>
			<tr>
				<td align="center" colspan="3"> <input type="text"  name="from" id="from"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;"  onChange="return ShowAllsTd()">
-
<label for="to" class="text-warning">To Limit No - </label>
<input type="text" name="to" id="to"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;" />  &nbsp;&nbsp; <input type="button" name="submit" value="Search" onClick="return ShowAllsTd()" /></td>
			</tr>
			<tr>
				<td align="right" colspan="3"><span id="showMsg"></span></td>
			</tr>
	</table>
	<div id="ShowMiddleTable"></div>
	</form>
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
