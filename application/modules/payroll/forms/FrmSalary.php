<?php

class Payroll_Form_FrmSalary extends Zend_Dojo_Form
{
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
    public function frmaddSalary($data=null)
    {

    	$db = new Application_Model_DbTable_DbGlobal();
    	$staff_name = new Zend_Dojo_Form_Element_FilteringSelect('staff_name');
    	$rows = $db ->getAllCOName();
    	$options=array(''=>"------Select------",-1=>"Add New");
    	if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
    	$staff_name->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'onchange'=>'popupCheckStaff(1);'
    	));
    	$staff_name->setMultiOptions($options);
    	
    	$db_Sex=new Application_Model_DbTable_DbGlobal();
    	$opt_Sex=$db_Sex->getVewOptoinTypeByType(8,1);
    	$Sex=new Zend_Dojo_Form_Element_FilteringSelect('sex');
    	$Sex->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'required'=>true,
    			'class'=>'fullside'
    	));
    	$Sex->setMultiOptions($opt_Sex);
    	
    	$position_=new Zend_Dojo_Form_Element_FilteringSelect('position');
    	$position_->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
//     			'dojoType'=>$this->filter,
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	
    	$db_position=new Application_Model_DbTable_DbGlobal();
    	$opt_position=$db_position->getAllStaffPosition(null,1);
    	$position_->setMultiOptions($opt_position);
    	
    	$Basic_salary=new Zend_Dojo_Form_Element_NumberTextBox('basic_salary');
    	$Basic_salary->setAttribs(array(
    			'dojoType'=>'dijit.form.NumberTextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$Basic_salary->setValue(0);
    	
    	
    	$date_start=new Zend_Dojo_Form_Element_DateTextBox('date_start');
    	$date_start->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'class'=>'fullside',
    			));
    	$date_start->setValue(date('Y-m-d'));
    	
    	$date_get_salary=new Zend_Dojo_Form_Element_DateTextBox('date_get_salary');
    	$date_get_salary->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'class'=>'fullside',
    			));
    	$date_get_salary->setValue(date('Y-m-d'));
    	
    	$date_end_contract=new Zend_Dojo_Form_Element_DateTextBox('date_end_contract');
    	$date_end_contract->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'class'=>'fullside',
    			));
    	$date_end_contract->setValue(date('Y-m-d'));
    	
    	$status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
    	$status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
    	$status_opt = array(
    			1=>$this->tr->translate("ACTIVE"),
    			0=>$this->tr->translate("DACTIVE"));
    	$status->setMultiOptions($status_opt);
    	
    	$db = new Application_Model_DbTable_DbGlobal();
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
    	
    	$staff_code=new Zend_Dojo_Form_Element_NumberTextBox('staff_code');
    	$staff_code->setAttribs(array(
    			'dojoType'=>'dijit.form.NumberTextBox',
    			'class'=>'fullside',
    			'required'=>true
    			));
    	
    	$for_month=new Zend_Dojo_Form_Element_FilteringSelect('for_month');
    	$for_month->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'required'=>true
    	));
		$opt_month="";
		  	for($i=1;$i<=12;$i++){
		  	 	$opt_month[$i]=$i;
		  }
    	$for_month->setMultiOptions($opt_month);
    	
    	$_id = new Zend_Form_Element_Hidden('id');
    	if($data!=null){
    	//	$staff_name->setValue($data['staff_id']);
    		//$position_->setValue($data['position']);
    		$Basic_salary->setValue($data['basic_salary']);
    		$date_start->setValue($data['date_start']);
    		$date_get_salary->setValue($data['date_get_salary']);
    		$status->setValue($data['status']);
    		$_branch_id->setValue($data['branch_id']);
    		//$staff_code->setValue($data['staff_code']);
    		$_id->setValue($data['id']);
    	}
    	
		$this->addElements(array($_id,$date_end_contract,$position_,$staff_code,$for_month,$status,$_branch_id,$_id,$staff_name,$Basic_salary,$date_start,$date_get_salary));
		return $this;
    }
}

