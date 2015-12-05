<?php 
include 'login.php';
validate_creds();
include 'header_patient.html';
?>
	<link rel="stylesheet" type="text/css" href="hospital.css" />
	<h1>My History</h1>
<?php 

$ssn = $_SESSION['current_ssn'];
$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
if ($conn->connect_error) {

	die("Connection failed: " . $conn->connect_error);

}
else{
	echo "<table class='result-list'>";
	echo "<tr><th>Visit ID</th><th>Date</th><th>Diagnosis</th><th>Treatment</th></tr>";
	$sql = "SELECT `Visit ID`, Date, Illness, `Treatment Description` FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit NATURAL LEFT JOIN `Visit Diagnosis` NATURAL LEFT JOIN `Visit Treatment` WHERE SSN = '$ssn'";
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

include 'footer_patient.html';
?>
