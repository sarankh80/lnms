<?php
class Report_ParamaterController extends Zend_Controller_Action {
    public function init()
    {    	
     /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
  function indexAction(){
  	
  }
  
  function  rptStaffAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->staff_list = $db->getAllstaff();
  	//print_r($db->getAllstaff());
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function  rptVillageAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->village_list = $db->getAllVillage();
  	//print_r($db->getAllstaff());
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptZoneAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->zone_list = $db->getAllZone();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  }
  function rptHolidayAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->holiday_list = $db->getAllHoliday();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	
  }
  function rptBranchAction(){
  	$db  = new Report_Model_DbTable_DbParamater();
  	$this->view->branch_list = $db->getAllBranch();
  	$key = new Application_Model_DbTable_DbKeycode();
  	$this->view->data=$key->getKeyCodeMiniInv(TRUE);
  	 
  }
}

