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
	  	 	$db=new Report_Model_DbTable_DbLnClient();
		 	$rows=$db->getAllLnClient();
		 	$this->view->list=$rows;
  	
  }
  function rptClientAgreementAction(){
  	
  }
  function rptCalleteralAction(){
  	
  }
}

