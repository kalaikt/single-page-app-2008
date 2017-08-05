<?php
include'config.inc';
$result = mysql_query("SELECT name, P_Name FROM test, familymembers");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

// Assuming name is in the people table
$table = mysql_field_table($result, 'P_Name');
echo $table; // people
?> 