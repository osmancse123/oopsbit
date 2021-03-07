<?php
  include("db.php");
  $ob=new dbconnect();
   


  $detail=isset($_POST["detail"])?$_POST["detail"]:"";

  if (isset($_POST["addbtn"])) 
  {
    if (!empty($detail)) 
      {
            $insert="INSERT INTO `terms_condition` (`id`,`details`) VALUES ('1','$detail')";
            $ob->insert($insert);
      }
  }

      $sql="SELECT * FROM `terms_condition` WHERE `id`='1'";
      
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


?>
<!DOCTYPE html>
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

    <title>Trems_&_comdition</title>
  </head>
  <body>
    <form method="POST">
    <table class="table" style="width:80%;margin-top: 50px;" align="center">

      <thead>
        <tr>
          <th style="background-color:#2962FF; color: #fff;"><h2><center>TERMS & CONDITION</center></h2></th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>
            <label><b><h4>Details</h4><b></label>
            <textarea class="form-control" id="myTextarea" name="detail" rows="10" cols="20">
              <?php print $fetchinfo[1];?>
            </textarea>
          </td>
        </tr>
        <tr>
          <td>
          <?php print $ob->sms; ?>
        </td>
      </tr>
      </tbody>

      <tfoot>
        <tr>
          <td align="center">
            <button type="submit" name="addbtn" class="btn btn-success">Save</button>
            <button type="submit" class="btn btn-secondary">Cancel</button>
          </td>
        </tr>
      </tfoot>

    </table>
    
</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>