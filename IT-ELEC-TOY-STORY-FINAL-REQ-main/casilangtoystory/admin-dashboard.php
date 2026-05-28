<?php
/**
 * Admin Dashboard - PHP Version
 * Toy Story Fan Site
 */

require_once 'php/auth.php';
requireAdminLogin();
require_once 'php/movies.php';
require_once 'php/characters.php';

$admin_username = getCurrentAdminUsername();
$movies_count = getMovieCount();
$characters_count = getCharacterCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOY STORY Admin Dashboard | Manage Content</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-dashboard-body">
    <!-- Animated Background -->
    <div class="background-container cinematic-bg admin-bg">
        <div class="sky-background night-sky"></div>
        <div class="stars-container">
            <div class="star-layer star-layer-1"></div>
            <div class="star-layer star-layer-2"></div>
            <div class="star-layer star-layer-3"></div>
        </div>
        <div class="clouds-container night-clouds">
            <div class="cloud cloud-1"></div>
            <div class="cloud cloud-2"></div>
            <div class="cloud cloud-3"></div>
        </div>
        <div class="moon-glow"></div>
        <div class="lamp-glow"></div>
    </div>
    
    <!-- Custom Cursor for Admin -->
    <div class="custom-cursor" id="customCursor"></div>
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Admin Layout -->
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-hat-cowboy"></i>
                </div>
                <span class="sidebar-title">TOY STORY</span>
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item active">
                        <a href="#dashboard" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#movies" class="nav-link">
                            <i class="fas fa-film"></i>
                            <span class="nav-text">Movies</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#characters" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Characters</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="main.html" class="nav-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            <span class="nav-text">View Website</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <a href="logout-handler.php" class="nav-link logout-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <!-- Top Bar -->
            <header class="admin-topbar glassmorphism-card">
                <div class="topbar-left">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="admin-greeting">
                        <h1>Welcome back, <span class="highlight"><?php echo htmlspecialchars($admin_username); ?></span>!</h1>
                        <p>Manage your Toy Story fan site content</p>
                    </div>
                </div>

                <div class="topbar-right">
                    <!-- Global Search -->
                    <div class="global-search">
                        <input 
                            type="text" 
                            class="search-input glass-input" 
                            placeholder="Search movies, characters..."
                            id="globalSearch"
                            aria-label="Global search"
                        >
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <!-- Profile Avatar -->
                    <div class="profile-avatar">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%23F4C542'/%3E%3Ctext x='50' y='55' font-size='40' text-anchor='middle' fill='%231a2744' font-family='Bangers'%3EA%3C/text%3E%3C/svg%3E" alt="Admin Avatar" class="avatar-img">
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="admin-content">
                <!-- Stats Row -->
                <section class="stats-section">
                    <div class="stats-grid">
                        <div class="stat-card glassmorphism-card">
                            <div class="stat-icon movie-icon">
                                <i class="fas fa-film"></i>
                            </div>
                            <div class="stat-info">
                                <h3 class="stat-number" data-target="<?php echo $movies_count; ?>">0</h3>
                                <p class="stat-label">Total Movies</p>
                            </div>
                            <div class="stat-glow"></div>
                        </div>

                        <div class="stat-card glassmorphism-card">
                            <div class="stat-icon character-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3 class="stat-number" data-target="<?php echo $characters_count; ?>">0</h3>
                                <p class="stat-label">Total Characters</p>
                            </div>
                            <div class="stat-glow"></div>
                        </div>

                        <div class="stat-card glassmorphism-card">
                            <div class="stat-icon update-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h3 class="stat-number">24</h3>
                                <p class="stat-label">Hours Ago</p>
                            </div>
                            <div class="stat-glow"></div>
                        </div>

                        <div class="stat-card glassmorphism-card">
                            <div class="stat-icon session-icon">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <div class="stat-info">
                                <h3 class="stat-number" data-target="12">0</h3>
                                <p class="stat-label">Active Sessions</p>
                            </div>
                            <div class="stat-glow"></div>
                        </div>
                    </div>
                </section>

                <!-- Movies Management Section -->
                <section class="content-section" id="movies">
                    <div class="section-header glassmorphism-card">
                        <div class="section-title-wrapper">
                            <h2><i class="fas fa-film"></i> Movies Management</h2>
                            <p>Edit and manage movie entries</p>
                        </div>
                        <button class="btn btn-primary cinematic-btn" id="addMovieBtn">
                            <i class="fas fa-plus"></i>
                            <span>Add New Movie</span>
                            <span class="btn-shine"></span>
                        </button>
                    </div>

                    <!-- Movies Table -->
                    <div class="table-container glassmorphism-card">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Release Year</th>
                                    <th>Tagline</th>
                                    <th>Poster Preview</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="moviesTableBody">
                                <?php
                                $movies = getAllMovies();
                                foreach ($movies as $movie):
                                ?>
                                <tr data-id="<?php echo $movie['id']; ?>">
                                    <td><?php echo $movie['id']; ?></td>
                                    <td><?php echo htmlspecialchars($movie['title']); ?></td>
                                    <td><?php echo $movie['release_year']; ?></td>
                                    <td class="tagline-cell"><?php echo htmlspecialchars(substr($movie['tagline'], 0, 50)); ?>...</td>
                                    <td>
                                        <div class="poster-preview">
                                            <img src="<?php echo htmlspecialchars($movie['poster_image']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?> Poster">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action btn-edit" title="Edit" onclick="editMovie(<?php echo $movie['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action btn-delete" title="Delete" onclick="deleteMovie(<?php echo $movie['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Empty State (hidden by default) -->
                        <div class="empty-state hidden" id="moviesEmptyState">
                            <i class="fas fa-film"></i>
                            <h3>No Movies Found</h3>
                            <p>Start by adding your first movie!</p>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            <button class="pagination-btn" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <button class="pagination-btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Characters Management Section -->
                <section class="content-section" id="characters">
                    <div class="section-header glassmorphism-card">
                        <div class="section-title-wrapper">
                            <h2><i class="fas fa-users"></i> Characters Management</h2>
                            <p>Edit and manage character profiles</p>
                        </div>
                        <button class="btn btn-primary cinematic-btn" id="addCharacterBtn">
                            <i class="fas fa-plus"></i>
                            <span>Add New Character</span>
                            <span class="btn-shine"></span>
                        </button>
                    </div>

                    <!-- Characters Table -->
                    <div class="table-container glassmorphism-card">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Character Role</th>
                                    <th>Quote Preview</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="charactersTableBody">
                                <?php
                                $characters = getAllCharacters();
                                foreach ($characters as $char):
                                ?>
                                <tr data-id="<?php echo $char['id']; ?>">
                                    <td><?php echo $char['id']; ?></td>
                                    <td>
                                        <div class="avatar-preview">
                                            <img src="<?php echo htmlspecialchars($char['avatar_image']); ?>" alt="<?php echo htmlspecialchars($char['name']); ?>">
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($char['name']); ?></td>
                                    <td><p class="character-role"><?php echo htmlspecialchars($char['role']); ?></p></td>
                                    <td class="quote-preview">"<?php echo htmlspecialchars(substr($char['quote'], 0, 30)); ?>..."</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action btn-edit" title="Edit" onclick="editCharacter(<?php echo $char['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action btn-delete" title="Delete" onclick="deleteCharacter(<?php echo $char['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Empty State (hidden by default) -->
                        <div class="empty-state hidden" id="charactersEmptyState">
                            <i class="fas fa-users"></i>
                            <h3>No Characters Found</h3>
                            <p>Start by adding your first character!</p>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            <button class="pagination-btn" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <button class="pagination-btn">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- Add Movie Modal -->
    <div class="modal hidden" id="addMovieModal">
        <div class="modal-content glassmorphism-card">
            <div class="modal-header">
                <h2><i class="fas fa-film"></i> Add New Movie</h2>
                <button class="modal-close" id="closeMovieModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addMovieForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="movieTitle">Title *</label>
                        <input type="text" id="movieTitle" name="title" required class="glass-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="movieYear">Release Year *</label>
                            <input type="number" id="movieYear" name="release_year" min="1900" max="2099" required class="glass-input">
                        </div>
                        <div class="form-group">
                            <label for="movieDuration">Duration (min)</label>
                            <input type="number" id="movieDuration" name="duration_minutes" class="glass-input">
                        </div>
                        <div class="form-group">
                            <label for="movieRating">Rating</label>
                            <input type="number" id="movieRating" name="rating" step="0.1" min="0" max="10" class="glass-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="movieTagline">Tagline</label>
                        <textarea id="movieTagline" name="tagline" rows="2" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="moviePoster">Poster Image Path</label>
                        <input type="text" id="moviePoster" name="poster_image" placeholder="img/toystory.webp" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="movieDescription">Description</label>
                        <textarea id="movieDescription" name="description" rows="3" class="glass-input"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelMovieBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary cinematic-btn">
                        <i class="fas fa-save"></i>
                        <span>Save Movie</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Movie Modal -->
    <div class="modal hidden" id="editMovieModal">
        <div class="modal-content glassmorphism-card">
            <div class="modal-header">
                <h2><i class="fas fa-film"></i> Edit Movie</h2>
                <button class="modal-close" id="closeEditMovieModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editMovieForm">
                <input type="hidden" id="editMovieId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editMovieTitle">Title *</label>
                        <input type="text" id="editMovieTitle" name="title" required class="glass-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="editMovieYear">Release Year *</label>
                            <input type="number" id="editMovieYear" name="release_year" min="1900" max="2099" required class="glass-input">
                        </div>
                        <div class="form-group">
                            <label for="editMovieDuration">Duration (min)</label>
                            <input type="number" id="editMovieDuration" name="duration_minutes" class="glass-input">
                        </div>
                        <div class="form-group">
                            <label for="editMovieRating">Rating</label>
                            <input type="number" id="editMovieRating" name="rating" step="0.1" min="0" max="10" class="glass-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editMovieTagline">Tagline</label>
                        <textarea id="editMovieTagline" name="tagline" rows="2" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editMoviePoster">Poster Image Path</label>
                        <input type="text" id="editMoviePoster" name="poster_image" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="editMovieDescription">Description</label>
                        <textarea id="editMovieDescription" name="description" rows="3" class="glass-input"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelEditMovieBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary cinematic-btn">
                        <i class="fas fa-save"></i>
                        <span>Update Movie</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Character Modal -->
    <div class="modal hidden" id="addCharacterModal">
        <div class="modal-content glassmorphism-card">
            <div class="modal-header">
                <h2><i class="fas fa-users"></i> Add New Character</h2>
                <button class="modal-close" id="closeCharacterModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addCharacterForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="charName">Name *</label>
                        <input type="text" id="charName" name="name" required class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="charRole">Character Role</label>
                        <input type="text" id="charRole" name="role" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="charQuote">Quote</label>
                        <textarea id="charQuote" name="quote" rows="2" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="charAvatar">Avatar Image Path</label>
                        <input type="text" id="charAvatar" name="avatar_image" placeholder="img/character.jpg" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="charDescription">Description</label>
                        <textarea id="charDescription" name="description" rows="3" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="charType">Character Type</label>
                        <select id="charType" name="character_type" class="glass-input">
                            <option value="main">Main</option>
                            <option value="supporting">Supporting</option>
                            <option value="minor">Minor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelCharacterBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary cinematic-btn">
                        <i class="fas fa-save"></i>
                        <span>Save Character</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Character Modal -->
    <div class="modal hidden" id="editCharacterModal">
        <div class="modal-content glassmorphism-card">
            <div class="modal-header">
                <h2><i class="fas fa-users"></i> Edit Character</h2>
                <button class="modal-close" id="closeEditCharacterModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editCharacterForm">
                <input type="hidden" id="editCharacterId" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editCharName">Name *</label>
                        <input type="text" id="editCharName" name="name" required class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="editCharRole">Character Role</label>
                        <input type="text" id="editCharRole" name="role" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="editCharQuote">Quote</label>
                        <textarea id="editCharQuote" name="quote" rows="2" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editCharAvatar">Avatar Image Path</label>
                        <input type="text" id="editCharAvatar" name="avatar_image" class="glass-input">
                    </div>
                    <div class="form-group">
                        <label for="editCharDescription">Description</label>
                        <textarea id="editCharDescription" name="description" rows="3" class="glass-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editCharType">Character Type</label>
                        <select id="editCharType" name="character_type" class="glass-input">
                            <option value="main">Main</option>
                            <option value="supporting">Supporting</option>
                            <option value="minor">Minor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelEditCharacterBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary cinematic-btn">
                        <i class="fas fa-save"></i>
                        <span>Update Character</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Toast -->
    <div class="toast success hidden" id="successToast">
        <i class="fas fa-check-circle"></i>
        <span id="successMessage">Operation successful!</span>
    </div>

    <!-- Error Toast -->
    <div class="toast error hidden" id="errorToast">
        <i class="fas fa-exclamation-circle"></i>
        <span id="errorMessage">Operation failed!</span>
    </div>

    <script src="admin-script.js"></script>
</body>
</html>
