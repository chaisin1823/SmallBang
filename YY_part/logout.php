<?php
// 1. 初始化 Session
session_start();

// 2. 清空所有 Session 变量
$_SESSION = array();

// 3. 如果使用的是基于 Cookie 的 Session，彻底销毁客户端的 Cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. 销毁服务器端的 Session 会话
session_destroy();

// 5. 跳转回登录页面
header("Location: ../YY_part/login.html");
exit();
?>