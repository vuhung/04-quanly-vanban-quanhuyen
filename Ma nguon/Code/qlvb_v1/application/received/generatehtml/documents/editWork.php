<?php
// Dinh nghia duong dan den thu vien cua Zend
	set_include_path('../../../../library/'
			. PATH_SEPARATOR . '../../../../application/models/'
			. PATH_SEPARATOR . '../../../../config/');
			
	// Goi class Zend_Load
	include "../../../../library/Zend/Loader.php";	
	Zend_Loader::loadClass('Zend_Config_Ini');
	Zend_Loader::loadClass('Zend_Registry');
	Zend_Loader::loadClass('Sys_Library');
	Zend_Loader::loadClass('Zend_Db');	
	Zend_Loader::loadClass('Sys_DB_Connection');
	Zend_Loader::loadClass('Sys_Function_DocFunctions');
	Zend_Loader::loadClass('Sys_Init_Config');
	//Ket noi CSDL SQL theo kieu ADODB
	$connectSQL = new Zend_Config_Ini('../../../../config/config.ini','dbmssql');
	$registry = Zend_Registry::getInstance();
	$registry->set('connectSQL', $connectSQL);
	$connAdo = Sys_Db_Connection::connectADO($connectSQL->db->adapter,$connectSQL->db->config->toArray());			
	//Load class Received_modReceived
	Zend_Loader::loadClass('Received_modReceived');
	$objReceive = new received_modReceived();
	$objDocFun = new Sys_Function_DocFunctions();	
	$pWorkId = $_REQUEST['hdn_work_id'];
	
	//File dinh kem
	$arFileAttach = $objReceive->DOC_GetAllDocumentFileAttach($pWorkId,'','T_DOC_WORK');	
	$attachFile = $objDocFun->DocSentAttachFile($arFileAttach,sizeof($arFileAttach),10,true,60);
	echo $attachFile; exit;
		
?>