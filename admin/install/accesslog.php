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
    $query = sprintf("DROP TABLE access_log");
    $result = mysql_query($query);

    if ($result) {
        printf("\nSuccessfully dropped table access_log\n");
    } else {
        printf("\nError dropping table access_log: %s\n", mysql_error());
    }

    # Create the table again
	$query = "CREATE TABLE access_log (
				script VARCHAR(255) NOT NULL,
				ip VARCHAR(255) NOT NULL,
                browser VARCHAR(255) NOT NULL,
                user VARCHAR(255),
				timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			)";
    $result = mysql_query($query);

    if ($result) {
        printf("Successfully created table access_log\n\n");
    } else {
        printf("Could not create table access_log: %s\n\n", mysql_error());
    }
?>
