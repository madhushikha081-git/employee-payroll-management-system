# Live Demonstration Guide

## 1. Database and ERD

Open `documentation/final_erd.png`, then phpMyAdmin → `employee_payroll_db`.
Show the seven related tables and their primary/foreign keys.

## 2. Login and Roles

- Admin: `ananya.sharma@company.com` / `password`
- Employee: `rahul.verma@company.com` / `password`

Show that Admin reaches the management dashboard and Employee reaches a personal dashboard.

## 3. CRUD Demonstration

- Create: Admin → Employees → add an employee.
- Read: the Employees table lists every employee with department and designation.
- Update: click Edit for any employee and save a change.
- Additional CRUD: add a department/designation under Master Data.

## 4. Core Project Features

- Attendance: Admin → Attendance → record/update a daily status.
- Leave workflow: Employee → Leaves → submit request; Admin → Leaves → approve/reject it.
- Payslip: Admin → Payslips → generate based on attendance and salary structure.
- Reports: Admin → Reports → department counts, payroll totals and attendance summary.

## 5. Code Folder Explanation

- `frontend/`: UI pages and CSS.
- `backend/`: PHP connection, sessions, access control and common page code.
- `sql/`: DDL, generated employee data, DML and required report queries.
- `documentation/`: handbook, final ERD and this guide.
