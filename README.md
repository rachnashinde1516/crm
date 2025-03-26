# CRM System
 
## Introduction
This is a CRM (Customer Relationship Management) system designed for managing leads, customers, and communications. It helps businesses track interactions with customers and manage sales leads.
 
## Features
- User authentication (Admin and User roles)
- Manage Leads: Add, Edit, Delete, List
- Manage Customers: Add, Edit, Delete, List
- Log Communications with Customers (Calls, Emails, Meetings)
- User-friendly interface with Bootstrap
 
## Installation
 
### Prerequisites
- PHP >= 7.4
- MySQL or MariaDB
- Apache or Nginx (with URL rewriting enabled)
 
### Steps
1. Clone the repository or download the source files.
2. Import the `crm_database.sql` file into your MySQL database.
3. Set up a `.env` file (or modify database connection in the config) with your database credentials.
4. Run `composer install` to install dependencies (if you use Composer).
5. Navigate to the project folder and open `index.php` in your browser.
 
### Configuration
Edit the database configuration in `config/database.php` (or use the `.env` file to set up your credentials).
 
## Contributing
Feel free to fork this project and submit pull requests. Contributions are welcome!
 
## License
This project is open-source and available under the MIT License.
