<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
<head>
</head>
<body>
<h1>Frequency of visits with diagnosis</h1>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td>Patient SSN: </td>
			<td><input type='text' name='SSN' value='<?php echo $_REQUEST["SSN"]; ?>' /></td>
		</tr>
		<tr>
			<td>Diagnosis: </td>
			<td><input type='text' name='DIAG' value='<?php echo $_REQUEST["DIAG"]; ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>

<?php

$ssn = $_REQUEST['SSN'];
$diag = $_REQUEST['DIAG'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	// The average is the latest visit minus the first visit, all divided by the number of visits minus 1
	$sql = "SELECT (MAX(Date) - MIN(Date)), COUNT(Date) FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit NATURAL JOIN `Visit Diagnosis` NATURAL JOIN `Diagnosis` WHERE SSN = ? AND Illness = ?;";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('ds', $ssn, $diag);
	$stmt->execute();
	$stmt->bind_result($diff, $cnt);

	echo "******************************";
	while ($stmt->fetch()) {
		echo "<br>";
		if ($cnt === 0) {
			echo "Patient was never diagnosed with illness";
		} else {
			$avg = $diff / ($cnt - 1);
			echo "Patient averaged $avg days between visits with given illness";
		}
		echo "<br>";
		echo "******************************";
	}
}
?>
<br />
<a href='index.html'>
	Back
</a>
</body>
</html>
