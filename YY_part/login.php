<?php
 session_start(); // 确保第一行有这个
include('../WX_part/connect.php');
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 使用 isset 或 ?? 语法防止 Undefined array key 报错
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        
        // 3. 注意：这里直接使用 connect.php 里的 $conn，不要再 new mysqli 了
        $smtm = $conn->prepare("SELECT role FROM registration WHERE email = ? AND password = ?");
        $smtm->bind_param("ss", $email, $password);
        $smtm->execute();
        $smtm->bind_result($role);}

    if($smtm->fetch()){
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;

    if($role == 'admin'){
        header("Location: ../WX_part/admin_dashboard.php");
    } else {
        header("Location: ../CS_part/user_dashboard.php");
    }
    exit(); 
    } else {
    header("Location: login.html?error=1"); 
    exit();
    }

$smtm->close();
$conn->close();
 }
?>