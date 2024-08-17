document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registration-form");
    const passwordInput = document.getElementById("password-baru");
    const confirmInput = document.getElementById("confirm-password-baru");

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
