<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Mahasiswa_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('formulir');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['view'] = 'dashboard/index';
		$this->load->view('layout/layout', $data);
	}
}
