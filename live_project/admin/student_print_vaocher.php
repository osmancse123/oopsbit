
<?php
@error_reporting(1);
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
    $db = new database();
	
	
$id =json_decode($_GET["id"]);
$vou =json_decode($_GET["Lid"]);
$year =json_decode($_GET["year"]);
$date =json_decode($_GET["date"]);
$clas =json_decode($_GET["clas"]);
 $last_id =json_decode($_GET["last_id"]);
$explodecl = explode('and',$clas);
$selApp="select * from project_info";
$queApp=$db->select_query($selApp);
$fetchApp=mysqli_fetch_assoc($queApp);



  $qurRun="SELECT `student_paid_table`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`,`add_class`.`class_name`  FROM `student_paid_table`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_paid_table`.`student_id` INNER JOIN `running_student_info`
ON `running_student_info`.`student_id`=`student_paid_table`.`student_id` INNER JOIN `add_class` ON `add_class`.`id`=`student_paid_table`.`class_id` WHERE `student_paid_table`.`student_id`='$id' AND
`student_paid_table`.`year`='$year' AND `student_paid_table`.`class_id`='$explodecl[0]' AND `student_paid_table`.`voucher`='$last_id' GROUP BY `student_paid_table`.`student_id`";

//echo $qurRun;

$SqlRun=$db->select_query($qurRun);
$fetchRun=mysqli_fetch_assoc($SqlRun);



