<!DOCTYPEhtml>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>

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
  <button type="submit" class="btn btn-default">Submit</button>
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
<a href='admin_main.php'>
	Back
</a>
</body>
</html