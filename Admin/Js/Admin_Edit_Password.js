document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("edit-password-form");
    const passwordInput = document.getElementById("password-baru");
    const confirmInput = document.getElementById("confirm-password-baru");

    form.addEventListener("submit", function(event) {
        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

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
