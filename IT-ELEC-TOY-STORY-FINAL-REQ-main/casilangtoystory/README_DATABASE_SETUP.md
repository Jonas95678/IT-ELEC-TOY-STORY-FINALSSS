# Toy Story Fan Site - Database & Backend Setup Guide

## Overview
This project converts the hardcoded HTML content from your Toy Story fan site into a dynamic MySQL database-driven website with full CRUD (Create, Read, Update, Delete) functionality for Movies and Characters.

## Files Created

### Database
- `database/schema.sql` - Complete MySQL database schema with tables and initial data

### PHP Backend
- `php/config.php` - Database configuration
- `php/auth.php` - Admin authentication functions
- `php/movies.php` - Movies CRUD operations
- `php/characters.php` - Characters CRUD operations
- `php/api.php` - REST API endpoints

### PHP Pages
- `admin-dashboard.php` - Dynamic admin dashboard (replaces admin-dashboard.html)
- `login-handler.php` - Login form handler
- `logout-handler.php` - Logout handler

### JavaScript Updates
- `admin-script.js` - Updated with full backend integration for CRUD operations

## Setup Instructions

### 1. Database Setup

1. Open phpMyAdmin or MySQL command line
2. Run the SQL script:
```bash
mysql -u root -p < database/schema.sql
```

Or import via phpMyAdmin:
- Go to phpMyAdmin
- Select "Import" tab
- Choose `database/schema.sql`
- Click "Go"

### 2. Configure Database Connection

Edit `php/config.php` if your database credentials are different:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Your MySQL password
define('DB_NAME', 'toystory_db');
```

### 3. Default Admin Credentials

- **Username:** admin
- **Password:** admin123

**IMPORTANT:** Change the default password after first login!

### 4. Access the Website

1. Start your local server (XAMPP, WAMP, MAMP, or PHP built-in server)
2. Navigate to your project folder
3. Access the main website: `http://localhost/your-project-folder/main.html`
4. Access admin dashboard: `http://localhost/your-project-folder/admin-dashboard.php`

### 5. Using the Admin Dashboard

#### Movies Management
- Click "Add New Movie" to create a new movie entry
- Click Edit icon to modify existing movies
- Click Delete icon to remove movies
- All changes will automatically reflect on the main website

#### Characters Management
- Click "Add New Character" to add new characters
- Click Edit icon to modify character details
- Click Delete icon to remove characters
- Changes appear immediately on the main website

## Database Structure

### Tables

#### admins
- id (Primary Key)
- username
- email
- password_hash
- created_at
- updated_at

#### movies
- id (Primary Key)
- title
- release_year
- tagline
- duration_minutes
- rating
- poster_image
- description
- created_at
- updated_at

#### characters
- id (Primary Key)
- name
- role
- quote
- description
- avatar_image
- character_type
- created_at
- updated_at

## API Endpoints

### Movies
- `GET php/api.php?type=movies&action=get_all` - Get all movies
- `GET php/api.php?type=movies&action=get_one&id={id}` - Get single movie
- `POST php/api.php?type=movies&action=create` - Create new movie
- `POST php/api.php?type=movies&action=update` - Update movie
- `POST php/api.php?type=movies&action=delete&id={id}` - Delete movie

### Characters
- `GET php/api.php?type=characters&action=get_all` - Get all characters
- `GET php/api.php?type=characters&action=get_one&id={id}` - Get single character
- `POST php/api.php?type=characters&action=create` - Create new character
- `POST php/api.php?type=characters&action=update` - Update character
- `POST php/api.php?type=characters&action=delete&id={id}` - Delete character

### Stats
- `GET php/api.php?type=stats` - Get movie and character counts

## Features

✅ Full CRUD operations for Movies and Characters
✅ Real-time updates on the main website
✅ Secure admin authentication
✅ Responsive admin dashboard
✅ Image path management
✅ Search functionality
✅ Toast notifications for actions
✅ Form validation
✅ AJAX-powered updates without page reload

## Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check database credentials in `php/config.php`
- Ensure database `toystory_db` exists

### Permission Denied
- Check file permissions for PHP files
- Ensure web server can read/write to the directory

### Images Not Loading
- Verify image paths are correct relative to `main.html`
- Check that images exist in the `img/` folder

### CRUD Operations Not Working
- Open browser console (F12) to check for JavaScript errors
- Verify PHP files have correct permissions
- Check that `session_start()` is working

## Security Notes

⚠️ **Important Security Recommendations:**
1. Change the default admin password immediately
2. Use strong passwords for database users
3. Enable HTTPS in production
4. Sanitize all user inputs (already implemented)
5. Use prepared statements (already implemented)
6. Regularly backup your database

## Support

For issues or questions, check:
1. Browser console for JavaScript errors
2. PHP error logs
3. MySQL error logs

---

**To Infinity and Beyond!** 🚀
