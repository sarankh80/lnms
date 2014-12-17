<?php
class Accounting_IncomeController extends Zend_Controller_Action {
	
    public function init()
    {    	
    	header('content-type: text/html; charset=utf8');
	}

    public function indexAction()
    {
    	
    }
    public function addAction()
    {
    	$fm = new Accounting_Form_Frmincome();
    	$frm = $fm->FrmIncome();
    	Application_Model_Decorator::removeAllDecorator($frm);
    	$this->view->frm_income=$frm;
    }
   
}
