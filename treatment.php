<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>
<h1>Add New Treatment</h1>

<?php 

if (isset($_REQUEST['Name'])){
	create_treatment();
}

function create_treatment(){
	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

	if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

	} else {
		$treatment = $_REQUEST['Name'];
		$description = $_REQUEST['Descr'];
		
		$sql = "INSERT INTO Treatment (`Treatment Name`, `Treatment Description`) VALUES ('$treatment', '$description')";
		$result = $conn->query($sql);
		if ($result) {
			echo "<h3>Treatment definition successfully added.</h3>";
		} else {
			echo "<h2>Failed to add Treatment: " . $conn->error . "</h2>";
		}
	}
	
	$conn->close();
}

?>

<div id="container">
<form role="form" class='form-inline'>
  <table>
    <tr>
     <td style='text-align: right'><label for="Name">Treatment Name:</label></td>
     <td><input type="Name" class="form-control" id="Name" name="Name"></td>
    </tr><tr>
     <td style='text-align: right'><label for="Descr">Treatment Description:</label></td>
     <td><textarea type="Name" class="form-control" id="Descr" name="Descr"></textarea></td>
    </tr>
  </table>
  <input type="submit" class="btn btn-primary" />
</form>
</div>

<h1>List of Treatments</h1>

<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else {
	$sql = "SELECT * FROM Treatment WHERE 1";
        $result = $conn->query($sql);

	echo "<table class='result-list'>";
	echo "<tr><th>Treatment Name</th><th>Treatment Description</th><th>Duration</th><th>Frequency</th></tr>"; 
	while ($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>" . $row['Treatment Name'] . "</td>";
		echo "<td>" . $row['Treatment Description'] . "</td>";
		echo "<td>" . $row['Duration'] . "</td>";
		echo "<td>" . $row['Frequency'] . "</td>";
		echo "</tr>";
	endwhile;
}
?>
</table>

<?php
include 'footer.html';
?>
