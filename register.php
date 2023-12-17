<?php
session_start();

include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profile_picture = $_FILES['profile_picture']; // Use $_FILES to get file details
    $designation = $_POST['designation'];

    // Check if the "uploads" directory exists, create it if not
    $target_directory = 'uploads/';
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0755, true);
    }

    // Specify the target file path
    $target_file = $target_directory . basename($profile_picture['name']);

    // Move the uploaded file to the "uploads" directory
    if (move_uploaded_file($profile_picture['tmp_name'], $target_file)) {
        // File upload successful, continue with other operations
        // ...

        // For demonstration purposes, let's echo the file path
        echo "File uploaded successfully. Path: " . $target_file;
    } else {
        // Handle file upload error
        echo "Error uploading file.";
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Registration</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            /*background-color: #f5f5f5;*/
            background-image: url('img/back.jfif');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-image:url('img/back1.jfif');
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            text-align: center;
        }

        h2 {
            color: #47AB11;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #47AB11;
            color: #fff;
            padding: 0.7rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #39870f;
        }
    </style>
    
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">

        <h2>Lecturer Registration</h2>

        <label for="name">Name in Full:</label>
        <input type="text" id="name" name="name" required>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture" accept=".png, .jpg, .jpeg" required>


        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="designation">Designation:</label>
        <select id="designation" name="designation" required>
            <option value="assistant">Assistant Lecturer</option>
            <option value="lecturer">Lecturer</option>
            <option value="senior1">Senior Lecturer I</option>
            <option value="senior2">Senior Lecturer II</option>
        </select>

        <label for="course">Course:</label>
        <select id="course" name="courseID" required>
            <option value="hnda">HNDA</option>
            <option value="hndit">HNDIT</option>
            <option value="hnde">HNDE</option>
            <!-- Add more options as needed -->
        </select>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="dob" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="no" pattern="[0-9]{10}" placeholder="Format: +94 0775305729" required>

        <label for="address">Address:</label>
        <textarea id="address" name="add" rows="4" required></textarea>

        <label for="academic_qualification">Academic Qualification:</label>
        <input type="text" id="academic_qualification" name="qual" required>

        <label for="upload_document">Upload Relevant Document:</label>
        <input type="file" id="upload_document" name="doc" accept=".pdf">

        <label for="experience">Teaching Experience (Years):</label>
        <input type="number" id="experience" name="year" min="0" required>

        <label for="specialization">Area of Specialization:</label>
        <input type="text" id="specialization" name="area" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
