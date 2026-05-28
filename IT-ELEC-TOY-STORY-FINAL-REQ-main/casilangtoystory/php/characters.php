<?php
/**
 * Characters CRUD Operations
 */

require_once 'config.php';

/**
 * Get all characters
 */
function getAllCharacters() {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM characters ORDER BY name ASC");
    
    $characters = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $characters[] = $row;
        }
    }
    
    closeDbConnection($conn);
    return $characters;
}

/**
 * Get character by ID
 */
function getCharacterById($id) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("SELECT * FROM characters WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $character = null;
    if ($result->num_rows === 1) {
        $character = $result->fetch_assoc();
    }
    
    $stmt->close();
    closeDbConnection($conn);
    
    return $character;
}

/**
 * Create new character
 */
function createCharacter($name, $role, $quote, $description, $avatar_image, $character_type = 'main') {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("INSERT INTO characters (name, role, quote, description, avatar_image, character_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $role, $quote, $description, $avatar_image, $character_type);
    
    $result = $stmt->execute();
    $insert_id = $stmt->insert_id;
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result, 'id' => $insert_id];
}

/**
 * Update character
 */
function updateCharacter($id, $name, $role, $quote, $description, $avatar_image, $character_type) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("UPDATE characters SET name=?, role=?, quote=?, description=?, avatar_image=?, character_type=? WHERE id=?");
    $stmt->bind_param("sssssdi", $name, $role, $quote, $description, $avatar_image, $character_type, $id);
    
    $result = $stmt->execute();
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result];
}

/**
 * Delete character
 */
function deleteCharacter($id) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("DELETE FROM characters WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    $result = $stmt->execute();
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result];
}

/**
 * Search characters
 */
function searchCharacters($search_term) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("SELECT * FROM characters WHERE name LIKE ? OR role LIKE ? ORDER BY name ASC");
    $search_pattern = "%{$search_term}%";
    $stmt->bind_param("ss", $search_pattern, $search_pattern);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $characters = [];
    while ($row = $result->fetch_assoc()) {
        $characters[] = $row;
    }
    
    $stmt->close();
    closeDbConnection($conn);
    
    return $characters;
}

/**
 * Get character count
 */
function getCharacterCount() {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(*) as count FROM characters");
    $row = $result->fetch_assoc();
    closeDbConnection($conn);
    return $row['count'];
}
?>
