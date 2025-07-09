<!-- login.php -->
<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - IntelliTask</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-white min-h-screen flex items-center justify-center py-10 px-4">

  <div class="w-full sm:max-w-md bg-white shadow-2xl rounded-2xl px-8 py-10">
    <h2 class="text-3xl font-bold text-indigo-700 text-center mb-6">Hey 👋, Log In</h2>

    <form action="login_backend.php" method="POST" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" required
               value="<?= htmlspecialchars($_GET['username'] ?? '') ?>"  
               class="w-full mt-1 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

        <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 flex justify-between items-center">
          <span>Password</span>

          <!-- Eye Toggle in Styled Container -->
          <button type="button" id="togglePasswordUser"
                  class="bg-indigo-200 hover:bg-indigo-300 text-indigo-600 border border-indigo-500 rounded-full p-1.5 transition duration-200 focus:outline-none shadow-sm"
                  title="Show/Hide Password">
            👁️
          </button>
        </label>

        <input type="password" id="password" name="password" required
              value="<?= htmlspecialchars($_GET['password'] ?? '') ?>"
              class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>


      <div>
        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">
          Log In
        </button>

      </div>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Don't have an account? 
      <a href="signup_form.php" class="text-indigo-600 hover:underline">Sign up</a>
    </p>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('error') === 'username') {
      Swal.fire({
        icon: 'error',
        title: 'Username Not Found',
        text: 'The username you entered does not exist. Please try again.',
        confirmButtonColor: '#ef4444', // red-500
      });
    } else if (urlParams.get('error') === 'password') {
      Swal.fire({
        icon: 'error',
        title: 'Incorrect Password',
        text: 'The password you entered is incorrect. Please try again.',
        confirmButtonColor: '#ef4444',
      });
    }

  </script>

  <script>
     document.getElementById("togglePasswordUser").addEventListener("click", function () {
        var passwordField = document.getElementById("password"); // getting the password from the Login Password .....
        
        // Toggle the type attribute between password and text
        if (passwordField.type === "password") 
        {
            passwordField.type = "text";  // Show password
            this.textContent = "🙈";     // Change icon to "eye with slash"
        } 
        else 
        {
            passwordField.type = "password";  // Hide password
            this.textContent = "👁️";          // Change back to "eye" icon
        }
    });
    </script>
</body>
</html>
