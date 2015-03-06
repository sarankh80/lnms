<?php

class Tellerandexchange_XchangesController extends Zend_Controller_Action
{
	const REDIRECT_URL='/tellerandexchange/xchanges';
	public function init()
	{
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL') || define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
		try{
			$db_tran=new Application_Model_DbTable_DbGlobal();
			
			$session_transfer=new Zend_Session_Namespace('search_xhcange');
			$db = new Tellerandexchange_Model_DbTable_Dbexchange();
			$session_user=new Zend_Session_Namespace('auth');
			$user_id = $session_user->user_id;
		
			
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'client_id' => -1,
						'status' => -1,
						'from_date' =>date('Y-m-d'),
						'to_date' => date('Y-m-d'),
				);
			}
			$rs_row= $db->getAllExchangeListMulti($search);
			
			$glClass = new Application_Model_GlobalClass();
			$rs_rows = $glClass->getImgActive($rs_row, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("ឈ្មោះអតិថិជន","ថ្ងៃ​ប្រតិបត្តិ","វិ.បត្រ","ការប្តូរប្រាក់","ទិញចូល","អត្រាប្តូរប្រាក់","លក់ចេញ","ប្រាក់​ទទួល​បាន​","ប្រាក់​អាប់","TYPE","STATUS");
			$link=array(
					'module'=>'tellerandexchange','controller'=>'exchanges','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs_rows,array('client_name'=>$link,'invoice_code'=>$link,'date'=>$link));
		  
			$usr_mod = new Application_Model_DbTable_DbUsers();
			$this->view->users = $usr_mod->getUserListSelect();
			$this->view->user_id = $user_id;
			//$this->view->from_date=$session_transfer->from_date;
			//$this->view->to_date=$session_transfer->to_date;
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			echo $e->getMessage();
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$frm = new Application_Form_FrmAdvanceSearch();
		$frm = $frm->AdvanceSearch();
		Application_Model_Decorator::removeAllDecorator($frm);
		$this->view->frm_search = $frm;
	}
	public function addAction()
	{
	  // action body       
        //user name for report
        $session_user=new Zend_Session_Namespace('auth');
        $this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
        
        $db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$cur = new Application_Model_DbTable_DbCurrencies();
		$currency = $cur->getCurrencyList();
		
		$this->view->currency = $this->_helpfilteroption($currency);
		
		
		$this->view->inv_no = Application_Model_GlobalClass::getInvoiceNo();
		
		
		if($this->getRequest()->isPost()){
			$formdata=$this->getRequest()->getPost();	
			$db_exc=new Application_Model_DbTable_DbExchange();	
			try {
				$id = $db_exc->save($formdata);
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL . '/index/add');
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
	}
	protected function _helpfilteroption($data){
		$tmp = array();
		foreach ($data as $i =>$d){
			foreach ($d as $key => $val){
				$tmp[$i][$key] = $val;
			}
			$bath=0; $rail=0; $dollar=0;
			if($d['symbol'] === "$"){
				$bath=1; $rail=1;
			}
			elseif($d['symbol'] === "B"){
				$dollar=1; $rail=1;
			}
			elseif($d['symbol'] === "R"){
				$bath=1; $dollar=1;
			}
			$tmp[$i]["dollar"] = $dollar;
			$tmp[$i]["bath"] = $bath;
			$tmp[$i]["rail"] = $rail;
		}
		return $tmp;
	}
 	public function checkRateAction(){
    	$db_rate=new Application_Model_DbTable_DbRate();
    	echo $db_rate->getCurrentRateJson();
    	exit();
    }

}