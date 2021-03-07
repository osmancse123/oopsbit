<?php
		if(isset($_GET["noticeid"])){
				$sql = "SELECT `notice`. Notice_id as ID,notice.* FROM `notice` WHERE `Notice_id`='".$_GET["noticeid"]."'";
		}
			if(isset($_GET["orderid"])){
				 $sql = "SELECT `office_order`. Notice_id as ID,office_order.* FROM `office_order` WHERE `Notice_id`='".$_GET["orderid"]."'";
		}
		
		
		if(isset($_GET["calid"])){
				$sql = "SELECT * FROM `academic_calender` WHERE `ID`='".$_GET["calid"]."'";
		}
		
		
		if(isset($_GET["fees"])){
				 $sql = "SELECT `pay`.`pay_id` AS ID,`pay`.`description` AS Description,`pay`.`extension` AS Extension,`pay`.`date_time` AS Date_time,`pay`.`title` AS `Title`
FROM `pay` WHERE `pay_id` ='".$_GET["fees"]."'";
		}
			if(isset($_GET["holiday"])){
				 $sql = "SELECT * from holiday_list WHERE `ID` ='".$_GET["holiday"]."'";
		}
		
		
		if(isset($_GET["public"])){
				 $sql = "SELECT `public_exam_result`.`serial` AS ID,`public_exam_result`.`result_title` AS Title,`public_exam_result`.`result` AS Description,
`public_exam_result`.`extension` AS Extension FROM `public_exam_result` WHERE `serial` ='".$_GET["public"]."'";
		}
		
		
		
		if(isset($_GET["scholarship"])){
				 $sql = "SELECT `bittiexam`.`bittiexam_id` AS ID,`bittiexam`.`xm_title` AS Title,`bittiexam`.`description` AS Description,`bittiexam`.`extension` AS Extension
FROM `bittiexam` WHERE `bittiexam_id`='".$_GET["scholarship"]."'";
		}
		
		
		if(isset($_GET["various"])){
				 $sql = "SELECT `defferentexam`.`defferentxm_id` AS ID,`defferentexam`.`xm_title` AS Title,`defferentexam`.`description` AS Description
,`defferentexam`.`extension` AS Extension FROM `defferentexam` WHERE `defferentxm_id`='".$_GET["various"]."'";
		}
		if(isset($_GET["routineid"])){
				 $sql = "SELECT `routine`.`Routine_id` AS ID,`routine`.`Routine_title` AS Title,`routine`.`Extension` AS Extension,`routine`.`Description` AS Description
FROM `routine` WHERE `Routine_id`='".$_GET["routineid"]."'";
		}
		
		
		
		
		if(isset($_GET["table"])){
				if($_GET["table"] == "examniyomaboli"){
				  $sql = "SELECT `examniyomaboli`.`examniyom_id` AS ID,`examniyomaboli`.`xm_title` AS Title,`examniyomaboli`.`description` AS Description
,`examniyomaboli`.`extension` AS Extension FROM `examniyomaboli` WHERE `examniyom_id`='".$_GET["examid"]."'";
				}else if($_GET["table"] == "examroutine"){
				 $sql = "SELECT `examroutine`.`routine_id` AS ID,`examroutine`.`xm_title` AS Title,`examroutine`.`description` AS Description,`examroutine`.`extension` AS
 Extension FROM `examroutine` WHERE `routine_id`='".$_GET["examid"]."'";
				}
				else if($_GET["table"] == "examsuggesion"){
				 $sql = "SELECT `examsuggesion`.`suggesion_id` AS ID,`examsuggesion`.`xm_title` AS Title,`examsuggesion`.`extension` AS Extension,
 `examsuggesion`.`description` AS Description FROM `examsuggesion` WHERE `suggesion_id`='".$_GET["examid"]."'";
				
				}
				else if($_GET["table"] == "studenexam_record"){
				  $sql = "SELECT `studenexam_record`.`examrecord_id` AS ID,`studenexam_record`.`xm_title` AS Title,`studenexam_record`.`description` AS Description,
 `studenexam_record`.`extension` AS Extension FROM studenexam_record where `studenexam_record`.`examrecord_id`='".$_GET["examid"]."'";
				
				}
				
				else if($_GET["table"] == "acchivement"){
				  $sql = "SELECT *  from acchivement where ID='".$_GET["examid"]."'";
				
				}
				else if($_GET["table"] == "prokoshona"){
				  $sql = "SELECT `prokoshona`.`prokoshona_id` AS ID,`prokoshona`.`xm_title` AS Title,`prokoshona`.`description` AS Description,
`prokoshona`.`extension` AS Extension FROM `prokoshona` WHERE `prokoshona`.`prokoshona_id`='".$_GET["examid"]."'";
				
				}
		}
		
		
		
		$resultsql = $db->select_query($sql);
			if($resultsql->num_rows > 0){
						$fetchsql = $resultsql->fetch_array();
						//print_r($fetchsql);
			}


	
