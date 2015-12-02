<!DOCTYPEhtml>
<html>
        <head>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <script src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
                <link rel="stylesheet" type="text/css" href="hospital.css" />
        </head>
        <body>
                <script>
                        webshim.polyfill('forms forms-ext');
                </script>
<h1>Specialists on a Visit</h1>

<form>
        <input type='hidden' name='SUBMIT' value='1' />
        Date of visit: <input type='date' name='DATE' value='<?php echo $_REQUEST['DATE'] ?>' />
        Patient SSN: <input type='text' name='PATIENT_SSN' value='Example' />
	<input type='submit' />
</form>

<?php

$day = $_REQUEST['DATE'];

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if ($_REQUEST['SUBMIT']) {

	specialization(1);

        //diagnosis, diagnosis treatment, Patient, Patient Visit, 
        //Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$x = $_REQUEST['PATIENT_SSN'];
	$y = $_REQUEST['DATE'];
        $sql = "SELECT `Visit ID` FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit WHERE SSN =`$x` AND  Date = STR_TO_DATE($y, '%Y-%m-%d')";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
		echo "<h1>asdf</h1>";
		specialication($row['Visit ID']);
        }
}

function specialization($number){
        $conn2 = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        $sql2 = "SELECT Name, Specialization FROM Physician NATURAL JOIN `Physician Visit` WHERE `Visit ID` = '$number'";
        $result2 = $conn2->query($sql2);

        if ($conn2->connect_error) {
               die("Connection failed: " . $conn2->connect_error);

        }
        else {
	        echo "<table class='result-list' cellspacing='5px'>";
        	echo "<tr><th>Name</th><th>Specialization</th>";
                while ($row2 = $result2->fetch_assoc()):
       		        echo "<tr>";
                        foreach($row2 as $key2=>$value2):
	                	echo "<td>" . $value2 . "</td>";
                        endforeach;
	                echo "</tr>";
                endwhile;
		echo "</table>";
        }
}

?>
<br />

<a href='index.html'>
        Back
</a>
</body>
</html>