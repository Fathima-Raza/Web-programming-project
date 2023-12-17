

<?php
session_start();

// Include the database connection script
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];



    // Validate login credentials
    $sql = "SELECT * FROM Lecturer WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['Password'];

        // Verify the password
        if (password_verify($password, $storedHashedPassword)) {
            // Password is correct, set session variables and redirect to the dashboard
            $_SESSION['email'] = $row['Email'];
            header("Location: dashboard.php");
            
        } else {
            // Password is incorrect
            $error_message = "Incorrect password";
            echo "<script>alert('$error_message');</script>"; 
        }
    } else {
        // Lecturer not found
        $error_message = "Lecturer not found";
        
    }
    if (!$result) {
        // Handle database query error
        echo "Error: " . $conn->error;
    }
    

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Login</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato:400,700");

        body {
            font-family: 'Lato', sans-serif;
            color: #4A4A4A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
            background-image: url('img/background1.jpg');
            background-repeat: no-repeat; 
            background-size: cover; 
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-position-x: center;
            filter: blur(0px);
        }

        form {
            width: 350px;
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        

        .form-field {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-field::before {
            font-size: 20px;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888888;
        }

        .form-field:nth-child(1)::before {
            content: "\1F464"; /* Unicode for envelope icon */
        }

        .form-field:nth-child(2)::before {
            content: "\1F512"; /* Unicode for key icon */
        }

        input {
            font-family: inherit;
            width: 80%;
            outline: none;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 1rem;
            font-size: 20px;
            color: #555;
            color: #555;
            margin-left: 40px; 
        }

        

        .btn {
            outline: none;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 1rem;
            text-align: center;
            background-color: #47AB11;
            color: #fff;
            border-radius: 4px;
            font-size: 17px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #39870f;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
            color: #333;
            font-size: 14px;
        }

        .register-link a {
            color: #47AB11;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-field">
            <input type="email" placeholder="Email / Username" name="email" required/>
        </div>
  
        <div class="form-field">
            <input type="password" placeholder="Password" name="password" required/>                         
        </div>
  
        <div class="form-field">
            <button class="btn" type="submit">Log in</button>
        </div>

        <div class="form-field register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </form>
</body>
</html>
