<?php 
include 'login.php';
validate_creds();
include 'header.html';
?>

<h1>Add Treatment</h1>
<div id="container">
<form role="form" class='form-inline'>
  <table>
    <tr>
     <td style='text-align: right'><label for="Name">New Treatment Name:</label></td>
     <td><input type="Name" class="form-control" id="Name" name="Name"></td>
    </tr><tr>
     <td style='text-align: right'><label for="Descr">New Treatment Description:</label></td>
     <td><textarea type="Name" class="form-control" id="Descr" name="Descr"></textarea></td>
    </tr>
  </table>
  <input type="submit" class="btn btn-default" />
</form>
</div>


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

include 'footer.html';
?>
