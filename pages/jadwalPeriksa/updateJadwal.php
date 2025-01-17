<?php
include '../../config/koneksi.php';
session_start();


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Ambil nilai dari form
//     $id = $_POST['id'];
//     $idPoli = $_SESSION['id_poli'];
//     $idDokter = $_SESSION['id'];
//     $hari = $_POST["hari"];
//     $jamMulai = $_POST["jamMulai"];
//     $jamSelesai = $_POST["jamSelesai"];
//     $aktif = $_POST['aktif'];

//     // Sebelum meng-update jadwal_periksa, atur semua nilai 'aktif' menjadi 'N' untuk dokter tertentu
//     $resetAktifQuery = "UPDATE jadwal_periksa SET aktif='N' WHERE id_dokter='$idDokter'";
//     mysqli_query($mysqli, $resetAktifQuery);

//     // Hanya satu jadwal yang boleh aktif, atur nilai 'aktif' menjadi 'Y' untuk jadwal yang sedang di-edit
//     $setAktifQuery = "UPDATE jadwal_periksa SET aktif='$aktif' WHERE id='$id'";
//     mysqli_query($mysqli, $setAktifQuery);

//     $queryOverlap = "SELECT jadwal_periksa.id, jadwal_periksa.id_dokter, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, dokter.id AS idDokter, dokter.nama, dokter.alamat, dokter.no_hp, dokter.id_poli, poli.id AS idPoli, poli.nama_poli, poli.keterangan FROM jadwal_periksa INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
//     INNER JOIN poli ON dokter.id_poli = poli.id WHERE id_poli = '$idPoli' 
//     AND id_dokter = '$idDokter' AND hari = '$hari' 
//     AND ((jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai'))";

//     $resultOverlap = mysqli_query($mysqli,$queryOverlap);
    
//     if (mysqli_num_rows($resultOverlap)>0) {
//         echo '<script>alert("Dokter lain telah mengambil jadwal ini");window.location.href="../../jadwalPeriksa.php";</script>';
//     }
//     else{
//         // Query untuk menambahkan data obat ke dalam tabel
//         $query = "UPDATE jadwal_periksa SET hari = '$hari', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', aktif = '$aktif' WHERE id = '$id'";

        

//         // if ($koneksi->query($query) === TRUE) {
//         // Eksekusi query
//         if (mysqli_query($mysqli, $query)) {
//             // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
//             // header("Location: ../../index.php");
//             // exit();
//             echo '<script>';
//             echo 'alert("Jadwal berhasil diubah!");';
//             echo 'window.location.href = "../../jadwalPeriksa.php";';
//             echo '</script>';
//             exit();
//         } else {
//             // Jika terjadi kesalahan, tampilkan pesan error
//             echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
//         }
//     }
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST['id']; // ID jadwal yang akan diupdate
    $idPoli = $_SESSION['id_poli'];
    $idDokter = $_SESSION['id'];
    $hari = $_POST["hari"];
    $jamMulai = $_POST["jamMulai"];
    $jamSelesai = $_POST["jamSelesai"];
    $aktif = $_POST['aktif'];

    // Reset semua jadwal untuk dokter tertentu menjadi tidak aktif (aktif='N')
    $resetAktifQuery = "UPDATE jadwal_periksa SET aktif='N' WHERE id_dokter='$idDokter'";
    if (!mysqli_query($mysqli, $resetAktifQuery)) {
        echo '<script>alert("Gagal mereset jadwal aktif dokter.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    // Atur nilai 'aktif' menjadi 'Y' untuk jadwal yang sedang diubah jika sesuai
    $setAktifQuery = "UPDATE jadwal_periksa SET aktif='$aktif' WHERE id='$id'";
    if (!mysqli_query($mysqli, $setAktifQuery)) {
        echo '<script>alert("Gagal mengatur jadwal aktif.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    // Cek apakah jadwal baru bentrok dengan jadwal yang ada
    $queryOverlap = "SELECT jadwal_periksa.id 
                     FROM jadwal_periksa 
                     INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id 
                     INNER JOIN poli ON dokter.id_poli = poli.id 
                     WHERE id_poli = '$idPoli' 
                     AND id_dokter = '$idDokter' 
                     AND hari = '$hari' 
                     AND ((jam_mulai < '$jamSelesai' AND jam_selesai > '$jamMulai') 
                     OR (jam_mulai < '$jamMulai' AND jam_selesai > '$jamMulai'))
                     AND jadwal_periksa.id != '$id'";

    $resultOverlap = mysqli_query($mysqli, $queryOverlap);
    
    if (mysqli_num_rows($resultOverlap) > 0) {
        echo '<script>alert("Dokter lain telah mengambil jadwal ini.");window.location.href="../../jadwalPeriksa.php";</script>';
        exit();
    }

    // Update data jadwal
    $queryUpdate = "UPDATE jadwal_periksa 
                    SET hari = '$hari', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', aktif = '$aktif' 
                    WHERE id = '$id'";

    if (mysqli_query($mysqli, $queryUpdate)) {
        echo '<script>';
        echo 'alert("Jadwal berhasil diubah!");';
        echo 'window.location.href = "../../jadwalPeriksa.php";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Gagal mengubah jadwal: ' . mysqli_error($mysqli) . '");';
        echo 'window.location.href = "../../jadwalPeriksa.php";';
        echo '</script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>