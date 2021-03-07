<?php
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
  $db = new database();
$id=$_GET['tchrId'];

$select_teacher="SELECT * FROM `stuff_information` WHERE `stuff_information`.`stuff_id`='$id'";
          $result_teacher=$db->select_query($select_teacher);
          if($result_teacher){
          	$fetchTable=$result_teacher->fetch_array();
?>
<table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
          <tr>
          <td colspan="5" bgcolor="#dddddd" align="center"><span class='text-info'><h4>Stuff Payment History</h4></span></td>
          
        </tr>
         <tr>
          <td><span class='text-info'></span></td>
           <td><span class='text-info'>Name : <b><?php echo $fetchTable['stuff_name'] ?></b> </span></td>
            <td><span class='text-info'>Id :<b><?php echo $fetchTable['stuff_id'] ?></b></span></td>
             <td><span class='text-info'>Phone:<b><?php echo $fetchTable['mobile_no'] ?></b></span></td>
             <td><span class='text-info'>Gender:<b><?php echo $fetchTable['gender'] ?></b></span></td>
        
        </tr>
        <?php
          $select_group="SELECT `stuff_payment`.`year` FROM `stuff_payment` WHERE `stuff_payment`.`stuff_id`='$id' GROUP BY year desc";
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
          $select_groupDate="SELECT `stuff_payment`.`date`,`stuff_payment`.`month` FROM `stuff_payment` WHERE `stuff_payment`.`stuff_id`='$id' and `year`='".$v['year']."' GROUP BY month ";
          $result_groupDate=$db->select_query($select_groupDate);
          if($result_groupDate)
          {
          while ($fetchs=$result_groupDate->fetch_array())
          {
        ?>
        <tr>
          <td colspan="5" class="success" bgcolor="#dddddd" align="center"><span class='text-info'><h4> <b><?php echo $fetchs['month']?></b></h4></span></td>
          
        </tr>
        <tr>
          <td><span class='text-info'>SL</span></td>
           <td><span class='text-info'>Payment Id </span></td>
            <td><span class='text-info'>Date</span></td>
             <td colspan="2"><span class='text-info'>Payment Amount</span></td>
            
            
        </tr>
        <?php
        $i=1;
      $yearss=$v['year'];
      $datess=$fetchs['month'];
     
         $selectHistory="SELECT `stuff_payment`.`id`,`stuff_payment`.`date`,`stuff_payment`.`pay_amount` FROM stuff_payment where stuff_id='$id' and `year`='$yearss' and `month`='$datess' ";
           $result_selectHistory=$db->select_query($selectHistory);
            if($result_selectHistory)
            {
        while ($fetch_History=$result_selectHistory->fetch_array()) 
        {

        ?>
      <tr>
          <td><span class='text-info'><?php echo $i++ ?></span></td>
           <td><span class='text-info'><?php echo $fetch_History['id'] ?></span></td>
            <td><span class='text-info'><?php echo $fetch_History['date'] ?></span></td>
             <td colspan="2"><span class='text-info'><?php echo $fetch_History['pay_amount'] ?></span></td>
           
             
        </tr>
        <?php
        }}
        ?>
            
     
          
   <?php }}}} ?>
      </table>
 <?php } ?>