<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}
$data = json_decode(file_get_contents('../site_data.json'), true);
$statusMessage = '';
if (isset($_GET['status']) && $_GET['status'] === 'saved') {
  $statusMessage = 'Site content updated successfully.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | SMUG CODES</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    body { background: #020617; color: #e2e8f0; }
    .dashboard { max-width: 1000px; margin: 2rem auto; padding: 2rem; }
    .dashboard header { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1rem; align-items: center; }
    .dashboard header h1 { margin: 0; }
    .dashboard form { display: grid; gap: 1.25rem; margin-top: 1.5rem; }
    .field-group { display: grid; gap: 0.75rem; }
    .field-group label { display: grid; gap: 0.5rem; font-weight: 600; }
    .field-group input, .field-group textarea { width: 100%; padding: 1rem; border-radius: 16px; border: 1px solid rgba(148,163,184,0.24); background: #111827; color: #e2e8f0; }
    .field-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
    .button-primary { width: auto; }
    .admin-footer { margin-top: 1rem; color: var(--muted); }
    .status { padding: 1rem 1.25rem; border-radius: 20px; background: rgba(56,189,248,0.12); border: 1px solid rgba(56,189,248,0.24); }
  </style>
</head>
<body>
  <main class="dashboard">
    <header>
      <div>
        <p class="eyebrow">Admin Dashboard</p>
        <h1>Manage SMUG CODES site content</h1>
      </div>
      <div>
        <a href="../index.html" class="button button-secondary">View site</a>
        <a href="logout.php" class="button button-secondary">Logout</a>
      </div>
    </header>
    <?php if ($statusMessage): ?>
      <div class="status"><?php echo htmlspecialchars($statusMessage); ?></div>
    <?php endif; ?>
    <form method="post" action="save.php">
      <div class="field-row">
        <div class="field-group">
          <label for="brandName">Brand name</label>
          <input id="brandName" name="brandName" value="<?php echo htmlspecialchars($data['brandName'] ?? 'SMUG CODES'); ?>" required>
        </div>
        <div class="field-group">
          <label for="heroEyebrow">Hero eyebrow</label>
          <input id="heroEyebrow" name="heroEyebrow" value="<?php echo htmlspecialchars($data['heroEyebrow'] ?? ''); ?>" required>
        </div>
      </div>
      <div class="field-row">
        <div class="field-group">
          <label for="heroTitle">Hero headline</label>
          <textarea id="heroTitle" name="heroTitle" rows="2"><?php echo htmlspecialchars($data['heroTitle'] ?? ''); ?></textarea>
        </div>
        <div class="field-group">
          <label for="heroDescription">Hero description</label>
          <textarea id="heroDescription" name="heroDescription" rows="3"><?php echo htmlspecialchars($data['heroDescription'] ?? ''); ?></textarea>
        </div>
      </div>
      <div class="field-row">
        <div class="field-group">
          <label for="heroPrimaryLabel">Primary button label</label>
          <input id="heroPrimaryLabel" name="heroPrimaryLabel" value="<?php echo htmlspecialchars($data['heroPrimaryLabel'] ?? 'Work with me'); ?>">
        </div>
        <div class="field-group">
          <label for="heroSecondaryLabel">Secondary button label</label>
          <input id="heroSecondaryLabel" name="heroSecondaryLabel" value="<?php echo htmlspecialchars($data['heroSecondaryLabel'] ?? 'View portfolio'); ?>">
        </div>
      </div>
      <div class="field-row">
        <div class="field-group">
          <label for="aboutEyebrow">About eyebrow</label>
          <input id="aboutEyebrow" name="aboutEyebrow" value="<?php echo htmlspecialchars($data['aboutEyebrow'] ?? ''); ?>">
        </div>
        <div class="field-group">
          <label for="aboutTitle">About title</label>
          <input id="aboutTitle" name="aboutTitle" value="<?php echo htmlspecialchars($data['aboutTitle'] ?? ''); ?>">
        </div>
      </div>
      <div class="field-group">
        <label for="aboutDescription">About description</label>
        <textarea id="aboutDescription" name="aboutDescription" rows="4"><?php echo htmlspecialchars($data['aboutDescription'] ?? ''); ?></textarea>
      </div>
      <div class="field-row">
        <div class="field-group">
          <label for="contactEmail">Contact email</label>
          <input id="contactEmail" name="contactEmail" value="<?php echo htmlspecialchars($data['contactEmail'] ?? ''); ?>">
        </div>
        <div class="field-group">
          <label for="contactPhone">Contact phone</label>
          <input id="contactPhone" name="contactPhone" value="<?php echo htmlspecialchars($data['contactPhone'] ?? ''); ?>">
        </div>
      </div>
      <div class="field-group">
        <label for="contactLocation">Contact location</label>
        <input id="contactLocation" name="contactLocation" value="<?php echo htmlspecialchars($data['contactLocation'] ?? ''); ?>">
      </div>
      <div class="field-group">
        <label for="footerText">Footer text</label>
        <input id="footerText" name="footerText" value="<?php echo htmlspecialchars($data['footerText'] ?? ''); ?>">
      </div>
      <button type="submit" class="button button-primary">Save changes</button>
    </form>
    <p class="admin-footer">Use this dashboard to keep the portfolio content updated without editing HTML directly.</p>
  </main>
</body>
</html>
