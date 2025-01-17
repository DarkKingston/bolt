<?
    include($_SERVER['DOCUMENT_ROOT']."/73naasfalteon.php");

	include($_SERVER['DOCUMENT_ROOT']."/". WS_PANEL ."/include.php");

	//защита от иньекций
	if( $Main->inject() ){
		header('HTTP/1.0 404 Not Found');
		header('Content-Type: text/html; charset=utf-8');
		if( true) { echo getErrorMessage( array( 'title' => 'error code: 1000' ) ); }
		include($_SERVER['DOCUMENT_ROOT']."/pages/404.php");
		exit;
	}
	
	$pageData = $CCpu->GetCPU();
	
	$Db->setlang($CCpu->lang);
	
	if($pageData['status']==='404'){ // CPU не найден в таблицу ws_cpu
        header('HTTP/1.0 404 Not Found');
        header('Content-Type: text/html; charset=utf-8');
        if( true ) { echo getErrorMessage( array( 'title' => 'error code: 1001' ) ); }
		include($_SERVER['DOCUMENT_ROOT']."/pages/404.php");
		exit;
	}elseif($pageData['status']==='redirect'){ 
		header('HTTP/1.1 301 Moved Permanently');
		header("Location: ".$pageData['data']);
		exit;
	} 
	
	$Main->lang = $CCpu->lang; 
	$_SESSION['last_lang'] = $CCpu->lang;
	
	$GLOBALS['ar_define_langterms'] = $Main->GetDefineLangTerms($CCpu->lang); 
	$page_data = $CCpu->GetPageData($pageData);  
	if(!$page_data){
		header('HTTP/1.0 404 Not Found');
	    header('Content-Type: text/html; charset=utf-8');
        if( true ) { echo getErrorMessage( array( 'title' => 'error code: 1002' ) ); }
	    include($_SERVER['DOCUMENT_ROOT']."/pages/404.php");
	    exit;
	}
	
	$defaultLinks = array();
	$defaultLinks['ajax'] = $CCpu->writelink( 3 );
	$defaultLinks['index'] = $CCpu->writelink( 1 );
	
	mb_internal_encoding("UTF-8");
	header('Content-Type: text/html; charset=utf-8');
	
	include($_SERVER['DOCUMENT_ROOT']."/pages".$pageData['page']);

    if(!isset($_SESSION['auth']['hash']) || $_SESSION['auth']['hash']=='' || !$_SESSION['auth']['hash'] || 1) {

        $_SESSION['auth']['hash'] = $_COOKIE['PHPSESSID'];

    }