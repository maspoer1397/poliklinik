<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $idPoli = $_SESSION['id_poli'];
    $idDokter = $_SESSION['id'];
    $hari = $_POST["hari"];
    $jamMulai = $_POST["jamMulai"];
    $jamSelesai = $_POST["jamSelesai"];

    $queryOverlap = "SELECT * FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE id_poli = '$idPoli' AND hari = '$hari' AND ((jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai'))";

    // Cek apakah hari sudah ada untuk dokter yang sama
    $queryHari = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$idDokter' AND hari = '$hari'";
    $resultHari = mysqli_query($mysqli, $queryHari);

    if (mysqli_num_rows($resultHari) > 0) {
        echo '<script>alert("Hari ini sudah ada jadwal untuk dokter tersebut.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    $resultOverlap = mysqli_query($mysqli,$queryOverlap);
    
//     if (mysqli_num_rows($resultOverlap)>0) {
//         echo '<script>alert("Dokter lain telah mengambil jadwal ini");window.location.href="../../jadwalPeriksa.php";</script>';
//     }
//     else{
//         // Query untuk menambahkan data obat ke dalam tabel
//         $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";
        

//         // if ($koneksi->query($query) === TRUE) {
//         // Eksekusi query
//         if (mysqli_query($mysqli, $query)) {
//             // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
//             // header("Location: ../../index.php");
//             // exit();
//             echo '<script>';
//             echo 'alert("Jadwal berhasil ditambahkan!");';
//             echo 'window.location.href = "../../jadwalPeriksa.php";';
//             echo '</script>';
//             exit();
//         } else {
//             // Jika terjadi kesalahan, tampilkan pesan error
//             echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
//         }
//     }
// }
    if (mysqli_num_rows($resultOverlap) > 0) {
        echo '<script>alert("Dokter lain telah mengambil jadwal ini");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }else {
        // Jika tidak ada bentrok, tambahkan data ke database
        $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) 
                VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";
    }

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