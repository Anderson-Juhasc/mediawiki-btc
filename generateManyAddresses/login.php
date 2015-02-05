<?php
if ($_POST) {
    $numAddresses = 3;
    $ID = $_POST["id"];
    $PW = $_POST["pw"];
    $PW2 = $_POST["pw2"];

    $URL = "https://blockchain.info/merchant/";
    $URL .= $ID . '/';
    $URL .= "new_address?password=$PW";

    if (!empty($PW2)) {
        $URL .= "&second_password=$PW2";
    }

    $URL = urlencode($URL);

    $addressArray = array();

    for ($i = 0; $i < $numAddresses; $i++) {
        $newAddr = json_decode(file_get_contents($URL), true);
        $addressArray[] = $newAddr['address'];
    }

    $addressJson = json_encode($addressArray);
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
    </style>
</head>
<body>
<?php if ($_POST) : ?>
    <h1>URL</h1>
    <?php print_r($URL); ?>
    <h1>Array de endereços</h1>
    <pre>
        <?php print_r($addressArray); ?>
    </pre>
    <h1>JSON de endereços</h1>
    <?php print_r($addressJson); ?>
<?php else : ?>
    <h1>Gerar endereços se logando</h1>
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
                <input id="" name="" type="checkbox" /> Lembrar dados de login.
            </li>
            <li>
                <button type="submit">Gerar endereços</button>
            </li>
        </ul>
    </form>
    <br />
<?php endIf ?>
<br />
<p><strong>NOTA:</strong> É necessário logar na nova carteira e acessar as configurações para ativar acesso à API da carteira para gerar novos endereços sem limitação.</p>
</body>
</html>
