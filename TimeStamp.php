<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 3/31/2019
 * Time: 9:37 AM
 */
require_once ('Db/dbConnect.php');

if (isset($_SESSION['class']))
{
    // Pull class name
    $class = $_SESSION['class'];
}

    //search record for student's log out time and output into an array
    $search = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `LogOut Time` from `current appts` where `STAR_ID` = '$student' order by dID desc limit 1;"));

    //See if the user also has a record that has not been logged out yet
    $LogOutStatus = mysqli_fetch_assoc(mysqli_query($connection,"select `logout time` from `current appts` where STAR_ID = '$student'order by dID desc limit 1;"));


    //If user does not have a time stamp, then we will put one in.
    //OR If the user already has a timestamp and log out time is not still 0's

if ($search == null || !($LogOutStatus["logout time"] == '0000-00-00 00:00:00')){
    //Get students name for output string
    $stringStuName = @implode("", mysqli_fetch_assoc(mysqli_query($connection,"Select Student from `current reg stu` where STAR_ID = '$student';")));

    //Create a new entry for student in system
    mysqli_query($connection, "Insert into `current appts`(STAR_ID, Subject) values ('$student', '$class');");
    //Output that student was logged in
    $message = "<div id='success'>Logged in $stringStuName</div>";
    session_destroy();
	 echo('<script type = "text/javascript" src = "timeout.js"></script>');
} else {
    //Logs student out by updating the 'LogOut' part of entry that was found
    $insert = mysqli_query($connection, "Update `current appts` set `LogOut Time` = CURRENT_TIMESTAMP where `STAR_ID` = '$student' order by dID desc limit 1;");

    //Get students name for output string
    $stringStuName = @implode("", mysqli_fetch_assoc(mysqli_query($connection, "Select Student from `current reg stu` where STAR_ID = '$student';")));
    //Output student was logged out
    $message = "<div id='success'>Logged out $stringStuName.</div>";
    session_destroy();
	echo('<script type = "text/javascript" src = "timeout.js"></script>');
}
?>


