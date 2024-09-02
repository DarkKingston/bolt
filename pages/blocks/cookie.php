<? if ($_COOKIE['cookie_alert'] == 0) { ?>
<section class="cookie">
    <div class="cookie_title">
        <?=$GLOBALS['ar_define_langterms']['MSG_MSG_COOKIE_FILE_COOKIE']?>
    </div>
    <div class="cookie_descr">
        <?=$GLOBALS['ar_define_langterms']['MSG_MSG_COOKIE_COOKIE_DESCR']?>
    </div>
    <div class="cookie_btns">
        <button class="cookie_accept" onclick="cookie_alert_close()">
            <?=$GLOBALS['ar_define_langterms']['MSG_MSG_COOKIE_ACCEPT']?>
        </button>
        <button class="cookie_ignore">
            <?=$GLOBALS['ar_define_langterms']['MSG_MSG_COOKIE_IGNORE']?>
        </button>
    </div>
</section>
<?}?>
<script>
    //cookie close
    const cookieAccept = document.querySelector('.cookie_accept');
       const cookieIgnore = document.querySelector('.cookie_ignore');
       const cookie = document .querySelector('.cookie');
       
       cookieAccept.addEventListener('click', () => {
            cookie.classList.add('btn_hidden');
       });
       
       cookieIgnore.addEventListener('click', () => {
            cookie.classList.add('btn_hidden');
       });

    //cookie close end
</script>