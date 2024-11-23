//signup.php
<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>alert('Username already exists. Please try again with a different username.'); window.location.href='signup.php';</script>";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Sign up successful! Redirecting to login.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error during signup. Please try again later.'); window.location.href='signup.php';</script>";
        }
    }

    $stmt_check->close();
    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background: url('Images/manasa2.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="container">
        <form action="signup.php" method="POST" class="form">
            <h2>Sign Up</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" style="background-color:#800080">Sign Up</button>
        </form>
    </div>
</body>
</html>
