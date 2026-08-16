<?php
require_once __DIR__ . '/auth.php';
requireLogin();

$user = getCurrentUser();
$tab = $_GET['tab'] ?? 'overview';

// Global Counters - Unread / New Leads
$totalLeads = $db->query("SELECT COUNT(*) FROM leads")->fetchColumn();
$newLeadsCount = $db->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetchColumn();
$newCourseLeadsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'course' AND status = 'new'")->fetchColumn();
$newSessionLeadsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'consulting' AND status = 'new'")->fetchColumn();
$newServiceLeadsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'service' AND status = 'new'")->fetchColumn();
$totalSubs = $db->query("SELECT COUNT(*) FROM subscribers WHERE status = 'active'")->fetchColumn();

// Financial metrics
$totalRevenuePKR = $db->query("SELECT SUM(paid_amount) FROM invoices WHERE currency = 'PKR'")->fetchColumn() ?: 0;
$totalRevenueUSD = $db->query("SELECT SUM(paid_amount) FROM invoices WHERE currency = 'USD'")->fetchColumn() ?: 0;
$pendingReceivablesPKR = $db->query("SELECT SUM(total_amount - paid_amount) FROM invoices WHERE currency = 'PKR' AND status != 'paid'")->fetchColumn() ?: 0;

// Filter Parameters for Leads
$filterCourse = $_GET['course'] ?? '';
$filterService = $_GET['service'] ?? '';
$filterDate = $_GET['date_range'] ?? 'all';
$filterStatus = $_GET['status'] ?? '';
$filterInstructor = $_GET['instructor'] ?? '';

// Build dynamic WHERE clause for leads
function buildLeadQuery($baseType, $itemFilter = '', $date = 'all', $status = '', $instructor = '') {
    global $db;
    $sql = "SELECT * FROM leads WHERE 1=1";
    $params = [];

    if ($baseType === 'course') {
        $sql .= " AND type = 'course'";
    } elseif ($baseType === 'consulting') {
        $sql .= " AND type = 'consulting'";
    } elseif ($baseType === 'service') {
        $sql .= " AND type = 'service'";
    }

    if (!empty($itemFilter)) {
        $sql .= " AND subject_or_item LIKE ?";
        $params[] = "%$itemFilter%";
    }

    if (!empty($status)) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }

    if (!empty($instructor)) {
        $sql .= " AND assigned_to = ?";
        $params[] = $instructor;
    }

    if ($date === 'today') {
        $sql .= " AND (date(created_at) = date('now') OR date(created_at, 'localtime') = date('now', 'localtime'))";
    } elseif ($date === 'yesterday') {
        $sql .= " AND (date(created_at) = date('now', '-1 day') OR date(created_at, 'localtime') = date('now', '-1 day', 'localtime'))";
    } elseif ($date === 'week') {
        $sql .= " AND created_at >= datetime('now', '-7 days')";
    } elseif ($date === '15days') {
        $sql .= " AND created_at >= datetime('now', '-15 days')";
    } elseif ($date === '30days') {
        $sql .= " AND created_at >= datetime('now', '-30 days')";
    }

    $sql .= " ORDER BY id DESC LIMIT 300";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

