<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    p {
      margin-bottom: 10px;
    }

    .logout-link {
      display: inline-block;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .logout-link:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <?php
  // Check if the user is logged in
  session_start();
  if (!isset($_SESSION["loggedIn"])) {
    header("Location: login.php");
    exit();
  }
  ?>

  <div class="container">
    <h2>Welcome to the Dashboard</h2>
    <?php
    // Display user ID and username
    $userId = $_SESSION["userId"];
    $username = $_SESSION["username"];

    echo "<p>User ID: $userId</p>";
    echo "<p>Username: $username</p>";
    ?>
    <a class="logout-link" href="logout.php">Logout</a>
  </div>
</body>
</html>