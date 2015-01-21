<?php 
Class Capital_Form_FrmCapitale extends Zend_Dojo_Form {
	public function frmCapital($_data=null)
	{
		/* Form Elements & Other Definitions Here ... */
		$brance = new Zend_Dojo_Form_Element_FilteringSelect('brance');
		$brance->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
// 				'class'=>'fullside',
				'required' =>'true'
		));
		$db = new Application_Model_DbTable_DbGlobal();
		$rows = $db->getAllBranchName();
		$options='';
		if(!empty($rows))foreach($rows AS $row){
			$options[$row['br_id']]=$row['branch_namekh'];
		}
		$brance->setMultiOptions($options);
		
		$date=new Zend_Dojo_Form_Element_DateTextBox('date');
		$date->setAttribs(array(
				'dojoType'=>'dijit.form.DateTextBox'
		));
		$date->setValue(date('Y-m-d'));
		$date->setValue(date('Y-m-d'));
		$_stutas = new Zend_Dojo_Form_Element_FilteringSelect('status');
		$_stutas ->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
		));
		$options= array(1=>"ប្រើប្រាស់",0=>"មិនប្រើប្រាស់");
		$_stutas->setMultiOptions($options);
		$note=new Zend_Dojo_Form_Element_TextBox('note');
		$note->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox'));
		$usa=new Zend_Dojo_Form_Element_TextBox('usa');
		$usa->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox'));
		$bath=new Zend_Dojo_Form_Element_TextBox('bath');
		$bath->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox'));
		$reil=new Zend_Dojo_Form_Element_TextBox('reil');
		$reil->setAttribs(array(
				'dojoType'=>'dijit.form.TextBox'));
		$id = new Zend_Form_Element_Hidden('id');
		if($_data!=null){
			$brance->setValue($_data['id']);
			$date->setValue($_data['date']);
			$_stutas->setValue($_data['status']);
			$note->setValue($_data['note']);
			$usa->setValue($_data['amount_dollar']);
			$reil->setValue($_data['amount_riel']);
			$bath->setValue($_data['amount_bath']);
			$id->setValue($_data['id']);
		
		}
		$this->addElements(array($brance,$date,$_stutas,
				$note,$bath,$usa,$reil,$id));
		return $this;
	}
}
?>