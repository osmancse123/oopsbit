<?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{

  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");

  $db = new database();
  global $msg;
  global $table;
  global $cheke_query;
$select_query="SELECT * FROM `project_info`";
$cheke_query=$db->select_query($select_query);
if($cheke_query){

    $fetch_all=$cheke_query->fetch_array();
}

  if(isset($_POST["add"]))
  {
    $id="SDMS2015";
     $insert_query="INSERT INTO `project_info`
            (`ID`,
             `title`,
             `institute_name`,
             `copyright`,
             `phone_number`,
             `location`,
             `email`,
             `meta_tag`,
             `facebook_page`,
             `twitter_page`,
             `google_plus`,
       `google_map`,`bninstituteName`,`collegeCode`,`Einncode`,`LocationbAngla`)
VALUES('$id','".$_POST["title"]."','".$_POST["insname"]."','".$_POST["cright"]."','".$_POST["phoneno"]."','".$_POST["location"]."','".$_POST["email"]."','".$_POST["metatag"]."','".$_POST["fbpage"]."','".$_POST["twitterpage"]."','".$_POST["gplus"]."','".$_POST["gmap"]."','".$_POST["binsname"]."','".$_POST["inscode"]."','".$_POST["Eind"]."','".$_POST["locationBN"]."')";
$chek_query=$db->insert_query($insert_query);
//print_r($insert_query);
$select_query="SELECT * FROM `project_info`";
$cheke_query=$db->select_query($select_query);
if($cheke_query){

    $fetch_all=$cheke_query->fetch_array();
}

  $image8="all_image/"."logo".$id.".png";
  move_uploaded_file($_FILES['logo']['tmp_name'],$image8);  
  @chmod($image8,0644);
  
  $image1="all_image/"."shortcurt_icon".$id.".png";
  move_uploaded_file($_FILES['sicon']['tmp_name'],$image1);
  @chmod($image1,0644);
  
  //............2nd...................//
    $image2="all_image/"."school_mark_sheet".$id.".jpg";
       move_uploaded_file($_FILES['smarkimg']['tmp_name'],$image2);
     @chmod($image2,0644);
  
  //............3nd...................//
    $image3="all_image/"."college_mark_sheet".$id.".jpg";
  move_uploaded_file($_FILES['cmarkimg']['tmp_name'],$image3); 
  @chmod($image3,0644);
  
  
  //............4nd...................//
    $image4="all_image/"."transfet_certificate".$id.".jpg";
  move_uploaded_file($_FILES['tc']['tmp_name'],$image4);
  @chmod($image4,0644);
  
  
  //............5nd...................//
    $image5="all_image/"."testimonial".$id.".jpg";
  move_uploaded_file($_FILES['testm']['tmp_name'],$image5);
  @chmod($image5,0644);
  //............6nd...................//
    $image6="all_image/"."charecter_certificate".$id.".jpg";
  move_uploaded_file($_FILES['charc']['tmp_name'],$image6);       
  @chmod($image6,0644);
  
   $image55="all_image/"."hompageCode".$id.".jpg";
  move_uploaded_file($_FILES['Homelogo']['tmp_name'],$image55);
  @chmod($image55,0644);
  


  }
  if(isset($_POST["Update"]))
  {
    $id="SDMS2015";
     $insert_query="REPLACE INTO `project_info`
            (`ID`,
             `title`,
             `institute_name`,
             `copyright`,
             `phone_number`,
             `location`,
             `email`,
             `meta_tag`,
             `facebook_page`,
             `twitter_page`,
             `google_plus`,
       `google_map`,`bninstituteName`,`collegeCode`,`Einncode`,`LocationbAngla`)
VALUES('$id','".$_POST["title"]."','".$_POST["insname"]."','".$_POST["cright"]."','".$_POST["phoneno"]."','".$_POST["location"]."','".$_POST["email"]."','".$_POST["metatag"]."','".$_POST["fbpage"]."','".$_POST["twitterpage"]."','".$_POST["gplus"]."','".$_POST["gmap"]."','".$_POST["binsname"]."','".$_POST["inscode"]."','".$_POST["Eind"]."','".$_POST["locationBN"]."')";
$chek_query=$db->insert_query($insert_query);
//print_r($insert_query);
$select_query="SELECT * FROM `project_info`";
$cheke_query=$db->select_query($select_query);
if($cheke_query){

    $fetch_all=$cheke_query->fetch_array();
}

  $image8="all_image/"."logo".$id.".png";
  move_uploaded_file($_FILES['logo']['tmp_name'],$image8);  
  @chmod($image8,0644);
  
  $image1="all_image/"."shortcurt_icon".$id.".png";
  move_uploaded_file($_FILES['sicon']['tmp_name'],$image1);
  @chmod($image1,0644);
  
  //............2nd...................//
    $image2="all_image/"."school_mark_sheet".$id.".jpg";
       move_uploaded_file($_FILES['smarkimg']['tmp_name'],$image2);
     @chmod($image2,0644);
  
  //............3nd...................//
    $image3="all_image/"."college_mark_sheet".$id.".jpg";
  move_uploaded_file($_FILES['cmarkimg']['tmp_name'],$image3); 
  @chmod($image3,0644);
  
  
  //............4nd...................//
    $image4="all_image/"."transfet_certificate".$id.".jpg";
  move_uploaded_file($_FILES['tc']['tmp_name'],$image4);
  @chmod($image4,0644);
  
  
  //............5nd...................//
    $image5="all_image/"."testimonial".$id.".jpg";
  move_uploaded_file($_FILES['testm']['tmp_name'],$image5);
  @chmod($image5,0644);
  //............6nd...................//
    $image6="all_image/"."charecter_certificate".$id.".jpg";
  move_uploaded_file($_FILES['charc']['tmp_name'],$image6);       
  @chmod($image6,0644);
  
   $image55="all_image/"."hompageCode".$id.".jpg";
  move_uploaded_file($_FILES['Homelogo']['tmp_name'],$image55);
  @chmod($image55,0644);
  


  }

  if(isset($_POST["Delete"]))
  {
       $id="SDMS2015";
    $delete_quer="DELETE FROM `project_info`";
    $chek_delte=$db->delete_query($delete_quer);
     print"<script>location='project.php'</script>";
      $image8="all_image/"."shortcurt_icon".$id.".png";
      @unlink($image8);
    
      $image1="all_image/"."logo".$id.".png";
      @unlink($image1);
      
      $image2="all_image/"."school_mark_sheet".$id.".jpg";
      @unlink($image2);
      
      $image3="all_image/"."college_mark_sheet".$id.".jpg";
      @unlink($image3);
      
      $image4="all_image/"."transfet_certificate".$id.".jpg";
      @unlink($image4);
      
      $image5="all_image/"."testimonial".$id.".jpg";
      @unlink($image5);
      
      $image6="all_image/"."charecter_certificate".$id.".jpg";
      @unlink($image6);
	   $image7="all_image/"."hompageCode".$id.".jpg";
      @unlink($image6);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
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
    </script>
  </head>
	<style type="text/css">
		.box {width :70%;}
	</style> 
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" >

  	<div class="col-xs-12 col-lg-12">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"   bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">  School Information Form</span> </td>
  			</tr>
			
			<tr>
				<td class="info"> ID</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12">
						<input type="text" class="form-control"   name="id" <?php if($cheke_query){?> value="<?php echo $fetch_all[0];?>" <?php } else {?> value="<?php echo "SDMS2015" ?>" <?php } ?>  readonly="" />
						
					</div>
				</td>
				<td class='info' rowspan="3" style="width: 200px;">
            <?php 
                if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "logoSDMS2015"?>.png" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 40%">Logo</strong>
                  <?php

                }
            ?>

        </td>
			</tr>
      <tr>
        <td class="info"> Title</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <input type="text"   class="form-control" name="title"  <?php if($cheke_query){?> value="<?php echo $fetch_all[1];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> />
            
          </div>
        </td>
        
      </tr>
      <tr>
        <td class="info"> Meta tag</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
          
			<textarea class="form-control" name="metatag">
			
			 <?php if($cheke_query){ echo $fetch_all[7]; } else { echo "" ; } ?>
			</textarea>
            
          </div>
        </td>
      
      </tr>
	   <tr>
        <td class="info"> Institute Code</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <input type="text" class="form-control" name="inscode"    <?php if($cheke_query){?> value="<?php echo $fetch_all["collegeCode"];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> />
            
          </div>
        </td>
		<td  class="info"></td>
		
		</tr>
		
		
		<tr>
        <td class="info"> EIIN No</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
          <input type="text" class="form-control" name="Eind"    <?php if($cheke_query){?> value="<?php echo $fetch_all["Einncode"];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> />
            
          </div>
        </td>
			<td  class="info"></td>
		</tr>
		
		
      <tr>
        <td class="info"> Home Page Logo</td>
        <td class="info">:</td>
        <td class="info" colspan="2">
          <div class="col-lg-12">
            <input type="file"  name="Homelogo" />
            
          </div>
        </td>
		
		</tr>
	  <tr>
        <td class="info"> Shortcurt Icon</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <input type="file"  name="sicon" />
            
          </div>
        </td>
        <td class='info' rowspan="3" style="width: 200px;">
          <?php 
                if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "shortcurt_iconSDMS2015"?>.png" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 35%">Shortcut Icon</strong>
                  <?php

                }
            ?>
        </td>
      </tr>
       <tr>
        <td class="info"> Bangla Institute Name</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <input type="text"  class="form-control" name="binsname"    <?php if($cheke_query){?> value="<?php echo $fetch_all[2];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>/>
            
          </div>
        </td>
      
      </tr>
	  
	  
	   <tr>
        <td class="info"> English Institute Name</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <input type="text"  class="form-control" name="insname"  <?php if($cheke_query){?> value="<?php echo $fetch_all[2];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>/>
            
          </div>
        </td>
      
      </tr>

       <tr>
        <td class="info"> Phone Number</td>
        <td class="info">:</td>
        <td class="info" >
          <div class="col-lg-6">
            <input type="text" style="100%;"   class="form-control" name="phoneno"  <?php if($cheke_query){?> value="<?php echo $fetch_all[4];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> />
            
          </div>
        </td>
       <td class="info"></td>
      </tr>

             <tr>
        <td class="info">Location</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <textarea name="location" class="form-control" style="height: 80px;"><?php if($cheke_query){ print $fetch_all[5]; } else { print "" ; } ?> </textarea>
          </div>
        </td>
        <td class='info' rowspan="2" style="width: 200px;">
        <?php
            if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "school_mark_sheetSDMS2015" ?>.jpg" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 30%">School Mark Shit</strong>
                  <?php

                }
            ?>

        </td>

        
      </tr>
	  
	  
	      <tr>
        <td class="info">Location Bangla</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
            <textarea name="locationBN" class="form-control" style="height: 80px;"><?php if($cheke_query){ print $fetch_all["LocationbAngla"]; } else { print "" ; } ?> </textarea>
          </div>
        </td>
 
        
      </tr>


             <tr>
        <td class="info">Email</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="email" class="form-control"  <?php if($cheke_query){?> value="<?php echo $fetch_all[6];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>></input>
          </div>
        </td>
		      <td class="info"></td>
              </tr>
      <tr>
        <td class="info">Logo</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="logo"></input>
          </div>
        </td>
         <td class='info' rowspan="3" style="width: 200px;">
        <?php
            if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "college_mark_sheetSDMS2015" ?>.jpg" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 30%">Collage Mark Shit</strong>
                  <?php

                }
            ?>

        </td>
      </tr>

      <tr>
        <td class="info">School MarkSheet Image</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="smarkimg"></input>
          </div>
        </td>
       

      </tr>

         <tr>
        <td class="info">College MarkSheet Image</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="cmarkimg"></input>
          </div>
        </td>
      
      </tr>

        <tr>
        <td class="info">Transfer Certificate</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="tc"></input>
          </div>
        </td>
        <td class='info' rowspan="3" style="width: 200px;">
        <?php
            if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "testimonialSDMS2015" ?>.jpg" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 30%">Testimonial</strong>
                  <?php

                }
            ?>

        </td>
      </tr>

      <tr>
        <td class="info">Testimonial</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="testm"></input>
          </div>
        </td>
         
      </tr>

       <tr>
        <td class="info">Charecter Certificate</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="file" name="charc"></input>
          </div>
        </td>
        
      </tr>
        <tr>
        <td class="info">Facebook Page</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="fbpage" <?php if($cheke_query){?> value="<?php echo $fetch_all[8];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> class="form-control"></input>
          </div>
        </td>
        <td class='info' rowspan="3" style="width: 200px;">
        <?php
            if($cheke_query)
                {
                  ?>
                    <img src="all_image/<?php echo "charecter_certificateSDMS2015"?>.jpg" class="img img-thumbnail img-responsive" width="200" height="180" style="height:120px"><br/><strong class="text-center text-success" style="padding-left: 20%">Charecter Certificate</strong>
                  <?php

                }
            ?>

        </td>
      </tr>

      <tr>
        <td class="info">Twitter Page</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="twitterpage"<?php if($cheke_query){?> value="<?php echo $fetch_all[9];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>class="form-control"></input>
          </div>
        </td>
   
      </tr>

      <tr>
        <td class="info">Google Plus</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="gplus"  class="form-control" <?php if($cheke_query){?> value="<?php echo $fetch_all[10];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>></input>
          </div>
        </td>
        
      </tr>

      <tr>
        <td class="info">Google Map</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="gmap" <?php if($cheke_query){?> value="<?php echo $fetch_all[11];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?> class="form-control"></input>
          </div>
        </td>
        <td class='info' style="width: 200px;"></td>
      </tr>
      <tr>
        <td class="info">Copy Right</td>
        <td class="info">:</td>
        <td class="info">
          <div class="col-lg-12">
           <input type="text" name="cright" <?php if($cheke_query){?> value="<?php echo $fetch_all[3];?>" <?php } else {?> value="<?php echo "" ?>" <?php } ?>class="form-control"></input>
          </div>
        </td>
        <td class='info' style="width: 200px;"></td>
      </tr>
      <tr>
          <td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
            <?php 
              if(isset($msg))
              {
                echo "<strong>".$msg."</strong>";
              }
              else 
              {
                 echo "<strong>".$db->sms."<strong>";
              }



            ?>

          </span> </td>
        </tr>
      <tr>
      
          <td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
      <?php if(!$cheke_query){?>
          <input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
          <?php } else {?>
          <input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
          <?php } ?>
               <input type="submit" value="Delete" name="Delete" class="btn btn-primary btn-sm" style="width:80px;"  onclick='return confirm_delete()'/>         
   
          <input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
        </td>
        </tr>


      </table>
      </div>
    </form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
