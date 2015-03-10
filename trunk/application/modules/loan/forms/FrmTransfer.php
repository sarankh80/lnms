<?php 
Class Loan_Form_FrmTransfer extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmTransfer($data=null){
		
		$db = new Application_Model_DbTable_DbGlobal();
		$request=Zend_Controller_Front::getInstance()->getRequest();
		$branch_name = new Zend_Dojo_Form_Element_FilteringSelect('branch_name');
    	$branch_name->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'required' =>'true'
    	));
    	$rows = $db->getAllBranchName();
    	$options=array(''=>"------Select------");
    	if(!empty($rows))
    		foreach($rows AS $row){
    		$options[$row['br_id']]=$row['branch_namekh'];
    	}
    	$branch_name->setMultiOptions($options);
    	$branch_name->setValue($request->getParam('branch_id'));    	
    	
    	$co_name = new Zend_Dojo_Form_Element_FilteringSelect('co_code');
    	$co_name->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'required' =>'true',
    			'onchange'=>'getClientInfo(1);'
    	));
    	$db_co = new Loan_Model_DbTable_DbTransferCo();
    	$row_co = $db_co->getcoinfo();
    	$options_co =array(''=>"------Select------");
    	if (!empty($row_co))
    		foreach ($row_co AS $row_cos){
    		$options_co[$row_cos['co_id']] = $row_cos['co_code'];
    		}
    	$co_name->setMultiOptions($options_co);
		
		$_date= new Zend_Dojo_Form_Element_DateTextBox('Date');
		$_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				
		));
		$_date->setValue(date('Y-m-d'));
		
		$db = new Loan_Model_DbTable_DbBadloan();
		$co_code = new Zend_Dojo_Form_Element_FilteringSelect('co_codes');
		$co_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
// 				'onchange'=>'getClientInfo();'
		));

// 		$opt= $db->getClientByTypes(1);
// 		$co_code->setMultiOptions($opt);
		
		$formc_co = new Zend_Dojo_Form_Element_FilteringSelect('formc_co');
		$formc_co->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
			    'onchange'=>"getClientInfo(2);"
				));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_khname'];
		}
		$formc_co->setMultiOptions($options_from);
		
// 		$options = $db->getClientByTypes(2);
// 		$formc_co->setMultiOptions($options);
		
		$to_co = new Zend_Dojo_Form_Element_FilteringSelect('to_co');
		$to_co->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(3);"
		));
		$row_co = $db_co->getcoinfo();
		$options_co =array(''=>"------Select------");
		if (!empty($row_co))
			foreach ($row_co AS $row_cos){
			$options_co[$row_cos['co_id']] = $row_cos['co_khname'];
		}
		$to_co->setMultiOptions($options_co);
		// 		$options = $db->getClientByTypes(2);
		// 		$formc_co->setMultiOptions($options);
		
		$to_co_code = new Zend_Dojo_Form_Element_FilteringSelect('to_co_code');
		$to_co_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(4);"
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_code'];
		}
		$to_co_code->setMultiOptions($options_from);
		
		$note = new Zend_Dojo_Form_Element_Textarea('Note');
		$note ->setAttribs(array(
				'dojoType'=>'dijit.form.SimpleTextarea',
				'class'=>'fullside',
				'style'=>'width:98%'
		));
		$user_id = new Zend_Dojo_Form_Element_FilteringSelect('user_id');
		$user_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				//'onchange'=>"getClientInfo(1);"
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			//$options_from[$row_from['co_id']] = $row_from['user_id'];
		}
		$user_id->setMultiOptions($options_from);
		
	

		$_arr = array(1=>$this->tr->translate("ACTIVE"),0=>$this->tr->translate("DACTIVE"));
		$_status = new Zend_Dojo_Form_Element_FilteringSelect("status");
		$_status->setMultiOptions($_arr);
		$_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'missingMessage'=>'Invalid Module!',
				'class'=>'fullside'));
		
		//$id = new Zend_Form_Element_Hidden("id");
		if($data!=null){
				
// 			$branch->setValue($data['branch']);
// 			$client_code->setValue($data['client_code']);
// 			$client_name->setValue($data['client_name']);
// 			$number_code->setValue($data['number_code']);
// 			$_date->setValue($data['date']);
// 			$date_loss->setValue($data['loss_date']);
// 			$total_amount->setValue($data['total_amount']);
// 			$interest_amount->setValue($data['intrest_amount']);
// 			$_term->setValue($data['tem']);
// 			$_note->setValue($data['note']);
// 			$id->setValue($data['id']);
		}		
		
		$this->addElements(array($co_name,$_status,$branch_name,$_date,$co_code,$formc_co,$to_co,$to_co_code,$note,$user_id));
		return $this;
		
	}	
}