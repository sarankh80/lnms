<?php

class Payroll_Form_FrmSalary extends Zend_Dojo_Form
{

    public function frmaddSalary()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$staff_name=new Zend_Dojo_Form_Element_ValidationTextBox('staff_name');
    	$staff_name->setAttribs(array(
    			'dojoType'=>'dijit.form.ValidationTextBox',
    			'required'=>true
    			));
    	
    	$Sex=new Zend_Dojo_Form_Element_FilteringSelect('sex');
    	$Sex->setAttribs(array(
    			'dojoType'=>'dijit.form.FilteringSelect'));
    	$Sex->setMultiOptions(array(""));
    	
    	$position=new Zend_Dojo_Form_Element_TextBox('position');
    	$position->setAttribs(array(
    			'dojoType'=>'dijit.form.TextBox'));
    	
    	$Basic_salary=new Zend_Dojo_Form_Element_NumberTextBox('basic_salary');
    	$Basic_salary->setAttribs(array(
    			'dojoType'=>'dijit.form.NumberTextBox',
    			'required'=>true));
    	
    	
    	
    	
    	$for_manth=new Zend_Dojo_Form_Element_DateTextBox('for_manth');
    	$for_manth->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox'));
    	$for_manth->setValue(date('Y-m-d'));
    	
    	
    	$Start_day=new Zend_Dojo_Form_Element_DateTextBox('start_day');
    	$Start_day->setAttribs(array(
    			'dojoType'=>'dijit.form.DateTextBox'));
    	$Start_day->setValue(date('Y-m-d'));
    	
    	
    	
		$this->addElements(array($staff_name,$Sex,$position,$Basic_salary,$for_manth,$Start_day));
		return $this;
    }


}

