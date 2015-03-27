<?php 
Class Loan_Form_FrmTransferCoClient extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmTransfer($data=null){
		
		$db = new Application_Model_DbTable_DbGlobal();
		$db_co = new Loan_Model_DbTable_DbTransferCoClient();
    	$row_co = $db_co->getcoinfo();
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
		
		$_date= new Zend_Dojo_Form_Element_DateTextBox('Date');
		$_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				
		));
		$_date->setValue(date('Y-m-d'));
		$co_code = new Zend_Dojo_Form_Element_FilteringSelect('co_code');
		$co_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(1);"
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_code'];
		}
		$co_code->setMultiOptions($options_from);
		
		$formc_co = new Zend_Dojo_Form_Element_FilteringSelect('name_co');
		$formc_co->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
			    'onchange'=>"getClientInfo(2);"
				));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
			$options_from[$row_from['co_id']] = $row_from['co_name'];
		}
		$formc_co->setMultiOptions($options_from);
		
		$name_client = new Zend_Dojo_Form_Element_FilteringSelect('name_client');
		$name_client->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(3);"
		));
		$row_co = $db_co->getcoinfo();
		$options_co =array(''=>"------Select------");
		if (!empty($row_co))
			foreach ($row_co AS $row_cos){
			$options_co[$row_cos['member_id']] = $row_cos['client_name'];
		}
		$name_client->setMultiOptions($options_co);
		
		$code_client = new Zend_Dojo_Form_Element_FilteringSelect('code_client');
		$code_client->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(4);"
		));
		$row_number = $db_co->getcoinfo();
		$options_numbers=array(''=>"------Select------");
		if (!empty($row_number))
			foreach ($row_number AS $row_client){
			$options_numbers[$row_client['member_id']] = $row_client['client_code'];
		}
		$code_client->setMultiOptions($options_numbers);
		
		$loan_number= new Zend_Dojo_Form_Element_FilteringSelect('loan_number');
		$loan_number->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(5);"
		));
		$row_number = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_number))
			foreach ($row_number AS $row_numbers){
			$options_from[$row_numbers['member_id']] = $row_numbers['loan_number'];
		}		
		$loan_number->setMultiOptions($options_from);
		
		$loan_client = new Zend_Dojo_Form_Element_FilteringSelect('loan_client');
		$loan_client->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(3);"
		));
		$loan_clientgroup = $db_co->getcoinfo();
		$options_loan_client =array(''=>"------Select------");
		if (!empty($loan_clientgroup))
			foreach ($loan_clientgroup AS $loan_clientgroups){
			$options_loan_client[$loan_clientgroups['member_id']] = $loan_clientgroups['client_name'];
		}
		$loan_client->setMultiOptions($options_loan_client);
		
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
		));
		$row_froms = $db_co->getcoinfo();
		$options_from =array(''=>"------Select------");
		if (!empty($row_froms))
			foreach ($row_froms AS $row_from){
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
		
		if($data!=null){				
			$branch_name->setValue($data['branch_id']);
			$co_code->setValue($data['code_to']);
			$formc_co->setValue($data['to']);
			$name_client->setValue($data['client_id']);
			$code_client->setValue($data['client_id']);			
			$_status->setValue($data['status']);
			$_date->setValue($data['date']);
			$note->setValue($data['note']);
			$loan_number->setValue($data['loan_id']);
			$loan_client->setValue($data['loan_id']);
		}		
		
		$this->addElements(array($loan_client,$loan_number,$_status,$branch_name,$_date,$formc_co,$name_client,$co_code,$code_client,$note,$user_id));
		return $this;
		
	}	
}