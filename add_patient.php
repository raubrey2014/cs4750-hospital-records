<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<!DOCTYPEhtml>

<h1>Add Patient</h1>
<?php


$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if (isset($_REQUEST['SUBMIT'])) {

	$ssn = $_REQUEST['SSN'];
	$name = $_REQUEST['NAME'];
	$dob = $_REQUEST['DOB'];
	$email = $_REQUEST['EMAIL'];
	$phone = $_REQUEST['PHONE'];
	$address = $_REQUEST['ADDRESS'];
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

<?php if (isset($_REQUEST['SUBMIT'])) { ?>
<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>SSN:</td>
			<td><input type='text' name='SSN' value='<?php echo $ssn; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Name:</td>
			<td><input type='text' name='NAME' value='<?php echo $name; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Date of Birth:</td>
			<td><input type='date' name='DOB' value='<?php echo $dob; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Email:</td>
			<td><input type='text' name='EMAIL' value='<?php echo $email; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Phone:</td>
			<td><input type='text' name='PHONE' value='<?php echo $phone; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Address:</td>
			<td><input type='text' name='ADDRESS' value='<?php echo $address; ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>

<?php } else { ?>
<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>SSN:</td>
			<td><input type='text' name='SSN' value='' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Name:</td>
			<td><input type='text' name='NAME' value='' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Date of Birth:</td>
			<td><input type='date' name='DOB' value='<?php echo $dob; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Email:</td>
			<td><input type='text' name='EMAIL' value='' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Phone:</td>
			<td><input type='text' name='PHONE' value='' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Address:</td>
			<td><input type='text' name='ADDRESS' value='' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>
<?php } ?>
<br />
<a href='site_admin.html'>
	Back
</a>

<?php include 'footer.html'; ?>
