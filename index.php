<?php
/**
 * For: Frank Dann & Andrew Brethauer Capstone Project
 * Created date: 2/24/2019
 * Last Edit: 4/23/2019
 */
$message ='';
require_once ('Db/dbConnect.php'); // refer to dbConnect for obtaining SQL information
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   session_start();

   // Pull name of student from form
   if(isset($_POST['studentID']))
	{
      $_SESSION['studentID'] = @substr($_POST['studentID'],5,8);
   }

   if(isset($_SESSION['studentID']))
   {
      $id = $_SESSION['studentID'];
      $sql1 = "select STAR_ID from `Current Reg Stu` where TECH_ID = $id";
      $statement = @mysqli_query($connection,$sql1);
      $result = @mysqli_fetch_assoc($statement);
      if (!empty($result))
      {
          $student =implode($result);
          if(isset($_POST['classes']))
          {
              $_SESSION['class'] = $_POST['classes'];
              $class = $_SESSION['class'];
          }
          
          //search record for student's log out time and output into an array
          $search = @mysqli_fetch_assoc(mysqli_query($connection, "SELECT `LogOut Time` from `current appts` where `STAR_ID` = '$student' order by dID desc limit 1;"));
          
          //See if the user also has a record that has not been logged out yet
          $LogOutStatus = @mysqli_fetch_assoc(mysqli_query($connection,"select `logout time` from `current appts` where STAR_ID = '$student'order by dID desc limit 1;"));
          if ($search == null || !($LogOutStatus["logout time"] == '0000-00-00 00:00:00'))
          {
              if (!(isset($_SESSION['class'])))
              {
                  header('location: login.php');
                  die;
              }
              include_once('timeStamp.php');
            }
            else if ($LogOutStatus["logout time"] == '0000-00-00 00:00:00')
            {
                include_once('timeStamp.php');
            }
        }
        else
        {
			// Error message for invalid student ID
            echo("<div id='error'>Student not found.</div>");
            echo('<script type = "text/javascript" src = "timeout.js"></script>');
        }
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style/stylesheet.css">
    <meta charset="UTF-8">
    <title>Tutoring Sign-In</title>
</head>
<body>


<!--Logo Header-->
    <table style="width: 100%">
        <thead><?= $message; ?></thead>
        <tr>
            <td>
                <img src="Style/img/SCCASCLOGO.jpg" class="ascIMG" alt="Acedemic Support Center">
            </td>

            <td>
                <img src="Style/img/SCC_Logo_Vert_RGB.jpg" class="sccIMG" alt="SCC Logo">
            </td>
        </tr>
    </table>

    <div class="padding">
        <div class="wContainer">
            <h1>Tutoring Sign-In</h1>

            <!--Form for ID scan-->
            <h3>Please scan Student ID</h3>
            <form method="post" action ="index.php" id="signin">
                <label for="studentID">Student ID</label>
                 <input type="name" name="studentID" id="studentID" onchange="this.form.submit()" required autofocus>

            </form>
        </div>
    </div>

</body>
</html>