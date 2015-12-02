<!DOCTYPEhtml>
<html>
<head>
</head>
<body>
<h1>View Visits</h1>
<hr>
<p>What would you like to do?</p>

<select name='Actions' form='queryForm'>
	<option>View My Visits</option>
	<option name='specialization'>See the specialist on my visits</option>
</select>
<form action='visit.php' method='POST' id='queryForm'>
<input type='submit' value='Submit' name='Submit'/>
</form>

<br />

<?php
//specialization('Diagnostician', 1);
if(isset($_POST['specialization'])){
	specilization(trim(strip_slashes($_POST['specialization'])), 1);
}

function specialization($spec, $number){
	$conn2 = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
	$sql2 = "SELECT Name, Specialization FROM Physician NATURAL JOIN `Physician Visit` WHERE `Specialization` = '$spec' AND `Visit ID` = '$number'";
        $result2 = $conn2->query($sql2);

	if ($conn2->connect_error) {
 	       die("Connection failed: " . $conn2->connect_error);

	}
	else {
		while ($row2 = $result2->fetch_assoc()):
                        foreach($row2 as $key2=>$value2):
                                echo "<p>$key2 => $value2</p>";
                        endforeach;
                endwhile;
	}
}

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT * FROM Visit";
        $result = $conn->query($sql);
	echo "******************************";

	while ($row = $result->fetch_assoc()):
		foreach($row as $key=>$value):
			echo "<p>$key => $value</p>";
		endforeach;
		echo "<p>Doctors associated with this visit?</p>";
		$x = $row['Visit ID'];
		$sql2 = "SELECT Name, Specialization FROM Physician NATURAL JOIN `Physician Visit` WHERE `Visit ID` = '$x'";
	        $result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()):
			foreach($row2 as $key2=>$value2):
        	                echo "<p>$key2 => $value2</p>";
                	endforeach;
		endwhile;
		echo "******************************";
	endwhile;
}
$conn->close();
?>
</body>
</html>
