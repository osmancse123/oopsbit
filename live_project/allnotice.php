﻿<div class="col-md-9 col-xs-12" style="padding:0px ; margin:0px; margin-top:10px; ">
						
							<div class="col-md-4 col-xs-12" id="noticetopdiv" style="margin-top:2px">
									
										<span>Text Size</span>
									
										&nbsp;&nbsp;&nbsp;&nbsp; <a  style="text-decoration:none; cursor:pointer" onclick="fontsize16()"><span style="font-size:14px">A</span></a>
										
									    &nbsp;&nbsp;<a style="text-decoration:none; cursor:pointer" onclick="fontsize18()">	<span style="font-size:18px">A</span></a>
										
										&nbsp;&nbsp;<a  style="text-decoration:none; cursor:pointer" onclick="fontsize20()"> <span style="font-size:20px">A</span></a>
							</div>
							
							<div class="col-md-4 col-xs-12" id="noticetopdiv" style="margin-top:2px;">
							
							
							
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
						if($_GET["page"]=="allnotice"){
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
	
	if($_GET["page"]=="allnotice"){
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
									
									<?php  if($_GET["page"]=="allnotice"){ ?>
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

