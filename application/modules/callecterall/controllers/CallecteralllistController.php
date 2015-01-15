<?php

class Callecterall_CallecteralllistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
    }

    public function addAction()
    {
    	
       $fm = new Callecterall_Form_Frmcallecteralllist();
	   $frm = $fm->callecteralllist(); 
	   Application_Model_Decorator::removeAllDecorator($frm);
	   $this->view->Form_Frmcallecterall = $frm;
	   
    }
   
    
}
?>
