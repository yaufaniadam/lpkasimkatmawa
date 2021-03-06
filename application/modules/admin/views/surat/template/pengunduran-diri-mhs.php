<div class="kertas">
  <table>
    <tr>
      <td width="70%">
        <table style="width: 100%;">
          <tr>
            <td width="15%">Nomor</td>
            <td>: <?= $no_surat['no_surat'] . "/" . $no_surat['kode'] . "." . $no_surat['kode_tujuan'] . "-" . $no_surat['kode_us'] . "/" . bulan_romawi($no_surat['bulan']) . "/" . $no_surat['tahun']; ?></td>
          </tr>
          <tr>
            <td>Hal</td>
            <td>: <?= $surat['kategori_surat']; ?></td>
          </tr>
        </table>
      </td>
      <td style="text-align:right;vertical-align:top;">Yogyakarta, <?= $no_surat['tanggal_full']; ?> </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
        <p>Kepada Yth:<br />
          <strong><?= ($no_surat['instansi']) ? $no_surat['instansi'] : $surat['tujuan_surat']; ?></strong>
          di-<br />
          Tempat
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>

  <p><em>Assalamulaikum warahmatullaahi wabarakatuh</em></p>
  <p>Dengan hormat,</p>
  <p>Kami sampaikan bahwa Mahasiswa dari Program Studi <?= $surat['prodi']; ?> Program Pascasarjana Universitas Muhammadiyah Yogyakarta </p>

  <table style="width:100%" class="nama">
    <tr>
      <td style="width:2.5cm;">Nama</td>
      <td> : <?= $surat['fullname']; ?></td>
    </tr>
    <tr>
      <td>NIM</td>
      <td> : <?= $surat['username']; ?></td>
    </tr>

  </table>

  <p>Bermaksud untuk mengajukan pengunduran diri sebagai mahasiswa Program Pascasarjana UMY. Bersama ini kami lampirkan dokumen persyaratan yang dibutuhkan. </p>
  <p>Demikian surat ini kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.</p>
  <p><em>Wassalamulaikum warahmatullaahi wabarakatuh</em></p>


  <table>
    <tr>
      <td colspan="2" class="ttd-dir">
        <p>Direktur </p>
        <br />
        <br />
        <br />
        <br />
        <p><u>Ir.Sri Atmaja P. Rosyidi, M.Sc.Eng., Ph.D., P.Eng.,IPM</u><br>NIK. 19780415200004123046</p>
      </td>

    </tr>
  </table>

</div>

<?php $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
$mpdf->AddPage(); ?>

<h3>Lampiran-lampiran&nbsp;</h3>


<?php $dokumen = get_dokumen_syarat($surat['id']);

foreach ($dokumen as $dokumen) { ?>

  <p><?= $dokumen['kat_keterangan_surat']; ?></p><img src="<?= base_url($dokumen['file']); ?>" />

<?php } ?>