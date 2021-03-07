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
	
function viewDetails(){
	//alert('dd');
				var ViewAll="10";
				$('#showdetails').show();
				$('#AddMarksStep1').hide();
				var className = $('#className').val();
				
				var groupname = $('#groupname').val();
				var examtype = $('#examtype').val();
				$.ajax({
					url:"subjecMark.php",
					type : "POST",
					data : {ViewAll:ViewAll,className:className,groupname:groupname,examtype:examtype},
					success:function(data){
						$("#showdetails").html(data);
						//alert(data);
					}
				});
	
	}
    
	function backPage(){
	//alert('asdf');
			$('#showdetails').hide();
			$('#AddMarksStep1').show();
	}
	
	
		
	function deleteBYid(getid){
			
					var DeletebyId="10";
					var deletid = getid;
						
						$.ajax({
							url:"subjecMark.php",
							type : "POST",
							data : {DeletebyId:DeletebyId,deletid:deletid},
							success:function(data){
								$('#hidetr'+deletid).hide();
							}
						});
	
	}
	
	
  function UpdatSubjectMark(id)
  {
  	//alert("ddd");
		//var id = document.getElementsByName('subinfoid').value;
		var subinfoid = $('#subinfoid-'+id).val();
		//alert(subinfoid);
		var exType=$('#extype-'+id).val();
		//alert(exType);
		var  clID=$('#clID-'+id).val();
		//alert(clID);
		var GpID=$('#grName-'+id).val();
		//alert(GpID);
		var subId=$('#subN-'+id).val();
		//alert(subId);
		var subParId=$('#subNpN-'+id).val();
		//alert(subParId);
		var subCode=$('#subC-'+id).val()
		//alert(subCode);
		var countAss=$('#countass-'+id).val();
		//alert(countAss);
		var creative=$('#theory_written-'+id).val();
		//alert(creative);
		var  Mcq=$('#mcq_mark-'+id).val();
		//alert(Mcq);
		var Partical = $('#practical-'+id).val();
		//alert(Partical);
		var total= $('#total-'+id).val();
		//alert(total);
		var edit="88";
		
		if(clID == "Select Class")
		{
			alert("Please Select The Class");
			return false;
		}
		
		else if (total == "")
		{
			alert("Please Fill Out Important Fields");
			return false;
		}
		else if(exType == null)
		{
			alert("Please Select The Exam Type");
			return false;
		}
		else if (GpID == null)
		{
			alert("Please Select Group Name");
			return false;
		}
		else if (subParId == null)
		{
			alert("Please Select Subject Part  Name");
			return false;
		}
		else if (subId == null)
		{
			alert("Please Select Subject   Name");
			return false;
		}
		
		if(subinfoid != "")
		{
			$.ajax({
				url:"subjecMark.php",
				type:"POST",
				data:{subinfoid:subinfoid,exType:exType,clID:clID,GpID:GpID,subId:subId,subParId:subParId,subCode:subCode,countAss:countAss,creative:creative,Mcq:Mcq,Partical:Partical,total:total},
				cache:false,
				success:function(data){
					//alert(data);
					$('#showMsg').html(data);
					location.reload();
				}
			});
		}
 }
	

</script>
	

    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">View Marks Destribution</strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:280px; border-radius:0px;">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `index` ASC";
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
                        <td><div class="col-md-8"><select name="groupname" id="groupname" class="form-control"  style="width:280px; border-radius:0px;">
						
						</select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><span class="text-success" style="font-size: 15px;">Exam Type</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" name="examtype" id="examtype" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                    </tr>
					

                    
               
				
                <tr><td colspan="2" align="center"><input type="button" name="ResultGenerate" value="Show" class="btn btn-danger btn-md" style="width: 180px" onClick="viewDetails()" ></input>
				
				</td></tr>
                </table>
							
                </div>
				
				<div id="showdetails" class="col-md-12"></div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
