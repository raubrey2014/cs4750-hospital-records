<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
<head>
</head>
<body>
<h1>CS4750</h1>
<?php

$id = $_REQUEST['ID'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "DELETE FROM Physician WHERE `Physician ID` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('d', $id);
	if ($stmt->execute()) {
		echo "<h2>Successfully removed physician</h2>";
	} else {
		echo "<h2>Could not remove physician</h2>";
	}
}

$conn->close();
?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td style='text-align: right'>Physician ID:</td>
			<td><input type='text' name='ID' value='<?php echo $id; ?>' /></td>
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
