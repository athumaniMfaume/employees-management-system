# employees-management-system

🏢 Employee Management System
📌 Description

The Employee Management System is a web application built with Laravel that helps organizations manage employees, track attendance, process payroll, and handle leave requests.
🚀 Features

✅ Employee Registration & Management
✅ Role-Based Access Control (Admin, HR, Employee)
✅ Attendance & Leave Tracking
✅ Payroll Management & Payslip Generation
✅ Performance Evaluation & Reporting
✅ Secure Authentication (Laravel Breeze/Sanctum)
✅ Email & Notification System
🛠️ Installation Guide
1️⃣ Clone the Repository

git clone https://github.com/athumaniMfaume/employees-management-system.git
cd your-repository

2️⃣ Install Dependencies

composer install
npm install && npm run dev

3️⃣ Setup Environment Variables

cp .env.example .env
php artisan key:generate

4️⃣ Configure Database

Edit the .env file and update database credentials. Then, run:

php artisan migrate --seed

5️⃣ Start the Application

php artisan serve

Visit http://127.0.0.1:8000 in your browser.

🔐 Default Login Credentials
Role	Email	Password
Admin	admin@gmail.com	password 123






