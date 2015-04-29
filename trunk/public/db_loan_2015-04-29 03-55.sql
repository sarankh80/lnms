DROP TABLE cs_keycode;

CREATE TABLE `cs_keycode` (
  `code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyName` varchar(450) DEFAULT NULL,
  `keyValue` varchar(4500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO cs_keycode VALUES("1","rpt-transfer-warnning-kh","???????????????????????????????????????????");
INSERT INTO cs_keycode VALUES("2","rpt-transfer-title-kh","??.???");
INSERT INTO cs_keycode VALUES("3","rpt-transfer-title-eng","??????????? ??? ???????????");
INSERT INTO cs_keycode VALUES("4","rpt-transfer-business-meaning-kh","????????????????????????? ?????????????????????");
INSERT INTO cs_keycode VALUES("5","rpt-transfer-business-meaning-eng","EXCHANGE CURRENCY AND TRANSFER SERIVCE");
INSERT INTO cs_keycode VALUES("6","rpt-transfer-location-adr-kh","????????189(?) ?????????????????????????????????????");
INSERT INTO cs_keycode VALUES("7","rpt-transfer-tel-eng","Tel:017 777 613,011 288 258");
INSERT INTO cs_keycode VALUES("8","rpt-transfer-send-kh","?????");
INSERT INTO cs_keycode VALUES("9","rpt-transfer-recieve-kh","??????");
INSERT INTO cs_keycode VALUES("10","imgPath","images/resolvo.gif");
INSERT INTO cs_keycode VALUES("11","mainbranch","??.???");
INSERT INTO cs_keycode VALUES("12","branch-add","??????? ????????189(?) ?????????????????????????????????????");
INSERT INTO cs_keycode VALUES("13","bracnch-tel","017 777 613,011 288 258");
INSERT INTO cs_keycode VALUES("14","mainbranch-subtitle","???????????????, ???????????????");
INSERT INTO cs_keycode VALUES("15","marquee-word","????????????????????????? ????????????????????? ?????????????, Exchnage and Transfer money");
INSERT INTO cs_keycode VALUES("16","services","???????????????, ???????????????");
INSERT INTO cs_keycode VALUES("17","copyright","&copy 2013 MONOROM Exchange And Transfer Money Management All rights reserved.");
INSERT INTO cs_keycode VALUES("18","comment","????????????????????????????????? Tel:012 288 258");
INSERT INTO cs_keycode VALUES("19","branch-tel","322");
INSERT INTO cs_keycode VALUES("20","rpt-transfer-title-eng","");
INSERT INTO cs_keycode VALUES("21","rpt-transfer-business-meaning-kh","");
INSERT INTO cs_keycode VALUES("22","rpt-transfer-business-meaning-eng","");
INSERT INTO cs_keycode VALUES("23","rpt-transfer-location-adr-kh","");
INSERT INTO cs_keycode VALUES("24","rpt-transfer-tel-eng","");
INSERT INTO cs_keycode VALUES("25","rpt-transfer-warnning-kh","");
INSERT INTO cs_keycode VALUES("26","comment ","");
INSERT INTO cs_keycode VALUES("27","imgPath ","");



DROP TABLE cs_rate;

CREATE TABLE `cs_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we take from customer',
  `out_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we give to customer',
  `rate_in` double DEFAULT NULL,
  `rate_out` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1:active; 0:Disactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_account_branch;

CREATE TABLE `ln_account_branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `balance` float(16,2) DEFAULT NULL,
  `currency_type` tinyint(4) NOT NULL COMMENT '1=kh,2=dollar,3 bath',
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`,`account_id`,`branch_id`,`currency_type`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO ln_account_branch VALUES("1","1","1","10381262.00","2","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("2","2","1","-10320937.00","2","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("3","1","1","40701000.00","1","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("4","2","1","-40471000.00","1","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("5","1","2","9200000.00","1","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("6","2","2","-9150000.00","1","1","1","2015-02-08","");
INSERT INTO ln_account_branch VALUES("7","1","2","1011000.00","2","1","1","2015-02-09","");
INSERT INTO ln_account_branch VALUES("8","2","2","-1010910.00","2","1","1","2015-02-09","");
INSERT INTO ln_account_branch VALUES("9","3","1","60325.00","2","1","1","2015-02-27","");
INSERT INTO ln_account_branch VALUES("22","3","2","90.00","2","1","1","2015-04-15","");
INSERT INTO ln_account_branch VALUES("25","3","1","230000.00","1","1","1","2015-04-15","");
INSERT INTO ln_account_branch VALUES("26","3","2","50000.00","1","1","1","2015-04-15","");
INSERT INTO ln_account_branch VALUES("27","1","1","34000.00","3","1","1","2015-04-22","");
INSERT INTO ln_account_branch VALUES("28","2","1","-33660.00","3","1","1","2015-04-22","");
INSERT INTO ln_account_branch VALUES("29","3","1","340.00","3","1","1","2015-04-22","");



DROP TABLE ln_account_category;

CREATE TABLE `ln_account_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_namekh` varchar(100) DEFAULT NULL,
  `cate_nameen` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `account_type` tinyint(4) DEFAULT NULL,
  `deplay` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ln_account_category VALUES("1","Dell","Dell","1","2","1","2014-12-17","1","");
INSERT INTO ln_account_category VALUES("2","Apple","Apple","1","3","1","2014-12-10","2","");
INSERT INTO ln_account_category VALUES("3","Acer","Acer","1","2","1","2014-12-02","1","");
INSERT INTO ln_account_category VALUES("4","???","kok","6","1","1","2014-12-25","1","");
INSERT INTO ln_account_category VALUES("12","rrr","rrrr","1","1","2","2015-01-26","1","");



DROP TABLE ln_account_name;

CREATE TABLE `ln_account_name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_code` varchar(100) DEFAULT NULL,
  `account_name_kh` varchar(100) DEFAULT NULL,
  `account_name_en` varbinary(100) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `disc` text,
  `option_acc` tinyint(1) DEFAULT '1' COMMENT '1=operation acc,2=non operation acc',
  `account_type` tinyint(4) DEFAULT NULL COMMENT '1=asset,2=liabilities,3=equities,4=incomes,5=expense,6=cost of goods sold',
  `parent_id` tinyint(11) DEFAULT NULL,
  `category_id` tinyint(11) DEFAULT NULL,
  `balance` float(15,3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `option_type` tinyint(4) DEFAULT '1' COMMENT '1=acc,2cate,3 parent',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

INSERT INTO ln_account_name VALUES("17","10000008","loan","loan","","","1","1","20","21","0.000","2015-01-21","1","1","1");
INSERT INTO ln_account_name VALUES("18","","","","","","1","","","","","","1","","1");
INSERT INTO ln_account_name VALUES("19","10000007","Petty Cash","Petty Cash","","","2","1","9","2","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("20","11","Current Assets","Current Assets","","","2","1","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("21","3","Cash/Bank","Cash/Bank","","","2","1","20","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("22","9","Petty Cash","Petty Cash","","","1","1","20","21","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("23","8","Cash on Hand","Cash on Hand","","","1","1","20","21","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("28","10000009","Regular Checking Account","Regular Checking Account","","","1","1","20","21","0.000","2015-01-21","1","","0");
INSERT INTO ln_account_name VALUES("29","10000009","Regular Checking Account","Regular Checking Account","","","1","1","20","21","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("30","10000010","Savings Account","Savings Account","","","1","1","20","21","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("31","01","Accounts Receivable","Accounts Receivable","","","2","1","20","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("32","10000011","Allowance for Doubtful Account","Allowance for Doubtful Account","","","1","1","20","31","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("33","10000012","Accounts Receivable","Accounts Receivable","","","1","1","20","31","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("34","10000013","Other Receivables","Other Receivables","","","1","1","20","31","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("35","10000034","Pending Account Receivables","Pending Account Receivables","","","1","1","20","31","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("38","02","Inventory","Inventory","","","2","1","20","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("39","10000014","Inventory","Inventory","","","1","1","20","38","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("40","10000036","Stock","Stock","","","1","1","20","38","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("41","03","Other Current Assets","Other Current Assets","","","2","1","20","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("42","10000015","Prepaid Expenses","Prepaid Expenses","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("43","10000017","Purchase Tax","Purchase Tax","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("44","10000018","Employee Advances","Employee Advances","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("45","10000019","Notes Receivable-Current (Business Advance)","Notes Receivable-Current (Business Advance)","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("46","10000020","Other Current Assets","Other Current Assets","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("47","10000033","Supplier Deposit","Supplier Deposit","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("48","10000035","Inventory Markup","Inventory Markup","","","1","1","20","41","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("49","04","Fixed Assets","Fixed Assets","","","2","1","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("50","10000021","Equipment","Equipment","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("51","10000022","Depreciation - Equipment","Depreciation - Equipment","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("52","10000023","Vehicles","Vehicles","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("53","10000024","Depreciation - Vehicles","Depreciation - Vehicles","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("54","10000025","Leasehold Improvements","Leasehold Improvements","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("55","10000026","Depreciation - Leasehold","Depreciation - Leasehold","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("56","10000027","Buildings","Buildings","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("57","10000028","Depreciation - Buildings","Depreciation - Buildings","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("58","10000029","Land","Land","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("59","10000030","Depreciation - Land","Depreciation - Land","","","1","1","49","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("60","05","Other Assets","Other Assets","","","2","1","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("61","10000031","Notes Receivable- Noncurrent","Notes Receivable- Noncurrent","","","1","1","60","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("62","10000032","Other Noncurrent Assets","Other Noncurrent Assets","","","1","1","60","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("63","06","Current Liabilities","Current Liabilities","","","2","2","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("64","07","Other Current Liabilities","Other Current Liabilities","","","2","2","63","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("65","20000006","Accrued Expenses","Accrued Expenses","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("66","20000007","Sales Tax Payable","Sales Tax Payable","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("67","20000008","Wages Payable","Wages Payable","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("68","20000009","Insurance Payable","Insurance Payable","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("69","20000010","Income Taxes Payable 1%","Income Taxes Payable 1%","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("70","20000011","Other Taxes Payable","Other Taxes Payable","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("71","20000012","Current Portion Long-Term Debt","Current Portion Long-Term Debt","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("72","20000013","Other Current Liabilities","Other Current Liabilities","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("73","20000014","Suspense - Clearing Account","Suspense - Clearing Account","","","1","2","63","64","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("75","08","Accounts Payable","Accounts Payable","","","2","2","0","0","0.000","2015-01-21","1","","2");
INSERT INTO ln_account_name VALUES("76","20000021","Pending  Purchase Order Receipt","Pending  Purchase Order Receipt","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("77","20000022","Customer Gift Voucher","Customer Gift Voucher","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("78","20000020","Pending Sale Commissions","Pending Sale Commissions","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("79","20000018","Customer Deposit","Customer Deposit","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("80","20000019","Customer Return","Customer Return","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("81","20000015","Accounts Payable","Accounts Payable","","","1","2","63","75","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("82","09","Non-Current Liabilities","Non-Current Liabilities","","","2","2","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("83","010","Long Term Liabilities","Long Term Liabilities","","","2","2","0","0","0.000","2015-01-21","1","","3");
INSERT INTO ln_account_name VALUES("84","20001300","Customer Commission","Customer Commission","","","1","2","83","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("85","20000016","Notes Payable-Noncurrent","Notes Payable-Noncurrent","","","1","2","83","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("86","20000017","Other Long-Term Liabilities","Other Long-Term Liabilities","","","1","2","83","0","0.000","2015-01-21","1","","1");
INSERT INTO ln_account_name VALUES("88","010","Equity","Equity","","","2","3","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("89","30000004","Beginning Balance Equity","Beginning Balance Equity","","","1","3","88","0","0.000","2015-01-22","1","","1");
INSERT INTO ln_account_name VALUES("90","30000005","Common Stock","Common Stock","","","1","3","88","0","0.000","2015-01-22","1","","1");
INSERT INTO ln_account_name VALUES("91","30000006","Paid-in Capital","Paid-in Capital","","","1","3","88","0","0.000","2015-01-22","1","","1");
INSERT INTO ln_account_name VALUES("92","011","Equity-Retained Earnings","Equity-Retained Earnings","","","2","3","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("93","30000007","Retained Earnings","Retained Earnings","","","1","3","92","0","0.000","2015-01-22","1","","1");
INSERT INTO ln_account_name VALUES("95","013","Equity-gets closed","Equity-gets closed","","","2","3","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("96","30000008","Dividends Paid","Dividends Paid","","","1","3","95","0","0.000","2015-01-22","1","","1");
INSERT INTO ln_account_name VALUES("97","014","Income","Income","","","2","4","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("98","40000003","Other Income","Other Income","","","2","5","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("99","40000013","Freight Income","Freight Income","","","2","4","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("100","40000015","Income Summary","Income Summary","","","2","4","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("101","40000016","Service Charge","Service Charge","","","2","4","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("102","014","Expenses","Expenses","","","2","5","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("103","015","Administrtive Expesne","Administrtive Expesne","","","2","5","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("104","60000004","Sale Incentive","Sale Incentive","","","2","5","0","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("106","60000011","Penalties and Fines Exp","Penalties and Fines Exp","","","2","5","103","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("107","60000011","Penalties and Fines Exp","Penalties and Fines Exp","","","2","5","103","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("108","60000010","Maintenance Expense","Maintenance Expense","","","2","5","103","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("109","016","Operation Expense","Operation Expense","","","2","5","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("110","60000019","Commissions and Fees Exp","Commissions and Fees Exp","","","2","5","0","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("112","60000021","Dues and Subscriptions Exp","Dues and Subscriptions Exp","","","2","5","109","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("113","60000036","Utilities Expense","Utilities Expense","","","2","5","109","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("114","60000034","Supplies Expense","Supplies Expense","","","2","5","109","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("115","016","Payroll Expense","Payroll Expense","","","2","5","0","0","0.000","2015-01-22","1","","3");
INSERT INTO ln_account_name VALUES("116","60000043","Over Time Expense","Over Time Expense","","","2","5","115","0","0.000","2015-01-22","1","","2");
INSERT INTO ln_account_name VALUES("117","60000044","Bonus Expense","Bonus Expense","","","2","5","115","0","0.000","2015-01-22","1","","2");



DROP TABLE ln_accountname_detail;

CREATE TABLE `ln_accountname_detail` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(20) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `dr` tinyint(4) DEFAULT NULL,
  `cr` tinyint(4) DEFAULT NULL,
  `amount` float(13,3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_adjust` tinyint(4) DEFAULT NULL COMMENT '0=not adjust,1=adjust',
  `status` tinyint(4) DEFAULT NULL,
  `tran_type` tinyint(4) DEFAULT NULL COMMENT 'exchange,laon',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_backupschedule;

CREATE TABLE `ln_backupschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `note` text,
  `file_name` varchar(40) DEFAULT NULL,
  `action_type` tinyint(4) DEFAULT NULL COMMENT '1=backup,2restore',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_badloan;

CREATE TABLE `ln_badloan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch` varchar(100) DEFAULT NULL,
  `client_code` varchar(100) DEFAULT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `number_code` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `loss_date` date DEFAULT NULL,
  `cash_type` int(10) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `intrest_amount` varchar(100) DEFAULT NULL,
  `tem` varchar(100) DEFAULT NULL COMMENT '1= writeoff',
  `note` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_badloan VALUES("1","1","1","1","","2015-04-21","2015-04-21","2","916.67","25.21","15","d","1","1");
INSERT INTO ln_badloan VALUES("2","1","0","0","","2015-04-21","2015-04-21","2","1","1","15","s","1","1");



DROP TABLE ln_branch;

CREATE TABLE `ln_branch` (
  `br_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_namekh` varchar(200) DEFAULT NULL,
  `branch_nameen` varbinary(100) DEFAULT NULL,
  `br_address` varchar(100) DEFAULT NULL,
  `branch_code` varchar(100) DEFAULT NULL,
  `branch_tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `displayby` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`br_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ln_branch VALUES("1","???? ???????","Phnom Penh","Phnom Penh","C-001","","","","1","2");
INSERT INTO ln_branch VALUES("2","???? ????????","Battambang","Battambang","C-001","","","","1","2");
INSERT INTO ln_branch VALUES("3","","","","","","","","1","0");
INSERT INTO ln_branch VALUES("4","??????","Takmao","Takmao , Kandal","124566","023 23 23 10","","","1","1");
INSERT INTO ln_branch VALUES("5","?????","Chom Choa","#201, St Rusia ,Kakab, Dongkor  Phnom Penh","C-005","070 41 80022","Info@sokha.com","","1","2");



DROP TABLE ln_branch_capital;

CREATE TABLE `ln_branch_capital` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `amount_dollar` float(18,3) DEFAULT NULL,
  `amount_riel` float(18,3) DEFAULT NULL,
  `amount_bath` float(18,3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_branch_capital VALUES("7","2","","1","100.000","300.000","300.000","2015-01-22","");
INSERT INTO ln_branch_capital VALUES("8","1","1","1","10000.000","1000000.000","400000.000","2015-02-08","");



DROP TABLE ln_callecteral_type;

CREATE TABLE `ln_callecteral_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(50) DEFAULT NULL,
  `title_kh` varbinary(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO ln_callecteral_type VALUES("1","Real Estate Certification Mark","វិញ្ញាបនប័ត្រសម្គាល់អចលនវត្ថុ","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("2","Land Ownership Certificate","លិខិតផ្ទេរកម្មសិទ្ធិដីធ្លី","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("3","National Identity Card","អត្តសញ្ញាណប័ណ្ណសញ្ជាតិខ្មែរ","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("4","Family Book","សៀវភៅគ្រួសារ","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("5","Resident Letter","លិខិតស្នាក់នៅ","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("6","Civil Status","សំបុត្របញ្ជាក់កំណើត","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("7","Driver\'s License","ប័ណ្ណបើកបរ","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("8","Vehicle Credentials","ប័ណ្ណសំគាល់យានយន្ត(កាតគ្រី)","2015-04-09","1","1");
INSERT INTO ln_callecteral_type VALUES("9","test","teqw","2015-02-17","1","1");



DROP TABLE ln_callecteralllist;

CREATE TABLE `ln_callecteralllist` (
  `id` int(22) unsigned NOT NULL AUTO_INCREMENT,
  `branch` int(12) DEFAULT NULL,
  `receipt` varchar(30) DEFAULT NULL,
  `code_call` varchar(20) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type_call` tinyint(4) DEFAULT NULL,
  `owner_call` varchar(50) DEFAULT NULL,
  `callnumber` varchar(20) DEFAULT NULL COMMENT 'numnote??????????',
  `create_date` date DEFAULT NULL,
  `date_debt` date DEFAULT NULL,
  `term` tinyint(4) DEFAULT NULL,
  `amount_term` int(11) DEFAULT NULL,
  `date_line` date DEFAULT NULL,
  `curr_type` tinyint(3) DEFAULT NULL,
  `amount_debt` double(18,2) DEFAULT NULL,
  `note` varchar(43) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_verify` tinyint(4) DEFAULT '0',
  `verify_by` int(11) DEFAULT NULL,
  `is_fund` tinyint(4) DEFAULT '0',
  `term_fun` tinyint(4) DEFAULT NULL,
  `charge_term` int(11) DEFAULT NULL,
  `amount_money` float(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ln_callecteralllist VALUES("1","1","00001","00001","1","1","theary","2","2015-02-06","2015-02-02","1","22","2015-02-06","1","23.00","komphong spur","","","0","","1","","","");
INSERT INTO ln_callecteralllist VALUES("2","1","00002","00002","2","2","sovon","3","2015-02-06","2015-02-03","2","34","2015-02-06","3","45.00","komphong chhnang","","","0","","0","","","");
INSERT INTO ln_callecteralllist VALUES("3","1","00003","00003","3","1","heng","23","2015-02-06","2015-02-06","2","44","2015-02-06","2","54.00","prey veng","","","0","","0","","","");
INSERT INTO ln_callecteralllist VALUES("4","1","00004","00004","3","2","phanet","56","2015-02-06","2015-02-06","3","65","2015-02-06","2","456.00","komphong cham","","","0","","0","","","");
INSERT INTO ln_callecteralllist VALUES("5","1","00005","00005","5","2","dina","23","2015-02-06","2015-02-06","2","34","2015-02-06","1","453.00","pp","","","0","","0","","","");



DROP TABLE ln_change_collecteral;

CREATE TABLE `ln_change_collecteral` (
  `int` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `from_coll_id` int(11) DEFAULT NULL,
  `to_coll_id` int(11) DEFAULT NULL,
  `coll_number` varchar(20) DEFAULT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `with_ownername` varchar(50) DEFAULT NULL,
  `owner_type` tinyint(4) DEFAULT NULL COMMENT '???????????? ????????????',
  `reason` text,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_verify` int(11) DEFAULT NULL,
  `is_closing` tinyint(4) DEFAULT '0',
  `closing_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_changecollteral;

CREATE TABLE `ln_changecollteral` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `collteral_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `owner_code_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `collteral_type` int(11) DEFAULT NULL,
  `number_code` varchar(50) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '1=??????????',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO ln_changecollteral VALUES("24","28","0","1","1","1","0","0","33","","2015-04-13","","1","1");
INSERT INTO ln_changecollteral VALUES("25","28","1","1","1","1","0","1","33","Sok Dara","2015-04-13","","1","1");
INSERT INTO ln_changecollteral VALUES("26","28","1","1","1","1","0","1","8","Sok Dara","2015-04-13","","1","1");



DROP TABLE ln_cheng_colleterall;

CREATE TABLE `ln_cheng_colleterall` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch` int(11) DEFAULT NULL,
  `owner` int(12) DEFAULT NULL,
  `from` int(12) DEFAULT NULL,
  `to` int(13) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_client;

CREATE TABLE `ln_client` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) DEFAULT NULL,
  `is_group` tinyint(4) DEFAULT NULL,
  `group_code` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'group id',
  `client_number` varchar(50) DEFAULT NULL COMMENT 'client_code ,first lenght for branch',
  `name_kh` varchar(150) DEFAULT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `position_id` int(1) DEFAULT NULL,
  `sit_status` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `dis_id` int(11) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `acc_number` varchar(20) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `job` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_nationid` varchar(30) DEFAULT NULL,
  `remark` text,
  `create_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '1',
  `photo_name` varchar(50) DEFAULT NULL,
  `reference` int(11) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1',
  `status_process` tinyint(4) DEFAULT '1' COMMENT '1 padding,2=closed',
  `type` tinyint(4) DEFAULT '1' COMMENT '1 loan, 2=callecterall',
  `is_blacklist` int(11) DEFAULT '0' COMMENT 'is bad client',
  `job_name` varchar(10) DEFAULT NULL,
  `nation_id` varchar(20) DEFAULT NULL,
  `is_verify` tinyint(4) DEFAULT NULL,
  `verify_by` int(11) DEFAULT NULL,
  `reasonblack_list` text,
  `date_blacklist` date DEFAULT NULL,
  `status_blacklist` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO ln_client VALUES("1","","0","","0","000001","??? ????","Sok Dara","2","","1","1","1","1","1","str2","23","","33030303003","","02202002020202","Doctor","","","","","sok ti","","","2015-04-02","1","1","1","","","1","1","1","0","","","","","","2015-04-14","1");
INSERT INTO ln_client VALUES("2","","0","","0","000002","?? ????","Loum Dany","1","","1","1","1","1","1","22","22","","223223222","","23221e12weq","33","","","","","dara","3232","","2015-04-07","1","1","2","","","1","1","1","0","","","","","???????????????????????????","2015-04-14","1");
INSERT INTO ln_client VALUES("3","","0","","0","000003","???????","vichet","1","","1","1","1","1","1","121","21","","111","","12","112","","","","","","","111","2015-04-08","1","1","1","vichet.jpg","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("4","","0","","0","000004","???? ????????","Meas chandaraq","1","","1","1","1","1","2","150","`20","","B3220202","","3433","Teacher","","","","","Vichea","3223222","new client ","2015-04-09","1","1","1","Meas_chandaraq.jpg","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("5","","0","","0","000005","meass\'sso\'/\'\'","dara","1","","1","1","1","1","1","12","12","","","","","","","","","","","","","2015-04-10","1","1","1","","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("6","","1","G000001","0","000006","?? ????","Chea Dara","1","","4","1","1","1","1","230","222","","meas narith","","","Teacher","","","","","","","","2015-04-11","1","1","1","","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("7","","0","","0","000007","?????","Narin","1","","1","1","1","1","1","testing","333","","333","","","","","","","","","","","2015-04-11","1","1","1","","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("8","","0","","0","000008","rith","mease","1","","1","1","1","1","2","testing","33","","333","","","33","","","","","","","","2015-04-11","1","1","1","","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("9","","0","","6","000009","??? ?????????","leang sopheaktra","1","","1","1","1","2","10","33","32","","2323","","3222232","teacher","","","","","","","","2015-04-17","1","1","1","","","1","1","1","0","","","","","","","");
INSERT INTO ln_client VALUES("10","","0","","0","000010","1","1","1","","1","1","1","1","1","","","","","","","","","","","","","","","2015-04-24","1","1","1","","","1","1","1","0","","","","","","","");



DROP TABLE ln_client_callecteral;

CREATE TABLE `ln_client_callecteral` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(40) DEFAULT NULL,
  `changecollteral_id` int(11) DEFAULT NULL COMMENT 'key from change coll',
  `code_call` varchar(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL,
  `getter_name` varbinary(50) DEFAULT NULL,
  `giver_name` varchar(50) DEFAULT NULL,
  `date_delivery` date DEFAULT NULL,
  `client_code` int(11) DEFAULT NULL,
  `number_collteral` varchar(11) NOT NULL,
  `mortgage_Contract` int(11) DEFAULT NULL,
  `client_name` tinyint(4) DEFAULT NULL COMMENT '1=owner,2=????????',
  `with` varchar(50) DEFAULT NULL COMMENT '??????????????????',
  `relativewith` varchar(50) DEFAULT NULL COMMENT '???????????????????????????????????',
  `owner` varchar(40) NOT NULL COMMENT '?????????????????????',
  `withs` varchar(40) DEFAULT NULL COMMENT '?????????????????????',
  `relativewiths` varchar(40) DEFAULT NULL COMMENT '??????????????????????',
  `callate_type` int(11) DEFAULT NULL COMMENT '???????????',
  `note` varchar(60) DEFAULT NULL,
  `date_registration` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_changed` tinyint(4) DEFAULT '0' COMMENT '1=ban change ready,2=return to client ready',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO ln_client_callecteral VALUES("27","2","","CL000004","1","","","","3","22333","","3","","","","","","3","","2015-04-10","1","0","");
INSERT INTO ln_client_callecteral VALUES("28","1","","CL000002","6","","","","1","11","","1","with","","","","","1","","2015-04-13","1","2","");
INSERT INTO ln_client_callecteral VALUES("29","0","24","","","","","","1","33","","1","","","","","","0","","2015-04-13","1","0","1");
INSERT INTO ln_client_callecteral VALUES("30","1","25","","","","","","1","33","","1","","","Sok Dara","","","0","","2015-04-13","1","0","1");
INSERT INTO ln_client_callecteral VALUES("31","1","26","","","","","","1","8","","1","","","Sok Dara","","","0","","2015-04-13","1","0","1");



DROP TABLE ln_client_receipt_money;

CREATE TABLE `ln_client_receipt_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `co_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL COMMENT 'client id or group id',
  `receiver_id` int(10) unsigned DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `loan_number` varchar(50) DEFAULT NULL,
  `date_pay` date DEFAULT NULL,
  `date_input` date DEFAULT NULL,
  `principal_amount` float(18,3) DEFAULT NULL,
  `total_principal_permonth` float(18,3) DEFAULT NULL,
  `total_payment` float(18,3) DEFAULT NULL,
  `total_interest` float(18,3) DEFAULT NULL,
  `recieve_amount` float(18,3) DEFAULT NULL,
  `penalize_amount` float(18,3) DEFAULT NULL,
  `return_amount` float(18,3) DEFAULT NULL,
  `service_charge` float(18,3) DEFAULT NULL,
  `total_discount` float(18,3) DEFAULT NULL,
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  `is_group` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `payment_option` int(11) DEFAULT NULL,
  `currency_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO ln_client_receipt_money VALUES("1","1","1","1","PM-00001","1","00001","2015-04-23","2015-04-23","916.670","83.330","108.330","25.000","108.330","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("2","1","1","1","PM-00002","1","00001","2015-04-23","2015-04-23","833.340","83.330","107.010","23.680","107.010","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("3","1","1","1","PM-00003","1","00001","2015-04-23","2015-04-23","750.010","83.330","104.160","20.830","104.160","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("4","1","1","1","PM-00004","1","00001","2015-04-23","2015-04-23","666.680","83.330","103.960","20.630","103.960","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("5","1","1","1","PM-00005","1","00001","2015-04-24","2015-04-24","583.350","83.330","100.550","17.220","100.550","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("6","1","1","1","PM-00006","1","00001","2015-04-24","2015-04-24","500.020","83.330","98.890","15.560","98.890","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("7","1","1","1","PM-00007","1","00001","2015-04-24","2015-04-24","416.690","83.330","96.250","12.920","100.000","0.000","3.750","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("8","1","1","1","PM-00008","1","00001","2015-04-24","2015-04-24","0.000","416.690","449.260","32.570","449.260","0.000","0.000","0.000","0.000","","1","0","","2","2");
INSERT INTO ln_client_receipt_money VALUES("9","8","5","8","PM-00009","1","00010","2015-04-24","2015-04-24","3000.000","0.000","387.500","387.500","387.500","0.000","0.000","0.000","0.000","","1","0","","2","2");
INSERT INTO ln_client_receipt_money VALUES("10","6","2","6","PM-00010","2","00009","2015-04-26","2015-04-26","3666.670","333.330","433.330","100.000","433.330","0.000","0.000","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("11","6","2","6","PM-00011","2","00009","2015-04-26","2015-04-26","3333.340","333.330","428.050","94.720","430.000","10.000","1.950","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("12","7","4","7","PM-00012","1","00003","2015-04-27","2015-04-27","27500.000","2500.000","3250.000","750.000","3250.000","0.000","0.000","0.000","0.000","","","0","","1","3");
INSERT INTO ln_client_receipt_money VALUES("13","7","5","7","PM-00013","1","00012","2015-05-28","2015-04-28","916.670","83.330","108.330","25.000","110.000","0.000","1.670","0.000","0.000","","1","0","","1","2");
INSERT INTO ln_client_receipt_money VALUES("14","7","5","7","PM-00014","1","00012","2015-06-29","2015-04-28","583.350","333.320","416.440","83.120","416.440","0.000","0.000","0.000","0.000","","1","0","","2","2");



DROP TABLE ln_client_receipt_money_detail;

CREATE TABLE `ln_client_receipt_money_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `crm_id` int(11) DEFAULT NULL COMMENT 'id of client reciept money',
  `lfd_id` int(11) DEFAULT NULL COMMENT 'loan fund detail',
  `client_id` int(10) unsigned DEFAULT NULL,
  `date_payment` date DEFAULT NULL,
  `capital` float(15,2) DEFAULT NULL COMMENT 'capital before fund',
  `remain_capital` float(15,2) DEFAULT NULL,
  `principal_permonth` float(15,2) DEFAULT NULL COMMENT 'principal pay for month',
  `total_interest` float(15,2) DEFAULT NULL,
  `total_payment` float(15,2) DEFAULT NULL COMMENT '????????????????',
  `is_completed` tinyint(4) DEFAULT '0' COMMENT '0=not paid complet ,1=complete,2=over paid',
  `is_verify` tinyint(4) DEFAULT '0',
  `verify_by` tinyint(4) DEFAULT '0',
  `is_closingentry` tinyint(4) DEFAULT '0',
  `currency_id` int(11) DEFAULT NULL,
  `pay_before` varchar(50) DEFAULT NULL,
  `pay_after` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=normal,2=pay before,3=??????????????',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='??????????????????????????????????';

INSERT INTO ln_client_receipt_money_detail VALUES("1","1","1","1","2015-05-22","1000.00","916.67","83.33","25.00","108.33","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("2","2","2","1","2015-06-22","916.67","833.34","83.33","23.68","107.01","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("3","3","3","1","2015-07-22","833.34","750.01","83.33","20.83","104.16","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("4","4","4","1","2015-08-24","750.01","666.68","83.33","20.63","103.96","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("5","5","5","1","2015-09-24","666.68","583.35","83.33","17.22","100.55","1","0","0","0","2","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("6","6","6","1","2015-10-26","583.35","500.02","83.33","15.56","98.89","1","0","0","0","2","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("7","7","7","1","2015-11-26","500.02","416.69","83.33","12.92","96.25","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("8","8","8","1","2015-12-28","416.69","333.36","83.33","11.11","94.44","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("9","8","9","1","2016-01-28","333.36","250.03","83.33","8.61","91.94","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("10","8","10","1","2016-02-29","250.03","166.70","83.33","6.67","90.00","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("11","8","11","1","2016-03-29","166.70","83.37","83.33","4.03","87.36","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("12","8","12","1","2016-04-29","83.37","0.00","83.37","2.15","85.52","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("13","9","127","5","2015-05-22","3000.00","3000.00","0.00","75.00","75.00","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("14","9","128","5","2015-06-22","3000.00","3000.00","0.00","77.50","77.50","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("15","9","129","5","2015-07-22","3000.00","3000.00","0.00","75.00","75.00","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("16","9","130","5","2015-08-24","3000.00","3000.00","0.00","82.50","82.50","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("17","9","131","5","2015-09-24","3000.00","3000.00","0.00","77.50","77.50","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("18","10","115","2","2015-05-22","4000.00","3666.67","333.33","100.00","433.33","1","0","0","0","2","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("19","11","116","2","2015-06-22","3666.67","3333.34","333.33","94.72","428.05","1","0","0","0","2","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("20","12","25","4","2015-04-29","30000.00","27500.00","2500.00","750.00","3250.00","1","0","0","0","3","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("21","13","151","5","2015-05-28","1000.00","916.67","83.33","25.00","108.33","1","0","0","0","2","0","0","1");
INSERT INTO ln_client_receipt_money_detail VALUES("22","14","152","5","2015-06-29","916.67","833.34","83.33","24.44","107.77","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("23","14","153","5","2015-07-29","833.34","750.01","83.33","20.83","104.16","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("24","14","154","5","2015-08-31","750.01","666.68","83.33","20.63","103.96","1","0","0","0","2","0","0","2");
INSERT INTO ln_client_receipt_money_detail VALUES("25","14","155","5","2015-10-01","666.68","583.35","83.33","17.22","100.55","1","0","0","0","2","0","0","2");



DROP TABLE ln_client_reciept;

CREATE TABLE `ln_client_reciept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_pay` date DEFAULT NULL COMMENT 'date client must pay',
  `date` date DEFAULT NULL COMMENT 'date input to system',
  `remain_principal` int(11) DEFAULT NULL COMMENT 'remain before fund',
  `principal_permonth` float(12,2) DEFAULT NULL,
  `interest_rate` float(12,2) DEFAULT NULL,
  `total_payment` float(12,2) DEFAULT NULL COMMENT '????????? ????????',
  `punish_fee` float(12,2) DEFAULT NULL,
  `total_fund` float(12,2) DEFAULT NULL COMMENT '????????? ??????',
  `loan_fundid` int(11) DEFAULT NULL COMMENT '????id ???????????',
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=active,0delete',
  `is_complete` tinyint(4) DEFAULT '1' COMMENT '1=paid,2 not complete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_co;

CREATE TABLE `ln_co` (
  `co_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT '1',
  `position_id` int(11) DEFAULT NULL,
  `co_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_khname` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL COMMENT '1=m,2=f',
  `national_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pob` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'date of birth',
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'current addresss',
  `degree` tinyint(4) DEFAULT NULL COMMENT '1=ba,2=phd',
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `create_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1=kh,2=eng',
  `basic_salary` float(12,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `postion_id` int(11) DEFAULT NULL,
  `contract_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shift` tinyint(4) DEFAULT '1' COMMENT '1=???????,2=????????',
  `workingtime` tinyint(4) DEFAULT '1' COMMENT '1=????????,2=????????,3=???????? ??? ?????????',
  `photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `figer_print_id` varbinary(30) DEFAULT NULL,
  `annual_lives` int(11) DEFAULT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO ln_co VALUES("1","1","1","C001","??? ?????","sarons","","1","33333","phnom penhs","Phnom Penhs","2","0121010101s","mok_channy@yahoo.com","1","0000-00-00","1","1","100.00","2015-01-01","2015-06-17","","44","","1","1","","","","");
INSERT INTO ln_co VALUES("2","1","1","C002","?? ????","dara","chea","2","3444","","Phnom Penh","1","0191919919","darachea@gmail.com","1","0000-00-00","1","1","","","","","","","1","1","","","","");
INSERT INTO ln_co VALUES("5","1","1","C003","SSSS","dd","","1","22222","","","2","","","1","0000-00-00","1","1","","","","","","","1","1","","","","");
INSERT INTO ln_co VALUES("6","1","1","C004","?????","Narith","","1","12345","12345dd","wq2qww","2","0102200202","abc@gmail.com","1","0000-00-00","1","2","","","","","","","1","1","","","","");
INSERT INTO ln_co VALUES("7","1","1","C005","?????","Chear sok","","1","12345","ph,234","phnom penh","2","02020200202","abc@gmail.com","1","0000-00-00","1","2","","","","","","","1","1","","","","");
INSERT INTO ln_co VALUES("8","1","1","C006","??????","abc","","1","555555","PP","PP","2","998552","kh@yahoo.com","1","0000-00-00","1","1","100.00","2014-12-26","2014-12-17","","144","Repay","2","2","","","","");
INSERT INTO ln_co VALUES("9","1","1","C007","?? ????SS","sok chitra","meas","2","22322","","PP","2","0020200202","narith@gmail.com","1","0000-00-00","1","1","","","","","","","1","1","","","","");



DROP TABLE ln_commune;

CREATE TABLE `ln_commune` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` tinyint(10) NOT NULL,
  `commune_name` varchar(60) NOT NULL,
  `commune_namekh` varchar(60) DEFAULT NULL,
  `modify_date` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1=kh,2=eng',
  `branch_id` int(11) DEFAULT '1',
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO ln_commune VALUES("1","1","Tonle Bassak","Tonle Bassak","Apr 7, 2015 3:33:31 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("2","1","Boeng Keng Kang I","Boeng Keng Kang I","Apr 7, 2015 3:33:46 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("3","1","Boeng Keng Kang II","Boeng Keng Kang II","Apr 7, 2015 3:34:26 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("4","1","Boeng Keng Kang III","Boeng Keng Kang III","Apr 7, 2015 3:39:14 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("5","1","Boeng Trabek","Boeng Trabek","Apr 7, 2015 3:38:57 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("6","1","Tumnup Tuk","Tumnup Tuk","Apr 7, 2015 3:39:40 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("7","1","Phsa Doeum Thkow","Phsa Doeum Thkow","Apr 7, 2015 3:39:56 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("8","1","Toul Svay Prey I","Toul Svay Prey I","Apr 7, 2015 3:40:08 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("9","1","Toul Svay Prey II","Toul Svay Prey II","Apr 7, 2015 3:40:24 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("10","1","Toul Tum Poung I","Toul Tum Poung I","Apr 7, 2015 3:40:38 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("11","1","Toul Tum Poung II","Toul Tum Poung II","Apr 7, 2015 3:40:51 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("12","1","Olympik","Olympik","Apr 7, 2015 3:41:03 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("13","2","Srah Chak","Srah Chak","Apr 7, 2015 3:41:46 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("14","2","Wat Phnom","Wat Phnom","Apr 7, 2015 3:42:01 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("15","2","Phsah Chas","Phsah Chas","Apr 7, 2015 3:42:17 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("16","2","Phsah Kandal I","Phsah Kandal I","Apr 7, 2015 3:42:30 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("17","2","Phsah Kandal II","Phsah Kandal II","Apr 7, 2015 3:42:45 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("18","2","Chey Chomneas","Chey Chomneas","Apr 7, 2015 3:43:18 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("19","2","Chaktomuk","Chaktomuk","Apr 7, 2015 3:43:30 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("20","2","Phsah Thmey I","Phsah Thmey I","Apr 7, 2015 3:43:44 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("21","2","Phsah Thmey II","Phsah Thmey II","Apr 7, 2015 3:43:56 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("22","2","Phsah Thmey III","Phsah Thmey III","Apr 7, 2015 3:44:16 PM","1","1","1","1");
INSERT INTO ln_commune VALUES("23","2","Boeng Raing","Boeng Raing","Apr 7, 2015 3:44:34 PM","1","1","1","1");



DROP TABLE ln_currency;

CREATE TABLE `ln_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curr_namekh` varchar(255) DEFAULT NULL,
  `curr_nameen` varchar(120) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1kh,2=en',
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=active,0deactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ln_currency VALUES("2","??????","Dollar","$","","1","1");
INSERT INTO ln_currency VALUES("1","???","Riel","R","","2","1");
INSERT INTO ln_currency VALUES("3","???","Bath","B","","3","1");



DROP TABLE ln_current_capital;

CREATE TABLE `ln_current_capital` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `currency_type` tinyint(4) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_department;

CREATE TABLE `ln_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_kh` varchar(100) DEFAULT NULL,
  `department_en` varchar(100) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `displayby` tinyint(15) DEFAULT '1' COMMENT '1 khmer ,2 english',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=??????????, 0=?????????????',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_department VALUES("1","???????","Accountant","2015-02-06","1","0","1");
INSERT INTO ln_department VALUES("2","?????????????","IT","2015-02-06","1","1","1");



DROP TABLE ln_displayby;

CREATE TABLE `ln_displayby` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayby_en` varchar(40) DEFAULT NULL,
  `displayby_kh` varchar(40) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `displayby` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_displayby VALUES("1","Khmer Title","","1","1");
INSERT INTO ln_displayby VALUES("2","English Title","","1","1");



DROP TABLE ln_district;

CREATE TABLE `ln_district` (
  `dis_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` tinyint(10) DEFAULT NULL,
  `district_name` varchar(60) DEFAULT NULL,
  `district_namekh` varchar(60) DEFAULT NULL,
  `modify_date` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL COMMENT '1=kh,2=en',
  `branch_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ln_district VALUES("1","1","Chamkarmon","Chamkarmon","Apr 7, 2015 3:30:10 PM","1","1","1","");
INSERT INTO ln_district VALUES("2","1","Daun Penh","Daun Penh","Apr 7, 2015 3:30:34 PM","1","1","1","");
INSERT INTO ln_district VALUES("3","1","7 Makara","7 Makara","Apr 7, 2015 3:30:51 PM","1","1","1","");
INSERT INTO ln_district VALUES("4","1","Toul Kork","Toul Kork","Apr 7, 2015 3:31:05 PM","1","1","1","");
INSERT INTO ln_district VALUES("5","1","Dangkor","Dangkor","Apr 7, 2015 3:31:15 PM","1","1","1","");
INSERT INTO ln_district VALUES("6","1","Meanchey","Meanchey","Apr 7, 2015 3:31:26 PM","1","1","1","");
INSERT INTO ln_district VALUES("7","1","Russey Keo","Russey Keo","Apr 7, 2015 3:31:35 PM","1","1","1","");
INSERT INTO ln_district VALUES("8","1","Sen Sok","Sen Sok","Apr 7, 2015 3:31:46 PM","1","1","1","");
INSERT INTO ln_district VALUES("9","1","Por Sen Chey","Por Sen Chey","Apr 7, 2015 3:31:54 PM","1","1","1","");
INSERT INTO ln_district VALUES("10","1","Chbar Ampov","Chbar Ampov","Apr 7, 2015 3:32:04 PM","1","1","1","");
INSERT INTO ln_district VALUES("11","1","Chroy Changvar","Chroy Changvar","Apr 7, 2015 3:32:14 PM","1","1","1","");
INSERT INTO ln_district VALUES("12","1","Praek Phnov","Praek Phnov","Apr 7, 2015 3:32:24 PM","1","1","1","");



DROP TABLE ln_exchange;

CREATE TABLE `ln_exchange` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` tinyint(4) DEFAULT NULL,
  `exchange_type` tinyint(4) DEFAULT NULL,
  `is_single` tinyint(4) DEFAULT '1' COMMENT '1 = single,0 multi exchange',
  `receive_dollar` float(15,2) DEFAULT NULL,
  `receive_riel` float(15,2) DEFAULT NULL,
  `receive_bath` float(15,2) DEFAULT NULL,
  `return_dollar` float(10,2) DEFAULT NULL,
  `return_riel` float(10,2) DEFAULT NULL,
  `return_bath` float(10,2) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice_code` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchange VALUES("1","1","1","","22.00","0.00","0.00","0.00","0.00","0.00","1","000001","1","2015-01-11","");



DROP TABLE ln_exchange_detail;

CREATE TABLE `ln_exchange_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exchange_id` int(11) DEFAULT NULL,
  `from_currency_type` varchar(1) DEFAULT NULL,
  `to_currency_type` varchar(1) DEFAULT NULL,
  `from_amount` double DEFAULT NULL,
  `to_amount` double DEFAULT NULL,
  `exchange_rate` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `from_to` varchar(20) DEFAULT NULL COMMENT 'simbal only',
  `specail_customer` tinyint(1) DEFAULT '0' COMMENT '0: normal, 1 : specail customer set new rate',
  `status` tinyint(5) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchange_detail VALUES("1","1","2","3","22","723.8","32.9","2015-01-11","Dollar - Bath","0","1");



DROP TABLE ln_exchangerate;

CREATE TABLE `ln_exchangerate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we take from customer',
  `out_cur_id` int(11) DEFAULT NULL COMMENT 'The Currency that we give to customer',
  `rate_in` double DEFAULT NULL,
  `spread` double DEFAULT NULL,
  `rate_out` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT '1:active; 0:Disactive',
  `is_using` tinyint(4) DEFAULT '1',
  `user_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ln_exchangerate VALUES("1","2","3","32.9","32.95","33","2014-02-03 12:07:58","1","","");
INSERT INTO ln_exchangerate VALUES("2","1","2","3990","4000","4100","2014-02-03 12:07:58","1","","");
INSERT INTO ln_exchangerate VALUES("3","3","1","120.6","120.05","121","2014-02-03 12:07:58","1","","");



DROP TABLE ln_fixed_asset;

CREATE TABLE `ln_fixed_asset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `depre_code` varchar(30) DEFAULT NULL,
  `fixed_assetname` varchar(120) DEFAULT NULL,
  `fixed_asset_type` tinyint(4) DEFAULT NULL COMMENT '1=shortterm,2=longterm',
  `asset_code` varchar(30) DEFAULT NULL,
  `asset_cost` float(15,2) DEFAULT NULL,
  `term_type` tinyint(4) DEFAULT NULL COMMENT 'month or year',
  `usefull_life` float(10,1) DEFAULT NULL,
  `currency_type` tinyint(4) DEFAULT NULL,
  `salvagevalue` float(10,2) DEFAULT NULL,
  `payment_method` float DEFAULT NULL COMMENT '1 Straight line,2 Double-declining banlance,3 Sum of the year',
  `depreciation_start` float DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL COMMENT 'create date',
  `user_id` int(11) DEFAULT NULL COMMENT 'create by',
  `total_amount` float(15,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=use,0unuse',
  `pay_type` tinyint(4) DEFAULT NULL COMMENT '1=cash,2=credit,3=other',
  `some_payamount` float(13,3) DEFAULT NULL COMMENT 'input if choose pay_type = 3',
  `note` varchar(100) DEFAULT NULL,
  `is_sold` tinyint(4) DEFAULT '0' COMMENT '1=has sold',
  `is_depreciate` tinyint(4) DEFAULT '0' COMMENT '??????????',
  `auto_post` tinyint(4) DEFAULT '0' COMMENT '1 = auto post every month',
  `is_verify` tinyint(4) DEFAULT NULL,
  `verify_by` int(11) DEFAULT NULL COMMENT 'by user id ?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO ln_fixed_asset VALUES("1","1","","car","2","1","22.00","","23.0","","24.00","3","2014","0","2014-01-01","","","1","2","34.000","neymar","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("21","1","","land","1","2","56.00","","67.0","","68.00","1","2014","0","2014-01-01","","","1","2","0.000","scra","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("22","1","","moto","2","8","78.00","","98.0","","67.00","2","2014","0","2014-01-01","","","1","2","0.000","dara","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("23","2","","toyota","1","78","34.00","","23.0","","12.00","1","2014","0","2014-01-01","","","1","1","0.000","serymon","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("24","1","","bratho","1","12","34.00","","55.0","","56.00","1","2014","0","2014-01-01","","","1","1","0.000","ronadol","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("25","1","","money","1","12","455.00","","566.0","","123.00","1","2014","0","2014-01-01","","","1","1","0.000","ravy","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("26","1","","dojo","2","666","2344.00","","1234545.0","","345656.00","2","2014","0","2014-01-01","","","1","2","222.000","bale","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("27","1","","land","2","325436","12345.00","","3455.0","","345456.00","1","2014","0","2014-01-01","","","1","1","1234.000","isco","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("28","1","","house","1","655","7889.00","","2334.0","","3455.00","1","2014","0","2014-01-01","","","1","1","0.000","marcello","0","0","0","","");
INSERT INTO ln_fixed_asset VALUES("29","1","","departemnet","1","234","2234.00","","12344.0","","5667.00","3","2014","0","2014-01-01","","","1","1","1233.000","hongda","0","0","0","","");



DROP TABLE ln_fixed_asset_preposal;

CREATE TABLE `ln_fixed_asset_preposal` (
  `id` int(11) DEFAULT NULL,
  `fixed_asset_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_sold` date DEFAULT NULL,
  `status` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `receipt_type` tinyint(4) DEFAULT '1' COMMENT '1=cash,2=credit,3=other',
  `amount` float(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_fixed_assetdetail;

CREATE TABLE `ln_fixed_assetdetail` (
  `int` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) DEFAULT NULL,
  `total_depre` float(13,2) DEFAULT NULL,
  `times_depre` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `note` text,
  `for_month` int(11) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `is_verify` tinyint(4) DEFAULT '0',
  `verify_by` int(11) DEFAULT NULL,
  `is_closing` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='????? ?????';




DROP TABLE ln_holiday;

CREATE TABLE `ln_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(150) DEFAULT NULL,
  `amount_day` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `modify_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_holiday VALUES("4","Happy New Year 2015","1","2015-03-01","2015-03-03","1","2014-12-31","1","","Stop for khmer New Year");
INSERT INTO ln_holiday VALUES("5","Happy New Year 2015","1","2015-01-01","2015-01-15","","","","","");
INSERT INTO ln_holiday VALUES("6","Happy New Year 2015","1","2015-01-01","","","","","","");
INSERT INTO ln_holiday VALUES("7","","","2015-01-01","","","","","","");
INSERT INTO ln_holiday VALUES("8","Khmer New Year ","3","2015-04-14","2015-04-17","1","2015-04-07","1","","1");



DROP TABLE ln_income_expense;

CREATE TABLE `ln_income_expense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `total_amount` float(12,2) DEFAULT NULL,
  `fordate` int(11) DEFAULT NULL COMMENT '1to 12',
  `disc` text,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1use,1unuse',
  `user_id` int(11) DEFAULT NULL,
  `tran_type` tinyint(4) DEFAULT NULL COMMENT '1 expense,2 income',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_journal;

CREATE TABLE `ln_journal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `receipt_number` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `from_location` int(11) DEFAULT '1' COMMENT '1=disburse,2=recieve,3xchange,4 collecteral,5payment collecteral,6 add capital,7=transfer capital',
  `is_adjust` tinyint(4) DEFAULT '0',
  `client_id` int(11) DEFAULT NULL,
  `is_direct` int(11) DEFAULT '0' COMMENT '1 = input ,0 auto',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO ln_journal VALUES("13","2","00001","2015-04-04","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("14","2","00002","2015-04-18","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("15","2","00003","2015-04-15","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("18","1","00001","2015-04-15","2015-04-15","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("26","2","00004","2015-04-15","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("27","2","00001","2015-04-15","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("28","2","00002","2015-04-15","2015-04-15","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("29","1","00001","2015-04-16","2015-04-16","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("30","1","00001","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("31","1","00002","2015-01-06","2015-04-17","from loan disburse","1","1","1","0","3","0");
INSERT INTO ln_journal VALUES("32","1","00003","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","4","0");
INSERT INTO ln_journal VALUES("33","1","00004","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","5","0");
INSERT INTO ln_journal VALUES("34","1","00006","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","8","0");
INSERT INTO ln_journal VALUES("35","1","00007","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","7","0");
INSERT INTO ln_journal VALUES("36","1","00008","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","6","0");
INSERT INTO ln_journal VALUES("37","1","00009","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","7","0");
INSERT INTO ln_journal VALUES("38","1","00010","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","4","0");
INSERT INTO ln_journal VALUES("39","2","00011","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("40","1","00012","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","7","0");
INSERT INTO ln_journal VALUES("41","2","00013","2015-04-17","2015-04-17","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("42","1","00001","2015-04-20","2015-04-20","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("43","1","00001","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("44","1","00001","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("45","1","00002","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","3","0");
INSERT INTO ln_journal VALUES("46","1","00003","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","4","0");
INSERT INTO ln_journal VALUES("47","1","00004","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","9","0");
INSERT INTO ln_journal VALUES("48","1","00005","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","8","0");
INSERT INTO ln_journal VALUES("49","1","00006","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","6","0");
INSERT INTO ln_journal VALUES("50","1","00007","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","7","0");
INSERT INTO ln_journal VALUES("51","1","00008","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","3","0");
INSERT INTO ln_journal VALUES("52","2","00009","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","2","0");
INSERT INTO ln_journal VALUES("53","1","00010","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","5","0");
INSERT INTO ln_journal VALUES("54","1","00011","2015-04-22","2015-04-22","from loan disburse","1","1","1","0","1","0");
INSERT INTO ln_journal VALUES("55","1","00012","2015-04-28","2015-04-28","from loan disburse","1","1","1","0","5","0");



DROP TABLE ln_journal_detail;

CREATE TABLE `ln_journal_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jur_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `account_type` tinyint(4) DEFAULT '1' COMMENT '1=debit ,2 credit',
  `is_increase` tinyint(4) DEFAULT '0',
  `currency_type` tinyint(4) DEFAULT NULL,
  `balance` float(13,3) DEFAULT '0.000',
  `is_adjust` tinyint(4) DEFAULT '0' COMMENT '0=not adjust,1=adjust',
  `status` tinyint(4) DEFAULT '1',
  `tran_type` tinyint(4) DEFAULT '1' COMMENT '1=disburse,2=recieve,3xchange,4 collecteral,5payment collecteral',
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8;

INSERT INTO ln_journal_detail VALUES("49","13","2","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("50","13","2","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("51","13","2","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("52","13","2","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("53","14","2","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("54","14","2","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("55","14","2","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("56","14","2","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("57","15","2","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("58","15","2","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("59","15","2","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("60","15","2","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("69","18","1","1","1","1","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("70","18","1","2","2","0","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("71","18","1","2","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("72","18","1","3","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("101","26","2","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("102","26","2","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("103","26","2","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("104","26","2","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("105","27","2","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("106","27","2","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("107","27","2","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("108","27","2","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("109","28","2","1","1","1","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("110","28","2","2","2","0","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("111","28","2","2","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("112","28","2","3","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("113","29","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("114","29","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("115","29","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("116","29","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("117","30","1","1","1","1","2","1500.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("118","30","1","2","2","0","2","1500.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("119","30","1","2","2","1","2","1500.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("120","30","1","3","2","1","2","1500.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("121","31","1","1","1","1","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("122","31","1","2","2","0","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("123","31","1","2","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("124","31","1","3","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("125","32","1","1","1","1","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("126","32","1","2","2","0","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("127","32","1","2","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("128","32","1","3","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("129","33","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("130","33","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("131","33","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("132","33","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("133","34","1","1","1","1","2","3000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("134","34","1","2","2","0","2","3000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("135","34","1","2","2","1","2","3000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("136","34","1","3","2","1","2","3000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("137","35","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("138","35","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("139","35","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("140","35","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("141","36","1","1","1","1","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("142","36","1","2","2","0","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("143","36","1","2","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("144","36","1","3","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("145","37","1","1","1","1","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("146","37","1","2","2","0","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("147","37","1","2","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("148","37","1","3","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("149","38","1","1","1","1","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("150","38","1","2","2","0","2","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("151","38","1","2","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("152","38","1","3","2","1","2","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("153","39","2","1","1","1","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("154","39","2","2","2","0","1","1000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("155","39","2","2","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("156","39","2","3","2","1","1","1000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("157","40","1","1","1","1","2","3000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("158","40","1","2","2","0","2","3000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("159","40","1","2","2","1","2","3000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("160","40","1","3","2","1","2","3000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("161","41","2","1","1","1","1","3000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("162","41","2","2","2","0","1","3000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("163","41","2","2","2","1","1","3000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("164","41","2","3","2","1","1","3000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("165","42","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("166","42","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("167","42","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("168","42","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("169","43","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("170","43","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("171","43","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("172","43","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("173","44","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("174","44","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("175","44","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("176","44","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("177","45","1","1","1","1","1","2000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("178","45","1","2","2","0","1","2000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("179","45","1","2","2","1","1","2000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("180","45","1","3","2","1","1","2000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("181","46","1","1","1","1","3","30000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("182","46","1","2","2","0","3","30000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("183","46","1","2","2","1","3","30000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("184","46","1","3","2","1","3","30000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("185","47","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("186","47","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("187","47","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("188","47","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("189","48","1","1","1","1","2","2000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("190","48","1","2","2","0","2","2000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("191","48","1","2","2","1","2","2000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("192","48","1","3","2","1","2","2000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("193","49","1","1","1","1","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("194","49","1","2","2","0","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("195","49","1","2","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("196","49","1","3","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("197","50","1","1","1","1","1","20000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("198","50","1","2","2","0","1","20000000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("199","50","1","2","2","1","1","20000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("200","50","1","3","2","1","1","20000000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("201","51","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("202","51","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("203","51","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("204","51","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("205","52","2","1","1","1","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("206","52","2","2","2","0","2","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("207","52","2","2","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("208","52","2","3","2","1","2","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("209","53","1","1","1","1","2","3000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("210","53","1","2","2","0","2","3000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("211","53","1","2","2","1","2","3000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("212","53","1","3","2","1","2","3000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("213","54","1","1","1","1","3","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("214","54","1","2","2","0","3","4000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("215","54","1","2","2","1","3","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("216","54","1","3","2","1","3","4000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("217","55","1","1","1","1","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("218","55","1","2","2","0","2","1000.000","0","1","1","");
INSERT INTO ln_journal_detail VALUES("219","55","1","2","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");
INSERT INTO ln_journal_detail VALUES("220","55","1","3","2","1","2","1000.000","0","1","1","Admin fee from disburse loan ");



DROP TABLE ln_loan_group;

CREATE TABLE `ln_loan_group` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(20) DEFAULT '1' COMMENT '?????? ???????????????',
  `group_id` int(11) DEFAULT NULL COMMENT '?????????? =client id of group',
  `co_id` int(11) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `date_line` date DEFAULT NULL COMMENT 'life of loan',
  `create_date` date DEFAULT NULL,
  `total_duration` int(11) DEFAULT NULL COMMENT '??????????',
  `first_payment` date DEFAULT NULL,
  `time_collect` varchar(30) DEFAULT NULL,
  `collect_typeterm` tinyint(4) DEFAULT NULL,
  `pay_term` tinyint(4) DEFAULT NULL COMMENT '1=day,2=month',
  `payment_method` int(11) DEFAULT NULL,
  `holiday` tinyint(4) DEFAULT NULL,
  `is_renew` tinyint(4) DEFAULT '0' COMMENT '0=old list,1=new list',
  `branch_id` int(11) DEFAULT '1',
  `loan_type` tinyint(4) DEFAULT '1' COMMENT '1=individule,2=group',
  `status` tinyint(4) DEFAULT '1' COMMENT '0 deactive ,1 active ,2 complated',
  `is_verify` tinyint(4) DEFAULT '0',
  `is_badloan` tinyint(4) DEFAULT '0',
  `teller_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ln_loan_group VALUES("1","1","1","1","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("2","1","3","7","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("3","1","4","7","1","2015-04-22","2015-07-15","2015-04-22","12","2015-04-29","10:00-11:00 AM","2","2","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("4","1","9","8","1","2015-04-22","2015-05-22","2015-04-22","30","2015-04-23","10:00-11:00 AM","1","1","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("5","1","8","7","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("6","1","6","5","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("7","1","7","6","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("8","2","3","2","1","2015-04-22","2015-07-15","2015-04-22","12","2015-04-29","10:00-11:00 AM","2","2","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("9","1","2","6","5","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","2","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("10","1","5","8","6","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","2","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("11","2","1","8","1","2015-04-22","2016-04-22","2015-04-22","12","2015-05-22","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");
INSERT INTO ln_loan_group VALUES("12","2","5","7","10","2015-04-28","2016-04-28","2015-04-28","12","2015-05-28","10:00-11:00 AM","3","3","1","2","0","1","1","1","0","0","");



DROP TABLE ln_loan_member;

CREATE TABLE `ln_loan_member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chart_id` int(11) DEFAULT NULL COMMENT 'from chart account 1',
  `group_id` int(11) DEFAULT NULL,
  `loan_number` varchar(20) DEFAULT NULL COMMENT 'first is branch then 5',
  `client_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `currency_type` tinyint(4) DEFAULT NULL COMMENT '1=khmer ,2=dollar',
  `total_capital` float(15,2) DEFAULT NULL,
  `admin_fee` float(15,2) DEFAULT NULL,
  `collect_typeterm` tinyint(4) DEFAULT NULL,
  `interest_rate` float(10,2) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `branch_id` int(11) unsigned DEFAULT '1',
  `loan_cycle` tinyint(4) DEFAULT '0' COMMENT '1= is loan cycle,0 not loan cycle',
  `loan_purpose` text,
  `pay_before` varchar(30) DEFAULT '0' COMMENT '??????????????',
  `pay_after` varchar(30) DEFAULT '0' COMMENT '??????????????',
  `graice_period` int(11) DEFAULT '0',
  `amount_collect_principal` float(15,2) DEFAULT NULL,
  `show_barcode` tinyint(4) DEFAULT '0' COMMENT '1 show,0 not show',
  `is_completed` tinyint(4) DEFAULT '0' COMMENT '0 yet,1 complete,2=some fund',
  `semi` int(11) DEFAULT '1' COMMENT '?????????????????????? ?? ????????????????????????',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ln_loan_member VALUES("1","","1","00001","1","1","2","1000.00","10.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("2","","2","00002","3","1","1","2000000.00","20000.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("3","","3","00003","4","1","3","30000.00","300.00","2","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("4","","4","00004","9","1","2","1000.00","10.00","1","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("5","","5","00005","8","1","2","2000.00","20.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("6","","6","00006","6","1","2","4000.00","40.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("7","","7","00007","7","1","1","20000000.00","200000.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("8","","8","00008","3","1","2","1000.00","10.00","2","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("9","","9","00009","2","1","2","4000.00","40.00","3","2.50","1","2","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("10","","10","00010","5","2","2","3000.00","30.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("11","","11","00011","1","1","3","4000.00","40.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");
INSERT INTO ln_loan_member VALUES("12","","12","00012","5","1","2","1000.00","10.00","3","2.50","1","1","0","","0","0","0","1.00","0","0","0");



DROP TABLE ln_loanmember_funddetail;

CREATE TABLE `ln_loanmember_funddetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `total_principal` float(15,2) DEFAULT NULL,
  `principal_permonth` float(15,2) DEFAULT NULL,
  `total_interest` float(15,2) DEFAULT NULL,
  `total_payment` float(15,2) DEFAULT NULL,
  `amount_day` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `is_completed` tinyint(4) DEFAULT '0' COMMENT '0=not complete,1=complete,2=in progress',
  `is_approved` tinyint(4) DEFAULT '0' COMMENT '1=approved paycomplete,not yet',
  `date_payment` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `collect_by` int(11) DEFAULT '1' COMMENT '?????????????',
  `payment_option` tinyint(4) DEFAULT NULL COMMENT '1=normal,2=before,3=after',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

INSERT INTO ln_loanmember_funddetail VALUES("1","1","1000.00","83.33","25.00","108.33","30","1","1","0","2015-05-22","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("2","1","916.67","83.33","23.68","107.01","31","1","1","0","2015-06-22","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("3","1","833.34","83.33","20.83","104.16","30","1","1","0","2015-07-22","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("4","1","750.01","83.33","20.63","103.96","33","1","1","0","2015-08-24","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("5","1","666.68","83.33","17.22","100.55","31","1","1","0","2015-09-24","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("6","1","583.35","83.33","15.56","98.89","32","1","1","0","2015-10-26","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("7","1","500.02","83.33","12.92","96.25","31","1","1","0","2015-11-26","1","1","1");
INSERT INTO ln_loanmember_funddetail VALUES("8","1","416.69","83.33","11.11","94.44","32","1","0","0","2015-12-28","1","1","");
INSERT INTO ln_loanmember_funddetail VALUES("9","1","333.36","83.33","8.61","91.94","31","1","0","0","2016-01-28","1","1","");
INSERT INTO ln_loanmember_funddetail VALUES("10","1","250.03","83.33","6.67","90.00","32","1","0","0","2016-02-29","1","1","");
INSERT INTO ln_loanmember_funddetail VALUES("11","1","166.70","83.33","4.03","87.36","29","1","0","0","2016-03-29","1","1","");
INSERT INTO ln_loanmember_funddetail VALUES("12","1","83.37","83.37","2.15","85.52","31","1","0","0","2016-04-29","1","1","");
INSERT INTO ln_loanmember_funddetail VALUES("13","2","2000000.00","166700.00","50000.00","216700.00","30","1","0","0","2015-05-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("14","2","1833300.00","166700.00","47400.00","214100.00","31","1","0","0","2015-06-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("15","2","1666600.00","166700.00","41700.00","208400.00","30","1","0","0","2015-07-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("16","2","1499900.00","166700.00","41300.00","208000.00","33","1","0","0","2015-08-24","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("17","2","1333200.00","166700.00","34500.00","201200.00","31","1","0","0","2015-09-24","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("18","2","1166500.00","166700.00","31200.00","197900.00","32","1","0","0","2015-10-26","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("19","2","999800.00","166700.00","25900.00","192600.00","31","1","0","0","2015-11-26","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("20","2","833100.00","166700.00","22300.00","189000.00","32","1","0","0","2015-12-28","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("21","2","666400.00","166700.00","17300.00","184000.00","31","1","0","0","2016-01-28","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("22","2","499700.00","166700.00","13400.00","180100.00","32","1","0","0","2016-02-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("23","2","333000.00","166700.00","8100.00","174800.00","29","1","0","0","2016-03-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("24","2","166300.00","166300.00","4300.00","170600.00","31","1","0","0","2016-04-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("25","3","30000.00","2500.00","750.00","3250.00","7","1","1","0","2015-04-29","1","7","1");
INSERT INTO ln_loanmember_funddetail VALUES("26","3","27500.00","2500.00","687.50","3187.50","7","1","0","0","2015-05-06","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("27","3","25000.00","2500.00","625.00","3125.00","7","1","0","0","2015-05-13","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("28","3","22500.00","2500.00","562.50","3062.50","7","1","0","0","2015-05-20","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("29","3","20000.00","2500.00","500.00","3000.00","7","1","0","0","2015-05-27","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("30","3","17500.00","2500.00","437.50","2937.50","7","1","0","0","2015-06-03","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("31","3","15000.00","2500.00","375.00","2875.00","7","1","0","0","2015-06-10","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("32","3","12500.00","2500.00","312.50","2812.50","7","1","0","0","2015-06-17","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("33","3","10000.00","2500.00","250.00","2750.00","7","1","0","0","2015-06-24","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("34","3","7500.00","2500.00","187.50","2687.50","7","1","0","0","2015-07-01","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("35","3","5000.00","2500.00","125.00","2625.00","7","1","0","0","2015-07-08","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("36","3","2500.00","2500.00","62.50","2562.50","7","1","0","0","2015-07-15","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("37","4","1000.00","33.33","25.00","58.33","1","1","0","0","2015-04-23","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("38","4","966.67","33.33","24.17","57.50","1","1","0","0","2015-04-24","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("39","4","933.34","33.33","70.00","103.33","3","1","0","0","2015-04-27","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("40","4","900.01","33.33","22.50","55.83","1","1","0","0","2015-04-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("41","4","866.68","33.33","21.67","55.00","1","1","0","0","2015-04-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("42","4","833.35","33.33","20.83","54.16","1","1","0","0","2015-04-30","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("43","4","800.02","33.33","20.00","53.33","1","1","0","0","2015-05-01","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("44","4","766.69","33.33","57.50","90.83","3","1","0","0","2015-05-04","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("45","4","733.36","33.33","18.33","51.66","1","1","0","0","2015-05-05","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("46","4","700.03","33.33","17.50","50.83","1","1","0","0","2015-05-06","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("47","4","666.70","33.33","16.67","50.00","1","1","0","0","2015-05-07","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("48","4","633.37","33.33","15.83","49.16","1","1","0","0","2015-05-08","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("49","4","600.04","33.33","45.00","78.33","3","1","0","0","2015-05-11","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("50","4","566.71","33.33","14.17","47.50","1","1","0","0","2015-05-12","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("51","4","533.38","33.33","13.33","46.66","1","1","0","0","2015-05-13","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("52","4","500.05","33.33","12.50","45.83","1","1","0","0","2015-05-14","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("53","4","466.72","33.33","11.67","45.00","1","1","0","0","2015-05-15","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("54","4","433.39","33.33","32.50","65.83","3","1","0","0","2015-05-18","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("55","4","400.06","33.33","10.00","43.33","1","1","0","0","2015-05-19","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("56","4","366.73","33.33","9.17","42.50","1","1","0","0","2015-05-20","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("57","4","333.40","33.33","8.33","41.66","1","1","0","0","2015-05-21","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("58","4","300.07","33.33","7.50","40.83","1","1","0","0","2015-05-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("59","4","266.74","33.33","20.01","53.34","3","1","0","0","2015-05-25","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("60","4","233.41","33.33","5.84","39.17","1","1","0","0","2015-05-26","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("61","4","200.08","33.33","5.00","38.33","1","1","0","0","2015-05-27","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("62","4","166.75","33.33","4.17","37.50","1","1","0","0","2015-05-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("63","4","133.42","33.33","3.34","36.67","1","1","0","0","2015-05-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("64","4","100.09","33.33","7.51","40.84","3","1","0","0","2015-06-01","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("65","4","66.76","33.33","1.67","35.00","1","1","0","0","2015-06-02","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("66","4","33.43","33.43","0.84","34.27","1","1","0","0","2015-06-03","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("67","5","2000.00","166.67","50.00","216.67","30","1","0","0","2015-05-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("68","5","1833.33","166.67","47.36","214.03","31","1","0","0","2015-06-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("69","5","1666.66","166.67","41.67","208.34","30","1","0","0","2015-07-22","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("70","5","1499.99","166.67","41.25","207.92","33","1","0","0","2015-08-24","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("71","5","1333.32","166.67","34.44","201.11","31","1","0","0","2015-09-24","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("72","5","1166.65","166.67","31.11","197.78","32","1","0","0","2015-10-26","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("73","5","999.98","166.67","25.83","192.50","31","1","0","0","2015-11-26","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("74","5","833.31","166.67","22.22","188.89","32","1","0","0","2015-12-28","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("75","5","666.64","166.67","17.22","183.89","31","1","0","0","2016-01-28","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("76","5","499.97","166.67","13.33","180.00","32","1","0","0","2016-02-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("77","5","333.30","166.67","8.05","174.72","29","1","0","0","2016-03-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("78","5","166.63","166.63","4.30","170.93","31","1","0","0","2016-04-29","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("79","6","4000.00","333.33","100.00","433.33","30","1","0","0","2015-05-22","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("80","6","3666.67","333.33","94.72","428.05","31","1","0","0","2015-06-22","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("81","6","3333.34","333.33","83.33","416.66","30","1","0","0","2015-07-22","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("82","6","3000.01","333.33","82.50","415.83","33","1","0","0","2015-08-24","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("83","6","2666.68","333.33","68.89","402.22","31","1","0","0","2015-09-24","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("84","6","2333.35","333.33","62.22","395.55","32","1","0","0","2015-10-26","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("85","6","2000.02","333.33","51.67","385.00","31","1","0","0","2015-11-26","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("86","6","1666.69","333.33","44.45","377.78","32","1","0","0","2015-12-28","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("87","6","1333.36","333.33","34.45","367.78","31","1","0","0","2016-01-28","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("88","6","1000.03","333.33","26.67","360.00","32","1","0","0","2016-02-29","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("89","6","666.70","333.33","16.11","349.44","29","1","0","0","2016-03-29","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("90","6","333.37","333.37","8.61","341.98","31","1","0","0","2016-04-29","1","5","");
INSERT INTO ln_loanmember_funddetail VALUES("91","7","20000000.00","1666700.00","500000.00","2166700.00","30","1","0","0","2015-05-22","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("92","7","18333300.00","1666700.00","473700.00","2140400.00","31","1","0","0","2015-06-22","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("93","7","16666600.00","1666700.00","416700.00","2083400.00","30","1","0","0","2015-07-22","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("94","7","14999900.00","1666700.00","412500.00","2079200.00","33","1","0","0","2015-08-24","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("95","7","13333200.00","1666700.00","344500.00","2011200.00","31","1","0","0","2015-09-24","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("96","7","11666500.00","1666700.00","311200.00","1977900.00","32","1","0","0","2015-10-26","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("97","7","9999800.00","1666700.00","258400.00","1925100.00","31","1","0","0","2015-11-26","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("98","7","8333100.00","1666700.00","222300.00","1889000.00","32","1","0","0","2015-12-28","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("99","7","6666400.00","1666700.00","172300.00","1839000.00","31","1","0","0","2016-01-28","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("100","7","4999700.00","1666700.00","133400.00","1800100.00","32","1","0","0","2016-02-29","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("101","7","3333000.00","1666700.00","80600.00","1747300.00","29","1","0","0","2016-03-29","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("102","7","1666300.00","1666300.00","43100.00","1709400.00","31","1","0","0","2016-04-29","1","6","");
INSERT INTO ln_loanmember_funddetail VALUES("103","8","1000.00","83.33","25.00","108.33","7","1","0","0","2015-04-29","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("104","8","916.67","83.33","22.92","106.25","7","1","0","0","2015-05-06","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("105","8","833.34","83.33","20.83","104.16","7","1","0","0","2015-05-13","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("106","8","750.01","83.33","18.75","102.08","7","1","0","0","2015-05-20","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("107","8","666.68","83.33","16.67","100.00","7","1","0","0","2015-05-27","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("108","8","583.35","83.33","14.58","97.91","7","1","0","0","2015-06-03","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("109","8","500.02","83.33","12.50","95.83","7","1","0","0","2015-06-10","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("110","8","416.69","83.33","10.42","93.75","7","1","0","0","2015-06-17","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("111","8","333.36","83.33","8.33","91.66","7","1","0","0","2015-06-24","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("112","8","250.03","83.33","6.25","89.58","7","1","0","0","2015-07-01","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("113","8","166.70","83.33","4.17","87.50","7","1","0","0","2015-07-08","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("114","8","83.37","83.37","2.08","85.45","7","1","0","0","2015-07-15","1","2","");
INSERT INTO ln_loanmember_funddetail VALUES("115","9","4000.00","333.33","100.00","433.33","30","1","1","0","2015-05-22","2","6","1");
INSERT INTO ln_loanmember_funddetail VALUES("116","9","3666.67","333.33","94.72","428.05","31","1","1","0","2015-06-22","2","6","1");
INSERT INTO ln_loanmember_funddetail VALUES("117","9","3333.34","333.33","83.33","416.66","30","1","0","0","2015-07-22","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("118","9","3000.01","333.33","82.50","415.83","33","1","0","0","2015-08-24","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("119","9","2666.68","333.33","68.89","402.22","31","1","0","0","2015-09-24","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("120","9","2333.35","333.33","62.22","395.55","32","1","0","0","2015-10-26","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("121","9","2000.02","333.33","51.67","385.00","31","1","0","0","2015-11-26","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("122","9","1666.69","333.33","44.45","377.78","32","1","0","0","2015-12-28","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("123","9","1333.36","333.33","34.45","367.78","31","1","0","0","2016-01-28","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("124","9","1000.03","333.33","26.67","360.00","32","1","0","0","2016-02-29","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("125","9","666.70","333.33","16.11","349.44","29","1","0","0","2016-03-29","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("126","9","333.37","333.37","8.61","341.98","31","1","0","0","2016-04-29","2","6","");
INSERT INTO ln_loanmember_funddetail VALUES("127","10","3000.00","0.00","75.00","75.00","30","1","0","0","2015-05-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("128","10","3000.00","0.00","77.50","77.50","31","1","0","0","2015-06-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("129","10","3000.00","0.00","75.00","75.00","30","1","0","0","2015-07-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("130","10","3000.00","0.00","82.50","82.50","33","1","0","0","2015-08-24","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("131","10","3000.00","0.00","77.50","77.50","31","1","0","0","2015-09-24","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("132","10","3000.00","0.00","80.00","80.00","32","1","0","0","2015-10-26","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("133","10","3000.00","0.00","77.50","77.50","31","1","0","0","2015-11-26","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("134","10","3000.00","0.00","80.00","80.00","32","1","0","0","2015-12-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("135","10","3000.00","0.00","77.50","77.50","31","1","0","0","2016-01-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("136","10","3000.00","0.00","80.00","80.00","32","1","0","0","2016-02-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("137","10","3000.00","0.00","72.50","72.50","29","1","0","0","2016-03-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("138","10","3000.00","3000.00","77.50","3077.50","31","1","0","0","2016-04-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("139","11","4000.00","333.33","100.00","433.33","30","1","0","0","2015-05-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("140","11","3666.67","333.33","94.72","428.05","31","1","0","0","2015-06-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("141","11","3333.34","333.33","83.33","416.66","30","1","0","0","2015-07-22","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("142","11","3000.01","333.33","82.50","415.83","33","1","0","0","2015-08-24","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("143","11","2666.68","333.33","68.89","402.22","31","1","0","0","2015-09-24","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("144","11","2333.35","333.33","62.22","395.55","32","1","0","0","2015-10-26","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("145","11","2000.02","333.33","51.67","385.00","31","1","0","0","2015-11-26","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("146","11","1666.69","333.33","44.45","377.78","32","1","0","0","2015-12-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("147","11","1333.36","333.33","34.45","367.78","31","1","0","0","2016-01-28","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("148","11","1000.03","333.33","26.67","360.00","32","1","0","0","2016-02-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("149","11","666.70","333.33","16.11","349.44","29","1","0","0","2016-03-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("150","11","333.37","333.37","8.61","341.98","31","1","0","0","2016-04-29","1","8","");
INSERT INTO ln_loanmember_funddetail VALUES("151","12","1000.00","83.33","25.00","108.33","30","1","1","0","2015-05-28","1","7","1");
INSERT INTO ln_loanmember_funddetail VALUES("152","12","916.67","83.33","24.44","107.77","32","1","1","0","2015-06-29","1","7","2");
INSERT INTO ln_loanmember_funddetail VALUES("153","12","833.34","83.33","20.83","104.16","30","1","1","0","2015-07-29","1","7","2");
INSERT INTO ln_loanmember_funddetail VALUES("154","12","750.01","83.33","20.63","103.96","33","1","1","0","2015-08-31","1","7","2");
INSERT INTO ln_loanmember_funddetail VALUES("155","12","666.68","83.33","17.22","100.55","31","1","1","0","2015-10-01","1","7","2");
INSERT INTO ln_loanmember_funddetail VALUES("156","12","583.35","83.33","15.56","98.89","32","1","0","0","2015-11-02","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("157","12","500.02","83.33","12.50","95.83","30","1","0","0","2015-12-02","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("158","12","416.69","83.33","11.46","94.79","33","1","0","0","2016-01-04","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("159","12","333.36","83.33","8.61","91.94","31","1","0","0","2016-02-04","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("160","12","250.03","83.33","6.04","89.37","29","1","0","0","2016-03-04","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("161","12","166.70","83.33","4.31","87.64","31","1","0","0","2016-04-04","1","7","");
INSERT INTO ln_loanmember_funddetail VALUES("162","12","83.37","83.37","2.08","85.45","30","1","0","0","2016-05-04","1","7","");



DROP TABLE ln_payment_method;

CREATE TABLE `ln_payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_nameen` varchar(50) DEFAULT NULL,
  `payment_namekh` varchar(50) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ln_payment_method VALUES("1","Decline","???????????","","1");
INSERT INTO ln_payment_method VALUES("2","Baloon","????????","","1");
INSERT INTO ln_payment_method VALUES("3","Flat Rate","??????","","1");
INSERT INTO ln_payment_method VALUES("4","Fixed Pyment(Full Last Period)","?????????????????","","1");
INSERT INTO ln_payment_method VALUES("5","Semi Baloon","","","1");
INSERT INTO ln_payment_method VALUES("6","Fixed Payment (Fixed Rate)","","","1");



DROP TABLE ln_permission;

CREATE TABLE `ln_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `permission_type` varchar(100) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `all_day` varchar(20) DEFAULT NULL,
  `paid_leave` varchar(20) DEFAULT NULL,
  `every_day` varchar(20) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO ln_permission VALUES("1","7","1","1","2014-12-10","1","2014-12-23","2014-12-23","00:00:00","1","0","0","??","0","2014-12-24","1");
INSERT INTO ln_permission VALUES("2","4","2","1","2014-12-12","4","2014-12-23","2014-12-23","09:51:08","1","1","0","????????????","0","2015-01-17","1");
INSERT INTO ln_permission VALUES("3","3","1","6","2014-12-04","3","2014-12-23","2014-12-23","00:00:00","0","0","1","?????????","0","2015-01-17","1");
INSERT INTO ln_permission VALUES("4","10","2","6","2014-12-04","2","2014-12-23","2014-12-23","00:00:00","0","1","0","????????????","1","2015-01-17","1");
INSERT INTO ln_permission VALUES("5","6","1","4","2014-12-05","1","2014-12-24","2014-12-24","00:00:00","1","0","0","?????????","1","2015-01-17","1");
INSERT INTO ln_permission VALUES("6","5","1","6","2014-12-19","1","2014-12-24","2014-12-24","00:00:00","1","1","0","????","1","2015-01-17","1");
INSERT INTO ln_permission VALUES("9","8","1","1","2014-12-10","1","2014-12-23","2014-12-23","00:00:00","1","1","0","???????","1","2015-01-17","1");
INSERT INTO ln_permission VALUES("10","1","2","8","2014-12-19","1","2014-12-24","2014-12-24","00:00:00","0","1","1","????","1","2014-12-24","1");
INSERT INTO ln_permission VALUES("11","4","1","2","2014-12-01","1","2014-12-17","2014-12-26","05:55:00","1","0","0","???????","1","2015-01-17","1");
INSERT INTO ln_permission VALUES("12","1","1","2","2014-12-12","3","2014-12-24","2014-12-24","00:00:00","0","1","0","????????????????","1","2014-12-24","1");
INSERT INTO ln_permission VALUES("13","6","1","8","2014-12-17","1","2014-12-11","2014-12-24","00:00:00","0","0","1","?????????","1","2014-12-24","1");



DROP TABLE ln_position;

CREATE TABLE `ln_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(30) DEFAULT NULL,
  `position_en` varchar(100) NOT NULL,
  `position_kh` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 active ,0 deactive',
  `user_id` int(11) NOT NULL COMMENT 'user modify and create',
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1 khmer ,2 english',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO ln_position VALUES("1","","Creditor Officer","????????????","Feb 23, 2014 6:04:30 AM","1","1","1");
INSERT INTO ln_position VALUES("2","","Teller","??????????????","Feb 23, 2014 6:06:30 AM","1","1","1");
INSERT INTO ln_position VALUES("4","","Accountant","?????????","Feb 23, 2014 6:12:47 AM","1","1","1");
INSERT INTO ln_position VALUES("5","","Administrator Officer","???????","Feb 23, 2014 6:17:44 AM","1","1","1");
INSERT INTO ln_position VALUES("6","","Branch Manager","????????????????????","Jun 1, 2014 4:05:12 PM","1","1","1");
INSERT INTO ln_position VALUES("7","","Marketing ","??????","Jun 1, 2014 1:28:44 PM","1","1","1");
INSERT INTO ln_position VALUES("8","","Operation","?????????????????","Jun 1, 2014 1:34:10 PM","1","1","1");



DROP TABLE ln_province;

CREATE TABLE `ln_province` (
  `province_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_en_name` varchar(50) DEFAULT NULL,
  `province_kh_name` varchar(60) DEFAULT NULL,
  `modify_date` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(10) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1=kh,2=eng',
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

INSERT INTO ln_province VALUES("1","Phnom Penh","???????","Apr 6, 2015 7:17:50 PM","1","1","1","1");
INSERT INTO ln_province VALUES("2","Battambang","????????","Apr 6, 2015 7:18:30 PM","1","1","1","1");
INSERT INTO ln_province VALUES("3","Banteay Meanchey","????????????","Apr 6, 2015 7:18:14 PM","1","1","1","1");
INSERT INTO ln_province VALUES("4","Kampong Cham","????????","Apr 6, 2015 7:18:45 PM","1","1","1","");
INSERT INTO ln_province VALUES("5","Kampong Chhnang","???????????","Apr 6, 2015 7:19:10 PM","1","1","1","");
INSERT INTO ln_province VALUES("6","Kampong Speu","?????????","Apr 6, 2015 7:19:25 PM","1","1","1","");
INSERT INTO ln_province VALUES("7","Kampong Thom","???????","Apr 6, 2015 7:19:40 PM","1","1","1","");
INSERT INTO ln_province VALUES("8","Kampot","????","Apr 6, 2015 7:19:52 PM","1","1","1","");
INSERT INTO ln_province VALUES("9","Kandal","??????","Apr 6, 2015 7:20:07 PM","1","1","1","");
INSERT INTO ln_province VALUES("10","Koh Kong","??????","Apr 6, 2015 7:20:22 PM","1","1","1","");
INSERT INTO ln_province VALUES("11","Kratie","??????","Apr 6, 2015 7:21:06 PM","1","1","1","");
INSERT INTO ln_province VALUES("12","Mondulkiri","?????????","Apr 6, 2015 7:21:20 PM","1","1","1","");
INSERT INTO ln_province VALUES("13","Oddar Meancheay","Oddar Meancheay","Apr 6, 2015 7:14:26 PM","1","1","1","");
INSERT INTO ln_province VALUES("14","Preah Vihear","?????????","Apr 6, 2015 7:22:11 PM","1","1","1","");
INSERT INTO ln_province VALUES("15","Pursat","?????????","Apr 6, 2015 7:22:32 PM","1","1","1","");
INSERT INTO ln_province VALUES("16","Prey Veng","???????","Apr 6, 2015 7:22:52 PM","1","1","1","");
INSERT INTO ln_province VALUES("17","Ratanakiri","???????","Apr 6, 2015 7:23:08 PM","1","1","1","");
INSERT INTO ln_province VALUES("18","Siem Reap","??????","Apr 6, 2015 7:23:23 PM","1","1","1","");
INSERT INTO ln_province VALUES("19","Stung Treng","??????????","Apr 6, 2015 7:23:38 PM","1","1","1","");
INSERT INTO ln_province VALUES("20","Svay Rieng","????????","Apr 6, 2015 7:23:56 PM","1","1","1","");
INSERT INTO ln_province VALUES("21","Takeo","?????","Apr 6, 2015 7:24:25 PM","1","1","1","");
INSERT INTO ln_province VALUES("22","Kep","???","Apr 6, 2015 7:20:35 PM","1","1","1","");
INSERT INTO ln_province VALUES("23","Pailin","?????","Apr 6, 2015 7:21:55 PM","1","1","1","");
INSERT INTO ln_province VALUES("24","Preah Sihanouk","?????????","Apr 6, 2015 7:17:28 PM","1","1","1","");
INSERT INTO ln_province VALUES("25","Tbong Khmum","??????????","Apr 6, 2015 7:24:39 PM","1","1","1","");



DROP TABLE ln_receipt_money;

CREATE TABLE `ln_receipt_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lfd_id` int(11) DEFAULT NULL COMMENT 'loan fund detail',
  `receipt_no` varchar(30) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL COMMENT 'pay at which office',
  `loan_number` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `co_id` int(11) DEFAULT NULL COMMENT 'co collect',
  `receiver_id` int(11) DEFAULT NULL COMMENT '??????????????',
  `date_pay` date DEFAULT NULL,
  `date_input` date DEFAULT NULL,
  `capital` float(15,2) DEFAULT NULL COMMENT 'capital before fund',
  `remain_capital` float(15,2) DEFAULT NULL,
  `principal_permonth` float(15,2) DEFAULT NULL COMMENT 'principal pay for month',
  `total_interest` float(15,2) DEFAULT NULL,
  `penalize_amount` float(15,2) DEFAULT NULL COMMENT '??????????????',
  `total_fund` float(15,2) DEFAULT NULL COMMENT '????????????????',
  `service_charge` float(10,2) DEFAULT NULL COMMENT '??????????????',
  `recieve_amount` float(10,2) DEFAULT NULL,
  `reuturn_amount` float(10,2) DEFAULT NULL,
  `note` text,
  `user_id` tinyint(4) DEFAULT NULL,
  `is_complete` tinyint(4) DEFAULT '0' COMMENT '0=not paid complet ,1=complete,2=over paid',
  `is_verify` tinyint(4) DEFAULT '0',
  `verify_by` tinyint(4) DEFAULT '0',
  `is_closingentry` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_referenct;

CREATE TABLE `ln_referenct` (
  `ref_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_return_collect;

CREATE TABLE `ln_return_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coll_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `reciever_name` varchar(50) DEFAULT NULL,
  `deliver_name` varchar(50) DEFAULT NULL,
  `date_deliver` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_return_collteral;

CREATE TABLE `ln_return_collteral` (
  `return_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `collteral_id` int(11) DEFAULT NULL,
  `giver_name` varchar(50) DEFAULT NULL,
  `receiver_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1' COMMENT '1=??????????',
  `user_id` int(11) DEFAULT NULL,
  `change_id` int(11) DEFAULT NULL COMMENT 'from exchange collterl id',
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ln_return_collteral VALUES("1","2","1","","channy","Sok Dara","2015-04-13","out of loan","1","1","");
INSERT INTO ln_return_collteral VALUES("2","2","1","28","channy","Sok Dara","2015-04-13","out of loan","1","1","");



DROP TABLE ln_salary;

CREATE TABLE `ln_salary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `staff_id` varchar(50) DEFAULT NULL,
  `basic_salary` float(12,2) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_get_salary` date DEFAULT NULL,
  `for_month` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `detail` varchar(10) DEFAULT 'Click',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO ln_salary VALUES("1","1","5","250.00","2014-12-01","2014-12-26","1","2015-01-10","1","0","Click");
INSERT INTO ln_salary VALUES("2","1","8","800.00","2014-12-01","2014-12-29","1","2014-12-31","1","0","Click");
INSERT INTO ln_salary VALUES("4","1","8","800.00","2014-12-01","2014-12-29","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("6","2","8","800.00","2014-12-01","2014-12-29","6","2014-12-30","1","1","Click");
INSERT INTO ln_salary VALUES("7","1","2","250.00","2014-12-01","2014-12-31","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("8","1","6","100.00","2014-12-26","2014-12-31","1","2014-12-31","1","1","Click");
INSERT INTO ln_salary VALUES("9","1","8","800.00","2014-12-01","2014-12-31","12","2014-12-31","1","1","Click");



DROP TABLE ln_salary_detail;

CREATE TABLE `ln_salary_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bonus_id` int(11) DEFAULT NULL,
  `bonus_type` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `note` text,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

INSERT INTO ln_salary_detail VALUES("1","2","6","88.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("2","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("3","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("4","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("5","4","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("6","5","0","2.00","","0");
INSERT INTO ln_salary_detail VALUES("7","6","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("8","6","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("9","6","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("10","6","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("11","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("12","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("13","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("14","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("16","6","1","200.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("17","6","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("18","6","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("19","6","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("20","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("21","7","1","20.00","Good","0");
INSERT INTO ln_salary_detail VALUES("22","7","2","10.00","C","0");
INSERT INTO ln_salary_detail VALUES("23","7","3","20.00","B","0");
INSERT INTO ln_salary_detail VALUES("24","7","4","2.00","D","0");
INSERT INTO ln_salary_detail VALUES("25","7","5","60.00","B","0");
INSERT INTO ln_salary_detail VALUES("26","7","6","200.00","A","0");
INSERT INTO ln_salary_detail VALUES("27","7","7","55.00","A","0");
INSERT INTO ln_salary_detail VALUES("28","7","8","80.00","A","0");
INSERT INTO ln_salary_detail VALUES("29","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("30","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("31","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("32","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("33","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("34","4","4","50.00","","0");
INSERT INTO ln_salary_detail VALUES("35","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("36","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("37","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("38","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("39","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("40","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("41","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("42","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("43","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("44","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("45","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("46","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("47","8","7","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("48","8","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("49","8","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("50","8","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("51","8","1","10.00","A","0");
INSERT INTO ln_salary_detail VALUES("52","8","8","25.00","B","0");
INSERT INTO ln_salary_detail VALUES("53","2","6","88.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("54","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("55","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("56","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("57","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("58","4","4","5.00","","0");
INSERT INTO ln_salary_detail VALUES("59","4","1","20.00","from interest","0");
INSERT INTO ln_salary_detail VALUES("60","4","2","50.00","","0");
INSERT INTO ln_salary_detail VALUES("61","4","3","10.00","","0");
INSERT INTO ln_salary_detail VALUES("62","4","4","50.00","","0");
INSERT INTO ln_salary_detail VALUES("63","7","1","20.00","Good","1");
INSERT INTO ln_salary_detail VALUES("64","7","2","10.00","C","1");
INSERT INTO ln_salary_detail VALUES("65","7","3","20.00","B","1");
INSERT INTO ln_salary_detail VALUES("66","7","4","2.00","D","1");
INSERT INTO ln_salary_detail VALUES("67","7","5","60.00","B","1");
INSERT INTO ln_salary_detail VALUES("68","7","6","200.00","A","1");
INSERT INTO ln_salary_detail VALUES("69","7","7","55.00","A","1");
INSERT INTO ln_salary_detail VALUES("70","7","8","80.00","A","1");
INSERT INTO ln_salary_detail VALUES("71","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("72","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("73","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("74","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("75","1","4","32.00","","0");
INSERT INTO ln_salary_detail VALUES("76","1","2","32.00","","0");
INSERT INTO ln_salary_detail VALUES("77","8","7","20.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("78","8","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("79","8","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("80","8","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("81","8","1","10.00","A","1");
INSERT INTO ln_salary_detail VALUES("82","9","7","20.00","Collection from customer","1");
INSERT INTO ln_salary_detail VALUES("83","1","5","50.00","Good","0");
INSERT INTO ln_salary_detail VALUES("84","1","5","20.00","","0");
INSERT INTO ln_salary_detail VALUES("85","1","4","32.00","","0");
INSERT INTO ln_salary_detail VALUES("86","1","2","32.00","","0");
INSERT INTO ln_salary_detail VALUES("87","4","1","20.00","from interest","1");
INSERT INTO ln_salary_detail VALUES("88","4","2","50.00","","1");
INSERT INTO ln_salary_detail VALUES("89","4","3","10.00","","1");
INSERT INTO ln_salary_detail VALUES("90","4","4","5.00","","1");
INSERT INTO ln_salary_detail VALUES("91","1","5","100.00","Good","1");
INSERT INTO ln_salary_detail VALUES("92","1","5","20.00","","1");
INSERT INTO ln_salary_detail VALUES("93","1","4","32.00","","1");
INSERT INTO ln_salary_detail VALUES("94","1","2","32.00","","1");



DROP TABLE ln_system_setting;

CREATE TABLE `ln_system_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keycode` varchar(150) DEFAULT NULL,
  `value` varchar(11) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ln_system_setting VALUES("1","work_saturday","0","1=work on saturday 0 not work");
INSERT INTO ln_system_setting VALUES("2","work_sunday","0","1=work on sunday 0 not work");
INSERT INTO ln_system_setting VALUES("3","servername","localhost","");
INSERT INTO ln_system_setting VALUES("4","dbuser","root","");
INSERT INTO ln_system_setting VALUES("5","dbpassword","","");
INSERT INTO ln_system_setting VALUES("6","dbname","db_loan","");
INSERT INTO ln_system_setting VALUES("7","adminfee","1","10% of loan amount");



DROP TABLE ln_tranfser_co;

CREATE TABLE `ln_tranfser_co` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `code_from` int(11) DEFAULT NULL COMMENT 'from co id',
  `code_to` int(11) DEFAULT NULL COMMENT 'to co id',
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '3 = transfer loan number',
  `date` date DEFAULT NULL,
  `note` text,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO ln_tranfser_co VALUES("6","1","","","","1","1","","1","2","2015-04-20","tt","");
INSERT INTO ln_tranfser_co VALUES("7","1","","","","1","1","","1","2","2015-04-20","d","");
INSERT INTO ln_tranfser_co VALUES("8","1","","","","6","2","","1","2","2015-04-20","dd","");
INSERT INTO ln_tranfser_co VALUES("9","1","","","","8","1","","1","2","2015-04-20","1-8","");
INSERT INTO ln_tranfser_co VALUES("10","1","","","","6","1","","1","2","2015-04-20","8-6","");
INSERT INTO ln_tranfser_co VALUES("11","1","","","","1","1","","1","2","2015-04-20","d","");
INSERT INTO ln_tranfser_co VALUES("13","1","1","2","1","2","","","1","1","2015-04-21","x","");
INSERT INTO ln_tranfser_co VALUES("14","1","","","1","2","","","1","1","2015-04-21","TESTING","1");



DROP TABLE ln_transaction_capital;

CREATE TABLE `ln_transaction_capital` (
  `int` int(11) DEFAULT NULL,
  `branch_int` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `amount_dollar` float(18,3) DEFAULT NULL,
  `amount_riel` float(18,3) DEFAULT NULL,
  `amount_bath` float(18,3) DEFAULT NULL,
  `note` text,
  `is_verify` tinyint(4) DEFAULT '0',
  `user_verify` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE ln_view;

CREATE TABLE `ln_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(50) DEFAULT NULL,
  `name_kh` varchar(50) DEFAULT NULL,
  `key_code` varchar(20) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT '1' COMMENT '1khmer',
  `type` int(11) DEFAULT NULL COMMENT '1=term',
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

INSERT INTO ln_view VALUES("1","Daily","??????????","1","1","1","1");
INSERT INTO ln_view VALUES("2","Weekly","?????????????","2","1","1","1");
INSERT INTO ln_view VALUES("3","Monthly","????????","3","1","1","1");
INSERT INTO ln_view VALUES("4","Yearly","???????????","4","1","1","1");
INSERT INTO ln_view VALUES("5","Before","???","1","1","2","1");
INSERT INTO ln_view VALUES("6","Normal","??????","3","1","2","1");
INSERT INTO ln_view VALUES("7","After","?????????","2","1","2","1");
INSERT INTO ln_view VALUES("8","Active","??????????","1","1","3","1");
INSERT INTO ln_view VALUES("10","Khmer","?????","1","1","4","1");
INSERT INTO ln_view VALUES("11","English","English","2","1","4","1");
INSERT INTO ln_view VALUES("12","Single","?????","1","1","5","1");
INSERT INTO ln_view VALUES("13","Married","?????????","2","1","5","1");
INSERT INTO ln_view VALUES("14","Windowed","??????","3","1","5","1");
INSERT INTO ln_view VALUES("15","Mindowed","???????","2","1","5","1");
INSERT INTO ln_view VALUES("16","National ID","National ID","3","1","6","1");
INSERT INTO ln_view VALUES("17","National ID","National ID","2","1","6","1");
INSERT INTO ln_view VALUES("18","dsfkasf","wdfs","3","1","6","1");
INSERT INTO ln_view VALUES("19","Other","asdfsa","4","1","6","");
INSERT INTO ln_view VALUES("23","Deactive","?????????????","0","1","3","1");
INSERT INTO ln_view VALUES("24","festival","?????????","1","1","7","1");
INSERT INTO ln_view VALUES("25","sickness","??","2","1","7","1");
INSERT INTO ln_view VALUES("26","Married","????????????","3","1","7","1");
INSERT INTO ln_view VALUES("27","Asset","Asset","1","1","8","1");
INSERT INTO ln_view VALUES("28","Liabilities","Liabilities","2","1","8","1");
INSERT INTO ln_view VALUES("29","Equities","Equities","3","1","8","1");
INSERT INTO ln_view VALUES("30","Incomes","Incomes","4","1","8","1");
INSERT INTO ln_view VALUES("32","Operation Account","Operation Account","1","2","10","1");
INSERT INTO ln_view VALUES("33","None Operation Account","None Operation Account","2","1","10","1");
INSERT INTO ln_view VALUES("34","???","???","1","1","12","1");
INSERT INTO ln_view VALUES("35","?????","?????","0","1","12","1");
INSERT INTO ln_view VALUES("36","go to province","????????","4","1","7","1");
INSERT INTO ln_view VALUES("37","Expense","Expense","5","1","8","1");
INSERT INTO ln_view VALUES("38","Moto Rental","????????????","1","1","9","1");
INSERT INTO ln_view VALUES("39","Petrol","Petrol","2","1","9","1");
INSERT INTO ln_view VALUES("40","Good cash Collection","Good cash Collection","3","1","9","1");
INSERT INTO ln_view VALUES("41","M","M","1","1","11","1");
INSERT INTO ln_view VALUES("42","F","F","2","1","11","1");
INSERT INTO ln_view VALUES("43","motor","motor","1","1","13","1");
INSERT INTO ln_view VALUES("44","national ID","national ID","2","1","13","1");
INSERT INTO ln_view VALUES("45","Day","??????????","1","1","14","1");
INSERT INTO ln_view VALUES("46","Week","?????????????","2","1","14","1");
INSERT INTO ln_view VALUES("47","Month","????????","3","1","14","1");
INSERT INTO ln_view VALUES("48","Riel","Riel","1","1","15","1");
INSERT INTO ln_view VALUES("49","Dolar","Dolar","2","1","15","1");
INSERT INTO ln_view VALUES("50","Bath","Bath","3","1","15","1");
INSERT INTO ln_view VALUES("51","Diploma","Diploma","1","1","20","1");
INSERT INTO ln_view VALUES("52","Associate","Associate","2","1","20","1");
INSERT INTO ln_view VALUES("53","Bechelor","Bechelor","3","1","20","1");
INSERT INTO ln_view VALUES("54","Master","Master","4","1","20","1");
INSERT INTO ln_view VALUES("55","PhD","PhD","5","1","20","1");
INSERT INTO ln_view VALUES("56","Personal","???????????","1","1","21","1");
INSERT INTO ln_view VALUES("57","Representer","?????????????","2","1","21","1");
INSERT INTO ln_view VALUES("58","Straight line","Straight line","1","1","16","1");
INSERT INTO ln_view VALUES("59","Double-declining banlance","Double-declining banlance","2","1","16","1");
INSERT INTO ln_view VALUES("60","Sum of the year","Sum of the year","3","1","16","1");
INSERT INTO ln_view VALUES("61","Long Term","Long Term","1","1","17","1");
INSERT INTO ln_view VALUES("62","Short Term","Short Term","2","1","17","1");
INSERT INTO ln_view VALUES("63","Cash","Cash","1","1","19","1");
INSERT INTO ln_view VALUES("64","Cradit","Cradit","2","1","19","1");
INSERT INTO ln_view VALUES("65","Other","Other","3","1","19","1");
INSERT INTO ln_view VALUES("66","Black List","Black List","1","1","22","1");



DROP TABLE ln_village;

CREATE TABLE `ln_village` (
  `vill_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commune_id` tinyint(10) NOT NULL,
  `village_name` varchar(60) NOT NULL,
  `village_namekh` varbinary(60) DEFAULT NULL,
  `displayby` tinyint(4) DEFAULT NULL,
  `modify_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`vill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ln_village VALUES("1","1","testing new ","ក្រាំងត្រឡាត់","1","Nov 2, 2014 12:00:31 AM","1","1");
INSERT INTO ln_village VALUES("2","1","Dom nak om pel","ក្រាំងត្រឡាត់","1","Jun 5, 2014 6:37:02 AM","1","1");
INSERT INTO ln_village VALUES("3","1","Lvea Chek","ក្រាំងត្រឡាត់","2","Jun 5, 2014 6:38:14 AM","1","1");
INSERT INTO ln_village VALUES("4","1","Tro sok pherm","ក្រាំងត្រឡាត់","1","Jun 5, 2014 6:37:43 AM","1","1");
INSERT INTO ln_village VALUES("5","1","ssss222","ក្រាំងត្រឡាត់","1","Nov 1, 2014 1:26:52 AM","1","1");
INSERT INTO ln_village VALUES("6","1","www","ក្រាំងត្រឡាត់","2","Nov 1, 2014 1:26:59 AM","1","1");
INSERT INTO ln_village VALUES("7","1","Prey kabas","ក្រាំងត្រឡាត់","2","Nov 1, 2014 11:58:14 PM","1","1");
INSERT INTO ln_village VALUES("8","1","Prey New","ក្រាំងត្រឡាត់","2","Nov 2, 2014 12:00:01 AM","1","1");
INSERT INTO ln_village VALUES("9","3","Prey Port","ក្រាំងត្រឡាត់","","Nov 13, 2014 1:48:28 AM","1","1");
INSERT INTO ln_village VALUES("10","2","Krang trolat","ក្រាំងត្រឡាត់","2","Nov 15, 2014 11:30:56 PM","1","1");
INSERT INTO ln_village VALUES("11","4","Tes eng","TESting","1","Apr 7, 2015 11:23:14 AM","1","1");



DROP TABLE ln_zone;

CREATE TABLE `ln_zone` (
  `zone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(40) NOT NULL,
  `zone_num` varchar(60) NOT NULL,
  `modify_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO ln_zone VALUES("1","zone 11211","001","2014-10-26","1","1");
INSERT INTO ln_zone VALUES("2","zone 2","002","2014-11-22","1","1");
INSERT INTO ln_zone VALUES("3","zone 5","003","0000-00-00","1","1");
INSERT INTO ln_zone VALUES("4","zone 5","004","0000-00-00","1","1");
INSERT INTO ln_zone VALUES("5","zone 22","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("6","zone 13","13","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("7","sdfsadf","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("8","dakc","222","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("9","WDFSADF","","2014-10-31","1","1");
INSERT INTO ln_zone VALUES("10","addd","","2014-11-01","1","1");
INSERT INTO ln_zone VALUES("11","vvvvv","vvvvv","2015-01-07","1","1");
INSERT INTO ln_zone VALUES("12","sok","B0012","2015-04-07","0","1");



DROP TABLE rms_acl_acl;

CREATE TABLE `rms_acl_acl` (
  `acl_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1: display in menu; 0: disable from menu',
  `rank` int(11) DEFAULT NULL COMMENT 'rank to show in submenu',
  PRIMARY KEY (`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_acl VALUES("1","rsvAcl","acl","add-acl","1","1");
INSERT INTO rms_acl_acl VALUES("2","rsvAcl","acl","edit-acl","1","2");
INSERT INTO rms_acl_acl VALUES("3","rsvAcl","acl","index","1","3");
INSERT INTO rms_acl_acl VALUES("4","rsvAcl","user-access","index","1","4");
INSERT INTO rms_acl_acl VALUES("5","rsvAcl","user-access","view-user-access","1","5");
INSERT INTO rms_acl_acl VALUES("6","rsvAcl","user-access","update-status","1","6");
INSERT INTO rms_acl_acl VALUES("7","rsvAcl","user-type","index","1","7");
INSERT INTO rms_acl_acl VALUES("8","rsvAcl","user-type","add-user-type","1","8");
INSERT INTO rms_acl_acl VALUES("9","rsvAcl","user-type","edit-user-type","1","9");
INSERT INTO rms_acl_acl VALUES("10","subagent","index","index","1","10");
INSERT INTO rms_acl_acl VALUES("11","subagent","index","add","1","11");
INSERT INTO rms_acl_acl VALUES("12","subagent","index","edited","1","12");
INSERT INTO rms_acl_acl VALUES("13","agent","index","index","1","13");
INSERT INTO rms_acl_acl VALUES("14","agent","index","add","1","14");
INSERT INTO rms_acl_acl VALUES("15","agent","index","edited","1","15");
INSERT INTO rms_acl_acl VALUES("16","user","index","index","1","16");
INSERT INTO rms_acl_acl VALUES("17","user","index","add","1","17");
INSERT INTO rms_acl_acl VALUES("18","user","index","edited","1","18");
INSERT INTO rms_acl_acl VALUES("19","transfer","index","index","1","19");
INSERT INTO rms_acl_acl VALUES("20","transfer","index","add","1","20");
INSERT INTO rms_acl_acl VALUES("21","transfer","index","edited","1","21");
INSERT INTO rms_acl_acl VALUES("22","reports","index","index","1","22");
INSERT INTO rms_acl_acl VALUES("23","reports","index","rpttotal","1","23");
INSERT INTO rms_acl_acl VALUES("24","reports","index","rptautoprint","1","24");
INSERT INTO rms_acl_acl VALUES("25","exchange","index","index","1","25");
INSERT INTO rms_acl_acl VALUES("26","exchange","index","add","1","26");
INSERT INTO rms_acl_acl VALUES("27","exchange","index","edited","1","27");
INSERT INTO rms_acl_acl VALUES("28","exchange","index","rate","1","");
INSERT INTO rms_acl_acl VALUES("29","exchange","index","balance","1","");
INSERT INTO rms_acl_acl VALUES("30","setting","index","index","1","");
INSERT INTO rms_acl_acl VALUES("31","reports","index","rptincome","1","");
INSERT INTO rms_acl_acl VALUES("32","reports","index","rptsummary-exchange","1","");
INSERT INTO rms_acl_acl VALUES("33","reports","index","rptsummary-transfer","1","");
INSERT INTO rms_acl_acl VALUES("34","wer","asdf","asdf","1","");
INSERT INTO rms_acl_acl VALUES("35","asdf","asdfasd","fasdf","1","");
INSERT INTO rms_acl_acl VALUES("36","accounting","index","service-price","1","");



DROP TABLE rms_acl_user_access;

CREATE TABLE `rms_acl_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `acl_id` (`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_user_access VALUES("1","1","1","1");
INSERT INTO rms_acl_user_access VALUES("4","2","1","1");
INSERT INTO rms_acl_user_access VALUES("5","3","1","1");
INSERT INTO rms_acl_user_access VALUES("6","4","1","1");
INSERT INTO rms_acl_user_access VALUES("7","5","1","1");
INSERT INTO rms_acl_user_access VALUES("8","6","1","1");
INSERT INTO rms_acl_user_access VALUES("9","7","1","1");
INSERT INTO rms_acl_user_access VALUES("10","8","1","1");
INSERT INTO rms_acl_user_access VALUES("11","9","1","1");
INSERT INTO rms_acl_user_access VALUES("12","10","1","1");
INSERT INTO rms_acl_user_access VALUES("13","11","1","1");
INSERT INTO rms_acl_user_access VALUES("14","12","1","1");
INSERT INTO rms_acl_user_access VALUES("15","13","1","1");
INSERT INTO rms_acl_user_access VALUES("16","14","1","1");
INSERT INTO rms_acl_user_access VALUES("17","15","1","1");
INSERT INTO rms_acl_user_access VALUES("18","16","1","1");
INSERT INTO rms_acl_user_access VALUES("19","17","1","1");
INSERT INTO rms_acl_user_access VALUES("23","21","1","1");
INSERT INTO rms_acl_user_access VALUES("24","22","1","1");
INSERT INTO rms_acl_user_access VALUES("25","23","1","1");
INSERT INTO rms_acl_user_access VALUES("26","24","1","1");
INSERT INTO rms_acl_user_access VALUES("27","10","2","1");
INSERT INTO rms_acl_user_access VALUES("28","11","2","1");
INSERT INTO rms_acl_user_access VALUES("29","12","2","1");
INSERT INTO rms_acl_user_access VALUES("30","13","2","1");
INSERT INTO rms_acl_user_access VALUES("31","14","2","1");
INSERT INTO rms_acl_user_access VALUES("32","15","2","1");
INSERT INTO rms_acl_user_access VALUES("33","19","2","1");
INSERT INTO rms_acl_user_access VALUES("34","20","2","1");
INSERT INTO rms_acl_user_access VALUES("35","21","2","1");
INSERT INTO rms_acl_user_access VALUES("36","22","2","1");
INSERT INTO rms_acl_user_access VALUES("37","23","2","1");
INSERT INTO rms_acl_user_access VALUES("38","24","2","1");
INSERT INTO rms_acl_user_access VALUES("39","19","3","1");
INSERT INTO rms_acl_user_access VALUES("40","20","3","1");
INSERT INTO rms_acl_user_access VALUES("41","21","3","1");
INSERT INTO rms_acl_user_access VALUES("42","25","1","1");
INSERT INTO rms_acl_user_access VALUES("43","26","1","1");
INSERT INTO rms_acl_user_access VALUES("44","27","1","1");
INSERT INTO rms_acl_user_access VALUES("45","28","1","1");
INSERT INTO rms_acl_user_access VALUES("46","29","1","1");
INSERT INTO rms_acl_user_access VALUES("47","25","2","1");
INSERT INTO rms_acl_user_access VALUES("48","26","2","1");
INSERT INTO rms_acl_user_access VALUES("49","27","2","1");
INSERT INTO rms_acl_user_access VALUES("50","28","2","1");
INSERT INTO rms_acl_user_access VALUES("51","29","2","1");
INSERT INTO rms_acl_user_access VALUES("52","25","4","1");
INSERT INTO rms_acl_user_access VALUES("53","26","4","1");
INSERT INTO rms_acl_user_access VALUES("54","27","4","1");
INSERT INTO rms_acl_user_access VALUES("55","28","5","1");
INSERT INTO rms_acl_user_access VALUES("56","25","5","1");
INSERT INTO rms_acl_user_access VALUES("57","29","4","1");
INSERT INTO rms_acl_user_access VALUES("58","30","1","1");
INSERT INTO rms_acl_user_access VALUES("59","31","1","1");
INSERT INTO rms_acl_user_access VALUES("60","32","1","1");
INSERT INTO rms_acl_user_access VALUES("61","33","1","1");
INSERT INTO rms_acl_user_access VALUES("62","33","2","1");
INSERT INTO rms_acl_user_access VALUES("63","32","2","1");
INSERT INTO rms_acl_user_access VALUES("64","31","2","1");
INSERT INTO rms_acl_user_access VALUES("65","30","2","1");
INSERT INTO rms_acl_user_access VALUES("66","22","3","1");
INSERT INTO rms_acl_user_access VALUES("67","23","3","1");
INSERT INTO rms_acl_user_access VALUES("68","31","3","1");
INSERT INTO rms_acl_user_access VALUES("69","24","3","1");
INSERT INTO rms_acl_user_access VALUES("70","33","3","1");
INSERT INTO rms_acl_user_access VALUES("71","32","4","1");
INSERT INTO rms_acl_user_access VALUES("72","30","4","1");



DROP TABLE rms_acl_user_type;

CREATE TABLE `rms_acl_user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO rms_acl_user_type VALUES("1","Operation Manager","0","1");
INSERT INTO rms_acl_user_type VALUES("2","Administrator","1","1");
INSERT INTO rms_acl_user_type VALUES("3","Credit Officer","2","1");



DROP TABLE rms_hold;

CREATE TABLE `rms_hold` (
  `hold_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`hold_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE rms_rate;

CREATE TABLE `rms_rate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rate_type` tinyint(4) DEFAULT NULL,
  `rate` float unsigned DEFAULT NULL,
  `modify_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO rms_rate VALUES("1","1","4100","","");



DROP TABLE rms_setting;

CREATE TABLE `rms_setting` (
  `code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyName` varchar(450) DEFAULT NULL,
  `keyValue` varchar(4500) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `access_type` int(11) NOT NULL DEFAULT '1' COMMENT '1=access all,2=foundation access,3=accounting access,4=no access',
  `status` tinyint(4) DEFAULT '1' COMMENT '1,use ,0 not use ,2 not access',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

INSERT INTO rms_setting VALUES("0","label_animation","????????????????????? : ????????????? ??????????? ?????????????????????????????","1","0","1");
INSERT INTO rms_setting VALUES("1","sms-warnning-kh","???????????????????????????????????????????","1","0","1");
INSERT INTO rms_setting VALUES("2","system_name","????????????????? ???????????","1","0","1");
INSERT INTO rms_setting VALUES("3","branch","VSS SERVICE","1","0","1");
INSERT INTO rms_setting VALUES("4","power_by","VSS SERVICE","1","0","1");
INSERT INTO rms_setting VALUES("6","branch-tel","TEL :(855) 10 78 55 44","1","0","1");
INSERT INTO rms_setting VALUES("7","branch_email","E-mail : info@vssservice.com","1","0","1");
INSERT INTO rms_setting VALUES("8","branch_add","??????? ??? ???????? ??? ??????? ????????? ?????? ???????","1","0","1");
INSERT INTO rms_setting VALUES("10","logo-path-name","images/loan-animation.gif","1","4","1");
INSERT INTO rms_setting VALUES("11","website","www.vssservice.com","1","0","1");
INSERT INTO rms_setting VALUES("12","branch-add-client","??????? ????????189(?) ?????????????????????????????????????","1","0","1");
INSERT INTO rms_setting VALUES("13","tel-client","092 515 555, 012 438 283","1","0","1");
INSERT INTO rms_setting VALUES("14","mainbranch-subtitle","???????????????, ???????????????","1","0","1");
INSERT INTO rms_setting VALUES("15","marquee-word","????????????????????????? ????????????????????? ?????????????, Exchnage and Transfer money","1","0","1");
INSERT INTO rms_setting VALUES("16","services","???????????????, ???????????????","1","0","1");
INSERT INTO rms_setting VALUES("18","branch_en","WESTERN UNIVERSITY","1","0","1");
INSERT INTO rms_setting VALUES("19","request_student","????????????????????","1","0","1");
INSERT INTO rms_setting VALUES("20","request_student_en","STUDENT REQUEST FORM","1","0","1");
INSERT INTO rms_setting VALUES("21","footer_branch","# 15,St 528 ,Boeung Kak I,Toul Kork ,Phnom Penh/# 47,St 173 ,Toul Svay Prey I,Chamkarmorn,Phnom Penh./#171-173,Pheah Ang Eng Street,Kampong Cham Town.","1","0","1");
INSERT INTO rms_setting VALUES("22","foot_phone","Phone:(855)23 998 233/Phone:(855)23 220 093/Phone:(855)42 942 024","1","0","1");
INSERT INTO rms_setting VALUES("23","f_email_website","Fax:(855)23 990n699/E-mail :info_wu@/Website western.edu.kh","1","0","1");
INSERT INTO rms_setting VALUES("24","reciept_en","OFFICAL RECEIPT","1","0","1");
INSERT INTO rms_setting VALUES("25","reciept_kh","???????????????????","1","0","1");
INSERT INTO rms_setting VALUES("26","This is My Test","ssss","1","1","1");
INSERT INTO rms_setting VALUES("27","set_service_label","1","1","0","1");
INSERT INTO rms_setting VALUES("28","rpt-transfer-title-kh","???? ?????????????????","0","1","1");
INSERT INTO rms_setting VALUES("29","exchange_ratetitle","?????????????????????","0","1","1");
INSERT INTO rms_setting VALUES("30","exchange_reciept","?????????????????????","0","1","1");
INSERT INTO rms_setting VALUES("31","brand_title","?????????????????????","0","1","1");
INSERT INTO rms_setting VALUES("34","comment","????????????????????????????????? ??????????????????","0","1","1");
INSERT INTO rms_setting VALUES("35","imgPath","7","0","1","1");
INSERT INTO rms_setting VALUES("36","rpt-transfer-title-eng","Tel 010 78 55 44","0","1","1");
INSERT INTO rms_setting VALUES("37","brand_title","?????????????????????","1","1","1");
INSERT INTO rms_setting VALUES("38","brand_zone","?????????????????","0","1","1");
INSERT INTO rms_setting VALUES("39","brand_Staff","Staff","0","1","1");
INSERT INTO rms_setting VALUES("40","brand_client","Client","0","1","1");
INSERT INTO rms_setting VALUES("41","Report ","Report","0","1","1");
INSERT INTO rms_setting VALUES("42","Report Agreement","Report Agreement","0","1","1");
INSERT INTO rms_setting VALUES("43","brand_adress","??????? ??? ???????? ??? ??????? ????????? ?????? ???????","0","1","1");
INSERT INTO rms_setting VALUES("44","phone_brand","TEL :(855) 10 78 55 44","0","1","1");
INSERT INTO rms_setting VALUES("45","brand_holiday","?????????????????","0","1","1");
INSERT INTO rms_setting VALUES("46","brand_call","??????????????????","0","1","1");
INSERT INTO rms_setting VALUES("47","il_payment_title","????????? ???????????????????","0","1","1");
INSERT INTO rms_setting VALUES("48","il_payment","??????????????????","0","1","1");
INSERT INTO rms_setting VALUES("49","rpt_loan_release","?????????????????????","0","1","1");
INSERT INTO rms_setting VALUES("50","rpt_loan_release_co","???????????????????????????","0","1","1");
INSERT INTO rms_setting VALUES("51","rpt_loan_collect","????????????????","0","1","1");
INSERT INTO rms_setting VALUES("52","rpt_loan_outstanding","????????????????????????","0","1","1");



DROP TABLE rms_user_log;

CREATE TABLE `rms_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `log_date` datetime NOT NULL,
  `log_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=664 DEFAULT CHARSET=utf8;

INSERT INTO rms_user_log VALUES("1","1","2014-01-18 05:09:43","in");
INSERT INTO rms_user_log VALUES("2","1","2014-01-18 05:11:21","in");
INSERT INTO rms_user_log VALUES("3","1","2014-01-18 08:35:11","in");
INSERT INTO rms_user_log VALUES("4","1","2014-01-19 05:34:03","in");
INSERT INTO rms_user_log VALUES("5","1","2014-01-19 05:46:26","in");
INSERT INTO rms_user_log VALUES("6","1","2014-01-20 11:21:29","in");
INSERT INTO rms_user_log VALUES("7","1","2014-01-20 14:26:06","in");
INSERT INTO rms_user_log VALUES("8","1","2014-01-21 14:01:00","in");
INSERT INTO rms_user_log VALUES("9","1","2014-01-23 11:44:37","in");
INSERT INTO rms_user_log VALUES("10","1","2014-01-23 11:56:00","in");
INSERT INTO rms_user_log VALUES("11","1","2014-01-25 00:44:42","in");
INSERT INTO rms_user_log VALUES("12","1","2014-01-26 11:12:44","in");
INSERT INTO rms_user_log VALUES("13","1","2014-01-26 12:07:58","in");
INSERT INTO rms_user_log VALUES("14","1","2014-02-05 14:20:18","in");
INSERT INTO rms_user_log VALUES("15","1","2014-02-09 00:58:51","in");
INSERT INTO rms_user_log VALUES("16","1","2014-02-09 01:08:35","out");
INSERT INTO rms_user_log VALUES("17","1","2014-02-09 01:08:41","in");
INSERT INTO rms_user_log VALUES("18","1","2014-02-09 01:08:51","out");
INSERT INTO rms_user_log VALUES("19","1","2014-02-09 01:09:21","in");
INSERT INTO rms_user_log VALUES("20","1","2014-02-09 01:24:16","out");
INSERT INTO rms_user_log VALUES("21","1","2014-02-09 01:25:11","in");
INSERT INTO rms_user_log VALUES("22","1","2014-02-09 01:26:44","out");
INSERT INTO rms_user_log VALUES("23","1","2014-02-09 01:27:38","in");
INSERT INTO rms_user_log VALUES("24","1","2014-02-09 10:39:04","in");
INSERT INTO rms_user_log VALUES("25","1","2014-02-09 10:41:35","in");
INSERT INTO rms_user_log VALUES("26","1","2014-02-09 13:31:42","in");
INSERT INTO rms_user_log VALUES("27","1","2014-02-15 05:22:56","in");
INSERT INTO rms_user_log VALUES("28","1","2014-02-15 06:02:22","in");
INSERT INTO rms_user_log VALUES("29","1","2014-02-17 11:15:45","in");
INSERT INTO rms_user_log VALUES("30","1","2014-02-18 11:12:22","in");
INSERT INTO rms_user_log VALUES("31","1","2014-02-18 23:13:48","in");
INSERT INTO rms_user_log VALUES("32","1","2014-02-19 12:20:51","in");
INSERT INTO rms_user_log VALUES("33","1","2014-02-19 23:09:24","in");
INSERT INTO rms_user_log VALUES("34","1","2014-02-20 03:04:05","in");
INSERT INTO rms_user_log VALUES("35","1","2014-02-20 11:38:08","in");
INSERT INTO rms_user_log VALUES("36","1","2014-02-20 13:31:46","in");
INSERT INTO rms_user_log VALUES("37","1","2014-02-22 00:10:55","in");
INSERT INTO rms_user_log VALUES("38","1","2014-02-22 07:59:55","in");
INSERT INTO rms_user_log VALUES("39","1","2014-02-22 10:16:08","in");
INSERT INTO rms_user_log VALUES("40","1","2014-02-22 13:15:30","in");
INSERT INTO rms_user_log VALUES("41","1","2014-02-23 04:51:08","in");
INSERT INTO rms_user_log VALUES("42","1","2014-02-25 11:56:49","in");
INSERT INTO rms_user_log VALUES("43","1","2014-02-25 12:13:02","out");
INSERT INTO rms_user_log VALUES("44","1","2014-02-25 12:15:17","in");
INSERT INTO rms_user_log VALUES("45","1","2014-02-25 14:10:05","out");
INSERT INTO rms_user_log VALUES("46","1","2014-02-25 14:10:13","in");
INSERT INTO rms_user_log VALUES("47","1","2014-02-26 14:00:32","in");
INSERT INTO rms_user_log VALUES("48","1","2014-02-26 23:37:51","in");
INSERT INTO rms_user_log VALUES("49","1","2014-02-27 11:58:17","in");
INSERT INTO rms_user_log VALUES("50","1","2014-02-28 14:08:31","in");
INSERT INTO rms_user_log VALUES("51","1","2014-02-28 14:15:08","out");
INSERT INTO rms_user_log VALUES("52","1","2014-02-28 14:15:27","in");
INSERT INTO rms_user_log VALUES("53","1","2014-02-28 14:16:00","out");
INSERT INTO rms_user_log VALUES("54","1","2014-02-28 14:19:22","in");
INSERT INTO rms_user_log VALUES("55","1","2014-02-28 14:31:03","in");
INSERT INTO rms_user_log VALUES("56","1","2014-02-28 15:15:02","out");
INSERT INTO rms_user_log VALUES("57","1","2014-03-01 00:46:40","in");
INSERT INTO rms_user_log VALUES("58","1","2014-03-01 00:48:27","in");
INSERT INTO rms_user_log VALUES("59","1","2014-03-01 05:23:21","in");
INSERT INTO rms_user_log VALUES("60","1","2014-03-01 05:45:37","out");
INSERT INTO rms_user_log VALUES("61","1","2014-03-01 05:45:43","in");
INSERT INTO rms_user_log VALUES("62","1","2014-03-01 05:47:12","out");
INSERT INTO rms_user_log VALUES("63","1","2014-03-01 05:47:26","in");
INSERT INTO rms_user_log VALUES("64","2","2014-03-02 13:49:22","in");
INSERT INTO rms_user_log VALUES("65","2","2014-03-02 14:41:30","out");
INSERT INTO rms_user_log VALUES("66","2","2014-03-03 09:22:59","in");
INSERT INTO rms_user_log VALUES("67","2","2014-03-06 11:06:28","in");
INSERT INTO rms_user_log VALUES("68","2","2014-03-10 02:07:21","in");
INSERT INTO rms_user_log VALUES("69","2","2014-03-10 03:02:51","in");
INSERT INTO rms_user_log VALUES("70","2","2014-03-10 03:55:52","in");
INSERT INTO rms_user_log VALUES("71","2","2014-03-10 08:46:26","in");
INSERT INTO rms_user_log VALUES("72","2","2014-03-10 10:11:31","in");
INSERT INTO rms_user_log VALUES("73","2","2014-03-10 11:30:20","in");
INSERT INTO rms_user_log VALUES("74","2","2014-03-10 13:33:24","in");
INSERT INTO rms_user_log VALUES("75","2","2014-03-10 14:53:47","in");
INSERT INTO rms_user_log VALUES("76","2","2014-05-02 02:18:16","in");
INSERT INTO rms_user_log VALUES("77","2","2014-05-02 02:49:27","in");
INSERT INTO rms_user_log VALUES("78","2","2014-05-03 03:19:52","in");
INSERT INTO rms_user_log VALUES("79","2","2014-05-03 05:14:59","in");
INSERT INTO rms_user_log VALUES("80","2","2014-05-03 08:37:17","in");
INSERT INTO rms_user_log VALUES("81","2","2014-05-03 09:27:07","out");
INSERT INTO rms_user_log VALUES("82","2","2014-05-03 09:27:23","in");
INSERT INTO rms_user_log VALUES("83","2","2014-05-20 14:32:06","in");
INSERT INTO rms_user_log VALUES("84","1","2014-06-01 03:55:48","in");
INSERT INTO rms_user_log VALUES("85","1","2014-06-01 06:35:08","in");
INSERT INTO rms_user_log VALUES("86","1","2014-06-01 11:51:09","in");
INSERT INTO rms_user_log VALUES("87","1","2014-06-01 12:04:32","in");
INSERT INTO rms_user_log VALUES("88","1","2014-06-01 13:52:01","in");
INSERT INTO rms_user_log VALUES("89","1","2014-06-01 22:29:58","in");
INSERT INTO rms_user_log VALUES("90","1","2014-06-02 22:30:30","in");
INSERT INTO rms_user_log VALUES("91","1","2014-06-03 21:38:29","in");
INSERT INTO rms_user_log VALUES("92","1","2014-06-04 18:27:47","in");
INSERT INTO rms_user_log VALUES("93","1","2014-06-04 22:15:19","out");
INSERT INTO rms_user_log VALUES("94","1","2014-06-05 04:48:17","in");
INSERT INTO rms_user_log VALUES("95","1","2014-06-05 18:17:16","in");
INSERT INTO rms_user_log VALUES("96","1","2014-06-06 05:38:43","in");
INSERT INTO rms_user_log VALUES("97","1","2014-06-06 07:22:15","in");
INSERT INTO rms_user_log VALUES("98","1","2014-06-06 22:10:07","in");
INSERT INTO rms_user_log VALUES("99","1","2014-06-07 05:33:41","in");
INSERT INTO rms_user_log VALUES("100","1","2014-06-07 06:06:47","in");
INSERT INTO rms_user_log VALUES("101","1","2014-06-07 15:00:40","in");
INSERT INTO rms_user_log VALUES("102","1","2014-06-07 17:13:39","in");
INSERT INTO rms_user_log VALUES("103","1","2014-06-07 20:41:01","in");
INSERT INTO rms_user_log VALUES("104","1","2014-06-08 06:00:02","in");
INSERT INTO rms_user_log VALUES("105","1","2014-06-08 08:36:25","in");
INSERT INTO rms_user_log VALUES("106","1","2014-06-08 08:45:30","in");
INSERT INTO rms_user_log VALUES("107","1","2014-06-08 09:37:59","in");
INSERT INTO rms_user_log VALUES("108","1","2014-06-14 07:10:10","in");
INSERT INTO rms_user_log VALUES("109","1","2014-06-14 10:15:58","in");
INSERT INTO rms_user_log VALUES("110","1","2014-06-14 14:12:25","in");
INSERT INTO rms_user_log VALUES("111","1","2014-06-14 21:31:42","in");
INSERT INTO rms_user_log VALUES("112","1","2014-06-14 23:03:13","in");
INSERT INTO rms_user_log VALUES("113","1","2014-06-15 04:43:34","in");
INSERT INTO rms_user_log VALUES("114","1","2014-06-15 04:47:07","in");
INSERT INTO rms_user_log VALUES("115","1","2014-06-15 16:50:10","in");
INSERT INTO rms_user_log VALUES("116","1","2014-06-16 06:55:49","in");
INSERT INTO rms_user_log VALUES("117","1","2014-06-16 19:15:32","in");
INSERT INTO rms_user_log VALUES("118","1","2014-06-21 06:45:03","in");
INSERT INTO rms_user_log VALUES("119","1","2014-06-21 07:07:38","in");
INSERT INTO rms_user_log VALUES("120","1","2014-06-21 09:32:57","in");
INSERT INTO rms_user_log VALUES("121","1","2014-06-22 16:59:58","in");
INSERT INTO rms_user_log VALUES("122","1","2014-06-22 17:40:27","in");
INSERT INTO rms_user_log VALUES("123","1","2014-06-22 20:40:53","in");
INSERT INTO rms_user_log VALUES("124","1","2014-06-24 21:29:23","in");
INSERT INTO rms_user_log VALUES("125","1","2014-06-24 21:51:40","in");
INSERT INTO rms_user_log VALUES("126","1","2014-06-25 19:45:29","in");
INSERT INTO rms_user_log VALUES("127","1","2014-06-26 06:29:30","in");
INSERT INTO rms_user_log VALUES("128","1","2014-06-26 20:18:09","in");
INSERT INTO rms_user_log VALUES("129","1","2014-06-28 14:37:49","in");
INSERT INTO rms_user_log VALUES("130","1","2014-06-28 21:24:55","in");
INSERT INTO rms_user_log VALUES("131","1","2014-06-29 05:23:08","in");
INSERT INTO rms_user_log VALUES("132","1","2014-06-29 05:34:44","out");
INSERT INTO rms_user_log VALUES("133","1","2014-06-29 05:34:56","in");
INSERT INTO rms_user_log VALUES("134","1","2014-06-29 10:25:45","in");
INSERT INTO rms_user_log VALUES("135","1","2014-06-29 11:35:51","out");
INSERT INTO rms_user_log VALUES("136","1","2014-06-29 15:25:24","in");
INSERT INTO rms_user_log VALUES("137","1","2014-06-29 20:31:58","in");
INSERT INTO rms_user_log VALUES("138","1","2014-06-29 20:56:06","out");
INSERT INTO rms_user_log VALUES("139","1","2014-06-29 21:34:59","in");
INSERT INTO rms_user_log VALUES("140","1","2014-06-30 05:29:47","in");
INSERT INTO rms_user_log VALUES("141","1","2014-06-30 20:41:59","in");
INSERT INTO rms_user_log VALUES("142","1","2014-07-01 05:51:04","in");
INSERT INTO rms_user_log VALUES("143","1","2014-07-01 19:54:49","in");
INSERT INTO rms_user_log VALUES("144","1","2014-07-02 06:27:57","in");
INSERT INTO rms_user_log VALUES("145","1","2014-07-02 21:45:38","in");
INSERT INTO rms_user_log VALUES("146","1","2014-07-03 05:19:54","in");
INSERT INTO rms_user_log VALUES("147","1","2014-07-04 04:41:10","in");
INSERT INTO rms_user_log VALUES("148","1","2014-07-04 05:31:37","in");
INSERT INTO rms_user_log VALUES("149","1","2014-07-04 06:56:53","in");
INSERT INTO rms_user_log VALUES("150","1","2014-07-04 21:28:37","in");
INSERT INTO rms_user_log VALUES("151","1","2014-07-05 05:44:15","in");
INSERT INTO rms_user_log VALUES("152","1","2014-07-05 20:13:17","in");
INSERT INTO rms_user_log VALUES("153","1","2014-07-06 11:00:03","in");
INSERT INTO rms_user_log VALUES("154","1","2014-07-06 18:01:20","in");
INSERT INTO rms_user_log VALUES("155","1","2014-07-06 20:38:16","in");
INSERT INTO rms_user_log VALUES("156","1","2014-07-07 20:20:32","in");
INSERT INTO rms_user_log VALUES("157","1","2014-07-08 06:01:40","in");
INSERT INTO rms_user_log VALUES("158","1","2014-07-08 07:15:37","in");
INSERT INTO rms_user_log VALUES("159","1","2014-07-08 20:39:18","in");
INSERT INTO rms_user_log VALUES("160","1","2014-07-09 06:37:35","in");
INSERT INTO rms_user_log VALUES("161","1","2014-07-09 20:27:37","in");
INSERT INTO rms_user_log VALUES("162","1","2014-07-10 19:55:19","in");
INSERT INTO rms_user_log VALUES("163","1","2014-07-11 06:15:03","in");
INSERT INTO rms_user_log VALUES("164","1","2014-07-11 06:25:07","in");
INSERT INTO rms_user_log VALUES("165","1","2014-07-11 22:15:04","in");
INSERT INTO rms_user_log VALUES("166","1","2014-07-12 06:52:32","in");
INSERT INTO rms_user_log VALUES("167","1","2014-07-12 09:35:48","in");
INSERT INTO rms_user_log VALUES("168","1","2014-07-12 12:53:16","in");
INSERT INTO rms_user_log VALUES("169","1","2014-07-12 17:09:30","in");
INSERT INTO rms_user_log VALUES("170","1","2014-07-12 18:11:14","in");
INSERT INTO rms_user_log VALUES("171","1","2014-07-12 21:46:18","in");
INSERT INTO rms_user_log VALUES("172","1","2014-07-13 07:09:35","in");
INSERT INTO rms_user_log VALUES("173","1","2014-07-13 11:21:08","in");
INSERT INTO rms_user_log VALUES("174","1","2014-07-13 18:05:53","in");
INSERT INTO rms_user_log VALUES("175","1","2014-07-13 20:11:44","in");
INSERT INTO rms_user_log VALUES("176","1","2014-07-14 20:51:13","in");
INSERT INTO rms_user_log VALUES("177","1","2014-07-15 06:08:36","in");
INSERT INTO rms_user_log VALUES("178","1","2014-07-15 13:51:34","in");
INSERT INTO rms_user_log VALUES("179","1","2014-07-15 17:36:49","in");
INSERT INTO rms_user_log VALUES("180","1","2014-07-15 20:51:35","in");
INSERT INTO rms_user_log VALUES("181","1","2014-07-15 20:52:41","in");
INSERT INTO rms_user_log VALUES("182","1","2014-07-16 06:39:13","in");
INSERT INTO rms_user_log VALUES("183","1","2014-07-16 06:42:37","in");
INSERT INTO rms_user_log VALUES("184","1","2014-07-16 19:26:04","in");
INSERT INTO rms_user_log VALUES("185","1","2014-07-17 03:49:26","in");
INSERT INTO rms_user_log VALUES("186","1","2014-07-17 05:02:29","in");
INSERT INTO rms_user_log VALUES("187","1","2014-07-17 05:14:15","in");
INSERT INTO rms_user_log VALUES("188","1","2014-07-17 20:33:27","in");
INSERT INTO rms_user_log VALUES("189","1","2014-07-18 05:21:58","in");
INSERT INTO rms_user_log VALUES("190","1","2014-07-18 21:11:27","in");
INSERT INTO rms_user_log VALUES("191","1","2014-07-19 10:24:14","in");
INSERT INTO rms_user_log VALUES("192","1","2014-07-19 13:33:43","in");
INSERT INTO rms_user_log VALUES("193","1","2014-07-19 16:32:24","in");
INSERT INTO rms_user_log VALUES("194","1","2014-07-19 16:35:36","in");
INSERT INTO rms_user_log VALUES("195","1","2014-07-19 17:49:58","in");
INSERT INTO rms_user_log VALUES("196","1","2014-07-19 17:50:16","in");
INSERT INTO rms_user_log VALUES("197","1","2014-07-19 17:50:44","in");
INSERT INTO rms_user_log VALUES("198","1","2014-07-19 17:50:59","in");
INSERT INTO rms_user_log VALUES("199","1","2014-07-19 18:02:19","in");
INSERT INTO rms_user_log VALUES("200","1","2014-07-19 21:38:14","in");
INSERT INTO rms_user_log VALUES("201","1","2014-07-20 10:15:34","in");
INSERT INTO rms_user_log VALUES("202","1","2014-07-20 15:23:38","in");
INSERT INTO rms_user_log VALUES("203","1","2014-07-20 20:02:06","in");
INSERT INTO rms_user_log VALUES("204","1","2014-07-27 08:34:13","in");
INSERT INTO rms_user_log VALUES("205","1","2014-07-27 08:52:25","in");
INSERT INTO rms_user_log VALUES("206","1","2014-07-27 16:14:46","in");
INSERT INTO rms_user_log VALUES("207","1","2014-07-27 18:36:55","in");
INSERT INTO rms_user_log VALUES("208","1","2014-07-28 20:32:08","in");
INSERT INTO rms_user_log VALUES("209","1","2014-07-28 20:52:42","in");
INSERT INTO rms_user_log VALUES("210","1","2014-07-29 06:32:59","in");
INSERT INTO rms_user_log VALUES("211","1","2014-07-29 19:43:46","in");
INSERT INTO rms_user_log VALUES("212","1","2014-07-30 07:15:37","in");
INSERT INTO rms_user_log VALUES("213","1","2014-07-30 18:01:28","in");
INSERT INTO rms_user_log VALUES("214","1","2014-07-30 19:04:46","in");
INSERT INTO rms_user_log VALUES("215","1","2014-08-01 06:39:39","in");
INSERT INTO rms_user_log VALUES("216","1","2014-08-02 09:26:50","in");
INSERT INTO rms_user_log VALUES("217","1","2014-08-02 18:39:09","in");
INSERT INTO rms_user_log VALUES("218","1","2014-08-03 10:20:35","in");
INSERT INTO rms_user_log VALUES("219","1","2014-08-03 16:40:14","in");
INSERT INTO rms_user_log VALUES("220","1","2014-08-04 20:03:21","in");
INSERT INTO rms_user_log VALUES("221","1","2014-08-05 21:12:02","in");
INSERT INTO rms_user_log VALUES("222","1","2014-08-06 07:18:56","in");
INSERT INTO rms_user_log VALUES("223","1","2014-08-06 20:36:29","in");
INSERT INTO rms_user_log VALUES("224","1","2014-08-07 04:13:12","in");
INSERT INTO rms_user_log VALUES("225","1","2014-08-07 05:08:59","in");
INSERT INTO rms_user_log VALUES("226","1","2014-08-07 17:54:28","in");
INSERT INTO rms_user_log VALUES("227","1","2014-08-07 18:12:09","in");
INSERT INTO rms_user_log VALUES("228","1","2014-08-07 20:45:33","in");
INSERT INTO rms_user_log VALUES("229","1","2014-08-08 21:32:59","in");
INSERT INTO rms_user_log VALUES("230","1","2014-08-11 21:08:09","in");
INSERT INTO rms_user_log VALUES("231","1","2014-08-12 18:17:32","in");
INSERT INTO rms_user_log VALUES("232","1","2014-08-13 18:12:23","in");
INSERT INTO rms_user_log VALUES("233","1","2014-08-14 05:37:25","in");
INSERT INTO rms_user_log VALUES("234","1","2014-08-14 19:41:34","in");
INSERT INTO rms_user_log VALUES("235","1","2014-08-15 06:14:04","in");
INSERT INTO rms_user_log VALUES("236","1","2014-08-15 19:49:53","in");
INSERT INTO rms_user_log VALUES("237","1","2014-08-16 21:52:05","in");
INSERT INTO rms_user_log VALUES("238","1","2014-08-16 22:05:04","in");
INSERT INTO rms_user_log VALUES("239","1","2014-08-17 19:22:03","in");
INSERT INTO rms_user_log VALUES("240","1","2014-08-18 21:00:16","in");
INSERT INTO rms_user_log VALUES("241","1","2014-08-19 06:29:20","in");
INSERT INTO rms_user_log VALUES("242","1","2014-08-19 18:34:26","in");
INSERT INTO rms_user_log VALUES("243","1","2014-08-31 10:10:22","in");
INSERT INTO rms_user_log VALUES("244","1","2014-08-31 16:04:43","in");
INSERT INTO rms_user_log VALUES("245","1","2014-08-31 17:09:09","in");
INSERT INTO rms_user_log VALUES("246","1","2014-08-31 19:57:00","in");
INSERT INTO rms_user_log VALUES("247","1","2014-09-01 06:31:20","in");
INSERT INTO rms_user_log VALUES("248","1","2014-09-01 18:23:22","in");
INSERT INTO rms_user_log VALUES("249","1","2014-09-01 19:47:05","in");
INSERT INTO rms_user_log VALUES("250","1","2014-09-02 06:41:51","in");
INSERT INTO rms_user_log VALUES("251","1","2014-09-02 19:10:19","in");
INSERT INTO rms_user_log VALUES("252","1","2014-09-03 06:37:47","in");
INSERT INTO rms_user_log VALUES("253","1","2014-09-03 07:02:12","in");
INSERT INTO rms_user_log VALUES("254","1","2014-09-03 18:44:09","in");
INSERT INTO rms_user_log VALUES("255","1","2014-09-03 20:49:12","in");
INSERT INTO rms_user_log VALUES("256","1","2014-09-04 06:58:42","in");
INSERT INTO rms_user_log VALUES("257","1","2014-09-04 18:29:00","in");
INSERT INTO rms_user_log VALUES("258","1","2014-09-04 20:45:56","in");
INSERT INTO rms_user_log VALUES("259","1","2014-09-04 22:34:11","in");
INSERT INTO rms_user_log VALUES("260","1","2014-09-09 21:19:29","in");
INSERT INTO rms_user_log VALUES("261","1","2014-09-10 18:32:44","in");
INSERT INTO rms_user_log VALUES("262","1","2014-09-11 21:13:56","in");
INSERT INTO rms_user_log VALUES("263","1","2014-10-09 20:32:45","in");
INSERT INTO rms_user_log VALUES("264","1","2014-10-10 08:49:25","in");
INSERT INTO rms_user_log VALUES("265","1","2014-10-11 09:09:12","in");
INSERT INTO rms_user_log VALUES("266","1","2014-10-11 17:14:14","in");
INSERT INTO rms_user_log VALUES("267","1","2014-10-12 09:18:11","in");
INSERT INTO rms_user_log VALUES("268","1","2014-10-12 15:14:40","in");
INSERT INTO rms_user_log VALUES("269","1","2014-10-12 15:52:02","in");
INSERT INTO rms_user_log VALUES("270","1","2014-10-12 19:49:23","in");
INSERT INTO rms_user_log VALUES("271","1","2014-10-26 16:19:12","in");
INSERT INTO rms_user_log VALUES("272","1","2014-10-27 20:56:01","in");
INSERT INTO rms_user_log VALUES("273","1","2014-10-27 23:22:59","in");
INSERT INTO rms_user_log VALUES("274","1","2014-10-28 08:49:03","in");
INSERT INTO rms_user_log VALUES("275","1","2014-10-28 08:49:13","in");
INSERT INTO rms_user_log VALUES("276","1","2014-10-28 21:32:40","in");
INSERT INTO rms_user_log VALUES("277","1","2014-10-28 21:44:26","in");
INSERT INTO rms_user_log VALUES("278","1","2014-10-29 17:41:01","in");
INSERT INTO rms_user_log VALUES("279","1","2014-10-30 08:47:14","in");
INSERT INTO rms_user_log VALUES("280","1","2014-10-31 09:00:51","in");
INSERT INTO rms_user_log VALUES("281","1","2014-10-31 20:48:43","in");
INSERT INTO rms_user_log VALUES("282","1","2014-10-31 20:52:49","in");
INSERT INTO rms_user_log VALUES("283","1","2014-10-31 00:28:59","in");
INSERT INTO rms_user_log VALUES("284","1","2014-10-31 09:06:45","in");
INSERT INTO rms_user_log VALUES("285","1","2014-11-01 00:34:47","in");
INSERT INTO rms_user_log VALUES("286","1","2014-11-01 00:41:19","in");
INSERT INTO rms_user_log VALUES("287","1","2014-11-01 08:43:22","in");
INSERT INTO rms_user_log VALUES("288","1","2014-11-01 10:34:13","in");
INSERT INTO rms_user_log VALUES("289","1","2014-11-01 22:07:13","in");
INSERT INTO rms_user_log VALUES("290","1","2014-11-01 23:10:31","in");
INSERT INTO rms_user_log VALUES("291","1","2014-11-02 22:21:39","in");
INSERT INTO rms_user_log VALUES("292","1","2014-11-06 22:09:22","in");
INSERT INTO rms_user_log VALUES("293","1","2014-11-06 22:44:32","in");
INSERT INTO rms_user_log VALUES("294","1","2014-11-06 22:45:41","in");
INSERT INTO rms_user_log VALUES("295","1","2014-11-06 23:48:01","in");
INSERT INTO rms_user_log VALUES("296","1","2014-11-08 23:52:54","in");
INSERT INTO rms_user_log VALUES("297","1","2014-11-09 00:17:20","in");
INSERT INTO rms_user_log VALUES("298","1","2014-11-10 23:25:50","in");
INSERT INTO rms_user_log VALUES("299","1","2014-11-10 23:46:56","in");
INSERT INTO rms_user_log VALUES("300","1","2014-11-11 01:31:09","in");
INSERT INTO rms_user_log VALUES("301","1","2014-11-12 09:03:34","in");
INSERT INTO rms_user_log VALUES("302","1","2014-11-13 00:10:27","in");
INSERT INTO rms_user_log VALUES("303","1","2014-11-13 00:25:43","in");
INSERT INTO rms_user_log VALUES("304","1","2014-11-13 00:40:17","in");
INSERT INTO rms_user_log VALUES("305","1","2014-11-13 21:25:22","in");
INSERT INTO rms_user_log VALUES("306","1","2014-11-13 21:46:45","in");
INSERT INTO rms_user_log VALUES("307","1","2014-11-13 20:10:40","in");
INSERT INTO rms_user_log VALUES("308","1","2014-11-13 20:12:19","in");
INSERT INTO rms_user_log VALUES("309","1","2014-11-13 22:24:54","in");
INSERT INTO rms_user_log VALUES("310","1","2014-11-14 20:17:26","in");
INSERT INTO rms_user_log VALUES("311","1","2014-11-14 20:23:26","in");
INSERT INTO rms_user_log VALUES("312","1","2014-11-15 08:57:13","in");
INSERT INTO rms_user_log VALUES("313","1","2014-11-15 10:46:24","in");
INSERT INTO rms_user_log VALUES("314","1","2014-11-15 18:45:01","in");
INSERT INTO rms_user_log VALUES("315","1","2014-11-16 07:48:24","in");
INSERT INTO rms_user_log VALUES("316","1","2014-11-16 17:55:01","in");
INSERT INTO rms_user_log VALUES("317","1","2014-11-16 20:57:45","in");
INSERT INTO rms_user_log VALUES("318","1","2014-11-16 22:31:24","in");
INSERT INTO rms_user_log VALUES("319","1","2014-11-16 22:32:04","in");
INSERT INTO rms_user_log VALUES("320","1","2014-11-17 18:09:44","in");
INSERT INTO rms_user_log VALUES("321","1","2014-11-17 20:26:16","in");
INSERT INTO rms_user_log VALUES("322","1","2014-11-17 21:33:47","in");
INSERT INTO rms_user_log VALUES("323","1","2014-11-18 06:47:54","in");
INSERT INTO rms_user_log VALUES("324","1","2014-11-18 16:23:39","in");
INSERT INTO rms_user_log VALUES("325","1","2014-11-18 16:44:49","in");
INSERT INTO rms_user_log VALUES("326","1","2014-11-18 16:47:49","in");
INSERT INTO rms_user_log VALUES("327","1","2014-11-18 17:22:34","in");
INSERT INTO rms_user_log VALUES("328","1","2014-11-19 18:50:39","in");
INSERT INTO rms_user_log VALUES("329","1","2014-11-19 22:09:47","in");
INSERT INTO rms_user_log VALUES("330","1","2014-11-20 01:29:53","in");
INSERT INTO rms_user_log VALUES("331","1","2014-11-20 10:10:47","in");
INSERT INTO rms_user_log VALUES("332","1","2014-11-20 21:15:10","in");
INSERT INTO rms_user_log VALUES("333","1","2014-11-20 19:25:45","in");
INSERT INTO rms_user_log VALUES("334","1","2014-11-21 06:11:11","in");
INSERT INTO rms_user_log VALUES("335","1","2014-11-21 11:31:37","in");
INSERT INTO rms_user_log VALUES("336","1","2014-11-21 12:49:04","in");
INSERT INTO rms_user_log VALUES("337","1","2014-11-21 14:13:48","in");
INSERT INTO rms_user_log VALUES("338","1","2014-11-21 20:01:01","in");
INSERT INTO rms_user_log VALUES("339","1","2014-11-21 21:31:04","in");
INSERT INTO rms_user_log VALUES("340","1","2014-11-22 06:49:58","in");
INSERT INTO rms_user_log VALUES("341","1","2014-11-22 08:58:09","in");
INSERT INTO rms_user_log VALUES("342","1","2014-11-22 11:19:08","in");
INSERT INTO rms_user_log VALUES("343","1","2014-11-22 11:28:35","in");
INSERT INTO rms_user_log VALUES("344","1","2014-11-22 14:35:56","in");
INSERT INTO rms_user_log VALUES("345","1","2014-11-22 15:40:46","in");
INSERT INTO rms_user_log VALUES("346","1","2014-11-22 21:45:40","in");
INSERT INTO rms_user_log VALUES("347","1","2014-11-23 10:35:44","in");
INSERT INTO rms_user_log VALUES("348","1","2014-11-23 11:03:07","in");
INSERT INTO rms_user_log VALUES("349","1","2014-11-23 14:44:15","in");
INSERT INTO rms_user_log VALUES("350","1","2014-11-23 19:31:42","in");
INSERT INTO rms_user_log VALUES("351","1","2014-11-23 23:21:59","in");
INSERT INTO rms_user_log VALUES("352","1","2014-11-23 23:44:30","in");
INSERT INTO rms_user_log VALUES("353","1","2014-11-24 21:35:28","in");
INSERT INTO rms_user_log VALUES("354","1","2014-11-25 00:35:44","in");
INSERT INTO rms_user_log VALUES("355","1","2014-11-25 21:43:03","in");
INSERT INTO rms_user_log VALUES("356","1","2014-11-26 10:18:20","in");
INSERT INTO rms_user_log VALUES("357","1","2014-11-26 15:44:10","in");
INSERT INTO rms_user_log VALUES("358","1","2014-11-26 20:14:47","in");
INSERT INTO rms_user_log VALUES("359","1","2014-11-26 23:15:36","in");
INSERT INTO rms_user_log VALUES("360","1","2014-11-26 23:57:00","in");
INSERT INTO rms_user_log VALUES("361","1","2014-11-27 20:50:15","in");
INSERT INTO rms_user_log VALUES("362","1","2014-11-27 22:24:27","in");
INSERT INTO rms_user_log VALUES("363","1","2014-11-28 00:48:07","in");
INSERT INTO rms_user_log VALUES("364","1","2014-11-28 19:53:46","in");
INSERT INTO rms_user_log VALUES("365","1","2014-11-28 21:34:37","in");
INSERT INTO rms_user_log VALUES("366","1","2014-11-28 22:55:47","in");
INSERT INTO rms_user_log VALUES("367","1","2014-11-30 01:29:58","in");
INSERT INTO rms_user_log VALUES("368","1","2014-11-30 11:03:29","in");
INSERT INTO rms_user_log VALUES("369","1","2014-11-30 19:54:36","in");
INSERT INTO rms_user_log VALUES("370","1","2014-11-30 23:01:56","in");
INSERT INTO rms_user_log VALUES("371","1","2014-11-30 23:03:01","in");
INSERT INTO rms_user_log VALUES("372","1","2014-12-01 09:55:47","in");
INSERT INTO rms_user_log VALUES("373","1","2014-12-02 02:19:27","in");
INSERT INTO rms_user_log VALUES("374","1","2014-12-02 20:12:38","in");
INSERT INTO rms_user_log VALUES("375","1","2014-12-02 22:29:23","in");
INSERT INTO rms_user_log VALUES("376","1","2014-12-03 07:45:42","in");
INSERT INTO rms_user_log VALUES("377","1","2014-12-03 13:29:39","in");
INSERT INTO rms_user_log VALUES("378","1","2014-12-03 21:37:07","in");
INSERT INTO rms_user_log VALUES("379","1","2014-12-04 05:53:19","in");
INSERT INTO rms_user_log VALUES("380","1","2014-12-04 21:30:13","in");
INSERT INTO rms_user_log VALUES("381","1","2014-12-05 22:08:08","in");
INSERT INTO rms_user_log VALUES("382","1","2014-12-08 08:07:22","in");
INSERT INTO rms_user_log VALUES("383","1","2014-12-08 21:54:49","in");
INSERT INTO rms_user_log VALUES("384","1","2014-12-09 10:07:46","in");
INSERT INTO rms_user_log VALUES("385","1","2014-12-09 11:19:18","in");
INSERT INTO rms_user_log VALUES("386","1","2014-12-09 22:44:19","in");
INSERT INTO rms_user_log VALUES("387","1","2014-12-10 18:37:00","in");
INSERT INTO rms_user_log VALUES("388","1","2014-12-12 09:05:43","in");
INSERT INTO rms_user_log VALUES("389","1","2014-12-12 11:00:14","in");
INSERT INTO rms_user_log VALUES("390","1","2014-12-13 12:37:07","in");
INSERT INTO rms_user_log VALUES("391","1","2014-12-13 17:49:46","in");
INSERT INTO rms_user_log VALUES("392","1","2014-12-13 18:08:25","in");
INSERT INTO rms_user_log VALUES("393","1","2014-12-13 18:12:42","in");
INSERT INTO rms_user_log VALUES("394","1","2014-12-13 18:14:07","in");
INSERT INTO rms_user_log VALUES("395","1","2014-12-13 18:16:54","in");
INSERT INTO rms_user_log VALUES("396","1","2014-12-13 21:43:36","in");
INSERT INTO rms_user_log VALUES("397","1","2014-12-14 17:19:24","in");
INSERT INTO rms_user_log VALUES("398","1","2014-12-15 00:14:43","in");
INSERT INTO rms_user_log VALUES("399","1","2014-12-15 12:03:51","in");
INSERT INTO rms_user_log VALUES("400","1","2014-12-15 22:09:34","in");
INSERT INTO rms_user_log VALUES("401","1","2014-12-16 00:14:26","in");
INSERT INTO rms_user_log VALUES("402","1","2014-12-16 11:13:45","in");
INSERT INTO rms_user_log VALUES("403","1","2014-12-16 22:52:22","in");
INSERT INTO rms_user_log VALUES("404","1","2014-12-16 23:11:30","in");
INSERT INTO rms_user_log VALUES("405","1","2014-12-17 17:46:50","in");
INSERT INTO rms_user_log VALUES("406","1","2014-12-17 19:25:09","in");
INSERT INTO rms_user_log VALUES("407","1","2014-12-18 11:06:27","in");
INSERT INTO rms_user_log VALUES("408","1","2014-12-18 08:25:58","in");
INSERT INTO rms_user_log VALUES("409","1","2014-12-18 08:39:47","in");
INSERT INTO rms_user_log VALUES("410","1","2014-12-18 09:17:10","in");
INSERT INTO rms_user_log VALUES("411","1","2014-12-18 10:05:28","in");
INSERT INTO rms_user_log VALUES("412","1","2014-12-18 19:08:36","in");
INSERT INTO rms_user_log VALUES("413","1","2014-12-19 06:52:42","in");
INSERT INTO rms_user_log VALUES("414","1","2014-12-19 10:00:57","in");
INSERT INTO rms_user_log VALUES("415","1","2014-12-19 10:41:02","in");
INSERT INTO rms_user_log VALUES("416","1","2014-12-19 13:36:50","in");
INSERT INTO rms_user_log VALUES("417","1","2014-12-20 09:49:01","in");
INSERT INTO rms_user_log VALUES("418","1","2014-12-20 09:49:20","in");
INSERT INTO rms_user_log VALUES("419","1","2014-12-20 21:54:32","in");
INSERT INTO rms_user_log VALUES("420","1","2014-12-21 09:19:06","in");
INSERT INTO rms_user_log VALUES("421","1","2014-12-21 09:21:34","in");
INSERT INTO rms_user_log VALUES("422","1","2014-12-21 18:51:51","in");
INSERT INTO rms_user_log VALUES("423","1","2014-12-22 08:51:56","in");
INSERT INTO rms_user_log VALUES("424","1","2014-12-22 10:23:22","in");
INSERT INTO rms_user_log VALUES("425","1","2014-12-22 22:00:34","in");
INSERT INTO rms_user_log VALUES("426","1","2014-12-23 08:50:46","in");
INSERT INTO rms_user_log VALUES("427","1","2014-12-23 10:11:23","in");
INSERT INTO rms_user_log VALUES("428","1","2014-12-24 07:04:54","in");
INSERT INTO rms_user_log VALUES("429","1","2014-12-24 07:22:54","in");
INSERT INTO rms_user_log VALUES("430","1","2014-12-24 08:18:26","in");
INSERT INTO rms_user_log VALUES("431","1","2014-12-23 21:20:42","in");
INSERT INTO rms_user_log VALUES("432","1","2014-12-23 21:25:37","in");
INSERT INTO rms_user_log VALUES("433","1","2014-12-24 11:17:12","in");
INSERT INTO rms_user_log VALUES("434","1","2014-12-24 13:49:36","in");
INSERT INTO rms_user_log VALUES("435","1","2014-12-24 20:17:02","in");
INSERT INTO rms_user_log VALUES("436","1","2014-12-25 06:57:39","in");
INSERT INTO rms_user_log VALUES("437","1","2014-12-25 16:02:43","in");
INSERT INTO rms_user_log VALUES("438","1","2014-12-25 19:41:03","in");
INSERT INTO rms_user_log VALUES("439","1","2014-12-26 13:19:35","in");
INSERT INTO rms_user_log VALUES("440","1","2014-12-26 10:39:57","in");
INSERT INTO rms_user_log VALUES("441","1","2014-12-27 07:36:28","in");
INSERT INTO rms_user_log VALUES("442","1","2014-12-27 13:00:57","in");
INSERT INTO rms_user_log VALUES("443","1","2014-12-28 21:32:25","in");
INSERT INTO rms_user_log VALUES("444","1","2014-12-28 21:43:08","in");
INSERT INTO rms_user_log VALUES("445","1","2014-12-28 21:54:45","in");
INSERT INTO rms_user_log VALUES("446","1","2014-12-29 12:51:22","in");
INSERT INTO rms_user_log VALUES("447","1","2014-12-29 16:15:37","in");
INSERT INTO rms_user_log VALUES("448","1","2014-12-30 00:24:18","in");
INSERT INTO rms_user_log VALUES("449","1","2014-12-30 08:06:45","in");
INSERT INTO rms_user_log VALUES("450","1","2014-12-30 09:53:08","in");
INSERT INTO rms_user_log VALUES("451","1","2014-12-30 22:31:38","in");
INSERT INTO rms_user_log VALUES("452","1","2014-12-31 09:11:36","in");
INSERT INTO rms_user_log VALUES("453","1","2014-12-31 06:21:29","in");
INSERT INTO rms_user_log VALUES("454","1","2015-01-02 08:30:45","in");
INSERT INTO rms_user_log VALUES("455","1","2015-01-02 10:37:05","in");
INSERT INTO rms_user_log VALUES("456","1","2015-01-02 14:26:22","in");
INSERT INTO rms_user_log VALUES("457","1","2015-01-02 21:52:02","in");
INSERT INTO rms_user_log VALUES("458","1","2015-01-03 12:27:25","in");
INSERT INTO rms_user_log VALUES("459","1","2015-01-03 18:50:47","in");
INSERT INTO rms_user_log VALUES("460","1","2015-01-04 07:31:25","in");
INSERT INTO rms_user_log VALUES("461","1","2015-01-04 17:20:31","in");
INSERT INTO rms_user_log VALUES("462","1","2015-01-05 04:02:57","in");
INSERT INTO rms_user_log VALUES("463","1","2015-01-05 12:13:40","in");
INSERT INTO rms_user_log VALUES("464","1","2015-01-05 13:24:38","in");
INSERT INTO rms_user_log VALUES("465","1","2015-01-05 16:18:29","in");
INSERT INTO rms_user_log VALUES("466","1","2015-01-06 00:26:56","in");
INSERT INTO rms_user_log VALUES("467","1","2015-01-06 05:47:53","in");
INSERT INTO rms_user_log VALUES("468","1","2015-01-06 05:48:55","in");
INSERT INTO rms_user_log VALUES("469","1","2015-01-06 08:17:07","in");
INSERT INTO rms_user_log VALUES("470","1","2015-01-06 04:28:42","in");
INSERT INTO rms_user_log VALUES("471","1","2015-01-06 04:29:12","in");
INSERT INTO rms_user_log VALUES("472","1","2015-01-07 10:55:02","in");
INSERT INTO rms_user_log VALUES("473","1","2015-01-07 11:28:01","in");
INSERT INTO rms_user_log VALUES("474","1","2015-01-07 12:01:35","in");
INSERT INTO rms_user_log VALUES("475","1","2015-01-07 19:39:29","in");
INSERT INTO rms_user_log VALUES("476","1","2015-01-07 19:40:27","in");
INSERT INTO rms_user_log VALUES("477","1","2015-01-11 12:01:49","in");
INSERT INTO rms_user_log VALUES("478","1","2015-01-11 12:31:04","in");
INSERT INTO rms_user_log VALUES("479","1","2015-01-11 19:30:58","in");
INSERT INTO rms_user_log VALUES("480","1","2015-01-12 08:32:34","in");
INSERT INTO rms_user_log VALUES("481","1","2015-01-12 15:59:36","in");
INSERT INTO rms_user_log VALUES("482","1","2015-01-12 16:00:32","in");
INSERT INTO rms_user_log VALUES("483","1","2015-01-13 06:21:22","in");
INSERT INTO rms_user_log VALUES("484","1","2015-01-13 08:02:03","in");
INSERT INTO rms_user_log VALUES("485","1","2015-01-13 20:16:57","in");
INSERT INTO rms_user_log VALUES("486","1","2015-01-14 10:26:37","in");
INSERT INTO rms_user_log VALUES("487","1","2015-01-14 23:04:03","in");
INSERT INTO rms_user_log VALUES("488","1","2015-01-14 23:05:46","in");
INSERT INTO rms_user_log VALUES("489","1","2015-01-15 11:31:13","in");
INSERT INTO rms_user_log VALUES("490","1","2015-01-15 21:17:52","in");
INSERT INTO rms_user_log VALUES("491","1","2015-01-16 08:39:23","in");
INSERT INTO rms_user_log VALUES("492","1","2015-01-16 22:14:44","in");
INSERT INTO rms_user_log VALUES("493","1","2015-01-17 08:37:23","in");
INSERT INTO rms_user_log VALUES("494","1","2015-01-17 09:27:37","in");
INSERT INTO rms_user_log VALUES("495","1","2015-01-19 10:35:45","in");
INSERT INTO rms_user_log VALUES("496","1","2015-01-20 08:08:46","in");
INSERT INTO rms_user_log VALUES("497","1","2015-01-21 09:44:31","in");
INSERT INTO rms_user_log VALUES("498","1","2015-01-22 08:03:55","in");
INSERT INTO rms_user_log VALUES("499","1","2015-01-22 08:11:13","in");
INSERT INTO rms_user_log VALUES("500","1","2015-01-22 20:52:25","in");
INSERT INTO rms_user_log VALUES("501","1","2015-01-26 08:46:46","in");
INSERT INTO rms_user_log VALUES("502","1","2015-01-26 09:43:08","in");
INSERT INTO rms_user_log VALUES("503","1","2015-01-26 12:09:15","in");
INSERT INTO rms_user_log VALUES("504","1","2015-01-27 13:34:07","in");
INSERT INTO rms_user_log VALUES("505","1","2015-01-27 13:34:37","in");
INSERT INTO rms_user_log VALUES("506","1","2015-01-27 11:55:45","in");
INSERT INTO rms_user_log VALUES("507","1","2015-01-27 13:01:39","in");
INSERT INTO rms_user_log VALUES("508","1","2015-01-27 14:53:23","in");
INSERT INTO rms_user_log VALUES("509","1","2015-01-28 16:07:11","in");
INSERT INTO rms_user_log VALUES("510","1","2015-01-28 16:36:41","in");
INSERT INTO rms_user_log VALUES("511","1","2015-01-28 21:27:25","in");
INSERT INTO rms_user_log VALUES("512","1","2015-01-30 09:14:14","in");
INSERT INTO rms_user_log VALUES("513","1","2015-01-30 09:31:15","in");
INSERT INTO rms_user_log VALUES("514","1","2015-02-01 20:32:46","in");
INSERT INTO rms_user_log VALUES("515","1","2015-02-02 08:05:47","in");
INSERT INTO rms_user_log VALUES("516","1","2015-02-04 09:43:56","in");
INSERT INTO rms_user_log VALUES("517","1","2015-02-04 10:06:21","in");
INSERT INTO rms_user_log VALUES("518","1","2015-02-04 10:32:33","in");
INSERT INTO rms_user_log VALUES("519","1","2015-02-04 16:33:57","in");
INSERT INTO rms_user_log VALUES("520","1","2015-02-05 17:31:03","in");
INSERT INTO rms_user_log VALUES("521","1","2015-02-05 22:02:05","in");
INSERT INTO rms_user_log VALUES("522","1","2015-02-05 22:02:21","in");
INSERT INTO rms_user_log VALUES("523","1","2015-02-06 08:37:50","in");
INSERT INTO rms_user_log VALUES("524","1","2015-02-06 10:07:15","in");
INSERT INTO rms_user_log VALUES("525","1","2015-02-06 13:50:23","in");
INSERT INTO rms_user_log VALUES("526","1","2015-02-06 15:09:33","in");
INSERT INTO rms_user_log VALUES("527","1","2015-02-06 15:16:24","in");
INSERT INTO rms_user_log VALUES("528","1","2015-02-07 12:23:32","in");
INSERT INTO rms_user_log VALUES("529","1","2015-02-07 15:24:15","in");
INSERT INTO rms_user_log VALUES("530","1","2015-02-07 16:13:31","in");
INSERT INTO rms_user_log VALUES("531","1","2015-02-07 17:03:19","in");
INSERT INTO rms_user_log VALUES("532","1","2015-02-07 18:02:36","in");
INSERT INTO rms_user_log VALUES("533","1","2015-02-07 21:14:20","in");
INSERT INTO rms_user_log VALUES("534","1","2015-02-07 21:40:15","in");
INSERT INTO rms_user_log VALUES("535","1","2015-02-07 21:52:33","in");
INSERT INTO rms_user_log VALUES("536","1","2015-02-07 21:58:30","in");
INSERT INTO rms_user_log VALUES("537","1","2015-02-07 22:05:12","in");
INSERT INTO rms_user_log VALUES("538","1","2015-02-08 07:51:20","in");
INSERT INTO rms_user_log VALUES("539","1","2015-02-08 09:26:25","in");
INSERT INTO rms_user_log VALUES("540","1","2015-02-08 09:35:24","in");
INSERT INTO rms_user_log VALUES("541","1","2015-02-08 10:50:58","in");
INSERT INTO rms_user_log VALUES("542","1","2015-02-08 10:55:58","in");
INSERT INTO rms_user_log VALUES("543","1","2015-02-08 13:45:55","in");
INSERT INTO rms_user_log VALUES("544","1","2015-02-09 08:31:51","in");
INSERT INTO rms_user_log VALUES("545","1","2015-02-09 13:50:14","in");
INSERT INTO rms_user_log VALUES("546","1","2015-02-09 15:09:33","in");
INSERT INTO rms_user_log VALUES("547","1","2015-02-09 15:12:52","in");
INSERT INTO rms_user_log VALUES("548","1","2015-02-09 15:13:22","in");
INSERT INTO rms_user_log VALUES("549","1","2015-02-09 15:17:00","in");
INSERT INTO rms_user_log VALUES("550","1","2015-02-09 22:41:22","in");
INSERT INTO rms_user_log VALUES("551","1","2015-02-10 08:49:14","in");
INSERT INTO rms_user_log VALUES("552","1","2015-02-10 11:35:47","in");
INSERT INTO rms_user_log VALUES("553","1","2015-02-10 21:19:27","in");
INSERT INTO rms_user_log VALUES("554","1","2015-02-10 22:02:58","in");
INSERT INTO rms_user_log VALUES("555","1","2015-02-11 08:10:56","in");
INSERT INTO rms_user_log VALUES("556","1","2015-02-12 08:22:17","in");
INSERT INTO rms_user_log VALUES("557","1","2015-02-12 22:04:28","in");
INSERT INTO rms_user_log VALUES("558","1","2015-02-13 08:12:17","in");
INSERT INTO rms_user_log VALUES("559","1","2015-02-13 14:10:22","in");
INSERT INTO rms_user_log VALUES("560","1","2015-02-13 17:26:42","in");
INSERT INTO rms_user_log VALUES("561","1","2015-02-14 07:17:27","in");
INSERT INTO rms_user_log VALUES("562","1","2015-02-14 13:13:27","in");
INSERT INTO rms_user_log VALUES("563","1","2015-02-14 17:50:31","in");
INSERT INTO rms_user_log VALUES("564","1","2015-02-16 06:10:21","in");
INSERT INTO rms_user_log VALUES("565","1","2015-02-16 11:44:48","in");
INSERT INTO rms_user_log VALUES("566","1","2015-02-16 12:10:27","in");
INSERT INTO rms_user_log VALUES("567","1","2015-02-16 13:18:02","in");
INSERT INTO rms_user_log VALUES("568","1","2015-02-17 09:09:27","in");
INSERT INTO rms_user_log VALUES("569","1","2015-02-17 09:18:13","in");
INSERT INTO rms_user_log VALUES("570","1","2015-02-17 11:46:04","in");
INSERT INTO rms_user_log VALUES("571","1","2015-02-17 23:27:52","in");
INSERT INTO rms_user_log VALUES("572","1","2015-02-18 18:30:09","in");
INSERT INTO rms_user_log VALUES("573","1","2015-02-18 23:50:00","in");
INSERT INTO rms_user_log VALUES("574","1","2015-02-19 17:58:21","in");
INSERT INTO rms_user_log VALUES("575","1","2015-02-19 19:37:42","in");
INSERT INTO rms_user_log VALUES("576","1","2015-02-19 23:12:30","in");
INSERT INTO rms_user_log VALUES("577","1","2015-02-20 11:24:27","in");
INSERT INTO rms_user_log VALUES("578","1","2015-02-20 13:25:43","in");
INSERT INTO rms_user_log VALUES("579","1","2015-02-20 23:31:36","in");
INSERT INTO rms_user_log VALUES("580","1","2015-02-21 00:26:25","in");
INSERT INTO rms_user_log VALUES("581","1","2015-02-21 15:02:14","in");
INSERT INTO rms_user_log VALUES("582","1","2015-02-23 10:09:23","in");
INSERT INTO rms_user_log VALUES("583","1","2015-02-24 20:31:41","in");
INSERT INTO rms_user_log VALUES("584","1","2015-02-27 10:43:41","in");
INSERT INTO rms_user_log VALUES("585","1","2015-02-27 11:40:49","in");
INSERT INTO rms_user_log VALUES("586","1","2015-02-27 11:41:51","in");
INSERT INTO rms_user_log VALUES("587","1","2015-02-27 14:36:57","in");
INSERT INTO rms_user_log VALUES("588","1","2015-02-27 14:46:09","in");
INSERT INTO rms_user_log VALUES("589","1","2015-02-27 15:24:05","in");
INSERT INTO rms_user_log VALUES("590","1","2015-02-27 18:27:04","in");
INSERT INTO rms_user_log VALUES("591","1","2015-02-27 18:32:23","in");
INSERT INTO rms_user_log VALUES("592","1","2015-03-03 15:04:19","in");
INSERT INTO rms_user_log VALUES("593","1","2015-03-03 15:06:37","in");
INSERT INTO rms_user_log VALUES("594","1","2015-03-25 10:59:47","in");
INSERT INTO rms_user_log VALUES("595","1","2015-03-30 11:18:15","in");
INSERT INTO rms_user_log VALUES("596","1","2015-04-01 10:56:53","in");
INSERT INTO rms_user_log VALUES("597","1","2015-04-02 10:20:32","in");
INSERT INTO rms_user_log VALUES("598","1","2015-04-02 12:03:02","in");
INSERT INTO rms_user_log VALUES("599","1","2015-04-02 12:03:36","in");
INSERT INTO rms_user_log VALUES("600","1","2015-04-02 12:04:01","in");
INSERT INTO rms_user_log VALUES("601","1","2015-04-03 18:07:25","in");
INSERT INTO rms_user_log VALUES("602","1","2015-04-03 18:26:31","in");
INSERT INTO rms_user_log VALUES("603","1","2015-04-03 18:28:03","in");
INSERT INTO rms_user_log VALUES("604","1","2015-04-06 10:25:39","in");
INSERT INTO rms_user_log VALUES("605","1","2015-04-06 15:23:08","in");
INSERT INTO rms_user_log VALUES("606","1","2015-04-07 09:46:22","in");
INSERT INTO rms_user_log VALUES("607","1","2015-04-07 09:50:15","in");
INSERT INTO rms_user_log VALUES("608","1","2015-04-07 21:45:43","in");
INSERT INTO rms_user_log VALUES("609","1","2015-04-08 10:18:24","in");
INSERT INTO rms_user_log VALUES("610","1","2015-04-08 10:35:50","in");
INSERT INTO rms_user_log VALUES("611","1","2015-04-09 11:02:16","in");
INSERT INTO rms_user_log VALUES("612","1","2015-04-09 15:26:44","in");
INSERT INTO rms_user_log VALUES("613","1","2015-04-09 15:40:42","in");
INSERT INTO rms_user_log VALUES("614","1","2015-04-09 15:56:30","in");
INSERT INTO rms_user_log VALUES("615","1","2015-04-09 20:56:34","in");
INSERT INTO rms_user_log VALUES("616","1","2015-04-10 10:10:42","in");
INSERT INTO rms_user_log VALUES("617","1","2015-04-11 18:50:52","in");
INSERT INTO rms_user_log VALUES("618","1","2015-04-11 20:13:56","in");
INSERT INTO rms_user_log VALUES("619","1","2015-04-11 22:40:27","in");
INSERT INTO rms_user_log VALUES("620","1","2015-04-13 09:56:22","in");
INSERT INTO rms_user_log VALUES("621","1","2015-04-14 07:30:44","in");
INSERT INTO rms_user_log VALUES("622","1","2015-04-15 08:20:15","in");
INSERT INTO rms_user_log VALUES("623","1","2015-04-15 13:36:11","in");
INSERT INTO rms_user_log VALUES("624","1","2015-04-15 17:04:03","in");
INSERT INTO rms_user_log VALUES("625","1","2015-04-15 22:42:01","in");
INSERT INTO rms_user_log VALUES("626","1","2015-04-16 11:57:47","in");
INSERT INTO rms_user_log VALUES("627","1","2015-04-16 16:07:52","in");
INSERT INTO rms_user_log VALUES("628","1","2015-04-16 22:23:23","in");
INSERT INTO rms_user_log VALUES("629","1","2015-04-17 13:22:31","in");
INSERT INTO rms_user_log VALUES("630","1","2015-04-17 15:56:49","in");
INSERT INTO rms_user_log VALUES("631","1","2015-04-17 22:24:31","in");
INSERT INTO rms_user_log VALUES("632","1","2015-04-18 12:54:41","in");
INSERT INTO rms_user_log VALUES("633","1","2015-04-18 18:57:33","in");
INSERT INTO rms_user_log VALUES("634","1","2015-04-18 20:21:31","in");
INSERT INTO rms_user_log VALUES("635","1","2015-04-18 22:36:00","in");
INSERT INTO rms_user_log VALUES("636","1","2015-04-20 07:56:47","in");
INSERT INTO rms_user_log VALUES("637","1","2015-04-21 07:38:09","in");
INSERT INTO rms_user_log VALUES("638","1","2015-04-22 10:04:22","in");
INSERT INTO rms_user_log VALUES("639","1","2015-04-22 16:14:14","in");
INSERT INTO rms_user_log VALUES("640","1","2015-04-23 10:34:46","in");
INSERT INTO rms_user_log VALUES("641","1","2015-04-23 10:49:20","in");
INSERT INTO rms_user_log VALUES("642","1","2015-04-23 12:07:03","in");
INSERT INTO rms_user_log VALUES("643","1","2015-04-23 12:20:37","in");
INSERT INTO rms_user_log VALUES("644","1","2015-04-24 11:28:34","in");
INSERT INTO rms_user_log VALUES("645","1","2015-04-24 12:16:00","in");
INSERT INTO rms_user_log VALUES("646","1","2015-04-24 16:12:56","in");
INSERT INTO rms_user_log VALUES("647","1","2015-04-25 19:17:11","in");
INSERT INTO rms_user_log VALUES("648","1","2015-04-26 09:11:07","in");
INSERT INTO rms_user_log VALUES("649","1","2015-04-26 09:15:21","in");
INSERT INTO rms_user_log VALUES("650","1","2015-04-27 10:54:10","in");
INSERT INTO rms_user_log VALUES("651","1","2015-04-27 11:11:48","in");
INSERT INTO rms_user_log VALUES("652","1","2015-04-27 11:30:08","in");
INSERT INTO rms_user_log VALUES("653","1","2015-04-28 11:11:33","in");
INSERT INTO rms_user_log VALUES("654","1","2015-04-28 16:31:17","in");
INSERT INTO rms_user_log VALUES("655","1","2015-04-28 17:04:55","in");
INSERT INTO rms_user_log VALUES("656","1","2015-04-29 09:51:24","in");
INSERT INTO rms_user_log VALUES("657","1","2015-04-29 10:08:23","in");
INSERT INTO rms_user_log VALUES("658","1","2015-04-29 10:09:24","in");
INSERT INTO rms_user_log VALUES("659","1","2015-04-29 10:10:00","in");
INSERT INTO rms_user_log VALUES("660","1","2015-04-29 10:10:25","in");
INSERT INTO rms_user_log VALUES("661","1","2015-04-29 10:31:26","in");
INSERT INTO rms_user_log VALUES("662","1","2015-04-29 12:28:50","in");
INSERT INTO rms_user_log VALUES("663","1","2015-04-29 12:29:43","in");



DROP TABLE rms_users;

CREATE TABLE `rms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` tinyint(1) DEFAULT '0' COMMENT '0: transfer; 1:admin',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO rms_users VALUES("1","?????","????","channy","5f4dcc3b5aa765d61d8327deb882cf99","1","1");
INSERT INTO rms_users VALUES("2","??????","????","soeurn","5f4dcc3b5aa765d61d8327deb882cf99","2","1");



