<?php
include("db.php");
$ob=new dbconnect();




 					$sql="SELECT * FROM `category_information` where item_name='".$_POST["item"]."'";

                     $q=$ob->link->query($sql);
                     if($q)
                     {
                        while($fetch=$q->fetch_array())
                        {

                           print "<option>".$fetch[2]."</option>";

                        }
                     }


?>