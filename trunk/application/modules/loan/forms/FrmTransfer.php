<?php 
Class Loan_Form_FrmTransfer extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmTransfer($data=null){
		
		$branch_name = new Zend_Dojo_Form_Element_FilteringSelect('branch_name');
		$branch_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$options= array(1=>"សាខា កណ្តាល",2=>"សាខា ទី១");
		$branch_name->setMultiOptions($options);
		
		$_date= new Zend_Dojo_Form_Element_DateTextBox('Date');
		$_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
		));
		$_date->setValue(date('Y-m-d'));
		
		$db = new Loan_Model_DbTable_DbBadloan();
		$co_code = new Zend_Dojo_Form_Element_FilteringSelect('co_code');
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
			    //'onchange'=>"getClientInfo(1);"
				));
// 		$options = $db->getClientByTypes(2);
// 		$formc_co->setMultiOptions($options);
		
		$to_co = new Zend_Dojo_Form_Element_FilteringSelect('to_co');
		$to_co->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				//'onchange'=>"getClientInfo(1);"
		));
		// 		$options = $db->getClientByTypes(2);
		// 		$formc_co->setMultiOptions($options);
		
		$to_co_code = new Zend_Dojo_Form_Element_FilteringSelect('to_co_code');
		$to_co_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				//'onchange'=>"getClientInfo(1);"
		));
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
		
		
		$this->addElements(array($branch_name,$_date,$co_code,$formc_co,$to_co,$to_co_code,$note,$user_id));
		return $this;
		
	}	
}