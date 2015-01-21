 <?php

class Capital_Model_DbTable_DbCapital extends Zend_Db_Table_Abstract
{
    protected $_name ='ln_branch_capital';
   	Public function getUserId($_data){
    	$_arr = array(
    		'branch_id'=>$_data['brance'],
    	    'date'=>$_data['date'],
    	    'status'=>$_data['status'],
    	    'amount_dollar'=>$_data['usa'],
    	    'amount_riel'=>$_data['reil'],
    		'amount_bath'=>$_data['bath'],
    		'note'=>$_data['note'],
    			);
    	$this->insert($_arr);
    }
    function getAllCapital(){
    	$db = $this->getAdapter();
    	$sql=" SELECT id,branch_id,status,date,note,amount_dollar,amount_riel,amount_bath
    	FROM ln_branch_capital";
    	return $db->fetchAll($sql);
    }
    public function getpartnerById($id){
    	$db = $this->getAdapter();
    	$sql = "SELECT * FROM ln_branch_capital WHERE id = ".$db->quote($id);
    	$sql.=" LIMIT 1 ";
    	$row=$db->fetchRow($sql);
    	return $row;
    }
    function updateCapital($_data){
    	$arr=array(
    			'branch_id'=>$_data['brance'],
    			'date'=>$_data['date'],
    			'status'=>$_data['status'],
    			'amount_dollar'=>$_data['usa'],
    			'amount_riel'=>$_data['reil'],
    			'amount_bath'=>$_data['bath'],
    			'note'=>$_data['note'],
    	);
    	return  $this->update($arr);
    }
}