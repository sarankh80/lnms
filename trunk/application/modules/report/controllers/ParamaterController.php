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
  function  rptHolidayAction(){
  	
  }
  function  rptStaffAction(){
  	 
  }
  function rptZoneAction(){
  	
  }
}

