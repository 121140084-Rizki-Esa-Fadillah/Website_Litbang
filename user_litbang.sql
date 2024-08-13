CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` varchar(25) NOT NULL,
    `nama_lengkap` varchar(50) NOT NULL,
    `email` varchar(75) NOT NULL,
    `jenis_kelamin` varchar(20) NOT NULL,
    `no_hp` varchar(20) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` varchar(5) NOT NULL,
    `image_profile_name` varchar(255) NOT NULL,
    `image_profile_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;