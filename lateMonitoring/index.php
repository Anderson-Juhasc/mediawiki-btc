<?php
if ($_POST) {
    // selectiona enderecos q ainda não tem 6 confirmacoes e pega data final/hora da doacao
    $ADDR = '1NrmXPsi9Lez8Z6xfUkWZ412smRANNN14W';
    //$ADDR = '13Yi35u1KFeNdzjgKv7gAy6auR7qWPxXFx';
    $ENDTIME = date("D M d Y H:i:s O");
    $TIME_MONITORED = date("D M d Y H:i:s O", strtotime($ENDTIME) + 1800); // 1800 - add 30 min
    //$TIME_MONITORED = date("D M d Y H:i:s O", strtotime($ENDTIME) - 1800); // 1800 - remove 30 min
    $NUM_MONITORING = 0;

    $DISTANCE = strtotime($TIME_MONITORED) - strtotime($ENDTIME);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<?php if ($_POST) : ?>
<?php
    if ($DISTANCE < 0) {
        $VALUE = json_decode(file_get_contents("https://blockchain.info/q/addressbalance/$ADDR?confirmations=6"), true);

        if ($VALUE > 0) {
            echo "Value: " . $VALUE . ". Gravar no banco e para o monitoramento da transação atual.";
        } else {
            if (!($NUM_MONITORING >= 3)) {
                echo "Acrescentar mais 30min para a próxima monitoração.";

                $ENDTIME = $TIME_MONITORED;
                $TIME_MONITORED = date("D M d Y H:i:s O", strtotime($ENDTIME) + 1800); // 1800 - add 30 min

                $NUM_MONITORING++; // incrementa +1
            } else {
                echo "Para monitoramento!";
            }
        }
    } else {
        echo "Ainda não deu a hora.";
    }
?>
<?php else : ?>
    <h1>Monitorar Tardio</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <button name="btn" type="submit">Checar</button>
            </li>
        </ul>
    </form>
<?php endIf; ?>
</body>
</html>
