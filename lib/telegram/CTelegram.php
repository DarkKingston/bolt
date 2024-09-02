<?

class Telegram {
    /*

     * 1 В телеграмме в поике находим BotFather

     * 2 пишем ему /newbot для создания бота через которого и будут отсылаться сообщения

     * 3 Когда бот создан вы получите его token

     * 3 Далее следуем инструкции (Называем бота, добавлем фото, описание т.д.)

     * 4 Находим в поиске нашего бота и пишем ему  /start

     * 5 https://api.telegram.org/bot[token]/getUpdates По этой ссылке получаем id

     * 		вместо [token] указываем token который мы получили

     * https://api.telegram.org/bot6249814005:AAFjDuvYTj2IVisbncOq0g_-q9QQHfUCxbs/getUpdates По этой ссылке получаем id

     * {

     * 	"ok":true,

     * 	"result":[

     * 		{

     * 			"update_id":945410549,

     * 			"message":{"message_id":1,

     * 			"from":{

     * 				--------------"id":564183869,-------------------

     * 				"is_bot":false,

     * 				"first_name":"\u0410\u043d\u0434\u0440\u0435\u0439",

     * 				"last_name":"\u041f\u043e\u043b\u0438\u0449\u0443\u043a",

     * 				"username":"andreip1997",

     * 				"language_code":"ru"

     * 			},

     * 			"chat":{"id":564183869,

     * 				"first_name":"\u0410\u043d\u0434\u0440\u0435\u0439",

     * 				"last_name":"\u041f\u043e\u043b\u0438\u0449\u0443\u043a",

     * 				"username":"andreip1997",

     * 				"type":"private"

     * 			},

     * 			"date":1602933236,

     * 			"text":"/start",

     * 			"entities":[

     * 				{

     * 				"offset":0,

     * 				"length":6,

     * 				"type":"bot_command"

     * 				}

     * 			]

     * 		}

     * }

     * 6 id чата для отсылки сообщений в личку "id". Пример:564183869

     * 		Для отсылки сообщений в группу id будет со знаком "-". Пример:-472498896

     * 7 В файле include.php объявляем класс следующим образом

     * 		include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/include/CTelegram.php");

     * 		$Telegram = new Telegram(array('bot_token'=>'[token]', 'chat_id'=>'id чата'));

     * 8 Для отправки сообщения конкретному пользователю используем функцию $Telegram->send_message_user("Текст сообщения")

     */

    // $text -Текст сообщения
    // $chat_id - id чата
    // $token - персональный токен

    var $token='';
    var $chat_id="";
    public function __construct($arr){
        $this->token= $arr['bot_token'];
        $this->chat_id=$arr['chat_id'];
    }

    // https://tlgrm.ru/docs/bots/api#sendmessage
    // https://tlgrm.ru/docs/bots/api#setwebhook
    function send_message_user( $text, $replyMarkup = false){
        global $db;

        // $Url ="https://api.telegram.org/bot".$this->token."/getUpdates";

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot'.$this->token.'/sendMessage');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);

        $data = array(
            'chat_id'=> $this->chat_id,
            'text'=> ($text),
            'parse_mode'=> 'HTML',
            'disable_web_page_preview'=> true,
             //'reply_markup' =>
        );

        if( $replyMarkup != false ){
            $data['reply_markup'] = json_encode( $replyMarkup);
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, (http_build_query( $data)) );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        $result = curl_exec($ch);

        $arrTitle = $arrVal = array();
        $arrTitle[] = " title "; $arrVal[] = " 'send_message_user/api 2' ";
        $arrTitle[] = " date "; $arrVal[] = " NOW() ";
        $arrTitle[] = " text "; $arrVal[] = " '".json_encode($data) ." --- RESULT ".$result."' ";
        mysqli_query($db, " INSERT INTO ws_telegram_api ( ".implode(',', $arrTitle)." ) VALUES ( ".implode(',', $arrVal)." ) ");

        curl_close($ch);

        return $result;

    }

} 