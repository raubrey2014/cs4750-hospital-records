<!DOCTYPEhtml>
<html>
	<head>
		<title>Add Patient</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
		<link rel="stylesheet" type="text/css" href="hospital.css" />
	</head>
	<body>
		<script>
			webshim.polyfill('forms forms-ext');
		</script>
		<h1>Add Patient</h1>
<?php

$ssn = $_REQUEST['SSN'];
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
	$sql = "INSERT INTO Patient (SSN, Name, DOB, Email, `Phone Number`, Address) VALUES (?, ?, STR_TO_DATE(?, '%Y-%m-%d'), ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('dsssss', $ssn, $name, $dob, $email, $phone, $address);
	if ($stmt->execute()) {
		echo "<h2>Patient successfully added</h2>";
	} else {
		echo "<h2>Failed to add patient: " . $conn->error . "</h2>";
	}
}

$conn->close();
?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>SSN:</td>
			<td><input type='text' name='SSN' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Name:</td>
			<td><input type='text' name='NAME' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Date of Birth:</td>
			<td><input type='date' name='DOB' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Email:</td>
			<td><input type='text' name='EMAIL' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Phone:</td>
			<td><input type='text' name='PHONE' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Address:</td>
			<td><input type='text' name='ADDRESS' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>
<br />
<a href='site_admin.html'>
	Back
</a>

</body>
</html>
