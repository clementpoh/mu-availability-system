<?php
    // locations.php
    // Clement Poh
    //
    // This file generates the main content for index.php. Primarily uses the 
    // functions in avail.php. The database username, password and address can 
    // be found in settings.php.
    //
    require_once("settings.php");
    require_once("lib/avail.php");

    echo "<br>";

    // Download the audit trail. The audit trail is a real-time list of 
    // computers showing whether the last action was a login or logout.
    $statuslist = readAuditTrail();

    // Parkville areas.
    $locations = array(
                    'Baillieu',
                    'Brownless',
                    'ERC',
                    'Giblin Eunson',
                    'Law',
                    );

    // Output the list in html.
    writeAvailabilityList($statuslist, $locations);

    echo "<br>";
    // Other campus locations.
    $locations = array('Burnley', 'Southbank', 'Werribee');
    writeAvailabilityList($statuslist, $locations);
?>
