<div class="col-md-9 col-xs-12" style="padding:0px ; margin:0px; margin-top:10px;">
											
											
											<!-- news tricker -->		
											<div class="content">
													<div class="simple-marquee-container" style="background: #fff;">
														<div class="marquee-sibling" >
															<span style="font-family:'Times New Roman', Times, serif;  padding:18px; background: rgb(61, 61, 61);">Notice</span>
														</div>
														<div class="marquee" >
															<ul class="marquee-content-items" style="background:#fff; padding-left:70px;" >
															
																 <?php
												 $select_notice="SELECT * FROM notice ORDER BY `Notice_id` DESC LIMIT 5";
												$chek_notice=$db->select_query($select_notice);
												if($chek_notice)
												{
												while($fetch_notice=$chek_notice->fetch_array())
												{
													
				?>
																<li style=" background: #fff;"><a href="?page=noticeview&noticeid=<?php echo $fetch_notice["Notice_id"] ?>"   style="font-family:'Times New Roman', Times, serif; color:#FF0000; font-size:16px;border-right:3px #ff0000 solid;"><?php   $strEvents= $fetch_notice["Title"];
																	 $sevents = $strEvents;
																	//$textEvents = substr($sevents, 0, strrpos($sevents, ' '));
																	print $sevents."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
														?>
																	
														</a></li>
																<?php }  } ?>
															
															</ul>
														</div>
													</div>
												</div>
												
													<!-- end news tricker -->
													
													
													
													<!-- notice board -->
													<div style="padding:0px ; margin:0px; margin-top:20px;" class="col-md-12 col-xs-12  well" id="grad">
															
															
															<div class="col-md-10 col-xs-12 col-md-offset-1" style="padding-top:30px; padding-bottom:20px;">
																<span style="color:#000000; font-size:18px; padding-left:10px;  font-family:'Times New Roman', Times, serif">Notice Board</span>
																
																		<ul class="noticeul">
																		
																 <?php
													$chek_notice=$db->select_query($select_notice);
												if($chek_notice)
												{
												while($fetch_notice=$chek_notice->fetch_array())
												{
													
				?>
													
			
															<li><a href="?page=noticeview&noticeid=<?php echo $fetch_notice["Notice_id"] ?>" style="font-size:16px;" ><i class="glyphicon glyphicon-certificate"></i>&nbsp;<?php                    $strEvents= $fetch_notice["Title"];
																	 $sevents = $strEvents;
																	//$textEvents = substr($sevents, 0, strrpos($sevents, ' '));
																	print $sevents;
														?></a></li>	<?php }  } ?>
																			
																		</ul>
																		
																	<div class="col-md-1 col-xs-1" style=" width:150px; text-align:center; float:right; margin-top:10px; height:25px; padding-top:2px;  background: -webkit-linear-gradient(top, #999999 , white);">
																			<a href="?page=allnotice" style="color:#000000; font-weight:400">ALL NOTICE</a>
																	</div>
															</div>	
																		
													</div>
													
														<!-- end notice board -->
														
														
											
											
												<div class="col-md-12 col-xs-12"  id="introduced" style="height: 35px;">
														<span style="font-weight: bold;; color: #fff; font-size: 18px;">Welcome to  <?php echo $fetcproject["institute_name"];?>.  </span>
															
												</div>
												
													<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
															<p style="text-align:justify; font-size:16px; line-height:25px; padding:10px; font-family:'Times New Roman', Times, serif;   ">
														 <?php  
														$string=$fetch_about[2];
														
														$a=array("\r\n", "\n", "\r");
														$replace='<br />';
														$about=str_replace($a, $replace, $string);
														print $about;
													  
													  
													  ?>
															</p>
													
													</div>
											
											<!--  mid div loop -->
											
												
											
												
														<div class="col-md-12 col-xs-12"  id="introduced" style="height: 35px;">
														<span style="font-weight: bold;; color: #fff; font-size: 18px;">Our Mission and Vision. </span>
															
												</div>
												

													<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
															<p style="text-align:justify; font-size:16px; line-height:25px; padding-top:10px; font-family:'Times New Roman', Times, serif">
															<?php  
		$stringmission=$fetch_mission_vission[2];
		
		$a=array("\r\n", "\n", "\r");
		$replace='<br />';
		$aboutmission=str_replace($a, $replace, $stringmission);
		print $aboutmission;
	  
	  
	  ?>
															</p>
													
													</div>
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">About Institute</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/order.jpg" style="height:100px"/>
																		</div>
																		
																		<div   class="col-md-9 col-xs-9"  class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=about"><i class="glyphicon glyphicon-play"></i> &nbsp; About Us</a></li>
																								<li><a  href="?page=mission"><i class="glyphicon glyphicon-play"></i>&nbsp; Mission and Vision</a></li>
																								<li><a  href="?page=history"><i class="glyphicon glyphicon-play"></i>&nbsp; History</a></li>
																								<li><a  href="?page=contact"><i class="glyphicon glyphicon-play"></i>&nbsp; Contact Us</a></li>
																								
																					</ul>
																		</div>
																		
													</div>
															
										

													
												
											<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Organization Information </span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/management-information-systems-52.jpg" style="height:100px"/>
																		</div>
																		
																		<div   class="col-md-9 col-xs-9"  class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=allnotice"><i class="glyphicon glyphicon-play"></i> &nbsp; Notice</a></li>
																								<li><a  href="?page=event"><i class="glyphicon glyphicon-play"></i>&nbsp; Events</a></li>
																								<li><a  href="?page=nevent"><i class="glyphicon glyphicon-play"></i>&nbsp;   National events</a></li>
																								<li><a  href="?page=officeorder"><i class="glyphicon glyphicon-play"></i>&nbsp; Office Order </a></li>
																								
																					</ul>
																		</div>
																		
													</div>
															
										

															
											</div>
											
											<!--  end mid div loop -->
											
											
											
											<!-- 3rd mid div loop -->
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
											
												
												
															
													
												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Admission</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/admission.png" style="height:100px"/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=admisionrule"><i class="glyphicon glyphicon-play"></i> &nbsp; Admission Rules</a></li>
																								<li><a  href="newadd/Registration/SignUp.php" target="_blank"><i class="glyphicon glyphicon-play"></i>&nbsp; Online Registration</a></li>
																								<li><a  href="Admission/Registration/signIN/signIn.php" target="_blank"><i class="glyphicon glyphicon-play"></i>&nbsp; Admint Card </a></li>
																								<li><a  href=""><i class="glyphicon glyphicon-play"></i>&nbsp;  Admission Results</a></li>
																								
																								




																					</ul>
																		</div>
																		
													</div>

											
											<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Result</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/karnataka-results.jpg" style="height:100px"/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="showResult.php" target="_blank"><i class="glyphicon glyphicon-play"></i> &nbsp; Internal Results</a></li>
																								<li><a  href="?page=public"><i class="glyphicon glyphicon-play"></i>&nbsp; Public Results</a></li>
																								<li><a  href="?page=scholership"><i class="glyphicon glyphicon-play"></i>&nbsp; Scholarship Results</a></li>
																								<li><a  href="?page=various"><i class="glyphicon glyphicon-play"></i>&nbsp; Various Test Result Info</a></li>
																					</ul>
																					







																		</div>
																		
													</div>
													
											
															
											</div>
											
											<!-- end 3rd mid div loop -->
											
											<!-- 2nd mid div loop -->
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
												
												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Teacher / Staff Information</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/teacher.png" style="height:100px"/>
																		</div>
																		 
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																							
																								<li><a  href="?page=teacherinfo&cls=teacher"><i class="glyphicon glyphicon-play"></i>&nbsp; Teacher Information</a></li>
																								<li><a  href=""><i class="glyphicon glyphicon-play"></i>&nbsp; Ex-teacher</a></li>
																								
																									<li><a  href="?page=staff&cls=staff"><i class="glyphicon glyphicon-play"></i>&nbsp; Staff Information</a></li>
																									<li><a  href="?page=zero"><i class="glyphicon glyphicon-play"></i> &nbsp;  Zero Designation Info</a></li>
																					</ul>
																					





																		</div>
																		
													</div>
								
											
												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Board of Directors
