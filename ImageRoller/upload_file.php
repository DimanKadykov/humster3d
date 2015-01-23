<?php 
if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 20000000000)) 
{ 
	if ($_FILES["file"]["error"] > 0) 
	{ 
	
	} 
	else 
	{ 
		move_uploaded_file($_FILES["file"]["tmp_name"], "screenshots/" . $_FILES["file"]["name"]);
	}
}
?>