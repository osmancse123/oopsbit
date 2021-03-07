<?php
include("db.php");
$ob=new dbconnect();


$fetchinfo[0]="";
$fetchinfo[1]="";
$fetchinfo[2]="";



$itemname=isset($_POST["itemname"])?$_POST["itemname"]:"";
$id=isset($_POST["id"])?$_POST["id"]:"";
$Categoryname=isset($_POST["Categoryname"])?$_POST["Categoryname"]:"";

if (isset($_POST["addbtn"]))
{

  if (!empty($itemname) && !empty($id) && !empty($Categoryname))
  {
    $path="img/category_information/$id.jpg";
    move_uploaded_file($_FILES["file"]["tmp_name"], $path);

  $insert="INSERT INTO `category_information` (`item_name`,`id`,`category_name`) VALUES ('$itemname','$id','$Categoryname')";
    $ob->insert($insert);
  }
}


if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `category_information` WHERE `id`='".$_GET["editbtn"]."'";
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

    if (!empty($itemname) && !empty($id) && !empty($Categoryname)) 
     {

        $edit="REPLACE INTO `category_information` (`item_name`,`id`,`category_name`) VALUES ('$itemname','$id','$Categoryname')";
         $ob->edit($edit); 
         print "<script>location='category_information.php'</script>";
     }
}


 if(isset($_GET["delbtn"]))
      {
        $del="DELETE FROM `category_information` WHERE id='".$_GET["delbtn"]."'";
        $ob->del($del);
        print "<script>location='category_information.php'</script>";
      }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Category_infromation</title>
  </head>
  <body>
    <form method="POST" enctype="multipart/form-data">
     <table class="table" style="max-width:80%;margin-top: 50px;" align="center">

          <thead>

            <tr>
              <th colspan="2" style="background-color:#2962FF; color: #fff;">
                <b><h2><center>CATEGORY INFORMATION</center></h2></b>
              </th>
            </tr>

          </thead>

          <tbody>

            <tr>
              <td><b>Item Name</b></td>
              <td>
                <select class="form-control" name="itemname" >

                  <?php
                  if (isset($_GET["editbtn"]))
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

                            print "<option>$fetch[1]</option>";

                        }
                     }

                      ?>
                </select>
              </td>
            </tr>

            <tr>
              <td><b>Category ID</b></td>
              <td><input type="number" name="id" value="<?php print $fetchinfo[1]; ?>" placeholder="Enter ID....." class="form-control"></td>
            </tr>

            <tr>
              <td><b>Category Name</b></td>
              <td><input type="text" name="Categoryname" value="<?php print $fetchinfo[2]; ?>" placeholder="Enter Name....." class="form-control"></td>
            </tr>
            <tr>
              <td>
                <b>image</b>
              </td>
              <td>
                <input type="file" name="file">
              </td>
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
                <button type="submit" name="addbtn" class="btn btn-success">Add</button>
                <button type="submit" name="edtbtn" class="btn btn-primary">Edit</button>
                <button type="submit" name="viewbtn" class="btn btn-info">View</button>
                <button type="submit" class="btn btn-secondary">Cancel</button>
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
            <td align="center"><b>Category ID</b></td>
            <td align="center"><b>Category Name</b></td>
            <td align="center"><b>Category Image</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `category_information`";
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
                        <td align="center"><img src="img/category_information/<?php print $fetchData[1]; ?>.jpg" height="70" weight="100"></td>
                        <td align="center"><a href="category_information.php?editbtn=<?php echo $fetchData[1] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="category_information.php?delbtn=<?php echo $fetchData[1] ?>" type="submit" class="btn btn-danger">Delete</a></td>

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