<!DOCTYPE html>  
<?php
    // index.php
    // Clement Poh
    // This page prints out complete information about all the computers in the database.
    error_reporting(-1);
    require_once("../settings.php");
    require_once("../lib/display.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Library Computer Availabilities</title>
		<link rel="shortcut icon" href="http://www.unimelb.edu.au/favicon.ico">
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=2.0; minimum-scale=1.0; user-scalable=1;" />
		<link media="handheld, screen" href="../css/admin.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
        <div id="header" class="availability-page-header">
            <h1>Library Availabilities</h1>
		</div>
		<div id="content">
            <ul>
                <li><a href="edit.php">Edit Desktop List</a></li>
            </ul>
            <div id="list">
                <?php showDetailDesktopTable(readAuditTrail()); ?>
            </div>
		</div>
		<div id="footer">
			<p>The University of Melbourne | <a href="http://www.unimelb.edu.au/disclaimer/" target="_blank">Copyright &amp; disclaimer</a> : <a href="http://www.unimelb.edu.au/disclaimer/privacy.html" target="_blank">Privacy</a></p>
            <p>Written and maintained by Clement Poh, Learning Environments</p>
		</div>
	</body>
</html>
