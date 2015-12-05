<?php 
include 'login.php';
validate_creds();
?>
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
	<h1>View a Patient's History</h1>
	<div class='content'>
	<form>
        <input type='hidden' name='SUBMIT' value='1' />
        Patient SSN:
        <?php
        $sql = "SELECT * FROM Patient";
        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

        }
        else{
            $result = $conn->query($sql);
            echo "<select name='PatientInfo'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['SSN'] . "'>" . $row['SSN'] . "</option>";
            }
            echo "</select>";
        }
        $conn->close();
        ?>
	<input type='submit' />
</form>
</div>
<?php 
if (isset($_REQUEST['SUBMIT'])){
	if (isset($_REQUEST['PatientInfo'])){
		$patient_name = "";
		$ssn = $_REQUEST['PatientInfo'];
		$sql = 	"SELECT Name FROM Patient WHERE SSN = '$ssn'";
        $conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
        if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

        }
        else{
       		$result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            	$patient_name = $row['Name'];
            }
        	$sql = "SELECT Date, `Visit ID`, Illness FROM Patient NATURAL JOIN `Patient Visit` NATURAL JOIN Visit NATURAL JOIN `Visit Diagnosis` WHERE SSN = '$ssn'";
       		$result = $conn->query($sql);
        	while ($row = $result->fetch_assoc()) {
            	$date = $row['Date'];
            	$visit_id = $row['Visit ID'];
            	$illness = $row['Illness'];
            	
            	echo $date.' '.$visit_id.' '.$illness.' <br />';
            }
        }


	}
}
?>

</body>
</html>