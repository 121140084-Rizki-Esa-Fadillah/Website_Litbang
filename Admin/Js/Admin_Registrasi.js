document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registration-form");
    const passwordInput = document.getElementById("password");
    const confirmInput = document.getElementById("confirm-password");

    form.addEventListener("submit", function(event) {
        // Ambil nilai dari password dan konfirmasi password
        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

        // Cek apakah password memenuhi kriteria
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!passwordPattern.test(password)) {
            // Jika password tidak memenuhi kriteria, tampilkan pesan kesalahan
            alert("Password harus memiliki minimal 8 karakter, mencakup huruf besar, huruf kecil, dan angka.");
            event.preventDefault(); // Mencegah form dikirim
        } else if (password !== confirmPassword) {
            // Jika password dan konfirmasi password tidak cocok
            alert("Password dan konfirmasi password tidak cocok.");
            event.preventDefault(); // Mencegah form dikirim
        }
    });

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

    function toggleConfirmPassword() {
        const confirmPasswordField = document.getElementById('confirm-password');
        const toggleIcon = document.getElementById('toggle-confirm-password');
        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Attach event listeners to icons
    document.getElementById('toggle-password').addEventListener('click', togglePassword);
    document.getElementById('toggle-confirm-password').addEventListener('click', toggleConfirmPassword);
});
