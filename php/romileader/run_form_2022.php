<html>
   <head>
      <title>PHP Run Input Form </title>
   </head>

   <body>
      <h2>FRC Team 5962 Romi Challenge Run Results</h2>

<?php
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");

  /* Prepare an insert statement */
  $select_query = "SELECT * FROM Player ORDER BY LastName"; 
  
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($select_query);
  echo "Prepared query<br>";

  /* Execute the statement */
  $stmt->execute();
  echo "Statement excecuted<br>";

  $result = $stmt->get_result();

?>
        <form method = "post" action = "insert_run_2022.php">
         <table>
            <tr>
	       <td>Player:</td>
               <td>
                  <select name="playerID">
                  <option value = NULL> --Select Player--</option>
<?php 
  foreach ($result as $row)
  {
     // echo "ID: ".$row['PlayerID']."  ".$row['LastName']."<br>";
     echo "<option value=".$row['PlayerID'].">".$row['FirstName']." ".$row['LastName']." ".$row['Phone']."</option>";
  }
  
?>

		   </select>
                  </td>
                </tr>

            <tr>
               <td>Balls Scored:</td>
               <td><input type = "text" name = "ballScored"></td>
            </tr>

            <tr>
               <td>Run Time (minutes):</td>
	       <td><input type = "text" name = "runMinutes">&nbsp;Minutes</td>
            </tr>

            <tr>
               <td>Run Time (seconds.ms):</td>
               <td><input type = "text" name = "runSeconds">&nbsp;Seconds.ms</td>
            </tr>

            <tr>
               <td>Bonus:</td>
               <td><input type = "checkbox" name = "bonus" value = "No"></td>
            </tr>

            <tr>
               <td>Comment:</td>
               <td><textarea name = "comment" rows = "5" cols = "40"></textarea></td>
            </tr>

            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit">
               </td>
            </tr>
         </table>
      </form>
      <div>
         <a href="../index.html">Home</a>
      </div>
    </body>
</html>

