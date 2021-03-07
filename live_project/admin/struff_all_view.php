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
   
    <title>Stuff Information</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update The Menu');
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
    		$confirm_click=confirm('Are You Confirm Delete The Menu');
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
            $select="SELECT * FROM `stuff_information`";
            $checkt=$db->select_query($select);
            if ($checkt) {
               $count_feild=mysqli_num_fields($checkt);
            }
             
            $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px;'>"."<tr class='success'>"."<td>Add to Ex-Struff</td>"."<td>Serial No</td>"."<td>Name </td>"."<td>Designation</td>"."<td>Date Of Brith</td>"."<td>Gendar</td>"."<td>Blood Group</td>"."<td>Religious</td>"."<td>Relitionship</td>"."<td>Mobile No</td>"."<td>Father Name </td>"."<td>Mother Name </td>"."<td>Present Address </td>"."<td>Permanent Address </td>"."<td>Frist Joining Date </td>"."<td>Education Qualification</td>"."<td>Picture</td>"."<td>Edit Or Delete</td>"."</tr>";
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                    $table.="<td><a href='struff_all_view.php?ex_Struf=$a[0]' class='btn btn-danger'>Add to Ex-Struff</a></td>";
                   for($i = 1; $i < $count_feild ;$i++)
                   {
                        $table.="<td>".@$a[$i]."</td>";
                    
                    }
                    $table.="<td>"."<img src='../other_img/$a[0].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
                  $table.="<td>";
                     $table.="<a href='Struff_information.php?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px;' href='Struff_information.php?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()  '>Delete</a>";
                   
                    $table.="</tr>";
            }
        }
           $table.="<tr>"."<td colspan='19' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='Struff_information.php'  class='btn btn-danger' onClick='javascript:closeWindow();''>Back</a>"."</td>"."</tr>";
           

            $table.="</table>";


     //link ex struf add 
    if(isset($_GET['ex_Struf']))
    {
            if(!empty($_GET['ex_Struf']))
            {
                $select="SELECT * FROM `stuff_information` WHERE `stuff_id`='".$_GET['ex_Struf']."'";
                $checked_query=$db->select_query($select);
               
                //print_r($fetch_exstruf);
               if($checked_query)
                {
                         $fetch_exstruf=$checked_query->fetch_array();
                  
                        $ex_Struf_ins="INSERT INTO `ex_stuff`(`stuff_id`,`index_no`,`stuff_name`,`designation`,`date_of_birth`,`gender`,`blood_group`,`relegion`,`marital_status`,`mobile_no`,`fathers_name`,`mothers_name`,`present_address`,`parmanent_address`,`the_date_of_joining`,`educational_qualification`) VALUES('".$_GET['ex_Struf']."','".$fetch_exstruf[1]."','".$fetch_exstruf[2]."','".$fetch_exstruf[3]."','".$fetch_exstruf[4]."','".$fetch_exstruf[5]."','".$fetch_exstruf[6]."','".$fetch_exstruf[7]."','".$fetch_exstruf[8]."','".$fetch_exstruf[9]."','".$fetch_exstruf[10]."','".$fetch_exstruf[11]."','".$fetch_exstruf[12]."','".$fetch_exstruf[13]."','".$fetch_exstruf[14]."','".$fetch_exstruf[15]."')";
                        
                            $checkd_ins=$db->insert_query($ex_Struf_ins);
                         
                               // print "asdfasdf";
                            $Delete="DELETE FROM `stuff_information` WHERE `stuff_id`='".$_GET['ex_Struf']."'";
                            $db->delete_query($Delete);
                            header("location:struff_all_view.php");

                            
                           
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
</html>
	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
