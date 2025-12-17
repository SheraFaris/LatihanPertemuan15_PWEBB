<?php
require __DIR__ . '/fpdf/fpdf.php';
include __DIR__ . '/koneksi.php';

$pdf = new FPDF('L', 'mm', 'A4'); // L = Landscape, P = Portrait
$pdf->AddPage();

// Judul
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, 'SEKOLAH MENENGAH KEJURUSAN NEGERI 2 LANGSA', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');

$pdf->Ln(6);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'NIM', 1, 0, 'C');
$pdf->Cell(90, 8, 'NAMA MAHASISWA', 1, 0, 'C');
$pdf->Cell(55, 8, 'NO HP', 1, 0, 'C');
$pdf->Cell(45, 8, 'TANGGAL LHR', 1, 1, 'C');

// Isi tabel dari DB
$pdf->SetFont('Arial', '', 10);

$sql = "SELECT nim, nama_lengkap, no_hp, tanggal_lahir FROM mahasiswa ORDER BY nim ASC";
$q = mysqli_query($connect, $sql);

if (!$q) {
    die("Query error: " . mysqli_error($connect));
}

while ($row = mysqli_fetch_assoc($q)) {
    $pdf->Cell(35, 8, $row['nim'], 1, 0);
    $pdf->Cell(90, 8, $row['nama_lengkap'], 1, 0);
    $pdf->Cell(55, 8, $row['no_hp'], 1, 0);
    $pdf->Cell(45, 8, $row['tanggal_lahir'], 1, 1);
}

// Tampilkan PDF
$pdf->Output('I', 'laporan-mahasiswa.pdf');
