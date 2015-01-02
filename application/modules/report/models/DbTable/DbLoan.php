<?php
class Report_Model_DbTable_DbLoan extends Zend_Db_Table_Abstract
{
      public function getAllLoan(){
      	 $db = $this->getAdapter();
    	 $sql="SELECT member_id,loan_number
    	 ,(SELECT name_kh FROM ln_client WHERE client_id=client_id limit 1) As client_id,amount_collect_principal,interest_rate
    	 ,(SELECT total_duration FROM ln_loan_group where g_id = group_id limit 1) AS total_duration
    	 ,(SELECT date_release FROM ln_loan_group where g_id = group_id limit 1) AS date_release
    	 ,(SELECT co_khname FROM ln_co WHERE co_id= 
    	 (SELECT co_id FROM ln_loan_group where g_id = group_id limit 1))AS co_name
    	 ,admin_fee FROM ln_loan_member";
      return $db->fetchAll($sql);
      }
 }

