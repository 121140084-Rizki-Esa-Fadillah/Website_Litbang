const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('error') && urlParams.get('error') === 'invalid_credentials') {
            // Tampilkan alert jika login gagal
            alert('Username atau password salah');
      }

      function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password');
            if (passwordField.type === 'password') {
                  passwordField.type = 'text';
                  toggleIcon.classList.remove('fa-eye');
                  toggleIcon.classList.add('fa-eye-slash');
            } else {
                  passwordField.type = 'password';
                  toggleIcon.classList.remove('fa-eye-slash');
                  toggleIcon.classList.add('fa-eye');
            }
      }