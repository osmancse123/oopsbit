<?php
include("db.php");
$ob=new dbconnect();
  

  $Name=isset($_POST["name"])?$_POST["name"]:"";
  $Email=isset($_POST["email"])?$_POST["email"]:"";
  $Password=isset($_POST["password"])?$_POST["password"]:"";
  $ConfirmPassword=isset($_POST["Confirm_password"])?$_POST["Confirm_password"]:"";
  $AdminType=isset($_POST["Admin_type"])?$_POST["Admin_type"]:"";


  if(isset($_POST["subBtn"]))
  {
    if(!empty($Name) && !empty($Email) && !empty($Password) && !empty($ConfirmPassword) && !empty($AdminType))
    {
      $insert="INSERT INTO `creat_admin` (`Name`,`email`,`password`,`confirm_password`,`admin_type`) VALUES ('$Name','$Email','$Password','$ConfirmPassword','$AdminType')";
      $ob->insert($insert);
    }
    
  }


  if (isset($_POST["editbtn"])) 
  {

     if(!empty($Name) && !empty($Email) && !empty($Password) && !empty($ConfirmPassword) && !empty($AdminType))
     {

        $edit="REPLACE INTO `creat_admin` (`Name`,`email`,`password`,`confirm_password`,`admin_type`) VALUES ('$Name','$Email','$Password','$ConfirmPassword','$AdminType')";
         $ob->edit($edit); 
     }
  }

if(isset($_GET["editid"]))
  {

      $sql="SELECT * FROM `creat_admin` WHERE `email`='".$_GET["editid"]."'";
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
        $del="DELETE FROM `creat_admin` WHERE `email`='".$_GET["delbtn"]."'";
        $ob->del($del);
        
      }
 

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>sign up</title>
      

      <script type="text/javascript">
          var check = function() {
            if (document.getElementById('password').value ==
              document.getElementById('confirm_password').value) {
              document.getElementById('message').style.color = 'blue';
              document.getElementById('message').innerHTML = 'matching';
            } else {
              document.getElementById('message').style.color = 'red';
              document.getElementById('message').innerHTML = 'not matching';
            }
          }
      </script>
  </head>
  <body>
    <form name="" method="post">

    <table class="table table-borderless" style="max-width: 80%; margin-top: 50px; background-color: #fff;" align="center">
      
      <thead class="bg-light" style="border-bottom: 1px solid #ccc;">
        <tr>
          <th scope="col"><h4>Sign Up</h4></th>
        </tr>

        <tbody>
          <tr>
            <td>
              <span>Name</span>
              <input type="text" name="name" value="<?php echo $fetchinfo[0]; ?>" class="form-control">
            </td>
          </tr>

          <tr>
            <td>
              <span>Email</span>
              <input type="Email" name="email" value="<?php echo $fetchinfo[1]; ?>" class="form-control">
            </td>
          </tr>

           <td>
              <span>Password</span>
              <input type="Password" name="password" value="<?php echo $fetchinfo[2]; ?>" id="password" onkeyup='check();' class="form-control">
            </td>
          </tr>

           <td>
              <span>Confirm Password</span>
              <input type="Password" name="Confirm_password" value="<?php echo $fetcharry[3]; ?>" id="confirm_password"  onkeyup='check();'  class="form-control">
              <span id='message'></span>
            </td>
          </tr>

          <tr>
            <td>
              <span>Admin Type</span><br>
              <select type="text" class="form-control" name="Admin_type" style="max-width: 70%">
                <option>Select one</option>
                <option>Main Admin</option>
                <option>Sub Admin</option>
              </select>
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
            <td colspan="2" align="right">
              <button type="Submit" name="editbtn" class="btn btn-primary">&nbsp;Edit&nbsp;</button>
              <button type="Submit" name="viewBtn" class="btn btn-info">&nbsp;View&nbsp;</button>
              <button type="Submit" name="subBtn" class="btn btn-success">&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;</button>
            </td>
          </tr>
        </tfoot>
      </thead>
    </table>



    <?php

        if(isset($_POST["viewBtn"]))
        {
          ?>
     <table class="table table-bordered">
      <tr>
        <td align="center">Name</td>
        <td align="center">email</td>
        <td align="center">password</td>
        <td align="center">con_pass</td>
        <td align="center">Admin Type</td>
        <td align="center">Edit</td>
        <td align="center">Delete</td>
      </tr>

      <?php
        $sql="SELECT * FROM `creat_admin`";
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
               <td align="center"><a href="creat_admim.php?editid=<?php echo $fetchData[1];?>" type="submit" name="" class="btn btn-primary">Edit</a></td>
              <td align="center"><a href="creat_admim.php?delbtn=<?php echo $fetchData[1];?>" type="submit" name="" class="btn btn-danger">Delete</a></td>
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