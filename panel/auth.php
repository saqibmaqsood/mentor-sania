<?php
/**
 * auth.php — Authentication and session management for Mentor Sania Panel.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

function requireLogin() {
    if (empty($_SESSION['panel_user_id'])) {
        header('Location: /panel/login.php');
        exit;
    }
}

function getCurrentUser() {
    global $db;
    if (empty($_SESSION['panel_user_id'])) return null;
    $stmt = $db->prepare("SELECT id, username, email, full_name, role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['panel_user_id']]);
    return $stmt->fetch();
}

function attemptLogin($username, $password) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['panel_user_id'] = $user['id'];
        $_SESSION['panel_user_name'] = $user['full_name'];
        $_SESSION['panel_user_role'] = $user['role'];
        return true;
    }
    return false;
}

function logoutUser() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
