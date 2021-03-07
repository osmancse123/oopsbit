
<style>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

</style>



<div class="col-md-9 col-xs-12 fontsize backgroundcol"  style="padding:0px ; margin:0px; margin-top:10px; padding-top:10px;" >

<?php

	 $sql="SELECT COUNT(id)  FROM `video_gallery`";
	$result=$db->select_query($sql);
	if($result)
	{
		$row=$result->fetch_array();
	}
	$rows = $row[0];
	$page_rows = 40;
	$last = ceil($rows/$page_rows);
	if($last < 1)
	{
		$last = 1;
	}
	$pagenum = 1;
	if(isset($_GET["pn"]))
	{
		
		$pagenum = preg_replace('#[^0-9]#','',$_GET['pn']);
	}
	if($pagenum < 1)
	{
			$pagenum = 1;
	}
	else if($pagenum > $last){
		$pagenum = $last;
		
	}
	$limit ='LIMIT '.($pagenum-1) * $page_rows.','.$page_rows;
	$sql1= "SELECT * FROM `video_gallery`  ORDER BY sl ASC 1,$limit";
	$result1=$db->select_query($sql1);
	$textline1= "Commetee Members(<b>$rows</b>)";
	$textline2="Page<b>$pagenum</b>of<b>$last</b>";
	$pagenationCtrl = '';
	if($last != 1){
		
		if($pagenum > 1 )
		{
			$previous = $pagenum-1;
			$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$previous.'" >Previous</a> &nbsp;';
				for($i = $pagenum-4;$i < $pagenum; $i++){
					
					if($i > 0){
						
						$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					}
					
				}
		}
		
			for($i = $pagenum+1;$i <= $last; $i++){
					$pagenationCtrl.= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$i.'" >'.$i.'</a> &nbsp;';
					if($i >= $pagenum+4){
						
						break;
					}
					
				}
				if($pagenum != $last)
				{
					$next=$pagenum+1;
					$pagenationCtrl.='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$_GET["page"].'&pn='.$next.'" >Next</a>';
				}
	}				
				
				
				
				
				
					
					$sl = 0;
					if($result1){
					while($fetch=$result1->fetch_object()){
					
					
?>
	<div class="col-md-6 colxs-12" style="margin:0px; padding:0px">
		<iframe style="width:100%" height="315" src="<?php echo $fetch->url;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>
	
	
  
  


<!-- The Modal -->
<!--<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
-->

<?php }  ?>
	<div class="center" style='text-align:center;'>
				<div class="pagination">
							<?php echo $pagenationCtrl;?>
				</div>
			</div>
<?php } ?>




</div>
