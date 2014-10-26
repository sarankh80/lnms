<?php 
Class Loan_Form_FrmLoan extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmAddLoan($data=null){
		
		$_groupid = new Zend_Dojo_Form_Element_FilteringSelect('group_id');
		$_groupid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
// 				'onkeyup'=>'Calcuhundred()'
				));
		$db = new Application_Model_DbTable_DbGlobal();
		$rows = $db ->getAllCOName();
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options['co_id']=$row['co_khname'];
		$_coid = new Zend_Dojo_Form_Element_FilteringSelect('co_id');
		$_coid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
								'class'=>'fullside',
		// 				'onkeyup'=>'Calcuhundred()'
		));
		$_coid->setMultiOptions($options);
		
		
		
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
		));
		$rows = $db ->getZoneList();
		
		$options=array(''=>"------Select------",-1=>"Add New");
		if(!empty($rows))foreach($rows AS $row) $options['zone_id']=$row['zone_name'];
		$_zone->setMultiOptions($options);
		
		$_amount = new Zend_Dojo_Form_Element_NumberTextBox('total_amount');
		$_amount->setAttribs(array(
						'dojoType'=>'dijit.form.NumberTextBox',
						'class'=>'fullside',
						'required' =>'true'
		));
		
		$_rate = new Zend_Dojo_Form_Element_NumberTextBox('interest_rate');
		$_rate->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
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
		
		$_first_payment = new Zend_Dojo_Form_Element_DateTextBox('first_payment');
		$_first_payment->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
	
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
		$_payterm->setMultiOptions($options);
		
		$_every_payamount = new Zend_Dojo_Form_Element_NumberTextBox('every_payamount');
		$_every_payamount->setAttribs(array(
				'dojoType'=>'dijit.form.NumberTextBox',
				'class'=>'fullside',
				'required' =>'true'
		));
		
		$_time= new Zend_Dojo_Form_Element_TextBox('time');
		$_time->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
		));
		
		$_repayment_method = new Zend_Dojo_Form_Element_FilteringSelect('repayment_method');
		$_repayment_method->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Decline",2=>"Baloon",3=>"Other");
		$_repayment_method->setMultiOptions($options);
		
		$_holiday = new Zend_Dojo_Form_Element_FilteringSelect('holiday');
		$_holiday->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Befor",2=>"After",3=>"Cancel");
		$_holiday->setMultiOptions($options);
		
		
		$this->addElements(array($_groupid,$_coid,$_devise,$_devise,$_zone,$_amount,$_rate,$_releasedate
				,$_payterm,$_every_payamount,$_time,$_holiday,$_period,$_first_payment,$_repayment_method));
		return $this;
		
	}	
}