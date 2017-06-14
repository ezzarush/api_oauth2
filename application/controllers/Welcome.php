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
		
		// $sql = "INSERT INTO  db_test.dbo.api (journalnum,accounttype,account,text,debit,currency,exchrate,department,costcenter,purpose,voucher,credit,date,transactiontype) 
		// VALUES ('$journalnum','$accounttype','$account','$text','$debit','$currency','$exchrate','$department','$costcenter','$purpose','$voucher','$credit','$date','$transactiontype')";
		
		// echo $sql;die;
		// $sql = "INSERT INTO  db_test.dbo.contoh (id,ket) VALUES ($id,'$ket')";
		
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
	
	public function tampil(){
echo 'ea';
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