$leads = [];
if ($tab === 'courses') {
    $leads = buildLeadQuery('course', $filterCourse, $filterDate, $filterStatus, $filterInstructor);
} elseif ($tab === 'sessions') {
    $leads = buildLeadQuery('consulting', '', $filterDate, $filterStatus, $filterInstructor);
} elseif ($tab === 'services') {
    $leads = buildLeadQuery('service', $filterService, $filterDate, $filterStatus, $filterInstructor);
} elseif ($tab === 'invoices') {
    $invoices = $db->query("SELECT * FROM invoices ORDER BY id DESC LIMIT 200")->fetchAll();
} elseif ($tab === 'email') {
    $subscribers = $db->query("SELECT * FROM subscribers ORDER BY id DESC LIMIT 200")->fetchAll();
    $broadcasts = $db->query("SELECT * FROM broadcasts ORDER BY id DESC LIMIT 20")->fetchAll();
} else {
    // Overview tab
    $recentLeads = $db->query("SELECT * FROM leads ORDER BY id DESC LIMIT 8")->fetchAll();
    $recentInvoices = $db->query("SELECT * FROM invoices ORDER BY id DESC LIMIT 6")->fetchAll();
    $activeStudentsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'course' AND status = 'enrolled'")->fetchColumn() ?: 0;
    $completedStudentsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'course' AND status = 'completed'")->fetchColumn() ?: 0;
    $activeCoursesBreakdown = $db->query("
        SELECT subject_or_item as course_name, COUNT(*) as student_count 
        FROM leads 
        WHERE type = 'course' AND status = 'enrolled' AND subject_or_item != ''
        GROUP BY subject_or_item 
        ORDER BY student_count DESC
    ")->fetchAll() ?: [];

    $activeClientsCount = $db->query("SELECT COUNT(*) FROM leads WHERE type = 'service' AND status IN ('enrolled', 'in_progress')")->fetchColumn() ?: 0;
    $activeServicesBreakdown = $db->query("
        SELECT subject_or_item as service_name, COUNT(*) as client_count 
        FROM leads 
        WHERE type = 'service' AND status IN ('enrolled', 'in_progress') AND subject_or_item != ''
        GROUP BY subject_or_item 
        ORDER BY client_count DESC
    ")->fetchAll() ?: [];

    $partialPaymentsList = $db->query("
        SELECT *, (total_amount - paid_amount) as pending_balance 
        FROM invoices 
        WHERE status = 'partially_paid' OR (total_amount > paid_amount AND paid_amount > 0)
        ORDER BY due_date ASC, id DESC
    ")->fetchAll() ?: [];
}

// 17 Courses List for Filter Dropdown
$COURSES_LIST = [
  'Pinterest Affiliate Marketing',
  'Pinterest & Etsy Mastery',
  'Pinterest Business & Brand Growth',
  'Pinterest Traffic for Bloggers',
  'YouTube Monetization',
  'Blogging & Content Strategy',
  'Website Design',
  'WordPress Design & Development',
  'Landing Pages & Conversion Design',
  'Website Development',
  'Graphics Designing',
  'Shopify Store Setup',
  'Shopify Dropshipping',
  'Search Engine Optimization (SEO)',
  'Meta & Google Ads',
  'Landing Page Design — Grand Session',
  'Forex Trading',
  'Binary Trading'
];

$SERVICES_LIST = [
  'Website Design & Development',
  'WordPress Development',
  'Shopify Dropshipping & Store Setup',
  'Pinterest Account Management & Growth',
  'YouTube Automation & Channel Management',
  'Search Engine Optimization (SEO)',
  'Performance Marketing & Ads',
  'Custom Project / Consulting'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="/panel/">
<title>Mentor Sania — Management Portal</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    background: #FAF7F2;
    color: #1E1B17;
    font-family: 'Manrope', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    min-height: 100vh;
    display: flex;
    -webkit-font-smoothing: antialiased;
  }
  
  /* SIDEBAR */
  .sidebar {
    width: 268px;
    background: #1E1B17;
    color: #FAF7F2;
    padding: 28px 18px;
    display: flex;
    flex-direction: column;
    gap: 22px;
    position: sticky;
    top: 0;
    height: 100vh;
    border-right: 1px solid rgba(250,247,242,0.1);
  }
  .nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 12px;
    color: rgba(250,247,242,0.72);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 180ms ease;
  }
  .nav-link svg {
    flex-shrink: 0;
    opacity: 0.8;
  }
  .nav-link:hover {
    color: #FAF7F2;
    background: rgba(250,247,242,0.06);
  }
  .nav-link:hover svg {
    opacity: 1;
  }
  .nav-link.active {
    color: #FAF7F2;
    background: #B5794A;
    font-weight: 600;
  }
  .nav-link.active svg {
    opacity: 1;
  }
  .badge {
    margin-left: auto;
    font-size: 11px;
    font-weight: 700;
    background: #B5794A;
    color: #FAF7F2;
    padding: 2px 8px;
    border-radius: 999px;
    line-height: 1.3;
  }

  /* MAIN CONTENT */
  .main-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    min-width: 0;
  }
  .top-header {
    background: #FFFDFA;
    border-bottom: 1px solid #E2D9C9;
    padding: 16px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
  }
  .content-area {
    padding: clamp(20px, 3vw, 36px);
    max-width: 1440px;
    width: 100%;
    margin: 0 auto;
  }

  /* CARDS & TABLES */
  .card {
    background: #FFFDFA;
    border: 1px solid #E2D9C9;
    border-radius: 20px;
    padding: clamp(20px, 2.5vw, 28px);
    box-shadow: 0 4px 16px rgba(30,27,23,0.03);
  }
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 18px;
    margin-bottom: 24px;
  }
  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 14px;
  }
  .table th {
    text-align: left;
    padding: 12px 14px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: rgba(30,27,23,0.55);
    border-bottom: 1.5px solid #EDE4D3;
  }
  .table td {
    padding: 14px;
    font-size: 13.5px;
    border-bottom: 1px solid #F4F1EA;
    vertical-align: middle;
  }
  .table tr:hover td {
    background: #FAF7F2;
  }

  /* STATUS PILLS */
  .status-pill {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
  }
  .pill-new { background: #E3F2FD; color: #1565C0; }
  .pill-contacted { background: #FFF8E1; color: #F57F17; }
  .pill-enrolled { background: #E8F5E9; color: #2E7D32; }
  .pill-in_progress { background: #EDE7F6; color: #512DA8; }
  .pill-completed { background: #E8F5E9; color: #2E7D32; }
  .pill-paid { background: #E8F5E9; color: #2E7D32; }
  .pill-partially_paid, .pill-partial { background: #FFF3E0; color: #E65100; border: 1px solid #FFE0B2; }
  .pill-unpaid { background: #FFEBEE; color: #C62828; }
  .pill-lost { background: #EEEEEE; color: #757575; }

  /* BUTTONS & CONTROLS */
  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 999px;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 180ms ease;
  }
  .btn svg { flex-shrink: 0; }
  .btn-primary { background: #B5794A; color: #FAF7F2; }
  .btn-primary:hover { background: #8A5A34; }
  .btn-dark { background: #1E1B17; color: #FAF7F2; }
  .btn-dark:hover { background: #332F2A; }
  .btn-outline { background: transparent; border: 1px solid #D9CDB6; color: #1E1B17; }
  .btn-outline:hover { border-color: #B5794A; color: #8A5A34; background: #FAF7F2; }
  .sidebar-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    padding: 7px 10px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 180ms ease;
    border: 1px solid rgba(250,247,242,0.15);
    color: rgba(250,247,242,0.85);
    background: rgba(250,247,242,0.06);
    cursor: pointer;
    font-family: inherit;
  }
  .sidebar-btn:hover {
    background: rgba(250,247,242,0.14) !important;
    color: #FAF7F2 !important;
    border-color: rgba(250,247,242,0.3) !important;
  }
  .sidebar-btn.btn-exit {
    color: #FF858D;
    border-color: rgba(255,133,141,0.25);
    background: rgba(255,133,141,0.05);
  }
  .sidebar-btn.btn-exit:hover {
    background: rgba(255,133,141,0.18) !important;
    color: #FF858D !important;
    border-color: rgba(255,133,141,0.45) !important;
  }
  .btn-wa-icon { background: #25D366; color: #FFF; width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; text-decoration: none; border: none; flex: 0 0 30px; box-shadow: 0 1px 3px rgba(37,211,102,0.25); transition: all 180ms ease; }
  .btn-wa-icon:hover { background: #1EBE5D; color: #FFF; transform: scale(1.05); }
  .btn-wa { background: #25D366; color: #FFF; font-size: 12px; font-weight: 600; height: 28px; padding: 0 12px; display: inline-flex; align-items: center; gap: 6px; border-radius: 999px; text-decoration: none; border: none; white-space: nowrap; box-shadow: 0 1px 3px rgba(37,211,102,0.25); transition: all 180ms ease; }
  .btn-wa:hover { background: #1EBE5D; color: #FFF; }

  /* FILTER BAR */
  .filter-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    background: #FAF7F2;
    border: 1px solid #E2D9C9;
    padding: 12px 16px;
    border-radius: 14px;
    margin-bottom: 20px;
  }
  .filter-select {
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid #D9CDB6;
    background: #FFF;
    font-family: inherit;
    font-size: 13px;
    outline: none;
  }

  /* SELECTION MODE & CHECKBOXES */
  .select-col {
    display: none !important;
    width: 38px;
    text-align: center;
  }
  .selection-mode .select-col {
    display: table-cell !important;
  }
  .row-del-btn {
    display: none !important;
  }
  .selection-mode .row-del-btn {
    display: inline-flex !important;
  }
  .custom-chk {
    appearance: none;
    -webkit-appearance: none;
    width: 17px;
    height: 17px;
    border: 1.5px solid #C4B5A0;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FFF;
    vertical-align: middle;
    transition: all 140ms ease;
    margin: 0;
  }
  .custom-chk:checked {
    background: #B5794A;
    border-color: #B5794A;
  }
  .custom-chk:checked::after {
    content: '';
    display: block;
    width: 4px;
    height: 8px;
    border: solid #FFF;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg) translate(-1px, -1px);
  }

  /* BULK ACTIONS BAR */
  .bulk-bar {
    display: none;
    align-items: center;
    justify-content: space-between;
    background: #1E1B17;
    color: #FAF7F2;
    padding: 12px 20px;
    border-radius: 14px;
    margin-bottom: 16px;
    box-shadow: 0 4px 16px rgba(30,27,23,0.12);
  }
  .bulk-bar.visible { display: flex; }

  /* MODAL */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(30,27,23,0.6);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .modal-overlay.open { display: flex; }
  .modal-box {
    background: #FFFDFA;
    border-radius: 20px;
    width: 100%;
    max-width: 580px;
    max-height: 90vh;
    overflow-y: auto;
    padding: clamp(24px, 4vw, 36px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
  }
  .form-control {
    width: 100%;
    height: 42px;
    border: 1px solid #D9CDB6;
    border-radius: 10px;
    padding: 0 14px;
    font-family: inherit;
    font-size: 14px;
    background: #FAF7F2;
    outline: none;
  }
  .form-control:focus { border-color: #B5794A; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div>
    <a href="index.php" style="font-family:'Newsreader',Georgia,serif;font-size:24px;color:#FAF7F2;text-decoration:none;display:flex;align-items:center;gap:6px">
      Sania Maqsood<span style="width:6px;height:6px;border-radius:999px;background:#D9A879"></span>
    </a>
    <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#D9A879;display:block;margin-top:4px">
      Management Portal
    </span>
  </div>

  <nav style="display:flex;flex-direction:column;gap:5px">
    <a href="index.php?tab=overview" class="nav-link <?php echo $tab === 'overview' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
      Overview
    </a>

    <a href="index.php?tab=courses" class="nav-link <?php echo $tab === 'courses' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
      Course Leads
      <?php if ($newCourseLeadsCount > 0): ?><span class="badge" title="<?php echo $newCourseLeadsCount; ?> New Course Leads"><?php echo $newCourseLeadsCount; ?></span><?php endif; ?>
    </a>

    <a href="index.php?tab=sessions" class="nav-link <?php echo $tab === 'sessions' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
      1:1 Bookings
      <?php if ($newSessionLeadsCount > 0): ?><span class="badge" title="<?php echo $newSessionLeadsCount; ?> New Session Bookings"><?php echo $newSessionLeadsCount; ?></span><?php endif; ?>
    </a>

    <a href="index.php?tab=services" class="nav-link <?php echo $tab === 'services' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
      Services
      <?php if ($newServiceLeadsCount > 0): ?><span class="badge" title="<?php echo $newServiceLeadsCount; ?> New Services Inquiries"><?php echo $newServiceLeadsCount; ?></span><?php endif; ?>
    </a>

    <a href="index.php?tab=invoices" class="nav-link <?php echo $tab === 'invoices' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
      Invoices & Finance
    </a>

    <a href="index.php?tab=email" class="nav-link <?php echo $tab === 'email' ? 'active' : ''; ?>">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
      The Sunday Note
    </a>
  </nav>

  <div style="margin-top:auto;display:flex;flex-direction:column;gap:12px;padding-top:20px;border-top:1px solid rgba(250,247,242,0.1)">
    <div style="display:flex;align-items:center;justify-content:space-between">
      <div style="display:flex;align-items:center;gap:10px">
        <img src="../Media/Instructors/sania.jpg" alt="User" style="width:36px;height:36px;border-radius:999px;object-fit:cover;border:1.5px solid #D9A879">
        <div style="font-size:13px">
          <strong style="color:#FAF7F2;display:block"><?php echo htmlspecialchars($user['full_name']); ?></strong>
          <span style="color:rgba(250,247,242,0.5);text-transform:capitalize"><?php echo htmlspecialchars($user['role']); ?></span>
        </div>
      </div>
      <button type="button" onclick="openChangePasswordModal()" class="sidebar-btn" style="padding:6px 8px;font-size:11px" title="Change Account Password">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
      </button>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
      <a href="../index.php" target="_blank" class="sidebar-btn" title="View Public Website">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        Site ↗
      </a>
      <a href="logout.php" class="sidebar-btn btn-exit" title="Sign Out">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        Exit
      </a>
    </div>
  </div>
</aside>

<!-- MAIN CONTENT WRAPPER -->
<main class="main-wrapper">
  
  <header class="top-header">
    <div>
      <h2 style="font-family:'Newsreader',Georgia,serif;font-size:24px;color:#1E1B17">
        <?php 
          if ($tab === 'courses') echo 'Course Leads & Registrations';
          elseif ($tab === 'sessions') echo '1:1 Strategy Session Bookings';
          elseif ($tab === 'services') echo 'Services Inquiries';
          elseif ($tab === 'invoices') echo 'Invoices & Financial Management';
          elseif ($tab === 'email') echo 'The Sunday Note & Email Broadcasts';
          else echo 'Executive Overview';
        ?>
      </h2>
    </div>
    <div style="display:flex;align-items:center;gap:12px">
      <a href="api.php?action=export_csv&export_type=<?php echo $tab === 'invoices' ? 'invoices' : 'leads'; ?>" class="btn btn-outline">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        Export CSV
      </a>
      <?php if ($tab === 'invoices'): ?>
        <button onclick="openInvoiceModal()" class="btn btn-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          Create Invoice
        </button>
      <?php elseif ($tab === 'email'): ?>
        <button onclick="openBroadcastModal()" class="btn btn-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
          Write Broadcast
        </button>
      <?php endif; ?>
    </div>
  </header>

  <div class="content-area">

    <!-- TAB 1: OVERVIEW -->
    <?php if ($tab === 'overview'): ?>
      
      <!-- STAT CARDS (4 COLUMNS GRID) -->
      <div style="display:grid;grid-template-columns:repeat(4, minmax(0, 1fr));gap:16px;margin-bottom:24px">
        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Total Inquiries</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#1E1B17;margin-top:6px"><?php echo number_format($totalLeads); ?></div>
          <span style="font-size:12.5px;color:#B5794A"><?php echo $newLeadsCount; ?> new awaiting contact</span>
        </div>

        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#8A5A34">Active Students</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#8A5A34;margin-top:6px"><?php echo number_format($activeStudentsCount); ?></div>
          <span style="font-size:12.5px;color:#4C7A5E">Enrolled in active batches</span>
        </div>

        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#8A5A34">Active Clients</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#8A5A34;margin-top:6px"><?php echo number_format($activeClientsCount); ?></div>
          <span style="font-size:12.5px;color:#4C7A5E">Active Services Projects</span>
        </div>

        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Course Alumni</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#1E1B17;margin-top:6px"><?php echo number_format($completedStudentsCount); ?></div>
          <span style="font-size:12.5px;color:rgba(30,27,23,0.5)">Completed & Graduated</span>
        </div>

        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Revenue (PKR)</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#2E7D32;margin-top:6px">PKR <?php echo number_format($totalRevenuePKR); ?></div>
          <span style="font-size:12.5px;color:#C62828"><?php echo number_format($pendingReceivablesPKR); ?> pending</span>
        </div>

        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Trading Revenue</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#1565C0;margin-top:6px">$<?php echo number_format($totalRevenueUSD); ?></div>
          <span style="font-size:12.5px;color:rgba(30,27,23,0.5)">Forex & Binary USD</span>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(450px,100%),1fr));gap:24px;margin-bottom:24px">
        <!-- ACTIVE ENROLLED STUDENTS -->
        <div class="card">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:14px">
            <div style="flex:1;min-width:0">
              <h3 style="font-family:'Newsreader',Georgia,serif;font-size:21px;color:#1E1B17">Active Enrolled Students</h3>
              <p style="font-size:13px;color:rgba(30,27,23,0.55);margin-top:2px">Ongoing live batches currently in progress.</p>
            </div>
            <span class="status-pill pill-enrolled" style="font-size:12px;white-space:nowrap;flex-shrink:0;margin-top:2px"><?php echo $activeStudentsCount; ?> Active Enrolled</span>
          </div>

          <?php if (empty($activeCoursesBreakdown)): ?>
            <div style="text-align:center;color:rgba(30,27,23,0.5);padding:28px 16px;background:#FAF7F2;border-radius:12px;border:1px dashed #D9CDB6;margin-top:16px">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="opacity:0.5;margin-bottom:6px"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
              <div style="font-size:13.5px;font-weight:600;color:#1E1B17">No active enrolled students currently</div>
              <div style="font-size:12.5px;color:rgba(30,27,23,0.6);margin-top:2px">When students register and their payment is confirmed (Status: Enrolled), their courses and counts will appear here.</div>
            </div>
          <?php else: ?>
            <table class="table" style="margin-top:16px">
              <thead>
                <tr>
                  <th>Course Name</th>
                  <th style="white-space:nowrap">Active Students</th>
                  <th style="white-space:nowrap">Status</th>
                  <th style="white-space:nowrap;text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($activeCoursesBreakdown as $c): ?>
                  <tr>
                    <td style="vertical-align:middle">
                      <div style="display:flex;align-items:center;gap:8px;line-height:1.3">
                        <span style="width:8px;height:8px;border-radius:999px;background:#4C7A5E;flex-shrink:0"></span>
                        <strong style="color:#1E1B17;font-size:13.5px"><?php echo htmlspecialchars($c['course_name']); ?></strong>
                      </div>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap">
                      <span style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#8A5A34;background:#FAF7F2;padding:4px 10px;border-radius:999px;border:1px solid #E2D9C9">
                        <?php echo $c['student_count']; ?> <?php echo $c['student_count'] == 1 ? 'Student' : 'Students'; ?>
                      </span>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap">
                      <span class="status-pill pill-enrolled" style="white-space:nowrap">Active</span>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap;text-align:right">
                      <a href="index.php?tab=courses&course=<?php echo urlencode($c['course_name']); ?>&status=enrolled" class="btn btn-outline" style="font-size:12px;padding:4px 12px;text-decoration:none;white-space:nowrap">View</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>

        <!-- ACTIVE SERVICES PROJECTS -->
        <div class="card">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:14px">
            <div style="flex:1;min-width:0">
              <h3 style="font-family:'Newsreader',Georgia,serif;font-size:21px;color:#1E1B17">Active Service Projects</h3>
              <p style="font-size:13px;color:rgba(30,27,23,0.55);margin-top:2px">Ongoing client projects currently being managed.</p>
            </div>
            <span class="status-pill pill-in_progress" style="font-size:12px;white-space:nowrap;flex-shrink:0;margin-top:2px"><?php echo $activeClientsCount; ?> Active Projects</span>
          </div>

          <?php if (empty($activeServicesBreakdown)): ?>
            <div style="text-align:center;color:rgba(30,27,23,0.5);padding:28px 16px;background:#FAF7F2;border-radius:12px;border:1px dashed #D9CDB6;margin-top:16px">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="opacity:0.5;margin-bottom:6px"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
              <div style="font-size:13.5px;font-weight:600;color:#1E1B17">No active service projects currently</div>
              <div style="font-size:12.5px;color:rgba(30,27,23,0.6);margin-top:2px">When service inquiries are confirmed (Status: In Progress), they will appear here.</div>
            </div>
          <?php else: ?>
            <table class="table" style="margin-top:16px">
              <thead>
                <tr>
                  <th>Service Category</th>
                  <th style="white-space:nowrap">Active Clients</th>
                  <th style="white-space:nowrap">Status</th>
                  <th style="white-space:nowrap;text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($activeServicesBreakdown as $s): ?>
                  <tr>
                    <td style="vertical-align:middle">
                      <div style="display:flex;align-items:center;gap:8px;line-height:1.3">
                        <span style="width:8px;height:8px;border-radius:999px;background:#B5794A;flex-shrink:0"></span>
                        <strong style="color:#1E1B17;font-size:13.5px"><?php echo htmlspecialchars($s['service_name']); ?></strong>
                      </div>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap">
                      <span style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#B5794A;background:#FAF7F2;padding:4px 10px;border-radius:999px;border:1px solid #E2D9C9">
                        <?php echo $s['client_count']; ?> <?php echo $s['client_count'] == 1 ? 'Client' : 'Clients'; ?>
                      </span>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap">
                      <span class="status-pill pill-in_progress" style="white-space:nowrap">In Progress</span>
                    </td>
                    <td style="vertical-align:middle;white-space:nowrap;text-align:right">
                      <a href="index.php?tab=services&service=<?php echo urlencode($s['service_name']); ?>" class="btn btn-outline" style="font-size:12px;padding:4px 12px;text-decoration:none;white-space:nowrap">View</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>

      <!-- RECENT INQUIRIES & RECENT INVOICES (SIDE BY SIDE) -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(450px,100%),1fr));gap:24px;margin-bottom:24px">
        <div class="card">
          <div style="display:flex;align-items:center;justify-content:space-between">
            <h3 style="font-family:'Newsreader',Georgia,serif;font-size:20px;color:#1E1B17">Recent Inquiries</h3>
            <a href="index.php?tab=courses" style="font-size:13px;color:#8A5A34;font-weight:600;text-decoration:none">View all →</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Lead</th>
                <th>Type / Item</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($recentLeads)): ?>
                <tr><td colspan="4" style="text-align:center;color:rgba(30,27,23,0.5);padding:24px">No inquiries received yet.</td></tr>
              <?php else: ?>
                <?php foreach ($recentLeads as $l): ?>
                  <tr>
                    <td>
                      <strong><?php echo htmlspecialchars($l['name']); ?></strong>
                      <div style="font-size:12px;color:rgba(30,27,23,0.5)"><?php echo htmlspecialchars($l['phone'] ?: $l['email']); ?></div>
                    </td>
                    <td><span style="font-size:13px"><?php echo htmlspecialchars($l['subject_or_item'] ?: ucfirst($l['type'])); ?></span></td>
                    <td><span class="status-pill pill-<?php echo $l['status']; ?>"><?php echo ($l['status'] === 'partially_paid') ? 'P. PAID' : htmlspecialchars(str_replace('_', ' ', strtoupper($l['status']))); ?></span></td>
                    <td>
                      <div style="display:flex;gap:5px">
                        <button onclick="viewLeadModal(<?php echo $l['id']; ?>)" class="btn btn-outline" style="font-size:12px;padding:4px 12px;font-weight:600">View</button>
                        <?php if (!empty($l['phone'])): 
                          $cleanPhone = preg_replace('/[^0-9]/', '', $l['phone']);
                          if (str_starts_with($cleanPhone, '03')) $cleanPhone = '92' . substr($cleanPhone, 1);
                        ?>
                          <a href="https://wa.me/<?php echo $cleanPhone; ?>?text=Salam%20<?php echo urlencode($l['name']); ?>,%20this%20is%20Sania%20Maqsood." target="_blank" class="btn-wa-icon" title="Open WhatsApp Chat">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                          </a>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div class="card">
          <div style="display:flex;align-items:center;justify-content:space-between">
            <div>
              <h3 style="font-family:'Newsreader',Georgia,serif;font-size:20px;color:#1E1B17">Recent Invoices</h3>
              <p style="font-size:12.5px;color:rgba(30,27,23,0.55);margin-top:2px">Track, generate and print official invoices & payment receipts.</p>
            </div>
            <div style="display:flex;align-items:center;gap:8px">
              <button onclick="openInvoiceModal()" class="btn btn-primary" style="font-size:12px;padding:5px 12px;display:inline-flex;align-items:center;gap:5px">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Generate Invoice
              </button>
              <a href="index.php?tab=invoices" class="btn btn-outline" style="font-size:12px;padding:5px 10px;text-decoration:none">View all →</a>
            </div>
          </div>
          <table class="table" style="margin-top:14px">
            <thead>
              <tr>
                <th>Invoice #</th>
                <th>Client / Student</th>
                <th>Amount</th>
                <th style="white-space:nowrap">Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($recentInvoices)): ?>
                <tr><td colspan="5" style="text-align:center;color:rgba(30,27,23,0.5);padding:24px">No invoices generated yet. Click "+ Generate Invoice" to create one.</td></tr>
              <?php else: ?>
                <?php foreach ($recentInvoices as $inv): ?>
                  <tr>
                    <td>
                      <a href="invoice-view.php?id=<?php echo $inv['id']; ?>" target="_blank" style="font-weight:700;color:#8A5A34;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
                        #<?php echo htmlspecialchars($inv['invoice_number']); ?>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                      </a>
                    </td>
                    <td>
                      <div style="font-weight:600"><?php echo htmlspecialchars($inv['client_name']); ?></div>
                      <div style="font-size:11.5px;color:rgba(30,27,23,0.5)"><?php echo htmlspecialchars($inv['title']); ?></div>
                    </td>
                    <td><strong><?php echo htmlspecialchars($inv['currency'] . ' ' . number_format($inv['total_amount'])); ?></strong></td>
                    <td style="white-space:nowrap"><span class="status-pill pill-<?php echo $inv['status']; ?>"><?php echo ($inv['status'] === 'partially_paid') ? 'P. PAID' : htmlspecialchars(str_replace('_', ' ', strtoupper($inv['status']))); ?></span></td>
                    <td>
                      <a href="invoice-view.php?id=<?php echo $inv['id']; ?>" target="_blank" class="btn btn-outline" style="font-size:11.5px;padding:3px 10px;font-weight:600">View</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- PARTIAL PAYMENTS & RECEIVABLES FOLLOW-UP LIST (AT THE BOTTOM) -->
      <div class="card" style="margin-bottom:24px">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
          <div>
            <h3 style="font-family:'Newsreader',Georgia,serif;font-size:21px;color:#1E1B17">Partial Payments & Pending Balance Follow-up</h3>
            <p style="font-size:13px;color:rgba(30,27,23,0.55);margin-top:2px">Students & clients with remaining balance installments and upcoming collection dates.</p>
          </div>
          <span class="status-pill pill-partially_paid" style="font-size:12px;white-space:nowrap"><?php echo count($partialPaymentsList); ?> Partial Accounts</span>
        </div>

        <?php if (empty($partialPaymentsList)): ?>
          <div style="text-align:center;color:rgba(30,27,23,0.5);padding:28px 16px;background:#FAF7F2;border-radius:12px;border:1px dashed #D9CDB6;margin-top:16px">
            <div style="font-size:13.5px;font-weight:600;color:#1E1B17">No pending partial installments</div>
            <div style="font-size:12.5px;color:rgba(30,27,23,0.6);margin-top:2px">All enrolled students and client invoices are currently settled in full.</div>
          </div>
        <?php else: ?>
          <table class="table" style="margin-top:16px">
            <thead>
              <tr>
                <th>Student / Client</th>
                <th>Course / Service</th>
                <th style="white-space:nowrap">Agreed Total</th>
                <th style="white-space:nowrap">Paid So Far</th>
                <th style="white-space:nowrap">Remaining Balance</th>
                <th style="white-space:nowrap">Next Due Date</th>
                <th style="white-space:nowrap;text-align:right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($partialPaymentsList as $p): 
                $cleanPhone = preg_replace('/[^0-9]/', '', $p['client_phone'] ?? '');
                if (str_starts_with($cleanPhone, '03')) $cleanPhone = '92' . substr($cleanPhone, 1);
                $isOverdue = (!empty($p['due_date']) && $p['due_date'] < date('Y-m-d'));
              ?>
                <tr>
                  <td>
                    <div style="font-weight:700;color:#1E1B17"><?php echo htmlspecialchars($p['client_name']); ?></div>
                    <div style="font-size:12px;color:rgba(30,27,23,0.5)"><?php echo htmlspecialchars($p['client_phone'] ?: $p['client_email']); ?></div>
                  </td>
                  <td>
                    <span style="font-size:13px;color:#8A5A34;font-weight:600"><?php echo htmlspecialchars($p['title']); ?></span>
                  </td>
                  <td style="white-space:nowrap">
                    <?php echo htmlspecialchars($p['currency'] . ' ' . number_format($p['total_amount'])); ?>
                  </td>
                  <td style="white-space:nowrap">
                    <span style="color:#2E7D32;font-weight:700"><?php echo htmlspecialchars($p['currency'] . ' ' . number_format($p['paid_amount'])); ?></span>
                  </td>
                  <td style="white-space:nowrap">
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:13px;font-weight:700;color:#C62828;background:#FFEBEE;padding:3px 10px;border-radius:6px;border:1px solid #FFCDD2">
                      <?php echo htmlspecialchars($p['currency'] . ' ' . number_format($p['pending_balance'])); ?> Pending
                    </span>
                  </td>
                  <td style="white-space:nowrap">
                    <?php if (!empty($p['due_date'])): ?>
                      <span style="font-size:12.5px;font-weight:600;color:<?php echo $isOverdue ? '#C62828' : '#1E1B17'; ?>">
                        <?php echo date('M d, Y', strtotime($p['due_date'])); ?>
                        <?php if ($isOverdue): ?><span style="font-size:10px;color:#C62828;font-weight:700;text-transform:uppercase;background:#FFEBEE;padding:2px 6px;border-radius:4px;margin-left:4px">Overdue</span><?php endif; ?>
                      </span>
                    <?php else: ?>
                      <span style="font-size:12px;color:rgba(30,27,23,0.4)">Not set</span>
                    <?php endif; ?>
                  </td>
                  <td style="white-space:nowrap;text-align:right">
                    <div style="display:inline-flex;align-items:center;gap:6px">
                      <button type="button" onclick="openCollectPaymentModal(<?php echo $p['id']; ?>, '<?php echo addslashes(htmlspecialchars($p['client_name'])); ?>', '<?php echo addslashes(htmlspecialchars($p['title'])); ?>', <?php echo $p['total_amount']; ?>, <?php echo $p['paid_amount']; ?>, '<?php echo $p['currency']; ?>', '<?php echo $p['due_date'] ?? ''; ?>')" class="btn btn-primary" style="font-size:11.5px;padding:4px 10px;background:#2E7D32;color:#FFF;border:none;white-space:nowrap;gap:4px">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Payment
                      </button>
                      <?php if (!empty($cleanPhone)): ?>
                        <a href="https://wa.me/<?php echo $cleanPhone; ?>?text=Salam%20<?php echo urlencode($p['client_name']); ?>,%20this%20is%20a%20gentle%20reminder%20regarding%20the%20remaining%20balance%20of%20<?php echo urlencode($p['currency'] . ' ' . number_format($p['pending_balance'])); ?>%20for%20<?php echo urlencode($p['title']); ?>." target="_blank" class="btn-wa-icon" title="Send WhatsApp Payment Reminder">
                          <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                        </a>
                      <?php endif; ?>
                      <a href="invoice-view.php?id=<?php echo $p['id']; ?>" target="_blank" class="btn btn-outline" style="font-size:11.5px;padding:3px 8px">View</a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>

    <!-- TAB 2: COURSE LEADS -->
    <?php elseif ($tab === 'courses'): ?>
      
      <!-- FILTER BAR -->
      <form method="get" action="index.php" class="filter-bar">
        <input type="hidden" name="tab" value="courses" />
        
        <span style="font-size:12.5px;font-weight:700;color:rgba(30,27,23,0.6)">Filter:</span>

        <select name="course" class="filter-select">
          <option value="">All 17 Courses</option>
          <?php foreach ($COURSES_LIST as $cName): ?>
            <option value="<?php echo htmlspecialchars($cName); ?>" <?php echo $filterCourse === $cName ? 'selected' : ''; ?>><?php echo htmlspecialchars($cName); ?></option>
          <?php endforeach; ?>
        </select>

        <select name="date_range" class="filter-select">
          <option value="all" <?php echo $filterDate === 'all' ? 'selected' : ''; ?>>All Time</option>
          <option value="today" <?php echo $filterDate === 'today' ? 'selected' : ''; ?>>Today</option>
          <option value="yesterday" <?php echo $filterDate === 'yesterday' ? 'selected' : ''; ?>>Yesterday</option>
          <option value="week" <?php echo $filterDate === 'week' ? 'selected' : ''; ?>>This Week (Last 7 Days)</option>
          <option value="15days" <?php echo $filterDate === '15days' ? 'selected' : ''; ?>>Last 15 Days</option>
          <option value="30days" <?php echo $filterDate === '30days' ? 'selected' : ''; ?>>Last 30 Days</option>
        </select>

        <select name="status" class="filter-select">
          <option value="">All Statuses</option>
          <option value="new" <?php echo $filterStatus === 'new' ? 'selected' : ''; ?>>New</option>
          <option value="contacted" <?php echo $filterStatus === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
          <option value="enrolled" <?php echo $filterStatus === 'enrolled' ? 'selected' : ''; ?>>Enrolled (Paid)</option>
          <option value="lost" <?php echo $filterStatus === 'lost' ? 'selected' : ''; ?>>Lost</option>
        </select>

        <select name="instructor" class="filter-select">
          <option value="">All Instructors</option>
          <option value="Sania Maqsood" <?php echo $filterInstructor === 'Sania Maqsood' ? 'selected' : ''; ?>>Sania Maqsood</option>
          <option value="M. Saqib" <?php echo $filterInstructor === 'M. Saqib' ? 'selected' : ''; ?>>M. Saqib</option>
          <option value="Aqib" <?php echo $filterInstructor === 'Aqib' ? 'selected' : ''; ?>>Aqib</option>
        </select>

        <button type="submit" class="btn btn-dark" style="padding:6px 14px;font-size:12.5px">Apply Filters</button>
        <a href="index.php?tab=courses" class="btn btn-outline" style="padding:6px 12px;font-size:12.5px">Reset</a>

        <button type="button" id="btnSelectMode" onclick="toggleSelectionMode()" class="btn btn-outline" style="padding:6px 14px;font-size:12.5px;margin-left:auto;display:inline-flex;align-items:center;gap:6px">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><polyline points="9 11 12 14 22 4"></polyline></svg>
          <span>Select</span>
        </button>
      </form>

      <!-- BULK ACTION BAR -->
      <div id="bulkBar" class="bulk-bar">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="font-size:13.5px">
            <strong class="selected-count-display">0</strong> leads selected
          </div>
          <button type="button" onclick="selectAllLeads(true)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Select All</button>
          <button type="button" onclick="selectAllLeads(false)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Deselect All</button>
        </div>
        <div style="display:flex;align-items:center;gap:10px">
          <select class="filter-select bulk-assign-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="Sania Maqsood">Assign: Sania Maqsood</option>
            <option value="M. Saqib">Assign: M. Saqib</option>
            <option value="Aqib">Assign: Aqib</option>
          </select>
          <button onclick="applyBulkAssign()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Assign</button>

          <select class="filter-select bulk-status-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="new">Status: New</option>
            <option value="contacted">Status: Contacted</option>
            <option value="enrolled">Status: Enrolled (Paid)</option>
            <option value="lost">Status: Lost</option>
          </select>
          <button onclick="applyBulkStatus()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Update</button>

          <button onclick="applyBulkDelete()" class="btn btn-outline" style="padding:5px 12px;font-size:12px;color:#ff858d;border-color:rgba(255,133,141,0.4)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            Delete Selected
          </button>
        </div>
      </div>

      <div class="card table-card-selectable" id="leadsTableCard">
        <table class="table">
          <thead>
            <tr>
              <th class="select-col"><input type="checkbox" class="custom-chk select-all-master" onchange="toggleSelectAll(this)" title="Select All" /></th>
              <th>Date</th>
              <th>Student Name</th>
              <th>Course Inquired</th>
              <th>Instructor</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($leads)): ?>
              <tr><td colspan="7" style="text-align:center;color:rgba(30,27,23,0.5);padding:32px">No course registrations match your filter criteria.</td></tr>
            <?php else: ?>
              <?php foreach ($leads as $l): ?>
                <tr>
                  <td class="select-col"><input type="checkbox" class="lead-chk custom-chk" value="<?php echo $l['id']; ?>" onchange="updateBulkBar()" /></td>
                  <td style="font-size:12.5px;color:rgba(30,27,23,0.55);white-space:nowrap"><?php echo date('M d, Y', strtotime($l['created_at'])); ?></td>
                  <td>
                    <strong><?php echo htmlspecialchars($l['name']); ?></strong>
                    <div style="font-size:12.5px;color:rgba(30,27,23,0.6)"><?php echo htmlspecialchars($l['phone'] ?: $l['email']); ?></div>
                  </td>
                  <td>
                    <span style="font-weight:600;color:#1E1B17"><?php echo htmlspecialchars($l['subject_or_item'] ?: 'Live Course'); ?></span>
                  </td>
                  <td>
                    <span style="font-size:12.5px;color:#8A5A34;font-weight:600"><?php echo htmlspecialchars($l['assigned_to'] ?: 'Sania Maqsood'); ?></span>
                  </td>
                  <td>
                    <span class="status-pill pill-<?php echo $l['status']; ?>"><?php echo htmlspecialchars($l['status']); ?></span>
                  </td>
                  <td>
                    <div style="display:flex;gap:5px">
                      <button onclick="viewLeadModal(<?php echo $l['id']; ?>)" class="btn btn-outline" style="font-size:12px;padding:4px 12px;font-weight:600">View</button>
                      <?php if (!empty($l['phone'])): 
                        $cleanPhone = preg_replace('/[^0-9]/', '', $l['phone']);
                        if (str_starts_with($cleanPhone, '03')) $cleanPhone = '92' . substr($cleanPhone, 1);
                      ?>
                        <a href="https://wa.me/<?php echo $cleanPhone; ?>?text=Salam%20<?php echo urlencode($l['name']); ?>,%20thank%20you%20for%20inquiring%20about%20<?php echo urlencode($l['subject_or_item']); ?>.%20Here%20are%20the%20batch%20and%20payment%20details:" target="_blank" class="btn-wa-icon" title="Open WhatsApp Chat">
                          <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                        </a>
                      <?php endif; ?>
                      <button onclick="deleteLead(<?php echo $l['id']; ?>)" class="btn btn-outline row-del-btn" style="padding:4px 8px;color:#ff858d;border-color:rgba(255,133,141,0.4)" title="Delete Lead">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <!-- TAB 3: 1:1 SESSION BOOKINGS -->
    <?php elseif ($tab === 'sessions'): ?>
      
      <!-- FILTER BAR -->
      <form method="get" action="index.php" class="filter-bar">
        <input type="hidden" name="tab" value="sessions" />
        
        <span style="font-size:12.5px;font-weight:700;color:rgba(30,27,23,0.6)">Filter:</span>

        <select name="date_range" class="filter-select">
          <option value="all" <?php echo $filterDate === 'all' ? 'selected' : ''; ?>>All Time</option>
          <option value="today" <?php echo $filterDate === 'today' ? 'selected' : ''; ?>>Today</option>
          <option value="yesterday" <?php echo $filterDate === 'yesterday' ? 'selected' : ''; ?>>Yesterday</option>
          <option value="week" <?php echo $filterDate === 'week' ? 'selected' : ''; ?>>This Week (Last 7 Days)</option>
          <option value="15days" <?php echo $filterDate === '15days' ? 'selected' : ''; ?>>Last 15 Days</option>
          <option value="30days" <?php echo $filterDate === '30days' ? 'selected' : ''; ?>>Last 30 Days</option>
        </select>

        <select name="status" class="filter-select">
          <option value="">All Statuses</option>
          <option value="new" <?php echo $filterStatus === 'new' ? 'selected' : ''; ?>>New</option>
          <option value="contacted" <?php echo $filterStatus === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
          <option value="enrolled" <?php echo $filterStatus === 'enrolled' ? 'selected' : ''; ?>>Enrolled (Paid)</option>
          <option value="lost" <?php echo $filterStatus === 'lost' ? 'selected' : ''; ?>>Lost</option>
        </select>

        <select name="instructor" class="filter-select">
          <option value="">All Assignees</option>
          <option value="Sania Maqsood" <?php echo $filterInstructor === 'Sania Maqsood' ? 'selected' : ''; ?>>Sania Maqsood</option>
          <option value="M. Saqib" <?php echo $filterInstructor === 'M. Saqib' ? 'selected' : ''; ?>>M. Saqib</option>
          <option value="Aqib" <?php echo $filterInstructor === 'Aqib' ? 'selected' : ''; ?>>Aqib</option>
        </select>

        <button type="submit" class="btn btn-dark" style="padding:6px 14px;font-size:12.5px">Apply Filters</button>
        <a href="index.php?tab=sessions" class="btn btn-outline" style="padding:6px 12px;font-size:12.5px">Reset</a>

        <button type="button" id="btnSelectMode" onclick="toggleSelectionMode()" class="btn btn-outline" style="padding:6px 14px;font-size:12.5px;margin-left:auto;display:inline-flex;align-items:center;gap:6px">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><polyline points="9 11 12 14 22 4"></polyline></svg>
          <span>Select</span>
        </button>
      </form>

      <!-- BULK ACTION BAR -->
      <div id="bulkBarSessions" class="bulk-bar">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="font-size:13.5px">
            <strong class="selected-count-display">0</strong> leads selected
          </div>
          <button type="button" onclick="selectAllLeads(true)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Select All</button>
          <button type="button" onclick="selectAllLeads(false)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Deselect All</button>
        </div>
        <div style="display:flex;align-items:center;gap:10px">
          <select class="filter-select bulk-assign-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="Sania Maqsood">Assign: Sania Maqsood</option>
            <option value="M. Saqib">Assign: M. Saqib</option>
            <option value="Aqib">Assign: Aqib</option>
          </select>
          <button onclick="applyBulkAssign()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Assign</button>

          <select class="filter-select bulk-status-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="new">Status: New</option>
            <option value="contacted">Status: Contacted</option>
            <option value="enrolled">Status: Enrolled (Paid)</option>
            <option value="lost">Status: Lost</option>
          </select>
          <button onclick="applyBulkStatus()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Update</button>

          <button onclick="applyBulkDelete()" class="btn btn-outline" style="padding:5px 12px;font-size:12px;color:#ff858d;border-color:rgba(255,133,141,0.4)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            Delete Selected
          </button>
        </div>
      </div>
      
      <div class="card table-card-selectable" id="sessionsTableCard">
        <table class="table">
          <thead>
            <tr>
              <th class="select-col"><input type="checkbox" class="custom-chk select-all-master" onchange="toggleSelectAll(this)" title="Select All" /></th>
              <th>Date</th>
              <th>Client Name</th>
              <th>WhatsApp / Email</th>
              <th>Details & Goals</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($leads)): ?>
              <tr><td colspan="7" style="text-align:center;color:rgba(30,27,23,0.5);padding:32px">No 1:1 Strategy Session bookings recorded yet.</td></tr>
            <?php else: ?>
              <?php foreach ($leads as $l): ?>
                <tr>
                  <td class="select-col"><input type="checkbox" class="lead-chk custom-chk" value="<?php echo $l['id']; ?>" onchange="updateBulkBar()" /></td>
                  <td style="font-size:12.5px;color:rgba(30,27,23,0.55);white-space:nowrap"><?php echo date('M d, Y', strtotime($l['created_at'])); ?></td>
                  <td><strong><?php echo htmlspecialchars($l['name']); ?></strong></td>
                  <td>
                    <div style="font-size:13px"><?php echo htmlspecialchars($l['phone'] ?: 'No Phone'); ?></div>
                    <div style="font-size:12px;color:rgba(30,27,23,0.55)"><?php echo htmlspecialchars($l['email']); ?></div>
                  </td>
                  <td>
                    <div style="font-size:13px;max-width:340px;line-height:1.5;color:rgba(30,27,23,0.85)">
                      <?php echo nl2br(htmlspecialchars($l['message'] ?: '1:1 Session Request')); ?>
                    </div>
                  </td>
                  <td>
                    <span class="status-pill pill-<?php echo $l['status']; ?>"><?php echo htmlspecialchars($l['status']); ?></span>
                  </td>
                  <td>
                    <div style="display:flex;gap:5px">
                      <button onclick="viewLeadModal(<?php echo $l['id']; ?>)" class="btn btn-outline" style="font-size:12px;padding:4px 12px;font-weight:600">View</button>
                      <?php if (!empty($l['phone'])): 
                        $cleanPhone = preg_replace('/[^0-9]/', '', $l['phone']);
                        if (str_starts_with($cleanPhone, '03')) $cleanPhone = '92' . substr($cleanPhone, 1);
                      ?>
                        <a href="https://wa.me/<?php echo $cleanPhone; ?>?text=Salam%20<?php echo urlencode($l['name']); ?>,%20this%20is%20Sania%20Maqsood%20regarding%20your%201:1%20Strategy%20Session%20booking." target="_blank" class="btn-wa-icon" title="Open WhatsApp Chat">
                          <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                        </a>
                      <?php endif; ?>
                      <button onclick="deleteLead(<?php echo $l['id']; ?>)" class="btn btn-outline row-del-btn" style="padding:4px 8px;color:#ff858d;border-color:rgba(255,133,141,0.4)" title="Delete Lead">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <!-- TAB 4: SERVICES INQUIRIES -->
    <?php elseif ($tab === 'services'): ?>
      
      <!-- FILTER BAR -->
      <form method="get" action="index.php" class="filter-bar">
        <input type="hidden" name="tab" value="services" />
        
        <span style="font-size:12.5px;font-weight:700;color:rgba(30,27,23,0.6)">Filter:</span>

        <select name="service" class="filter-select">
          <option value="">All Services</option>
          <?php foreach ($SERVICES_LIST as $sName): ?>
            <option value="<?php echo htmlspecialchars($sName); ?>" <?php echo $filterService === $sName ? 'selected' : ''; ?>><?php echo htmlspecialchars($sName); ?></option>
          <?php endforeach; ?>
        </select>

        <select name="date_range" class="filter-select">
          <option value="all" <?php echo $filterDate === 'all' ? 'selected' : ''; ?>>All Time</option>
          <option value="today" <?php echo $filterDate === 'today' ? 'selected' : ''; ?>>Today</option>
          <option value="yesterday" <?php echo $filterDate === 'yesterday' ? 'selected' : ''; ?>>Yesterday</option>
          <option value="week" <?php echo $filterDate === 'week' ? 'selected' : ''; ?>>This Week (Last 7 Days)</option>
          <option value="15days" <?php echo $filterDate === '15days' ? 'selected' : ''; ?>>Last 15 Days</option>
          <option value="30days" <?php echo $filterDate === '30days' ? 'selected' : ''; ?>>Last 30 Days</option>
        </select>

        <select name="status" class="filter-select">
          <option value="">All Statuses</option>
          <option value="new" <?php echo $filterStatus === 'new' ? 'selected' : ''; ?>>New</option>
          <option value="contacted" <?php echo $filterStatus === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
          <option value="enrolled" <?php echo $filterStatus === 'enrolled' ? 'selected' : ''; ?>>Enrolled (Paid)</option>
          <option value="lost" <?php echo $filterStatus === 'lost' ? 'selected' : ''; ?>>Lost</option>
        </select>

        <select name="instructor" class="filter-select">
          <option value="">All Assignees</option>
          <option value="Sania Maqsood" <?php echo $filterInstructor === 'Sania Maqsood' ? 'selected' : ''; ?>>Sania Maqsood</option>
          <option value="M. Saqib" <?php echo $filterInstructor === 'M. Saqib' ? 'selected' : ''; ?>>M. Saqib</option>
          <option value="Aqib" <?php echo $filterInstructor === 'Aqib' ? 'selected' : ''; ?>>Aqib</option>
        </select>

        <button type="submit" class="btn btn-dark" style="padding:6px 14px;font-size:12.5px">Apply Filters</button>
        <a href="index.php?tab=services" class="btn btn-outline" style="padding:6px 12px;font-size:12.5px">Reset</a>

        <button type="button" id="btnSelectMode" onclick="toggleSelectionMode()" class="btn btn-outline" style="padding:6px 14px;font-size:12.5px;margin-left:auto;display:inline-flex;align-items:center;gap:6px">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><polyline points="9 11 12 14 22 4"></polyline></svg>
          <span>Select</span>
        </button>
      </form>

      <!-- BULK ACTION BAR -->
      <div id="bulkBarServices" class="bulk-bar">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="font-size:13.5px">
            <strong class="selected-count-display">0</strong> leads selected
          </div>
          <button type="button" onclick="selectAllLeads(true)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Select All</button>
          <button type="button" onclick="selectAllLeads(false)" class="btn btn-outline" style="font-size:11.5px;padding:3px 9px;color:#FAF7F2;border-color:rgba(250,247,242,0.3)">Deselect All</button>
        </div>
        <div style="display:flex;align-items:center;gap:10px">
          <select class="filter-select bulk-assign-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="Sania Maqsood">Assign: Sania Maqsood</option>
            <option value="M. Saqib">Assign: M. Saqib</option>
            <option value="Aqib">Assign: Aqib</option>
          </select>
          <button onclick="applyBulkAssign()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Assign</button>

          <select class="filter-select bulk-status-select" style="background:#25221D;color:#FFF;border-color:rgba(250,247,242,0.3);font-size:12px;padding:5px 8px">
            <option value="new">Status: New</option>
            <option value="contacted">Status: Contacted</option>
            <option value="enrolled">Status: Enrolled (Paid)</option>
            <option value="lost">Status: Lost</option>
          </select>
          <button onclick="applyBulkStatus()" class="btn btn-primary" style="padding:5px 12px;font-size:12px">Update</button>

          <button onclick="applyBulkDelete()" class="btn btn-outline" style="padding:5px 12px;font-size:12px;color:#ff858d;border-color:rgba(255,133,141,0.4)">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            Delete Selected
          </button>
        </div>
      </div>
      
      <div class="card table-card-selectable" id="servicesTableCard">
        <table class="table">
          <thead>
            <tr>
              <th class="select-col"><input type="checkbox" class="custom-chk select-all-master" onchange="toggleSelectAll(this)" title="Select All" /></th>
              <th>Date</th>
              <th>Client Name</th>
              <th>Contact Info</th>
              <th>Required Service</th>
              <th>Estimated Budget</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($leads)): ?>
              <tr><td colspan="8" style="text-align:center;color:rgba(30,27,23,0.5);padding:32px">No services inquiries submitted yet.</td></tr>
            <?php else: ?>
              <?php foreach ($leads as $l): ?>
                <tr>
                  <td class="select-col"><input type="checkbox" class="lead-chk custom-chk" value="<?php echo $l['id']; ?>" onchange="updateBulkBar()" /></td>
                  <td style="font-size:12.5px;color:rgba(30,27,23,0.55);white-space:nowrap"><?php echo date('M d, Y', strtotime($l['created_at'])); ?></td>
                  <td><strong><?php echo htmlspecialchars($l['name']); ?></strong></td>
                  <td>
                    <div style="font-size:13px"><?php echo htmlspecialchars($l['phone']); ?></div>
                    <div style="font-size:12px;color:rgba(30,27,23,0.55)"><?php echo htmlspecialchars($l['email']); ?></div>
                  </td>
                  <td>
                    <span style="font-weight:600;color:#1E1B17"><?php echo htmlspecialchars($l['subject_or_item']); ?></span>
                  </td>
                  <td>
                    <span style="font-weight:700;color:#B5794A"><?php echo htmlspecialchars($l['budget'] ?: 'Not Specified'); ?></span>
                  </td>
                  <td>
                    <span class="status-pill pill-<?php echo $l['status']; ?>"><?php echo htmlspecialchars($l['status']); ?></span>
                  </td>
                  <td>
                    <div style="display:flex;gap:5px">
                      <button onclick="viewLeadModal(<?php echo $l['id']; ?>)" class="btn btn-outline" style="font-size:12px;padding:4px 12px;font-weight:600">View</button>
                      <?php if (!empty($l['phone'])): 
                        $cleanPhone = preg_replace('/[^0-9]/', '', $l['phone']);
                        if (str_starts_with($cleanPhone, '03')) $cleanPhone = '92' . substr($cleanPhone, 1);
                      ?>
                        <a href="https://wa.me/<?php echo $cleanPhone; ?>?text=Salam%20<?php echo urlencode($l['name']); ?>,%20this%20is%20Sania%20Maqsood%20regarding%20your%20project%20inquiry%20for%20<?php echo urlencode($l['subject_or_item']); ?>." target="_blank" class="btn-wa-icon" title="Open WhatsApp Chat">
                          <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                        </a>
                      <?php endif; ?>
                      <button onclick="deleteLead(<?php echo $l['id']; ?>)" class="btn btn-outline row-del-btn" style="padding:4px 8px;color:#ff858d;border-color:rgba(255,133,141,0.4)" title="Delete Lead">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <!-- TAB 5: INVOICES & FINANCE -->
    <?php elseif ($tab === 'invoices'): ?>
      
      <div class="stat-grid">
        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Total Collected (PKR)</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#2E7D32;margin-top:6px">PKR <?php echo number_format($totalRevenuePKR); ?></div>
        </div>
        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Pending Receivables (PKR)</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#C62828;margin-top:6px">PKR <?php echo number_format($pendingReceivablesPKR); ?></div>
        </div>
        <div class="card">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">USD Revenue</span>
          <div style="font-family:'Newsreader',Georgia,serif;font-size:32px;color:#1565C0;margin-top:6px">$<?php echo number_format($totalRevenueUSD); ?></div>
        </div>
      </div>

      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div>
            <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">All Issued Invoices</h3>
            <p style="font-size:14px;color:rgba(30,27,23,0.6);margin-top:2px">Generate, track and print official student & client invoices.</p>
          </div>
          <button onclick="openInvoiceModal()" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Generate Invoice
          </button>
        </div>

        <table class="table" style="margin-top:20px">
          <thead>
            <tr>
              <th>Invoice #</th>
              <th>Client / Student</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Payment Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($invoices)): ?>
              <tr><td colspan="6" style="text-align:center;color:rgba(30,27,23,0.5);padding:32px">No invoices generated yet. Click "+ Generate Invoice" to create one.</td></tr>
            <?php else: ?>
              <?php foreach ($invoices as $inv): ?>
                <tr>
                  <td>
                    <a href="invoice-view.php?id=<?php echo $inv['id']; ?>" target="_blank" style="font-weight:700;color:#8A5A34;text-decoration:none;display:inline-flex;align-items:center;gap:4px">
                      #<?php echo htmlspecialchars($inv['invoice_number']); ?>
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    </a>
                  </td>
                  <td>
                    <strong><?php echo htmlspecialchars($inv['client_name']); ?></strong>
                    <div style="font-size:12px;color:rgba(30,27,23,0.55)"><?php echo htmlspecialchars($inv['client_phone'] ?: $inv['client_email']); ?></div>
                  </td>
                  <td><?php echo htmlspecialchars($inv['title']); ?></td>
                  <td>
                    <strong><?php echo htmlspecialchars($inv['currency'] . ' ' . number_format($inv['total_amount'])); ?></strong>
                  </td>
                  <td>
                    <select onchange="updateInvoiceStatus(<?php echo $inv['id']; ?>, this.value, <?php echo $inv['total_amount']; ?>)" style="padding:4px 8px;border-radius:6px;border:1px solid #D9CDB6;font-size:12.5px;font-weight:600;background:#FAF7F2">
                      <option value="unpaid" <?php echo $inv['status'] === 'unpaid' ? 'selected' : ''; ?>>Unpaid</option>
                      <option value="partially_paid" <?php echo $inv['status'] === 'partially_paid' ? 'selected' : ''; ?>>Partially Paid</option>
                      <option value="paid" <?php echo $inv['status'] === 'paid' ? 'selected' : ''; ?>>Paid in Full</option>
                      <option value="cancelled" <?php echo $inv['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                  </td>
                  <td>
                    <div style="display:flex;gap:5px">
                      <a href="invoice-view.php?id=<?php echo $inv['id']; ?>" target="_blank" class="btn btn-outline" style="font-size:12px;padding:4px 12px;font-weight:600">View</a>
                      <button onclick="deleteInvoice(<?php echo $inv['id']; ?>)" class="btn btn-outline" style="padding:4px 8px;color:#ff858d;border-color:rgba(255,133,141,0.4)" title="Delete Invoice">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <!-- TAB 6: EMAIL MARKETING -->
    <?php elseif ($tab === 'email'): ?>
      
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(450px,100%),1fr));gap:24px">
        <div class="card">
          <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
              <h3 style="font-family:'Newsreader',Georgia,serif;font-size:20px;color:#1E1B17">Subscribers (<?php echo count($subscribers); ?>)</h3>
              <p style="font-size:13.5px;color:rgba(30,27,23,0.6)">Readers subscribed to The Sunday Note.</p>
            </div>
            <button onclick="openBroadcastModal()" class="btn btn-primary">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
              Write Broadcast
            </button>
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Source</th>
                <th>Joined</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($subscribers)): ?>
                <tr><td colspan="4" style="text-align:center;color:rgba(30,27,23,0.5);padding:24px">No subscribers yet.</td></tr>
              <?php else: ?>
                <?php foreach ($subscribers as $s): ?>
                  <tr>
                    <td><strong><?php echo htmlspecialchars($s['name'] ?: 'Reader'); ?></strong></td>
                    <td><?php echo htmlspecialchars($s['email']); ?></td>
                    <td><span class="status-pill pill-new"><?php echo htmlspecialchars($s['source']); ?></span></td>
                    <td style="font-size:12px;color:rgba(30,27,23,0.5)"><?php echo date('M d, Y', strtotime($s['created_at'])); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div class="card">
          <h3 style="font-family:'Newsreader',Georgia,serif;font-size:20px;color:#1E1B17">Broadcast History</h3>
          <p style="font-size:13.5px;color:rgba(30,27,23,0.6)">Past newsletters sent to your list.</p>

          <div style="margin-top:16px;display:flex;flex-direction:column;gap:12px">
            <?php if (empty($broadcasts)): ?>
              <div style="text-align:center;color:rgba(30,27,23,0.5);padding:32px">No email broadcasts sent yet.</div>
            <?php else: ?>
              <?php foreach ($broadcasts as $b): ?>
                <div style="background:#FAF7F2;border:1px solid #EDE4D3;border-radius:12px;padding:16px">
                  <div style="display:flex;justify-content:space-between;align-items:baseline">
                    <strong style="font-size:15px;color:#1E1B17"><?php echo htmlspecialchars($b['subject']); ?></strong>
                    <span style="font-size:12px;color:rgba(30,27,23,0.5)"><?php echo date('M d, Y', strtotime($b['created_at'])); ?></span>
                  </div>
                  <p style="font-size:13.5px;color:rgba(30,27,23,0.7);margin-top:6px"><?php echo htmlspecialchars(mb_substr($b['body'], 0, 120)) . '...'; ?></p>
                  <div style="font-size:12px;color:#4C7A5E;margin-top:8px">Sent to <?php echo $b['recipient_count']; ?> recipients by <?php echo htmlspecialchars($b['sent_by']); ?></div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

    <?php endif; ?>

  </div>
</main>

<!-- LEAD VIEW & EDIT MODAL -->
<div id="leadModal" class="modal-overlay">
  <div class="modal-box" style="max-width:680px">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;padding-bottom:14px;border-bottom:1.5px solid #EDE4D3">
      <div>
        <div style="display:flex;align-items:center;gap:10px">
          <h3 id="modalLeadName" style="font-family:'Newsreader',Georgia,serif;font-size:24px;color:#1E1B17">Lead Details</h3>
          <span id="modalLeadTypeBadge" class="status-pill pill-new" style="font-size:11px">COURSE</span>
        </div>
        <span id="modalLeadDate" style="font-size:12.5px;color:rgba(30,27,23,0.5);margin-top:3px;display:block"></span>
      </div>
      <button onclick="closeLeadModal()" style="background:none;border:none;font-size:26px;cursor:pointer;color:rgba(30,27,23,0.4);line-height:1">&times;</button>
    </div>

    <form id="leadEditForm" onsubmit="handleSaveLead(event)" style="display:flex;flex-direction:column;gap:16px">
      <input type="hidden" id="modalLeadId" name="id" />

      <!-- DYNAMIC STRUCTURED FORM DATA CONTAINER -->
      <div id="modalStructuredContent" style="display:flex;flex-direction:column;gap:12px"></div>

      <!-- FEE & PAYMENT SETTLEMENT (ORIGINAL, DISCOUNT/AGREED, PAID, PENDING) -->
      <div id="modalPaymentSettlementSection" style="background:#FAF7F2;border:1.5px solid #E2D9C9;border-radius:14px;padding:16px;display:flex;flex-direction:column;gap:12px">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
          <span style="font-size:12px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#8A5A34;display:flex;align-items:center;gap:6px">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
            Fee & Payment Settlement
          </span>
          <span id="modalOriginalFeeBadge" style="font-size:12px;font-weight:600;color:rgba(30,27,23,0.6);background:#FFF;padding:3px 10px;border-radius:6px;border:1px solid #D9CDB6">Original: PKR 0</span>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div>
            <label style="font-size:11.5px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
              Agreed / Final Fee (<span id="modalCurrencyLabel">PKR</span>)
            </label>
            <input type="number" id="modalAgreedFee" name="agreed_fee" step="any" min="0" oninput="calcPendingBalance()" class="form-control" style="background:#FFF;font-weight:700;color:#1E1B17" placeholder="Agreed amount..." />
            <span style="font-size:11px;color:rgba(30,27,23,0.5);margin-top:3px;display:block">Enter discounted / revised total</span>
          </div>

          <div>
            <label style="font-size:11.5px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
              Paid Amount Received
            </label>
            <input type="number" id="modalPaidAmount" name="paid_amount" step="any" min="0" oninput="calcPendingBalance()" class="form-control" style="background:#FFF;font-weight:700;color:#2E7D32" placeholder="Amount paid..." />
            <span style="font-size:11px;color:rgba(30,27,23,0.5);margin-top:3px;display:block">For partial payment, enter received amount</span>
          </div>
        </div>

        <div id="modalDueDateRow" style="display:grid;grid-template-columns:1fr;gap:14px">
          <div>
            <label style="font-size:11.5px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
              Next Pending Payment Due Date
            </label>
            <input type="date" id="modalDueDate" name="due_date" class="form-control" style="background:#FFF;font-weight:600;color:#1E1B17" />
            <span style="font-size:11px;color:rgba(30,27,23,0.5);margin-top:3px;display:block">Follow-up target date to collect remaining balance</span>
          </div>
        </div>

        <div id="modalPendingBalanceBox" style="background:#FFF;border:1px solid #E2D9C9;border-radius:10px;padding:10px 14px;display:flex;justify-content:space-between;align-items:center;font-size:13px">
          <span style="color:rgba(30,27,23,0.6);font-weight:600">Settlement Status:</span>
          <strong id="modalPendingBalanceText" style="color:#2E7D32">PKR 0 Pending (Paid in Full)</strong>
        </div>
      </div>

      <!-- INSTRUCTOR ASSIGNMENT & STATUS -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;padding-top:8px;border-top:1px dashed #D9CDB6">
        <div>
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);display:block;margin-bottom:6px">Assign Instructor</label>
          <select id="modalLeadAssigned" name="assigned_to" class="form-control" style="background:#FFF">
            <option value="Sania Maqsood">Sania Maqsood</option>
            <option value="M. Saqib">M. Saqib</option>
            <option value="Aqib">Aqib</option>
          </select>
        </div>
        <div>
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);display:block;margin-bottom:6px">Lead Status</label>
          <select id="modalLeadStatus" name="status" class="form-control" style="background:#FFF">
            <option value="new">New</option>
            <option value="contacted">Contacted</option>
            <option value="enrolled">Enrolled (Paid)</option>
            <option value="in_progress">Proposal / In Progress</option>
            <option value="completed">Completed</option>
            <option value="lost">Lost</option>
          </select>
        </div>
      </div>

      <div>
        <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);display:block;margin-bottom:6px">Internal Admin Notes</label>
        <textarea id="modalLeadNotes" name="notes" rows="3" placeholder="Add follow-up notes, discussion summary, or batch schedule..." class="form-control" style="height:auto;padding:10px 14px;background:#FFF"></textarea>
      </div>

      <div style="display:flex;gap:10px;margin-top:6px">
        <button type="submit" class="btn btn-primary" style="flex:1;height:46px;font-size:14px">Save Changes</button>
        <button type="button" onclick="closeLeadModal()" class="btn btn-outline" style="height:46px;font-size:14px;padding:0 24px">Close</button>
      </div>
    </form>
  </div>
</div>

<!-- CREATE INVOICE MODAL -->
<div id="invoiceModal" class="modal-overlay">
  <div class="modal-box">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
      <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">Generate New Invoice</h3>
      <button onclick="closeInvoiceModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:rgba(30,27,23,0.5)">&times;</button>
    </div>

    <form id="invoiceForm" onsubmit="handleCreateInvoice(event)" style="display:flex;flex-direction:column;gap:14px">
      <div>
        <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Client / Student Name *</label>
        <input type="text" name="client_name" required placeholder="e.g. Sana Malik" class="form-control" />
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Phone / WhatsApp</label>
          <input type="tel" name="client_phone" placeholder="03xx xxxxxxx" class="form-control" />
        </div>
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Email</label>
          <input type="email" name="client_email" placeholder="client@email.com" class="form-control" />
        </div>
      </div>

      <div>
        <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Item / Course Title *</label>
        <input type="text" name="title" required placeholder="e.g. Pinterest Affiliate Marketing Course Fee" class="form-control" />
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Currency</label>
          <select name="currency" class="form-control">
            <option value="PKR">PKR (Pakistani Rupee)</option>
            <option value="USD">USD (US Dollar)</option>
          </select>
        </div>
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Total Amount *</label>
          <input type="number" name="total_amount" required placeholder="15000" class="form-control" />
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Payment Method</label>
          <select name="payment_method" class="form-control">
            <option value="Bank Transfer">Bank Transfer / Raast</option>
            <option value="JazzCash">JazzCash</option>
            <option value="EasyPaisa">EasyPaisa</option>
            <option value="Cash">Cash</option>
            <option value="Stripe">Stripe</option>
          </select>
        </div>
        <div>
          <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Initial Status</label>
          <select name="status" class="form-control">
            <option value="unpaid">Unpaid (Pending)</option>
            <option value="paid">Paid in Full</option>
          </select>
        </div>
      </div>

      <div>
        <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Notes / Special Instructions</label>
        <textarea name="notes" rows="2" placeholder="Batch starts Monday at 9 PM PKT..." class="form-control" style="height:auto;padding:10px 14px"></textarea>
      </div>

      <button type="submit" class="btn btn-primary" style="height:46px;margin-top:8px">Generate Invoice →</button>
    </form>
  </div>
</div>

<!-- RECORD INSTALLMENT / PAYMENT MODAL -->
<div id="collectPaymentModal" class="modal-overlay">
  <div class="modal-box" style="max-width:540px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
      <div>
        <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">Record Installment / Payment</h3>
        <p style="font-size:13px;color:rgba(30,27,23,0.55);margin-top:2px" id="collectModalSubheading">Add new received payment entry for student / client.</p>
      </div>
      <button onclick="closeCollectPaymentModal()" style="background:none;border:none;font-size:26px;cursor:pointer;color:rgba(30,27,23,0.4);line-height:1">&times;</button>
    </div>

    <!-- SUMMARY BREAKDOWN CARD -->
    <div style="background:#FAF7F2;border:1.5px solid #E2D9C9;border-radius:14px;padding:14px 16px;margin-bottom:18px;display:flex;flex-direction:column;gap:8px">
      <div style="display:flex;justify-content:space-between;align-items:center">
        <span id="collectModalClientName" style="font-size:15px;font-weight:700;color:#1E1B17">Client Name</span>
        <span id="collectModalCourseTitle" style="font-size:12.5px;color:#8A5A34;font-weight:600">Course / Service</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;padding-top:8px;border-top:1px dashed #D9CDB6;font-size:12px">
        <div>
          <span style="color:rgba(30,27,23,0.5);display:block">Agreed Total:</span>
          <strong id="collectModalTotal" style="color:#1E1B17;font-size:13.5px">PKR 0</strong>
        </div>
        <div>
          <span style="color:rgba(30,27,23,0.5);display:block">Paid So Far:</span>
          <strong id="collectModalPaid" style="color:#2E7D32;font-size:13.5px">PKR 0</strong>
        </div>
        <div>
          <span style="color:rgba(30,27,23,0.5);display:block">Pending:</span>
          <strong id="collectModalPending" style="color:#C62828;font-size:13.5px">PKR 0</strong>
        </div>
      </div>
    </div>

    <form id="collectPaymentForm" onsubmit="handleRecordPaymentSubmit(event)" style="display:flex;flex-direction:column;gap:14px">
      <input type="hidden" id="collectModalInvoiceId" name="invoice_id" />
      <input type="hidden" id="collectModalCurrency" name="currency" value="PKR" />
      <input type="hidden" id="collectModalPendingRaw" value="0" />

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div>
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
            Amount Received (<span id="collectModalCurLabel">PKR</span>) *
          </label>
          <input type="number" id="collectModalAmountInput" name="payment_amount" step="any" min="1" required class="form-control" style="background:#FFF;font-weight:700;color:#2E7D32" placeholder="e.g. 5000" oninput="calcCollectPending()" />
        </div>
        <div>
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
            Payment Method
          </label>
          <select name="payment_method" class="form-control" style="background:#FFF">
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="JazzCash">JazzCash</option>
            <option value="EasyPaisa">EasyPaisa</option>
            <option value="Nayapay / Sadapay">Nayapay / Sadapay</option>
            <option value="Cash">Cash In Hand</option>
            <option value="Online / Card">Online / Card</option>
          </select>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div>
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
            Payment Date
          </label>
          <input type="date" name="payment_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" style="background:#FFF" />
        </div>
        <div id="collectModalNextDueRow">
          <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
            Next Remaining Due Date
          </label>
          <input type="date" id="collectModalNextDueDate" name="next_due_date" class="form-control" style="background:#FFF" />
        </div>
      </div>

      <div id="collectModalStatusAlert" style="background:#E8F5E9;border:1px solid #C8E6C9;border-radius:10px;padding:10px 14px;font-size:13px;color:#2E7D32;font-weight:600;display:flex;align-items:center;gap:6px">
        ✓ This entry will complete the full payment!
      </div>

      <div>
        <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">
          Transaction Remarks / Notes
        </label>
        <input type="text" name="remarks" placeholder="e.g. 2nd Installment received via Bank Transfer" class="form-control" style="background:#FFF" />
      </div>

      <div style="display:flex;gap:10px;margin-top:6px">
        <button type="submit" class="btn btn-primary" style="flex:1;height:46px;font-size:14px;background:#2E7D32">Confirm & Save Payment Entry</button>
        <button type="button" onclick="closeCollectPaymentModal()" class="btn btn-outline" style="height:46px;font-size:14px;padding:0 24px">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- EMAIL BROADCAST MODAL -->
<div id="broadcastModal" class="modal-overlay">
  <div class="modal-box">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
      <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">Compose Sunday Note Broadcast</h3>
      <button onclick="closeBroadcastModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:rgba(30,27,23,0.5)">&times;</button>
    </div>

    <form id="broadcastForm" onsubmit="handleSendBroadcast(event)" style="display:flex;flex-direction:column;gap:14px">
      <div>
        <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Email Subject Line *</label>
        <input type="text" name="subject" required placeholder="The Sunday Note #42: One change that doubled conversion" class="form-control" />
      </div>

      <div>
        <label style="font-size:12.5px;font-weight:600;color:rgba(30,27,23,0.6)">Newsletter Content *</label>
        <textarea name="body" required rows="8" placeholder="Write your weekly tactic, teardown, and notes here..." class="form-control" style="height:auto;padding:12px 14px"></textarea>
      </div>

      <div style="font-size:12px;color:rgba(30,27,23,0.5)">
        This broadcast will be dispatched to all <?php echo $totalSubs; ?> active subscribers on your list.
      </div>

      <button type="submit" class="btn btn-primary" style="height:46px;margin-top:8px">Dispatch Broadcast to Readers →</button>
    </form>
  </div>
</div>

<!-- CHANGE PASSWORD MODAL -->
<div id="changePasswordModal" class="modal-overlay">
  <div class="modal-box" style="max-width:440px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
      <div>
        <h3 style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">Change Password</h3>
        <p style="font-size:13px;color:rgba(30,27,23,0.55);margin-top:2px">Update your admin login password securely.</p>
      </div>
      <button onclick="closeChangePasswordModal()" style="background:none;border:none;font-size:26px;cursor:pointer;color:rgba(30,27,23,0.4);line-height:1">&times;</button>
    </div>

    <form id="changePasswordForm" onsubmit="handleChangePassword(event)" style="display:flex;flex-direction:column;gap:14px">
      <div>
        <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">Current Password *</label>
        <input type="password" name="current_password" required placeholder="Enter current password" class="form-control" style="background:#FFF" />
      </div>

      <div>
        <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">New Password (Min 6 Chars) *</label>
        <input type="password" name="new_password" required minlength="6" placeholder="Enter new password" class="form-control" style="background:#FFF" />
      </div>

      <div>
        <label style="font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.7);display:block;margin-bottom:4px">Confirm New Password *</label>
        <input type="password" name="confirm_password" required minlength="6" placeholder="Confirm new password" class="form-control" style="background:#FFF" />
      </div>

      <div style="display:flex;gap:10px;margin-top:8px">
        <button type="submit" class="btn btn-primary" style="flex:1;height:44px;font-size:14px">Update Password</button>
        <button type="button" onclick="closeChangePasswordModal()" class="btn btn-outline" style="height:44px;font-size:14px;padding:0 20px">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- IMAGE LIGHTBOX / POPUP MODAL -->
<div id="imageLightboxModal" class="modal-overlay" onclick="closeImageLightbox(event)" style="z-index:999999;background:rgba(20,17,14,0.88);backdrop-filter:blur(6px);display:none;align-items:center;justify-content:center;padding:20px;position:fixed;inset:0">
  <div style="position:relative;max-width:92vw;max-height:90vh;display:flex;flex-direction:column;align-items:center" onclick="event.stopPropagation()">
    <div style="display:flex;justify-content:space-between;align-items:center;width:100%;margin-bottom:12px;color:#FAF7F2">
      <span id="lightboxTitle" style="font-size:14px;font-weight:600;letter-spacing:0.02em;color:#EDE4D3">Payment Proof</span>
      <div style="display:flex;align-items:center;gap:10px">
        <a id="lightboxDownloadBtn" href="#" download class="btn btn-outline" style="height:34px;padding:0 12px;font-size:12px;background:rgba(250,247,242,0.15);color:#FAF7F2;border-color:rgba(250,247,242,0.3);display:inline-flex;align-items:center;gap:6px;text-decoration:none" title="Download Image">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-1px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
          <span>Download</span>
        </a>
        <button type="button" onclick="closeImageLightbox()" style="background:rgba(250,247,242,0.2);border:none;color:#FAF7F2;width:34px;height:34px;border-radius:50%;cursor:pointer;font-size:20px;display:flex;align-items:center;justify-content:center;line-height:1">&times;</button>
      </div>
    </div>
    <img id="lightboxImg" src="" alt="Payment Proof" style="max-width:90vw;max-height:80vh;object-fit:contain;border-radius:12px;box-shadow:0 24px 60px rgba(0,0,0,0.6);border:1px solid rgba(250,247,242,0.2);background:#1E1B17" />
  </div>
</div>

<script>
// Modal Controls
function openInvoiceModal() { document.getElementById('invoiceModal').classList.add('open'); }
function closeInvoiceModal() { document.getElementById('invoiceModal').classList.remove('open'); }
function openBroadcastModal() { document.getElementById('broadcastModal').classList.add('open'); }
function closeBroadcastModal() { document.getElementById('broadcastModal').classList.remove('open'); }
function closeLeadModal() { document.getElementById('leadModal').classList.remove('open'); }
function openChangePasswordModal() { document.getElementById('changePasswordForm').reset(); document.getElementById('changePasswordModal').classList.add('open'); }
function closeChangePasswordModal() { document.getElementById('changePasswordModal').classList.remove('open'); }

function openImageLightbox(imgUrl, filename) {
  const modal = document.getElementById('imageLightboxModal');
  const img = document.getElementById('lightboxImg');
  const title = document.getElementById('lightboxTitle');
  const dlBtn = document.getElementById('lightboxDownloadBtn');
  if (modal && img) {
    img.src = imgUrl;
    title.innerText = filename || 'Payment Proof Screenshot';
    dlBtn.href = imgUrl;
    dlBtn.download = filename || 'payment_proof.jpg';
    modal.style.display = 'flex';
  }
}

function closeImageLightbox(e) {
  if (e && e.target && e.target.id !== 'imageLightboxModal' && !e.target.closest('button')) return;
  const modal = document.getElementById('imageLightboxModal');
  if (modal) modal.style.display = 'none';
}

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeImageLightbox();
  }
});

