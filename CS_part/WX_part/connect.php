<?php
// 数据库配置信息
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SMALLBANG_user_details";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 设置编码（防止中文乱码）
$conn->set_charset("utf8mb4");
?>