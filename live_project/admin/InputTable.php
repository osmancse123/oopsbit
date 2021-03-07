<?php
include("../db_connect/conect.php");
$db = new database();


$fetchData[0]="";
$fetchData[1]="";
$fetchData[2]="";
$fetchData[3]="";
$fetchData[4]="";
$fetchData[5]="";
$fetchData[6]="";
$fetchData[7]="";
$fetchData[8]="";
$fetchData[9]="";


$varName=mysqli_real_escape_string($db->link,isset($_POST["stdName"])?$_POST["stdName"]:"");
$varFatherName=mysqli_real_escape_string($db->link,isset($_POST["father"])?$_POST["father"]:"");
$varMotherName=mysqli_real_escape_string($db->link,isset($_POST["mother"])?$_POST["mother"]:"");
$varVill=mysqli_real_escape_string($db->link,isset($_POST["vill"])?$_POST["vill"]:"");

$varPo=mysqli_real_escape_string($db->link,isset($_POST["po"])?$_POST["po"]:"");
$varUpaZilla=mysqli_real_escape_string($db->link,isset($_POST["upaZila"])?$_POST["upaZila"]:"");
$varZilla=mysqli_real_escape_string($db->link,isset($_POST["zilla"])?$_POST["zilla"]:"");

$varZilla=mysqli_real_escape_string($db->link,isset($_POST["zilla"])?$_POST["zilla"]:"");
$varClass=mysqli_real_escape_string($db->link,isset($_POST["class"])?$_POST["class"]:"");
$varRoll=mysqli_real_escape_string($db->link,isset($_POST["roll"])?$_POST["roll"]:"");
$varBirth=mysqli_real_escape_string($db->link,isset($_POST["birth"])?$_POST["birth"]:"");

if(isset($_REQUEST["addBtn"]))
{
  if(!empty($varName) and !empty($varRoll))
  {
    $sql="insert into certificate (`student_name`,`father`,`mother`,`village`,`po`,`upa_zilla`,`zilla`,`class`,`roll`,`birthday`) values('$varName','$varFatherName','$varMotherName','$varVill','$varPo','$varUpaZilla','$varZilla','$varClass','$varRoll','$varBirth')";
    $db->insert_query($sql);
    //echo $mod->sms;
    $message="Data Insert Successfully";
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}

if(isset($_REQUEST["editBtn"]))
{
  if(!empty($varName) and !empty($varRoll))
  {
    $sql="replace into certificate (`student_name`,`father`,`mother`,`village`,`po`,`upa_zilla`,`zilla`,`class`,`roll`,`birthday`) values('$varName','$varFatherName','$varMotherName','$varVill','$varPo','$varUpaZilla','$varZilla','$varClass','$varRoll','$varBirth')";
    $db->insert_query($sql);
    //echo $mod->sms;
    $message="Data Update";
  }
  else
  {
    $nulMessage="<span style='color:red; font-size:15px;'>Sorry !! Fields is Empty</span>";
  }
}


if(isset($_GET["edtId"]))
{
    $sql="SELECT * FROM `certificate` WHERE `roll`='".$_GET['edtId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      $fetchData=$query->fetch_array();

    }
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

    <title>Cirtificate</title>
  </head>
  <body>
  <form name="" method="post">
    <div class="container" style="max-width: 50%; background-color: #f4f4f4;">
      <h1>Certificate</h1><hr>
        <div>
           <label>Student Name</label>
            <input type="text" name="stdName" value="<?php echo $fetchData[0]?>" autocomplete="off" class="form-control">
        </div>
         <div>
           <label>Father Name</label>
            <input type="text" name="father" value="<?php echo $fetchData[1]?>" autocomplete="off" class="form-control">
        </div>
         <div>
           <label>Mother Name</label>
            <input type="text" name="mother" value="<?php echo $fetchData[2]?>" autocomplete="off" class="form-control">
        </div>
        <div>
          <label>
             <label>গ্রামঃ</label>
              <input type="text" name="vill" value="<?php echo $fetchData[3]?>" class="form-control">
          </label>
            <label>
             <label>ডাকঘরঃ</label>
              <input type="text" name="po" value="<?php echo $fetchData[4]?>" class="form-control">
          </label>
         
        </div>
        <div>
            <label>
             <label>উপজেলাঃ</label>
              <input type="text" name="upaZila" value="<?php echo $fetchData[5]?>" class="form-control" style="max-width: 100%">
          </label>
           <label>
           <label>জেলাঃ</label>
              <input type="text" name="zilla" value="<?php echo $fetchData[6]?>" class="form-control"  style="max-width: 100%">
          </label>
        </div>
        <div>
           <label>Class Name</label>
            <input type="text" name="class" value="<?php echo $fetchData[7]?>" class="form-control">
        </div>
        <div>
           <label>Roll NO </label>
            <input type="text" name="roll" value="<?php echo $fetchData[8]?>" autocomplete="off" class="form-control">
        </div>

        <div>
           <label>Date of Birth</label>
            <input type="date" name="birth" value="<?php echo $fetchData[9]?>" autocomplete="off" class="form-control">
        </div>
        <br>

        <div align="center">
        <button type="submit" class="btn btn-success" name="addBtn">Add</button>
        <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
        <a href="view.php" type="submit" class="btn btn-danger" name="viewBtn" target="_blank">View</a>

        </div>

           
  </div>
  </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>