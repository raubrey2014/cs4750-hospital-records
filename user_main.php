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
			<h1>User Portal</h1>

			<a href='update_patient.php'>View/Update Info</a><br />
			<a href='#'>View Visit History</a><br />
			<a href='add_visit.php'>Schedule Visit</a><br />
			<br />
			<form method="post" action="login.php">
				<input type = "submit" value = "Logout" name="logout">
			</form>
		</div>
	</body>
</html>
