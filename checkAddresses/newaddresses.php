<?php
    if ($_POST['author']) {
        //echo $_POST['author'];

        $numAddresses = 3;

        // pega os dados do autor no banco
        $ID = "3ce246ef-91f1-4d64-b1d4-5f2d3ba20f86";
        $PW = "firefox12345";
        $PW2;

        $URL = "https://blockchain.info/merchant/";
        $URL .= $ID . '/';
        $URL .= "new_address?password=$PW";

        if (!empty($PW2)) {
            $URL .= "&second_password=$PW2";
        }

        $addressArray = array();

        for ($i = 0; $i < $numAddresses; $i++) {
            $newAddr = json_decode(file_get_contents($URL), true);
            $addressArray[] = $newAddr['address'];
        }

        $addressJson = json_encode($addressArray);

        echo $addressJson;
    } else {
        // envia mensagem privada
    }
?>
