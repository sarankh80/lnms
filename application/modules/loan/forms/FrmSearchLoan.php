<?php 
Class Loan_Form_FrmSearchLoan extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function AdvanceSearch($data=null){
		
		$db = new Application_Model_DbTable_DbGlobal();
		
		$request=Zend_Controller_Front::getInstance()->getRequest();
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect'));
		$_status_opt = array(
				-1=>$this->tr->translate("ALL"),
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		$_status->setValue($request->getParam("status"));
		
		$_title = new Zend_Dojo_Form_Element_TextBox('adv_search');
		$_title->setAttribs(array('dojoType'=>'dijit.form.TextBox',
				'onkeyup'=>'this.submit()',
				'placeholder'=>$this->tr->translate("ADVANCE_SEARCH")
		));
		$_title->setValue($request->getParam("adv_search"));
		
		$_btn_search = new Zend_Dojo_Form_Element_SubmitButton('btn_search');
		$_btn_search->setAttribs(array(
				'dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch',
		
		));
		
		$_group_code = new Zend_Dojo_Form_Element_FilteringSelect('group_code');
		$_group_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
				'onchange'=>'getmemberIdGroup();'
		));
		$group_opt = $db ->getGroupCodeById(1,1,1);
		$_group_code->setMultiOptions($group_opt);
		$_group_code->setValue($request->getParam("group_code"));
		
		$_customer_code = new Zend_Dojo_Form_Element_FilteringSelect('customer_code');
		$_customer_code->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'onchange'=>'getmemberIdGroup();'
		));
		$group_opt = $db ->getGroupCodeById(1,0,1);//code,individual,option
		$_customer_code->setMultiOptions($group_opt);
		$_customer_code->setValue($request->getParam("customer_code"));
		
		$_member = new Zend_Dojo_Form_Element_FilteringSelect('member');
		$_member->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'onchange'=>'checkMember()'
		));
		$options = $db->getGroupCodeById(2,0,1);
		$_member->setMultiOptions($options);
		$_member->setValue($request->getParam("member"));
		
		$_groupid = new Zend_Dojo_Form_Element_FilteringSelect('group_id');
		$_groupid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
 				'onchange'=>'popupCheckClient();'
				));
		$options = $db ->getGroupCodeById(2,1,1);//show name,show group,show option
		$_groupid->setMultiOptions($options);
		$_groupid->setValue($request->getParam("group_id"));
		
		$_coid = new Zend_Dojo_Form_Element_FilteringSelect('co_id');
		$_coid->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'onchange'=>'popupCheckCO();'
		));
		$options = $db ->getAllCOName(1);
		$_coid->setMultiOptions($options);
		$_coid->setValue($request->getParam("co_id"));
		
		$_currency_type = new Zend_Dojo_Form_Element_FilteringSelect('currency_type');
		$_currency_type->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
		));
		$opt = array(-1=>"--Select Currency Type--",2=>"Dollar",1=>'Khmer',3=>"Bath");
		$_currency_type->setMultiOptions($opt);
		$_currency_type->setValue($request->getParam("currency_type"));
		
		$_repayment_method = new Zend_Dojo_Form_Element_FilteringSelect('repayment_method');
		$_repayment_method->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required' =>'true',
				'onchange'=>'chechPaymentMethod()'
		));
		$options = $db->getAllPaymentMethod(null,1);
		$options[-1]="--Select Repayment Method--";
		$_repayment_method->setMultiOptions($options);
		$opt_method = $request->getParam("repayment_method");
		if(empty($opt_method)){
			$opt_method=-1;
		}
		$_repayment_method->setValue($opt_method);
		
		$_zone = new Zend_Dojo_Form_Element_FilteringSelect('zone');
		$_zone->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'onchange'=>'popupCheckZone();'
		));
		$options = $db ->getZoneList(1);
		$_zone->setMultiOptions($options);
		$_zone->setValue($request->getParam("zone"));
		
		$_releasedate = new Zend_Dojo_Form_Element_DateTextBox('start_date');
		$_releasedate->setAttribs(array('dojoType'=>'dijit.form.DateTextBox',
// 				'class'=>'fullside',
				'onchange'=>'CalculateDate();'));
		$_date = $request->getParam("start_date");
		
		if(empty($_date)){
			$_date = date('Y-m-d');
		}
		$_releasedate->setValue($_date);
		
		
		$_dateline = new Zend_Dojo_Form_Element_DateTextBox('end_date');
		$_dateline->setAttribs(array('dojoType'=>'dijit.form.DateTextBox','required'=>'true',
// 				'class'=>'fullside',
		));
		$_date = $request->getParam("end_date");
		
		if(empty($_date)){
			$_date = date("Y-m-d");
		}
		$_dateline->setValue($_date);
		
		
		$_payterm = new Zend_Dojo_Form_Element_FilteringSelect('payment_term');
		$_payterm->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
				'required' =>'true'
		));
		$options= array(1=>"Day",2=>"Week",3=>"Month");
		$_payterm->setMultiOptions($options);
		$_payterm->setValue($request->getParam("payment_term"));
		
		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
		$_branch_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
		));
		
		$rows = $db->getAllBranchName();
		$options=array(-1=>'---Select Branch---');
			if(!empty($rows))foreach($rows AS $row){
				$options[$row['br_id']]=$row['branch_namekh'];
			}
		$_branch_id->setMultiOptions($options);
		$_branch_id->setValue($request->getParam("branch_id"));
		
		$_pay_every = new Zend_Dojo_Form_Element_FilteringSelect('pay_every');
		$_pay_every->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
				'required' =>'true',
				'onchange'=>'changeCollectType();'
		));
		
		$term_opt = $db->getVewOptoinTypeByType(14,1,3);
		unset($term_opt[-1]);
		$_pay_every->setMultiOptions($term_opt);
// 		$_pay_every->setValue(3);
		$_pay_every->setValue($request->getParam('pay_every'));
		
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect("client_name");
		$opt_client = array(''=>'ជ្រើសរើស ឈ្មោះអតិថិជន');
		$rows = $db->getAllClient();
		if(!empty($rows))foreach($rows AS $row){
			$opt_client[$row['id']]=$row['name'];
		}
		$client_name->setMultiOptions($opt_client);
		$client_name->setAttribs(array('class'=>'fullside','dojoType'=>'dijit.form.FilteringSelect',));
		$client_name->setValue($request->getParam("client_name"));
		
		if($data!=null){
			//print_r($data);
			$_branch_id->setValue($data['member_id']);
			$_member->setValue($data['client_id']);
			$_coid->setValue($data['co_id']);
			$_zone->setValue($data['zone_id']);
			$_releasedate->setValue($data['date_release']);
			$_currency_type->setValue($data['payment_method']);
			$client_name->setValue($data['client_name']);
		}
		$this->addElements(array($client_name,$_pay_every,$_groupid,$_title,$_branch_id,$_member,$_coid,$_currency_type,$_zone,$_releasedate
				,$_payterm,$_dateline,$_group_code,$_customer_code,$_status,$_btn_search,$_repayment_method));
		return $this;
		
	}	
}