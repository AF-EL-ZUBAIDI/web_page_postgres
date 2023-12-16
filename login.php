<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check the user
    $query = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
    $result = pg_query($dbconn, $query);

    if ($result && pg_num_rows($result) > 0) {
        session_start();
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

