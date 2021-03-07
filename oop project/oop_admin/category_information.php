<?php
include("db.php");
$ob=new dbconnect();


$itemName=isset($_POST["itemName"])?$_POST["itemName"]:"";
$id=isset($_POST["id"])?$_POST["id"]:"";
$catName=isset($_POST["catName"])?$_POST["catName"]:"";

  if(isset($_POST["addBtn"]))
  {
    if(!empty($itemName) && !empty($id) && !empty($catName))
    {
      $insert="INSERT INTO `category_information` (`item_name`,`id`,`category_name`) VALUES ('$itemName','$id','$catName')";
      $ob->insert($insert);
      
    }
  }


  if (isset($_POST["editbtn"])) 
  {

    if (!empty($itemName) && !empty($id) && !empty($catName)) 
     {

        $edit="REPLACE INTO `category_information`(`item_name`,`id`,`category_name`) VALUES('$itemName','$id','$catName') ";
         $ob->edit($edit); 
     }
}


if(isset($_GET["editid"]))
  {

      $sql="SELECT * FROM `category_information` WHERE `id`='".$_GET["editid"]."'";
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
        $del="DELETE FROM `category_information` WHERE `id`='".$_GET["delbtn"]."'";
        $ob->del($del);
        
      }


  if(isset($_POST["cancelbtn"]))
  {
    echo exit();
  }


?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Category_infromation</title>
  </head>
  <body><br>
    <form method="POST">
    <table class="table table-bordered" style="max-width:80%" align="center">

      <thead>

        <tr>
          <th colspan="2" style="background-color:#CCC;"><b><h2><center>CATEGORY INFORMATION</center></h2></b></th>
        </tr>

      </thead>

      <tbody>

        <tr>
          <td><b>Item Name</b></td>
          <td> 
            <select class="form-control" name="itemName">

                <?php
                  if (isset($_GET["editid"]))
                  {
                    print "<option>$fetchinfo[0]</option>";
                  }
                  ?>

              <option>One Select</option>

              <?php

                $sql="SELECT * FROM `item_info`";
                $q=$ob->selectQuery($sql);
                if($q)
                {
                  
                  while($fetch=$q->fetch_array())
                  {
                    print"<option>$fetch[1]</option>";
                  }
                }

              ?>

            </select>
          </td>
        </tr>

        <tr>
          <td><b>Categoty ID</b></td>
          <td><input type="number" name="id" value="<?php echo $fetchinfo[1] ;?>" placeholder="Enter ID....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Categoty Name</b></td>
          <td><input type="text" name="catName" value="<?php echo $fetchinfo[2] ;?>" placeholder="Enter Name....." class="form-control"></td>
        </tr>

        <tr>
          <td style="color: green" colspan="2">
            <?php print $ob->sms; ?>
          </td>
        </tr>

      </tbody>


      <tfoot>

        <tr>
          <td colspan="2" align="center">
            <button type="submit" name="addBtn" class="btn btn-success">Add</button>
            <button type="submit" name="editbtn" class="btn btn-primary">Edit</button>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="submit" name="viewBtn" class="btn btn-info">Viwe</button>
            <button type="submit" name="cancelbtn" class="btn btn-secondary">Cencel</button>
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
        <td align="center">Item Name</td>
        <td align="center">cate ID</td>
        <td align="center">cate Name</td>
        <td align="center">Edit</td>
        <td align="center">Delete</td>
      </tr>

      <?php
        $sql="SELECT * FROM `category_information`";
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
               <td align="center"><a href="category_information.php?editid=<?php echo $fetchData[1];?>" type="submit" name="" class="btn btn-primary">Edit</a></td>
              <td align="center"><a href="category_information.php?delbtn=<?php echo $fetchData[1];?>" type="submit" name="" class="btn btn-danger">Delete</a></td>
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