  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	

 		if(isset($_POST["ResultGenerate"])){
			$classID=explode('and',$_POST["className"]);
			
			$examtype=explode('and',$_POST["examtype"]);
			$Session=$_POST["session"];
			$groupname = explode('and',$_POST["groupname"]);
			$stdRollfrom=$_POST["from"];
			$stdRollto=$_POST["to"];
			if(isset($classID) and $classID != "Select One" and isset($examtype) and $examtype != "Select Exam Name" and isset($Session) and $Session != "Select Session" ){
					print "<script>location='ajaxForShowSeatLevel.php?clID=$classID[0]&session=$Session&gpna=$groupname[0]&stdRollfrom=$stdRollfrom&stdRollto=$stdRollto&exam=$examtype[0]'</script>";
			}else{
					print "<script>window.close();</script>";
			}
			}	



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <script type="text/javascript">
             $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               Check_exam_type();
        });
    
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
                
                $('#subject_type').html("");
                $('#sub_name').html("");
                $('#part_name').html('');
                $('#subjectcode').val('');
                 
        });

}
//function to check exam type availability  
function Check_exam_type()
{
        var class_name = $('#className').val();
        $.post("Check_exam_type.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#examtype').html(result);
                    $('#checkingGroup').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    $('#checkingGroup').html('No Exam  Name Found');
                    $('#item_result').html("");
                    $('#examtype').html('');
                }

        });

} 
	
	
	
	
	
	
	
</script>
    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Generate Student seat Level </strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:100%; border-radius:0px">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` order by id asc";
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
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Group</span></strong></td>
                        <td ><div class="col-md-8">
                        <select name="groupname" id="groupname" class="form-control" style="width:100%; border-radius:0px">
						
						</select></div>
                    </tr>
					
					 <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Exam Name</span></strong></td>
                        <td ><div class="col-md-8">
                        <select name="examtype" id="examtype" class="form-control" style="width:100%; border-radius:0px">
								
						</select></div>
                    </tr>

                
                    
                <tr>
                    <td ><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="session" name="session" style="width:100%; border-radius:0px">
                       
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
				
                <tr><td colspan="2" align="center"><input type="submit" name="ResultGenerate" value="Show Seat Level" class="btn btn-danger btn-md" style="width: 180px" formtarget="_blank"></input>
				<!--<input type="button" name="submit" value="Update Result" class="btn btn-danger btn-md"  style="width: 180px" onClick="return ResultGene()"></input>
				<input type="button" name="submit" value="Show Total Student" class="btn btn-danger btn-md"  style="width: 180px" onClick="return totalStudent()"></input>--></td></tr>
                </table>
							
      </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
