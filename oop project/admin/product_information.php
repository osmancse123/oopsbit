<?php
include("db.php");
$ob=new dbconnect();

$fetchinfo[0]="";
$fetchinfo[1]="";
$fetchinfo[2]="";
$fetchinfo[3]="";
$fetchinfo[4]="";
$fetchinfo[5]="";
$fetchinfo[6]="";

$itemname=isset($_POST["itemname"])?$_POST["itemname"]:"";
$Categoryname=isset($_POST["Categoryname"])?$_POST["Categoryname"]:"";
$id=isset($_POST["id"])?$_POST["id"]:"";
$productname=isset($_POST["productname"])?$_POST["productname"]:"";
$productprice=isset($_POST["productprice"])?$_POST["productprice"]:"";
$detail=isset($_POST["detail"])?$_POST["detail"]:"";
$stock=isset($_POST["stock"])?$_POST["stock"]:"";

if (isset($_POST["addbtn"])) 
  {
    if (!empty($itemname) && !empty($Categoryname) && !empty($id) && !empty($productname) && !empty($productprice) && !empty($detail) && !empty($stock)) 
      {     
        $path="img/product_information/$id.jpg";
        move_uploaded_file($_FILES["file"]["tmp_name"], $path);

        $insert="INSERT INTO `product_info` (`item_name`,`Category_name`,`id`,`product_name`,`product_price`,`detail`,`stock`) VALUES ('$itemname','$Categoryname','$id','$productname','$productprice','$detail','$stock')";
        $ob->insert($insert);
      }
  }


if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `product_info` WHERE `id`='".$_GET["editbtn"]."'";
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

    if (!empty($itemname) && !empty($Categoryname) && !empty($id) && !empty($productname) && !empty($productprice) && !empty($detail) && !empty($stock)) 
     {

        $edit="REPLACE INTO `product_info` (`item_name`,`Category_name`,`id`,`product_name`,`product_price`,`detail`,`stock`) VALUES ('$itemname','$Categoryname','$id','$productname','$productprice','$detail','$stock')";
         $ob->edit($edit); 
         print "<script>location='product_information.php'</script>";
     }
}


 if(isset($_GET["delbtn"]))
  {
        $del="DELETE FROM `product_info` WHERE id='".$_GET["delbtn"]."'";
        $ob->del($del);
        print "<script>location='product_information.php'</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>




<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>

      <script src='tinymce/tinymce.min.js'></script>
        <script type="text/javascript">
          tinymce.init({
          selector: '#myTextarea'
          });
        </script>

    <title>Product_information</title>

  </head>

  <script type="text/javascript">
    function  checkingCatName()
    {
        
        var item_name = $('#itemname').val();
       
  
        $.post("check_category_name.php", { item: item_name },  

      function(result){
        //if the result is 1
        if(result !=null )
        {
          //show that the username is available
          $('#catName').html(result);
        
        }
        else
        {
          
          $('#category_result').html('No Category Name Found');

          $('#catName').html("");
          
        }
    });

    }

  </script>

  <body>
    <form method="POST" enctype="multipart/form-data">
      
        <table class="table" style="max-width:85%;margin-top: 50px;" align="center">

          <thead>
            <tr>
              <th colspan="2" style="background-color:#2962FF; color: #fff;">
                <b><h2><center>PRODUCT INFORMATION</center></h2></b>
              </th>
            </tr>
          </thead>


          <tbody>

            <tr>
              <td>
                <b>Item Name</b>
              </td>

              <td>
                <select class="form-control" id="itemname"  name="itemname" value="<?php print $fetchinfo[0]; ?>" onchange="return checkingCatName()">
                 
                     <?php
                     $sql="SELECT * FROM `item_info`";
                     $q=$ob->selectQuery($sql);
                     if($q)
                     {
                        while($fetch=$q->fetch_array())
                        {

                            print "<option>$fetch[1]</option>";

                        }
                     }

                      ?>
                </select>
              </td>
            </tr>



            <tr>
              <td>
                <b>Category Name</b>
              </td>
              <td>
                <select class="form-control" name="Categoryname" value="<?php print $fetchinfo[1]; ?>" id="catName">
                
                </select><span id="category_result"></span>
              </td>
            </tr>



            <tr>
              <td>
                <b>Product ID</b>
              </td>
              <td><input type="number" name="id" value="<?php print $fetchinfo[2]; ?>" placeholder="Enter ID....." class="form-control">
              </td>
            </tr>


             <tr>
              <td>
                <b>Product Name</b>
              </td>
              <td>
                <input type="text" name="productname" value="<?php print $fetchinfo[3]; ?>" placeholder="Enter Name....." class="form-control">
              </td>
            </tr>


            <tr>
              <td>
                <b>Product Price</b>
              </td>
              <td><input type="number" name="productprice" value="<?php print $fetchinfo[4]; ?>" placeholder="Enter Product Price....." class="form-control"></td>
            </tr>


            <tr>
              <td><b>Product Details</b></td>
              <td><textarea class="form-control" id="myTextarea" name="detail"><?php print $fetchinfo[5]; ?></textarea></td>
            </tr>


             <tr>
              <td><b>Product Stock</b></td>
              <td><input type="number" name="stock" value="<?php print $fetchinfo[6]; ?>" placeholder="Enter Product Stock....." class="form-control"></td>
            </tr>


             <tr>
              <td><b>Product Picture</b></td>
              <td><input type="file" name="file" value="img/product_information/<?php print $fetchinfo[2]; ?>"></td>
            </tr>


            <tr>
              <td colspan="2" style="color:green;" align="center">
                <?php print $ob->sms;?>
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
            <td align="center"><b>Item Name</b></td>
            <td align="center"><b>Category Name</b></td>
            <td align="center"><b>Product ID</b></td>
            <td align="center"><b>Product Name</b></td>
            <td align="center"><b>Product Price</b></td>
            <td align="center"><b>Product Details</b></td>
            <td align="center"><b>Product Stock</b></td>
            <td align="center"><b>Product Image</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `product_info`";
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
                        <td align="center"><b><?php print $fetchData[5]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[6]; ?></b></td>
                        <td align="center"><img src="img/product_information/<?php print $fetchData[2]; ?>.jpg" height="70" weight="100"></td>
                        <td align="center"><a href="product_information.php?editbtn=<?php echo $fetchData[2] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="product_information.php?delbtn=<?php echo $fetchData[2] ?>" type="submit" class="btn btn-danger">Delete</a></td>
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



  </body>
</html>