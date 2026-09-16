# LandBuy - Land Selling & Buying Website

A full-stack Land Selling and Buying website for Sri Lanka, built with:
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 8+
- **Database**: MySQL
- **Java API**: Spring Boot REST API (optional backend)

---

## 📁 Project Structure

```
landbuy/
├── index.php              # Homepage
├── register.php           # User registration
├── login.php              # Login page
├── search.php             # Browse/search lands
├── land-detail.php        # Single land detail
├── about.php              # About page
├── contact.php            # Contact page
│
├── css/
│   └── style.css          # Main stylesheet
│
├── js/
│   └── main.js            # Main JavaScript
│
├── php/
│   ├── config.php         # DB config + session helpers
│   ├── auth.php           # Register / Login / Logout
│   ├── lands.php          # Add / Edit / Delete / Approve lands
│   ├── inquiries.php      # Send inquiry / Favorites
│   ├── header.php         # Shared navbar
│   └── footer.php         # Shared footer
│
├── seller/
│   ├── dashboard.php      # Seller dashboard
│   ├── my_lands.php       # Seller's land listings
│   ├── add_land.php       # Add new land
│   ├── edit_land.php      # Edit land
│   ├── inquiries.php      # View received inquiries
│   └── profile.php        # Seller profile
│
├── buyer/
│   ├── dashboard.php      # Buyer dashboard
│   ├── inquiries.php      # Buyer inquiries sent
│   ├── favorites.php      # Saved/favorite lands
│   └── profile.php        # Buyer profile
│
├── admin/
│   ├── dashboard.php      # Admin dashboard
│   ├── users.php          # Manage users
│   ├── lands.php          # Approve/reject/manage lands
│   ├── inquiries.php      # View all inquiries
│   └── reports.php        # Statistics & reports
│
├── images/
│   └── lands/             # Uploaded land images (auto-created)
│
├── java/                  # Optional Spring Boot REST API
│   ├── LandBuyApplication.java
│   ├── Land.java
│   ├── LandController.java
│   ├── LandRepository.java
│   ├── UserModel_Controller.java
│   ├── pom.xml
│   └── application.properties
│
└── database.sql           # MySQL database schema + sample data
```

---

## 🚀 Installation (PHP + MySQL)

### Requirements
- PHP 8.0+
- MySQL 5.7+ or MariaDB 10+
- Apache/Nginx with mod_rewrite (XAMPP/WAMP/LAMP)

### Steps

1. **Copy project** to your web server root:
   ```
   C:\xampp\htdocs\landbuy\     (Windows/XAMPP)
   /var/www/html/landbuy/       (Linux/Apache)
   ```

2. **Import the database**:
   - Open phpMyAdmin → `http://localhost/phpmyadmin`
   - Create a new database: `landbuy_db`
   - Click **Import** and select `database.sql`
   - Click **Go**

3. **Configure database** in `php/config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');        // your MySQL password
   define('DB_NAME', 'landbuy_db');
   define('SITE_URL', 'http://localhost/landbuy');
   ```

4. **Create upload folder** (if not auto-created):
   ```
   landbuy/images/lands/
   ```
   Set permissions: `chmod 755 images/lands/` (Linux)

5. **Open in browser**:
   ```
   http://localhost/landbuy/
   ```

---

## 🔐 Demo Accounts

| Role   | Email                  | Password  |
|--------|------------------------|-----------|
| Admin  | admin@landbuy.lk       | password  |
| Seller | kumar@example.com      | password  |
| Seller | silva@example.com      | password  |
| Buyer  | *(Register new account)* | -       |

---

## 👥 User Roles

### 🛒 Buyer
- Browse and search lands
- View land details
- Send inquiries to sellers
- Save favorite lands
- Manage profile

### 🏞️ Seller
- Add land listings with images
- Edit / delete own listings
- View inquiries from buyers
- Manage profile

### ⚙️ Admin
- Approve or reject land listings
- Manage all users
- View all inquiries
- View reports and statistics

---

## ☕ Java Spring Boot API (Optional)

The `java/` folder contains a Spring Boot REST API that mirrors the PHP backend.

### Run the Java API
```bash
cd java/
mvn spring-boot:run
```

### API Endpoints
| Method | Endpoint                    | Description              |
|--------|-----------------------------|--------------------------|
| GET    | /api/lands                  | List approved lands      |
| GET    | /api/lands/{id}             | Get single land          |
| POST   | /api/lands                  | Create land listing      |
| PUT    | /api/lands/{id}             | Update land              |
| PATCH  | /api/lands/{id}/approve     | Approve land (admin)     |
| PATCH  | /api/lands/{id}/reject      | Reject land (admin)      |
| DELETE | /api/lands/{id}             | Delete land              |
| GET    | /api/lands/seller/{id}      | Lands by seller          |
| POST   | /api/users/register         | Register user            |
| POST   | /api/users/login            | Login user               |
| GET    | /api/users                  | List all users (admin)   |

---

## 🎨 Design Features
- Responsive design (mobile-friendly)
- Green nature-themed UI
- Sticky navbar
- Image gallery for land details
- Search filters (district, type, price, size)
- Pagination for land listings
- Dashboard stats cards
- Role-based navigation

---

## 📸 Pages Implemented

1. ✅ Home Page (hero + search + featured lands)
2. ✅ Register Page
3. ✅ Login Page
4. ✅ Search Lands Page (with filters)
5. ✅ Land Detail Page (gallery + specs + inquiry form)
6. ✅ Seller Dashboard
7. ✅ Seller My Lands
8. ✅ Seller Add Land
9. ✅ Seller Edit Land
10. ✅ Seller Inquiries
11. ✅ Seller Profile
12. ✅ Buyer Dashboard
13. ✅ Buyer Inquiries
14. ✅ Buyer Favorites
15. ✅ Buyer Profile
16. ✅ Admin Dashboard
17. ✅ Admin Lands (approve/reject)
18. ✅ Admin Users
19. ✅ Admin Inquiries
20. ✅ Admin Reports
21. ✅ About Page
22. ✅ Contact Page

---

*Built with ❤️ — LandBuy © 2024*
