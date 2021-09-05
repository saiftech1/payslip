<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payslips_model extends CI_Model {
	
	public function getMySlips($limit = 0){
		$this->db->from('slips');
		$this->db->join('payslips', 'payslips.id = slips.payslip_id');
		$this->db->order_by('unix_date', 'desc');
		$this->db->where('ippis_no', $_SESSION['ippis_no']);
		if($limit != 0) $this->db->limit($limit);
		$result = $this->db->get();
		return $result->result();
	}
	
	public function getPaySlips(){
		$this->db->order_by('unix_date', 'desc');
		return $this->db->get('payslips')->result();
	}
	
	public function getSlips($hash){
		$this->db->from('slips');
		$this->db->join('payslips', 'payslips.id = slips.payslip_id');
		$this->db->join('profiles', 'slips.ippis_no = profiles.ippis_no');
		$this->db->where('payslips.hash', $hash);
		$this->db->order_by('slip_unixdate', 'desc');
		return $this->db->get()->result();
	}
	
	public function approvePayslip($hash){
		$this->db->set('status', '1');
		$this->db->where('hash', $hash);
		return $this->db->update('payslips');
	}
	
	public function disapprovePayslip($hash){
		$this->db->set('status', '0');
		$this->db->where('hash', $hash);
		return $this->db->update('payslips');
	}
	
	public function deletePayslip($hash){
		$sql = "select payslips.id from payslips WHERE payslips.hash = ?";
		$pid = $this->db->query($sql, [$hash])->row()->id;
		
		$this->db->where('payslip_id', $pid);
        $this->db->delete('slips');
        
        $this->db->reset_query();
        
        $this->db->where('id', $pid);
        $this->db->delete('payslips');
		return true;
	}
	
	public function savePaySlip($data){
        $this->db->replace('payslips', $data);
        $lastid = $this->db->insert_id();
        return $lastid ? $lastid : FALSE;
    }
    
    public function saveSlips($data){
        //var_dump($data); 
        $this->db->where('payslip_id', $data[0]['payslip_id']);
        $this->db->delete('slips');
        $this->db->reset_query();
        return $this->db->insert_batch('slips', $data);
    }

}
