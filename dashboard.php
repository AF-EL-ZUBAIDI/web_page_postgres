<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirect back to login page
    exit();
}
?>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>

