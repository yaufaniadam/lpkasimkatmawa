<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//menampilkan kategori keterangan surat
function generate_form_field($id, $pengajuan_id, $pengajuan_status)
{
?>
  <link href="<?= base_url() ?>public/plugins/dm-uploader/dist/css/jquery.dm-uploader.min.css" rel="stylesheet">
  <?php
  $CI = &get_instance();
  $fields = $CI->db->select('mf.*, fv.value, fv.verifikasi')->from('Mstr_Fields mf')
    ->join('Tr_Field_Value fv', 'fv.field_id=mf.field_id', 'left')
    ->where(array('mf.field_id' => $id))

    ->get()->row_array();

  if ($fields['type'] == 'image') {

    $image_id = (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];

    $image = $CI->db->select('*')->from('media')
      ->where(array('id' => $image_id))->get()->row_array();

    if ($image) {
      $thumb = $image['thumb'];
      $image = base_url($thumb);
    } else {
      $image = "base_url('public/dist/img/logo.png')";
      $thumb = '';
    }
  ?>

    <figure style="background:url('<?= $image; ?>') center center no-repeat" class="d-flex align-items-center justify-content-center upload-dokumen <?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> <?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>">
      <?php
      if ($pengajuan_status == 1 && $fields['verifikasi'] == 0 || $pengajuan_status == 4 && $fields['verifikasi'] == 0) {
        if ($thumb) { ?>
          <button id="opener-<?= $id; ?>" class="opener hapus btn btn-danger btn-md" type="button"><i class="fas fa-trash"></i> Hapus</button>
        <?php } else { ?>
          <button id="opener-<?= $id; ?>" class="opener btn btn-info btn-md" type="button" data-toggle="modal" data-target="#fileUploader"><i class="fas fa-plus"></i> Upload</button>
      <?php }  // $thumb
      } // $pengajuan_status = 1
      ?>

      <input type="hidden" value="<?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?>" class="dokumen" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]" />
    </figure>
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>



  <?php } elseif ($fields['type'] == 'textarea') {  ?>

    <textarea class="form-control 
		<?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> 
		<?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]" <?= ($pengajuan_status == 1 && $fields['verifikasi'] == 0 || $pengajuan_status == 4 && $fields['verifikasi'] == 0) ? "" : "disabled"; ?>><?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?></textarea>
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

  <?php } elseif ($fields['type'] == 'text') {  ?>

    <input type="text" class="form-control" value="<?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?>" <?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> <?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]" <?= ($pengajuan_status == 1 && $fields['verifikasi'] == 0 || $pengajuan_status == 4 && $fields['verifikasi'] == 0) ? "" : "disabled"; ?> />
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>


  <?php } elseif ($fields['type'] == 'date_range') {  ?>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/plugins/daterangepicker/daterangepicker.css" />

    <input type="text" class="form-control" value="<?= (validation_errors()) ? set_value('dokumen[' . $id . ']') :  $fields['value'];  ?>" <?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> <?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" id="input-<?= $id; ?>" name="dokumen[<?= $id; ?>]" <?= ($pengajuan_status == 1 && $fields['verifikasi'] == 0 || $pengajuan_status == 4 && $fields['verifikasi'] == 0) ? "" : "disabled"; ?> />

    <script type="text/javascript">
      $(function() {

        $('#input-<?= $id; ?>').daterangepicker({
          autoUpdateInput: false,
          locale: {
            cancelLabel: 'Clear'
          }
        });

        $('#input-<?= $id; ?>').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#input-<?= $id; ?>').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });

      });
    </script>

    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

  <?php } elseif ($fields['type'] == 'ta') { //tahun akademik 
  ?>
    <select class="form-control
		<?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> 
		<?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" name="dokumen[<?= $id; ?>]" id="input-<?= $id; ?>">
      <option value=""> -- Pilih Tahun Akademik -- </option>
      <?php
      $cur_year = date("Y");
      $cur_semester = (date("n") <= 6) ?  $cur_year - 1 : $cur_year;
      for ($x = $cur_semester; $x <= $cur_year + 1; $x++) {
        $value_select = sprintf("%d / %d", $x, $x + 1); ?>
        <option value="<?= $value_select; ?>" <?= (validation_errors()) ? set_select('dokumen[' . $id . ']', $value_select) : ""; ?> <?= ($fields['value'] == $value_select) ? "selected" : ""; ?>><?= $x; ?> / <?= $x + 1; ?></option>
      <?php  }
      ?>
    </select>
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

  <?php } elseif ($fields['type'] == 'sem') { //tahun akademik 
  ?>
    <select class="form-control
		<?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> 
		<?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" name="dokumen[<?= $id; ?>]" id="input-<?= $id; ?>">
      <option value=""> -- Pilih Semester -- </option>
      <?php
      $cur_year = date("Y");
      $cur_semester = (date("n") <= 6) ?  "Genap" : "Ganjil";
      ?>
      <option value="Ganjil" <?= (validation_errors()) ? set_select('dokumen[' . $id . ']', "Ganjil") : ""; ?><?= ($fields['value'] == "Ganjil") ? "selected" : ""; ?>>Ganjil</option>
      <option value="Genap" <?= (validation_errors()) ? set_select('dokumen[' . $id . ']', "Genap") : ""; ?> <?= ($fields['value'] == "Genap") ? "selected" : ""; ?>>Genap</option>
    </select>
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>

    <!--  Piih Pembimbing -->
  <?php } elseif ($fields['type'] == 'select_pembimbing') { //tahun akademik 
  ?>
    <select class="form-control
		<?= (form_error('dokumen[' . $id . ']')) ? 'is-invalid' : ''; ?> 
		<?= (($fields['verifikasi'] == 0) && ($pengajuan_status == 4)) ? 'is-invalid' : ''; ?>" name="dokumen[<?= $id; ?>]" id="input-<?= $id; ?>" <?= ($pengajuan_status == 1 && $fields['verifikasi'] == 0 || $pengajuan_status == 4 && $fields['verifikasi'] == 0) ? "" : "disabled"; ?>>
      <option value=""> -- Pilih Dosen -- </option>
      <?php
      $CI = &get_instance();
      $CI->db->order_by('id', 'DESC');
      $dosen = $CI->db->get_where('users', array('role' => 4))->result_array();

      foreach ($dosen as $dosen) {
      ?>
        <option value="<?= $dosen['id'] ?>" <?= (validation_errors()) ? set_select('dokumen[' . $id . ']',  $dosen['id']) : ""; ?><?= ($fields['value'] ==  $dosen['id']) ? "selected" : ""; ?>><?= $dosen['fullname'] ?></option>
      <?php } ?>
    </select>
    <span class="text-danger"><?php echo form_error('dokumen[' . $id . ']'); ?></span>
  <?php }
}

