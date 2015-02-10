<?php
if ($_POST) {
    // query que conta quantos enderecos ainda existem
    $addressCount = 49;
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
    <h1>Novos Endereços</h1>
    <div id="newAddresses">Aguardando...</div>

    <script type="text/javascript">
        $(document).ready(function() {
            if (<?php echo $addressCount; ?> < 50) {
                $.ajax({
                    type: "POST",
                    url: "newaddresses.php",
                    data: { author: 10 },
                    success: function(response) {
                        if (!response) return;

                        $('#newAddresses').html(response);
                    }
                });
            }
        });
    </script>
<?php else : ?>
    <h1>Checagem da quantidade de endereços</h1>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <ul>
            <li>
                <button name="btn" type="submit">Checar</button>
            </li>
        </ul>
    </form>
    <p>
        <strong>Nota:</strong> Esse script pode ser iniciado após clicar em doar na página do artigo.
    </p>
<?php endIf ?>
</body>
</html>