// View Lead Modal with Structured Form Fields
const ICONS = {
  card: `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>`,
  calendar: `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>`,
  paperclip: `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>`,
  eye: `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`,
  download: `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-1px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>`,
  extLink: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-1px"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>`,
  wa: `<svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor" style="vertical-align:-2px"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>`
};

async function viewLeadModal(id) {
  const res = await fetch('api.php?action=get_lead&id=' + id);
  const data = await res.json();
  if (data.ok && data.lead) {
    const l = data.lead;
    let meta = {};
    try { meta = JSON.parse(l.meta_json || '{}'); } catch(e) {}

    document.getElementById('modalLeadId').value = l.id;
    document.getElementById('modalLeadName').innerText = l.name;
    document.getElementById('modalLeadDate').innerText = 'Submitted on ' + l.created_at + (l.ip_address ? ' · IP: ' + l.ip_address : '');
    
    // Type badge
    const badgeEl = document.getElementById('modalLeadTypeBadge');
    if (l.type === 'course') {
      badgeEl.innerText = 'Live Course Batch';
      badgeEl.className = 'status-pill pill-new';
    } else if (l.type === 'consulting') {
      badgeEl.innerText = '1:1 Session Booking';
      badgeEl.className = 'status-pill pill-in_progress';
    } else if (l.type === 'service') {
      badgeEl.innerText = 'Services Project';
      badgeEl.className = 'status-pill pill-enrolled';
    } else {
      badgeEl.innerText = 'Contact Inquiry';
      badgeEl.className = 'status-pill pill-new';
    }

    // WhatsApp clean link
    let cleanPhone = (l.phone || '').replace(/[^0-9]/g, '');
    if (cleanPhone.startsWith('03')) cleanPhone = '92' + cleanPhone.substring(1);

    // Build structured fields HTML
    let html = `
      <div style="background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px">
        <div>
          <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Student / Client Name</span>
          <strong style="font-size:15px;color:#1E1B17">${l.name}</strong>
        </div>
        <div>
          <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">WhatsApp / Phone</span>
          <div style="display:flex;align-items:center;gap:8px;margin-top:2px">
            <strong style="font-size:14.5px;color:#1E1B17">${l.phone || 'None'}</strong>
            ${cleanPhone ? `<a href="https://wa.me/${cleanPhone}" target="_blank" class="btn btn-wa">${ICONS.wa} <span>Chat on WhatsApp</span></a>` : ''}
          </div>
        </div>
        <div style="grid-column:1/-1">
          <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Email Address</span>
          <a href="mailto:${l.email}" style="color:#8A5A34;font-size:14px;text-decoration:none;font-weight:600">${l.email || 'None'}</a>
        </div>
      </div>
    `;

    // Category specific form fields
    if (l.type === 'course') {
      const paymentOpt = meta.payment_option || meta.payment_method || (l.message && l.message.includes('Payment:') ? l.message.split('Payment:')[1].trim() : 'Bank Transfer');
      html += `
        <div style="background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px">
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Enrolled Course</span>
            <strong style="font-size:16px;color:#B5794A">${l.subject_or_item || 'Live Course'}</strong>
          </div>
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Course Fee</span>
            <strong style="font-size:16px;color:#2E7D32">${l.budget || 'PKR 10,000'}</strong>
          </div>
          <div style="grid-column:1/-1">
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Selected Payment Option</span>
            <span style="display:inline-flex;align-items:center;gap:6px;margin-top:3px;background:#FFF;border:1px solid #D9CDB6;padding:5px 14px;border-radius:8px;font-size:13.5px;font-weight:600;color:#1E1B17">
              ${ICONS.card} <span>${paymentOpt}</span>
            </span>
          </div>
        </div>
      `;
    } else if (l.type === 'consulting') {
      const screenshotUrl = meta.screenshot_url || '';
      const screenshotName = meta.screenshot_name || meta.screenshot || '';
      const payMethod = meta.method || meta.payment_method || 'Online Transfer';
      const txnId = meta.txn || '';
      const proofLink = screenshotUrl || ('api.php?action=view_proof&id=' + l.id + '&name=' + encodeURIComponent(screenshotName));

      html += `
        <div style="background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px">
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Session Focus & Type</span>
            <strong style="font-size:15px;color:#B5794A">${l.subject_or_item || '1:1 Strategy Session'}</strong>
          </div>
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Consulting Fee</span>
            <strong style="font-size:15px;color:#2E7D32">${meta.amount || l.budget || 'PKR 1,000'}</strong>
          </div>
          ${meta.stage ? `<div><span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Current Business Stage</span><span style="font-size:13.5px;font-weight:600">${meta.stage}</span></div>` : ''}
          ${meta.revenue ? `<div><span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Current Monthly Income</span><span style="font-size:13.5px;font-weight:600">${meta.revenue}</span></div>` : ''}
          ${meta.preferred_date ? `<div style="grid-column:1/-1"><span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Requested Schedule Date & Time</span><span style="font-size:13.5px;font-weight:600;display:inline-flex;align-items:center;gap:6px">${ICONS.calendar} <span>${meta.preferred_date} · ${meta.preferred_time || ''}</span></span></div>` : ''}
          
          <!-- PAYMENT VERIFICATION & SCREENSHOT BOX -->
          <div style="grid-column:1/-1;background:#FFF;border:1.5px solid #D9CDB6;border-radius:12px;padding:14px 16px;display:flex;flex-direction:column;gap:10px">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
              <span style="font-size:11.5px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#8A5A34;display:inline-flex;align-items:center;gap:6px">
                ${ICONS.card} <span>Payment Verification</span>
              </span>
              <span style="font-size:13px;font-weight:700;color:#2E7D32;background:#E8F5E9;padding:3px 10px;border-radius:6px;border:1px solid #C8E6C9">${payMethod} · ${meta.amount || l.budget || 'PKR 1,000'}</span>
            </div>
            ${txnId ? `<div style="font-size:13px;color:#1E1B17"><strong>Transaction ID:</strong> <code style="background:#FAF7F2;padding:3px 8px;border-radius:6px;border:1px solid #E2D9C9;font-weight:600">${txnId}</code></div>` : ''}
            <div>
              <span style="font-size:11px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.5);display:block;margin-bottom:6px">Attached Payment Proof / Screenshot</span>
              ${(screenshotUrl || screenshotName) ? `
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
                  <button type="button" onclick="${screenshotUrl ? `openImageLightbox('${screenshotUrl}', '${screenshotName}')` : `window.open('${proofLink}', '_blank')`}" class="btn btn-primary" style="height:38px;font-size:13px;padding:0 18px;display:inline-flex;align-items:center;gap:7px;cursor:pointer">
                    ${ICONS.eye} <span>View Proof</span>
                  </button>
                  ${screenshotUrl ? `
                    <a href="${screenshotUrl}" download="${screenshotName || 'payment_proof'}" class="btn btn-outline" style="width:38px;height:38px;padding:0;display:inline-flex;align-items:center;justify-content:center;background:#FFF;border:1px solid #D9CDB6;border-radius:10px;text-decoration:none;color:#1E1B17" title="Download Screenshot">
                      ${ICONS.download}
                    </a>
                  ` : ''}
                </div>
              ` : `
                <span style="font-size:12.5px;color:rgba(30,27,23,0.5);font-style:italic">No payment screenshot attached by client</span>
              `}
            </div>
          </div>

          <div style="grid-column:1/-1">
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Goal / What's Stuck</span>
            <div style="margin-top:4px;font-size:13.5px;line-height:1.6;color:#1E1B17;background:#FFF;padding:10px 14px;border-radius:8px;border:1px solid #EDE4D3">${meta.goal || l.message || '1:1 Session Request'}</div>
          </div>
        </div>
      `;
    } else if (l.type === 'service') {
      html += `
        <div style="background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px">
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Primary Service Needed</span>
            <strong style="font-size:15px;color:#B5794A">${l.subject_or_item || 'Client Service'}</strong>
          </div>
          <div>
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Estimated Budget Range</span>
            <strong style="font-size:15px;color:#2E7D32">${l.budget || 'Not specified'}</strong>
          </div>
          <div style="grid-column:1/-1">
            <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Project Scope & Brief</span>
            <div style="margin-top:4px;font-size:13.5px;line-height:1.6;color:#1E1B17;background:#FFF;padding:10px 14px;border-radius:8px;border:1px solid #EDE4D3;white-space:pre-wrap">${l.message || 'No project description provided.'}</div>
          </div>
        </div>
      `;
    } else {
      html += `
        <div style="background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:16px">
          <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Topic / Subject</span>
          <strong style="font-size:15px;color:#B5794A">${l.subject_or_item || 'General Question'}</strong>
          <span style="display:block;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5);margin-top:12px">Message</span>
          <div style="margin-top:4px;font-size:13.5px;line-height:1.6;color:#1E1B17;background:#FFF;padding:10px 14px;border-radius:8px;border:1px solid #EDE4D3;white-space:pre-wrap">${l.message || 'No message provided.'}</div>
        </div>
      `;
    }

    document.getElementById('modalStructuredContent').innerHTML = html;
    document.getElementById('modalLeadAssigned').value = l.assigned_to || 'Sania Maqsood';
    document.getElementById('modalLeadStatus').value = l.status || 'new';
    document.getElementById('modalLeadNotes').value = l.notes || '';

    // Parse currency & default amount from lead budget
    let cur = 'PKR';
    let budgetStr = l.budget || '';
    let parsedOriginal = 0;
    if (budgetStr.includes('$') || budgetStr.toLowerCase().includes('usd')) {
      cur = 'USD';
      let m = budgetStr.match(/[\d,]+(\.\d+)?/);
      parsedOriginal = m ? parseFloat(m[0].replace(/,/g, '')) : 200;
    } else {
      cur = 'PKR';
      let m = budgetStr.match(/[\d,]+(\.\d+)?/);
      parsedOriginal = m ? parseFloat(m[0].replace(/,/g, '')) : (l.type === 'course' ? 15000 : (l.type === 'consulting' ? 1000 : 5000));
    }
    if (parsedOriginal <= 0) parsedOriginal = (cur === 'USD' ? 200 : 10000);

    document.getElementById('modalCurrencyLabel').innerText = cur;
    document.getElementById('modalOriginalFeeBadge').innerText = 'Original: ' + (cur === 'USD' ? '$' : 'PKR ') + Number(parsedOriginal).toLocaleString();

    let agreedVal = (meta.agreed_fee !== undefined && meta.agreed_fee !== null && meta.agreed_fee !== '') ? parseFloat(meta.agreed_fee) : parsedOriginal;
    let paidVal = (meta.paid_amount !== undefined && meta.paid_amount !== null && meta.paid_amount !== '') ? parseFloat(meta.paid_amount) : ((l.status === 'enrolled' || l.status === 'completed') ? agreedVal : 0);

    document.getElementById('modalAgreedFee').value = agreedVal;
    document.getElementById('modalPaidAmount').value = paidVal;
    document.getElementById('modalDueDate').value = meta.due_date || '';
    calcPendingBalance();

    document.getElementById('leadModal').classList.add('open');
  } else {
    alert(data.error || 'Could not load lead details');
  }
}

