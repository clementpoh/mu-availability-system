<?php
    require_once('../../settings.php');

    header("Content-type: text/plain");

    # Connect to the computer list database.
    printf("PHP Version: %s\n", phpversion());

    $link = mysql_connect(DB_ADDRESS, DB_USERNAME, DB_PASSWORD) or die('Could not connect: ' . mysql_error());
    echo("Authentication successful\n");
    mysql_select_db(DB_NAME) or die("Could not select database");
    echo("Connected successfully\n");

    printf("MySQL server version: %s\n", mysql_get_server_info());

    # Drop the table if it already exists
    $query = sprintf("DROP TABLE quick_log");
    $result = mysql_query($query);

    if ($result) {
        printf("\nSuccessfully dropped table quick_log\n");
    } else {
        printf("\nError dropping table quick_log: %s\n", mysql_error());
    }

    # Create the table again
	$query = "CREATE TABLE quick_log (
				branch      VARCHAR(255) NOT NULL,
				category    VARCHAR(255) NOT NULL,
                query       VARCHAR(255) NOT NULL,
				timestamp   TIMESTAMP    NOT NULL
			)";
    $result = mysql_query($query);

    if ($result) {
        printf("Successfully created table quick_log\n\n");
    } else {
        printf("Could not create table quick_log: %s\n\n", mysql_error());
    }
?>
