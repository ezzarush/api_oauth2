<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

	function __construct(){
        @session_start();
        parent::__construct();
        $this->load->library("Server", "server");
    }
	
	public function get_token(){
		$post = [
			'grant_type'	=> 'client_credentials',
			'client_id' 	=> 'testclient',
			'client_secret'	=> 'testpass',
			'scope' 		=> 'userinfo cloud file node'
		];
		$ch = curl_init(base_url('token/token'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$response = curl_exec($ch);
		curl_close($ch);
		// var_dump($response);
		echo json_encode($response);	
		// $this->response($server_output);
	}
	
	public function token(){
		$this->server->client_credentials();
	}
	
	public function contoh(){
		echo json_encode(array('success' => true, 'message' => 'You accessed my APIs!'));
	}
}
