<?php
/**
 * Login Handler
 */

require_once 'php/auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['username']) && isset($data['password'])) {
        $result = loginAdmin($data['username'], $data['password']);
        
        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => 'admin-dashboard.php'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $result['message']
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Username and password required'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
}
?>
