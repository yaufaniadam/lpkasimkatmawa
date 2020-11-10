<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-md-8 mb-4">
		<div class="card shadow">
			<a href="#collKeterangan" class="d-block card-header pt-3 pb-2 bg-abumuda <?= ($surat['id_status'] == 10) ? "collapsed" : "" ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collKeterangan">
				<p class="h6 font-weight-bold text-white">Keterangan</p>
			</a>
			<div class="collapse<?= ($surat['id_status'] == 10) ? "" : " show" ?>" id="collKeterangan">
				<div class="card-body">

					<?php

					/* if ($surat['id_status'] == '9') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-signature"></i> Permohonan disetujui oleh Direktur Pascasarjana UMY <i class="fas fa-long-arrow-alt-right"></i> Proses penerbitan surat.</strong></p>

					<?php } elseif ($surat['id_status'] == '8') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-signature"></i> Permohonan disetujui oleh Ketua Program Studi <i class="fas fa-long-arrow-alt-right"></i> Menunggu persetujuan Direktur Program Pascasarjana.</strong></p>

					<?php } elseif ($surat['id_status'] == '7') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-check-square"></i> Permohonan sudah diverifikasi <i class="fas fa-long-arrow-alt-right"></i> Menunggu persetujuan Ketua Program Studi.</strong></p>

					<?php } elseif ($surat['id_status'] == '6') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-ban"></i> Permohonan ditolak. Silakan mengajukan surat baru.</strong></p>

					<?php } elseif ($surat['id_status'] == '5') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-hourglass-half"></i> Menunggu verifikasi hasil revisi oleh Tata Usaha.</strong></p>

					<?php } elseif ($surat['id_status'] == '4') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-exclamation-triangle"></i> Perbaiki data yang belum sesuai <strong>yang diberi tanda merah.</strong></p>

					<?php } elseif ($surat['id_status'] == '3') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-hourglass-half"></i> Menunggu Persetujuan Kepala Prodi</p>

					<?php } elseif ($surat['id_status'] == '2') { ?>
						<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="<?= $surat['icon']; ?>"></i> <?= $surat['alert']; ?></p>

					<?php } elseif ($surat['id_status'] == '1') { ?>
						<p class="alert alert-warning mb-4"><?php tampil_alert(); ?></p>
					<?php } */ ?>

					<?php echo form_open(base_url('mahasiswa/surat/tambah/' . $surat['id']), '') ?>

					<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
					<input type="hidden" name="id_notif" value="<?= $surat['id_notif']; ?>">
					<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

					foreach ($ket_surat as $ket_surat => $value) {
						$type = kat_keterangan_surat($value)['type'];
						$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

						<div class="form-group row">
							<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?>
								<small id="emailHelp" class="form-text text-muted"><?= kat_keterangan_surat($value)['deskripsi']; ?></small>

							</label>
							<div class="col-md-7">
								<?php generate_form_field($value, $surat['id'], $surat['id_status']); ?>
							</div>
						</div>

					<?php } ?>

					<?php if ($surat['id_status'] == 4) { ?>
						<input type="hidden" name="revisi" value="1">
						<input class="btn btn-lg btn-<?= $surat['badge']; ?> btn-block" type="submit" name="submit" value="<?= ($surat['id_status'] == '4') ? "Kirim Revisi Data" : "Ajukan Surat " . $surat['kategori_surat']; ?>" />

					<?php } elseif ($surat['id_status'] == 1) { ?>
						<input class="btn btn-lg btn-<?= $surat['badge']; ?> btn-block" type="submit" name="submit" value="Ajukan Surat <?= $surat['kategori_surat']; ?>" />
					<?php } ?>

					<?php echo form_close(); ?>
				</div>
			</div>

		</div>
		<?php if ($surat['id_status'] == 10) { ?>
			<div class="card shadow mt-3">
				<a href="#collterbit" class="d-block card-header pt-3 pb-2 bg-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collterbit">
					<p class="h6 font-weight-bold text-white">Surat</p>
				</a>
				<div class="collapse show" id="collterbit">
					<div class="card-body pb-3">
						Download Surat
						<a href="<?= base_url("mahasiswa/surat/tampil_surat/" . $surat['id']); ?>" class="btn btn-success"> <i class="fas fa-file-pdf"></i> PDF</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-4">

		<div class="card shadow">
			<a href="#collStatus" class="d-block card-header pt-3 pb-2 bg-<?= $surat['badge']; ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collStatus">
				<p class="h5 text-center font-weight-bold text-white"> <?= $surat['status']; ?> </p>
			</a>
			<div class="collapse show" id="collStatus">
				<div class="card-body pl-2">
					<ul class="timeline">
						<?php foreach ($timeline as $tl) { ?>
							<li>
								<span class="badge badge-<?= $tl['badge']; ?>"><?= $tl['status']; ?></span>
								<span class="badge badge-secondary"><?= $tl['date']; ?></span>
								<span class="badge badge-perak"><?= $tl['time']; ?></span>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col -->
</div>

<?php fileUploaderModal(); ?>