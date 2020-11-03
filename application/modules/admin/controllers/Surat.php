<?php defined('BASEPATH') or exit('No direct script access allowed');
class Surat extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model', 'surat_model');
		$this->load->model('notif/Notif_model', 'notif_model');
	}

	public function index($role = 0)
	{
		$data['query'] = $this->surat_model->get_surat($role);
		$data['title'] = 'Surat Admin';
		$data['view'] = 'surat/index';
		$this->load->view('layout/layout', $data);
	}
	public function detail($id_surat = 0)
	{
		$data['status'] = $this->surat_model->get_surat_status($id_surat);
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['timeline'] = $this->surat_model->get_timeline($id_surat);

		//cek apakah admin atau pengguna prodi ( admin prodi, tu, kaprodi, kecuali mhs)
		if (($data['surat']['id_prodi'] == $this->session->userdata('id_prodi') && $this->session->userdata('role') !== 1) || $this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {

			$data['title'] = 'Detail Surat';
			$data['view'] = 'surat/detail';
		} else {
			$data['title'] = 'Forbidden';
			$data['view'] = 'restricted';
		}

		$this->load->view('layout/layout', $data);
	}
	public function proses_surat($id_surat = 0)
	{
		$this->db->set('id_status', 2);
		$this->db->set('date', 'NOW()', FALSE);
		$this->db->set('id_surat', $id_surat);
		$this->db->insert('surat_status');

		redirect(base_url('admin/surat/detail/' . $id_surat));
	}
	public function verifikasi()
	{
		if ($this->input->post('submit')) {

			$verifikasi = $this->input->post('verifikasi'); //ambil nilai 
			$id_surat = $this->input->post('id_surat');
			$this->db->set('id_status', $this->input->post('rev2'));
			$this->db->set('pic', $this->session->userdata('user_id'));
			$this->db->set('date', 'NOW()', FALSE);
			$this->db->set('id_surat', $id_surat);
			$this->db->insert('surat_status');

			foreach ($verifikasi as $id => $value_verifikasi) {

				$this->db->where(array('id_kat_keterangan_surat' => $id, 'id_surat' => $id_surat));
				$this->db->update(
					'keterangan_surat',
					array(
						'verifikasi' =>  $value_verifikasi,
					)
				);
			}

			if ($this->input->post('rev2') == 6) {
				$role = array(3, 2);
			} else if ($this->input->post('rev2') == 4) {
				$role = array(3, 2);
			} else if ($this->input->post('rev2') == 7) {
				$role = array(3, 6);
			}

			$data_notif = array(
				'id_surat' => $id_surat,
				'id_status' => $this->input->post('rev2'),
				'kepada' => $this->input->post('user_id'),
				'role' => $role
			);

			$result = $this->notif_model->send_notif($data_notif);

			if ($result) {
				$this->session->set_flashdata('msg', 'Surat sudah diperiksa oleh TU!');
				redirect(base_url('admin/surat/detail/' . $id_surat));
			}
		} else {
			$data['title'] = 'Forbidden';
			$data['view'] = 'restricted';
			$this->load->view('layout/layout', $data);
		}
	}

	public function disetujui()
	{
		if ($this->input->post('submit')) {

			if ($this->session->userdata('role') == 5) { // direktur
				$id_surat = $this->input->post('id_surat');
				$result = $this->db->set('id_status', 9)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');


				if ($result) {
					$data_notif = array(
						'id_surat' => $id_surat,
						'id_status' => 9,
						'kepada' => $this->input->post('user_id'),
						'role' => array(3, 1)
					);

					$result = $this->notif_model->send_notif($data_notif);

					$this->session->set_flashdata('msg', 'Surat sudah diberi persetujuan oleh Direktur Pascasarjana!');
					redirect(base_url('admin/surat/detail/' . $id_surat));
				}
			} elseif ($this->session->userdata('role') == 6 && $this->session->userdata('id_prodi') == $this->input->post('prodi')) { // kaprodi

				$id_surat = $this->input->post('id_surat');
				$result = $this->db->set('id_status', 8)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');

				if ($result) {
					$data_notif = array(
						'id_surat' => $id_surat,
						'id_status' => 8,
						'kepada' => $this->input->post('user_id'),
						'role' => array(3, 5)
					);

					$result = $this->notif_model->send_notif($data_notif);
					$this->session->set_flashdata('msg', 'Surat sudah diberi persetujuan oleh Kaprodi!');
					redirect(base_url('admin/surat/detail/' . $id_surat));
				}
			}
		}
	}

	public function terbitkan_surat()
	{
		if ($this->input->post('submit')) {
			$id_surat = $this->input->post('id_surat');
			$data = array(
				'id_surat' => $id_surat,
				'id_kategori_surat' => $this->input->post('id_kategori_surat'),
				'no_surat' => $this->input->post('no_surat'),
				'kat_tujuan_surat' => $this->input->post('kat_tujuan_surat'),
				'tujuan_surat' => $this->input->post('tujuan_surat'),
				'urusan_surat' => $this->input->post('urusan_surat'),
				'instansi' => $this->input->post('instansi'),
				'tanggal_terbit' => date('Y-m-d'),
			);

			$insert = $this->db->insert('no_surat', $data);
			if ($insert) {
				$this->db->set('id_status', 10)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');

				$data_notif = array(
					'id_surat' => $id_surat,
					'id_status' => 10,
					'kepada' => $this->input->post('user_id'),
					'role' => array(3, 1, 2, 5, 6)
				);

				$result = $this->notif_model->send_notif($data_notif);

				$this->session->set_flashdata('msg', 'Surat berhasil diterbitkan!');
				redirect(base_url('admin/surat/detail/' . $id_surat));
			}
		}
	}

	public function tampil_surat($id_surat)
	{
		$surat = $this->surat_model->get_detail_surat($id_surat);
		$no_surat = $this->surat_model->get_no_surat($id_surat);

		$data['title'] = 'Tampil Surat';
		$data['surat'] = $surat;
		$data['no_surat'] = $no_surat;
		$data['view'] = 'surat/tampil_surat.php';
		$this->load->view('layout/layout', $data);
	}

	public function get_tujuan_surat()
	{
		$kat_tujuan = $this->input->post('kat_tujuan_surat');
		$data = $this->db->query("SELECT * FROM tujuan_surat WHERE id_kat_tujuan_surat = $kat_tujuan")->result_array();
		echo json_encode($data);
	}
}
