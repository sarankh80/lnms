<?php
class Tellerandexchange_Model_DbTable_Dbexchange extends Zend_Db_Table_Abstract
{

	protected $_name = 'ln_exchange';
	function addxchange($_data){
		$arr = array(
				'branch_id'=>$_data['branch_id'],
				'invoice_code'=>$_data['number_code'],
				'receive_amount'=>$_data['onetomany'],
				'date'=>$_data['date'],
				'user_id'=>$_data['cusomer'],
				
		);
		$this->insert($arr);
	}
// 	function updatetellerandexchange($_data){
// 		$arr = array(
// 				'branch_id'=>$_data['branch_id'],
// 				'invoice_code'=>$_data['number_code'],
// 				'receive_amount'=>$_data['onetomany'],
// 				'date'=>$_data['date'],
// 				'user_id'=>$_data['cusomer'],
				
// 		);
// 		$where=" id = ".$_data['id'];
// 		$this->update($arr, $where);
// 	}
// 	function geteAlltellerandexchange($id){
// 		$db = $this->getAdapter();
// 		$sql=" SELECT id,
// 		(SELECT branch_id FROM ln_exchange WHERE branch_id = branch_id limit 1) 
// 		//echo $sql;exit();
// 		return $db->fetchAll($sql);
// 	}
// }

}
?>