<?php
include("db.php");
  $ob=new dbconnect();

  $fetchinfo[7]="";
  $date=isset($_POST["date"])?$_POST["date"]:"";
  $Year=isset($_POST["Year"])?$_POST["Year"]:"";
  $Hand_in_Cash=isset($_POST["Hand_in_Cash"])?$_POST["Hand_in_Cash"]:"";
  $Bank_Deposit=isset($_POST["Bank_Deposit"])?$_POST["Bank_Deposit"]:"";
  $Account_Payable=isset($_POST["Account_Payable"])?$_POST["Account_Payable"]:"";
  $Account_Receiveable=isset($_POST["Account_Receiveable"])?$_POST["Account_Receiveable"]:"";
  $Admin=isset($_POST["Admin"])?$_POST["Admin"]:"";


if (isset($_POST["addbtn"])) 
  {
    if (!empty($date) && !empty($Year) && !empty($Hand_in_Cash) && !empty($Bank_Deposit) && !empty($Account_Payable)  && !empty($Account_Receiveable) && !empty($Admin)) 
      {
         $insert="INSERT INTO `opening_balance` (`date`,`year`,`hend_in_cash`,`bank_deposit`,`accounts_receiveable`,`accounts_payable`,`admin`) VALUES ('$date','$Year','$Hand_in_Cash','$Bank_Deposit','$Account_Payable','$Account_Receiveable','$Admin')";
         $ob->insert($insert);
      }
  }

  if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `opening_balance` WHERE `id`='".$_GET["editbtn"]."'";
      $r=$ob->selectQuery($sql);
      if($r)
      {
          $fetchinfo=$r->fetch_array();
         // print_r( $fetchinfo);
      }
      else
      {
          print "Check Info";
      }
  }
if (isset($_POST["edtbtn"])) 
  {
    if (!empty($date) && !empty($Year) && !empty($Hand_in_Cash) && !empty($Bank_Deposit) && !empty($Account_Payable)  && !empty($Account_Receiveable) && !empty($Admin)) 
      {
         $edit="REPLACE INTO `opening_balance` (`id`,`date`,`year`,`hend_in_cash`,`bank_deposit`,`accounts_receiveable`,`accounts_payable`,`admin`) VALUES ('".$_GET["editbtn"]."','$date','$Year','$Hand_in_Cash','$Bank_Deposit','$Account_Payable','$Account_Receiveable','$Admin')
";
         $ob->edit($edit);
      }
  }

  if(isset($_GET["delbtn"]))
  {
    $del="DELETE FROM `opening_balance` WHERE `id`='".$_GET["delbtn"]."'";
    $ob->del($del);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>opening balance</title>
  </head>
  <body>

    <form method="POST">

      <table class="table  table-bordered" style="max-width:80%;margin-top: 50px;" align="center">
      	<thead>
      		<tr>
      			<th colspan="2" style="background-color:#2962FF; color: #fff; font-size:35px;"><center>Opening Balance</center></th>
      		</tr>
      	</thead>
      	<tbody>


      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Date</span></td>
      			<td><input type="date"  name="date" value="<?php print $fetchinfo[1]; ?>" class="form-control" ></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Year</span></td>
      			<td><input type="number"  name="Year" value="<?php print $fetchinfo[2]; ?>" class="form-control"></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Hand in Cash</span></td>
      			<td><input type="number" name="Hand_in_Cash" value="<?php print $fetchinfo[3]; ?>" class="form-control"></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Bank Deposit</span></td>
      			<td><input type="number"  name="Bank_Deposit" value="<?php print $fetchinfo[4]; ?>" class="form-control"></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Account Payable</span></td>
      			<td><input type="number" name="Account_Payable"  value="<?php print $fetchinfo[5]; ?>" class="form-control"></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Account Receiveable</span></td>
      			<td><input type="number" name="Account_Receiveable"  value="<?php print $fetchinfo[6]; ?>" class="form-control"></td>
      		</tr>
      		<tr>
      			<td><span style="font-size:18px; margin-left:20px;">Admin</span></td>
      			<td><input type="text" name="Admin" value="<?php print $fetchinfo[7]; ?>" class="form-control"></td>
      		</tr>
          <tr>
          <td style="color: green;" colspan="2">
            <?php print $ob->sms;?>
          </td>
        </tr>
      	</tbody>

      	<tfoot>
      		<tr>
      			<td colspan="2" align="center">
      				<button type="submit" name="addbtn"  class="btn btn-success">Add</button>
      				<button name="edtbtn" type="submit" class="btn btn-primary">Edit</button>
      				<button name="" type="submit" class="btn btn-danger">Delete</button>
      				<button name="viewbtn" type="submit" class="btn btn-info">View</button>
      				<button name="" type="submit" class="btn btn-secondary">Cancel</button>
      			</td>
      		</tr>
      	</tfoot>
      </table>

      <?php

      if(isset($_POST["viewbtn"]))
      {
      ?>
        <table class="table table-bordered">
          <tr>
            <td align="center"><b>Date</b></td>
            <td align="center"><b>Year</b></td>
            <td align="center"><b>Hand in Cash</b></td>
            <td align="center"><b>Bank Deposit</b></td>
            <td align="center"><b>Account Payable</b></td>
            <td align="center"><b>Account Receiveable</b></td>
            <td align="center"><b>Admin</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `opening_balance`";
            $r=$ob->selectQuery($sql);
            if($r)           
            {
                while($fetchData=$r->fetch_array())
                {
                  ?>
                  <tr>
                        <td align="center"><b><?php print $fetchData[1]; ?> </b></td>
                        <td align="center"><b><?php print $fetchData[2]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[3]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[4]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[5]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[6]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[7]; ?></b></td>
            
                        <td align="center"><a href="opening_balance.php?editbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="opening_balance.php?delbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-danger">Delete</a></td>
                  </tr>
                  <?php
                }
            }
          ?>
        </table>
    <?php
      }
    ?>


      	</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>