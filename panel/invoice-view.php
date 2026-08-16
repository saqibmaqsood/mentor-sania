<?php
require_once __DIR__ . '/auth.php';
requireLogin();

$invId = intval($_GET['id'] ?? 0);
$stmt = $db->prepare("SELECT * FROM invoices WHERE id = ?");
$stmt->execute([$invId]);
$invoice = $stmt->fetch();

if (!$invoice) {
    die("Invoice not found.");
}

$items = json_decode($invoice['items_json'], true) ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="/panel/">
<title>Invoice #<?php echo htmlspecialchars($invoice['invoice_number']); ?> — Sania Maqsood</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    background: #F4F1EA;
    color: #1E1B17;
    font-family: 'Manrope', system-ui, sans-serif;
    padding: 40px 20px;
    -webkit-font-smoothing: antialiased;
  }
  .invoice-wrapper {
    max-width: 800px;
    margin: 0 auto;
    background: #FFFFFF;
    border: 1px solid #E2D9C9;
    border-radius: 20px;
    padding: clamp(32px, 5vw, 56px);
    box-shadow: 0 10px 30px rgba(30,27,23,0.05);
  }
  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 24px;
  }
  .table th {
    text-align: left;
    padding: 12px 16px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(30,27,23,0.6);
    border-bottom: 1.5px solid #EDE4D3;
  }
  .table td {
    padding: 16px;
    font-size: 14.5px;
    border-bottom: 1px solid #F4F1EA;
  }
  .status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
  .status-paid { background: #E8F5E9; color: #2E7D32; }
  .status-unpaid { background: #FFEBEE; color: #C62828; }
  .status-partial { background: #FFF8E1; color: #F57F17; }
  
  @media print {
    body { background: #FFF; padding: 0; }
    .invoice-wrapper { border: none; box-shadow: none; padding: 0; }
    .no-print { display: none !important; }
  }
</style>
</head>
<body>

<div class="no-print" style="max-width:800px;margin:0 auto 20px;display:flex;align-items:center;justify-content:space-between">
  <a href="index.php?tab=invoices" style="color:#8A5A34;text-decoration:none;font-weight:600;font-size:14.5px">← Back to Invoices</a>
  <div style="display:flex;gap:10px">
    <button onclick="window.print()" style="background:#1E1B17;color:#FAF7F2;border:none;padding:10px 22px;border-radius:999px;font-weight:600;font-size:14px;cursor:pointer">🖨️ Print / Save PDF</button>
  </div>
</div>

<div class="invoice-wrapper">
  <!-- INVOICE HEADER -->
  <div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:start;gap:24px;padding-bottom:32px;border-bottom:1.5px solid #EDE4D3">
    <div>
      <h1 style="font-family:'Newsreader',Georgia,serif;font-size:28px;color:#1E1B17">Sania Maqsood</h1>
      <p style="font-size:13.5px;color:rgba(30,27,23,0.6);margin-top:4px">Digital Mentorship & Client Services</p>
      <p style="font-size:13px;color:rgba(30,27,23,0.5);margin-top:2px">hello@saniamaqsood.com · mentorsania.com</p>
    </div>
    <div style="text-align:right">
      <span style="display:block;font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#8A5A34">Invoice</span>
      <div style="font-family:'Newsreader',Georgia,serif;font-size:24px;color:#1E1B17;margin-top:4px">#<?php echo htmlspecialchars($invoice['invoice_number']); ?></div>
      <div style="margin-top:8px">
        <?php if ($invoice['status'] === 'paid'): ?>
          <span class="status-badge status-paid">PAID IN FULL</span>
        <?php elseif ($invoice['status'] === 'partially_paid'): ?>
          <span class="status-badge status-partial">PARTIALLY PAID</span>
        <?php else: ?>
          <span class="status-badge status-unpaid">PAYMENT PENDING</span>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- CLIENT & DATES -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;margin-top:28px">
    <div>
      <span style="font-size:11.5px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Billed To:</span>
      <h3 style="font-size:17px;font-weight:700;color:#1E1B17;margin-top:6px"><?php echo htmlspecialchars($invoice['client_name']); ?></h3>
      <?php if (!empty($invoice['client_phone'])): ?>
        <p style="font-size:14px;color:rgba(30,27,23,0.65);margin-top:3px"><?php echo htmlspecialchars($invoice['client_phone']); ?></p>
      <?php endif; ?>
      <?php if (!empty($invoice['client_email'])): ?>
        <p style="font-size:14px;color:rgba(30,27,23,0.65);margin-top:1px"><?php echo htmlspecialchars($invoice['client_email']); ?></p>
      <?php endif; ?>
    </div>

    <div>
      <span style="font-size:11.5px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Invoice Details:</span>
      <div style="margin-top:6px;font-size:14px;color:rgba(30,27,23,0.7);display:flex;flex-direction:column;gap:4px">
        <div><strong>Issue Date:</strong> <?php echo date('M d, Y', strtotime($invoice['issue_date'])); ?></div>
        <?php if (!empty($invoice['due_date'])): ?>
          <div><strong>Due Date:</strong> <?php echo date('M d, Y', strtotime($invoice['due_date'])); ?></div>
        <?php endif; ?>
        <?php if (!empty($invoice['payment_method'])): ?>
          <div><strong>Payment Method:</strong> <?php echo htmlspecialchars($invoice['payment_method']); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- INVOICE ITEMS TABLE -->
  <table class="table">
    <thead>
      <tr>
        <th>Description</th>
        <th style="width:100px;text-align:center">Qty</th>
        <th style="width:140px;text-align:right">Price</th>
        <th style="width:140px;text-align:right">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($items)): ?>
        <tr>
          <td><?php echo htmlspecialchars($invoice['title']); ?></td>
          <td style="text-align:center">1</td>
          <td style="text-align:right"><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format($invoice['total_amount'])); ?></td>
          <td style="text-align:right"><strong><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format($invoice['total_amount'])); ?></strong></td>
        </tr>
      <?php else: ?>
        <?php foreach ($items as $item): ?>
          <tr>
            <td>
              <strong><?php echo htmlspecialchars($item['name'] ?? $invoice['title']); ?></strong>
              <?php if (!empty($item['desc'])): ?>
                <div style="font-size:12.5px;color:rgba(30,27,23,0.55);margin-top:2px"><?php echo htmlspecialchars($item['desc']); ?></div>
              <?php endif; ?>
            </td>
            <td style="text-align:center"><?php echo htmlspecialchars($item['qty'] ?? '1'); ?></td>
            <td style="text-align:right"><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format($item['price'] ?? $invoice['total_amount'])); ?></td>
            <td style="text-align:right"><strong><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format(($item['qty'] ?? 1) * ($item['price'] ?? $invoice['total_amount']))); ?></strong></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- TOTALS -->
  <div style="margin-top:24px;display:flex;justify-content:flex-end">
    <div style="width:260px;display:flex;flex-direction:column;gap:8px">
      <div style="display:flex;justify-content:space-between;font-size:14.5px;color:rgba(30,27,23,0.7)">
        <span>Subtotal:</span>
        <span><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format($invoice['total_amount'])); ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:14.5px;color:rgba(30,27,23,0.7)">
        <span>Paid Amount:</span>
        <span><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format($invoice['paid_amount'])); ?></span>
      </div>
      <div style="border-top:1.5px solid #EDE4D3;padding-top:10px;display:flex;justify-content:space-between;font-size:18px;font-weight:700;color:#1E1B17">
        <span>Balance Due:</span>
        <span style="color:#B5794A"><?php echo htmlspecialchars($invoice['currency'] . ' ' . number_format(max(0, $invoice['total_amount'] - $invoice['paid_amount']))); ?></span>
      </div>
    </div>
  </div>

  <!-- NOTES & PAYMENT ACCOUNTS -->
  <div style="margin-top:40px;padding-top:24px;border-top:1px solid #EDE4D3;background:#FAF7F2;border-radius:14px;padding:20px">
    <span style="display:block;font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8A5A34">Payment Accounts & Verification</span>
    <div style="margin-top:10px;font-size:13.5px;line-height:1.6;color:rgba(30,27,23,0.75)">
      <div>• <strong>Bank Transfer / Raast ID:</strong> Available on request via WhatsApp</div>
      <div>• <strong>JazzCash / EasyPaisa:</strong> Available on request via WhatsApp</div>
      <div>• After making payment, please send screenshot on WhatsApp: <strong>0300 0000000</strong> with Invoice #<strong><?php echo htmlspecialchars($invoice['invoice_number']); ?></strong>.</div>
    </div>
    <?php if (!empty($invoice['notes'])): ?>
      <div style="margin-top:12px;padding-top:10px;border-top:1px dashed #D9CDB6;font-size:13px;color:rgba(30,27,23,0.65)">
        <strong>Special Note:</strong> <?php echo htmlspecialchars($invoice['notes']); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- FOOTER -->
  <div style="margin-top:32px;text-align:center;font-size:12.5px;color:rgba(30,27,23,0.45)">
    Thank you for learning and building with Sania Maqsood.
  </div>
</div>

</body>
</html>
