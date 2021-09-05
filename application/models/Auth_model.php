<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	
	public function authenticate($data){
		$this->db->from('users');
		$this->db->join('profiles', 'profiles.userid = users.id');
		$this->db->join('roles', 'roles.roleid = users.role_profile');
		$result = $this->db->get_where('', $data);
		if($result->num_rows() == 1){
			$row = $result->row();
			$this->db->set('last_login', 'NOW()', false);
			$this->db->where('username', $row->username);
			$this->db->update('users');
			return $row;
		}else{
			return false;
		}
	}

	public function getUser($data){
		$this->db->from('users');
		$this->db->join('profiles', 'profiles.userid = users.id');
		$result = $this->db->get_where('', $data);
		return $result->num_rows() == 1 ? $result->row() : false;
	}

	public function getUserByEmail($username){
		$this->db->from('users');
		$this->db->join('profiles', 'profiles.userid = users.id');
		$result = $this->db->get_where('', ['username' => $username]);
		return $result->num_rows() == 1 ? $result->row() : false;
	}

	public function setResetHash($data){
		$this->db->set('password_reset_hash', $data['reset_hash']);
		$this->db->where('username', $data['username']);
		return $this->db->update('users');
	}

	public function setPassword($data){
		$this->db->set('password', $data['password']);
		$this->db->where('username', $data['username']);
		return $this->db->update('users');
	}

	public function changeUserPassword($data){
		$this->db->set('password', $data['password']);
		$this->db->where('username', $data['username']);
		return $this->db->update('users');
	}

	public function updateDB(){
		$users = $this->db->get('users')->result();
		$data = [];
		foreach($users as $row){
			$data[] = [
				'username' => $row->username,
				'password' => hash('sha512', $row->username)
			];
		}
		$this->db->update_batch('users', $data, 'username');
	}


}
