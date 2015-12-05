<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
	<head>
		<title>Update Patient</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
		<link rel="stylesheet" type="text/css" href="hospital.css" />
	</head>
	<body>
		<script>
			webshim.polyfill('forms forms-ext');
		</script>
		<h1>Update Patient</h1>
<?php

if (is_admin()) {
	$ssn = $_REQUEST['SSN'];
} else {
	$ssn = $_SESSION['current_ssn'];
}

$name = $_REQUEST['NAME'];
$dob = $_REQUEST['DOB'];
$email = $_REQUEST['EMAIL'];
$phone = $_REQUEST['PHONE'];
$address = $_REQUEST['ADDRESS'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "UPDATE Patient SET Name = ?, DOB = STR_TO_DATE(?, '%Y-%m-%d'), Email = ?, `Phone Number` = ?, Address = ? WHERE SSN = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssssd', $name, $dob, $email, $phone, $address, $ssn);
	if ($stmt->execute()) {
		echo "<h2>Patient info successfully updated</h2>";
	} else {
		echo "<h2>Failed to add patient: " . $conn->error . "</h2>";
	}
}

$sql = "SELECT Name, DATE_FORMAT(DOB, '%Y-%m-%d'), Email, `Phone Number`, Address FROM Patient WHERE SSN = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('d', $ssn);
$stmt->execute();
$stmt->bind_result($name, $dob, $email, $phone, $address);
$stmt->fetch();

$conn->close();
?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>SSN:</td>
			<td><input type='text' name='SSN' value='<?php echo "$ssn" ?>' readonly /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Name:</td>
			<td><input type='text' name='NAME' value='<?php echo "$name" ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Date of Birth:</td>
			<td><input type='date' name='DOB' value='<?php echo "$dob" ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Email:</td>
			<td><input type='text' name='EMAIL' value='<?php echo "$email" ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Phone:</td>
			<td><input type='text' name='PHONE' value='<?php echo "$phone" ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Address:</td>
			<td><input type='text' name='ADDRESS' value='<?php echo "$address" ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>
<br />
<?php
if (is_admin()) {
	echo "<a href='admin_main.php'>Home</a>";
} else {
	echo "<a href='user_main.php'>Home</a>";
}
?>

</body>
</html>
