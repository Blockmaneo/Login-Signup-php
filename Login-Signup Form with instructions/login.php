<html>
<head>
  <title>Login Form</title>
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
      width: 100%;
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
  </style>
</head>
<body>
<?php
// Check if the login form is submitted
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

    // SQL query to retrieve the user with the entered username and password
    $sql = "SELECT * FROM users WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store user ID and username in session
        session_start();
        $_SESSION["loggedIn"] = true;
        $_SESSION["userId"] = $row["id"];
        $_SESSION["username"] = $row["username"];

        // Login successful, redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        $errorMessage = "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>
  <div class="container">
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    <?php
    // Display error message, if any
    if (isset($errorMessage)) {
      echo '<p style="color: red;">' . $errorMessage . '</p>';
    }
    ?>
    <a style="color: black;" href="register.php">Dont have an account?</a>
  </div>
</body>
</html>