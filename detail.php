<?php 

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $detail = null;
    foreach ($_SESSION['data_siswa'] as $key => $rinci) {
        if ($key == $id) {
            $detail = $rinci;
        }
    }
    if($detail == null) {
        header("Location: index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="detail">

    <div class="container-detail">
        <h1 class="h-detail"><?= $detail['nama'] ?></h1>
        <h1 class="h-detail"><?= $detail['nis'] ?></h1>
        <h1 class="h-detail"><?= $detail['rayon'] ?></h1>
    </div>
    <br>
    <center><a href="index.php" class="link-detail">Back to home page</a></center>

</body>
</html>