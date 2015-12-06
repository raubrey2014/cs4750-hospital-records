<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>Frequency of visits with diagnosis</h1>
<?php if (isset($_REQUEST['SUBMIT'])) { ?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td>Patient SSN: </td>
			<?php
	        $sql = "SELECT `SSN`, Name FROM Patient";
	        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
	        if ($conn->connect_error) {

	         die("Connection failed: " . $conn->connect_error);

	        }
	        else{
	            $result = $conn->query($sql);
	            echo "<td><select name='SSN'>";
	            while ($row = $result->fetch_assoc()) {
	                echo "<option value='" . $row['SSN'] . "'>" . $row['SSN'] . "</option>";
	            }
	            echo "</select></td>";
	        }
	        ?>
		</tr>
		
		<tr>
			<td>Diagnosis: </td>
			<td><input type='text' name='DIAG' value='<?php echo $_REQUEST["DIAG"]; ?>' /></td>
		</tr>
	</table>
	<input type='submit' />
</form>
<?php } else { ?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<table>
		<tr>
			<td>Patient SSN: </td>
			<?php
	        $sql = "SELECT `SSN`, Name FROM Patient";
	        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
	        if ($conn->connect_error) {

	         die("Connection failed: " . $conn->connect_error);

	        }
	        else{
	            $result = $conn->query($sql);
	            echo "<td><select name='SSN'>";
	            while ($row = $result->fetch_assoc()) {
	                echo "<option value='" . $row['SSN'] . "'>" . $row['SSN'] . "</option>";
	            }
	            echo "</select></td>";
	        }
	        ?>
		</tr>
		<tr>
			<td>Diagnosis: </td>
			<td><input type='text' name='DIAG' value='' /></td>
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
	$ssn = $_REQUEST['SSN'];
	$diag = $_REQUEST['DIAG'];

	// The average is the latest visit minus the first visit, all divided by the number of visits minus 1
	$sql = "SELECT Name, (MAX(Date) - MIN(Date)), COUNT(Date) FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit NATURAL JOIN `Visit Diagnosis` NATURAL JOIN `Diagnosis` WHERE SSN = ? AND Illness = ?;";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('ds', $ssn, $diag);
	$stmt->execute();
	$stmt->bind_result($name, $diff, $cnt);

	echo "<hr><h1>Results</h1>";
	while ($stmt->fetch()) {

		echo "<br>";
		if ($cnt === 0) {
			echo "<h3>Patient <i>$name</i> was never diagnosed with illness</h3>";
		} else {
			$avg = $diff / ($cnt - 1);
			echo "<h3>Patient $name averaged <i>$avg</i> days between visits with given illness of $diag.</h3>";
			echo "<h3>See $name's full history <a href='view_patient_history.php?SUBMIT=1&PatientInfo=$ssn'>here</a>.</h3>";
		}
		echo "<br>";
	}
}
?>

<?php include 'footer.html'; ?>