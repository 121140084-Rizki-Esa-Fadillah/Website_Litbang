document.addEventListener('DOMContentLoaded', function() {
      const notification = document.getElementById('notification');
      if (notification) {
          setTimeout(() => {
              notification.classList.remove('show');
          }, 5000);
      }
  });
  