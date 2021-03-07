<?php
include("db.php");
$ob=new dbconnect();


$Id=isset($_POST["ID"])?$_POST["ID"]:"";
$Name=isset($_POST["cusName"])?$_POST["cusName"]:"";
$Address=isset($_POST["address"])?$_POST["address"]:"";
$Email=isset($_POST["email"])?$_POST["email"]:"";
$number=isset($_POST["num"])?$_POST["num"]:"";

  if(isset($_POST["addBtn"]))
  {
    if(!empty($Id) && !empty($Name) && !empty($Address) && !empty($Email) && !empty($number))
    {
      $insert="INSERT INTO `customer_info` (`ID`,`name`,`address`,`email`,`number`) VALUES ('$Id','$Name','$Address','$Email','$number')";
      $ob->insert($insert);
      
    }
  }


  if (isset($_POST["editbtn"])) 
  {

      if(!empty($Id) && !empty($Name) && !empty($Address) && !empty($Email) && !empty($number)) 
     {

        $edit="REPLACE INTO `customer_info` (`ID`,`name`,`address`,`email`,`number`) VALUES ('$Id','$Name','$Address','$Email','$number')";
         $ob->edit($edit); 
     }
}


if(isset($_GET["editid"]))
  {

      $sql="SELECT * FROM `customer_info` WHERE `ID`='".$_GET["editid"]."'";
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

   if(isset($_GET["delbtn"]))
      {
        $del="DELETE FROM `customer_info` WHERE `ID`='".$_GET["delbtn"]."'";
        $ob->del($del);
        
      }



?>


<!doctype html>
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
  <body><br> <br>
    <form name="" method="post">


    <table class="table table-bordered" style="max-width:80%" align="center">
    
      <thead>
        <tr>
         <th colspan="2" style="background-color:#ccc;"><b><h2><center>CUSTOMER INFORMATION</center></h2></b></th>
       </tr>
     </thead>


      <tbody>

        <tr>
          <td><b>Customer ID</b></td>
          <td><input type="text" name="ID" value="<?php echo $fetchinfo[0] ?>" placeholder="Enter ID....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Customer Name</b></td>
          <td><input type="Name" name="cusName" value="<?php echo $fetchinfo[1] ?>" placeholder="Enter Name....." class="form-control"></td>
        </tr>

         <tr>
          <td><b>Customer Address</b></td>
          <td><textarea class="form-control" value="<?php echo $fetchinfo[2] ?>" name="address" id="myTextarea"></textarea></td>
        </tr>

        <tr>
          <td><b>Customer Email</b></td>
          <td><input type="text" name="email" value="<?php echo $fetchinfo[3] ?>" placeholder="Enter Email....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Customer Number</b></td>
          <td><input type="text" name="num" value="<?php echo $fetchinfo[4] ?>" placeholder="Enter Name....." class="form-control"></td>
        </tr>

      </tbody>

        <tr>
          <td style="color: green" colspan="2">
            <?php print $ob->sms; ?>
          </td>
        </tr>

      <tfoot>

        <tr>
          <td colspan="2" align="center">
            <button type="submit" name="addBtn" class="btn btn-success">Add</button>
            <button type="submit" name="editbtn" class="btn btn-primary">Edit</button>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="submit" name="viewBtn" class="btn btn-info">Viwe</button>
            <button type="submit" class="btn btn-secondary">Cencel</button>
          </td>
        </tr>

      </tfoot>

    </table>

     <?php

        if(isset($_POST["viewBtn"]))
        {
          ?>
     <table class="table table-bordered">
      <tr>
       
        <td align="center">cust ID</td>
        <td align="center">cust Name</td>
        <td align="center">cust address</td>
        <td align="center">cust email</td>
        <td align="center">cust number</td>
        <td align="center">Edit</td>
        <td align="center">Delete</td>
      </tr>

      <?php
        $sql="SELECT * FROM `customer_info`";
        $r=$ob->selectQuery($sql);
        if($r)
        {
          while($fetchData=$r->fetch_array())
          {
            ?>
            <tr>
              <td align="center"><b><?php echo $fetchData[0]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[1]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[2]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[3]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[4]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[5]; ?></b></td>
               <td align="center"><a href="customar_information.php?editid=<?php echo $fetchData[0];?>" type="submit" name="" class="btn btn-primary">Edit</a></td>
              <td align="center"><a href="customar_information.php?delbtn=<?php echo $fetchData[0];?>" type="submit" name="" class="btn btn-danger">Delete</a></td>
            </tr>

            <?php

           }
        }
       ?>
    </table>
    <?php
      }
      ?>
    
    
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </form>
  </body>
</html>