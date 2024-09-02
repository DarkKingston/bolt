<!DOCTYPE html>
<html lang="<?=$CCpu->lang?>">
<head>
	<? include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/head.php") ?>
</head>
<body>


<header class="header">
		<? include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/header.php") ?>
</header>



    <main class="main">
       <div class="container">

           main

       </div>
    </main>

    <footer class="footer">
		<? include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/footer.php") ?>
    </footer>
	<? include($_SERVER['DOCUMENT_ROOT']."/pages/blocks/script_link.php") ?>
<script>
    $(".toptop").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("body").offset().top
        }, 1000);
    });

</script>
<script>
    function showPopup(){
        $('.call_popup').show();
    }
    function hide_call(){
        $('.call_popup').hide();
    }
</script>
</body>
</html>