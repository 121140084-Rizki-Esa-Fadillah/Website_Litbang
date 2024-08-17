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
