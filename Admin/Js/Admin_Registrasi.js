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
});
