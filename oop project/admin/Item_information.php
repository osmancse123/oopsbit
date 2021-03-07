<?php
  include("db.php");
  $ob=new dbconnect();
   

$fetchinfo[0]="";
$fetchinfo[1]="";

  $id=isset($_POST["id"])?$_POST["id"]:"";
  $itemname=isset($_POST["name"])?$_POST["name"]:"";

  

  if (isset($_POST["addbtn"])) 
  {
    if (!empty($id) && !empty($itemname)) 
      {
        $path="img/Item_picture/$id.jpg";
        move_uploaded_file($_FILES["file"]["tmp_name"], $path);

         $insert="INSERT INTO `item_info` (`id`,`name`) VALUES ('$id','$itemname')";
         $ob->insert($insert);
      }
  }


  
 if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `item_info` WHERE `id`='".$_GET["editbtn"]."'";
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

    if (!empty($id) && !empty($itemname)) 
     {

        $edit="REPLACE INTO `item_info` (id,name) VALUES ('$id','$itemname')";
         $ob->edit($edit); 
         print "<script>location='Item_information.php'</script>";
     }
}


 if(isset($_GET["delbtn"]))
      {
        $del="DELETE FROM `item_info` WHERE id='".$_GET["delbtn"]."'";
        $ob->del($del);
        print "<script>location='Item_information.php'</script>";
      }


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Item info</title>
  </head>
  <body>

    <form method="POST" enctype="multipart/form-data">

      <table class="table" style="max-width:80%;margin-top: 50px;" align="center">

      <thead>

        <tr>
          <th colspan="2" style="background-color:#2962FF; color: #fff;"><b><h2><center>ITEM INFORMATIONS</center></h2></b></th>
        </tr>

      </thead>

      <tbody>

        <tr>
          <td><b>Item ID</b></td>
          <td><input type="number" name="id" value="<?php print $fetchinfo[0]; ?>" placeholder="Enter Item ID...." class="form-control"></td>
        </tr>

        <tr>
          <td><b>Item Name</b></td>
          <td><input type="text" name="name" value="<?php print $fetchinfo[1]; ?>" placeholder="Enter Item Name...." class="form-control"></td>
        </tr>
        <tr>
          <td><b>Image</b></td>
          <td><input type="file" name="file" id="profile-img" value="" >
            <img src="img/Item_picture/<?php print $fetchinfo[0]; ?>.jpg" id="profile-img-tag" width="80px" height="80" style="margin-left: 40px;"/>
          </td>
        </tr>

        <tr>
          <td style="color: green;" colspan="2" align="center">
            <?php print $ob->sms;?>
          </td>
        </tr>



      </tbody>

      <tfoot>

        <tr>

          <td colspan="2" align="center">

            <button type="submit" name="addbtn" style="background-color:#00879B;color: #ffff" class="btn">Add</button>
             <button type="submit" name="edtbtn" style="background-color:#00879B;color: #ffff" class="btn">edit</button>
              <button type="submit" name="viewbtn" style="background-color:#00879B;color: #ffff" class="btn">view</button>
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
            <td align="center"><b>Item ID</b></td>
            <td align="center"><b>Item Name</b></td>
            <td align="center"><b>Item Image</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `item_info`";
            $r=$ob->selectQuery($sql);
            if($r)           
            {
                while($fetchData=$r->fetch_array())
                {
                  ?>
                  <tr>
                        <td align="center"><b><?php print $fetchData[0]; ?> </b></td>
                        <td align="center"><b><?php print $fetchData[1]; ?></b></td>
                        <td align="center"><img src="img/Item_picture/<?php print $fetchData[0]; ?>.jpg" height="70" weight="100"></td>
                        <td align="center"><a href="Item_information.php?editbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="Item_information.php?delbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-danger">Delete</a></td>
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
    <!--img show link-->
    
 <script type="text/javascript">
                  function readURL(input) {
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          
                          reader.onload = function (e) {
                              $('#profile-img-tag').attr('src', e.target.result);
                          }
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
                  $("#profile-img").change(function(){
                      readURL(this);
                  });
              </script>
      <!--img show link end-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  </body>
</html>