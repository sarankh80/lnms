<?php 
Class Group_Form_Frmcallterals extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmCallTeral($data=null){
		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
		$_branch_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"សាខា កណ្តាល",2=>"សាខា ទី១");
		$_branch_id->setMultiOptions($options);
		
// 		$co_name = new Zend_Dojo_Form_Element_ValidationTextBox('co_name');
// 		$co_name->setAttribs(array(
// 				'dojoType'=>'dijit.form.ValidationTextBox',
// 				'class'=>'fullside',
// 				'required'=>true
// 				));
		$db = new Application_Model_DbTable_DbGlobal();
		$co_name = new Zend_Dojo_Form_Element_FilteringSelect('co_name');
		$rows = $db ->getAllCOName();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
		$co_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckCO();'
		));
		$co_name->setMultiOptions($options);
		
		
		
		$getter_name = new Zend_Dojo_Form_Element_ValidationTextBox('getter_name');
		$getter_name->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
// 		$getter_name=new Zend_Dojo_Form_Element_ValidationTextBox('getter_name');
// 		$getter_name->setAttribs(array(
// 				'dotoType'=>'dijit.form.ValidationTextBox',
// 				'class'=>'fullside',
// 				'required'=>true,
// 				));
		
		$giver_name = new Zend_Dojo_Form_Element_TextBox('giver_name');
		$giver_name->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$Date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
				));
		
		$customer_code = new Zend_Dojo_Form_Element_NumberTextBox('customer_code');
		$customer_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$contract_code = new Zend_Dojo_Form_Element_NumberTextBox('contract_code');
		$contract_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		
		$_code = new Zend_Dojo_Form_Element_NumberTextBox('code');
		$_code ->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$belong_borrower=new Zend_Dojo_Form_Element_RadioButton('belong_borrower');
		$belong_borrower->setAttribs(array(
				'dojoType'=>'dijit.form.RadioButton',
				'class'=>'fullside'
				));
		$option=array(1=>'កម្មសិទ្ធិរបស់អ្នកខ្ចីប្រាក់',2=>'កម្មសិទិ្ធរបស់អ្នកធានា');
		$belong_borrower->setMultiOptions($option);
		$belong_borrower->setValue(1);
// 		$_representer=new Zend_Dojo_Form_Element_CheckBox('representer');
// 		$_representer->setAttribs(array(
// 				'dojoType'=>'dijit.form.CheckBox',
// 				'class'=>'fullside'
// 		));
		$borrower = new Zend_Dojo_Form_Element_FilteringSelect('borrower');
		$borrower->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$rows = $db->getClientByType();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['client_id']]=$row['name_en'];
		$borrower->setMultiOptions($options);
		
		$_name=new Zend_Dojo_Form_Element_ValidationTextBox('name');
		$_name->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
				));
		$_name_=new Zend_Dojo_Form_Element_ValidationTextBox('names');
		$_name_->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
		));
		$owner=new Zend_Dojo_Form_Element_ValidationTextBox('owner');
		$owner->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
		));
		$_And_name=new Zend_Dojo_Form_Element_ValidationTextBox('and_name');
		$_And_name->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
		));
		$_And_name_=new Zend_Dojo_Form_Element_ValidationTextBox('and_names');
		$_And_name_->setAttribs(array(
				'dojoType'=>'dijit.form.ValidationTextBox',
				'class'=>'fullside'
		));
		$_personal=new Zend_Dojo_Form_Element_FilteringSelect('personal');
		$_personal->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
				));
		$opt=array(1=>'ផ្ទាល់ខ្លួន',2=>'អ្នកធានាជំនួស');
		$_personal->setMultiOptions($opt);
		$_personal->setValue(1);
		
        $db = new Application_Model_DbTable_DbGlobal();
		$represent_property=new Zend_Dojo_Form_Element_FilteringSelect('represent_property');
		$represent_property->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
				));
		$opt= $db->getCollteralType(1);
		$represent_property->setMultiOptions($opt);
		$note=new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$Date_estate=new Zend_Dojo_Form_Element_DateTextBox('date_estate');
		$Date_estate->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
		));
		$Date_estate->setValue(date('Y-m-d'));
		$stutas = new Zend_Dojo_Form_Element_FilteringSelect('Stutas');
		$stutas ->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"ប្រើប្រាស់",2=>"មិនប្រើប្រាស់");
		$stutas->setMultiOptions($options);
		
		$cod_cal = new Zend_Dojo_Form_Element_TextBox('cod_cal');
		$cod_cal ->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'readOnly'=>'readOnly',
				'class'=>'fullside',
				'style'=>'color:red'
		));
		$code = Group_Model_DbTable_DbCallteral::getCallteralCode();
// 		echo$code;exit();
		$cod_cal->setValue($code);
		
		$id = new Zend_Form_Element_Hidden("id");
// 		print_r($data);exit();
		if($data!=null){
		
			$_branch_id->setValue($data['branch_id']);
			$cod_cal->setValue($data['code_call']);
			$co_name->setValue($data['co_id']);
			$contract_code->setValue($data['contract_code']);
// 			$_code->setValue($data['mortgage_Contract']);
			$borrower->setValue($data['client_name']);
			$_name->setValue($data['with']);
			$_name_->setValue($data['relativewith']);
			$owner->setValue($data['owner']);
			$_And_name->setValue($data['withs']);
			$_And_name_->setValue($data['relativewiths']);
			$represent_property->setValue($data['callate_type']);
			$note->setValue($data['note']);
			$Date_estate->setValue($data['date_registration']);
			$stutas->setValue($data['status']);
			$id->setValue($data['id']);
			
		}
		
		$this->addElements(array($co_name,$getter_name,$giver_name,$Date,$customer_code,$contract_code,$_code,$belong_borrower,
				$borrower,$_name,$_name_,$owner,$_And_name,$_And_name_,$_personal,$represent_property,$note,
				$Date_estate,$_branch_id,$id,$stutas,$cod_cal));
		return $this;
		
	}	
}