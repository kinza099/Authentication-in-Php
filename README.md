# PHP Authentication System

A simple and secure PHP-based authentication system that allows users to register, log in, and access a dashboard. This project is built using core PHP and MySQL, with a responsive frontend design.

---

## Features

- **User Registration**:
  - Users can register with their name, email, username, password, and phone number.
  - Validations for required fields, email format, password matching, and unique email/username.
- **User Login**:
  - Users can log in using their email and password.
  - Validations for required fields and correct credentials.
- **Dashboard**:
  - Authenticated users can access the dashboard, which displays their details.
- **Session Management**:
  - Prevents logged-in users from accessing the login/register pages.
  - Prevents non-logged-in users from accessing the dashboard.
- **Responsive Design**:
  - The frontend is designed to be responsive and works well on all screen sizes.

---

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/kinza099/Authentication-in-Php.git
   cd php-authentication-system
   ```

2. **Set Up the Database**:
   - Import the `database.sql` file into your MySQL database to create the necessary table.
   - Update the database credentials in the `connection.php` file:
     ```php
     $servername = "localhost";
     $username = "your-db-username";
     $password = "your-db-password";
     $dbname = "authentication";
     ```

3. **Run the Application**:
   - Start a local server (e.g., using XAMPP, WAMP, or PHP's built-in server).
   - Open the project in your browser:
     ```
     http://localhost/php-authentication-system
     ```

---

## Usage

1. **Register**:
   - Navigate to the registration page (`register.php`).
   - Fill in the required details and submit the form.
   - If successful, you will be redirected to the login page.

2. **Login**:
   - Navigate to the login page (`login.php`).
   - Enter your email and password.
   - If successful, you will be redirected to the dashboard.

3. **Dashboard**:
   - The dashboard (`dashboard.php`) displays the user's details.
   - Users can log out by clicking the "Logout" button.

---

## Screenshots

### Index Page
![image](https://github.com/user-attachments/assets/eca18e78-3502-4eb1-a4e5-2cc6241f0bff)

### Registration Page
![image](https://github.com/user-attachments/assets/34c6ac10-0cb2-432e-bf46-edd843619def)


### Login Page
![image](https://github.com/user-attachments/assets/2c32132c-4360-44da-a33f-e49dda185206)


### Dashboard
![image](https://github.com/user-attachments/assets/d3909c85-044c-437a-b44c-b57ad7d9069c)

---

## File Structure

```
php-authentication-system/
│
├── index.php            # Main page with login/register buttons
├── register.php         # User registration page
├── login.php            # User login page
├── dashboard.php        # Dashboard for authenticated users
├── logout.php           # Logout functionality
├── config.php           # Database connection and setup

```

---

## Technologies Used

- **Frontend**:
  - HTML, CSS, Bootstrap
- **Backend**:
  - PHP (Core)
- **Database**:
  - MySQL

---

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Contact

For any queries or suggestions, please contact:
- **Email:** kinzapython@gmail.com


