<?php
    // install.php
    // Clement Poh
    //
    // Populates the computer list database, completely overwriting any 
    // previous content.
    //
    // install.php expects a file in the same folder called desktops.csv, a 
    // list of all the computers in each location. desktops.csv should have 
    // the following four columns:
    // - The computer name, which must match the name in the name in the audit 
    // trail.
    //
    // - The computer’s unique IPv4 address, for reference only.
    // 
    // - The computer's location, which must match the locations in the other 
    // availability system php files.
    //
    // - The area or floor the computer is within a location, must also match 
    // the areas in the rest of the system.
    //
    //
    // The Availability System will only search for computers that are listed 
    // in the database. It is imperative that the database be kept up to date.
    require_once('../../settings.php');

    header("Content-type: text/plain");

    # Connect to the computer list database.
    echo(phpversion() . "\n");
    $link = mysql_connect(DB_ADDRESS, DB_USERNAME, DB_PASSWORD) or die('Could not connect: ' . mysql_error());
    echo("Authentication successful\n");
    mysql_select_db(DB_NAME) or die("Could not select database");
    echo("Connected successfully\n");

    # Drop the table if it already exists
    $query = sprintf("DROP TABLE desktops");
    $result = mysql_query($query);
    
    if ($result) {
        printf("\nSuccessfully dropped table desktops\n");
    } else {
        printf("\nCould not drop table desktops: %s\n", mysql_error());
    }

    # Create the table again
	$query = "CREATE TABLE desktops (
                id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(255) NOT NULL,
				location VARCHAR(255),
				sublocation VARCHAR(255),
                display BOOLEAN,
                PRIMARY KEY (id),
                UNIQUE (name)
			)";
    $result = mysql_query($query);

    if ($result) {
        printf("Successfully created table desktops\n\n");
    } else {
        printf("Could not create table desktops: %s\n\n", mysql_error());
    }

    # Populate the table according to the desktops.csv.
    $csv = fopen("desktops.csv", "r");

    if ($csv) {
        printf("Successfully opened desktops.csv\n\n");
    }

	$data = fgetcsv($csv);

    while($data = fgetcsv($csv)) {
        // Sanitize the data.
        $name = mysql_real_escape_string($data[0]);
        $location = mysql_real_escape_string($data[1]);
        $sublocation = mysql_real_escape_string($data[2]);
        $display = mysql_real_escape_string($data[3]);

        $query = sprintf("INSERT INTO desktops (name, location, sublocation, display) VALUES
                        ('%s', '%s', '%s', %s)", 
                        $name, $location, $sublocation, $display);
        // Print the query to the page for debugging purposes.
        printf("%s\n", $query);

        $result = mysql_query($query);
        if ($result) {
            printf("Successfully inserted %s into table desktops\n\n", $name);
        } else {
            printf("Could not insert %s into table desktops: %s\n\n", $name, mysql_error());
        }
    }
    
    printf("Process complete");
?>
