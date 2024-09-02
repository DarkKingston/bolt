<?php
// 87.236.20.180

/**
 * @transmixt_notification_bot


Use this token to access the HTTP API:
6249814005:AAFjDuvYTj2IVisbncOq0g_-q9QQHfUCxbs
Keep your token secure and store it safely, it can be used by anyone to control your bot.

 * // https://api.telegram.org/bot5939118080:AAECSZjubTa4jlLhDacgpEH-WJSYz7uk9KA/setWebhook?url=https://floriangro.md/callbackcincstar/?token=cincstarTG
 * Дорин, это ссылка на вебхуки
 *
 *
 *
 * // $ar_clean['message']['text']; // /actual_catalog /start
    // $ar_clean['message']['chat']['id'];
 */

chdir( dirname(__FILE__) );

include_once '../../adminka/config.php';
include_once '../../adminka/include/functions.php';
include_once '../../adminka/include/CCpu.php';
include_once '../../adminka/include/CDb.php';
include_once 'CTelegram.php';

$db =  mysqli_connect($SERVER_NAME, $DB_LOGIN, $DB_PASS, $DB_NAME);
mysqli_set_charset($db, "utf8");

$CCpu = new CCpu();
$Db = new CDb();

$bot_token = 'token';

$data = file_get_contents('php://input');
$data = $data_input = json_decode($data, 1);
$ar_clean = filter_var_array( $data, FILTER_SANITIZE_SPECIAL_CHARS);
$callback_query = $data['callback_query']['data'];


$Cbot = new Telegram( array('bot_token'=> $bot_token, 'chat_id'=> 'id чата, в который бот будет отправлять уведомления') );


$filename = 'cincStarChatIds.txt';
$book_content = file_get_contents($filename);
$book_content = json_decode($book_content , 1);


?>