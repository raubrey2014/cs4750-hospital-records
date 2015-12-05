<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Add common treatment for diagnosis</h1>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td>Diagnosis: </td>
			<td><input type='text' name='DIAG' value='<?php echo $_REQUEST['DIAG']; ?>' /></td>
		</tr>
		<tr>
			<td>Treatment: </td>
			<td><input type='text' name='TREAT' value='<?php echo $_REQUEST['TREAT']; ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>

<?php

$diag = $_REQUEST['DIAG'];
$treat = $_REQUEST['TREAT'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	// 
	$sql = "INSERT INTO DiagnosisTreatment (Illness, `Treatment Name`) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $diag, $treat);

	if ($stmt->execute()) {
		echo "<h2>Successfully added treatment</h2>";
	} else {
		echo "<h2>Error adding treatment</h2>";
	}
}

include 'footer.html';
?>
