<?
/* используется при создании хэша пароля */
$GLOBALS['security_salt'] = 'eSf!%3eJJaPGY09'; // указать длину от 15 символов // https://www.lastpass.com/password-generator
if( $GLOBALS['security_salt'] == '' || strlen( $GLOBALS['security_salt'] ) < 15 ) {
    exit( 'error code: 800' );
}

$GLOBALS['project_name'] = 'Resurse Gal3coline'; // Указывать название проекта, виден в админ панели
if( $GLOBALS['project_name'] == '' ) {
    exit( 'error code: 804' );
}
/* режим работы dev | public; влияет на вывод ошибок, частоту формирования бэкапа бд */
//$GLOBALS['mode'] = 'public';

/* окончание урл-ов - со слэшем или нет */
$GLOBALS['last_slash'] = true;

/* Unblocking Key */
// $GLOBALS['uk'] = '1n8dm1hZ90bFuTBb';

/* Protocol */
//$GLOBALS['protocol'] = stripcs( $_SERVER['SERVER_PROTOCOL'] , 'https' ) === true ? 'https://' : 'http://';
$GLOBALS['protocol'] = 'http://';
/* Default timezone */
$GLOBALS['timezone'] = 'Europe/Chisinau';

/* доступы к БД */
$SERVER_NAME    = "localhost";
$DB_LOGIN       = "starknetbolt";
$DB_PASS        = "Wolfman4500";
$DB_NAME        = "starknetbolt";

// используется в созданий авто бэкапов и в ручную из админке
// $dateName = date("Y-m-d-H");
/*
switch ( $GLOBALS['mode'] ) {
	case 'dev':
		error_reporting( E_ALL );
		break;

	case 'public':
		error_reporting( 0 );
		break;

	default:
		error_reporting( E_ERROR );
		break;
}*/

