<html>
<body>

<?php

// check for a bonus
$bonusValue = 0;
if(filter_has_var(INPUT_POST,'bonus')) 
{
    $bonusValue = 1;
}
	 
// Calculate runTime and totalTime
$runTime = $_POST[runMinutes] * 60 + $_POST[runSeconds];
$totalTime = $runTime - ($bonusValue *2);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");
 
/* Prepare an insert statement */
$query = "INSERT INTO CourseRun (PlayerID, BallScored, RunTime, Bonus, TotalTime, Comment) VALUES (?,?,?,?,?,?)"; 

$stmt = $mysqli->stmt_init();
$stmt->prepare($query);

/* Bind variables to parameters */
$stmt->bind_param("iidids", $_POST[playerID], $_POST[ballScored], $runTime, $bonusValue, $totalTime, $_POST[comment]);

/* Execute the statement */
if($stmt->execute())
{
   echo "<table>";
   echo "<tr><td colspan=2>Entered Course Run:</tr></td>";
   echo "<tr><td>PlayerID</td><td>" . $_POST[playerID] . "</td></tr>";
   echo "<tr><td>Balls Scored</td><td>" . $_POST[ballScored] . "</td></tr>";
   echo "<tr><td>Run Time</td><td>" . $runTime . "</td></tr>";
   echo "<tr><td>Bonus</td><td>" . $bonusValue . "</td></tr>";
   echo "<tr><td>Total Time</td><td>" . $totalTime . "</td></tr>";
   echo "<tr><td>Comment</td><td>" . $_POST[comment] . "</td></tr>";
   echo "</table>";
}
else
{
   echo "ERRROR:  Unable to INSERT into database<br>";
}


?>
      <div>
         <a href="../index.html">Home</a>
      </div>

</body>
</html>
