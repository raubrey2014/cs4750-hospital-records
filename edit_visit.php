<?php
ini_set('display_errors', 1);

include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>Edit Visit Information</h1>

<?php
$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


else if (isset($_REQUEST['SUBMIT'])) {

	$visit_id = $_REQUEST['VISIT_ID'];
        $physician_id = $_REQUEST['PHYSICIAN_ID'];
	$diagnosis = $_REQUEST['DIAGNOSIS'];
	$treatment = $_REQUEST['TREATMENT'];


	$sql = "INSERT into `Physician Visit` VALUES ('$physician_id', '$visit_id')";
	#; INSERT into `Visit Diagnosis` VALUES ('$visit_id', '$diagnosis'); INSERT into `Visit Treatment` VALUES ('$visit_id', '$treatment');";
        $stmt = $conn->prepare($sql);
	echo $conn->error;
        #$stmt->bind_param('ddss', $visit_id, $physician_id, $diagnosis, $treatment);
        if ($stmt->execute()) {
                echo "<h2>Visit info successfully updated</h2>";
        } else {
                echo "<h2>Failed to update visit information: " . $conn->error . "</h2>";
        }
}

?>


<form>
        <input type='hidden' name='SUBMIT' value='1' />
        <table>
                <tr>
                        <td style='text-align: right'>Visit ID:</td>
                        <td><input type='text' name='VISIT_ID'  /></td>
                </tr>
                <tr>
                        <td style='text-align: right'>Physician ID:</td>
                        <td><input type='text' name='PHYSICIAN_ID'  /></td>
                </tr>
                <tr>
                        <td style='text-align: right'>Diagnosis:</td>
                        <td><input type='text' name='DIAGNOSIS' /></td>
                </tr>
                <tr>
                        <td style='text-align: right'>Treatment:</td>
                        <td><input type='text' name='TREATMENT'  /></td>
                </tr>
        </table>
        <input type='submit' />
</form>


<a href='admin_main.php'>
        Back
</a>

<?php include 'footer.html' ?>
