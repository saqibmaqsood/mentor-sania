<?php
/**
 * api.php — AJAX API endpoint for Mentor Sania Management Panel.
 */

require_once __DIR__ . '/auth.php';
requireLogin();

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'view_proof') {
    $id = intval($_GET['id'] ?? 0);
    $name = trim($_GET['name'] ?? '');
    $fileUrl = '';
    if ($id > 0) {
        $stmt = $db->prepare("SELECT meta_json FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        $lead = $stmt->fetch();
        if ($lead && !empty($lead['meta_json'])) {
            $m = json_decode($lead['meta_json'], true) ?: [];
            $fileUrl = $m['screenshot_url'] ?? '';
            if (empty($name)) $name = $m['screenshot_name'] ?? ($m['screenshot'] ?? '');
        }
    }
    if (!empty($fileUrl) && file_exists(__DIR__ . '/..' . $fileUrl)) {
        header('Location: ' . $fileUrl);
        exit;
    }
    // Styled visual preview card
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Payment Proof Reference — Mentor Sania Panel</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
        body { margin:0; padding:40px 20px; font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background:#1E1B17; color:#FAF7F2; display:flex; align-items:center; justify-content:center; min-height:80vh; }
        .card { background:#FAF7F2; color:#1E1B17; border-radius:18px; padding:36px 30px; max-width:480px; width:100%; box-shadow:0 24px 60px rgba(0,0,0,0.5); text-align:center; box-sizing:border-box; border:1px solid #EDE4D3; }
        .icon { width:60px; height:60px; background:#EDE4D3; color:#B5794A; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 18px; font-size:26px; }
        h2 { font-family:Georgia, serif; margin:0 0 10px; font-size:24px; color:#1E1B17; }
        p { color:rgba(30,27,23,0.7); font-size:14.5px; line-height:1.55; margin:0 0 20px; }
        .file-box { background:#EDE4D3; border:1px solid #D9CDB6; padding:14px 18px; border-radius:10px; font-family:ui-monospace, monospace; font-size:14px; font-weight:600; color:#1E1B17; word-break:break-all; margin-bottom:20px; }
        .btn { display:inline-block; background:#B5794A; color:#FAF7F2; padding:12px 28px; border-radius:999px; text-decoration:none; font-weight:600; font-size:14px; border:none; cursor:pointer; }
      </style>
    </head>
    <body>
      <div class="card">
        <div class="icon">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
        </div>
        <h2>Payment Proof Reference</h2>
        <p>This booking was registered with the following payment confirmation reference attached by the client:</p>
        <div class="file-box"><?php echo htmlspecialchars($name ?: 'payment_receipt.jpeg'); ?></div>
        <p style="font-size:13px; color:rgba(30,27,23,0.52); margin-bottom:24px;">Note: You can verify payment via Transaction ID or contact the client directly on WhatsApp/Email.</p>
        <a href="javascript:window.close()" class="btn">Close Tab</a>
      </div>
    </body>
    </html>
    <?php
    exit;
}

header('Content-Type: application/json');

function syncLeadEnrollmentInvoice($leadId, $status, $customAgreed = null, $customPaid = null, $customDueDate = null) {
    global $db;
    if (!in_array($status, ['enrolled', 'completed'])) {
        return;
    }
    
    try {
        $stmt = $db->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$leadId]);
        $lead = $stmt->fetch();
        if (!$lead) return;
        
        $meta = [];
        try { $meta = json_decode($lead['meta_json'] ?? '{}', true) ?: []; } catch (Exception $e) {}

        // Parse currency & default budget
        $budgetStr = $lead['budget'] ?? '';
        $currency = 'PKR';
        $defaultAmount = 0;
        
        if (stripos($budgetStr, '$') !== false || stripos($budgetStr, 'USD') !== false) {
            $currency = 'USD';
            preg_match('/[\d,]+(\.\d+)?/', $budgetStr, $m);
            $defaultAmount = !empty($m[0]) ? floatval(str_replace(',', '', $m[0])) : 200;
        } else {
            $currency = 'PKR';
            preg_match('/[\d,]+(\.\d+)?/', $budgetStr, $m);
            $defaultAmount = !empty($m[0]) ? floatval(str_replace(',', '', $m[0])) : (($lead['type'] === 'course') ? 15000 : 5000);
        }
        if ($defaultAmount <= 0) $defaultAmount = ($currency === 'USD') ? 200 : 10000;

        // Agreed & Paid amounts
        $agreedAmount = ($customAgreed !== null && floatval($customAgreed) > 0) ? floatval($customAgreed) : (isset($meta['agreed_fee']) ? floatval($meta['agreed_fee']) : $defaultAmount);
        $paidAmount = ($customPaid !== null && floatval($customPaid) >= 0) ? floatval($customPaid) : (isset($meta['paid_amount']) ? floatval($meta['paid_amount']) : $agreedAmount);
        $dueDate = !empty($customDueDate) ? $customDueDate : (!empty($meta['due_date']) ? $meta['due_date'] : date('Y-m-d', strtotime('+7 days')));
        
        $invStatus = 'paid';
        if ($paidAmount >= $agreedAmount && $agreedAmount > 0) {
            $invStatus = 'paid';
        } elseif ($paidAmount > 0) {
            $invStatus = 'partially_paid';
        } else {
            $invStatus = 'unpaid';
        }

        // Check if invoice already exists for this lead
        $chk = $db->prepare("SELECT id FROM invoices WHERE (client_email = ? AND client_email != '') OR (client_phone = ? AND client_phone != '' AND title = ?)");
        $chk->execute([$lead['email'] ?? '', $lead['phone'] ?? '', $lead['subject_or_item'] ?? '']);
        $existing = $chk->fetch();
        if ($existing) {
            $upd = $db->prepare("UPDATE invoices SET total_amount = ?, paid_amount = ?, status = ?, due_date = ? WHERE id = ?");
            $upd->execute([$agreedAmount, $paidAmount, $invStatus, $dueDate, $existing['id']]);
            return;
        }
        
        $invNum = 'INV-' . strtoupper(substr(uniqid(), -6));
        $title = $lead['subject_or_item'] ?: ($lead['type'] === 'course' ? 'Live Course Enrollment' : ($lead['type'] === 'consulting' ? '1:1 Session' : 'Service Project'));
        $items = [
            ['name' => $title, 'qty' => 1, 'price' => $agreedAmount, 'desc' => 'Enrollment payment receipt']
        ];
        $itemsJson = json_encode($items);
        
        $issueDate = date('Y-m-d');

        $ins = $db->prepare("
            INSERT INTO invoices (invoice_number, type, client_name, client_email, client_phone, title, items_json, currency, total_amount, paid_amount, status, payment_method, notes, issue_date, due_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Bank Transfer', 'Lead enrollment settlement', ?, ?)
        ");
        $ins->execute([
            $invNum,
            $lead['type'] ?: 'course',
            $lead['name'] ?: 'Enrolled Student',
            $lead['email'] ?: '',
            $lead['phone'] ?: '',
            $title,
            $itemsJson,
            $currency,
            $agreedAmount,
            $paidAmount,
            $invStatus,
            $issueDate,
            $dueDate
        ]);
    } catch (Exception $e) {
        error_log("Enrollment invoice sync error: " . $e->getMessage());
    }
}

try {
    switch ($action) {
        case 'get_lead':
            $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
            $stmt = $db->prepare("SELECT * FROM leads WHERE id = ?");
            $stmt->execute([$id]);
            $lead = $stmt->fetch();
            if ($lead) {
                echo json_encode(['ok' => true, 'lead' => $lead]);
            } else {
                echo json_encode(['ok' => false, 'error' => 'Lead not found']);
            }
            break;

        case 'update_lead':
        case 'save_lead':
            $id = intval($_POST['id'] ?? 0);
            $status = trim($_POST['status'] ?? 'new');
            $notes = trim($_POST['notes'] ?? '');
            $assigned = trim($_POST['assigned_to'] ?? 'Sania Maqsood');
            $agreedFee = isset($_POST['agreed_fee']) ? floatval($_POST['agreed_fee']) : null;
            $paidAmount = isset($_POST['paid_amount']) ? floatval($_POST['paid_amount']) : null;
            $dueDate = !empty($_POST['due_date']) ? trim($_POST['due_date']) : null;

            // Update meta_json with agreed, paid, and due_date
            $curStmt = $db->prepare("SELECT meta_json FROM leads WHERE id = ?");
            $curStmt->execute([$id]);
            $curRow = $curStmt->fetch();
            $meta = [];
            if ($curRow && !empty($curRow['meta_json'])) {
                try { $meta = json_decode($curRow['meta_json'], true) ?: []; } catch (Exception $e) {}
            }
            if ($agreedFee !== null) $meta['agreed_fee'] = $agreedFee;
            if ($paidAmount !== null) $meta['paid_amount'] = $paidAmount;
            if ($dueDate !== null) $meta['due_date'] = $dueDate;
            $metaJson = json_encode($meta);

            $stmt = $db->prepare("UPDATE leads SET status = ?, notes = ?, assigned_to = ?, meta_json = ? WHERE id = ?");
            $stmt->execute([$status, $notes, $assigned, $metaJson, $id]);
            
            if (in_array($status, ['enrolled', 'completed'])) {
                syncLeadEnrollmentInvoice($id, $status, $agreedFee, $paidAmount, $dueDate);
            }
            
            echo json_encode(['ok' => true, 'msg' => 'Lead saved successfully']);
            break;

        case 'bulk_assign':
            $ids = json_decode($_POST['ids'] ?? '[]', true) ?: [];
            $assigned = trim($_POST['assigned_to'] ?? 'Sania Maqsood');
            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $stmt = $db->prepare("UPDATE leads SET assigned_to = ? WHERE id IN ($placeholders)");
                $stmt->execute(array_merge([$assigned], $ids));
                echo json_encode(['ok' => true, 'msg' => count($ids) . ' leads assigned to ' . $assigned]);
            } else {
                echo json_encode(['ok' => false, 'error' => 'No leads selected']);
            }
            break;

        case 'bulk_status':
            $ids = json_decode($_POST['ids'] ?? '[]', true) ?: [];
            $status = trim($_POST['status'] ?? 'new');
            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $stmt = $db->prepare("UPDATE leads SET status = ? WHERE id IN ($placeholders)");
                $stmt->execute(array_merge([$status], $ids));
                
                if (in_array($status, ['enrolled', 'completed'])) {
                    foreach ($ids as $lid) {
                        syncLeadEnrollmentInvoice($lid, $status);
                    }
                }
                
                echo json_encode(['ok' => true, 'msg' => count($ids) . ' leads updated to ' . $status]);
            } else {
                echo json_encode(['ok' => false, 'error' => 'No leads selected']);
            }
            break;

        case 'bulk_delete':
            $ids = json_decode($_POST['ids'] ?? '[]', true) ?: [];
            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $stmt = $db->prepare("DELETE FROM leads WHERE id IN ($placeholders)");
                $stmt->execute($ids);
                echo json_encode(['ok' => true, 'msg' => count($ids) . ' leads deleted']);
            } else {
                echo json_encode(['ok' => false, 'error' => 'No leads selected']);
            }
            break;

        case 'delete_lead':
            $id = intval($_POST['id'] ?? 0);
            $stmt = $db->prepare("DELETE FROM leads WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['ok' => true, 'msg' => 'Lead deleted']);
            break;

        case 'create_invoice':
            $invNum = 'INV-' . strtoupper(substr(uniqid(), -6));
            $clientName = trim($_POST['client_name'] ?? '');
            $clientEmail = trim($_POST['client_email'] ?? '');
            $clientPhone = trim($_POST['client_phone'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $currency = trim($_POST['currency'] ?? 'PKR');
            $totalAmount = floatval($_POST['total_amount'] ?? 0);
            $paidAmount = floatval($_POST['paid_amount'] ?? 0);
            $status = trim($_POST['status'] ?? 'unpaid');
            $paymentMethod = trim($_POST['payment_method'] ?? 'Bank Transfer');
            $notes = trim($_POST['notes'] ?? '');
            $issueDate = trim($_POST['issue_date'] ?? date('Y-m-d'));
            $dueDate = trim($_POST['due_date'] ?? date('Y-m-d', strtotime('+7 days')));
            $type = trim($_POST['type'] ?? 'course');

            $items = [
                ['name' => $title, 'qty' => 1, 'price' => $totalAmount, 'desc' => $notes]
            ];
            $itemsJson = json_encode($items);

            $stmt = $db->prepare("
                INSERT INTO invoices (invoice_number, type, client_name, client_email, client_phone, title, items_json, currency, total_amount, paid_amount, status, payment_method, notes, issue_date, due_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$invNum, $type, $clientName, $clientEmail, $clientPhone, $title, $itemsJson, $currency, $totalAmount, $paidAmount, $status, $paymentMethod, $notes, $issueDate, $dueDate]);

            echo json_encode(['ok' => true, 'msg' => 'Invoice created', 'id' => $db->lastInsertId(), 'number' => $invNum]);
            break;

        case 'update_invoice_status':
            $id = intval($_POST['id'] ?? 0);
            $status = trim($_POST['status'] ?? 'unpaid');
            $paidAmount = floatval($_POST['paid_amount'] ?? 0);

            $stmt = $db->prepare("UPDATE invoices SET status = ?, paid_amount = ? WHERE id = ?");
            $stmt->execute([$status, $paidAmount, $id]);
            echo json_encode(['ok' => true, 'msg' => 'Invoice updated']);
            break;

        case 'record_partial_payment':
            $invoiceId = intval($_POST['invoice_id'] ?? 0);
            $paymentAmount = floatval($_POST['payment_amount'] ?? 0);
            $paymentMethod = trim($_POST['payment_method'] ?? 'Bank Transfer');
            $paymentDate = trim($_POST['payment_date'] ?? date('Y-m-d'));
            $nextDueDate = !empty($_POST['next_due_date']) ? trim($_POST['next_due_date']) : null;
            $remarks = trim($_POST['remarks'] ?? '');

            if ($invoiceId <= 0 || $paymentAmount <= 0) {
                echo json_encode(['ok' => false, 'error' => 'Valid invoice ID and payment amount are required']);
                exit;
            }

            $stmt = $db->prepare("SELECT * FROM invoices WHERE id = ?");
            $stmt->execute([$invoiceId]);
            $inv = $stmt->fetch();
            if (!$inv) {
                echo json_encode(['ok' => false, 'error' => 'Invoice not found']);
                exit;
            }

            $oldPaid = floatval($inv['paid_amount']);
            $totalAmount = floatval($inv['total_amount']);
            $newPaid = $oldPaid + $paymentAmount;
            
            $newStatus = ($newPaid >= $totalAmount) ? 'paid' : 'partially_paid';
            $dueDate = ($newStatus === 'paid') ? $inv['due_date'] : ($nextDueDate ?: $inv['due_date']);
            
            $entryNote = "\n[" . date('Y-m-d H:i') . "] Received {$inv['currency']} " . number_format($paymentAmount) . " via {$paymentMethod}" . (!empty($remarks) ? " ({$remarks})" : "");
            $newNotes = trim(($inv['notes'] ?? '') . $entryNote);

            $upd = $db->prepare("UPDATE invoices SET paid_amount = ?, status = ?, due_date = ?, payment_method = ?, notes = ? WHERE id = ?");
            $upd->execute([$newPaid, $newStatus, $dueDate, $paymentMethod, $newNotes, $invoiceId]);

            // Sync with lead record if matching email/phone exists
            if (!empty($inv['client_email']) || !empty($inv['client_phone'])) {
                $leadStmt = $db->prepare("SELECT id, meta_json FROM leads WHERE (email = ? AND email != '') OR (phone = ? AND phone != '')");
                $leadStmt->execute([$inv['client_email'], $inv['client_phone']]);
                $lead = $leadStmt->fetch();
                if ($lead) {
                    $lMeta = [];
                    try { $lMeta = json_decode($lead['meta_json'] ?? '{}', true) ?: []; } catch (Exception $e) {}
                    $lMeta['paid_amount'] = $newPaid;
                    if ($newStatus !== 'paid' && $dueDate) {
                        $lMeta['due_date'] = $dueDate;
                    }
                    $db->prepare("UPDATE leads SET meta_json = ? WHERE id = ?")->execute([json_encode($lMeta), $lead['id']]);
                }
            }

            echo json_encode([
                'ok' => true, 
                'msg' => 'Payment entry of ' . $inv['currency'] . ' ' . number_format($paymentAmount) . ' recorded successfully!',
                'new_status' => $newStatus,
                'new_paid' => $newPaid,
                'pending_balance' => max(0, $totalAmount - $newPaid)
            ]);
            break;

        case 'change_password':
            $userId = intval($_SESSION['panel_user_id'] ?? 0);
            $currentPass = trim($_POST['current_password'] ?? '');
            $newPass = trim($_POST['new_password'] ?? '');
            $confirmPass = trim($_POST['confirm_password'] ?? '');

            if ($userId <= 0) {
                echo json_encode(['ok' => false, 'error' => 'You must be logged in to change your password.']);
                exit;
            }

            if (empty($currentPass) || empty($newPass) || empty($confirmPass)) {
                echo json_encode(['ok' => false, 'error' => 'Please fill in all password fields.']);
                exit;
            }

            if ($newPass !== $confirmPass) {
                echo json_encode(['ok' => false, 'error' => 'New password and confirmation password do not match.']);
                exit;
            }

            if (strlen($newPass) < 6) {
                echo json_encode(['ok' => false, 'error' => 'New password must be at least 6 characters long.']);
                exit;
            }

            $uStmt = $db->prepare("SELECT id, password_hash FROM users WHERE id = ?");
            $uStmt->execute([$userId]);
            $uRow = $uStmt->fetch();

            if (!$uRow || !password_verify($currentPass, $uRow['password_hash'])) {
                echo json_encode(['ok' => false, 'error' => 'Current password is incorrect.']);
                exit;
            }

            $newHash = password_hash($newPass, PASSWORD_DEFAULT);
            $updStmt = $db->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
            $updStmt->execute([$newHash, $userId]);

            echo json_encode(['ok' => true, 'msg' => 'Password updated successfully!']);
            break;

        case 'delete_invoice':
            $id = intval($_POST['id'] ?? 0);
            $stmt = $db->prepare("DELETE FROM invoices WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['ok' => true, 'msg' => 'Invoice deleted']);
            break;

        case 'delete_subscriber':
            $id = intval($_POST['id'] ?? 0);
            $stmt = $db->prepare("DELETE FROM subscribers WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['ok' => true, 'msg' => 'Subscriber removed']);
            break;

        case 'send_broadcast':
            $subject = trim($_POST['subject'] ?? '');
            $body = trim($_POST['body'] ?? '');
            
            if (empty($subject) || empty($body)) {
                echo json_encode(['ok' => false, 'error' => 'Subject and content are required']);
                exit;
            }

            $stmt = $db->query("SELECT email, name FROM subscribers WHERE status = 'active'");
            $subs = $stmt->fetchAll();
            $count = count($subs);

            $currentUser = getCurrentUser();
            $ins = $db->prepare("INSERT INTO broadcasts (subject, body, recipient_count, sent_by) VALUES (?, ?, ?, ?)");
            $ins->execute([$subject, $body, $count, $currentUser['full_name'] ?? 'Admin']);

            echo json_encode(['ok' => true, 'msg' => "Broadcast logged and queued for {$count} active subscribers."]);
            break;

        case 'export_csv':
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="mentorsania_export_' . date('Y-m-d') . '.csv"');
            $out = fopen('php://output', 'w');
            
            $type = $_GET['export_type'] ?? 'leads';
            if ($type === 'invoices') {
                fputcsv($out, ['Invoice #', 'Type', 'Client Name', 'Phone', 'Email', 'Title', 'Currency', 'Total', 'Paid', 'Status', 'Date']);
                $rows = $db->query("SELECT invoice_number, type, client_name, client_phone, client_email, title, currency, total_amount, paid_amount, status, issue_date FROM invoices ORDER BY id DESC")->fetchAll();
                foreach ($rows as $r) fputcsv($out, $r);
            } else {
                fputcsv($out, ['ID', 'Type', 'Name', 'Email', 'Phone', 'Subject/Course', 'Budget', 'Status', 'Assigned To', 'Date']);
                $rows = $db->query("SELECT id, type, name, email, phone, subject_or_item, budget, status, assigned_to, created_at FROM leads ORDER BY id DESC")->fetchAll();
                foreach ($rows as $r) fputcsv($out, $r);
            }
            fclose($out);
            exit;

        default:
            echo json_encode(['ok' => false, 'error' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
