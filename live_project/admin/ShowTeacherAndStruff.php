  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
		if(isset($_POST["show"])){
	
	?>
	
	
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
			 
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">View Teacher And Stuff</strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Type</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:280px; border-radius:0px;">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT `Type` FROM `teachers_information` GROUP BY `Type`";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
									if($fetch_class[0] != ""){
                        ?>
                        <option value="<?php echo "$fetch_class[0]"?>"><?php echo $fetch_class[0];?></option><span id="item_result"></span>
                        <?php } }  }?>
                        </select></div>
						</td>
                    </tr>

                   
				
				
                <tr><td colspan="2" align="center"><input type="button" name="ResultGenerate" value="Go" class="btn btn-danger btn-md" style="width: 80px" onClick="return Go()"></input>
				<input type="button" name="submit" value="Back" class="btn btn-danger btn-md"  style="width: 80px" onClick="return Back()"></input>
				
				
				</td></tr>
                </table>
							
             <?php  }
			 		
					if(isset($_POST["goes"])){
						$sqlProjectInfo="SELECT * FROM `project_info`";
			$result_query=$db->select_query($sqlProjectInfo);
			if($result_query){
					$fetch_query=$result_query->fetch_array();
				
			}
			  
			   global $i;
            global $table;
              $select="SELECT `teachers_id`,`teachers_name`,index_no,custom_index,`designation`,`gender`,Type,`relegion`,`fathers_name`,`mobile_no`,`email`,`present_address`,`parmanent_address`,`the_date_of_joining`,`educational_qualification`,`Department` FROM `teachers_information` WHERE `Type`='".$_POST["type"]."' ORDER BY `index_no` ASC";
            $bcheckt=$db->select_query($select);
			
        
           
           $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px; width:1000px;' align='center'>";
		   $table.='<tr style="border:1px #CCCCCC solid">
									<td align="center"><img src="all_image/logoSDMS2015.png" style="height:80px; padding-left:5px; padding-top:2px;"/></td>
										<td align="center" colspan="9">
												<span class="text-justify text-info" style="font-size:24px;"><strong> '.$fetch_query["institute_name"].'</strong></span><br/>
								<span class="text-justify text-info" style="font-size:15px; "><strong>'.$fetch_query["location"].'</strong></span><br/>';
								if($_POST["type"] == "Teacher"){
									$table.='<span class="text-justify text-info" style="font-size:20px; "><strong>Teacher List</strong></span><br/>';
									}else {
										$table.='<span class="text-justify text-info" style="font-size:20px; "><strong>Stuff List</strong></span><br/>';
									}
									
									//='</strong></span><br/>	
									$table.='</td>
							</tr>';
		   
		       if($bcheckt->num_rows > 0)
			   {
			   $ba=$bcheckt->fetch_array();
		   $table.="<tr class='success'>"."<td class='noneBtnForprin'>Add to Ex</td>"."<td>Serial No</td>"."<td>Name </td>"."<td>Designation</td>"."<td>Gendar</td>"."<td>Mobile No</td>"."<td>Email</td>"."<td>Index No</td>";
		  
		   $table.="<td>Picture</td>"."<td class='noneBtnForprin'>Edit Or Delete</td>"."</tr>";
		    $checkt=$db->select_query($select);
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                    $table.="<td style='width35px;' class='noneBtnForprin'><a  onclick='return AddEx(".$a[0].")' class='btn btn-danger'>Add to Ex</a></td>";
					 $table.="<td>$a[index_no]</td>";
					  $table.="<td>$a[teachers_name]</td>";
					   $table.="<td>$a[designation]</td>";
					    $table.="<td>$a[gender]</td>";
						  
					
						   $table.="<td>$a[mobile_no]</td>";
						    $table.="<td>$a[email]</td>";
					
								
								    $table.="<td>$a[custom_index]</td>";
								  
								
					 if($a["Type"] == "Stuff"){
                    $table.="<td>"."<img src='../other_img/$a[0].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
					} else {
					
					$table.="<td>"."<img src='../other_img/$a[email].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
					}
                  $table.="<td class='noneBtnForprin'>";
                     $table.="<a  href='Teacher_information.php?edit=$a[0]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>";
					 if($a["Type"] == "Stuff"){
					 $table.="<a style='width:80px; margin-top:2px;' class='btn btn-danger' onclick='return delete2(".$a[0].")'>Delete</a>";
					 }else {
					   $table.="<a style='width:80px; margin-top:2px;' class='btn btn-danger' onclick='return delete2(".$a[0].")'>Delete</a>";
					 }
				   $table.="</td></tr>";
            }
        }
		
		}else {
		   
		      $table.="<tr>"."<td colspan='26' align='center'>"."No Data found"."</td>"."</tr>";
		   }
           $table.="<tr class='noneBtnForprin'>"."<td colspan='26' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a    class='btn btn-primary' onClick='return Back2()'>Back</a>  <input type='button' name='Print' value='Print' class='btn btn-danger btn-md'  style='width: 80px' onClick='window.print()'></input>"."</td>"."</tr>";
           

            $table.="</table>";
			
			echo $table;
			    } ?>
				<?php
						if(isset($_POST["getID"])){
							 $sleect ="select * FROM `teachers_information` where `teachers_id`='".$_POST['getID']."'";
							$resultselect=$db->select_query($sleect);
								if($resultselect->num_rows > 0){
										$fetchSelect = $resultselect->fetch_array();
								}
							$Delete="DELETE FROM `teachers_information` where `teachers_id`='".$_POST['getID']."'";
                            $db->delete_query($Delete);
							if($fetchSelect["Type"] == "Stuff"){
							 @unlink("../other_img/".$fetchSelect[0].".jpg");
							 }else {
							  @unlink("../other_img/".$fetchSelect['email'].".jpg");
							 }
                           
						}		
				?>

