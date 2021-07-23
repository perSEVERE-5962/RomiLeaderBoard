<html>
   <head>
      <title>PHP Player Input Form </title>
   </head>

   <body>
      <?php

         // define variables and set to empty values
         $firstname = 
         $lastname = 
	 $phone = 
	 $comment = "";

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstname = test_input($_POST["firstname"]);
            $lastname  = test_input($_POST["lastname"]);
            $comment   = test_input($_POST["comment"]);
         }

         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
      ?>

      <h2>FRC Team 5962 Romi Challenge Player Registration</h2>

      <form method = "post" action = "insert_player.php">
         <table>
            <tr>
               <td>First Name:</td>
               <td><input type = "text" name = "firstname"></td>
            </tr>

            <tr>
               <td>Last Name:</td>
               <td><input type = "text" name = "lastname"></td>
            </tr>

            <tr>
               <td>Phone Number:</td>
               <td><input type = "text" name = "phonenum"></td>
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

   </body>
</html>

<body>

