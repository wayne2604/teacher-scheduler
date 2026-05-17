# Teacher Schedule Management System

A robust web-based scheduling application built with PHP and MySQL. Teachers can seamlessly manage their daily routines, while administrators oversee the entire system. Features include secure authentication, email-based password recovery via PHPMailer, and efficient schedule searching.

📦 Stack
PHP 8.x
MySQL / MariaDB
PHPMailer
Vanilla CSS

✨ Quick start
1. Clone the repository to your server's root (e.g., `htdocs`).
2. Import your database schema into MySQL.
3. Copy `db_conn.php.example` to `db_conn.php` and update your database credentials.
4. Open your browser and navigate to `localhost/teacher_schedule`.

📧 Email Setup
This project integrates **PHPMailer** for secure password resets. To enable this, configure your SMTP settings within the `forgot_logic.php` file using your email provider's credentials.

🎹 Features
- **Authentication** — Secure login and registration for teachers and admins.
- **Schedule Management** — Easily add, view, and delete schedule entries.
- **Admin Panel** — Dedicated interface for system-wide management.
- **Search** — Fast filtering to find specific schedules instantly.

🤖 How it works
The system utilizes a classic LAMP/WAMP architecture:
- **Database Layer**: `db_conn.php` handles the connection using `mysqli` with `utf8mb4` support for special characters.
- **Logic Separation**: Processing is handled by dedicated `*_logic.php` files to keep the UI clean.
- **Mailing**: Password recovery links are generated and sent via SMTP using the PHPMailer library.

📁 Project structure
/
  PHPMailer/          # PHPMailer core library files
  style/              # CSS and frontend assets
  db_conn.php.example # Template for database configuration
  index.php           # Main dashboard and entry point
  *_logic.php         # Backend processing scripts
  admin.php           # Administrator dashboard

👤 Author
**Wayne** (rmanunag308@gmail.com)
