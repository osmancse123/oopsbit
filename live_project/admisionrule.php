<?php

$select_about="SELECT * FROM admission_info";
	$result_about=$db->select_query($select_about);
	if($result_about){
	$fetch_about=$result_about->fetch_array();}
	
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
				padding:0px; text-align:right; padding-top:20px;">
						<span id="noticetitle"  style="color:#000000; font-size:12px; font-family:'Times New Roman', Times, serif; font-weight:300;"> End-time: 15 Dec 2017</span>
				</div>
				
				<div class="col-md-12 col-xs-12"  style="width:100%; border-bottom:1px #E4E4E4 solid; margin-top:10px;">
				
				</div>
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
					
					<span class="changetitle"  style="font-size:18px; color:black; font-family:'Times New Roman', Times, serif">Admission Rules</span>
		</div>
		
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
					
					<table class="table table-bordered table-responsive">
								<tbody>
											
											
											
											<tr>
													<td><p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetch_about[2];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p></td>
											</tr>
											
											
								
								</tbody>
					</table>
					
				
								
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
		</div>
		
		
</div>