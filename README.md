<img src="https://i.imgur.com/VO2ucH7.png">

# Panelix Installer & Dashboard

Panelix is a modern Laravel 12 Admin Dashboard Starter Kit with a built-in installer. It helps you quickly scaffold a fresh project on your local machine, giving you a ready-to-use admin panel, preconfigured environment, and minimal setup hassle.

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

> **Make sure your global Composer `vendor/bin` directory is in your system PATH:**
>
> - **Windows**: `C:\Users\<YourUser>\AppData\Roaming\Composer\vendor\bin`
> - **Linux/macOS**: `~/.composer/vendor/bin` or `~/.config/composer/vendor/bin`

You may need to restart your terminal after adding the path.

---

## Creating a New Panelix Project

Once installed, you can create a new Panelix project with:

```bash
panelix new myproject
```

Replace `myproject` with your desired project directory name.

> If you leave it blank, the default directory will be `panelix-app`.

---

## Database Setup

During installation, the installer will:

- Prompt you to enter a database name (press Enter to use the default `panelix_db`):

  ```
  Enter database name (default: panelix_db):
  ```

- Attempt to create the database automatically if MySQL is available.

If MySQL is not detected or database creation fails, you’ll see:

> ⚠️ **Database was not created automatically.**  
> ➡️ Please create it manually:  
> &nbsp;&nbsp;&nbsp;&nbsp;`CREATE DATABASE your_database_name;`  
> &nbsp;&nbsp;&nbsp;&nbsp;(You can use phpMyAdmin or any MySQL management tool)  
> ➡️ Then run:  
> &nbsp;&nbsp;&nbsp;&nbsp;`php artisan migrate --seed`

The installer will automatically update the `.env` file with the database name, username, and password.

---

## Running Migrations & Seeders

The installer attempts to run migrations and seeders automatically after database setup.

If this step fails or is skipped, run manually:

```bash
php artisan migrate --seed
```

---

## Serving the Project

After installation, the installer starts the Laravel development server:

```
🚀 Starting Laravel development server...
✅ Panelix Project is ready!
👉 Serving at: http://127.0.0.1:8000
👉 Project directory: myproject
```

You can access your Panelix dashboard at the provided URL.

---

## Custom Domain & CDN_URL

If you are using **Herd**, **Valet**, **WSL**, or any custom domain (e.g., `xyz.test`), you need to set the `CDN_URL` in your `.env` file:

```env
CDN_URL=http://xyz.test
```

This ensures assets, images, and links load correctly in your dashboard.

> 💡 Tip: Also update `APP_URL` in `.env` if you're using a custom domain:
>
> ```env
> APP_URL=http://xyz.test
> ```

---

## Manual Steps (if needed)

If the installer fails to create the database or run migrations, follow these steps manually:

### 1. Create Database

```sql
CREATE DATABASE your_database_name;
```

### 2. Update `.env` File

Set your database credentials:

```env
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 4. Start Server Manually (if needed)

```bash
php artisan serve
```

---

## Troubleshooting

- ❗ If `panelix` command is not found, ensure Composer’s global `vendor/bin` is in your `PATH`.
- ❗ If database creation fails, verify MySQL is running and accessible with your credentials.
- ❗ If assets don’t load properly, double-check `CDN_URL` and `APP_URL` in `.env`.
- ❗ Clear config cache after changes: `php artisan config:clear`

---

## Support

**Developer**: Md. Anik Rahman  
**Email**: [a7604366@gmail.com](mailto:a7604366@gmail.com)

---

## License

MIT


# Dashboard Overview
<img src="https://i.imgur.com/4gOEuHE.png">
