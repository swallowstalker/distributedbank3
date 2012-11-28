<?php
    
    require_once "autoload.php";

    // extract hasil field kiriman dari form.
    extract($_POST);
    
    $ownServer = new SoapClient(PEER4); // mesin kita sendiri.
    $saldo = $ownServer->getSaldo($dropdown_nama);
    $saldoTersisa = $saldo - $field_nominal;
    
    // cek saldo yang tersisa.
    if ($saldoTersisa >= 0) {
        
        // transfer ke mesin tujuan.
        $client = new SoapClient($tujuan); // mesin tujuan.
		$isRegistered = $client->getSaldo($dropdown_nama);
		if ($isRegistered < 0) {
			$bank = new Bank4();
			$user = $bank->getUserData($dropdown_nama);
			$client->register($user->id, $user->nama, HERE);
		}
        $response = $client->transfer($dropdown_nama, $field_nominal);
        
        // aksi untuk balasan dari mesin tujuan.
        if ($response == 0) {
            echo "Transfer tidak berhasil.<br />";
        } else {
            
            // jika transfer berhasil, kurangi saldo di mesin kita.
            $saldo = $ownServer->getSaldo($dropdown_nama);
            $saldoTersisa = $saldo - $field_nominal;
            echo "Saldo saat ini di server: ". $ownServer->getSaldo($dropdown_nama) ."<br />";
            
            $bank = new Bank4();
            $bank->updateSaldo($dropdown_nama, $saldoTersisa);
            echo "Transfer berhasil.<br />";
        }
        
    } else {
        echo "Transfer tidak berhasil. Saldo tidak cukup.<br />";
    }
    
    echo "<a href=\"interface/home.php\">Kembali</a>";
    
?>
