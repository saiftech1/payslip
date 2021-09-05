<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model {
	
	public function getAll(){
		$this->db->from('profiles');
		$this->db->join('users', 'users.id = profiles.userid');
		$this->db->order_by('username', 'asc');
		return $this->db->get()->result();
	}

	public function addStaff($data){
		return $this->db->insert('staff', $data);
	}

	public function getInfo(){
		$this->db->from('users');
		$this->db->join('profiles', 'users.id = profiles.userid');
		$this->db->where('users.username', $_SESSION['username']);
		return $this->db->get()->row();
	}

	public function saveEdit($data){
		$this->db->set('personal_phone', $data['personal_phone']);
		$this->db->set('personal_email', $data['personal_email']);
		$this->db->set('contact_address', $data['contact_address']);
		$this->db->where('userid', $_SESSION['userid']);
		return $this->db->update('contact_info');
		//echo $this->db->last_query(); die;
	}

	public function getStaff($hash){
		$this->db->from('users');
		$this->db->join('profiles', 'users.id = profiles.userid');
		$this->db->where('users.user_hash', $hash);
		$result = $this->db->get()->row();
		return $result;
	}

	public function getStates(){
		$this->db->from('states');
		$this->db->order_by('state_name', 'asc');
		return $this->db->get()->result();
	}
	
	public function getBio($staffid){
		$this->db->from('users');
		$this->db->join('profiles', 'users.id = profiles.userid');
		$this->db->join('appt_types', 'appt_types.id = profiles.appt_type');
		$this->db->join('units', 'units.id = profiles.unit_id');
		$this->db->join('departments', 'departments.id = units.dept_id');
		$this->db->join('ranks', 'ranks.id = profiles.current_rank');
		$this->db->where('profiles.userid', $staffid);
		return $this->db->get()->row();
	}

	public function getContactInfo($staffid){
		$this->db->from('contact_info');
		$this->db->join('states', 'states.id = contact_info.stateid');
		$this->db->join('local_governments', 'local_governments.id = contact_info.lgaid');
		$this->db->where('userid', $staffid);
		return $this->db->get()->row();
	}

	public function getFinInfo($staffid){
		$this->db->from('finance_info');
		$this->db->join('banks', 'banks.id = finance_info.bank_id');
		$this->db->join('pension_administrators', 'pension_administrators.id = finance_info.pfa_admin_id');
		$this->db->join('salary_structure', 'salary_structure.id = finance_info.salary_structure');
		$this->db->where('finance_info.userid', $staffid);
		return $this->db->get()->row();
	}

	public function getAcadInfo($staffid){
		return $this->db->get_where('academic_qualifications', ['userid' => $staffid])->result();
	}


}
