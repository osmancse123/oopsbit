<?php
  session_start();
   
  if($_SESSION["logstatus"] === "Active")
  { 
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
    $db = new database();

    $fetchData[0]="";
    $fetchData[1]="";
    $fetchData[2]="";
    $fetchData[3]="";
    $fetchData[4]="";
    $fetchData[5]="";

$varAdmin=$_SESSION["id"];

$varBankName=mysqli_real_escape_string($db->link,isset($_POST["bankName"])?$_POST["bankName"]:"");
$varAccountNumber=mysqli_real_escape_string($db->link,isset($_POST["accountNumber"])?$_POST["accountNumber"]:"");
$varDetails=mysqli_real_escape_string($db->link,isset($_POST["details"])?$_POST["details"]:"");
$varContact=mysqli_real_escape_string($db->link,isset($_POST["contact"])?$_POST["contact"]:"");

if(isset($_REQUEST["addBtn"]))
{
  if(!empty($varBankName) && !empty($varAccountNumber))
  {
    $sql="INSERT INTO `bank_information`(`bank_name`, `account_number`, `details`, `contact`,`admin`) VALUES ('$varBankName','$varAccountNumber','$varDetails','$varContact','$varAdmin')";
    $db->insert_query($sql);
    //echo $mod->sms;
    $message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}


if(isset($_REQUEST["editBtn"]))
{
  if(!empty($varBankName) and !empty($varAccountNumber))
  {
    $sql="Replace INTO `bank_information`(`id`,`bank_name`, `account_number`, `details`, `contact`, `admin`) VALUES ('".$_POST['id']."','$varBankName','$varAccountNumber','$varDetails','$varContact','$varAdmin')";
    $db->update_query($sql);
    //echo $mod->sms;
    $message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}

if(isset($_REQUEST["dltBtn"]))
{
  if(!empty($varBankName) && !empty($varAccountNumber))
  {
    $sql="DELETE FROM `bank_information` WHERE `id`='".$_POST['id']."'";
    $db->delete_query($sql);
    //echo $mod->sms;
    $message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}

if(isset($_GET["edtId"]))
{
    $sql="SELECT * FROM `bank_information` WHERE `id`='".$_GET['edtId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      $fetchData=$query->fetch_array();
      //print_r($fetch);
      //print $fetchData[0];
    }
}
if(isset($_GET["dltId"]))
{
    $sql="DELETE FROM `bank_information` WHERE `id`='".$_GET['dltId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      echo"Delete Successfully!!";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Bank Info</title>
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

  </head>
  <body>
    	<form name="" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

   
		 <table class="table table-bordered table-hover" style="max-width: 800px;" align="center">
		  <thead class="bg-light">
		    <tr>
		      <th scope="col" colspan="2" align="center" ><h3>Bank Account Info</h3></th>
		    </tr>
		  </thead>
		  <tbody>
        <input type="hidden" name="id" value="<?php echo $fetchData[0];?>" class="form-control" autocomplete="off">
		  <tr>
		      <td>Bank Name</td>
		      <td><input type="text" name="bankName" value="<?php echo $fetchData[1];?>" class="form-control" autocomplete="off"></td>
		    </tr>
		    <tr>
		      <td>Account Number</td>
		      <td><input type="text" name="accountNumber" value="<?php echo $fetchData[2];?>" class="form-control" autocomplete="off"></td>
		    </tr>
		   
		    <tr>
		      <td>Address</td>
		      <td><textarea name="details" rows="3" class="form-control"><?php echo $fetchData[3];?></textarea></td>
		    </tr>

		     <tr>
		      <td>Contact</td>
		      <td>
            <input type="text" name="contact" value="<?php echo $fetchData[4];?>" class="form-control" placeholder="" autocomplete="off"></td>
		    </tr>

		  

		     <tr class="bg-light">
		      <td scope="col" colspan="2" align="center">
		      <h4 class="text-success"><?php echo $message=isset($message)?$message:"" ; ?></h4>
		      	<button type="submit" name="addBtn" class="btn btn-success">Add</button>
		      	<button type="submit" name="editBtn" class="btn btn-primary">Edit</button>
				<button type="submit" name="dltBtn" class="btn btn-danger">Delete</button>
				<button type="submit" name="viewBtn" class="btn btn-info">View</button>
				<button type="submit" name="" class="btn btn-secondary">Cancel</button>
		      </td>
		    </tr>
		  </tbody>
		</table>

		<?php
          if(isset($_REQUEST["viewBtn"]))
            {
              $table="<table class=' table table-hover table-bordered ' style='max-width:800px; background-color:#fff;' align='center'>";
              $sql="SELECT * FROM `bank_information`";
              $query=$db->select_query($sql);

              $table.="<tr class=' table table-bordered' style='background-color:#ccc;' align='center'> 
                        <td><b>Bank Name</b></td>
                        <td><b>Account Number</b></td>
                        <td><b>Details</b></td>
                        <td><b>Contact</b></td>
                     
                        <td><b>Admin</b></td>
                        <td><b>Edit</b></td>
                        <td><b>Delete</b></td>
                    </tr>";
              if($query)
              {


              while($fetch=$query->fetch_array())
              {
                $table.="<tr> 
                    <td>$fetch[1]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[3]</td>
                    <td>$fetch[4]</td>
                    <td>$fetch[5]</td>
             
                    <td><a href='bank_info.php?edtId=$fetch[0]' class='btn btn-outline-primary btn-sm'>EDIT </a></td>
                    <td><a href='bank_info.php?dltId=$fetch[0]' class='btn btn-outline-danger btn-sm' onClick='return Confirm_Click_Delete()'>DELETE </a></td>
                    </tr>";
              }  
            }
              $table.="</table>";
            echo $table;  
          }
          
        ?>		
	</form>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


