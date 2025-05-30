# RandomWebSite-UniLab

## Project Overview
This is a PHP-based e-commerce web application for UniLab coursework, developed by Mai Hoàng Phúc (2252635). The application allows users to register, log in, browse products, purchase items, and manage their accounts. Admin users can manage products and view all purchase histories.

## Features
- User authentication (register, login, logout, password reset)
- Product browsing, searching, and filtering by category
- Product purchase with checkout and address/billing form
- Order history for users and admins
- Admin product management (add/delete products)
- Account management (change password, delete account)
- Responsive UI with Bootstrap and custom styles

## Project Structure
- `index.php`: Main entry point, handles routing
- `header.php`: Navigation and layout
- `pages/`: Contains all page scripts (login, register, products, checkout, etc.)
- `uploads/`: Sample images for products
- `vendor/`: Composer dependencies (ColorThief for color extraction)
- `composer.json`: PHP dependencies

## Setup Instructions
1. **Clone or extract the project** to your web server directory (e.g., `htdocs` for XAMPP).
2. **Install dependencies**:
   ```
   composer install
   ```
3. **Database setup**:
   - Create a MySQL database named `account`.
   - Create the required tables (`users`, `products`, `buy_history`, etc.) according to your application logic.
   - Update `pages/db.php` if your database credentials differ from:
     ```php
     $db_server = "localhost";
     $db_user = "root";
     $db_pass = "";
     $db_name = "account";
     ```
4. **Run the application**:
   - Open your browser and navigate to `http://localhost/[project-folder]/index.php`.

## Dependencies
- PHP >= 7.x
- MySQL
- Composer
- [ksubileau/color-thief-php](https://github.com/ksubileau/color-thief-php) (for color palette extraction)
- Bootstrap 5 (via CDN)
- FontAwesome (via CDN)

## Usage
- Register a new account or log in with an existing one.
- Browse and search for products.
- Add products to the database (admin only).
- Purchase products and view your order history.
- Manage your account (change password, delete account, reset password).

## Author
Mai Hoàng Phúc - 2252635

---
For any issues, please contact the author or your course instructor.
