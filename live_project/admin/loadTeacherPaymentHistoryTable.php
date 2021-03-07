<?php
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
$id=$_GET['tchrId'];

$select_teacher="SELECT * FROM `teachers_information` WHERE `teachers_information`.`teachers_id`='$id'";
          $result_teacher=$db->select_query($select_teacher);
          if($result_teacher){
          	$fetchTable=$result_teacher->fetch_array();
?>
<table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
          <tr>
          <td colspan="5" bgcolor="#dddddd" align="center"><span class='text-info'><h4>Teacher Payment History</h4></span></td>
          
        </tr>
         <tr>
          <td><span class='text-info'></span></td>
           <td><span class='text-info'>Name : <b><?php echo $fetchTable['teachers_name'] ?></b> </span></td>
            <td><span class='text-info'>Email :<b><?php echo $fetchTable['email'] ?></b></span></td>
             <td><span class='text-info'>Phone:<b><?php echo $fetchTable['mobile_no'] ?></b></span></td>
             <td><span class='text-info'>Gender:<b><?php echo $fetchTable['gender'] ?></b></span></td>
        
        </tr>
        <?php
          $select_group="SELECT `teacher_payment_history`.`year` FROM `teacher_payment_history` WHERE `teacher_payment_history`.`teacher_id`='$id' GROUP BY year desc";
          $result_group=$db->select_query($select_group);
          if($result_group)
          {
          while ($v=$result_group->fetch_array())
          {
        ?>
          <tr>
          <td colspan="5" bgcolor="#dddddd" align="center"><span class='text-info'><h4> <?php echo $v['year']?></h4></span></td>
          
        </tr>
         <?php
          $select_groupDate="SELECT `teacher_payment_history`.`date` FROM `teacher_payment_history` WHERE `teacher_payment_history`.`teacher_id`='$id' and `year`='".$v['year']."' GROUP BY date desc";
          $result_groupDate=$db->select_query($select_groupDate);
          if($result_groupDate)
          {
          while ($fetchs=$result_groupDate->fetch_array())
          {
        ?>
        <tr>
          <td colspan="5" class="success" bgcolor="#dddddd" align="center"><span class='text-info'><h4> <b><?php echo $fetchs['date']?></b></h4></span></td>
          
        </tr>
        <tr>
          <td><span class='text-info'>SL</span></td>
           <td><span class='text-info'>Payment Id </span></td>
            <td><span class='text-info'>Payable Amount</span></td>
             <td><span class='text-info'>Payment Amount</span></td>
             <td><span class='text-info'>Current Amount</span></td>
            
        </tr>
        <?php
        $i=1;
      $yearss=$v['year'];
      $datess=$fetchs['date'];
        $totalAmount=0;
        $totalPayable=0;
        $totalPayment=0;
        $totalcurrent=0;
         $selectHistory="SELECT `teacher_payment_history`.`id`,`teacher_payment_history`.`current_amount`,`teacher_payment_history`.`payment_amout` FROM teacher_payment_history where teacher_id='$id' and `year`='$yearss' and `date`='$datess' ";
           $result_selectHistory=$db->select_query($selectHistory);
            if($result_selectHistory)
            {
        while ($fetch_History=$result_selectHistory->fetch_array()) 
        {
$totalAmount=$fetch_History['current_amount']-$fetch_History['payment_amout'];
// $totalPayment+=$fetch_History['payment_amout'];
// $totalPayable+=$fetch_History['current_amount'];
// $totalcurrent=$totalPayable-$totalPayment;
        ?>
      <tr>
          <td><span class='text-info'><?php echo $i++ ?></span></td>
           <td><span class='text-info'><?php echo $fetch_History['id'] ?></span></td>
            <td><span class='text-info'><?php echo $fetch_History['current_amount'] ?></span></td>
             <td><span class='text-info'><?php echo $fetch_History['payment_amout'] ?></span></td>
             <td><span class='text-info'><?php echo $totalAmount ?></span></td>
             
        </tr>
        <?php
        }}
        ?>
            
     
          
   <?php }}}} ?>
      </table>
 <?php } ?>