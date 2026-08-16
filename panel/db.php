<?php
/**
 * db.php — Embedded SQLite Database initialization & connection for Mentor Sania Panel.
 * Zero-config, auto-creates database & tables on first run.
 */

$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$dbPath = $dataDir . '/mentorsania.db';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Create tables if they do not exist
$db->exec("
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    full_name TEXT NOT NULL,
    role TEXT DEFAULT 'admin',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS leads (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type TEXT NOT NULL, /* 'course', 'service', 'consulting', 'contact' */
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    subject_or_item TEXT, /* Course name, Service required, Session type */
    budget TEXT,
    message TEXT,
    status TEXT DEFAULT 'new', /* 'new', 'contacted', 'enrolled', 'in_progress', 'completed', 'lost' */
    assigned_to TEXT DEFAULT 'Sania Maqsood',
    notes TEXT,
    ip_address TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS invoices (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    invoice_number TEXT UNIQUE NOT NULL,
    type TEXT DEFAULT 'course', /* 'course', 'service', 'consulting' */
    client_name TEXT NOT NULL,
    client_email TEXT,
    client_phone TEXT,
    title TEXT NOT NULL,
    items_json TEXT NOT NULL,
    currency TEXT DEFAULT 'PKR', /* 'PKR', 'USD' */
    total_amount REAL NOT NULL,
    paid_amount REAL DEFAULT 0,
    status TEXT DEFAULT 'unpaid', /* 'unpaid', 'paid', 'partially_paid', 'cancelled' */
    payment_method TEXT, /* 'Bank Transfer', 'JazzCash', 'EasyPaisa', 'Stripe', 'Cash' */
    notes TEXT,
    issue_date DATE NOT NULL,
    due_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS subscribers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE NOT NULL,
    source TEXT DEFAULT 'sunday-note',
    status TEXT DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS broadcasts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    subject TEXT NOT NULL,
    body TEXT NOT NULL,
    recipient_count INTEGER DEFAULT 0,
    sent_by TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
");

// Ensure meta_json column exists
try {
    $db->exec("ALTER TABLE leads ADD COLUMN meta_json TEXT");
} catch (Exception $e) {}

// Create default admin user if not exists
$check = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
if ($check == 0) {
    $defaultPass = password_hash('sania2026!', PASSWORD_BCRYPT);
    $ins = $db->prepare("INSERT INTO users (username, email, password_hash, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $ins->execute(['admin', 'hello@saniamaqsood.com', $defaultPass, 'Sania Maqsood', 'admin']);
    
    // Also create instructor accounts for Saqib & Aqib
    $ins->execute(['saqib', 'saqib@saniamaqsood.com', password_hash('saqib2026!', PASSWORD_BCRYPT), 'M. Saqib', 'instructor']);
    $ins->execute(['aqib', 'aqib@saniamaqsood.com', password_hash('aqib2026!', PASSWORD_BCRYPT), 'Aqib', 'instructor']);
}

// Helper to insert a lead
function recordLead($type, $name, $email, $phone = '', $item = '', $budget = '', $message = '', $ip = '', $metaJson = '') {
    global $db;
    try {
        $stmt = $db->prepare("
            INSERT INTO leads (type, name, email, phone, subject_or_item, budget, message, ip_address, meta_json) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$type, $name, $email, $phone, $item, $budget, $message, $ip, $metaJson]);
    } catch (Exception $e) {
        error_log("Failed to record lead: " . $e->getMessage());
        return false;
    }
}

// Helper to add a subscriber
function recordSubscriber($email, $name = '', $source = 'sunday-note') {
    global $db;
    try {
        $stmt = $db->prepare("
            INSERT INTO subscribers (name, email, source) 
            VALUES (?, ?, ?)
            ON CONFLICT(email) DO UPDATE SET name=excluded.name, status='active'
        ");
        return $stmt->execute([$name, $email, $source]);
    } catch (Exception $e) {
        error_log("Failed to record subscriber: " . $e->getMessage());
        return false;
    }
}
