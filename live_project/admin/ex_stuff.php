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
   
    <title></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
  </head>
  <script type="text/javascript">
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

  <body>
 
        <?php
            global $i;
            global $table;
            $select="SELECT * FROM `ex_stuff`";
            $checkt=$db->select_query($select);
            if($checkt)
            {
            $count_feild=mysqli_num_fields($checkt); 
            }
            $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px;'>";
            $table.="<tr class='warning'>"."<td colspan='19' align='center'><span style='font-size:22px;'>প্রাক্তন কর্মচারীদের তথ্য</span></td>"."</tr>";
            $table.="<tr class='success'>"."<td>ইন্ডেক্স নং</td>"."<td>নাম</td>"."<td>পদবী</td>"."<td>জন্ম তারিখ</td>"."<td>লিঙ্গ</td>"."<td>রক্তের গ্রুপ</td>"."<td>ধর্ম</td>"."<td>বৈবাহিক অবস্থা</td>"."<td>মোবাইল</td>"."<td>পিতার নাম</td>"."<td>মাতার নাম</td>"."<td>বর্তমান ঠিকানা</td>"."<td> স্থায়ী ঠিকানা</td>"."<td>চাকুরিতে প্রথম   তারিখ</td>"."<td>শিক্ষাগত যোগ্যতা</td>"."<td>ছবি</td>"."<td> Delete</td>"."</tr>";
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                   
                   for($i = 1; $i < $count_feild ;$i++)
                   {
                        $table.="<td>".@$a[$i]."</td>";
                    
                    }
                    $table.="<td>"."<img src='../other_img/$a[0].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
                  $table.="<td>";
                     $table.="<a style='width:80px; margin-top:2px;' href='ex_stuff.php?dlt=$a[0]' class='btn btn-danger' onclick='return confirm_delete()'>Delete</a>";
                   
                    $table.="</tr>";
            }

        }
           $table.="<tr>"."<td colspan='19' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='ex_stuff.php'  class='btn btn-primary' onClick='javascript:closeWindow();''>Back</a>"."</td>"."</tr>";
           

            $table.="</table>";


                if(isset($_GET['dlt']))
                {
                    if(!empty($_GET['dlt']))
                    {
                        $Delet="DELETE FROM `ex_stuff` WHERE `stuff_id`='".$_GET['dlt']."'";
                        $db->delete_query($Delet);
                        @unlink("../other_img/".$_GET['dlt'].".jpg");
                        header("location:ex_stuff.php");
                    }
                }
   
        ?>

        <?php echo $table; ?>
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
