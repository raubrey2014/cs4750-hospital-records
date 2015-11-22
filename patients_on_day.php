<!DOCTYPEhtml>
<html>
<head>
</head>
<body>
<h1>Patients Visited on Date</h1>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	Date: <input type='text' name='DATE' />
	<br />
	<input type='submit' />
</form>

<?php

$day = $_REQUEST['DATE'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT SSN, Name, DOB, Email, `Phone Number`, Address FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit WHERE Date = STR_TO_DATE(?, '%m/%d/%Y')";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $day);
	$stmt->execute();
	$stmt->bind_result($ssn, $name, $dob, $email, $phone, $address);

	echo "******************************";
	while ($stmt->fetch()) {
		echo "<table>";
		echo "<tr><td style='text-align: right;'>SSN:</td><td>" . $ssn . "</td></tr>";
		echo "<tr><td style='text-align: right;'>Name:</td><td>" . $name . "</td></tr>";
		echo "<tr><td style='text-align: right;'>Date of Birth:</td><td>" . $dob . "</td></tr>";
		echo "<tr><td style='text-align: right;'>Email:</td><td>" . $email . "</td></tr>";
		echo "<tr><td style='text-align: right;'>Phone Number:</td><td>" . $phone . "</td></tr>";
		echo "<tr><td style='text-align: right;'>Address:</td><td>" . $address . "</td></tr>";
		echo "</table>";
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