?>
<style type="text/css">
<!--
.style2 {color: #333333;font-size:14px;font-family:Arial, Helvetica, sans-serif; padding-left:10px;}
.style3 {color: #333333;font-size:14px;font-family:Arial, Helvetica, sans-serif; padding-left:10px;}
.style5 {color: #000000;font-size:14px;font-family:Arial, Helvetica, sans-serif;text-decoration:overline;}
-->
li{list-style:none}
.style7 {color: #000033;font-weight:bold;font-size:12px;font-family:Arial, Helvetica, sans-serif}
.style8 {color: #000066;font-size:14px;font-family:Arial, Helvetica, sans-serif}
</style>

<?php
function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );


    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

/*$a=0;
for ($j=0; $j <2 ; $j++)
 { 

$a++;*/

?>

<div style="float:left;  clear:right; margin: auto; width: 760px; border:1px #000 solid; margin:5px;">
  <table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
    <tr >
  <td height="50" align="center" style="border-bottom:1px solid #333333">

    <img src="all_image/logoSDMS2015.png" width="76" height="74"/>

  </td>
      <td style="border-bottom:1px solid #333333" height="50" colspan="4" align="center" >
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px;"><?php echo $fetchApp["institute_name"]?></li>
   <li><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style="margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
     </ul>      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>
    <tr>
      <td width="89" height="27"><span class="style3">Receipt </span></td>
      <td width="9" align="center">:</td>
      <td width="205" style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["voucher"] ?></td>
      <td width="117"><span class="style2">Date</span></td>
      <td width="16" align="center">:</td>
      <td width="77" style="font-size:14px;font-family:Arial, Helvetica, sans-serif">      <?php  $d=explode('-',$fetchRun["date"]);  echo $d[2].'-'.$d[1].'-'.$d[0]; ?></td>
    </tr>



    <tr>
      <td height="20"><span class="style3">Name</span></td>
      <td align="center">:</td>
      <td width="205" style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php  echo $fetchRun["student_name"]?></td>
      <td><span class="style2">Class</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["class_name"]?></td>
    </tr>
      <tr>
      <td height="20"><span class="style3">ID</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["student_id"]?></td>
      <td><span class="style2">Roll</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["class_roll"]?></td>
    </tr>

      <tr>
      <td  colspan="6">


    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#333333" style="border-top:1px solid #333333">


        <tr >
          <td  width="20"  align="center"  style="border-bottom:1px solid #333333;border-right:1px solid #333333; ">SL</td>

          <td width="150" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333">Fee Title </td>

          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Amount </span></td>
              <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Disc.</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Net Amount</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Previous Paid</span></td>
           <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7"> Paid</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;><span class="style7">Dues</span></td>
        </tr>

<?php


$sqls="SELECT `student_paid_table`.*,`add_fee`.`title`,`amount`,`Common_Exceptional`,`student_account_info`.`AmountExceptional` FROM `student_paid_table`  INNER JOIN `add_fee` ON `add_fee`.`id`=`student_paid_table`.`fk_fee_id` INNER JOIN `student_account_info` ON `student_account_info`.`fee_id`=`student_paid_table`.`fk_fee_id` WHERE `student_paid_table`.`class_id`='$explodecl[0]' AND `student_paid_table`.`year`='$year' AND `student_paid_table`.`student_id`='$id' AND `student_paid_table`.`voucher`='$last_id' AND `student_account_info`.`studentID`='$id'";

//echo $sqls;

$querys=$db->select_query($sqls);
if ($querys) 
{
  $totalAmmount =0;
  $totalDiscoutn=0;
  $total=0;
  $dis=0;
  $totalPaid=0;
  $totalDues=0;
  $s = 0;
 while ($fetcRow=mysqli_fetch_assoc($querys)) {
 $s ++;
 
 
      $forDis= "SELECT * FROM `add_discount` WHERE `student_id`='$id' AND `year`='$year' AND `class_id`='$explodecl[0]' and feeid='$fetcRow[fk_fee_id]'";

              $resDist = $db->select_query($forDis);
                if($resDist){
                    $fetchdis=$resDist->fetch_array();
                  $discount = $fetchdis["discount"];
                }else{
                $discount = "";
                }
                

                $paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetcRow[fk_fee_id]' AND `student_id`='$id' AND `class_id`='$explodecl[0]' AND `year`='$year' ";


                
                $RelpaidAmmount = $db->select_query($paidAmmount);
                if($RelpaidAmmount->num_rows > 0){


                    $fetchPaidAmount=$RelpaidAmmount->fetch_array();
                    $padiAMmount = $fetchPaidAmount["total"];
                    $totalPaid = $totalPaid + $fetcRow['paid_amount'];
                }else {
                $padiAMmount = "";
                }
                
                
                
                if($fetcRow['Common_Exceptional']=="Common")
                      {
                        $netAmmount =  $fetcRow["amount"] - $discount;
                      }
                      else
                      {
                            
                            $netAmmount =  $fetcRow["AmountExceptional"] - $discount;

                      }


              
                
                $dueAmmount = $netAmmount-$padiAMmount;
                
                $totalDues = $totalDues+  $dueAmmount;
                

  if($fetcRow['Common_Exceptional']=="Common")
                      {
                          $totalAmmount = $totalAmmount +  $fetcRow["amount"];
                      }
                      else
                      {
                            
                            $totalAmmount =  $totalAmmount+$fetcRow["AmountExceptional"];

                      }

              
                


                $totalDiscoutn = $totalDiscoutn + $discount;
                
                
 /* $prvDue=$prvDue+$fetcRow["prv_dues"];
  $curr=$curr+$fetcRow["amount"];
  $dis=$dis+$fetcRow["discount"];
  $total=$total+$fetcRow["grand_total"];
  $paidTotal=$paidTotal+$fetcRow["paid"];
  $dueTotal=$dueTotal+$fetcRow["dues"];
*/
?>
        <tr>
          <td height="10" align="center" 
          style="border-bottom:1px solid #333333;border-right:1px solid #333333">

          <?php echo $s; ?> </td>

          <td align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo $fetcRow["title"]; ?> </td>
          <td align="right"  style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php 



  if($fetcRow['Common_Exceptional']=="Common")
                      {
                            echo @$db->my_money_format($fetcRow["amount"]); 
                      }
                      else
                      {
                            
                               echo @$db->my_money_format($fetcRow["AmountExceptional"]); 

                         

                      }


       



          ?>&nbsp;</td>
             <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333;"><?php echo @$db->my_money_format($discount); ?>&nbsp; </td>
          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($netAmmount); ?>&nbsp; </td>

          

          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($padiAMmount-$fetcRow['paid_amount']); ?> &nbsp;</td>



          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($fetcRow['paid_amount']); ?>&nbsp; </td>
          <td align="right" style="border-bottom:1px solid #333333;"><?php echo @$db->my_money_format($dueAmmount); ?>&nbsp; </td>

        </tr>
<?php
 }
 
?>  
  
    <tr>
        <td align="right" style=" padding-top:10px;" colspan="8">
            

            <table style="border: 1px #000 solid; margin-right:2px; width: 600px;  " >
                <tr>
                      <td>Total Amount   </td>
                      <td>  :  </td>
                      
                      <td><?php echo @$db->my_money_format($totalAmmount);?></td>

              
                      <td>Total Discount     </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalDiscoutn);?></td>


                
                       <td>Paid Amount </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalPaid);?></td>

                </tr>
               
                

                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                      <td >Previous Paid      </td>
                      <td>  :  </td>
                      <td><?php
                       $previousPaidAmount=$totalAmmount-($totalPaid+$totalDues);
                        echo @$db->my_money_format($previousPaidAmount);?></td>

                         <td>Due Amount    </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalDues);?></td>

                </tr>


           
              
              
              

          </table>
        </td>
    </tr>

 

          <?php 




  ?>
  <tr>
    <td colspan="8">

<table width="100%">
  
  <tr>
      <td height="70" valign="bottom" align="center">


    

      </td>
      <td valign="bottom">
          ..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-left:60px;">

        Student
        </p>
      </td>
      <td colspan="2" align="center" valign="bottom"><p style="margin-top:3px;"></p></td>
  <td valign="bottom" align="center"><p style="font-weight: bold;; font-size: 12px;">Developed By: SBIT (www.sbit.com.bd)</p></td>
      <td align="right" valign="bottom" style="">
        <br>
        <br>
..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-right:60px; ">

        Receiver
        </p>

         </td>
    </tr>
</table>
    
</td>
</tr>

    

</table>


  <?php
}
  ?>



<br>

<br>


  <table  width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-top: 1px #000 solid;" >
       <tr >
  <td height="50" align="center" style="border-bottom:1px solid #333333">

    <img src="all_image/logoSDMS2015.png" width="76" height="74"/>

  </td>
      <td style="border-bottom:1px solid #333333" height="50" colspan="4" align="center" >
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px;"><?php echo $fetchApp["institute_name"]?></li>
   <li><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["location"]?></p></li>
    <li style="margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchApp["phone_number"].','.$fetchApp["email"];?></li>
     </ul>      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>
    <tr>
      <td width="89" height="27"><span class="style3">Receipt </span></td>
      <td width="9" align="center">:</td>
      <td width="205" style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["voucher"] ?></td>
      <td width="117"><span class="style2">Date</span></td>
      <td width="16" align="center">:</td>
      <td width="77" style="font-size:14px;font-family:Arial, Helvetica, sans-serif">      <?php  $d=explode('-',$fetchRun["date"]);  echo $d[2].'-'.$d[1].'-'.$d[0]; ?> </td>
    </tr>
    <tr>
      <td height="20"><span class="style3">Name</span></td>
      <td align="center">:</td>
      <td width="205" style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php  echo $fetchRun["student_name"]?></td>
      <td><span class="style2">Class</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["class_name"]?></td>
    </tr>
      <tr>
      <td height="20"><span class="style3">ID</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["student_id"]?></td>
      <td><span class="style2">Roll</span></td>
      <td align="center">:</td>
      <td style="font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php echo $fetchRun["class_roll"]?></td>
    </tr>

      <tr>
      <td  colspan="6">


    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#333333" style="border-top:1px solid #333333">


        <tr >
          <td  width="20"  align="center"  style="border-bottom:1px solid #333333;border-right:1px solid #333333; ">SL</td>

          <td width="150" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333">Fee Title </td>

          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Amount </span></td>
              <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Disc.</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Net Amount</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7">Previous Paid</span></td>
           <td width="80" align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><span class="style7"> Paid</span></td>
          <td width="80" align="center" style="border-bottom:1px solid #333333;><span class="style7">Dues</span></td>
        </tr>

<?php


      

$sqls="SELECT `student_paid_table`.*,`add_fee`.`title`,`amount`,`Common_Exceptional`,`student_account_info`.`AmountExceptional` FROM `student_paid_table`  INNER JOIN `add_fee` ON `add_fee`.`id`=`student_paid_table`.`fk_fee_id` INNER JOIN `student_account_info` ON `student_account_info`.`fee_id`=`student_paid_table`.`fk_fee_id` WHERE `student_paid_table`.`class_id`='$explodecl[0]' AND `student_paid_table`.`year`='$year' AND `student_paid_table`.`student_id`='$id' AND `student_paid_table`.`voucher`='$last_id' AND `student_account_info`.`studentID`='$id'";

//echo $sqls;

$querys=$db->select_query($sqls);
if ($querys) 
{
  $totalAmmount =0;
  $totalDiscoutn=0;
  $total=0;
  $dis=0;
  $totalPaid=0;
  $totalDues=0;
  $s = 0;
 while ($fetcRow=mysqli_fetch_assoc($querys)) {
 $s ++;
 
 
      $forDis= "SELECT * FROM `add_discount` WHERE `student_id`='$id' AND `year`='$year' AND `class_id`='$explodecl[0]' and feeid='$fetcRow[fk_fee_id]'";

              $resDist = $db->select_query($forDis);
                if($resDist){
                    $fetchdis=$resDist->fetch_array();
                  $discount = $fetchdis["discount"];
                }else{
                $discount = "";
                }
                

                $paidAmmount = "SELECT SUM(`paid_amount`) AS total
FROM `student_paid_table` WHERE `fk_fee_id`='$fetcRow[fk_fee_id]' AND `student_id`='$id' AND `class_id`='$explodecl[0]' AND `year`='$year' ";


                
                $RelpaidAmmount = $db->select_query($paidAmmount);
                if($RelpaidAmmount->num_rows > 0){


                    $fetchPaidAmount=$RelpaidAmmount->fetch_array();
                    $padiAMmount = $fetchPaidAmount["total"];
                    $totalPaid = $totalPaid + $fetcRow['paid_amount'];
                }else {
                $padiAMmount = "";
                }
                
                
                
                if($fetcRow['Common_Exceptional']=="Common")
                      {
                        $netAmmount =  $fetcRow["amount"] - $discount;
                      }
                      else
                      {
                            
                            $netAmmount =  $fetcRow["AmountExceptional"] - $discount;

                      }


              
                
                $dueAmmount = $netAmmount-$padiAMmount;
                
                $totalDues = $totalDues+  $dueAmmount;
                

  if($fetcRow['Common_Exceptional']=="Common")
                      {
                          $totalAmmount = $totalAmmount +  $fetcRow["amount"];
                      }
                      else
                      {
                            
                            $totalAmmount =  $totalAmmount+$fetcRow["AmountExceptional"];

                      }

              
                


                $totalDiscoutn = $totalDiscoutn + $discount;
                
                
 /* $prvDue=$prvDue+$fetcRow["prv_dues"];
  $curr=$curr+$fetcRow["amount"];
  $dis=$dis+$fetcRow["discount"];
  $total=$total+$fetcRow["grand_total"];
  $paidTotal=$paidTotal+$fetcRow["paid"];
  $dueTotal=$dueTotal+$fetcRow["dues"];
*/
?>
        <tr>
          <td height="10" align="center" 
          style="border-bottom:1px solid #333333;border-right:1px solid #333333">

          <?php echo $s; ?> </td>

          <td align="center" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo $fetcRow["title"]; ?> </td>
          <td align="right"  style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php 



  if($fetcRow['Common_Exceptional']=="Common")
                      {
                            echo @$db->my_money_format($fetcRow["amount"]); 
                      }
                      else
                      {
                            
                               echo @$db->my_money_format($fetcRow["AmountExceptional"]); 

                         

                      }


       



          ?>&nbsp;</td>
             <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333;"><?php echo @$db->my_money_format($discount); ?>&nbsp; </td>
          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($netAmmount); ?>&nbsp; </td>

          

          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($padiAMmount-$fetcRow['paid_amount']); ?> &nbsp;</td>



          <td align="right" style="border-bottom:1px solid #333333;border-right:1px solid #333333"><?php echo @$db->my_money_format($fetcRow['paid_amount']); ?>&nbsp; </td>
          <td align="right" style="border-bottom:1px solid #333333;"><?php echo @$db->my_money_format($dueAmmount); ?>&nbsp; </td>

        </tr>
<?php
 }
 
?>  
  
    <tr>
        <td align="right" style=" padding-top:10px;" colspan="8">
            
            <table style="border: 1px #000 solid; margin-right:2px; width: 600px;  " >
                <tr>
                      <td>Total Amount   </td>
                      <td>  :  </td>
                      
                      <td><?php echo @$db->my_money_format($totalAmmount);?></td>

              
                      <td>Total Discount     </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalDiscoutn);?></td>


                
                       <td>Paid Amount </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalPaid);?></td>

                </tr>
               
                

                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                      <td >Previous Paid      </td>
                      <td>  :  </td>
                      <td><?php
                       $previousPaidAmount=$totalAmmount-($totalPaid+$totalDues);
                        echo @$db->my_money_format($previousPaidAmount);?></td>

                         <td>Due Amount    </td>
                      <td>  :  </td>
                      <td><?php echo @$db->my_money_format($totalDues);?></td>

                </tr>


           
              
              
              

          </table>
        </td>
    </tr>


 

          <?php 




  ?>
  <tr>
    <td colspan="8">
<table width="100%">
  
  <tr>
      <td height="70" valign="bottom" align="center">


    

      </td>
      <td valign="bottom">
          ..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-left:60px;">

        Student
        </p>
      </td>
      <td colspan="2" align="center" valign="bottom"><p style="margin-top:3px;"></p></td>
      <td valign="bottom" align="center"><p style="font-weight: bold;; font-size: 12px;">Developed By: SBIT (www.sbit.com.bd)</p></td>
      <td align="right" valign="bottom" style="">
        <br>
        <br>
..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-right:60px; ">

       Receiver
        </p>

         </td>
    </tr>
</table>
    
</td>
</tr>

    

</table>

</div>
  <?php
}
  ?>