</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/boardofdirectors-icon.png" style="height:100px"/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=member&cls=all"><i class="glyphicon glyphicon-play"></i> &nbsp; Members Information</a></li>
																								<li><a  href="?page=doner&cls=General"><i class="glyphicon glyphicon-play"></i>&nbsp; Doner Members </a></li>
																								<li><a  href="?page=doner&cls=Long"><i class="glyphicon glyphicon-play"></i>&nbsp; Long Time Doner Members  </a></li>
																								<li><a  href="?page=gurdian&cld=all"><i class="glyphicon glyphicon-play"></i>&nbsp; Guardian and Teacher  Ass</a></li>
																							




																					</ul>
																		</div>
																		
													</div>
															

											
											
															

															
											</div>
											
											<!-- end 2nd mid div loop -->
												
												
												
												
											<!-- 4th mid div loop -->
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
											
											
												
												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Exam</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/exam-week-pencil-and-paper.jpg" style="height:100px; "/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=studenexam_record&ID=examrecord_id"><i class="glyphicon glyphicon-play"></i> &nbsp; Students' Test Record</a></li>
																								<li><a  href="?page=examniyomaboli&ID=examniyom_id"><i class="glyphicon glyphicon-play"></i>&nbsp; Exam Rules</a></li>
																								<li><a  href="?page=examroutine&ID=routine_id"><i class="glyphicon glyphicon-play"></i>&nbsp; Exam Routine </a></li>
																								<li><a  href="?page=examsuggesion&ID=suggesion_id"><i class="glyphicon glyphicon-play"></i>&nbsp; Exam Suggestions</a></li>
																								
																								








																					</ul>
																		</div>
																		
													</div>
															





											<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext"> Routine </span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/CENTER_SIGN_SCHEDULE.jpg" style="height:100px"/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=join"><i class="glyphicon glyphicon-play"></i> &nbsp; Joint Routine</a></li>
																								<li><a  href="?page=class"><i class="glyphicon glyphicon-play"></i>&nbsp; Class Based Routine</a></li>
																								<li><a  href="?page=teacher"><i class="glyphicon glyphicon-play"></i>&nbsp; Teacher Based Routine</a></li>
																								<li><a  href=""><i class="glyphicon glyphicon-play"></i>&nbsp;   Curriculum</a></li>
																								
																				




																					</ul>
																		</div>
																		
													</div>
															
											</div>
											
											<!-- end 4th mid div loop -->
												
													<!-- 5th mid div loop -->
											
											
											<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													
											
											
													<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Academic Information</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/academic-icons-pack_23-2147501134.jpg" style="height:100px; "/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=calendar"><i class="glyphicon glyphicon-play"></i> &nbsp; Academic Calendar</a></li>
																								<li><a  href="?page=uniform"><i class="glyphicon glyphicon-play"></i>&nbsp; Uniform Picture and Details</a></li>
																								<li><a  href="?page=fees"><i class="glyphicon glyphicon-play"></i>&nbsp; Fee's Details </a></li>
																								<li><a  href="?page=holiday"><i class="glyphicon glyphicon-play"></i>&nbsp; Holiday List</a></li>
																								
																								








																					</ul>
																		</div>
																		
													</div>
													
												
													
													
													

												<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Voluntary force</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/collaboration-512.png" style="height:100px"/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"  class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=scout"><i class="glyphicon glyphicon-play"></i> &nbsp; Scout</a></li>
																								<li><a  href="?page=BNCC"><i class="glyphicon glyphicon-play"></i>&nbsp; BNCC</a></li>
																								<li><a  href="?page=red"><i class="glyphicon glyphicon-play"></i>&nbsp; Red Cricent</a></li>
																								<li><a  href="?page=Cub"><i class="glyphicon glyphicon-play"></i>&nbsp; Cub</a></li>
																					</ul>
																		</div>
																		
													</div>

											
												
										





												
											
															
											</div>
											
											<!-- end 5th mid div loop -->
												
												
												
																<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
													

