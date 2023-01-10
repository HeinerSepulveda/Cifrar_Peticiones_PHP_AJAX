<?php
    include('encryption.php');
    $claveCifrado = '12345';
    $data = $_POST["buscar"];
    
    $decifrado = cryptoJsAesDecrypt($claveCifrado, $data);
    echo 'Valor cifrado: '.$data.'<br>';
    echo 'Valor decifrado: '.$decifrado;
?>