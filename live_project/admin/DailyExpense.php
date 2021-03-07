
<?php
@error_reporting(1);
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
    $db = new database();
     $x=explode("-", $_GET["date"]);

       $date=$x[2]."-".$x[1]."-".$x[0];


$sqlProjectInfo="SELECT * FROM `project_info`";
      $result_query=$db->select_query($sqlProjectInfo);
      if($result_query){
          $fetch_query=$result_query->fetch_array();
        
      }

    ?>
<style type="text/css">


.style2 {color: #333333;font-size:14px;font-family:Arial, Helvetica, sans-serif; padding-left:10px;}
.style3 {color: #333333;font-size:14px;font-family:Arial, Helvetica, sans-serif; padding-left:10px;}
.style5 {color: #000000;font-size:14px;font-family:Arial, Helvetica, sans-serif;text-decoration:overline;}

li{list-style:none}
.style7 {color: #000033;font-weight:bold;font-size:12px;font-family:Arial, Helvetica, sans-serif}
.style8 {color: #000066;font-size:14px;font-family:Arial, Helvetica, sans-serif}
</style>
<style>
  @media print{
      .print{
        display:none;
      }


    </style>

     <table  width="960"  border="0"  cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"  align="center">
    <tr >
  <td height="50" align="center" style="border-bottom:1px solid #333333">

    <img src="all_image/logoSDMS2015.png" width="76" height="74"/>

  </td>
      <td style="border-bottom:1px solid #333333" height="50" colspan="4" align="center" >
    <ul style=" padding-top:5px">
    
    <li style="color:#000000;font-family:microsoft-sun-serif;  font-size:26px;"><?php print $fetch_query['bninstituteName']?></li>
   <li><p style="margin-top:-1px;font-size:16px;font-family:Arial, Helvetica, sans-serif"><?php print $fetch_query['LocationbAngla']?> </p></li>
    <li style="margin-top:-13px;font-size:14px;font-family:Arial, Helvetica, sans-serif"><?php print $fetch_query['phone_number']?>,<?php print $fetch_query['email']?> </li>
     </ul>      </td>
<td style="border-bottom:1px solid #333333"></td>
    </tr>

</table>




  <table  width="960"  border="0"  cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"  align="center" style=" margin-top: 20px;">
    
        <tr>
            <td align="center" style="border-bottom: 1px #000 solid; " colspan="2"><h3>  ব্যয় রিপোর্ট </h3>
                <h3 style="float: left; clear: right;">
             <?php
             if(isset($_GET["date"]))
            {
             ?>
             Entry Date : <?php print $_GET["date"]; 
            } 


 if(isset($_GET["SelectYear"]))
            {
             ?>
             Collection Year : <?php print $_GET["SelectYear"]; 
            } 


         if(isset($_GET["monthID"]))
          {
             ?>
              Month  : 
              <?php 
      $selMonth = "SELECT * FROM `month_setup` where  `id`='".$_GET["monthID"]."'";
      $checkMont=$db->select_query($selMonth);
      if($checkMont)
      {
        if($fetmonth=$checkMont->fetch_array())
          echo $fetmonth[1];
      }
    }


            ?>
          </h3>
           <h3 style="float: right;">  Print Date : <?php print date('d-m-Y') ?>  </h3>
          </td>
              
         

        </tr>


     
<!-- ///////////////////////Print Title/////////////// -->
        <tr>
            <td align="center"style="border-right:1px #000 solid; " >
                
                <table style="width: 100%;">
                    <tr>

                        <td style=" border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;"> Voucher No</td>
                                <td style=" border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;"> Details</td>
                    <?php
$query="SELECT * FROM `income_expense_title` WHERE `type`='Expense' ORDER BY `index` ASC";
        $result=$db->select_query($query);
        if($result)
        {
$i=0;
            $count=mysqli_num_fields($result_all);
             while($fetch_all=$result->fetch_array())
             {
                            $i++; ?>
                        <td style="border-bottom: 1px #000 solid; border-left: 1px #000 solid; padding: 10px; text-align: center;">
                            <?php print $fetch_all[1]; ?> 
                        </td>
                <?php
            }
        }
        ?>

        <td style="border-bottom: 1px #000 solid; border-left: 1px #000 solid; padding: 10px; text-align: center;">
                            মোট
                                
        </td>
                
   </tr>
       

     <!-- /////////////////End Title/////////////////
 -->

    <?php

    if(isset($_GET["date"]))
    {
       $class="SELECT * FROM `other_cost` WHERE `date`='$date'";

    }

    if(isset($_GET["monthID"]))
    {

      $mo=$_GET["year"].'-'.$_GET["monthID"];

       $class="SELECT * FROM `other_cost` WHERE `date` LIKE '%$mo%'";

    }

      if(isset($_GET["SelectYear"]))
    {

      $y=$_GET["SelectYear"];

       $class="SELECT * FROM `other_cost` WHERE `date` LIKE '%$y%'";

    }


       

        $netTotal=0;
        $SelectClass=$db->select_query($class);
        if($SelectClass)
        {
$i=0;
            $count=mysqli_num_fields($SelectClass);
                        while($fetch_Class=$SelectClass->fetch_array()){
                            $i++; ?>

                 <tr>
                        <td style=" border-left: 1px #000 solid; padding: 10px;border-bottom: 1px #000 solid;">
                            <?php print $fetch_Class[0]; ?>
                                
                </td>
                <td style=" border-left: 1px #000 solid; padding: 10px;border-bottom: 1px #000 solid;">
                            <?php print $fetch_Class[3]; ?>
                                
                </td>

<?php
    $query="SELECT * FROM `income_expense_title` WHERE `type`='Expense' ORDER BY `index` ASC";
        $result=$db->select_query($query);
        if($result)
        {

        while($fetch_all=$result->fetch_array()){
        $i++; ?>


                        <td style="border-bottom: 1px #000 solid; border-left: 1px #000 solid; padding: 10px; text-align: right;">
                       
    <?php

   if(isset($_GET["date"]))
    {
        $totalAmunt="SELECT * FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND `date`='$date' and `id`='".$fetch_Class[0]."'";
       // echo $totalAmunt;

    }

 if(isset($_GET["monthID"]))
    {

      $mo=$_GET["year"].'-'.$_GET["monthID"];

      $totalAmunt="SELECT * FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND  `id`='".$fetch_Class[0]."' AND `date` like '%$mo%'";

      

    }

      if(isset($_GET["SelectYear"]))
    {

      $y=$_GET["SelectYear"];

    
        $totalAmunt="SELECT * FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND  `id`='".$fetch_Class[0]."' AND `date` like '%$y%'";
    }



//print $totalAmunt;

         $r=$db->select_query($totalAmunt);
        if($r)
        {
                if($amount=$r->fetch_array()){
            print $amount['amount'];
        }
    }

    ?>

                                
             </td>

        <?php

    }

}
?>
 <td style="border-bottom: 1px #000 solid; border-left: 1px #000 solid; padding: 10px; text-align: center;">
                            
                                
                            </td>
</tr>

<?php
            }
        }
        ?>

                    
            

                </tr>


     </tr>
<!-- 
///////////////////////////////////Total Title wise/////////////////// -->
     <tr>
            <td style=" border-left: 1px #000 solid; padding: 10px;">Total: </td>
            <td style=" border-left: 1px #000 solid; padding: 10px;"></td>

<?php
$netTotal=0;
    $query="SELECT * FROM `income_expense_title` WHERE `type`='Expense' ORDER BY `index` ASC";
        $result=$db->select_query($query);
        if($result)
        {

        while($fetch_all=$result->fetch_array()){
     ?>


                        <td style="border-bottom: 1px #000 solid; border-left: 1px #000 solid; padding: 10px; text-align: right;">
                       

    <?php
 if(isset($_GET["date"]))
    {
        $totalAmunt="SELECT SUM(`amount`) FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND `date`='$date'";
    }

 if(isset($_GET["monthID"]))
    {

      $mo=$_GET["year"].'-'.$_GET["monthID"];
 $totalAmunt="SELECT SUM(`amount`) FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND `date` LIKE '%$mo%'";
      

    }


      if(isset($_GET["SelectYear"]))
    {

      $y=$_GET["SelectYear"];
      $mo=$_GET["year"].'-'.$_GET["monthID"];
 $totalAmunt="SELECT SUM(`amount`) FROM `other_cost` WHERE `title`='".$fetch_all[0]."' AND `date` LIKE '%$y%'";
    
       
    }


//print $totalAmunt;

         $r=$db->select_query($totalAmunt);
        if($r)
        {
           if($amount=$r->fetch_array()){
            print $amount[0];
            $netTotal=$netTotal+$amount[0];
        }
    }

    ?>
                                
             </td>

        <?php
            }
        }
        ?>


<td style=" border-left: 1px #000 solid; padding: 10px; font-weight: bold; text-align: right;" ><?php echo @$db->my_money_format($netTotal);?>/=</td>

     </tr>

<!-- ///////////////////////////////////End Total Title wise///////////////////
 -->
                    
                    <!-- <tr>
                        <td colspan="2" style="border-top: 1px #000 solid; text-align: right;border-right: 1px #000 solid; ">Total</td>
                        
                        <td style="border-top: 1px #000 solid;">100</td>
                    </tr> -->

                </table>

            </td>
        

        </tr>


        <tr>
                <td  style="border-top: 1px #000 solid;" colspan="2" align="center"> 
<table width="100%">
  
  <tr>
      <td height="70" valign="bottom" align="center">


    

      </td>
      <td valign="bottom">
          ..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-left:60px;">

        Receiver
        </p>
      </td>
      <td colspan="2" align="center" valign="bottom"><p style="margin-top:3px;"></p></td>
  <td valign="bottom" align="center"><p style="font-weight: bold;; font-size: 12px;">Developed By: SBIT (www.sbit.com.bd)</p></td>
      <td align="right" valign="bottom" style="">
        <br>
        <br>
..................................................
        <p style="font-size:14px;font-family:Arial, Helvetica, sans-serif; margin-top: -0px; margin-right:60px; ">

        Principal
        </p>

         </td>
    </tr>
</table>
    
</td>
</tr>

    

</table> </td>
                
        </tr>

  </table>

 <br>
<center> 
<input type="button" name="print" value="Print" class="print" style="height: 30px; width: 150px; background: GREEN; color: #fff; border: 0px;" 
onclick="window.print()">
</center>
