<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<div class='content'>
<h1>Patients Visited on Date</h1>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	Date: <input type='date' name='DATE' value='<?php echo $_REQUEST['DATE'] ?>' />
	<input type='submit' />
</form>

<?php


$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if (isset($_REQUEST['SUBMIT'])) {
	$day = $_REQUEST['DATE'];

	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT SSN, Name, DATE_FORMAT(DOB, '%m/%d/%Y'), Email, `Phone Number`, Address FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit WHERE Date = STR_TO_DATE(?, '%Y-%m-%d')";
        $stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $day);
	$stmt->execute();
	$stmt->bind_result($ssn, $name, $dob, $email, $phone, $address);

	echo "<br />";
	echo "<table class='result-list' cellspacing='5px'>";
	echo "<tr><th>SSN</th><th>Name</th><th>Date of Birth</th><th>Email</th><th>Phone Number</th><th>Address</th></tr>";
	while ($stmt->fetch()) {
		echo "<tr>";
		echo "<td>" . $ssn . "</td>";
		echo "<td>" . $name . "</td>";
		echo "<td>" . $dob . "</td>";
		echo "<td>" . $email . "</td>";
		echo "<td>" . $phone . "</td>";
		echo "<td>" . $address . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
<br />
<a href='index.html'>
	Back
</a>
</div>
<?php include 'footer.html'; ?>