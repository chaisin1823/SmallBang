<?php
session_start();
require_once('connect.php'); 

// 1. 权限检查
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: /TWPProject/YY_part/login.html");
exit();
}

// 2. 获取统计数据 (注意表名已改为 appointment_details)
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM appointment_details");
$customerCount = $totalQuery ? $totalQuery->fetch_assoc()['total'] : 0;

$pendingQuery = $conn->query("SELECT COUNT(*) AS total FROM appointment_details WHERE status='Pending'");
$pendingCount = $pendingQuery ? $pendingQuery->fetch_assoc()['total'] : 0;

// 3. 获取所有预约列表
// 我将 ORDER BY 改为了 appDate，因为刚才报错显示可能没有 created_at 字段
$result = $conn->query("SELECT * FROM appointment_details ORDER BY appDate DESC");

if (!$result) {
    die("Connection failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
    }
    </script>
</head>

<body>

<div class="sidebar" id="sidebar">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <h2>Admin</h2>
    <a href="#">Dashboard</a>
    <a href="#">Appointments</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
  <div class="cards-container">
    <div class="card card-sales dashboard-card">
      <h5>Total Appointments</h5>
      <h3><?= $customerCount ?></h3>
    </div>

    <div class="card card-orders dashboard-card">
      <h5>Pending Approval</h5>
      <h3><?= $pendingCount ?></h3>
    </div>
  </div>

  <table>
    <tr>
        <th>Patient Name</th>
        <th>Service</th>
        <th>Category</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row['fullName']) ?></td>
      <td><?= htmlspecialchars($row['serviceName']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td><?= $row['appDate'] ?></td>
      <td><?= $row['appTime'] ?></td>
      <td class="status <?= strtolower($row['status']) ?>">
  <?= $row['status'] ?>
</td>

      <td>
  <?php if ($row['status'] === 'Pending') { ?>
    <a href="approve.php?id=<?= $row['id'] ?>" class="btn approve">Approve</a>
    <a href="cancel.php?id=<?= $row['id'] ?>" class="btn cancel">Cancel</a>
  <?php } else { ?>
    <span style="color:#999; font-size:13px;">No action</span>
  <?php } ?>
</td>
    </tr>
    <?php } ?>

  </table>
</div>

</body>
</html>