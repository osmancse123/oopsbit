<?php 
include("db.php");
$ob=new dbconnect();

$s="";
$fetchinfo[0]="";
$fetchinfo[1]="";
$fetchinfo[2]="";



$Email=isset($_POST["Email"])?$_POST["Email"]:"";
$Password=isset($_POST["Password"])?$_POST["Password"]:"";
$cpassword=isset($_POST["cpassword"])?$_POST["cpassword"]:"";
$type=isset($_POST["type"])?$_POST["type"]:"";

if (isset($_POST["addbtn"])) 
  {
    if($Password==$cpassword)
    {


    if (!empty($Email) && !empty($Password) && !empty($type)) 
      {
            $insert="INSERT INTO `creat_admin` (`email`,`password`,`confirm_password`,`admin_type`) VALUES ('$Email','$Password','$cpassword','$type')";

            $ob->insert($insert);
      }

    }
    else
    {
      $s="<b style='color:red'>Check Password</b>";
    }
  }

  


   if(isset($_GET["editbtn"]))
  {

      $sql="SELECT * FROM `creat_admin` WHERE `email`='".$_GET["editbtn"]."'";
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

    if (!empty($Email) && !empty($Password) && !empty($type)) 
     {

        $edit="REPLACE INTO `creat_admin` (`email`,`password`,`confirm_password`,`admin_type`) VALUES ('$Email','$Password','$cpassword','$type')";
         $ob->edit($edit); 
         print "<script>location='creat_admin.php'</script>";
     }
}


 if(isset($_GET["delbtn"]))
      {
        $del="DELETE FROM `creat_admin` WHERE email='".$_GET["delbtn"]."'";
        $ob->del($del);
        print "<script>location='creat_admin.php'</script>";
      }

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    

    <title>Creat_Admin</title>

     
      <script type="text/javascript">
      var check = function() {
          if (document.getElementById('myInput').value ==
            document.getElementById('confirm_password').value)
             {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Matching';
          } 
          else 
          {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not matching';
          }
        }
    </script>

  

     <script type="text/javascript">
      
      function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>

     <script type="text/javascript">
      
      function Function() {
      var x = document.getElementById("confirm_password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>



  </head>
  <body>

    <form method="POST" name="frmName">

    <table class="table" style="max-width:80%;margin-top: 50px;" align="center"> 
      <thead>
        <tr>
          <th style="background-color:#2962FF; color: #fff;"><b><h2><center>CREAT ADMIN</center></h2></b></th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <td>
            <label><b>Email</b></label>
            <input type="enail" name="Email" value="<?php print $fetchinfo[0]; ?>" placeholder="Enter Email..." class="form-control">
          </td>
        </tr>

        <tr>
          <td>
            <label><b>Password</b></label>
            <input type="Password" name="Password" value="<?php print $fetchinfo[1]; ?>" placeholder="Enter Password..." class="form-control" id="myInput"onkeyup='check();'> 
              <input type="checkbox" onclick="myFunction()">
              <i style="color:#000;">Show Password</i>
          </td>
        </tr>

         <tr>
          <td>
            <label><b>Confirm Password</b></label>
            <input type="Password" name="cpassword" value="<?php print $fetchinfo[2]; ?>" placeholder="Enter Confirm Password..." class="form-control" id="confirm_password"  onkeyup='check();'>
            <input type="checkbox" onclick="Function()">
            <i style="color:#000;">Show Password</i>
            <span id='message'></span>
        </tr>

        <tr>
          <td>
            <label><b>Admin Type</b></label>
            <select class="form-control" name="type">
                  <option>One Select</option>
                  <option>Main admin</option>
                  <option>User admin</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="color:green;">
            <?php print $ob->sms ;?>
            <?php print $s;?>
          </td>
        </tr>

      </tbody>

      <tfoot>
        <tr>
          <td align="center">
            <button type="Submit" name="addbtn" class="btn btn-success">Submit</button>
            <button type="Submit" name="edtbtn" class="btn" style="background-color:#00879B;color: #ffff;">Edit</button>
            <button type="Submit" name="viewbtn" class="btn" style="background-color:#00879B;color: #ffff">View</button>
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
            <td align="center"><b>Email</b></td>
            <td align="center"><b>Password</b></td>
            <td align="center"><b>Admin type</b></td>
            <td align="center">Edit</td>
            <td align="center">Delete</td>
          </tr>

          <?php
            $sql="select * from `creat_admin`";
            $r=$ob->selectQuery($sql);
            if($r)           
            {
                while($fetchData=$r->fetch_array())
                {
                  ?>
                  <tr>
                        <td align="center"><b><?php print $fetchData[0]; ?> </b></td>
                        <td align="center"><b><?php print $fetchData[1]; ?></b></td>
                        <td align="center"><b><?php print $fetchData[3]; ?></b></td>
                        <td align="center"><a href="creat_admin.php?editbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-primary">Edit</a></td>
                        <td align="center"><a href="creat_admin.php?delbtn=<?php echo $fetchData[0] ?>" type="submit" class="btn btn-danger">Delete</a></td>
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