<?php
    // Fetch the file info.
	session_start();
	
	 
	 
	  if(isset($_GET["Sl"]))
	  {
	  		$path=$_SESSION['Inpath'];
			 $ID=$_GET["Sl"];
			 $extension=$_GET['ext'];
	  }
	  else
	  {
	  	$path=$_SESSION['path'];
		 $ID=$_GET["id"];
		 $extension=$_GET['ext'];
	  }
	
	  
    $filePath =$path.$ID.'.'.$extension;
	
	$title=$_GET['title'];
	
	  
    if(file_exists($filePath)) {
        $fileName = basename($filePath);
        $fileSize = filesize($filePath);

        // Output headers.
        header("Cache-Control: private");
        header("Content-Type: application/stream");
        header("Content-Length: ".$fileSize);
        header("Content-Disposition: attachment; filename=$title.$extension");//.$fileName);

        // Output file.
        readfile ($filePath);                   
        exit();
    }
    else {
        die('The provided file Not Found!!!');
    }
?>