// Live calculation of pending balance & settlement status in lead modal
function calcPendingBalance() {
  const cur = document.getElementById('modalCurrencyLabel').innerText || 'PKR';
  const agreed = parseFloat(document.getElementById('modalAgreedFee').value) || 0;
  const paid = parseFloat(document.getElementById('modalPaidAmount').value) || 0;
  const pending = Math.max(0, agreed - paid);
  const textEl = document.getElementById('modalPendingBalanceText');
  const dueDateRow = document.getElementById('modalDueDateRow');
  const sym = cur === 'USD' ? '$' : 'PKR ';

  if (dueDateRow) {
    dueDateRow.style.display = pending > 0 ? 'grid' : 'none';
  }

  if (agreed === 0 && paid === 0) {
    textEl.style.color = 'rgba(30,27,23,0.6)';
    textEl.innerText = sym + '0 Pending';
  } else if (pending <= 0) {
    textEl.style.color = '#2E7D32';
    textEl.innerText = '✓ ' + sym + '0 Balance (Paid in Full)';
  } else if (paid > 0) {
    textEl.style.color = '#E65100';
    textEl.innerText = '⏳ ' + sym + Number(pending).toLocaleString() + ' Pending (Partial Payment)';
  } else {
    textEl.style.color = '#C62828';
    textEl.innerText = '✕ ' + sym + Number(pending).toLocaleString() + ' Pending (Unpaid)';
  }
}

