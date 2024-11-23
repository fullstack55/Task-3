//login.php
<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $user['username'];  
            header("Location: https://www.bookswagon.com/");  
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('No account found. Redirecting to sign up.'); window.location.href='signup.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
