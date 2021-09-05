<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->library('phpmailer_lib');
	}

	public function updateDB(){
		return $this->auth_model->updateDB();
	}

	public function login(){
		$this->session->set_userdata('pageTitle', 'Please Login .::. HR-FUBK');
		return $this->load->view('login');
	}

	public function lock_screen(){
		if(!isset($_SESSION['username'])){
			redirect('auth/logout', 'refresh');
		}
		$this->session->set_userdata('pageTitle', 'Lock Screen .::. HR-FUBK');
		return $this->load->view('lock');
	}

	public function reset(){
		$this->session->set_userdata('pageTitle', 'Reset Password .::. HR-FUBK');
		return $this->load->view('reset');
	}

	public function activate(){
		$this->session->set_userdata('pageTitle', 'Activate Account .::. HR-FUBK');
		return $this->load->view('activate');
	}

	public function resetPassword(){
		$this->session->set_userdata('pageTitle', 'Reset Password .::. HR-FUBK');
		$hash = $this->uri->segment(3);
		$user = $this->auth_model->getUser(['password_reset_hash' => $hash]);
		
		if($user){
			$_SESSION['resetUserID'] = $user->username;
			return $this->load->view('change_password', ['resetHash' => $hash]);
		}else{
			$this->session->set_flashdata('msg', 'Invalid Request Link. Please Try Again');
			return redirect('auth/login', 'refresh');
		}
	}

	public function changepass(){
		$hash = $this->input->post('resetHash');
		$sims_password = $this->input->post('sims_password');
		$sims_cpassword = $this->input->post('sims_cpassword');

		if($sims_password != $sims_cpassword){
			$this->session->set_flashdata('msg', 'Password Mismatch. Please Try Again');
			return $this->load->view('change_password', ['resetHash' => $hash]);
		}else{
			$data = [
				'username' => $_SESSION['resetUserID'],
				'password' => hash('sha512', $sims_password)
			];
			$user = $this->auth_model->changeUserPassword($data);
			$this->session->set_flashdata('msg', 'Password Changed Successfully. Please Login');
			return redirect('auth/login', 'refresh');
		}
	}

	public function resetpass(){
		$username = $this->input->post('sims_username');
        if(!(substr($username, strpos($username, '@')) == "@fubk.edu.ng")){
            $this->session->set_flashdata('msg', 'Only Registred University Emails are Allowed');
		    return redirect('auth/reset', 'refresh');
        }
        
        $this->auth_model->setResetHash(['reset_hash' => hash('sha512', $username.date('YmdHis').rand()), 'username' => $username]);
		$user = $this->auth_model->getUserByEmail($username);
		
		if($user){
		    $odds = array("0", "o", "O", "i", "I", "1", "C", "c", "J", 'j');
		    
			$password = hash('sha512', date("YmdHis").$user->username.$user->user_hash);
			$password = str_replace($odds, "", $password);
			$password = substr($password, rand(0, 8), 8);
			

			$msg = "<h1>MIS IT Account</h1><br>";
			$msg = "<h2>PRIVATE AND CONFIDENTIAL</h2><br><br><br>";
			$msg = "Hello ".trim(ucfirst(strtolower($user->firstname))).",<br><br>";
			$msg .= "You have requested for a new password to access the Staff Portal. Your login details are as below: <br><br><br>";
			$msg .= "<em>Username:</em> ".$username."<br>";
			$msg .= "<em>Password:</em> ".$password."<br><br><br>";
			$msg .= "Visit <a target='_blank' href='https://staffportal.fubk.edu.ng'>https://staffportal.fubk.edu.ng</a> to login with these details. ";
			$msg .= "At the first opportunity, you must change your password by logging in to <a target='_blank' href='https://staffportal.fubk.edu.ng/auth/resetPassword/".$user->password_reset_hash."'>Password Reset</a>. ";
			$msg .= "Disclosing your network account login and password is a serious breach of University security policies and could result in disciplinary procedures.";
			$msg .= "<br><br><br>Kind regards,<br>Cloud Identity Unit<br>E: mis@fubk.edu.ng";
			try {
				$mail = $this->phpmailer_lib->initialize();
				$mail->Subject = "FUBK Human Resource";
				$mail->setFrom('noreply@fubk.edu.ng', 'Password Reset Manager');
				$mail->addAddress($user->username);
				$mail->Body    = $msg;
				$mail->AltBody = $msg;

				$mail->send();

				$data = [
					'password' => hash('sha512', $password), 
					'username' => $user->username
				];
				$this->auth_model->setPassword($data);
			} catch (Exception $e) {
				log_message('error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
			}
		}

		$this->session->set_flashdata('msg', 'If the details are correct, we have sent a reset link to your registered email address. Please check your email to proceed');
		return redirect('auth/reset', 'refresh');

	}
	

	public function activateacct(){
		$username = $this->input->post('sims_username');
        if(!(substr($username, strpos($username, '@')) == "@fubk.edu.ng")){
            $this->session->set_flashdata('msg', 'Only Registred University Emails are Allowed');
		    return redirect('auth/reset', 'refresh');
        }
        
        $this->auth_model->setResetHash(['reset_hash' => hash('sha512', $username.date('YmdHis').rand()), 'username' => $username]);
		$user = $this->auth_model->getUserByEmail($username);
		
		if($user){
		    $odds = array("0", "o", "O", "i", "I", "1", "C", "c", "J", 'j');
		    
			$password = hash('sha512', date("YmdHis").$user->username.$user->user_hash);
			$password = str_replace($odds, "", $password);
			$password = substr($password, rand(0, 8), 8);
			

			$msg = "<h1>MIS IT Account</h1><br>";
			$msg = "<h2>PRIVATE AND CONFIDENTIAL</h2><br><br><br>";
			$msg = "Hello ".trim(ucfirst(strtolower($user->firstname))).",<br><br>";
			$msg .= "You have requested to activate your access to the Staff Portal. Your login details are as below: <br><br><br>";
			$msg .= "<em>Username:</em> ".$username."<br>";
			$msg .= "<em>Password:</em> ".$password."<br><br><br>";
			$msg .= "Visit <a target='_blank' href='https://staffportal.fubk.edu.ng'>https://staffportal.fubk.edu.ng</a> to login with these details. ";
			$msg .= "At the first opportunity, you must change your password by logging in to <a target='_blank' href='https://staffportal.fubk.edu.ng/auth/resetPassword/".$user->password_reset_hash."'>Password Reset</a>. ";
			$msg .= "Disclosing your network account login and password is a serious breach of University security policies and could result in disciplinary procedures.";
			$msg .= "<br><br><br>Kind regards,<br>Cloud Identity Unit<br>E: mis@fubk.edu.ng";
			try {
				$mail = $this->phpmailer_lib->initialize();
				$mail->Subject = "FUBK Human Resource";
				$mail->setFrom('noreply@fubk.edu.ng', 'Password Reset Manager');
				$mail->addAddress($user->username);
				$mail->Body    = $msg;
				$mail->AltBody = $msg;

				$mail->send();

				$data = [
					'password' => hash('sha512', $password), 
					'username' => $user->username
				];
				$this->auth_model->setPassword($data);
			} catch (Exception $e) {
				log_message('error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
			}
		}

		$this->session->set_flashdata('msg', 'If the details are correct, we have sent an activate email to your registered email address. Please check your email to proceed');
		return redirect('auth/activate', 'refresh');

	}

	public function change_theme(){
		$_SESSION['theme_mode'] = ($_SESSION['theme_mode'] == "dark-mode") ? "" :  "dark-mode";
		redirect($this->uri->segment(3).'/'.$this->uri->segment(4), 'refresh');
	}

	public function logout(){
		$this->session->set_userdata('pageTitle', 'Please Login .::. HR-FUBK');
		$this->session->set_flashdata('msg', 'Logout Successful, Bye!');
		$_SESSION['loginStatus'] = false;
		$_SESSION['userid'] = null;
		$_SESSION['schoolid'] = null;
		$_SESSION['roleid'] = null;
		$_SESSION['roleid'] = null;
		return redirect('auth/login', 'refresh');
	}

	public function authenticate(){
		$this->session->set_userdata('pageTitle', 'Welcome .::. HR-FUBK');

		$data = [
			'username' => $this->input->post('sims_username'),
			'password' => hash('sha512', $this->input->post('sims_password'))
		];

		$result = $this->auth_model->authenticate($data);
		if($result){
			$_SESSION['loginStatus'] = true;
			$_SESSION['username'] = $result->username;
			$_SESSION['employeeID'] = $result->employeeID;
			$_SESSION['fullname'] = strtoupper($result->surname).' '.ucwords(strtolower($result->firstname.' '.$result->othernames));
			$_SESSION['userid'] = $result->userid;
			$_SESSION['roleid'] = $result->roleid;
			$_SESSION['ippis_no'] = $result->ippis_no;
			$_SESSION['role'] = $result->role_name;
			$_SESSION['userHash'] = $result->user_hash;
			$_SESSION['theme_mode'] = '';
			$_SESSION['schoolName'] = "Federal University Birnin Kebbi - HR System";
			$_SESSION['shortName'] = "FUBK-HR";
			$_SESSION['last_activity'] = $_SERVER['REQUEST_TIME'];

			$url = 'staff/index';
			
			if(!$result->roleid){
				$url = 'auth/logout'; 
				$this->session->set_flashdata('msg', 'Something went wrong. Please contact your school administrator'); 
			}
			$_SESSION['home_url'] = $url;
			$this->session->set_flashdata('msg', 'Login Successful, Welcome to FUBK-HR');
			return redirect($url, 'refresh');
		}else{
			$this->session->set_flashdata('msg', 'Invalid Username/Password');
			return redirect('auth/login', 'refresh');
		}
	}
	
	
	public function authenticateWithGoogle($email){
		$this->session->set_userdata('pageTitle', 'Welcome .::. HR-FUBK');

		$data = ['username' => $email];

		$result = $this->auth_model->authenticate($data);
		if($result){
			$_SESSION['loginStatus'] = true;
			$_SESSION['username'] = $result->username;
			$_SESSION['employeeID'] = $result->employeeID;
			$_SESSION['fullname'] = strtoupper($result->surname).' '.ucwords(strtolower($result->firstname.' '.$result->othernames));
			$_SESSION['userid'] = $result->userid;
			$_SESSION['roleid'] = $result->roleid;
			$_SESSION['ippis_no'] = $result->ippis_no;
			$_SESSION['role'] = $result->role_name;
			$_SESSION['userHash'] = $result->user_hash;
			$_SESSION['theme_mode'] = '';
			$_SESSION['schoolName'] = "Federal University Birnin Kebbi - HR System";
			$_SESSION['shortName'] = "FUBK-HR";
			$_SESSION['last_activity'] = $_SERVER['REQUEST_TIME'];

			$url = 'staff/index';
			
			if(!$result->roleid){
				$url = 'auth/logout'; 
				$this->session->set_flashdata('msg', 'Something went wrong. Please contact your school administrator'); 
			}
			$_SESSION['home_url'] = $url;
			$this->session->set_flashdata('msg', 'Login Successful, Welcome to FUBK-HR');
			return redirect($url, 'refresh');
		}else{
			$this->session->set_flashdata('msg', 'Invalid Username/Password');
			return redirect('auth/login', 'refresh');
		}
	}

	public function sendMail(){
		echo "Sending mail...";
		$mail = $this->phpmailer_lib->initialize();

		try {
			
			$mail->Subject = $this->input->post('subject');
			$mail->setFrom('noreply@fubk.edu.ng', 'FUBK Cloud Identity');
			$mail->addAddress($this->input->post('receipient'));
			$mail->addCC('noreply@fubk.edu.ng');
			$mail->addAttachment('./uploads/fubklogo.jpeg', 'The University Logo');
			$mail->Body    = $this->input->post('msg');
			$mail->AltBody = $this->input->post('msg');

			$mail->send();
			$this->session->set_flashdata('msg', 'Message has been sent');
		} catch (Exception $e) {
			$this->session->set_flashdata('msg', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
		}
		redirect('notification/index', 'refresh');
	}

	public function mongo(){
		return $this->load->view('mongo');
	}
	
	public function identity(){
	    $data = [
	        "op" => "SignIn",
	        "code" => "5603F2B95B80E37BDBE4",
	        "source_url" => "https://staffportal.fubk.edu.ng",
	        "return_url" => "https://staffportal.fubk.edu.ng/auth/complete",
	    ];
	    $jwt = JWT::encode($data, $this->config->item('encryption_key'));
	    header("location: https://identity.fubk.edu.ng/?v=".($jwt));
	}
	
	public function identitySignOut(){
	    $data = [
	        "op" => "SignOut",
	        "code" => "5603F2B95B80E37BDBE4",
	        "source_url" => "https://staffportal.fubk.edu.ng",
	        "return_url" => "https://staffportal.fubk.edu.ng/auth/complete",
	    ];
	    $jwt = JWT::encode($data, $this->config->item('encryption_key'));
	    header("location: https://identity.fubk.edu.ng/?v=".($jwt)."&op=0");
	}
	
	public function complete(){
	    header('Access-Control-Allow-Origin: *');
        header('Acces-Control-Allow-Methods','GET,POST,PUT,PATCH,DELETE');
            
	    $jwt = $_GET['v'];
	    $jwt = JWT::decode($jwt, $this->config->item('encryption_key'), true);
	    
	    if($jwt->auth_status){
	        $this->authenticateWithGoogle($jwt->username);
	    }else{
	        $this->logout();
	    }
	}
}
