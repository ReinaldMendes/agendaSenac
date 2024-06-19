<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/agendasenaccopia/classes/api.php/users',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$output = curl_exec($curl);

curl_close($curl);

$decoded = json_decode($output, true); // Mudei para true para retornar um array associativo

foreach ($decoded as $x) {
    echo "$x[nome] <br>";
    echo "$x[email] <br>";
    echo "$x[senha] <br>";
    echo "$x[permissoes] <br>";
}
?>
