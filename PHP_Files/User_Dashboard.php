<?php
    //echo "Welcome to User Dashbaord";
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
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">Dashboard</h2>
      <p>Welcome to your IntelliTask dashboard. Quick overview of your task stats and progress will be shown here.</p>
    </section>

    <section id="tasks" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">My Tasks</h2>
      <p>Here you'll manage your tasks with deadlines, priorities, and progress tracking.</p>
    </section>

    <section id="insights" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">AI Insights</h2>
      <p>This section will show smart suggestions and AI-driven task recommendations.</p>
    </section>

    <section id="notifications" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">Notifications</h2>
      <p>Your task reminders and system updates will appear here.</p>
    </section>

    <section id="profile" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">Profile & Settings</h2>
      <p>Update your account info, password, timezone, preferences, and more.</p>
    </section>

    <section id="support" class="min-h-screen p-8 bg-gray-50 shadow-inner">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4">Help & Support</h2>
      <p>Frequently asked questions, documentation, and support contact info.</p>
    </section>

    <section id="logout" class="min-h-screen p-8 bg-white shadow-inner">
      <h2 class="text-3xl font-bold text-red-600 mb-4">Logout</h2>
      <p>Click to securely log out from IntelliTask.</p>
    </section>
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
</body>
</html>

