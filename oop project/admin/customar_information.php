<?php
include("db.php");
$ob=new dbconnect();

$fetchinfo[0]="";
$fetchinfo[1]="";
$fetchinfo[2]="";
$fetchinfo[3]="";
$fetchinfo[4]="";


$id=isset($_POST["id"])?$_POST["id"]:"";
$Customername=isset($_POST["Customername"])?$_POST["Customername"]:"";
$Address=isset($_POST["Address"])?$_POST["Address"]:"";
$Email=isset($_POST["Email"])?$_POST["Email"]:"";
$Number=isset($_POST["Number"])?$_POST["Number"]:"";

if (isset($_POST["addbtn"])) 
  {
    if (!empty($id) && !empty($Customername) && !empty($Address) && !empty($Email) && !empty($Number)) 
      {
            $insert="INSERT INTO `customer_info` (`id`,`customer_name`,`address`,`email`,`number`) VALUES ('$id','$Customername','$Address','$Email','$Number')";
            $ob->insert($insert);
      }
  }


  if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `customer_info` WHERE `id`='".$_GET["editbtn"]."'";
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

    if (!empty($id) && !empty($Customername) && !empty($Address) && !empty($Email) && !empty($Number)) 
      {
            $edit="REPLACE INTO `customer_info` (`id`,`customer_name`,`address`,`email`,`number`) VALUES ('$id','$Customername','$Address','$Email','$Number')";
         $ob->edit($edit); 
         print "<script>location='customar_information.php'</script>";
     }
}


 if(isset($_GET["delbtn"]))
      {
        $del="DELETE FROM `customer_info` WHERE id='".$_GET["delbtn"]."'";
        $ob->del($del);
        print "<script>location='customar_information.php'</script>";
      }



 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <script src='tinymce/tinymce.min.js'></script>
        <script type="text/javascript">
          tinymce.init({
          selector: '#myTextarea'
          });
        </script>

    <title>customer_information</title>
  </head>
  <body>
    <form method="POST">
    <table class="table" style="max-width:85%;margin-top: 50px;" align="center">
    
      <thead>
        <tr>
         <th colspan="2" style="background-color:#2962FF;color:#fff;"><b><h2><center>CUSTOMER INFORMATION</center></h2></b></th>
       </tr>
     </thead>


      <tbody>

        <tr>
          <td><b>Customer ID</b></td>
          <td><input type="number" name="id" value="<?php print $fetchinfo[0]; ?>" placeholder="Enter ID....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Customer Name</b></td>
          <td><input type="Name" name="Customername" value="<?php print $fetchinfo[1]; ?>" placeholder="Enter Name....." class="form-control"></td>
        </tr>

         <tr>
          <td><b>Customer Address</b></td>
          <td><textarea class="form-control" id="myTextarea" name="Address"><?php print $fetchinfo[2]; ?></textarea></td>
        </tr>

        <tr>
          <td><b>Customer Email</b></td>
          <td><input type="email" name="Email" value="<?php print $fetchinfo[3]; ?>" placeholder="Enter Email....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Customer Number</b></td>
          <td><input type="number" name="Number" value="<?php print $fetchinfo[4]; ?>" placeholder="Enter Name....." class="form-control"></td>
        </tr>

        <tr>
          <td colspan="2" align="center" style="color: green;text-align: center;">
            <?php  print $ob->sms;?>
          </td>  
        </tr>

      </tbody>

      <tfoot>

        <tr>
          <td colspan="2" align="center">
            <button type="submit" name="addbtn" class="btn btn-success">Add</button>
            <button type="submit" name="edtbtn" class="btn btn-primary">Edit</button>
            <button type="submit" name="viewbtn" class="btn btn-info">View</button>
            <button type="submit" name="" class="btn btn-secondary">Cancel</button>
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
            <td align="center"><b>Customer ID</b></td>
            <td align="center"><b>Customer Name</b></td>
            <td align="center"><b>Customer Address</b></td>
            <td align="center"><b>Customer Email</b></td>
            <td align="center"><b>Customer Number</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `customer_info`";
            $r=$ob->selectQuery($sql);
            if($r)           
            {
                while($fetchData=$r->fetch_array())
                {
                  ?>
                  <tr>
                        <td align="center"><b><?php print $fetchData[0]; ?> </b></td>
                        <td align="center"><b><?php print $fetchData[1]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[2]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[3]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[4]; ?></b></td>
                        <td align="center"><a href="customar_information.php?editbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="customar_information.php?delbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-danger">Delete</a></td>
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