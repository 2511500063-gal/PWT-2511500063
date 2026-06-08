<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

include '../config/koneksi.php';

$id = $_GET['id'];

// HEADER JADWAL
$jadwal = mysqli_query($koneksi,"
SELECT jk.*, k.Nm_kelas
FROM jadwal_kelas jk
JOIN kelas k ON jk.Id_kelas = k.Id_kelas
WHERE jk.Id_jadwal='$id'
");

$data = mysqli_fetch_assoc($jadwal);

// DETAIL JADWAL
$detail = mysqli_query($koneksi,"
SELECT dj.*, m.nm_mapel, g.Nm_guru
FROM detail_jadwal dj
JOIN mapel m ON dj.Kd_mapel = m.kd_mapel
JOIN guru g ON dj.Kd_guru = g.Kd_guru
WHERE dj.Id_jadwal='$id'
");

$html = '
<h2 style="text-align:center;">JADWAL PELAJARAN</h2>
<hr>

<table>
<tr><td><b>Kelas</b></td><td>: '.$data['Nm_kelas'].'</td></tr>
<tr><td><b>Tahun Ajaran</b></td><td>: '.$data['Thn_ajaran'].'</td></tr>
<tr><td><b>Semester</b></td><td>: '.$data['Semester'].'</td></tr>
</table>

<br>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
<tr>
<th>No</th>
<th>Hari</th>
<th>Mapel</th>
<th>Guru</th>
<th>Jam</th>
</tr>
';

$no = 1;

while($row = mysqli_fetch_assoc($detail)){
$html .= '
<tr>
<td>'.$no++.'</td>
<td>'.$row['Hari'].'</td>
<td>'.$row['nm_mapel'].'</td>
<td>'.$row['Nm_guru'].'</td>
<td>'.$row['Jam_mulai'].' - '.$row['Jam_selesai'].'</td>
</tr>
';
}

$html .= '
</table>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("jadwal.pdf", ["Attachment" => false]);
?>