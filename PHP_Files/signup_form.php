<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - IntelliTask</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
  <!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
  /* css for timezone selection */
  .select2-container--default .select2-selection--single {
    height: 2.75rem; /* match Tailwind input height */
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 2rem;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 2.5rem;
    right: 10px;
  }
</style>

</head>
<body class="bg-gradient-to-br from-indigo-50 to-white min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md mx-4 bg-white shadow-2xl rounded-2xl px-8 py-10 my-6">
    <h2 class="text-3xl font-bold text-indigo-700 text-center mb-6">Create Your Account</h2>
    <form action="signup_form_backend.php" method="POST" onsubmit="return validateForm()" class="space-y-4" novalidate> 
        <!-- novalidate in <form> tag used to bypass browser's built -in validation -->
      <div>
        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" name="fullname" id="fullname" required
               pattern="[A-Za-z\s]{3,50}" title="Only letters and spaces allowed, min 3 characters"
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" name="email" id="email" required
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" required
               pattern="^[a-zA-Z0-9_]{4,20}$" title="Username must be 4-20 characters, alphanumeric or underscores"
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" minlength="6" required
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <p id="password-error" class="text-red-500 text-sm mt-1 hidden">Passwords do not match.</p>
      </div>

      <div>
        <label for="timezone" class="block text-sm font-medium text-gray-700">Time Zone</label>
        <select name="timezone" id="timezone" required
                class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
          <option value="">Select your time zone</option>
          <option value="Asia/Kathmandu">Asia/Kathmandu (GMT+5:45)</option>
          <option value="Asia/Kolkata">Asia/Kolkata (GMT+5:30)</option>
          <option value="Asia/Dubai">Asia/Dubai (GMT+4)</option>
          <option value="Asia/Tokyo">Asia/Tokyo (GMT+9)</option>
          <option value="Asia/Singapore">Asia/Singapore (GMT+8)</option>
          <option value="Asia/Shanghai">Asia/Shanghai (GMT+8)</option>
          <option value="Asia/Jakarta">Asia/Jakarta (GMT+7)</option>
          <option value="Europe/London">Europe/London (GMT+0)</option>
          <option value="Europe/Berlin">Europe/Berlin (GMT+1)</option>
          <option value="Europe/Moscow">Europe/Moscow (GMT+3)</option>
          <option value="Europe/Paris">Europe/Paris (GMT+1)</option>
          <option value="Africa/Nairobi">Africa/Nairobi (GMT+3)</option>
          <option value="Africa/Johannesburg">Africa/Johannesburg (GMT+2)</option>
          <option value="America/New_York">America/New_York (GMT-5)</option>
          <option value="America/Chicago">America/Chicago (GMT-6)</option>
          <option value="America/Los_Angeles">America/Los_Angeles (GMT-8)</option>
          <option value="America/Toronto">America/Toronto (GMT-5)</option>
          <option value="America/Vancouver">America/Vancouver (GMT-8)</option>
          <option value="America/Sao_Paulo">America/Sao_Paulo (GMT-3)</option>
          <option value="Australia/Sydney">Australia/Sydney (GMT+10)</option>
          <option value="Pacific/Auckland">Pacific/Auckland (GMT+12)</option>

        </select>
      </div>

      <div class="flex items-start">
        <input type="checkbox" name="terms" id="terms" required
               class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="terms" class="ml-2 text-sm text-gray-600">
          I agree to the <a href="terms_and_conditions.php"  class="text-indigo-600 hover:underline">terms and conditions</a>
        </label>
      </div>

      <div>
        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">
          Sign Up
        </button>
      </div>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Already have an account? <a href="login.php" class="text-indigo-600 hover:underline">Log in</a>
    </p>
  </div>

  <!-- This is a Secure Client-side Validation Code... -->
<script>
  function sanitizeInput(value) {
    const div = document.createElement('div');
    div.innerText = value;
    return div.innerHTML;
  }

  function validateForm() {
    const fullname = document.getElementById('fullname');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const pass = document.getElementById('password');
    const confirm = document.getElementById('confirm_password');
    const error = document.getElementById('password-error');
    const terms = document.getElementById('terms');

    // Sanitize and trim inputs
    fullname.value = sanitizeInput(fullname.value.trim());
    username.value = sanitizeInput(username.value.trim());
    email.value = sanitizeInput(email.value.trim());

    // Password match check
    if (pass.value !== confirm.value) {
      error.classList.remove('hidden');
      return false;
    } else {
      error.classList.add('hidden');
    }

    // Checkbox check (checkbox must be checked for sign up !!)
    if (!terms.checked) {
      alert("You must agree to the terms and conditions for signing up !!");
      return false;
    }

    return true; // All validations passed and okaieee sign up
  }

</script>

<!-- Script for sweet alert after successful sign up  -->
  <script>
    if (window.location.search.includes('success=1')) {
      Swal.fire({
        title: '🎉 Welcome to IntelliTask!',
        html: '<strong>Your account has been successfully created.</strong><br><strong style="color: green;">Please Log in using your Username and Password.</strong><br><br><i>Start organizing your tasks smarter!</i>',
        icon: 'success',  
        confirmButtonText: 'Go to Login',
        confirmButtonColor: '#4f46e5', // Tailwind indigo-600
        background: 'linear-gradient(to right, #c7d2fe, #e0e7ff)',
        color: '#333',
      }).then(() => {
        window.location.href = 'login.php';
      });
    }
  </script>

  <!-- Select To for Time Zone Selection -->
<script>
  $(document).ready(function() {
    $('#timezone').select2({
      placeholder: "Select your time zone",
      allowClear: true,
      width: '100%'
    });

    $('#timezone').on('select2:open', function() {
      // Select the search box input within the dropdown
      let searchField = document.querySelector('.select2-container--open .select2-search__field');
      if (searchField) {
        searchField.focus();
      }
    });
  });
</script>
</body>
</html>
