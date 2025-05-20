<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Login Atmint</h2>
        <?php if (isset($_SESSION['error'])): ?>

            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>

        <?php endif; ?>
        <form action="cek-login.php" method="POST">
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
    </div>
</body>
</html>