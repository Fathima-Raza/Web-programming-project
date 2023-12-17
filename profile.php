<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


include 'db.php';

$email = $_SESSION['email'];
$sql = "SELECT lecturer.*, course.Title AS CourseTitle
        FROM lecturer
        JOIN course ON lecturer.CourseID = course.CourseID
        WHERE lecturer.Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $lecturer = $result->fetch_assoc();
    $courseTitle = $lecturer['CourseTitle'];

    // ... other profile information

} else {
    // Handle lecturer not found as needed
    header("Location: login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #profile-container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #profile-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        p {
            margin-bottom: 20px;
            color: #7f8c8d;
        }

        label {
            font-weight: bold;
            color: #2c3e50;
        }

        .info {
            margin-bottom: 20px;
        }

        #edit-profile-btn {
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #edit-profile-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div id="profile-container">
        <img src="download.jfif" alt="Profile Picture">
        <h2><?php echo $lecturer['Name']; ?></h2>

        <div class="info">
            <label>Email:</label>
            <p><?php echo $lecturer['Email']; ?></p>
        </div>

        <div class="info">
            <label>Designation:</label>
            <p><?php echo $lecturer['Designation']; ?></p>
        </div>

        <div class="info">
            <label>Gender:</label>
            <p><?php echo $lecturer['Gender']; ?></p>
        </div>

        <div class="info">
            <label>Course:</label>
            <p><?php echo $courseTitle; ?></p>
        </div>

        <!-- Add more profile information as needed -->

        <button id="edit-profile-btn" onclick="window.location.href='register.php';">Edit Profile</button>
    </div>
</body>
</html>
