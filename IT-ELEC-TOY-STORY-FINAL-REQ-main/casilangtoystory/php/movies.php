<?php
/**
 * Movies CRUD Operations
 */

require_once 'config.php';

/**
 * Get all movies
 */
function getAllMovies() {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM movies ORDER BY release_year ASC");
    
    $movies = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }
    
    closeDbConnection($conn);
    return $movies;
}

/**
 * Get movie by ID
 */
function getMovieById($id) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $movie = null;
    if ($result->num_rows === 1) {
        $movie = $result->fetch_assoc();
    }
    
    $stmt->close();
    closeDbConnection($conn);
    
    return $movie;
}

/**
 * Create new movie
 */
function createMovie($title, $release_year, $tagline, $duration_minutes, $rating, $poster_image, $description) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("INSERT INTO movies (title, release_year, tagline, duration_minutes, rating, poster_image, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisidss", $title, $release_year, $tagline, $duration_minutes, $rating, $poster_image, $description);
    
    $result = $stmt->execute();
    $insert_id = $stmt->insert_id;
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result, 'id' => $insert_id];
}

/**
 * Update movie
 */
function updateMovie($id, $title, $release_year, $tagline, $duration_minutes, $rating, $poster_image, $description) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("UPDATE movies SET title=?, release_year=?, tagline=?, duration_minutes=?, rating=?, poster_image=?, description=? WHERE id=?");
    $stmt->bind_param("sisidsdi", $title, $release_year, $tagline, $duration_minutes, $rating, $poster_image, $description, $id);
    
    $result = $stmt->execute();
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result];
}

/**
 * Delete movie
 */
function deleteMovie($id) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    $result = $stmt->execute();
    
    $stmt->close();
    closeDbConnection($conn);
    
    return ['success' => $result];
}

/**
 * Search movies
 */
function searchMovies($search_term) {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("SELECT * FROM movies WHERE title LIKE ? OR tagline LIKE ? ORDER BY release_year DESC");
    $search_pattern = "%{$search_term}%";
    $stmt->bind_param("ss", $search_pattern, $search_pattern);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
    
    $stmt->close();
    closeDbConnection($conn);
    
    return $movies;
}

/**
 * Get movie count
 */
function getMovieCount() {
    $conn = getDbConnection();
    $result = $conn->query("SELECT COUNT(*) as count FROM movies");
    $row = $result->fetch_assoc();
    closeDbConnection($conn);
    return $row['count'];
}
?>
