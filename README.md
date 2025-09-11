# Panelix Installer & Dashboard

Panelix is a modern **Laravel 12 Admin Dashboard**. This package provides a simple **installer** to create a new Panelix project on your local machine with minimal setup.

---

## Table of Contents

- [Requirements](#requirements)
- [Global Installation](#global-installation)
- [Creating a New Panelix Project](#creating-a-new-panelix-project)
- [Database Setup](#database-setup)
- [Running Migrations & Seeders](#running-migrations--seeders)
- [Serving the Project](#serving-the-project)
- [Custom Domain & CDN_URL](#custom-domain--cdn_url)
- [Manual Steps](#manual-steps)
- [Troubleshooting](#troubleshooting)
- [Support](#support)
- [License](#license)

---

## Requirements

Before using the installer, ensure your system has:

- PHP ≥ 8.2  
- Composer  
- Git  
- MySQL (optional, for automatic database creation)  
- Laravel 12 compatible environment  

---

## Global Installation

Install the installer globally using Composer:

```bash
composer global require panelix/installer
```

-Make sure your global Composer vendor/bin directory is in your system PATH:

    Windows: C:\Users\<YourUser>\AppData\Roaming\Composer\vendor\bin

    Linux/macOS: ~/.composer/vendor/bin or ~/.config/composer/vendor/bin


#Create a New Panelix Project

    Once installed, you can create a new Panelix project with:

Create a New Panelix Project

```bash
panelix new myproject
```
Replace myproject with your desired project directory.

If you leave it blank, the default directory will be panelix-app.


Database Setup

During installation, the installer will:

Ask you to enter a database name (press Enter to use the default panelix_db):

Enter database name (default: panelix_db):


Attempt to create the database automatically if MySQL is available.

If MySQL is not detected or database creation fails, instructions will be provided:

⚠️ Database was not created automatically.
➡️ Please create it manually:
   CREATE DATABASE your_database_name;
   (You can use phpMyAdmin or any MySQL management tool)
➡️ Then run:
   php artisan migrate --seed


The installer will automatically update the .env file with the database name, username, and password.


Serving the Project

After installation, the installer starts the Laravel development server:

🚀 Starting Laravel development server...
✅ Panelix Project is ready!
👉 Serving at: http://127.0.0.1:8000
👉 Project directory: myproject


If you want to serve the project on a custom domain or port, update your .env and CDN_URL accordingly.

Custom Domain & CDN_URL

If you are using Herd, Valet, WSL, or any custom domain (e.g., xyz.test), you need to set the CDN_URL in your .env file:

CDN_URL=http://xyz.test


This ensures assets and links load correctly in your dashboard.

Manual Steps (if needed)

If database creation or migration fails, perform these steps manually:

# Create database
CREATE DATABASE your_database_name;

# Set your DB credentials in .env
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Start server manually (if installer fails)
php artisan serve

Support

Developer: Md. Anik Rahman

Email: a7604366@gmail.com.com

