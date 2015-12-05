<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Add Diagnosis</h1>
<div id="container">
<form role="form" class='form-inline'>
  <div class="form-group">
    <label for="Name">New Diagnosis Name:</label>
    <input type="Name" class="form-control" id="Name" name="Name">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<?php 

if (isset($_REQUEST['Name'])){
	create_diagnosis();
}

function create_diagnosis(){
	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

	if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

	} else {
		$diagnosis = $_REQUEST['Name'];
		
		$sql = "INSERT INTO Diagnosis (Illness) VALUES ('$diagnosis')";
		$result = $conn->query($sql);
		if ($result) {
			echo "<h3>Diagnosis definition successfully added.</h3>";
		} else {
			echo "<h2>Failed to add Diagnosis: " . $conn->error . "</h2>";
		}
	}
	
	$conn->close();
}

?>
<a href='admin_main.php'>
	Back
</a>

<?php include 'footer.html'; ?>