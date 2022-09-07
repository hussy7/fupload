<?php 	
	if(isset($_FILES["file"])){
		$uploadFolder="upload/";
		$fileName=basename($_FILES["file"]["name"]); #Get File Name 
		$fileType=pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);#Get File Extension
		$fileType=strtolower($fileType); #convert to lowercase
		$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'csv', 'mp3','mp4'); 
		if(in_array($fileType,$allowTypes)){
			#Move file into 'upload' Folder
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$uploadFolder.$fileName)){
				echo "<div class='alert alert-success'><b>$fileName</b> Upload Successfully</div>";
			}else{
				echo "<div class='alert alert-danger'><b>$fileName</b> Upload Failed. Try Again.</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>Upload Failed. <b>$fileType</b> Not allowed.</div>";
		}
	}
?>
