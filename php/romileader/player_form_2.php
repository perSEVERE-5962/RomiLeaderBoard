<html>
   <head>
      <title>PHP Player Input Form</title>
   </head>

   <body>
      <?php

         // define variables and set to empty values
         $firstname = $lastname = $phonenum = $comment = "";
         $firstnameErr = $lastnameErr = $phonenumErr = $insertErr = "";
         $counter = 0;

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["firstname"])) {
		$firstnameErr = "First name is required";
                $counter++;
	    } else {
                $firstname = test_input($_POST["firstname"]);
            }
            if(empty($_POST["lastname"])) {
		$lastnameErr = "Last name is required";
                $counter++;
	    } else {
                $lastname  = test_input($_POST["lastname"]);
            }
            if(empty($_POST["phonenum"])) {
		$phonenumErr = "Phone number is required";
                $counter++;
	    } else if(!isValidTelephoneNumber($_POST["phonenum"])) {
		$phonenumErr = 'Phone number is invalid';
                $counter++;
	    } else { 
		$phonenum = test_input($_POST["phonenum"]);
	    }
            $comment   = test_input($_POST["comment"]);
            if ($counter == 0) {
               $insertErr = insert_data();
               $firstname = $lastname = $phonenum = $comment = "";
               $firstnameErr = $lastnameErr = $phonenumErr = "";
            }
	    
         }

         function test_input(string $data): string {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

         function isDigits(string $data, int $minDigits=7, int $maxDigits=11): bool {
            return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $data);
         } 

         function isValidTelephoneNumber(string $data): bool{
            // remove formatting
            $data = str_replace([' ', '.', '-', '(', ')'], '', $data);
            return isDigits($data);
         }

         function insert_data(): string {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli = new mysqli("localhost", "frc5962", "G0r0b0t", "romileader");

            /* Prepare an insert statement */
            $query = "INSERT INTO Player (FirstName, LastName, Phone, Comment) VALUES (?,?,?,?)"; 

            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query))
            {
               $msg = "Failed to prepare statement";
            }
            else
            {
               /* Bind variables to parameters */
               $stmt->bind_param("ssss", $_POST[firstname], $_POST[lastname], $_POST[phonenum], $_POST[comment]);

               /* Execute the statement */
               if($stmt->execute())
               {
                  $msg = "Entered Player:<br>". $_POST[firstname] . " " . $_POST[lastname] . "<br>" . $_POST[phonenum] . "<br>" .$_POST[comment];
               }
               else
               {
                  $msg =  "ERROR:  Unable to INSERT into database";
               }
            }
            return $msg;
         }
      ?>

      <h2>FRC Team 5962 Romi Challenge 2022 Player Registration</h2>

      <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <table>
            <tr>
               <td>First Name:</td>
               <td><input type = "text" name = "firstname" value = "<?php echo $firstname;?>"><span class="error"><font color=red>* <?php echo $firstnameErr;?></color></span></td>
            </tr>

            <tr>
               <td>Last Name:</td>
               <td><input type = "text" name = "lastname" value = "<?php echo $lastname;?>"><span class="error"><font color=red>* <?php echo $lastnameErr;?></color></span></td>
            </tr>

            <tr>
               <td>Phone Number:</td>
               <td><input type = "text" name = "phonenum" value = "<?php echo $phonenum;?>"><span class="error"><font color=red>* <?php echo $phonenumErr;?></color></span></td>
            </tr>

            <tr>
               <td>Comment:</td>
               <td><textarea name = "comment" rows = "5" cols = "40"><?php echo $comment;?></textarea></td>
            </tr>

            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit">
               </td>               
               <td>
                  <a href="../index.html">Home</a>
               </td>
            </tr>

         </table>

      </form>
      <div>
         <font color=blue><?php echo $insertErr;?><font>
      </div>


   </body>
</html>

