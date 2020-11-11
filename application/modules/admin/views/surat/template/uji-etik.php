<div class="kertas">
  <table>
    <tr>
      <td width="70%">
        <table>
          <tr>
            <td width="30%">Nomor</td>
            <td>: <?= $no_surat['no_surat'] . "/" . $no_surat['kode'] . "." . $no_surat['kode_tujuan'] . "-" . $no_surat['kode_us'] . "/" . bulan_romawi($no_surat['bulan']) . "/" . $no_surat['tahun']; ?></td>
          </tr>
          <tr>
            <td width="30%">Hal</td>
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
    <tr>
      <td colspan="2">
        <p><em>Assalamulaiakum warahmatullaahi wabarakatuh</em></p>
        <p>Dengan hormat,</p>
        <p>Kami sampaikan bahwa Mahasiswa dari Program Studi <?= $surat['prodi']; ?> Program Pascasarjana Universitas Muhammadiyah Yogyakarta ; </p>

        <table style="width:100%">
          <tr>
            <td style="width:150px;">Nama</td>
            <td> : <?= $surat['fullname']; ?></td>
          </tr>
          <tr>
            <td>NIM</td>
            <td> : <?= $surat['username']; ?></td>
          </tr>

        </table>
        <br />

        <p>Berkaitan dengan Uji Etik dengan topik : <strong>"<?= get_meta_value('keterangan', $surat['id'], false); ?>"</strong>.</p>
        <p>Maka, kami mohon mahasiswa yang bersangkutan dapat diberikan ijin untuk melaksanakan Uji Etik di Tempat Kerja yang Bapak/Ibu pimpin. </p>
        <p>Demikian surat ini kami sampaikan. Atas perhatian dan terkabulkannya ijin kami mengucapkan terima kasih.</p>
        <p><em>Wassalamulaiakum warahmatullaahi wabarakatuh</em></p>

      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: right;"> </td>
    </tr>
    <tr>
      <td colspan="2">
        <p>Direktur </p>
        <br />
        <br />
        <br />
        <br />
        <p><u>Ir.Sri Atmaja P. Rosyidi, M.Sc.Eng., Ph.D., P.Eng.,IPM</u><br>NIK. 19780415200004123046</p>
      </td>

    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</div>