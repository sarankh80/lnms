<?php 
Class Other_Form_FrmVillage extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function FrmAddVillage($data=null){
		
		$village_name = new Zend_Dojo_Form_Element_TextBox('village_name');
		$village_name->setAttribs(array('dojoType'=>'dijit.form.ValidationTextBox',
				'required'=>'true','missingMessage'=>'Invalid Module!','class'=>'fullside'
		));
		
		$_db = new Application_Model_DbTable_DbGlobal();
		
		$rows_provice = $_db->getCommune();
		$opt_province = "";
		if(!empty($rows_provice))foreach($rows_provice AS $row) $opt_province[$row['com_id']]=$row['commune_name'];
		$commune_name = new Zend_Dojo_Form_Element_FilteringSelect('commune_name');
		$commune_name->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside'
		));
		
		$commune_name->setMultiOptions($opt_province);
		$commune_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'class'=>'fullside',));
		
		$rows_provice = $_db->getAllDistrict();
		$opt_province = "";
		if(!empty($rows_provice))foreach($rows_provice AS $row) $opt_province[$row['dis_id']]=$row['district_name'];
		$district_name = new Zend_Dojo_Form_Element_FilteringSelect('district_name');
		$district_name->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside'
		));
		
		$district_name->setMultiOptions($opt_province);
		$district_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'class'=>'fullside',));
		
		$rows_provice = $_db->getAllDistrict();
		$opt_province = "";
		if(!empty($rows_provice))foreach($rows_provice AS $row) $opt_province[$row['dis_id']]=$row['district_name'];
		$district_name = new Zend_Dojo_Form_Element_FilteringSelect('district_name');
		$district_name->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside'
		));
		
		$district_name->setMultiOptions($opt_province);
		$district_name->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'class'=>'fullside',));
		
		
		
		
		$rows_provice = $_db->getAllProvince();
		$opt_province = "";
		if(!empty($rows_provice))foreach($rows_provice AS $row) $opt_province[$row['province_id']]=$row['province_en_name'];
		$_province = new Zend_Dojo_Form_Element_FilteringSelect('province_name');
		$_province->setAttribs(array('dojoType'=>'dijit.form.FilteringSelect','class'=>'fullside'
		));
		
		$_province->setMultiOptions($opt_province);
		$_province->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'class'=>'fullside',));
		
		$_arr = array(1=>$this->tr->translate("ACTIVE"),0=>$this->tr->translate("DACTIVE"));
		$_status = new Zend_Dojo_Form_Element_FilteringSelect("status");
		$_status->setMultiOptions($_arr);
		$_status->setAttribs(array(
				'dojoType'=>'dijit.form.FilteringSelect',
				'required'=>'true',
				'missingMessage'=>'Invalid Module!',
				'class'=>'fullside'));
		$id = new Zend_Form_Element_Hidden('id');
		if(!empty($data)){
			$id->setValue($data['vill_id']);
			$village_name->setValue($data['village_name']);
			$_province->setValue($data['pro_id']);
			$district_name->setValue($data['dis_id']);
			$commune_name->setValue($data['commune_id']);
			$_status->setValue($data['status']);
		}
		$this->addElements(array($id,$commune_name,$village_name,$district_name,$_province, $_status));
		return $this;
		
	}
	
	
}