 <?php

class Capital_Model_DbTable_DbCapital extends Zend_Db_Table_Abstract
{
    protected $_name ='ln_branch_capital';
   	Public function getUserId($_data){
   		$session_user=new Zend_Session_Namespace('auth');
   		$user_id = $session_user->user_id;
    	$_arr = array(
    		'branch_id'		=>	$_data['brance'],
    	    'date'			=>	$_data['date'],
    	    'status'		=>	$_data['status'],
    	    'amount_dollar'	=>	$_data['usa'],
    	    'amount_riel'	=>	$_data['reil'],
    		'amount_bath'	=>	$_data['bath'],
    		'note'			=>	$_data['note'],
    		'user_id'		=> 	$user_id
    	);
    	$this->insert($_arr);
    }
    function getAllCapital(){
    	$db = $this->getAdapter();
    	$sql="SELECT brc.id,br.`branch_namekh`,brc.`date`,brc.note,brc.amount_dollar,brc.amount_riel,brc.amount_bath,brc.`status`
    	FROM ln_branch_capital AS brc,`ln_branch` AS br WHERE brc.`branch_id`=br.`br_id`";
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
    	$db = $this->getAdapter();
    	$id = $_data["id"];
    	$session_user=new Zend_Session_Namespace('auth');
    	$user_id = $session_user->user_id;
    	$arr=array(
    			'branch_id'		=>	$_data['brance'],
    			'date'			=>	$_data['date'],
    			'status'		=>	$_data['status'],
    			'amount_dollar'	=>	$_data['usa'],
    			'amount_riel'	=>	$_data['reil'],
    			'amount_bath'	=>	$_data['bath'],
    			'note'			=>	$_data['note'],
    			'user_id'		=>	$user_id
    	);
    	$where = $db->quoteInto("id=?", $id);
    	return  $this->update($arr, $where);
    }
}