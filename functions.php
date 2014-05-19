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
require 'config.php';

function getNbmDescriptor($file) {
	$fp = getInfoXmlFilePointer($file);
	$contents="";
	$lcount = 0;
	while (!feof($fp)) {
		if ($lcount<2) {
			fgets($fp);
			$lcount++;
		} else {
			$contents .= fgets($fp);
		}
		
	}
	
	$contents = str_replace("distribution=\"\"","distribution=\"".$file."\"",$contents);
	$contents = str_replace("downloadsize=\"0\"","downloadsize=\"".filesize($file)."\"",$contents);
	fclose($fp);
	return $contents;
}

function extractNbmInfos($file) {
	global $nbmInfos;
	$nbmInfos=array();
	$fp = getInfoXmlFilePointer($file);
	$xml_parser = xml_parser_create('');
	xml_set_element_handler($xml_parser, "startElement", "endElement");
	xml_set_character_data_handler($xml_parser, "characterData");
	while ($data = fread($fp, 4096)) {
		xml_parse($xml_parser, $data, feof($fp)) or die(sprintf("XML error: %s at line %d",  xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)));
	}
	// Close the XML file
	fclose($fp);

	// Free up memory used by the XML parser
	xml_parser_free($xml_parser);
	return $nbmInfos;
}

function startElement($parser, $tagName, $attrs) {
	global $nbmInfos;
	if ($tagName=='MANIFEST') {
		$nbmInfos["name"]=$attrs["OPENIDE-MODULE-NAME"];
		$nbmInfos["spec"]=$attrs["OPENIDE-MODULE-SPECIFICATION-VERSION"];
	}
	if ($tagName=='MODULE') {
		$nbmInfos["author"]=$attrs["MODULEAUTHOR"];
	}
}

function endElement($parser, $tagName) {
	
}

function characterData($parser, $data) {
	
} 

function getInfoXmlFilePointer($file) {
	return fopen('zip://' . $file . '#Info/info.xml', 'r');
}

function endsWith( $str, $sub ) {
	$str = strtolower($str);
	$sub = strtolower($sub);
	return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}

function getLastLastModified($dir) {
	$dir_handle = @opendir($dir) or die("Unable to open $dir");
	$lastmodified = 0;
	while ($file = readdir($dir_handle)) 
	{
		if (endsWith($file,".nbm")) {
			$tmp = filemtime($dir.$file);
			if ($tmp>$lastmodified) $lastmodified = $tmp;
		}
	}
	return $lastmodified;
}

function getTimestamp() {
	global $NBM_PATH;
	$lastmodified = getLastLastModified($NBM_PATH);
	$timestamp = date("s", $lastmodified);
	$timestamp .= "/";
	$timestamp .= date("i", $lastmodified);
	$timestamp .= "/";
	$timestamp .= date("G", $lastmodified);
	$timestamp .= "/";
	$timestamp .= date("d", $lastmodified);
	$timestamp .= "/";
	$timestamp .= date("m", $lastmodified);
	$timestamp .= "/";
	$timestamp .= date("Y", $lastmodified);
	return $timestamp;
}


?>