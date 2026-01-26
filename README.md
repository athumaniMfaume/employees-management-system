check live https://employees-management-system-2.onrender.com/

Employees Management System Documentation

1. Project Title

Employees Management System

2. Introduction

2.1 Overview

The Employees Management System is a web-based application built using Laravel. It helps organizations efficiently manage employees, track leave requests, monitor payroll, and organize departmental structures. This system simplifies HR processes and ensures seamless management of employee data.

2.2 Objectives

Automate employee record management.

Provide an easy-to-use interface for HR and employees.

Track employee leave and complaints requests

Improve overall efficiency and transparency in HR operations.

3. System Features

3.1 Functional Requirements

✅ Employee registration and management
✅ Department and job position assignment
✅ Leave request and approval system
✅ Employee performance tracking
✅ Role-based access control (Admin, Employee)
✅ Reporting and analytics dashboard
✅ Data backup and recovery
✅ Email notifications: When an admin registers a new employee, an email notification is automatically sent to the employee with their login credentials (email and password) to access the system.

3.2 Non-Functional Requirements

✅ Security (User authentication & data protection)
✅ Scalability (Supports company growth)
✅ Performance (Optimized database queries & caching)
✅ Usability (User-friendly UI for HR and employees)
✅ Reliability (Ensures data integrity & uptime)

4. System Architecture

4.1 Technology Stack

Frontend: Blade Templates, HTML, CSS, JavaScript (Bootstrap)

Backend: Laravel (PHP Framework)

Database: MySQL

Version Control: GitHub

Deployment: DigitalOcean / AWS / Local Server

4.2 System Design

User Authentication: Laravel authentication system 

Database Relationships: Employees, Departments, Leave Requests, Users


5. Database Schema

Table Name  	Description
employees	    Stores employee details
departments	    Stores department information
leaves       	Manages leave applications
complains       Managesleave complain applications
users	        Stores admin  login credentials and roles

Admin:

Add, edit, delete employees
Manage departments and positions
Approve/reject leave requests


Employee:

View personal details
Apply for leave
Submit complaints
Update profile

6. User Roles and Permissions

Admin

Full access to manage system settings, users, and data

Admin

Manage employees, leave and complaints

Employee

Apply for leave and com

7. Installation Guide

7.1 Prerequisites

PHP 8.x

Composer

MySQL Database

Laravel 11.x

Web server (Apache/Nginx)

7.2 Steps to Install

# Clone the repository
git clone https://github.com/athumaniMfaume/employees-management-system.git
cd employees-management

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Start the application
php artisan serve

🔐 Default Login Credentials
Role	Email	Password
Admin	admin@gmail.com	password 123

8. Usage Guide

Admin Dashboard → Manage employees, departments, complain and leave  
                  requests.


Employee Dashboard → View profile, apply for leave and complaints

9. Backup and Recovery Plan

Daily database backups using Laravel Scheduler

Backups stored in cloud storage (AWS S3, Google Drive, etc.)

Backup restoration through admin panel

10. Conclusion

The Employees Management System streamlines HR operations by providing an efficient, secure, and user-friendly solution for managing employees, payroll, and leave requests. It ensures transparency, reduces paperwork, and enhances organizational efficiency.









