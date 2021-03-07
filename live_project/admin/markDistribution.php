<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	$db = new database();
    global $chek_edit_all;


 
	
	
    
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
    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm to Update');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}

    	function confirm_delete()
    	{
    		$confirm_click=confirm('Are You Confirm to Delete ');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}

<!--model chke all-->
	
		function TotalGenerat(getid){
		
		
	var cont_ass = document.getElementById("countass-"+getid).value;
    var theory_marks = document.getElementById("theory_written-"+getid).value;
    var mcq_marks = document.getElementById("mcq_mark-"+getid).value;
    var practical_marks = document.getElementById("practical-"+getid).value;
    
        total_marks=0;
    if(document.getElementById("countass-"+getid).value=="")
    cont_ass=0;
    if(document.getElementById("mcq_mark-"+getid).value=="")
    mcq_marks=0;
    if(document.getElementById("theory_written-"+getid).value=="")
    theory_marks=0;
    if(document.getElementById("practical-"+getid).value=="")
    practical_marks=0;
   


    if(cont_ass >= 0 )
    {
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
    
        document.getElementById("total-"+getid).value=parseInt(total_marks);
        document.getElementById("total-"+getid).style.background="green";
        document.getElementById("total-"+getid).style.color="Black";
        document.getElementById("total-"+getid).style.fontWeight="Bold";
    
    }
    else if(theory_marks >= 0 )
    {
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        alert(total_marks);
        document.getElementById("total-"+getid).value=parseInt(total_marks);
        document.getElementById("total-"+getid).style.background="#68C973";
        document.getElementById("total-"+getid).style.color="Black";
        document.getElementById("total-"+getid).style.fontWeight="Bold";
        
    }
    else if(mcq_marks >= 0){
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        //alert("aa");
        document.getElementById("total-"+getid).value=parseInt(total_marks);
        document.getElementById("total-"+getid).style.background="#68C973";
        document.getElementById("total-"+getid).style.color="Black";
        document.getElementById("total-"+getid).style.fontWeight="Bold";
    }
    else if(practical_marks >= 0){
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        
        document.getElementById("total-"+getid).value=parseInt(total_marks);
        document.getElementById("total-"+getid).style.background="#68C973";
        document.getElementById("total-"+getid).style.color="Black";
        document.getElementById("total-"+getid).style.fontWeight="Bold";
    }
    else{
        document.getElementById("warning-"+getid).innerHTML="Input is Invaild";
        document.getElementById("warning-"+getid).style.color="RED";
        document.getElementById("warning-"+getid).style.fontWeight="Bold"; 
    }
		
		}

		
		
		function chekgpEx(getid)
		{
			chekGroupName(getid);
			chekExamType(getid);
		}

	function chekGroupName(getid){
	
		var class_name = $('#clID-'+getid).val();
		//alert(class_name);
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#grName-'+getid).html(result);
                   
                }
                else
                {
                    //show that the username is NOT available
                   $('#grName-'+getid).html("");
                }
				$('#sbType-'+getid).html("");
				$('#subN-'+getid).html("");
				$('#subNpN-'+getid).html("");
				$('#subC-'+getid).val("");
				
               
                 
        });
	}
	
	function chekExamType(getid){
		
		var class_name = $('#clID-'+getid).val();
        $.post("Check_exam_type.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#extype-'+getid).html(result);
                   
                }
                else
                {
                    //show that the username is NOT available
                    $('#extype-'+getid).html("");
                }

        });
			
	}
	
	function chekSubType(getid){
		var class_name = $('#clID-'+getid).val();
        var group_name = $('#grName-'+getid).val();
        $.post("chekingsubject_type.php", { className: class_name,groupName:group_name },
            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#sbType-'+getid).html(result);
                    
                   

                }
                else
                {
                    
                   $('#sbType-'+getid).html("");
                }
				$('#subN-'+getid).html('');
				$('#subC-'+getid).val("");
				$('#subNpN-'+getid).html("");
				
               
        });
		
	}
	
	function subNC(getid){
		SubPart(getid);
		subCode(getid);
	}
	
	function SubName(getid){
	
		var class_name = $('#clID-'+getid).val();
        var group_name = $('#grName-'+getid).val();
        var sub_type=$('#sbType-'+getid).val();
		//alert(class_name);
		//subCode(getid);
        $.post("cheking_subject_name.php", { className: class_name, groupName: group_name, sub_type:sub_type },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
					//alert(result);
                    $('#subN-'+getid).html(result);
                   
                   

                }
                else
                {
                    
                    
                    $('#subN-'+getid).html('');
                }
				
        });
		
	}
	
	function SubPart(getid){
	
				
        var class_name = $('#clID-'+getid).val();
        var group_name = $('#grName-'+getid).val();
        var sub_type=$('#sbType-'+getid).val();
        var sub_name=$('#subN-'+getid).val();
		var examtype= $('#extype-'+getid).val();
        $.post("checking_subject_part_name.php", { className: class_name, groupName: group_name, sub_type: sub_type, sub_name: sub_name,examtype:examtype },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
					//alert(result);
                    $('#subNpN-'+getid).html(result);
                   
                   

                }
                else
                {
                    
                   $('#subNpN-'+getid).html("");
                }
        });
	}
	
	function subCode(getid){
	//alert("dd");
		var class_name = $('#clID-'+getid).val();
        var group_name = $('#grName-'+getid).val();
        var sub_type=$('#sbType-'+getid).val();
        var sub_name=$('#subN-'+getid).val();
        $.post("cheking_subject_code.php", { className: class_name, groupName: group_name, sub_type:sub_type, subname: sub_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#subC-'+getid).val(result);
                    
                   

                }
                else
                {
                    
                   $('#subC-'+getid).val("");
                }

        });

	}
	
	function SubParC(getid)
	{
		var class_name = $('#clID-'+getid).val();
        var group_name = $('#grName-'+getid).val();
        var sub_type=$('#sbType-'+getid).val();
        var sub_name=$('#subN-'+getid).val();
        var sub_part_name=$('#subNpN-'+getid).val();
        $.post("cheking_part_code.php", { className: class_name, groupName: group_name, sub_type:sub_type, subname: sub_name, part_name: sub_part_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                     $('#subC-'+getid).val(result);
                   

                }
                else
                {
                    
                     $('#subC-'+getid).val("");
                }
        });
	}
	
	/*function editShow(eid)
	{
		//var SubInfoId=$('#subinid-'+eid).val();
		//var 
		var gtid=eid;
		var edit="10";
		//alert(gtid);
		if(gtid != "")
		{
			$.ajax({
					url:"subjecMark.php",
					type:"POST",
					cache:false,
					data:{idd:gtid,edit:edit},
					success:function(data)
					{
						//alert(data);
						var a = data.split('/');
						var sbuinfoid = a[0];
						var className = a[1];
						var subCode = a[16];
						//alert(subCode)
						var id=$('#theory_written-'+idd).val(subCode);
						alert(id);
						
					}
			});
		}
	}
  */
