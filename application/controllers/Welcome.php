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
	public function insert_get()
	{
		
		$id 				= 1;
		$journalnum 		= $this->get('journalnum');
		$accounttype		= $this->get('accounttype');
		$account			= $this->get('account');
		$company			= $this->get('company');
		$debit				= $this->get('debit');
		$currency			= $this->get('currency');
		$exchrate			= $this->get('exchrate');
		$department			= $this->get('department');
		$costcenter			= $this->get('costcenter');
		$purpose			= $this->get('purpose');
		$voucher			= $this->get('voucher');
		$credit				= $this->get('credit');
		$date				= $this->get('date');
		$transactiontype	= $this->get('transactiontype');
		
		$data = array(
			'journalnum'		=> $journalnum,
			'accounttype'		=> $accounttype,
			'account'			=> $account,
			'company'			=> $company,
			'debit'				=> $debit,
			'currency'			=> $currency,
			'exchrate'			=> $exchrate,
			'department'		=> $department,
			'costcenter'		=> $costcenter,
			'purpose'			=> $purpose,
			'voucher'			=> $voucher,
			'credit'			=> $credit,
			'date'				=> $date,
			'transactiontype'	=> $transactiontype
		);
		
		$sql = "INSERT INTO  db_api.dbo.api (journalnum,accounttype,account,company,debit,currency,exchrate,department,costcenter,purpose,voucher,credit,date,transactiontype) 
		VALUES ('$journalnum','$accounttype','$account','$company','$debit','$currency','$exchrate','$department','$costcenter','$purpose','$voucher','$credit','$date','$transactiontype')";
		
		$insert = $this->db->query($sql);
		
		// $insert = $this->db->insert('db_test.dbo.contoh',$data);
		
		if($insert){
			$data = array(
				'code'		=> 201,
				'pesan'		=> 'Berhasil'
			);
		}else{
			$data = array(
				'code'		=> 201,
				'pesan'		=> 'Berhasil'
			);
		}
		$this->response($data);
		
	}
	
	public function tampil_post($access_token=null){
		//untuk fitur auto refresh
		$auto_refresh_token = true;
		
		if($access_token==null){
			$token = $this->post('token');
		}else{
			$token = $access_token;
		}
		
		if(isset($token)){
			$x = json_decode($this->check_access_token($token));
			if(!isset($x->error)){
				$x->access_token = $token;
				$this->response($x);
			}else{
				if($auto_refresh_token){
					$access_token = json_decode(json_decode($this->get_access_token()));
					$x->access_token = $access_token->access_token;
					$this->tampil_post($access_token->access_token);
				}
				$this->response($x);
			}
		}else{
			$this->response(array('error'=>'invalid_get_token','error_description'=>'Unidentified GET Token'));
		}
		
		// print_r($this->check_access_token($token)['asdf']);// json_decode($this->check_access_token($token));
	}
	
	public function check_access_token($param){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url('resource_token'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"access_token=$param");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		return $server_output;
	}
	
	public function get_access_token(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,base_url('token/get_token'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=testclient&client_secret=testpass");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		return $server_output;
	}
	
}
