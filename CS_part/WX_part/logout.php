<?php
session_start();

$_SESSION = [];
session_destroy();

header("Location: ../YY_part/login.html?logout=1");
exit();

?>