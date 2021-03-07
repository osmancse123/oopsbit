<?php
  session_start();
  $admin=$_SESSION["id"];
  if($_SESSION["logstatus"] === "Active")
  { 
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

    $db = new database();


$fetchData[0]="";
$fetchData[1]="";
$fetchData[2]="";
$fetchData[3]="";
"";


$varDate=mysqli_real_escape_string($db->link,isset($_POST["date"])?$_POST["date"]:"");

if($varDate!="")
{
    $x=explode('-',$varDate);
    $date=$x[2].'-'.$x[1].'-'.$x[0];
}

  //print $date;

$varAmount=mysqli_real_escape_string($db->link,isset($_POST["amount"])?$_POST["amount"]:"");
$varDetails=mysqli_real_escape_string($db->link,isset($_POST["details"])?$_POST["details"]:"");

if(isset($_REQUEST["addBtn"]))
{
  if(!empty($varDate) and !empty($varAmount))
  {
    $sql="INSERT INTO `handin_cash` (`date`, `Previous_Blance`,`Current_Blance`, `details`,`admin`) VALUES('$date','0.00','$varAmount','$varDetails','$admin')";
    $db->insert_query($sql);
    //echo $mod->sms;
    $message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}


// if(isset($_REQUEST["editBtn"]))
// {
//   if(!empty($varDate) and !empty($varAmount))
//   {
//     $sql="Replace INTO `handin_cash` (`sl`, `date`, `amount`, `details`,`admin`) VALUES('$varId','$varDate','$varAmount','$varDetails','306')";
//     $mod->excuteQuery($sql);
//     //echo $mod->sms;
//     $message="Data Update"."&nbsp;". $mod->sms;
//   }
//   else
//   {
//     $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
//   }
// }


// if(isset($_REQUEST["dltBtn"]))
// {
//   if(!empty($varDate) and !empty($varAmount))
//   {
//     $sql="DELETE FROM `handin_cash` WHERE `sl`='$varId'";
//     $mod->excuteQuery($sql);
//     //echo $mod->sms;
//     $message="Data Delete"."&nbsp;". $mod->sms;
//   }
//   else
//   {
//     $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
//   }
// }

// if(isset($_GET["edtId"]))
// {
//     $sql="SELECT * FROM `handin_cash` WHERE `sl`='".$_GET['edtId']."'";
//     $query=$db->link->query($sql);
//     if($query)
//     {
//       $fetchData=$query->fetch_array();
//       //print_r($fetch);
//       print $fetchData[0];
//     }
// }

if(isset($_GET["dltId"]))
{
    $sql="DELETE FROM `handin_cash` WHERE `sl`='".$_GET['dltId']."'";
    $query=$db->delete_query($sql);
    if($query)
    {
     $message=$db->sms;
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
  
  
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>

 <link rel="stylesheet" href="datespicker/datepicker.css">
 <link rel="stylesheet" href="datespicker/bootstrap.min.css">
  <script src="datespicker/bootstrap-datepicker.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <title>Hand in Cash</title>
  </head>

  <script type="text/javascript">
      $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );
</script>


<script type="text/javascript">
    $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd-mm-yyyy"
                    });  
                
                });

  </script>

  <script type="text/javascript">
    function Confirm_Click_Delete()
    {
      var con=confirm("Are you confirm delete data?");
      if(con==true)
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
    
	<form name="" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
		 	<table class="table table-bordered table-hover" style="max-width: 800px;" align="center">
		 
		    <tr>
		      <td scope="col" colspan="2" style="background: #f4f4f4; text-align: center;"><h3> Add Hand in Cash</h3></td>
		    </tr>
		
		  <tbody>
		 
		    <tr>
		      <td>Date</td>
		      <td><input type="text" name="date"  class="form-control"  id="example1" autocomplete="off"  style="max-width: 400px;"></td>
		    </tr>
		    <tr>
		      <td>Amount</td>
		      <td><input type="text" name="amount"  class="form-control" placeholder=""  autocomplete="off"  style="max-width: 400px;"></td>
		    </tr>
		    <tr>
		      <td>Details</td>
		      <td><textarea name="details" rows="5" class="form-control" id="redactor"></textarea></td>
		    </tr>

		     <tr class="bg-light">
		      <td scope="col" colspan="2" align="center"> <h4 class="text-success"><?php echo $message=isset($message)?$message:"" ; ?></h4>
		      	<button type="submit" name="addBtn" class="btn btn-success">Save</button>
            <button type="submit" name="viewBtn" class="btn btn-info">View</button>
		      	
		
				<button type="submit" name="" class="btn btn-secondary">Clear</button>
		      </td>
		    </tr>
		  </tbody>
		</table>


		<?php
          if(isset($_REQUEST["viewBtn"]))
            {
              $table="<table class=' table table-hover table-bordered ' style='max-width:800px; background-color:#fff;' align='center'>";
              $sql="SELECT * FROM `handin_cash`";
              $query=$db->select_query($sql);

        if($query)
        {


              $table.="<tr class=' table table-bordered' style='background-color:#ccc;' align='center'> 
                        <td><b>SL No</b></td>
                        <td><b>Date</b></td>
                         <td><b>Details</b></td>
                        <td><b>Previous Blance</b></td>
                         <td><b>Current Blance</b></td>
                       
                        
                        <td><b>Delete</b></td>
                    </tr>";
              while($fetch=$query->fetch_array())
              {

                 $d=explode('-',$fetch[1]);
                 $fetchDate=$d[2].'-'.$d[1].'-'.$d[0];

                $table.="<tr> 
                    <td>$fetch[0]</td><td>$fetchDate</td> <td>$fetch[4]</td><td>$fetch[2]</td><td>$fetch[3]</td>
                    <td><a href='handin_cash.php?dltId=$fetch[0]' class='btn btn-outline-danger btn-sm' onClick='return Confirm_Click_Delete()'>DELETE </a></td></tr>";
              }  
          }
              $table.="</table>";
            echo $table;  
          }
          
        ?>	
	</form>
    <!-- Optional JavaScript -->
    
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


