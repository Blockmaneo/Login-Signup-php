<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
    }

    .container {
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #ffffff;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333333;
    }

    .container input[type="text"],
    .container input[type="password"] {
      width: 93%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
      color: #333333;
    }

    .container input[type="text"]:focus,
    .container input[type="password"]:focus {
      outline: none;
      border-color: #5e9ed6;
    }

    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      background-color: #5e9ed6;
      color: #ffffff;
      cursor: pointer;
    }

    .container input[type="submit"]:hover {
      background-color: #4a8ac2;
    }

    .container p.error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<?php
// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "";
    $username = "";
    $password = "";
    $database = "";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the entered username and password from the form
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // SQL query to insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$enteredUsername', '$enteredPassword')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        // Error in the registration process
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
  <div class="container">
    <h2>Register</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Register">
    </form>
<?php
    // Display error message, if any
    if (isset($errorMessage)) {
      echo '<p class="error-message">' . $errorMessage . '</p>';
    }
    ?>
    <a style="color: black;" href="login.php">already have an account?</a>
  </div>
</body>
</html>
