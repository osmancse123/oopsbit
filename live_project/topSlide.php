
		<!--  slider section -->
                    <div class="col-md-12 col-xs-12" style="padding:0px; border:0px; margin-top:5px;" id="sliderdiv">
                    
                              
                          
                          
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
  </ol>

  <div class="carousel-inner" role="listbox">


      <?php
        
            $selectclass = "SELECT * FROM `photo_gellary`  WHERE `slide`='slide' ORDER BY `serial_no` DESC  LIMIT 5";
            $resultcls = $db->select_query($selectclass);
              if($resultcls){
                $i=0;
                while($fetchsql = $resultcls->fetch_array())
                  {

                    $i++;
                    if($i==1)
                    {


        ?>  


    <div class="item active">
      <img src="other_img/<?php print $fetchsql[0]; ?>.jpg" style="width:100%; max-height: 400px;">
      <div class="carousel-caption">
        </div>
      </div>

        
       <?php
   }
   else
   {


   ?>
       
        


      <div class="item">
        <img src="other_img/<?php print $fetchsql[0]; ?>.jpg" style="width:100%;max-height: 400px; " >
        <div class="carousel-caption">
          
        
        </div>
      </div>


    <?php
}
}
}
    ?>
     
    </div>

    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>