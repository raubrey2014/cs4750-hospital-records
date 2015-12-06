<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Add Physician</h1>
<div id="container">
<form role="form" class='form-inline'>
<table>
  <tr>
    <td style='text-align: right;'><label for="Name">Physician Name:</label></td>
    <td><input type="Name" class="form-control" id="Name" name="Name"></td>
  </tr>
  <tr>
    <td style='text-align: right;'><label for="Spec">Specialization:</label></td>
    <td><input id="Spec" name="Spec"></td>
  </tr>
  <tr>
    <td style='text-align: right;'><label for="Salary">Salary:</label></td>
    <td><input id="Salary" name="Salary"></td>
  </tr>
</table>
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

<h1>Physicians</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$sql = "SELECT * FROM Physician WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Physician ID</th><th>Salary</th><th>Name</th><th>Specialization</th><th>Actions</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		$id = $row['Physician ID'];
		echo "<tr>";
		echo "<td>" . $id . "</td>";
		echo "<td>" . $row['Salary'] . "</td>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['Specialization'] . "</td>";
		echo "<td><a href='remove_physician.php?ID=$id'><button type='submit' class='btn btn-primary'>Fire</button></a></td>";
		echo "</tr>";
	endwhile;
	echo "</table>";
}
?>
<?php include 'footer.html'; ?>
