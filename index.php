<?php 

session_start();
$buttonPrint = "";
$buttonHapus = "";

if (isset($_POST['btn'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $rayon = $_POST['rayon'];
    $dataAwal = false;
    
    if (isset($_SESSION['data_siswa'])) {
        foreach ($_SESSION['data_siswa'] as $data) {
            if ($data['nis'] == $nis) {
                $dataAwal = true;
                break;
            }
        }
    }
    if ($dataAwal) {
        $_SESSION['errorMessage'] = "! Data sudah ada !";
    }else {
        $_SESSION['data_siswa'][] = [
            "nama" => $nama,
            "nis" => $nis,
            "rayon" => $rayon
        ];
        $_SESSION['successMessage'] = "! Data berhasil ditambahkan !";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
if (isset($_SESSION['data_siswa']) && !empty($_SESSION['data_siswa'])) {
    $buttonPrint = '<a href="print.php" style="margin-left: 5px;">Print</a>';
    $buttonHapus = '<a href="hapusAll.php" style="margin-left: 5px;">Delete</a>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <!-- Link font awesome -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- link ke CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Link untuk ke css Responsif -->
    <!-- script agar pesan berhasil ditambah hanya muncul 3 detik -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successMessage = document.getElementById("successMessage");
            if (successMessage) {
                successMessage.style.display = "block";
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 3000); // Pesan akan hilang setelah 3 detik
            }
        });
    </script> -->

</head>
<body class="index">

    <h1>Data Siswa</h1>
    <div class="container-content">
        <div class="container">
            <form action="" method="POST">
                <div class="container-btn-input">
                    <div class="content-input">
                        <input type="text" name="nama" id="nama" placeholder="Masukan Nama" required>
                        <input type="number" name="nis" id="nis" placeholder="Masukan NIS" required>
                        <input type="text" name="rayon" id="rayon" placeholder="Masukan Rayon" required>
                    </div>
                    <button type="submit" name="btn" id="btn"><i class="fa-solid fa-user-plus fa-lg"></i>Input Data</button>
                    <?= $buttonPrint; ?>
                    <?= $buttonHapus; ?>

                    <hr>
                    <div class="pesan" id="successMessage"> 
                    <!-- Pesan jika inputan user berhasil ditambahkan  -->
                        <?php if (isset($_SESSION['successMessage'])) : ?>
                            <p class="messege">
                                <?=
                                    $_SESSION['successMessage']; 
                                    unset($_SESSION['successMessage']); 
                                ?>
                            </p>
                        <?php endif; ?> 
                    <!-- Pesan jika inputan user NIS nya sama  -->
                        <?php if (isset($_SESSION['errorMessage'])) : ?>
                            <p class="messege1">
                                <?=
                                    $_SESSION['errorMessage'];
                                    unset($_SESSION['errorMessage']); 
                                ?>
                            </p>
                        <?php endif; ?>
                </div>
                </div>
            </form>
            <div class="table">
                <table>
                    <?php $i = 1; ?>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Rayon</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <?php if(empty($_SESSION['data_siswa'])): ?>
                            <td colspan="5">
                                <?= "<center>Data Belum diisi</center>" ; ?>
                            </td>
                        <?php endif ?>
                    </tr>
                    <?php if (isset($_SESSION['data_siswa']) && is_array($_SESSION['data_siswa'])) : ?>

                        <?php foreach($_SESSION["data_siswa"] as $key => $data) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($data['nama']); ?></td>
                                <td style="padding: 0 10px;"><?= htmlspecialchars($data['nis']); ?></td>
                                <td><?= htmlspecialchars($data['rayon']); ?></td>
                                <td class="aksi">
                                    <a href="hapus.php?id=<?= $key; ?>" ><i class='bx bx-trash'></i></a>
                                    <a href="detail.php?id=<?= $key; ?>" ></a>
                                    <a href="edit.php?id=<?= $key; ?>"><i class='bx bx-edit'></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif;  ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>