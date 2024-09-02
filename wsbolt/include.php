<?
	ini_set('zlib.output_compression', 'On');
	ini_set('zlib.output_compression_level', '1');

	session_start();

    error_reporting( 0 );

    include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/config.php");
    
    date_default_timezone_set($GLOBALS['timezone']);

	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/db.php");
	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CMain.php");
	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CCpu.php");
	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CDb.php");
    include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CClient.php");
	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/functions.php");

	$CCpu = new CCpu();
	$Main = new CMain();
	$Db = new CDb();
    $Client = new CClient();
	
	$GLOBALS['ar_define_settings'] = $Main->GetDefineSettings();
    $GLOBALS['auth_fields'] = array('email', 'login');
	
	include($_SERVER['DOCUMENT_ROOT']."/". WS_PANEL ."/view_access/access.php");
	
	if( substr_count($_SERVER['REQUEST_URI'], "/". WS_PANEL ."/")>0 ){
	    include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CUser.php");
	    $User = new CUser(); 
	    $CCpu->lang = $User->lang;
		
	    $GLOBALS['CPLANG'] = $User->GetDefineLangTerms( $User->interface_lang );
	    $Admin = $User;
	}

