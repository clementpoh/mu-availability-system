<?php
    // manage.php
    // Clement Poh
    //
    // Handles simple database operations.
    require_once('../settings.php');
    require_once('../lib/avail.php');

    if (isset($_GET['remove'])) {
        $query = sprintf("DELETE FROM desktops WHERE id='%s'", $_GET['remove']);
        if($result = mysql_query($query)) {
            header('Location: edit.php?remove=1');
            exit;
        } else {
            header('Location: edit.php?remove=0');
            exit;
        }
    } else if (isset($_POST['add'])) {
        $query = sprintf("INSERT INTO desktops 
                          (name, location, sublocation, ipaddress)
                          VALUES ('%s', '%s', '%s', '%s')", 
                            mysql_real_escape_string($_POST['name']),
                            mysql_real_escape_string($_POST['location']),
                            mysql_real_escape_string($_POST['sublocation']),
                            mysql_real_escape_string($_POST['ip'])
                        );  
        if($result = mysql_query($query)) {
            header('Location: edit.php?add=1');
            exit;
        } else {
            header('Location: edit.php?add=0');
            exit;
        }
    } else {
        header('Location: edit.php');
    }
?>
