            
                    
                    
                    <div class="col-md-12 col-xs-12" id="fristheading">
                            <img src="img/header.jpg"  class="img-responsive"  width="100%" />
                    </div>
                    
                    
                    <div class="col-md-12 col-xs-12" style="margin:0px; padding:0px; height:5px; background:#fff">
                    </div>
                    
                    
                        
      
<!-- ...............................................................Menu............................................-->


    <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Roboto');
a:hover,
a:focus {
    text-decoration: none;
    outline: none;
}

/*
1.1 Header Area
***************************************************/
/*Bootstrap Reset*/
.navbar-nav > li > a {
    padding-top: 0;
    padding-bottom: 0;

}
.mainmenu {
    background-color: transparent;
    border-color: transparent;
    margin-bottom: 0;
  border: 0px !important;
}
.navbar-nav > li:last-child > a {
    padding-right: 0px;
    margin-right: 0px;
}
.dropdown-menu {
    padding: 0px 0; 
    margin: 0 0 0; 
    border: 0px solid transition !important;
  border: 0px solid rgba(0,0,0,.15);  
  border-radius: 0px;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;

}
/*=-====Main Menu=====*/
.navbar-nav .open .dropdown-menu > li > a {padding: 16px 15px 16px 25px;
}
.header_bottom { background: #0071ba }
.header_area .header_bottom .mainmenu a , .navbar-default .navbar-nav > li > a {
    color: #fff;
    font-size: 16px;
    text-transform: capitalize;
    padding: 16px 15px;
  font-family: 'Roboto', sans-serif;
}
.header_area .mainmenu .active a,
.header_area .mainmenu .active a:focus,
.header_area .mainmenu .active a:hover,
.header_area .mainmenu li a:hover,
.header_area .mainmenu li a:focus ,
.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
    color: #fff;
    background: #302f95;
    outline: 0;

}
/*-----./ Main Menu-----*/

.navbar-default .navbar-toggle { border-color: #fff } /*Toggle Button*/
.navbar-default .navbar-toggle .icon-bar { background-color: #fff } /*Toggle Button*/

/*==========Sub Menu=v==========*/
.mainmenu .collapse ul > li:hover > a{background: #54c6d4;}
.mainmenu .collapse ul ul > li:hover > a, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus, 
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover{background: #CBEAF0;}
.mainmenu .collapse ul ul ul > li:hover > a{background: #CBEAF0;}

.mainmenu .collapse ul ul, .mainmenu .collapse ul ul.dropdown-menu{background:#98D7E1; }
.mainmenu .collapse ul ul ul, .mainmenu .collapse ul ul ul.dropdown-menu{}
.mainmenu .collapse ul ul ul ul, .mainmenu .collapse ul ul ul ul.dropdown-menu{background:#e4eeb8; }

/******************************Drop-down menu work on hover**********************************/
.mainmenu{background: none;border: 0 solid;margin: 0;padding: 0;min-height:20px}
@media only screen and (min-width: 767px) {
.mainmenu .collapse ul li{position:relative;}
.mainmenu .collapse ul li:hover> ul{display:block}
.mainmenu .collapse ul ul{position:absolute;top:100%;left:0;min-width:250px;display:none}
/*******/
.mainmenu .collapse ul ul li{position:relative}
.mainmenu .collapse ul ul li:hover> ul{display:block}
.mainmenu .collapse ul ul ul{position:absolute;top:0;left:100%;min-width:250px;display:none}
/*******/
.mainmenu .collapse ul ul ul li{position:relative}
.mainmenu .collapse ul ul ul li:hover ul{display:block}
.mainmenu .collapse ul ul ul ul{position:absolute;top:0;left:-100%;min-width:250px;display:none;z-index:1}


}
    </style>


    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>

     <script src="admin/lib/jquery-1.9.0.min.js"></script>
   

</head>
<body>
 
 
            <div class="container-fluid" style="padding: 0px; background:#09c; ">
                <div class="row">
                    <nav role="navigation" class="navbar navbar-default mainmenu">
                <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collection of nav links and other content for toggling -->
                        <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul id="fresponsive" class="nav navbar-nav dropdown">
                        <li ><a href="./">Home</a></li>
                        <li><a href="?page=about">About Us</a></li>


                        <li><a href="?page=teacherinfo&cls=teacher">Teacher's Info</a></li>
                      



            

                    <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle">Student's Info  &nbsp;<span class="caret" ></span></a>


                  <ul class="dropdown-menu">
                 
                  <?php
            $selectclass = "SELECT * FROM `add_class` ORDER BY `id`  ASC  ";
            $resultcls = $db->select_query($selectclass);
              if($resultcls){
                while($fetchsql = $resultcls->fetch_array())
                  {


                
                        $selectgroup = "SELECT * FROM `add_group` WHERE `class_id`='".$fetchsql["id"]."' ORDER BY `add_group`.`id` ASC";

                  $resultgp = $db->select_query($selectgroup);
                  $fetchgpp = $resultgp->fetch_array();

                  if($fetchgpp['group_name'] == "Null")
                  {


            
        ?>  


           <li><a href="?page=clsstudent&cls=<?php echo $fetchsql["id"];?>" style="padding: 10px 15px;"><?php echo $fetchsql["class_name"];?></a>

           </li> 

          

             <?php  } 
             else
              {?>


                    <li>
                      
                      <a href="?page=clsstudent&cls=<?php echo $fetchsql["id"];?>" style="padding: 10px 15px;"  data-toggle="dropdown" class="dropdown-toggle"><?php echo $fetchsql["class_name"];?>

          
                 <span class="drop-icon" style="float: right;">▸</span> 
                <!--    <span class="caret"></span>
                  -->



                     


                  </a>
 <ul class="dropdown-menu">
                          <?php
                           $selectgroup = "SELECT * FROM `add_group` WHERE `class_id`='".$fetchsql["id"]."' ORDER BY `add_group`.`id` ASC";
                           $resultgp = $db->select_query($selectgroup);
                      $count= $resultgp->num_rows;
                    if($count > 1){ 

                      while($fetchgp = $resultgp->fetch_array()){

                          if($fetchgp['group_name'] != "Null"){
                  ?>
                  <li><a href="?page=gpstudent&cls=<?php echo $fetchsql['id'];?>&gpid=<?php echo $fetchgp['id'];?>" style="padding: 10px 0px 10px 30px;"><?php echo $fetchgp["group_name"];?></a></li>


                  <?php  }  }


                   } ?>

                  
                      </ul>
                   </li>

 <?php  } }} ?>




                  </ul>
                </li>
                
                <li><a href="?page=allnotice">Notice</a></li>     

             <li><a href="showResult.php">Result</a></li>     



      <li><a href="?page=photo">Photo Gallery</a></li>
        <li><a href="?page=video">Video Gallery</a></li>
          <li><a href="?page=contact">Contact</a></li>

          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle">Admission  &nbsp;<span class="caret" ></span></a>


            <ul class="dropdown-menu">

       


                 <li><a href="?page=admisionrule" style="padding: 10px 15px;">Admission Rules</a></li> 
                  <li><a href="OnlineRegistration/RegistrationForm.php" style="padding: 10px 15px;" target="_blank">Online Application</a></li> 
                   <li><a href="OnlineRegistration/signIN/signIn.php" style="padding: 10px 15px;">Admit Card</a></li> 
                    <li><a href="" style="padding: 10px 15px;">Admission Result</a></li> 
           </ul>



                            </ul>
                        </div>
                    </nav>
                </div> 
            </div>            
     





  <script type="text/javascript">
  (function($){
  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });
  });
})(jQuery); 

</script> 


                          