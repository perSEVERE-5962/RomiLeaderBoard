<html>
   <head>
      <title>Display User Run Data </title>
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

  /* Execute the statement */
  $stmt->execute();
  $result = $stmt->get_result();

?>
        <form method = "post" action = "display_user_run_2022.php">
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

