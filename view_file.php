<?php

	session_start();
	
	
	
		$file='C:\\xampp\\htdocs\\Student-Notes-Management-System\\files'.$_GET['notes'];
		header('Content-Type: '.mime_content_type($file));
		readfile($file);		
	

?>