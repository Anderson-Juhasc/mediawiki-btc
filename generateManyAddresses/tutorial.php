<?php
if ($_POST) {
    print_r($_POST);
    //$numAddresses = 3;
    //$APICODE = "my-api-code";
    //$EMAIL = $_POST['email'];
    //$PW = $_POST['password'];

    //$WALLET_URL = "https://blockchain.info/pt/api/v2/create_wallet";
    //$WALLET_URL .= "?api_code=$APICODE";
    //$WALLET_URL .= "&password=$PW";

    //if (!empty($EMAIL)) {
    //    $WALLET_URL .= "&email=$EMAIL";
    //}

    //$newWallet = json_decode(file_get_contents($WALLET_URL), true);

    //$receivingAddress = $newWallet["address"];

    //$addressesArray = array();

    //for ($i = 0; $i < $numAddresses; $i++) {
    //    $newAddr = json_decode(file_get_contents("https://blockchain.info/api/receive?method=create&address=$receivingAddress"), true);
    //    $addressesArray[] = $newAddr["input_address"];
    //}

    //$addressesJson = json_encode($addressesArray);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
    <style type="text/css">
        label {
            display:block;
        }

        ul {
            margin-bottom:0;
        }
    </style>
</head>
<body>
<?php if ($_POST) : ?>
    <!--h1>Nova Carteira</h1>
    <pre>
        <?php print_r($newWallet); ?>
    </pre>
    <h1>Array de endereços</h1>
    <pre>
        <?php print_r($addressesArray); ?>
    </pre>
    <h1>JSON de endereços</h1-->
    <?php print_r($addressesJson); ?>
<?php else : ?>
    <h1>Criar Carteira</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <label for="">Email(opcional):</label>
                <input value="" name="email" type="text" />
            </li>
            <li>
                <label for="">Senha:</label>
                <input value="" name="password" required type="password" />
            </li>
            <li>
                <label for="">Confirmar Senha:</label>
                <input value="" name="pw2" required type="password" />
            </li>
            <li>
                <input id="" name="" type="checkbox" /> Lembrar dados de login.
            </li>
            <li>
                <button name="create-wallet" type="submit">Continue</button>
            </li>
        </ul>
    </form>

    <h1>Acessar Carteira</h1>
    <p>Você precisa abrir sua carteira para fazer um pequeno ajuste e poderemos continuar.</p>
    <p>
        <a href="">Acessar Carteira</a>
    </p>
    <img src="img/1.png" alt="" />
    <img src="img/2.png" alt="" />
    <img src="img/3.png" alt="" />
    <img src="img/4.png" alt="" />
    <img src="img/5.png" alt="" />
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <button name="open-wallet" type="submit">Continue</button>
            </li>
        </ul>
    </form>

    <h1>Gerar Endereços</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <label for="">Blockchain Wallet ID:</label>
                <input value="" required name="id" type="text" />
            </li>
            <li>
                <label for="">Senha:</label>
                <input value="" name="pw" required type="password" />
            </li>
            <li>
                <label for="">Senha Secundária(opcional):</label>
                <input value="" name="pw2" type="password" />
            </li>
            <li>
                <button name="generate-addresses" type="submit">Gerar endereços</button>
            </li>
        </ul>
    </form>
<?php endIf ?>
</body>
</html>
