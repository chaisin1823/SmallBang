<?php
 $fullName = $_POST['fullName'];
 $appDate = $_POST['appDate'];
 $appTime = $_POST['appTime'];
 $category = $_POST['category'];
 $serviceName = $_POST['serviceName'];

 //Database Connection
 $conn = new mysqli('localhost', 'root', '', 'SMALLBANG_user_details');

 if($conn->connect_error){
     die('Connection Failed :'. $conn->connect_error);
     } 

    $smtm = $conn->prepare("INSERT INTO appointment_details (fullName, appDate, appTime, category, serviceName) VALUES (?, ?, ?, ?, ?)");
    if (!$smtm) {
    die("Prepare failed: " . $conn->error);
    }

    $smtm->bind_param("sssss", $fullName, $appDate, $appTime, $category, $serviceName);
    if($smtm->execute()) {
    echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
    echo "
    <div style='text-align:center; padding:50px; font-family:\"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #333;'>
        <div style='max-width: 500px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 10px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
            <h2 style='color: #008080;'>Appointment Successful!</h2>
            <p style='font-size: 1.1em;'>Thank you, <strong>$fullName</strong>. Your request has been recorded.</p>
            
            <div style='background-color: #f9f9f9; border-left: 5px solid #008080; display: block; padding: 20px; text-align: left; margin: 20px 0;'>
                <b style='color: #008080; font-size: 1.2em;'>Booking Summary:</b><br><br>
                <strong>Treatment:</strong> $serviceName <br>
                <strong>Category:</strong> $category <br>
                <strong>Date:</strong> $appDate <br>
                <strong>Time:</strong> $appTime
            </div>

            <p style='color: #666;'>We look forward to seeing you at SMALLBANG Dental Clinic.</p>
            
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            
            <p style='color:#888; font-size:11px; font-style: italic;'>
                (In a production environment, a formal confirmation email would be automatically dispatched to your inbox at this stage.)
            </p>
            
            <a href='../CS_part/user_dashboard.php' style='display:inline-block; margin-top:15px; padding:10px 20px; background-color:#008080; color:white; text-decoration:none; border-radius:5px;'>Back to Home</a>
        </div>
    </div>";
};

    $smtm->close();
    $conn->close();
?>