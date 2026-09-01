<?php
declare(strict_types=1);

session_start();

// `database.php` is intentionally local-only. The tracked example enables a
// fresh clone to work with the default XAMPP database settings immediately.
$databaseConfig = __DIR__ . '/../config/database.php';
if (!file_exists($databaseConfig)) {
    $databaseConfig = __DIR__ . '/../config/database.example.php';
}
require_once $databaseConfig;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function money($value): string { return '₹' . number_format((float)$value, 2); }
function flash(string $message, string $type = 'success'): void { $_SESSION['flash'] = ['message' => $message, 'type' => $type]; }
function show_flash(): void { if (!empty($_SESSION['flash'])) { $f = $_SESSION['flash']; unset($_SESSION['flash']); echo '<div class="alert alert-' . e($f['type']) . ' alert-dismissible fade show" role="alert">' . e($f['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'; } }
function logged_in(): bool { return isset($_SESSION['user']); }
function user(): array { return $_SESSION['user'] ?? []; }
function is_admin(): bool { return (user()['role'] ?? '') === 'ADMIN'; }
function require_login(): void { if (!logged_in()) { header('Location: index.php'); exit; } }
function require_admin(): void { require_login(); if (!is_admin()) { flash('Admin access is required.', 'danger'); header('Location: index.php?page=employee_dashboard'); exit; } }
function selected(string $value, ?string $current): string { return $value === $current ? 'selected' : ''; }
function badge(string $status): string { $map=['ACTIVE'=>'success','INACTIVE'=>'secondary','ON_LEAVE'=>'warning','RESIGNED'=>'dark','PENDING'=>'warning','APPROVED'=>'success','REJECTED'=>'danger','CANCELLED'=>'secondary','PRESENT'=>'success','ABSENT'=>'danger','HALF_DAY'=>'warning','LEAVE'=>'info']; return '<span class="badge text-bg-' . ($map[$status] ?? 'secondary') . '">' . e(str_replace('_', ' ', $status)) . '</span>'; }
function scalar(mysqli $conn, string $sql): mixed { $r=$conn->query($sql); return $r->fetch_row()[0] ?? 0; }
function get_options(mysqli $conn, string $table, string $id, string $label): array { return $conn->query("SELECT $id, $label FROM $table ORDER BY $label")->fetch_all(MYSQLI_ASSOC); }
?>