// Save Lead Details Form
async function handleSaveLead(e) {
  e.preventDefault();
  const fd = new FormData(e.target);
  fd.append('action', 'save_lead');
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) {
    location.reload();
  } else {
    alert(data.error || 'Failed to save lead');
  }
}

// Selection Mode Toggle & Bulk Actions
let isSelectionMode = false;

function toggleSelectionMode() {
  isSelectionMode = !isSelectionMode;
  const cards = document.querySelectorAll('.table-card-selectable');
  const btn = document.getElementById('btnSelectMode');
  const masterChks = document.querySelectorAll('.select-all-master');
  
  if (isSelectionMode) {
    cards.forEach(c => c.classList.add('selection-mode'));
    if (btn) {
      btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> <span>Cancel Selection</span>`;
      btn.classList.remove('btn-outline');
      btn.classList.add('btn-dark');
    }
    updateBulkBar();
  } else {
    cards.forEach(c => c.classList.remove('selection-mode'));
    if (btn) {
      btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><polyline points="9 11 12 14 22 4"></polyline></svg> <span>Select</span>`;
      btn.classList.remove('btn-dark');
      btn.classList.add('btn-outline');
    }
    selectAllLeads(false);
    masterChks.forEach(m => m.checked = false);
    const allBulkBars = document.querySelectorAll('.bulk-bar');
    allBulkBars.forEach(b => b.classList.remove('visible'));
  }
}

