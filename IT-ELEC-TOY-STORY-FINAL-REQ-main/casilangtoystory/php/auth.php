<?php
/**
 * Admin Authentication Functions
 */

require_once 'config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Register a new admin user
 */
function registerAdmin($username, $email, $password) {
    $conn = getDbConnection();
    
    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO admins (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password_hash);
    
    $result = $stmt->execute();
    
    $stmt->close();
    closeDbConnection($conn);
    
    return $result;
}

/**
 * Login admin user
 */
function loginAdmin($username, $password) {
    $conn = getDbConnection();
    
    // Prepare statement
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM admins WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $admin['password_hash'])) {
            // Set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_logged_in'] = true;
            
            $stmt->close();
            closeDbConnection($conn);
            
            return ['success' => true, 'admin_id' => $admin['id'], 'username' => $admin['username']];
        }
    }
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => false, 'message' => 'Invalid username or password'];
}

/**
 * Logout admin user
 */
function logoutAdmin() {
    session_unset();
    session_destroy();
    return true;
}

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Get current admin username
 */
function getCurrentAdminUsername() {
    return isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin';
}

/**
 * Require admin login (for protected pages)
 */
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: admin-login.html');
        exit();
    }
}
?>
