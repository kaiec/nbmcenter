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

	// The directory where the NBM files are. If uploads are enabled, this
	// directory must be writable for the webserver.
	// Add a trailing slash, use "./" for application directory
	// The directory mus exist!
	$NBM_PATH = "./nbm";

	// Allow the upload of new NBM files for everyone.
	// WARNING: Currently, there are no passwords, no security.
	// USE AT YOUR OWN RISK!
	$ALLOW_UPLOADS = false;
	
	// Maximum filesize for uploads in bytes. Check your PHP settings for further restrictions.
	$UPLOAD_MAX_FILESIZE = 50000000;
	

?>