<?php
/*
	This file is part of NBM Center, http://nbmcenter.sourceforge.net/
	
	Copyright 2009 Kai Eckert, http://www.kaiec.org

    NBM Center is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    NBM Center is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with NBM Center.  If not, see <http://www.gnu.org/licenses/>.
*/


error_reporting(E_ALL);
// header("content-type: text/xml; charset=iso-8859-1");
require 'config.php';
require 'functions.php';



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NBM Center</title>
</head>
<body>
<p>
<?php

if($ALLOW_UPLOADS && array_key_exists('uploadedfile', $_FILES)) {
	// var_dump($_FILES);
	$filename = $_FILES['uploadedfile']['name'];

	// Validate the uploaded file
	if($_FILES['uploadedfile']['size'] === 0 
			|| empty($_FILES['uploadedfile']['tmp_name'])) {
		echo("<p>No file was selected.</p>\r\n");
	} else if($_FILES['uploadedfile']['size'] > $UPLOAD_MAX_FILESIZE) {
		echo("<p>The file was too large.</p>\r\n");
	} else if($_FILES['uploadedfile']['error'] !== UPLOAD_ERR_OK) {
		// There was a PHP error
		echo("<p>There was an error uploading.</p>\r\n");
	} else 	if (!endsWith($filename,".nbm")) {
		echo "Wrong filetype, only .NBM files are allowed.";
	} else {

		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], 
					$NBM_PATH . basename( $filename ))) {
			echo("<p>File uploaded successfully!</p>\r\n");
		} else {
			echo("<p>There was an error moving the file.</p>\r\n");
		}

	}

}

?>
</p>
<p>
<a href="index.php">Back</a>
</p>
</body>
</html>
