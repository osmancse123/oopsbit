
  <?php
  error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
  
  global $result_std_details;
  global $checked_std_info;
  global $checked_searc;
  $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');

if(isset($_POST["searchbutton"]))
  {
    $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
    @$EXPLOID=explode("and", $class);
    
    $searstudent="SELECT * FROM `student_account_info` WHERE `id`='".$_POST['id']."' AND `class_id`='".$EXPLOID[0]."'";
    $checked_searc=$db->select_query($searstudent);
    
    if($checked_searc)
    {
      $fetch_student=$checked_searc->fetch_array();
      $studeinfo="SELECT `student_personal_info`.`student_name`,`running_student_info`.`class_roll`,`running_student_info`.`group_id`,`running_student_info`.`section_id`,`add_section`.`section_name`,`add_group`.`group_name`,`add_class`.`class_name`,`add_class`.`id` FROM  `student_account_info` 
     INNER JOIN  `student_personal_info` ON `student_account_info`.`id`=`student_personal_info`.`id` 
     INNER JOIN `running_student_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
     INNER JOIN `add_section` ON `running_student_info`.`section_id`=`add_section`.`id`
    INNER JOIN `add_group` ON `running_student_info`.`group_id`=`add_group`.`id`
    INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
     WHERE `student_account_info`.`id`='".$fetch_student[0]."' GROUP BY `student_account_info`.`id`"; 
    $result_std_details=$db->select_query($studeinfo);
      if($result_std_details)
      {
          $fetch_std_info=$result_std_details->fetch_array();

      }
    }
  }   

  if(isset($_POST["add1"]))
  {
      
      $stdid=$db->escape($_POST["stdid"]);
      $class_id=$db->escape($_POST["clsid"]);
      $year=$db->escape($_POST["year2"]);
      $roll=$db->escape($_POST["roll"]);
      $fee_id=$db->escape($_POST["feeid"]);
      $discount_amount=$db->escape($_POST["discount"]);
      $amoun=$db->escape($_POST["feetext"]);
      if($discount_amount<=$amoun){
      $insert_fee="INSERT INTO `add_discount` (`discount_id`,`student_id`,`class_id`,`year`,`roll`,`feeid`,`discount`,`admin_id`,`date`,`section_id`,`group_id`) VALUES('$makeid','$stdid','$class_id','$year','$roll','$fee_id','$discount_amount','1','".$_POST['date']."','".$_POST['sectionId']."','".$_POST['groupId']."')";
      $check_insert=$db->insert_query($insert_fee);
        $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
     }
  }
  //link dlt data.....................................
  if(isset($_GET['dlt']))
  {
    $linid=$db->escape($_GET['dlt']);
    $query="DELETE FROM `add_discount` WHERE `discount_id`='$linid'";
    $delete=$db->delete_query($query);
   $makeid=$db->autogenerat('add_discount','discount_id','DIS-','9');
    print "<script>location='Adddiscount.php'</script";

  }
  if (isset($_POST['add2'])) {
   echo"<script>location='student_class_wise_discount.php?stdid=".$_POST["stdid"]."'</script>";
  }
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
        $(document).ready(function()
  {
    var checking_html = '<img src="search_group/loading.gif" /> Checking...';
    $('#feetitle').change(function()
    {
      $('#item_result').html(checking_html);
        check_availability();
    }); 
  });

//function to check username availability 
function check_availability()
{
    var fee_id = $('#feetitle').val();
    var studentid=$('#stdid').val();
    
    $.post("chek_fee_amount.php", { FEE_id: fee_id,std_di:studentid },
      function(result){
        //if the result is 1
        if(result !=0 )
        {
          //show that the username is available
          $('#feetext').val(result);
          
          $('#item_result').html("");
         
        }
        else
        {
         

          $('#item_result').html("");
          $('#feetext').val('');
        }
    });

}  

    </script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="6" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Discount</span> </td>
  			</tr>
  			<tr>
  				<td colspan="2"><input type="text" class="form-control" id="stdid" placeholder="ID" name="id"<?php 
          if($checked_searc){
            ?>
            value="<?php echo $fetch_student[0]; ?>"
          <?php }
          ?>></input></td>
  				<td><input type="text" value="<?php echo date('Y')?>" class="form-control"  name="year"></input></td>
  				<td colspan="2">
  					<select name="className" id="className" class="form-control">
					         <option <?php if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info['id']; ?>"
          <?php }
          ?>><?php 
          if($result_std_details){
            ?>
           <?php echo $fetch_std_info['class_name']; ?>
          <?php }
          ?></option>
          
								<option  disabled<?php if(!isset($result_std_details)){?> selected <?php }?>>Select One</option>
							<?php 
								$select_section = "SELECT * FROM `add_class`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[0]"?>"><?php echo $fetchsection[2];?></option>
							<?php }  } ?>
				  </select>
  				</td>
  				<td><button type="submit" name="searchbutton" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></td>
  			</tr>

        <tr>
          <td align="right"><strong><span class="text-justify text-success text-right">Name &nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
            <input type="text" class="form-control" name="name" placeholder="Name"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info[0]; ?>"
          <?php }
          ?> ></input>
          </div>
          </td>
          
          <td align="right"><strong><span class="text-justify text-success text-right">Class Roll &nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
            <input type="hidden" name="clsid" <?php 
               if($checked_searc){
            ?>
            value="<?php echo $fetch_student[1]; ?>"
          <?php }
          ?> ></input>
          <input type="hidden" name="stdid" <?php 
               if($checked_searc){
            ?>
            value="<?php echo $fetch_student[0]; ?>"
          <?php }
          ?> ></input>
            <input type="text" class="form-control" name="roll" placeholder="roll"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info[1]; ?>"
          <?php }
          ?>></input>
        </div>
          </td>
             <td align="right"><strong><span class="text-justify text-success text-right">Year &nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
            <input type="text" class="form-control" name="year2" placeholder="Year" value="<?php echo date("Y");?>"></input>
        </div>
          </td>
        </tr>
        <tr>
          <td align="right"><strong><span class="text-justify text-success text-right">Section &nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
            <input type="text" class="form-control" name="" placeholder=""<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info['section_name']; ?>"
          <?php }
          ?> ></input>
           <input type="hidden" class="form-control" name="sectionId" placeholder=""<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info['section_id']; ?>"
          <?php }
          ?> ></input>
          </div>
          </td>
          
          <td align="right"><strong><span class="text-justify text-success text-right">Group&nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
        <input type="text" class="form-control" name="" placeholder=""<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info['group_name']; ?>"
          <?php }
          ?> ></input>
            <input type="hidden" class="form-control" name="groupId" placeholder=""<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_std_info['group_id']; ?>"
          <?php }
          ?> ></input>
        </div>
          </td>
             <td align="right"><strong><span class="text-justify text-success text-right">Date &nbsp;</span></strong>  </td>
             <td>
          <div class="col-md-12">
            <input type="text" class="form-control" name="date" placeholder="" value="<?php echo date("d/m/Y");?>">
            </input>
        </div>
            </td>
        </tr>
        <?php 
            if($result_std_details)
            {
              ?>
             <tr>
                <td colspan="3" align="left"><strong><span class="text-justify text-info" style="padding-left: 15px;">Fee Title</span></strong></td>

                <td colspan="1" align="left"><strong><span class="text-justify text-info">Fee Amount</span></strong></td>
                <td colspan="1" align="left"><strong><span class="text-justify text-info">Fee Discount</span></strong></td>
                <td align="center"><strong><span class="text-justify text-info">ADD</span></strong></td>
      </tr>
              <tr>
                <td colspan="3">
                <div class="col-md-8">
                    <select class="form-control" id="feetitle" name="feeid">
                      <option disabled>Select One</option>
                      <option></option>
                      <?php 
                        $select_fee="SELECT `student_account_info`.`id`,`fee_id`,`add_fee`.`title` FROM `student_account_info` INNER JOIN `add_fee` 
ON `student_account_info`.`fee_id`=`add_fee`.`id` WHERE `student_account_info`.`id`='".$fetch_student[0]."' and `add_fee`.`class_id`='".$_POST['className']."'";
                      $chek_fee=$db->select_query($select_fee);
                      if($chek_fee){
                          while($fetch_fee=$chek_fee->fetch_array())
                          {
                            ?>
                            <option value="<?php echo $fetch_fee[1];?>"><?php echo $fetch_fee[2];?></option>
                          <?php }

                      }
                      ?>
                    </select><span id="item_result"></span>
                  </div> 
                </td>
                <td colspan="1">
                  <input type="text"  id="feetext" name="feetext" class='form-control' readonly=""></input>
                </td>
                <td colspan="1">
                  <input type="text" class="form-control" name="discount"></input>
                </td>
                <td align="center"><input type="submit" value="ADD" name="add1" class="btn btn-info btn-sm"></input> <input type="submit" value="View" name="add3" class="btn btn-info btn-sm"></input> <input type="submit" value="View All" name="add2" class="btn btn-info btn-sm"></input></td>
              </tr>
           <?php }
        ?>
             <tr> 
          <td class="danger" colspan="6" bgcolor="#dddddd" align="center"><span>
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

          </span> </td>
        </tr>
      </table>
       <?php
        if(isset($_POST["add3"]))
        {
          $selectDiscount="SELECT `add_section`.`section_name`,`add_group`.`group_name`,`add_fee`.`title`,`add_fee`.`amount`,add_discount.* FROM  `add_discount` INNER JOIN `add_section` ON `add_discount`.`section_id`=`add_section`.`id` INNER JOIN `add_group` ON `add_discount`.`group_id`=`add_group`.`id` INNER JOIN `add_fee` ON `add_discount`.`feeid`=`add_fee`.`id`  WHERE `add_discount`.`student_id`='".$_POST['stdid']."' ;";
           $resultselectDiscount=$db->select_query($selectDiscount);
            if($resultselectDiscount)
            {
              $studeinfoTable="SELECT `student_personal_info`.`student_name`,`running_student_info`.`class_roll`,`running_student_info`.`group_id`,`running_student_info`.`section_id`,`add_section`.`section_name`,`add_group`.`group_name`,`add_class`.`class_name` FROM  `student_account_info`
               JOIN `student_personal_info` ON `student_account_info`.`id`=`student_personal_info`.`id` 
              JOIN `running_student_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
 INNER JOIN `add_section` ON `running_student_info`.`section_id`=`add_section`.`id`
  INNER JOIN `add_group` ON `running_student_info`.`group_id`=`add_group`.`id`
  INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
    WHERE `student_account_info`.`id`='".$_POST['stdid']."' and `student_account_info`.`class_id`='".$_POST['clsid']."' GROUP BY `student_account_info`.`id`"; 
    $result_std_details_table=$db->select_query($studeinfoTable);
     if($result_std_details_table)
            {
    $fetchTable=$result_std_details_table->fetch_array();
  }
          ?>
      <table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
          <tr>
          <td colspan="6" bgcolor="#dddddd" align="center"><span class='text-info'><h4>Student Discount Table</h4></span></td>
          
        </tr>
         <tr>
          <td><span class='text-info'></span></td>
           <td><span class='text-info'>Name : <b><?php echo $fetchTable['student_name'] ?></b> </span></td>
            <td><span class='text-info'>Roll : <b><?php echo $fetchTable['class_roll'] ?></b></span></td>
             <td><span class='text-info'>Section: <b><?php echo $fetchTable['section_name'] ?></b></span></td>
             <td><span class='text-info'>Group: <b><?php echo $fetchTable['group_name'] ?></b></span></td>
        <td><span class='text-info'>Class: <b><?php echo $fetchTable['class_name'] ?></span></td>
        </tr>
        <tr>
          <td><span class='text-info'>SL</span></td>
           <td><span class='text-info'>Title </span></td>
            <td><span class='text-info'>Amount</span></td>
             <td><span class='text-info'>Discount</span></td>
             <td><span class='text-info'>With Discount Amount</span></td>
             <td align="right"><span class='text-info'>Action</span></td>
        </tr>
        <?php
        $i=1;
        $total=0;
        while ($fetchDiscount=$resultselectDiscount->fetch_array()) 
        {$total=$fetchDiscount['amount']-$fetchDiscount['discount'];
          
       
        ?>
      <tr>
          <td><span class='text-info'><?php echo $i++ ?></span></td>
           <td><span class='text-info'><?php echo $fetchDiscount['title'] ?></span></td>
            <td><span class='text-info'><?php echo $fetchDiscount['amount'] ?></span></td>
             <td><span class='text-info'><?php echo $fetchDiscount['discount'] ?></span></td>
             <td><span class='text-info'><?php echo $total ?></span></td>
             <td align="right"><span class='text-info'><a style='width:80px; margin-top:2px; margin-left:0px;' href="?dlt=<?php echo $fetchDiscount['discount_id'] ?>" class='btn btn-danger' onclick='return confirm_delete()  '>Delete</a></span></td>
        </tr>
        <?php
        }
        ?>
      </table>
      <?php
} }
      ?>
     
      </div>
  </form>
  
 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
