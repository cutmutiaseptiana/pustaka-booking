<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	// public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model("siswa_model");
    //     $this->load->library('form_validation');
    // }

	public function index()
	{
		$data['judul'] = 'Data Siswa';
		$data['siswa'] = $this->ModelSiswa->getSiswa()->result_array();
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Tambah Siswa';
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
		$this->load->view('siswa/tambah');
		$this->load->view('templates/footer');
	}

	public function save()
	{
		$this->form_validation->set_rules('nama', 'nis', 'kelas', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'required',
	['required' => 'Semua Data Harus Diisi']);
	$data = array(
		'nama' => $this->input->post('nama'),
		'nis' => $this->input->post('nis'),
		'kelas' => $this->input->post('kelas'),
		'tanggal_lahir' => $this->input->post('tanggal_lahir'),
		'tempat_lahir' => $this->input->post('tempat_lahir'),
		'alamat' => $this->input->post('alamat'),
		'gender' => $this->input->post('gender'),
		'agama' => $this->input->post('agama')
	);
		// if ($this->form_validation->run()==true)
        // {
		$this->load->model('ModelSiswa');
		$this->ModelSiswa->save($data);
		redirect('siswa');
	}

	public function edit()
	{
		$data['judul'] = 'edit Siswa';
		$data['siswa'] = $this->ModelSiswa->getSiswa()->result_array();
		$where = ['id' => $this->uri->segment(3)];
		$data['siswa'] = $this->ModelSiswa->siswaWhere($where)->row_array();
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
		$this->load->view('siswa/edit', $data);
		$this->load->view('templates/footer');
	}

	public function editDataSiswa()
	{
		$this->form_validation->set_rules('nama', 'nis', 'kelas', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'required',
	['required' => 'Semua Data Harus Diisi']);
	$data = array(
		'nama' => $this->input->post('nama'),
		'nis' => $this->input->post('nis'),
		'kelas' => $this->input->post('kelas'),
		'tanggal_lahir' => $this->input->post('tanggal_lahir'),
		'tempat_lahir' => $this->input->post('tempat_lahir'),
		'alamat' => $this->input->post('alamat'),
		'gender' => $this->input->post('gender'),
		'agama' => $this->input->post('agama'));
		$this->load->model('ModelSiswa');
		$this->ModelSiswa->editDataSiswa(['id' => $this->input->post('id')],$data);
		redirect('siswa');
	}

	public function hapus()
	{
		$where=['id' => $this->uri->segment(3)];
		$this->ModelSiswa->hapus($where);
		redirect('siswa');
	}

}