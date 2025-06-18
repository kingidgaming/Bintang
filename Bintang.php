<?php
session_start();

// Inisialisasi angka rahasia jika belum ada
if (!isset($_SESSION['angka_rahasia'])) {
    $_SESSION['angka_rahasia'] = rand(1, 100);
    $_SESSION['percobaan'] = 0;
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tebakan = intval($_POST["tebakan"]);
    $_SESSION['percobaan']++;

    if ($tebakan < $_SESSION['angka_rahasia']) {
        $pesan = "Tebakan terlalu rendah!";
    } elseif ($tebakan > $_SESSION['angka_rahasia']) {
        $pesan = "Tebakan terlalu tinggi!";
    } else {
        $pesan = "Selamat! Kamu menebak dengan benar dalam " . $_SESSION['percobaan'] . " percobaan.";
        // Reset permainan
        unset($_SESSION['angka_rahasia']);
        unset($_SESSION['percobaan']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Permainan Tebak Angka</title>
</head>
<body>
    <h1>Tebak Angka (1 - 100)</h1>
    <form method="post">
        <label for="tebakan">Masukkan tebakan:</label>
        <input type="number" name="tebakan" id="tebakan" required>
        <input type="submit" value="Tebak">
    </form>
    <p><?php echo $pesan; ?></p>
</body>
</html>