<div class="col-md-6 col-xs-12 well" id="bodyDiv">
																		
																		<div class="col-md-12 col-xs-12" style="0px; padding:0px; padding-bottom:5px;">	<span class="spantext">Other Link</span>	</div>
																	
																		<div class="col-md-3 col-xs-3" style="padding:0px; margin:0px; display:block">
																				<img src="img/link-page.jpg" style="height:100px; "/>
																		</div>
																		
																		<div  class="col-md-9 col-xs-9"   class="middivul">
																					<ul id="midul">
																					
																								<li><a  href="?page=Regulations"><i class="glyphicon glyphicon-play"></i> &nbsp; Rules and Regulation</a></li>
																								<li><a  href="?page=Hostel Information"><i class="glyphicon glyphicon-play"></i>&nbsp; Hostel Information</a></li>
																								<li><a  href="?page=Transport Information"><i class="glyphicon glyphicon-play"></i>&nbsp; Transport Information </a></li>
																								<li><a  href="?page=acchivement&ID=ID"><i class="glyphicon glyphicon-play"></i>&nbsp; Achievement</a></li>
																				</ul>
																		</div>
																		
													</div>
									
									</div>
												
											<!-- photo gallery -->

														<div class="col-md-12 col-xs-12" style="padding:0px; margin:0px;">
																

																<?php
								$selectVideo= "SELECT * FROM `video_gallery` where  sl='1'";
								$queryVideo=$db->select_query($selectVideo);
								if($queryVideo)
								{
									$fetchVideoLink = $queryVideo->fetch_array();
																?>
																	<iframe style="height:400px; width:100%;" src="<?php print $fetchVideoLink ['url']?>" frameborder="0" allow="autoplay; encrypted-media" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
									<?php
								}
								?>
											
														</div>
											<!--  end gallery -->
												
												
												</div>