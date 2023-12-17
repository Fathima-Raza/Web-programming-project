
<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection script
include 'db.php';

// Retrieve course data based on the session variables
$email = $_SESSION['email'];
$sql = "SELECT * FROM Lecturer WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $lecturer = $result->fetch_assoc();
    $courseID = $lecturer['CourseID'];

    // Retrieve course details based on the CourseID
    $courseSql = "SELECT * FROM Course WHERE CourseID = $courseID";
    $courseResult = $conn->query($courseSql);

    if ($courseResult->num_rows == 1) {
        $course = $courseResult->fetch_assoc();
    } else {
        // Course not found, handle as needed (e.g., redirect to an error page)
        header("Location: error.php");
        exit();
    }
} else {
    // Lecturer not found, redirect to login page
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
    <title>User Dashboard</title>
    <style>
        #body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #sidebar {
            height: 100vh;
            padding: 20px;
            background-color: #2c3e50;
            float: left;
            width: 300px;
            color: #ecf0f1;
        }

        #content {
            padding: 20px;
            float: left;
            width: calc(100% - 250px);
            margin: 10px;
        }
        

        #sidebar h2 {
            margin-top: 0;
            color: #ecf0f1;
        }

        #sidebar a {
            color: #ecf0f1;
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            transition: color 0.3s;
        }

        #sidebar a {
            color: black;
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
        }

        #sidebar a:hover {
            color: Blue;
        }


        #sidebar a:hover {
            color: #3498db;
        }

        #sidebar img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        #logout-btn {
            background-color: #e74c3c;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #logout-btn:hover {
            background-color: #c0392b;
        }

        
    </style>
</head>
<script>
        function loadProfile() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("body").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "profile.php", true);
            xhttp.send();
        }
    </script>
<body id="body">
    <div id="sidebar">
        <center><img src="download.jfif" alt="Profile Picture" class="myimg">
        <h2>Welcome back, <?php echo $lecturer['Name']; ?>!</h2></center>
        <a href="#" onclick="loadProfile()">Profile</a>
        <a href="#">Course Details</a>
        <a href="#">Allocation</a>
        <button id="logout-btn" onclick="window.location.href='logout.php';">Log Out</button>
    </div>
    <div id="content">
        
    </div>

   
</body>
</html>