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

---
## Make sure your global Composer vendor/bin directory is in your system PATH:

Windows: C:\Users\<YourUser>\AppData\Roaming\Composer\vendor\bin

Linux/macOS: ~/.composer/vendor/bin or ~/.config/composer/vendor/bin
