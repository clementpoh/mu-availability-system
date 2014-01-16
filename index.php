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
    
    require_once("lib/access.php");
    log_traffic();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
			window.addEventListener("load",function() {
			  // Set a timeout...
			  setTimeout(function(){
				// Hide the address bar!
				window.scrollTo(0, 1);
			  }, 0);
			});
			
			function getXMLHttp(){
				var xmlHttp;
					try {	
						xmlHttp = new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
					} catch (e){
						try {
							xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
						} catch (e){
							try{
								xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
							} catch (e){
								alert("No AJAX!?");
								return false;
							}
						}
					}
				return xmlHttp;
			}

			function refresh() {
				xmlHttp = getXMLHttp();
				xmlHttp.onreadystatechange = function(){
					if(xmlHttp.readyState == 4) { 
						document.getElementById('list').innerHTML=xmlHttp.responseText;
						setTimeout('refreshIt()', 30000);
					}
				}
				xmlHttp.open("GET", "locations.php", true);
				xmlHttp.send(null);
				return false;
			}

			window.onload=refresh();
		</script>
	</head>
	<body id="top">
    
    
     <div id="portrait" data-role="page">
          <div class="header" data-role="header"> <a href="#" class="back_btn">Back</a> 
          <!-- 
          <a href="#globalnav" id="testBt" class="inside_nav">Menu &#x25BC;</a>
           <ul class="global_nav" >
            
            </ul>
            -->
          </div>
  
          <h1 class="page_title">Computer Availability</h1>

		<div id="content">
         	<div class="block_wrap">
      		
                <div id="list" class="availability"></div>
            </div>
		</div>
        
            <div class="local_footer">
              <ul class="local_footer_list">
                <li class="btn_top"><a href="#top" title="Back to Top" data-ajax="false" id="top-of-page">Top</a></li>
                <li class="btn_feedback"><a href="http://m.studentit.unimelb.edu.au/feedback.html" title="Feedback" data-ajax="false">Feedback</a></li>
                <li class="btn_menu"><a href="http://m.studentit.unimelb.edu.au" title="Menu" data-ajax="false">Menu</a></li>
              </ul>
              <p><a href="http://studentit.unimelb.edu.au" title="Student IT non-mobile site">Student IT non-mobile Site > </a></p>
              <p>© copyright 2012</p>
            </div>
            
            <div class="footer">
              <div class="footerlogo">
                <p><a href="http://www.unimelb.edu.au" title="University of Melbourne homepage"><img src="images/unimelb-logo-lge.png" width="80%" alt="UoM logo"></a> </p>
              </div>
              <ul class="footernav-social">
                <li><a href="http://twitter.com/unimelb" title="Unimelb Twitter account"><img src="images/twitter.png"></a></li>
                <li><a href="http://facebook.com/melbuni" title="Unimelb Facebook account"><img src="images/facebook.png"></a></li>
              </ul>
              <ul class="footernav-legals">
                <li><a href="http://www.unimelb.edu.au/disclaimer/" title="Disclaimer and copyright">Disclaimer &amp; copyright</a></li>
                <li><a href="http://www.unimelb.edu.au/accessibility/index.html" title="Accessibility">Accessibility</a></li>
                <li><a href="http://www.unimelb.edu.au/disclaimer/privacy.html" title="Privacy">Privacy</a></li>
              </ul>
              
              <p class="credits">Backend development by <br />Clement Poh, Student IT</p>

            </div>
            <!-- /footer --> 
            <script type="text/javascript">
			
		    $(document).ready(function() { 
				 $("#top-of-page").bind("click",function(){
				   $('html, body').stop().animate({ scrollTop : 0 }, 300);
				   return false;
				});
				$(".back_btn")
      				.click(function() {
						history.back();
						return false;
      			});
			});
		</script>
	</body>
</html>