function fileUploaderModal()
{
  $CI = &get_instance();
  $CI->db->order_by('id', 'DESC');
  $media = $CI->db->get_where('media', array('id_user' => $CI->session->userdata('user_id')))->result_array();

  ?>

  <div id="fileUploader" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih File</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="alert alert-info alert-sm d-block mt-1 mb-3"><i class="fas fa-info-circle"></i> <strong>Catatan:</strong> File yang sama dapat digunakan berulang kali. (Pdf, Jpg, Png)</span>
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-upload-tab" data-toggle="tab" href="#nav-upload" role="tab" aria-controls="nav-upload" aria-selected="true">Upload</a>
              <a class="nav-item nav-link" id="nav-galeri-tab" data-toggle="tab" href="#nav-galeri" role="tab" aria-controls="nav-galeri" aria-selected="false">Galeri</a>

            </div>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-upload" role="tabpanel" aria-labelledby="nav-upload-tab">
              <form class="mb-3 mt-3 dm-uploader p-5" id="drag-and-drop-zone">
                <div class="form-row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-2">
                      <input type="hidden" class="value" value="" />

                      <input type="hidden" class="form-control" aria-describedby="fileHelp" placeholder="No image uploaded..." readonly="readonly">

                      <div class="progress mb-2 d-none">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                          0%
                        </div>
                      </div>

                    </div>
                    <div class="form-group">
                      <div role="button" class="btn btn-primary">
                        <i class="fas fa-folder fa-fw"></i> Cari file atau seret ke sini
                        <input type="file" title="Klik untuk menambahkan file">

                      </div>

                    </div>
                  </div>

                </div>

              </form>

            </div>
            <div class="tab-pane fade" id="nav-galeri" role="tabpanel" aria-labelledby="nav-galeri-tab">
              <small class="status text-muted"></small>
              <div class="row pt-3 pb-3 " id="files">
                <?php
                foreach ($media as $row) { ?>
                  <div class="col-md-3 media mb-3">
                    <figure class="img-thumbnail d-flex align-items-center justify-content-center" style="min-height:200px; border:1px solid #ddd;">
                      <a title="Klik pada file yang ingin digunakan" href="#" class="link" id="<?= $row['id']; ?>">
                        <img class="img rounded mx-auto d-block" src="<?= base_url($row['thumb']); ?>" width="100%" height="auto" />
                      </a>
                      <figure>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"> <i class="fas fa-excla,ation-triangle"></i> Jika file tidak bisa diklik, klik tombol <strong>"Batal"</strong> lalu coba kembali.
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

        </div>
      </div>
    </div>
  </div>

  <!-- File item template -->
  <script type="text/html" id="files-template">
    <div class="col-md-3 media mb-3">
      <figure class="img-thumbnail d-flex align-items-center justify-content-center" style="min-height:200px; border:1px solid #ddd;">
        <a title="Klik pada file yang ingin digunakan" href="#" class="link" id="%%id%%">
          <img class="img rounded mx-auto d-block" src="<?= base_url(); ?>%%filename%%" width="100%" height="auto" />
        </a>
      </figure>
    </div>
  </script>

  <script src="<?= base_url() ?>/public/plugins/dm-uploader/dist/js/jquery.dm-uploader.min.js"></script>


  <script>
    function ui_single_update_active(element, active) {
      element.find('div.progress').toggleClass('d-none', !active);
      element.find('input[type="text"]').toggleClass('d-none', active);

      element.find('input[type="file"]').prop('disabled', active);
      element.find('.btn').toggleClass('disabled', active);

      element.find('.btn i').toggleClass('fa-circle-o-notch fa-spin', active);
      element.find('.btn i').toggleClass('fa-folder-o', !active);
    }

    function ui_single_update_progress(element, percent, active) {
      active = (typeof active === 'undefined' ? true : active);

      var bar = element.find('div.progress-bar');

      bar.width(percent + '%').attr('aria-valuenow', percent);
      bar.toggleClass('progress-bar-striped progress-bar-animated', active);

      if (percent === 0) {
        bar.html('');
      } else {
        bar.html(percent + '%');
      }
    }

    function ui_single_update_status(element, message, color) {
      color = (typeof color === 'undefined' ? 'muted' : color);

      element.find('small.status').prop('class', 'status text-' + color).html(message);
    }


    $(function() {

      $('#drag-and-drop-zone').dmUploader({ //
        url: '<?= base_url('mahasiswa/surat'); ?>/doupload/',
        maxFileSize: 3000000, // 3 Megs max
        multiple: false,
        allowedTypes: 'image/*',
        extFilter: ['jpg', 'jpeg', 'png', 'gif'],
        onDragEnter: function() {
          // Happens when dragging something over the DnD area
          this.addClass('active');
        },
        onDragLeave: function() {
          // Happens when dragging something OUT of the DnD area
          this.removeClass('active');
        },
        onInit: function() {
          this.find('input[type="text"]').val('');
        },
        onComplete: function() {

        },
        onNewFile: function(id, file) {

          if (typeof FileReader !== "undefined") {
            var reader = new FileReader();
            var img = this.find('img');

            reader.onload = function(e) {
              img.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
          }

        },
        onBeforeUpload: function(id) {
          ui_single_update_progress(this, 0, true);
          ui_single_update_active(this, true);

          ui_single_update_status(this, 'Uploading...');
        },
        onUploadProgress: function(id, percent) {
          // Updating file progress
          ui_single_update_progress(this, percent);
        },
        onUploadSuccess: function(id, data) {
          var response = JSON.stringify(data);
          var obj = JSON.parse(response);

          ui_single_update_active(this, false);

          this.find('input[type="text"]').val(response);

          ui_single_update_status(this, 'Upload completed.', 'success');

          var template = $('#files-template').text();
          template = template.replace('%%filename%%', obj.thumb);
          template = template.replace('%%id%%', obj.id);

          template = $(template);
          template.prop('id', 'uploaderFile' + id);
          template.data('file-id', id);

          $('#files').prepend(template);

          $('#nav-tab a[href="#nav-galeri"]').tab('show');
        },
        onUploadError: function(id, xhr, status, message) {
          // Happens when an upload error happens
          ui_single_update_active(this, false);
          ui_single_update_status(this, 'Error: ' + message, 'danger');
        },

        onFileSizeError: function(file) {
          //   ui_single_update_status(this, 'File excess the size limit', 'danger');

          // ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
        },
        onFileTypeError: function(file) {
          ui_single_update_status(this, 'File type is not an image', 'danger');

          // ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
        },
        onFileExtError: function(file) {
          ui_single_update_status(this, 'File extension not allowed', 'danger');

          //ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
        }
      });
    });

    $("button.opener").click(function(event) {
      $('.value').val(event.target.id);
    });

    $(document).on('click', '.link', function() {

      var link = $(this).attr('id'); /*ambil id gambar */
      var img = $(this).children().attr('src'); /*ambil id gambar */
      var value = $('.value').val(); /* ambil id button */
      console.log(value);
      var openerinput = $("#" + value).siblings(".dokumen").attr("id");

      $("#" + openerinput).val(link); /*insert value ke field hidden */
      $("#" + openerinput).parent("figure").siblings('span.text-danger').hide();
      $("#" + openerinput).parent("figure").removeClass('is-invalid');
      $("#" + openerinput).parent("figure").css('background-image', 'none');
      $("#" + openerinput).parent("figure").css('background', 'url("' + img + '") center center no-repeat');

      $('#fileUploader').modal('hide');
      $("#" + value).html('<i class="fas fa-trash"></i> Hapus');
      $("#" + value).addClass('btn-danger hapus').removeClass('btn-info');
      $("#" + value).removeAttr('data-toggle data-target');

      return false;
    })

    $(document).on('click', '.hapus', function() {

      $(this).siblings(".dokumen").val('');
      $(this).parent("figure").css('background', 'none');
      $(this).parent("figure").css('background', 'none');
      $(this).addClass('btn-info').removeClass('btn-danger hapus');
      $(this).html('<i class="fas fa-plus"></i> Upload');
      $(this).attr("data-toggle", "modal").attr("data-target", "#fileUploader");

    })
    $('textarea.form-control').on('keyup', function(e) {
      $(this).removeClass('is-invalid');
      $(this).siblings('span.text-danger').hide();
    })
  </script>

  <?php }


//menampilkan kategori keterangan surat
function generate_keterangan_surat($id, $id_surat, $pengajuan_status)
{
  $CI = &get_instance();
  $fields = $CI->db->select('kks.*, ks.value, ks.verifikasi')->from('kat_keterangan_surat kks')
    ->join('keterangan_surat ks', 'ks.id_kat_keterangan_surat=kks.id', 'left')
    ->where(array('kks.id' => $id))
    ->where(array('ks.id_surat' => $id_surat))
    ->get()->row_array();

  if ($fields['type'] == 'image') {

    $image = $CI->db->select('*')->from('media')
      ->where(array('id' => $fields['value']))->get()->row_array();
    $img_full = $image['file'];
    $thumb = $image['thumb'];
    $image = base_url($thumb);
  ?>

    <figure style="background:url('<?= $image; ?>') center center no-repeat" class="d-flex align-items-start justify-content-start preview-dokumen">
      <a data-href="<?= base_url($img_full); ?>" class="opener btn btn-warning btn-md" type="button" data-toggle="modal" data-target="#fileZoom"><i class="fas fa-search-plus" data-toggle="tooltip" data-placement="top" title="Klik untuk memperbesar"></i></a>
    </figure>

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))

      && ($CI->session->userdata('role') == 2)

    ) { ?>
      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : '';  ?> />
          <span class="slider round"></span>
        </label>

      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>
    <?php }
  } elseif ($fields['type'] == 'textarea') { ?>

    <textarea class="form-control mb-2" id="input-<?= $id; ?>" disabled><?= $fields['value'];  ?></textarea>

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>
      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

    <?php }
  } elseif ($fields['type'] == 'text') { ?>

    <input type="text" class="form-control mb-2" id="input-<?= $id; ?>" disabled value="<?= $fields['value'];  ?>" />

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>

      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

    <?php }
  } elseif ($fields['type'] == 'date_range') { ?>

    <input type="text" class="form-control mb-2" id="input-<?= $id; ?>" disabled value="<?= $fields['value'];  ?>" />

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>

      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

    <?php }
  } elseif ($fields['type'] == 'sem') { ?>


    <input type="text" class="form-control mb-2" id="input-<?= $id; ?>" disabled value="<?= $fields['value'];  ?>"></input>
    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>
      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

    <?php }
  } elseif ($fields['type'] == 'ta') { ?>

    <input type="text" class="form-control mb-2" id="input-<?= $id; ?>" disabled value="<?= $fields['value'];  ?>"></input>

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>
      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

    <?php }
  } elseif ($fields['type'] == 'select_pembimbing') {

    $CI = &get_instance();
    $dosen = $CI->db->get_where('users', array('id' => $fields['value']))->row_array();
    ?>

    <input type="text" class="form-control mb-2" id="input-<?= $id; ?>" disabled value="<?= $dosen['fullname'];  ?>"></input>

    <?php if ((($pengajuan_status == 2 && $fields['verifikasi'] == 0) || ($pengajuan_status == 5 && $fields['verifikasi'] == 0))
      && $CI->session->userdata('role') == 2
    ) { ?>
      <div class="d-inline">
        <input type="hidden" name="verifikasi[<?= $id; ?>]" value="0" />
        <label class="switch">
          <input type="checkbox" class="verifikasi" name="verifikasi[<?= $id; ?>]" value="1" <?= ($fields['verifikasi'] == 1) ? 'checked' : ''; ?> />
          <span class="slider round"></span>
        </label>
      </div>
      <div class="d-inline">
        Data sudah sesuai? <a class="help" data-toggle="tooltip" data-placement="right" title="Klik tombol di samping jika data sudah sesuai"><i class="fa fa-info-circle"></i></a>
      </div>

  <?php }
  } ?>

  <div id="fileZoom" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Preview</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <figure class="img_full"></figure>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $("a.opener").click(function(event) {
      var $gbr = $(this).attr('data-href');
      console.log($gbr);
      $('.img_full').empty();
      $('.img_full').prepend("<img style='width:100%;' src=" + $gbr + " />");
    });
  </script>

<?php }
