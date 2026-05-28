<?php
/**
 * API for Movies and Characters CRUD Operations
 */

header('Content-Type: application/json');
require_once 'config.php';
require_once 'auth.php';
require_once 'movies.php';
require_once 'characters.php';

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Handle different endpoints
switch ($type) {
    case 'movies':
        handleMovies($method, $action);
        break;
    case 'characters':
        handleCharacters($method, $action);
        break;
    case 'stats':
        handleStats();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid type']);
}

/**
 * Handle Movies CRUD
 */
function handleMovies($method, $action) {
    switch ($action) {
        case 'get_all':
            $movies = getAllMovies();
            echo json_encode(['success' => true, 'data' => $movies]);
            break;
            
        case 'get_one':
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $movie = getMovieById($id);
            if ($movie) {
                echo json_encode(['success' => true, 'data' => $movie]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Movie not found']);
            }
            break;
            
        case 'create':
            if ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = createMovie(
                    $data['title'],
                    $data['release_year'],
                    $data['tagline'],
                    $data['duration_minutes'],
                    $data['rating'],
                    $data['poster_image'],
                    $data['description']
                );
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'update':
            if ($method === 'POST' || $method === 'PUT') {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = updateMovie(
                    $data['id'],
                    $data['title'],
                    $data['release_year'],
                    $data['tagline'],
                    $data['duration_minutes'],
                    $data['rating'],
                    $data['poster_image'],
                    $data['description']
                );
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'delete':
            if ($method === 'POST' || $method === 'DELETE') {
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $result = deleteMovie($id);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'search':
            $term = isset($_GET['q']) ? $_GET['q'] : '';
            $movies = searchMovies($term);
            echo json_encode(['success' => true, 'data' => $movies]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

/**
 * Handle Characters CRUD
 */
function handleCharacters($method, $action) {
    switch ($action) {
        case 'get_all':
            $characters = getAllCharacters();
            echo json_encode(['success' => true, 'data' => $characters]);
            break;
            
        case 'get_one':
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $character = getCharacterById($id);
            if ($character) {
                echo json_encode(['success' => true, 'data' => $character]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Character not found']);
            }
            break;
            
        case 'create':
            if ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = createCharacter(
                    $data['name'],
                    $data['role'],
                    $data['quote'],
                    $data['description'],
                    $data['avatar_image'],
                    isset($data['character_type']) ? $data['character_type'] : 'main'
                );
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'update':
            if ($method === 'POST' || $method === 'PUT') {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = updateCharacter(
                    $data['id'],
                    $data['name'],
                    $data['role'],
                    $data['quote'],
                    $data['description'],
                    $data['avatar_image'],
                    $data['character_type']
                );
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'delete':
            if ($method === 'POST' || $method === 'DELETE') {
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $result = deleteCharacter($id);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            }
            break;
            
        case 'search':
            $term = isset($_GET['q']) ? $_GET['q'] : '';
            $characters = searchCharacters($term);
            echo json_encode(['success' => true, 'data' => $characters]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

/**
 * Handle Stats
 */
function handleStats() {
    $stats = [
        'movies_count' => getMovieCount(),
        'characters_count' => getCharacterCount()
    ];
    echo json_encode(['success' => true, 'data' => $stats]);
}
?>
