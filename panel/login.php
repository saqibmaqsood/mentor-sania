<?php
require_once __DIR__ . '/auth.php';

$error = '';
if (!empty($_SESSION['panel_user_id'])) {
    header('Location: /panel/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        if (attemptLogin($username, $password)) {
            header('Location: /panel/index.php');
            exit;
        } else {
            $error = 'Invalid username or password. Please try again.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Portal — Sania Maqsood</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    background: #1E1B17;
    color: #FAF7F2;
    font-family: 'Manrope', system-ui, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    -webkit-font-smoothing: antialiased;
  }
  .login-card {
    width: 100%;
    max-width: 440px;
    background: #25221D;
    border: 1px solid rgba(250,247,242,0.12);
    border-radius: 24px;
    padding: clamp(32px, 5vw, 48px);
    box-shadow: 0 24px 64px rgba(0,0,0,0.4);
  }
  .input-field {
    width: 100%;
    height: 48px;
    background: #1E1B17;
    border: 1px solid rgba(250,247,242,0.18);
    border-radius: 12px;
    padding: 0 16px;
    color: #FAF7F2;
    font-family: inherit;
    font-size: 15px;
    outline: none;
    transition: border-color 200ms ease;
  }
  .input-field:focus {
    border-color: #D9A879;
  }
  .submit-btn {
    width: 100%;
    height: 48px;
    background: #B5794A;
    border: none;
    border-radius: 999px;
    color: #FAF7F2;
    font-family: inherit;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 200ms ease, transform 150ms ease;
  }
  .submit-btn:hover {
    background: #8A5A34;
    transform: translateY(-1px);
  }
  .error-box {
    background: rgba(220, 53, 69, 0.15);
    border: 1px solid rgba(220, 53, 69, 0.4);
    color: #ff858d;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 14px;
    margin-bottom: 20px;
  }
</style>
</head>
<body>

<div class="login-card">
  <div style="text-align:center;margin-bottom:32px">
    <span style="font-family:'Newsreader',Georgia,serif;font-size:28px;color:#FAF7F2;display:flex;align-items:center;justify-content:center;gap:6px">
      Sania Maqsood<span style="width:6px;height:6px;border-radius:999px;background:#D9A879;display:inline-block"></span>
    </span>
    <span style="display:inline-block;margin-top:8px;font-size:12px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#D9A879;background:rgba(217,168,121,0.12);padding:4px 12px;border-radius:999px">
      Management Portal
    </span>
  </div>

  <?php if (!empty($error)): ?>
    <div class="error-box"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="post" action="login.php" style="display:flex;flex-direction:column;gap:18px">
    <div style="display:flex;flex-direction:column;gap:6px">
      <label style="font-size:12.5px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(250,247,242,0.6)">Username or Email</label>
      <input type="text" name="username" required autocomplete="username" placeholder="admin" class="input-field" />
    </div>

    <div style="display:flex;flex-direction:column;gap:6px">
      <label style="font-size:12.5px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(250,247,242,0.6)">Password</label>
      <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="input-field" />
    </div>

    <button type="submit" class="submit-btn" style="margin-top:10px">Sign In to Dashboard →</button>
  </form>

  <div style="margin-top:32px;text-align:center;border-top:1px solid rgba(250,247,242,0.1);padding-top:18px">
    <a href="../index.php" style="color:rgba(250,247,242,0.5);font-size:13.5px;text-decoration:none;transition:color 180ms ease" onmouseover="this.style.color='#D9A879'" onmouseout="this.style.color='rgba(250,247,242,0.5)'">← Return to Website</a>
  </div>
</div>

</body>
</html>
