<?php
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);  
	
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false){                                  
	        $uploadOk = 1;
	    }else{                             
	        $uploadOk = 0;
	    }
	}
                                  
	if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "JPG") { $uploadOk = 0; }                                               
	
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";     
	}else{
	    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {               
	        echo '<script type="text/javascript">location.href = "'.$target_file.'";</script>';  
	    }else{
	        echo "Sorry, there was an error uploading your file.";
	    }  
	}

?>