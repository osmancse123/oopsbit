<?php
include("db.php");
$ob=new dbconnect();


$itemName=isset($_POST["itemName"])?$_POST["itemName"]:"";
$CateName=isset($_POST["CatName"])?$_POST["CatName"]:"";
$proId=isset($_POST["ID"])?$_POST["ID"]:"";
$proName=isset($_POST["ProName"])?$_POST["ProName"]:"";
$proPrice=isset($_POST["proPrice"])?$_POST["proPrice"]:"";
$proDetails=isset($_POST["Details"])?$_POST["Details"]:"";
$proStock=isset($_POST["proStock"])?$_POST["proStock"]:"";
$proPic=isset($_POST["Picture"])?$_POST["Picture"]:"";

  if(isset($_POST["addBtn"]))
  {
    if(!empty($itemName) && !empty($CateName) && !empty($proId) && !empty($proName) && !empty($proPrice) && !empty($proDetails) && !empty($proStock) && !empty($proPic))
    {
      $insert="INSERT INTO `product_info` (`item_name`,`cat_name`,`pro_id`,`pro_name`,`pro_price`,`pro_details`,`pro_stock`,`pro_pic`) VALUES ('$itemName','$CateName','$proId','$proName','$proPrice','$proDetails','$proStock','$proPic')";
      $ob->insert($insert);
      
    }
  }


  if (isset($_POST["editbtn"])) 
  {

     if(!empty($itemName) && !empty($CateName) && !empty($proId) && !empty($proName) && !empty($proPrice) && !empty($proDetails) && !empty($proStock) && !empty($proPic)) 
     {

        $edit="REPLACE INTO `product_info` (`item_name`,`cat_name`,`pro_id`,`pro_name`,`pro_price`,`pro_details`,`pro_stock`,`pro_pic`) VALUES ('$itemName','$CateName','$proId','$proName','$proPrice','$proDetails','$proStock','$proPic')";
         $ob->edit($edit); 
     }
}


if(isset($_GET["editid"]))
  {

      $sql="SELECT * FROM `product_info` WHERE `pro_id`='".$_GET["editid"]."'";
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
        $del="DELETE FROM `product_info` WHERE `pro_id`='".$_GET["delbtn"]."'";
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

      <script src='tinymce/tinymce.min.js'></script>
        <script type="text/javascript">
          tinymce.init({
          selector: '#myTextarea'
          });
        </script>

    <title>Product_information</title>
  </head>
  <body><br>
    <form name="" method="post">

    <table class="table table-bordered" style="max-width:100%;" align="center">

      <thead>
        <tr>
          <th colspan="2" style="background-color:#ccc;"><b><h2><center>PRODUCT INFORMATION</center></h2></b></th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <td><b>Item Name</b></td>
          <td>
            <select name="itemName" class="form-control">


                <?php
                  if (isset($_GET["editid"]))
                  {
                    print "<option>$fetchinfo[0]</option>";
                  }
                  ?>

              <option>One Select</option>

               <?php

                $sql="SELECT * FROM `category_information`";
                $q=$ob->selectQuery($sql);
                if($q)
                {
                  
                  while($fetch=$q->fetch_array())
                  {
                    print"<option>$fetch[0]</option>";
                  }
                }

              ?>
              
            </select>
          </td>
        </tr>

        <tr>
          <td><b>Category Name</b></td>
          <td>
            <select name="CatName" class="form-control">

               <?php
                  if (isset($_GET["editid"]))
                  {
                    print "<option>$fetchinfo[1]</option>";
                  }
                  ?>

              <option>One Select</option>

              <?php

                $sql="SELECT * FROM `category_information`";
                $q=$ob->selectQuery($sql);
                if($q)
                {
                  
                  while($fetch=$q->fetch_array())
                  {
                    print"<option>$fetch[2]</option>";
                  }
                }

              ?>
              
            </select>
          </td>
        </tr>

        <tr>
          <td><b>Product ID</b></td>
          <td><input type="number" name="ID" value="<?php echo $fetchinfo[2] ;?>" placeholder="Emter ID....." class="form-control"></td>
        </tr>

         <tr>
          <td><b>Product Name</b></td>
          <td><input type="text" name="ProName" value="<?php echo $fetchinfo[3] ;?>" placeholder="Emter Name....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Product Price</b></td>
          <td><input type="number" name="proPrice" value="<?php echo $fetchinfo[4] ;?>" placeholder="Emter Product Price....." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Product Details</b></td>
          <td><textarea class="form-control" name="Details" value="<?php echo $fetchinfo[5] ;?>" id="myTextarea"></textarea></td>
        </tr>

         <tr>
          <td><b>Product Stock</b></td>
          <td><input type="number" name="proStock" value="<?php echo $fetchinfo[6] ;?>" placeholder="Emter Product Stock....." class="form-control"></td>
        </tr>

         <tr>
          <td><b>Product Picture</b></td>
          <td><input type="file" name="Picture" value="<?php echo $fetchinfo[7] ;?>">
             <img src="" id="profile-img-tag" width="80" height="80" />  
          </td>
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
        <td align="center">cate Name</td>
        <td align="center">Pro ID</td>
        <td align="center">pro Name</td>
        <td align="center">pro Price</td>
        <td align="center">Pro Details</td>
        <td align="center">pro Stock</td>
        <td align="center">pro Pic</td>
        <td align="center">Edit</td>
        <td align="center">Delete</td>
      </tr>

      <?php
        $sql="SELECT * FROM `product_info`";
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
              <td align="center"><b><?php echo $fetchData[6]; ?></b></td>
              <td align="center"><b><?php echo $fetchData[7]; ?></b></td>
               <td align="center"><a href="product_information.php?editid=<?php echo $fetchData[2];?>" type="submit" name="" class="btn btn-primary">Edit</a></td>
              <td align="center"><a href="product_information.php?delbtn=<?php echo $fetchData[2];?>" type="submit" name="" class="btn btn-danger">Delete</a></td>
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