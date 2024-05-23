<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = floatval($_POST['valor']); // Converta para float aqui

    require __DIR__ . '/vendor/autoload.php';

    // Substitua com suas credenciais
    MercadoPago\SDK::setAccessToken('TEST-5938414195419363-052311-227eb2e009027f2cb324e908a190e4e7-565737986');

    // Crie uma preferência de pagamento
    $preference = new MercadoPago\Preference();
    $item = new MercadoPago\Item();
    $item->title = "Seu(s) produto(s)!"; // Use a descrição recebida do JavaScript
    $item->quantity = 1; // Defina a quantidade conforme necessário
    $item->unit_price = $valor; // Use o valor convertido para float aqui
    $preference->items = array($item);

    // Salve a preferência e obtenha o ID
    $preference->save();

    // Agora você pode obter o ID gerado dinamicamente
    $preference_id = $preference->id;

    // Crie o link de pagamento com o ID da preferência de pagamento
    $link_pagamento = "https://www.mercadopago.com.br/checkout/v1/redirect?preference-id={$preference_id}";

    // Redirecione o usuário para o link de pagamento
    header("Location: $link_pagamento");
    exit;
}

?>
