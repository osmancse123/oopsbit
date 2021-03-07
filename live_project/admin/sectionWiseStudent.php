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
	
///

    if(isset($_POST["Show"]))
    {
        $clID=explode("and",$_POST["className"]);
        //print_r($clID);
        $grID=explode("and",$_POST["groupname"]); 
        $section=explode("and",$_POST["section"]); 

        print "<script>location='sectionWiseStudentList.php?clID=$clID[0]&grID=$grID[0]&section=$section[0]&sec=$section[1]'</script>";
    }

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

   
     <script src="datespicker/bootstrap-datepicker.js"></script>
     <script type="text/javascript">
         // When the document is ready
       

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

  </script>
	 <style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 400px;
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
	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal"  target="_blank">
        <div class="has-feedback col-md-10 col-md-offset-1">
    <table align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px; max-width: 800px;">
   		 
             <tr>
                <td colspan="6" align="center"> <h1>Section Wise Student Information</h1></td>
           
                 
            </tr>


             
            <tr>
				<td align="right"> <strong>Select Class  &nbsp; :</strong></td>
				<td colspan="3">
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
                 
			</tr>
            <tr>
            
                <td align="right"> <strong>Select Group  &nbsp; :</strong></td>
                <td colspan="3">
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
                
            </tr>
            
            

            <tr>
            	<td colspan="4">
            		<input type="Submit" class="btn btn-primary btn-block" value="Submit" name="Show" ></input>
            	</td>
            </tr>

            </table>
	 </form>
	<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