?>

<style type="text/css">
	@media print{

.print{ display: none; }

}

</style>


<div class="col-md-9 col-xs-12 print" style="padding:0px ; margin:0px; margin-top:10px; ">
						
							<div class="col-md-4 col-xs-12 print" id="noticetopdiv" style="margin-top:2px">
									
										<span>Text Size</span>
									
										&nbsp;&nbsp;&nbsp;&nbsp; <a  style="text-decoration:none; cursor:pointer" onclick="fontsize16()"><span style="font-size:14px">A</span></a>
										
									    &nbsp;&nbsp;<a style="text-decoration:none; cursor:pointer" onclick="fontsize18()">	<span style="font-size:18px">A</span></a>
										
										&nbsp;&nbsp;<a  style="text-decoration:none; cursor:pointer" onclick="fontsize20()"> <span style="font-size:20px">A</span></a>
							</div>
							
							
							<div class="col-md-4 col-xs-12 print" id="noticetopdiv" style="margin-top:2px;">
									
									<div class="col-md-2 col-xs-2" style="padding:0px; margin:0px;  font-size:14px;
		 color:#FFFFFF;" >Color</div>
										
										<div class="col-md-10 col-xs-10" style="padding:0px; margin:0px;">
										&nbsp;&nbsp;&nbsp;&nbsp; <a  style="cursor:pointer" onclick="backgroupcolone()"> <div id="colordiv">C</div></a>
										
									    &nbsp;&nbsp;	 <a  style="cursor:pointer"  onclick="backgroupcoltwo()"> <div  id="colordivone">C</div></a>
										
										&nbsp;&nbsp; <a  style="cursor:pointer"  onclick="backgroupcolthree()"> <div  id="colordivtwo">C</div></a>
										
										&nbsp;&nbsp;<a   style="cursor:pointer" onclick="backgroupcolfour()">  <div  id="colordivthree">C</div> </a>
										</div>
							</div>
							
														
</div>	


<style>
       #boxshadow {
        position: relative;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
      
        background: white;
}



</style>



