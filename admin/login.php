<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
  header('Location: dashboard.php');
  exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');
  if ($username === 'admin' && $password === 'smugcodes123') {
    $_SESSION['admin_logged_in'] = true;
    header('Location: dashboard.php');
    exit;
  }
  $error = 'Invalid username or password. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | SMUG CODES</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    body { min-height: 100vh; display: grid; place-items: center; padding: 2rem; }
    .auth-card { width: min(540px, 100%); background: #0f172a; border: 1px solid rgba(255,255,255,0.08); padding: 2rem; border-radius: 24px; }
    .auth-card h1 { margin-top: 0; }
    .auth-card form { display: grid; gap: 1rem; }
    .auth-card input { width: 100%; padding: 1rem; border-radius: 16px; border: 1px solid rgba(148,163,184,0.24); background: #111827; color: #e2e8f0; }
    .auth-card button { width: 100%; margin-top: 0.5rem; }
    .error { color: #fecaca; }
  </style>
</head>
<body>
  <main class="auth-card">
    <h1>SMUG CODES Admin Login</h1>
    <p>Access the dashboard to update portfolio content.</p>
    <?php if ($error): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post" action="">
      <label>
        Username
        <input type="text" name="username" required autofocus>
      </label>
      <label>
        Password
        <input type="password" name="password" required>
      </label>
      <button type="submit" class="button button-primary">Sign in</button>
    </form>
  </main>
</body>
</html>
