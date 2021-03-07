<?php
@session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
  global $student_acadamic_information_std_details;
  global $insert_fee_studnt;
	$db = new database();
	
 
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">

		
		
		
	function ShowAllsTd(){
	
	
		var session = $('#Session').val();
		var className = $('#className').val();
		var from = parseInt($('#from').val());
		var to = parseInt($('#to').val());
		
		var year = $('#year').val();
		var total =from+to;
		var autoIDdd = "dddddddd";
		
		if(to <= 10){
			
			if(session != "" && to != "" ){
				if(from >=0){
				$.ajax({
				url : "ajaxForaddFee.php",
				data : {session:session,className:className,to:to,from:from,autoIDdd:autoIDdd,year:year},
				type : "POST",
				success:function(data){
					
					$('#ShowMiddleTable').html(data);
					$('#showMsg').html("");
					
				}
			});
			}
			else{
				$('#showMsg').html("<strong><span class='text-danger'>Please Fill Up All Fields...!!</span></strong>");
			return false;
			}
			}
			else 
			{
			$('#showMsg').html("<strong><span class='text-danger'>Please Fill Up All Fields...!!</span></strong>");
			return false;
			}
			
			
		}else {
		
			$('#showMsg').html("<strong><span class='text-danger'>Limit should be 10...!!</span></strong>");
			$('#ShowMiddleTable').html('');
			return false;
		}
		
		
	}
	
		function check_all(){
		if($('#chkbx_all').is(':checked')){
				 		$('.check_elmnt').prop('checked', true);
						$('.feechck').prop('disabled', false);
				 }else {
						 $('.feechck').prop('disabled', true);
						$('.check_elmnt').prop('checked', false);
				 }
	}
	
	
	
	/*function byroollcheked(getid){
		if($('#chek-'+getid).is(':checked')){
						$('#disableId-'+getid).prop('disabled', false);
				 }else {
						 $('#disableId-'+getid).prop('disabled', true);
						
				 }
	}*/
	
	


		function Submit(){
								

				var fromData =$('.addfee').serialize();
				var from = parseInt($('#from').val());
				var to = parseInt($('#to').val());
			
				var total =from+to;
				
				var inserttotal = "ddd";
				$.ajax({
				url : "ajaxForaddFee.php",
				data : fromData,
				type : "POST",
				success:function(data){
					$('#smsforR').html(data);
					
				}
			});
		}

    </script>
	
	 <style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 180px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
  margin-left:13px;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;

  .ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;

    &.ui-state-hover, &.ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
    }
  }
}
 </style>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addfee">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="frspage">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td  bgcolor="#f4f4f4"   class="warning" colspan="6"  bgcolor="#dddddd"     align="center"><span style="font-size:22px; color:#333; display:block;">Multiple Add Fee in Student's Account</span>  </td>

  			</tr>
			<tr>
			
				<td colspan="6">
					<div class="col-md-4"><select name="className" onChange="return chekGroup()" class="form-control" required id="className"   style="width:280px; border-radius:0px;">
						<option>Select Class</option>
						<?php 
								$select_section = "SELECT * FROM `add_class`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php }  } ?>
					
						
					</select></div>
					<div class="col-md-1"></div>
					<div class="col-md-5"><select class="form-control" id="Session" name="Session" style="width:280px; border-radius:0px;">
                        <option>Select Session</option>
							  <?php 
								$sessionsql = "SELECT `session2` FROM `student_acadamic_information` GROUP BY `student_acadamic_information`.`session2` ORDER BY `student_acadamic_information`.`session2` DESC";

								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str >5){
						?>
								
								<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?>
								
								<?php
											$sessionsql = "SELECT `session2` FROM `student_acadamic_information` GROUP BY `student_acadamic_information`.`session2` ORDER BY `student_acadamic_information`.`session2` DESC";
								$result = $db->select_query($sessionsql);
									if($result > 0){
										
										while($fetchsession = $result->fetch_array()){
										$str = strlen($fetchsession[0]);
											if($str ==4){
								?>
																<option><?php print $fetchsession[0];?></option>
								<?php   } } } ?>
								</select>
					</div>
					<div class="col-md-2"><input type="text" value="<?php echo date('Y')?>"  style="width:120px; border-radius:0px;" class="form-control" name="year" id="year"></input></div>
				</td>
			</tr>
  	<tr>
				<td align="center" colspan="6"> <input type="text"  name="from" id="from"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:33px;  text-align:center;"  ">
-
<label for="to" class="text-warning">To Limit No - </label>
<input type="text" name="to" id="to"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:33px;  text-align:center;" /> &nbsp; <input type="button" name="show" value="Show" onclick="return ShowAllsTd()" class="btn btn-primary" style="width: 150px;"><br/>&nbsp; <span id="showMsg"></span>  &nbsp; </td>
				
			</tr>
		
		
		
		
		<tr>
				<td colspan="6" id="ShowMiddleTable"></td>
		</tr>
		<tr>
				<td colspan="6" id="sms" align="right"></td>
		</tr>
       
   
          
         
    
        
        
       
</table>
</div>
<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="showfeeslist">
</div>


	</form>
  
   
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>