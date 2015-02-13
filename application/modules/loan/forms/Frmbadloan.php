<?php 
Class Loan_Form_Frmbadloan extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmBadLoan($data=null){
		
		$branch = new Zend_Dojo_Form_Element_FilteringSelect('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$options= array(1=>"សាខា កណ្តាល",2=>"សាខា ទី១");
		$branch->setMultiOptions($options);
		
		$db = new Loan_Model_DbTable_DbBadloan();
		$client_code = new Zend_Dojo_Form_Element_FilteringSelect('client_code');
		$client_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(3);"
		));

		$opt= $db->getClientByTypes(1);
		$client_code->setMultiOptions($opt);
		
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect('client_name');
		$client_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
			    'onchange'=>"getClientInfo(1);"
				));
		$options = $db->getClientByTypes(2);
		$client_name->setMultiOptions($options);
		
		$number_code = new Zend_Dojo_Form_Element_FilteringSelect('number_code');
		$number_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(2);"
		));
		
		$options = $db->getClientByTypes(3);
		$number_code->setMultiOptions($options);
		
		$_date= new Zend_Dojo_Form_Element_DateTextBox('Date');
		$_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
		));
		
		
		$date_loss= new Zend_Dojo_Form_Element_DateTextBox('date_loss');
		$date_loss->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
		));
		
		$total_amount = new Zend_Dojo_Form_Element_NumberTextBox('Total_amount');
		$total_amount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		
		

		
		$interest_amount = new Zend_Dojo_Form_Element_NumberTextBox('Interest_amount');
		$interest_amount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		
		
		$_term = new Zend_Dojo_Form_Element_ValidationTextBox('Term');
		$_term->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
		));
		
		$_note = new Zend_Dojo_Form_Element_Textarea('Note');
		$_note ->setAttribs(array(
				'dojoType'=>'dijit.form.SimpleTextarea',
				'class'=>'fullside',
				'style'=>'width:98%'
		));
		
		$_id = new Zend_Form_Element_Hidden('id');
		
		$this->addElements(array($branch,$client_code,$client_name,$number_code,$date_loss,$total_amount,$interest_amount,$_date,$_term,$_note));
		return $this;
		
	}	
}