<?php
		if(isset($_GET["curid"])){
				$sql = "SELECT * FROM `cariculam` WHERE `Id`='".$_GET["curid"]."'";
		}
		
		
		if(isset($_GET["eventid"])){
				$sql = "SELECT * FROM `event` WHERE `Event_id`='".$_GET["eventid"]."'";
		}
	
		if(isset($_GET["neventid"])){
				$sql = "SELECT * FROM `national_event` WHERE `Event_id`='".$_GET["neventid"]."'";
		}
	
		
		$resultsql = $db->select_query($sql);
			if($resultsql->num_rows > 0){
						$fetchsql = $resultsql->fetch_array();
						//print_r($fetchsql);
			}
	
?>

<div class="col-md-9 col-xs-12" style="padding:0px ; margin:0px; margin-top:10px; ">
						
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
					padding:0px;  text-align:left; ">
							<img src="img/Printer-icon.png" id="boxshadow" style="height:20px; width:20px;" />
				</div>
				
				
				
					
				<div class="col-md-6 col-xs-6" style="margin:0px;
				padding:0px; text-align:right; padding-top:20px;"> End Time: 15 Dec 2017</span>
				</div>
				
				<div class="col-md-12 col-xs-12"  style="width:100%; border-bottom:1px #E4E4E4 solid; margin-top:10px;">
				
				</div>
				
				
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
				
				
				
				<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
							
								
								
							<?php
									if($_GET["curid"]){ ?>
									<span   class="changetitle"   style="font-size:18px;" ><?php echo $fetchsql["Tite"];?></sapn><br/>
									<?php
										if($fetchsql["Extension"] == "pdf" ){
								?>
								
								
								<img src="img/pdf.png" style="height:20px; width:20px;" />
								 <span  class="changetitle" style="font-size:12px;" > <?php echo $fetchsql["Tite"];?></span>
								<br/>
								<br/>
								<embed src="other_img/<?php echo $fetchsql["Id"];?>.<?php echo $fetchsql["Extension"];?>" type="application/pdf"   height="700px" width="100%">
								<br/><br/>
								<?php } else { ?>
									 
							<table class="table table-bordered table-responsive">
								<tbody>
											<tr>
													<td><img src="other_img/<?php echo $fetchsql["Id"];?>.<?php echo $fetchsql["Extension"];?>" style="height:250px; width:307px;" /></td>
											</tr>
											
											
											
								
										</tbody>
							</table>
									 <?php } } else if($_GET["eventid"]){  ?>
									  <span   class="changetitle"  style="font-size:18px;" ><?php echo $fetchsql["Title"];?></sapn><br/>
									 <?php
									 
									 	if($fetchsql["Extension"] == "pdf" && $fetchsql["Description"] == ""){
									 ?>
									
									 	<img src="img/pdf.png" style="height:20px; width:20px;" />
								 <span  class="changetitle" style="font-size:12px;" > <?php echo $fetchsql["Title"];?></span>
								<br/>
								<br/>
								<embed src="other_img/<?php echo $fetchsql["Event_id"];?>.<?php echo $fetchsql["Extension"];?>" type="application/pdf"   height="700px" width="100%">
								<br/><br/>
									 
									 <?php
									} else if($fetchsql["Extension"] != ""  && $fetchsql["Description"] != "" ){  ?> 
									
									<?php if($fetchsql["Extension"] == "pdf"){ ?>
								<img src="img/pdf.png" style="height:20px; width:20px;" />
								 <?php } else {?>
								 <img src="img/picture.jpg" style="height:20px; width:20px;" />
								 <?php } ?>
								 <span  class="changetitle" style="font-size:12px;" > <?php echo $fetchsql["Title"];?></span>
								<br/>
								<br/>
								
							
								<?php if($fetchsql["Extension"] == "pdf"){ ?>
								<embed src="other_img/<?php echo $fetchsql["Event_id"];?>.<?php echo $fetchsql["Extension"];?>" type="application/pdf"   height="700px" width="100%">
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
									 
							<table class="table table-bordered table-responsive">
								<tbody>
											<tr>
													<td><img src="other_img/<?php echo $fetchsql["Event_id"];?>.<?php echo $fetchsql["Extension"];?>" style="height:250px; width:307px;" /></td>
											</tr>
											
											
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
									 
									 <?php } else if($fetchsql["Extension"] != "pdf"  && $fetchsql["Description"] == ""){
									 ?>
									 <table class="table table-bordered table-responsive">
								<tbody>
											<tr>
													<td><img src="other_img/<?php echo $fetchsql["Event_id"];?>.<?php echo $fetchsql["Extension"];?>" style="height:250px; width:307px;" /></td>
											</tr>
										</tbody>
							</table>
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
									 
									 
									 <?php } else if($_GET["neventid"]){
									 ?>
									 <span   class="changetitle"   style="font-size:18px;" ><?php echo $fetchsql["Title"];?></sapn><br/>
									<table class="table table-bordered table-responsive">
								<tbody>
								
										<?php
										
												 $path = "other_img/$fetchsql[Event_id].jpg";
													if(file_exists($path)){
										?>
											<tr>
													<td><img src="other_img/<?php echo $fetchsql["Event_id"];?>.jpg" style="height:250px; width:307px;" /></td>
											</tr>
											
											<?php } ?>
											
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
									 <?php  } ?>
							
								
								
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
				</div>
				
		</div>
		
		
</div>