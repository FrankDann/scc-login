<?php
/*
* Page that will allow page connect to the Access DB to display content.
* User: Andre
 * Date: 3/1/2019
* Last edit:3/26/2019
 */

// Define database constants
define ('DB_HOSTNAME', 'localhost');            // The computer the database is on
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'scanner');              // The name of the database

// Create a new database connection using the mysqli driver (see p271)
$connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

?>




