<?php
    // index.php
    // Clement Poh
    //
    // This file is for all intents and purposes an html file. It contains no 
    // logic; only the main presentation and styles of the page are contained here.
    //
    // The content of the page and logic for its calculation can be found in 
    // 'locations.php'
    //
    // The content of this page is populated through an ajax request, refresh, to 
    // locations.php. Through this method the page updates itself every thirty 
    // seconds.
    //
    
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Computer Availability - in Libraries - StudentIT Mobile</title>
            <meta name="apple-mobile-web-app-capable" content="no" />
            <meta name="apple-mobile-web-app-status-bar-style" content="black" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="touch-icon-iphone4.png" />
            <link rel="shortcut icon" href="http://www.unimelb.edu.au/favicon.ico">
            <meta name="DC.Rights" content="http://www.unimelb.edu.au/disclaimer/" />
            <meta name="DC.Format" scheme="IMT" content="text/html" />
            <meta http-equiv="cache-control" content="no-cache">
            <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=1;" />
            <link media="handheld, screen" href="css/mobile1.css" type="text/css" rel="stylesheet" />
            <link media="handheld, screen" href="css/portrait.css" type="text/css" rel="stylesheet" />
            <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
            <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <!--[if lt IE 8]>
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
            <![endif]-->
	</head>
	<body id="top">
    
    
     <div id="portrait" data-role="page">
          <h1 class="page_title">Computer Availability</h1>

		    <div id="content">
                <div class="block_wrap">
        
                    <div id="list" class="availability">
                        <?php require_once("locations.php") ?>
                    </div> 
                </div>
            </div>
        
            <div class="footer">
              <div class="footerlogo">
                <p><a href="http://www.unimelb.edu.au" title="University of Melbourne homepage"><img src="images/unimelb-logo-lge.png" width="80%" alt="UoM logo"></a> </p>
              </div>
              
              <p class="credits">Backend development by <br />Clement Poh, Student IT</p>

            </div>
            <!-- /footer --> 
    </body>
</html>

