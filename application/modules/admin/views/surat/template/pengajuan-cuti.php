<div class="kertas">
  <h3 style="text-align: center;">Blangko Pengajuan Cuti Kuliah</h3>
  <table style="width: 100%;">
    <tr>
      <td width="60%">
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
          <strong><?= ($no_surat['instansi']) ? $no_surat['instansi'] : $surat['tujuan_surat']; ?></strong><br />
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
  <p>Saya yang bertandatangan di bawah ini:</p>

  <table style="width:100%" class="nama">
    <tr>
      <td style="width:2.5cm;">Nama</td>
      <td> : <?= $surat['fullname']; ?></td>
    </tr>
    <tr>
      <td>NIM</td>
      <td> : <?= $surat['username']; ?></td>
    </tr>
    <tr>
      <td>Program Studi</td>
      <td> : <?= $surat['prodi']; ?></td>
    </tr>
  </table>

  <p>Bermaksud untuk mengajukan permohonan cuti/berhenti kuliah sementara untuk semester <strong><?= get_meta_value('semester', $surat['id'], false); ?></strong> tahun akademik <strong><?= get_meta_value('thn_akademik', $surat['id'], false); ?></strong> karena : <strong><?= get_meta_value('alasan_cuti', $surat['id'], false); ?></strong></p>
  <p>Bersama ini saya lampirkan: </p>
  <ol>
    <li>Slip pembayaran biaya cuti kuliah</li>
    <li>Surat keterangan bebas tunggakan SPP</li>
    <li>Surat keterangan bebas pinjaman pustaka</li>
    <li>Fotokopi kartu tanda mahasiswa (KTM)</li>
  </ol>
  <p>Demikian atas perhatiannya kami ucapkan terima kasih.</p>
  <p><em>Wassalamulaiakum warahmatullaahi wabarakatuh</em></p>

  <table style="width: 100%;">
    <tr>
      <td class="ttd-dir">

        <p>Direktur </p>
        <br />
        <br />
        <br />
        <br />
        <p><u>Ir.Sri Atmaja P. Rosyidi, M.Sc.Eng., Ph.D., P.Eng.,IPM</u><br>NIK. 19780415200004123046</p>


      </td>
      <td style="text-align: center; height:200px; vertical-align:middle">

        <p>Hormat saya, </p>
        <br />
        <br />
        <br />
        <br />
        <p>(<?= $surat['fullname']; ?>)</p>
      </td>
    </tr>
    <tr>
  </table>
</div>

<?php $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
$mpdf->AddPage(); ?>

<?php $dokumen = get_dokumen_syarat($surat['id']);

foreach ($dokumen as $dokumen) { ?>
  <div class="kertas">
    <p><?= $dokumen['kat_keterangan_surat']; ?></p><img src="<?= base_url($dokumen['file']); ?>" />
  </div>
<?php } ?>