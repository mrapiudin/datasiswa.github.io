<?php 

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="print">

<div class="container-print">
    <table class="table-print">
            <?php 
            $i = 1;
            ?>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Rayon</th>
        </tr>
        <?php if (isset($_SESSION['data_siswa']) && is_array($_SESSION['data_siswa'])) : ?>
            <?php foreach($_SESSION["data_siswa"] as $key => $data) : ?>
                <tr>
                    <td><?= $i++; ?>.</td>
                    <td><?= htmlspecialchars($data['nama']); ?></td>
                    <td><?= htmlspecialchars($data['nis']); ?></td>
                    <td><?= htmlspecialchars($data['rayon']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif;  ?>
    </table>
</div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>

</body>
</html>