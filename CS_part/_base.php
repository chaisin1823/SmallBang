<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="nav">
    <div class="logo">
        <a href="user_dashboard.php" class="home-icon">
            <i class="fa-solid fa-tooth"></i> SMALLBANG Dental Clinic
        </a>
    </div>
    <ul>
        <li><a href="about.php">About</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="../YY_part/appointment.html" class="btn">Booking</a></li>

        <?php if (isset($_SESSION['email'])): ?>
            <li>
                <span class="user-greeting" style="margin-right: 10px; color: #333;">
                    <i class="fa-solid fa-circle-user"></i> 
                    Hi, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                </span>
            </li>
            <li>
                <a href="../YY_part/logout.php" class="login" style="color: #ff4d4d;">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="../YY_part/login.html" class="login">
                    <i class="fa-solid fa-user"></i> Log In
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
