<?php 
Class Loan_Form_FrmIlPayment extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmAddIlPayment($data=null){
		
		$db = new Application_Model_DbTable_DbGlobal();
		$_groupid = new Zend_Dojo_Form_Element_FilteringSelect('client_id');
		$_groupid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
 				'onchange'=>'popupCheckClient();'
				));
		$rows = $db ->getClientByType();
		$options="";
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['client_id']]=$row['name_en'].','.$row['province_en_name'].','.$row['district_name'].','.$row['commune_name'].','.$row['village_name'];
		}
		$_groupid->setMultiOptions($options);
		
		$_loan_number = new Zend_Dojo_Form_Element_TextBox('loan_number');
		$_loan_number->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$_client_code = new Zend_Dojo_Form_Element_TextBox('client_code');
		$_client_code->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$_amount_receive = new Zend_Dojo_Form_Element_NumberTextBox('amount_receive');
		$_amount_receive->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'totalReturn();'
		));
		
		$_amount_return = new Zend_Dojo_Form_Element_NumberTextBox('amount_return');
		$_amount_return->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$_service_charge = new Zend_Dojo_Form_Element_NumberTextBox('service_charge');
		$_service_charge->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'onkeyup'=>'addMoreService();'
		));
		$_service_charge->setValue(0);
		
		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
		$_branch_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		$rows = $db->getAllBranchName();
		$options='';
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['br_id']]=$row['branch_namekh'];
		}
		$_branch_id->setMultiOptions($options);
		
		
		$_coid = new Zend_Dojo_Form_Element_FilteringSelect('co_id');
		$_coid = new Zend_Dojo_Form_Element_FilteringSelect('co_id');
		$rows = $db ->getAllCOName();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
		$_coid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
								'class'=>'fullside',
		 						'onchange'=>'popupCheckCO();'
		));
		$_coid->setMultiOptions($options);
		
		$_priciple_amount = new Zend_Dojo_Form_Element_NumberTextBox('priciple_amount');
		$_priciple_amount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$_loan_fee = new Zend_Dojo_Form_Element_NumberTextBox('loan_fee');
		$_loan_fee->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$_os_amount = new Zend_Dojo_Form_Element_NumberTextBox('os_amount');
		$_os_amount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		
		$_rate = new Zend_Dojo_Form_Element_NumberTextBox('total_interest');
		$_rate->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
// 		$value_interest = 2.5;
// 		$_rate->setValue($value_interest);
		
		$_penalize_amount = new Zend_Dojo_Form_Element_NumberTextBox('penalize_amount');
		$_penalize_amount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$_penalize_amount->setValue(0);
		
		$_total_payment = new Zend_Dojo_Form_Element_NumberTextBox('total_payment');
		$_total_payment->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true',
				'style'=>'color:red;'
		));
		
		$_hide_total_payment = new Zend_Form_Element_Hidden('hide_total_payment');
		$_hide_total_payment->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
		));
		
		
		
		$_note = new Zend_Dojo_Form_Element_TextBox('note');
		$_note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		$_collect_date = new Zend_Dojo_Form_Element_DateTextBox('collect_date');
		$_collect_date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		$c_date = date('Y-m-d');
		$_collect_date->setValue($c_date);
	
		$this->addElements(array($_groupid,$_coid,$_priciple_amount,$_loan_fee,$_os_amount,$_rate,
				$_penalize_amount,$_collect_date,$_total_payment,$_note,$_service_charge,$_amount_return,
				$_amount_receive,$_client_code,$_loan_number,$_branch_id,$_hide_total_payment));
		return $this;
		
	}	
}