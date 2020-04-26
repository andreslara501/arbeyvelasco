<?php
	foreach(glob("../../uploads/articles/*_*.jpg") AS $file_image){
		unlink($file_image);
	}
	foreach(glob("../../uploads/pages/*_*.jpg") AS $file_image){
		unlink($file_image);
	}
	if(file_exists("../../core_noodles/scripts/tmp.zip")){
		unlink("../../core_noodles/scripts/tmp.zip");	
	}
?>
