<!DOCTYPEhtml>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="hospital.css" />
</head>
<body>
<div class='content'>
<h1>Physicians</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT * FROM Physician WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Physician ID</th><th>Salary</th><th>Name</th><th>Specialization</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>" . $row['Physician ID'] . "</td>";
		echo "<td>" . $row['Salary'] . "</td>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['Specialization'] . "</td>";
		echo "</tr>";
	endwhile;
}
?>
</div>
</body>
</html>
