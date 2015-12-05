<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
	<link rel="stylesheet" type="text/css" href="hospital.css" />
	<h1>View a Patient's History</h1>

	<form>
        <input type='hidden' name='SUBMIT' value='1' />
        Patient SSN:
        <?php
        $sql = "SELECT * FROM Patient";
        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

        }
        else{
            $result = $conn->query($sql);
            echo "<select name='PatientInfo'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['SSN'] . "'>" . $row['SSN'] . "</option>";
            }
            echo "</select>";
        }
        $conn->close();
        ?>
	<input type='submit' />
</form>
<?php 
if (isset($_REQUEST['SUBMIT'])){
	if (isset($_REQUEST['PatientInfo'])){
		$patient_name = "";
		$ssn = $_REQUEST['PatientInfo'];
		$sql = 	"SELECT Name FROM Patient WHERE SSN = '$ssn'";
        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);

        }
        else{
       		$result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            	$patient_name = $row['Name'];
            }
            echo "<h4>Results for patient $patient_name</h4>";
            echo "<table class='result-list'>";
			echo "<tr><th>Visit ID</th><th>Date</th><th>Diagnosis</th><th>Treatment</th></tr>";
        	$sql = "SELECT `Visit ID`, Date, Illness, `Treatment Name` FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit NATURAL LEFT JOIN `Visit Diagnosis` NATURAL LEFT JOIN `Visit Treatment` WHERE SSN = '$ssn'";
       		$result = $conn->query($sql);
        	while ($row = $result->fetch_assoc()) {
        		echo "<tr>";
        		foreach($row as $key=>$value){
        			echo "<td>$value</td>";
        		}
        		echo "</tr>";
            }
            echo "</table>";
        }


	}
}

include 'footer.html';
?>
