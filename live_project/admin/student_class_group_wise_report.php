<?php
require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  global $result_std_details;
  global $insert_fee_studnt;
  $db = new database();
  $getyid=$_GET['stdId'];

            $selc_student="SELECT `student_account_info`.`id`,`year`,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2` FROM `student_account_info`
            JOIN `student_personal_info` ON `student_account_info`.`id`=`student_personal_info`.`id` JOIN `student_acadamic_information` ON 
            `student_personal_info`.`id`=`student_acadamic_information`.`id` WHERE `student_account_info`.`id`='$getyid'  GROUP BY `student_account_info`.`id`";
            $check_student=$db->select_query($selc_student);
            if($check_student){
              $fetch_Student=$check_student->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
      </head>
  
  <body>
<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" >
<table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
           <tr>
          <td colspan="4" align="center" class="info"><span class="text-justify text-warning"><strong><h4>Student Fee Report</h4></strong></span></td>
        </tr>
        <tr>
          <td><span class='text-info'>ID &nbsp; : <b><?php echo $fetch_Student[0];?></b></span></td>
           <td><span class='text-info'>Name &nbsp; : <b><?php echo $fetch_Student[2]?></b></span></td>
            <td><span class='text-info'>Year &nbsp;  : <b><?php echo $fetch_Student[1];?></b></span></td>
             <td><span class='text-info'>Session &nbsp; :  <b><?php echo $fetch_Student[3];?></b></span></td>
        </tr>
        <?php
               
            $select_fee_details_stdaa="SELECT `add_class`.`class_name`,`student_account_info`.`class_id` from `student_account_info` 
INNER JOIN `add_class` ON 
`student_account_info`.`class_id`=`add_class`.`id`
             WHERE `student_account_info`.`id`='$getyid' GROUP BY `student_account_info`.`class_id` desc";
            $result_Class=$db->select_query($select_fee_details_stdaa);
            if($result_Class){
           
              
              while ($fetch_class=$result_Class->fetch_array()) {
               
               

        
        ?>
             <tr>
          <td colspan="4" align="center" class="info"><span class="text-justify text-warning"><strong><?php echo $fetch_class['class_name'] ?></strong></span></td>
        </tr>
        <tr>
          <td colspan="3" align="left"><span class="text-justify text-warning"><strong>Fee Title</strong></span></td>
          <td colspan="1"><span class="text-justify text-warning"><strong>Amount</strong></span></td>
        </tr>
        <?php
            $select_fee_details_std="SELECT `student_account_info`.`id`,`fee_id`,`add_fee`.`title`,`amount` FROM `student_account_info` INNER JOIN `add_fee` ON 
`student_account_info`.`fee_id`=`add_fee`.`id` WHERE `student_account_info`.`id`='$getyid' and `student_account_info`.`class_id`='".$fetch_class['class_id']."'";
            $result_fee=$db->select_query($select_fee_details_std);
            if($result_fee){
              $sl = 0;
              $total="";
              while ($fetch_feee=$result_fee->fetch_array()) {
                $sl++;
                $total=$total+$fetch_feee[3];

         ?>
        <tr>
          <td colspan="3">&nbsp; <span class="text-justify text-info">&nbsp;<?php echo $sl;?> . &nbsp; <?php echo $fetch_feee[2];?></span>
          </td>
          <td colspan="1">
            <span class="text-justify text-info">&nbsp; <?php echo $fetch_feee[3]; ?> </span>
          </td>
        </tr>
       <?php } } ?>
        <tr>
          <td colspan="3" align="right"><span class="text-justify text-warning">Total &nbsp;:<strong></strong></span> </td>
          <td><span class="text-justify text-warning"><?php echo $total;?><strong></strong></span></td>
        </tr>
         <?php } } ?>
      </table>
<?php
}
?>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
