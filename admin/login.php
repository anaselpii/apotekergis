<?php
session_start();
require '../config.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = mysqli_prepare($conn, "SELECT id, username, password, nama FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id']  = $admin['id'];
        $_SESSION['admin_nama'] = $admin['nama'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - SIG Apotek Lebak</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f5f5; }
        .login-box {
            width:320px; margin:80px auto; background:#fff; padding:20px;
            border-radius:6px; box-shadow:0 0 10px rgba(0,0,0,.1);
        }
        h2 { text-align:center; margin-top:0; }
        label { display:block; margin-bottom:5px; }
        input[type=text], input[type=password] {
            width:100%; padding:8px; margin-bottom:10px;
            border:1px solid #ccc; border-radius:4px;
        }
        button {
            width:100%; padding:8px; background:#198754; border:none;
            color:#fff; border-radius:4px; cursor:pointer;
        }
        .error { color:#d00; font-size:13px; text-align:center; margin-bottom:10px; }
        .back { text-align:center; margin-top:10px; }
        .back a { text-decoration:none; font-size:13px; color:#198754; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login Admin</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
    <div class="back">
        <a href="../index.php">&laquo; Kembali ke Peta</a>
    </div>
</div>
</body>
</html>
