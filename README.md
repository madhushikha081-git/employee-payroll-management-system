# Employee Payroll Management System

A PHP, MySQL/MariaDB and Bootstrap implementation of the **Employee Payroll
Management System** DBMS project. It uses the finalized seven-table 3NF schema:
Employee, Department, Designation, Attendance, Salary Structure, Payslip and
Leave Request.

## Run locally

1. Clone/download this repository inside XAMPP's `htdocs` folder.
2. Start **Apache Web Server** and **MySQL Database** in XAMPP Manager.
3. In phpMyAdmin, import `sql/employee_payroll_db.sql`.
4. Copy `backend/config/database.example.php` to
   `backend/config/database.php`.
5. Open `http://localhost/employee-payroll/`.

## Demo accounts

- HR/Admin: `ananya.sharma@company.com` / `password`
- Employee: `rahul.verma@company.com` / `password`

## Included modules

- Role-based login and session logout
- Admin dashboard with payroll and leave metrics
- Employee CRUD, department/designation management, salary structures and attendance
- Leave request submission, cancellation, approval and rejection
- Payslip listing and attendance-driven monthly payslip generation
- Employee dashboard, profile, attendance, leave and payslip screens
- Aggregate reports for employee count, department payroll and attendance

The project uses the final seven-table 3NF schema in `employee_payroll_db`.

## Repository structure

- `frontend/` - PHP user-interface pages built with HTML and Bootstrap
- `backend/` - PHP session, role, database and reusable layout logic
- `assets/` - custom CSS
- `sql/` - complete database export, Mockaroo data and SQL report queries
- `documentation/` - final ERD, handbook and live demonstration guide
