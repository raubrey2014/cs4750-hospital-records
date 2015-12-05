<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
        <head>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
                <link rel="stylesheet" type="text/css" href="hospital.css" />
        </head>
        <body>
                <script>
                        webshim.polyfill('forms forms-ext');
                </script>
<h1>Patients seen by a Physician on a Day</h1>

<form>
        <input type='hidden' name='SUBMIT' value='1' />
        Date: <input type='date' name='DATE' value='<?php echo $_REQUEST['DATE'] ?>' />
        Physician Name:
        <?php
        $sql = "SELECT `Physician ID`, Name FROM Physician";
        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

        }
        else{
            $result = $conn->query($sql);
            echo "<select name='PhysicianName'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Physician ID'] . "'>" . $row['Name'] . "</option>";
            }
            echo "</select>";
        }
        ?>
	<input type='submit' />
</form>

<?php

echo "<h1>In php main</h1>";
$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if (isset($_REQUEST['SUBMIT'])) {
        $day = $_REQUEST['DATE'];
        $physician = $_REQUEST['PhysicianName'];
        $sql = "SELECT * from Physician WHERE `Physician ID` = '$physician'";
        $row = $conn->query($sql)->fetch_assoc();
	$name = $row['Name'];
        echo $day ." ".$name;
        echo "<h1>Results for $name on $day</h1>";

        echo "<table class='result-list' cellspacing='5px'>";
        echo "<tr><th>Patient Visited</th></tr>";
        $init = "SELECT `Visit ID`, `SSN` FROM `Physician Visit` NATURAL JOIN Visit NATURAL JOIN `Patient Visit` WHERE `Physician ID` = '$physician' AND Date = STR_TO_DATE('$day', '%Y-%m-%d')" ;
        $result4 = $conn->query($init);
        $count = 0;

        while ($row = $result4->fetch_assoc()) {
            $patient = $row['SSN'];
            $patient_name = "SELECT Name FROM Patient WHERE SSN = $patient";
            $row2 = $conn->query($patient_name)->fetch_assoc();
            $name2 = $row2['Name'];
	    echo "<tr><td>$name2</td></tr>";
        }  
        echo "</table>";
        $init = "SELECT count(`Visit ID`) as initCount FROM `Physician Visit` NATURAL JOIN Visit WHERE `Physician ID` = '$physician' AND Date = STR_TO_DATE('$day', '%Y-%m-%d')" ;
<<<<<<< HEAD
        $row3 = $conn->query($init)->fetch_assoc();
	$count = $row3['initCount'];
        echo "<h3>$name saw a total of $count patients on $day</h3>";
=======
        $count = $conn->query($init)->fetch_assoc()['initCount'];
        echo "<h3>$name saw a total of $count patients on $day.</h3>";
>>>>>>> dd90bbcbc30a39fca1b59872d603a75db24dd61a
}
else{
	echo "<h1>In else</h1>";

}


?>
<br />

<a href='admin_main.php'>
        Back
</a>
</body>
</html>
