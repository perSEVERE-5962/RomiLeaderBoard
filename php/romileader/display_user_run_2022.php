<html>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");
 
/* Look up Player detail */
$query = "SELECT FirstName, LastName FROM Player WHERE PlayerID = ?"; 
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);
/* Bind variables to parameters */
$stmt->bind_param('i',$_POST[playerID]);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($FirstName,$LastName);
$stmt->fetch();
echo "<H2 >". $FirstName . " " . $LastName . "</H2>";

/* Lookup Results Data */
$query = "SELECT * FROM romi_leaderboard WHERE PlayerID = ?"; 
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);

/* Bind variables to parameters */
$stmt->bind_param('i',$_POST[playerID]);

/* Execute the statement */
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($Rank,$FirstName,$LastName,$PlayerID,$BallScored,$RunTime, $TotalTime, $Bonus);
$numRows = $stmt->num_rows;

?>
<TR>
<TABLE BORDER=1>
  <TR>
   <TD ALIGN="center" BGCOLOR="black"><FONT COLOR="yellow"><b>&nbsp;Rank&nbsp;</b></FONT></TD>
   <TD ALIGN="center" BGCOLOR="black"><FONT COLOR="yellow"><b>&nbsp;Balls&nbsp;Scored&nbsp;</b></FONT></TD>
   <TD ALIGN="center" BGCOLOR="black"><FONT COLOR="yellow"><b>&nbsp;Total&nbsp;Time&nbsp;</b></FONT></TD>
   <TD ALIGN="center" BGCOLOR="black"><FONT COLOR="yellow"><b>&nbsp;Run&nbsp;Time&nbsp;</b></FONT></TD>
   <TD ALIGN="center" BGCOLOR="black"><FONT COLOR="yellow"><b>&nbsp;Bonus&nbsp;</b></FONT></TD>
  </TR>

<?php

for ($i = 0; $i < $numRows; $i++)
{
	$stmt->fetch();

	$bonusValue = "No";
	if ($Bonus == "1")
	{
		$bonusValue = "Yes";
	}
	echo "<TR>";
	echo "<TD ALIGN='center'>" . $Rank . "</TD>";
	echo "<TD ALIGN='center'>" . $BallScored . "</TD>";
	echo "<TD ALIGN='center'>" . $TotalTime . "</TD>";
	echo "<TD ALIGN='center'>" . $RunTime . "</TD>";
	echo "<TD ALIGN='center'>" . $bonusValue . "</TD>";
	echo "</TR>";
}

echo "</TABLE>";

?>
      <div>
         <a href="../index.html">Home</a>
      </div>

</body>
</html>
