<?php 

session_start();

// Jika sudah login, langsung redirect
if (isset($_SESSION['is_login'])  && $_SESSION['is_login'] === true) {
    header("Location: /sekolah/views/index.php");
    exit;
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $valid_username = "admin";
    $valid_password = "123";

    if ($username === $valid_username && $password == $valid_password) {
        $_SESSION["is_login"] = true;
        $_SESSION["username"] = $username;
        header("Location: /sekolah/views/index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Login</title>
</head>
<body>

    <h2>Login</h2>
    <?php 
    
      if (isset($error)) echo "<p style='color:red;'>$error</p>";

    ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="username" required><br><br>
            <input type="password" name="password" placeholder="password" required><br><br>
            <button type="submit">Login</button>
</body>
</html>