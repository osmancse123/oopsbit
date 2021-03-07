<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
  global $result_std_details;
  global $insert_fee_studnt;
	$db = new database();
	 if(isset($_POST['searchbutton']))
   {
      $id=$db->escape($_POST['id']);
      $year=$db->escape($_POST['year']);
      $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
      @$exploide=explode('and', $class);
      if(!empty($id) && !empty($class)){
      $select="SELECT * FROM `running_student_info` WHERE `student_id`='$id' AND `class_id`='".$exploide[0]."'";
      $result_s=$db->select_query($select);
      if($result_s)
      {
        $select_Std_details="SELECT `running_student_info`.`student_id`,`class_roll`,`class_id`,`student_personal_info`.`student_name`,`add_class`.`class_name` FROM `running_student_info` 
INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
 WHERE `running_student_info`.`student_id`='$id' AND `running_student_info`.`class_id`='".$exploide[0]."'";
    $result_std_details=$db->select_query($select_Std_details);
    if ($result_std_details) {
      $fetch_Student_details=$result_std_details->fetch_array();
    }
      }
    }
   }
   if(isset($_POST["Add"]))
   {
       $id=$db->escape($_POST['id']);
      $year=$db->escape($_POST['year2']);
      $classId=$db->escape($_POST['clsid']);
      
      if(!empty($_POST['name']) && !empty($_POST["roll"]))
      { 
  //     $selectStudentAccount="select id,fee_id,class_id,year from student_account_info WHERE id='$id'";
  //      $resultStudentAccount=$db->select_query($selectStudentAccount);
  //      if ($resultStudentAccount==true)
  //       {
  //     $fetch=$resultStudentAccount->fetch_array();
  // if ($fetch['id']==$id&&$fetch['class_id']== $classId&&$fetch['year']==$year)
  //   {
  //      echo "You Have Already Add Fee";
  //   }
  //   }
  //   else
  //   {
      $feedetails=count($_POST["fee"]);
      //print $feedetails;
      for($t = 0; $t < $feedetails ; $t++)
      {
        $insert_fee="INSERT INTO `student_account_info`(`id`,`class_id`,`fee_id`,`year`,`month`,`date`,`admin_id`) VALUES ('$id','".$_POST['clsid']."','".$_POST["fee"][$t]."','$year','".date('M')."','".date('d/m/y')."','1')";
        $insert_fee_studnt=$db->insert_query($insert_fee);
      }
    // }
    }
   }
   if (isset($_POST['Add3']))
    {
     echo "<script>location='student_class_group_wise_report.php?stdId=".$_POST['id']."'</script>";
   }
    if(isset($_GET['deleId']))
  {
    $stdid=$db->escape($_GET['stdid']);
    $classId=$db->escape($_GET['classId']);
    $yearId=$db->escape($_GET['yearId']);
    $linid=$db->escape($_GET['deleId']);
    $query="DELETE FROM `student_account_info` WHERE `id`='$stdid' and `class_id`='$classId' and `fee_id`='$linid' and `year`='$yearId'";
    $delete=$db->delete_query($query);
   $insert_fee="INSERT INTO `recent_delete_info`(`student_id`,`title`,`fee_id`,`date_time`,`admin_id`) VALUES ('$stdid','Delete From Student Account','$linid','".date('d/m/y')."','1')";
        $insert_fee_studnt=$db->insert_query($insert_fee);
    print "<script>location='add_fee_in_student_account.php'</script>";

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
    <script type="text/javascript">
function check_all( parent_chk_bx_id, all_chk_bx_clss)
    {
      var x,r; 
      r = document.getElementsByClassName(all_chk_bx_clss);
      
      if(parent_chk_bx_id.checked== true)
      {
        for(x=0;x < r.length; x++)
        {
          r[x].checked = true;
        
        }
      }
      else
      {
        for(x=0;x < r.length; x++)
        {
          r[x].checked = false;
        
        }
      }
    }
    </script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4"  class="warning" colspan="6" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Fee In Student Account</span> </td>
  			</tr>
  			<tr>
  				<td colspan="2"><input type="text" class="form-control" required placeholder="ID" name="id"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details[0]; ?>"
          <?php }
          ?>></input></td>
  				<td><input type="text" value="<?php echo date('Y')?>" class="form-control"  name="year"></input></td>
  				<td colspan="2">
  					<select name="className" required id="className" class="form-control">
					<option><?php 
          if($result_std_details){
            ?>
           <?php echo $fetch_Student_details['class_name']; ?>
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
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
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
            value="<?php echo $fetch_Student_details[3]; ?>"
          <?php }
          ?> ></input>
          </div>
          </td>
          
          <td align="right"><strong><span class="text-justify text-success text-right">Class Roll &nbsp;</span></strong>  </td>
          <td>
          <div class="col-md-12">
            <input type="hidden" name="clsid" <?php 
               if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details[2]; ?>"
          <?php }
          ?> ></input>
            <input type="text" class="form-control" name="roll" placeholder="roll"<?php 
          if($result_std_details){
            ?>
            value="<?php echo $fetch_Student_details[1]; ?>"
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

       
   
          
          <?php 
          if(isset($_POST['searchbutton']))
          {
            $year=$db->escape($_POST['year']);
            $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
            @$exploide=explode('and', $class);
             $select="SELECT * FROM `running_student_info` WHERE `student_id`='$id' AND `class_id`='".$exploide[0]."'";
              $result_s=$db->select_query($select);
              if($result_s)
              {
            if(!empty($_POST["id"])){
            $select_fee="SELECT * FROM `add_fee` WHERE `year`='$year' AND `class_id`='".$exploide[0]."'";
            $result_select_fee=$db->select_query($select_fee);
              if ($result_select_fee) {
                ?>
                 <tr>
          <td colspan="6">&nbsp; &nbsp;<input type="checkbox" value="checkbox" id="chkbx_all"  onclick="check_all(this,'check_elmnt')"> &nbsp; <strong><span class="text-danger">Select All</span></strong></input></td>
        </tr>
                <?php
                while($fetch_fee=$result_select_fee->fetch_array())
                {
                     $selectAcc="SELECT * FROM `student_account_info` WHERE `id`='".$_POST['id']."' and `class_id`='".$exploide[0]."' and `fee_id`='".$fetch_fee[0]."' and `year`='".$_POST['year']."'";
                 $result_select_Acc=$db->select_query($selectAcc);
                 
                 ?>
                   <tr>
                <td colspan="6">

                &nbsp; &nbsp;<input type="checkbox" class="check_elmnt" name="fee[]"<?php if($result_select_Acc){?> checked="checked" disabled<?php } ?> value="<?php echo "$fetch_fee[0]";?>">&nbsp; &nbsp;&nbsp; <strong><span class="text-info" style="font-size:15px;"><?php echo $fetch_fee[1];?> &nbsp; &nbsp;(<?php echo $fetch_fee[3];?>)</span></strong></input><br/>
          </td>
              </tr>
                <?php }
              }
            }
          }
          }
          ?>
            
    
        
        
        <tr>
          <td colspan="6" align="center"><button type="submit" class="btn btn-primary"style="width: 150px;" name="Add">ADD</button> <button type="submit" class="btn btn-primary"style="width: 150px;" name="Add3">All View</button> <?php 
          if($result_std_details){
            ?><button type="submit" class="btn btn-primary"style="width: 100px;" name="Add2">View</button>
            <?php }?></td>
        </tr>

        <?php
        if(isset($_POST["Add2"]))
        {
            $id=$db->escape($_POST['id']);
            $year=$db->escape($_POST['year2']);
            $class_id=$db->escape($_POST['clsid']);
            $selc_student="SELECT `student_account_info`.`id`,`year`,`student_personal_info`.`student_name`,`student_acadamic_information`.`session2` FROM `student_account_info`
            JOIN `student_personal_info` ON `student_account_info`.`id`=`student_personal_info`.`id` JOIN `student_acadamic_information` ON 
            `student_personal_info`.`id`=`student_acadamic_information`.`id` WHERE `student_account_info`.`id`='$id' AND 
            `student_account_info`.`class_id`='$class_id'  GROUP BY `student_account_info`.`id`";
            $check_student=$db->select_query($selc_student);
            if($check_student){
              $fetch_Student=$check_student->fetch_array();
        ?>
        
      </table>
      <table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
        <tr>
          <td><span class='text-info'>ID &nbsp; : <?php echo $fetch_Student[0];?></span></td>
           <td><span class='text-info'>Name &nbsp; : <?php echo $fetch_Student[2]?></span></td>
            <td><span class='text-info'>Year &nbsp;  : <?php echo $fetch_Student[1];?></span></td>
             <td><span class='text-info'>Session &nbsp; :  <?php echo $fetch_Student[3];?></span></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><span class="text-justify text-warning"><strong>Fee Title</strong></span></td>
          <td ><span class="text-justify text-warning"><strong>Amount</strong></span></td>
          <td align='right'><span class="text-justify text-warning"><strong>Action</strong></span></td>
        
        </tr>
        <?php
            $select_fee_details_std="SELECT `student_account_info`.`id`,`fee_id`,`add_fee`.`title`,`amount`,`add_class`.`class_name`,`student_account_info`.`class_id`,`student_account_info`.`year` FROM `student_account_info` INNER JOIN `add_fee` ON 
`student_account_info`.`fee_id`=`add_fee`.`id`
INNER JOIN `add_class` ON 
`student_account_info`.`class_id`=`add_class`.`id`
 WHERE `student_account_info`.`id`='$id' AND `student_account_info`.`class_id`='$class_id' AND `student_account_info`.`year`='$year'";
            $result_fee=$db->select_query($select_fee_details_std);
            if($result_fee){
              $sl = 0;
              $total="";
              while ($fetch_feee=$result_fee->fetch_array()) {
                $sl++;
                $total=$total+$fetch_feee[3];

         ?>
        <tr>
          <td colspan="2">&nbsp; <span class="text-justify text-info">&nbsp;<?php echo $sl;?> . &nbsp; <?php echo $fetch_feee[2];?></span>
          </td>
          <td colspan="">
            <span class="text-justify text-info">&nbsp; <?php echo $fetch_feee[3]; ?> </span>
          </td>
           <td colspan="" align='right'>
            <span class="text-justify text-info">&nbsp; <a href="add_fee_in_student_account.php?stdid=<?php echo $fetch_feee['id']; ?>&classId=<?php echo $fetch_feee['class_id']; ?>&yearId=<?php echo $fetch_feee['year']; ?>&deleId=<?php echo $fetch_feee['fee_id']; ?>" class="btn btn-danger">Delete</a> </span>
          </td>
        </tr>
       <?php } } ?>
        <tr>
          <td colspan="3" align="right"><span class="text-justify text-warning">Total &nbsp;:<strong></strong></span> </td>
          <td><span class="text-justify text-warning"><?php echo $total;?><strong></strong></span></td>
        </tr>
      </table>
      <?php } } ?>
	</form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
