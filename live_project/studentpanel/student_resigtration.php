<?php
error_reporting(1);
	@session_start();
	
	//echo $_GET["id"];
	//echo $_GET["session"];
	
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
    date_default_timezone_set('Asia/Dhaka');

	$db = new database();
	global $msg;
	if(isset($_POST["bACK"])){
		print "<script>location='Student_information.php'</script>";
	}
  
  		 $sql = "SELECT student_personal_info.*,`student_acadamic_information`.`session2` FROM `student_personal_info` INNER JOIN `student_acadamic_information`
ON 
`student_personal_info`.`id`=`student_acadamic_information`.`id`
 WHERE student_personal_info.`id`='".$_SESSION["useridid"]."'";
		$resulwsql = $db->select_query($sql)->fetch_array();

	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="../admin/textEdit/lib/jquery-1.9.0.min.js"></script>
        <link rel="stylesheet" href="../admin/datespicker/datepicker.css">
    <link rel="stylesheet" href="../admin/datespicker/bootstrap.min.css">

   
     <script src="../admin/datespicker/bootstrap-datepicker.js"></script>
     <script type="text/javascript">
         // When the document is ready
            $(document).ready(function () {
                
                $('#date').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

            //check group name 
  $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               
        }); 

         $('#groupname').change(function()
        {
            $('#check_section').html(checking_html);
                check_section_name();
                check_compolsary_subject();
                check_selective_subject();
                check_optional_subject();

        }); 
  });

