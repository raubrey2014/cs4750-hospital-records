<!DOCTYPEhtml>
<html>
<head>
</head>
<body>
<h1>CS4750</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT * FROM Treatment";
        $result = $conn->query($sql);
	echo "******************************";

	while ($row = $result->fetch_assoc()):
		foreach($row as $key=>$value):
			echo "<p>$key => $value</p>";
		endforeach;
		echo "******************************";
	endwhile;
}
?>
</body>
</html>