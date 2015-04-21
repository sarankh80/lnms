<?php 
Class Loan_Form_FrmSearchGroupPayment extends Zend_Dojo_Form {
	protected $tr;
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function AdvanceSearch ($data=null){
		$request=Zend_Controller_Front::getInstance()->getRequest();
		$db = new Loan_Model_DbTable_DbGroupPayment();
		
		$advnceSearch = new Zend_Dojo_Form_Element_TextBox("advance_search");
		$advnceSearch->setAttribs(array('class'=>'fullside'
				,'dojoType'=>'dijit.form.TextBox'
				,'placeholder'=>$this->tr->translate("Reciept No or Loan Number")));
		$client_name = new Zend_Dojo_Form_Element_FilteringSelect("client_name");
		$opt_client = array(''=>'ជ្រើសរើស ឈ្មោះអតិថិជន');
		$rows = $db->getAllClient();
		if(!empty($rows))foreach($rows AS $row){
			$opt_client[$row['id']]=$row['name'];
		}
		$client_name->setMultiOptions($opt_client);
		$client_name->setAttribs(array('class'=>'fullside','dojoType'=>'dijit.form.FilteringSelect'));
		
		$date = date("y-m-d");
		$date_pay = new Zend_Dojo_Form_Element_DateTextBox("date_pay");
		$date_pay->setAttribs(array('class'=>'fullside','dojoType'=>'dijit.form.DateTextBox','placeholder'=>$this->tr->translate("ថ្ងៃត្រូវបង់ប្រាក់")));
		$date_pay->setValue($date);
		
		$due_date = new Zend_Dojo_Form_Element_DateTextBox("due_date");
		$due_date->setAttribs(array('class'=>'fullside','dojoType'=>'dijit.form.DateTextBox','placeholder'=>$this->tr->translate("ថ្ងៃទទួលប្រាក់")));
		$due_date->setValue($date);
		
		$status = new Zend_Dojo_Form_Element_FilteringSelect("status");
		$status->setAttribs(array('class'=>'fullside','dojoType'=>'dijit.form.FilteringSelect','placeholder'=>$this->tr->translate("ស្ថានការ")));
		$opt_status = array(''=>'ជ្រើសរើស ស្ថានការ','1'=>'ដំណើការ','2'=>'មិនដំណើការ');
		$status->setMultiOptions($opt_status);
		
		$submit = new Zend_Dojo_Form_Element_SubmitButton("btn_submit");
		$submit->setAttribs(array('dojoType'=>'dijit.form.Button',
				'iconclass'=>'dijitIconSearch',
				'label'=>'Search'));
		$advnceSearch->setValue($request->getParam("advance_search"));
		$client_name->setValue($request->getParam("client_name"));
		$date_pay->setValue($request->getParam("date_pay"));
		$due_date->setValue($request->getParam("due_date"));
		$status->setValue($request->getParam("status"));
		if($data!=null){
			$advnceSearch->setValue($request->getParam("advance_search"));
			$client_name->setValue($request->getParam("client_name"));
			$date_pay->setValue($request->getParam("date_pay"));
			$due_date->setValue($request->getParam("due_date"));
			$status->setValue($request->getParam("status"));
			
		}
		$this->addElements(array($submit,$advnceSearch,$client_name,$date_pay,$due_date,$status));
		return $this;
		
	}	
}