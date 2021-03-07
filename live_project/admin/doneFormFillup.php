<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Accordion with CSS3" />
        <meta name="keywords" content="accordion, css3, sibling selector, radio buttons, input, pseudo class" />
        <meta name="author" content="Codrops" />
        
        <link rel="stylesheet" type="text/css" href="../css/demo.css" />
        <link rel="stylesheet" type="text/css" href="../css/styleee.css" />
		<script type="text/javascript" src="../js/modernizr.custom.29473.js"></script>
		<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>

	
	</head>
	
    <body id="showClgp">
        <div class="container" >
			<section class="ac-container" >
				<?php
						$sql ='SELECT `add_class`.`class_name`,`running_student_info`.* FROM `running_student_info` INNER JOIN `add_class` ON 
	`add_class`.`id`=`running_student_info`.`class_id` GROUP BY `running_student_info`.`class_id` ORDER BY `running_student_info`.`class_id` ASC';

					$result=$db->select_query($sql);
					if($result){
					$a=0;
					while($fetch=$result->fetch_array()){
					
					//print_r($fetch);
				$a++;
				?>
				
				<div>
					<input id="ac-<?php echo $fetch[0];?>" name="accordion-<?php echo $fetch[0];?>" type="checkbox" />
					<label for="ac-<?php echo $fetch[0];?>"><?php echo $fetch[0]; ?></label>
					
						<?php 
							 	$sql32="SELECT `running_student_info`.*,`add_group`.`group_name` FROM `running_student_info` INNER JOIN `add_group` 
ON `add_group`.`id`=`running_student_info`.`group_id` WHERE `running_student_info`.`class_id`='".$fetch[2]."'  GROUP BY `running_student_info`.`group_id`";
								$result1 = $db->select_query($sql32);
								$row = $result1->num_rows;
								//$height = $row * 40;
								$l = '';
								if($row == 1 ){
									$l='small';
								} 
								if($row == 2)
								{
								$l='medium';
								}
								if($row == 3) {
									$l='large';
								}
								if($row == 4) {
									$l='extraLarge';
								}
								if($row == 5) {
									$l='EXXlarge';
								}
								if($row == 6) {
									$l='EXXXlarge';
								}
								if($row == 7) {
									$l='EXXXXlarge';
								}
								$a = 0;
								if($result1){?><article class="ac-<?php echo $l;?>"><ul>
							<?php	while($fetch1=$result1->fetch_array()){
							$a++;
									 
									
						?>
						
						
								<a target="_blank" href="showDetailsRun.php?clID=<?php echo $fetch1[1]?>&grID=<?php echo $fetch1[3];?>" onClick="return GEtId(<?php echo $a;?>)"><li style="padding-left:50px;">
									<?php echo $fetch1[7]; ?>
									
								</li></a>
						
						
						<?php }?></ul></article><?php } ?>
				</div>
				<?php } } ?>
			</section>
        </div>
	
</body>
<span id="showData"></span>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

	

	