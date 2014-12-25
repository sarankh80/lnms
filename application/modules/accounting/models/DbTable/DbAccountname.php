<?php
class Accounting_Model_DbTable_DbAccountname extends Zend_Db_Table_Abstract
{
	protected $_name = 'ln_account_name';
	function addaccountname($data){
		$data = array(
				'account_code'=>$data['account_id'],
				'account_name_kh'=>$data['account_namekh'],
				'account_name_en'=>$data['account_nameeg'],
				'displayby'=>$data['dispay_by'],
				'disc'=>$data['description'],
				'option_acc'=>$data['optionacc'],
				'type'=>$data['account_type'],
				'parent_id'=>$data['parent_acc'],
				'category_id'=>$data['categories'],
				'date'=>$data['date'],
				'status'=>$data['status'],
		);
		$this->insert($data);

}
function updateaccountname($data){
	$arr = array(
			'account_code'=>$data['account_id'],
			'account_name_kh'=>$data['account_namekh'],
			'account_name_en'=>$data['account_nameeg'],
			'displayby'=>$data['dispay_by'],
			'disc'=>$data['description'],
			'option_acc'=>$data['optionacc'],
			'type'=>$data['account_type'],
			'parent_id'=>$data['parent_acc'],
			'category_id'=>$data['categories'],
			'date'=>$data['date'],
			'status'=>$data['status'],
				
		);
	$where=" id = ".$data['id'];
	$this->update($arr, $where);
}
function geteaccountnamebyid($id){
	$db = $this->getAdapter();
	$sql=" SELECT id,account_code,account_name_kh,account_name_en,displayby,disc,
	option_acc,type,parent_id,category_id,date,status FROM $this->_name where id=$id ";
	return $db->fetchRow($sql);
}

function getAllaccountname($search=null){
	$db = $this->getAdapter();
	$sql=" SELECT id,
	(SELECT branch_namekh FROM ln_branch WHERE br_id = Category_id),account_code,account_name_kh,account_name_en,displayby,disc,
	option_acc,type,parent_id,category_id,date,status FROM $this->_name  ";
	return $db->fetchAll($sql);
}



}