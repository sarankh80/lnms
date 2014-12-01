<?php 
Class Loan_Form_FrmLoan extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmAddLoan($data=null){
		
		$_isgroup = new Zend_Dojo_Form_Element_CheckBox('is_group');
		$_isgroup->setAttribs(array(
				'dojoType'=>'dijit.form.CheckBox',
				'class'=>'fullside',
				// 				'onkeyup'=>'Calcuhundred()'
		));
		
		$db = new Application_Model_DbTable_DbGlobal();
		$_groupid = new Zend_Dojo_Form_Element_FilteringSelect('group_id');
		$_groupid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
 				'onchange'=>'popupCheckClient();'
				));
		$rows = $db ->getClientByType(1);
		$options=array(''=>"------Select------",-1=>"Add New new group");
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['client_id']]=$row['name_en'].','.$row['province_en_name'].','.$row['district_name'].','.$row['commune_name'].','.$row['village_name'];
		}
		$_groupid->setMultiOptions($options);
		
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
		
		$_member = new Zend_Dojo_Form_Element_FilteringSelect('member');
		$_member->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$rows = $db->getClientByType();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['client_id']]=$row['name_en'];
		$_member->setMultiOptions($options);
		
		$_devise = new Zend_Dojo_Form_Element_FilteringSelect('currency_type');
		$_devise->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
		));
		$opt = array(1=>'Khmer',2=>"Dollar");
		$_devise->setMultiOptions($opt);
		
		$_zone = new Zend_Dojo_Form_Element_FilteringSelect('zone');
		$_zone->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'onchange'=>'popupCheckZone();'
		));
		$rows = $db ->getZoneList();
		
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options[$row['zone_id']]=$row['zone_name'];
		$_zone->setMultiOptions($options);
		
		$_loan_fee = new Zend_Dojo_Form_Element_NumberTextBox('loan_fee');
		$_loan_fee->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
		$_loan_fee->setValue(0);
		
		$_time_collect = new Zend_Dojo_Form_Element_NumberTextBox('amount_collect');
		$_time_collect->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
		));
 		$_time_collect->setValue(1);
 		
 		$_time_collect_pri = new Zend_Dojo_Form_Element_NumberTextBox('amount_collect_pricipal');
 		$_time_collect_pri->setAttribs(array(
 				'dojoType'=>'dijit.form.NumberTextBox',
 				'class'=>'fullside',
 				'readonly'=>true,
 		));
 		$_time_collect_pri->setValue(2);
		
		$_amount = new Zend_Dojo_Form_Element_NumberTextBox('total_amount');
		$_amount->setAttribs(array(
						'dojoType'=>'dijit.form.NumberTextBox',
						'class'=>'fullside',
						'required' =>'true'
		));
		
		$_level = new Zend_Dojo_Form_Element_NumberTextBox('level');
		$_level->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		$_level->setValue(1);
		
		$_rate = new Zend_Dojo_Form_Element_NumberTextBox('interest_rate');
		$_rate->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		$value_interest = 2.5;
		$_rate->setValue($value_interest);
		
		$_period = new Zend_Dojo_Form_Element_NumberTextBox('period');
		$_period->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		$_releasedate = new Zend_Dojo_Form_Element_DateTextBox('release_date');
		$_releasedate->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		$s_date = date('Y-m-d');
		$_releasedate->setValue($s_date);
		
		$_first_payment = new Zend_Dojo_Form_Element_DateTextBox('first_payment');
		$_first_payment->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		$_graice_pariod = new Zend_Dojo_Form_Element_TextBox('graice_pariod');
		$_graice_pariod->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		$_graice_pariod->setValue(0);
	
		$_payterm = new Zend_Dojo_Form_Element_FilteringSelect('payment_term');
		$_payterm->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Day",2=>"Week",3=>"Month");
		$_payterm->setMultiOptions($options);
		
		$_pay_every = new Zend_Dojo_Form_Element_FilteringSelect('pay_every');
		$_pay_every->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Day",2=>"Week",3=>"Month");
		$_pay_every->setMultiOptions($options);
		
		$_every_payamount = new Zend_Dojo_Form_Element_FilteringSelect('every_payamount');
		$_every_payamount->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(2=>"After",1=>"Before",3=>"Normal");
		$_every_payamount->setMultiOptions($options);
		
		$_time= new Zend_Dojo_Form_Element_TextBox('time');
		$_time->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		$set_time='10:00-11:00 AM';
		$_time->setValue($set_time);
		
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
		
		$_repayment_method = new Zend_Dojo_Form_Element_FilteringSelect('repayment_method');
		$_repayment_method->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true',
				'onchange'=>'chechPaymentMethod()'
		));
		$options= array(1=>"Decline",2=>"Baloon",3=>"Fixed Rate",4=>"Fixed Payment",5=>"Semi Baloon");
		$_repayment_method->setMultiOptions($options);
		
		$_holiday = new Zend_Dojo_Form_Element_FilteringSelect('holiday');
		$_holiday->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Befor",2=>"After",3=>"Cancel");
		$_holiday->setMultiOptions($options);
		
		
		$this->addElements(array($_isgroup,$_groupid,$_time_collect,$_loan_fee,$_level,$_branch_id,$_member,$_coid,$_devise,$_devise,$_zone,$_amount,$_rate,$_releasedate
				,$_payterm,$_every_payamount,$_time,$_time_collect_pri,$_holiday,$_graice_pariod,$_period,$_first_payment,$_repayment_method,$_pay_every));
		return $this;
		
	}	
}