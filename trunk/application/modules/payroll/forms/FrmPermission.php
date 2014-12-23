<?php

class Payroll_Form_FrmPermission extends Zend_Dojo_Form
{

    public function frmPermission()
    {
        /* Form Elements & Other Definitions Here ... */
    	$opt_employee=array(1=>'ធុង​ កក្កដា',2=>'ថុន សម្បត្តិ',3=>'មក ចន្នី');
    	$employee=new Zend_Dojo_Form_Element_FilteringSelect('employee');
    	$employee->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$employee->setMultiOptions($opt_employee);
    	
    	$approve_by=new Zend_Dojo_Form_Element_FilteringSelect('approve_by');
    	$approve_by->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$approve_by->setMultiOptions(array("ប្រធានសាខា","ប្រធាតំបន់"));
    	
    	$request_date=new Zend_Dojo_Form_Element_DateTextBox('request_date');
    	$request_date->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox',
    			'required'=>true,
    			'class'=>'fullside'
    			));
    	$opt_type=array(1=>'ឈឺ',2=>'អាពាហ៍ពិពាហ៍',3=>'ពិធីបុណ្យ',4=>'ចុះខេត្ត');
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
//     	$opt=array(1=>'All Day',2=>'Paid Leave',3=>'Every Day');
//     	$choose->setMultiOptions($opt);
    	
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
		
		$this->addElements(array($employee,$approve_by,$request_date,$type,$from_date,$to_date,$time,
				$all_day,$reason,$paid_leave,$every_day,$branch_id));
		return $this;
    }


}

