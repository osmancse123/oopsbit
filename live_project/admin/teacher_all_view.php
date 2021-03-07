<?php
 error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
     $db = new database();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Teacher Information</title>

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
    		$confirm_click=confirm('Are You Confirm to Delete');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
    </script>
  </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
    <span><?php echo $db->sms;?></span>
        <?php
       
    
             global $i;
            global $table;
            $select="SELECT * FROM `teachers_information` ORDER BY `index_no` ASC";
            $checkt=$db->select_query($select);
            if($checkt)
            {
            $count_feild=mysqli_num_fields($checkt);
            } 
           $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px;'>"."<tr class='success'>"."<td>Add to Ex-Struff</td>"."<td>Serial No</td>"."<td>Name </td>"."<td>Designation</td>"."<td>Date of Brith</td>"."<td>Gendar</td>"."<td>Blood Group</td>"."<td>Religious</td>"."<td>Relationship</td>"."<td>Father Name</td>"."<td>Mother Name</td>"."<td>Mobile No</td>"."<td>Email</td>"."<td>Present Address</td>"."<td>Permanent Address</td>"."<td>First Joining Date</td>"."<td>The current date of joining</td>"."<td>MPO Date/td>"."<td>Education Qualification</td>"."<td>  Extra Qualification</td>"."<td>Hobby</td>"."<td>Index No</td>"."<td>Voter ID no</td>"."<td>Picture</td>"."<td>Edit Or Delete</td>"."</tr>";
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                    $table.="<td><a href='?ex_teacher=$a[12]' class='btn btn-danger'>Add to Ex-Teacher</a></td>";
                   for($i = 1; $i < $count_feild ;$i++)
                   {
                        $table.="<td>".$a[$i]."</td>";
                    
                    }
                    $table.="<td>"."<img src='../other_img/$a[12].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
                  $table.="<td>";
                     $table.="<a  href='Teacher_information.php?edit=$a[12]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px;' href='Teacher_information.php?dlt=$a[12]' class='btn btn-danger' onclick='return confirm_delete()  '>Delete</a>";
                   
                    $table.="</tr>";
            }
        }
           $table.="<tr>"."<td colspan='26' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  href='Teacher_information.php' target='adminbody'  class='btn btn-primary' onClick='javascript:closeWindow();''>Back</a>"."</td>"."</tr>";
           

            $table.="</table>";


     //link ex struf add 
   if(isset($_GET['ex_teacher']))
    {
            if(!empty($_GET['ex_teacher']))
            {
                $select="SELECT * FROM `teachers_information` WHERE `teachers_id`='".$_GET['ex_teacher']."'";
                $checked_query=$db->select_query($select);
                
                //print_r($fetch_exstruf);
               if($checked_query)
                {
                    //print "adfasdfasdf";
                    $fetch_exteacher=$checked_query->fetch_array();
                    $ex_teacher_inof="INSERT INTO `ex-teacher`(`teachers_id`,`index_no`,`teachers_name`,`designation`,`date_of_birth`,`gender`,`blood_group`,`relegion`,`marital_status`,`fathers_name`,
`mothers_name`,`mobile_no`,`email`,`present_address`,`parmanent_address`,`service_firs_joinig_date`,`the_date_of_joining`,`mpo_date`,`educational_qualification`,`additional_qualifications`,`hobby`,`custom_index`,`votar_id_no`,`department`,`type`) VALUES('".$fetch_exteacher[0]."','".$fetch_exteacher[1]."','".$fetch_exteacher[2]."','".$fetch_exteacher[3]."','".$fetch_exteacher[4]."','".$fetch_exteacher[5]."','".$fetch_exteacher[6]."','".$fetch_exteacher[7]."','".$fetch_exteacher[8]."','".$fetch_exteacher[9]."','".$fetch_exteacher[10]."','".$fetch_exteacher[11]."','".$fetch_exteacher[12]."','".$fetch_exteacher[13]."','".$fetch_exteacher[14]."','".$fetch_exteacher[15]."','".$fetch_exteacher[16]."','".$fetch_exteacher[17]."','".$fetch_exteacher[18]."','".$fetch_exteacher[19]."','".$fetch_exteacher[20]."','".$fetch_exteacher[21]."','".$fetch_exteacher[22]."','".$fetch_exteacher[23]."','".$fetch_exteacher[24]."')";
                    $checkd_ins=$db->insert_query($ex_teacher_inof);
              // print "asdfasdf";
                            $Delete="DELETE FROM `teachers_information` where `email`='".$_GET['ex_teacher']."'";
                            $db->delete_query($Delete);
                            header("location:teacher_all_view.php");


                    }
            }
            else
            {
                 $msg="<span class='text-center text-danger'>Not Found!!</span>";
            }

    }
        ?>

        <?php echo $table; ?>
    </form>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html> 	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
