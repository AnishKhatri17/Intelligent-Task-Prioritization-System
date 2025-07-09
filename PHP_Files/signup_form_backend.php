<?php
    include("config.php");
    
    // Post Requests
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        // let's collect and trim input data
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $timezone = trim($_POST['timezone'] ?? '');

        // Ok, basic required field validarions
        if(empty($fullname) || empty($email) || empty($username) || empty($password) || empty($confirm_password) || empty($timezone)){
                die("All fields are required.");
        }

        // Validate Email Format ...
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                die("Invalid email format.");
        }

        // Check Username Format ...
        if(!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)){
                die("Username must be 4-20 characters long and only contain letters, numbers or underscores.");
        }

        // Check Password Length ...
        if(strlen($password) < 6){
                die("Password must be at least 6 characters long.");
        }

        // Password Match Check
        if($password !== $confirm_password){
            die("Passwords do not match");
        }

        // Check if Username or Email Already Exists
        $check_sql = "SELECT id FROM users WHERE username = ? or email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if($check_stmt->num_rows > 0){
            die("Username or Email already exists.");
        }
        $check_stmt->close();

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Now let's insert into the database securely.
        $insert_sql = "INSERT INTO users (fullname, email, username, password, timezone) VALUES (?,?,?,?,?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssss", $fullname, $email, $username, $hashed_password, $timezone);

        if($insert_stmt->execute()){
            header("Location: signup_form.php?success=1");
            exit();
        }
        else{
            die("Error: " . $insert_stmt->error);
        }

        $insert_stmt->close();
        $conn->close();
    }

    else{
        // Redirect to the same login page if error in submission
        header("Location: index.php");
        exit();
    }
?>