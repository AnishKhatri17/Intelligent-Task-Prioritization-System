<?php 
if(!isset($_SESSION)) session_start(); // Starting the session if not set.

include '../../../PHP_Files/config.php'; // Including the "config file".

$userId = $_SESSION['user_id'] ?? null; // Fetching the user ID from the session.
if(!$userId){
    $_SESSION['update_error'] = "Unauthorized Access!";
    header("Location: ../../User_Dashboard.php#profile");
    exit;
}

// Fetching the submitted form data
$fullname = trim($_POST['fullname'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$timezone = trim($_POST['timezone'] ?? '');
$new_password = trim($_POST['new_password'] ?? '');
$confirm_password = trim($_POST['confirm_password'] ?? '');
$current_password = trim($_POST['current_password'] ?? '');

// Now, fetching the current hashed password from Database
$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();
$stmt->close();

// Now verifying the current password after we fetched it.
if(!password_verify($current_password, $hashed_password)){
    $_SESSION['update_error'] = "Incorrect Current Password!";
    header("Location: ../../User_Dashboard.php#profile");
    exit;
}

if (!empty($new_password) && $new_password !== $confirm_password) {
    $_SESSION['update_error'] = "New passwords do not match!";
    header("Location: ../../User_Dashboard.php#profile");
    exit;
}

// Okay if new password is provided, we hash it.
if (!empty($new_password)) 
    {
    // Update with new password
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, username = ?, email = ?, timezone = ?, password = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("sssssi", $fullname, $username, $email, $timezone, $new_hashed_password, $userId);
} 
else 
    {
    // Update without changing password
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, username = ?, email = ?, timezone = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("ssssi", $fullname, $username, $email, $timezone, $userId);
}

// Execute and handle the update request...
if($stmt->execute()){
    $_SESSION['update_success'] = "Profile Updated Successfully!";
}
    else{
        $_SESSION['update_error'] = "Failed to update profile! Please try agaian.";
    }

$stmt->close();

// Redirecting Back to the profile section.
header("Location: ../../User_Dashboard.php#profile");
exit;
?>