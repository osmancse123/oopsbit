<?php
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{ 
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
  	global $msg;
    global $result_std_details;
    global $result_Teacher;
    global $checked_searc;
    //$makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
  
  if(isset($_POST["searchbutton"]))
    {
	$searTeracher="SELECT * FROM `stuff_information` WHERE `stuff_id`='".$_POST['id']."'";
      $checked_searc=$db->select_query($searTeracher);
    
      if($checked_searc)
      {
        $fetch_techer=$checked_searc->fetch_array();
        $teacherInfo="SELECT `stuff_information`.`stuff_name`,`stuff_information`.`mobile_no`,`stuff_information`.`designation` FROM  `stuff_information` 
   		WHERE `stuff_information`.`stuff_id`='".$fetch_techer['stuff_id']."'"; 
      $result_Teacher=$db->select_query($teacherInfo);
        if($result_Teacher)
        {
            $fetch_teacher=$result_Teacher->fetch_array();
        }
      }
    }   
  $makeid=$db->autogenerat('stuff_payment','id','REC-','9');
  $makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
    if(isset($_POST["save"]))
    {
      @$tchid=$_POST['id'];
     if(!empty($_POST['id']) && !empty($_POST['paidAmount']))
		{
         $insert_fee="INSERT INTO `stuff_payment` (`id`,`stuff_id`,`year`,`date`,`month`,`pay_amount`,`user_id`) VALUES('$makeid','".$_POST['id']."','".date('Y')."','".date('d/m/Y')."','".date('M')."','".$_POST['paidAmount']."','1')";
        $check_insert=$db->insert_query($insert_fee);
       $insert_cost="INSERT INTO `other_cost` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES('$makeidCost','".date('d/m/Y')."','Stuff Payment','$makeid-".$_POST['stuff_name']."','".$_POST['paidAmount']."','1')";
        $check_insertAA=$db->insert_query($insert_cost);
       echo "<script>location='stuffRecipt.php?techid=$tchid&id=$makeid'</script>";
       $makeid=$db->autogenerat('stuff_payment','id','REC-','9');
       $makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
       }
       else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
    }
    // //link dlt data.....................................
    // if(isset($_GET['dlt']))
    // {
    //   $linid=$db->escape($_GET['dlt']);
    //   $query="DELETE FROM `add_discount` WHERE `discount_id`='$linid'";
    //   $delete=$db->delete_query($query);
    //  $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
    //   print "<script>location='Adddiscount.php'</script";
  
    // }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
      
    </script>
  </head>
  <body>
      <div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1">
        
        <table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
    <form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">
        
          <tr>
            <td bgcolor="#f4f4f4" class="warning" colspan="6" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Stuff Payment</span> </td>
          </tr>
          <tr>
            <td colspan="5" align="right"><input type="text" class="form-control tcherId" id="stdid" placeholder="ID" name="id" <?php if($checked_searc){ ?>value="<?php echo $fetch_techer['stuff_id']; ?>"<?php }?>></input></td>
            <td><button type="submit" name="searchbutton" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></td>
          </tr>
          <tr>
            <td align="right"><strong><span class="text-justify text-success text-right">Name &nbsp;</span></strong>  </td>
            <td>
              <div class="col-md-12">
                <input type="text" name="stuff_name" class="form-control"<?php if($result_Teacher)
        { 
        	?>value="<?php echo $fetch_teacher['stuff_name']; ?>"<?php
        }
        ?>>
              </div>
            </td>
            <td align="right"><strong><span class="text-justify text-success text-right">Designation &nbsp;</span></strong>  </td>
            <td>
              <div class="col-md-12">
                          <input type="text" class="form-control"<?php if($result_Teacher)
        { 
        	?>value="<?php echo $fetch_teacher['designation']; ?>"<?php
        }
        ?>>
              </div>
            </td>
            <td align="right"><strong><span class="text-justify text-success text-right">Phone &nbsp;</span></strong>  </td>
            <td>
              <div class="col-md-12">
                         <input type="text" class="form-control"<?php if($result_Teacher)
        { 
        	?>value="<?php echo $fetch_teacher['mobile_no']; ?>"<?php
        }
        ?>>
              </div>
            </td>
          </tr>
        
           <tr>
           	<td class="" colspan="5"  align="right"><span>
            		Payment Amount:
              </span> </td>
            <td class="" colspan=""  align="center">
                <input type="text" class="form-control" name="paidAmount" placeholder="00.00" value=""></input>

            </td>
          </tr>
          <tr>

            <td class="danger" colspan="5" bgcolor="#dddddd" align="center"><span>
            	<?php 
  						if(isset($msg))
  						{
  							echo "<strong>".$msg."</strong>";
  						}
  						else 
  						{
  							 echo "<strong>".$db->sms."<strong>";
  						}



  					?>

              </span> 
            </td>
            <td class="danger" colspan=""  align="right"><span>

            		<button type="submit" class="btn btn-success" name="save">Payment</button>
            		    </form>
                    		<?php if($result_Teacher)
        { ?>
            		<button  class="btn btn-info view">View</button>
            		<?php
        }
        ?>
              </span> </td>

          </tr>
        </table>
        <div class="col-md-12 datatable">
        	
        </div>
      </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
$(document).ready(function(){
$('.view').on('click', function() {
	var tchId=$('.tcherId').val();

         $('.datatable').load('loadStuff_payment_history.php?tchrId='+tchId);
	 });

 });
    </script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
