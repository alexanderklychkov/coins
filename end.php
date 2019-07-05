<?php
  session_start();
  require_once "db.php";
  $listPlayers = getPlayersList();
  unset($_SESSION['user']);
?>
<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/header.php");?>

<main>
    <div class="container">
        <div class="game-box">
            <h1>Игра "Монетки"</h1>
            <h2>Игра закончена</h2>
            <table border="1" align="center" width="400">
              <tr>
                <th>№</th>
                <th>Имя игрока</th>
                <th>Очки</th>
              </tr>
              <?php
                $number = 1;
                for ($i = 0; $i < sizeof($listPlayers) && $i < 10; $i++) { ?>
                  <tr>
                    <td><?=$listPlayers[$i][0]?></td>
                    <td><?=$listPlayers[$i][2]?></td>
                    <td><?=$listPlayers[$i][3]?></td>
                  </tr>
              
              <?php } ?>
            </table>
            
            <a class="home" href="index.php">На главную</a>

        </div>
    </div>
</main>

<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/footer.php"); ?>