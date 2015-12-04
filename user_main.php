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
<h1>User Portal</h1>

<form method="post" action="login.php">
			<input type = "submit" value = "Logout" name="logout">
			</form>

</body>
</html>
