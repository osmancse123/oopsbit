
												
<?php
	$foundername="SELECT * FROM `founder_message`";
	$resultname=$db->select_query($foundername);
	if($resultname){
	$fetfoundername=$resultname->fetch_array();
	}

	$premsg="SELECT * FROM presedent_info ";
	$resupre=$db->select_query($premsg);
	if($resupre)
	{
	$fetchpre=$resupre->fetch_array();
	}


	$headmsg="SELECT * FROM message_from_head_teacher ";
	$resulthead=$db->select_query($headmsg);
	if($resulthead)
	{
		$fetchhead=$resulthead->fetch_array();
	}

	$founder_message="SELECT * FROM founder_message ";
	$resultFounder=$db->select_query($founder_message);
	if($resultFounder)
	{
		$fetchFounder=$resultFounder->fetch_array();
	}


?>

													<!-- right section -->
															<div class="col-md-3 col-xs-12 print" style=" border: 1px  #ccc solid; ">
																		
																		
																		<!-- 	<section>
																			
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Message From M.P  </span>
																			</div>
																			
																			<div class="col-md-8 col-xs-8" style="margin:0px; padding:0px; padding-top:10px;">
																						<img src="other_img/founder.jpg" style="height:180px; width:100%;" class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3" />
																						
																			</div>



																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; padding-top:10px;">
																					<span style="font-size:16px; display:block; text-align:center"><b><?=  $fetfoundername["name"];?></b></span>
																			</div>
																			
																			
																			<div class="col-md-6 col-xs-6" style=" width:100%; text-align:center; float:right; margin-top:10px; height:25px; padding-top:2px;  background: -webkit-linear-gradient(top, #999999 , white);">
																						<a  href="?page=FS" id="details">&nbsp;Details</a>
																			</div>
																		</section>
																		 -->
																		
																		
																		<section>
																			
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Message From Founder </span>
																			</div>
																			
																			
																			<div class="col-md-8 col-xs-8" style="margin:0px; padding:0px; padding-top:10px; text-align:center">
																						<img src="other_img/founder.jpg" style="height:180px; width:100%;" class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3" />
																						
																			</div>
																			
																				
																	
																			
																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; padding-top:10px;">
														<span style="font-size:16px;  text-align:center; display:block"><b><?=  
														$fetchFounder["name"];?> </b></span>
																			</div>
																			
																			
																			<div class="col-md-6 col-xs-6" style="width:100%; text-align:center;  margin-top:10px; height:25px; padding-top:2px;  background: -webkit-linear-gradient(top, #999999 , white);">
																						<a  href="?page=founder_message" id="details">Message</a>
																			</div>
																			
																		</section>




																			<section>
																			
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Message From President </span>
																			</div>
																			
																			
																			<div class="col-md-8 col-xs-8" style="margin:0px; padding:0px; padding-top:10px; text-align:center">
																						<img src="other_img/Prasidenimg.jpg" style="height:180px; width:100%;" class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3" />
																						
																			</div>
																			
																				
																	
																			
																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; padding-top:10px;">
																					<span style="font-size:16px;  text-align:center; display:block"><b><?=  $fetchpre["name"];?> </b></span>
																			</div>
																			
																			
																			<div class="col-md-6 col-xs-6" style="width:100%; text-align:center;  margin-top:10px; height:25px; padding-top:2px;  background: -webkit-linear-gradient(top, #999999 , white);">
																						<a  href="?page=PS" id="details">Message</a>
																			</div>
																			
																		</section>





																		<section>
																			<div class="col-md-12 col-xs-12"  id="introduced" style="margin-top: 5px;">
																					<span>Message From Headmaster</span>
																			</div>
																			<div class="col-md-8 col-xs-8" style="margin:0px; padding:0px; padding-top:10px;">
																						<img src="other_img/<?php echo "Principle" ?>.jpg" style="height:180px; width:100%"  class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3"/>
																						
																			</div>
																	
																			
																			
																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; padding-top:10px;">
																					<span style="font-size:16px;  display:block; text-align:center"><b>

																				<?=  $fetchhead["Teacher_name"];?>

																					 </b></span>
																			</div>
																			
																			
																			<div class="col-md-6 col-xs-6" style=" width:100%; text-align:center; float:right; margin-top:10px; height:25px; padding-top:2px;  background: -webkit-linear-gradient(top, #999999 , white);">
																						<a  href="?page=head" id="details">&nbsp;Message</a>
																			</div>
																			
																			
																			
																			
																		</section>
																		
																		
																		<!--<section>
																			<div class="col-md-12 col-xs-12"   id="introduced">
																					<span>Message From Vice Principal  </span>
																			</div>
																			
																			<div class="col-md-6 col-xs-6" style="margin:0px; padding:0px; padding-top:10px;">
																						<img src="other_img/<?php echo "vicePrinciple" ?>.jpg"  style="height:100px; width:100%" />
																						
																			</div>
																			
																			<div class="col-md-6 col-xs-6" style="margin:0px; ; padding-top:10px;">
																						<a  href="?page=vp" id="details">&nbsp;Details</a>
																			</div>
																		</section>-->
																		
																		
																			
																	
																		
																			<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span> Internal Service</span>
																			</div>
																		
																			<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=contact"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Contact Us</a></li>
																						</ul>
																			</div>
																				<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																			
																		</section>
																		
																		
																			<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Organization information</span>
																			</div>
																		
																		>
																			
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=curiculam"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Curriculum</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=event"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Events</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																					<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=nevent"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; National events</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																				
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=library"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Library information</a></li>
																						</ul>
																				</div>
																				
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=sport"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Sports</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=Literary practices"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Literary Practices</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=Cultural practices"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Cultural practices</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=Study tour"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Study tour</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																				
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=prokoshona&ID=prokoshona_id"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Publication</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																				
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=Girls"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Girls Guide</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																				
																				<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=photo"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Photo Gallery</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				
																							<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="?page=video"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; Video Gallery</a></li>
																						</ul>
																				</div>
																					<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>		
																					
																				
																			
																		</section>
																		
																		
																		
																			<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Important Link's</span>
																			</div>
																		
																		<?php
																		
																				$selectlinke = "SELECT * FROM `usefull_link` ORDER BY `id` ASC";
																				$resullink = $db->select_query($selectlinke);
																					if($resullink){
																							while($fetch_link = $resullink->fetch_array()){
																							
																				
																		?>
																		
																			<div class="col-md-12 col-xs-12"  id="rightblock">
																						
																						<ul>
																							<li><a href="<?php echo $fetch_link["url"];?>" target="_blank"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; <?php echo $fetch_link["title"];?></a></li>
																					</ul>
																			</div>
																			<div class="col-md-12 col-xs-12"  id="tophr">
																				</div>
																				<?php 			}
																					}?>
																		
																				
																				
																				
																				
																				
																		</section>
																		
																		
																		<section>
																			<div class="col-md-12 col-xs-12"  id="alllink">
																					<a href="">All Link's</a>
																			</div>
																		</section>
																		<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<a href="">Facilitate service</a>
																			</div>
																		</section>
																		<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Innovation Corner</span>
																			</div>
																		</section>
																		<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Social Link</span>
																			</div>
																			
																			
																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px;">
																					   
 
    <ul class="social-icons">
        <li><a href="<?php echo $fetcproject["facebook_page"];?>" target="_blank"  class="social-icon"> <i class="fa fa-facebook face"></i></a></li>
        <li><a href="<?php echo $fetcproject["twitter_page"];?>" target="_blank" class="social-icon"> <i class="fa fa-twitter twitter"></i></a></li>
       
        <li><a href="#" target="_blank" class="social-icon"> <i class="fa fa-youtube youtube"></i></a></li>
        <li><a  href="#" target="_blank" class="social-icon"> <i class="fa fa-instagram instagram"></i></a></li>
        <li><a href="<?php echo $fetcproject["google_plus"];?>" target="_blank" class="social-icon"> <i class="fa fa-google-plus plus"></i></a></li>
    </ul>

																			</div>
																	
																			</section>
																			
																			
																					<section>
																			<div class="col-md-12 col-xs-12"  id="introduced">
																					<span>Map</span>
																			</div>
																			
																			
																			<div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; margin-top:10px;">
																					   
 																		
																				<iframe src='<?php echo $fetcproject["google_map"];?>'  frameborder="0" style="border:0; width:100%; height:250px;" allowfullscreen></iframe>			
																						
																							
																			</div>
																	
																			</section>
																		
																		
																		
															</div>
															
												<!-- end right section -->