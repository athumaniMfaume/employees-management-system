Employee Management System Documentation

Table of Contents

Introduction
Features
Installation and Setup
System Requirements
Configuration
Database Migration
Usage
User Roles
Admin Features
Employee Features
Leave Application and Complaints
API Endpoints (Optional)
Conclusion

1. Introduction
The Employee Management System is a Laravel-based application designed to streamline employee management for organizations. The system allows employers to manage employee information, approve leave applications, and handle complaints. The system is designed with an admin role to manage user permissions, approve requests, and maintain overall control of the system.

2. Features
Employee Registration: Admin can add new employees to the system.
Leave Management: Employees can apply for leave, and admin can approve/reject requests.
Complaint Management: Employees can submit complaints, and the admin can manage those complaints.
Role Management: Different user roles (Admin, Employer) for varying levels of access.
Dashboard: Admin dashboard for monitoring activities and user requests.
Data Security: Secure authentication and authorization using Laravel’s built-in mechanisms.

3. Installation and Setup
Step 1: Clone the Repository
Clone the repository using Git:
git clone https://github.com/your-repository/employee-management-system.git
cd employee-management-system

Step 2: Install Dependencies
Run composer to install the necessary Laravel packages:
composer install

Step 3: Set Up .env File
Copy the .env.example file to .env and configure the database settings:

cp .env.example .env
Then, set up your database credentials in the .env file.

Step 4: Generate Application Key
Run the following command to generate the app key:

php artisan key:generate
Step 5: Run Migrations
Migrate the database to create all the necessary tables:
php artisan migrate

4. System Requirements
PHP >= 7.4
Composer
MySQL or PostgreSQL (for database)
Laravel 8 or higher

5. Configuration
Once the application is installed, configure the settings such as mail configurations, database settings, etc., in the .env file.

6. Database Migration
Run the following command to migrate the database schema:
php artisan migrate
This will create the required tables such as:

users (store admin details)
leave_requests (stores leave requests)
complaints (stores complaints)
employees (stores employee details)
departments (stores department details)

7. Usage

1. Register New Employees:
Navigate to the "Employees" section in the admin panel.
Fill in the employee’s details like name, role, department, and contact info.
Click "Save" to add the employee to the system.

2. Leave Application:
Employees can apply for leave via the "Leave Requests" section.
After submission, the admin will review and approve or reject the leave request.

3. Complaints:
Employees can submit complaints, which will be stored in the complaints section.
Admins can review and take necessary action on complaints.

8. User Roles
Admin:
Full access to the system, including employee management, leave request approvals, and complaints management.
Employer:
Can apply for leave, submit complaints, and view personal information.

9. Admin Features
Employee Management:
Add, edit, or delete employee records.
Leave Requests:
View, approve, or reject leave requests submitted by employees.
Complaints Management:
View and manage complaints submitted by employees.
Role Management:
Assign and manage roles for employees.

10. Employee Features
Profile Management:
Employees can view and update their profile information.
Leave Application:
Submit leave requests and track leave status.
Complaint Submission:
Submit complaints and track their status.

11. Leave Application and Complaints
Leave Application Process:
Employee fills in the leave application form.
Admin reviews and either approves or rejects the request.
The employee is notified about the status of the leave.
Complaint Process:
Employee fills in the complaint form.
Admin reviews the complaint and decides the action to take.
Employee is notified of the decision.


🔐 Default Login Credentials
Role	Email	Password
Admin	admin@gmail.com	password 123






