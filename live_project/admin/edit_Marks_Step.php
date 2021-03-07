<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{		require_once("../db_connect/config.php");
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
    
    <title>Add Mark</title>

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

        $.post("cheking_subject_name.php", { className: class_name, groupName: group_name, sub_type:sub_type },

            function(result){
                //if the result is 1
                if(result != 0 )
                {
                    //show that the username is available
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
                    //show that the username is available
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

function EditMarks(tos,froms){
		var className = $('#className').val();
		if(tos != null)
		{
			var toss=tos;
			//alert(toss);
		}
		if(froms != null)
		{
			var fromss=froms;
		}
		var groupname = $('#groupname').val();
		var examtype = $('#examtype').val();
		var addMarks ="10";
		var subject_type = $('#subject_type').val();
		
		var sub_name = $('#sub_name').val();
		//alert(sub_name);
		var part_name = $('#part_name').val();
		//alert(part_name);
		var session = $('#session').val();
		
		if(className != "Select One" && groupname != null && examtype != null && session !="Select Session")
		{
			$('#AddMarksStep1').hide();
			$('#AddMarksStep2').show();
			$.ajax({
				url:"EditMarks.php",
				type:"POST",
				data :{className:className,groupname:groupname,examtype:examtype,subject_type:subject_type,sub_name:sub_name,part_name:part_name,session:session,addMarks:addMarks,toss:toss,fromss:fromss},
				cache:false,
				success:function(data)
				{
						//alert(data);
					$('#AddMarksStep2').html(data);
				}
				
			});
		}
		else 
		{
			alert("Please Fill Up Important Fields");
		}
		
}  

function ShowBack(){
			$('#AddMarksStep1').show();
			$('#AddMarksStep2').hide();
			//$('#showChekView').hide();
}
  function GoBackPage(){
	  		ShowBack();
	  }



 function calculate(getid) {
        
        var obtainMark=0;
        var grade_letter="";

        var countAss_mark = parseInt(document.getElementById('counAssMark-'+getid).value);
        var Creative_mark=parseInt(document.getElementById('CreaTiveMark-'+getid).value);
        var Mcq_mark=parseInt(document.getElementById('MeqMark-'+getid).value);
        var practical_mark=parseInt(document.getElementById('practicalMark-'+getid).value);

        var ca_tatal_mark=parseInt(document.getElementById('counAss-'+getid).value);
        var creative = parseInt(document.getElementById('Creative-'+getid).value);
        var McQ = parseInt(document.getElementById('Mcq-'+getid).value);
        var PracTical=parseInt(document.getElementById('practical-'+getid).value);
        var FullMarks= parseInt(document.getElementById('fullmark-'+getid).value);
        
        if(document.getElementById('counAssMark-'+getid).value=="")
          countAss_mark=0;
        if(document.getElementById('CreaTiveMark-'+getid).value=="")
          Creative_mark=0;
        if(document.getElementById('MeqMark-'+getid).value=="")
          Mcq_mark=0;
        if(document.getElementById('practicalMark-'+getid).value=="")
          practical_mark=0;
        var creat_grade=0;
        
        if(countAss_mark >=0 && countAss_mark <= ca_tatal_mark)
        {
			document.getElementById('counAssMark-'+getid).style.borderColor ='green';
          	obtainMark = obtainMark + countAss_mark;

          if(countAss_mark >= parseInt(ca_tatal_mark * .33) && countAss_mark <= parseInt(ca_tatal_mark *  1))
          {

            creat_grade ++;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
			document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Contnue Assesment Mark Should be less than or equal of Continue Assesment Total Mark");
          document.getElementById('counAssMark-'+getid).value=0;
		  document.getElementById('counAssMark-'+getid).style.borderColor ='red';
        }

        if(Creative_mark >=0 && Creative_mark <= creative)
        {
          obtainMark = obtainMark + Creative_mark;
		document.getElementById('CreaTiveMark-'+getid).style.borderColor ='green';

          if(Creative_mark >= parseInt(creative * .33) && Creative_mark <= parseInt(creative *  1))
          {
            creat_grade ++;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Creative Mark Should be less than or equal of Creative Total Mark");
           document.getElementById('CreaTiveMark-'+getid).style.borderColor ='red';
			document.getElementById('CreaTiveMark-'+getid).value=0;
		  }

         if(Mcq_mark >=0 && Mcq_mark <= McQ)
        {
          obtainMark = obtainMark + Mcq_mark;
		  document.getElementById('MeqMark-'+getid).style.borderColor ='green';

          if(Mcq_mark >= parseInt(McQ * .33) && Mcq_mark <= parseInt(McQ *  1))
          {
            creat_grade ++;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
         //alert("MCQ Mark Should be less than or equal of MCQ Total Mark");
          
		  document.getElementById('MeqMark-'+getid).value=0;
          document.getElementById('MeqMark-'+getid).style.borderColor ='red';

		}


         if(practical_mark >=0 && practical_mark <= PracTical)
        {
          obtainMark = obtainMark + practical_mark;
			document.getElementById('practicalMark-'+getid).style.borderColor='green';
          if(practical_mark >= parseInt(PracTical * .33) && practical_mark <= parseInt(PracTical *  1))
          {
            creat_grade ++;
          }
          else
          {
            grade_letter ="F";
           document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Practical Mark Should be less than or equal of Practical Total Mark");
          document.getElementById('practicalMark-' +getid).value=0;
		   document.getElementById('practicalMark-' +getid).style.borderColor='red';
        }

        if(creat_grade == 4)
        {
            document.getElementById('obtainmark-'+getid).style.background="GREEN";
            document.getElementById('lettergrade-'+getid).style.background="GREEN";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
            if(obtainMark >= parseInt(FullMarks * 0.8) && obtainMark <= parseInt(FullMarks * 1))
            {
                grade_letter ="A+";
            }
            else if(obtainMark >=  parseInt(FullMarks * 0.7) && obtainMark <= parseInt(FullMarks * .7999))
            {
              grade_letter ="A";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.6) && obtainMark <= parseInt(FullMarks * .6999))
            {
              grade_letter ="A-";
            }
            else if (obtainMark >= parseInt(FullMarks * 0.5) && obtainMark <= parseInt(FullMarks * .5999))
            {
              grade_letter ="B";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.4) && obtainMark <= parseInt(FullMarks * .4999))
            {
              grade_letter ="C";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.33) && obtainMark <= parseInt(FullMarks * .3999))
            {
              grade_letter ="D";
            }
            else
            {
              	grade_letter="F";
				document.getElementById('obtainmark-'+getid).style.background="RED";
				document.getElementById('lettergrade-'+getid).style.background="RED";
				document.getElementById('obtainmark-'+getid).style.color="white";
				document.getElementById('lettergrade-'+getid).style.color="white";
            }

        }
        document.getElementById('obtainmark-'+getid).value=obtainMark;
        document.getElementById('lettergrade-'+getid).value=grade_letter;
      }
	  
	 function showChekTo(){
	  	var to = $('#to').val();
		var from =$('#from').val();
		EditMarks(to,from);
		//alert(to);
		}
	 
	
	function EditMarkshet(){
			var count = $('#countValue').val();
			var queryString= $('.marksEditEntry').serialize();
			$.ajax({
				url : "EditMarksheetMarks.php",
				type: "POST",
				data : queryString,
				cache : false,
				success : function(data){
					$("#sms").html(data);
					//document.getElementsByName().reset();
				
				} 
			});
			
		}
		function alreset(){
		$("#sms").html("");
		location.reload();
		}
		
		
		
		

 function calculaten(getid) {
        
        var obtainMark=0;
        var grade_letter="";

        var countAss_mark = parseInt(document.getElementById('counAssMark-'+getid).value);
        var Creative_mark=parseInt(document.getElementById('CreaTiveMark-'+getid).value);
        var Mcq_mark=parseInt(document.getElementById('MeqMark-'+getid).value);
        var practical_mark=parseInt(document.getElementById('practicalMark-'+getid).value);

        var ca_tatal_mark=parseInt(document.getElementById('counAss-'+getid).value);
        var creative = parseInt(document.getElementById('Creative-'+getid).value);
        var McQ = parseInt(document.getElementById('Mcq-'+getid).value);
        var PracTical=parseInt(document.getElementById('practical-'+getid).value);
        var FullMarks= parseInt(document.getElementById('fullmark-'+getid).value);
        
        if(document.getElementById('counAssMark-'+getid).value=="")
          countAss_mark=0;
        if(document.getElementById('CreaTiveMark-'+getid).value=="")
          Creative_mark=0;
        if(document.getElementById('MeqMark-'+getid).value=="")
          Mcq_mark=0;
        if(document.getElementById('practicalMark-'+getid).value=="")
          practical_mark=0;
        var creat_grade=0;
        
		obtainMark = countAss_mark+Creative_mark+Mcq_mark+practical_mark;
		



   
        if(countAss_mark >=0 && countAss_mark <= ca_tatal_mark)
        {
			document.getElementById('counAssMark-'+getid).style.borderColor ='green';
          	//obtainMark = obtainMark + countAss_mark;

         if(obtainMark >= parseInt(FullMarks * .33) && obtainMark <= parseInt(FullMarks * 1))
          {

            creat_grade =1;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
			document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Contnue Assesment Mark Should be less than or equal of Continue Assesment Total Mark");
          document.getElementById('counAssMark-'+getid).value=0;
		  document.getElementById('counAssMark-'+getid).style.borderColor ='red';
        }

        if(Creative_mark >=0 && Creative_mark <= creative)
        {
          //obtainMark = obtainMark + Creative_mark;
		document.getElementById('CreaTiveMark-'+getid).style.borderColor ='green';

          if(obtainMark >= parseInt(FullMarks * .33) && obtainMark <= parseInt(FullMarks * 1))
          {

            creat_grade =1;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Creative Mark Should be less than or equal of Creative Total Mark");
           document.getElementById('CreaTiveMark-'+getid).style.borderColor ='red';
			document.getElementById('CreaTiveMark-'+getid).value=0;
		  }

         if(Mcq_mark >=0 && Mcq_mark <= McQ)
        {
         // obtainMark = obtainMark + Mcq_mark;
		  document.getElementById('MeqMark-'+getid).style.borderColor ='green';

           if(obtainMark >= parseInt(FullMarks * .33) && obtainMark <= parseInt(FullMarks * 1))
          {

            creat_grade =1;
          }
          else
          {
            grade_letter ="F";
            document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
         //alert("MCQ Mark Should be less than or equal of MCQ Total Mark");
          
		  document.getElementById('MeqMark-'+getid).value=0;
          document.getElementById('MeqMark-'+getid).style.borderColor ='red';

		}


         if(practical_mark >=0 && practical_mark <= PracTical)
        {
         // obtainMark = obtainMark + practical_mark;
			document.getElementById('practicalMark-'+getid).style.borderColor='green';
          if(obtainMark >= parseInt(FullMarks * .33) && obtainMark <= parseInt(FullMarks * 1))
          {

            creat_grade =1;
          }
          else
          {
            grade_letter ="F";
         	  document.getElementById('obtainmark-'+getid).style.background="RED";
            document.getElementById('lettergrade-'+getid).style.background="RED";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
             
          }

        }
        else
        {
          //alert("Practical Mark Should be less than or equal of Practical Total Mark");
          document.getElementById('practicalMark-'+getid).value=0;
		   document.getElementById('practicalMark-'+getid).style.borderColor='red';
        }
		
		
		


        if(creat_grade==1)
        {
            document.getElementById('obtainmark-'+getid).style.background="GREEN";
            document.getElementById('lettergrade-'+getid).style.background="GREEN";
            document.getElementById('obtainmark-'+getid).style.color="white";
            document.getElementById('lettergrade-'+getid).style.color="white";
            if(obtainMark >= parseInt(FullMarks * 0.8) && obtainMark <= parseInt(FullMarks * 1))
            {
                grade_letter ="A+";
            }
            else if(obtainMark >=  parseInt(FullMarks * 0.7) && obtainMark <= parseInt(FullMarks * .7999))
            {
              grade_letter ="A";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.6) && obtainMark <= parseInt(FullMarks * .6999))
            {
              grade_letter ="A-";
            }
            else if (obtainMark >= parseInt(FullMarks * 0.5) && obtainMark <= parseInt(FullMarks * .5999))
            {
              grade_letter ="B";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.4) && obtainMark <= parseInt(FullMarks * .4999))
            {
              grade_letter ="C";
            }
            else if(obtainMark >= parseInt(FullMarks * 0.33) && obtainMark <= parseInt(FullMarks * .3999))
            {
              grade_letter ="D";
            }
            else
            {
              	grade_letter="F";
				document.getElementById('obtainmark-'+getid).style.background="RED";
				document.getElementById('lettergrade-'+getid).style.background="RED";
				document.getElementById('obtainmark-'+getid).style.color="white";
				document.getElementById('lettergrade-'+getid).style.color="white";
            }

        }
		
        document.getElementById('obtainmark-'+getid).value=obtainMark;
        document.getElementById('lettergrade-'+getid).value=grade_letter;
      }
    </script>
	
    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal marksEditEntry" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">EDIT MARKS </strong></span><br/>
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
                        <td><strong><span class="text-success" style="font-size: 15px;">Exam Type</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" name="examtype" id="examtype" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                    </tr>

                    <tr>
                        <td ><strong><span class="text-success" style="font-size: 15px;">Select Group</span></strong></td>
                        <td ><div class="col-md-8"><select class="form-control" name="groupname" id="groupname" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                </tr>
                 <tr>
                        <td ><strong><span class="text-success" style="font-size: 15px;">Select Subject Type</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="subject_type" name="subject_type" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                </tr>
                <tr>
                        <td ><strong><span class="text-success" style="font-size: 15px;"> Subject Name</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="sub_name" name="sub_name" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                </tr>
                <tr>
                        <td ><strong><span class="text-success" style="font-size: 15px;"> Part Name</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="part_name" name="part_name" style="width:280px; border-radius:0px;">
                        </select>
                        </div>
                        </td>
                </tr>
                <tr>
                    <td ><strong><span class="text-success" style="font-size: 15px;">Session</span></strong></td>
                        <td><div class="col-md-8"><select class="form-control" id="session" name="session" style="width:280px; border-radius:0px;">
                        <option>Select Session</option>
                       <?php 
								$sessionsql = "SELECT `Session` FROM `marksheet` GROUP BY `marksheet`.`Session` ORDER BY `marksheet`.`Session` DESC";
								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str >5){
						?>
								
								<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?>
								
								<?php
											$sessionsql = "SELECT `Session` FROM `marksheet` GROUP BY `marksheet`.`Session` ORDER BY `marksheet`.`Session` DESC";
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
                <tr><td colspan="2" align="center"><input type="button" name="submit" value="Submit" class="btn btn-danger btn-md" onClick="return EditMarks()"  style="width: 90px"></input></td></tr>
                </table>
                </div>
		<div class="col-md-12" id="AddMarksStep2"></div>
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
