<?php
session_start();
require_once('connect.php');

// 简单权限保护
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Access denied');
}

$id = intval($_GET['id']);

$conn->query(
    "UPDATE appointment_details
     SET status='Approved'
     WHERE id=$id"
);

header("Location: admin_dashboard.php");
exit();
