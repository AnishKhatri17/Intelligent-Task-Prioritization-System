<?php if (!isset($_SESSION)) session_start(); ?>

<!-- FAQ Section -->
  <div class="max-w-3xl mx-auto mb-12">
    <h3 class="text-2xl font-semibold text-red-700 mb-4">Frequently Asked Questions❓</h3>
    <div id="faq-container" class="space-y-1">
      <?php
        $faqs = [
          ["What is IntelliTask?", "IntelliTask is a smart task management system that helps you create, track, and get AI-based suggestions to stay productive."],
          ["How can I add a new task?", "Go to 'My Tasks' section from the dashboard sidebar, fill the form with task details, and click on 'Add Task'."],
          ["How does AI help in productivity?", "The AI engine analyses your task habits, deadlines, and timings to recommend better schedules and reminders."],
          ["How are reminders sent?", "Reminders are sent via on-dashboard notifications. In future versions, email/SMS reminders may also be added."],
          ["Can I update or delete my tasks?", "Yes, each task has an edit and delete button. You can modify or remove tasks anytime."],
          ["Is my data secure in IntelliTask?", "Absolutely! Your data is tied to your user ID and safely stored in a secured MySQL database."],
          ["How can I contact support?", "Use the feedback form below. You can also reach us from the main website contact section."]
        ];

        foreach($faqs as $index => $faq){
          echo '
          <div class="border border-indigo-300 rounded-xl bg-indigo-50 shadow-sm">
            <button class="faq-toggle w-full text-left px-5 py-4 font-medium text-indigo-700 hover:bg-indigo-100 focus:outline-none flex justify-between items-center">
              <span>'.$faq[0].'</span>
              <svg class="w-5 h-5 transform transition-transform duration-300 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg> 
            </button>
            <div class="faq-answer px-5 pb-4 text-gray-900 hidden"><i>'.$faq[1].'</i></div>
          </div>';
        }
      ?>
    </div>
  </div>

  <!-- Help & Feedback Form -->
  <h3 class="text-2xl font-semibold text-gray-700 text-center mb-4">
💬 Have questions, feedback, or ideas to share? 🤔<br> We'd love to hear from you! ❤️
</h3>
  <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl border border-gray-200 p-8 hover:shadow-2xl transition-all duration-300 ease-in-out">
        <h3 class="text-2xl font-semibold text-indigo-700 text-center mb-4">Let’s Connect with IntelliTask🤍</h3>
    <form id="supportForm" action="User_Dashboard_Sections/Support_Section/user_feedback_backend.php" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Your Name: </label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['fullname']); ?>" readonly required class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
        </div>
        <div>
        <label class="block text-sm font-medium text-gray-700">Your Email: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly required class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Your Message: </label>
        <textarea name="message" id="message" rows="4" maxlength="750" required class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400"  placeholder="Please write your feedback (min 10 characters and max 750 characters)... You can also use emoji if you like. 😊"></textarea>
        <p class="text-sm text-right text-gray-500 mt-1">
         <span id="charCount">0</span> / 750 characters
        </p>
      </div>
      <button type="submit" class="bg-indigo-700 hover:bg-indigo-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all">Send Message</button>
    </form>
  </div>

<!-- jQuery for FAQ toggle and basic validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('.faq-toggle').click(function(){
    const answer = $(this).next('.faq-answer');
    const icon = $(this).find('svg');

    $('.faq-answer').not(answer).slideUp();
    $('.faq-toggle svg').not(icon).removeClass('rotate-180');

    answer.slideToggle();
    icon.toggleClass('rotate-180');
  });

  // Basic validation for support form
  $('#supportForm').submit(function(e){
  const message = $('textarea[name="message"]').val().trim();
  // Regex to detect actual HTML/script tags like <script>, <img>, <div> etc.
  const tagPattern = /<\s*\/?\s*\w+.*?>/i;
  // Regex to detect common malicious SQL keywords/characters *only when used dangerously*
  const sqlPattern = /('|--|\b(UNION\s+SELECT|INSERT\s+INTO|DROP\s+TABLE|UPDATE\s+SET|DELETE\s+FROM)\b)/i;

  if (message.length < 10) {
    Swal.fire({
      icon: 'warning',
      title: 'Too Short!',
      text: 'Your message should be at least 10 characters long.',
    });
    e.preventDefault();
    return;
  }

  if (tagPattern.test(message) || sqlPattern.test(message)) {
    Swal.fire({
      icon: 'error',
      title: 'Invalid Input!',
      html: '<span style="color:red; font-size:24px;"><strong>Warning!!!</strong></span><br>HTML or script tags and Malicious SQL are <b>not allowed</b> in the message.',
    });
    e.preventDefault();
    return;
  }
});

// For live character count
$('#message').on('input', function() {
  const length = $(this).val().length;
  $('#charCount').text(length);

  if(length > 700){
    $('#charCount').addClass('text-red-600 font-semibold');
  } 
  else 
    {
    $('#charCount').removeClass('text-red-600 font-semibold');
     }
});
</script>