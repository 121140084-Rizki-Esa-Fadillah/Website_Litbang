<?php
session_start();
include('Koneksi_user_litbang.php');

if (!isset($_SESSION['username'])) {
    header("Location: Admin_Login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT id FROM user WHERE username='$username'";
$result = $conn->query($sql);

// Cek apakah file diunggah
if (isset($_FILES['profile-image']) && $_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile-image']['tmp_name'];
    $fileName = $_FILES['profile-image']['name'];
    $fileSize = $_FILES['profile-image']['size'];
    $fileType = $_FILES['profile-image']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    if ($row = $result->fetch_assoc()) {
        $id = $row['id'];

        $uploadFileDir = realpath(__DIR__ . '/../../image/foto-profile') . '/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;

        // Path relatif yang akan disimpan ke database
    $dest_path_rel = '../../image/foto-profile/' . $newFileName;

        $allowedExts = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedExts)) {
            if (is_dir($uploadFileDir) && move_uploaded_file($fileTmpPath, $dest_path)) {
                $sql_update = "UPDATE user SET image_profile_name = ?, image_profile_path = ? WHERE id = ?";
                $stmt = $conn->prepare($sql_update);
                $stmt->bind_param('ssi', $fileName, $dest_path_rel, $id);

                if ($stmt->execute()) {
                    header("Location: Admin_Edit_Profile.php");
                    exit();
                } else {
                    echo "Error updating record: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No file uploaded or upload error.";
}

$conn->close();
?>
