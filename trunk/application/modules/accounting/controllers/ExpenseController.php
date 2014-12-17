<?php

class Accounting_ExpenseController extends Zend_Controller_Action
{
	const REDIRECT_URL = '/agent';
	private $activelist = array('មិនប្រើ​ប្រាស់', 'ប្រើ​ប្រាស់');
	
    public function init()
    {
        /* Initialize action controller here */
    	header('content-type: text/html; charset=utf8');
    	
    	//clear all other sessions
    	Application_Form_FrmSessionManager::clearSessionSearch();
    }

    public function indexAction()
    {
      
        
    }

 //djalv odigja oslfc kfsdalfij doflkdslkffkmaslcds fkds fklfasdj fldsa fadij fodslflsd jflsdf lsdj foal
    
    public function addAction()
    {
    	if($this->getRequest()->isPost()){
			$agentdata=$this->getRequest()->getPost();	
			$db_agent = new Expens_models_Dbtable_DbInsert();				
			try {
				$db = $db_agent->addStudent($agentdata);				
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);		
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
    	$pructis=new Accounting_Form_Frmexpense();
    	$frm = $pructis->FrmAddExpense();
    	Application_Model_Decorator::removeAllDecorator($frm);
    	$this->view->frm_expense=$frm;
    }
    public function viewAction()
    {
        // action body
        $ag_id = $this->getRequest()->getParam('ag_id');
		
		$db_agent = new Application_Model_DbTable_DbAgents();
		$this->view->agent_view = $db_agent->getAgentViewById($ag_id);
    }

    public function editedAction()
    {
        // action body
        $ag_id = $this->getRequest()->getParam('ag_id');
    	$ag_id = (empty($ag_id))? 0 : $ag_id; 
    	
    	$pro = new Application_Model_DbTable_DbProvinces();
		$this->view->provinces = $pro->getProvinceListAll();
		
		$db_agent = new Application_Model_DbTable_DbAgents();
		$this->view->agent_edit = $db_agent->getAgentEditedById($ag_id);
		
    	if($this->getRequest()->isPost()){
			$agentdata=$this->getRequest()->getPost();	
							
			try {
				$db = $db_agent->updateAgent($agentdata);				
				Application_Form_FrmMessage::Sucessfull('ការ​បញ្ចូល​​ជោគ​ជ័យ', self::REDIRECT_URL);		
			} catch (Exception $e) {
				$this->view->msg = 'ការ​បញ្ចូល​មិន​ជោគ​ជ័យ';
			}
		}
    }


}







