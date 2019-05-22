<?php
require_once ('Db/dbConnect.php'); // refer to dbConnect for obtaining SQL information
// Pull classes listing from database
$sql2 = "select * from `Current Classes`";
$statement = mysqli_query($connection,$sql2);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style/stylesheet.css">
</head>
	<body>

    <!--Logo Header-->
    <table style="width: 100%">
        <thead></thead>
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
            <h3>Please select a class</h3>
            <form method="post" action ="index.php" id="signin">
                <select name="classes" onchange="this.form.submit()" required>
                <option value="" disabled selected>Select your class</option>
                <?php while($row = mysqli_fetch_assoc($statement)): ?>
                <option value="<?= $row['Class'] ?>"><?= $row['Class'] ?></option>
                <?php endwhile; ?>
                </select>
            </form>
        </div>
    </div>
	</body>
</html>