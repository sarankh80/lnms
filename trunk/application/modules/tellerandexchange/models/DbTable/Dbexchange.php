<?php
class Tellerandexchange_Model_DbTable_Dbexchange extends Zend_Db_Table_Abstract
{

	protected $_name = 'ln_exchange';
	function addXchange($_data){
		$arr = array(
				'branch_id'=>$_data['branch_id'],
				'invoice_code'=>$_data['number_code'],
				'receive_amount'=>$_data['onetomany'],
				'date'=>$_data['date'],
				'user_id'=>$_data['cusomer'],
				
		);
		$id = $this->insert($arr);
		
		$this->_name='ln_exchange_detail';
		$ids = explode(',', $_data['record_row']);
		foreach ($ids as $i){
			$arr = array(
				'exchange_id'=>$id,
				'from_currency_type'=>$_data['from_type'.$i],
				'to_currency_type'=>$_data['to_type'.$i],
				'specail_customer'=>empty($_data['is_spacial'.$i])?0:1,
				'exchange_rate'=>$_data['exchange_rate'.$i],
				'changed_amount'=>$_data['exchange_amount'.$i],
				'recieved_amount'=>$_data['amount_exchanged'.$i],
// 				'from_amount'=>$_data['from_type'.$i],
// 				'to_amount'=>$_data['from_type'.$i],
// 				'from_to'=>$_data['from_type'.$i],
// 				'recieved_type'=>$_data['from_type'.$i],
				
				);
		$this->insert($arr);
		}
		//print_r($ids);
		
	}
	function updatexchange($_data){
		$arr = array(
				'branch_id'=>$_data['branch_id'],
				'invoice_code'=>$_data['number_code'],
				'receive_amount'=>$_data['onetomany'],
				'date'=>$_data['date'],
				'user_id'=>$_data['cusomer'],
				
		);
		$where=" id = ".$_data['id'];
		$this->update($arr, $where);
	}
function getexpensebyid($id){
	$db = $this->getAdapter();
	$sql=" SELECT id,branch_id,invoice_code,receive_amount,date,user_id FROM $this->_name where id=$id ";
	return $db->fetchRow($sql);
}
}
?>