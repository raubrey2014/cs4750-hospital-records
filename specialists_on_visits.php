<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>Specialists on a Visit</h1>
<form>
    <input type='hidden' name='SUBMIT' value='1' />
    Date of visit: <input type='date' name='DATE' value='<?php echo $_REQUEST['DATE'] ?>' />
    <!-- Patient SSN: <input type='text' name='PATIENT_SSN' value='Example' /> -->
    <?php
    $sql = "SELECT * FROM Patient";
    $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
    if ($conn->connect_error) {

     die("Connection failed: " . $conn->connect_error);

    }
    else{
        $result = $conn->query($sql);
        echo "Patient SSN: <select name='PATIENT_SSN'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['SSN'] . "'>" . $row['SSN'] . "</option>";
        }
        echo "</select>";
    }
    ?>
	<input type='submit' />
</form>

<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
}
else if (isset($_REQUEST['SUBMIT'])) {
 
    	$x = $_REQUEST['PATIENT_SSN'];
    	$y = $_REQUEST['DATE'];
        $init = "SELECT count(*) as initCount FROM `Patient Visit` NATURAL JOIN Patient NATURAL JOIN Visit WHERE SSN = $x AND Date = STR_TO_DATE('$y', '%Y-%m-%d')";
        $result = $conn->query($init);
        $row0 = $result->fetch_assoc();
	$number_of_visits = $row0['initCount'];
        $sql = "SELECT `Visit ID` FROM `Patient Visit` NATURAL JOIN Patient NATURAL JOIN Visit WHERE SSN = $x AND Date = STR_TO_DATE('$y', '%Y-%m-%d')";
        $result = $conn->query($sql);
        echo "<h1>There were $number_of_visits visit(s) on $y</h1>";
        while ($row = $result->fetch_assoc()) {

            $visit_num = $row['Visit ID'];
    		echo "<h2>Results from visit $visit_num</h2>";
    		specialization($visit_num);
            echo "<hr>";

        }
}

function specialization($number){
        $conn2 = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        $sql2 = "SELECT Name, Specialization FROM Physician NATURAL JOIN `Physician Visit` WHERE `Visit ID` = '$number'";
        $result2 = $conn2->query($sql2);

        if ($conn2->connect_error) {
               die("Connection failed: " . $conn2->connect_error);

        }
        else {
            if ($row = $result2->fetch_assoc()){
                ########################################
                $sql3 = "SELECT Specialization, count(*) as SpecCount FROM Physician NATURAL JOIN `Physician Visit` WHERE `Visit ID` = '$number' GROUP BY Specialization";
                $result3 = $conn2->query($sql3);
                if ($conn2->connect_error) {
                       die("Connection failed: " . $conn2->connect_error);

                }
                else {
                    echo "<table class='result-list' cellspacing='5px'>";
                    echo "<tr><th>Specialization</th><th>Number Attended</th></tr>";
                    while ($row3 = $result3->fetch_assoc()):
                        $spec = $row3['Specialization'];
                        $specCount = $row3['SpecCount'];
                        echo "<tr><td>$spec</td><td>$specCount</td></tr>";

                    endwhile;
                    echo "</table><br>";

                }
                ########################################
                echo "<table class='result-list' cellspacing='5px'>";
                echo "<tr><th>Name</th><th>Specialization</th>";
                $name = $row['Name'];
                $spec = $row['Specialization'];
                echo "<tr><td>$name</td><td>$spec</td></tr>";
                while ($row2 = $result2->fetch_assoc()):
                    echo "<tr>";
                    foreach($row2 as $key2=>$value2):
                	   echo "<td>" . $value2 . "</td>";
                    endforeach;
                    echo "</tr>";
                endwhile;
                echo "</table>";
            }
            else{
                echo "There were no Physicians involved in this visit.";
            }
        }

}

?>
<br />

<?php include 'footer.html'; ?>
