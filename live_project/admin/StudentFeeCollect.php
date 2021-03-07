<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
    global $msg;
  global $result_std_details;
  global $insert_fee_studnt;
  $db = new database();
  @$id=$db->escape($_POST['id']);
  if(isset($_POST['searchbutton']))
   {
      
      $year=$db->escape($_POST['year']);
      $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
      @$exploide=explode('and', $class);
      if(!empty($id) && !empty($class)){
      $select="SELECT * FROM `running_student_info` WHERE `student_id`='$id' AND `class_id`='".$exploide[0]."'";
      $result_s=$db->select_query($select);
      if($result_s)
      {
        $select_Std_details="SELECT `running_student_info`.`student_id`,`class_roll`,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`contact_no`,`add_class`.`class_name`,`add_group`.`group_name`,`add_section`.`section_name`,`student_acadamic_information`.`session2`,`running_student_info`.`class_id` FROM `running_student_info` 
INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
INNER JOIN `student_acadamic_information` ON `running_student_info`.`student_id`=`student_acadamic_information`.`id`
INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
INNER JOIN `add_group` ON `running_student_info`.`group_id`=`add_group`.`id`
INNER JOIN `add_section` ON `running_student_info`.`section_id`=`add_section`.`id` WHERE `running_student_info`.`student_id`='$id' AND `running_student_info`.`class_id`='".$exploide[0]."'";
    $result_std_details=$db->select_query($select_Std_details);
    if ($result_std_details) {
      $fetch_Student_details=$result_std_details->fetch_array();
    }
      }
    }
   }
      $fetch[0]=$db->autogenerat('student_paid_table','voucher','Rec-','9');
      $fetcha[0]=$db->autogenerat('Student_due_table','id','Due-','9');
$fetchIncome[0]=$db->autogenerat('other_income','id','OTI-','9');
if(isset($_POST['add']))
  {
    
    if(!empty($_POST['stdId']) && !empty($_POST['classNameId'])&& !empty($_POST['paidAmount']))
    {
      $stduID=$_POST['stdId'];
      $voucher=$fetch[0];
      $DuID=$fetcha[0];
      $query="INSERT INTO `student_paid_table` (`student_id`,`voucher`,`class_id`,`paid_amount`,`date`,`admin_id`,`month`,`year`) VALUES ('".$_POST['stdId']."','".$fetch[0]."','".$_POST['classNameId']."','".$_POST['paidAmount']."','".date('d-m-Y')."','1','".date('M')."','".date('Y')."')";
      $resultisnsert=$db->insert_query($query);
      //print_r($query);
     $selectDueTable="SELECT * FROM `Student_due_table` WHERE `Student_due_table`.`student_id`='".$_POST['stdId']."'";
    $resultDueTable=$db->select_query($selectDueTable);
    if ($resultDueTable) {
    $fetchDue=$resultDueTable->fetch_array();
    if ($fetchDue['student_id']==$stduID)
     {
      $updateQuery="UPDATE `Student_due_table` SET `total_amount`='".$_POST['TotalDueAmount']."',`paid_amount`='".$_POST['paidAmount']."',`date`='".date('d-m-Y')."' where `student_id`='$stduID'";
      $update=$db->update_query($updateQuery);  
    }
    
    }
    else
    {
        $queryDue="INSERT INTO `Student_due_table` (`id`,`student_id`,`class_id`,`total_amount`,`paid_amount`,`date`) VALUES ('".$fetcha[0]."','".$_POST['stdId']."','".$_POST['classNameId']."','".$_POST['TotalDueAmount']."','".$_POST['paidAmount']."','".date('d-m-Y')."')";
      $resultisnsert=$db->insert_query($queryDue); 
    }
      
       $query_ass="INSERT INTO `other_income` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES ('".$fetchIncome[0]."','".date('d/m/Y')."','Student Payment','Student ID :".$_POST['stdId']."','".$_POST['paidAmount']."','1')";
      $result_query=$db->insert_query($query_ass);
      //print_r($query);
      echo "<script>location='custome_create_fee.php?stdId=$stduID&VoucherId=$voucher&DuID=$DuID'</script>";
      $fetcha[0]=$db->autogenerat('Student_due_table','id','Due-','9');
       $fetch[0]=$db->autogenerat('student_paid_table','voucher','Rec-','9');
      $fetchIncome[0]=$db->autogenerat('other_income','id','OTI-','9');
    }
    else
    {
      $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
    }
  }

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
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Fee Collect</span> </td>
  			</tr>
        <tr>
          <td bgcolor="#ffffff" class="" colspan="4"  align="center">
            <div class="col-md-12">
            <div class="col-md-4">
            
             <input type="text" name="id" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['student_id']; ?>"
          <?php }
          ?> placeholder="Student Id"></input>

              </div>
              <div class="col-md-3">
             <input type="text" name="year" class="form-control" value="<?php echo date('Y')?>" ></input>

              </div>
              <div class="col-md-3">
             <select name="className" id="className" class="form-control">
          
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
              </div>
