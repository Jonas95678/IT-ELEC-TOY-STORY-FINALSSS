-- ========================================
-- TOY STORY FAN SITE DATABASE SCHEMA
-- ========================================

-- Create database
CREATE DATABASE IF NOT EXISTS toystory_db;
USE toystory_db;

-- ========================================
-- ADMIN USERS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ========================================
-- MOVIES TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    release_year YEAR NOT NULL,
    tagline TEXT,
    duration_minutes INT,
    rating DECIMAL(3,1),
    poster_image VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ========================================
-- CHARACTERS TABLE
-- ========================================
CREATE TABLE IF NOT EXISTS characters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100),
    quote TEXT,
    description TEXT,
    avatar_image VARCHAR(255),
    character_type VARCHAR(50) DEFAULT 'main',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ========================================
-- INSERT DEFAULT ADMIN USER
-- Password: admin123 (hashed with bcrypt)
-- ========================================
INSERT INTO admins (username, email, password_hash) VALUES 
('admin', 'admin@toystory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ========================================
-- INSERT MOVIES DATA FROM HTML
-- ========================================
INSERT INTO movies (title, release_year, tagline, duration_minutes, rating, poster_image, description) VALUES
('Toy Story', 1995, 'Hang on for the comedy that goes to infinity and beyond!', 81, 8.3, 'img/toystory1.webp', 'The original classic that started it all. A cowboy doll named Woody must deal with a new space ranger toy named Buzz Lightyear.'),
('Toy Story 2', 1999, 'The toys are back!', 92, 7.9, 'img/Toy_Story_2_-_Poster.webp', 'When Woody is stolen by a toy collector, Buzz and his friends set out on a rescue mission.'),
('Toy Story 3', 2010, 'No toy gets left behind.', 103, 8.3, 'img/toystory3.jpg', 'As Andy prepares to leave for college, the toys find themselves at a daycare center where they must escape.'),
('Toy Story 4', 2019, 'Get Ready to Hit the Road', 100, 7.7, 'img/toystory4.jpg', 'Woody and the gang embark on a road trip adventure with Bonnie''s new toy, Forky.');

-- ========================================
-- INSERT CHARACTERS DATA FROM HTML
-- ========================================
INSERT INTO characters (name, role, quote, description, avatar_image, character_type) VALUES
('Woody', 'The Cowboy Leader', 'You\'ve got a friend in me!', 'A brave and loyal pull-string cowboy doll who serves as the leader of Andy\'s toys, always putting his friends first.', 'img/woody.jpg', 'main'),
('Buzz Lightyear', 'Space Ranger', 'To infinity and beyond!', 'A confident space ranger action figure who learns the true meaning of friendship and bravery alongside Woody.', 'img/buzz.jpg', 'main'),
('Jessie', 'The Yodeling Cowgirl', 'I\'m going!, I\'m going!', 'An energetic and fun-loving yodeling cowgirl who brings excitement and enthusiasm to every adventure.', 'img/jessie.jpg', 'main'),
('Rex', 'The Anxious Dinosaur', 'I don\'t think I can do this!', 'A caring but nervous plastic tyrannosaurus who worries about fitting in, yet always shows up for his friends.', 'img/rex.jpg', 'main'),
('Hamm', 'The Wise Piggy Bank', 'It\'s déjà vu all over again!', 'A smart and witty piggy bank who offers clever advice and comic relief with his sarcastic humor.', 'img/hamm.jpg', 'main'),
('Slinky Dog', 'The Loyal Friend', 'I gotta get me one of these!', 'A loyal and friendly dachshund toy with a stretchy spring body, always ready to help his friends.', 'img/dog.jpg', 'main');

-- ========================================
-- VIEWS FOR EASY ACCESS
-- ========================================

-- View for active movies
CREATE OR REPLACE VIEW v_active_movies AS
SELECT * FROM movies ORDER BY release_year ASC;

-- View for main characters
CREATE OR REPLACE VIEW v_main_characters AS
SELECT * FROM characters WHERE character_type = 'main' ORDER BY name ASC;

-- ========================================
-- STORED PROCEDURES
-- ========================================

DELIMITER //

-- Procedure to get movie by ID
CREATE PROCEDURE sp_get_movie(IN movie_id INT)
BEGIN
    SELECT * FROM movies WHERE id = movie_id;
END //

-- Procedure to get character by ID
CREATE PROCEDURE sp_get_character(IN char_id INT)
BEGIN
    SELECT * FROM characters WHERE id = char_id;
END //

-- Procedure to search movies
CREATE PROCEDURE sp_search_movies(IN search_term VARCHAR(100))
BEGIN
    SELECT * FROM movies 
    WHERE title LIKE CONCAT('%', search_term, '%') 
    OR tagline LIKE CONCAT('%', search_term, '%')
    ORDER BY release_year DESC;
END //

-- Procedure to search characters
CREATE PROCEDURE sp_search_characters(IN search_term VARCHAR(100))
BEGIN
    SELECT * FROM characters 
    WHERE name LIKE CONCAT('%', search_term, '%') 
    OR role LIKE CONCAT('%', search_term, '%')
    ORDER BY name ASC;
END //

DELIMITER ;

-- ========================================
-- END OF SCHEMA
-- ========================================
