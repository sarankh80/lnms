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
		$borrower = new Zend_Dojo_Form_Element_TextBox('borrower');
		$borrower->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
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
		$_personal=new Zend_Dojo_Form_Element_RadioButton('personal');
		$_personal->setAttribs(array(
				'dojoType'=>'dijit.form.RadioButton',
				'class'=>'fullside'
				));
		$opt=array(1=>'ផ្ទាល់ខ្លួន',2=>'អ្នកធានាជំនួស');
		$_personal->setMultiOptions($opt);
		$_personal->setValue(1);
// 		print_r($_personal);exit();
// 		$_bollow=new Zend_Dojo_Form_Element_CheckBox('bollow');
// 		$_bollow->setAttribs(array(
// 				'dojoType'=>'dijit.form.CheckBok',
// 				'class'=>'fullside'
// 				));
        $db = new Application_Model_DbTable_DbGlobal();
		$represent_property=new Zend_Dojo_Form_Element_FilteringSelect('represent_property');
		$represent_property->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
				));
		$opt= $db->getVewOptoinTypeByType(6,1);
		$represent_property->setMultiOptions($opt);
		$represent_property->setValue(1);
		$estate_code=new Zend_Dojo_Form_Element_NumberTextBox('estate_code');
		$estate_code->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$Date_estate=new Zend_Dojo_Form_Element_DateTextBox('date_estate');
		$Date_estate->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside'
		));
		$stutas = new Zend_Dojo_Form_Element_FilteringSelect('Stutas');
		$stutas ->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				));
		$options= array(1=>"ប្រើប្រាស់",2=>"មិនប្រើប្រាស់");
		$stutas->setMultiOptions($options);
		
		$cod_cal = new Zend_Dojo_Form_Element_NumberTextBox('cod_cal');
		$cod_cal ->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$id = new Zend_Form_Element_Hidden("id");
		
		if($data!=null){
		
			$_branch_id->setValue($data['branch_id']);
			$cod_cal->setValue($data['code_call']);
			$co_name->setValue($data['co_id']);
			$getter_name->setValue($data['getter_name']);
			$giver_name->setValue($data['giver_name']);
			$Date->setValue($data['date_delivery']);
			$customer_code->setValue($data['client_code']);
			$contract_code->setValue($data['contracts_borrow']);
			$_code->setValue($data['mortgage_Contract']);
			$borrower->setValue($data['name_borrower']);
			$_name->setValue($data['with']);
			$_name_->setValue($data['relativewith']);
			$owner->setValue($data['owner']);
			$_And_name->setValue($data['withs']);
			$_And_name_->setValue($data['relativewiths']);
			$represent_property->setValue($data['callate_type']);
			$estate_code->setValue($data['note']);
			$Date_estate->setValue($data['date_registration']);
			$stutas->setValue($data['status']);
		
			$id->setValue($data['id']);
		
		
		
		}
		
		$this->addElements(array($co_name,$getter_name,$giver_name,$Date,$customer_code,$contract_code,$_code,$belong_borrower,
				$borrower,$_name,$_name_,$owner,$_And_name,$_And_name_,$_personal,$represent_property,$estate_code,
				$Date_estate,$_branch_id,$id,$stutas,$cod_cal));
		return $this;
		
	}	
}