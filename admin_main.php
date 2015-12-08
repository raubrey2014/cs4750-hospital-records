<?php 
include 'login.php';
validate_creds();

include 'header.html';

?>

<div class='content'>
<h1>Admin Portal</h1>
<p>Welcome to the admin portal.</p>

<h1>Physicians in Visits Today</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

	die("Connection failed: " . $conn->connect_error);

} else {
	$sql = "SELECT * FROM `Physician Daily Schedule`";
	$result = $conn->query($sql);
	echo "<table class='result-list'>";
	echo "<tr><th>Physician Name</th><th>Visit ID</th></tr>"; 
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['Physician Name'] . "</td>";
		echo "<td>" . $row['Visit ID'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$conn->close();
}

?>

</div>

<?php include 'footer.html' ?>