<?php
		if(isset($_POST["getShowAdd"])){
		
				 $select="SELECT * FROM `teachers_information` WHERE `teachers_id`='".$_POST['getShowAdd']."'";
                $checked_query=$db->select_query($select);
                
                //print_r($fetch_exstruf);
               if($checked_query)
                {
                    //print "adfasdfasdf";
                    $fetch_exteacher=$checked_query->fetch_array();
                    $ex_teacher_inof="INSERT INTO `ex-teacher`(`teachers_id`,`index_no`,`teachers_name`,`designation`,`date_of_birth`,`gender`,`blood_group`,`relegion`,`marital_status`,`fathers_name`,
`mothers_name`,`mobile_no`,`email`,`present_address`,`parmanent_address`,`service_firs_joinig_date`,`the_date_of_joining`,`mpo_date`,`educational_qualification`,`additional_qualifications`,`hobby`,`custom_index`,`votar_id_no`,`department`,`type`) VALUES('".$fetch_exteacher[0]."','".$fetch_exteacher[1]."','".$fetch_exteacher[2]."','".$fetch_exteacher[3]."','".$fetch_exteacher[4]."','".$fetch_exteacher[5]."','".$fetch_exteacher[6]."','".$fetch_exteacher[7]."','".$fetch_exteacher[8]."','".$fetch_exteacher[9]."','".$fetch_exteacher[10]."','".$fetch_exteacher[11]."','".$fetch_exteacher[12]."','".$fetch_exteacher[13]."','".$fetch_exteacher[14]."','".$fetch_exteacher[15]."','".$fetch_exteacher[16]."','".$fetch_exteacher[17]."','".$fetch_exteacher[18]."','".$fetch_exteacher[19]."','".$fetch_exteacher[20]."','".$fetch_exteacher[21]."','".$fetch_exteacher[22]."','".$fetch_exteacher[23]."','".$fetch_exteacher[24]."')";
                    $checkd_ins=$db->insert_query($ex_teacher_inof);
              // print "asdfasdf";
                            $Delete="DELETE FROM `teachers_information` where `teachers_id`='".$_POST['getShowAdd']."'";
                            $db->delete_query($Delete);
                          

                    }
		
		}
