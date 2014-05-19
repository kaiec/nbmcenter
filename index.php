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
	// error_reporting(E_ALL);
	// header("content-type: text/xml; charset=iso-8859-1");
    require 'config.php';
	require 'functions.php';
	$llm = date ("F d Y H:i:s",getLastLastModified($NBM_PATH));

	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="author" content="Kai Eckert, http://www.kaiec.org" />
<title>NBM Center</title>
<!--
	This is NBM Center, available at http://nbmcenter.sourceforge.net/
-->
</head>
<body>
<h1>NBM Center</h1>
<h2>How to use this Update Center</h2>
<p>
	To use this update center, add a new Update Center in your Netbeans Platform Application with the following URL:
</p>
<p>
	<a href="updates.xml.php">URL</a>
</p>
<h2>List of Modules</h2>
<p>
	Last Upload: <?php echo $llm ?>
</p>
<table border="1">
<tr><th>Name</th><th>Author</th><th>Spec. Version</th><th>Filename</th><th>Last modified</th><th>Size</th></tr>
<?php

$dir_handle = @opendir($NBM_PATH) or die("Unable to open $NBM_PATH");
while ($file = readdir($dir_handle)) 
{
   if (endsWith($file, ".nbm")) {
	    $infos = extractNbmInfos($NBM_PATH.$file);
        echo "<tr><td>";
		echo $infos['name'];
		echo "</td><td>";
		echo $infos['author'];
		echo "</td><td>";
		echo $infos['spec'];
		echo "</td><td>";
		echo "<a href=\"".$NBM_PATH.$file."\">".$file."</a>";
		echo "</td><td>";
		echo date ("F d Y H:i:s",filemtime($NBM_PATH.$file));
		echo "</td><td>";
		$filesize = round(filesize($NBM_PATH.$file)/1024);
		echo "".$filesize." KB";
		echo "</td></tr>";
     } else {
     }
}

closedir($dir_handle);


?>
</table>

<?php if ($ALLOW_UPLOADS) { ?>
<h2>Upload Module</h2>
<p>
Maximum File Size: <?php echo $UPLOAD_MAX_FILESIZE/1024/1024 ?>.
</p>
<form enctype="multipart/form-data" action="upload.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $UPLOAD_MAX_FILESIZE ?>" />
Choose a NBM File to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload Module" />
</form>
<?php } ?>

<hr>
<small>
NBM Center, Copyright 2009 <a href="http://www.kaiec.org">Kai Eckert</a>, <a href="http://nbmcenter.sourceforge.net/">http://nbmcenter.sourceforge.net/</a>
</small>
</body>
</html>
