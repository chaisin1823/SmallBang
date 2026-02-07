<?php
session_start();

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password !== $confirm_password) {
    die("Passwords do not match");
}


// Database connection
    $conn = new mysqli('localhost', 'root', '', 'SMALLBANG_user_details');
    if($conn->connect_error){
        die('Connection Failed :'. $conn->connect_error);
        } 
        $smtm = $conn->prepare("INSERT INTO registration (name, email, password) VALUES (?, ?, ?)");
        
    if (!$smtm) {
        die("Prepare failed: " . $conn->error);
       }
        $smtm->bind_param("sss", $name, $email, $password);
        
    if($smtm->execute()) {
    // 存入 Session 方便 dashboard 调用
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['user_name'] = $name;

    echo "
    <div style='text-align:center; padding:50px; font-family:\"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #333;'>
        <div style='max-width: 500px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 10px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
            <h2 style='color: #008080;'>Registration Successful!</h2>
            <p style='font-size: 1.1em;'>Welcome, <strong>$name</strong>. Your account has been created.</p>
            
            <div style='background-color: #f9f9f9; border-left: 5px solid #008080; display: block; padding: 20px; text-align: left; margin: 20px 0;'>
                <b style='color: #008080; font-size: 1.2em;'>Account Summary:</b><br><br>
                <strong>Name:</strong> $name <br>
                <strong>Email:</strong> $email <br>
                <strong>Status:</strong> Active
            </div>

            <p style='color: #666;'>You can now manage your appointments in your dashboard.</p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            
            <a href='../CS_part/user_dashboard.php' style='display:inline-block; margin-top:15px; padding:10px 20px; background-color:#008080; color:white; text-decoration:none; border-radius:5px; font-weight: bold;'>Go to Dashboard</a>
        </div>
    </div>";
} else {
    echo "Registration Error: " . $smtm->error;
}

$smtm->close();
$conn->close();
?>