<?php 
session_start();
require_once('../WX_part/connect.php'); 

// 1. 权限检查
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header("Location: ../YY_part/login.html");
    exit();
}

// 假设你在 login 时把用户名存到了 $_SESSION['username']
// 如果没存，可以用 $_SESSION['email'] 代替
$displayName = isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['email'];

include '_head.php'; 
include '_base.php'; 
?>

<!-- HERO -->
<section class="home-hero" style="background-image: url('background.jpeg');">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1>Brighten Your Smile</h1>
    <p>Professional Dental Care with Modern Technology</p>
    <a href="../YY_part/appointment.html" class="hero-btn">Book Appointment</a>
  </div>
</section>
<!-- SERVICES PREVIEW -->
<section class="home-services">
  <div class="section-title">
    <h2>Our Services</h2>
    <p>Complete dental solutions for your family</p>
  </div>

  <div class="service-grid">
    <div class="service-card">
      <i class="fa-solid fa-tooth"></i>
      <h3>Orthodontics & Invisalign</h3>
      <p>Straightening teeth with modern invisible aligners</p>
    </div>

    <div class="service-card">
      <i class="fa-solid fa-face-smile"></i>
      <h3>Smile Makeovers</h3>
      <p>Enhancing smiles through aesthetic dental treatments</p>
    </div>

    <div class="service-card">
      <i class="fa-solid fa-teeth"></i>
      <h3>Periodontal (Gum) Care</h3>
      <p>Protecting gums for long-term oral health</p>
    </div>
    <div class="service-card">
      <i class="fa-solid fa-user-doctor"></i>
      <h3>Oral Surgery</h3>
      <p>Safe surgical treatment for complex conditions</p>
    </div>
    <div class="service-card">
      <i class="fa-solid fa-book-medical"></i>
      <h3>Restoration Of Function</h3>
      <p>Restoring chewing and bite functionality</p>
    </div>
  </div>
</section>

<!-- ABOUT PREVIEW -->
<section class="home-about">
  <div class="about-img">
    <img src="background.jpg" alt="Clinic">
  </div>
  <div class="about-text">
    <h2>Why Choose SMALLBANG Dental Clinic</h2>
    <p>
      We combine modern technology, professional expertise, and patient-focused care to
      provide comfortable, reliable and high-quality dental services.
    </p>

    <ul>
      <li>✔ Modern Equipment</li>
      <li>✔ Experienced Doctors</li>
      <li>✔ Comfortable Environment</li>
      <li>✔ Trusted by Families</li>
    </ul>

    <a href="about.php" class="about-btn">Learn More</a>
  </div>
</section>


<?php include '_foot.php'; ?>
</body>
</html>