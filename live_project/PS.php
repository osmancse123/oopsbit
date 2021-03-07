		
<?php
	$select_message="SELECT * FROM presedent_info ";
	$result_msg=$db->select_query($select_message);
	if($result_msg)
	{
	$fetch_message=$result_msg->fetch_array();
	
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
				padding:0px; text-align:right; padding-top:20px;">
						<span id="noticetitle"  style="color:#000000; font-size:12px; font-family:'Times New Roman', Times, serif; font-weight:300;">End-time: 15 Dec 2017</span>
				</div>
				
				<div class="col-md-12 col-xs-12"  style="width:100%; border-bottom:1px #E4E4E4 solid; margin-top:10px;">
								
						
				</div>
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
				
				
								
								<span class="changetitle" style="font-size:22px; font-family:'Times New Roman', Times, serif">Message From   President</span><br/>
								
								
								<img src="other_img/Prasidenimg.jpg"   style="height:220px; width:220px;margin-top:15px;" />
							
							<!--	
								<div class="col-md-12 col-xs-12" style="text-align:center; padding-top:5px; font-size:18px; font-family:'Times New Roman', Times, serif; font-weight:bold; text-decoration:underline;margin:0px; padding:0px;">
													<span class="changetitle">
													President <?php //echo $fetch_message[1];?> - of
													<br/>
													Short statement
													</span>
								
								</div>-->
								
								<div  class="col-md-12 col-xs-12" style="margin:0px; padding:0px; padding-top:5px;">
										<p class="changetitle" style="text-align:justify;font-size:16px; line-height:25px; font-family:'Times New Roman', Times, serif">
											<?php  
	
	$string=$fetch_message['details'];
		
		$a=array("\r\n", "\n", "\r");
		$replace='<br />';
		$about=str_replace($a, $replace, $string);
		print $about;
	  
	  
	  ?>
										</p>
								</div>
								
								
								<br/><br/>
								
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
				
				
		</div>
		
		
</div>