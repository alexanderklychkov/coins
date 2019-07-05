<?php 
    session_start();
    if($_SESSION['user'] == "") {
        header('Location:index.php');
    }
    
    $_SESSION['score'] = 0;
?>
<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/header.php");?>

<main>
    <div class="container">
        <div class="game-box">
            <h1>Игра "Монетки"</h1>
            <p class="no-margin"><canvas id="myCanvas" width="400" height="400"></canvas></p>
            <div class="game-main-up">
                <p><?php echo $_SESSION['user']; ?></p>
                <p><span id="minutes"><?= $minutes ?></span> : <span id="seconds"><?= $seconds ?></span></p>
                <p>Очки: <span id="score"><?= $_SESSION['score']; ?></span></p> 
            </div>
            <div class="game-main-down">
                <a href="#"><img src="_img/left.png" width="60" height="60"></a>
                <a href="#" onmouseover="pressRight()"><img src="_img/right.png" width="60" height="60"></a>
            </div>
        </div>
    </div>
</main>

<div id="modal">
    <div class="modal-box">
        <h3 class="red">Вы проиграли!</h3>
        <button>Продолжить</button>
    </div>
</div>
<script>

    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");

    // Изображения
    var basket = new Image();
    var coin = new Image();
    var wood = new Image();
    var bg = new Image();

    basket.src = "../_img/basket2.png";
    coin.src = "../_img/coin.png";
    wood.src = "../_img/wood.png";
    bg.src = "../_img/bg.jpg";

    // Позиция корзины
    var xPos = (canvas.width-70)/2;
    var yPos = 330;

    var number = 0;
    var heart = 1;

    // Управление
    var rightPressed = false;
    var leftPressed = false;

    document.addEventListener("keydown", keyDownHandler, false);
    document.addEventListener("keyup", keyUpHandler, false);

    function keyDownHandler(e) {
        if(e.keyCode == 39) {
            rightPressed = true;
        }
        else if(e.keyCode == 37) {
            leftPressed = true;
        }
    }

    function keyUpHandler(e) {
        if(e.keyCode == 39) {
            rightPressed = false;
        }
        else if(e.keyCode == 37) {
            leftPressed = false;
        }
    }

    // Рандомное число
    function getRandom(min, max) {
        return Math.random() * (max - min) + min;
    }

    // Создание монет
    var countCoins = 0;
    var coins = [];

    coins[0] = {
        x : getRandom(0, 360),
        y : 10
    }

    var woods = [];

    woods[0] = {
        x : getRandom(0, 360),
        y : 120
    }

    function draw() {
        ctx.drawImage(bg, 0, 0);  
        ctx.drawImage(basket, xPos, yPos);

        if (rightPressed && xPos < canvas.width-70) {
            xPos += 6;
        }

        if (leftPressed && xPos > 0) {
            xPos -= 6;
        }

        

        for (var i = 0; i < coins.length; i++) {
            ctx.drawImage(coin, coins[i].x, coins[i].y);
            coins[i].y++;

            if(coins[i].y == 100) {
            countCoins++;

            coins.push({
                x : getRandom(0, 360),
                y : 10
            });
            }

            if(coins[i].x >= xPos-35
            && coins[i].x <= xPos+65
            && coins[i].y >= 300 
            && coins[i].y <= 370 ) {
                number++;  
                document.getElementById('score').innerText=number;
                delete coins[i].y;
            } else if (coins[i].y > 400) {
            heart--;
            delete coins[i].y;
            } else if(heart == 0) {
                delete coins[i];
                delete woods[i];
                var modal = document.getElementById('modal');
                modal.style.display = 'flex';

                var button = document.querySelector("button");
                button.addEventListener("click", function(){
                    location.href = "_functions/score.php?score=" + number;
                });
            }
        }

        for (var i = 0; i < woods.length; i++) {
            ctx.drawImage(wood, woods[i].x, woods[i].y);
            woods[i].y++;
            if((countCoins % 4) == 0){
            countCoins++;
            woods.push({
                x : getRandom(0, 360),
                y : 60
            });
            }
            if(woods[i].x >= xPos-35
            && woods[i].x <= xPos+65
            && woods[i].y >= 300 
            && woods[i].y <= 370 ) {
                heart--;
                delete woods[i].y;
            }
        }

        ctx.drawImage(basket, xPos, yPos);

        ctx.fillStyle = "#000";
        ctx.font = "24px Verdana";
        ctx.fillText("Жизни: " + heart, 10, 30);
        
        requestAnimationFrame(draw);
    }

    // Таймер 
    function timer() {
    let minutes = '0' + 0;
    let seconds = '0' + 0;
        
    document.getElementById('minutes').innerText = minutes;
    document.getElementById('seconds').innerText = seconds;  

    setInterval(function(){
        seconds++;
        document.getElementById('seconds').innerText = '0' + seconds;
        if (seconds > 9) document.getElementById('seconds').innerText = seconds;
        if (seconds === 60) {
        minutes++;
        document.getElementById('minutes').innerText = '0' + minutes;
        if (minutes > 9) document.getElementById('minutes').innerText = minutes;
        seconds = 0;
        document.getElementById('seconds').innerText = '0' + seconds;
        }    
    }, 1000); 
    }

    timer();

    bg.onload = draw;

</script>


<?php include_once ($_SERVER["DOCUMENT_ROOT"] . "/_include/footer.php"); ?>