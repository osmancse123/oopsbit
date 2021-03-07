<?php
$id=$_GET['tchrId'];
$dates=$_GET['date'];

require_once("../db_connect/config.php");
require_once("../db_connect/conect.php");
  $db = new database();


    $sears="SELECT `add_payment_title`.`payment_title`,`teacher_payable_table`.`amount` FROM  `teacher_payable_table`
 INNER JOIN `add_payment_title` ON `teacher_payable_table`.`title`=`add_payment_title`.`id`
    WHERE `teacher_payable_table`.`id`='$id' and `teacher_payable_table`.`date`='$dates'";
    $checked=$db->select_query($sears);
    
    	if($checked)
   		 {
?>
<form method="post">
<table width="844" border="1" align="center"  cellpadding="0" cellspacing="0" bordercolor="#333333" class="table table-responsive box">
            <tr>
              <td width="8%" align="center" bgcolor="#000000"><span class="style1">Sl</span></td>
              <td width="51%" align="center" bgcolor="#000000"><span class="style1">Title</span></td>
              <td width="41%" align="center" bgcolor="#000000"><span class="style1">Amount</span></td>
            </tr>
            <?php

   		 	$i=1;
   		 	$total=0;
     while( $fetch=$checked->fetch_array())
     {
     	$total+=$fetch['amount'];
  		
            ?>
            <tr>
              <td align="center">&nbsp;<?php echo $i++ ?></td>
              <td align="center">&nbsp;<?php echo $fetch['payment_title'] ?></td>
              <td align="center">&nbsp;<?php echo $fetch['amount'] ?></td>
            </tr>
            <?php
        }
            ?>
             <tr>
              
              <td align="right" colspan="2">Total :</td>
              <td align="center"><input type="text" value="<?php echo $total ?>" name="payableAmountf"><input type="hidden" value="<?php echo $id ?>" name="teacherIdno"></td>
  </tr>
  <tr>
  	 <td colspan="3" align="right"><button type="submit" name="save" class="btn btn-info btn-sm ">Payment</button></td>
  </tr>
          </form>
          <?php

}
          ?>