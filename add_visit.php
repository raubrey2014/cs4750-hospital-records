<!DOCTYPEhtml>
<html>
	<head>
		<title>Add Visit</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
		<link rel="stylesheet" type="text/css" href="hospital.css" />
	</head>
	<body>
		<script>
			webshim.polyfill('forms forms-ext');
		</script>
<?php

$id = $_REQUEST['VISITID'];
$ssn = $_REQUEST['SSN'];
$date = $_REQUEST['DATE'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	$sql = "INSERT INTO Visit (`Visit ID`, Date) VALUES (?, STR_TO_DATE(?, '%Y-%m-%d'));";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ds', $id, $date);
	if ($stmt->execute()) {
		$sql = "INSERT INTO `Patient Visit` (SSN, `Visit ID`) VALUES (?, ?);";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('dd', $ssn, $id);
		
		if ($stmt->execute()) {
			$encid = urlencode($id);
			echo "<h2>Visit added successfully</h2>";
			echo "<a href='add_visit_physician.php?VISITID=$encid'>Add physician to visit</a>";
			echo "<br />";
		} else {
			echo "<h2>Failed to add patient to visit: " . $conn->error . "</h2>";
		}
	} else {
		echo "<h2>Failed to add visit: " . $conn->error . "</h2>";
	}
}

$conn->close();
?>

<h1>Add Visit</h1>
<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>SSN:</td>
			<td><input type='text' name='SSN' value='<?php echo $ssn; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Date:</td>
			<td><input type='date' name='DATE' value='<?php echo $date; ?>' /></td>
		</tr>
		<tr>
			<td style='text-align: right'>Visit ID:</td>
			<td><input type='text' name='VISITID' value='<?php echo $id; ?>' /></td>
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
