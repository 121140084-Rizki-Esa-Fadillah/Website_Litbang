<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Hasil Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Hasil_Survey.css">
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="hasil-survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Hasil Survey</h2>
            </section>
            <div class="judul-container">
                  <div class="search">
                        <div class="search-box">
                              <input type="text" placeholder="Search...">
                              <button>
                                    <i class="fa fa-search"></i>
                              </button>
                        </div>
                  </div>
                  <div class="sort-box">
                        <label for="sort">Sorting :</label>
                        <div class="select-container">
                              <select id="sort">
                                    <option value="1">Lampung Barat</option>
                                    <option value="2">Tanggamus</option>
                                    <option value="3">Lampung Selatan</option>
                                    <option value="4">Lampung Timur</option>
                                    <option value="5">Lampung Tengah</option>
                                    <option value="6">Lampung Utara</option>
                                    <option value="7">Way Kanan</option>
                                    <option value="8">Tulang Bawang</option>
                                    <option value="9">Pesawaran</option>
                                    <option value="10">Pringsewu</option>
                                    <option value="11">Mesuji</option>
                                    <option value="12">Tulang Bawang Barat</option>
                                    <option value="13">Pesisir Barat</option>
                                    <option value="14">Bandar Lampung</option>
                                    <option value="15">Kota Metro</option>
                              </select>
                              <span class="material-symbols-outlined arrow-select">
                                    keyboard_arrow_up
                              </span>
                        </div>
                  </div>
            </div>
            <div class="hasil">
                  <a href="Admin_Detail_Hasil_Survey.php" class="survey-title">
                        <h3>Judul Survey</h3>
                  </a>
                  <div class="hasil-container">
                        <div class="img"></div>
                        <div class="ket">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                              <p class="wilayah">Wilayah Pelaksanaan Survei :</p>
                              <p>Bandar Lampung, Lampung Selatan, Lampung Timur,......</p>
                              <div class="ket-action">
                                    <div class="tanggal">
                                          <span class="material-symbols-outlined">
                                                schedule
                                          </span>
                                          <p>Radar Litbang, 32 Juli 2023</p>
                                    </div>
                                    <div class="action-buttons">
                                          <a href="Admin_Edit_Keterangan_Survey.php" class="tombol-edit">
                                                <i class="fa fa-edit"></i>Edit
                                          </a>
                                          <button class="tombol-hapus-survey">
                                                <i class="fa fa-trash"></i>Delete
                                          </button>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>