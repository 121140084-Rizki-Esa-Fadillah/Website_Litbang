<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Dashboard.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<bosdy>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <!-- Konten Dashboard -->
            <section id="dashboard">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Dashboard</h2>
            </section>
            <div class="dashboard_admin">
                  <div class="judul_dashboard">
                        <h2>Selamat Datang,</h2>
                        <h3>Admin Litbang Radar Lampung</h3>
                        <ul>
                              <li>
                                    Anda dapat mengelola survei dan melihat analisis data di sini.
                                    Pastikan untuk memperbarui informasi secara berkala.
                              </li>
                              <li>
                                    Teruslah memantau hasil survei dan analisis untuk memastikan kualitas data yang
                                    maksimal.
                              </li>
                        </ul>
                  </div>

                  <div class="total-survey">
                        <div class="total-survey-box">
                              <i class="fa-solid fa-file-lines"></i>
                              <div class="total">
                                    <span>7</span>
                                    <h3>Total Survey</h3>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="cari-container">
                  <h3>Cari Hasil Survey</h3>
                  <div class="search-sort-container">
                        <div class="search-box">
                              <input type="text" placeholder="Search...">
                              <button>
                                    <i class="fa fa-search"></i>
                              </button>
                        </div>
                        <div class="sort-box">
                              <label for="sort">Sorting :</label>
                              <div class="select-container">
                                    <select id="sort">
                                          <option value="lampung_barat">Lampung Barat</option>
                                          <option value="tanggamus">Tanggamus</option>
                                          <option value="lampung_selatan">Lampung Selatan</option>
                                          <option value="lampung_timur">Lampung Timur</option>
                                          <option value="lampung_tengah">Lampung Tengah</option>
                                          <option value="lampung_utara">Lampung Utara</option>
                                          <option value="way_kanan">Way Kanan</option>
                                          <option value="tulang_bawang">Tulang Bawang</option>
                                          <option value="pesawaran">Pesawaran</option>
                                          <option value="pringsewu">Pringsewu</option>
                                          <option value="mesuji">Mesuji</option>
                                          <option value="tulang_bawang_barat">Tulang Bawang Barat</option>
                                          <option value="pesisir_barat">Pesisir Barat</option>
                                          <option value="Bandar_Lampung">Bandar Lampung</option>
                                          <option value="metro">Kota Metro</option>
                                    </select>
                                    <span class="material-symbols-outlined arrow-select">
                                          keyboard_arrow_up
                                    </span>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="hasil">
                  <h3>Judul Survei</h3>
                  <div class="hasil-container">
                        <div class="img"></div>
                        <div class="ket">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                              <p class="wilayah">Wilayah Pelaksanaan Survei :</p>
                              <p>Bandar Lampung, Lampung Selatan, Lampung Timur,......</p>
                              <div class="ket-action">
                                    <div class="tanggal">
                                          <span class="material-symbols-outlined">
                                                schedule
                                          </span>
                                          <p>Radar Litbang, 32 Juli 2023</p>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
      <script>
      // Initialize links
      const links = "Admin_Dashboard.php";
      links.forEach(link => {
            link.addEventListener("click", function() {
                  setActiveLink(this);
            });
      });
      // Function to set the active link in the sidebar
      function setActiveLink(link) {
            document.querySelectorAll("nav ul li").forEach(li => {
                  li.classList.remove("active");
            });
            if (link) {
                  link.parentElement.classList.add("active");
            }
      }
      </script>

</bosdy>

</html>