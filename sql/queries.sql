-- 1. Employee details with department and designation
SELECT
    e.employee_code,
    CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
    d.department_name,
    des.designation_name,
    e.email,
    e.employment_status
FROM employee e
JOIN department d
    ON e.department_id = d.department_id
JOIN designation des
    ON e.designation_id = des.designation_id
ORDER BY d.department_name, employee_name;




--2. Department-wise employee count
SELECT
    d.department_name,
    COUNT(e.employee_id) AS total_employees
FROM department d
LEFT JOIN employee e
    ON e.department_id = d.department_id
GROUP BY d.department_id, d.department_name
ORDER BY total_employees DESC;



-- 3. August attendance summary per employee
SELECT
    e.employee_code,
    CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
    COUNT(a.attendance_date) AS working_days,
    SUM(a.attendance_status = 'PRESENT') AS present_days,
    SUM(a.attendance_status = 'HALF_DAY') AS half_days,
    SUM(a.attendance_status = 'ABSENT') AS absent_days
FROM employee e
JOIN attendance a
    ON a.employee_id = e.employee_id
WHERE a.attendance_date BETWEEN '2026-08-01' AND '2026-08-31'
GROUP BY e.employee_id, e.employee_code, e.first_name, e.last_name
ORDER BY employee_name;



-- 4. Pending leave requests
SELECT
    lr.leave_id,
    CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
    lr.leave_type,
    lr.start_date,
    lr.end_date,
    lr.reason,
    lr.applied_on
FROM leave_request lr
JOIN employee e
    ON lr.employee_id = e.employee_id
WHERE lr.leave_status = 'PENDING'
ORDER BY lr.applied_on DESC;



-- 5. Department-wise monthly payroll total
SELECT
    d.department_name,
    COUNT(p.payslip_id) AS payslips_generated,
    ROUND(SUM(p.gross_salary), 2) AS total_gross_salary,
    ROUND(SUM(p.total_deduction), 2) AS total_deduction,
    ROUND(SUM(p.net_salary), 2) AS total_net_salary
FROM payslip p
JOIN employee e
    ON p.employee_id = e.employee_id
JOIN department d
    ON e.department_id = d.department_id
WHERE p.pay_month = '2026-08-01'
GROUP BY d.department_id, d.department_name
ORDER BY total_net_salary DESC;



-- 6. Individual payslip report
SELECT
    p.payslip_id,
    p.pay_month,
    e.employee_code,
    CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
    d.department_name,
    des.designation_name,
    p.working_days,
    p.paid_days,
    p.gross_salary,
    p.total_deduction,
    p.net_salary,
    p.generated_on
FROM payslip p
JOIN employee e
    ON p.employee_id = e.employee_id
JOIN department d
    ON e.department_id = d.department_id
JOIN designation des
    ON e.designation_id = des.designation_id
ORDER BY p.pay_month DESC, employee_name;

