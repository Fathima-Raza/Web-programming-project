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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Dashboard</title>

    <style>
        *{
    padding: 0;
    margin: 0;
    color: white;
    font-family: sans-serif;
}
body{
    background-color:#001;
    display: flex;

}
.profile{
    display: flex;
    align-items: center;
    gap: 30px;
}
.profile h2{
    font-size: 20px;
    text-transform: capitalize;
}
.img-box{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid white;
    flex-shrink: 0;
}
.img-box img{
    width: 100%;
    height: 100%;
}

.menu{
    background-color: #123;
    width: 60px;
    height: 100vh;
    padding: 20px;
    overflow: hidden;
    transition: 0.5s;
}
.menu:hover{
    width: 260px;
}
ul{
    list-style: none;
    position: relative;
    height: 95%;
}
ul li a{
    display: block;
    text-decoration: none;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    display: flex;
    gap: 40px;
    align-items: center;
    transition: 0.5s;

}
ul li a:hover, .active , .box:hover, td:hover{
    background-color: #ffffff55;
}
.log-out{
    position: absolute;
    bottom: 0;
    width: 100%;

}
.log-out a{
    background-color:#a00 ;
}
ul li a i{
    font-size: 30px;
}
.content{
    width: 100%;
    margin: 10px;
}
.title-info{
    background-color: #0481ff;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 8px;
    margin: 10px 0;
}
.data-info{
    display:flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;

}
.box{
    background-color: #123;
    height: 150px;
    flex-basis: 150px;
    flex-grow: 1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-around;

}

.box i{
    font-size:40px
}
.box .data{
    text-align: center;
}

.box .data span{
    font-size: 30px;
}
table{
    width: 100%;
    text-align: center;
    border-spacing: 8px;

}
th,td{
    background-color: #123;
    height: 40px;
    border-radius: 8px;
}
th{
    background-color: #0481ff;
}
.price , .count{
    padding: 6px;
    border-radius: 6px;
}
.price{
    background-color: green;
}
.count{
    background-color: gold;
    color: black;
}

    </style>
</head>
<body>
    <div class="menu">
        <ul>
            <li class="profile">
                <div class="img-box">
                    <img src="img/profile.jpg" alt="image">
                </div>
                <h2><?php echo $lecturer['Name']; ?></h2>
            </li>
            <li>
                <a href="dashboard.php" class="active">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fas fa-user-group"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-table"></i>
                    <p>Course</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-pie"></i>
                    <p>Schedule</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-pen"></i>
                    <p>To Do List</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-star"></i>
                    <p>Important</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <p>settings</p>
                </a>
            </li>
            <li class="log-out">
                <a href="logout.php">
                    <i class="fas fa-sign-out"></i>
                    <p>Log Out</p>
                </a>
            </li>
        </ul>

    </div>


    <div class="content">
     <div class="title-info">
        <p>Dashboard</p>
        <i class="fas fa-chart-bar"></i>
     </div>
     <div class="data-info">
        <div class="box">
            <i class="fas fa-user"></i>
            <div class="data">
                <p>Total Lecturers</p>
                <span>10</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-pen"></i>
            <div class="data">
                <p>No of Courses</p>
                <span>4</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-table"></i>
            <div class="data">
                <p>No of hours</p>
                <span>102</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-dollar"></i>
            <div class="data">
                <p>No of total hours</p>
                <span>32</span>
            </div>
        </div>
        
     </div>
     <div class="title-info">
        <p>products</p>
        <i class="fas fa-table"></i>
     </div>
     <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Subject</th>
                <th>No of hours</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>HNDE</td>
                <td><span class="price">Communication Skills</span></td>
                <td><span class="count">4</span></td>
            </tr>
            <tr>
                <td>HNDIT</td>
                <td><span class="price">Database Management 
Systems </span></td>
                <td><span class="count">6</span></td>
            </tr>
            <tr>
                <td>HNDA</td>
                <td><span class="price"> Business Analysis</span></td>
                <td><span class="count">2</span></td>
            </tr>
            <tr>
                <td>HNDA</td>
                <td><span class="price">Statistics</span></td>
                <td><span class="count">2</span></td>
            </tr>
            <tr>
                <td>HNDE</td>
                <td><span class="price">Information Management and Information Systems</span></td>
                <td><span class="count">4</span></td>
            </tr>
            <tr>
                <td>HNDIT</td>
                <td><span class="price">Statistics for IT </span></td>
                <td><span class="count">6</span></td>
            </tr>
            
        </tbody>
     </table>

    </div>

    
</body>
</html>
