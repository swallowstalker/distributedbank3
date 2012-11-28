<?php
    require_once "mysql/config.php";

    // extract hasil field kiriman dari form.
    extract($_POST);
    
    // melakukan proses cek saldo tergantung dari pilihan, lokal atau global.
    $client = new SoapClient(PEER4); // mesin kita sendiri.
    
    if (isset($btn_saldo)) {
        $saldo = $client->getSaldo(trim($dropdown_nama));
		//$saldo = $client->__soapCall('getSaldo',array('user_id'=>trim($dropdown_nama)));
		//$saldo = $client->ping();
        // pesan
        echo "Saldo: ". $saldo ."<br />";
    } else if (isset($btn_total_saldo)){
        $saldo = $client->getTotalSaldo($dropdown_nama);
        // pesan
        echo "Saldo total: ". $saldo ."<br />";
    }
    
    echo "<a href=\"interface/home.php\">Kembali</a>";
    
?>