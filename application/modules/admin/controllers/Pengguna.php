<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Pengguna extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna_model', 'pengguna_model');
		$this->load->model('prodi_model', 'prodi_model');
		$this->load->library('datatable');
	}

	public function index($role = 0)
	{
		$data['pengguna'] = $this->pengguna_model->get_pengguna($role);
		$data['role'] = $this->pengguna_model->get_role();
		$data['title'] = 'Semua Pengguna';
		$data['view'] = 'admin/pengguna/list';

		$this->load->view('layout/layout', $data);
	}

	public function tambah()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules(
				'username',
				'Username',
				'trim|required|is_unique[users.username]',
				array('required' => '%s wajib diisi', 'is_unique' => '%s tidak tersedia, gunakan yang lain.')
			);
			$this->form_validation->set_rules(
				'email',
				'Email',
				'trim|valid_email|required|is_unique[users.email]',
				array('required' => '%s wajib diisi', 'valid_email' => 'Format %s salah',  'is_unique' => '%s tidak tersedia, gunakan yang lain.')
			);
			$this->form_validation->set_rules('role', 'Role', 'trim|required', array('required' => '%s wajib diisi'));
			$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => '%s wajib diisi'));
			$this->form_validation->set_rules('id_prodi', 'Program Studi', 'required', array('required' => '%s wajib diisi'));
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required', array('required' => '%s wajib diisi'));

			if ($this->form_validation->run() == FALSE) {
				$data['role'] = $this->pengguna_model->role();
				$data['prodi'] = $this->prodi_model->get_prodi();
				$data['title'] = 'Tambah Pengguna';
				$data['view'] = 'admin/pengguna/tambah';
				$this->load->view('layout/layout', $data);
			} else {

				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'role' => $this->input->post('role'),
					'fullname' => $this->input->post('nama'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pengguna_model->add_user($data);
				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil ditambahkan!');
					redirect(base_url('admin/pengguna'));
				}
			}
		} else {
			$data['role'] = $this->pengguna_model->role();
			$data['prodi'] = $this->prodi_model->get_prodi();
			$data['title'] = 'Tambah Pengguna';
			$data['view'] = 'admin/pengguna/tambah';
			$this->load->view('layout/layout', $data);
		}
	}

	public function edit($id = 0)
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->pengguna_model->get_user_by_id($id);
				$data['role'] = $this->pengguna_model->get_role();
				$data['title'] = 'Edit Pengguna';
				$data['view'] = 'admin/pengguna/edit';
				$this->load->view('layout/layout', $data);
			} else {
				$data = array(
					'email' => $this->input->post('email'),
					'role' => $this->input->post('role'),
					'fullname' => $this->input->post('nama'),
					'password' => ($this->input->post('password') !== "" ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->input->post('password_hidden')),
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pengguna_model->edit_user($data, $id);

				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil diubah!');
					redirect(base_url('admin/pengguna'));
				}
			}
		} else {
			$data['user'] = $this->pengguna_model->get_user_by_id($id);
			$data['role'] = $this->pengguna_model->get_role();
			$data['title'] = 'Edit Pengguna';
			$data['view'] = 'admin/pengguna/edit';
			$this->load->view('layout/layout', $data);
		}
	}

	public function detail($id = 0)
	{
		$data['pengguna'] = $this->pengguna_model->get_user_by_id($id);
		$data['title'] = 'Detail Pengguna';
		$data['view'] = 'admin/pengguna/detail';
		$this->load->view('layout/layout', $data);
	}

	public function hapus($id)
	{
		$this->db->delete('users', array('id' => $id));
		$this->session->set_flashdata('msg', 'Pengguna berhasil dihapus!');
		redirect(base_url('admin/pengguna'));
	}

	public function upload()
	{

		if (isset($_POST['submit'])) {

			$upload_path = './uploads/pengguna';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, TRUE);
			}

			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => "xlsx",
				'overwrite' => FALSE,
			);

			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$upload = $this->upload->data();


			if ($upload) { // Jika proses upload sukses			    	

				$excelreader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx;
				$loadexcel = $excelreader->load('./uploads/pengguna/' . $upload['file_name']); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

				$data['sheet'] = $sheet;
				$data['file_excel'] = $upload['file_name'];

				$data['title'] = 'Upload Pengguna';
				$data['view'] = 'admin/pengguna/upload';

				$this->load->view('layout/layout', $data);
			} else {

				$data['title'] = 'Upload Pengguna';
				$data['view'] = 'admin/pengguna/upload';
				$this->load->view('layout/layout', $data);
			}
		} else {

			$data['title'] = 'Upload Pengguna';
			$data['view'] = 'admin/pengguna/upload';
			$this->load->view('layout/layout', $data);
		}
	}

	public function import($file_excel)
	{

		$excelreader = new Xlsx;
		$loadexcel = $excelreader->load('./uploads/pengguna/' . $file_excel); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

		$data2 = array();

		$numrow = 1;
		foreach ($sheet as $row) {

			if ($numrow > 1) {
				// Kita push (add) array data ke variabel data
				array_push($data2, array(
					'password' => password_hash($row['A'], PASSWORD_BCRYPT),
					'username' => $row['A'],
					'email' => $row['C'],
					'created_at' => date('Y-m-d : h:m:s'),
				));
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_pengguna
		$this->pengguna_model->import_pengguna($data2);

		redirect("admin/pengguna"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}