<!--- model chke all end -->
		
		
		
		
 $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               Check_exam_type();
        });
    
         $('#groupname').change(function()
        {
            $('#check_section').html(checking_html);
                chek_subject_Type();

        }); 
     $('#subject_type').change(function()
        {
            $('#chek_type').html(checking_html);
                chek_subname();

        }); 
     $('#sub_name').change(function()
        {
            $('#check_sub_name').html(checking_html);
                chek_subject_part();
                check_subject_code();
               

        });
      $('#part_name').change(function()
        {
            $('#check_part_code').html(checking_html);
           

                check_subject_part_code();

        });
 });

         //function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
		//alert(class_name);
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
	//alert(class_name);
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
//function to check username availability   
function chek_subject_Type()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        $.post("chekingsubject_type.php", { className: class_name,groupName:group_name },
            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#subject_type').html(result);
                    $('#check_section').html("");
                   

                }
                else
                {
                    
                    $('#check_section').html("");
                    $('#subject_type').html('');
                }
                $('#sub_name').html("");
                $('#part_name').html('');
               $('#subjectcode').val('');
        });


} 

function chek_subname()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        var sub_type=$('#subject_type').val();
		//alert(class_name);

        $.post("cheking_subject_name.php", { className: class_name, groupName: group_name, sub_type:sub_type },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
					//alert(result);
                    $('#sub_name').html(result);
                    $('#chek_type').html("");
                   

                }
                else
                {
                    
                    $('#chek_type').html("");
                    $('#sub_name').html('');
                }
        });

}              

function chek_subject_part()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        var sub_type=$('#subject_type').val();
        var sub_name=$('#sub_name').val();
		  var examtype=$('#examtype').val();
        $.post("checking_subject_part_name.php", { className: class_name, groupName: group_name, sub_type: sub_type, sub_name: sub_name,examtype: examtype },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //alert(result);
                    $('#part_name').html(result);
                    $('#check_sub_name').html("");
                   

                }
                else
                {
                    
                    $('#check_sub_name').html("");
                    $('#part_name').html('');
                }
        });
}

