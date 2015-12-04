<?php 
session_start();
if (!isset($_SESSION['current_user'])){
	header("Location: http://localhost:8080/cs4750/cs4750-hospital-records/");
	exit();
}
?>
<!DOCTYPEhtml>
<html>
<head>
	<title>CS4750 Project</title>
    <link rel="stylesheet" type="text/css" href="hospital.css" />

</head>
<body>
<h1>Medical Records</h1>
<a href="connect.php">View Patients</a>
<br />
<a href="physicians.php">View Physicians</a>
<br />
<a href="treatment.php">View Treatments</a>
<br />
<a href="diagnosis.php">View Diagnosis</a>
<br />
<a href="visit.php">View Visits</a>
<br />
<a href="specialists_on_visits.php">View Specialists for a visit</a>
<br />
<a href="patients_physician_sees_in_a_day.php">Patients a physician sees in a day</a>
<br />
<a href="patients_on_day.php">Patient visits for day</a>
<br />
<a href="treatment_for_diagnosis.php">Treatment frequency for diagnosis</a>
<br />
<a href="timediff_patient_diagnosis.php">Average time between visits with diagnosis</a>
<br />
<a href="update_patient.php">Update Patient Info</a>
<br />
<a href="receptionist.html">Receptionist Login</a>
<br />
<a href="site_admin.html">Site Admin Login</a>
<form method="post" action="login.php">
			<input type = "submit" value = "Logout" name="logout">
			</form>

</body>
</html>
