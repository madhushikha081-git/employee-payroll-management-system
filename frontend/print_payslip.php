<?php
require_once __DIR__ . '/../backend/includes/bootstrap.php';

if (!logged_in()) {
    header('Location: ../index.php');
    exit;
}

$payslipId = (int) ($_GET['id'] ?? 0);

if ($payslipId <= 0) {
    exit('Invalid payslip.');
}

$stmt = $conn->prepare("
    SELECT
        p.*,
        e.employee_code,
        e.first_name,
        e.last_name,
        e.email,
        d.department_name,
        ds.designation_name,
        ss.basic_salary,
        ss.hra,
        ss.travel_allowance,
        ss.other_allowance,
        ss.pf_deduction,
        ss.tax_deduction
    FROM payslip p
    JOIN employee e ON e.employee_id = p.employee_id
    JOIN department d ON d.department_id = e.department_id
    JOIN designation ds ON ds.designation_id = e.designation_id
    JOIN salary_structure ss ON ss.salary_id = p.salary_id
    WHERE p.payslip_id = ?
");

$stmt->bind_param('i', $payslipId);
$stmt->execute();
$payslip = $stmt->get_result()->fetch_assoc();

if (!$payslip) {
    exit('Payslip not found.');
}

if (!is_admin() && (int) user()['employee_id'] !== (int) $payslip['employee_id']) {
    exit('You are not allowed to view this payslip.');
}

function amount($value) {
    return '₹' . number_format((float) $value, 2);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Payslip - <?=htmlspecialchars($payslip['employee_code'])?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f7fb; padding: 35px; }
        .payslip { max-width: 850px; margin: auto; background: white; padding: 40px; border: 1px solid #dce3ed; }
        .company { color: #1466ad; font-weight: 700; }
        .net { color: #198754; font-size: 1.3rem; font-weight: 700; }

        @media print {
            body { background: white; padding: 0; }
            .payslip { border: 0; max-width: none; }
            .no-print { display: none !important; }
        }
    </style>
</head>

<body>
    <div class="payslip">
        <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
            <div>
                <h2 class="company mb-1">EPMS</h2>
                <p class="mb-0 text-secondary">Employee Payroll Management System</p>
            </div>

            <div class="text-end">
                <h4 class="mb-1">PAYSLIP</h4>
                <div><?=date('F Y', strtotime($payslip['pay_month']))?></div>
                <small class="text-secondary">Generated: <?=date('d M Y', strtotime($payslip['generated_on']))?></small>
            </div>
        </div>

        <h5 class="mb-3">Employee Details</h5>

        <div class="row mb-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Name:</strong> <?=htmlspecialchars($payslip['first_name'] . ' ' . $payslip['last_name'])?></p>
                <p class="mb-1"><strong>Employee Code:</strong> <?=htmlspecialchars($payslip['employee_code'])?></p>
                <p class="mb-1"><strong>Email:</strong> <?=htmlspecialchars($payslip['email'])?></p>
            </div>

            <div class="col-md-6">
                <p class="mb-1"><strong>Department:</strong> <?=htmlspecialchars($payslip['department_name'])?></p>
                <p class="mb-1"><strong>Designation:</strong> <?=htmlspecialchars($payslip['designation_name'])?></p>
                <p class="mb-1"><strong>Working / Paid Days:</strong> <?=$payslip['working_days']?> / <?=$payslip['paid_days']?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Earnings</h5>

                <table class="table">
                    <tr><td>Basic Salary</td><td class="text-end"><?=amount($payslip['basic_salary'])?></td></tr>
                    <tr><td>HRA</td><td class="text-end"><?=amount($payslip['hra'])?></td></tr>
                    <tr><td>Travel Allowance</td><td class="text-end"><?=amount($payslip['travel_allowance'])?></td></tr>
                    <tr><td>Other Allowance</td><td class="text-end"><?=amount($payslip['other_allowance'])?></td></tr>
                    <tr class="fw-bold"><td>Gross Salary</td><td class="text-end"><?=amount($payslip['gross_salary'])?></td></tr>
                </table>
            </div>

            <div class="col-md-6">
                <h5>Deductions</h5>

                <table class="table">
                    <tr><td>PF</td><td class="text-end"><?=amount($payslip['pf_deduction'])?></td></tr>
                    <tr><td>Tax</td><td class="text-end"><?=amount($payslip['tax_deduction'])?></td></tr>
                    <tr class="fw-bold"><td>Total Deductions</td><td class="text-end"><?=amount($payslip['total_deduction'])?></td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr class="net"><td>Net Salary</td><td class="text-end"><?=amount($payslip['net_salary'])?></td></tr>
                </table>
            </div>
        </div>

        <div class="text-center mt-4 no-print">
            <button class="btn btn-primary" onclick="window.print()">Print / Save as PDF</button>
            <button class="btn btn-outline-secondary ms-2" onclick="window.close()">Close</button>
        </div>
    </div>
</body>
</html>