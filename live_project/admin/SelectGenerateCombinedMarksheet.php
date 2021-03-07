<!-- SelectGenerateCombinedMarksheet.php -->

  <?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
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


function generate()
{
	var checking_html = '<img src="search_group/loading.gif" /> Checking...';
	$('#message').html(checking_html);

        var className = $('#className').val();
         var groupname = $('#groupname').val();
          var Session = $('#Session').val();
           var limit1 = parseInt($('#limit1').val());
            var limit2 = parseInt($('#limit2').val());
            //alert(className)
            var limit3=parseInt(limit1+limit2);

        $.post("b.php", { className: className,groupname:groupname,Session:Session,limit1:limit1,limit2:limit2},
            function(result){

               $('#message').html(result);

               $('#limit1').val(limit3)
                 
        });

}




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
	
	
	
	$(document).ready(function(){
	$('#stdId').keyup(function(){
		var iddd = $(this).val();
		var forMisss = "dd";
		if(iddd != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {iddd:iddd,forMisss:forMisss},
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


</script>
	 <style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 300px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
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
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >

            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Result Processing </strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:280px; border-radius:0px;">
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
                        <td><strong><span class="text-success" style="font-size: 15px;">Group Name</span></strong></td>
                        <td><div class="col-md-8"><select name="groupname" id="groupname" class="form-control" style="width:280px; border-radius:0px;">
						
						</select>
                        
                        </div>
                        </td>
                    </tr>

				    <!--<tr>-->
        <!--                <td><strong><span class="text-success" style="font-size: 15px;">Exam Type</span></strong></td>-->
        <!--                <td><div class="col-md-8"><select class="form-control" name="examtype" id="examtype" style="width:280px; border-radius:0px;">-->
        <!--                </select>-->
        <!--                </div>-->
        <!--                </td>-->
        <!--            </tr>-->

                    
                <tr>
                    <td ><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="Session" name="Session" style="width:280px; border-radius:0px;">
                        <option>Select Session</option>
                      <?php 
								$sessionsql = "SELECT `session` FROM `result` GROUP BY `result`.`session` ORDER BY `result`.`session` DESC";
								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str >5){
						?>
								
								<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?>
								
								<?php
											$sessionsql = "SELECT `session` FROM `result` GROUP BY `result`.`session` ORDER BY `result`.`session` DESC";
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
                        <td><strong><span class="text-success" style="font-size: 15px;">Select Limit </span></strong></td>
                        <td><div class="col-md-12">
                        	<label>
                        			<input type="text" autocomplete="off" name="limit1" class="form-control" id="limit1" value="0" style="width:180px; border-radius:0px;"/>
                        	</label>

                        	<label>
                        			<input type="text" autocomplete="off" name="limit2" class="form-control" id="limit2" value="10" style="width:180px; border-radius:0px;"/>
                        	</label>
								
							
                </div>
                  </div>
                        </td>
                    </tr>
				<tr>
					<td colspan="2" align="right">
								<strong style="font-weight:bold; font-size:15px"><span id="showMsg" class="text-danger"></span></strong>
								<strong id="runnigmsg" class="text-danger" style="font-weight:bold; font-size:15px"></strong>
								
					</td>
				</tr>
				
                <tr><td colspan="2" align="center">
<label>
                	<input type="button" name="ResultGenerate" value="Result Generate" class="btn btn-danger btn-md" style="width: 180px" onclick="return generate()"></input>
</label>
<label>
	<span id="message"></span>
</label>
			
				</td></tr>
                </table>
							


                </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