//function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
        $.post("../admin/check_grou_name.php", { className: class_name },
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
        $.post("../admin/check_section_name.php", { className: class_name,groupName:group_name },
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
        $.post("../admin/check_compolsary_subject.php", { className: class_name, groupname:group_name},
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
       
        $.post("../admin/check_selective_subject.php", { className: class_name,group_name:group_name},
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
       
        $.post("../admin/check_optional_subject.php", { className: class_name,group_name:group_name},
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

function sbumit(){
			var name = $('#name').val();
			//alert(name);
			var id =$('#Txtid').val();
			var session = $('#session').val();
			var date = $('#date').val();
			var class_name = $('#className').val();
			var roll = $('#roll').val();
			if(roll===""){
				alert('Please Enter the roll');
				return false;
			}
        	//alert(class_name);
			var group_name = $('#groupname').val();
			//alert(group_name);
			var section = $('#section').val();
			//alert(session);
			var cmsubject = [];
			$('.cmsub').each(function(){
				if($(this).is(":checked"))
				{
					cmsubject.push($(this).val());
				}
			
			});
			//var cmlent=$('.cmsub').length;
			//alert(cmlent);
			
			var slsubject = [];
			$('.slsub').each(function(){
				if($(this).is(":checked"))
				{
					slsubject.push($(this).val());
				}
			
			});
			
			var opsubject= $('input:radio[name=optional_subject]:checked').val();
			
			//var opsubject = $('#optional_subject').val();
				//alert(opsubject);
				//return false;
			
			$.ajax({
				url : "InsertStudentReg.php",
				type: "POST",
				data : {id:id,name:name,section:section,session:session,date:date,class_name:class_name,group_name:group_name,cmsubject:cmsubject,slsubject:slsubject,opsubject:opsubject,roll:roll},
				cache : false,
				success : function(data){
				//alert(data);
					$("#sms").html(data);
					location.reload();
					id =$('#Txtid').val('');
					name = $('#name').val('');
			 		session = $('#session').val('');
			 	date = $('#date').val('');
			 	class_name = $('#className').val('');
			 	roll = $('#roll').val('');
        	//alert(class_name);
				 group_name = $('#groupname').val('');
			//alert(group_name);
			 	section = $('#section').val('');	
				
				} 
			});
			
			
	
}



//$(document).ready(function(){
//$("#Txtid").keyup(function()

function showIdby(){
var id =$('#Txtid').val();
var lent =$('#Txtid').val().length;
//alert(lent);
if(lent > 5){
		//alert("anik");
		 $.ajax({
		 			
                    type: "POST",
                    url: "SelectIdByName.php",
                    data: {id:id},
                    cache: false,
                    success: function(data) {
                    	//alert(data);
						
                    		var a = data.split('/');
							
							var name = a[0];
							//alert(name);
							var session = a[1];
								var gendar = a[2];
							$('#name').val(name);
							$('#session').val(session);
							$('#gendar').val(gendar);
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#session').val('');
							$('#gendar').val('');

	}
	}
//});
//});

  </script>
	 
 </style>
     </head>
   <body>
	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
        <div class="has-feedback col-md-10 col-md-offset-1">
    <table align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;">
   		 	<tr> 
			<td  bgcolor="#f4f4f4"  class="warning" style="border-right:1px #FFFFFF solid">
				  <input type="submit" value="Go to Student Info" name="bACK" class="btn btn-primary btn-sm" style="width:180px;" />
			</td>
                <td  bgcolor="#f4f4f4"  class="warning"  colspan="3"  bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;"><STRONG class='text-success'>Student Registration </STRONG></span> </td>
            </tr>
            
            <tr>
            <form class="form-inline">
                <td colspan="4" align="right"> 
                   <div class="col-md-3"><strong> &nbsp; </strong></div> 
                <div class="col-md-6">
				<input type="text" readonly=""  name="id"  id="Txtid" placeholder="ID" class="form-control"
				
					 value="<?php echo $_SESSION["useridid"]; ?>"
					
				   />
				<div id="idlist" class="ui-autocomplete" style="text-align:left"></div>
                </div>
         <div class="col-md-3 text-left">
             </div></td>
            </form>
            	
            </tr>
              <tr>
            	<td align="right"> <strong>Name &nbsp;:</strong></td>
            	<td><div class="col-md-12"><input readonly="" type="text" placeholder="Name" id="name"  name="name" class="form-control" value="<?php echo $resulwsql['student_name'];?>" /></div>
            	</td>
                <td align="right"> <strong> Session &nbsp; :</strong></td>
                <td><div class="col-md-12"><input readonly="" type="text" id="session" placeholder="2013-2014" name="session" class="form-control" value="<?php print $resulwsql["session2"];?>" /></div>
                </td>
            </tr>
               
            <tr>
                <td align="right"> <strong>Religion &nbsp;:</strong></td>
                <td><div class="col-md-12">
				<input type="text" id="gendar" placeholder="Religion"  name="gendar" class="form-control" value="<?php echo $resulwsql['religious'];?>" /></div>
                </td>
                <td align="right"> <strong>Class Roll &nbsp;:</strong></td>
                <td><div class="col-md-12"><input type="text" id="roll"  placeholder="Class Roll"  name="classRoll" class="form-control"  value="<?php echo $_GET["id"]; ?>" /></div>
                </td>
            </tr>
          
            <tr>
				<td align="right"> <strong>Select Class  &nbsp; :</strong></td>
				<td>
					<div class="col-md-12 has-warning">
		
						<select name="className" id="className" class="form-control">
						
								<option>Select One</option>
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
						</select>
                        <span id="item_result"></span>
					</div>
				</td>
                 <td align="right"> <strong>Select Group  &nbsp; :</strong></td>
                <td>
                    <div class="col-md-12 has-warning">
        
                        <select name="groupname" id="groupname" class="form-control"></select>
                        <span id="category_result"></span>
                        <span id="check_section"></span>
                    </div>
                </td>
			</tr>
            
            <tr>
                <td align="right"> <strong>Select Section  &nbsp; :</strong></td>
                <td>
                    <div class="col-md-12 has-warning">
        
                        <select name="section" id="section" class="form-control"></select>
                       
                    </div>
                </td>
                <td align="right"> <strong>Compulsory Subject:</strong></td>
                <td><div class="col-md-12">
                    <span id="compolsarysubject"></span> &nbsp;&nbsp;&nbsp;<span id="check_compol_name"></span>

                	</div>
                </td>
            </tr>
            
            

           
            <tr>
            	<td align="right"> <strong>Selective Subject:</strong></td>
            	<td><div class="col-md-12">
                 
                 <span id="selectivesubject"></span>   &nbsp;&nbsp;&nbsp;<span id="check_selectivenae"></span>
                </div>
            	</td>
                <td align="right"> <strong>Optional Subject &nbsp; :</strong></td>
                <td><div class="col-md-12">
                 <span id="select_optional_subject"></span>   &nbsp;&nbsp;&nbsp;<span id="check_optional_name"></span>   
                </div>
                </td>
            </tr>
            
            <tr>
                <td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span id="sms">
                    
                </span> </td>
            </tr>
            <tr>
            	<td colspan="4">
            		<input type="button" class="btn btn-primary btn-block" onClick="return sbumit()" value="Submit" name="add"></input>
            	</td>
            </tr>

            </table>
	 </form>
	<script src="../admin/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
