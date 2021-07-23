<html>
<body>

<?php

// Calculate runTime and totalTime
$runTime = $_POST[runMinutes] * 60 + $_POST[runSeconds];
$totalTime = $runTime + $_POST[penalty] - $_POST[bonus];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");
 
/* Prepare an insert statement */
$query = "INSERT INTO CourseRun (PlayerID, RunTime, Penalty, Bonus, TotalTime, Comment) VALUES (?,?,?,?,?,?)"; 

$stmt = $mysqli->stmt_init();
$stmt->prepare($query);

/* Bind variables to parameters */
$stmt->bind_param("idiids", $_POST[playerID], $runTime, $_POST[penalty], $_POST[bonus], $totalTime, $_POST[comment]);

/* Execute the statement */
if($stmt->execute())
{
   echo "<table>";
   echo "<tr><td colspan=2>Entered Course Run:</tr></td>";
   echo "<tr><td>PlayerID</td><td>" . $_POST[playerID] . "</td></tr>";
   echo "<tr><td>Run Time</td><td>" . $runTime . "</td></tr>";
   echo "<tr><td>Penalty</td><td>" . $_POST[penalty] . "</td></tr>";
   echo "<tr><td>Bonus</td><td>" . $_POST[bonus] . "</td></tr>";
   echo "<tr><td>Total Time</td><td>" . $totalTime . "</td></tr>";
   echo "<tr><td>Comment</td><td>" . $_POST[comment] . "</td></tr>";
   echo "</table>";
}
else
{
   echo "ERRROR:  Unable to INSERT into database<br>";
}


?>
</body>
</html>
