<?php
include("db.php");
$ob=new dbconnect();


$id=isset($_POST["id"])?$_POST["id"]:"";
$itemName=isset($_POST["name"])?$_POST["name"]:"";

  if(isset($_POST["addbtn"]))
  {
    if(!empty($id) && !empty($itemName))
    {
      $insert="INSERT INTO `item_info` (`id`,`name`) VALUES ('$id','$itemName')";
      $ob->insert($insert);
      
    }
  }


  if(isset($_GET["editid"]))
  {

      $sql="SELECT * FROM `item_info` WHERE `id`='".$_GET["editid"]."'";
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

  if (isset($_POST["edtBtn"])) 
  {
    if (!empty($id) && !empty($itemName)) 
      {
         $edit="REPLACE INTO `item_info` (`id`,`name`) VALUES ('$id','$itemName')";
         $ob->edit($edit);
      }
  }

  if(isset($_GET["delbtn"]))
  {
    $del="DELETE FROM `item_info` WHERE `id`='".$_GET["delbtn"]."'";
    $ob->del($del);
  }



  if(isset($_POST["cancelbtn"]))
  {
    echo exit();
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>About_Us</title>
  </head>
  <body>

    <form method="POST">

      <table class="table table-striped" style="max-width:80%;" align="center">

      <thead>
        <tr style="margin-top:200px;">
          <th colspan="2" style="background-color:#2962FF; color: #fff;"><b><h2><center>ITEM INFORMATIONS</center></h2></b></th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><b>Item ID</b></td>
          <td><input type="number" name="id" value="<?php echo $fetchinfo[0]; ?>" placeholder="Enter Item ID...." class="form-control"></td>
        </tr>
        <tr>
          <td><b>Item Name</b></td>
          <td><input type="text" name="name" value="<?php echo $fetchinfo[1]; ?>" placeholder="Enter Item Name...." class="form-control"></td>
        </tr>
      </tbody>

      <tr>
        <td style="color: green;" colspan="2">
          <?php print $ob->sms;?>
        </td>
      </tr>

      <tfoot>
        <tr>
          <td colspan="2" align="center">
            <button type="submit" name="addbtn" class="btn btn-success">Add</button>
            <button type="submit" name="edtBtn" class="btn btn-primary">Edit</button>
            <button type="submit" name="Delete" class="btn btn-danger">Delete</button>
            <button type="submit" name="viewBtn" class="btn btn-info">View</button>
            <button type="submit" name="cancelbtn" class="btn btn-secondary">Cancel</button>
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
        <td class="bg-primary text-white">Item ID</td>
        <td class="bg-primary text-white">Item Name</td>
        <td class="bg-primary text-white">Edit</td>
        <td class="bg-primary text-white">Delete</td>
      </tr>

      <?php
        $sql="SELECT * FROM `item_info`";
        $r=$ob->selectQuery($sql);
        if($r)
        {
          while($fetchData=$r->fetch_array())
          {
            ?>
            <tr>
              <td align="center"><b><?php echo $fetchData[0]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[1]; ?></b></td>
              <td align="center"><a href="Item_information.php?editid=<?php echo $fetchData[0] ?>" type="submit" name="" class="btn btn-primary">Edit</a></td>
              <td align="center"><a href="Item_information.php?delbtn=<?php echo $fetchData[0] ?>" type="submit" name="" class="btn btn-danger">Delete</a></td>
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