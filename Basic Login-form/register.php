<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form | Ashwin</title>
  <link rel="stylesheet" href="styles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root"; // Database username
    $password = "pw1"; // Simple MariaDB root password
    $dbname = "user_database";

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<p class='error'>Database connection failed: " . $conn->connect_error . "</p>");
    }

    // Form submission logic
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "<p class='error'>All fields are required.</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>Invalid email format.</p>";
        } elseif ($password !== $confirmPassword) {
            echo "<p class='error'>Passwords do not match.</p>";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert the user into the database
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<p class='success'>Registration successful! <a href='login.html'>Login here</a>.</p>";
            } else {
                echo "<p class='error'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

    <!-- Registration Form -->
    <form action="register.php" method="POST">
      <h1>Register</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" required>
        <i class='bx bxs-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <i class='bx bxs-lock'></i>
      </div>
      <button type="submit" class="btn">Register</button>
      <div class="login-link">
        <p>Already have an account? <a href="index.html">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>
