<?php

class Payroll_SalaryController extends Zend_Controller_Action
{
	const REDIRECT_URL = '/agent';
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
	
    public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	
    	//clear all other sessions
    	defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
    	Application_Form_FrmSessionManager::clearSessionSearch();
    }
		public function indexAction(){
		try{
			$db = new Payroll_Model_DbTable_DbSalary();
// 			if($this->getRequest()->isPost()){
// 				$search=$this->getRequest()->getPost();
// 			}
// 			else{
// 				$search = array(
// 						'adv_search' => '',
// 						'status' => -1);
// 			}
			$rs_rows= $db->getAllSalary($search=null);
			$glClass = new Application_Model_GlobalClass();//status
			$rs_rows = $glClass->getImgActive($rs_rows, BASE_URL, true);
			$list = new Application_Form_Frmtable();
			$collumns = array("សាខា","លេខកូដបុគ្គលិក","ឈ្មោះបុគ្គលិក","ភេទ","ទួនាទី","ប្រាក់ខែគោល","ថ្ងៃចូលធ្វើការ","ថ្ងៃបើកប្រាក់ខែ","ថ្ងៃ","User Id","Status");
			$link=array(
					'module'=>'payroll','controller'=>'salary','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns,$rs_rows,array('branch_name'=>$link,'staff_code'=>$link,'staff_name'=>$link));
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
    	if($this->getRequest()->isPost()){
   		$_data = $this->getRequest()->getPost();
   		try{
   			$db_salary = new Payroll_Model_DbTable_DbSalary();
   			$db_salary->addSalary($_data);
   			Application_Form_FrmMessage::Sucessfull("ការ​បញ្ចូល​ជោគ​ជ័យ !",'/payroll/salary');
   		}catch(Exception $e){
   			Application_Form_FrmMessage::message("ការ​បញ្ចូល​មិន​ជោគ​ជ័យ");
   			$err =$e->getMessage();
   			Application_Model_DbTable_DbUserLog::writeMessageError($err);
   			}
   		}
    	$pructis=new Payroll_Form_FrmSalary();
    	$frm = $pructis->frmaddSalary();
    	Application_Model_Decorator::removeAllDecorator($frm);
    	$this->view->frm=$frm;
    	$db = new Payroll_Model_DbTable_DbSalary();
    	$this->view->salary_option = $db->getTypeOption();
    }

    public function viewAction()
    {
        // action body
        $ag_id = $this->getRequest()->getParam('ag_id');
		$db_salary = new Payroll_Model_DbTable_DbSalary();
		$this->view->agent_view = $db_salary->getAgentViewById($ag_id);
    }

	function editAction(){
   	$db_salary = new Payroll_Model_DbTable_DbSalary();
   	if($this->getRequest()->isPost()){
   		$_data = $this->getRequest()->getPost();
   		try{
   			$db_salary->addSalary($_data);
   			Application_Form_FrmMessage::Sucessfull("ការ​បញ្ចូល​ជោគ​ជ័យ !",'/payroll/salary');
   		}catch(Exception $e){
   			Application_Form_FrmMessage::message("ការ​បញ្ចូល​មិន​ជោគ​ជ័យ");
   			$err =$e->getMessage();
   			Application_Model_DbTable_DbUserLog::writeMessageError($err);
   		}
   	}
   	$id = $this->getRequest()->getParam("id");
   	$row = $db_salary->getSalaryById($id);
   	if(empty($row)){
   		$this->_redirect('payroll/salary');
   	}
	   	$pructis=new Payroll_Form_FrmSalary();
	    $frm = $pructis->frmaddSalary($row);
	    Application_Model_Decorator::removeAllDecorator($frm);
	    $this->view->frm=$frm;
   }
}







