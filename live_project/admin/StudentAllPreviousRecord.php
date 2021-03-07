
<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{      require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");

    $db = new database();
	
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
        
     <link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
    <link rel="stylesheet" href="textEdit/redactor/redactor.css" />
    <script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
    <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
    $(document).ready(
        function()
        {
            $('#redactor').redactor();
        }
    );
    
    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}

    	function confirm_delete()
    	{
    		$confirm_click=confirm('Are You Confirm Delete');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
          $(document).ready(function () {
                    
                    $('#example1').datepicker({
                        format: "dd/mm/yyyy"
                    });  
                
                });

 function checkforText()
    {
        if (document.getElementById("forText").checked == true)
        {
            //alert("aa");
            document.notice.descreption.disabled=false;
            document.notice.file.disabled=true;
    

        }
        else
        {
            //alert("bb");
            document.notice.descreption.disabled=true;
            document.notice.file.disabled=true;
    

        }
    }   
    
    function checkforboth()
    {
        if (document.getElementById("both").checked == true )
        {
        //alert("aa");
            document.notice.descreption.disabled=false;
            document.notice.file.disabled=false;
        }
    }

    function checkforFile()
    {
        if (document.getElementById("forFile").checked)
        {
        //alert("aa");
            document.notice.file.disabled=false;
            document.notice.descreption.disabled=true;  

        }
        else
        {
            //alert("bb");
            document.notice.file.disabled=true;
            document.notice.descreption.disabled=true;
            //document.routine.notice_details.disabled=true;

        }
    }
	
	$(document).ready(function(){
	$('#stdId').keyup(function(){
		var iddd = $(this).val();
		//alert(iddd);
		var foradmit = "dd";
		if(iddd != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {iddd:iddd,foradmit:foradmit},
				type : "POST",
				success:function(data){
					$('#idlist').fadeIn();
					$('#idlist').html(data);
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#stdId').val($(this).text());
			$('#idlist').fadeOut();
			showIdby();
		});
});

function showIdby(){
  var CsslassId = "ddddddd";
  var stdId = 	$('#stdId').val();
  //alert(stdId);
		$.ajax({
				url:"shwoResultForOldrecord.php",
				type:"POST",
				data:{CsslassId:CsslassId,stdId:stdId},
				cache:false,
				success:function(data){
					//alert(data);
					$('#showdata').html(data);
					
					
				
					
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
  min-width: 410px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
  font-size:14px;
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
    <form name="notice" action="" method="post"  enctype="multipart/form-data" class="form-horizontal" >
	
		<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
              <table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
                            <tr>
                <td  class="warning" colspan="3" align="center"><span style="font-size:22px; color:#333; display:block;">
Student's Previous Records </span> </td>
            </tr>
			
              <tr>
                <td  class="warning" colspan="3" align="center"><div class="col-md-8">
								<input type="text" autocomplete="off" name="stdId" class="form-control" id="stdId" placeholder='Student ID'/>
								<div id="idlist" class="ui-autocomplete" style="text-align:left"></div>
                </div> </td>
            </tr>			
			</table>
			</div>	
			
			<span id="showdata"></span>
	</form>
	  </body>
    </html>
		    					<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
