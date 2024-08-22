document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("edit-password-form");
    const passwordInput = document.getElementById("password-baru");
    const confirmInput = document.getElementById("confirm-password-baru");

    form.addEventListener("submit", function(event) {
        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

        // Pola untuk password: minimal 8 karakter, mencakup huruf besar, huruf kecil, dan angka
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!passwordPattern.test(password)) {
            alert("Password harus memiliki minimal 8 karakter, mencakup huruf besar, huruf kecil, dan angka.");
            event.preventDefault(); // Mencegah form dikirim
        } else if (password !== confirmPassword) {
            alert("Password dan konfirmasi password tidak cocok.");
            event.preventDefault(); // Mencegah form dikirim
        }
    });
});

// Fungsi togglePassword harus dideklarasikan di luar event listener DOMContentLoaded agar bisa diakses oleh elemen HTML
function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);
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
