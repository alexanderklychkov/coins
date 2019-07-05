<?php session_start(); ?>
<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/header.php");?>

<main>
    <div class="container">
        <div class="game-box">
            <h1>Игра "Монетки"</h1>
            <p><img src="_img/coins.png" width="300" height="400" alt=""></p>
            <p class="red"><?= $_GET['get']; ?></p>
            <form class="form-game" action="_functions/start.php" method="get">
                <input type="text" name="login" placeholder="Ваше имя" required><br>
                <input type="submit" name="do_enter" value="Начать игру">
            </form>
        </div>
    </div>
</main>

<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/footer.php"); ?>