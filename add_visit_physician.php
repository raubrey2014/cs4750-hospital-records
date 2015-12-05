<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
	<head>
		<title>Add Visit</title>
	</head>
	<body>
<?php

$visitid = $_REQUEST['VISITID'];
$physicianid = $_REQUEST['PHYSICIANID'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	$sql = "INSERT INTO `Physician Visit` (`Physician ID`, `Visit ID`) VALUES (?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('dd', $physicianid, $visitid);
	if ($stmt->execute()) {
		echo "<h2>Physician added to visit successfully</h2>";
	} else {
		echo "<h2>Failed to add visit: " . $conn->error . "</h2>";
	}
}

$conn->close();
?>

<h1>Add Physician to Visit</h1>
<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>Physician ID:</td>
			<td><input type='text' name='PHYSICIANID' value='<?php echo "$physicianid" ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Visit ID:</td>
			<td><input type='text' name='VISITID' value='<?php echo "$visitid" ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>
<br />
<a href='receptionist.html'>
	Back
</a>

</body>
</html>
