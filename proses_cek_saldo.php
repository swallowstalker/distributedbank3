<?php
    

    require_once "autoload.php";

    // extract hasil field kiriman dari form.
    extract($_POST);
    
    // melakukan proses cek saldo tergantung dari pilihan, lokal atau global.
    $client = new SoapClient(PEER4); // mesin kita sendiri.
    
    if (isset($btn_saldo)) {
        $saldo = $client->getSaldo($dropdown_nama);
        // pesan
        echo "Saldo: ". $saldo ."<br />";
    } else if (isset($btn_total_saldo)){
        $saldo = $client->getTotalSaldo($dropdown_nama);
        // pesan
        echo "Saldo total: ". $saldo ."<br />";
    }
    
    echo "<a href=\"interface/home.php\">Kembali</a>";
    
?>
