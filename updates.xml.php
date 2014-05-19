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
	// header("content-type: text/xml; charset=iso-8859-1");
	require 'config.php';
	require 'functions.php' ;
	$timestamp = getTimestamp();
echo '<' . '?xml version="1.0" encoding="UTF-8" ?>'
?>

<!DOCTYPE module_updates PUBLIC "-//NetBeans//DTD Autoupdate Catalog 2.5//EN" "http://www.netbeans.org/dtds/autoupdate-catalog-2_5.dtd">
<module_updates timestamp="<?php echo $timestamp ?>">

<?php

$dir_handle = @opendir($NBM_PATH) or die("Unable to open $NBM_PATH");
while ($file = readdir($dir_handle)) 
{
   if (endsWith($file, ".nbm")) {
		echo getNbmDescriptor($NBM_PATH.$file);
     } else {
     }
}

closedir($dir_handle);


?>
</module_updates>