function check_subject_code()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        var sub_type=$('#subject_type').val();
        var sub_name=$('#sub_name').val();
        $.post("cheking_subject_code.php", { className: class_name, groupName: group_name, sub_type:sub_type, subname: sub_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#subjectcode').val(result);
                    $('#chek_type').html("");
                   

                }
                else
                {
                    
                    $('#chek_type').html("");
                    $('#subjectcode').val('');
                }

        });

}   
function check_subject_part_code()
{
        var class_name = $('#className').val();
        var group_name = $('#groupname').val();
        var sub_type=$('#subject_type').val();
        var sub_name=$('#sub_name').val();
        var sub_part_name=$('#part_name').val();
        $.post("cheking_part_code.php", { className: class_name, groupName: group_name, sub_type:sub_type, subname: sub_name, part_name: sub_part_name },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
                    $('#subjectcode').val(result);
                    $('#chek_type').html("");
                   

                }
                else
                {
                    
                    $('#chek_type').html("");
                    $('#subjectcode').val('');
                }
        });

}       


    </script>
    <script type="text/javascript">
        function TotalCalculate()
{
    var cont_ass = document.getElementById("countass").value;
    var theory_marks = document.getElementById("theory_written").value;
    var mcq_marks = document.getElementById("mcq_mark").value;
    var practical_marks = document.getElementById("practical").value;
    
        total_marks=0;
    if(document.getElementById("countass").value=="")
    cont_ass=0;
    if(document.getElementById("mcq_mark").value=="")
    mcq_marks=0;
    if(document.getElementById("theory_written").value=="")
    theory_marks=0;
    if(document.getElementById("practical").value=="")
    practical_marks=0;
   


    if(cont_ass >= 0 )
    {
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
    
        document.getElementById("total").value=parseInt(total_marks);
        document.getElementById("total").style.background="green";
        document.getElementById("total").style.color="Black";
        document.getElementById("total").style.fontWeight="Bold";
    
    }
    else if(theory_marks >= 0 )
    {
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        alert(total_marks);
        document.getElementById("total").value=parseInt(total_marks);
        document.getElementById("total").style.background="#68C973";
        document.getElementById("total").style.color="Black";
        document.getElementById("total").style.fontWeight="Bold";
        
    }
    else if(mcq_marks >= 0){
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        //alert("aa");
        document.getElementById("total").value=parseInt(total_marks);
        document.getElementById("total").style.background="#68C973";
        document.getElementById("total").style.color="Black";
        document.getElementById("total").style.fontWeight="Bold";
    }
    else if(practical_marks >= 0){
        var total_marks = total_marks+parseInt(cont_ass)+parseInt(theory_marks)+parseInt(mcq_marks)+parseInt(practical_marks);
        
        document.getElementById("total").value=parseInt(total_marks);
        document.getElementById("total").style.background="#68C973";
        document.getElementById("total").style.color="Black";
        document.getElementById("total").style.fontWeight="Bold";
    }
    else{
        document.getElementById("warning").innerHTML="Input is Invaild";
        document.getElementById("warning").style.color="RED";
        document.getElementById("warning").style.fontWeight="Bold"; 
    }
}
function MarkAdd(){
		
		var markadd="10";
		var ClassId = $('#className').val();
		var examID = $('#examtype').val();
		var GroupId = $('#groupname').val();
		var subID = $('#sub_name').val();
		var PartID = $('#part_name').val();
		var cnAss = $('#countass').val();
		var Cretive = $('#theory_written').val();
		var mcqmak= $("input[name='mcq_mark']").val();
		var practical =$('#practical').val();
		var total = $('#total').val();
		if(ClassId == "Select Class")
		{
			alert("Please Select The Class");
			return false;
		}
		
		else if (total == "")
		{
			alert("Please Fill Out Important Fields");
			return false;
		}
		else if(examID == null)
		{
			alert("Please Select The Exam Type");
			return false;
		}
		else if (GroupId == null)
		{
			alert("Please Select Group Name");
			return false;
		}
		else if (subID == null)
		{
			alert("Please Select Subject  Name");
			return false;
		}
		else if (PartID == null)
		{
			alert("Please Select Subject Part  Name");
			return false;
		}
		
		$.ajax({
			url:"subjecMark.php",
			type:"POST",
			data : {ClassId:ClassId,examID:examID,GroupId:GroupId,subID:subID,PartID:PartID,cnAss:cnAss,Cretive:Cretive,mcqmak:mcqmak,practical:practical,total:total,markadd:markadd},
			cache:false,
			success:function(data){
				$('#sms').html(data);
				location.reload();
					var ClassId = $('#className').val("");
					var examID = $('#examtype').val("");
					var GroupId = $('#groupname').val("");
					var subID = $('#sub_name').val("");
					var PartID = $('#part_name').val("");
					var cnAss = $('#countass').val("");
					var Cretive = $('#theory_written').val("");
					var mcqmak= $("input[name='mcq_mark']").val("");
					var practical =$('#practical').val("");
					var total = $('#total').val("");
					var subcode = $('#subjectcode').val("");
			}
			
		
		});
}
	function viewDetails(){
	//alert('dd');
				var ViewAll="10";
				$('#showDetails').show();
				$('#AddMark').hide();
				$.ajax({
					url:"subjecMark.php",
					type : "POST",
					data : {ViewAll:ViewAll},
					success:function(data){
						$("#showDetails").html(data);
						//alert(data);
					}
				});
	
	}
    
	function backPage(){
	//alert('asdf');
			$('#showDetails').hide();
			$('#AddMark').show();
	}

	
	
    </script>
  </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
     
		    <div class="col-md-12" id="AddMark"><br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Add Mark Distribution Dependes on Exam.Type</strong></span><br/>
		
		
		
                <table class="table table-responsive table-hover table-bordered">
                    <tr>
		
					
					
					
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td colspan="6"><div class="col-md-6">
                        <select class="form-control" name="className" id="className">
                        
                        <option>Select Class</option>
                       
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `index` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
                        ?>
                        <option  value="<?php echo "$fetch_class[0]and$fetch_class[2]"?>"><?php echo $fetch_class[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select></div></td>
                    </tr>
                     <tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Exam Type</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="examtype" id="examtype">
                            
                        </select></div></td>
                    </tr>
                     <tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Select Group</span></strong></td>
                        <td colspan="6"><div class="col-md-6"><select class="form-control" name="groupname" id="groupname">
                           
                        </select><span id="category_result"></span></div></td>
                    </tr>
                     <tr>
                        <td colspan="2"><strong><span class="text-success" style="font-size: 15px;">Select Subject Type</span></strong></td>
                        <td colspan="6"><div class="col-md-6">

                        <select class="form-control" id="subject_type" name="subject_type">
                          
                        </select></div></td>
                    </tr>
                    <tr>
                        <td width="16%" rowspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Name</span></strong></td>
                        <td width="18%" rowspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Part</span></strong></td>
                        <td width="18%" rowspan="2"><strong><span class="text-success" style="font-size: 15px;">Subject Code</span></strong></td>
                        <td colspan="6" align="center"><strong><span class="text-success" style="font-size: 15px;">Marks</span></strong></td>
                    </tr>
                    <tr>
                      <td><strong><span class="text-success" style="font-size: 15px;">Cont. Asses.</span></strong></td>
                      <td><strong><span class="text-success" style="font-size: 15px;">Creative</span></strong></td>
                      <td><strong><span class="text-success" style="font-size: 15px;">MCQ.</span></strong></td>
                      <TD><strong><span class="text-success" style="font-size: 15px;">Practical</span></strong></TD>
                        <TD width="9%"><strong><span class="text-success" style="font-size: 15px;">Total</span></strong></TD>
                    </tr>
                    <tr>
                        <td><select class="form-control" id="sub_name" name="sub_name">
                            
                          
                        </select></td>
                        <td><select class="form-control" id="part_name" name="part_name"> </select></td>
                        <td> <input type="text" class="form-control" id="subjectcode" name="subjectcode"  ></input></td>
                        <td width="11%"><input type="text" class="form-control" id="countass" name="countass" placeholder="00" maxlength="3" onKeyUp="TotalCalculate();" onChange="TotalCalculate();"  ></input></td>
                        <td width="9%"><input type="text" class="form-control" id="theory_written" name="theory_written" placeholder="00"  maxlength="3" onKeyUp="TotalCalculate();" onChange="TotalCalculate();" ></input></td>
                        <td width="9%"><input class="form-control" type="text" id="mcq_mark" name="mcq_mark" placeholder="00"  maxlength="3" onKeyUp="TotalCalculate();" onChange="TotalCalculate();"  ></input></td>
                        <TD width="10%"><input type="text" class="form-control" id="practical" name="practical" placeholder="00"  maxlength="3" onKeyUp="TotalCalculate();"  onchange="TotalCalculate();"  ></input></TD>
                         <TD width="10%"><input type="text" class="form-control" id="total" name="total" placeholder="00"   readonly ></input>
                         <br/>
                         <span id="warning"></span>
                         </TD>         
                          </tr>
                          </tr>
            
            
                <td class="danger" colspan="8" bgcolor="#dddddd" align="center"><span id="sms">
                    

                </span> 
				
		
				</td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" class="warning" colspan="8"align="center" >
               
                    <input type="button" name="ADDV"  style="width:80px;" id="ADDV" class="btn btn-primary btn-sm" value="ADD" onClick="return MarkAdd()" />
                 
                                
                    <input type="reset"  value="Reset"   name="reset" class="btn btn-primary btn-sm" style="width:80px;"/>
                   
                </td>
            </tr>
                </table>
       </div>
	
         	<div id="showDetails" class="col-md-12"></div>


     </form>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
