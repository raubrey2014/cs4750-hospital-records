<?php 
include 'login.php';
validate_creds();
if (is_admin()) {
	include 'header.html';
} else {
	include 'header_patient.html';
}
?>
		<script>
			webshim.polyfill('forms forms-ext');
		</script>
<?php

if (is_admin()) {
	$ssn = $_REQUEST['SSN'];
} else {
	$ssn = $_SESSION['current_ssn'];
}


?>

		<div class='content'>
			<h1>Schedule Visit</h1>
			<form>
				<input type='hidden' name='SUBMIT' value='1' />
				<table>
<?php
if (is_admin()) {
	if (isset($_REQUEST['SUBMIT'])){
?>
					<tr>
						<td style='text-align: right'>SSN:</td>
						<td><input type='text' name='SSN' value='<?php echo $ssn; ?>' /></td>
					</tr>
<?php
	}
	else {
		?>
		
					<tr>
						<td style='text-align: right'>SSN:</td>
						<td><input type='text' name='SSN' value='' /></td>
					</tr>
	<?php
	}
}
if (isset($_REQUEST['SUBMIT'])){
?>
					<tr>
						<td style='text-align: right'>Date:</td>
						<td><input type='date' name='DATE' value='<?php echo $date; ?>' /></td>
					</tr>
				</table>
				<input type='submit' />
			</form>
<?php } else {
				?>
				<tr>
						<td style='text-align: right'>Date:</td>
						<td><input type='date' name='DATE' value='' /></td>
					</tr>
				</table>
				<input type='submit' />
			</form>
<?php } ?>
 
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if (isset($_REQUEST['SUBMIT'])) {
	$date = $_REQUEST['DATE'];

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

if (is_admin()) {
	include 'footer.html';
} else {
	include 'footer_patient.html';
}
?>
