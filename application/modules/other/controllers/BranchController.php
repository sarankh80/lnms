<?php
class Other_BranchController extends Zend_Controller_Action {
	public function init()
	{
		/* Initialize action controller here */
		header('content-type: text/html; charset=utf8');
		defined('BASE_URL')	|| define('BASE_URL', Zend_Controller_Front::getInstance()->getBaseUrl());
	}
	public function indexAction(){
      try{
    	 $db = new Other_Model_DbTable_DbBranch();
    	 if($this->getRequest()->isPost()){
    	$search=$this->getRequest()->getPost();
   		}
     else{
   		 $search = array(
      		'adv_search' => '',
      		'status' => -1);
  		 }
           $rs_rows= $db->getAllBranch($search);
   			
			$db = new Other_Model_DbTable_DbBranch();
			$rs_rows = $db->getAllBranch();
			$glClass = new Application_Model_GlobalClass();
			$rs = $glClass->getImgActive($rs_rows, BASE_URL, true,null,1);
		
			$list = new Application_Form_Frmtable();
			$collumns = array("BRANCH_KH","BRANCH_EN","ADDRESS","CODE","TEL","FAX","DISPLAY","OTHER","STATUS");
			$link=array(
					      'module'=>'other','controller'=>'branch','action'=>'edit',
			);
			$this->view->list=$list->getCheckList(0, $collumns, $rs,array('branch_namekh'=>$link,'branch_nameen'=>$link));
		}catch (Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$fm = new Application_Form_FrmAdvanceSearch();
 		$frm = $fm->AdvanceSearch();
  		Application_Model_Decorator::removeAllDecorator($frm);
  		$this->view->frm_search = $frm;
  
	}
	
	function addAction()
	{
		if($this->getRequest()->isPost()){//check condition return true click submit button
			$_data = $this->getRequest()->getPost();
			try {
	
				$_dbmodel = new Other_Model_DbTable_DbBranch();
				$_dbmodel->addbranch($_data);
				Application_Form_FrmMessage::Sucessfull("INSERT_SUCCESS","/other/branch/index");
			}catch (Exception $e) {
				Application_Form_FrmMessage::message("INSERT_FAIL");
				$err =$e->getMessage();
				Application_Model_DbTable_DbUserLog::writeMessageError($err);
			}
		}
		$fm=new Other_Form_Frmbranch();
		$frm_branch=$fm->Frmbranch();
		Application_Model_Decorator::removeAllDecorator($frm_branch);
		$this->view->frm_branch = $frm_branch;
	}
	function editAction(){
		$id=$this->getRequest()->getParam("id");
		$db=new Other_Model_DbTable_DbBranch();
		$row=$db->getBranchById($id);
		if($this->getRequest()->isPost())
		{
			$data = $this->getRequest()->getPost();
			$db = new Other_Model_DbTable_DbBranch();
			$db->updateBranch($data,$id);
			Application_Form_FrmMessage::Sucessfull("EDIT_SUCCESS","/other/branch/index");
		}
		$db=new Other_Model_DbTable_DbBranch();
		$row=$db->getBranchById($id);
		//print_r($row);exit();
	
		$frm= new Other_Form_Frmbranch();
		$update=$frm->FrmBranch($row);
		$this->view->frm_branch=$update;
		Application_Model_Decorator::removeAllDecorator($update);
	}
}

