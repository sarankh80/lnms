<?php

class Tellerandexchange_ExchangesController extends Zend_Controller_Action
{

	const REDIRECT_URL = '/exchange';
	
    public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	
    	//clear all other sessions
    	Application_Form_FrmSessionManager::clearSessionSearch();
    	
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
    }

    public function indexAction()
    {
        // action body	
        try {
	     
        } catch (Exception $e) {
        }	
    }

    public function editedAction()
    {
        // action body    
        //Get value from url
        $ex_id = $this->getRequest()->getParam('ex_id',0);
        
     	$session_user=new Zend_Session_Namespace('auth');
        $this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
        
        $db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
		$cur = new Application_Model_DbTable_DbCurrencies();
		$currency = $cur->getCurrencyList();
		
		$this->view->currency = $this->_helpfilteroption($currency);
		
		$db_exc=new Application_Model_DbTable_DbExchange();
		$this->view->dataedit = $db_exc->getDataById($ex_id);
		if($this->getRequest()->isPost()){
			$formdata=$this->getRequest()->getPost();	
			try {
				$result = $db_exc->getDataById($formdata['id']);
				$to_type = $db_exc->getCurrencyById("`name`, `symbol`,`country_id`", $formdata["to_amount_type"]);
				$from_type = $db_exc->getCurrencyById("`name`, `symbol`,`country_id`", $formdata["from_amount_type"]);
				
				if($result['fromAmountType']==$from_type['country_id'] && $result['toAmountType']==$to_type['country_id']){//if the edit not change the currency
					$id = $db_exc->updateData($formdata);
				}else{//if edit change the currency we need to add new record
					$formdata['inv_no'] = Application_Model_GlobalClass::getInvoiceNo();
					$id = $db_exc->save($formdata);
				}
				
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);
						
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}       
    }

    public function addAction()
    {
        // action body       
        //user name for report
        $session_user=new Zend_Session_Namespace('auth');
        $this->view->user_name = $session_user->last_name .' '. $session_user->first_name;
        
        $db_keycode = new Application_Model_DbTable_DbKeycode();
		$this->view->keycode = $db_keycode->getKeyCodeMiniInv();
		
// 		$cur = new Application_Model_DbTable_DbCurrencies();
// 		$currency = $cur->getCurrencyList();
		
// 		$this->view->currency = $this->_helpfilteroption($currency);
		
		
		$this->view->inv_no = Application_Model_GlobalClass::getInvoiceNo();
		
		
		if($this->getRequest()->isPost()){
			$formdata=$this->getRequest()->getPost();	
// 			$db_exc=new Application_Model_DbTable_DbExchange();	
			try {
// 				$id = $db_exc->save($formdata);
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL . '/index/add');
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
        
    }
  

    
}











