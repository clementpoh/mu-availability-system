<?php
    // traffic.php
    // Clement Poh
    //
    // A library containing the function to log traffic to a database.
    //
    
    // log_traffic connects to the MySQL database specified in settings.php
    // and records client information there.
    require_once('settings.php');

    function log_traffic() {
        // Connect to the database.
        $link = mysql_connect(DB_ADDRESS, DB_USERNAME, DB_PASSWORD) 
            or die('Could not connect: ' . mysql_error());
        mysql_select_db(DB_NAME)
            or die("Could not select database");

        // Sanitise the data.
        $uri = mysql_real_escape_string('availability');
        $ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
        $browser = mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);
        $user = isset($_SERVER['PHP_AUTH_USER']) ? mysql_real_escape_string($_SERVER['PHP_AUTH_USER']) : NULL;

        // Insert information.
        $query = sprintf("INSERT INTO access_log (script, ip, browser, user) VALUES ('%s', '%s', '%s', '%s')", $uri, $ip, $browser, $user);
        $result = mysql_query($query);

        // Disconnect.  
        mysql_close($link);
    }
?>
