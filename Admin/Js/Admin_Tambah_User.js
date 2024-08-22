document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("tambah-user-form");
    const passwordInput = document.getElementById("password");
    const confirmInput = document.getElementById("confirm-password");

    form.addEventListener("submit", function(event) {
        // Ambil nilai dari password dan konfirmasi password
        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

        // Cek apakah password dan konfirmasi password cocok
        if (password !== confirmPassword) {
            // Jika tidak cocok, tampilkan pesan kesalahan dan batalkan pengiriman form
            alert("Password dan konfirmasi password tidak cocok.");
            event.preventDefault(); // Mencegah form dikirim
        }
    });
});

// Fungsi untuk toggle password visibility
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

// Fungsi untuk toggle confirm password visibility
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