function selectAllLeads(val) {
  const chks = document.querySelectorAll('.lead-chk');
  chks.forEach(c => c.checked = val);
  const masterChks = document.querySelectorAll('.select-all-master');
  masterChks.forEach(m => m.checked = val);
  updateBulkBar();
}

function getSelectedLeadIds() {
  const chks = document.querySelectorAll('.lead-chk:checked');
  return Array.from(chks).map(c => parseInt(c.value));
}

function updateBulkBar() {
  const ids = getSelectedLeadIds();
  const bulkBars = document.querySelectorAll('.bulk-bar');
  const countEls = document.querySelectorAll('.selected-count-display');
  countEls.forEach(el => el.innerText = ids.length);
  bulkBars.forEach(bar => {
    if (isSelectionMode && ids.length > 0) {
      bar.classList.add('visible');
    } else {
      bar.classList.remove('visible');
    }
  });
}

function toggleSelectAll(master) {
  const chks = document.querySelectorAll('.lead-chk');
  chks.forEach(c => c.checked = master.checked);
  updateBulkBar();
}

async function applyBulkAssign() {
  const ids = getSelectedLeadIds();
  if (ids.length === 0) return;
  const select = document.querySelector('.bulk-assign-select');
  const assigned = select ? select.value : 'Sania Maqsood';
  const fd = new FormData();
  fd.append('action', 'bulk_assign');
  fd.append('ids', JSON.stringify(ids));
  fd.append('assigned_to', assigned);
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) location.reload();
  else alert(data.error || 'Failed bulk assign');
}

