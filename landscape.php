<?php
    // landscape.php
    // Clement Poh
    //
    // 'landscape.php' is designed to be displayed on landscape oriented LCD 
    // TVs around the Parkville campus. It uses landscape.css as its stylesheet.
    //
    require_once("settings.php");
    require_once("lib/avail.php");

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
		<link media="handheld, screen" href="css/landscape.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">
            function urlParameters() {
                return window.location.href.split('?')[1];
            }
		</script>
	</head>
	<body>
		<div id="content">
			<div id="list">
                <?php
                    $statuslist = readAuditTrail();

                    # $locations = explode(",", $_GET['locs']);
                    $locations = array(
                                    'Architecture',
                                    'Baillieu',
                                    'Brownless',
                                    'ERC',
                                    'Frank Tate',
                                    'Giblin Eunson',
                                    'Law',
                                    'VetSci Parkville'
                                    );
                    $locations = array_map("mysql_real_escape_string", $locations);

                    writeShallowTable($statuslist, $locations, 2);
                ?>
			</div>
		</div>
	</body>
</html>
