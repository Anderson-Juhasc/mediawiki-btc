<?php
    if ($_POST['addr']) {
        $ADDR = $_POST['addr'];

        $addrData = array();

        $data = json_decode(file_get_contents("https://blockchain.info/address/$ADDR?format=json"), true);

        $addrData['amount'] = $data['total_received'];
        $addrData['txhash'] = $data['txs'][0]['hash']; // pega o hash da posicao 0 da tx
        $addrData['time'] = $data['txs'][0]['time']; // pega a data da posicao 0 da tx

        $dataJson = json_encode($addrData);

        echo $dataJson;
    }
?>
