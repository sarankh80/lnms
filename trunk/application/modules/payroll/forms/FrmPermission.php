<?php

class Payroll_Form_FrmPermission extends Zend_Dojo_Form
{
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}

    public function frmPermission($data=null)
    {
    	$db = new Application_Model_DbTable_DbGlobal();
    	
    	$employee = new Zend_Dojo_Form_Element_FilteringSelect('employee');
    	$rows = $db ->getAllCOName();
    	$options=array(''=>"------Select------",-1=>"Add New");
    	if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
    	$employee->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'onchange'=>'popupCheckCO();'
    	));
    	$employee->setMultiOptions($options);
  
    	$approve_by = new Zend_Dojo_Form_Element_FilteringSelect('approve_by');
    	$rows = $db ->getAllCOName();
    	$options=array(''=>"------Select------",-1=>"Add New");
    	if(!empty($rows))foreach($rows AS $row) $options[$row['co_id']]=$row['co_khname'];
    	$approve_by->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'class'=>'fullside',
    			'onchange'=>'popupCheckCO();'
    	));
    	$approve_by->setMultiOptions($options);
    	
    	$request_date=new Zend_Dojo_Form_Element_DateTextBox('request_date');
    	$request_date->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$db_type=new Application_Model_DbTable_DbGlobal();
    	$opt_type=$db_type->getVewOptoinTypeByType(7,1);
    	$type=new Zend_Dojo_Form_Element_FilteringSelect('type');
    	$type->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$type->setMultiOptions($opt_type);
    	$from_date=new Zend_Dojo_Form_Element_DateTextBox('from_date');
    	$from_date->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$from_date->setValue(date('Y-m-d'));
    	
    	
    	$to_date=new Zend_Dojo_Form_Element_DateTextBox('to_date');
    	$to_date->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$to_date->setValue(date('Y-m-d'));
    	
    	$time=new Zend_Dojo_Form_Element_TextBox('time');
    	$time->setAttribs(array(
    			'dojotype'=>'dijit.form.TextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$time->setValue('00:00');
    	$all_day=new Zend_Dojo_Form_Element_CheckBox('all_day');
    	$all_day->setAttribs(array(
    			'dojotype'=>'dijit.form.CheckBox',
    			'required'=>true,
    	));
    	
    	$paid_leave=new Zend_Dojo_Form_Element_CheckBox('paid_leave');
    	$paid_leave->setAttribs(array(
    			'dojotype'=>'dijit.form.CheckBox',
    			'required'=>true,
    	));
    	
    	$every_day=new Zend_Dojo_Form_Element_CheckBox('every_day');
    	$every_day->setAttribs(array(
    			'dojotype'=>'dijit.form.CheckBox',
    			'required'=>true,
    	));
    	
    	$reason=new Zend_Dojo_Form_Element_TextBox('reason');
    	$reason->setAttribs(array(
    			'dojotype'=>'dijit.form.TextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	
    	$branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
		$branch_id->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required' =>'true'
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$rows = $db->getAllBranchName();
		$options='';
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['br_id']]=$row['branch_namekh'];
		}
		$branch_id->setMultiOptions($options);
		$_status=  new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_status->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside',));
		$_status_opt = array(
				1=>$this->tr->translate("ACTIVE"),
				0=>$this->tr->translate("DACTIVE"));
		$_status->setMultiOptions($_status_opt);
		
		$_id = new Zend_Form_Element_Hidden('id');
		if($data!=null){
			$employee->setValue($data['employee_id']);
			$branch_id->setValue($data['branch_id']);
			$employee->setValue($data['employee_id']);
			$approve_by->setValue($data['approve_by']);
			$request_date->setValue($data['request_date']);
			$type->setValue($data['permission_type']);
			$from_date->setValue($data['from_date']);
			$to_date->setValue($data['to_date']);
			$time->setValue($data['time']);
			$all_day->setValue($data['all_day']);
			$paid_leave->setValue($data['paid_leave']);
			$every_day->setValue($data['every_day']);
			$reason->setValue($data['reason']);
			$_status->setValue($data['status']);
			$_id->setValue($data['id']);
		}
		
		$this->addElements(array($_status,$_id,$employee,$approve_by,$request_date,$type,$from_date,$to_date,$time,
				$all_day,$reason,$paid_leave,$every_day,$branch_id));
		return $this;
    }


}

