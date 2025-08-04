<?php
    // echo "<p>Here you'll manage your tasks with deadlines, priorities, and progress tracking.</p>";
?>

<!-- Flatpickr CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-4 min-h-[100vh] flex flex-col justify-center hover:shadow-2xl transition-all duration-300 ease-in-out">
  <h3 class="text-2xl font-bold text-indigo-700 mb-6 text-center">Create New Task</h3>
  <form action="/ProjectIII/PHP_Files/User_Dashboard_Sections/My_Task_Section/task_create_backend.php" method="POST" class="space-y-5" onsubmit="return validateForm()">
    
    <!-- Task Title -->
    <div>
      <label class="block text-sm font-medium text-gray-700">Task Title <span class="text-red-500">*</span></label>
      <input type="text" name="title" id="title" maxlength="50" autocomplete="off"
             class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"/>
    </div>

    <!-- Description -->
    <div>
      <label class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
      <textarea name="description" rows="3" id="description" maxlength="250" autocomplete="off"
                class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
    </div>

    <!-- Due Date & Time -->
    <div>
      <label class="block text-sm font-medium text-gray-700">Task Date and Time <span class="text-red-500">*</span></label>
    <!-- Displayed to user -->
      <input type="text" id="due_datetime_display"
       class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
       placeholder="Select due date and time"  readonly />

    <!-- Hidden real value for backend -->
      <input type="hidden" name="due_datetime" id="due_datetime" />  
       </div>

    <!-- Priority -->
      <div>
      <label class="block text-sm font-medium text-gray-700">Priority <span class="text-red-500">*</span></label>
      <select name="priority" id="priority"
              class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
             >
        <option value="None" selected disabled>-- Select Priority --</option>
        <option value="Urgent">Urgent</option>
        <option value="High">High</option>
        <option value="Medium">Medium</option>
        <option value="Low">Low</option>
        <option value="Optional">Optional</option>
      </select>
    </div>

    <!-- Frequency -->
    <div>
      <label class="block text-sm font-medium text-gray-700">Frequency <span class="text-red-500">*</span></label>
      <select name="frequency" id="frequency"
              class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" >
        <option value="None" selected disabled>-- Select Frequency --</option>
        <option value="One-time">One-time</option>
        <option value="Daily">Daily</option>
        <option value="Weekly">Weekly</option>
        <option value="Monthly">Monthly</option>
        <option value="Yearly">Yearly</option>
      </select>
    </div>

    <!-- Category -->
    <div>
      <label class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
      <select name="category" id="category"
              class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        <option value="None" selected disabled>-- Select Category --</option>
        <option value="Work">Work</option>
        <option value="Study">Study</option>
        <option value="Personal">Personal</option>
        <option value="Health">Health</option>
        <option value="Finance">Finance</option>
        <option value="Shopping">Shopping</option>
        <option value="Errands">Mini Tasks</option>
        <option value="Hobby">Hobby</option>
        <option value="Hobby">Meeting</option>
        <option value="Other">Other</option>
      </select>   
    </div>

    <!-- Submit Button -->
    <div class="text-center">
      <button type="submit"
              class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">
        Add Task
      </button>
    </div>
  </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    flatpickr("#due_datetime_display", {
      enableTime: true,
      altInput: false,
      dateFormat: "F j, Y h:i K", // This is user-friendly format for readability...
      minDate: "today",
      onClose: function(selectedDates, dateStr, instance) {
        const selected = selectedDates[0];
        const now = new Date();

        if (selected && selected < now) {
          Swal.fire({
            icon: 'error',
            title: 'Invalid Time',
            text: 'You cannot select a past date or time.',
            confirmButtonColor: '#ef4444'
          });
          instance.clear();
          document.getElementById("due_datetime").value = '';
        } 
        else {
          const backendFormat = selected.toISOString().slice(0, 16).replace("T", " ");
          document.getElementById("due_datetime").value = backendFormat;
        }
      }
    });
  });

  function validateForm() {
    const titleField = document.getElementById('title');
    const descriptionField = document.getElementById('description');
    const datetimeField = document.getElementById('due_datetime');
    const datetimeDisplayField = document.getElementById('due_datetime_display');
    const priorityField = document.getElementById('priority');
    const frequencyField = document.getElementById('frequency');
    const categoryField = document.getElementById('category');

    const showError = (field, title, text) => {
  Swal.fire({
    icon: 'error',
    title: title,
    text: text,
    confirmButtonColor: '#ef4444'
  }).then(() => {
    setTimeout(() => {
      field.scrollIntoView({ behavior: 'smooth', block: 'center' });
      field.blur();
      field.focus();
    }, 300);
  });
};
    //-- Client Side Form Validation (To MAKE MY TASK FORM SECURE FROM ATTACKS!)-- //

     // Utility to detect scripts or HTML
   const containsScriptOrHTML = (str) => /<script\b[^>]*>(.*?)<\/script>|<\/?\w+[^>]*>/gi.test(str);

  // Title Validation
  const title = titleField.value.trim();
  if (title === "") {
    showError(titleField, 'Missing Task Title', 'Please enter a task title.');
    return false;
  }
  if (title.length > 50) {
    showError(titleField, 'Title Too Long', 'Task title must be under 50 characters.');
    return false;
  }
  if (containsScriptOrHTML(title)) {
    showError(titleField, 'Invalid Title', 'Title contains forbidden HTML or script content. Please Try Again !');
    return false;
  }

  // Description Validation
  const description = descriptionField.value.trim();
  if (description === "") {
    showError(descriptionField, 'Missing Description', 'Please provide a description.');
    return false;
  }
  if (description.length > 250) {
    showError(descriptionField, 'Description Too Long', 'Description must be under 250 characters.');
    return false;
  }
  if (containsScriptOrHTML(description)) {
    showError(descriptionField, 'Invalid Description', 'Description contains forbidden HTML or script content. Please Try Again !');
    return false;
  }

  // Date/Time
  if (!datetimeField.value) {
    showError(datetimeDisplayField, 'Missing Due Date/Time', 'Please select a due date and time.');
    return false;
  }

  //  Dropdown Validations
  if (!priorityField.value || priorityField.value === "None") {
    showError(priorityField, 'Missing Priority', 'Please select a priority.');
    return false;
  }

  if (!frequencyField.value || frequencyField.value === "None") {
    showError(frequencyField, 'Missing Frequency', 'Please select how often this task occurs.');
    return false;
  }

  if (!categoryField.value || categoryField.value === "None") {
    showError(categoryField, 'Missing Category', 'Please choose a task category.');
    return false;
  }

  return true;
}
</script>


<?php if (isset($_SESSION['task_success'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'success',
        title: 'Task Created!',
        text: '<?php echo addslashes($_SESSION['task_success']); ?>',
        background: '#d1fae5', // soft green
        color: '#065f46', // dark green text
        iconColor: '#10b981', // green check
        confirmButtonColor: '#6366F1', // green confirm button
        customClass: {
          popup: 'rounded-xl shadow-lg'
        }
      }).then(() => {
        // Make sure user stays on the #tasks section
        window.location.hash = '#tasks';
      });
    });
  </script> 
  
  <?php unset($_SESSION['task_success']); ?>
<?php endif; ?>
