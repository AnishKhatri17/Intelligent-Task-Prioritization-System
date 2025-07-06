<?php
    // Added A PHP
?>
<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IntelliTask - AI Task Management</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/@heroicons/vue@2.0.16/outline/index.min.js" defer></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
    .nav-blur {
      backdrop-filter: blur(12px);
      background-color: rgba(255, 255, 255, 0.7);
    }
    .section {
      min-height: 100vh;
      padding-top: 5rem;
      padding-bottom: 5rem;
    }
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease-in-out forwards;
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="font-sans text-gray-800 bg-gradient-to-br from-indigo-50 to-blue-100">

  <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full z-50 nav-blur shadow-md">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
      <h1 class="text-2xl font-bold text-indigo-700">IntelliTask</h1>
      <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="#home" class="hover:text-indigo-600">Home</a>
        <a href="#about" class="hover:text-indigo-600">About</a>
        <a href="#features" class="hover:text-indigo-600">Features</a>
        <a href="#contact" class="hover:text-indigo-600">Contact</a>
      </nav>
      <div class="space-x-4 hidden md:block">
        <a href="signup.php" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Sign Up</a>
        <a href="login.php" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-100 transition">Log In</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="section flex flex-col items-center justify-center text-center px-6 fade-in">
    <h2 class="text-5xl md:text-6xl font-bold text-indigo-800 mb-4 leading-tight">AI-Powered Task Mastery</h2>
    <p class="text-xl md:text-2xl text-gray-700 max-w-2xl mb-8">Plan smart. Work efficiently. Let IntelliTask guide your productivity journey with intelligent automation.</p>
    <a href="signup.php" class="px-8 py-4 bg-indigo-600 text-white text-lg rounded-lg hover:bg-indigo-700 transition transform hover:scale-105">Start Your Journey</a>
  </section>

  <!-- About Section -->
  <section id="about" class="section bg-white flex items-center fade-in">
    <div class="max-w-6xl mx-auto px-4 md:flex md:items-center">
      <div class="md:w-1/2 mb-6 md:mb-0">
        <img src="./images/About_Page.jpg" alt="About Image" class="w-full max-w-sm mx-auto">
      </div>
      <div class="md:w-1/2 text-center md:text-left">
        <h3 class="text-4xl font-semibold text-indigo-700 mb-4">What is IntelliTask?</h3>
        <p class="text-lg text-gray-700">IntelliTask is your intelligent task assistant built for modern users who want smarter ways to manage time. From daily task tracking to AI-driven priority suggestions, we cover it all. Let AI do the thinking while you focus on what matters most.</p>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="section bg-gradient-to-r from-indigo-50 via-blue-100 to-indigo-50 fade-in">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h3 class="text-4xl font-semibold text-indigo-700 mb-10">Features You'll Love</h3>
      <div class="grid md:grid-cols-3 gap-10">
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <img src="./images/AI_Recommendation.png" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-xl font-bold text-indigo-600 mb-2">AI Task Recommendations</h4>
          <p class="text-gray-600">Personalized suggestions based on past habits and deadlines.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <img src="./images/Custom_Scheduling.png" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-xl font-bold text-indigo-600 mb-2">Custom Scheduling</h4>
          <p class="text-gray-600">Create flexible plans—daily, weekly, or completely custom routines.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <img src="./images/Progress_Insight.jpg" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-xl font-bold text-indigo-600 mb-2">Progress Insights</h4>
          <p class="text-gray-600">Visualize how far you've come and what’s left with intelligent charts.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <img src="./images/Mobile_Friendly.jpg" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-xl font-bold text-indigo-600 mb-2">Mobile Friendly</h4>
          <p class="text-gray-600">Access your dashboard anytime, anywhere with responsive design.</p>
        </div>
       <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
        <img src="./images/Notification_Reminder.jpg" class="w-12 h-12 mx-auto mb-4" />
        <h4 class="text-xl font-bold text-indigo-600 mb-2">Smart Reminders & Notifications</h4>
        <p class="text-gray-600">Stay on track with intelligent alerts for upcoming deadlines and overdue tasks—never miss a thing.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2">
          <img src="./images/Secure_Login.jpg" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-xl font-bold text-indigo-600 mb-2">Secure Login System</h4>
          <p class="text-gray-600">Your data is protected with secure authentication protocols.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ✅ Contact Section -->
 <section id="contact" class="min-h-screen pb-20 bg-gradient-to-br from-white via-blue-50 to-indigo-50 text-gray-800 fade-in">
  <div class="w-full h-full flex flex-col">
    
    <!-- Heading -->
    <div class="text-center px-4 pt-8">
      <h3 class="text-4xl font-semibold text-indigo-700 mb-2">Let’s Connect</h3>
      <p class="text-gray-700 text-lg">Have questions, feedback, or ideas to share? We'd love to hear from you.</p>
    </div>

    <!-- Main Grid -->
    <div class="flex-1 flex flex-col md:flex-row items-stretch mt-6 md:mt-0 md:gap-6 px-4 md:px-12">
      
      <!-- Left Image -->
      <div class="md:w-1/2 w-full h-1/2 md:h-full flex-shrink-0 rounded-lg overflow-hidden shadow-md">
        <img src="./images/Contact-Us-Image.jpg" alt="Contact Us"
             class="w-full h-full object-cover object-center" />
      </div>

      <!-- Right Form -->
      <div class="md:w-1/2 w-full h-1/2 md:h-full bg-white p-6 md:p-12 flex flex-col justify-center rounded-lg shadow-md">
        <div class="w-full max-w-lg mx-auto h-full flex flex-col justify-center max-h-full">
          <form action="#" method="post" class="space-y-6 flex-grow">
            <div>
              <label class="block text-left font-medium mb-1">Your Name</label>
              <input type="text" name="name" placeholder="Enter Your Name" required
                     class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <div>
              <label class="block text-left font-medium mb-1">Your Email</label>
              <input type="email" name="email" placeholder="Enter Your Email" required
                     class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <div>
              <label class="block text-left font-medium mb-1">Your Message</label>
              <textarea name="message" rows="4" placeholder="Type your message here..." required
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">Send Message</button>
          </form>

          <!-- Contact Info -->
          <div class="mt-6 text-sm text-gray-600">
            <p><strong>Email:</strong> <a href="mailto:smctu444@gmail.com" class="text-indigo-600 hover:underline">smctu444@gmail.com</a></p>
            <p><strong>Phone:</strong> +977-9800000000</p>
            <p><strong>Location:</strong> Kathmandu, Nepal</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="bg-indigo-800 text-white text-center py-5">
    <p>2025 Intelligent Task Prioritization System. Copyright &copy; <strong>Anish Khatri</strong> - All rights reserved. </p>
  </footer>

</body>
</html>
