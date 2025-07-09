<?php 
    session_start(); // starting session to store the user info

    include("config.php");
    // getting form data from the Post Method
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // Let's trim and collect the input
        $username = trim($_POST['username'] ?? '');
        $password = ($_POST['password'] ?? '');

        // Let's check if the field is left empty
        if(empty($username) || empty($password)){
            header("Location: login.php?error=1");
        }

        // Now, SQL query to find the user by username ..
        $sql = "SELECT id, fullname, email, username, password, timezone FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt ->bind_param("s", $username);
        $stmt ->execute();
        $stmt ->store_result();

        // Check if user exists
        if($stmt->num_rows === 1){
            $stmt->bind_result($user_id, $fullname, $email, $db_username, $hashed_password, $timezone);
            $stmt->fetch();

            //verify password
            if(password_verify($password, $hashed_password)){
                 // Let's store important user info in the session
                 $_SESSION['user_id'] = $user_id;
                 $_SESSION['fullname'] = $fullname;
                 $_SESSION['username'] = $username;
                 $_SESSION['email'] = $email;
                 $_SESSION['timezone'] = $timezone;

                 // Redirect to dashboard after successful login
                 header("Location: user_dashboard.php");
                 exit();
            }

            else{
                // Invalid Password
                header("Location: login.php?error=password&username=" . urlencode($username) . "&password=" . urlencode($password));
                exit();
            }
        }
                else{
                    // Username not found
                   header("Location: login.php?error=username&username=" . urlencode($username) . "&password=" . urlencode($password));
                    exit();
                }

            $stmt->close();
            $conn->close();
        }

        else{
            header("Location: login.php");
            exit();
        }
?>