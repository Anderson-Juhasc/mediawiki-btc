<?php
if ($_POST) {
    // selectiona enderecos q ainda não tem 6 confirmacoes e pega data final/hora da doacao
    //$ADDR = '1NrmXPsi9Lez8Z6xfUkWZ412smRANNN14W';
    $ADDR = '13Yi35u1KFeNdzjgKv7gAy6auR7qWPxXFx';
    $ENDTIME = date("D M d Y H:i:s O");
    $TIME_MONITORED = date("D M d Y H:i:s O", strtotime($ENDTIME) + 3600); // add 1 hour

    $DISTANCE = strtotime($TIME_MONITORED) - strtotime($ENDTIME);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
    <style type="text/css">
    </style>
    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
<?php if ($_POST) : ?>
    <?php if ($DISTANCE < 0) : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var url = "https://blockchain.info/";

            $.ajax({
                type: "GET",
                url: url + "q/addressbalance/<?php echo $ADDR; ?>?confirmations=6",
                data: { format : 'plain'},
                success: function(response) {
                    if (!response) return;

                    var value = parseInt(response);

                    if (value > 0) {
                        console.log("Valor: " + value + ". Gravar no banco e para o monitoramento da transação atual.");
                    } else {
                        console.log("Valor: " + value + ". Acrescentar mais 1 hora e grava no banco.");

                        <?php
                            $ENDTIME = $TIME_MONITORED;
                            $TIME_MONITORED = date("D M d Y H:i:s O", strtotime($ENDTIME) + 3600); // add more 1 hour
                        ?>
                    }
                }
            });
        });
    </script>
    <?php endIf ?>
<?php else : ?>
    <h1>Monitorar Tardio</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <button name="btn" type="submit">Checar</button>
            </li>
        </ul>
    </form>
<?php endIf ?>
</body>
</html>
