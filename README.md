# Ashesi Lost and Found

## Overview
The **Ashesi Lost and Found** system is a web-based platform designed to help members of the Ashesi University community efficiently report and recover lost items. The platform allows users to report lost and found items, browse reported items, and claim ownership with ease. The system is managed by the Ashesi Student Council Welfare Committee, ensuring a streamlined process for all users.

## Features
- **User Authentication**: Secure login and registration.
- **Lost Item Reporting**: Users can report lost items with details like description, location, and images.
- **Found Item Reporting**: Users can report found items, helping rightful owners reclaim them.
- **Search and Filter**: Users can search for items by name, category, or location.
- **Admin Dashboard**: Welfare committee members manage and update records.
- **User Dashboard**: Personalized view of reported items and statuses.

## Installation
### Prerequisites
Ensure you have the following installed:
- A local server environment (e.g., **XAMPP**, **MAMP**, or **WAMP**).
- **PHP 7+**
- **MySQL Database**
- **Composer** (For dependency management)

### Steps to Run the App
1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/ashesilostandfound.git
   cd ashesilostandfound
   ```
2. Move the project folder to your server's root directory (e.g., `htdocs` for XAMPP).
3. Import the database:
   - Open **phpMyAdmin**.
   - Create a new database (e.g., `lost_found_db`).
   - Import the `database.sql` file provided.
4. Configure the database connection in `settings/core.php`:
   ```php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'lost_found_db');
   ```
5. Start your local server and visit:
   ```sh
   http://localhost/ashesilostandfound/view/home_about.php
   ```

## Folder Structure
```
ashesilostandfound/
 ├── css/                # Stylesheets
 ├── images/             # Image assets
 ├── js/                 # JavaScript files
 ├── settings/           # Configuration files
 │   ├── core.php        # Database connection
 ├── view/               # Frontend pages
 │   ├── home_about.php  # Homepage
 │   ├── user_dash.php   # User dashboard
 │   ├── item_lost.php   # Lost items page
 │   ├── item_found.php  # Found items page
 │   ├── profile.php     # User profile
 ├── login/              # Authentication system
 │   ├── signup_view.php # Registration page
 │   ├── login_view.php  # Login page
 ├── actions/            # Backend logic (handling form submissions and database operations)
 ├── database.sql        # Database schema
 ├── index.php           # Entry point
```

## User Roles & Permissions
- **Standard Users**: Can report lost/found items, search the database, and claim items.
- **Admin Users**: Manage all lost and found reports, update statuses, and oversee the system.

## API Endpoints
### Fetch Lost Items
- **Endpoint:** `/actions/get_lost_items.php`
- **Method:** `GET`
- **Response:** JSON list of lost items

### Fetch Found Items
- **Endpoint:** `/actions/get_found_items.php`
- **Method:** `GET`
- **Response:** JSON list of found items

### Report Lost Item
- **Endpoint:** `/actions/report_lost_item.php`
- **Method:** `POST`
- **Payload:** `{item_name, location, description, category, image}`
- **Response:** Success/Failure message

### Report Found Item
- **Endpoint:** `/actions/report_found_item.php`
- **Method:** `POST`
- **Payload:** `{item_name, location, description, category, image}`
- **Response:** Success/Failure message


## Testing Credentials
- **Home Page:** [Lost & Found System](http://localhost/ashesilostandfound/view/home_about.php)
- **Standard User:** `user@gmail.com` (Password: `54321`)
- **Admin User:** `admin@gmail.com` (Password: `12345`)

## Contribution
Contributions are welcome! Feel free to fork the repository, create a new branch, and submit a pull request.

## License
This project is licensed under the MIT License.

## Contact
For any queries, reach out via email at `your.email@example.com`.

---
Developed by **Team 15 - 2024 Web Technologies Class**
