<?php
    if ($_POST['author']) {
        $numAddresses = 3;

        // pega os dados do autor no banco
        $ID = "0ea8ba80-5fc1-4a42-8e2a-a024a2fe9fe5";
        $PW = "firefoxd6ww";
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
