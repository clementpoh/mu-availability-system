<?php
    // avail.php
    // Clement Poh
    //
    // Contains the main logic and functionality to connect, read and process the 
    // audit trail, and output the computer availability lists in html form.
    //
    // Populates the computer list database, completely overwriting any 
    // previous content.
    //
    // The Availability System will only search for computers that are listed 
    // in the database.
    
    // Connect to the computer list database.
    $link = mysql_connect(DB_ADDRESS, DB_USERNAME, DB_PASSWORD) or die('Could not connect: ' . mysql_error());
    mysql_select_db(DB_NAME) or die("Could not select database");


    // This function connects to the audit trail and returns a two dimensional 
    // array according to the fields in the audit trail csv.
    //
    // The audit trail API returns a csv file of the computer names, IP 
    // addresses, usernames and most recent actions.
    function readAuditTrail() {
        $csv = fopen(AUDIT_LOCATION, "r");
        $len = 6; # There are 6 columns in the data.

        $i = 0;
        // Read all the computers in the audit trail into array $arr.
        while($data = fgetcsv($csv)) {
            for($j = 0; $j < $len; $j++) {
                // Remove junk characters in the csv fields.
                $trimmed = trim($data[$j], '="');

                $arr[$i][$j] = $trimmed;
            }
            $i++;
        }
        return $arr;
    }
    

    // Returns a list of the sublocations of $loc.
	function sublocations($loc) {
		$query = sprintf("SELECT DISTINCT sublocation FROM desktops WHERE location = '%s'", $loc);
		$result = mysql_query($query);

		while($a = mysql_fetch_array($result)) {
			$sublocations[$a['sublocation']]['total'] = 0;
			$sublocations[$a['sublocation']]['free'] = 0;
		}

		return $sublocations;
	}


    // Prints out the availability of all the computers in $locations in html 
    // including a nested list for each floor or sublocation in each location.
    function writeAvailabilityList($statuslist, $locations) {
        $out = "<ul>";
        
        // Iterate through each location in $locations.
        foreach($locations as $loc) {
            $desktops = locationAvail($statuslist, $loc);

            $free = $desktops['free'];
            $total = $desktops['total'];
            $sublocations = $desktops['sublocations'];

            // Output the total number of computers, and total number of free computers in HTML as list item. The classes and anchors are for the CSS.
            $out .= "<li><a href='javascript:;'>${loc}: <span><span class='avail'>$free available</span> <span class='out'>out of $total</span></span></a>";

            // Output a nested sublist in HTML to list each sublocation within a given location.
			$out .= "<ul>";
			foreach($sublocations as $sublocation_name => $sublocation_comps) {
                // Classes and anchors are for use with the CSS.
				$out .= "<li><a>$sublocation_name: <span class='avail'>{$sublocation_comps['free']} available</span> <span class='out'>out of {$sublocation_comps['total']}</span></a></li>";
			}
			$out .= "</ul></li>";
        }
        $out .= "</ul>";
        echo $out;
    }



    // Prints out the availability of all the computers in $locations in html as
    // a table.  Nearly identical to writeAvailabilityList, however it does not
    // print the sublocation sublist.
    function writeShallowTable($statuslist, $locations, $columns) {
        $out = "<table>";
        $cs = 0;

        foreach($locations as $loc) {
            $stats = locationAvail($statuslist, $loc);
            if ($cs == 0) {
                $out .= sprintf("<tr>%s", tableCell($loc, $stats['free'], $stats['total']));
                $cs++;
            } else if ($cs == $columns - 1) {
                $out .= sprintf("%s</tr>", tableCell($loc, $stats['free'], $stats['total']));
                $cs = 0;
            } else { 
                $out .= tableCell($loc, $stats['free']. $stats['total']);
                $cs++;
            }
        }
        $out .= "</table>";
        echo $out;
    }


    // Prints out the availability of all the computers in $locations in html as
    // an unordered list.  Nearly identical to writeAvailabilityList, however it
    // does not print the sublocation sublist.
    function writeShallowList($statuslist, $locations) {
        $out = "<ul>";

        foreach($locations as $loc) {
            $stats = locationAvail($statuslist, $loc);

            // Output the total number of computers, and total number of free
            // computers in HTML as a table cell.
            $out .= listItem($loc, $stats['free'], $stats['total']);
        }
        $out .= laptopListItem();
        $out .= "</ul>";
        echo $out;
    }


    // Returns an associative array of the total number of free computers in $loc.
    function locationAvail($statuslist, $loc) {
        // Retrieve a list of computers in the location, and sublocations within the location.
        $query = sprintf("SELECT * FROM desktops WHERE location = '%s' AND display = TRUE", $loc);
        $result = mysql_query($query);
        $sublocations = sublocations($loc);

        $free = 0;
        while($desktop = mysql_fetch_assoc($result)) {
            $sublocation = $desktop["sublocation"];
            // Update the total number of computers in the sublocation.
            $sublocations[$sublocation]["total"]++;

            // Find the computer in the audit trail array through a linear search.
            foreach($statuslist as $status) {
                // If its last action was a login, assume that it is currently in use.
                if($desktop["name"] == $status[0] && $status[1] == "logout") {
                    $sublocations[$sublocation]['free']++;
                    $free++;
                    break; // Go to the next computer in the location.
                }
            }
        }

        $total = mysql_num_rows($result);

        return array( "free" => $free, "total" => $total, "sublocations" => $sublocations);
    }

    // Output the total number of computers, and total number of free computers
    // in HTML as a table cell.
    function tableCell($loc, $free, $total) {
        return sprintf("<td>%s</td>", anchor($loc, $free, $total));
    }

    // Output the total number of computers, and total number of free computers
    // in HTML as a list item. 
    function listItem($loc, $free, $total) {
        return sprintf("<li>%s</li>", anchor($loc, $free, $total));
    }

    // Output the total number of computers, and total number of free computers
    // in HTML as an anchor. The classes and anchors are for the CSS.
    function anchor($loc, $free, $total) {
        return sprintf(" <a>%s: <span> <span class='avail'>%s available</span> <span class='out'>out of %s</span> </span></a>", $loc, $free, $total);
    }

    function getLaptopsAvailable() {
        $numberAvailable = 0;

        $file = fopen(LAPTOP_LOCATION, "r");
        while(!feof($file)) {

            $line = fgets($file);
            if (strpos($line, "<td") !== False) {
                if (strpos($line, "AVAILABLE") !== False) {
                    $numberAvailable++;
                }
            }
        }
        fclose($file);
        return $numberAvailable;
    }

    // Parses $LAPTOP_SITE to output the number of available laptops in the ERC.
    function writeLaptopList() {
        $available = getLaptopsAvailable();
        echo "<ul><li><a>ERC Laptops: <span class='avail'>$available available</span></a></li></ul>";
    }

    function laptopListItem() {
        $available = getLaptopsAvailable();
        return "<li><a>ERC Laptops: <span class='avail'>$available available</span></a></li>";
    }

    
?>

