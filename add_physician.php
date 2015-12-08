<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>Add Physician</h1>
<div id="container">
<form role="form" class='form-inline'>
  <div class="form-group">
    <label for="Name">Physician Name:</label>
    <input type="Name" class="form-control" id="Name" name="Name">
  </div>
  <div class="form-group">
    <label for="Spec">Specialization:</label>
    <input id="Spec" name="Spec">
  </div>
  <div class="form-group">
    <label for="Salary">Salary:</label>
    <input id="Salary" name="Salary">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<?php 

if (isset($_REQUEST['Name']) && isset($_REQUEST['Spec']) && isset($_REQUEST['Salary'])){
	create_physician();
}

function create_physician(){
	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

	if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

	} else {
		$name = $_REQUEST['Name'];
		$spec = $_REQUEST['Spec'];
		$salary = $_REQUEST['Salary'];
		$sql = "SELECT count(*) as PhysCount FROM Physician";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$count = $row['PhysCount'];
		$sql = "INSERT INTO Physician (`Physician ID`, Name, Specialization, Salary) VALUES ($count, '$name', '$spec', $salary)";
		$result = $conn->query($sql);
		if ($result) {
			echo "<h3>Physician successfully added.</h3>";
		} else {
			echo "<h2>Failed to add Physician: " . $conn->error . "</h2>";
		}
	}
	
	$conn->close();
}

?>
<?php include 'footer.html'; ?>