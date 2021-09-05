<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataEntry extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('DataEntry_model');
		$this->load->model('Payslips_model');
	}

	public function index(){
		$data = [
			'data_entry' => $this->data_entry_model->getInfo(),
			'payslips' => $this->Payslips_model->getMySlips(5)
		];
		return $this->load->view('data_entry/index', $data);
	}

	public function viewall(){
		$this->session->set_userdata('pageTitle', 'data_entry Dashboard .::. HR-FUBK');
		$data = [
			'data_entry' => $this->data_entry_model->getAll(),
		];
		$this->load->view('data_entry/viewall', $data);
	}

	public function add(){
		$this->data_entry_model->adddata_entry($_POST);
		$this->session->set_flashdata('msg', 'data_entry Added Successfully');
		return redirect('data_entry/index', 'refresh');
	}

	public function view(){
		$hash = $_SESSION['userHash'];//this->uri->segment(3) ? $this->uri->segment(3) : false;
		if(!$hash) redirect('data_entry', 'refresh');

		$data = [
			'data_entry' => $this->data_entry_model->getdata_entry($hash)
		];
		return $this->load->view('data_entry/view', $data);
	}

	public function print(){
		$_SESSION['pageTitle'] =  'Employee Data Profile Printout .::. HR-FUBK';
		$hash = $_SESSION['userHash'];//this->uri->segment(3) ? $this->uri->segment(3) : false;
		if(!$hash) redirect('data_entry', 'refresh');

		$data = [
			'data_entry' => $this->data_entry_model->getdata_entry($hash)
		];
		return $this->load->view('data_entry/print', $data);
	}
}
