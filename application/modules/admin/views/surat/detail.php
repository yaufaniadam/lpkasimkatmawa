<!-- catatan:
error message pada field jika invalidnya masih muncul, padahal field yg salah sudah diganti isinya,
mestinya ketika user mengganti, error messagenya langsung ilang -->
<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-8">
		<?php if (isset($msg) || validation_errors() !== '') : ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
				<?= validation_errors(); ?>
				<?= isset($msg) ? $msg : ''; ?>
			</div>
		<?php endif; ?>
		<!-- fash message yang muncul ketika proses penghapusan data berhasil dilakukan -->
		<?php if ($this->session->flashdata('msg') != '') : ?>
			<div class="alert alert-success flash-msg alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Sukses!</h4>
				<?= $this->session->flashdata('msg'); ?>
			</div>
		<?php endif; ?>
		<!-- Surat diproses oleh Kaprodi -->
		<?php if (($surat['id_status'] == 3 || $surat['id_status'] == 7) && $this->session->userdata('role') == 6) { ?>

			<div class="card shadow mb-3">
				<a href="#collPengantar" class="d-block card-header pt-3 pb-2 bg-tosca" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collPengantar">
					<p class="h6 font-weight-bold text-white">Pengantar</p>
				</a>
				<div class="collapse show" id="collPengantar">
					<div class="card-body">
						<p class="font-italic">Assalamu'alaikum warahmatullahi wabarakatuh</p>
						<p> Kepada Yth. Kepala Program Studi <?= $surat['prodi']; ?>, mohon kesediaanya untuk memberikan persetujuan pada surat yang diajukan oleh:</p>

						<table class="mb-3 ml-3 table-striped" style="width:95%">
							<tr>
								<td style="width:150px;">Nama</td>
								<td> : <?= $surat['fullname']; ?></td>
							</tr>
							<tr>
								<td>NIM</td>
								<td> : <?= $surat['username']; ?></td>
							</tr>
							<tr>
								<td>Jenis Surat</td>
								<td> : <?= $surat['kategori_surat']; ?></td>
							</tr>
						</table>

						<p> Adapun kelengkapan administratif yang dibutuhkan sudah diverifikasi kebenarannya oleh staf Tata Usaha <?= $surat['prodi']; ?>.</p>

						<p>Demikian pengatar dari kami, atas perhatiannya kami ucapkan terima kasih.</p>
						<p class="font-italic">Wassalamu'alaikum warahmatullahi wabarakatuh</p>
					</div>
				</div>
			</div>
		<?php } ?>

		<!-- Surat diproses oleh Direktur -->
		<?php if (($surat['id_status'] == 8) && $this->session->userdata('role') == 5) { ?>

			<div class="card shadow mb-3">
				<a href="#collPengantar" class="d-block card-header pt-3 pb-2 bg-tosca" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collPengantar">
					<p class="h6 font-weight-bold text-white">Pengantar</p>
				</a>
				<div class="collapse show" id="collPengantar">
					<div class="card-body">
						<p class="font-italic">Assalamu'alaikum warahmatullahi wabarakatuh</p>
						<p> Kepada Yth. Direktur Program Pascasarjana UMY, mohon kesediaanya untuk memberikan persetujuan pada Surat yang diajukan oleh: </p>

						<table class="mb-3 ml-3 table-striped" style="width:95%">
							<tr>
								<td style="width:150px;">Nama</td>
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
							<tr>
								<td>Jenis Surat</td>
								<td> : <?= $surat['kategori_surat']; ?></td>
							</tr>
						</table>


						<p> Adapun kelengkapan administratif yang dibutuhkan sudah diverifikasi kebenarannya oleh staf Tata Usaha dan telah disetujui oleh Ketua Program Studi <?= $surat['prodi']; ?>.</p>

						<p>Demikian pengatar dari kami, atas perhatiannya kami ucapkan terima kasih.</p>
						<p class="font-italic">Wassalamu'alaikum warahmatullahi wabarakatuh</p>
					</div>
				</div>
			</div>



		<?php } ?>

		<div class="card shadow">
			<a href="#collKeterangan" class="d-block card-header pt-3 pb-2 bg-abumuda <?= (($surat['id_status'] == 9 || $surat['id_status'] == 10) && $this->session->userdata('role') == 1) ? "collapsed" : "" ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collKeterangan">
				<p class="h6 font-weight-bold text-white">Keterangan</p>
			</a>
			<div class="collapse<?= (($surat['id_status'] == 9 || $surat['id_status'] == 10) && $this->session->userdata('role') == 1) ? "" : " show" ?>" id="collKeterangan">
				<div class="card-body">

					<?php
					if (
						($surat['id_status'] == 8 && $this->session->userdata('role') == 5) ||
						($surat['id_status'] == 7 && $this->session->userdata('role') == 6)
					) {
						echo form_open('admin/surat/disetujui');
					}

					if (($surat['id_status'] == 2 || $surat['id_status'] == 5) && $this->session->userdata('role') == 2) {
						echo form_open('admin/surat/verifikasi');
					}
					?>
					<?= ($surat['id_status'] == 1) ? '<a href="' . base_url('admin/surat/proses_surat/' . $surat['id']) . '" class="btn btn-warning btn-sm">Klik untuk Memproses</a>' : '' ?>

					<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
					<input type="hidden" name="id_notif" value="<?= $surat['id_notif']; ?>">
					<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']); ?>

					<input type="hidden" name="sizeof_ket_surat" value="<?= sizeof($ket_surat); ?>">
					<input type="hidden" name="user_id" value="<?= $surat['user_id']; ?>">

					<?php foreach ($ket_surat as $ket_surat => $value) {
						$type = kat_keterangan_surat($value)['type'];
						$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

						<div class="form-row">
							<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
							<div class="col-md-7">
								<?php
								// memanggil form (data_helper.php)
								generate_keterangan_surat($value, $surat['id'], $surat['id_status']); ?>
							</div>
						</div>

					<?php } ?>

					<?php if (($surat['id_status'] == 2 || $surat['id_status'] == 5) && $this->session->userdata('role') == 2) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">

								<div class="card">
									<div class="card-header">
										Hasil Verifikasi Dokumen
									</div>
									<div class="card-body">

										<p> Setelah diperiksa dengan seksama, maka
											<?= $this->session->userdata('fullname'); ?> menyatakan bahwa permohonan <strong>Surat <?= $surat['kategori_surat']; ?></strong> yang diajukan oleh <strong><?= $surat['fullname']; ?></strong> : </p>

										<ul class="list-group list-group-flush">
											<li class="list-group-item"><input type="radio" name="rev2" id="diterima" value="7" /> Diterima dan dapat diproses lebih lanjut
											</li>

											<li class="list-group-item"><input type="radio" name="rev2" id="ditolak" value="6" /> Ditolak
												<?php if ($surat['id_status'] == 2) { ?>
											<li class="list-group-item"><input type="radio" name="rev2" id="revisi" value="4" /> Perlu direvisi kembali
											</li>
										<?php } ?> </li>
										</ul>


										<p class="mt-3">
											<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Pernyataan ini dibuat dengan sebenar-benarnya dan dapat dipertanggung jawabkan kebenarannya. <a class="help" data-toggle="tooltip" data-placement="top" title="Centang untuk mengaktifkan tombol verifikasi."><i class="fa fa-info-circle"></i></a></span>
										</p>


										<input type="submit" id="sub1" value="Kirim Hasil Verifikasi" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
									</div>


								</div>


							</div>
						</div>

						<script>
							$(function() {

								<?php if ($surat['id_status'] == 2) { ?>


									var check_all = sizeof = $("input[name='sizeof_ket_surat']").val();

									$('#diterima').click(function(e) {
										if ($('.verifikasi:checked').length != check_all) {

											$('#error_modal').modal("show");
											return false;
										}
									});

								<?php } ?>

								$('#sudahPeriksa').click(function(e) {
									if ($(this).is(':checked')) {

										if (!$("input[name='rev2']:checked").val()) {
											alert('Hasil belum dipilih!');
											return false;
										} else {
											$('#sub1').removeAttr('disabled');
										}

									} else {
										$('#sub1').attr('disabled', 'disabled');
									}
								});
							});
						</script>
					<?php }


					if ($surat['id_status'] == 4 && $this->session->userdata('role') == 2) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<input type="submit" id="sub1" value="Menunggu perbaikan kelengkapan administrasi" name="submit" class="btn btn-perak btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					if ($surat['id_status'] == 7 && $this->session->userdata('role') == 6) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										Persetujuan Ketua Program Studi
									</div>
									<div class="card-body">

										<p> Saya selaku Ketua Program Studi <?= $surat['prodi']; ?> memberikan persetujuan pada <strong>Surat <?= $surat['kategori_surat']; ?></strong> yang diajukan oleh <strong><?= $surat['fullname']; ?></strong> </p>

										<p>Dengan demikian surat ini dapat diteruskan prosesnya ke tingkat fakultas.</p>

										<p class="mt-3">
											<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Pernyataan ini dibuat dengan sebenar-benarnya dan dapat dipertanggung jawabkan kebenarannya. <a class="help" data-toggle="tooltip" data-placement="top" title="Centang untuk mengaktifkan tombol verifikasi."><i class="fa fa-info-circle"></i></a></span>
										</p>


										<input type="hidden" name="prodi" value="<?= $surat['id_prodi']; ?>" />
										<input type="submit" id="sub1" value="Beri Persetujuan" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
									</div>


								</div>

							</div>
						</div>

						<script>
							$(function() {
								$('#sudahPeriksa').click(function(e) {
									if ($(this).is(':checked')) {
										$('#sub1').removeAttr('disabled');
									} else {
										$('#sub1').attr('disabled', 'disabled');
									}
								});
							});
						</script>
					<?php }

					if ($surat['id_status'] == 8 && $this->session->userdata('role') == 5) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">

								<div class="card">
									<div class="card-header">
										Persetujuan Direktur Program Pascasarjana
									</div>
									<div class="card-body">

										<p> Saya selaku Direktur Program Pascasarjana UMY memberikan persetujuan pada <strong>Surat <?= $surat['kategori_surat']; ?></strong> yang diajukan oleh <strong><?= $surat['fullname']; ?></strong> dari prodi <?= $surat['prodi']; ?>.</p>

										<p>Dengan demikian surat ini dapat diterbitkan.</p>

										<p class="mt-3">
											<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Pernyataan ini dibuat dengan sebenar-benarnya dan dapat dipertanggung jawabkan kebenarannya. <a class="help" data-toggle="tooltip" data-placement="top" title="Centang untuk mengaktifkan tombol verifikasi."><i class="fa fa-info-circle"></i></a></span>
										</p>

										<input type="submit" id="sub1" value="Beri Persetujuan" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
									</div>
								</div>
							</div>
						</div>
						<script>
							$(function() {
								$('#sudahPeriksa').click(function(e) {
									if ($(this).is(':checked')) {
										$('#sub1').removeAttr('disabled');
									} else {
										$('#sub1').attr('disabled', 'disabled');
									}
								});
							});
						</script>

					<?php }
					form_close(); ?>
				</div>
			</div>
		</div>

		<!-- jika surat sudah diacc oleh Direktur pasca, maka atur surat-->
		<?php if ($surat['id_status'] == 9 && $this->session->userdata('role') == 1) { ?>
			<div class="card shadow mt-3">
				<a href="#collterbit" class="d-block card-header pt-3 pb-2 bg-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collterbit">
					<p class="h6 font-weight-bold text-white">Terbitkan Surat</p>
				</a>
				<div class="collapse show" id="collterbit">
					<div class="card-body pb-3">

						<p>Lakukan pengaturan di bawah ini sebelum surat diterbitkan</p>
						<?php echo form_open('admin/surat/terbitkan_surat'); ?>

						<div class="form-group row">
							<label class="col-md-4" for="">Nomor Surat
								<small id="emailHelp" class="form-text text-muted">+1 dari nomor sebelumnya dengan kategori yang sama</small>
							</label>
							<div class="col-md-8">

								<?php
								$no_surat = $this->db->query("select max(no_surat) as last_no from no_surat where id_kategori_surat= " . $surat['id_kategori_surat'] . " AND YEAR(tanggal_terbit) =" . date('Y'))->row_array();

								if ($no_surat['last_no'] > 0) {
									$last_no = $no_surat['last_no'] + 1;
								} else {
									$last_no = 1;
								}
								?>

								<input type="hidden" name="id_surat" id="" value="<?= $surat['id']; ?>">
								<input type="hidden" name="id_kategori_surat" id="" value="<?= $surat['id_kategori_surat'] ?>">
								<input type="text" name="no_surat" id="" value="<?= $last_no ?>" class="form-control <?= (form_error('no_surat')) ? 'is-invalid' : ''; ?> ">
								<span class="text-danger"><?php echo form_error('no_surat'); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4" for="">Kategori Tujuan Surat</label>
							<div class="col-md-8">

								<?php $tujuan_surat = $this->db->query("select * from kat_tujuan_surat")->result_array(); ?>

								<select name="kat_tujuan_surat" id="kat_tujuan_surat" class="form-control <?= (form_error('kat_tujuan_surat')) ? 'is-invalid' : ''; ?> ">
									<option value="">Pilih Kategori Tujuan Surat</option>
									<?php foreach ($tujuan_surat as $tujuan) { ?>
										<option value="<?= $tujuan['id']; ?>"><?= $tujuan['kat_tujuan_surat']; ?></option>
									<?php } ?>
								</select>
								<span class="text-danger"><?php echo form_error('kat_tujuan_surat'); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4" for="">Tujuan Surat</label>
							<div class="col-md-8">

								<select name="tujuan_surat" id="tujuan_surat" class="form-control <?= (form_error('tujuan_surat')) ? 'is-invalid' : ''; ?> ">
									<option value="">Pilih Tujuan</option>
								</select>
								<span class="text-danger"><?php echo form_error('tujuan_surat'); ?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4" for="">Urusan Surat</label>
							<div class="col-md-8">

								<?php $urusan_surat = $this->db->query("select * from urusan_surat")->result_array(); ?>

								<select name="urusan_surat" id="" class="form-control <?= (form_error('urusan_surat')) ? 'is-invalid' : ''; ?> ">
									<option value="">Urusan Surat</option>
									<?php foreach ($urusan_surat as $urusan) { ?>
										<option value="<?= $urusan['kode']; ?>"><?= $urusan['urusan']; ?></option>
									<?php } ?>
								</select>
								<span class="text-danger"><?php echo form_error('urusan_surat'); ?></span>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-4" for="">Instansi/Lembaga Tujuan
								<small id="emailHelp" class="form-text text-muted">Tujuan surat bisa diganti jika diperlukan.</small>
							</label>
							<div class="col-md-8">
								<textarea name="instansi" id="" cols="30" rows="3" class="textarea-summernote <?= (form_error('instansi')) ? 'is-invalid' : ''; ?> ">
								<?= ($surat['tujuan_surat']) ? $surat['tujuan_surat'] : get_meta_value('tujuan_surat', $surat['id'], false);  ?>
							</textarea>
								<span class="text-danger"><?php echo form_error('instansi'); ?></span>
							</div>
						</div>

						<input type="submit" id="sub1" value="Terbitkan Sekarang" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block">
						<?php form_close(); ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<!-- jika surat sudah diterbitkan -->
		<?php if ($surat['id_status'] == 10) { ?>
			<div class="card shadow mt-3">
				<a href="#collterbit" class="d-block card-header pt-3 pb-2 bg-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collterbit">
					<p class="h6 font-weight-bold text-white">Surat</p>
				</a>
				<div class="collapse show" id="collterbit">
					<div class="card-body pb-3">
						Download Surat
						<a href="<?= base_url("admin/surat/tampil_surat/" . $surat['id']); ?>" class="btn btn-success"> <i class="fas fa-file-pdf"></i> PDF</a>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>



	<!-- /.col -->
	<div class="col-4">
		<div class="card shadow">
			<a href="#collMhs" class="d-block card-header pt-3 pb-2 bg-warning" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collMhs">
				<p class="h6 font-weight-bold text-white">Pemohon</p>
			</a>
			<div class="collapse show" id="collMhs">
				<div class="card-body pb-3">
					<div class="media">

						<?= profPic($surat['username'], 60); ?>

						<div class="media-body ml-2">
							<h5 class="mt-0 text-gray-900 mb-0 font-weight-bold"><?= $surat['fullname']; ?></h5>
							<span class="mb-0 badge badge-ijomuda"> <?= $surat['username']; ?></span>
							<p class="mb-0 text-gray-800"> <?= $surat['prodi']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card shadow mt-3">
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
<!-- /.row -->


<!-- Modal -->
<div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Terjadi kesalahan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p><i class="fas fa-exclamation-triangle"> </i> Opsi ini hanya jika semua data yang dikirimkan sudah sesuai seluruhnya!</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#kat_tujuan_surat').change(function() {
			var id = $(this).val();
			$.ajax({
				url: '<?= base_url('admin/surat/get_tujuan_surat'); ?>',
				method: 'POST',
				data: {
					kat_tujuan_surat: id
				},
				dataType: 'json',
				success: function(data) {
					console.log(data)
					var html = '';
					var i;
					if (data.length == 0) {
						html += '<option>Tujuan tidak ditemukan</option>'
					} else {
						for (i = 0; i < data.length; i++) {
							html += '<option value = ' + data[i].id + '>' + data[i].tujuan_surat + '</option>'
						}
					}
					$('#tujuan_surat').html(html);
				}
			});
		});
	});
</script>