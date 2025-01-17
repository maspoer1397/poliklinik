<?php
include '../../config/koneksi.php';
session_start();

// IKI SING CMN GENERAL JIPUK HARINE TANPA MEMPERHATIKAN POLIKLINIK
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Ambil nilai dari form
//     $idPoli = $_SESSION['id_poli'];
//     $idDokter = $_SESSION['id'];
//     $hari = $_POST["hari"];
//     $jamMulai = $_POST["jamMulai"];
//     $jamSelesai = $_POST["jamSelesai"];

//     $queryOverlap = "SELECT * FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE id_poli = '$idPoli' AND hari = '$hari' AND ((jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai'))";

//     // Cek apakah hari sudah ada untuk dokter yang sama
//     $queryHari = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$idDokter' AND hari = '$hari'";
//     $resultHari = mysqli_query($mysqli, $queryHari);

//     if (mysqli_num_rows($resultHari) > 0) {
//         echo '<script>alert("Hari ini sudah ada jadwal untuk dokter tersebut.");window.location.href="../../jadwalPeriksa.php";</script>';
//         exit();
//     }

//     $resultOverlap = mysqli_query($mysqli,$queryOverlap);
    
//     if (mysqli_num_rows($resultOverlap) > 0) {
//         echo '<script>alert("Dokter lain telah mengambil jadwal ini");window.location.href="../../jadwalPeriksa.php";</script>';
//         exit();
//     }else {
//         // Jika tidak ada bentrok, tambahkan data ke database
//         $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) 
//                 VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";
//     }

//     if (mysqli_query($mysqli, $query)) {
//         echo '<script>';
//         echo 'alert("Jadwal berhasil ditambahkan!");';
//         echo 'window.location.href = "../../jadwalPeriksa.php";';
//         echo '</script>';
//         exit();
//     } else {
//         echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
//     }
//     }

// IKI WES PALING FIX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari session dan form
    $idDokter = $_SESSION['id'];
    $hari = $_POST["hari"];
    $jamMulai = $_POST["jamMulai"];
    $jamSelesai = $_POST["jamSelesai"];

    // Ambil id_poli berdasarkan id_dokter dari tabel dokter
    $queryPoli = "SELECT id_poli FROM dokter WHERE id = '$idDokter'";
    $resultPoli = mysqli_query($mysqli, $queryPoli);
    $dataPoli = mysqli_fetch_assoc($resultPoli);

    if (!$dataPoli) {
        echo '<script>alert("Data poli tidak ditemukan untuk dokter ini.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    $idPoli = $dataPoli['id_poli'];

    // Cek apakah dokter sudah memiliki jadwal di hari yang sama
    $queryHariDokter = "SELECT * FROM jadwal_periksa 
                        WHERE id_dokter = '$idDokter' 
                        AND hari = '$hari'";
    $resultHariDokter = mysqli_query($mysqli, $queryHariDokter);

    if (mysqli_num_rows($resultHariDokter) > 0) {
        echo '<script>alert("Dokter sudah memiliki jadwal pada hari yang sama.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    // Cek apakah ada bentrok waktu di poli yang sama
    $queryOverlap = "SELECT * FROM jadwal_periksa 
                     INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                     WHERE dokter.id_poli = '$idPoli' 
                     AND hari = '$hari' 
                     AND (
                         (jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') 
                         OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai')
                     )";
    $resultOverlap = mysqli_query($mysqli, $queryOverlap);

    if (mysqli_num_rows($resultOverlap) > 0) {
        echo '<script>alert("Dokter lain telah mengambil jadwal ini pada poli yang sama.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    // Jika tidak ada bentrok, tambahkan data ke database
    $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) 
              VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";

    if (mysqli_query($mysqli, $query)) {
        echo '<script>';
        echo 'alert("Jadwal berhasil ditambahkan!");';
        echo 'window.location.href = "../../jadwalPeriksa.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}



// Tutup koneksi
mysqli_close($mysqli);
?>