<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
<head>	
		<link rel="stylesheet" type="text/css" href="hospital.css" />

</head>
<body>
<h1>View Visits</h1>
	<div class='content'>

<?php
//specialization('Diagnostician', 1);
if(isset($_POST['specialization'])){
	specilization(trim(strip_slashes($_POST['specialization'])), 1);
}

function specialization($spec, $number){
	$conn2 = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
	$sql2 = "SELECT Name, Specialization FROM Physician NATURAL JOIN `Physician Visit` WHERE `Specialization` = '$spec' AND `Visit ID` = '$number'";
        $result2 = $conn2->query($sql2);

	if ($conn2->connect_error) {
 	       die("Connection failed: " . $conn2->connect_error);

	}
	else {
		while ($row2 = $result2->fetch_assoc()):
                        foreach($row2 as $key2=>$value2):
                                echo "<p>$key2 => $value2</p>";
                        endforeach;
                endwhile;
	}
}

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	$sql = "SELECT `Visit ID`, Date, Name, Illness, `Treatment Name` FROM Visit NATURAL JOIN `Patient Visit` NATURAL JOIN `Patient` NATURAL JOIN `Visit Diagnosis` NATURAL JOiN `Visit Treatment` WHERE 1";
    $result = $conn->query($sql);
    echo "<h4>Visits resulting in a Diagnosis</h4>";
	echo "<table class='result-list'>";
	echo "<tr><th>Visit ID</th><th>Date</th><th>Patient Name</th><th>Diagnosis</th><th>Treatment</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		foreach($row as $key=>$value){
			echo "<td>$value</td>";
		}
		echo "</tr>";
	endwhile;
	echo "</table>";
	$sql = "SELECT `Visit ID`, Date, Name FROM Visit NATURAL JOIN `Patient Visit` NATURAL JOIN `Patient` WHERE 1";
	$result = $conn->query($sql);
    echo "<h4>Visits not resulting in a Diagnosis</h4>";
	echo "<table class='result-list'>";
	echo "<tr><th>Visit ID</th><th>Date</th><th>Patient Name</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		foreach($row as $key=>$value){
			echo "<td>$value</td>";
		}
		echo "</tr>";
	endwhile;
	echo "</table>";

	
}
$conn->close();
?>
</div>
</body>
</html>
