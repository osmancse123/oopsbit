	<?php

	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
     require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    global $t;
    $db = new database();
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Student Information</title>
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update');
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
    		$confirm_click=confirm('Are You Confirm Delete');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
               //check group name 
  $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
        $('#classname').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
        }); 
  });

//function to check username availability   
function check_availability()
{
        var class_name = $('#classname').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=1 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
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

    </script>
  </head>
	<style>
	@media print{
			.noneBtnForprin{
				display:none;
			}
			#dont{
				display:none;
			}
			.dontprint{
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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
    <div class="has-feedback col-lg-12 col-md-12">
    <table align="center" class="table table-hover table-responsive table-bordered bg-info noneBtnForprin" style=" margin-top:30px;">
    <tr>
        <td colspan="14" class="bg-warning"></td>
    </tr>
        <tr>
            <td width="132"><strong><SPAN class='text-info'>Admitted Class </SPAN></strong></td>
            <td colspan="4"><div class="col-md-12 has-warning">

                        <select name="classname" id="classname" class="form-control" style="width:250px;">
                            
                            <option disabled <?php if(!isset($_GET['edit'])){?> selected <?php }?>>Select One</option>
                            
                            <?php 
                                $select_section = "SELECT * FROM `add_class`";
                                $cheked_query=$db->select_query($select_section);
                                if($cheked_query)
                                {
                                    while($fetchsection=$cheked_query->fetch_array())
                                {
                            ?>
                            <option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
                            <?php } } ?>
                        </select>
                    </div>
          </td>
            <td width="70" colspan="1"><strong><SPAN class='text-info'>Admitted Group</SPAN></strong></td>
            <td colspan="3"><div class="col-md-12 has-warning">
                        <select name="groupname" id="groupname" class="form-control" style="width:250px;">
                            
                        </select>
          </div></td>
            <td width="139"><strong><SPAN class='text-info'>Session</SPAN></strong></td>
            <td colspan="2"><div class="col-md-12">
               <!-- <input type="text" placeholder="<?php echo date('Y')?>" class="form-control" name="session" ></input>-->
				
				<select class="form-control" name="session" style="width:250px;">
					<option disabled="disabled">Select Session</option>
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
            </div></td>
            <td width="108" colspan="2">
                <div  class="col-md-3 text-left">
              <button type="submit" name="searchbutton" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></div>
          </td>
        </tr>
	  </table>
		<table width="1302" class="table  table-bordered ">
        <tr>
            <td colspan="14" class="warning" align="center"><strong><span class="text-justify text-success text-center" style="font-size: 18px">Student Information</span></strong></td>
        </tr>
        <tr>
            
            <td width="122" align="center">ID</td> 
		    <td width="180" align="center">Name</td> 
            <td width="135" align="center">Father's Name</td>
            <td width="118" align="center">Mother's Name</td> 
            <td width="93" align="center">Gender</td>
            <td width="90" align="center">Religious</td>
            <td width="106" align="center">Date Of Birth</td>
            <td width="126" align="center">Gurdian Contact No</td>

      		<td width="111" align="center">Address </td>

            <td width="61" align="center">Picture</td>
            <td width="117" align="center" id="dont">Edit or Delete</td>
        </tr>
        <?php 
            if(isset($_POST["searchbutton"]))
            {

                $className=$db->escape(isset($_POST['classname'])?$_POST['classname']:"");
                $exloid_class=explode('and', $className);
                $groupname=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
                $explode_group=explode('and', $groupname);
                $session=$db->escape(isset($_POST["session"])?$_POST["session"]:"");
                if(!empty($className) && !empty($groupname) && !empty($session))
                {
                    $select_student_info="SELECT `student_personal_info`.`id`,`student_name`,`father_name`,`mother_name`,`gender`,`religious`,
`date_of_brith`,`contact_no`,`email`,`student_guardian_information`.`guardian_contact`,`guardian_email`,
 `student_acadamic_information`.`regular_iregular`, `student_address_info`.`present_house_name`,
 `student_address_info`.`present_village`,`student_address_info`.`present_PO`,`student_address_info`.`present_post_code`,
 `student_address_info`.`present_upazila`,`student_address_info`.`present_distric` FROM `student_personal_info`
INNER JOIN `student_guardian_information` ON `student_personal_info`.`id`=`student_guardian_information`.`id` 
INNER JOIN `student_address_info` ON `student_address_info`.`id`=`student_personal_info`.`id` 
JOIN `student_acadamic_information` ON `student_guardian_information`.`id`=`student_acadamic_information`.`id`WHERE `student_acadamic_information`.`admission_disir_class`='".$exloid_class[0]."' AND `student_acadamic_information`.`admission_disir_group`='".$explode_group[0]."' AND `session2`='$session' ORDER BY `student_personal_info`.`id` ASC";				

//echo $select_student_info;            
  $result_query=$db->select_query($select_student_info);
                    if($result_query){
                        $count_fields=mysqli_num_fields($result_query);
                        while($fetch_all=$result_query->fetch_array())
                        {
                        	  $address="H/O :".$fetch_all['present_house_name'].", :&nbsp Vill: ".$fetch_all['present_village']." , &nbsp P/O :".$fetch_all['present_PO']." ,&nbsp POST Code: ".$fetch_all['present_post_code']." , &nbsp Thana :".$fetch_all['present_upazila']." ,&nbsp Zilla: ".$fetch_all['present_distric'];

                           
                            print"<tr>";
                           /* for($x=0;$x<$count_fields;$x++)
                            {
                                print "<td>"."<strong>".$fetch_all[$x]."</strong>"."</td>";
                            }*/
							  print  "<td align='center'>".$fetch_all['id']."</td>";
							  print  '<td align="center">'.$fetch_all['student_name'].'</td>';
							  print  '<td align="center">'.$fetch_all['father_name'].'</td>';
							  print  '<td align="center">'.$fetch_all['mother_name'].'</td>';
							  print  '<td align="center">'.$fetch_all['gender'].'</td>';
							  print  '<td align="center">'.$fetch_all['religious'].'</td>';
							  print  '<td align="center">'.$fetch_all['date_of_brith'].'</td>';
							  print  '<td align="center">'.$fetch_all['guardian_contact'].'</td>';

							  	

							  print  '<td align="center">'.$address.'</td>';


                            print "<td>"."<img src='../other_img/$fetch_all[0].jpg' width='80'  height='80'/>"."</td>";
                            print "<td id='dont'>"."<a href='Student_information.php?edit=$fetch_all[0]'class='btn btn-primary btn-sm' onclick='return confirm_click()' style='width:80px'>Edit</a><br/><a style='width:80px; margin-top:2px;' href='Student_information.php?dlt=$fetch_all[0]' class='btn btn-sm btn-danger' onclick='return confirm_delete()  '>Delete</a>"."</td>";
                            print "</ tr>";
                        }
                    }
                }
            }
        ?>
        
        <tr id="dont">
            <td colspan="18" class="warning"></td>
        </tr>
        <tr id="dont">
            <td align="center" colspan="18">
                <input type="submit" name="print" onClick="window.print()" class="btn btn-primary" value="Print" style="width: 120px"></input>
                <a href="Student_information.php" target="adminbody" class="btn btn-primary" style="width: 120px">Back</a>
            </td>
        </tr>
    </table>
    </div>

    </form>
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
