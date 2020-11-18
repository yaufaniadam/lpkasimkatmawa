<div class="row">
  <div class="col-md-12">


    <div class="accordion" id="accordionExample">

      <?php foreach ($jenis_pengajuan as $kategori) : ?>

        <div class="card">
          <div class="card-header" id="heading-<?= $kategori['Jenis_Pengajuan_Id']; ?>">
            <h2 class="h6 mb-0">
              <a href="#" data-toggle="collapse" data-target="#collapse-<?= $kategori['Jenis_Pengajuan_Id']; ?>" aria-expanded="true" aria-controls="collapse-<?= $kategori['Jenis_Pengajuan_Id']; ?>">
                <?= $kategori['Jenis_Pengajuan']; ?>
              </a>
            </h2>
          </div>

          <div id="collapse-<?= $kategori['Jenis_Pengajuan_Id']; ?>" class="collapse" aria-labelledby="heading-<?= $kategori['Jenis_Pengajuan_Id']; ?>" data-parent="#accordionExample">
            <div class="card-body">
              <?= $kategori['deskripsi']; ?>
              <a class="btn btn-md" href="<?= base_url('mahasiswa/surat/baru/' . $kategori['Jenis_Pengajuan_Id']); ?>">Ajukan Surat</a>



            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</div>