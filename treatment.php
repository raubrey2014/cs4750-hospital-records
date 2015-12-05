<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<div class='content'>
<h1>View Treatments</h1>

<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	$sql = "SELECT * FROM Treatment WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Treatment Description</th><th>Duration</th><th>Frequency</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>" . $row['Treatment Description'] . "</td>";
		echo "<td>" . $row['Duration'] . "</td>";
		echo "<td>" . $row['Frequency'] . "</td>";
		echo "</tr>";
	endwhile;
}
?>
</table>
</div>

<?php
include 'footer.html';
?>
