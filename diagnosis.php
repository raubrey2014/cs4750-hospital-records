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
    <input type="Name" class="form-control" id="Name" name="Name" required>
  </div>
  <div class="form-group">
    <label for="Name">New Diagnosis Summary:</label>
    <input type="Summary" class="form-control" id="Summary" name="Summary" required>
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
		$summary = $_REQUEST['Summary'];
		$sql = "INSERT INTO Diagnosis (Illness, Summary) VALUES ('$diagnosis', '$summary')";
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
<div class='content'>
<h1>View Diagnoses</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	$sql = "SELECT * FROM Diagnosis WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Illness</th><th>Summary</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>" . $row['Illness'] . "</td>";
		echo "<td>" . $row['Summary'] . "</td>";
		echo "</tr>";
	endwhile;
	echo "</table>";
}
?>
</div>
<?php include 'footer.html'; ?>