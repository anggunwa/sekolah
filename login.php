<?php 

define("PUBLIC_PAGE", true);

require_once __DIR__ . "/includes/init.php"; 

// jika sudah login, langsun alihkan ke index
if (!empty($_SESSION['is_login'])) {
    header('Location: index.php');
    exit;
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
   <!-- <div class="container mt-5">
        <h2>Login Atmint</h2>
        <?php if (isset($_SESSION['error'])): ?>

            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>

        <?php endif; ?>
        <form action="controllers/cek-login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required
                        value="<?= isset($_SESSION['old_username']) ? htmlspecialchars($_SESSION['old_username']) : '' ?>">
            </div>  
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>

        </form>
        <?php unset($_SESSION['old_username']); ?>
    </div> -->

    <h2>Login Dummy</h2>
        <form action="controllers/cek-login.php" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <button type="submit">Login</button>
</body>
</html>