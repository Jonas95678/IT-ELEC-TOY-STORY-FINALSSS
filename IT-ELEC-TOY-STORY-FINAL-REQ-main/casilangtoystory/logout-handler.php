<?php
/**
 * Logout Handler
 */

require_once 'php/auth.php';

logoutAdmin();
header('Location: admin-login.html');
exit();
?>
