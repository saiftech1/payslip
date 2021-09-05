<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataEntry_model extends CI_Model {
	
	public function getAll(){
		$this->db->from('profiles');
		$this->db->join('users', 'users.username = profiles.employee_no');
		$this->db->order_by('username', 'asc');
		return $this->db->get()->result();
	}

	public function addStaff($data){
		return $this->db->insert('staff', $data);
	}

	public function getInfo(){
		$this->db->from('users');
		$this->db->join('profiles', 'users.username = profiles.employee_no');
		$this->db->where('users.username', $_SESSION['username']);
		return $this->db->get()->row();
	}

	public function getStaff($hash){
		$this->db->from('users');
		$this->db->join('profiles', 'users.username = profiles.employee_no');
		$this->db->where('users.user_hash', $hash);
		return $this->db->get()->row();
	}

}
