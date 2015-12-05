<?php 
include 'login.php';
validate_creds();
?>
<!DOCTYPEhtml>
<html>
<head>
	<title>CS4750 Project</title>
    <link rel="stylesheet" type="text/css" href="hospital.css" />

</head>
<body>
<div class='content'>
<h1>Admin Portal</h1>

<a href="visit.php">View Visits</a>
<br />

<h3>Diagnosis and Treatment</h3>

<a href="treatment.php">View Treatments</a>
<br />
<a href="diagnosis.php">View Diagnoses</a>
<br />
<a href="add_diagnosis.php">Add Diagnoses</a>
<br />

<a href="treatment_for_diagnosis.php">Treatment frequency for diagnosis</a>
<br />
<a href="timediff_patient_diagnosis.php">Average time between visits with diagnosis</a>
<br />


<h3>Physician and Patient</h3>
<a href="connect.php">View Patients</a>
<br />
<a href="view_patient_history.php">View Patient History</a>
<br />

<a href="update_patient.php">Update Patient Info</a>
<br />
<a href="physicians.php">View Physicians</a>
<br />
<a href="patients_physician_sees_in_a_day.php">Patients a physician sees in a day</a>
<br />
<a href="specialists_on_visits.php">View Specialists for a visit</a>
<br />

<a href="patients_on_day.php">Patient visits for day</a>
<br />
<a href="site_admin.html">Add and Remove Physicians and Patients</a>
<br />
<br />
<form method="post" action="login.php">
			<input type = "submit" value = "Logout" name="logout">
			</form>
</div>
</body>
</html>
