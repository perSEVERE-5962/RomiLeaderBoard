<html>
<body>

<?php
echo $_POST[phonenum] . "<br>";
if ($_POST[phonenum] == "INVALID"){
	echo "ERROR:  Invalid phone number<br>";
}	
else {
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");

	/* Prepare an insert statement */
	$query = "INSERT INTO Player (FirstName, LastName, Phone, Comment) VALUES (?,?,?,?)"; 

	$stmt = $mysqli->stmt_init();
	if(!$stmt->prepare($query))
	{
	    echo "Failed to prepare statement<br>";
	}
	else
	{
	  /* Bind variables to parameters */
	  $stmt->bind_param("ssss", $_POST[firstname], $_POST[lastname], $_POST[phonenum], $_POST[comment]);

	  /* Execute the statement */
	  if($stmt->execute())
	  {
	     echo "Entered Player:<br>";
	     echo $_POST[firstname] . " " . $_POST[lastname] . "<br>";
	     echo $_POST[phonenum] . "<br>";
	     echo $_POST[comment] . "<br>";
	  }
	  else
	  {
	     echo "ERROR:  Unable to INSERT into database<br>";
	  }
 	}
}

?>
</body>
</html>
