<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Site Administrator</h1>
<hr>
<h3><a href='add_patient.php'>
	Add Patient
</a></h3>
<h3><a href='add_physician.php'>
	Add Physician
</a></h3>
<br />
<br />


<?php include 'footer.html'; ?>