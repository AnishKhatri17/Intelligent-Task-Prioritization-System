<?php     
 if(!isset($_SESSION)) session_start(); // Start the session if not set

// Including the database connection "config file"
include '../PHP_Files/config.php'; // This is the path based on my project structure

$userId = $_SESSION['user_id'];
$query = $conn->prepare("SELECT fullname, username, email, timezone FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($fullname, $username, $email, $timezone);
$query->fetch();
$query->close();  

// New query to fetch updated_at only...
$updatedQuery = $conn->prepare("SELECT updated_at FROM users WHERE id = ?");
$updatedQuery->bind_param("i", $userId);
$updatedQuery->execute();
$updatedQuery->bind_result($updatedAt);
$updatedQuery->fetch();
$updatedQuery->close();
?>

<!-- Stylish container to show updated time -->
<div class="flex justify-end mt-2">
<div  class="inline-block float-right mt-1 px-3 py-1 bg-indigo-100 border border-indigo-300 text-indigo-800 rounded-md text-xs sm:text-sm shadow-sm">
    <?php
    if (!empty($updatedAt)) {
        echo "🕒 Last Updated: <strong>" . date("F j, Y g:i A", strtotime($updatedAt)) . "</strong>";
    } else {
        echo "📝Last Updated: <strong>Profile not updated yet!</strong>";
    }
    ?>
</div>
</div><br>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-200 hover:shadow-2xl transition-all duration-300 ease-in-out">
    <form action="User_Dashboard_Sections/Profile_Section/profile_update_backend.php" method="POST" class="space-y-6" onsubmit="return confirmUpdate(event)">
        <div>
            <label class="block mb-1 font-medium text-indigo-700">Full Name: </label>
            <input type="text" name="fullname" value="<?= htmlspecialchars($fullname) ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-indigo-700">Username: </label>
            <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-indigo-700">Email: </label>
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-indigo-700">Timezone: </label>
            <select name="timezone" id="timezone" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
            <?php
            $timezone_options = [
            "Asia/Kathmandu" => "Asia/Kathmandu (GMT+5:45)",
            "Asia/Kolkata" => "Asia/Kolkata (GMT+5:30)",
            "Asia/Dubai" => "Asia/Dubai (GMT+4)",
            "Asia/Tokyo" => "Asia/Tokyo (GMT+9)",
            "Asia/Singapore" => "Asia/Singapore (GMT+8)",
            "Asia/Shanghai" => "Asia/Shanghai (GMT+8)",
            "Asia/Jakarta" => "Asia/Jakarta (GMT+7)",
            "Europe/London" => "Europe/London (GMT+0)",
            "Europe/Berlin" => "Europe/Berlin (GMT+1)",
            "Europe/Moscow" => "Europe/Moscow (GMT+3)",
            "Europe/Paris" => "Europe/Paris (GMT+1)",
            "Africa/Nairobi" => "Africa/Nairobi (GMT+3)",
            "Africa/Johannesburg" => "Africa/Johannesburg (GMT+2)",
            "America/New_York" => "America/New_York (GMT-5)",
            "America/Chicago" => "America/Chicago (GMT-6)",
            "America/Los_Angeles" => "America/Los_Angeles (GMT-8)",
            "America/Toronto" => "America/Toronto (GMT-5)",
            "America/Vancouver" => "America/Vancouver (GMT-8)",
            "America/Sao_Paulo" => "America/Sao_Paulo (GMT-3)",
            "Australia/Sydney" => "Australia/Sydney (GMT+10)",
            "Pacific/Auckland" => "Pacific/Auckland (GMT+12)",
            ];

            echo '<option value="">Select your time zone</option>';
            foreach ($timezone_options as $tz_value => $tz_label) {
            $selected = ($tz_value === $timezone) ? 'selected' : '';
            echo "<option value=\"$tz_value\" $selected>$tz_label</option>";
            }
            ?>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium text-red-600">Current Password: <span class="text-sm text-gray-500">(<span class="text-red-600">**</span>required for verification)</span></label>
            <input type="password" name="current_password" required class="w-full px-4 py-2 border border-red-400 rounded-lg focus:ring-2 focus:ring-red-500">
        </div>

        <div class="relative">
            <label class="block mb-1 font-medium text-indigo-700">New Password: <span class="text-sm text-gray-500">(leave blank to keep current password unchanged)</span></label>
            <input type="password" name="new_password" id="new_password" class="w-full px-4 py-2 border border-red-400 rounded-lg focus:ring-2 focus:ring-red-500:">
            <span onclick="togglePassword('new_password', this)" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">👁️</span>
            <p id="password-strength-text" class="mt-1 text-sm font-medium"></p>
            <div id="password-strength-bar" class="h-2 rounded bg-gray-200 overflow-hidden">
              <div id="password-strength-fill" class="h-full w-0 bg-red-500 transition-all duration-300 ease-in-out"></div>
            </div>
        </div>

          <div class="relative">
            <label class="block mb-1 font-medium text-indigo-700">Re-Enter New Password: <span class="text-sm text-gray-500">(please re-enter your new password)</span></label>
            <input type="password" name="confirm_password" id="confirm_password" class="w-full px-4 py-2 border border-red-400 rounded-lg focus:ring-2 focus:ring-red-500:">
            <span onclick="togglePassword('confirm_password', this)" class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">👁️</span>
        </div>
      
        <div class="text-center pt-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Update Profile</button>
        </div>
    </form>
</div>

<!-- SweetAlert script for confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate(e){
    e.preventDefault(); //This is to Prevent the default form submission

    const newPass = document.getElementById('new_password').value.trim();
    const confirmPass = document.getElementById('confirm_password').value.trim();

  // Only validate if new password is entered
    if(newPass !== '') {
    // Checking the minimum length of new password (min 8 characters)
    if (newPass.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Password is too short!',
            text: 'New password must be at least 8 characters long.',
            confirmButtonColor: '#4f46e5'
        });
        return false;
    }

    // Validate match only if password is not empty
    if (newPass !== confirmPass) {
        Swal.fire({
            icon: 'error',
            title: 'Inconsistent Passwords',
            text: 'New password and Confirm Password do not match!',
            confirmButtonColor: '#4f46e5'
        });
        return false;
    }
}

    // If everything is fine, let's show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text : 'You are about to update your profile information.',
            icon : 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, I want to Update.',
            cancelButtonText : 'No, Cancel', 
            confirmButtonColor: '#4f46e5',
            cancelButtonColor : '#6b7280'
        }).then((result) => {
            if(result.isConfirmed){
                e.target.submit(); //Okay, Submit the form if user confirms !
            }
        });
            return false;
    }
