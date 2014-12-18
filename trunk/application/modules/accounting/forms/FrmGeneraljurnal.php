<?php 
Class Accounting_Form_FrmGeneraljurnal extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmGeneraljurnal($data=null){
		
		$Brance = new Zend_Dojo_Form_Element_TextBox('brance');
		$Brance->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside',
				'readonly'=>true
		));
		
		
		
		
		$Add_Date = new Zend_Dojo_Form_Element_DateTextBox('add_date');
		$Add_Date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox',
				'class'=>'fullside',
				'required'=>true
		));
		$Add_Date->setValue(date('Y-m-d'));
		
		
		$Account_Number=new Zend_Dojo_Form_Element_FilteringSelect('account_number');
		$Account_Number->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside',
				'required'=>'true'
		));
		
		
		$Account_name = new Zend_Dojo_Form_Element_FilteringSelect('account_name');
		$Account_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'class'=>'fullside'
		));
		
		
		$Note = new Zend_Dojo_Form_Element_TextBox('note');
		$Note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside'
		));
		
		$Debit = new Zend_Dojo_Form_Element_TextBox('debit');
		$Debit->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside'
		));
		$Debit->setValue(0);
		
		$Credit = new Zend_Dojo_Form_Element_TextBox('credit');
		$Credit->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox',
				'class'=>'fullside'
		));
		$Credit->setValue(0);
		
		
// 		$_branch_id = new Zend_Dojo_Form_Element_FilteringSelect('branch_id');
// 		$_branch_id->setAttribs(array(
// 				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
// 				'required' =>'true'
// 		));
// 		$db = new Application_Model_DbTable_DbGlobal();
// 		$rows = $db->getAllBranchName();
// 		$options='';
// 		if(!empty($rows))foreach($rows AS $row){
// 			$options[$row['br_id']]=$row['branch_namekh'];
// 		}
// 		$_branch_id->setMultiOptions($options);
		 
// 		$_id = new Zend_Form_Element_Hidden('id');
		
		$this->addElements(array($Add_Date,$Account_Number,$Account_name,$Note,$Debit,$Credit,$Brance));
		return $this;
		
	}	
}