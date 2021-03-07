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

function StudentShow(){
	
			var ClassId=$('#className').val();
			var Session=$('#session').val();
			var groupname=$('#groupname').val();
			var from =parseInt($('#from').val());
			var to =parseInt($('#to').val());
			var StringDataddddd = "ddddd";
			if(ClassId == "Select One")
			{
					alert("Please Select Class Name");
					return false;
			}
			
			if(groupname == "Select Group")
			{
					alert("Please Select Group Name");
					return false;
			}
			
			if(Session == "Select Session")
			{
					alert("Please Select Session");
					return false;
			}
			
			if(from == "" && to == ""){
				alert("Please Enter The Limit");
					return false;
			}
			var total = to-from;
			//alert(total);
			if(total <= 50){
			
			$.ajax({
				url:"ajaxForStudentPassward.php",
				type:"POST",
				data:{ClassId:ClassId,groupname:groupname,Session:Session,StringDataddddd:StringDataddddd,from:from,to:to},
				cache:false,
				success:function(data){
					//alert(data);
					$('#showDataInRoll').html(data);
					$('#showMsg').html('');
					
				}
			});
			}else {
					$('#showDataInRoll').html("");
					$('#showMsg').html('Limit less than 50 or equal');
			}
			
			
	}
	
	function check_all(){
		if($('#chkbx_all').is(':checked')){
				 		$('.check_elmnt').prop('checked', true);
						$('.dd').prop('disabled', false);
						
				 }else { 
						$('.check_elmnt').prop('checked', false);
						$('.dd').prop('disabled', true);
				 }
	}
	
	
	
	
		function Saveff(){
								

				var fromData =$('.passdata').serialize();
				//alert(gg);
				var from = parseInt($('#from').val());
				var to = parseInt($('#to').val());
			
				var total =to-from;
				var inc = to+1;
				var limit = inc +total;
				var insert = "ddd";
				$.ajax({
				url : "ajaxForStudentPassward.php",
				data : fromData,
				type : "POST",
				success:function(data){
				
					$('#showMsg').html("Insert Successfully");
					$('#to').val(limit);
					$('#from').val(inc);
					 StudentShow();
				}
			});
		}
		function byroollcheked(rollId){
					if($('#checkboxsingId-'+rollId).is(':checked')){
				 		$('#passward-'+rollId).prop('disabled', false);
						
				 }else {
						$('#passward-'+rollId).prop('disabled', true);
				 }
		}
  </script>

     </head>
   <body>
	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal passdata">
  			
			<div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Generate Student's passwards..</strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className"  style="width:280px; border-radius:0px;" onChange="return check_availability()">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `class_name` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
                        ?>
                        <option value="<?php echo "$fetch_class[0]and$fetch_class[2]"?>"><?php echo $fetch_class[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select></div>
                    </tr>
      <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                      	<select name="groupname" id="groupname" class="form-control" style="width:280px; border-radius:0px;">
								<?php
							
								if($chek)
								{
							?>
							<option value="<?php echo "$fetch[3]and$fetch[9]"?>"><?php echo $fetch[9];?></option>
							<?php } ?>
						</select></div>
                    </tr>
                   

                    
                <tr>
                    <td ><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="session" name="session"  style="width:280px; border-radius:0px;">
                        <option>Select Session</option>
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
								<?php   } } } ?>
                        </select>
                        </div>
                        </td>
                </tr>
				<tr>
					<Td colspan="2" align="center">
						 <input type="text"  name="from" id="from"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Limit No - </label>
<input type="text" name="to" id="to"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;"/>
					</Td>
				</tr>
				<tr>
					<Td colspan="2" align="right">
								<strong style="font-weight:bold; font-size:15px"><span id="showMsg" class="text-danger"></span></strong>
								<strong id="runnigmsg" class="text-danger" style="font-weight:bold; font-size:15px"></strong>
								
					</Td>
				</tr>
				
                <tr><td colspan="2" align="center"><input type="button" name="ResultGenerate" value="Show Student" class="btn btn-danger btn-md" style="width: 180px" onClick="return StudentShow()"></input>
				</td></tr>
                </table>
							
                </div>
				
				<div id="showDataInRoll"></div>
	</form>
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
