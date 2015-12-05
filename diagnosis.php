<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<div class='content'>
<h1>View Diagnoses</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	$sql = "SELECT * FROM Diagnosis WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Illness</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>" . $row['Illness'] . "</td>";
		echo "</tr>";
	endwhile;
	echo "</table>";
}
?>
</div>
<?php include 'footer.html'; ?>