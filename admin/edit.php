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
            <?php 
                if(isset($_GET['remove'])) {
                    if($_GET['remove'] == 1) {
                        echo "<div class='notice'>Computer successfully removed.</div>";
                    } else {
                        echo "<div class='error'>Error computer could not be removed successfully.</div>";
                    }
                } else if(isset($_GET['add'])) {
                    if($_GET['add'] == 1) {
                        echo "<div class='notice'>Computer successfully added to the database.</div>";
                    } else {
                        echo "<div class='error'>Error computer could not be added to the database.</div>";
                    }
                }
            ?>
            <table><tr><td>
                <form method="post" action="manage.php">
                    <fieldset>
                        <legend>Add Computer</legend>
                        <input type="hidden" value="true" name="add">
                        <span class="q"><label for="location">Location</label> <input type="text" name="location" id="location"></span>
                        <span class="q"><label for="sublocation">Sublocation</label> <input type="text" name="sublocation" id="sublocation"></span>
                        <span class="q"><label for="name">Name</label> <input type="text" name="name" id="name"></span>
                        <button type="submit">Add</button>
                    </fieldset>
                </form>
            </td></tr></table>
            <div id="list">
                <?php editFullDesktopTable(readAuditTrail()); ?>
            </div>
		</div>
		<div id="footer">
			<p>The University of Melbourne | <a href="http://www.unimelb.edu.au/disclaimer/" target="_blank">Copyright &amp; disclaimer</a> : <a href="http://www.unimelb.edu.au/disclaimer/privacy.html" target="_blank">Privacy</a></p>
            <p>Written and maintained by Clement Poh, Learning Environments</p>
		</div>
	</body>
</html>
