<?
$Lang = $Main->GetDefaultLanguage();
$lang = $Lang['code'];
if(isset($_SESSION['last_lang']) && in_array($_SESSION['last_lang'], $CCpu->langList)){
    $lang = $_SESSION['last_lang'];
}

$CCpu->lang = $Main->lang = $lang;

$GLOBALS['ar_define_langterms'] = $Main->GetDefineLangTerms( $lang );
$defaultLinks['index'] = $CCpu->writelinkOne(1);
$page_404 = 0 ;
?>
<!DOCTYPE html>
<html lang="<?=$CCpu->lang?>">
	<head>
		<?include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/head.php")?>
	</head>
	<body>
		<?include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/whitefog.php")?>
		
		
		<div id="content" >
			<div id="page">

                <? include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/header.php") ?>

				<div class="container">

                    <div style="text-align: center">
                        <img src="/images/404.png" alt="">
                    </div>
                    <div style="text-align: center">
                        <h3>
                            Page not found
                        </h3>
                    </div>

				</div>

			</div>	
		</div>
	
		
		<?include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/footer.php")?>
        <script>
            $(".toptop").click(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("body").offset().top
                }, 1000);
            });
        </script>
	</body>
</html>