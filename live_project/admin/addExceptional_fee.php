
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exceptional Fee</title>

    <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">


<script type="text/javascript">


function enableDisable(getId) {



         if($('#'+getId).is(':checked')){

           // alert(getId);

            $("#amount-"+getId).prop('disabled', false);
 
            
         }else {

            $("#amount-"+getId).prop('disabled', true);
        
            
         }
        

         
   }


function showIdby(){

var id =$('#stdId').val();
var ClassId=$('#className').val();
var year=$('#year').val();       
var stdinfo="studentInfo";
$('#viewInformation').html('');
if(id > 2){



     $.ajax({
          
                    type: "POST",
                    url: "ajxexceptionalFee.php",
                    data: {stdinfo:stdinfo,id:id,ClassId:ClassId,year:year},
                    cache: false,
                    success: function(data) {

                        
                        $("#viewInformation").html(data);
                       
            
            }
            
          
          
             });
  
    }
}

function viewFee()
{


var id =$('#stdId').val();
var ClassId=$('#className').val();
var year=$('#year').val();       
var viewFee="viewFee";
$('#viewInformation').html('');

if(id > 2){



     $.ajax({
          
                    type: "POST",
                    url: "ajxexceptionalFee.php",
                    data: {viewFee:viewFee,id:id,ClassId:ClassId,year:year},
                    cache: false,
                    success: function(data) {

                        
                        $("#viewInformation").html(data);
                       
            
            }
            
          
          
             });
  
    }

}

function deleteFee(id){

   
    var feeId=id;
   var stdID=$('#stdId').val();
 
var deleteFee="deleteFee";
$('#msg').html('');
if(stdID >2){



     $.ajax({
          
                    type: "POST",
                    url: "ajxexceptionalFee.php",
                    data: {deleteFee:deleteFee,feeId:feeId,stdID:stdID},
                    cache: false,
                
                    success: function(data) {

                        
                        $("#msg").html(data);
                        viewFee();
                       
            
            }
            
          
          
             });
  
    }

}

function addFe(){

var id =$('#stdId').val();
var ClassId=$('#className').val();    
var year=$('#year').val();   
var addExceptionalFee="addData";
$('#msg').html('');
if(id > 2){



     $.ajax({
          
                    type: "POST",
                    url: "ajxexceptionalFee.php",
                    data:$(".addfee").serialize() + "&addExceptionalFee=" + addExceptionalFee,
              cache: false,
                    cache: false,
                    success: function(data) {

                        
                        $("#msg").html(data);
                        showIdby();
                       
            
            }
            
          
          
             });
  
    }
}


</script>

   </head>
   <body>
          <form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addfee">

      <div class="container-fluid">
        
          <div class="col-md-12 col-xs-12 "> <h3>Exceptional Fee</h3></div>

          <div class="col-lg-12 col-md-12 col-xs-12" style="background: #f4f4f4; padding: 20px;"> 
        
              <div class="col-md-4">
     <h4>Class : </h4>
                  
                  <select  name="className" id="className"  style="max-width: 300px;" class="form-control">
    
      
    <?php

    $sql="SELECT * FROM `add_class`";
    $querys=$db->select_query($sql);
     while($fetcRow=$querys->fetch_array()) 
    {
      ?>
        <option value="<?php print $fetcRow['id']; ?> "><?php print $fetcRow['class_name']?></option>
      
      <?php
      
    }
    
    ?>

      </select>
              </div>

            <div class="col-md-4"> 
               <h4>Student ID: </h4>
               <input type="text" id="stdId" name="studentID"  class="form-control" style="max-width: 300px;" value="<?php print $_POST['studentID']; ?>" autocomplete="off" />

         <div id="idlist" class="ui-autocomplete"  style="text-align:left; max-width: 250px; float: right;;">
           
         </div>
            </div>

              <div class="col-md-4"> 
                   <h4>Year : </h4>
              <input type="text" name="year" id="year"  value="<?php print date('Y')?>"   class="form-control" style='max-width: 300px;'>


                 </div>

               <div class="col-md-12 col-xs-12" style="padding-top:30px; text-align: left; "> 
                 
              <input type="button" name="show"  value="Show"   class="btn btn-success" style='width:200px;' onclick="return showIdby()">

                 </div>


                  <div class="col-md-12 col-xs-12" style="padding-top:30px; "> 
                 
                      <span id="viewInformation">   </span>

                 </div>
 <div class="col-md-12 col-xs-12" style="padding-top:30px; "> 
                 
                      <span id="msg">   </span>

                 </div>


            </div>

      </div>

</form>
   </body>

  <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

