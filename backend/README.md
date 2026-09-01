# Backend - PHP Business Logic

## `includes/bootstrap.php`

- Starts the PHP session.
- Loads the database connection.
- Provides login, access-control, flash-message, sanitization and formatting helpers.

## `includes/layout.php`

- Reusable navigation bar, page layout and footer.
- Shows role-appropriate navigation for Admin and Employee users.

## `config/database.php`

- MySQL/MariaDB connection settings for `employee_payroll_db`.

## Backend functions demonstrated live

- Login with password verification and roles.
- Employee create and update.
- Attendance insert/update.
- Leave submit, cancel, approve and reject.
- Salary structure insertion.
- Attendance-based payslip generation.
- Aggregate report queries.
