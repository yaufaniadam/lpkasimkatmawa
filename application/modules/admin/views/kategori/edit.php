<?php echo form_open_multipart(base_url('admin/kategorisurat/edit/' . $kat['id']), 'class="form-horizontal"');  ?>

<div class="row">
	<div class="col-md-12">

		<!-- fash message yang muncul ketika proses penghapusan data berhasil dilakukan -->
		<?php if ($this->session->flashdata('msg') != '') : ?>
			<div class="alert alert-success flash-msg alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Sukses!</h4>
				<?= $this->session->flashdata('msg'); ?>
			</div>
		<?php endif; ?>
		<?php if (isset($msg) || validation_errors() !== '') : ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
				<?= validation_errors(); ?>
				<?= isset($msg) ? $msg : ''; ?>
			</div>
		<?php endif; ?>

	</div>

	<div class="col-md-8">
		<div class="card card-success card-outline">
			<div class="card-body box-profile">


				<div class="form-group row">
					<label for="kategori_surat" class="col-md-3 control-label">Kategori Surat</label>
					<div class="col-md-9">
						<input type="text" value="<?= (validation_errors()) ? set_value('kategori_surat') : $kat['kategori_surat'];  ?>" name="kategori_surat" class="form-control <?= (form_error('kategori_surat')) ? 'is-invalid' : ''; ?>" id="kategori_surat">

						<span class="invalid-feedback"><?php echo form_error('kategori_surat'); ?></span>

					</div>
				</div>
				<div class="form-group row">
					<label for="kode" class="col-md-3 control-label">Kode</label>
					<div class="col-md-9">
						<input type="text" value="<?= (validation_errors()) ? set_value('kode') : $kat['kode'];  ?>" name="kode" class="form-control <?= (form_error('kode')) ? 'is-invalid' : ''; ?>" id="kode">

						<span class="invalid-feedback"><?php echo form_error('kode'); ?></span>

					</div>
				</div>

				<div class="form-group row">
					<label for="kode" class="col-md-3 control-label">Pengguna</label>
					<div class="col-md-9">
						<select name="klien" class="form-control">
							<option value="" <?php echo  set_select('klien', '', TRUE); ?>>Pilih Pengguna</option>
							<option value="m" <?= (validation_errors()) ? set_select('klien', 'm') : "";
																echo ($kat['klien'] == 'm') ? "selected" : ""; ?>>
								Mahasiswa</option>
							<option value="d" <?= (validation_errors()) ? set_select('klien', 'd') : "";
																echo ($kat['klien'] == 'd') ? "selected" : ""; ?>>
								Dosen</option>
							<option value="p" <?= (validation_errors()) ? set_select('klien', 'p') : "";
																echo ($kat['klien'] == 'p') ? "selected" : ""; ?>>
								Prodi</option>
							<option value="u" <?= (validation_errors()) ? set_select('klien', 'u') : "";
																echo ($kat['klien'] == 'u') ? "selected" : ""; ?>>
								Dosen</option>
							<option value="i" <?= (validation_errors()) ? set_select('klien', 'i') : "";
																echo ($kat['klien'] == 'i') ? "selected" : ""; ?>>
								Internal PPs</option>
						</select>
						<span class="text-danger" style="font-size: 80%;"><?php echo form_error('klien'); ?></span>
					</div>
				</div>

				<div class="form-group row">
					<label for="deskripsi" class="col-md-3 control-label">Deskripsi</label>
					<div class="col-md-9">

						<div class="<?= (form_error('deskripsinya')) ? 'summernote-is-invalid' : ''; ?>"><textarea name="deskripsinya" class="textarea-summernote"><?= (validation_errors()) ? set_value('deskripsinya') : $kat['deskripsi'];  ?></textarea>
						</div>

						<span class="text-danger" style="font-size: 80%;"><?php echo form_error('deskripsinya'); ?></span>
					</div>
				</div>

				<div class="form-group row">
					<label for="deskripsi" class="col-md-3 control-label">Tujuan Surat</label>
					<div class="col-md-9">

						<div class="<?= (form_error('tujuan_surat')) ? 'summernote-is-invalid' : ''; ?>"><textarea name="tujuan_surat" class="textarea-summernote"><?= (validation_errors()) ? set_value('tujuan_surat') : $kat['tujuan_surat'];  ?></textarea>
						</div>

						<span class="text-danger" style="font-size: 80%;"><?php echo form_error('tujuan_surat'); ?></span>
					</div>
				</div>

				<div class="form-group row">
					<label for="template" class="col-md-3 control-label">Template surat</label>
					<div class="col-md-9">
						<select name="template" class="form-control">
							<option value="" <?php echo  set_select('template', '', TRUE); ?>>Pilih Template</option>

							<?php foreach ($template as $tpl) { ?>
								<option value="<?= $tpl; ?>" <?= (validation_errors()) ? set_select('template', $kat['template']) : "";
																							echo ($kat['template'] == $tpl) ? "selected" : ""; ?>>
									<?= $tpl; ?></option>
							<?php } ?>
						</select>
						<span class="text-danger" style="font-size: 80%;"><?php echo form_error('template'); ?></span>
					</div>
				</div>

				<div class="form-group row">
					<label for="kode" class="col-md-3 control-label"></label>
					<div class="col-md-9">
						<input type="submit" name="submit" value="Edit Kategori Surat" class="btn btn-perak btn-block">
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-success card-outline">
			<div class="card-body box-profile">

				<label for="kode" class=" control-label">Formulir Isian</label>
				<ul style="list-style: none;" class="keterangan_surat list-group pl-0 <?= (form_error('kat_keterangan_surat[]')) ? 'is-invalid' : ''; ?>">
					<?php

					$explode = explode(',', $kat['kat_keterangan_surat']);

					foreach ($keterangan_surat as $row) { ?>
						<li class="list-group-item <?= (form_error('kat_keterangan_surat[]')) ? 'is-eror' : ''; ?>
						<?= ((validation_errors()) ? '' : (in_array($row['id'], $explode))) ? 'active' : ''; ?>">
							<input class="checkbox_keterangan_surat" type="checkbox" value="<?= $row['id']; ?>" name="kat_keterangan_surat[]" <?php $check = (in_array($row['id'], $explode)) ? 'checked' : ''; ?> <?= (validation_errors()) ? set_checkbox('kat_keterangan_surat[]', $row['id']) : $check; ?> />
							<?= $row['kat_keterangan_surat']; ?>
						</li>
					<?php } // endforeach 
					?>
				</ul>
				<span class="text-danger" style="line-height:1.5rem;font-size: 80%;"><?php echo form_error('kat_keterangan_surat[]'); ?></span>

			</div>
		</div>
	</div>
	<script>
		$(document).on('change', '.checkbox_keterangan_surat', function() {
			if (this.checked) {
				$(this).parent('li.list-group-item').addClass('active');
			} else {
				$(this).parent('li.list-group-item').removeClass('active');
			}
		});
		$('.checkbox_keterangan_surat:checked').parent('li.list-group-item').addClass('active');
	</script>





</div>
<?php echo form_close(); ?>