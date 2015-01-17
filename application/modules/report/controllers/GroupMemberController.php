<?php
class Report_GroupMemberController extends Zend_Controller_Action {
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  function rptIndividulAction(){
  	
  }
  function rptClientInformationAction(){
	  	 
  }
  function rptClientAgreementAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptCalleteralAction(){
  	$db  = new Report_Model_DbTable_DbLnClient();
  	$this->view->calleteral_list = $db->getAllCalleteral();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptClientAction(){
    $db  = new Report_Model_DbTable_DbLnClient();
  	$this->view->client_list = $db->getAllLnClient();
  	//  	print_r($rows);exit();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptGroupAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptAgreementAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptCalleteralValueAction(){
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
 
}