async function applyBulkStatus() {
  const ids = getSelectedLeadIds();
  if (ids.length === 0) return;
  const select = document.querySelector('.bulk-status-select');
  const status = select ? select.value : 'new';
  const fd = new FormData();
  fd.append('action', 'bulk_status');
  fd.append('ids', JSON.stringify(ids));
  fd.append('status', status);
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) location.reload();
  else alert(data.error || 'Failed bulk status update');
}

async function applyBulkDelete() {
  const ids = getSelectedLeadIds();
  if (ids.length === 0) return;
  if (!confirm('Are you sure you want to permanently delete ' + ids.length + ' selected leads?')) return;
  const fd = new FormData();
  fd.append('action', 'bulk_delete');
  fd.append('ids', JSON.stringify(ids));
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) location.reload();
  else alert(data.error || 'Failed bulk delete');
}

async function deleteLead(id) {
  if (!confirm('Are you sure you want to delete this lead?')) return;
  const fd = new FormData();
  fd.append('action', 'delete_lead');
  fd.append('id', id);
  await fetch('api.php', { method: 'POST', body: fd });
  location.reload();
}

async function handleCreateInvoice(e) {
  e.preventDefault();
  const form = e.target;
  const fd = new FormData(form);
  fd.append('action', 'create_invoice');
  if (fd.get('status') === 'paid') {
    fd.append('paid_amount', fd.get('total_amount'));
  }
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) {
    window.open('invoice-view.php?id=' + data.id, '_blank');
    location.reload();
  } else {
    alert(data.error || 'Failed to create invoice');
  }
}

