<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>View Patients</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT * FROM Patient WHERE 1";
    $result = $conn->query($sql);
	echo "<table class='result-list'>";
	echo "<tr><th>SSN</th><th>Name</th><th>DOB</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Update</th><th>View History</th></tr>";
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		$ssn = $row['SSN'];
		$name = $row['Name'];
		$dob = $row['DOB'];
		$email = $row['Email'];
		$phone = $row['Phone Number'];
		$address = $row['Address'];
		echo "<td>$ssn</td>";
		echo "<td>$name</td>";
		echo "<td>$dob</td>";
		echo "<td>$email</td>";
		echo "<td>$phone</td>";
		echo "<td>$address</td>";
		echo "<td><a href='update_patient.php?SSN=$ssn'><button type='submit' class='btn btn-primary'>Edit</button></a></td>";
		echo "<td><a href='view_patient_history.php?SUBMIT&PatientInfo=$ssn'><button type='submit' class='btn btn-primary'>History</button></a></td>";

		
		echo "</tr>";
	endwhile;
	echo "</table>";
}
?>
<?php include 'footer.html'; ?>
