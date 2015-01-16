<?php

class Loan_Model_DbTable_DbLoanGroup extends Zend_Db_Table_Abstract
{

    protected $_name = 'ln_loan_group';
    public function getUserId(){
    	$session_user=new Zend_Session_Namespace('auth');
    	return $session_user->user_id;
    	 
    }
    public function addNewLoanGroup($data){
    	
    	$db = $this->getAdapter();
    	$db->beginTransaction();
    	try{
    		$datagroup = array(
    				'group_id'=>$data['group_id'],
    				'co_id'=>$data['co_id'],
    				'zone_id'=>$data['zone'],
    				'level'=>$data['level'],
    				'date_release'=>$data['release_date'],
    				'create_date'=>date("Y-m-d"),
    				'branch_id'=>$data['branch_id'],
    				'total_duration'=>$data['period'],
    				'first_payment'=>$data['first_payment'],
    				'time_collect'=>$data['time'],
    				'pay_term'=>$data['pay_every'],
    				'payment_method'=>$data['repayment_method'],
    				'holiday'=>$data['every_payamount'],
    				'is_renew'=>0,
    				'loan_type'=>1,
    				'loan_group'=>1,
    				'collect_typeterm'=>$data['collect_termtype']
    		);
    		
    		$g_id = $this->insert($datagroup);//add group loan
    		$dbtable = new Application_Model_DbTable_DbGlobal();
    		$tranlist = explode(',',$data['record_row']);
    		foreach ($tranlist as $i) {
    			$datamember = array(
    					'group_id'=>$g_id,
    					'client_id'=>$data['member_id'.$i],
    					'total_capital'=>$data['debt_amount'.$i],//$data[''],
    					'loan_purpose'=>$data['note'.$i],
    					'payment_method'=>$data['repayment_method'],
    					'currency_type'=>$data['currency_type'],
    					'admin_fee'=>$data['loan_fee'],
    					'interest_rate'=>$data['interest_rate'],
    					'status'=>1,
    					'is_completed'=>0,
    					'branch_id'=>$data['branch_id'],
    					'pay_before'=>$data['pay_before'],
    					'pay_after'=>$data['pay_late'],
    					'graice_period'=>$data['graice_pariod'],
    					'amount_collect_principal'=>$data['amount_collect'],
    					'collect_typeterm'=>$data['collect_termtype']
    			);
    			
    			$this->_name='ln_loan_member';
    			$g_id = $this->insert($datamember);//add member loan
    			
    			$remain_principal = $data['debt_amount'.$i];
    			$next_payment = $data['first_payment'];
    			$start_date = $data['release_date'];//loan release;
    			
    			$old_remain_principal = 0;
    			$old_pri_permonth = 0;
    			$old_interest_paymonth = 0;
    			$old_amount_day = 0;
    			$amount_collect = 1;
    			$ispay_principal=2;//for payment type = 5;
    			$is_subremain = 2;
    			$curr_type = $data['currency_type'];
    			
    			$this->_name='ln_loanmember_funddetail';
    			$borrow_term = $dbtable->getSubDaysByPaymentTerm($data['pay_every'],null);//return amount day for payterm
    			$amount_borrow_term = $borrow_term*$data['period'];//amount of borrow
    			
    			$fund_term = $dbtable->getSubDaysByPaymentTerm($data['collect_termtype'],null);//return amount day for payterm
    			$amount_fund_term = $fund_term*$data['amount_collect'];
    			
    			$loop_payment = ($amount_borrow_term)/($amount_fund_term);
    			$payment_method = $data['repayment_method'];
    			for($j=1;$j<=$loop_payment;$j++){
    				//return amount next day collection
    				$amount_collect = $data['amount_collect'];
    				$day_perterm = $dbtable->getSubDaysByPaymentTerm($data['collect_termtype'],$amount_collect);//return amount day for payterm
    				
    				//$day_perterm = $dbtable->getSubDaysByPaymentTerm($data['pay_every'],$amount_collect);//return amount day for payterm
    				$str_next = $dbtable->getNextDateById($data['collect_termtype'],$data['amount_collect']);//for next,day,week,month;
    				
    				if($payment_method==1){//decline//completed
//     					$pri_permonth = ($data['debt_amount'.$j]/($data['period']-$data['graice_pariod'])*$amount_collect);
    					$pri_permonth = $data['debt_amount'.$i]/(($amount_borrow_term-($data['graice_pariod']*$borrow_term))/$amount_fund_term);
    					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    					
    					if($j*$amount_collect<=$data['graice_pariod']){//check here//for graice period
    						$pri_permonth = 0;
    					}
    					if($j!=1){
    						if($data['graice_pariod']!=0){//if collect =1 not other check
    							if($j*$amount_collect>$data['graice_pariod']+$amount_collect){//not wright
    								$remain_principal = $remain_principal-$pri_permonth;
    							}else{
    								
    							}
    						}else{
    							$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា}
    						}
    						if($j==$loop_payment){//check condition here//for end of record only
    							$pri_permonth = $data['debt_amount'.$i]-$pri_permonth*($j-(($data['graice_pariod']/$amount_collect)+1));//code error here
    						}
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}else{
    						$next_payment = $data['first_payment'];
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = ($data['debt_amount'.$i])*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}
    				}elseif($payment_method==2){//baloon
    					$pri_permonth=0;
    					if(($j*$amount_collect)==$data['period']){
    						$pri_permonth = ($curr_type==1)?round($data['debt_amount'.$i],-2):$data['debt_amount'.$i];
    						$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    						$remain_principal = $pri_permonth;//$remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					}
    					if($j!=1){
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
//     						$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}else{
    						$next_payment = $data['first_payment'];//$dbtable->getNextPayment($str_next, $start_date, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    					$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    				}elseif($payment_method==3){//fixed rate
    					////////////////////////////
    					$pri_permonth = ($data['debt_amount'.$i]/($amount_borrow_term/$amount_fund_term));
    					$pri_permonth = ($curr_type==2)? round($pri_permonth,-2): $pri_permonth;
    					
    					if($j!=1){
    						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}else{
    						$next_payment = $data['first_payment'];
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    						$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    						
    				}elseif($payment_method==4){//fixed payment full last period yes
    					if($j!=1){
    						$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    						$start_date = $next_payment;
    						$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    							
    					}else{
    						$next_payment = $data['first_payment'];
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					}
    					$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					$pri_permonth = $data['amount_collect_pricipal']-$interest_paymonth;
    					if($j==$loop_payment){//for end of record only
    					//if(($i*$amount_collect)==$data['period']){//check here 
    						$pri_permonth = $remain_principal;
    					}
    				}elseif($payment_method==5){//semi baloon//ok
    					if($j!=1){
    						$ispay_principal++;
    						$is_subremain++;
    						$pri_permonth = ($data['debt_amount'.$i]/$data['period'])*$data['amount_collect_pricipal'];
    						$pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    						$pri_permonth=0;
								if(($is_subremain-1)==$data['amount_collect_pricipal']){
    								$pri_permonth = ($data['debt_amount'.$i]/$data['period'])*$data['amount_collect_pricipal'];
    								$is_subremain=1;
    							}
    							if(($ispay_principal-1)==$data['amount_collect_pricipal']+1){
    								$remain_principal = $remain_principal-($data['debt_amount'.$i]/$data['period'])*$data['amount_collect_pricipal'];
    								$ispay_principal=2;
    							}
    							if($j==($data['period']/$data['amount_collect'])){//check condition here//for end of record only
    								$pri_permonth = ($data['debt_amount'.$i]/$data['period'])*$data['amount_collect_pricipal'];
    								$pri_permonth = $data['debt_amount'.$i]-$pri_permonth*($j-(($data['graice_pariod']/$amount_collect)+1));//code error here
    							}
    							
    							$start_date = $next_payment;
    							$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    							$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    							$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					
    					}else{
    						$pri_permonth = 0;//check if get pri first too much change;
    						$next_payment = $data['first_payment'];
    						$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    						$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					}
    				}else{//    fixed payment with fixed rate
    					    $pri_permonth = $data['debt_amount'.$i]/$data['period']*$amount_collect;
    					        
    					    $pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    					    	if($j!=1){
    					    			$remain_principal = $remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					    	        $start_date = $next_payment;
    					    			$next_payment = $dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    					    			$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					    	}else{
    					    			$next_payment = $data['first_payment'];
    					    			$amount_day = $dbtable->CountDayByDate($start_date,$next_payment);
    					    	}
    					    			$interest_paymonth = ($data['debt_amount'.$i]*($data['interest_rate']/100)/$data['period']*($amount_day/$day_perterm));
    				}
    				$old_remain_principal =$old_remain_principal+$remain_principal;
    				$old_pri_permonth = $old_pri_permonth+$pri_permonth;
    				
    				$old_interest_paymonth = $old_interest_paymonth+$interest_paymonth;
    				$old_amount_day =$old_amount_day+ $amount_day;
    				
    				if($data['amount_collect']==$amount_collect){
    					
    					$datapayment = array(
    							'member_id'=>$g_id,
    							'total_principal'=>$remain_principal,//good
    							'principal_permonth'=> $old_pri_permonth,//good
    							'total_interest'=>$old_interest_paymonth,//good
    							'total_payment'=>$old_pri_permonth+$old_interest_paymonth,//good
    							'date_payment'=>$next_payment,//good
    							'is_completed'=>0,
    							'branch_id'=>1,
    							'status'=>1,
    							'amount_day'=>$old_amount_day,
    					);
    					$this->insert($datapayment);
    					$amount_collect=0;
    					$old_remain_principal = 0;
    					$old_pri_permonth = 0;
    					$old_interest_paymonth = 0;
    					$old_amount_day = 0;
    					
    				}else{
    					
    				}
    				$amount_collect++;
    			}
    			if(($amount_borrow_term)%($amount_fund_term)!=0){///end for record odd number only
    				$start_date = $next_payment;//$dbtable->getNextPayment($str_next, $next_payment, $data['amount_collect'],$data['every_payamount']);
    				$amount_day = $amount_day = $dbtable->CountDayByDate($start_date,$data['date_line']);
    				if($payment_method==1){
    					$pri_permonth =$remain_principal-$pri_permonth; // $pri_permonth*($amount_day/$amount_fund_term);//check it if khmer currency
    					$pri_permonth = ($curr_type==1)?round($pri_permonth,-2):$pri_permonth;
    					$interest_paymonth = $pri_permonth*($data['interest_rate']/100)*($amount_day/$day_perterm);
    				}elseif($payment_method==2){
    					$pri_permonth = ($curr_type==1)?round($data['debt_amount'.$i],-2):$data['debt_amount'.$i];
    					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    					$remain_principal = $pri_permonth;//$remain_principal-$pri_permonth;//OSប្រាក់ដើមគ្រា
    					$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    				}elseif($payment_method==3){
    					$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					$pri_permonth = $pri_permonth*($amount_day/$amount_fund_term);//check it if khmer currency
    					$pri_permonth = ($curr_type==1)? round($pri_permonth,-2): round($pri_permonth);
    				}elseif($payment_method==4){
    					$interest_paymonth = $data['debt_amount'.$i]*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					$pri_permonth = $remain_principal-$pri_permonth;
    				}elseif($payment_method==5){
    					$pri_permonth = $remain_principal;
    					$interest_paymonth = $remain_principal*($data['interest_rate']/100)*($amount_day/$day_perterm);
    					
    				}elseif($payment_method==6){
    					//$pri_permonth = $data['debt_amount'.$i]/$data['period']*$amount_collect;
    					$pri_permonth = $pri_permonth*($amount_day/$amount_fund_term);
    					$interest_paymonth = ($data['debt_amount'.$i]*($data['interest_rate']/100)/$data['period']*($amount_day/$day_perterm));
    				}
    				
    				$datapayment = array(
    						'member_id'=>$g_id,
    						'total_principal'=>$pri_permonth,//good
    						'principal_permonth'=> $pri_permonth,//good
    						'total_interest'=>$interest_paymonth,//good
    						'total_payment'=>$interest_paymonth+$pri_permonth,//good
    						'date_payment'=>$data['date_line'],//good
    						'is_completed'=>0,
    						'branch_id'=>1,
    						'status'=>1,
    						'amount_day'=>$amount_day,
    				);
    				$this->insert($datapayment);
    			}
    		}
    		$db->commit();
    		return 1;
    	}catch (Exception $e){
    		$db->rollBack();
    		return $e->getMessage();
    	}
    }
    public function getNextDateById($pay_term){
    	if($pay_term==3){
    		$str_next = 'next month';
    	}elseif($pay_term==2){
    		$str_next = 'next week';
    	}else{
    		$str_next = 'next day';
    	}
    	return $str_next;
    }
    public function getSubDaysByPaymentTerm($pay_term){
    	if($pay_term==3){
    		$amount_days =30;
    	}elseif($pay_term==2){
    		$amount_days =7;
    	}else{
    		$amount_days =1;
    	}
    	return $amount_days;
    	
    }
    public function CountDayByDate($start,$end){
    	$db = new Application_Model_DbTable_DbGlobal();
    	return ($db->countDaysByDate($start,$end));
    }
    public function CalculateByMethod($method_type){
    	
    }
  
}

