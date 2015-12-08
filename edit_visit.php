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


	$sql = "INSERT into `Physician Visit` VALUES ('$physician_id', '$visit_id'); ";
	$sql.= "INSERT into `Visit Diagnosis` VALUES ('$visit_id', '$diagnosis'); "; 
	$sql.= "INSERT into `Visit Treatment` VALUES ('$visit_id', '$treatment'); ";
	if ($conn->multi_query($sql) == TRUE) {
		#header("Location: visit.php");
		echo "Visit info successfully updated.";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

}

?>


<form>
        <input type='hidden' name='SUBMIT' value='1' />
        <table>
                <tr>
                        <td style='text-align: right'>Visit ID:</td>
                        <td><input type='text' name='VISIT_ID' value=<?php echo $_REQUEST["VISIT_ID"] ?> /></td>
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


<a href='visit.php'>
        Back
</a>

<?php include 'footer.html' ?>
