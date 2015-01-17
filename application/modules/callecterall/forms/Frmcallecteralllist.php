<?php 
Class Callecterall_Form_Frmcallecteralllist extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		
	}
	public function callecteralllist($data=null){
		
		$branch = new Zend_Dojo_Form_Element_FilteringSelect('branch');
		$branch->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"សាខា កណ្តាល",2=>"សាខា ទី១");
		$branch->setMultiOptions($options);
	
		

		$db = new Application_Model_DbTable_DbGlobal();
		$customer_name = new Zend_Dojo_Form_Element_FilteringSelect('customer_name');
		$customer_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>"getClientInfo(1);"
		));
		$rows = $db->getClientByType();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['client_id']]=$row['name_en'];
		$customer_name->setMultiOptions($options);
		
		$db = new Application_Model_DbTable_DbGlobal();
		$cus_code = new Zend_Dojo_Form_Element_FilteringSelect('cus_code');
		$cus_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true,
				'onchange'=>"getClientInfo(2);"
				));
		$rows = $db->getClientByType();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['client_id']]=$row['client_number'];
		$cus_code->setMultiOptions($options);
		
		$num_vi = new Zend_Dojo_Form_Element_TextBox('num_vi');
		$num_vi->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$date = new Zend_Dojo_Form_Element_DateTextBox('$date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$date->setValue(date('Y-m-d'));
		
		$db = new Application_Model_DbTable_DbGlobal();
		$time_think = new Zend_Dojo_Form_Element_FilteringSelect('time_think');
		$time_think->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>true
		));
		$opt= $db->getVewOptoinTypeByType(14,1);
		$time_think->setMultiOptions($opt);
		$time_think->setValue(1);
	
		
		$time_short = new Zend_Dojo_Form_Element_NumberTextBox('time_short');
		$time_short->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$date_call = new Zend_Dojo_Form_Element_DateTextBox('date_call');
		$date_call->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$callecterall_type = new Zend_Dojo_Form_Element_FilteringSelect('callecterall_type');
		$callecterall_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt= $db->getVewOptoinTypeByType(13,1);
		$callecterall_type->setMultiOptions($opt);
		$callecterall_type->setValue(1);
		
// 		$callecterall_code = new Zend_Dojo_Form_Element_NumberTextBox('callecterall_code');
// 		$callecterall_code->setAttribs(array(
// 				'dojoType'=>'dijit.form.NumberTextBox',
// 				'class'=>'fullside',
// 		));
		$callecterall_code = new Zend_Dojo_Form_Element_TextBox('callecterall_code');
		$callecterall_code->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'readonly'=>true,
				'style'=>'color:red; font-weight: bold;'
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$loan_number = $db->getLoanNumber();
		$callecterall_code->setValue($loan_number);
		
		$note = new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$cash_type = new Zend_Dojo_Form_Element_FilteringSelect('cash_type');
		$cash_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt= $db->getVewOptoinTypeByType(15,1);
		$cash_type->setMultiOptions($opt);
		$cash_type->setValue(1);
		
		$much_boro = new Zend_Dojo_Form_Element_NumberTextBox('much_boro');
		$much_boro->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$_id = new Zend_Form_Element_Hidden('id');
		
		if($data!=null){
			$branch->setValue($data['branch']);
			$customer_name->setValue($data['name_customer']);
			$cus_code->setValue($data['code']);
			$num_vi->setValue($data['number_invo']);
			$date->setValue($data['date']);
			$time_think->setValue($data['time_boro']);
			$time_short->setValue($data['huch_bro']);
			$date_call->setValue($data['date_call']);
			$callecterall_type->setValue($data['type_call']);
			$callecterall_code->setValue($data['code_call']);
			$note->setValue($data['note']);
			$cash_type->setValue($data['cash_type']);
			$much_boro->setValue($data['cash_type']);
			$_id->setValue($data['id']);
		}
		$this->addElements(array($branch,$customer_name,$cus_code,$num_vi,$date,$time_think,$time_short,
				$date_call,$callecterall_type,$callecterall_code,$note,$cash_type,$much_boro,$_id,));
		return $this;
		
	}	
}