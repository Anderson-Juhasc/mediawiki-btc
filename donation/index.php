<?php
if ($_POST) {
    // selecionar um endereço da row
    $ADDR = "13Yi35u1KFeNdzjgKv7gAy6auR7qWPxXFx";
    // grava a data da exibicao e a data de expiracao com 10min extra no banco
    $TIME = date("D M d Y H:i:s O");
    $ENDTIME = date("D M d Y H:i:s O", strtotime($TIME) + 600); // add 10min
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
    <style type="text/css">
        .bar {
            border:1px solid #eee;
            padding: 1px;
            margin-bottom: 12px;
            overflow: hidden;
            width: 250px;
        }

        .bar__percent {
            background: #eee;
            float: right;
            height: 12px;
            width:100%;
        }
    </style>
    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
<?php if ($_POST) : ?>
    <h1>Fazer Doação</h1>
    <p>
        <a href="bitcoin:<?php echo $ADDR; ?>">
            <?php echo $ADDR; ?>
        </a>
    </p>
    <p>
        <a href="bitcoin:<?php echo $ADDR; ?>">
            <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chld=L|0&chl=bitcoin:<?php echo $ADDR; ?>" alt="" />
        </a>
    </p>

    <div class="bar">
        <div id="bar" class="bar__percent"></div>
    </div>
    <div id="countdown"></div>
    <div id="result">Esperando pagamento...</div>

    <script type="text/javascript">
        $(document).ready(function() {
            var url = "https://blockchain.info/";
            var bal;

            function checkBalance() {
                $.ajax({
                    type: "GET",
                    url: url + "q/getreceivedbyaddress/<?php echo $ADDR; ?>?confirmations=0",
                    data: {format : 'plain'},
                    success: function(response) {
                        if (!response) return;

                        var value = parseInt(response);

                        if (value > 0) {
                            $('#result').text("Recebido!");
                            $('#countdown').text('');
                            $('#bar').css("width", 0 + "%");
                            clearInterval(timer);
                            clearInterval(bal);

                            $.ajax({
                                type: "POST",
                                url: "save-tx.php",
                                data: {addr : "<?php echo $ADDR; ?>"},
                                success: function(response) {
                                    console.log(response);
                                }
                            });
                        } else {
                            bal = setTimeout(checkBalance, 5000);
                        }
                    }
                });
            }
            ///Check for incoming payment
            bal = setTimeout(checkBalance, 5000);


            var timer;
            var end = new Date('<?php echo $ENDTIME; ?>');
            var barWidth = 100;
            var secondsToEnd = parseInt((end - new Date()) / 1000);
            var percent = (100 / secondsToEnd);

            function countDown() {
                var second = 1000;
                var minute = second * 60;
                var hour = minute * 60;
                var day = hour * 24;
                var now = new Date();
                var distance = end - now;

                if (distance < 0) {
                    clearInterval(timer);
                    clearInterval(bal);
                    $('#bar').css("width", 0 + "%");
                    $('#countdown').text('Expirou!');
                    $('#result').text('');

                    return;
                }

                var days = Math.floor(distance / day);
                var hours = Math.floor((distance % day) / hour);
                var minutes = Math.floor((distance % hour) / minute);
                var seconds = Math.floor((distance % minute) / second);

                var expire = "Expira em: " + minutes + ':';
                    expire += (seconds < 10 ? '0' : '') + seconds;

                barWidth = barWidth - percent;
                $('#bar').css("width", barWidth + "%");
                $('#countdown').text(expire);
            }

            // inicia funcao countDown
            countDown();
            timer = setInterval(countDown, 1000);
        });
    </script>
<?php else : ?>
    <h1>Doação</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <button name="btn" type="submit">Doar</button>
            </li>
        </ul>
    </form>
<?php endIf ?>
</body>
</html>
