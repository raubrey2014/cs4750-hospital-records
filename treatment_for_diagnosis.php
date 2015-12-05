<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Frequency of treatment for diagnosis</h1>

<?php if (isset($_REQUEST['SUBMIT'])) { ?>
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
<?php } else { ?>
<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td>Diagnosis: </td>
			<td><input type='text' name='DIAG' value='' /></td>
		</tr>
		<tr>
			<td>Treatment: </td>
			<td><input type='text' name='TREAT' value='' /></td>
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
	// 
	$diag = $_REQUEST['DIAG'];
	$treat = $_REQUEST['TREAT'];
	$sql_diagnosis = "SELECT `Visit ID` FROM Visit NATURAL JOIN `Visit Diagnosis` NATURAL JOIN Diagnosis WHERE Illness = ?";
	$sql_treatment = "SELECT `Visit ID`, 1 AS num FROM Visit NATURAL JOIN `Visit Treatment` NATURAL JOIN Treatment WHERE `Treatment Description` = ?";
	$sql = "SELECT COUNT(*), SUM(num) FROM ($sql_diagnosis) AS diag LEFT OUTER JOIN ($sql_treatment) AS treat USING (`Visit ID`);";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $diag, $treat);
	$stmt->execute();
	$stmt->bind_result($total, $relevant);

	echo "<br />";
	if ($stmt->fetch()) {
		if ($total === 0) {
			echo "No information about diagnosis";
		} else {
			printf("%d time(s) / %d visit(s) = %.2f%%", $relevant, $total, 100 * $relevant / $total); 
		}
	} else {
		echo "<h2>Error retreiving information</h2>";
	}
	echo "<br />";
}
?>
<br />

<?php include 'footer.html'; ?>
