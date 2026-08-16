<?php
/**
 * mail-handler.php — robust endpoint for all website lead capture & forms.
 */

require_once __DIR__ . '/panel/db.php';

const TO_ADDRESS   = 'hello@saniamaqsood.com';
const FROM_ADDRESS = 'no-reply@saniamaqsood.com';

function cleanVal($v, $max = 2000) {
    $v = is_string($v) ? $v : '';
    $v = str_replace(["\r", "\n", "%0a", "%0d"], ' ', strip_tags($v));
    return trim(mb_substr($v, 0, $max));
}

function sendResponse($ok = true, $msg = 'Success') {
    if (stripos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false || !empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        header('Content-Type: application/json');
        echo json_encode(['ok' => $ok, 'message' => $msg]);
        exit;
    } else {
        header('Location: /index.php?submitted=1');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Method not allowed');
}

// 1. Honeypot check
if (!empty($_POST['hp_field'])) {
    sendResponse(true, 'Submitted');
}

// 2. Extract Data
$rawType = cleanVal($_POST['form_type'] ?? ($_POST['list'] ?? ($_POST['type'] ?? 'contact')), 50);
$name = cleanVal($_POST['name'] ?? ($_POST['student_name'] ?? ($_POST['client_name'] ?? 'Visitor')), 120);
$email = cleanVal($_POST['email'] ?? ($_POST['student_email'] ?? ($_POST['client_email'] ?? '')), 254);
$phone = cleanVal($_POST['phone'] ?? ($_POST['student_phone'] ?? ($_POST['client_phone'] ?? ($_POST['whatsapp'] ?? ''))), 50);
$ip = preg_replace('/[^0-9a-f:.]/i', '', $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');

$item = cleanVal($_POST['service'] ?? ($_POST['course'] ?? ($_POST['subject'] ?? ($_POST['item'] ?? ''))), 200);
$budget = cleanVal($_POST['budget'] ?? ($_POST['amount'] ?? ''), 100);
$message = cleanVal($_POST['details'] ?? ($_POST['message'] ?? ($_POST['goal'] ?? '')), 2000);

// Determine lead type category
$leadType = 'contact';
if (in_array($rawType, ['services-inquiry', 'services', 'service', 'agency'], true)) {
    $leadType = 'service';
    if (empty($item)) $item = 'General Client Service';
} elseif (in_array($rawType, ['booking', 'consulting', 'session', '1on1'], true)) {
    $leadType = 'consulting';
    if (empty($item)) $item = '1:1 Strategy Session Booking';
} elseif (in_array($rawType, ['course', 'course-inquiry', 'batch', 'enroll'], true)) {
    $leadType = 'course';
    if (empty($item)) $item = 'Live Batch Enrollment';
} elseif (in_array($rawType, ['sunday-note', 'newsletter'], true)) {
    $leadType = 'newsletter';
}

// Collect all form fields for structured metadata display
$meta = [];
foreach ($_POST as $k => $v) {
    if (in_array($k, ['hp_field'], true)) continue;
    if (is_array($v)) $v = implode(', ', $v);
    $meta[$k] = cleanVal($v);
}

// File Upload Handling (Payment screenshots, receipts, briefs)
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (!empty($_FILES['screenshot']['name']) && $_FILES['screenshot']['error'] === UPLOAD_ERR_OK) {
    $origName = basename($_FILES['screenshot']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf'];
    if (in_array($ext, $allowed, true)) {
        $safeName = 'payment_' . time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $ext;
        $targetPath = $uploadDir . '/' . $safeName;
        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $targetPath)) {
            $meta['screenshot_url'] = '/uploads/' . $safeName;
            $meta['screenshot_name'] = $origName;
        }
    }
}

// Fallback: If sent via Base64 data URL
if (empty($meta['screenshot_url']) && !empty($_POST['screenshot_data'])) {
    $rawBase = $_POST['screenshot_data'];
    if (preg_match('/^data:(image\/[a-zA-Z0-9\+\.-]+|application\/pdf);base64,/', $rawBase, $match)) {
        $baseData = substr($rawBase, strpos($rawBase, ',') + 1);
        $decoded = base64_decode($baseData);
        if ($decoded !== false) {
            $mime = $match[1];
            $ext = ($mime === 'application/pdf') ? 'pdf' : (strpos($mime, 'png') !== false ? 'png' : 'jpg');
            $safeName = 'payment_' . time() . '_' . substr(md5(uniqid()), 0, 8) . '.' . $ext;
            $targetPath = $uploadDir . '/' . $safeName;
            if (file_put_contents($targetPath, $decoded)) {
                $meta['screenshot_url'] = '/uploads/' . $safeName;
                $meta['screenshot_name'] = cleanVal($_POST['screenshot_name'] ?? ('payment.' . $ext));
            }
        }
    }
}

if (empty($meta['screenshot_name']) && !empty($_POST['screenshot_name'])) {
    $meta['screenshot_name'] = cleanVal($_POST['screenshot_name']);
}

$metaJson = json_encode($meta, JSON_UNESCAPED_UNICODE);

// 3. Save into Database
try {
    if ($leadType === 'newsletter') {
        if (!empty($email)) {
            recordSubscriber($email, $name, 'sunday-note');
        }
    } else {
        if (empty($email) && !empty($phone)) {
            $email = $phone . '@whatsapp.lead';
        } elseif (empty($email)) {
            $email = 'visitor@mentorsania.com';
        }
        recordLead($leadType, $name, $email, $phone, $item, $budget, $message, $ip, $metaJson);
    }
} catch (Exception $e) {
    error_log("DB Lead Save Error: " . $e->getMessage());
}

// 4. Send Email Notification (best effort, do not crash if mail server not configured locally)
$lines = [];
foreach ($_POST as $k => $v) {
    if (in_array($k, ['hp_field', 'form_type', 'list'], true)) continue;
    if (is_array($v)) $v = implode(', ', $v);
    $lines[] = ucfirst(str_replace('_', ' ', cleanVal($k, 50))) . ': ' . cleanVal($v);
}
$lines[] = 'IP: ' . $ip;
$lines[] = 'Date: ' . date('r');

$subject = sprintf('[%s] %s - %s', strtoupper($leadType), $name, $item ?: 'New Lead');
$headers = implode("\r\n", [
    'From: Sania Maqsood Website <' . FROM_ADDRESS . '>',
    'Reply-To: ' . (filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : FROM_ADDRESS),
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion(),
]);

@mail(TO_ADDRESS, $subject, implode("\n", $lines), $headers);

sendResponse(true, 'Lead recorded successfully');
