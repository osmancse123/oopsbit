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
   
    <title>Members of donor information</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
            $select="SELECT * FROM `donermembersinfo`";
            $checkt=$db->select_query($select);
            if($checkt)
            {
            $count_feild=mysqli_num_fields($checkt);
            } 
           $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px;'>"."<tr class='success'>"."<td>Index No</td>"."<td>Name <td>"."<td>Designation </td>"."<td>Voter ID No/td>"."<td>Date Of Brith </td>"."<td>Gendar </td>"."<td>Blood Group </td>"."<td>Religious </td>"."<td>Relationship</td>"."<td>Father Name</td>"."<td>Mother Name </td>"."<td>Present Address </td>"."<td>Permanent Address</td>"."<td>Education Qualification</td>"."<td> Mobile No</td>"."<td>Picture </td>"."<td>Edit Or Delete</td>"."</tr>";
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                   for($i = 1; $i < $count_feild ;$i++)
                   {
                        $table.="<td>".$a[$i]."</td>";
                    
                    }
                    $table.="<td>"."<img src='../other_img/$a[0].jpg' height='120' width='120'>"."</td>";
                  $table.="<td>";
                     $table.="<a href='donermembersinfo.php?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a><a style='width:80px; margin-top:2px;' href='donermembersinfo.php?dlt=$a[0]' class='btn btn-primary' onclick='return confirm_delete()  '>Delete</a>";
                   
                    $table.="</tr>";
            }
        }
           $table.="<tr>"."<td colspan='20' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='donermembersinfo.php'  class='btn btn-primary' onClick='javascript:closeWindow();''>Back</a>"."</td>"."</tr>";
           

            $table.="</table>";


        ?>

        <?php echo $table; ?>
    </form>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
