<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}
$source = '../site_data.json';
$data = json_decode(file_get_contents($source), true);
if (!$data) {
  $data = [];
}
$fields = [
  'brandName', 'heroEyebrow', 'heroTitle', 'heroDescription', 'heroPrimaryLabel', 'heroSecondaryLabel',
  'aboutEyebrow', 'aboutTitle', 'aboutDescription',
  'contactEmail', 'contactPhone', 'contactLocation', 'footerText'
];
foreach ($fields as $field) {
  if (isset($_POST[$field])) {
    $data[$field] = trim($_POST[$field]);
  }
}
file_put_contents($source, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
header('Location: dashboard.php?status=saved');
exit;
