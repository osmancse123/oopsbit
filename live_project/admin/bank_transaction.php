<?php
  session_start();
  date_default_timezone_set("Asia/Dhaka");

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
    $fetchData[6]="";

    $varBankName=mysqli_real_escape_string($db->link,isset($_POST["bankName"])?$_POST["bankName"]:"");
    $varAccountName=mysqli_real_escape_string($db->link,isset($_POST["accountName"])?$_POST["accountName"]:"");
    $varAccType=mysqli_real_escape_string($db->link,isset($_POST["transactionType"])?$_POST["transactionType"]:"");
    $varVouchar=mysqli_real_escape_string($db->link,isset($_POST["VoucherNo"])?$_POST["VoucherNo"]:"");

   

    $varAmount=mysqli_real_escape_string($db->link,isset($_POST["amount"])?$_POST["amount"]:"");

    if($varAccType=="Withdraw" or $varAccType=="Cost")
    {
      $varAmount='-'.$varAmount;
    }

    
    $varDate=mysqli_real_escape_string($db->link,isset($_POST["date"])?$_POST["date"]:"");
    $varAdmin=mysqli_real_escape_string($db->link,isset($_POST["admin"])?$_POST["admin"]:"");

if(isset($_REQUEST["addBtn"]))
{
  if(!empty($varAccountName) and !empty($varAmount))
  {
    $sql="INSERT INTO `bank_transaction`(`account_name`,`transaction_type`,`vouchar_no`,`amount`,`date`,`admin`,`EntryDate`) VALUES ('$varAccountName','$varAccType','$varVouchar','$varAmount','$varDate','$varAdmin','".date('Y-m-d')."')";
    $db->insert_query($sql);
    
    $message=$message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }

}


if(isset($_REQUEST["editBtn"]))
{

  if(!empty($varAccountName) and !empty($varAmount))
  {
   //  $sql="INSERT INTO `bank_transaction`(`id`,`account_name`,`transaction_type`,`vouchar_no`,`amount`,`date`,`admin`,`EntryDate`) VALUES ('',$varAccountName','$varAccType','$varVouchar','$varAmount','$varDate','$varAdmin','".date('Y-m-d')."')";
   //  $db->update_query($sql);
   //  //echo $mod->sms;
   // $message=$message=$db->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}



if(isset($_REQUEST["dltBtn"]))
{
  if(!empty($varAccountName) and !empty($varAmount))
  {
    $sql="DELETE FROM `bank_transaction` WHERE vouchar_no='$varVouchar'";
    $mod->excuteQuery($sql);
    //echo $mod->sms;
    $message="Data Update"."&nbsp;". $mod->sms;
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}


if(isset($_GET["edtId"]))
{
    $sql="SELECT * FROM `bank_transaction` WHERE `vouchar_no`='".$_GET['edtId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      $fetchData=$query->fetch_array();
      //print_r($fetch);
      print $fetchData[0];
    }
}



if(isset($_GET["dltId"]))
{
    $sql="DELETE FROM `bank_transaction` WHERE `vouchar_no`='".$_GET['dltId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      echo"Delete success";
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

    <title>Bank Transaction</title>

    <script type="text/javascript">
      
      
      $(document).ready(
        function()
        {
            getValue();
        }
    );

      
      function getValue()
      {

              var val= parseFloat($('#amount').val());
              
              if(isNaN(val))
              {
                   $('#amount').val('');
              }
              else
              {
                   $('#amount').val(val);
              }

      }

    </script>
  </head>
  <body>
    <form name="" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
		 <table class="table table-bordered table-hover" style="max-width: 800px;" align="center">
		  <thead class="bg-default">
		    <tr>
		      <th scope="col" colspan="2" align="center"> <center> <h3>Bank Transaction Entry</h3></center></th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr >
		      <td width="200">Bank Name</td>
		      <td>
		      	<select class="form-control" name="bankName" >
		      		<option>Select Bank Name</option>
		          <?php
                $selectBank="SELECT * FROM `bank_information` ORDER BY `bank_name` ASC ";
                $querySelectBank=$db->link->query($selectBank);
              if($querySelectBank)
              {
                while($fetchBankName=$querySelectBank->fetch_array())
                {
                  print "<option value='$fetchBankName[0]'>$fetchBankName[1]</option>";
                }
              }
              ?>
            </select>
		      	
		      </td>
		    </tr>

		     <tr>
		      <td>Account Name</td>
		      <td><input type="text" name="accountName" value="<?php echo $fetchData[1];?>" class="form-control" autocomplete="off" ></td>
		    </tr>
		    <tr>
		      <td>Transaction Type</td>
		      <td>
			      <div class="custom-control custom-radio custom-control-inline">
				    <input type="radio" class="custom-control-input" id="customRadio" name="transactionType" value="Deposit">
				    <label class="custom-control-label" for="customRadio">Deposit</label>
				  </div>

				  <div class="custom-control custom-radio custom-control-inline">
				    <input type="radio" class="custom-control-input" id="customRadio2" name="transactionType" value="Withdraw">
				    <label class="custom-control-label" for="customRadio2">Withdraw</label>
				  </div> 

           <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="customRadio3" name="transactionType" value="Cost">
            <label class="custom-control-label" for="customRadio3">Bank Acc. Cost</label>
          </div> 


		      </td>
		    </tr>
		   
		    <tr>
		      <td>Voucher No/Check No</td>
		      <td><input type="text" name="VoucherNo" value="<?php echo $fetchData[3];?>" class="form-control" autocomplete="off"></td>
		    </tr>
		     <tr>
		      <td>Amount</td>
		      <td><input type="text" name="amount" value="<?php echo $fetchData[4];?>" class="form-control" autocomplete="off" onkeyup="return getValue();" id="amount"></td>
		    </tr>

		    <tr>
		      <td>Date</td>
		      <td><input type="text" name="date" value="<?php echo $fetchData[5];?>" class="form-control" autocomplete="off" placeholder="dd-mm-yyyy"></td>
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
              $sql="SELECT * FROM `bank_transaction`";
              $query=$db->link->query($sql);
              if($query)
              {



              $table.="<tr class=' table table-bordered' style='background-color:#ccc;' align='center'> 
                        <td><b>Bank Name</b></td>
                        <td><b>Account Name</b></td>
                        <td><b>Transaction Type</b></td>
                        <td><b>Vouchar No</b></td>
                        <td><b>Amount</b></td>
                        <td><b>Date</b></td>
                        <td><b>Admin</b></td>
                        <td><b>Edit</b></td>
                        <td><b>Delete</b></td>
                    </tr>";
              while($fetch=$query->fetch_array())
              {
                $table.="<tr> 
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[3]</td>
                    <td>$fetch[4]</td>
                    <td>$fetch[5]</td>
                    <td>$fetch[6]</td>
                    <td><a href='bank_transaction.php?edtId=$fetch[3]' class='btn btn-outline-primary btn-sm'>EDIT </a></td>
                    <td><a href='bank_transaction.php?dltId=$fetch[3]' class='btn btn-outline-danger btn-sm' onClick='return Confirm_Click_Delete()'>DELETE </a></td>
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


