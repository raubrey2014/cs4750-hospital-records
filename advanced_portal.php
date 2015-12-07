<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Site Administrator Advanced Options</h1>

<h2>Treatment/Diagnosis</h2>
<ul>
<li><a href="treatment_for_diagnosis.php"><span class="hidden-tablet">Treatment frequency for diagnosis Treatments</span></a></li>
</ul>

<h2>Patient/Physician</h2>
<ul>
<li><a href="patients_physician_sees_in_a_day.php"><span class="hidden-tablet">Patients a physician sees in a day</span></a></li>
<li><a href="specialists_on_visits.php"><span class="hidden-tablet">View Specialists for a visit</span></a></li>
<li><a href="timediff_patient_diagnosis.php"><span class="hidden-tablet">Average time between visits with diagnosis</span></a></li>
<li><a href="patients_on_day.php"><span class="hidden-tablet">Patient visits for day</span></a></li>
</ul>


<?php include 'footer.html'; ?>