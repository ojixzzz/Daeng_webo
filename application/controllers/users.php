<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('webo_users_m');
    }

	public function login()
	{
		$username = $this->input->post('username');
		if ($username) {
			$datauser = $this->webo_users_m->get_username($username);
			if($datauser){
				$data = array(
					'weblocker' =>
						 array(
						 	'name' => $datauser->name, 
						 	'username' => $datauser->username,
						 	'email'=> $datauser->email,
						 	'passwd'=> $datauser->passwd
						 )
				);
			}else{
				$data = array(
					'weblocker' =>
						 array(
						 	'status' => 'error',
						 	'error_msg'=> 'User tidak terdaftar!'
						 )
				);
			}
		}else{
			$data = array(
				'weblocker' =>
					 array(
					 	'status' => 'error',
					 	'error_msg'=> 'Parameter tidak lengkap!'
					 )
			);
		}
		echo json_encode($data);
	}

	public function register()
	{
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$passwd = $this->input->post('passwd');
		if ($name && $username && $email && $passwd) {
			$param = array(
				'name' => $name, 
				'username' => $username,
				'email' => $email,
				'passwd' => hash('sha256', $passwd)
			);
			$datauser = $this->webo_users_m->get_username($username);
			if(!$datauser){
				if($this->webo_users_m->insert($param)){
					$datauser = $this->webo_users_m->get_username($username);
					if($datauser){
						$data = array(
							'weblocker' =>
								 array(
								 	'name' => $datauser->name, 
								 	'username' => $datauser->username,
								 	'email'=> $datauser->email,
								 	'passwd'=> $datauser->passwd
								 )
						);
					}
				}else{
					$data = array(
						'weblocker' =>
							 array(
							 	'status' => 'error',
							 	'error' => '1',
							 	'error_msg'=> 'Error saat registrasi!'
							 )
					);
				}
			}else{
					$data = array(
						'weblocker' =>
							 array(
							 	'status' => 'error',
							 	'error' => '2',
							 	'error_msg'=> 'User sudah terdaftar!'
							 )
					);
			}
		}else{
			$data = array(
				'weblocker' =>
					 array(
					 	'status' => 'error',
					 	'error_msg'=> 'Param tidak lengkap!'
					 )
			);
		}
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */