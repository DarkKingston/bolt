<?
// ---- - -- -- - - - -- - - - - - -
    if( substr(sprintf('%o', fileperms($_SERVER['DOCUMENT_ROOT'] . '/' . '73naasfalteon.php')), -4) != '0600' ) {
        $r = chmod($_SERVER['DOCUMENT_ROOT'] . '/' . "73naasfalteon.php", 0600 );
        if( !$r ) {
            exit('Error permission');
        }
    }


    $path = 'wsbolt'; /** НАЗВАНИЕ ПАПКИ АДМИН ПАНЕЛИ */
    if( !is_dir( $_SERVER['DOCUMENT_ROOT'] . '/' . $path ) || $path == '' ) {
        exit( 'error code: 801' );
    }
    define( "WS_PANEL" , $path );
		
// ---- - -- -- - - - -- - - - - - - END

include_once $_SERVER['DOCUMENT_ROOT'] . "/errors_functions.php";
	