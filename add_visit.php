<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
	<head>
		<title>Schedule Visit</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
		<link rel="stylesheet" type="text/css" href="hospital.css" />
	</head>
	<body>
		<script>
			webshim.polyfill('forms forms-ext');
		</script>
<?php

if (is_admin()) {
	$ssn = $_REQUEST['SSN'];
} else {
	$ssn = $_SESSION['current_ssn'];
}

$date = $_REQUEST['DATE'];

?>

		<div class='content'>
			<h1>Schedule Visit</h1>
			<form>
				<input type='hidden' name='SUBMIT' value='1' />
				<table>
<?php
if (is_admin()) {
?>
					<tr>
						<td style='text-align: right'>SSN:</td>
						<td><input type='text' name='SSN' value='<?php echo $ssn; ?>' /></td>
					</tr>
<?php
}
?>
					<tr>
						<td style='text-align: right'>Date:</td>
						<td><input type='date' name='DATE' value='<?php echo $date; ?>' /></td>
					</tr>
				</table>
				<input type='submit' />
			</form>
			<br />

<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	$sql = "INSERT INTO Visit (Date) VALUES (STR_TO_DATE(?, '%Y-%m-%d'));";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $date);
	if ($stmt->execute()) {
		$id = $conn->insert_id;
		$sql = "INSERT INTO `Patient Visit` (SSN, `Visit ID`) VALUES (?, ?);";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('dd', $ssn, $id);
		
		if ($stmt->execute()) {

			if (is_admin()) {
				echo "<h2>Visit added successfully</h2>";
				echo "<a href='add_visit_physician.php?VISITID=$id'>Add physician to visit</a>";
				echo "<br />";
			} else {
				echo "<h2>Visit successfully scheduled</h2>";
			}
		} else {
			echo "<h2>Failed to add patient to visit: " . $conn->error . "</h2>";
		}
	} else {
		echo "<h2>Failed to add visit: " . $conn->error . "</h2>";
	}
}

$conn->close();
?>

<?php
if (is_admin()) {
	echo "<a href='admin_main.php'>Home</a>";
} else {
	echo "<a href='user_main.php'>Home</a>";
}
?>
		</div>
	</body>
</html>
