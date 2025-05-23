/******/ (() => { // webpackBootstrap
/*!*************************************!*\
  !*** ./assets/src/js/newsletter.js ***!
  \*************************************/
document.addEventListener('DOMContentLoaded', function () {
  var newsletterForm = document.querySelector('.footer-newsletter form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function (e) {
      e.preventDefault();

      // Get form data
      var formData = new FormData(newsletterForm);
      formData.append('action', 'newsletter_ajax_signup');

      // Get notification container or create one if it doesn't exist
      var notificationContainer = document.querySelector('.newsletter-notification');
      if (!notificationContainer) {
        notificationContainer = document.createElement('div');
        notificationContainer.className = 'newsletter-notification mt-4';
        newsletterForm.insertAdjacentElement('afterend', notificationContainer);
      }

      // Show loading message
      notificationContainer.innerHTML = '<div class="bg-gray-100 text-gray-700 px-4 py-3 rounded">Subscribing...</div>';

      // Send AJAX request
      fetch(gns.ajax_endpoint, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        console.log('Newsletter response:', data); // Debug

        if (data.success) {
          // Show success message
          notificationContainer.innerHTML = '<div class="bg-green-100 border border-green-400 text-green-700 px-2 py-1 rounded text-xs">' + '<strong>Thank you!</strong>' + '<span class="block sm:inline"> ' + (data.data && data.data.message ? data.data.message : "You've been successfully subscribed to our newsletter.") + '</span>' + '</div>';

          // Clear the form
          newsletterForm.reset();
        } else {
          // Show error message
          notificationContainer.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">' + '<strong class="font-bold">Error:</strong>' + '<span class="block sm:inline"> ' + (data.data && data.data.message ? data.data.message : "Failed to subscribe. Please try again.") + '</span>' + '</div>';
        }

        // Auto-hide the message after 5 seconds
        setTimeout(function () {
          notificationContainer.innerHTML = '';
        }, 5000);
      })["catch"](function (error) {
        console.error('Newsletter submission error:', error);
        // Show error message
        notificationContainer.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">' + '<strong class="font-bold">Error:</strong>' + '<span class="block sm:inline"> An unexpected error occurred. Please try again.</span>' + '</div>';
      });
    });
  }
});
/******/ })()
;
//# sourceMappingURL=newsletter.js.map