<div class="col-md-2">
<button type="submit" name="searchbutton" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

  </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">ID &nbsp; :</span></div>
          <div class="col-md-9">
          <input type="text" name="stdId" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['student_id']; ?>"
          <?php }
          ?> readonly></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Phone&nbsp;:</span></div>
          <div class="col-md-8">
          <input type="text" name="phone" class="form-control"  <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['contact_no']; ?>"
          <?php }
          ?>  disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Name &nbsp; :</span></div>
          <div class="col-md-9">
              <input type="text" class="form-control" name="name" placeholder="Name"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['student_name']; ?>"
          <?php }
          ?> ></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Group &nbsp; :</span></div>
          <div class="col-md-8">
          <input type="text" name="" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['group_name']; ?>"
          <?php }
          ?> disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Roll &nbsp; :</span></div>
          <div class="col-md-9">
          <input type="text" name="classRoll" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['class_roll']; ?>"
          <?php }
          ?> disabled></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Section &nbsp; :</span></div>
          <div class="col-md-8">
          <input type="text" name="" class="form-control"  <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['section_name']; ?>"
          <?php }
          ?>  disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Father Name &nbsp; :</span></div>
          <div class="col-md-9">
          <input type="text" name="" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['father_name']; ?>"
          <?php }
          ?> disabled></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Mother Name &nbsp; :</span></div>
          <div class="col-md-8">
          <input type="text" name="" class="form-control"  <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['mother_name']; ?>"
          <?php }
          ?>  disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Class  &nbsp; :</span></div>
          <div class="col-md-9">
            <input type="hidden" name="classNameId"  <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['class_id']; ?>"
          <?php }
          ?>></input>
          <input type="text" name="" class="form-control" <?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['class_name']; ?>"
          <?php }
          ?>  disabled></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Session &nbsp; :</span></div>
          <div class="col-md-8">
          <input type="text" name="" class="form-control"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details['session2']; ?>"
          <?php }
          ?>  disabled></input>
          </div></td>
        </tr>
        <?php
 if(isset($_POST['searchbutton']))
   {
   $id=$_POST["id"];
    $idc=$_POST["className"];
	print $id.'class='.$idc;
$selectStudentAccount2="SELECT `add_fee`.`amount` FROM `student_account_info` 
INNER JOIN `add_fee` ON `student_account_info`.`fee_id`=`add_fee`.`id`
 WHERE `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`class_id`='".$_POST["className"]."' ";
  $cheked_queryFee2=$db->select_query($selectStudentAccount2);
  print_r($cheked_queryFee2) ;
                if($cheked_queryFee2)
                {
                  $totalPayable=0;
                  
                while($fetchFeeTotal=$cheked_queryFee2->fetch_array())
                {
                  $totalPayable+=$fetchFeeTotal['amount'];
                }
				
                }

  $selectStudentdiscount="SELECT  sum(`discount`) from add_discount WHERE `add_discount`.`student_id`='$id' AND `add_discount`.`class_id`='".@$exploide[0]."' ";
  $cheked_queryFeediscount=$db->select_query($selectStudentdiscount);
                if($cheked_queryFeediscount)
                { 
               $fetchFeeTotalDiscount=$cheked_queryFeediscount->fetch_array();
                }

  $selectStudentPaid="SELECT  sum(`paid_amount`) from student_paid_table WHERE `student_paid_table`.`student_id`='$id' AND `student_paid_table`.`class_id`='".@$exploide[0]."' ";
  $cheked_queryFeePaid=$db->select_query($selectStudentPaid);
                if($cheked_queryFeePaid)
                { 
               $fetchFeeTotalPaid=$cheked_queryFeePaid->fetch_array();
                }
                @$totalDue=@$totalPayable-@$fetchFeeTotalDiscount['sum(`discount`)']-@$fetchFeeTotalPaid['sum(`paid_amount`)'];
        $getDue=0;
        $selectDue="SELECT  * from `student_due_table` WHERE `student_due_table`.`student_id`='$id'";
  $checkDueTable=$db->select_query($selectDue);
   if($checkDueTable)
                { 
               $fetchDuAmount=$checkDueTable->fetch_array();
               $getDue=$fetchDuAmount['total_amount']-$fetchDuAmount['paid_amount'];
                }
        }
        ?>
 <tr>
          <td align="right">
           </td>
          <td align="right">
                   <span class="text-justify text-warning"><strong>Total  Amount &nbsp; :- </strong></span>       </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" 
            value="<?php echo @$totalPayable; ?>" readonly></input>
           </div></td>
         </tr>
         <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Total Discount Amount &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" value="<?php echo @$fetchFeeTotalDiscount['sum(`discount`)'] ?>" readonly></input>
          </div></td>
        </tr>
        <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Total Paid Amount &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" name="" value="<?php echo @$fetchFeeTotalPaid['sum(`paid_amount`)'] ?>" readonly ></input>
          </div></td>
        </tr>
         <tr>
          <td align="right">
           </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Total Due Amount  &nbsp; :- </strong></span>        </td>
          <td> <div class="col-md-12">
                <input type="text" class="form-control" name="TotalDueAmount" value="<?php echo @$totalDue ?>" readonly></input>
           </div>  </td>
         </tr>
      </table>

          <table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000; margin-top: -20px;">
        
     

         <tr>
          <td align="right">
           </td>
          <td align="right">
                   <span class="text-justify text-warning"><strong>Total Payable  Amount &nbsp; :- </strong></span>       </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" value="<?php echo @$totalDue ?>" ></input>
           </div></td>
         </tr>
        <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Now Paid  &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" name="paidAmount"></input>
          </div></td>
        </tr>
   
        <tr>
          <td colspan="3" align="center">
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
        </tr> 
         <tr>
          <td colspan="3" align="center">
            <input type="submit" value="ADD" name="add" style="width: 150px;" class="btn btn-primary" ></input>          </td>
        </tr>
      </table>

  </form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
// $("#Feeamount").change(function(){
//     //get the form values
//  var feeTitle = $('.feeTitle').val();     
//  var Feeamount = $('.Feeamount').val();     
//  var postData = '&feeTitle='+feeTitle+'&Feeamount='+Feeamount;
// alert(postData);
//  $.ajax({
//     url : "insert_cuistom_fee.php",
//     type: "POST",
//     data : postData,
//     success: function(data)
//      {
//         alert(data);
//         $('#feeTitle').val();
//         $('#Feeamount').val('');
      
//         $("#div1").load("loadCustomFee.php");
//          }

// });


// });   
</script>


    </script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

