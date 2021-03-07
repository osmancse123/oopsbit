
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

		
			
				
				
				
				
				
				
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
		<?php
		
				if($_GET["page"]=="about"){
		?>
					
					<span class="changetitle"  style="font-size:18px; color:black; font-family:'Times New Roman', Times, serif; font-weight: bold; font-size: 24px;">
						
						<?= $fetcproject['institute_name'];?>
					</span>
		
			<?php } else if($_GET["page"]== "litaryview") {
						
						
$slelit="SELECT * FROM literature_culture_education  where id ='".$_GET["litid"]."'";
	$resultit=$db->select_query($slelit);
	if($resultit){
	$fetchlit=$resultit->fetch_array();}
			?>
				<span class="changetitle"  style="font-size:18px; color:black; font-family:'Times New Roman', Times, serif"><?php echo $fetchlit['type'];?></span>
			
			<?php }?>
		</div>
		
				
		<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:5px;">
		
		
					<?php
		
				if($_GET["page"]=="about"){
		?>
			
			<img src="other_img/AbouSchool.jpg" class="img-responsive" style="max-height: 400px; max-width: 850px;" />


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
											
											<tr>
													<td>		<iframe src="<?php echo $fetcproject["google_map"];?>"  frameborder="0" style="border:0; width:100%; height:480px;" allowfullscreen></iframe></td>
											</tr>
								
								</tbody>
					</table>
					
					<?php } else if($_GET["page"]=="litaryview"){ ?>
					
					<table class="table table-bordered table-responsive">
								<tbody>
											<tr>
													<td><img src="other_img/<?php echo $fetchlit['id'];?>.jpg" style="height:250px; width:307px;" /></td>
											</tr>
											
											
											<tr>
													<td><p style="text-align:justify; font-family:'Times New Roman', Times, serif">
															 <?php  
														$string=$fetchlit[3];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
													</p></td>
											</tr>
											
											
								
								</tbody>
					</table>
					
					<?php }?>
				
								
								
								
								
								<!-- Go to www.addthis.com/dashboard to customize your tools --> share with : <div class="addthis_inline_share_toolbox"></div>
		</div>
		
		
</div>