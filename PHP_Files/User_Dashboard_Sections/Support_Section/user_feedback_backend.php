<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();
    include '../../config.php';

      // Prevent malicious scripts or HTML from being saved or executed.
      function clean_input($data){
      $data = trim($data);  

      // Reject messages with actual HTML tags like <script>, <img>, etc.
      if (preg_match('/<\s*\/?\s*\w+.*?>/', $data)) {
          return false;
      }

      // Block clearly malicious SQL patterns (like trying to inject statements)
      $sqlPattern = "/('|--|\\b(UNION\\s+SELECT|INSERT\\s+INTO|DROP\\s+TABLE|UPDATE\\s+SET|DELETE\\s+FROM)\\b)/i";
      if (preg_match($sqlPattern, $data)) {
          return false;
      }

      // Maximum length check for minimium 10 characters and  maximum 750 characters in backend also...
       if (strlen($data) < 10 || strlen($data) > 750){
        return false;
      }
        // Escape characters for safe DB storage 
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

    if (!isset($_SESSION['user_id'])) {
    echo "<script>
      window.onload = () => {
        Swal.fire({
          icon: 'error',
          title: 'Unauthorized',
          text: 'You must be logged in to send feedback!',
        }).then(() => {
          window.location.href = '../../index.php';
        });
      };
    </script>";
    exit;
  }

    $user_id = $_SESSION['user_id'];
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $message = clean_input($_POST['message']);

if($message === false) // Server side validation if bypassed in frontend browser, Extra security
  { 
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      window.onload = () => {
        Swal.fire({
          icon: 'warning',
          title: 'Invalid Message!!!',
          text: 'Make sure your message is between 10 and 750 characters and does not contain any HTML/script tags.'
        }).then(() => {
          window.history.back();
        });
      };
    </script>";
    exit;
}

    $stmt = $conn->prepare("INSERT INTO user_support_messages (user_id, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $name, $email, $message);

    if($stmt->execute()){
       echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      window.onload = () => {
        Swal.fire({
          icon: 'success',
          title: 'Feedback Sent!',
          text: 'Thanks for contacting us. We’ll get back to you soon.'
        }).then(() => {
          window.location.href = '../../User_Dashboard.php#support';
        });
      };
    </script>";
    }
    else{
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      window.onload = () => {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong. Please try again.'
        }).then(() => {
          window.history.back();
        });
      };
    </script>";
    }
}
?>