?>
<?php
		if(isset($_POST["GoEX"])){
		
		$sqlProjectInfo="SELECT * FROM `project_info`";
			$result_query=$db->select_query($sqlProjectInfo);
			if($result_query){
					$fetch_query=$result_query->fetch_array();
				
			}
			  
		      global $i;
            global $table;
              $select="SELECT `teachers_id`,`teachers_name`,index_no,custom_index,`designation`,`gender`,Type,`relegion`,`fathers_name`,`mobile_no`,`email`,`present_address`,`parmanent_address`,`the_date_of_joining`,`educational_qualification`,`Department` FROM `ex-teacher` WHERE `type`='".$_POST["type"]."' ORDER BY `index_no` ASC";
            $bcheckt=$db->select_query($select);
			
        
           
           $table="<table class=\"table table-responsive table-bordered table-hover\" style='margin-top:20px; width:1000px;' align='center'>";
		   $table.='<tr style="border:1px #CCCCCC solid">
									<td align="center"><img src="all_image/logoSDMS2015.png" style="height:80px; padding-left:5px; padding-top:2px;"/></td>
										<td align="center" colspan="9">
												<span class="text-justify text-info" style="font-size:24px;"><strong> '.$fetch_query["institute_name"].'</strong></span><br/>
								<span class="text-justify text-info" style="font-size:15px; "><strong>'.$fetch_query["location"].'</strong></span><br/>';
								if($_POST["type"] == "Teacher"){
									$table.='<span class="text-justify text-info" style="font-size:20px; "><strong>Teacher List</strong></span><br/>';
									}else {
										$table.='<span class="text-justify text-info" style="font-size:20px; "><strong>Stuff List</strong></span><br/>';
									}
									
									//='</strong></span><br/>	
									$table.='</td>
							</tr>';
							
							
		       if($bcheckt->num_rows > 0)
			   {
			   $ba=$bcheckt->fetch_array();
		   $table.="<tr class='success'>"."<td>Serial No</td>"."<td>Name </td>"."<td>Designation</td>"."<td>Gendar</td>"."<td>Mobile No</td>"."<td>Email</td>"."<td>Index No</td>"."<td>Jioning Date</td>";
		  
		   $table.="<td>Picture</td>"."<td class='noneBtnForprin'>Edit Or Delete</td>"."</tr>";
		    $checkt=$db->select_query($select);
            if($checkt){
            while($a=$checkt->fetch_array())
            {
                    $table.="</tr class='info'>";
                  
					 $table.="<td>$a[index_no]</td>";
					  $table.="<td>$a[teachers_name]</td>";
					   $table.="<td>$a[designation]</td>";
					    $table.="<td>$a[gender]</td>";
						  
					
						   $table.="<td>$a[mobile_no]</td>";
						    $table.="<td>$a[email]</td>";
					
								
								    $table.="<td>$a[custom_index]</td>";
									
									 $table.="<td>$a[the_date_of_joining]</td>";
								  
								
					 if($a["Type"] == "Stuff"){
                    $table.="<td>"."<img src='../other_img/$a[0].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
					} else {
					
					$table.="<td>"."<img src='../other_img/$a[email].jpg' height='70' width='70' class='img-responsive img-thumbnail'>"."</td>";
					}
                  $table.="<td class='noneBtnForprin'>";
                     
					 if($a["Type"] == "Stuff"){
					 $table.="<a style='width:80px; margin-top:2px;' class='btn btn-danger' onclick='return deleteff2(".$a[0].")'>Delete</a>";
					 }else {
					   $table.="<a style='width:80px; margin-top:2px;' class='btn btn-danger' onclick='return deleteff2(".$a[0].")'>Delete</a>";
					 }
				   $table.="</td></tr>";
            }
        }
		
		}else {
		   
		      $table.="<tr>"."<td colspan='26' align='center'>"."No Data found"."</td>"."</tr>";
		   }
           $table.="<tr class='noneBtnForprin'>"."<td colspan='26' align='center'>"."<a href='javascript:history.go(0)'' class='btn btn-primary'>Reload</a>&nbsp;&nbsp;&nbsp;&nbsp;<a    class='btn btn-primary' onClick='return Back2()'>Back</a>            <input type='button' name='Print' value='Print' class='btn btn-danger btn-md'  style='width: 80px' onClick='window.print()'>"."</td>"."</tr>";
           

            $table.="</table>";
			
			echo $table;
			



 }
 if(isset($_POST["getIDxxxx"])){
 			   $Delete="DELETE FROM `ex-teacher` where `teachers_id`='".$_POST['getIDxxxx']."'";
                            $db->delete_query($Delete);
 }
?>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
