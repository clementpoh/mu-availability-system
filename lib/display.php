<?php
    require_once("../lib/avail.php");

    // Prints out the most recent information related to all the computers in
    // the database.
    function showDetailDesktopTable($statuslist) {
        $cols = array_shift($statuslist);

        $out = "<table><thead><tr>";
        $out .= "<th>Location</th>";
        $out .= "<th>Sub-location</th>";
        $out .= "<th>{$cols[0]}</th>";
        $out .= "<th>{$cols[1]}</th>";
        $out .= "<th>{$cols[2]}</th>";
        $out .= "<th>{$cols[3]}</th>";
        $out .= "<th>{$cols[4]}</th>";
        $out .= "<th>{$cols[5]}</th>";
        $out .= "</tr></thead><tbody>";

        // Retrieve a list of computers in the location, and sublocations within the location.
        $query = sprintf("SELECT * FROM desktops");
        $result = mysql_query($query);

        while($desktop = mysql_fetch_assoc($result)) {
            if(($status = getCompFrom($desktop["name"], $statuslist))) {
                // Desktop found, output the information related to it.
                $out .= "<tr>";
                $out .= "<td>{$desktop["location"]}</td>";
                $out .= "<td>{$desktop["sublocation"]}</td>";
                $out .= "<td>{$status[0]}</td>";
                $out .= "<td class='{$status[1]}'>&nbsp</td>";
                $out .= "<td>{$status[2]}</td>";
                $out .= "<td>{$status[3]}</td>";
                $out .= "<td>{$status[4]}</td>";
                $out .= "<td>{$status[5]}</td>";
                $out .= "</tr>";
            } else {
                $out .= "<tr>";
                $out .= "<td>{$desktop["location"]}</td>";
                $out .= "<td>{$desktop["sublocation"]}</td>";
                $out .= "<td>{$desktop["name"]}</td>";
                $out .= "<td colspan='5' class='warning'>Error: {$desktop["name"]} could not be found in the audit trail. </td>";
                $out .= "</tr>";
            }
        }
       
       $out .= "</tbody></table>";
       echo $out;
    }

    // Prints out the most recent information related to all the computers in
    // the database. with the additional option of removing entries in the
    // active table.
    function editFullDesktopTable($statuslist) {
        $cols = array_shift($statuslist);

        $out = "<table><thead><tr>";
        $out .= "<th>Location</th>";
        $out .= "<th>Sub-location</th>";
        $out .= "<th>{$cols[0]}</th>";
        $out .= "<th>{$cols[1]}</th>";
        $out .= "<th>{$cols[2]}</th>";
        $out .= "<th>{$cols[3]}</th>";
        $out .= "<th>{$cols[4]}</th>";
        $out .= "<th>{$cols[5]}</th>";
        $out .= "<th>Remove</th>";
        $out .= "</tr></thead><tbody>";

        // Retrieve a list of computers in the location, and sublocations within the location.
        $query = sprintf("SELECT * FROM desktops");
        $result = mysql_query($query);

        while($desktop = mysql_fetch_assoc($result)) {
            if(($status = getCompFrom($desktop["name"], $statuslist))) {
                // Desktop found, output the information related to it.
                $out .= "<tr>";
                $out .= "<td>{$desktop["location"]}</td>";
                $out .= "<td>{$desktop["sublocation"]}</td>";
                $out .= "<td>{$status[0]}</td>";
                $out .= "<td class='{$status[1]}'>&nbsp</td>";
                $out .= "<td>{$status[2]}</td>";
                $out .= "<td>{$status[3]}</td>";
                $out .= "<td>{$status[4]}</td>";
                $out .= "<td>{$status[5]}</td>";
                $out .= "<td class='warning'><a href='manage.php?remove={$desktop["id"]}'>x</a></td>";
                $out .= "</tr>";
            } else {
                $out .= "<tr>";
                $out .= "<td>{$desktop["location"]}</td>";
                $out .= "<td>{$desktop["sublocation"]}</td>";
                $out .= "<td>{$desktop["name"]}</td>";
                $out .= "<td colspan='5' class='warning'>Error: {$desktop["name"]} could not be found in the audit trail. </td>";
                $out .= "<td class='warning'><a href='manage.php?remove={$desktop["id"]}'>x</a></td>";
                $out .= "</tr>";
            }
        }

        foreach($statuslist as $desktop) {
            $out .= "<tr>";
            $out .= "<td colspan='2' class='warning'>Untracked Computer</td>";
            $out .= "<td>{$desktop[0]}</td>";
            $out .= "<td colspan='6' class='notice'>{$desktop[2]}: Last {$desktop[1]} at {$desktop[3]} by {$desktop[4]}</td>";
            $out .= "</tr>";
        }
       
       $out .= "</tbody></table>";
       echo $out;
    }
    
    // Returns a record of a computer matching $name in $stauslist.
    function getCompFrom($name, $statuslist) {
        foreach($statuslist as $i=>$status) {
            if($name == $status[0]) {
                unset($statuslist[$i]);
                return $status;
            }
        }
        return NULL;
    }

    function dumpAuditTrail() {
        $statuslist = readAuditTrail();

        $out = "<table><thead><tr>";
        foreach(array_shift($statuslist) as $col) {
            $out .= "<th>$col</th>";
        }
        $out .= "</tr></thead><tbody>";

        foreach($statuslist as $status) {
            $out .= "<tr>";
            foreach($status as $field) {
                $out .= "<td> $field </td>";  
            }
            $out .= "</tr>";
        }
       
       $out .= "</tbody></table>";
       echo $out;
    }
?>