async function updateInvoiceStatus(id, status, total) {
  const fd = new FormData();
  fd.append('action', 'update_invoice_status');
  fd.append('id', id);
  fd.append('status', status);
  fd.append('paid_amount', status === 'paid' ? total : 0);
  await fetch('api.php', { method: 'POST', body: fd });
  location.reload();
}

async function deleteInvoice(id) {
  if (!confirm('Are you sure you want to delete this invoice?')) return;
  const fd = new FormData();
  fd.append('action', 'delete_invoice');
  fd.append('id', id);
  await fetch('api.php', { method: 'POST', body: fd });
  location.reload();
}

// Record Installment Payment Modal Handlers
function openCollectPaymentModal(invId, clientName, title, total, paid, currency, dueDate) {
  const pending = Math.max(0, total - paid);
  const sym = currency === 'USD' ? '$' : 'PKR ';
  
  document.getElementById('collectModalInvoiceId').value = invId;
  document.getElementById('collectModalCurrency').value = currency;
  document.getElementById('collectModalCurLabel').innerText = currency;
  document.getElementById('collectModalPendingRaw').value = pending;
  
  document.getElementById('collectModalClientName').innerText = clientName;
  document.getElementById('collectModalCourseTitle').innerText = title;
  document.getElementById('collectModalTotal').innerText = sym + Number(total).toLocaleString();
  document.getElementById('collectModalPaid').innerText = sym + Number(paid).toLocaleString();
  document.getElementById('collectModalPending').innerText = sym + Number(pending).toLocaleString();
  
  document.getElementById('collectModalAmountInput').value = pending > 0 ? pending : '';
  document.getElementById('collectModalNextDueDate').value = dueDate || '';
  
  calcCollectPending();
  document.getElementById('collectPaymentModal').classList.add('open');
}

function closeCollectPaymentModal() {
  document.getElementById('collectPaymentModal').classList.remove('open');
}

function calcCollectPending() {
  const cur = document.getElementById('collectModalCurrency').value || 'PKR';
  const pendingRaw = parseFloat(document.getElementById('collectModalPendingRaw').value) || 0;
  const paying = parseFloat(document.getElementById('collectModalAmountInput').value) || 0;
  const remaining = Math.max(0, pendingRaw - paying);
  const alertEl = document.getElementById('collectModalStatusAlert');
  const dueRow = document.getElementById('collectModalNextDueRow');
  const sym = cur === 'USD' ? '$' : 'PKR ';

  if (paying >= pendingRaw && pendingRaw > 0) {
    alertEl.style.display = 'flex';
    alertEl.style.background = '#E8F5E9';
    alertEl.style.borderColor = '#C8E6C9';
    alertEl.style.color = '#2E7D32';
    alertEl.innerHTML = '✓ This payment will settle the invoice in full (' + sym + '0 Remaining Balance).';
    if (dueRow) dueRow.style.display = 'none';
  } else if (paying > 0) {
    alertEl.style.display = 'flex';
    alertEl.style.background = '#FFF3E0';
    alertEl.style.borderColor = '#FFE0B2';
    alertEl.style.color = '#E65100';
    alertEl.innerHTML = '⏳ Partial payment. ' + sym + Number(remaining).toLocaleString() + ' will remain pending.';
    if (dueRow) dueRow.style.display = 'block';
  } else {
    alertEl.style.display = 'none';
    if (dueRow) dueRow.style.display = 'block';
  }
}

async function handleRecordPaymentSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const fd = new FormData(form);
  fd.append('action', 'record_partial_payment');
  
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) {
    alert(data.msg);
    location.reload();
  } else {
    alert(data.error || 'Failed to record payment entry');
  }
}

async function handleSendBroadcast(e) {
  e.preventDefault();
  if (!confirm('Send this email broadcast to all subscribers now?')) return;
  const form = e.target;
  const fd = new FormData(form);
  fd.append('action', 'send_broadcast');
  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) {
    alert(data.msg);
    location.reload();
  } else {
    alert(data.error || 'Failed to send broadcast');
  }
}

async function handleChangePassword(e) {
  e.preventDefault();
  const form = e.target;
  const fd = new FormData(form);
  fd.append('action', 'change_password');

  const res = await fetch('api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.ok) {
    alert(data.msg);
    closeChangePasswordModal();
  } else {
    alert(data.error || 'Failed to update password');
  }
}
</script>

</body>
</html>
