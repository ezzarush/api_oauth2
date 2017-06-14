<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Welcome extends REST_Controller {

	function __construct(){
        @session_start();
        parent::__construct();
        $this->load->library("Server", "server");
    }
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index_get()
	{
		// echo $this->get('ea');
		
		$data = array(
			'201'=>'success',
			'info'=>$this->get('kata')
		);
		
		$this->response($data);
		// $this->load->view('welcome_message');
		
		// { grant_type: "password", username: "user", password: "pass", client_id: 'testclient', client_secret:'testpass', scope:'userinfo cloud file node' }
		$data = array(
		);
		// $data2 = $this->db->get('contoh')->result_array();
		// print_r($data2);
		// $this->kodok();
	}
	
	public function insert_post(){
		
	}
	
	public function kodok(){
		$grant_type="password";
		$username="user";
		$password="pass";
		$client_id="testclient";
		$client_secret="testpass";
		$scope="userinfo cloud file node";
		$this->server->client_credentials();
	}
}