<div class="col-md-9 col-xs-12 fontsize backgroundcol"  style="padding:0px ; margin:0px; margin-top:10px; padding-top:10px;" >

		
				<div class="col-md-12 col-xs-12 print" style="margin:0px;
					padding:0px;  text-align:left; " >
							<img src="img/Printer-icon.png"  style="height:40px; width:40px;" alt="Print"  onclick="window.print()" />
				</div>
				
				<div class="col-md-12 col-xs-12" style="margin:0px;
				padding:0px;  padding-top:20px; "> 
				<span style="float:left; text-align: left;padding-left:5px; font-size: 18px; "> Notice : </span>
				<span style="float:right; text-align:right; padding-right: 10px;"><?php echo $fetchsql['Date_time'];?></span>

				</div>
				
				<div class="col-md-12 col-xs-12"  style="width:100%; border-bottom:1px #E4E4E4 solid; margin-top:10px;">
				
				</div>
				
				
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
				
				
				
				<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
							
								<span  class="changetitle"   style="font-size:24px;" ><?php echo $fetchsql["Title"];?></sapn><br/>
								
								
								<?php
								 if($_GET["table"] == "acchivement"){
								 ?>

								 		<iframe src="other_img/<?php echo $fetchsql["ID"];?>.jpg" height="800" width="100%"></iframe>


								 <table class="table table-bordered table-responsive">
								<tbody>
											
											
											
											<tr>
													<td><p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetchsql["Description"];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p></td>
											</tr>
											
											
								
										</tbody>
							</table>
								 <?php 
								 }else{
										if($fetchsql["Extension"] == "pdf" && $fetchsql["Description"] == ""){
										$an=preg_replace('#[^a-z,A-Z,অ-ঔ,ক-ঁ,া,ি,ী,ু,ূ,ে,ৈ,ো,ৌ,০-৯,0-9]#','',$fetchsql["Title"]);
								?>
								
								<img src="img/pdf.png" style="height:20px; width:20px;" />

								 <span  class="changetitle" style="font-size:12px;" > <?php echo $fetchsql["Title"];?></span> &nbsp;&nbsp;&nbsp;
								 
								 
								<a href="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" class="btn btn-sm btn-danger" download="<?php echo $fetchsql["Title"];?>"> <span class="glyphicon glyphicon-download-alt"></span></a>
								<br/>
								<br/>
								
								<object height="800" width="100%" data="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>"></object>
								
								
								
								<!--<embed src="other_img/<?php //echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" type="application/pdf"   height="700px" width="100%">-->
								<br/><br/>
								<?php } else if($fetchsql["Extension"] != ""  && $fetchsql["Description"] != "" ){
										
										$an=preg_replace('#[^a-z,A-Z,অ-ঔ,ক-ঁ,া,ি,ী,ু,ূ,ে,ৈ,ো,ৌ,০-৯,0-9]#','',$fetchsql["Title"]);			
								?>
								
								<?php if($fetchsql["Extension"] == "pdf"){ ?>
								<img src="img/pdf.png" style="height:20px; width:20px;" />
								 <?php } else {?>
								 <img src="img/picture.jpg" style="height:20px; width:20px;" />
								 <?php } ?>
								 <span  class="changetitle" style="font-size:12px;" > <?php echo $fetchsql["Title"];?></span>
								 	 
								<a  href="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" class="btn btn-sm btn-danger" download="<?php echo $fetchsql["Title"];?>"> <span class="glyphicon glyphicon-download-alt"></span></a>
								<br/>
								<br/>
								<?php if($fetchsql["Extension"] == "pdf"){ ?>
								
									<object height="800" width="100%" data="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>"></object>
									
									
								<!--<embed src="other_img/<?php //echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" type="application/pdf"   height="700px" width="100%">-->
								<br/>
								<br/>
								<p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetchsql["Description"];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p>
								
									 <?php } else { ?>
									 

									 	<iframe src="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" height="800" width="100%"></iframe>

							<table class="table table-bordered table-responsive">
								<tbody>
										
											
											
											<tr>
													<td><p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetchsql["Description"];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p></td>
											</tr>
											
											
								
										</tbody>
							</table>
									 <?php } ?>
								<br/><br/>
								<?php  }   else if($fetchsql["Extension"] != "pdf"  && $fetchsql["Description"] == ""){
									 ?>
									 <span style="float: right; margin:20px;">
									<a href="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" class="btn btn-sm btn-danger" download="<?php echo $fetchsql["Title"];?>"> <span class="glyphicon glyphicon-download-alt" style="margin:20px; float: right;"></span></a>
								</span>
									<br>

<p>
														<iframe src="other_img/<?php echo $fetchsql["ID"];?>.<?php echo $fetchsql["Extension"];?>" height="800" width="100%"></iframe></p>
										
									 <?php
									 } else if($fetchsql["Extension"] == "" && $fetchsql["Description"] != ""){ ?>
									 
									 
									 
									 			 
							<table class="table table-bordered table-responsive">
								<tbody>
											
											
											<tr>
													<td><p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetchsql["Description"];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p></td>
											</tr>
											
											
								
										</tbody>
							</table>
									 <?php }
									 		
									 ?>
									 
									 <?php } ?>
								
								
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
				</div>
				
		</div>

	
<style>
       #boxshadow {
        position: relative;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
      
        background: white;
}


</style>

<div class="col-md-12 col-xs-12 fontsize backgroundcol"  style="padding:0px ; margin:0px; margin-top:10px; padding-top:10px;" >

				<div class="col-md-6 col-xs-6" style="margin:0px;
				padding:0px; float:left; clear:right; text-align:left;">
						<span id="noticetitle"  style="color:#000000; font-size:20px; font-family:'Times New Roman', Times, serif; font-weight:300;">Notice</span>
				</div>
				
				<div class="col-md-6 col-xs-6" style="margin:0px;
					padding:0px; float:right; text-align:right; ">
							<img src="img/Printer-icon.png" id="boxshadow" style="height:20px; width:20px;" />
				</div>
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
				<table class="table table-bordered table-responsive">
						<tbody>
						
						<?php
						if($_GET["page"]=="noticeview"){
						$sql="SELECT COUNT(Notice_id) FROM `notice`";
						}else if($_GET["page"]=="officeorder"){
							
							$sql="SELECT COUNT(Notice_id) FROM `office_order`";
						}
						
	$result=$db->select_query($sql);
	if($result)
	{
		$row=$result->fetch_array();
	}
	$rows = $row[0];
	$page_rows = 20;
	$last = ceil($rows/$page_rows);
	if($last < 1)
	{
		$last = 1;
	}
	$pagenum = 1;
	if(isset($_GET["pn"]))
	{
		
		$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
	}
	if($pagenum < 1)
	{
			$pagenum = 1;
	}
	else if($pagenum > $last){
		$pagenum = $last;
		
	}
	$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
	
	if($_GET["page"]=="noticeview"){
	$sql1= "SELECT * FROM `notice` ORDER BY Notice_id DESC $limit";
	}else if($_GET["page"]=="officeorder"){
	$sql1= "SELECT * FROM `office_order` ORDER BY Notice_id DESC $limit";
	}
	$result1=$db->select_query($sql1);
	$textline1= "Commetee Members(<b>$rows</b>)";
	$textline2="Page<b>$pagenum</b>of<b>$last</b>";
	$pagenationCtrl = '';
	if($last != 1){
		
		if($pagenum > 1 )
		{
			$previous = $pagenum-1;
			$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$previous.'" >Previous</a> &nbsp;';
				for($i = $pagenum-4;$i < $pagenum; $i++){
					
					if($i > 0){
						
						$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					}
					
				}
		}
		
			for($i = $pagenum+1;$i <= $last; $i++){
					$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					if($i >= $pagenum+4){
						
						break;
					}
					
				}
				if($pagenum != $last)
				{
					$next=$pagenum+1;
					$pagenationCtrl.='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$next.'" >Next</a>';
				}
	}				
				
				
				
				
				
					
					$sl = 0;
					if($result1){
					while($fetch=$result1->fetch_object()){
					$an=preg_replace('#[^a-z,A-Z,অ-ঔ,ক-ঁ,া,ি,ী,ু,ূ,ে,ৈ,ো,ৌ,০-৯,0-9]#','',$fetch->Title);
					$sl++;
						?>
								 <tr>
									<td align="center"><?php echo $sl;?></td>
									
									<?php  if($_GET["page"]=="noticeview"){ ?>
									<td><a class="changetitle" href="?page=noticeview&noticeid=<?php echo $fetch->Notice_id;?>" style="text-decoration:none; color:#000000; font-family:'Times New Roman', Times, serif" id="titlecolor"><?php echo $fetch->Title;?></a></td>
									<?php } else {?>
										<td><a class="changetitle" href="?page=noticeview&orderid=<?php echo $fetch->Notice_id;?>" style="text-decoration:none; color:#000000; font-family:'Times New Roman', Times, serif" id="titlecolor"><?php echo $fetch->Title;?></a></td>
									<?php } ?>
									
									
									
									<td align="center"><?php echo $fetch->Date_time;?></td>
									<td align="center">

	<?php
											if($fetch->Extension!="")
											{
										?>
										<a href="other_img/<?php echo $fetch->Notice_id;?>.<?php echo $fetch->Extension;?>" download='<?php echo $fetch->Title;?>' target="_blank"><img src="img/pdf.png"/></a>
										<?php
									}
										?>


										</td>
								</tr>
								
						<?php } }?>
								
								
						</tbody>
				</table>
				
				
				<div style="margin:0px; padding:0px; text-align:center"><span>Total : <?php echo $rows;?></span></div>
				
				<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
							<span>Notices Archive</span>
								
								<br/>
								<br/>
								<!-- Go to www.addthis.com/dashboard to customize your tools --> Share with :<div class="addthis_inline_share_toolbox"></div>
				</div>
				
				<div class="center" style='text-align:center;'>
				<div class="pagination">
							<?php echo $pagenationCtrl;?>
				</div>
			</div>
		</div>
		
		
</div>


</div>

