# Project Code Guide

This is the folder structure to show during a viva or live demonstration.

```text
employee-payroll/
├── index.php                 Main PHP application: login, CRUD, dashboards, leaves and payslips
├── assets/
│   └── style.css             Frontend styling (CSS)
├── config/
│   └── database.php          MySQL database connection (PHP + MySQL)
├── includes/
│   ├── bootstrap.php         Sessions, role checks, helpers and database utilities
│   └── layout.php            Shared Bootstrap navigation, header and footer
├── sql/
│   ├── employee_payroll_db.sql  Complete MySQL export: DDL, constraints and final data
│   ├── mockaroo_employees.sql   Mockaroo-generated employee inserts
│   └── queries.sql              Six report queries using JOIN, GROUP BY and aggregates
├── documentation/
│   ├── final_erd.png         Final ER diagram
│   └── DBMS_Project_Handbook.pdf
└── README.md                 Setup, demo accounts and feature summary
```

## Technology mapping

| Technology | Files to demonstrate | What they show |
|---|---|---|
| HTML / Bootstrap | `index.php`, `includes/layout.php` | Forms, login page, tables, dashboard layout, responsive UI |
| CSS | `assets/style.css` | Custom colours, metrics, login design and responsive styling |
| PHP backend | `index.php`, `includes/bootstrap.php` | Login, sessions, validation, CRUD operations, leave workflow and payroll generation |
| MySQL / MariaDB | `config/database.php`, `sql/employee_payroll_db.sql` | Database connection, seven tables, DDL, PK/FK/UK/CHECK constraints and sample data |
| SQL reports | `sql/queries.sql` | JOIN, GROUP BY, COUNT, SUM, ROUND and attendance/payroll reports |
| Mockaroo | `sql/mockaroo_employees.sql` | Generated employee data imported into the final database |

## Recommended live demonstration order

1. Open `documentation/final_erd.png` and explain the seven tables.
2. Open phpMyAdmin and show `employee_payroll_db`, its tables, keys and row counts.
3. In VS Code show `sql/employee_payroll_db.sql`, then `sql/queries.sql`.
4. Show `config/database.php` to explain the PHP-to-MySQL connection.
5. Run the app at `http://localhost/employee-payroll/`.
6. Log in as Admin: manage employees, record attendance, approve a leave request and show reports.
7. Log in as Employee: apply/cancel a leave request, view attendance and view payslip.

## Important viva explanation

PHP renders the frontend and runs the backend in the same application. `index.php` is the main controller: it receives requests, validates sessions and roles, calls MySQL through prepared statements, then displays Bootstrap pages. Shared logic is kept in `includes/`, CSS is isolated in `assets/`, and all database artifacts are isolated in `sql/`.
