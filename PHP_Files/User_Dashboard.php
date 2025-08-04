<?php
    session_start();

    // Auto Logout after 2 hours (2 hours is 7200 seconds) of inactiivity 
    $timeout = 7200;

    if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout){
      // Session expired due to inactivity
      session_unset(); // Okay, Unset all session variables
      session_destroy(); // Now, Destroy the session
      header("Location: /ProjectIII/PHP_Files/login.php?session_expired=1"); // Redirect to login page
      exit();
    }

    // update the user last activity time
    $_SESSION['last_activity'] = time();

    // Okay, enusuring that only logged-in users can access the dashboard
    if(!isset($_SESSION['user_id'])){
        header("Location: /ProjectIII/PHP_Files/login.php");
        exit();
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>IntelliTask - User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="flex h-screen overflow-hidden bg-gray-100">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 h-full w-64 bg-indigo-700 text-white z-40 hidden lg:block">
    <div class="p-6 text-2xl font-bold">IntelliTask</div>
 <nav class="space-y-4 p-4">
  <a href="#dashboard" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">Dashboard</a>
  <a href="#tasks" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">My Tasks</a>
  <a href="#insights" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">AI Insights</a>
  <a href="#notifications" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">Notifications</a>
  <a href="#profile" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">Profile & Settings</a>
  <a href="#support" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">Help & Support</a>
  <a href="#" onclick="confirmLogout()" class="block w-full text-center px-4 py-3 bg-indigo-900 hover:bg-indigo-400 hover:ring-2 hover:ring-indigo-300 hover:scale-105 transform rounded-xl shadow-md text-white font-medium transition-all duration-200 ease-in-out">Logout</a>  
</nav>

  </aside>

  <!-- Mobile Hamburger -->
  <div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="menuBtn" class="text-indigo-700 focus:outline-none">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <!-- Mobile Sidebar -->
  <aside id="mobileMenu" class="fixed top-0 left-0 h-full w-64 bg-indigo-700 text-white z-50 transform -translate-x-full transition-transform duration-300 lg:hidden">
    <div class="p-6 text-2xl font-bold">IntelliTask</div>
    <nav class="space-y-2 p-4">
      <a href="#dashboard" class="block px-4 py-2 rounded hover:bg-indigo-600">Dashboard</a>
      <a href="#tasks" class="block px-4 py-2 rounded hover:bg-indigo-600">My Tasks</a>
      <a href="#insights" class="block px-4 py-2 rounded hover:bg-indigo-600">AI Insights</a>
      <a href="#notifications" class="block px-4 py-2 rounded hover:bg-indigo-600">Notifications</a>
      <a href="#profile" class="block px-4 py-2 rounded hover:bg-indigo-600">Profile & Settings</a>
      <a href="#support" class="block px-4 py-2 rounded hover:bg-indigo-600">Help & Support</a>
      <a href="#logout" class="block px-4 py-2 rounded hover:bg-red-600">Logout</a>
    </nav>
  </aside>

  <!-- Dashboard Content -->
  <main class="flex-1 lg:ml-64 overflow-y-auto">
    <section id="dashboard" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">IntelliTask Dashboard</h2>
      <?php include 'User_Dashboard_Sections/Dashboard_Home_Section/dashboard_home.php'; ?>
    </section>

    <section id="tasks" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">My Tasks</h2>
      <?php include 'User_Dashboard_Sections/My_Task_Section/my_tasks_section.php'; ?>
    </section>

    <section id="insights" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">AI Insights</h2>
      <?php include 'User_Dashboard_Sections/Insights_Section/insights_section.php'; ?>
    </section>

    <section id="notifications" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">Notifications</h2>
      <?php include 'User_Dashboard_Sections/Notifications_Section/notifications_section.php'; ?>
    </section>

    <section id="profile" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">Profile & Settings</h2>
      <?php include 'User_Dashboard_Sections/Profile_Section/profile_section.php'; ?>
    </section>

    <section id="support" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl text-center font-bold text-indigo-700 mb-4">Help & Support</h2>
      <?php include 'User_Dashboard_Sections/Support_Section/support_section.php'; ?>
    </section>

    <!-- Logout Section (No additional UI or usage is needed for logout !!)-->
    <!-- <section id="logout" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl text-center font-bold text-red-600 mb-4">Logout</h2>
    </section> -->
  </main>

  <!-- JavaScript -->
  <script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('-translate-x-full');
    });

    const links = mobileMenu.querySelectorAll('a');
    links.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('-translate-x-full');
      });
    });
  </script>

    <!-- SweetAlert2 for Logout Confirmation js Logic -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  function confirmLogout() {
    Swal.fire({
      title: 'Are you sure you want to logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout',
      cancelButtonText: 'Cancel',
      color: '#1e1b4b', // Darker text color to contrast well ..
    }).then((result) => {
      if (result.isConfirmed) {
        // If user clicks "Yes", redirect to logout process php file
        window.location.href = '/ProjectIII/PHP_Files/user_Dashboard_Sections/logout_process.php';
      }
      // If canceled, do nothing (stay on the dashboard page.......)
    });
  }
</script>

</body>
</html>

