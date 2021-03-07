<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>view</title>
  </head>
  <body>
 


<?php
include("../db_connect/conect.php");
$db = new database();


                    

if(isset($_GET["dltId"]))
{
    $sql="DELETE FROM `certificate` WHERE `roll`='".$_GET['dltId']."'";
    $query=$db->link->query($sql);
    if($query)
    {
      echo"Delete Successed";
    }
}

          
              $table="<table class=' table table-hover table-bordered ' style='max-width:800px; background-color:#fff;' align='center'>";
              $sql="SELECT * FROM `certificate`";
             $query=$db->link->query($sql);

              $table.="<tr class=' table table-bordered' style='background-color:#ccc;' align='center'> 
                        <td><b>Name</b></td>
                        <td><b>Father Name</b></td>
                        <td><b>Mother Name</b></td>
                        <td><b>village</b></td>
                        <td><b>Post Office </b></td>
                       
                        <td><b>Upa Zilla </b></td>
                        <td><b>Zilla </b></td>
                        <td><b>Class</b></td>
                       <td><b>Roll</b></td>
                      <td><b>Date of Birth</b></td>
                      <td><b>Edit</b></td>
                      <td><b>Delete</b></td>

                    </tr>";
              while($fetch=$query->fetch_array())
              {
                $table.="<tr> 
                    <td>$fetch[0]</td>
                    <td>$fetch[1]</td>
                    <td>$fetch[2]</td>
                    <td>$fetch[3]</td>
                    <td>$fetch[4]</td>
                    <td>$fetch[5]</td>
                    <td>$fetch[6]</td>
                     <td>$fetch[7]</td>
                    <td>$fetch[8]</td>
                      <td>$fetch[9]</td>
                    
                    
                    <td><a href='InputTable.php?edtId=$fetch[8]' class='btn btn-outline-primary btn-sm'>EDIT </a></td>
                    <td><a href='view.php?dltId=$fetch[8]' class='btn btn-outline-danger btn-sm' onClick='return Confirm_Click_Delete()'>DELETE </a></td>
                    </tr>";
              }  
              $table.="</table>";
            echo $table;  
         
          
        ?>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>