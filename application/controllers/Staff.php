<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Staff_model');
		$this->load->model('Payslips_model');
	}

	public function index(){
	    $_SESSION['pageTitle'] = 'Staff Dashboard .::. HR-FUBK';
		$data = [
			'staff' => $this->Staff_model->getInfo(),
			'payslips' => $this->Payslips_model->getMySlips(5)
		];
		return $this->load->view('staff/index', $data);
	}

	public function viewall(){
		$_SESSION['pageTitle'] = 'Staff Dashboard .::. HR-FUBK';
		$data = [
			'staff' => $this->Staff_model->getAll(),
		];
		$this->load->view('staff/viewall', $data);
	}

	public function add(){
		$this->Staff_model->addStaff($_POST);
		$this->session->set_flashdata('msg', 'Staff Added Successfully');
		return redirect('staff/index', 'refresh');
	}

	public function new(){
	    $_SESSION['pageTitle'] = 'Add New Staff .::. HR-FUBK';
		$data = [
			'states' => $this->Staff_model->getStates(),
		];
		$this->load->view('staff/new', $data);
	}

	public function view(){
	    $_SESSION['pageTitle'] = 'View Staff .::. HR-FUBK';
		$hash = $_SESSION['userHash'];
		if(!$hash) redirect('staff', 'refresh');

		$staffid = $this->Staff_model->getStaff($hash)->userid;

		$data = [
			'staff' => $this->Staff_model->getBio($staffid),
			'fin_info' => $this->Staff_model->getFinInfo($staffid),
			'contact_info' => $this->Staff_model->getContactInfo($staffid),
			'acad_info' => $this->Staff_model->getAcadInfo($staffid),
		];
		return $this->load->view('staff/view', $data);
	}
	
	public function edit(){
	    $_SESSION['pageTitle'] = 'Edit Staff .::. HR-FUBK';
		$hash = $_SESSION['userHash'];
		if(!$hash) redirect('staff', 'refresh');

		$staffid = $this->Staff_model->getStaff($hash)->userid;

		$data = [
			'staff' => $this->Staff_model->getBio($staffid),
			'contact_info' => $this->Staff_model->getContactInfo($staffid)
		];
		return $this->load->view('staff/edit', $data);
	}
	
	public function saveEdit(){
        $data = [
            'personal_phone' => trim($this->input->post('phone')), 
            'personal_email' => trim($this->input->post('personal_email')), 
            'contact_address' => trim($this->input->post('contact_address'))
        ];
		if($this->Staff_model->saveEdit($data)){
		    $this->session->set_flashdata('msg', 'Update Successful');
		}else{
		    $this->session->set_flashdata('msg', 'Update Failed, please try again');
		}
		return redirect('staff/view', 'refresh');
	}
	
	public function print(){
		$_SESSION['pageTitle'] =  'Employee Data Profile Printout .::. HR-FUBK';
		$hash = $_SESSION['userHash'];//this->uri->segment(3) ? $this->uri->segment(3) : false;
		if(!$hash) redirect('staff', 'refresh');

		$data = [
			'staff' => $this->Staff_model->getStaff($hash)
		];
		return $this->load->view('staff/print', $data);
	}
}
