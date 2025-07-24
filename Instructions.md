# Project Setup Guide

## Requirements

- **PHP 7.4+** (included in XAMPP)
- **MySQL Server** (included in XAMPP)
- **Web browser:** Chrome, Firefox, Edge, etc.
- **XAMPP** (or similar local server stack)
- **Version 8.1 mPDF**

## Step-by-Step Setup Guide

### 1. Install and Start XAMPP

- Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
- Run the installer (default settings recommended).
- Open the XAMPP Control Panel.
- Start the following services:
  - **Apache** (web server)
  - **MySQL** (database server)

### 2. Set Up Project Files

Place your project folder in the XAMPP web directory based on your OS:

- **Windows:** `C:\xampp\htdocs\Interview\`
- **Mac:** `/Applications/XAMPP/htdocs/Interview/`
- **Linux:** `/opt/lampp/htdocs/Interview/`

Verify the folder contains:

- `index.php`
- `login.php`
- `includes/` (with `config.php`)
- `assets/` (CSS/JS/images)
- `database/` (with `schema.sql` and `dummy_data.sql`)

### 3. Create the Database

- Open phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Create a new database named `synrgise_tasks` (or use an existing one).

**Import the database schema:**

  1. Click the database name.
  2. Go to the "Import" tab.
  3. Select `database/schema.sql`.
  4. Click "Go".

**Import sample data:**

  1. Go to the "Import" tab again.
  2. Select `database/dummy_data.sql`.
  3. Click "Go".

### 4. Verify Database Configuration

Your `config.php` should already include the default XAMPP settings:
private $host = 'localhost';
private $database = 'synrgise_tasks';
private $username = 'root';
private $password = ''; // Empty password for XAMPP
private $port = 3306;

**No changes needed unless:**

- You changed your MySQL password in XAMPP, or
- You used a different database name.

### 5. Test Credentials

After importing the dummy data, use these login credentials:

| Username     | Password  |
| ------------ | --------- |
| demo         | demo123   |
| john_doe     | demo123   |
| jane_smith   | demo123   |

### 6. Run the Application

- Open your preferred web browser.
- Go to the login page:
http://localhost/Interview/login.php

- After login, you'll be redirected to:
http://localhost/Interview/index.php


## Troubleshooting

### Common Issues & Solutions

#### Database Connection Failed

- Make sure MySQL is running in XAMPP.
- Check the database name (`synrgise_tasks`) matches in both phpMyAdmin and `config.php`.
- Ensure `schema.sql` was imported successfully.

#### Page Not Found (404)

- Confirm the project folder is in the correct `htdocs` directory.
- Check the folder name matches the URL (case-sensitive).
- Ensure `.htaccess` is not blocking access.