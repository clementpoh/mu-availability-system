<?php
    // static.php
    // Clement Poh
    //
    // Exact same content as index.php; however, the contents are not reloaded every thirty seconds. Primarily used for 
    // debugging and testing.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Library Computer Availabilities</title>
        <link rel="shortcut icon" href="http://www.unimelb.edu.au/favicon.ico">
        <meta name="DC.Rights" content="http://www.unimelb.edu.au/disclaimer/" />
        <meta name="DC.Format" scheme="IMT" content="text/html" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=2.0; minimum-scale=1.0; user-scalable=1;" />
        <link media="handheld, screen" href="css/mobile.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="header" class="availability-page-header">
                <h1>Library Availabilities</h1>
                <span id="student-it-logo">
                    <a href="http://m.studentit.unimelb.edu.au" title="Student IT Mobile home page"><span id="student-it-link-text">Student IT Mobile home page</span></a>
                </span>
        </div>
        <div id="content">
            <div id="list">
                <?php require_once("locations.php") ?>
            </div>
        </div>
        <div id="footer">
            <p>The University of Melbourne | <a href="http://www.unimelb.edu.au/disclaimer/" target="_blank">Copyright &amp; disclaimer</a> : <a href="http://www.unimelb.edu.au/disclaimer/privacy.html" target="_blank">Privacy</a></p>
        </div>
    </body>
</html>