</script>

<script>
<?php if(isset($_SESSION['update_success'])): ?>
    Swal.fire('Updated!', '<?= $_SESSION["update_success"] ?>', 'success');
    <?php unset($_SESSION['update_success']); ?>
    <?php elseif(isset($_SESSION['update_error'])): ?>
        Swal.fire('Error!', '<?= $_SESSION['update_error'] ?>', 'error');
        <?php unset($_SESSION['update_error']); ?>
    <?php endif; ?>
</script>   


<!-- Logics for Timezone Dropdown Selection -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

<!-- Styling for Select2 Timezone Dropdown for Updating Profile -->
<style>
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

<!-- Javascript for toggling password visibility -->
<script>
function togglePassword(fieldId, icon) {
    const field = document.getElementById(fieldId);
    if (field.type === "password") {
        field.type = "text";
        icon.textContent = "🙈";
    } else {
        field.type = "password";
        icon.textContent = "👁️";
    }
}
</script>

<script>
document.getElementById('new_password').addEventListener('input', function() {
    const password = this.value;
    const fill = document.getElementById('password-strength-fill');
    const text = document.getElementById('password-strength-text');

    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    let width = ['0%', '20%', '40%', '60%', '80%', '100%'][strength];
    let color = ['bg-red-500', 'bg-yellow-400', 'bg-orange-400', 'bg-blue-500', 'bg-green-400', 'bg-green-600'][strength];
    let label = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'][strength];

    fill.style.width = width;
    fill.className = `h-full ${color} transition-all duration-300 ease-in-out`; 
    text.textContent = label;
    text.className = `mt-1 text-sm font-medium ${color.replace('bg', 'text')}`;
});
</script>
