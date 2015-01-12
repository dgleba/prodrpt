<?php

require_once "configdbphp.dbc";


$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname);

$return_arr = array();

/* If connection to database, run sql statement. */
if ($conn) {
    $fetch = mysql_query("SELECT * FROM pr_machine where machine_description like '%" . mysql_real_escape_string($_GET['term']) . "%'");

    /* Retrieve and store in array the results of the query. */
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['machine_num_list'] = $row['machine_num_list'];
        $row_array['value'] = $row['machine_description'];

        array_push($return_arr, $row_array);
    }
}

/* Free connection resources. */
mysql_close($conn);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);
