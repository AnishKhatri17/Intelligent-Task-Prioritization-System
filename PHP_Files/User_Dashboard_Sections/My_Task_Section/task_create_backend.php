<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Okay let's check whether the user is logged in ...
if(!isset($_SESSION['user_id'])){
    header("Location: /ProjectIII/PHP_Files/login.php");
    exit();
}

// Include database connection "config file"
include '../../../PHP_Files/config.php';

// Getting and sanitiize user inputs    
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$due_datetime = trim($_POST['due_datetime'] ?? '');
$priority = trim($_POST['priority'] ?? '');
$frequency = trim($_POST['frequency'] ?? '');
$category = trim($_POST['category'] ?? '');
$user_id = $_SESSION['user_id'];

$errors = [];

// Validate user inputs ....
if($title === '') $errors[] = "Task title is required.";
if($description === '') $errors[] = "Description is required.";
if($due_datetime === '') $errors[] = "Due date and time is required.";
if(!in_array($priority, ['Urgent', 'High', 'Medium', 'Low', 'Optional'])) $errors[] = "Invalid Priority. Please select a valid priority.";
if(!in_array($frequency, ['One-time', 'Daily', 'Weekly','Monthly','Yearly'])) $errors[] = " Invalid Frequecy. Please select a valid frequency.";
if($category === 'None' || $category === '') $errors[] = "Please select a valid category."; 

// Okayyy, if erros, redirect with a error message
if(!empty($errors)){
    $_SESSION['task_errors'] = $errors;
    header("Location: my_tasks_section.php");
    exit();
}

$status = 'Pending'; // Default status for new tasks
// Okay now, Prepare the SQL statement to prevent SQL injection
// Okay now use prepared statements for security
$stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, due_datetime, priority, frequency, category, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt -> bind_param("isssssss", $user_id, $title, $description, $due_datetime, $priority, $frequency, $category, $status);

// Execute and redirect...

if($stmt->execute()){
    $_SESSION['task_success'] = "Please Complete Your Task To Be Productive !";

}

else{
    $_SESSION['task_errors'] = ["Failed to create task. Please try again."];
}

$stmt->close();
$conn->close();

header("Location: /ProjectIII/PHP_Files/User_Dashboard.php#tasks");

exit();
?>  