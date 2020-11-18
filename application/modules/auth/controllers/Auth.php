<?php defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('auth_model', 'auth_model');
	}
	//--------------------------------------------------------------
	public function index()
	{
		if (!$this->session->has_userdata('is_login')) {
			redirect('auth/login');
		} else {
			if ($this->session->has_userdata('role') == 3) {
				redirect('mahasiswa/surat');
			} else {
				redirect('admin/surat');
			}
		}
	}
	//--------------------------------------------------------------
	public function login($referrer = null)
	{
		//check referer page
		if (isset($referrer)) {
			// jika referrernya non sso
			if ($referrer === 'non-sso') {
				if ($this->input->post('submit')) {
					$this->form_validation->set_rules('username', 'Username', 'trim|required');
					$this->form_validation->set_rules('password', 'Password', 'trim|required');

					if ($this->form_validation->run() == FALSE) {
						$data['ref'] = $referrer;
						$this->load->view('auth/login', $data);
					} else {
						$data = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password')
						);
						$result = $this->auth_model->login($data);
						if ($result) {
							$user_data = array(
								'user_id' => $result['id'],
								'username' => $result['username'],
								'fullname' => $result['fullname'],
								'role' => $result['role'],
								'id_prodi' => $result['id_prodi'],
								'is_login' => TRUE,
							);

							$this->session->set_userdata($user_data);
							if ($result['role'] != 3) {
								redirect(base_url('admin/surat'), 'refresh');
							} else {
								redirect(base_url('mahasiswa/surat'), 'refresh');
							}
						} else {
							$data['msg'] = 'Invalid Username or Password!';
							$data['ref'] = $referrer;
							$this->load->view('auth/login', $data);
						}
					}
				} else {
					$data['ref'] = $referrer;
					$this->load->view('auth/login', $data);
				}
				// jika referrernya salah
			} else {
				echo "404";
			}
			//jika tanpa referrer maka menggunakan SSO UMY
		} else {
			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['ref'] = $referrer;
					$this->load->view('auth/login', $data);
				} else {

					$data = array(
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password')
					);

					$params = http_build_query($data);

					$email = $this->input->post('username');

					$body = array('http' =>
					array(
						'method' => 'POST',
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'content' => $params
					));
					$context = stream_context_create($body);
					$link = file_get_contents('https://sso.umy.ac.id/api/Authentication/Login', false, $context);
					$json = json_decode($link);

					$ceknum = $json->{'code'};

					// jika login benar
					if ($ceknum == 0) {
						// cek user ke tabel Mhs (SQLSERVER UMY)

						$result = $this->db->query("SELECT * from dbo.V_Mahasiswa WHERE EMAIL ='$email' ")->row_array();



						$user_data = array(
							'studentid' => $result['STUDENTID'],
							'fullname' => $result['FULLNAME'],
							'email' => $result['EMAIL'],
							'fakultas' => $result['name_of_faculty'],
							'id_prodi' => $result['department_id'],
							'role' => 3,
							'created_at' => date('Y-m-d : h:m:s'),
						);

						$this->session->set_userdata($user_data);
						$this->session->set_userdata('is_login', TRUE);

						$this->session->set_userdata('user_id', $result);

						redirect(base_url('mahasiswa/dashboard'), 'refresh');
					} else {
						$data['ref'] = $referrer;
						$data['msg'] = 'Invalid Username or Password!';
						$this->load->view('auth/login', $data);
					}
				}
			} else {
				$data['ref'] = $referrer;
				$this->load->view('auth/login', $data);
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth/login'), 'refresh');
	}
}  // end class
