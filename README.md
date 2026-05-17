#### Teacher Schedule Management System

A robust web-based scheduling application built with PHP and MySQL. It allows teachers to manage their daily routines and administrators to oversee system-wide schedules with ease.

---

### 📦 Stack
- PHP 8.x
- MySQL / MariaDB
- PHPMailer
- Vanilla CSS

---

### ? Quick start
```bash
# Clone the repository
git clone https://github.com/wayne2604/teacher-scheduler.git

# Navigate to the directory
cd teacher-scheduler

# Copy the example config and add your DB credentials
cp db_conn.php.example db_conn.php
```
Ensure you have a local server (like XAMPP) running and the database schema imported to get started.

---

### ?? Features
- **Secure Auth** — Login and registration system for teachers and admins.
- **Schedule Management** — Create, view, and delete daily schedules.
- **Search Logic** — Efficient filtering to find specific classes or times.
- **Password Recovery** — Secure reset links sent via SMTP using PHPMailer.

---

### ??? How it works
The system follows a modular PHP architecture designed for reliability and ease of use:
- **Database Connectivity**: Uses `mysqli` with `utf8mb4` charset to handle special characters (like "ñ") correctly.
- **Decoupled Logic**: UI and processing are separated into `index.php` and `*_logic.php` files for better maintainability.
- **Mailing System**: Integrates PHPMailer to handle authenticated SMTP requests for password resets.

---

### ?? Project structure
```text
/
+-- PHPMailer/          # Core library for email functionality
+-- style/              # CSS assets and design files
+-- add_schedule_logic.php # Backend logic for adding schedules
+-- admin.php           # Admin dashboard interface
+-- db_conn.php.example # Template for database configuration
+-- index.php           # Main entry point and user dashboard
+-- login_logic.php     # Authentication processing
+-- README.md           # Project documentation
```

---

### ?? Author
**Wayne** - [https://github.com/wayne2604](https://github.com/wayne2604)
