<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Welcome extends REST_Controller {

	function __construct(){
        @session_start();
        parent::__construct();
        $this->load->library("Server", "server");
    }
	
	public function index_get(){
		echo '#########################################<br/>';
		echo 'Codeigniter API OAuth2 Integrated Systems V1.1<br/>';
		echo '#########################################';
		date_default_timezone_set("Asia/Jakarta");
		echo '<h5>'.date('Y-m-d H:m:s').' ('.date_default_timezone_get().')</h5><br/>';
	}
	
	public function insert()
	{
		
		$id 				= 1;
		$journalnum 		= $this->post('journalnum');
		$accounttype		= $this->post('accounttype');
		$account			= $this->post('account');
		$company			= $this->post('company');
		$text				= $this->post('text');
		$debit				= $this->post('debit');
		$currency			= $this->post('currency');
		$exchrate			= $this->post('exchrate');
		$department			= $this->post('department');
		$costcenter			= $this->post('costcenter');
		$purpose			= $this->post('purpose');
		$voucher			= $this->post('voucher');
		$credit				= $this->post('credit');
		$date				= $this->post('date');
		$transactiontype	= $this->post('transactiontype');
		
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
		
		$sql = "INSERT INTO  db_api.dbo.api (journalnum,accounttype,account,company,text,debit,currency,exchrate,department,costcenter,purpose,voucher,credit,date,transactiontype) VALUES ('$journalnum','$accounttype','$account','$company','$text','$debit','$currency','$exchrate','$department','$costcenter','$purpose','$voucher','$credit','$date','$transactiontype')";
		
		$insert = $this->db->query($sql);
		
		if($insert){
			$data = array(
				'code'		=> 201,
				'pesan'		=> $sql
			);
		}else{
			$data = array(
				'code'		=> 201,
				'pesan'		=> 'Gagal'
			);
		}
		$this->response($data);
		
	}
	
	public function validate_post($access_token=null){
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
				
				$this->insert();
				
				$x->access_token = $token;
				$this->response($x);
			}else{
				if($auto_refresh_token){
					$access_token = json_decode(json_decode($this->get_access_token()));
					$x->access_token = $access_token->access_token;
					$this->validate_post($access_token->access_token);
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
