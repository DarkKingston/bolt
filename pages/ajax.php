<?
$ar_clean = filter_input_array( INPUT_POST , FILTER_SANITIZE_SPECIAL_CHARS);
if ( !isset( $_POST ) || empty( $_POST ) || !isset( $_POST['task'] ) ) { exit; }


/* Выход из аккаунта */
if ($ar_clean['task'] === 'exit' ){

    unset($_SESSION['user']);

}

/* авторизация на сайте */

if($ar_clean['task'] === 'authorization'){

    $user = $Client->auth( $ar_clean['login'], $ar_clean['password'] );

    if($user){

        echo "ok";

    }else{

        echo $GLOBALS['ar_define_langterms']['MSG_MSG_ACCOUNT_NEVERNIE_DANNIE'];

    }

}

