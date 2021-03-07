<?php

	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
	if(isset($_POST["moredata"]))		
	{
		 $seeTHisdayPresent="SELECT * FROM `struff_present` WHERE `date`='".$_POST["daterunning"]."'";
			$resultpresetnt=$db->select_query($seeTHisdayPresent);
					@$countrows=$resultpresetnt->num_rows;
				if($countrows>0){
						print "<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Today's attendance was completed !!</strong></span>";
				}	
				else{
			if(!empty($_POST["linkID"])){
					for($x = 0;$x<count($_POST["linkID"]) ; $x++){
							 $insertQUery="INSERT INTO `struff_present` (`slNo`,`date`,`StruffID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`) VALUES ('0','".$_POST["daterunning"]."','".$_POST["linkID"][$x]."','1','0','0','".$_POST["attnTime"][$x]."','".$_POST["leavTime"][$x]."')";
							$db->insert_query($insertQUery);
					}
			}
			if(!empty($_POST["approved"])){
					for($z = 0;$z<count($_POST["approved"]) ; $z++){
							$insertQUery="INSERT INTO `struff_present` (`slNo`,`date`,`StruffID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`) VALUES ('0','".$_POST["daterunning"]."','".$_POST["approved"][$z]."','0','0','1','0:00','0:00')";
							$db->insert_query($insertQUery);
					}
			}
			if(!empty($_POST["unapproved"])){
				for($c = 0;$c<count($_POST["unapproved"]) ; $c++){
							 $insertQUery="INSERT INTO `struff_present` (`slNo`,`date`,`StruffID`,`present`,`absent`,`onvacation`,`comming_time`,`goingTime`) VALUES ('0','".$_POST["daterunning"]."','".$_POST["unapproved"][$c]."','0','1','0','0:00','0:00')";
							$db->insert_query($insertQUery);
					}
			}
			if(isset($db->sms)){
				echo $db->sms;
			}
			}
	}
	
	if(isset($_POST["updateValue"])){
	
		if(!empty($_POST["linkID"])){
					for($x = 0;$x<count($_POST["linkID"]) ; $x++){
							 $insertQUery="UPDATE `struff_present` SET `present`='1',`onvacation`='0',`absent`='0',`comming_time`='".$_POST["attnTime"][$x]."',`goingTime`='".$_POST["leavTime"][$x]."' WHERE `date`='".$_POST["daterunning"]."' AND `StruffID`='".$_POST["linkID"][$x]."'";
							
							$db->update_query($insertQUery);
					}
			}
			if(!empty($_POST["approved"])){
					for($z = 0;$z<count($_POST["approved"]) ; $z++){
							$insertQUery="UPDATE `struff_present` SET `present`='0',`onvacation`='1',`absent`='0',`comming_time`='0:00',`goingTime`='0:00' WHERE `date`='".$_POST["daterunning"]."' AND `StruffID`='".$_POST["approved"][$z]."'";
							$db->update_query($insertQUery);
					}
			}
			if(!empty($_POST["unapproved"])){
				for($c = 0;$c<count($_POST["unapproved"]) ; $c++){
							 $insertQUery="UPDATE `struff_present` SET `present`='0',`onvacation`='0',`absent`='1',`comming_time`='0:00',`goingTime`='0:00' WHERE `date`='".$_POST["daterunning"]."' AND `StruffID`='".$_POST["unapproved"][$c]."'";
							$db->update_query($insertQUery);
					}
			}
			if(isset($db->sms)){
				echo $db->sms;
			}
	}
	
?>